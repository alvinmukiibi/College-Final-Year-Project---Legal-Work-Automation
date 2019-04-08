@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">
@endsection

@section('content')

<section class="content-header">
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Website Manager</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Website</li>
                </ol>
            </div>
        </div>
    </div>  
</section>
<div class="col-md-9">
                    <div class="card">
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">
                          <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">LawfirmProfile</a></li>
                          {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Correspondence</a></li> --}}
                         </ul>

                        </div><!-- /.card-header -->
<div class="card-body">
                            @include('includes.messages')
<div class="tab-content">
<div class="active tab-pane" id="profile">
                                    <form action="{{url('/admin/saveProfile')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                    <div class="form-group">
                                            <label for="firstName" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-12">
                                            <input type="text" value="{{$user->fname}}" required class="form-control {{$errors->has('firstName')?'is-invalid':''}}" name="firstName"   placeholder="First Name">
                                            </div>
                                          </div>
                                          <div class="form-group">

                                                <label for="lastName"  class="col-sm-2 control-label">Last Name</label>

                                                <div class="col-sm-12">
                                                  <input type="text" value="{{$user->lname}}" required class="form-control {{$errors->has('lastName')?'is-invalid':''}}" name="lastName"  placeholder="Last Name">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                    <label for="email" class="col-sm-2 control-label">Email</label>

                                                    <div class="col-sm-12">
                                                    <input type="text" class="form-control" readonly  value="{{$user->email}}">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                        <label for="contact" required class="col-sm-4 control-label">contact1</label>

                                                        <div class="col-sm-12">
                                                          <input type="text" value="{{$user->contact}}" class="form-control {{$errors->has('contact')?'is-invalid':''}}" name="contact"  placeholder="Personal Contact">
                                                        </div>
                                                      </div>
                                                  <div class="form-group">
                                                        <label for="contact" required class="col-sm-4 control-label">contact2</label>

                                                        <div class="col-sm-12">
                                                          <input type="text" value="{{$user->contact}}" class="form-control {{$errors->has('contact')?'is-invalid':''}}" name="contact"  placeholder="Personal Contact">
                                                        </div>
                                                      </div> 
                                                      <div class="form-group">
                                                            <label for="profilePicture" class="col-sm-4 control-label">Profile Picture</label>

                                                            <div class="col-sm-12">
                                                              <input type="file" class="form-control {{$errors->has('profilePicture')?'is-invalid':''}}"  name="profilePicture">
                                                            </div>
                                                          </div>
                                                          <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Save</button>

                                                        </form>
                                                        </div>
                          </div>
                        </div>
                    </div>
</div>
@endsection
