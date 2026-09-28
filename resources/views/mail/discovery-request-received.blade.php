<x-mail::message>
# New discovery call request

**Name:** {{ $lead->name }}
**Company:** {{ $lead->company ?? '—' }}
**Trade:** {{ \App\Models\Lead::TRADES[$lead->trade] ?? $lead->trade }}
**Crew size:** {{ \App\Models\Lead::CREW_SIZES[$lead->crew_size] ?? $lead->crew_size }}
**Phone:** {{ $lead->phone }}
**Email:** {{ $lead->email }}
**Preferred contact method:** {{ \App\Models\Lead::CONTACT_METHODS[$lead->preferred_contact_method] ?? $lead->preferred_contact_method }}

**Biggest headache right now:**
{{ $lead->headache }}

Received {{ $lead->created_at->format('M j, Y g:ia') }}.
</x-mail::message>
