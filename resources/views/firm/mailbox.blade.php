@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">My Mailbox</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Mailbox</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-3">
            <button type="button" data-toggle="modal"  data-target="#composeMessage"class="btn btn-outline-primary btn-block"> <i class="fa fa-envelope"></i> Compose </button><br/>



        </div>
        <div class="col-md-9">
                @include('includes.messages')
            <div class="card card-primary card-outline">

                <div class="card-header">
                <h3 class="card-title">{{ __('My conversations') }}</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped" id="example2" >
                            <tbody>
                                @foreach ($conversations as $conversation)
                                <tr>

                                <td class="mailbox-name">


                                    <a href={{ url('user/make/chat',['msg' => $conversation['conv']->id , 'user' => $conversation['otherUser'][0]->id]) }} class="btn btn-outline-success btn-sm"> <b> {{$conversation['otherUser'][0]->fname}} {{$conversation['otherUser'][0]->lname}}
                                        </b>
                                    </a>

                            </td>
                                <td class="mailbox-subject"><b>{{$conversation['msg'][0]->message}}</b></td>
                                <td class="mailbox-attachment">
                                    @if ($conversation['msg'][0]->attachment !== null)
                                <i class="fa fa-paperclip"></i><a href="{{ url('user/download/attachment', ['file' => $conversation['msg'][0]->attachment] )}}"> <i class="fa fa-download"></i> </a>
                                    @endif


                                </td>
                                        <td class="mailbox-date">{{ date('d-M-Y H:i', strtotime($conversation['msg'][0]->date)) }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="composeMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                <form action="{{ url('/user/send/message')}}" method="post" enctype="multipart/form-data" >
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Message Composer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <div class="form-group row">
                    <label for="recipient"class="col-sm-2 col-form-label">To: </label>
                    <div class="col-sm-10">
                <select name="recipient" required class="form-control select2 {{$errors->has('recipient')?'is-invalid':''}}" style="width: 100%;">
                @foreach ($recipients as $recipient)
                    <option value={{$recipient->id}}>{{$recipient->fname}} {{$recipient->lname}}</option>
                @endforeach
                </select></div>
                </div>

                <div class="form-group">
                    <textarea name="message" required rows="5"  placeholder="Your Message Here.." cols="10" id="compose-textarea" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input {{$errors->has('attachment')?'is-invalid':''}}" name="attachment">
                          <label class="custom-file-label" > <i class="fa fa-paperclip"></i> Attachment</label>

                        </div>

                </div>
                <p class="help-block">Max. 32MB</p>


            </div>
            <div class="modal-footer">
                @csrf
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
          </div>
        </div>
      </div>




    </section>

@endsection
