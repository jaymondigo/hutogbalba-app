<!DOCTYPE html>
<html style="height:100%;">
<head>
    <title>Dream Builder Solutions :: 3D View - {{$houseDesign->name}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> 
</head>
<body style="height:100%;">
    <div class="container">
        <div class="row" style="background: transparent;position: absolute;width: 407px;">
            <div class="col-md-10">
                <h3>{{$houseDesign->name}}</h3>
                <button onclick="window.close()" class="btn btn-warning">Back</button>&nbsp;&nbsp;&nbsp;
                <button id="screenshot" class="btn btn-success">Screenshot</button>
                <button id="toggleRoof" data-show="1" class="btn btn-default">Hide Roof</button>
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
    <script type="text/javascript" src="{{URL::to('js/canvas-to-blob.min.js')}}"></script>
</body>
</html>
