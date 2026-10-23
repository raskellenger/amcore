<?php

declare(strict_types=1);

namespace App\Actions\Leads;

use App\Mail\DiscoveryRequestReceived;
use App\Models\Lead;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Lorisleiva\Actions\Concerns\AsAction;
use Psr\Log\LoggerInterface;

class SendDiscoveryRequestNotification implements ShouldQueue
{
    use AsAction;

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    public function handle(Lead $lead): void
    {
        Mail::to(config('mail.discovery_request_recipients'))
            ->send(new DiscoveryRequestReceived($lead));

        $this->logger->info('Discovery request notification sent.', ['lead_id' => $lead->id]);
    }
}
