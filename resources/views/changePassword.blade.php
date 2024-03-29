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
              Change Password
            </span>
          </h1>
        <form action="{{url('/changePassword')}}" method="POST">
            @csrf
          <div class="form-group">

              <input type="password" required placeholder="Password" class="form-control {{$errors->has('password')?'is-invalid':''}}" name="password"  />
            </div>
            <div class="form-group">

              <input type="password" placeholder="Confirm Password" class="form-control {{$errors->has('password_confirmation')?'is-invalid':''}}" name="password_confirmation" required />
              </div>

              @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{session('error')}}
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

              <button type="submit" class="btn btn-secondary btn-block"> Save <i class="fa fa-save"></i> </button>



          </form>



        </div>

      </div>

    </div>


</div>


</div>

            @include('layouts.partials.footin')

