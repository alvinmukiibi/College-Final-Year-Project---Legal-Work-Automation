@extends('layouts.mainlayout')

@section('body_tag')
<body class="hold-transition sidebar-mini">

@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Task Manager</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tasks</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @include('includes.messages')
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Assign Task
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/user/assign/task') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="dept">Deparment</label>
                                    <select required id="department"  class="form-control {{ $errors->has('department')?'is-invalid':'' }}">
                                            <option value="">-- Select Department</option>
                                            @foreach ($departments as $department)
                                                 <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group col-md-6">
                                        <label for="dept">Assigned To</label>
                                        <select required id="assignee" name="assignee"  class="form-control {{ $errors->has('assignee')?'is-invalid':'' }}">
                                            <option value="">-- Select Associate</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-row">
                                    <label for="deadline">Deadline</label>
                                    <div class="input-group date form_datetime col-md-12"  data-date-format="dd MM yyyy - HH:ii" data-link-field="deadline">
                                            <input class="form-control" size="16" type="text"  value="" readonly>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>
                                        <input type="hidden" required name="deadline" id="deadline" /><br/>

                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="task">Task</label>
                                    <textarea required name="task" cols="5" rows="5" placeholder="E.g. Draft document for client.." class="form-control"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-flat pull-right"> <b>Assign Task</b> </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">
                           Tasks I Assigned
                       </h3>
                   </div>
                   <div class="card-body">
                        <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Task</th>
                                        <th>Assignee</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasksIAssigned as $task)
                                        <tr>
                                            <td> {{ date('d-M-Y', strtotime($task->created_at)) }} </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="Task Description" data-content="{{ $task->task }}"> <b>View <i class="fa fa-eye"></i> </b> </button>
                                            </td>
                                            <td> {{ $task->fname }}  {{ $task->lname }} </td>
                                            <td> {{ date('d-M-Y H:i', strtotime($task->deadline)) }} </td>
                                            <td>
                                                @if ($task->completion_status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                                @if ($task->completion_status == 'completed')
                                                    <span class="badge badge-success">Completed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                   </div>
               </div>
               <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Tasks Assigned To Me
                        </h3>
                    </div>
                    <div class="card-body">
                         <table class="table table-hover">
                                 <thead>
                                     <tr>
                                         <th>Task</th>
                                         <th>Assigned By</th>
                                         <th>Deadline</th>
                                         <th>Status</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($tasksAssignedToMe as $task)
                                         <tr>
                                                <td>
                                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="Task Description" data-content="{{ $task->task }}"> <b>View <i class="fa fa-eye"></i> </b> </button>
                                                    </td>
                                             <td>{{ $task->fname }} {{ $task->lname }}</td>
                                             <td>{{ date('d-M-Y H:i', strtotime($task->deadline)) }}</td>
                                             <td>
                                                    @if ($task->completion_status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @endif
                                                    @if ($task->completion_status == 'completed')
                                                        <span class="badge badge-success">Completed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($task->completion_status == 'pending')
                                                    <form action="{{ url('/user/complete/task') }}" method="post">
                                                        <input type="hidden" name="taskID" value="{{ $task->id }}">
                                                    @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-success">mark as complete</button>
                                                    </form>
                                                    @endif


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
    <script>
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
