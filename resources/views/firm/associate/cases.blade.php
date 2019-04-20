@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Case Manager</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Cases</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @include('includes.messages')
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            My Cases
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="example1">
                            <thead>
                                <tr>
                                    <th>Case No</th>
                                    <th>Case Type</th>
                                    <th>Party Name</th>
                                    <th>Date Taken</th>
                                    <th>Case Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cases as $case)
                                    <tr>
                                        <td>{{ $case->case_number }}</td>
                                        <td>

                                                <button type="button" class="btn btn-sm btn-info" data-toggle="popover" title="Case Type" data-content="{{ $case->casetype }}"> <b>{{ $case->acronym }}</b> </button>
                                        </td>
                                        <td>{{ $case->name }}</td>
                                        <td>{{ date('d-M-Y', strtotime($case->date_taken)) }}</td>
                                        <td>
                                                @if ($case->case_status == 'intake')
                                                <span class="badge badge-warning text-white"><b>{{ __('INTAKE') }}</b></span>
                                                @endif
                                                @if ($case->case_status == 'open')
                                                <span class="badge badge-success text-white"><b>{{ __('OPEN') }}</span>
                                                @endif
                                                @if ($case->case_status == 'closed-rejected')
                                                <span class="badge badge-danger text-white"><b>{{ __('REJECTED') }}</span>
                                                @endif
                                        </td>
                                        <td>
                                            @if ($case->owner == auth()->user()->id && $case->assignee !== null)
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-danger"> <b>ASSIGNED</b> </button>
                                            </div>
                                            @else
                                                <div class="btn-group">
                                                        <button type="button" class="btn btn-success btn-sm"> <b>Action</b> </button>
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                          <span class="caret"></span>
                                                          <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                                <a class="dropdown-item" href="{{ url('/associate/view/case', ['caseID' => $case->case_number]) }}">View</a>
                                                          <div class="dropdown-divider"></div>
                                                          <a class="dropdown-item" href="{{ url('/associate/share/case', ['caseID' => $case->case_number]) }}">Share Case</a>
                                                        </div>
                                                      </div>
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
