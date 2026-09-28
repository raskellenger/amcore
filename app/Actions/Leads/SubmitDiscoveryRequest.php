<?php

declare(strict_types=1);

namespace App\Actions\Leads;

use App\Models\Lead;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;
use Psr\Log\LoggerInterface;

class SubmitDiscoveryRequest
{
    use AsAction;

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public function handle(array $data): ?Lead
    {
        if (filled($data['website'] ?? null)) {
            $this->logger->info('Discovery request dropped by honeypot.');

            return null;
        }

        $validated = Validator::make($data, $this->rules())->validate();

        $lead = Lead::create($validated);

        SendDiscoveryRequestNotification::dispatch($lead);

        $this->logger->info('Discovery request received.', ['lead_id' => $lead->id]);

        return $lead;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'trade' => ['required', 'string', 'in:'.implode(',', array_keys(Lead::TRADES))],
            'crew_size' => ['required', 'string', 'in:'.implode(',', array_keys(Lead::CREW_SIZES))],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255'],
            'headache' => ['required', 'string', 'max:2000'],
            'preferred_contact_method' => ['required', 'string', 'in:'.implode(',', array_keys(Lead::CONTACT_METHODS))],
        ];
    }
}
