@component('mail::message')
Hello,  {{ $sharee->fname }} {{ $sharee->lname }}

This email serves to notify you that <b> {{ $sharer->fname }} {{ $sharer->lname }} </b> assigned a case to you.
The case number is <b>{{ $case_id }}</b> and you can find it in your workspace at the link below.

@component('mail::button', ['url' => 'http://wat-l.herokuapp.com/associate/view/case/' . $case_id])
VIEW CASE
@endcomponent

Thanks,<br>
{{ 'Management' }}<br/>
{{ config('app.name') }}
@endcomponent
