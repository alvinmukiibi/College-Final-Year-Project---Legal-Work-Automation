@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Receipt</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Receipt</li>
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
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                        <i class="fa fa-globe"></i>{{ config('app.name') }}
                                        <small class="float-right">Date of Issuance: {{ date('d-M-Y') }}</small>
                                    </h4>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>{{ $firm->name }}</strong> <br>
                                        {{ $firm->street_address }} <br>
                                        {{ $firm->city }}, {{ $firm->country }} <br>
                                        Phone: {{ $firm->contact1 }} <br>
                                        Email: {{ $firm->email }}
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                        To
                                        <address>
                                          <strong>{{ $client->name }} </strong><br>
                                          {{ $client->address }}<br>
                                          {{ $client->city_of_residence }}, {{ $client->district_of_residence }}, {{ $client->country }}<br>
                                          Phone: {{ $client->mobile_contact }}<br>
                                          Email: {{ $client->email }}
                                        </address>
                                      </div>
                                      <div class="col-sm-4 invoice-col">
                                            <b>Reference {{ __('#') }}  {{ $payment->ref }}</b><br>
                                            <br>
                                            <b>Case Number:</b> {{ $case->case_number }}<br>
                                            <b>Payment Date:</b> {{ date('d-M-Y', strtotime($payment->date_of_payment)) }}<br>
                                            <b>Delivered By:</b> {{ $payment->paid_by }} <br>
                                            <b>Received By:</b> {{ $payment->fname }} {{ $payment->lname }}

                                          </div>
                            </div>
                            <div class="row">
                                    <div class="col-12 table-responsive">
                                      <table class="table table-striped">
                                        <thead>
                                        <tr>
                                          <th>In Payment of</th>
                                          <th>Payment Reason</th>
                                          <th>Amount (SHS)</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                              <td>LEGAL FEES</td>
                                              <td>{{ $payment->paid_for }}</td>
                                              <td>{{ $payment->amount }}</td>
                                          </tr>

                                        </tbody>
                                      </table>
                                    </div>
                            </div>
                            <div class="row">
                                <p class="text-primary">All Rights Reserved</p>
                            </div>

                            <div class="row no-print">
                                    <div class="col-12">
                                      <a href="#" onClick="window.print();" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                                      <button type="button" class="btn btn-success float-right"><i class="fa fa-credit-card"></i> Send Receipt

                                      </button>
                                      {{--  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fa fa-download"></i> Generate PDF
                                      </button>  --}}
                                    </div>
                                  </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
