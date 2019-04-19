@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Invoices</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoices</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Invoices</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Invoice {{ __('#') }}</th>
                                                <th>Rate(/hr)</th>
                                                <th>Time(hr)</th>
                                                <th>Amount(/=)</th>

                                                <th>Generated By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ date('d-M-Y', strtotime($invoice->created_at)) }}</td>
                                                <td>{{ $invoice->invoice_no }}</td>
                                                <td>{{ $invoice->rate }}</td>
                                                <td>{{ $invoice->time }}</td>
                                                <td>{{ $invoice->amount }}</td>

                                                <td>{{ $invoice->fname }} {{ $invoice->lname }}</td>
                                                <td>
                                                    @if ($invoice->status == 'unpaid')
                                                        <span class="badge badge-warning">unpaid</span>
                                                    @endif
                                                    @if ($invoice->status == 'paid')
                                                        <span class="badge badge-success">unpaid</span>
                                                    @endif
                                                    @if ($invoice->status == 'invoiced')
                                                        <span class="badge badge-primary">invoiced</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($invoice->invoicer == auth()->user()->id)
                                                    <a href="{{ url('/associate/print/invoice', ['case' => $case_number, 'invoice' => $invoice->invoice_no ]) }}" class="btn btn-outline-success btn-sm"> <i class="fa fa-print"></i></a>

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


