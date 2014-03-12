(function () {

	var currentSet; //will be set upon right-clicking the element

	var $cm = $('#contextMenu'); //house elements contextmenu

	var contextCallback = function (e) {
		currentSet = set;
		//show the contextmenu
		$cm.css({
			display: 'block',
			left: e.pageX,
			top: e.pageY
		});
		return false;
	};

	Raphael.st.draggable = function(obj) {
		var me = this;
		var lx = 0;
		var ly = 0;
		var ox = 0;
		var oy = 0;

		var moveFnc = function(dx, dy) {
			var x = dx + ox;
			var y = dy + oy;
			var xx = DreamBuilder.get('length') - obj.width; //set the vertical limit: the edge of the room must not exceed to the edge of the house
			var yy = DreamBuilder.get('width') - obj.length; //set the horizontal limit
		    lx = (x >= 0 ? (x <= xx ? x : xx) : 0); // set x to zero if the drag x is less than zero, and set the max if drag x exceeds the limit
		    ly = (y >= 0 ? (y <= yy ? y : yy) : 0); // set y to zero if the drag x is less than zero, and set the max if drag y exceeds the limit
		    me.transform('t' + lx + ',' + ly); //move the room to x,y ordinates
		};

		var startFnc = function() {};

		var endFnc = function() {
		    ox = lx;
		    oy = ly;
		    DreamBuilder.house[obj.property][obj.index].x = ox; //set the current x to house object
		    DreamBuilder.house[obj.property][obj.index].y = oy; //set the curretn y to house object
		};
		
		this.drag(moveFnc, startFnc, endFnc);

		me.transform('T' + obj.x + ',' + obj.y);
	};

	Raphael.st.dragVertical = function (obj) {
		var limit = DreamBuilder.get('width') - obj.width;
		var me = this;
		var lx = 0;
		var ly = 0;
		var ox = 0;
		var oy = 0;

		var moveFnc = function(dx, dy) {
			var x = 0; // cannot change the x position
			var y = dy + oy;
		    lx = x;
		    ly = y >= 0 ? (y <= limit ? y : limit) : 0; // set y to zero if y < 0 and max if y > max
		    me.transform('t' + lx + ',' + ly); //move the object
		};

		var startFnc = function() {};

		var endFnc = function() {
		    ox = lx;
		    oy = ly;
		    DreamBuilder.house[obj.property][obj.index].x = ox; // set x to the house object
		    DreamBuilder.house[obj.property][obj.index].y = oy; //set y to the house object
		};
		
		this.drag(moveFnc, startFnc, endFnc);

		me.transform('T' + 0 + ',' + obj.x); // initially move the object to preferred position
	};

	Raphael.st.dragHorizontal = function (obj) {
		var limit = DreamBuilder.get('length') - obj.width;
		var me = this;
		var lx = 0;
		var ly = 0;
		var ox = 0;
		var oy = 0;
		var moveFnc = function(dx, dy) {
			var x = dx + ox;
			var y = 0; //cannot change they y ordinate
		    lx = x >= 0 ? (x <= limit ? x : limit) : 0; //set x to 0 if x < 0 and max if x > max
		    ly = y;
		    me.transform('t' + lx + ',' + ly);
		};

		var startFnc = function() {};

		var endFnc = function() {
		    ox = lx;
		    oy = ly;
		    DreamBuilder.house[obj.property][obj.index].x = ox;
		    DreamBuilder.house[obj.property][obj.index].y = oy;
		};
		
		this.drag(moveFnc, startFnc, endFnc);

		me.transform('T' + obj.x + ',' + 0);
	};

	var paper, floor;

	var offsetX = 50, offsetY = 50;

	var rooms = 0, doors = 0, windows = 0;

	var door = {
		left: {
			position: 'vertical',
			lat: -1
		},
		right: {
			position: 'vertical',
			lat: 1
		},
		top: {
			position: 'horizontal',
			lat :-1
		},
		bottom: {
			position: 'horizontal',
			lat: 1
		}
	};

	var init = function () {
		//initialize new Raphael object
		paper = new Raphael('sketchpad', DreamBuilder.get('length') + offsetY * 2, DreamBuilder.get('width') + offsetX * 2);
	};

	var d = DreamBuilder.TWOD = function () {
		init.call(this);
	};

	d.prototype.init = init;

	d.prototype.createFloor = function () {
		//draw a square that represents the floor
		floor = paper.rect(offsetX, offsetY, DreamBuilder.get('length'), DreamBuilder.get('width'));
	};

	var verticalDash = function (obj) {
		//this method draws dashes for the room dimensions
		var width = obj.width - obj.x + offsetX;
		var x = obj.x - 15;
		while(obj.x <= obj.width) {
			var path = 'M' + obj.x + ' ' + obj.y + 'L' + (obj.x + 10) + ' ' + obj.y; //draw a dash
			var dash = paper.path(path);
			obj.set.push(dash);
			obj.x += 20;
		}
		var label = paper.text(width / 2 + x, obj.y + (15 * obj.lat), obj.label / 100 + 'm');
		obj.set.push(label);
	};

	var horizontalDash = function (obj) {
		var y = obj.y - 20;
		var length = obj.length - obj.y + offsetY;
		while(obj.y < obj.length) {
			var path = 'M' + obj.x + ' ' + obj.y + 'L' + obj.x + ' ' + (obj.y + 10);
			var dash = paper.path(path);
			obj.set.push(dash);
			obj.y += 20;
		}
		var label = paper.text(obj.x + (25 * obj.lat), length / 2 + y, obj.label / 100 + 'm');
		obj.set.push(label);
	};

	d.prototype.createRoom = function (obj) {
		//cache the room to the house object
		DreamBuilder.house.rooms.push({
			x: obj.px,
			y: obj.py,
			width: obj.width,
			length: obj.length,
			name: name
		});
		//set the initial position to the edge
		var x = offsetX;
		var y = offsetY;
		var set = paper.set();
		set.index = rooms;
		set.property = 'rooms';
		var room = paper.rect(x, y, obj.width, obj.length);
		room.attr({
			fill: 'silver'
		});
		set.push(room);

		verticalDash({
			x: x + 15,
			y: y + 15,
			width: obj.width + 15,
			label: obj.width,
			lat: 1,
			set: set
		});

		verticalDash({
			x: x + 15,
			y: obj.length + offsetY - 15,
			width: obj.width + 15,
			label: obj.width,
			lat: -1,
			set: set
		});

		horizontalDash({
			x: x + 15,
			y: y + 15,
			length: obj.length + offsetY - 15,
			label: obj.length,
			lat: 1,
			set: set
		});

		horizontalDash({
			x: obj.width + offsetX - 15,
			y: y + 15,
			length: obj.length + offsetY - 15,
			label: obj.length,
			lat: -1,
			set: set
		});

		rooms++;

		var name = obj.name ? obj.name : 'ROOM' + rooms;
		//display the room label
		var label = paper.text(obj.width / 2 + offsetX, obj.length / 2 + offsetY, name);

		label.attr({
			'font-size': 15,
			'font-style': 'italic',
			'font-weight': 'bold'
		});

		set.push(label);

		set.draggable({
			width: obj.width,
			length: obj.length,
			x: obj.px,
			y: obj.py,
			index: rooms - 1,
			property: 'rooms'
		});
		//set each node for contextmenu event
		$.each(set, function (i, node) {
			$(node.node).on('contextmenu', function (e) {
				currentSet = set;
				$cm.css({
					display: 'block',
					left: e.pageX,
					top: e.pageY
				});
				return false;
				});
		});
	};

	d.prototype.createDoor = function(obj) {
		//cache the door to the house object
		DreamBuilder.house.doors.push({
			where: obj.where,
			x: obj.x,
			width: obj.width,
			length: obj.length
		});

		var x, y, xx, yy, drag;

		switch(obj.where) {
			case 'left':
				x = offsetX / 2;
				y = offsetY;
				xx = offsetX / 2;
				yy = obj.width;
				drag = 'dragVertical';
				break;
			case 'top':
				x = offsetX;
				y = offsetY / 2;
				xx = obj.width;
				yy = offsetY / 2;
				drag = 'dragHorizontal';
				break;
			case 'right':
				x = DreamBuilder.get('length') + offsetX;
				y = offsetY;
				xx = offsetX / 2;
				yy = obj.width;
				drag = 'dragVertical';
				break;
			case 'bottom':
				x = offsetX;
				y = DreamBuilder.get('width') + offsetY;
				xx = obj.width;
				yy = offsetY / 2;
				drag = 'dragHorizontal';
				break;
		}
		var door = paper.rect(x, y, xx, yy);
		door.attr({
			fill: 'brown'
		});
		var d1 = paper.path('M' + x + ',' + y + 'L' + (x + xx) + ',' + (y + yy));
		var d2 = paper.path('M' + x + ',' + (y + yy) + 'L' + (x + xx) + ',' + y);
		var set = paper.set();
		set.index = doors;
		set.property = 'doors';
		set.push(door);
		set.push(d1);
		set.push(d2);
		$([door.node, d1.node, d2.node]).on('contextmenu', function (e) {
			currentSet = set;
			$cm.css({
				display: 'block',
				left: e.pageX,
				top: e.pageY
			});
			return false;
		});
		set[drag]({
			width: obj.width,
			x: obj.x,
			index: doors,
			property: 'doors'
		});
		doors++;
	};

	d.prototype.createWindow = function(obj) {
		//cache the window to the house object
		DreamBuilder.house.windows.push({
			where: obj.where,
			x: obj.x,
			width: obj.width,
			length: obj.length
		});

		var x, y, xx, yy, drag, lx, ly;

		switch(obj.where) {
			case 'left':
				x = offsetX / 2;
				y = offsetY;
				xx = offsetX / 2;
				yy = obj.width;
				lx = 0;
				ly = yy;
				drag = 'dragVertical';
				break;
			case 'top':
				x = offsetX;
				y = offsetY / 2;
				xx = obj.width;
				yy = offsetY / 2;
				drag = 'dragHorizontal';
				lx = obj.width;
				ly = 0;
				break;
			case 'right':
				x = DreamBuilder.get('length') + offsetX;
				y = offsetY;
				xx = offsetX / 2;
				yy = obj.width;
				drag = 'dragVertical';
				lx = DreamBuilder.get('length') + xx;
				ly = yy;
				break;
			case 'bottom':
				x = offsetX;
				y = DreamBuilder.get('width') + offsetY;
				xx = obj.width;
				yy = offsetY / 2;
				drag = 'dragHorizontal';
				lx = obj.width;
				ly = DreamBuilder.get('width') + yy;
				break;
		}
		
		var door = paper.rect(x, y, xx, yy);

		door.attr({
			fill: '#ebebeb'
		});

		var d1 = paper.path('M' + (xx / 2 + (offsetX - xx + lx)) + ',' + y + 'L' + (xx / 2 + (offsetX - xx + lx)) + ',' + (y + yy));
		var d2 = paper.path('M' + x + ',' + (yy / 2 + (offsetY - yy + ly)) + 'L' + (x + xx) + ',' + (yy / 2 + (offsetY - yy + ly)));
		var set = paper.set();
		set.index = windows;
		set.property = 'windows';
		set.push(door);
		set.push(d1);
		set.push(d2);

		$([door.node, d1.node, d2.node]).on('contextmenu', function (e) {
			currentSet = set;
			$cm.css({
				display: 'block',
				left: e.pageX,
				top: e.pageY
			});
			return false;
		});

		set[drag]({
			width: obj.width,
			x: obj.x,
			index: windows,
			property: 'windows'
		});

		windows++;

	};

	$([document, $cm]).click(function (e) {
		$cm.hide();
	});

	$('#delete-set').click(function (e) {
		console.log(currentSet.property, currentSet.index);
		DreamBuilder.house[currentSet.property][currentSet.index] = null;
		currentSet.remove();
		$cm.hide();
		return false;
	});

	window.currentSet = currentSet;

})();
