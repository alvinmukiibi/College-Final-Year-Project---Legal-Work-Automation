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
                                  <h3 class="card-title"> <b>Inter-Departmental Analytics</b> </h3>

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
                                  <h3 class="card-title"> <b>Case Type Analytics</b> </h3>
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
                <div class="col-md-6">
                        <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title"> <b>CaseType-Revenue Analytics</b> </h3>
                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="card-body" id="casetypes-revenue">
                                </div>
                              </div>


                </div>
                <div class="col-md-6">
                        <div class="card card-warning">
                                <div class="card-header">
                                  <h3 class="card-title"> <b>Lawyer-Revenue Analytics</b> </h3>
                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="card-body" id="lawyers-revenue">
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
                            <div class="row">
                                <div class="col-md-9">
                                        <table class="table table-hover table-bordered" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th>Laywer Name</th>
                                                        <th >{{ __('#') }} <span title="Total number of Intakes Cases">Intakes</span></th>
                                                        <th >{{ __('#') }} <span title="Number of Open Cases">Open</span></th>
                                                        <th >{{ __('#') }} <span title="Number of Closed Cases">Closed</span></th>
                                                        <th >{{ __('#') }} <span title="Number of Rejected Cases">Rej</span></th>
                                                        <th > <span title="Client Converstion Rate">CCR</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lawyers as $lawyer)
                                                    <tr>
                                                            <td> {{ $lawyer->fname }} {{ $lawyer->lname }}</td>
                                                            <td> {{ $lawyer->intakes }} </td>
                                                            <td> {{ $lawyer->open_cases }} </td>
                                                            <td> {{ $lawyer->closed_cases }} </td>
                                                            <td> {{ $lawyer->rejected_cases }} </td>
                                                            <td> {{ ($lawyer->intakes - $lawyer->rejected_cases) / ($lawyer->intakes) * 100 }}% </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                </div>
                                <div class="col-md-3">

                                              <div class="info-box">
                                                    <span class="info-box-icon bg-success elevation-1"><i class="fa fa-briefcase"></i></span>
                                                    <div class="info-box-content">
                                                      <span class="info-box-text">Total Intakes</span>
                                                      <span class="info-box-number">
                                                        {{ __($totalIntakesInDepartment) }}
                                                        <small></small>
                                                      </span>
                                                    </div>
                                                  </div>
                                                  <div class="info-box">
                                                        <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-briefcase"></i></span>
                                                        <div class="info-box-content">
                                                          <span class="info-box-text">Total Open</span>
                                                          <span class="info-box-number">
                                                            {{ __($totalOpenInDepartment)  }} Cases
                                                            <small></small>
                                                          </span>
                                                        </div>
                                                      </div>
                                                  <div class="info-box">
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-briefcase"></i></span>
                                                        <div class="info-box-content">
                                                          <span class="info-box-text">Department CCR</span>
                                                          <span class="info-box-number">
                                                            @if ($totalIntakesInDepartment == 0)
                                                            {{ ($totalIntakesInDepartment - $totalRejectedInDepartment) / 1 * 100 }}%
                                                            @else
                                                            {{ ($totalIntakesInDepartment - $totalRejectedInDepartment) / $totalIntakesInDepartment * 100 }}%


                                                            @endif

                                                            <small></small>
                                                          </span>
                                                        </div>
                                                      </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Miscellaneous Atomic Analytics
                            </h3>
                            <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>

                </div>

            </div>

        </div>

        <?= Lava::render('PieChart', 'PieChartDepartmentsCases', 'depts-cases') ?>
        <?= Lava::render('BarChart', 'LineChartCaseTypesCases', 'casetypes-cases') ?>
        <?= Lava::render('LineChart', 'LineChartCaseTypesRevenue', 'casetypes-revenue') ?>
        <?= Lava::render('BarChart', 'LineChartLawyerRevenue', 'lawyers-revenue') ?>


    </section>
    @endsection




