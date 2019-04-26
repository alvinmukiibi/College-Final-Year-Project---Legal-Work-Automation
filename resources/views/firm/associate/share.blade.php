@extends('layouts.mainlayout')

@section('body_tag')
    <body class="hold-transition sidebar-mini">
@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Case Sharer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Share</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
            <div class="container-fluid">
                @include('includes.messages')
                <div class="row">
                    <form action="{{ url('/associate/submit/share') }}" method="post">
                    <div class="col-12">
                            <div class="card card-primary card-outline">
                                    <div class="card-header">
                                      <h3 class="card-title">Sharing Type</h3>
                                    </div>
                                    <div class="card-body">
                                            <div class="form-group row">
                                                    <label for="case_number" class="col-sm-6 col-form-label">Choose How You Want To Share</label>
                                                    <div class="col-sm-6">
                                                        <select  required name="sharingType" id="sharingType" class="form-control {{ $errors->has('sharingType')?'is-invalid':'' }}">
                                                            <option  value="refer">Share</option>
                                                            <option value="assign">Assign</option>
                                                        </select>
                                                    </div>
                                            </div>
                                    </div>
                                  </div>
                            <div class="callout callout-info">
                                    <h5><i class="fa fa-info"></i> IMPORTANT NOTE:</h5>
                                     <p id="note"> Sharing a case with another lawyer means that you shall both be working on the case concurrently. The other lawyer will be able to see all the case information and all the updates you make on the case and you shall be able to see their activity on the case too </p>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Share Case
                                    </h3>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group row">
                                                        <label for="case_number" class="col-sm-4 col-form-label">Case Number</label>
                                                        <div class="col-sm-8">
                                                            <input type="text"  readonly class="form-control" value="{{ $case }}"  >
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group row">
                                                        <label for="client" class="col-sm-4 col-form-label">Client Name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text"  readonly class="form-control" value="{{ $client }}"  >
                                                        </div>
                                                </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group row">
                                                        <label for="department" class="col-sm-4 col-form-label">Department </label>
                                                        <div class="col-sm-8">
                                                               <select required id="department" name="department"  class="form-control {{ $errors->has('department')?'is-invalid':'' }}">
                                                                   <option value="">-- Select Department</option>
                                                                   @foreach ($departments as $department)
                                                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                                   @endforeach
                                                               </select>
                                                        </div>

                                                </div>


                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group row">
                                                        <label for="assignee" class="col-sm-4 col-form-label">Shared To </label>
                                                        <div class="col-sm-8">
                                                               <select required id="assignee" name="assignee"  class="form-control {{ $errors->has('assignee')?'is-invalid':'' }}">
                                                                   <option value="">-- Select Associate</option>
                                                               </select>
                                                        </div>

                                                </div>

                                        </div>

                                    </div>
                                    @csrf
                                    <input type="hidden" name="caseID" class="form-control" value="{{ $case }}"  >
                                    <button type="submit" class="btn btn-outline-success pull-right"> <i class="fa fa-arrow-circle-right"></i> <b id="submit" >REFER CASE</b></button>

                                </div>
                            </div>

                    </div>
                </form>

                </div>
            </div>
            <script>
                const sharingType = document.querySelector('#sharingType');
                sharingType.addEventListener('change', () => {
                    const shType = jQuery('#sharingType').val();
                    if(shType === "refer"){


                        jQuery('#note').html('Sharing a case to another lawyer means that you shall both be working on the case concurrently. The other lawyer will be able to see all the case information and all the updates you make on the case and you shall be able to see their activity on the case too');
                        jQuery('#submit').html('REFER CASE');
                    }else{

                        jQuery('#note').html('Assigning a case to another lawyer means that you are transfering the case completely to them, although you remain the original owner of the case. You wont be able to see activity of the other lawyer on the case and you can`t work with the case');
                        jQuery('#submit').html('ASSIGN CASE');
                    }
                });
                const dept = document.querySelector('#department');
                dept.addEventListener('change', (event) => {
                    const department = jQuery('#department').val();
                    if(department !== null && department !== ''){
                        // make an ajax request to fetch the users in that department
                        jQuery.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                            }
                        });
                        jQuery.ajax({
                            url: "{{ url('api/associate/fetch/departmenters') }}",
                            method: "POST",
                            data: {
                               'id': department,
                            },
                            success: res => {
                                // clear past users from DOM
                                jQuery('#assignee').empty();
                                res.users.map(obj => {
                                    jQuery('#assignee').append('<option value="' + obj.id + '">' + obj.fname + " " + obj.lname + '</option>');
                                });
                            }
                        });


                    }else{
                        jQuery('#assignee').empty();
                    }
                })
            </script>
    </section>

@endsection
