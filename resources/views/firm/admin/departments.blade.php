@extends('layouts.mainlayout')
@section('body_tag')

<body class="hold-transition sidebar-mini">
@endsection

@section('content')
<section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Departments</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Departments</li>
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


                            @if (session("department"))
                            <form action="{{url('admin/editDepartment')}}" method="post">
                                @csrf
                                <div class="card-header">
                                    <h3 class="card-title">Edit Department</h3>
                                </div>
                                <div class="card-body">
                                    @include('includes.messages')
                                        <div class="form-group">
                                                <label for="name">Name</label>
                                        <input type="text" required class="form-control {{$errors->has('name')?'is-invalid':''}}" name="name" value="{{session('department')->name}}" >
                                    </div>
                                    <div class="form-group">
                                            <label for="name">Description</label>
                                    <textarea name="description" required  cols="10" rows="5" class="form-control {{$errors->has('description')?'is-invalid':''}}">{{session('department')->description}}</textarea>
                                        </div>
                                        <input type="hidden" name="id" value={{session('department')->id}}>
                                </div>
                                <div class="card-footer">
                                        <button type="submit" class="btn btn-outline-success btn-flat"> <i class="fa fa-save"></i > Update</button>
                                      </div>
                                    </form>
                            @else
                            <form action="{{url('admin/addDepartment')}}" method="post">
                                @csrf
                                <div class="card-header">
                                    <h3 class="card-title">Add Department</h3>
                                </div>
                                <div class="card-body">
                                    @include('includes.messages')
                                        <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" required class="form-control" name="name"  placeholder="Department Name">
                                    </div>
                                    <div class="form-group">
                                            <label for="name">Description</label>
                                            <textarea name="description" required placeholder="Brief Description About the Department.."  cols="10" rows="5" class="form-control"></textarea>
                                        </div>
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
                        <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                        <tr>

                                                <th>Name</th>
                                                <th >Role</th>
                                                <th></th>
                                            </tr>
                                </thead>

                                <tbody>
                                        @foreach ($departments as $department)
                                        <tr>

                                                <td>{{$department->name}}</td>
                                                <td>
                                                        {{$department->description}}
                                                </td>
                                                <td>
                                                <a href="{{url('admin/departments',['department'=>$department->id])}}" title="Edit" class="btn btn-outline-primary btn-sm"> <i class="fa fa-pencil"></i>  </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>

                            </table><br/>
                            {{ $departments->links() }}
                        </div>

                    </div>

                  </div>


              </div>
          </div>

      </section>

@endsection
