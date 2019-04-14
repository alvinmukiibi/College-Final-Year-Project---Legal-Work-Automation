@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">
@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Proceedings Viewer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Proceedings</li>
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
                                        Record Proceeding
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/associate/add/proceeding') }}" method="post">
                                    @csrf
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                    <label for="dtp_input1" class="col-md-12 control-label">Date of Proceeding</label>
                                                    <div class="input-group date form_datetime col-md-12"  data-date-format="dd MM yyyy - HH:ii" data-link-field="date_of_proceeding">
                                                    <input class="form-control" size="16" type="text"  value="" readonly>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                                <input type="hidden"  name="date_of_proceeding" id="date_of_proceeding" /><br/>

                                                </div>
                                                <div class="form-group col-md-8">
                                                        <label for="description">Description</label>
                                                        <textarea id="editor1" required name="description" cols="5" rows="5" placeholder="What happened during the proceeding..." class="form-control"></textarea>


                                                </div>
                                    </div>


                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="court">Courts of Law</label>
                                            <input type="text" required placeholder="High Court" name="court" class="form-control">

                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="court">Outcome of Proceeding</label>
                                            <input type="text" required placeholder="E.g. Court adjourned..." name="outcome" class="form-control">

                                        </div>

                                    </div>
                                    <div class="row">
                                            <div class="form-group col-md-4">
                                                    <label for="dtp_input1" class="col-md-12 control-label">Date of Next Proceeding</label>
                                                    <div class="input-group date form_datetime col-md-12"  data-date-format="dd MM yyyy - HH:ii" data-link-field="date_of_next_proceeding">
                                                    <input class="form-control" size="16" type="text" value="" readonly>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                                <input type="hidden" name="date_of_next_proceeding" id="date_of_next_proceeding" value="" /><br/>


                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for=""> <i class="fa fa-login"></i> </label>
                                                    <input type="hidden" name="caseID" value="{{ $case }}">
                                                        <button type="submit" class="btn btn-outline-success btn-block"> <b>Submit</b>  </button>

                                                </div>


                                    </div>
                                </form>

                                <hr/>

                                <table class="table table-hover">
                                    <thead>
                                        <th style="width:20%">Date</th>
                                        <th>Issues</th>
                                        <th style="width:20%">Outcome</th>
                                        <th style="width:20%">Next Proceeding</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($proceedings as $proceeding)
                                        <tr>
                                                <td>{{ date('d-M-Y H:i', strtotime($proceeding->date_of_proceeding)) }}</td>
                                                <td>
                                                    <div class="card card-info collapsed-card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Desc</h3>
                                                            <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                                                      <i class="fa fa-minus"></i>
                                                                    </button>
                                                                  </div>
                                                        </div>
                                                        <div class="card-body">
                                                                {{ $proceeding->description }}
                                                        </div>

                                                    </div>
                                                </td>
                                                <td>{{ $proceeding->outcome_of_proceeding }}</td>
                                                <td>{{ date('d-M-Y H:i', strtotime($proceeding->date_of_next_proceeding)) }}</td>
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
