@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Intakes Manager</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Intakes</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            My Intakes
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Case No</td>
                                    <td>Case Type</td>
                                    <td>Party Name</td>
                                    <td>Date Taken</td>
                                    <td>Case Status</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cases as $case)
                                    <tr>
                                        <td>{{ $case->case_number }}</td>
                                        <td>

                                                <button type="button" class="btn btn-sm btn-info" data-toggle="popover" title="Case Type" data-content="{{ $case->description }}"> <b>{{ $case->type }}</b> </button>
                                        </td>
                                        <td>{{ $case->name }}</td>
                                        <td>{{ date('d-M-Y', strtotime($case->date_taken)) }}</td>
                                        <td>
                                                @if ($case->case_status == 'intake')
                                                <button class="btn btn-warning text-white"><b>{{ __('INTAKE') }}</b></button>
                                                @endif
                                                @if ($case->case_status == 'open')
                                                <button class="btn btn-success text-white"><b>{{ __('OPEN') }}</button>
                                                @endif
                                                @if ($case->case_status == 'closed-rejected')
                                                <button class="btn btn-danger text-white"><b>{{ __('REJECTED') }}</button>
                                                @endif
                                        </td>
                                        <td>
                                                <div class="btn-group">
                                                            <a href="{{ url('/associate/view/case', ['caseID' => $case->case_number]) }}" class="btn btn-primary">View</a>
                                                        </form>

                                                      </div>
                                        </td>
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
