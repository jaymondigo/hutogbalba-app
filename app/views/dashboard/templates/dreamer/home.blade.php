@extends('dashboard.index')
    
@section('main_content')
            <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            @include('partials.sidebar')

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>My Dream Houses</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content"> 
                    <div class="row">
                    @foreach ($dreams as $dream) 
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h2>
                                        {{$dream->name}}
                                    </h4>
                                     <small>{{date('F d, Y', strtotime($dream->created_at))}}</small>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                     
                                </div>
                                @if(count($dream->pictures)>0)
                                <a href="#view-dialog" data-id="{{$dream->id}}" view-dream class="small-box-footer" data-toggle="modal">
                                    View Dream House <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                @endif
                            </div>
                        </div><!-- ./col -->
                    @endforeach
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- modal -->
        <div class="modal fade" id="view-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog" dream-content style="width:100%;height:100%;background:white;margin-top:0px;">
               
            </div>
        </div>
@stop

@section('other_scripts') 
    <script type="text/javascript">
        window.baseUrl = $('[base-url]').attr('base-url');
    </script>
    <script src="{{URL::to('js/dreams-page.custom.js')}}" type="text/javascript"></script>
     
@stop