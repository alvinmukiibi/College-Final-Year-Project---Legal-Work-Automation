<aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="index3.html" class="brand-link">
          <img src="{{asset('\dist\img\AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">L-WAT</span>
        </a>


        <div class="sidebar">

          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{asset('\dist\img\user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{auth()->user()->fname}} {{auth()->user()->lname}}</a>
            </div>
          </div>
          <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <li class="nav-item">
                  <a href="{{ url('/profile')}}" class="nav-link">
                      <i class="nav-icon fa fa-user"></i>
                      <p>
                        My Profile

                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                  <a href="{{ url('/dashboard')}}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                          Dashboard

                        </p>
                      </a>
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
                    <a href="{{ url('/firm/manage/website')}}" class="nav-link">
                        <i class="nav-icon fa fa-globe"></i>
                        <p>
                          Website Profile

                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/firm/manage/departments')}}" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                              Departments
                            </p>
                          </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/firm/manage/staff')}}" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                  Staff
                                </p>
                              </a>
                            </li>
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
                                  <a href="{{ url('/firm/view/messages')}}" class="nav-link">
                                      <i class="fa fa-pencil nav-icon"></i>
                                      <p>Compose Message </p>
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="{{ url('/firm/view/messages')}}" class="nav-link">
                                        <i class="fa fa-inbox nav-icon"></i>
                                        <p>Inbox <span class="right badge badge-danger">5</span></p>
                                      </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/firm/view/messages')}}" class="nav-link">
                                            <i class="fa fa-send-o nav-icon"></i>
                                            <p>Sent</p>
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
                                  <a href="{{ url('/register/firm')}}" class="nav-link">
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
                                <a href="{{ url('/firm/manage/staff')}}" class="nav-link">
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
