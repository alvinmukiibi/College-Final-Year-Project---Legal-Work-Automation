<aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="index3.html" class="brand-link">
          <img src="{{asset('dist/img/lwat_logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">L-WAT</span>
        </a>


        <div class="sidebar">

          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{asset('uploads/profiles/'.auth()->user()->profile_pic)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{auth()->user()->fname}} {{auth()->user()->lname}}</a>
            </div>
          </div>
          <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                                <a href="{{ url('/dashboard')}}" class="nav-link">
                                      <i class="nav-icon fa fa-home"></i>
                                      <p>
                                        Dashboard

                                      </p>
                                    </a>
                                  </li>
                  <li class="nav-item">
                      @if (auth()->user()->user_role == "administrator")
                      <a href="{{ url('/admin/profile')}}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                          My Profile

                        </p>
                      </a>
                     @else
                      <a href="{{ url('/user/profile')}}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                          My Profile

                        </p>
                      </a>
                      @endif



                  </li>

                  @if(auth()->user()->user_role === "ulc")
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-pie-chart"></i>
                        <p>
                              Law Firms
                          <i class="right fa fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ url('/register/firm')}}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Registered Firms <span class="right badge badge-danger">50</span></p>
                          </a>
                        </li>

                      </ul>
                    </li>
                  @endif
                  @if (auth()->user()->user_role === "administrator")
                  <li class="nav-item">
                    <a href="{{ url('/admin/manage/website')}}" class="nav-link">
                        <i class="nav-icon fa fa-globe"></i>
                        <p>
                          Website Profile

                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/departments')}}" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                              Departments
                            </p>
                          </a>
                        </li>
                        <li class="nav-item">
                                <a href="{{ url('/admin/manage/roles')}}" class="nav-link">
                                    <i class="nav-icon fa fa-delicious"></i>
                                    <p>
                                      User Roles
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/manage/casetypes')}}" class="nav-link">
                                        <i class="nav-icon fa fa-briefcase"></i>
                                        <p>
                                          Case Types
                                        </p>
                                      </a>
                                    </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/manage/staff')}}" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                  Staff
                                </p>
                              </a>
                            </li>


                  @endif
                  @if (auth()->user()->user_role == "Associate" || auth()->user()->user_role == "Partner" )
                  <li class="nav-item">
                    <a href="{{ url('/associate/make/intake')}}" class="nav-link">
                          <i class="nav-icon fa fa-meh-o"></i>
                          <p>
                            New Intake

                          </p>
                        </a>
                      </li>
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-legal"></i>
                      <p>
                            Cases
                        <i class="right fa fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                      <a href="{{ url('/associate/view/intakes')}}" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>Open Cases</p>
                        </a>
                      </li>


                    </ul>
                  </li>
                  @endif
                  @if (auth()->user()->firm_id !== null)
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-envelope"></i>
                      <p>
                            Messages
                        <i class="right fa fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      <li class="nav-item">
                        <a href="{{ url('/user/manage/mailbox')}}" class="nav-link">
                            <i class="fa fa-inbox nav-icon"></i>
                            <p>My Mailbox </p>
                          </a>
                        </li>


                    </ul>
                  </li>
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-tasks"></i>
                      <p>
                            Tasks
                        <i class="right fa fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                      <a href="{{ url('/user/manage/tasks')}}" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>Assign Task </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/register/firm')}}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>My Tasks <span class="right badge badge-danger">50</span></p>
                          </a>
                        </li>

                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/user/manage/calendar')}}" class="nav-link">
                        <i class="nav-icon fa fa-calendar"></i>
                        <p>
                          My Calendar
                        </p>
                      </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-money"></i>
                          <p>
                                Requisitions
                            <i class="right fa fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                          <a href="{{ url('/register/firm')}}" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Make Requisition</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ url('/register/firm')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>View Requisitions <span class="right badge badge-danger">50</span></p>
                              </a>
                            </li>

                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-clock-o"></i>
                          <p>
                                Meetings
                            <i class="right fa fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                          <a href="{{url('user/manage/meetings')}}" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>New Meeting</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ url('/register/firm')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>All Meetings <span class="right badge badge-danger">50</span></p>
                              </a>
                            </li>

                        </ul>
                      </li>

                  @endif



























                  {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-tree"></i>
                      <p>
                            Link
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/UI/general.html" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>Sub Link</p>
                        </a>
                      </li>

                    </ul>
                  </li> --}}


                  {{-- <li class="nav-header">Link</li> --}}
                  </ul>
              </nav>
            </div>

        </aside>
