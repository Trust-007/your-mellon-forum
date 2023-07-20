@component('mail::message')
# Verify Your Email Address

Click the button below to verify your email address:

@component('mail::button', ['url' => route('verification.verify', ['id' => $user->id, 'hash' => $user->hash])])
Verify Email
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent