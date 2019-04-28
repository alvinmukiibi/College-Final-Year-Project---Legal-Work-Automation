@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Staff Manager</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Staff</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#addStaff">
                           Add <i class="fa fa-plus"></i>
                          </button>
            </div>
            <div class="col-md-10">
                @include('includes.messages')
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Staff</h3>
                    </div>
                <div class="card-body">

                    <table class="table table-bordered" id="example1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Role</th>
                                <th>Dept</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staff as $user)
                            <tr>
                            <td>{{$user->fname}} {{$user->lname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->contact}}</td>
                                    <td>{{$user->user_role}}</td>
                                    <td>{{$user->name}}</td>

                                    <td>
                                        @if ($user->account_status=='inactive')
                                        <span class="badge badge-danger">inactive</button>
                                        @else

                                        <span class="badge badge-success" title="Active">active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->account_status=='inactive')
                                        <a href={{url('/admin/activate/staff', ['id'=>$user->id])}}  class="btn btn-outline-success btn-sm">Actvt</a>
                                        @else

                                        <a href={{url('/admin/deactivate/staff', ['id'=>$user->id])}} class="btn btn-outline-danger btn-sm">Deact</a>
                                        @endif
                                        @if ($user->online_status=='online')

                                        <a href={{url('/admin/logout/staff', ['id'=>$user->id])}}  class="btn btn-outline-danger btn-sm"> <i class="fa fa-sign-in"></i> </a>

                                          @endif


                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                        <form action="{{url('/admin/add/staff')}}" method="post">

                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalScrollableTitle">Staff Management</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Add Staff
                                        </h3>
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label for="firstName" class="col-sm-4 col-form-label">First Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="firstName" required class="form-control {{$errors->has('firstName')?'is-invalid':''}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label for="lastName" class="col-sm-4 col-form-label ">Last Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="lastName" required class="form-control {{$errors->has('lastName')?'is-invalid':''}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label ">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" required class="form-control {{$errors->has('email')?'is-invalid':''}}">
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-4 col-form-label ">Phone Number    </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="phone" required class="form-control {{$errors->has('phone')?'is-invalid':''}}">
                                                </div>
                                        </div>
                                        <div class="form-check">
                                           <input type="radio" checked value="Male" name="gender" class="form-check-input">
                                           <label for="male" class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" value="Female" name="gender" class="form-check-input">
                                            <label for="female" class="form-check-label">Female</label>
                                         </div>
                                         <div class="form-group row">
                                            <label for="role" class="col-sm-4 col-form-label ">User Role </label>
                                                <div class="col-sm-8">
                                                    <select name="role" class="form-control">
                                                        @foreach ($roles as $role)
                                                        <option value="{{$role->name}}">{{$role->name}}</option>

                                                        @endforeach

                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="department" class="col-sm-4 col-form-label ">Department</label>
                                                    <div class="col-sm-8">
                                                        <select name="department" class="form-control">
                                                        @foreach ($departments as $department)
                                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                                        @endforeach


                                                        </select>
                                                    </div>
                                            </div>



                                    </div>


                                </div>

                    </div>
                    <div class="modal-footer">

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> Submit </button>
                      @csrf
                    </div>
                        </form>
                  </div>
                </div>
              </div>

            </div>






























        </section>

@endsection
