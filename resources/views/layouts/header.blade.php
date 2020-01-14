
<header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            
              <a href="{{route('dashboard')}}" class="logo"><img src="{{asset('img/Logo.png')}}"></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        
                        
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            
                            <span class="username" style="text-transform: capitalize;">{{Auth::user()->admin_name}}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout dropdown-menu-right">

                            <div class="log-arrow-up"></div>
                            <li><a href="{{route('settings')}}"><i class="fa fa-cog"></i>Account Settings</a></li>
                           <!-- <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-bell-o"></i> FAQ</a></li>
                             -->
                              <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-key"></i> Log Out</a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                                    </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>