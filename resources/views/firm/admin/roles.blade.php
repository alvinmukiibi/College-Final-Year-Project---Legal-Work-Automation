@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">

@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Role |  {{Auth::user()->firm->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Role</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        @if (session("roles"))
                            <form action="{{route('roles.update')}}" method="post">
                                @csrf
                                <div class="card-header">
                                    <h3 class="card-title">Edit User Role</h3>
                                </div>
                                <div class="card-body">
                                    @include('includes.messages')
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" required class="form-control {{$errors->has('name')?'is-invalid':''}}" name="name" value="{{session('role')->name}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Description</label>
                                        <textarea name="description" required  cols="10" rows="5" class="form-control {{$errors->has('description')?'is-invalid':''}}">{{session('role')->description}}</textarea>
                                    </div>
                                    <input type="hidden" name="firm_id" value={{Auth::user()->firm->id}}>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-success btn-flat"> <i class="fa fa-save"></i > Update</button>
                                </div>
                            </form>
                        @else
                            <form action="{{route('roles.store')}}" method="post">
                                @csrf
                                <div class="card-header">
                                    <h3 class="card-title">Add User Role</h3>
                                </div>
                                <div class="card-body">
                                    @include('includes.messages')
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" required class="form-control" name="name"  placeholder="User Role">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Description</label>
                                        <textarea name="description" required placeholder="Brief Description About the User Role.."  cols="10" rows="5" class="form-control"></textarea>
                                    </div>
                                    <input type="hidden" name="firm_id" value={{Auth::user()->firm->id}}>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-primary btn-flat pull-right"> <i class="fa fa-save"></i > Save</button>
                                </div>
                            </form>

                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Our Departments
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <tr>
                                    <th style="width: 180px">Name</th>
                                    <th >Role</th>
                                    <th  style="width: 40px">Action</th>
                                </tr>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->description}}</td>
                                        <td><a href="{{url('admin/roles',['role'=>$role->id])}}" class="btn btn-primary"> <i class="fa fa-pencil"></i>  </a></td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

