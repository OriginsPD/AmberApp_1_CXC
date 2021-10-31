@component('mail::message')
# Good Day {{ $details['name'] }}

Your Status As A {{ $details['subject'] }} Teacher Has Been Approved

# Account Information
## Please Keep Account information confidential

### Email Address: #### {{ $details['email'] }}

### Password: #### {{ $details['password'] }}

@component('mail::button', ['url' => 'http://127.0.0.1:8000/teacher/portal'])
Login Using Teacher Portal
@endcomponent

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
