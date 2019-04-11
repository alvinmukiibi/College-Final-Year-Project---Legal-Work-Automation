@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">
@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Due Diligence</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Due Diligence</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @include('includes.messages')
                            <div class="card card-primary">
                                <form action="{{ url('/associate/add/duediligence') }}" method="post" enctype="multipart/form-data" >
                                @csrf
                                    <div class="card-header">
                                    <h3 class="card-title">Add DD</h3>
                                </div>
                                <div class="card-body">
                                        <div class="form-group">
                                                <label for="date_carried_out">Date Created Out</label>
                                                <input type="date" name="date_carried_out" required class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                    <label for="description">Textual Description</label>
                                                    <textarea name="description" cols="5" rows="5" class="form-control" placeholder="Give Detailed Description of findings...">

                                                    </textarea>
                                                </div>
                                                <div class="form-group col-md-12">

                                                        <div class="input-group">
                                                                <div class="custom-file">
                                                                  <input type="file" class="custom-file-input" name="file1">
                                                                  <label class="custom-file-label" >Choose file</label>

                                                                </div>

                                                              </div>
                                                    </div>
                                                    <div class="form-group col-md-12">

                                                            <div class="input-group">
                                                                    <div class="custom-file">
                                                                      <input type="file" class="custom-file-input" name="file2">
                                                                      <label class="custom-file-label" >Choose file</label>

                                                                    </div>

                                                                  </div>
                                                        </div>
                                                        <div class="form-group col-md-12">

                                                                <div class="input-group">
                                                                        <div class="custom-file">
                                                                          <input type="file" class="custom-file-input" name="file3">
                                                                          <label class="custom-file-label" >Choose file</label>

                                                                        </div>

                                                                      </div>
                                                            </div>
                                                            <div class="form-group col-md-12">

                                                                    <div class="input-group">
                                                                            <div class="custom-file">
                                                                              <input type="file" class="custom-file-input" name="file4">
                                                                              <label class="custom-file-label" >Choose file</label>

                                                                            </div>

                                                                          </div>
                                                                </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="caseID" value="{{ $caseID }}">
                                    <button type="submit" class="pull-right btn btn-success btn-flat">Add To Case</button>
                                </div>
                            </form>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Past Entries</h3>
                                </div>
                                <div class="card-body">
                                        @foreach ($diligences as $dd)


                                        <div id="accordion">

                                                <div class="card card-primary">
                                                  <div class="card-header">
                                                    <h4 class="card-title">
                                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                        {{ date('d-M-Y', strtotime($dd->date_carried_out)) }}
                                                      </a>
                                                    </h4>
                                                  </div>
                                                  <div id="collapseOne" class="panel-collapse collapse in">
                                                    <div class="card-body">
                                                        {{ $dd->description }}


                                                        <span id="files">
                                                        </span>
                                                    </div>
                                                  </div>
                                                </div>

                                              </div>
                                              @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    </section>
@endsection
