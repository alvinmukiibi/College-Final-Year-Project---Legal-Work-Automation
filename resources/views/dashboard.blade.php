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
                <li class="breadcrumb-item active">Dashboard v2</li>
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
                  <a href="/profile" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>Law Firms</h3>
    
                    <p>Manage Law Firms</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-legal"></i>
                  </div>
                  <a href="/register/firm" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>


           </div>
         </div>

      </section>

    
@endsection