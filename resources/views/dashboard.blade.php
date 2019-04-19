@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini" id="body" >


@endsection

@section('content')
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
         <div class="container-fluid">
           <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>Profile</h3>

                    <p>My Profile</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user"></i>
                  </div>
                  @if (auth()->user()->user_role=="administrator")
                <a href="{{ url('admin/profile')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>


                @elseif(auth()->user()->user_role=="ulc")
                <a href="{{ url('/profile')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                @else
                <a href="{{ url('/user/profile')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                @endif
            </div>
              </div>
              @if (auth()->user()->user_role === "ulc")
              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>Law Firms</h3>

                    <p>Manage Law Firms</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-legal"></i>
                  </div>
                <a href="{{ url('/register/firm')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              @endif
              @if (auth()->user()->user_role === "administrator")
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>Site Profile</h3>

                    <p>Manage Website Profile</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-globe fa-spin"></i>
                  </div>
                <a href="{{ url('/admin/manage/website')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning text-white">
                      <div class="inner">
                        <h3>Departments</h3>
                        <p>Manage Firm Departments</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-legal"></i>
                      </div>
                    <a href="{{ url('/admin/departments')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
              <div class="col-lg-3 col-6">
                    <div class="small-box text-white" style="background-color:#fb7a24">
                      <div class="inner">
                        <h3>User Roles</h3>
                        <p>Manage User Roles</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-delicious"></i>
                      </div>
                    <a href="{{ url('/admin/manage/roles')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background-color:#452b17">
                  <div class="inner">
                    <h3>Staff</h3>

                    <p>Manage Firm Staff</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                <a href="{{ url('/admin/manage/staff')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background-color:#090e12">
                  <div class="inner">
                    <h3>Case Types</h3>

                    <p>Manage Case Types</p>
                  </div>
                  <div class="icon text-white">
                    <i class="fa fa-briefcase"></i>
                  </div>
                <a href="{{ url('/admin/manage/casetypes')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              @endif
              @if (auth()->user()->firm_id !== null)
              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>Unread <span id="noOfUnread"></span></h3>

                    <p>My Messages   </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-envelope"></i>
                  </div>
                <a href="{{ url('/user/manage/mailbox')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>Tasks <span id="unCompleted"></span></h3>

                    <p>My Tasks</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-tasks"></i>
                  </div>
                <a href="{{ url('/user/manage/tasks')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              @if (auth()->user()->user_role=='Finance')
              <div class="col-lg-3 col-6">
                    <div class="small-box text-white" style="background-color:#452b17">
                      <div class="inner">
                        <h3>Payments</h3>

                        <p>Manage Case Payments</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-credit-card"></i>
                      </div>
                    <a href="{{ url('/finance/manage/payments')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3>Invoices</h3>

                            <p>Manage Case Invoices</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-money"></i>
                          </div>
                        <a href="{{ url('/finance/manage/invoices')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
              @endif

              <div class="col-lg-3 col-6">
                    <div class="small-box bg-success" >
                      <div class="inner">
                        <h3>Requisitions</h3>

                        <p>My Requisitions</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-money"></i>
                      </div>
                      @if (auth()->user()->user_role == 'Associate')
                      <a href="{{ url('/associate/manage/requisitions')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                      @endif
                      @if (auth()->user()->user_role == 'Partner')
                      <a href="{{ url('/partner/manage/requisitions')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                      @endif
                      @if (auth()->user()->user_role == 'Finance')
                      <a href="{{ url('/finance/manage/requisitions')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                      @endif


                </div>
                  </div>





              <section class="col-lg-7 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-clipboard mr-1">

                                </i>
                                Daily To Do List

                            </h3>
                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                  <i class="fa fa-minus"></i>
                                </button>

                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                              </div>

                        </div>
                        <div class="card-body" >

                            <ul class="todo-list">

                            </ul>
                        </div>
                        <div class="card-footer">


                              <div class="input-group">

                              <input type="text"  id="todo" maxlength="100" required class="form-control {{$errors->has('todo')?'is-invalid':''}}">
                              <input type="hidden" id="owner" value={{auth()->user()->id}}>
                              <input type="hidden" id="firm_id" value={{auth()->user()->firm_id}}>
                              <input type="date"  id="dueBy" class="form-control">
                                <span class="input-group-append">
                                  <button type="submit" id="addTodo" class="btn btn-outline-primary"> <i class="fa fa-plus"></i> Add Todo</button>
                                </span>
                              </div>

                          </div>
                    </div>


              </section>
              <section class="col-lg-5 connectedSortable">


                @if (auth()->user()->user_role == 'Associate')
                    <div class="card card-danger">
                        <div class="card-header no-border">
                            <h3 class="card-title">
                                <i class="fa fa-briefcase"></i> Cases

                            </h3>
                            <div class="card-tools">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                                              <i class="fa fa-bars"></i></button>
                                        <div class="dropdown-menu float-right" role="menu">
                                            <a href="#" class="dropdown-item" style="color:#fff">Clear events</a>
                                        </div>
                                    </div>
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                  <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="info-box">
                                            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-briefcase"></i></span>
                                            <div class="info-box-content">
                                                    <span class="info-box-text">Open Cases</span>
                                                    <span id="noOfOpenCases" class="info-box-number">

                                                    </span>
                                                </div>
                                        </div>

                                </div>
                                <div class="col-6">
                                        <div class="info-box">
                                                <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-gear"></i></span>
                                                <div class="info-box-content">
                                                        <span class="info-box-text">All Cases</span>
                                                        <span class="info-box-number">
                                                            10
                                                        </span>
                                                    </div>
                                            </div>

                                    </div>
                            </div>
                        </div>
                    </div>
                @endif

                    <div class="card collapsed-card bg-success-gradient">
                        <div class="card-header no-border">
                            <h3 class="card-title">
                                <i class="fa fa-calendar"></i> My Calendar
                            </h3>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                      <i class="fa fa-bars"></i></button>
                                    <div class="dropdown-menu float-right" role="menu">
                                      <a href="#" class="dropdown-item">Add new event</a>
                                      <a href="#" class="dropdown-item">Clear events</a>
                                      <div class="dropdown-divider"></div>
                                      <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                  </div>
                                  <button type="button" class="btn btn-success btn-sm" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-success btn-sm" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                  </button>
                            </div>
                        </div>
                        <div class="card-body  p-0">
                            <div id="calendar" style="width:100%"></div>
                        </div>
                    </div>
              </section>


              @endif



           </div>
         </div>
         <script>
            const addTodo = document.querySelector('#addTodo');
            addTodo.addEventListener('click', (event) => {
                event.preventDefault();
                     jQuery.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                         }
                     });
                     jQuery.ajax({
                         url: "{{ url('api/user/add/todo') }}",
                         method: "POST",
                         data: {
                            'todo': jQuery('#todo').val(),
                            'owner': jQuery('#owner').val(),
                            'dueBy': jQuery('#dueBy').val(),
                            'firm_id': jQuery('#firm_id').val()
                         },
                         success: res => {
                            const date = new Date(); //.format('m-d-Y')-obj.dueBy;
                            const  today = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
                            const date2 = new Date(today);
                            const date1 = new Date(res.dueBy);
                            const timeDiff = Math.abs(date2.getTime() - date1.getTime());
                            const remainingTime = Math.ceil(timeDiff / (1000 * 3600 * 24));
                            let flag = ''; let verbose = '';
                            if(remainingTime >= 5){
                                flag = 'success';
                                verbose = remainingTime + ' days';
                            }else if(remainingTime >= 2 && remainingTime < 5){
                                flag = 'info';
                                verbose = remainingTime + ' days';
                            }else if(remainingTime < 2 && remainingTime > 0){
                                flag = 'warning';
                                verbose = remainingTime + ' day';
                            }else if(remainingTime < 0){
                                flag='danger'
                                verbose = 'overdue';
                            }else{
                                flag='primary';
                                verbose = 'Today'
                            }
                           return jQuery('.todo-list').append('<li><span class="handle"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span><input type="checkbox" name="" ><span class="text">' + res.tagline + '</span><small class="pull-right badge badge-'+ flag + '"><i class="fa fa-clock-o"></i>  ' + ' ' + verbose + '  </small><div class="tools"><i class="fa fa-trash-o"></i></div></li>');

                         }
                     });
            });


            window.addEventListener('load', () => {
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('api/user/todos/getTodos/')  }}",
                    method: "POST",
                    data: {
                        owner: jQuery('#owner').val()
                    },
                    success: res => {
                        res.map(obj => {
                            const date = new Date(); //.format('m-d-Y')-obj.dueBy;
                            const  today = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
                            const date2 = new Date(today);
                            const date1 = new Date(obj.dueBy);
                            const timeDiff = Math.abs(date2.getTime() - date1.getTime());
                            const remainingTime = Math.ceil(timeDiff / (1000 * 3600 * 24));
                            let flag = ''; let verbose = '';
                            if(remainingTime >= 5){
                                flag = 'success';
                                verbose = remainingTime + ' days';
                            }else if(remainingTime >= 2 && remainingTime < 5){
                                flag = 'info';
                                verbose = remainingTime + ' days';
                            }else if(remainingTime < 2 && remainingTime > 0){
                                flag = 'warning';
                                verbose = remainingTime + ' day';
                            }else if(remainingTime < 0){
                                flag='danger'
                                verbose = 'overdue';
                            }else{
                                flag='primary';
                                verbose = 'Today'
                            }
                            //const deleteUrl = "{{ url('api/user/delete/todo/"+7+"') }}"

                            return jQuery('.todo-list').append('<li><span class="handle"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span><input type="checkbox" name="" ><span class="text">' + obj.tagline + '</span><small class=" pull-right badge badge-'+ flag + '"><i class="fa fa-clock-o"></i>' + ' ' + verbose + '  </small><div class="tools"> <i class="fa fa-trash-o"></i></div></li>');
                        })
                    }
                });
                jQuery.ajax({
                    url: "{{ url('api/user/count/unread/')  }}",
                    method: "POST",
                    data: {
                        user: {{ auth()->user()->id }}
                    },
                    success: res => {
                        if(res.noOfUnread > 0){
                            jQuery('#noOfUnread').html(res.noOfUnread);

                        }else{
                            jQuery('#noOfUnread').html(0);

                        }

                    }
                });
                jQuery.ajax({
                    url: "{{ url('/api/user/count/tasks/')  }}",
                    method: "POST",
                    data: {
                        user: {{ auth()->user()->id }}
                    },
                    success: res => {
                        if(res.noOfunCompleted > 0){
                            jQuery('#unCompleted').html(res.noOfunCompleted);

                        }else{
                            jQuery('#unCompleted').html(0);

                        }

                    }
                });

                jQuery.ajax({
                    url: "{{ url('api/associate/count/opencases/')  }}",
                    method: "POST",
                    data: {
                        id: {{ auth()->user()->id }}
                    },
                    success: res => {
                        if(res.count > 0){
                            jQuery('#noOfOpenCases').html(res.count);

                        }else{
                            jQuery('#noOfOpenCases').html(0);

                        }

                    }
                });





            });
        </script>
      </section>


@endsection
