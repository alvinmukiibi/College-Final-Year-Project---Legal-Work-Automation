@extends('layouts.mainlayout')
@section('body_tag')
    <body class="hold-transition sidebar-mini">

    @endsection

@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Firm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">view</li>
                    </ol>
                </div>
            </div>
        </div>
</section>
@foreach ($firm as $lawfirm)


<section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="../../dist/img/user4-128x128.jpg"
                         alt="User profile picture">
                  </div>

                <h3 class="profile-username text-center">{{$lawfirm->name}}</h3>



                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                     <i class="fa fa-phone"></i><span class="float-right"> {{$lawfirm->contact1}}</span>
                    </li>
                    <li class="list-group-item">
                            <i class="fa fa-mobile"></i> <span class="float-right">{{$lawfirm->contact2}}</span>
                    </li>
                    <li class="list-group-item">
                            <i class="fa fa-envelope"></i> <span class="float-right">{{$lawfirm->email}}</span>
                    </li>
                    <li class="list-group-item">
                           <i class="fa fa-map-marker"></i><span class="float-right">{{$lawfirm->city}}, {{$lawfirm->country}}</span>
                    </li>
                    <li class="list-group-item">
                            <i class="fa fa-globe"></i><span class="float-right">{{$lawfirm->website}}</span>
                     </li>
                  </ul>

                  <a href="#" class="btn btn-primary btn-block"><b>Message</b></a>
                </div>
                <!-- /.card-body -->
              </div>
              </div>

            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Firm Info</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Correspondence</a></li>
                   </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                            @if ($lawfirm->verification_flag=='not_verified')
                            <button class="btn btn-warning btn-flat btn-block"  title="NOT VERIFIED EMAIL"  ><b>ACCOUNT NOT VERIFIED</b>  <i class="fa fa-circle-o-notch fa-spin"></i> </button>
                            @elseif($lawfirm->verification_flag=='verified' && $lawfirm->activity_flag=='inactive')
                            <button class="btn btn-danger btn-flat btn-block" title="ACCOUT INACTIVE"  ><b>INACTIVE</b> <i class="fa fa-close"></i> </button>
                            @else
                            <button class="btn btn-success btn-flat btn-block" title="ACCOUNT ACTIVE" ><b>ACTIVE</b> <i class="fa fa-check-circle"></i> </button>
                            @endif
                            <br/>
                            <div class="callout callout-success">
                                    <h5>Law Firm Address</h5>

                                    <p>{{$lawfirm->street_address}}</p>
                                  </div>
                                  <div class="callout callout-warning">
                                        <h5>Law Firm Description</h5>

                                        <p>{{$lawfirm->description}}</p>
                                      </div>
                                      <div class="callout callout-info">
                                            <h5>Date Registered</h5>

                                      <p>{{
                                          date("d/m/y", strtotime($lawfirm->created_at))

                                      }}</p>
                                          </div>


                                          <hr/>
                                          @if ($lawfirm->activity_flag=="active")

                                                                  <a href="{{url('/firm/deactivate/'.$lawfirm->uuid)}}" class="btn btn-danger btn-block">Deactivate</a>
                                                              @else
                                                                @if($lawfirm->activity_flag=="inactive" && $lawfirm->verification_flag=='verified')
                                                                    <a href="{{url('/firm/activate/'.$lawfirm->uuid)}}" class="btn btn-success btn-block">Activate</a>
                                                                @endif
                                                              @endif

                           </div>


                    <div class="tab-pane" id="timeline">
                      Message between Regulatory Authority and Law Firm System Administrator appear here
                   </div>


                  </div>

                </div>
              </div>

            </div>

          </div>

        </div>
      </section>

      @endforeach
@endsection
