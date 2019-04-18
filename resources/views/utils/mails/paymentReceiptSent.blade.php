@component('mail::message')
Hello, {{ $data['client']->name }}. <b>{{ $data['firm']->name }}</b> thanks you for the payment made on {{ date('d-M-Y', strtotime($data['payment']->date_of_payment)) }}. <br/> Please find attached the receipt.

Thanks,<br>
{{ 'Team' }}<br/>
{{ config('app.name') }}
@endcomponent
