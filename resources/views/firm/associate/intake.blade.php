@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">New Intake</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Intake</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                    @include('includes.messages')
                    <div class="card card-primary">
                        <form action="{{ url('associate/register/intake') }}" method="post">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">
                                    New intake
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="form-row">
                                        <div class="form-group col-md-3">
                                                <label for="caseType">Case Type</label>
                                                <select required name="caseType" class="form-control">
                                                    @foreach ($caseTypes as $type)


                                                    <option title="{{ $type->description }}" value={{ $type->id }}>{{ $type->type }} : {{ $type->description }}</option>

                                                    @endforeach
                                                </select>

                                            </div>
                                    <div class="form-group col-md-3">
                                        <label for="date">Date</label>
                                        <input type="text" readonly class="form-control" value={{ date('d-M-Y', time()) }}>
                                    </div>
                                    <div class="form-group col-md-3">
                                            <label for="inputCity">Staff</label>
                                            <input type="text" class="form-control" readonly value="<?=  auth()->user()->fname . ' ' . auth()->user()->lname ?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                                <label for="inputCity">Staff Type</label>
                                                <input type="text" class="form-control" readonly value={{ auth()->user()->user_role }}>
                                            </div>

                                </div>
                                <h4>Client Information</h4>
                                <div class="form-row">
                                            <div class="form-group col-md-4">
                                                    <label for="clientName">Client Name</label>
                                                    <input name="clientName" value="{{ old('clientName') }}" required type="text" class="form-control {{ $errors->has('clientName')?'is-invalid':'' }}" >
                                                </div>

                                            <div class="form-group col-md-4">
                                                <label for="nationality">Nationality</label>
                                                <input required type="text" name="nationality" value="{{ old('nationality') }}" class="form-control {{ $errors->has('nationality')?'is-invalid':'' }}" >
                                            </div>
                                            <div class="form-group col-md-4">
                                                    <label for="dob">Date of Birth</label>
                                                    <input type="date" value="{{ old('dob') }}" name="dob"class="form-control {{ $errors->has('dob')?'is-invalid':'' }}" >
                                                </div>

                                        </div>
                                        <div class="form-row">
                                                <div class="form-group col-md-4">
                                                        <label for="nin">National ID Number</label>
                                                        <input  type="number" value="{{ old('nin') }}" name="nin" class="form-control {{ $errors->has('nin')?'is-invalid':'' }}" >
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                            <label for="email">Email Address</label>
                                                            <input required value="{{ old('email') }}" type="email" name="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" >
                                                        </div>
                                                    <div class="form-group col-md-4">
                                                            <label for="maritalStatus">Marital Status</label>
                                                           <select required name="maritalStatus" value="{{ old('maritalStatus') }}" class="form-control {{ $errors->has('maritalStatus')?'is-invalid':'' }}">
                                                               <option value="Single">Single</option>
                                                               <option value="Married">Married</option>
                                                               <option value="Divorced">Divorced</option>
                                                               <option value="Widowed">Widowed</option>
                                                               <option value="Civil Union">Civil Union</option>
                                                               <option value="Domestic Relationship">Domestic Relationship</option>
                                                           </select>
                                                        </div>
                                            </div>
                                        <h4>Addresses</h4>
                                        <table class="table table-simple table-bordered">
                                            <thead>
                                                <tr>

                                                    <td>City</td>
                                                    <td>District</td>
                                                    <td>Country</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input name="city" value="{{ old('city') }}" required class="form-control {{ $errors->has('city')?'is-invalid':''}}" type="text"></td>
                                                    <td><input name="district" value="{{ old('district') }}" required class="form-control {{ $errors->has('district')?'is-invalid':''}}" type="text"></td>
                                                    <td>
                                                        <select required name="country" value="{{ old('country') }}"  class="form-control select2 {{ $errors->has('country')?'is-invalid':''}}">

                                                                @foreach ($countries as $country)
                                                                    <option value={{$country}}>{{$country}}</option>
                                                                    @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br/>
                                        <div class="form-group row">
                                                <label for="address" class="col-sm-4 col-form-label ">Address</label>
                                                <div class="col-sm-8">
                                                    <textarea rows="5" cols="5" required placeholder="Enter Your Address..." name="address" required class="form-control {{$errors->has('address')?'is-invalid':''}}"></textarea>
                                                </div>

                                        </div>
                                        <h4>Contacts</h4>
                                        <table class="table table-bordered">
                                                <thead>
                                                    <tr>

                                                        <td>Work Number</td>
                                                        <td>Mobile Number</td>
                                                        <td>Home Number


                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input name="work_no"  value="{{ old('work_no') }}" class="form-control {{ $errors->has('work_no')?'is-invalid':''}}" type="number"></td>
                                                        <td><input name="mobile_no" value="{{ old('mobile_no') }}" required class="form-control {{ $errors->has('mobile_no')?'is-invalid':''}}" type="number"></td>
                                                        <td><input name="home_no" value="{{ old('home_no') }}"  required class="form-control {{ $errors->has('home_no')?'is-invalid':''}}" type="number"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br/>
                                            <h4>Case Details</h4>
                                            <div class="form-group row">
                                                    <label for="address" class="col-sm-4 col-form-label ">Synopsis</label>
                                                    <div class="col-sm-8">
                                                        <textarea rows="5" required cols="5" name="synopsis" placeholder = "Brief Description of case..."required class="form-control {{ $errors->has('synopsis')?'is-invalid':''}}"></textarea>
                                                    </div>

                                            </div>






                            </div>
                            <div class="card-footer">

                                    <button type="submit" class="btn btn-outline-primary pull-right"> <i class="fa fa-plus"></i> Make Intake </button>

                            </div>
                        </form>
                        </div>
            </div>

        </div>

    </div>
</section>
@endsection
