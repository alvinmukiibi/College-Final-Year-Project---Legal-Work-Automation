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
                            <div class="col-md-6 col-sm-6 col-12">
                                    <div class="info-box">
                                      <span class="info-box-icon bg-primary"><i class="fa fa-money"></i></span>

                                      <div class="info-box-content">
                                        <span class="info-box-text">Total Amount Paid (Shs)</span>
                                        <span class="info-box-number">{{ $totalpayment }}</span>
                                      </div>

                                    </div>

                                  </div>


                                  <div class="col-md-6 col-sm-6 col-12">
                                        <div class="info-box">
                                          <span class="info-box-icon bg-success"><i class="fa fa-clock-o"></i></span>

                                          <div class="info-box-content">
                                            <span class="info-box-text">Remaining Billable Time(hrs)</span>
                                            <span class="info-box-number">{{ $remaininghrs }}</span>
                                          </div>

                                        </div>

                                      </div>
                    </div>
                    <div class="row">

                        <div class="col-4 connectedSortable">
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

                                            <table class="table table-hover" id="example2">
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
                                <div class="card card-success collapsed-card">

                                        <div class="card-header">
                                            <h3 class="card-title">Payments</h3>
                                            <div class="card-tools">

                                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                                      <i class="fa fa-minus"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                                    </button>
                                                  </div>
                                        </div>
                                        <form action="{{ url('/associate/record/payment') }}" method="post">
                                            @csrf
                                        <div class="card-body">
                                            <div class="callout callout-info">
                                                <h5> <i class="fa fa-info"></i>Note </h5>
                                                <p> {{ __('Receipts shall be automatically generated and sent to the clients for any kind of payment that they make.') }}</p>
                                            </div>

                                            <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                            <label for="amount">Amount Paid (SHS)</label>
                                                            <input name="amount" value="{{ old('amount') }}" required type="number" class="form-control {{ $errors->has('amount')?'is-invalid':'' }}" >
                                                        </div>
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                            <label for="paidby">Paid By <small class="text-danger">Person that has delivered the payment</small> </label>
                                                            <input name="paidby" value="{{ old('paidby') }}" required type="text" class="form-control {{ $errors->has('paidby')?'is-invalid':'' }}" >
                                                        </div>
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                            <label for="paidfor">Paid For / Invoice {{ __('#') }} <small class="text-success">Enter Invoice {{ __('#') }} if paying for an invoice</small> </label>
                                                            <input name="paidfor" value="{{ old('paidfor') }}" required type="text" class="form-control {{ $errors->has('paidfor')?'is-invalid':'' }}" >
                                                        </div>
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                            <label for="date">Date of Payment </label>
                                                            <input name="date" value="{{ old('date') }}" type="date" class="form-control {{ $errors->has('date')?'is-invalid':'' }}" >
                                                        </div>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <input type="hidden" name="caseID" value={{ $case->id  }} >
                                            <button type="submit" class="btn btn-outline-success pull-right"> <b>SUBMIT</b> </button>

                                            <a href="{{ url('/associate/view/payments', ['case' => $case->case_number]) }}" class="btn btn-primary btn-flat"><b>Past Payments</b> </a>
                                        </div>
                                    </form>
                                    </div>



                            </div>
                        <div class="col-8 connectedSortable">
                            <div class="card card-info collapsed-card">
                                <div class="card-header">
                                    <h3 class="card-title">Invoices</h3>
                                    <div class="card-tools">

                                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                              <i class="fa fa-minus"></i>
                                            </button>

                                            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                            </button>
                                          </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/associate/make/invoice') }}" method="post">
                                        @csrf
                                        <div class="callout callout-success">
                                        <h5> <i class="fa fa-info"></i> Note</h5>
                                        <p>{{ __('You can either draft an invoice according to billable time, or any other reason. If an invoice is to be generated according to billable time, please note that you cannot enter time that is greater than the remaining billable time') }}</p>
                                    </div>
                                    <div class="col-12">
                                            <div class="info-box">
                                              <span class="info-box-icon bg-info"><i class="fa fa-clock-o"></i></span>

                                              <div class="info-box-content">
                                                <span class="info-box-text">Remaining Billable Time (Hrs) </span>
                                                <span class="info-box-number">{{ $remaininghrs }}</span>
                                              </div>
                                              <input type="hidden" id="remainingbillablehrs" value="{{ $remaininghrs }}">
                                            </div>

                                          </div>
                                    <div class="form-group row">
                                            <label for="choice" class="col-sm-4 col-form-label ">Choice</label>
                                            <div class="col-sm-8">
                                                <select required name="choice" id="invoicetype" class="form-control">
                                                    <option value="1">Other reason</option>
                                                    <option value="2">Billable Time</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" style="display:none" id="time">
                                                <label for="time" class="col-form-label col-sm-4">Time To Bill (HRS)</label>
                                                <div class="col-sm-8">
                                                    <input type="text" placeholder="E.g. 4" step="any" name="time" id="billabletime" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="display:none" id="rate">
                                                    <label for="rate" class="col-form-label col-sm-4">Rate (SHS/HR)</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" value="30000" readonly name="rate" id="billingRate" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="display:none" id="total">
                                                        <label for="total" class="col-form-label col-sm-4">Total Amount (SHS)</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" readonly   name="total" id="totalAmount" class="form-control">
                                                        </div>
                                                    </div>


                                        <div class="form-group row" id="amount">
                                            <label for="amount" class="col-form-label col-sm-4">Amount (SHS)</label>
                                            <div class="col-sm-8">
                                                <input type="number" step="any" name="amount" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row" id="reason">
                                                <label for="reason" class="col-form-label col-sm-4">Reason</label>
                                                <div class="col-sm-8">
                                                    <textarea name="reason"  cols="5" rows="5" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="caseID" value="{{ $case->id }}">
                                            <a href="{{ url('/associate/view/invoices', ['case' => $case->case_number]) }}" class="btn btn-outline-success btn-flat">Past Invoices</a>
                                            <button type="submit" id="submitinvoice" class="btn btn-primary pull-right"> <b>DRAFT INVOICE</b></button>
                                        </form>
                                </div>
                            </div>

                            <div class="card card-default collapsed-card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Billable Time
                                    </h3>
                                    <div class="card-tools">

                                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                              <i class="fa fa-minus"></i>
                                            </button>

                                            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                            </button>
                                          </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/associate/add/time') }}" method="post">
                                        @csrf
                                <div class="col-md-12">
                                    <div class="callout callout-danger">
                                        <h5> <i class="fa fa-info"></i> Billable Time Entries</h5>
                                        <p>{{ __('You can either choose to use a time range, or directly enter the time ') }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label for="choice" class="col-sm-4 col-form-label ">Choice</label>
                                        <div class="col-sm-8">
                                            <select required name="choice" id="choice" class="form-control">
                                                <option value="1">Direct Time Entry</option>
                                                <option value="2">Date/Time Range</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row" id="range" style="display:none">
                                        <div class="form-group col-md-6">
                                            <label for="start">From</label>
                                            <div class="input-group date form_datetime col-md-12"  data-date-format="dd MM yyyy - HH:ii" data-link-field="from">
                                                    <input class="form-control" size="16" type="text"  value="" readonly>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                                <input type="hidden"  name="from" id="from" /><br/>

                                        </div>
                                        <div class="form-group col-md-6">
                                                <label for="To">To</label>
                                                <div class="input-group date form_datetime col-md-12"  data-date-format="dd MM yyyy - HH:ii" data-link-field="to">
                                                        <input class="form-control" size="16" type="text"  value="" readonly>
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                    </div>
                                                    <input type="hidden"  name="to" id="to" /><br/>

                                            </div>
                                    </div>
                                    <div class="form-group row" id="direct">
                                        <label for="time" class="col-sm-4 form-label">Billable Time (hrs)</label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" name="time" id="" class="form-control {{ $errors->has('time')?'is-invalid':'' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="event" class="col-sm-4 form-label">Event <small class="text-success">What happened during the time?</small></label>
                                            <div class="col-sm-8">
                                                <input type="text" required name="event" id="" class="form-control {{ $errors->has('event')?'is-invalid':'' }}">
                                            </div>
                                        </div>
                                        <a href="{{ url('/associate/view/times', ['case' => $case->case_number]) }}" class="btn btn-outline-secondary"> <b>Past Entries</b> </a>
                                        <input type="hidden" name="caseID" value={{ $case->id }}>
                                        <button type="submit" class="btn btn-outline-primary pull-right btn-flat"> <i class="fa fa-clock-o"></i> <b>Add Time Entry</b> </button>
                                </div>
                            </form>
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

                                          <table class="table table-hover" id="example2">
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
                                                <table class="table table-hover" id="example2">
                                                        <thead>
                                                                <tr>

                                                                        <th>Task</th>

                                                                        <th style="width: 40px">Label</th>
                                                                        <th style="width: 40px">Action</th>
                                                                      </tr>
                                                        </thead>
                                                        <tbody>
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
                                                        </tbody>

                                                    </table>


                                        </div>
                                        <div class="card-footer">
                                                <form action="{{ url('/associate/add/casetask') }}" method="post">
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
                                            <table class="table table-hover" id="example1">
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



                        </div>

                    </div>
            </div>



    </section>

<script>
    const choiceElement = document.querySelector('#choice');
    choiceElement.addEventListener('change', () => {
        const choice = jQuery('#choice').val();
        if(choice == 1){
            jQuery('#range').hide();
            jQuery('#direct').show();
        }else{
            jQuery('#direct').hide();
            jQuery('#range').show();
        }
    });

    const invoicetypeElement = document.querySelector('#invoicetype');
    invoicetypeElement.addEventListener('change', () => {

        const choice = jQuery('#invoicetype').val();
        if(choice == 1){
            jQuery('#time').hide()
            jQuery('#rate').hide()
            jQuery('#total').hide()
            jQuery('#amount').show()
            jQuery('#reason').show()
        }else{
            jQuery('#amount').hide()
            jQuery('#reason').hide()
            jQuery('#time').show()
            jQuery('#rate').show()
            jQuery('#total').show()


        }

    });

    const timeElement = document.querySelector('#billabletime');

    timeElement.addEventListener('change', () => {

        const remainingbillablehrs = parseInt(jQuery('#remainingbillablehrs').val());
        const time = parseInt(jQuery('#billabletime').val());
        const submitbutton = jQuery('#submitinvoice');
        const timeelement = jQuery('#billabletime');
        if(time > remainingbillablehrs){
            submitbutton.attr('disabled', true);
            timeelement.addClass('is-invalid');

        }else{
            submitbutton.attr('disabled', false);
            timeelement.removeClass('is-invalid');
            const rate = parseInt(jQuery('#billingRate').val());
            const total = time * rate;
            jQuery('#totalAmount').val(total);
        }


    } );


</script>


@endsection
