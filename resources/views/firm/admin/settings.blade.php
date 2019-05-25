@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        @include('includes.messages')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
                            <div class="card-header">
                                    <h3 class="card-title">
                                        Settings
                                    </h3>
                                </div>
                                <div class="card-body">
                                    @if ($settings->count() == 0)
                                    <form action="{{ url('/admin/set/rqa') }}" method="post">
                                        <div class="form-group">
                                                <label for="name">Requisition Critical Amount(RQA)</label>
                                                <div class="input-group">
                                                        @csrf
                                                        <input type="number" required name="rqa" class="form-control">
                                                        <span class="input-group-append">
                                                            <button type="submit" class="btn btn-primary"><b>Set Value</b></button>
                                                        </span>
                                                </div>
                                        </div>
                                        </form>

                                    @else
                                        <form action="{{ url('/admin/submit/rqa') }}" method="post">
                                        <div class="form-group">
                                                <label for="name">Requisition Critical Amount(RQA)</label>
                                                <div class="input-group">
                                                        @csrf
                                                        <input type="hidden" name="firmID" value="{{ $settings[0]->firm_id }}" >
                                                        <input type="text" readonly class="form-control" id="oldValue" value="{{ $settings[0]->requisition_critical_amount }}">
                                                        <input type="number" style="display: none" id="newValue" required class="form-control" name="newRQA">
                                                        <span class="input-group-append">
                                                            <button id="editButton"  class="btn btn-success"><b> <i class="fa fa-pencil"></i>  Edit</b></button>
                                                            <button id="submitButton" style="display: none" type="submit"  class="btn btn-outline-primary"><b>   Submit</b></button>
                                                        </span>
                                                </div>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Verbose
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="callout callout-success">
                                <h5> <i class="fa fa-info"></i> Requisition Critical Amount </h5>
                                <p>This value defines the maximum amount of money above which a requisition of that amount requires approval from a partner role</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        const butt = document.querySelector('#editButton');
        butt.addEventListener('click', (event) => {
            event.preventDefault();
            jQuery('#oldValue').hide();
            jQuery('#newValue').show();
            jQuery('#editButton').hide();
            jQuery('#submitButton').show();
        })


    </script>


    @endsection


