@component('mail::message')
    # {{$content['title'] }}<br>
   Hello,

    {{$content['body'] }}


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
