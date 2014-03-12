<!DOCTYPE html>
<html style="height:100%;">
<head>
    <title>Dream Builder Solutions :: 3D View - {{$houseDesign->name}}</title>
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
        
</head>
<body style="height:100%;">
    <div class="container">
        <div class="row" style="background: transparent;position: absolute;width: 407px;">
            <div class="col-md-10">
                <h3>{{$houseDesign->name}}</h3>
                <button id="screenshot" class="btn btn-success">Screenshot</button>
                <button id="toggleRoof" data-show="1" class="btn btn-warning">Hide Roof</button>
            </div>
        </div>
    </div>
    <div id="sketcher" style="height: 90%;"></div>
    <script type="text/javascript" src="{{URL::to('js/jquery-2.0.3.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/three.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/TrackballControls.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/Detector.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/dreambuilder.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/3d.dreambuilder.js')}}"></script>
    <script type="text/javascript">
    baseUrl = "{{URL::to('/')}}";
    DreamBuilder.ID = "{{$houseDesign->id}}";
    </script>
    <script type="text/javascript" src="{{URL::to('js/3d.js')}}"></script>
</body>
</html>
