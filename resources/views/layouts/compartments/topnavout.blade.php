{{-- 
What    :   Top navigation bar for website i.e. before login
Author  :   Alvin Mukiibi
Date    :   6th-February-2019
 --}}
 {{-- <nav class="navbar navbar-expand navbar-dark bg-primary">
  <div class="container">
    <a href="/" class="navbar-brand">
      L-WAT
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="fa fa-home" ></i> Home
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav> --}}

<header id="header">
  <div class="container main-menu">
    <div class="row align-items-center justify-content-between d-flex">
      <div id="logo">
        <a href="index.html"><img src="{{asset('img/logo.png')}}" alt="" title="" /></a>
      </div>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="/">Home</a></li>
          <li><a href="/home">Find a Lawyer</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="price.html">Pricing</a></li>
          <li class="menu-has-children"><a href="">Blog</a>
            <ul>
              <li><a href="blog-home.html">Blog Home</a></li>
              <li><a href="blog-single.html">Blog Single</a></li>
            </ul>
          </li>	
          <li class="menu-has-children"><a href="">Pages</a>
            <ul>
              <li><a href="elements.html">Elements</a></li>
            <li class="menu-has-children"><a href="">Level 2 </a>
              <ul>
                <li><a href="#">Item One</a></li>
                <li><a href="#">Item Two</a></li>
              </ul>
            </li>					                		
            </ul>
          </li>					          					          		          
          <li><a href="/login">Login</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->		    		
    </div>
  </div>
</header><!-- #header -->

