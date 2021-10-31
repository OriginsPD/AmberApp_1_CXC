@component('mail::message')
# Congratulation You Have Been Approved

You have been approved for {{ $details['subject'] }}

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
Check On Your Status
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
