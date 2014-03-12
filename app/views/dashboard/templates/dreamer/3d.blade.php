<!DOCTYPE html>
<html style="height:100%;">
<head>
    <title>Dream Builder Solutions :: 3D View</title>
</head>
<body style="height:100%;">
    <button id="screenshot">Screenshot</button>
    <button id="toggleRoof" data-show="1">Hide Roof</button>
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
