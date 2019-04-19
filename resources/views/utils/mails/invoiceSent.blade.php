@component('mail::message')
Hello, {{ $data['client']->name }}. <b>{{ $data['firm']->name }}</b> informs you of a pending payment of SHS {{ $data['invoice']->amount }} as reflected in the invoice attached. <br/>

Please find more information in the invoice attached!


Thanks,<br>
{{ 'Team' }}<br/>
{{ config('app.name') }}
@endcomponent
