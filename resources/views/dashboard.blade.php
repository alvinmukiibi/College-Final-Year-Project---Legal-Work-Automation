@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
         <div class="container-fluid">
           <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>Profile</h3>

                    <p>My Profile</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user"></i>
                  </div>
                  @if (auth()->user()->user_role=="administrator")
                <a href="{{ url('admin/profile')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>


                @elseif(auth()->user()->user_role=="Associate")
                <a href="{{ url('associate/profile')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                @else
                <a href="{{ url('profile')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                @endif
            </div>
              </div>
              @if (auth()->user()->user_role === "ulc")
              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>Law Firms</h3>

                    <p>Manage Law Firms</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-legal"></i>
                  </div>
                <a href="{{ url('/register/firm')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              @endif
              @if (auth()->user()->user_role === "administrator")
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>Site Profile</h3>

                    <p>Manage Website Profile</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-globe fa-spin"></i>
                  </div>
                <a href="{{ url('/register/firm')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>Departments</h3>

                    <p>Manage Firm Departments</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-legal"></i>
                  </div>
                <a href="{{ url('/admin/departments')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background-color:#452b17">
                  <div class="inner">
                    <h3>Staff</h3>

                    <p>Manage Firm Staff</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                <a href="{{ url('/admin/manage/staff')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              @endif
              @if (auth()->user()->firm_id !== null)
              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>Messages</h3>

                    <p>My Messages</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-envelope"></i>
                  </div>
                <a href="{{ url('/register/firm')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>Tasks</h3>

                    <p>My Tasks</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-tasks"></i>
                  </div>
                <a href="{{ url('/register/firm')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success" >
                  <div class="inner">
                    <h3>Requisitions</h3>

                    <p>My Requisitions</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-money"></i>
                  </div>
                <a href="{{ url('/register/firm')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              @endif







           </div>
         </div>

      </section>


@endsection
