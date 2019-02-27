{{-- 
What    :   Top navigation bar for user session i.e. after login
Author  :   Alvin Mukiibi
Date    :   6th-February-2019
 --}}
<nav class="main-header navbar navbar-expand bg-primary navbar-light border-bottom">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/dashboard" class="nav-link">Home <i class="fa fa-home"></i></a>
        </li>
        @if (auth()->user()->user_role == "ulc")
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/register/firm" class="nav-link">Register a Firm <i class="fa fa-plus-circle"></i>   </a>
        </li>
        @endif
    </ul>
    <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a href="#!" class="nav-link">
                        {{auth()->user()->email}}
                    </a>
                </li>
        <li class="nav-item">
            <a href="/logout" class="nav-link">
                Logout <i class="fa fa-sign-out"></i>
            </a>
        </li>
    </ul>
</nav>