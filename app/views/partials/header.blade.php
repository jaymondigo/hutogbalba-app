<!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="{{URL::to('/')}}" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Dream Builder<sup>&nbsp;Beta</sup>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{Auth::user()->fullname}}<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{URL::to(Auth::user()->avatar->url('medium'))}}" class="img-circle" alt="User Image" />
                                    <p>
                                        {{Auth::user()->fullname}} - {{Auth::user()->type}}
                                        <small>Member since {{date('F Y', strtotime(Auth::user()->created_at))}}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a class="btn btn-default btn-flat" href="{{URL::to('home/profile')}}">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{{ (Confide::checkAction('UserController@logout')) ?: 'signout' }}}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>