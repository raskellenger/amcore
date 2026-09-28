<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DiscoveryRequestReceived extends Mailable
{
    use SerializesModels;

    public function __construct(
        public readonly Lead $lead,
    ) {}

    public function build(): self
    {
        return $this
            ->subject('New discovery call request: '.$this->lead->name)
            ->view('mail.discovery-request-received');
    }
}
