{{--
What    :   Top navigation bar for user session i.e. after login
Author  :   Alvin Mukiibi
Date    :   6th-February-2019
 --}}
<nav class="main-header navbar navbar-expand bg-primary navbar-light border-bottom">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/dashboard')}}" class="nav-link">Home <i class="fa fa-home"></i></a>
        </li>
        @if (auth()->user()->user_role == "ulc")
        <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/register/firm')}}" class="nav-link">Register a Firm <i class="fa fa-plus-circle"></i>   </a>
        </li>
        @elseif (auth()->user()->user_role == "Associate")
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/associate/make/intake')}}" class="nav-link">New Intake <i class="fa fa-plus-circle"></i>   </a>
            </li>






        @endif
    </ul>
    <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a href="#!" class="nav-link">
                        {{auth()->user()->email}}
                    </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                          <i class="fa fa-comments-o"></i>
                          <span class="badge badge-danger navbar-badge" id="noOfUnreadTopNavin">
                          </span>
                        </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                      <i class="fa fa-tasks"></i>
                      <span class="badge badge-warning navbar-badge" id="noOfunCompletedTopNavin">
                      </span>
                    </a>
            </li>
        <li class="nav-item">
        <a href="{{ url('/logout')}}" class="nav-link">
                Logout <i class="fa fa-sign-out"></i>
            </a>
        </li>

    </ul>
    <script>
        window.addEventListener('load', () => {


            jQuery.ajax({
                url: "{{ url('api/user/count/unread/')  }}",
                method: "POST",
                data: {
                    user: {{ auth()->user()->id }}
                },
                success: res => {
                    if(res.noOfUnread > 0){
                        jQuery('#noOfUnreadTopNavin').html(res.noOfUnread)
                    }else{
                        jQuery('#noOfUnreadTopNavin').html(0)
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
                        jQuery('#noOfunCompletedTopNavin').html(res.noOfunCompleted);
                    }else{
                        jQuery('#noOfunCompletedTopNavin').html(0);
                    }
                }
            });

        })
    </script>
</nav>
