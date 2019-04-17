@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payments Viewer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payments</li>
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
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Case Payments
                                </h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-bordered" id="example2">
                                    <thead>
                                        <tr>
                                            <th>Date of Payment</th>
                                            <th> Ref {{ __('#') }} </th>
                                            <th>Amount (SHS)</th>
                                            <th>Delivered By</th>
                                            <th>Paid For</th>
                                            <th>Recieved By</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ date('d-M-Y', strtotime($payment->date_of_payment)) }}</td>
                                                <td>{{ $payment->ref }}</td>
                                                <td>{{ $payment->amount }}</td>
                                                <td>{{ $payment->paid_by }}</td>
                                                <td>{{ $payment->paid_for }}</td>
                                                <td>{{ $payment->fname }} {{ $payment->lname }}</td>
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
