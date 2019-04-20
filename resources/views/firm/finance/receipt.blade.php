<html>
<head>
          <style>
            #invoice{
                padding: 30px;
            }

            .invoice {
                position: relative;
                background-color: #FFF;
                min-height: 680px;
                padding: 15px
            }

            .invoice header {
                padding: 10px 0;
                margin-bottom: 20px;
                border-bottom: 1px solid #3989c6
            }

            .invoice .company-details {
                text-align: right
            }

            .invoice .company-details .name {
                margin-top: 0;
                margin-bottom: 0
            }

            .invoice .contacts {
                margin-bottom: 20px
            }

            .invoice .invoice-to {
                text-align: left
            }

            .invoice .invoice-to .to {
                margin-top: 0;
                margin-bottom: 0
            }

            .invoice .invoice-details {
                text-align: right
            }

            .invoice .invoice-details .invoice-id {
                margin-top: 0;
                color: #3989c6
            }

            .invoice main {
                padding-bottom: 50px
            }

            .invoice main .thanks {
                margin-top: -100px;
                font-size: 2em;
                margin-bottom: 50px
            }

            .invoice main .notices {
                padding-left: 6px;
                border-left: 6px solid #3989c6
            }

            .invoice main .notices .notice {
                font-size: 1.2em
            }

            .invoice table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px
            }

            .invoice table td,.invoice table th {
                padding: 15px;
                background: #eee;
                border-bottom: 1px solid #fff
            }

            .invoice table th {
                white-space: nowrap;
                font-weight: 400;
                font-size: 16px
            }

            .invoice table td h3 {
                margin: 0;
                font-weight: 400;
                color: #3989c6;
                font-size: 1.2em
            }

            .invoice table .qty,.invoice table .total,.invoice table .unit {
                text-align: right;
                font-size: 1.2em
            }

            .invoice table .no {
                color: #fff;
                font-size: 1.6em;
                background: #3989c6
            }

            .invoice table .unit {
                background: #ddd
            }

            .invoice table .total {
                background: #3989c6;
                color: #fff
            }

            .invoice table tbody tr:last-child td {
                border: none
            }

            .invoice table tfoot td {
                background: 0 0;
                border-bottom: none;
                white-space: nowrap;
                text-align: right;
                padding: 10px 20px;
                font-size: 1.2em;
                border-top: 1px solid #aaa
            }

            .invoice table tfoot tr:first-child td {
                border-top: none
            }

            .invoice table tfoot tr:last-child td {
                color: #3989c6;
                font-size: 1.4em;
                border-top: 1px solid #3989c6
            }

            .invoice table tfoot tr td:first-child {
                border: none
            }

            .invoice footer {
                width: 100%;
                text-align: center;
                color: #777;
                border-top: 1px solid #aaa;
                padding: 8px 0
            }

            @media print {
                .invoice {
                    font-size: 11px!important;
                    overflow: hidden!important
                }

                .invoice footer {
                    position: absolute;
                    bottom: 10px;
                    page-break-after: always
                }

                .invoice>div:last-child {
                    page-break-before: always
                }
            }
       </style>

</head>
<body>

        <div id="invoice">

                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a target="_blank" href="https://lobianijs.com">
                                          </a>
                                </div>
                                <div class="col company-details">

                                    <h2 class="name">
                                        <a target="_blank" href="{{ $firm->website }}">
                                                {{ $firm->name }}
                                        </a>
                                    </h2>
                                    <div>{{ $firm->street_address }}, </div>
                                    <div>{{ $firm->city }}, {{ $firm->country }} </div>
                                    <div>{{ $firm->contact1 }} </div>
                                    <div>{{ $firm->email }} </div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">

                                <div class="col invoice-to">
                                    <div class="text-gray-light">RECEIPT TO:</div>
                                    <h2 class="to">{{ $client->name }}</h2>
                                    <div class="address">{{ $client->address }}</div>
                                    <div class="address">{{ $client->city_of_residence }}, {{ $client->district_of_residence }}, {{ $client->country }}</div>
                                    <div class="email"><a href="#">{{ $client->email }}</a></div>
                                </div>


                                <div class="col invoice-details">
                                    <h1 class="invoice-id">Reference {{ __('#') }}  {{ $payment->ref }}</h1>
                                    <div class="date">Case Number : {{ $case->case_number }} </div>
                                    <div class="date">Payment Date : {{ date('d-M-Y', strtotime($payment->date_of_payment)) }}</div>
                                    <div class="date">Payment Delivered By : {{ $payment->paid_by }}</div>
                                    <div class="date">Payment Received By : {{ $payment->fname }} {{ $payment->lname }}</div>
                                </div>
                            </div>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>


                                        <th class="text-left"> <b>IN PAYMENT OF</b> </th>
                                        {{-- <th class="text-right">HOUR PRICE</th>
                                        <th class="text-right">HOURS</th> --}}
                                        <th class="text-right">TOTAL (SHS)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>

                                        <td class="text-left"><h3>LEGAL FEES</h3> {{ $payment->paid_for }} </td>

                                        <td class="total">{{ $payment->amount }}</td>
                                    </tr>

                                </tbody>
                                <tfoot>

                                    <tr>

                                        <td>GRAND TOTAL</td>
                                        <td>{{ $payment->amount }}</td>
                                    </tr>
                                </tfoot>
                            </table><br><br>

                            <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">Print and Keep all your receipts, for future reference!!</div>
                            </div>

                        </main>
                        <footer>
                            Receipt was created on a computer and is valid without the signature and seal.
                        </footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>

</body>
</html>
