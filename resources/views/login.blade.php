@include('layouts.partials.headin')



      <body>
          <nav class="navbar navbar-expand navbar-dark bg-primary">
              <div class="container">
              <a href="{{ url('/')}}" class="navbar-brand">
                  L-WAT
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                      <a href="{{ url('/')}}" class="nav-link">
                        <i class="fa fa-home" ></i> Home
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
<div class="container">
  <div class="row mt-3">
    <div class="col-md-5 mx-auto">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center pb-4 pt-3">
            <span class="text-primary">
              <i class="fa fa-lock"></i>
              Login
            </span>
          </h1>
          <form action="/login" method="POST">
            @csrf
          <div class="form-group">

              <input type="email" required placeholder="Email" class="form-control {{$errors->has('email')?'is-invalid':''}}" name="email"  />
            </div>
            <div class="form-group">

              <input type="password" placeholder="Password" class="form-control {{$errors->has('password')?'is-invalid':''}}" name="password" required />
              </div>

              @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{session('error')}}
                </div>

              @endif
              @if(session('info'))
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{session('info')}}
                </div>

              @endif
              @if($errors->any())
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{$error}}
                  </div>

                @endforeach

              @endif

              <input type="submit" value="Login" class="btn btn-primary btn-block btn-flat">



          </form>



        </div>

      </div>

    </div>


</div>


</div>

            @include('layouts.partials.footin')

