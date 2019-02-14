@include('layouts.partials.headin')


<nav class="navbar navbar-expand navbar-dark bg-primary">
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
      </nav>
      <body class="hold-transition login-page">
            <div class="login-box">
              <div class="login-logo">
                <a href="../../index2.html"><b>WAT</b>-L</a>
              </div>
              <!-- /.login-logo -->
              <div class="card">
                <div class="card-body login-card-body">
                  <p class="login-box-msg">Sign in to start your session</p>
            
                  <form action="/login" method="POST">
                      {{csrf_field()}}
                    <div class="form-group has-feedback">
                      <input type="email" class="form-control{{$errors->has('email')?'is-invalid':''}}" placeholder="Email">
                     
                    </div>
                    <div class="form-group has-feedback">
                      <input type="password" class="form-control {{$errors->has('description')?'is-invalid':''}}" placeholder="Password">
                      
                    </div>
                    <div class="row">
                      <div class="col-8">
                            <p class="mb-1">
                                    <a href="#">I forgot my password</a>
                                  </p>
                                  <p class="mb-0">
                                    <a href="register.html" class="text-center">Register a new membership</a>
                                  </p>
                      </div>
                      
                      <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                      </div>
                      
                    </div>
                  </form>
            
               
                  
            
                  
                </div>
                
              </div>
            </div>
            
            @include('layouts.partials.footin')    

