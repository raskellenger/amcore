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

    $component->assertRedirect(route('how-we-work'));

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

test('required fields carry the native required attribute, company does not', function (): void {
    $html = $this->get('/contact')->getContent();

    preg_match('/<input[^>]*id="name"[^>]*>/', $html, $nameField);
    preg_match('/<input[^>]*id="company"[^>]*>/', $html, $companyField);

    expect($nameField[0])->toContain('required');
    expect($companyField[0])->not->toContain('required');
});

test('an invalid field is linked to its error message for assistive tech', function (): void {
    $component = Volt::test('pages.contact')
        ->set('name', '')
        ->call('submit');

    $component->assertSee('id="name-error"', false);
    $component->assertSee('aria-describedby="name-error"', false);
    $component->assertSee('aria-invalid="true"', false);
});

test('a honeypot submission shows success without creating a lead', function (): void {
    Bus::fake();

    $component = fillValidContactForm(Volt::test('pages.contact'))
        ->set('website', 'http://spambot.example');

    $component->call('submit');

    $component->assertRedirect(route('how-we-work'));
    $this->assertDatabaseCount('leads', 0);
});

test('the honeypot field is clipped, not pushed off-screen', function (): void {
    $response = $this->get('/contact');

    $response->assertOk();
    $response->assertDontSee('-left-[9999px]', false);
    $response->assertSee('h-0 w-0 overflow-hidden', false);
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
    $component->assertSee('Too many discovery call requests');

    $secondsRemaining = $component->get('rateLimitedForSeconds');
    expect($secondsRemaining)->toBeGreaterThan(0)->toBeLessThanOrEqual(60);
    $component->assertSee("about {$secondsRemaining} seconds");
    $component->assertSee('role="alert"', false);

    $this->assertDatabaseCount('leads', 5);
});
