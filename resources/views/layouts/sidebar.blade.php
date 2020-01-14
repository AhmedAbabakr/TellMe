
<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class=" {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{route('dashboard')}}">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <!--<li class="sub-menu">
                      <a href="javascript:;" class="<%= propBean.getTickets() %>">
                          <i class="fa fa-laptop"></i>
                          <span>Tickets</span>
                      </a>
                      <ul class="sub">
                          <li class="<%= propBean.getTlive() %>"><a  href="#">Live Tickets</a></li>
                          <li class="<%= propBean.getThistory() %>"><a  href="#">Tickets History</a></li>
                      </ul>
                  </li>-->
                  @can('roleview', auth()->user()->type->roles->admintype_view)
                    <li ><a class="{{ Request::routeIs('admin_roles.index') ? 'active' : '' }} {{ Request::routeIs('admin_roles.create') ? 'active' : '' }}{{ Request::routeIs('manage.role') ? 'active' : '' }}  {{ Request::routeIs('admin_roles.edit') ? 'active' : '' }} " href="{{route('admin_roles.index')}} "><i class="fa  fa-gear (alias)"></i><span>Manage Roles</span></a></li>
                   @endcan
                   @can('roleview', auth()->user()->type->roles->admins_user_view)
                    <li ><a class="{{ Request::routeIs('admins_user.index') ? 'active' : '' }} {{ Request::routeIs('admins_user.create') ? 'active' : '' }}  {{ Request::routeIs('admins_user.edit') ? 'active' : '' }}" href="{{route('admins_user.index')}}"> <i class="fa  fa-group (alias)"></i><span>Admins Users</span></a></li>
                   @endcan
                   @can('roleview', auth()->user()->type->roles->company_view)
                    <li><a class="{{ Request::routeIs('company.index') ? 'active' : '' }} {{ Request::routeIs('company.create') ? 'active' : '' }}  {{ Request::routeIs('company.edit') ? 'active' : '' }}  " href="{{route('company.index')}}"><i class="fa fa-building-o"></i>
                          <span>Companies</span></a></li>
                  @endcan
                   @can('roleview', auth()->user()->type->roles->company_branch_view)
                   <li><a class="{{ Request::routeIs('branch.index') ? 'active' : '' }} {{ Request::routeIs('branch.create') ? 'active' : '' }}  {{ Request::routeIs('branch.edit') ? 'active' : '' }} {{ Request::routeIs('branch.assign.index') ? 'active' : '' }} {{ Request::routeIs('branch.assign.create') ? 'active' : '' }} " href="{{route('branch.index')}}"><i class="fa fa-bookmark"></i>
                          <span>Branches</span></a></a></li>
                    @endcan
                   @can('roleview', auth()->user()->type->roles->company_user_view)
                   <li >
                          <a class="{{ Request::routeIs('users.index') ? 'active' : '' }} {{ Request::routeIs('users.create') ? 'active' : '' }}  {{ Request::routeIs('users.edit') ? 'active' : '' }}" href="{{route('users.index')}}"><i class="fa   fa-user"></i> <span>Company Users</span></a></li>
                    @endcan
                   @can('roleview', auth()->user()->type->roles->question_view)
                    <li ><a class="{{ Request::routeIs('question.index') ? 'active' : '' }} {{ Request::routeIs('question.create') ? 'active' : '' }}  {{ Request::routeIs('question.edit') ? 'active' : '' }}{{ Request::routeIs('options.index') ? 'active' : '' }} {{ Request::routeIs('options.create') ? 'active' : '' }} " href="{{route('question.index')}}"> <i class="fa fa-question-circle">
                      
                        </i>
                         <span>Questions Bank</span>
                       </a>
                     </li>
                     @endcan
                     @can('roleview', auth()->user()->type->roles->customer_review_view)
                        <li><a class="{{ Request::routeIs('customers.index') ? 'active' : '' }} {{ Request::routeIs('customers.create') ? 'active' : '' }}  {{ Request::routeIs('customers.edit') ? 'active' : '' }} {{ Request::routeIs('customers.show') ? 'active' : '' }} " href="{{route('customers.index')}}"><i class="fa fa-comments"></i>
                              <span>Customers Reviews</span></a></li>
                      @endcan
                      {{-- <li>
                                                                      <a class=" {{ Request::routeIs('app.setting') ? 'active' : '' }}" href="{{route('app.setting')}}">
                                                                          <i class="fa fa-cogs"></i>
                                                                          <span>Application Settings</span>
                                                                      </a>
                                                                  </li>--}}

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>