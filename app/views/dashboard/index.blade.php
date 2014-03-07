@extends('base')
	 
@section('head')
	<meta charset="UTF-8">
        <title>Dream Builder Solutions | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{URL::to('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{URL::to('css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="{{URL::to('css/morris/morris.css')}}" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="{{URL::to('css/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="{{URL::to('css/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="{{URL::to('css/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="{{URL::to('css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{URL::to('css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('header')
    @include('partials.header')
@stop

@section('body')
	@section('body_attr') class="skin-blue" @stop

    @yield('main_content')
@stop
	 
@section('footer')

@stop

@section('scripts')
	 <!-- jQuery 2.0.2 -->
        <script src="{{URL::to('js/jquery-2.0.3.min.js')}}"></script>
        <!-- jQuery UI 1.10.3 -->
        <!-- <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script> -->
        <!-- Bootstrap -->
        <script src="{{URL::to('js/bootstrap.min.js')}}" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="{{URL::to('js/raphael.js')}}"></script>
        <script src="{{URL::to('js/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="{{URL::to('js/plugins/sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="{{URL::to('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::to('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="{{URL::to('js/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{URL::to('js/plugins/jqueryKnob/jquery.knob.js')}}" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="{{URL::to('js/plugins/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{URL::to('js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="{{URL::to('js/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="{{URL::to('js/AdminLTE/app.js')}}" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{URL::to('js/AdminLTE/dashboard.js')}}" type="text/javascript"></script> 
@stop