@component('mail::message')
# Hello {{$firm_name}}<br/> 

Thank you for registering with <i><b>Legal Work Automation Tool</b></i><br/>
Verify Your Email Address, Please.

@component('mail::button', ['url' => 'http://wat.alv/api/firm/verifyEmail/'.$firm_uuid, 'color' => 'success'])
VERIFY EMAIL
@endcomponent

@component('mail::panel')
<b>Note:</b> Your One Time Password is {{$firm_otp}}
@endcomponent

Thanks,<br>
Team, <br>
{{ config('app.name') }}
@endcomponent
