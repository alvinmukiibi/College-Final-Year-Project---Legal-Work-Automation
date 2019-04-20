@component('mail::message')
# Hello {{$recipient->fname}} <br/>

This email serves to inform you of a <b><i>{{$details['name']}}</i></b> meeting on {{$details['date']}} at {{$details['time']}}.
The Venue is {{$details['venue']}} and the agenda of the meeting is

@component('mail::panel')
<blockquote><b>{{$details['agenda']}}</b></blockquote>.
@endcomponent

Please attend in person.

Thanks,<br>
{{$sender}} <br/>
{{ config('app.name') }}
@endcomponent
