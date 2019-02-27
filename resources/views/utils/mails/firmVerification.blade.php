@include('layouts.partials.headin')
<div class="container">
    <p>
            Hello <b style="color:blue">{{$firm_name}}</b><br/>
            Thank you for registering with <i><b>Legal Work Automation Tool</b></i><br/>
            Click on the link below to verify your email account
   
    </p>
    <p>
    <a href="http://wat.alv/firm/verifyEmail/{{$token}}">Verification Link</a>
    </p>
     
   
    
    <p> <b>Note:</b> Your One Time Password is {{$firm_otp}}</p>
</div>

@include('layouts.partials.footin')