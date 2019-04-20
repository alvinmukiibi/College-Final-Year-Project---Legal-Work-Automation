@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Requisitions Manager</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Requisitions</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @include('includes.messages')
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary">
                <form action="{{ url('/associate/make/requisition') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">
                            Make Requisition
                        </h3>
                    </div>
                    <div class="card-body">

                            <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="Amount">{{ __('Amount (SHS)') }}</label>
                                        <input type="number" required name="amount" class="form-control {{ $errors->has('amount')?'is-invalid':'' }}">
                                    </div>
                                </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="Subject">Subject</label>
                                <input type="text" placeholder="E.g. Reimbursement.." required name="subject" class="form-control {{ $errors->has('subject')?'is-invalid':'' }}">
                            </div>
                        </div>
                        <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="Reason">Reason <small class="text-danger">optional</small> </label>
                                    <textarea name="reason"  cols="5" rows="3" class="form-control {{ $errors->has('reason')?'is-invalid':'' }}"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="contact" class="col-sm-4 col-form-label">Supporting Doc <small class="text-danger">optional</small> </label>

                                    <div class="col-sm-8">
                                            <div class="input-group">
                                                    <div class="custom-file">
                                                      <input type="file" class="custom-file-input" name="supportingDocument">
                                                      <label class="custom-file-label" >Choose file</label>
                                                    </div>
                                            </div>
                                    </div>
                                  </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success pull-right btn-flat"> <b>SUBMIT</b> <i class="fa fa-login"></i> </button>
                    </div>
                </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-secondary">
                  <div class="card-header">
                      <h3 class="card-title">My Requisitions</h3>
                  </div>
                  <div class="card-body table-responsive">
                        <table class="table table-hover" id="example2">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Subject</th>
                                        <th>Reason</th>

                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requisitions as $req)
                                        <tr>
                                            <td>{{ date('d-M', strtotime($req->created_at)) }}</td>
                                            <td>{{ $req->amount }}</td>
                                            <td>{{ $req->subject }}</td>
                                            <td>
                                                @if ($req->reason != null)
                                                    <button type="button" class="btn btn-sm btn-info" data-toggle="popover" title="Reason" data-content="{{ $req->reason }}"> <i class="fa fa-eye"></i> </button>
                                                    @if ($req->supporting_document)
                                                <a href="{{ url('/associate/download/file',['file' => $req->supporting_document]) }}"><i class="fa fa-download"></i></a>

                                                @endif
                                                @endif
                                                </td>

                                            <td>
                                                @if ($req->status == 'pending')
                                                    <span class="badge badge-warning">pending</span>
                                                @endif
                                                @if ($req->status == 'approved')
                                                    <span class="badge badge-success">approved</span>
                                                @endif
                                                @if ($req->status == 'cancelled')
                                                    <span class="badge badge-secondary">cancelled</span>
                                                @endif
                                                @if ($req->status == 'served')
                                                    <span class="badge badge-secondary">served</span>
                                                @endif
                                                @if ($req->status == 'submitted')
                                                    <span class="badge badge-warning">submitted</span>
                                                @endif
                                                @if ($req->status == 'declined')
                                                    <span class="badge badge-danger">declined
                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="popover" title="Reason Given" data-content="{{ $req->reason_for_update }}"> <i class="fa fa-eye"></i> </button>

                                                    </span>

                                                @endif
                                            </td>
                                            <td>
                                                @if ($req->status == 'pending')
                                                    <a href="{{ url('/associate/cancel/requisition', ['requisition' => $req->id]) }}" class="btn btn-sm btn-danger"> <b>Cancel</b> </a>

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
    </div>
</section>

@endsection
