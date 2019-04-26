@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">
@endsection

@section('content')

<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">My Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Personal Profile</li>
                    </ol>
                </div>
            </div>
        </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                        src="{{asset('uploads/profiles/'.$user->profile_pic)}}"
                                alt="User profile picture">
                        </div>
                    <h3 class="profile-username text-center">{{$user->fname }} {{$user->lname}}</h3>
                    <p class="text-muted text-center">
                        @if($user->user_role == 'Associate')
                            {{ __('Associate') }}
                        @else
                            @if ($user->user_role == 'Partner')
                            {{ __('Partner') }}
                            @else
                            {{ __('Finance Comptroller') }}
                            @endif

                        @endif
                    </p>
                    <p class="text-center">{{$user->dept->name}}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                 <i class="fa fa-envelope"></i><span class="float-right"> {{$user->email}}</span>
                                </li>
                                <li class="list-group-item">
                                        <i class="fa fa-phone"></i><span class="float-right"> {{$user->contact}}</span>
                                       </li>

                            </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                    <div class="card">
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">
                          <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">My Profile</a></li>
                          {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Correspondence</a></li> --}}
                         </ul>

                        </div><!-- /.card-header -->
                      <div class="card-body">
                            @include('includes.messages')
                          <div class="tab-content">
                              <div class="active tab-pane" id="profile">
                                    <form action="{{url('/admin/saveProfile')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                    <div class="form-group row">
                                            <label for="firstName" class="col-sm-4 col-form-label">First Name</label>

                                            <div class="col-sm-8">
                                            <input type="text" value="{{$user->fname}}" required class="form-control {{$errors->has('firstName')?'is-invalid':''}}" name="firstName"   placeholder="First Name">
                                            </div>
                                          </div>
                                          <div class="form-group row">

                                                <label for="lastName"  class="col-sm-4 col-form-label">Last Name</label>

                                                <div class="col-sm-8">
                                                  <input type="text" value="{{$user->lname}}" required class="form-control {{$errors->has('lastName')?'is-invalid':''}}" name="lastName"  placeholder="Last Name">
                                                </div>
                                              </div>
                                              <div class="form-group row">
                                                    <label for="email" class="col-sm-4 col-form-label">Email</label>

                                                    <div class="col-sm-8">
                                                    <input type="text" class="form-control" readonly  value="{{$user->email}}">
                                                    </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="contact" required class="col-sm-4 col-form-label">Phone Number</label>

                                                        <div class="col-sm-8">
                                                          <input type="text" value="{{$user->contact}}" class="form-control {{$errors->has('contact')?'is-invalid':''}}" name="contact"  placeholder="Personal Contact">
                                                        </div>
                                                      </div>
                                                      <div class="form-group row">
                                                            <label for="profilePicture" class="col-sm-4 col-form-label">Profile icture</label>

                                                            <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                            <div class="custom-file">
                                                                              <input type="file" class="custom-file-input {{$errors->has('profilePicture')?'is-invalid':''}}" name="profilePicture">
                                                                              <label class="custom-file-label" >Choose file</label>
                                                                            </div>
                                                                    </div>
                                                                                                  </div>
                                                          </div>
                                                          <div class="form-group row">
                                                              <label for="password" class="col-sm-4 col-form-label">Password</label>
                                                              <div class="col-sm-8">
                                                              <input type="password" name="password" class="form-control {{$errors->has('password')?'is-invalid':''}}" >
                                                              </div>
                                                          </div>
                                                          <div class="form-group row">
                                                                <label for="confirmationPassword" class="col-sm-4 col-form-label">Confirm Password</label>
                                                                <div class="col-sm-8">
                                                                <input type="password" name="password_confirmation" class="form-control {{$errors->has('password_confirmation')?'is-invalid':''}}" >
                                                                </div>
                                                            </div>
                                                          <button type="submit" class="btn btn-outline-primary pull-right"> <i class="fa fa-save"></i> Save</button>

                                                        </form>
                                                        </div>
                          </div>
                      </div>


                    </div>
            </div>
        </div>
    </div>


</section>

@endsection
