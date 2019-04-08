@component('mail::message')
Hello {{$name}} <br/>

You have been successfully registered with the <i><b>Legal Work Automation Tool</b></i><br/>
Verify Your Email Address, Please

@component('mail::button', ['url' => 'http://127.0.0.1:8000/api/user/verifyEmail/'.$token, 'color' => 'success'])
VERIFY EMAIL
@endcomponent

@component('mail::panel')
<b>Note:</b> Your One Time Password is {{$otp}}
@endcomponent

Thanks,<br>
Team,<br>
{{ config('app.name') }}
@endcomponent
