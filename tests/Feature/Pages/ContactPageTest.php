<?php

declare(strict_types=1);

use App\Actions\Leads\SendDiscoveryRequestNotification;
use Illuminate\Support\Facades\Bus;
use Livewire\Volt\Volt;
use Lorisleiva\Actions\Decorators\JobDecorator;

function fillValidContactForm(mixed $component): mixed
{
    return $component
        ->set('name', 'Jim Carter')
        ->set('company', 'Carter Plumbing')
        ->set('trade', 'plumbing')
        ->set('crew_size', '5_14')
        ->set('phone', '864-555-0142')
        ->set('email', 'jim@carterplumbing.test')
        ->set('headache', 'We lose paper work orders on job sites constantly.')
        ->set('preferred_contact_method', 'phone');
}

test('a visitor can submit the discovery request form', function (): void {
    Bus::fake();

    $component = fillValidContactForm(Volt::test('pages.contact'));
    $component->call('submit');

    $component->assertSet('submitted', true);
    $component->assertSee('Got it.');

    $this->assertDatabaseHas('leads', ['email' => 'jim@carterplumbing.test']);
    Bus::assertDispatched(
        JobDecorator::class,
        fn (JobDecorator $job): bool => $job->getAction() instanceof SendDiscoveryRequestNotification
    );
});

test('it shows validation errors for missing required fields', function (): void {
    Volt::test('pages.contact')
        ->set('name', '')
        ->call('submit')
        ->assertHasErrors(['name']);

    $this->assertDatabaseCount('leads', 0);
});

test('a honeypot submission shows success without creating a lead', function (): void {
    Bus::fake();

    $component = fillValidContactForm(Volt::test('pages.contact'))
        ->set('website', 'http://spambot.example');

    $component->call('submit');

    $component->assertSet('submitted', true);
    $this->assertDatabaseCount('leads', 0);
});

test('it rate limits repeated submissions and shows a message instead of a 500', function (): void {
    Bus::fake();

    for ($i = 0; $i < 5; $i++) {
        fillValidContactForm(Volt::test('pages.contact'))
            ->set('email', "jim{$i}@carterplumbing.test")
            ->call('submit');
    }

    $this->assertDatabaseCount('leads', 5);

    $component = fillValidContactForm(Volt::test('pages.contact'))
        ->set('email', 'jim6@carterplumbing.test')
        ->call('submit');

    $component->assertSet('rateLimited', true);
    $component->assertSet('submitted', false);
    $component->assertSee('Too many discovery call requests');

    $this->assertDatabaseCount('leads', 5);
});
