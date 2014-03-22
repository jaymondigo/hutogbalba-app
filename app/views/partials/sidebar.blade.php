<!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{URL::to(Auth::user()->avatar->url('medium'))}}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, {{Auth::user()->firstname}}</p>

                            <a href="#edit-profile-dialog" data-toggle="modal"><i class="fa fa-circle text-success"></i> {{Auth::user()->online_status}}</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <!-- <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form> -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu"> 
                        @foreach (DbsHelper::navs(Auth::user()->type, 'left') as $nav)
                            <li class="{{isset($nav['active'])&&$nav['active'] ? 'active' :''}}">
                                <a href="{{$nav['link']}}">
                                    <i class="{{$nav['icon']}}"></i> <span>{{$nav['label']}}</span>
                                </a>
                            </li>
                        @endforeach 

                        @if(strpos($_SERVER['REQUEST_URI'], 'dreams'))
                            <li>
                                <a>
                                    <i class="fa fa-crosshairs"></i> <span>Legend</span>
                                    <div class="form-group">
                                        <label>Door</label><br >
                                        <img src="{{URL::to('img/door-legend.png')}}" width="150px" />
                                    </div>
                                    <div class="form-group">
                                        <label>Room</label><br />
                                        <img src="{{URL::to('img/room-legend.png')}}" width="150px" />
                                    </div>
                                    <div class="form-group">
                                        <label>Window</label><br />
                                        <img src="{{URL::to('img/window-legend.png')}}" width="150px" />
                                    </div>
                                    <div class="form-group">
                                        <label>Wall</label><br />
                                        <img src="{{URL::to('img/wall-legend.png')}}" width="150px" />
                                    </div> 
                                </a>
                            </li>
                        @endif
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>