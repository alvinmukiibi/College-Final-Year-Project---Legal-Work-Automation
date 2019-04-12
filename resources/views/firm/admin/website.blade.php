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
<section class="content">
    <div class="container-fluid">
<div class="row">
            
<div class="col-md-2">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle", width="500", height="500"
                        src="{{asset('uploads/firms/'.$firm->avatar)}}"
                                alt="User profile picture">
                        </div>
                        
                  </div>
                </div>
  </div>           
<div class="col-md-10">
                    <div class="card">
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">
                          <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">LawfirmProfile</a></li>
                          {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Correspondence</a></li> --}}
                         </ul>

                        </div><!-- /.card-header -->
<div class="card-body">
                           
<div class="tab-content">
<div class="active tab-pane" id="profile">
                                    <form action="{{url('/admin/savelawfirmProfile')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                    <div class="form-group">
                                            <label for="firstName" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-12">
                                            <input type="text" value="{{$firm->name}}" required class="form-control {{$errors->has('firstName')?'is-invalid':''}}" name="name"   placeholder="First Name">
                                            </div>
                                          </div>
                                              <div class="form-group">
                                                    <label for="email" class="col-sm-2 control-label">Email</label>

                                                    <div class="col-sm-12">
                                                    <input type="text" class="form-control" readonly  value="{{$firm->email}}">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                        <label for="contact" required class="col-sm-4 control-label">contact1</label>

                                                        <div class="col-sm-12">
                                                          <input type="text" value="{{$firm->contact1}}" class="form-control {{$errors->has('contact')?'is-invalid':''}}" name="contact1"  placeholder="Personal Contact">
                                                        </div>
                                                      </div>
                                                  <div class="form-group">
                                                        <label for="contact" required class="col-sm-4 control-label">contact2</label>

                                                        <div class="col-sm-12">
                                                          <input type="text" value="{{$firm->contact2}}" class="form-control {{$errors->has('contact')?'is-invalid':''}}" name="contact2"  placeholder="Personal Contact">
                                                        </div>
                                                      </div> 
                                                      <div class="form-group">
                                                        <label for="contact" required class="col-sm-4 control-label">Country</label>

                                                        <div class="col-sm-12">
                                                          <input type="text" value="{{$firm->country}}" class="form-control {{$errors->has('country')?'is-invalid':''}}" name="country"  placeholder="Country">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="contact" required class="col-sm-4 control-label">Area</label>

                                                        <div class="col-sm-12">
                                                          <input type="text" value="{{$firm->area}}" class="form-control {{$errors->has('area')?'is-invalid':''}}" name="area"  placeholder="Area">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="contact" required class="col-sm-4 control-label">City</label>

                                                        <div class="col-sm-12">
                                                          <input type="text" value="{{$firm->city}}" class="form-control {{$errors->has('city')?'is-invalid':''}}" name="city"  placeholder="City of operation">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="contact" required class="col-sm-4 control-label">Street_address</label>

                                                        <div class="col-sm-12">
                                                          <input type="text" value="{{$firm->street_address}}" class="form-control {{$errors->has('street_address')?'is-invalid':''}}" name="street_address"  placeholder="Street_address">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="contact" required class="col-sm-4 control-label">Website</label>

                                                        <div class="col-sm-12">
                                                          <input type="text" value="{{$firm->website}}" class="form-control {{$errors->has('website')?'is-invalid':''}}" name="website"  placeholder="Website">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="contact" required class="col-sm-4 control-label">FirmDescription</label>

                                                        <div class="col-sm-12">
                                                          <input type="text" value="{{$firm->description}}" class="form-control {{$errors->has('description')?'is-invalid':''}}" name="description"  placeholder="FirmDescription">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                            <label for="avatar" class="col-sm-4 control-label">FirmPicture</label>

                                                            <div class="col-sm-12">
                                                              <input type="file" class="form-control {{$errors->has('avatar')?'is-invalid':''}}"  name="avatar">
                                                            </div>
                                                          </div>
                                                      
                                                          <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Save</button>

                                                        </form>
                                                        </div>
                          </div>
                        </div>
                    </div>
                   
  </div>
  </div>
  </section>
@endsection

