@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Case Types</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Case Types</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                  <div class="card card-primary">


                          @if (session("casetype"))
                          <form action="{{url('/admin/edit/casetype')}}" method="post">
                              @csrf
                              <div class="card-header">
                                  <h3 class="card-title">Edit Case Type</h3>
                              </div>
                              <div class="card-body">
                                  @include('includes.messages')
                                      <div class="form-group">
                                              <label for="name">Case Type</label>
                                      <input type="text"  required class="form-control {{$errors->has('casetype')?'is-invalid':''}}" name="casetype" value="{{session('casetype')->casetype}}" >
                                  </div>
                                  <div class="form-group">
                                          <label for="name"><Acronym></label>
                                            <input type="text"  maxlength="4" required class="form-control {{$errors->has('acronym')?'is-invalid':''}}" name="acronym" value="{{session('casetype')->acronym}}" >

                                      <input type="hidden" name="id" value={{session('casetype')->id}}>
                              </div>
                              </div>
                              <div class="card-footer">
                                      <button type="submit" class="btn btn-outline-success btn-flat"> <i class="fa fa-save"></i > Update</button>
                                    </div>
                                  </form>
                          @else
                          <form action="{{url('/admin/add/casetype')}}" method="post">
                              @csrf
                              <div class="card-header">
                                  <h3 class="card-title">Add Case Type</h3>
                              </div>
                              <div class="card-body">
                                  @include('includes.messages')
                                      <div class="form-group">
                                              <label for="name">Case Type</label>
                                              <input type="text" placeholder="E.g. Child Abuse" required class="form-control" name="casetype"  placeholder="Role Name">
                                  </div>
                                  <div class="form-group">
                                          <label for="name">Description</label>
                                          <input type="text" placeholder="E.g. CHB"  maxlength="4" required class="form-control {{$errors->has('acronym')?'is-invalid':''}}" name="acronym"  >

                                        </div>
                              </div>
                              <div class="card-footer">
                                      <button type="submit" class="btn btn-outline-primary btn-flat pull-right"> <i class="fa fa-save"></i > Save</button>
                                    </div>
                                  </form>



                          @endif


                  </div>

                </div>
                <div class="col-md-6">
                  <div class="card card-info">
                      <div class="card-header">
                          <h3 class="card-title">
                              Case Types
                          </h3>
                      </div>
                      <div class="card-body table-responsive">
                          <table class="table table-hover ">
                              <thead>
                                      <tr>

                                              <th style="width: 180px">Case Type</th>
                                              <th >Acronym</th>
                                              <th></th>
                                          </tr>
                              </thead>

                              <tbody>
                                      @foreach ($casetypes as $casetype)
                                      <tr>
                                              <td>{{$casetype->casetype}}</td>
                                              <td>
                                                      {{$casetype->acronym}}
                                              </td>
                                              <td>
                                                 <a href="{{url('/admin/manage/casetypes',['casetype' => $casetype->id])}}" title="Edit" class="btn btn-outline-primary btn-sm btn-flat"> <i class="fa fa-pencil"></i>  </a>
                                              </td>
                                          </tr>
                                      @endforeach

                              </tbody>

                          </table>
                          {{ $casetypes->links() }}
                      </div>

                  </div>

                </div>


            </div>
        </div>

    </section>

@endsection
