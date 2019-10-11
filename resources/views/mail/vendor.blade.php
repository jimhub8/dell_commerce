@component('mail::message')
# Hello {{ $user->name }}
Thank you for registering with dellmat. This is your password new {{ $password }}
Thanks,<br>
{{ config('app.name') }}
@endcomponent
