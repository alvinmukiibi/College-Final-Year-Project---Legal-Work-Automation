@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payments Manager</h1>
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
                                <table class="table table-hover table-bordered" id="example1">
                                    <thead>
                                        <tr>

                                            <th>Case Number</th>
                                            <th> Ref {{ __('#') }} </th>
                                            <th>Date of Payment</th>
                                            <th>Amount</th>
                                            <th>Delivered By</th>

                                            <th>Recieved By</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->case_number }}</td>
                                                <td>{{ $payment->ref }}</td>
                                                <td>{{ date('d-M-Y', strtotime($payment->date_of_payment)) }}</td>
                                                <td>{{ $payment->amount }}</td>
                                                <td>{{ $payment->paid_by }}</td>

                                                <td>{{ $payment->fname }} {{ $payment->lname }}</td>
                                                <th>
                                                    @if ($payment->status == 'pending')
                                                    <a href={{ url('/finance/send/receipt', ['case' => $payment->case_number, 'payment' => $payment->ref]) }}  class="btn btn-sm btn-outline-success" title="SEND TO CLIENT"> <i class="fa fa-send-o"></i> <b>SEND</b> </a>

                                                        <a href={{ url('/finance/view/receipt', ['case' => $payment->case_number, 'payment' => $payment->ref]) }}  class="btn btn-sm btn-outline-primary" title="PRINT RECEIPT"> <i class="fa fa-print"></i> </a>
                                                    @else
                                                    <span class="badge badge-success">receipted</span>
                                                    <a href={{ url('/finance/view/receipt', ['case' => $payment->case_number, 'payment' => $payment->ref]) }}  class="btn btn-sm btn-outline-primary" title="PRINT RECEIPT"> <i class="fa fa-print"></i> </a>

                                                    @endif

                                                </th>
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
