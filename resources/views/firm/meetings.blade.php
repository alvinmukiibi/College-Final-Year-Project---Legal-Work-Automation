@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">

@endsection

@section('content')

<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Meetings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Meetings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-md-2">
                            <button type="button" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#newMeeting">
                                   New Meeting <i class="fa fa-plus"></i>
                                  </button>

                                <button type="button" class="btn btn-outline-warning btn-block">
                                        UpComing Meetings
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-block">
                                        Past Meetings
                                </button>

                    </div>
                    <div class="col-md-10">
                        @include('includes.messages')
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">My Meetings</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Venue</th>
                                            <th>Agenda</th>
                                            <th>Attendance</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($meetings as $meeting)
                                        <tr>
                                                <td>{{$meeting->name}}</td>
                                                <td>{{$meeting->date}}</td>
                                                <td>{{$meeting->time}}</td>
                                                <td>{{$meeting->venue}}</td>
                                                <td>{{$meeting->agenda}}</td>
                                                <td>
                                                   @switch($meeting->attendance)
                                                       @case("all_part")
                                                           {{__("All Partners")}}
                                                           @break
                                                       @case("all_assoc")
                                                           {{__("All Associates")}}
                                                           @break
                                                       @case("all_assoc_in_dept")
                                                            {{__("Department Associates")}}
                                                            @break
                                                       @case("all")
                                                            {{__("Everyone")}}
                                                            @break
                                                       @default
                                                            {{__("Unspecified")}}

                                                   @endswitch
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
        <div class="modal fade" id="newMeeting" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                        <form action="{{url('/user/schedule/meeting')}}" method="post">

                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalScrollableTitle">Meeting Management</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">


                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Schedule Meeting
                                </h3>

                            </div>
                            <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label">Meeting Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="name" class="form-control">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="date" class="col-sm-4 col-form-label">Date of Meeting</label>
                                            <div class="col-sm-8">
                                                <input type="date" name="date" class="form-control">

                                            </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="time" class="col-sm-4 col-form-label">Time of Meeting</label>
                                            <div class="col-sm-8">
                                                <input type="time" name="time" class="form-control">

                                            </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="venue" class="col-sm-4 col-form-label">Venue</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="venue" class="form-control">

                                            </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="agenda" class="col-sm-4 col-form-label">Agenda</label>
                                            <div class="col-sm-8">
                                               <textarea name="agenda"  id="editor1" cols="10" rows="5" class="form-control"></textarea>


                                            </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="agenda" class="col-sm-4 col-form-label">Attendes <br/> <small>Who should attend?</small></label>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                        <input type="radio" value="all" name="attendee" class="minimal">
                                                        <label for="everyone" class="form-check-label">Everyone</label>
                                                </div>
                                                <div class="form-check">
                                                        <input type="radio"  value="all_assoc" name="attendee" class="minimal">
                                                        <label for="associates" class="form-check-label">All Associates</label>
                                                </div>
                                                <div class="form-check">
                                                        <input type="radio" value="all_assoc_in_dept" name="attendee" class="minimal">
                                                        <label for="dept-associates" class="form-check-label">All Associates In My Department</label>
                                                </div>
                                                <div class="form-check">
                                                        <input type="radio" value="all_part" name="attendee" class="minimal">
                                                        <label for="partners" class="form-check-label">All Partners</label>
                                                </div>
                                                {{-- <div class="form-check">
                                                        <input type="radio" onClick="hey();"  name="attendee" class="minimal">
                                                        <label for="individual" class="form-check-label">Specify Individuals</label>
                                                </div> --}}



                                            </div>
                                    </div>
                            </div>

                        </div>




                    </div>
                    <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> Schedule </button>
                            @csrf
                          </div>
                        </form>
                        </div>
                        </div>
                    </div>



    </section>
@endsection
