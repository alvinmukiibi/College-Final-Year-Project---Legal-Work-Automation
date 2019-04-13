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
                    @include('includes.messages')
                    <div class="row">

                        <div class="col-12">
                                <div class="card card-primary card-outline">
                                        <div class="card-header">
                                        <h3 class="card-title">
                                            @if ($staff_on_the_case['owner'] != null)
                                                <b>Intake Made By:</b> {{ $staff_on_the_case['owner'] }}
                                            @endif
                                            @if ($staff_on_the_case['assignee'] != null)
                                            <b>Assigned To:</b> {{ $staff_on_the_case['assignee'] }}
                                            @endif
                                            @if ($staff_on_the_case['referee1'] != null)
                                            <b>Referred To:</b> {{ $staff_on_the_case['referee1'] }}
                                            @endif
                                            @if ($staff_on_the_case['referee2'] != null)
                                                 {{ ', '. $staff_on_the_case['referee2'] }}
                                            @endif




                                        </h3>

                                        </div>

                                </div>
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
                                <div class="card card-danger collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Documents
                                            </h3>
                                            <div class="card-tools">

                                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                                      <i class="fa fa-minus"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                                    </button>
                                                  </div>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Date of Upload</th>
                                                        <th>Name</th>
                                                        <th>Uploaded By</th>
                                                        <th>Download</th>
                                                    </tr>
                                                    <tbody>
                                                        @foreach ($docs as $doc)
                                                        <tr>
                                                            <td>{{ date('d-M-Y', strtotime($doc->date_of_upload)) }}</td>
                                                            <td>{{ $doc->name }}</td>
                                                            <td>{{ $doc->fname }} {{ $doc->lname }}</td>
                                                            <td> <a href="{{ url('/associate/download/file', ['file' => $doc->location])  }}"> <i class="fa fa-download"></i> </a> </td>
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                </thead>
                                            </table>

                                        </div>
                                        <div class="card-footer">
                                            <form action="{{ url('/associate/add/document') }}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <div class="form-group row">
                                                        <label for="docName" class="col-sm-4 col-form-label">Name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" placeholder="E.g. Client Agreement document.." name="name" required class="form-control {{$errors->has('name')?'is-invalid':''}}">
                                                        </div>
                                                    </div>
                                                <div class="form-group">
                                                        <div class="input-group">
                                                          <div class="custom-file">
                                                            <input required type="file" name="file" class="custom-file-input {{$errors->has('file')?'is-invalid':''}}">
                                                            <label class="custom-file-label" >Choose file</label>

                                                          </div>

                                                          <div class="input-group-append">
                                                              <input type="hidden" name="caseID"  value="{{ $case->case_number }}">
                                                            <button type="submit" class="btn btn-outline-success" >Upload</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </form>
                                        </div>

                                    </div>

                                <div class="card card-info collapsed-card">
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

                                            <table class="table table-hover">
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

                            <div class="card card-secondary collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Tasks
                                        </h3>
                                        <div class="card-tools">

                                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                                  <i class="fa fa-minus"></i>
                                                </button>

                                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                                </button>
                                              </div>
                                    </div>
                                    <div class="card-body p-0">
                                            <table class="table table-hover">
                                                    <tr>

                                                      <th>Task</th>

                                                      <th style="width: 40px">Label</th>
                                                      <th style="width: 40px">Action</th>
                                                    </tr>
                                                    @foreach ($tasks as $task)
                                                    <tr>
                                                            <td>{{ $task->task }}</td>
                                                            <td>
                                                                @if ($task->status == 'done')
                                                                <span class="badge bg-success">    {{ __('DONE') }} </span>
                                                                @else
                                                                <span class="badge bg-warning">    {{ __('PENDING') }} </span>
                                                                @endif
                                                              </td>
                                                              <td>
                                                                    @if ($task->status == 'pending')

                                                                    <a title="COMPLETE" class="btn btn-sm btn-primary" href="{{ url('/associate/complete/task', ['task' => $task->id]) }}"> <i class="fa fa-check"></i> </a>

                                                                    @endif

                                                              </td>
                                                        </tr>
                                                    @endforeach

                                                </table>


                                    </div>
                                    <div class="card-footer">
                                            <form action="{{ URL('/associate/add/casetask') }}" method="post">
                                                    <div class="input-group">
                                                        @csrf
                                                        <input type="hidden" name="caseID" value="{{ $case->id }}">
                                                      <input required type="text" name="task" placeholder="E.g. Make Research ..." class="form-control">
                                                      <span class="input-group-append">
                                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Task</button>
                                                      </span>
                                                    </div>
                                                  </form>
                                    </div>

                                </div>
                                <div class="card card-warning collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title text-white">Court Proceedings</h3>
                                            <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                                      <i class="fa fa-minus"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                                    </button>
                                                  </div>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <th>Date of Proceeding</th>
                                                    <th>Courts of Law</th>
                                                    <th>Outcome</th>
                                                    <th>Date of Next Proceeding</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($proceedings as $proceeding)
                                                    <tr>
                                                        <td>{{ date('d-M-Y H:i', strtotime($proceeding->date_of_proceeding)) }}</td>
                                                        <td>{{ $proceeding->court_of_proceeding }}</td>
                                                        <td>{{ $proceeding->outcome_of_proceeding }}</td>
                                                        <td>{{ date('d-M-Y H:i', strtotime($proceeding->date_of_next_proceeding)) }}</td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="card-footer">
                                            <a class="btn btn-outline-success pull-right" href="{{ url('/associate/view/proceedings', ['case' => $case->case_number]) }}"> <i class="fa fa-plus"></i> Add Proceeding  </a>
                                        </div>

                                    </div>

                                    <div class="card card-primary collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Case Meetings</h3>
                                                <div class="card-tools">

                                                      <button type="button" class="btn btn-tool" data-widget="collapse">
                                                        <i class="fa fa-minus"></i>
                                                      </button>

                                                      <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                                      </button>
                                                    </div>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ url('/associate/schedule/casemeeting') }}" method="post">
                                            <div class="form-row">
                                                  <div class="form-group col-md-6">
                                                          <label for="date">Date</label>
                                                          <input required type="date" name="date" class="form-control {{ $errors->has('date')?'is-invalid':'' }}">
                                                  </div>
                                                  <div class="form-group col-md-6">
                                                          <label for="time">Time</label>
                                                          <input required type="time" name="time" class="form-control {{ $errors->has('time')?'is-invalid':'' }}">
                                                  </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                  <label for="agenda">Agenda</label>
                                                  <textarea required name="agenda" class="form-control {{ $errors->has('agenda')?'is-invalid':'' }}"  rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                  <div class="form-group col-md-12">
                                                    <label for="venue">Venue</label>
                                                    <input required type="text" name="venue" class="form-control {{ $errors->has('venue')?'is-invalid':'' }}">
                                                  </div>
                                              </div>
                                              <input type="hidden" name="caseID" value="{{ $case->case_number }}">
                                              <button type="submit" class="btn btn-block btn-flat btn-outline-primary"> <b>Schedule Meeting</b> <i class="fa fa-clock-o"></i> </button>
                                              @csrf
                                          </form>
                                          <div class="row">

                                              <table class="table table-hover">
                                                  <thead>
                                                      <tr>
                                                          <th>Date of Meeting</th>
                                                          <th>Agenda</th>
                                                          <th>Venue</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      @foreach($meetings as $meeting)
                                                      <tr>
                                                          <td> {{ date('d-M-Y', strtotime($meeting->date)) }} {{ $meeting->time }} </td>
                                                          <td>
                                                                  <button type="button" class="btn btn-sm btn-info" data-toggle="popover" title="Case Type" data-content="{{ $meeting->agenda }}"> <b> Agenda <i class="fa fa-eye"></i></b> </button>

                                                          </td>
                                                          <td>{{ $meeting->venue }}</td>
                                                      </tr>
                                                      @endforeach
                                                  </tbody>

                                              </table>

                                          </div>
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

                                </div>

                    </div>
            </div>



    </section>




@endsection
