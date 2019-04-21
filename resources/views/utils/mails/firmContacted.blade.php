@component('mail::message')

Hello {{ $firm->name }}, You have been contacted by  <b>{{ $data['name'] }}</b> via the <b> <i>L-WAT</i> </b> portal. <br/>
They have provided their contacts as: <br/>
<b>Email Address</b> : {{ $data['email'] }} <br/>
<b>Phone</b> : {{ $data['phone'] }} <br/>
They prefer that you contact them through their
@if ($data['contactChoice'] == '1')
    {{ __('email as provided above.') }}
@endif
@if ($data['contactChoice'] == '2')
    {{ __('phone number as provided above.') }}
@endif

<b>Query: </b>

@component('mail::panel')
{{ $data['query'] }}
@endcomponent

Regards,<br>
Team<br/>
{{ config('app.name') }}
@endcomponent
