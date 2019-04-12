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
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Record Proceeding
                                    </h3>
                                </div>
                                <div class="card-body">
                                        <div class="form-group">
                                            <label for="dtp_input1" class="col-md-12 control-label">Date of Proceeding</label>
                                            <div class="input-group date form_datetime col-md-12" data-date="2019-01-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="date_of_proceeding">
                                            <input class="form-control" size="16" type="text" value="" readonly>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>
                                        <input type="hidden" id="date_of_proceeding" value="" /><br/>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" cols="5" rows="5" placeholder="What happened during the proceeding..." class="form-control"></textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="court">Courts of Law</label>
                                        <input type="text" name="court" class="form-control">
                                    </div>
                                    <div class="form-group">
                                            <label for="court">Outcome of Proceeding</label>
                                            <input type="text" name="outcome" class="form-control">
                                        </div>
                                        <div class="form-group">
                                                <label for="dtp_input1" class="col-md-12 control-label">Date of Next Proceeding</label>
                                                <div class="input-group date form_datetime col-md-12" data-date="2019-01-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="date_of_next_proceeding">
                                                <input class="form-control" size="16" type="text" value="" readonly>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>
                                            <input type="hidden" id="date_of_next_proceeding" value="" /><br/>
                                        </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
            </div>
    </section>
@endsection
