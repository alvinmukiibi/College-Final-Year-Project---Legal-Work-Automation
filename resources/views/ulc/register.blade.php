@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">

    @endsection


    @section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Register Firm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Register</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="card-title">
                                    Register a Law Firm
                                </div>
                            </div>
                            <form action="/register" method="POST">
                                @csrf
                                <div class="card-body">
                                    @include('includes.messages')


                                    <div class="form-group">
                                        <input type="text" required value="{{old('name')}}" name="name"
                                               placeholder="Name"
                                               class="form-control {{$errors->has('name')?'is-invalid':''}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" required value="{{old('email')}}" name="email"
                                               placeholder="Email"
                                               class="form-control {{$errors->has('email')?'is-invalid':''}} {{session('error')?'is-invalid':''}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" required value="{{old('work_contact')}}" name="work_contact"
                                               placeholder="Work Phone Number"
                                               class="form-control {{$errors->has('work_contact')?'is-invalid':''}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mobile_contact" value="{{old('mobile_contact')}}"
                                               placeholder="Other Phone Number" class="form-control ">
                                    </div>

                                    <div class="form-group">
                                        <select name="country" required
                                                class="form-control select2 {{$errors->has('country')?'is-invalid':''}}"
                                                style="width: 100%;">

                                            <option value="">Country</option>
                                            @foreach ($countries as $country)
                                                <option value={{$country}}>{{$country}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="region" required
                                                class="form-control {{$errors->has('region')?'is-invalid':''}}">
                                            <option value="Central">Central</option>
                                            <option value="Northern">Northern</option>
                                            <option value="Southern">Southern</option>
                                            <option value="Western">Western</option>
                                            <option value="Eastern">Eastern</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" required value="{{old('city')}}" name="city"
                                               placeholder="City"
                                               class="form-control {{$errors->has('city')?'is-invalid':''}}">
                                    </div>

                                    <div class="form-group">
                                        <textarea name="street_address" required cols="20" rows="3"
                                                  placeholder="Street Address"
                                                  class="form-control {{$errors->has('street_address')?'is-invalid':''}}"></textarea>


                                    </div>
                                    <div class="form-group">
                                        <input type="text" value="{{old('website')}}" name="website"
                                               placeholder="Website" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <textarea name="description" cols="20" rows="5" placeholder="Description"
                                                  class="form-control"></textarea>
                                    </div>
                                    <button type="submit" value="Register" class="btn btn-primary btn-flat btn-block">
                                        Add <i class="fa fa-plus-circle"></i></button>


                                </div>


                            </form>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">All Law Firms</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-hover" >
                                    <tr>
                                        <th>Firm Name</th>
                                        <th style="width: 5px">Status</th>
                                        <th style="width: 30px">View</th>
                                    </tr>
                                    @foreach ($firms as $firm)
                                    <tr>
                                    <td>{{$firm->name}}</td>
                                            <td>
                                                @if ($firm->verification_flag=='not_verified')
                                                <span class="badge badge-warning"> <b>pending</b> </span>
                                                @elseif($firm->verification_flag=='verified' && $firm->activity_flag=='inactive')
                                                <span class="badge badge-danger"> <b>inactive</b> </span>
                                                @else
                                                <span class="badge badge-success"> <b>active</b> </span>
                                                @endif
                                            </td>
                                            <td>
                                            <div class="btn-group">
                                                            <button type="button" class="btn btn-success btn-sm"> <b>Action</b> </button>
                                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                              <span class="caret"></span>
                                                              <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                            <a class="dropdown-item" href=" {{url('/view/firm/'.$firm->uuid)}}">View</a>
                                                              @if ($firm->activity_flag=="active")
                                                                  <a href=" {{url('/firm/deactivate/'.$firm->uuid)}}" class="dropdown-item">Deactivate</a>
                                                              @else
                                                                @if($firm->activity_flag=="inactive" && $firm->verification_flag=='verified')
                                                            <a href=" {{url('/firm/activate/'.$firm->uuid)}}" class="dropdown-item">Activate</a>
                                                                @endif
                                                              @endif
                                                            </div>
                                                          </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                                {{ $firms->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
