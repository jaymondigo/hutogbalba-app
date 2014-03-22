(function() {

    var currentSet = DreamBuilder.currentSet; //will be set upon right-clicking the element

    var $cm = $('#contextMenu'); //house elements contextmenu

    var doorEdge = DreamBuilder.doorEdge;

    var contextCallback = function(e) {
        DreamBuilder.currentSet = currentSet = set;
        //show the contextmenu
        $cm.css({
            display: 'block',
            left: e.pageX,
            top: e.pageY
        });
        return false;
    };

    var cm2px = function (cm) {
        return cm * 37.795275591
    };

    var px2cm = function (px) {
        return px / 37.795275591;
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
            var xx = DreamBuilder.get('length') * DreamBuilder.divider - obj.width; //set the vertical limit: the edge of the room must not exceed to the edge of the house
            var yy = DreamBuilder.get('width') * DreamBuilder.divider - obj.length; //set the horizontal limit
            lx = (x >= 0 ? (x <= xx ? x : xx) : 0); // set x to zero if the drag x is less than zero, and set the max if drag x exceeds the limit
            ly = (y >= 0 ? (y <= yy ? y : yy) : 0); // set y to zero if the drag x is less than zero, and set the max if drag y exceeds the limit
            me.transform('t' + lx + ',' + ly); //move the room to x,y ordinates
        };

        var startFnc = function() {};

        var endFnc = function() {
            ox = lx;
            oy = ly;
            DreamBuilder.house[obj.property][obj.index].x = ox / DreamBuilder.divider; //set the current x to house object
            DreamBuilder.house[obj.property][obj.index].y = oy / DreamBuilder.divider; //set the curretn y to house object
        };

        this.drag(moveFnc, startFnc, endFnc);

        me.transform('T' + obj.x + ',' + obj.y);
    };

    Raphael.st.dragVertical = function(obj) {
        var limit = DreamBuilder.get('width') * DreamBuilder.divider - obj.width - doorEdge;
        var me = this;
        var lx = 0;
        var ly = 0;
        var ox = 0;
        var oy = 0;

        var moveFnc = function(dx, dy) {
            var x = 0; // cannot change the x position
            var y = dy + oy;
            lx = x;
            ly = y >= doorEdge ? (y <= limit ? y : limit) : doorEdge; // set y to zero if y < 0 and max if y > max
            me.transform('t' + lx + ',' + ly); //move the object
        };

        var startFnc = function() {};

        var endFnc = function() {
            ox = lx;
            oy = ly;
            DreamBuilder.house[obj.property][obj.index].x = ox / DreamBuilder.divider; // set x to the house object
            DreamBuilder.house[obj.property][obj.index].y = oy / DreamBuilder.divider; //set y to the house object
        };

        this.drag(moveFnc, startFnc, endFnc);

        me.transform('T' + 0 + ',' + obj.x); // initially move the object to preferred position
    };

    Raphael.st.dragHorizontal = function(obj) {
        var limit = DreamBuilder.get('length') * DreamBuilder.divider - obj.width - doorEdge;
        var me = this;
        var lx = 0;
        var ly = 0;
        var ox = 0;
        var oy = 0;
        var moveFnc = function(dx, dy) {
            var x = dx + ox;
            var y = 0; //cannot change they y ordinate
            lx = x >= doorEdge ? (x <= limit ? x : limit) : doorEdge; //set x to 0 if x < 0 and max if x > max
            ly = y;
            me.transform('t' + lx + ',' + ly);
        };

        var startFnc = function() {};

        var endFnc = function() {
            ox = lx;
            oy = ly;
            DreamBuilder.house[obj.property][obj.index].x = ox / DreamBuilder.divider;
            DreamBuilder.house[obj.property][obj.index].y = oy / DreamBuilder.divider;
        };

        this.drag(moveFnc, startFnc, endFnc);

        me.transform('T' + obj.x + ',' + 0);
    };

    var paper, floor;

    var offsetX = 50,
        offsetY = 50;

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
            lat: -1
        },
        bottom: {
            position: 'horizontal',
            lat: 1
        }
    };

    var init = function() {
        //initialize new Raphael object
        paper = new Raphael('sketchpad', DreamBuilder.get('length') * DreamBuilder.divider + offsetY * 2, DreamBuilder.get('width') * DreamBuilder.divider + offsetX * 2);
        paper.setViewBox(0, 0, DreamBuilder.get('length') * DreamBuilder.divider + offsetY * 2, DreamBuilder.get('width') * DreamBuilder.divider + offsetX * 2);
    };

    var d = DreamBuilder.TWOD = function() {
        init.call(this);
    };

    d.prototype.init = init;

    d.prototype.createFloor = function() {
        //draw a square that represents the floor
        floor = paper.rect(offsetX, offsetY, DreamBuilder.get('length') * DreamBuilder.divider, DreamBuilder.get('width') * DreamBuilder.divider);
        var fiftycm = 50 * DreamBuilder.divider;
        var i = fiftycm + offsetX;
        while (i <= DreamBuilder.get('length') * DreamBuilder.divider + offsetX) {
            var line = paper.path('M' + i + ',' + offsetY + 'L' + i + ',' + (DreamBuilder.get('width') * DreamBuilder.divider + offsetY));
            line.attr({
                'stroke': 'silver'
            });
            i += fiftycm;
        }
        i = fiftycm + offsetY;
        while (i <= DreamBuilder.get('width') * DreamBuilder.divider + offsetY) {
            var line = paper.path('M' + offsetX + ',' + i + 'L' + (DreamBuilder.get('length') * DreamBuilder.divider + offsetX) + ',' + i);
            line.attr({
                'stroke': 'silver'
            });
            i += fiftycm;
        }
        var m = paper.text((fiftycm / 2) + offsetX, offsetY / 2, '0.5 m');
        var mm = paper.path('M' + offsetX + ',' + offsetY / 2 + 'L' + (((fiftycm / 2) - 20) + offsetX) + ',' + offsetY / 2 +
            'M' + ((fiftycm / 2) + 20 + offsetX) + ',' + offsetY / 2 + 'L' + (fiftycm + offsetX) + ',' + offsetY / 2);
    };

    var verticalDash = function(obj) {
        //this method draws dashes for the room dimensions
        var width = obj.width - obj.x + offsetX;
        var x = obj.x - 15;
        while (obj.x <= obj.width) {
            var path = 'M' + obj.x + ' ' + obj.y + 'L' + (obj.x + 10) + ' ' + obj.y; //draw a dash
            var dash = paper.path(path);
            obj.set.push(dash);
            obj.x += 20;
        }
        var label = paper.text(width / 2 + x, obj.y + (15 * obj.lat), obj.label / 100 + 'm');
        obj.set.push(label);
    };

    var horizontalDash = function(obj) {
        var y = obj.y - 20;
        var length = obj.length - obj.y + offsetY;
        while (obj.y < obj.length) {
            var path = 'M' + obj.x + ' ' + obj.y + 'L' + obj.x + ' ' + (obj.y + 10);
            var dash = paper.path(path);
            obj.set.push(dash);
            obj.y += 20;
        }
        var label = paper.text(obj.x + (25 * obj.lat), length / 2 + y, obj.label / 100 + 'm');
        obj.set.push(label);
    };

    d.prototype.createRoom = function(obj) {
        //cache the room to the house object
        DreamBuilder.house.rooms.push({
            x: obj.px,
            y: obj.py,
            width: obj.width,
            length: obj.length,
            name: obj.name,
            door: obj.door
        });
        //set the initial position to the edge
        var x = offsetX;
        var y = offsetY;
        var set = paper.set();
        set.index = DreamBuilder.rooms;
        set.property = 'rooms';
        var room = paper.rect(x, y, obj.width * DreamBuilder.divider, obj.length * DreamBuilder.divider);
        room.attr({
            fill: 'silver'
        });
        set.push(room);

        verticalDash({
            x: x + 15,
            y: y + 15,
            width: obj.width * DreamBuilder.divider + 15,
            label: obj.width,
            lat: 1,
            set: set
        });

        verticalDash({
            x: x + 15,
            y: obj.length * DreamBuilder.divider + offsetY - 15,
            width: obj.width * DreamBuilder.divider + 15,
            label: obj.width,
            lat: -1,
            set: set
        });

        horizontalDash({
            x: x + 15,
            y: y + 15,
            length: obj.length * DreamBuilder.divider + offsetY - 15,
            label: obj.length,
            lat: 1,
            set: set
        });

        horizontalDash({
            x: obj.width * DreamBuilder.divider + offsetX - 15,
            y: y + 15,
            length: obj.length * DreamBuilder.divider + offsetY - 15,
            label: obj.length,
            lat: -1,
            set: set
        });

        if(typeof obj.door == 'object') {
            var w = 0, l = 0;
            
            switch(obj.door.where) {
                case 'left':
                    x = offsetX;
                    y = offsetY + doorEdge * DreamBuilder.divider;
                    w = doorEdge * DreamBuilder.divider;
                    l = obj.door.width * DreamBuilder.divider;
                    break;
                case 'right':
                    x = offsetX + (obj.length - doorEdge) * DreamBuilder.divider;
                    y = offsetY + doorEdge * DreamBuilder.divider;
                    w = doorEdge * DreamBuilder.divider;
                    l = obj.door.width * DreamBuilder.divider;
                    break;
                case 'top':
                    x = offsetX + doorEdge * DreamBuilder.divider;
                    y = offsetY;
                    w = obj.door.width * DreamBuilder.divider;
                    l = doorEdge * DreamBuilder.divider;
                    break;
                case 'bottom':
                    x = offsetX + doorEdge * DreamBuilder.divider;
                    y = offsetY + (obj.width - doorEdge) * DreamBuilder.divider;
                    w = obj.door.width * DreamBuilder.divider;
                    l = doorEdge * DreamBuilder.divider;
                    break;
            }
            var door = paper.rect(x, y, w, l);
            door.attr({
                fill: 'brown'
            });
            var dl = paper.path('M' + x + ',' + y + 'L' + (x + w) + ',' + (y + l) +
                'M' + x + ',' + (y + l) + 'L' + (x + w) + ',' + y);

            set.push(door);
            set.push(dl);

        }

        DreamBuilder.rooms++;

        var name = obj.name ? obj.name : 'ROOM' + DreamBuilder.rooms;
        //display the room label
        var label = paper.text(obj.width * DreamBuilder.divider / 2 + offsetX, obj.length * DreamBuilder.divider / 2 + offsetY, name);

        label.attr({
            'font-size': 15,
            'font-style': 'italic',
            'font-weight': 'bold'
        });

        set.push(label);

        set.draggable({
            width: obj.width * DreamBuilder.divider,
            length: obj.length * DreamBuilder.divider,
            x: obj.px * DreamBuilder.divider,
            y: obj.py * DreamBuilder.divider,
            index: DreamBuilder.rooms - 1,
            property: 'rooms'
        });
        //set each node for contextmenu event
        $.each(set, function(i, node) {
            $(node.node).on('contextmenu', function(e) {
                DreamBuilder.currentSet = currentSet = set;
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
        if(typeof obj.where == 'undefined') return;
        var xxx;
        //cache the door to the house object
        DreamBuilder.house.doors.push({
            where: obj.where,
            x: obj.x,
            y: obj.y,
            width: obj.width,
            length: obj.length,
            type: obj.type,
            num: obj.num
        });

        var x, y, xx, yy, drag;

        var width = obj.width * obj.num;

        switch (obj.where) {
            case 'left':
                x = offsetX / 2;
                y = offsetY;
                xx = offsetX / 2;
                yy = width * DreamBuilder.divider;
                xxx = obj.y;
                drag = 'dragVertical';
                break;
            case 'top':
                x = offsetX;
                y = offsetY / 2;
                xx = width * DreamBuilder.divider;
                yy = offsetY / 2;
                xxx = obj.x;
                drag = 'dragHorizontal';
                break;
            case 'right':
                x = DreamBuilder.get('length') * DreamBuilder.divider + offsetX;
                y = offsetY;
                xx = offsetX / 2;
                yy = width * DreamBuilder.divider;
                xxx = obj.y;
                drag = 'dragVertical';
                break;
            case 'bottom':
                x = offsetX;
                y = DreamBuilder.get('width') * DreamBuilder.divider + offsetY;
                xx = width * DreamBuilder.divider;
                yy = offsetY / 2;
                xxx = obj.x;
                drag = 'dragHorizontal';
                break;
        }
        var set = paper.set();
        set.index = DreamBuilder.doors;
        set.property = 'doors';
        var door = paper.rect(x, y, xx, yy);
        door.attr({
            fill: 'brown'
        });
        set.push(door);
        $(door.node).on('contextmenu', function (e) {
            DreamBuilder.currentSet = currentSet = set;
            $cm.css({
                display: 'block',
                left: e.pageX,
                top: e.pageY
            });
            return false;
        });
        console.log('d1', 'M' + x + ',' + y + 'L' + (x + xx) + ',' + (y + yy));
        console.log('d2', 'M' + x + ',' + (y + yy) + 'L' + (x + xx) + ',' + y);
        console.log('x', x, 'y', y, 'yy', yy, 'xx', xx);
        console.log('obj', obj);
        var d1 = paper.path('M' + x + ',' + y + 'L' + (x + xx) + ',' + (y + yy));
        var d2 = paper.path('M' + x + ',' + (y + yy) + 'L' + (x + xx) + ',' + y);
        set.push(d1);
        set.push(d2);
        $([d1.node, d2.node]).on('contextmenu', function(e) {
            DreamBuilder.currentSet = currentSet = set;
            $cm.css({
                display: 'block',
                left: e.pageX,
                top: e.pageY
            });
            return false;
        });
        set[drag]({
            width: width * DreamBuilder.divider,
            x: xxx * DreamBuilder.divider,
            index: DreamBuilder.doors,
            property: 'doors'
        });
        DreamBuilder.doors++;
    };

    d.prototype.createWindow = function(obj) {
        var xxx;
        //cache the window to the house object
        DreamBuilder.house.windows.push({
            where: obj.where,
            x: obj.x,
            y: obj.y,
            width: obj.width,
            length: obj.length
        });

        var x, y, xx, yy, drag, lx, ly;

        switch (obj.where) {
            case 'left':
                x = offsetX / 2;
                y = offsetY;
                xx = offsetX / 2;
                yy = obj.width * DreamBuilder.divider;
                lx = 0;
                ly = yy;
                xxx = obj.y;
                drag = 'dragVertical';
                break;
            case 'top':
                x = offsetX;
                y = offsetY / 2;
                xx = obj.width * DreamBuilder.divider;
                yy = offsetY / 2;
                drag = 'dragHorizontal';
                lx = obj.width * DreamBuilder.divider;
                ly = 0;
                xxx = obj.x;
                break;
            case 'right':
                x = DreamBuilder.get('length') * DreamBuilder.divider + offsetX;
                y = offsetY;
                xx = offsetX / 2;
                yy = obj.width * DreamBuilder.divider;
                drag = 'dragVertical';
                lx = DreamBuilder.get('length') * DreamBuilder.divider + xx;
                ly = yy;
                xxx = obj.y;
                break;
            case 'bottom':
                x = offsetX;
                y = DreamBuilder.get('width') * DreamBuilder.divider + offsetY;
                xx = obj.width * DreamBuilder.divider;
                yy = offsetY / 2;
                drag = 'dragHorizontal';
                lx = obj.width * DreamBuilder.divider;
                ly = DreamBuilder.get('width') * DreamBuilder.divider + yy;
                xxx = obj.x;
                break;
        }

        var door = paper.rect(x, y, xx, yy);

        door.attr({
            fill: '#ebebeb'
        });

        var d1 = paper.path('M' + (xx / 2 + (offsetX - xx + lx)) + ',' + y + 'L' + (xx / 2 + (offsetX - xx + lx)) + ',' + (y + yy));
        var d2 = paper.path('M' + x + ',' + (yy / 2 + (offsetY - yy + ly)) + 'L' + (x + xx) + ',' + (yy / 2 + (offsetY - yy + ly)));
        var set = paper.set();
        set.index = DreamBuilder.windows;
        set.property = 'windows';
        set.push(door);
        set.push(d1);
        set.push(d2);

        $([door.node, d1.node, d2.node]).on('contextmenu', function(e) {
            DreamBuilder.currentSet = currentSet = set;
            $cm.css({
                display: 'block',
                left: e.pageX,
                top: e.pageY
            });
            return false;
        });

        set[drag]({
            width: obj.width * DreamBuilder.divider,
            x: xxx * DreamBuilder.divider,
            index: DreamBuilder.windows,
            property: 'windows'
        });

        DreamBuilder.windows++;

    };

    d.prototype.createWall = function (obj) {
        DreamBuilder.house.walls.push({
            x: obj.x,
            y: obj.y,
            thickness: obj.thickness,
            width: obj.width,
            orientation: obj.orientation
        });
        var w = 0, l = 0;
        var set = paper.set();
        switch(obj.orientation) {
            case 'vertical':
                w = obj.thickness * DreamBuilder.divider;
                l = obj.width * DreamBuilder.divider;
                break;
            case 'horizontal':
                w = obj.width * DreamBuilder.divider;
                l = obj.thickness * DreamBuilder.divider;
                break;
        }
        var wall = paper.rect(offsetX, offsetY, w, l);
        wall.attr({
            fill: 'black'
        });
        set.push(wall);
        set.index = DreamBuilder.walls;
        set.property = 'walls';
        set.draggable({
            width: w,
            length: l,
            x: obj.x * DreamBuilder.divider,
            y: obj.y * DreamBuilder.divider,
            index: DreamBuilder.walls,
            property: 'walls'
        });
        DreamBuilder.walls++;
        $(wall.node).on('contextmenu', function(e) {
            DreamBuilder.currentSet = currentSet = set;
            $cm.css({
                display: 'block',
                left: e.pageX,
                top: e.pageY
            });
            return false;
        });
    };

    $([document, $cm]).click(function(e) {
        $cm.hide();
    });

    $('#delete-set').click(function(e) {
        DreamBuilder.house[currentSet.property][currentSet.index] = null;
        currentSet.remove();
        $cm.hide();
        return false;
    });

})();