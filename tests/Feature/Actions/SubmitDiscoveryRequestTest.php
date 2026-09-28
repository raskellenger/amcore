<?php

declare(strict_types=1);

use App\Actions\Leads\SendDiscoveryRequestNotification;
use App\Actions\Leads\SubmitDiscoveryRequest;
use App\Exceptions\TooManyDiscoveryRequestsException;
use App\Models\Lead;
use Illuminate\Support\Facades\Bus;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Decorators\JobDecorator;

function validDiscoveryRequestData(array $overrides = []): array
{
    return array_merge([
        'name' => 'Jim Carter',
        'company' => 'Carter Plumbing',
        'trade' => 'plumbing',
        'crew_size' => '5_14',
        'phone' => '864-555-0142',
        'email' => 'jim@carterplumbing.test',
        'headache' => 'We lose paper work orders on job sites constantly.',
        'preferred_contact_method' => 'phone',
        'website' => '',
    ], $overrides);
}

test('it saves a valid discovery request as a lead', function (): void {
    Bus::fake();

    $lead = SubmitDiscoveryRequest::run(validDiscoveryRequestData());

    expect($lead)->toBeInstanceOf(Lead::class);

    $this->assertDatabaseHas('leads', [
        'id' => $lead->id,
        'name' => 'Jim Carter',
        'company' => 'Carter Plumbing',
        'trade' => 'plumbing',
        'email' => 'jim@carterplumbing.test',
    ]);
});

test('it queues the notification action after saving a lead', function (): void {
    Bus::fake();

    $lead = SubmitDiscoveryRequest::run(validDiscoveryRequestData());

    Bus::assertDispatched(
        JobDecorator::class,
        fn (JobDecorator $job): bool => $job->getAction() instanceof SendDiscoveryRequestNotification
            && $job->getParameters()[0]->is($lead)
    );
});

test('it rejects missing required fields', function (): void {
    Bus::fake();

    SubmitDiscoveryRequest::run(validDiscoveryRequestData(['name' => '']));
})->throws(ValidationException::class);

test('it rejects an invalid email', function (): void {
    Bus::fake();

    SubmitDiscoveryRequest::run(validDiscoveryRequestData(['email' => 'not-an-email']));
})->throws(ValidationException::class);

test('it rejects a trade that is not in the allowed list', function (): void {
    Bus::fake();

    SubmitDiscoveryRequest::run(validDiscoveryRequestData(['trade' => 'astrophysics']));
})->throws(ValidationException::class);

test('it silently drops submissions caught by the honeypot', function (): void {
    Bus::fake();

    $lead = SubmitDiscoveryRequest::run(validDiscoveryRequestData(['website' => 'http://spambot.example']));

    expect($lead)->toBeNull();

    $this->assertDatabaseCount('leads', 0);
    Bus::assertNotDispatched(
        JobDecorator::class,
        fn (JobDecorator $job): bool => $job->getAction() instanceof SendDiscoveryRequestNotification
    );
});

test('it rate limits repeated submissions from the same ip', function (): void {
    Bus::fake();

    for ($i = 0; $i < 5; $i++) {
        SubmitDiscoveryRequest::run(validDiscoveryRequestData(['email' => "jim{$i}@carterplumbing.test"]), '203.0.113.5');
    }

    $this->assertDatabaseCount('leads', 5);

    SubmitDiscoveryRequest::run(validDiscoveryRequestData(['email' => 'jim6@carterplumbing.test']), '203.0.113.5');
})->throws(TooManyDiscoveryRequestsException::class);

test('it does not rate limit submissions from a different ip', function (): void {
    Bus::fake();

    for ($i = 0; $i < 5; $i++) {
        SubmitDiscoveryRequest::run(validDiscoveryRequestData(['email' => "jim{$i}@carterplumbing.test"]), '203.0.113.5');
    }

    $lead = SubmitDiscoveryRequest::run(validDiscoveryRequestData(['email' => 'other@otherplumbing.test']), '198.51.100.9');

    expect($lead)->toBeInstanceOf(Lead::class);
});
