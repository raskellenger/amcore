<?php

declare(strict_types=1);

use App\Actions\Leads\SendDiscoveryRequestNotification;
use App\Mail\DiscoveryRequestReceived;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

test('it emails the discovery request notification for a lead', function (): void {
    Mail::fake();

    $lead = Lead::create([
        'name' => 'Jim Carter',
        'company' => 'Carter Plumbing',
        'trade' => 'plumbing',
        'crew_size' => '5_14',
        'phone' => '864-555-0142',
        'email' => 'jim@carterplumbing.test',
        'headache' => 'We lose paper work orders on job sites constantly.',
        'preferred_contact_method' => 'phone',
    ]);

    SendDiscoveryRequestNotification::run($lead);

    Mail::assertSent(DiscoveryRequestReceived::class, fn ($mail): bool => $mail->lead->is($lead));
});
