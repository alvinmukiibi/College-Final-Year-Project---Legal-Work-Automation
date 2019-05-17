@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reports Viewer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                        <div class="card card-danger">
                                <div class="card-header">
                                  <h3 class="card-title"> <b>Departmental Analytics</b> </h3>

                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="card-body" id="depts-cases">
                                  {{--  <canvas id="pieChart" style="height:250px"></canvas>  --}}
                                  {{--  {!! $chart->container() !!}  --}}
                                </div>
                              </div>
                </div>
                <div class="col-md-6">
                        <div class="card card-success">
                                <div class="card-header">
                                  <h3 class="card-title"> <b>Lawyer Analytics</b> </h3>
                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="card-body" id="casetypes-cases">
                                </div>
                              </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title"><b>Department Staff</b></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>Laywer Name</th>
                                        <th style="width:130px">Intakes Made</th>
                                        <th style="width:130px">Open Cases</th>
                                        <th style="width:130px">Closed Cases</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lawyers as $lawyer)
                                    <tr>
                                            <td> {{ $lawyer->fname }} {{ $lawyer->lname }}</td>
                                            <td> {{ $lawyer->intakes }} </td>
                                            <td> {{ $lawyer->open_cases }} </td>
                                            <td> {{ $lawyer->closed_cases }} </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?= Lava::render('PieChart', 'PieChartDepartmentsCases', 'depts-cases') ?>
        <?= Lava::render('BarChart', 'LineChartCaseTypesCases', 'casetypes-cases') ?>


    </section>
    @endsection




