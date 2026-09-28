<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New discovery call request</title>
</head>
<body style="font-family: -apple-system, sans-serif; color: #191a1c; background: #f7f4ee; padding: 24px;">
    <div style="max-width: 560px; margin: 0 auto; background: #ffffff; border: 1px solid #e4ddcf; border-radius: 8px; padding: 24px;">
        <h1 style="color: #1f2a44; font-size: 20px; margin: 0 0 16px;">New discovery call request</h1>

        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <tr><td style="padding: 4px 0; color: #1f2a44; font-weight: 600; width: 160px;">Name</td><td style="padding: 4px 0;">{{ $lead->name }}</td></tr>
            <tr><td style="padding: 4px 0; color: #1f2a44; font-weight: 600;">Company</td><td style="padding: 4px 0;">{{ $lead->company ?? '—' }}</td></tr>
            <tr><td style="padding: 4px 0; color: #1f2a44; font-weight: 600;">Trade</td><td style="padding: 4px 0;">{{ \App\Models\Lead::TRADES[$lead->trade] ?? $lead->trade }}</td></tr>
            <tr><td style="padding: 4px 0; color: #1f2a44; font-weight: 600;">Crew size</td><td style="padding: 4px 0;">{{ \App\Models\Lead::CREW_SIZES[$lead->crew_size] ?? $lead->crew_size }}</td></tr>
            <tr><td style="padding: 4px 0; color: #1f2a44; font-weight: 600;">Phone</td><td style="padding: 4px 0;">{{ $lead->phone }}</td></tr>
            <tr><td style="padding: 4px 0; color: #1f2a44; font-weight: 600;">Email</td><td style="padding: 4px 0;">{{ $lead->email }}</td></tr>
            <tr><td style="padding: 4px 0; color: #1f2a44; font-weight: 600;">Preferred contact</td><td style="padding: 4px 0;">{{ \App\Models\Lead::CONTACT_METHODS[$lead->preferred_contact_method] ?? $lead->preferred_contact_method }}</td></tr>
        </table>

        <p style="color: #1f2a44; font-weight: 600; margin: 16px 0 4px;">Biggest headache right now</p>
        <p style="margin: 0;">{{ $lead->headache }}</p>

        <p style="margin-top: 24px; font-size: 12px; color: #6b6456;">Received {{ $lead->created_at->format('M j, Y g:ia') }}.</p>
    </div>
</body>
</html>
