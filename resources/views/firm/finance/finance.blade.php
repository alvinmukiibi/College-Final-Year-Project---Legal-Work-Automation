@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">

    @endsection

    @section('content')

        <h1>  {{Auth::user()->name }} </h1>

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Finance |  {{Auth::user()->firm->name}}</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Finance</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            From Lawyer
                        </h3>
                    </div>
                    <div class="card-body pb-60">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 180px">Case_id</th>
                                <th style="width: 180px">Amount</th>
                                <th style="width: 180px">PaidFor</th>
                                <th style="width: 180px">PaidBy</th>

                                <th >Status</th>
                                <th  style="width: 40px">Action</th>
                            </tr>
                            @foreach ($finance as $finance)
                                <tr>
                                    <td>{{$finance->Case_id}}</td>
                                    <td>{{$finance->Amount}}</td>
                                    <td>{{$finance->PaidFor}}</td>
                                    <td>{{$finance->PaidBy}}</td>
                                    <td><a href="{{url('admin/finance',['finance'=>$finance->id])}}" class="btn btn-primary"> <i class="fa fa-pencil"></i>  </a></td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>


    {{--<div class="col-md-12">--}}
    {{--<div class="card">--}}
    {{--<div class="card-header">--}}
    {{--<h3 class="card-title">--}}
    {{--From Lawyer--}}
    {{--</h3>--}}
    {{--</div>--}}
    {{--<div class="card-body p-0">--}}
    {{--<table class="table table-striped">--}}
    {{--<tr>--}}
    {{--<th style="width: 180px">Case_Id</th>--}}
    {{--<th style="width: 180px">Amount</th>--}}
    {{--<th style="width: 180px">PaidFor</th>--}}
    {{--<th style="width: 180px">PaidBy</th>--}}

    {{--<th >Action</th>--}}
    {{--<th  style="width: 40px">Action</th>--}}
    {{--</tr>--}}
    {{--@foreach ($finance as $finance)--}}
    {{--<tr>--}}
    {{--<td>{{$finance->name}}</td>--}}
    {{--<td>{{$finance->description}}</td>--}}
    {{--<td><a href="{{url('admin/finance',['finance'=>$finance->id])}}" class="btn btn-primary"> <i class="fa fa-pencil"></i>  </a></td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}

    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</section>--}}
@stop
