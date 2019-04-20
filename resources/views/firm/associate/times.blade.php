@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Billable Time Entries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Time Entries</li>
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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Time Entries
                                    <span class="badge pull-right" id="total">Total Hours: {{ $totalhrs }} </span>
                                    <span class="badge badge-primary pull-right" id="billed">Billed Hours: {{ $invoicedhrs }} </span>
                                </h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Date Added</th>
                                            <th>Time(HRS)</th>
                                            <th>Event</th>
                                            <th>Entry Added By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($entries as $entry)
                                        <tr>
                                                <td>{{ date('d-M-Y', strtotime($entry->created_at)) }}</td>
                                                <td>{{ $entry->time }}</td>
                                                <td>{{ $entry->event }}</td>
                                                <td>{{ $entry->fname }} {{ $entry->lname }}</td>
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


