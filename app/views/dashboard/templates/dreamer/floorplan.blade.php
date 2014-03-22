<!DOCTYPE html>
<html>
<head>
	<title>Dream Builder Solutions :: Floor Plan View</title>
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
    <style type="text/css" media="screen">
    	#floorplan, #floorplan img{ 
    		text-align: center;
    		margin:0 auto; 
    	}	
    </style>
</head>
<body>
<div class="container" style="margin-top:10px;">
	<button onclick="window.close()" class="btn btn-warning" back>Back</button>&nbsp;&nbsp;&nbsp;&nbsp;
	<div class="btn-group">
	<button class="btn btn-default" print>Print</button>
	<a class="btn btn-success" download draggable="true">Download</a>
</div>
</div>
<br/><br/>
<div id="floorplan-svg"></div>
<canvas id="floorplan-canvas"></canvas>
<div id="floorplan"></div>

 <script type="text/javascript" src="{{URL::to('js/jquery-2.0.3.min.js')}}"></script>
<script type="text/javascript">
        window.baseUrl = $('[base-url]').attr('base-url');
    </script>
<script type="text/javascript" src="{{URL::to('js/raphael.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/StackBlur.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/rgbcolor.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/canvg.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/floorplan.js')}}"></script>
 
<script type="text/javascript">
	$(document).ready(function(){
		$data = {{json_encode(json_decode($house, true))}};
		$house = JSON.parse($data.properties);
		console.log($data);
		var f = new Floorplan({
				width: parseInt($house.width),
				length: parseInt($house.length),
				name: $data.name,
			});
		f.createFloor();
		if(typeof $house.rooms !='undefined'){
			$.each($house.rooms, function(i, room){
				f.createRoom({
					x: parseInt(room.x),
					y: parseInt(room.y),
					width: parseInt(room.width),
					length: parseInt(room.length),
					name: room.name,
					door: room.door
				});
			});	
		}
		if(typeof $house.doors !='undefined'){
			$.each($house.doors, function(i, door){
				f.createDoor({
					where: door.where,
					x: parseInt(door.x),
					y: parseInt(door.y),
					width: parseInt(door.width),
					length: parseInt(door.length),
					num: parseInt(door.num)
				});
			});
		}
		 
		if(typeof $house.windows != 'undefined'){
			$.each($house.windows, function(i, win){
				f.createWindow({
					where: win.where,
					x: parseInt(win.x),
					y: parseInt(win.y),
					width: parseInt(win.width),
					length: parseInt(win.length)
				});
			});
		}		

		if(typeof $house.walls != 'undefined') {
			$.each($house.walls, function (i, wall) {
				f.createWall({
					orientation: wall.orientation,
					x: parseFloat(wall.x),
					y: parseFloat(wall.y),
					width: parseFloat(wall.width),
					thickness: parseFloat(wall.thickness)
				});
			});
		} 
		
		convertToImage();

		$(document).on('click','[print]', function(){
			console.log('printing floorplan');
			img = $('img').attr('src');
			printAble = '<html><head>'
						+'<title>'+{{'"'.str_replace("'","\\'",$house->name).'"'}}+' - Floor Plan View</title>'
						+'<script type="text/javascript" src="{{URL::to("js/jquery-2.0.3.min.js")}}"></scr'+'ipt>'
						+'</head>'
						+'<body onload="printa();">'
						+'<center><img src="'+img+'" style="max-width:1200px;"/></center>'
						+'<script type="text/javascript">\n'
						+'function printa(){'
						+'$("img").css({'
								+"'max-width': '1200px'"
							+'});'
							+'window.print();}\n'
						+'</scr'+'ipt>'+'</body><html>';
			link = 'floorplan-'+{{'"'.$house->id.'_'.date('y-m-d').'.png"'}};
			print = window.open(link, '_new');
			print.document.open();
			print.document.write(printAble);
			print.document.close();
		});
 		
 		img = $('img');
		$('[download]').attr('download','floorplan-'+{{'"'.$house->id.'_'.date('y-m-d').'.png"'}});
		url = img.attr('src').replace('image/png','image/octet-stream');
		$('[download]').attr('href',url); 

		$('img').css({
			'max-width': $(window).width()+'px'
		});
	});
</script>
</body>
</html>