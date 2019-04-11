@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">
@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Case Viewer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Case</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
            <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <div class="callout callout-info">

                                    <h5><i class="fa fa-info"></i> CASE STATUS:
                                        @if ($case->case_status == 'intake')
                                        <span class="badge badge-warning text-white">{{ __('INTAKE') }}</span>
                                        @endif
                                        @if ($case->case_status == 'open')
                                            <span class="badge badge-success text-white">{{ __('OPEN') }}</span>
                                        @endif
                                        @if ($case->case_status == 'closed-rejected')
                                            <span class="badge badge-danger text-white">{{ __('CLOSED/REJECTED') }}</span>
                                        @endif

                                    </h5>
                                    @if ($case->case_status == 'intake')
                                        {{ __('This case is still an intake. Use the Buttons on the right to either accept or reject it') }}
                                        <a href="{{ url('/associate/make/case', ['case' => $case->case_number]) }}" class="btn btn-success btn-sm pull-right"> <b>MAKE CASE</b> </a>
                                        <a href="{{ url('/associate/reject/case', ['case' => $case->case_number]) }}" class="btn btn-danger btn-sm pull-right"> <b>REJECT CASE</b> </a>
                                    @endif

                                </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-4 connectedSortable">
                            <div class="card card-primary collapsed-card">
                                <div class="card-header">
                                    <h3 class="card-title">Basic Case Info</h3>
                                    <div class="card-tools">

                                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                              <i class="fa fa-minus"></i>
                                            </button>

                                            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                            </button>
                                          </div>
                                </div>
                                <div class="card-body">
                                    <strong>Case Number</strong>
                                    <p class="text-muted pull-right">
                                          {{ $case->case_number }}
                                    </p>
                                    <hr>
                                    <strong>Case Type</strong>
                                    <p class="text-muted pull-right">
                                          {{ $case->case_type }}
                                    </p>
                                    <hr>
                                    <strong>Date Taken</strong>
                                    <p class="text-muted pull-right">
                                          {{ $case->date_taken }}
                                    </p>
                                    <hr>
                                    <strong>Taken By</strong>
                                    <p class="text-muted pull-right">
                                          {{ $case->taken_by }}
                                    </p>
                                    <hr>
                                    <strong>Synopsis</strong>
                                    <p class="text-muted pull-right">
                                          {{ $case->synopsis }}
                                    </p>



                                </div>
                            </div>
                            <div class="card card-success collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title">Client Info</h3>
                                        <div class="card-tools">

                                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                                  <i class="fa fa-minus"></i>
                                                </button>

                                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                                </button>
                                              </div>
                                    </div>
                                    <div class="card-body">
                                            <strong>Party Name</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->name }}
                                            </p>
                                            <hr>
                                            <strong>Email Address</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->email }}
                                            </p>
                                            <hr/>
                                            <strong>Mobile Contact</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->mobile_contact }}
                                            </p>
                                            <hr/>
                                            <strong>Work Contact</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->work_contact }}
                                            </p>
                                            <hr/>

                                            <strong>Country</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->country }}
                                            </p>
                                            <hr/>
                                            <strong>City Of Residence</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->city_of_residence }}
                                            </p>
                                            <hr/>
                                            <strong>District</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->district_of_residence }}
                                            </p>
                                            <hr/>
                                            <strong>Detailed Address</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->address }}
                                            </p>
                                            <hr/>
                                            <strong>Nationality</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->nationality }}
                                            </p>
                                            <hr/>
                                            <strong>National ID Number</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->nin }}
                                            </p>
                                            <hr/>
                                            <strong>Marital Status</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->marital_status }}
                                            </p>
                                            <hr/>
                                            <strong>Date of Birth</strong>
                                            <p class="text-muted pull-right">
                                                  {{ date('d-M-Y', strtotime($client->date_of_birth)) }}
                                            </p>
                                            <hr/>
                                            <strong>Home Contact</strong>
                                            <p class="text-muted pull-right">
                                                  {{ $client->home_contact }}
                                            </p>
                                            <hr/>
                                    </div>
                                </div>

                        </div>
                        <div class="col-8 connectedSortable">
                                <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Due Diligence</h3>
                                            <div class="card-tools">

                                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                                      <i class="fa fa-minus"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                                    </button>
                                                  </div>
                                        </div>
                                        <div class="card-body">
                                            <h3>Previous Due Diligences</h3>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Date Carried Out </td>
                                                        <td>Description</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dds as $dd)
                                                    <tr>
                                                        <td> {{  date('d-M-Y', strtotime($dd->date_carried_out)) }} </td>
                                                        <td>
                                                                <button type="button" class="btn btn-sm btn-info" data-toggle="popover" title="Due Diligence Description" data-content="{{ $dd->description }}"> <b>{{ __('DESCRIPTION') }}</b> </button>


                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>


                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ url('/associate/make/due_diligence', ['case'=> $case->case_number  ]) }}" class="btn btn-primary btn-flat pull-right"> <i class="fa fa-plus"></i> Add Due Diligence</a>
                                        </div>
                                    </div>
                        </div>

                    </div>
            </div>



    </section>




@endsection
