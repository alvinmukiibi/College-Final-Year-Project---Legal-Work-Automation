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
                    <div class="col-md-12">
                        <div class="callout callout-success">
                            <h5> <i class="fa fa-info"></i> NOTE:</h5>
                            <p>Requisitions concerning amounts greater than {{ __('SHS 50,000 require') }} approval from a Partner!!</p>
                        </div>
                       <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Staff Requisitions
                                </h3>
                            </div>
                            <div class="card-body table-responsive">
                                    <table class="table table-hover table-bordered" id="example2">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Requestor</th>
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
                                                            <td>{{ $req->fname }} {{ $req->lname }}</td>
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
                                                                @if ($req->status == 'rejected' || $req->status == 'declined')
                                                                    <span class="badge badge-danger">declined</span>
                                                                @endif
                                                                @if ($req->status == 'served')
                                                                    <span class="badge badge-secondary">served</span>
                                                                @endif
                                                                @if ($req->status == 'submitted')
                                                                    <span class="badge badge-info">submitted</span>
                                                                @endif

                                                            </td>
                                                            <td>
                                                                @if($req->status == 'pending')
                                                                    @if($req->amount <= 50000)
                                                                        <a href="{{ url('/finance/approve/requisition', ['requisition' => $req->id]) }}" class="btn btn-sm btn-success"> <b>Approve</b> </a>
                                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#{{ 'giveReason_'.$req->id }}">
                                                                            <b>Decline</b>
                                                                              </button>


                                                                         @else
                                                                    <a href="{{ url('/finance/submit/requisition', ['requisition' => $req->id]) }}" class="btn btn-sm btn-primary"> <b>Submit</b> </a>
                                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#{{ 'giveReason_'.$req->id }}">
                                                                            <b>Decline</b>
                                                                          </button>


                                                                    @endif
                                                                @endif

                                                                @if ($req->status == 'approved')
                                                                <a href="{{ url('/finance/serve/requisition', ['requisition' => $req->id]) }}" class="btn btn-sm btn-outline-success"> <b>Mark as Served</b> </a>

                                                                @endif


                                                            </td>
                                                            <div class="modal fade" id="{{ 'giveReason_'.$req->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                      <div class="modal-content">
                                                                            <form action="{{ url('/finance/decline/requisition') }}" method="post">
                                                                        <div class="modal-header">
                                                                          <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Reason For Declining') }}</h5>
                                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                          </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                         <div class="form-group">
                                                                             <textarea name="reason" required  cols="5" rows="5" placeholder="E.g. Insufficient funds in treasury..." class="form-control {{ $errors->has('reason')?'is-invalid':'' }}"></textarea>
                                                                         </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            @csrf
                                                                            <input type="hidden" name="reqID" value={{ $req->id }}>
                                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                          <button type="submit" class="btn btn-outline-danger"> <b>Decline</b> </button>

                                                                        </div>
                                                                    </form>
                                                                      </div>
                                                                    </div>
                                                                  </div>
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
