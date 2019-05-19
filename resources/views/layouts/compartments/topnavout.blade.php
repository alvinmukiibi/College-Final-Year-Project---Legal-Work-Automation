{{--
What    :   Top navigation bar for website i.e. before login
Author  :   Alvin Mukiibi
Date    :   6th-February-2019
 --}}

<header id="header">
  <div class="container main-menu">
    <div class="row align-items-center justify-content-between d-flex">
      <div id="logo">
        <a href="{{ url('/') }}"><img src="{{asset('img/logo.png')}}" alt="" title="" /></a>
      </div>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="{{ url('/') }}"><b>Home</b></a></li>
          <li><a href="{{ url('/firms') }}"><b>Find a Lawyer</b></a></li>			          					          		                   <li><a href="{{ url('/login') }}"><b>Login</b></a></li>
        </ul>
      </nav>
    </div>
  </div>
</header>

