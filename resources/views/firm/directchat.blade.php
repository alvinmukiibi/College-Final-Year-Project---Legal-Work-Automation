@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">
@endsection

@section('content')


        <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Direct Chat</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Chat</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                                <a href={{ url('/user/manage/mailbox') }}  class="btn btn-outline-primary btn-block"> Back To Mailbox </a>


                        </div>
                        <section class="col-lg-9 connectedSortable">
                            <div class="card direct-chat direct-chart-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Direct Chat</h3>
                                    <div class="card-tools">
                                            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span>
                                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                              <i class="fa fa-minus"></i>
                                            </button>

                                            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                            </button>
                                          </div>
                                </div>
                                <div class="card-body">
                                    <div class="direct-chat-messages">
                                        @foreach ($messages as $message)
                                        @if ($message->recipient_id == auth()->user()->id)
                                        <div class="direct-chat-msg right">
                                                <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name float-right">{{$user->fname}} {{$user->lname}} </span>
                                                <span class="direct-chat-timestamp float-left">{{$message->date}}</span>
                                                </div>

                                                <img class="direct-chat-img" src="{{asset('uploads/profiles/'.$user->profile_pic)}}" alt="message user image"/>

                                                <div class="direct-chat-text bg-primary">
                                                  {{$message->message}}
                                                  @if ($message->attachment)
                                                  <span class="pull-right"> <i class="fa fa-paperclip"></i> <a href="{{ url('user/download/attachment', ['file' => $message->attachment] )}}" ><i class="fa fa-download"></i></a>  </span>

                                                  @endif


                                                </div>

                                        </div>
                                        @else
                                        <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name float-left">{{auth()->user()->fname}} {{auth()->user()->lname}}</span>
                                                    <span class="direct-chat-timestamp float-right">{{$message->date}}</span>
                                                </div>
                                            <img class="direct-chat-img" src="{{asset('uploads/profiles/'.auth()->user()->profile_pic)}}" alt="message user image">
                                                <div class="direct-chat-text ">
                                                        {{$message->message}}
                                                        @if ($message->attachment)
                                                  <span class="pull-right"> <i class="fa fa-paperclip"></i> <a  href="{{ url('user/download/attachment', ['file' => $message->attachment] )}}"> <i class="fa fa-download"></i> </a>  </span>

                                                  @endif
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach


                                    </div>


                                </div>
                                <div class="card-footer">
                                <form action="{{ url('/user/send/message') }}" method="post">
                                        <div class="input-group">
                                            @csrf
                                            <input type="hidden" name="recipient" value={{$user->id}}>
                                            <input type="text" name="message" class="form-control" placeholder="Type Message....">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </section>





@endsection


