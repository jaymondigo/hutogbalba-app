(function() {
    var offsetX = 100,
        offsetY = 100,
        bgColor = 'white',
        ra = 50;
    var doorEdge = 20;
    var $svg = $('#floorplan-svg'),
        $canvas = $('#floorplan-canvas');
    var Floorplan = (function() {
        var paper;

        function Floorplan(obj) {
            Object.keys(obj).forEach(function(key) {
                this[key] = obj[key];
            }, this);
            paper = new Raphael('floorplan-svg', this.length + offsetX * 2, this.width + offsetY * 2);
            var rect = paper.rect(0, 0, this.length + offsetX * 2, this.width + offsetY * 2);
            rect.attr({
                'fill': bgColor,
                'stroke': bgColor
            });
            //var name = paper.text(offsetX / 2, offsetY / 3, obj.name);
            // name.attr({
            //     'font-style': 'italic',
            //     'font-size': '10px'
            // });
            //rightAngle.call(this);
        }

        function rightAngle() {
            var angle = paper.path('M' + offsetX + ',' + (offsetY + ra) + ' C' + offsetX + ',' + (offsetY + ra) +
                ' ' + (offsetX + ra) + ',' + (offsetY + ra) + ' ' + (offsetX + ra) + ',' + offsetY +
                ' M' + (offsetX + ra) + ',' + offsetY + ' M' + offsetX + ',' + (this.width + offsetY - ra) +
                ' C' + offsetX + ',' + (this.width + offsetY - ra) + ' ' + (offsetX + ra) + ',' + (this.width + offsetY - ra) +
                ' ' + (offsetX + ra) + ',' + (this.width + offsetY) + ' M' + (offsetX + ra) + ',' + (this.width + offsetY) +
                ' M' + (this.length + offsetX - ra) + ',' + offsetY + ' C' + (this.length + offsetX - ra) + ',' + offsetY +
                ' ' + (this.length + offsetX - ra) + ',' + (offsetY + ra) + ' ' + (this.length + offsetX) + ',' + (offsetY + ra) +
                ' M' + (this.length + offsetX) + ',' + (offsetY + ra) +
                ' M' + (this.length + offsetX - ra) + ',' + (this.width + offsetY) + ' C' + (this.length + offsetX - ra) + ',' + (this.width + offsetY) +
                ' ' + (this.length + offsetX - ra) + ',' + (this.width + offsetY - ra) + ' ' + (this.length + offsetX) + ',' + (this.width + offsetY - ra) +
                ' M' + (this.length + offsetX) + ',' + (this.width + offsetY - ra));
            var kudlit = paper.path('M' + (offsetX + 3 + ra / 2) + ',' + (offsetY + 8 + ra / 2) + 'L' + (offsetX + 14 + ra / 2) + ',' + (offsetY + 19 + ra / 2) +
                'M' + (offsetX + 8 + ra / 2) + ',' + (offsetY + 3 + ra / 2) + 'L' + (offsetX + 19 + ra / 2) + ',' + (offsetY + 14 + ra / 2) +
                '');
        }

        function rightPythagorean(h) {
            return Math.sqrt(Math.pow(h, 2) / 2);
        }

        function verticalLine(x) {
            return paper.path('M' + x + ',' + offsetY + 'L' + x + ',' + ((this.width / 2) + (offsetY / 2) + 25) +
                'M' + x + ',' + ((this.width / 2) + offsetY + 25) + 'L' + x + ',' + (this.width + offsetY));
        }

        function horizontalLine(y) {
            return paper.path('M' + offsetX + ',' + y + 'L' + ((this.length / 2) + (offsetX / 2) + 25) + ',' + y +
                'M' + ((this.length / 2) + offsetX + 25) + ',' + y + 'L' + (this.length + offsetX) + ',' + y);
        }

        function verticalWindow(x, y, width, l) {
            var t = 10;
            var w = width / 3;
            var win1 = paper.rect(x - t / 2, y, t, w);
            var win2 = paper.rect(x - t / 2, y + w * 2, t, w);
            var win3 = paper.rect(x - t / 2, y + w, t / 2, w);
            var win4 = paper.rect(x, y + w, t / 2, w);
            win1.attr({
                'fill': 'black'
            });
            win2.attr({
                'fill': 'black'
            });
            //var label = paper.text(l, y + width / 2, (width / 100).toFixed(2) + ' m');
        }

        function horizontalWindow(x, y, width, l) {
            var t = 10;
            var w = width / 3;
            var win1 = paper.rect(x, y - t / 2, w, t);
            var win2 = paper.rect(x + w * 2, y - t / 2, w, t);
            var win3 = paper.rect(x + w, y - t / 2, w, t / 2);
            var win4 = paper.rect(x + w, y, w, t / 2);
            win1.attr({
                'fill': 'black'
            });
            win2.attr({
                'fill': 'black'
            });
            //var label = paper.text(x + width / 2, l, (width / 100).toFixed(2) + ' m');
        }

        function verticalDoor(x, y, width, l, dx, dy) {
            var t = 10;
            var w = width / 3;
            var a = rightPythagorean(w);
            var door1 = paper.rect(x - t / 2, y, t, w);
            var door2 = paper.rect(x - t / 2, y + w * 2, t, w);
            // door3 = paper.path('M' + (x) + ',' + (y + w) + 'L' + ((x) + a * dx) + ',' + ((y + w) + a * dy));
            var door3 = paper.path('M' + (x + ((t / 2) * dx)) + ',' + (y + w - 2) + 'L' + (x + (w * dx)) + ',' + (w + y - 2) +
                'C' + (x + (w * dx)) + ',' + (w + y - 2) + ' ' + (x + (w * dx)) + ',' + (w * 2 + y + 2) + ' ' + (x + ((t / 2) * dx)) + ',' + (w * 2 + y + 2) + 'z');
            var door4 = paper.path('M' + (x + ((t / 2) * dx)) + ',' + (y + w - 2) + 'L' + (x + (w * dx)) + ',' + (w + y - 2));
            var door5 = paper.rect(x - 1 - t / 2, y + w, t * 1.5, w);
            //var door4 = paper.path('C' + (x + (w * dx)) + ',' + (w + y - 2) + ' ' + (x + (w * dx)) + ',' + (w * 2 + y - 2) + ' ' + (x + ((t / 2) * dx)) + ',' + (w * 2 + y - 2) + 'z');
            door1.attr({
                'fill': 'black'
            });
            door2.attr({
                'fill': 'black'
            });
            door3.attr({
                'stroke-width': '2',
                'stroke': 'gray'
            });
            door4.attr({
                'stroke-width': '2',
                'stroke': 'black'
            });
            door5.attr({
                'fill': bgColor,
                'stroke': bgColor
            });
            //var label = paper.text(l, y + width / 2, (width / 100).toFixed(2) + ' m');
        }

        function horizontalDoor(x, y, width, l, dx, dy) {
            var t = 10;
            var w = width / 3;
            var a = rightPythagorean(w);
            var door1 = paper.rect(x, y - t / 2, w, t);
            var door2 = paper.rect(x + w * 2, y - t / 2, w, t);
            //var door3 = paper.path('M' + (x + w * 2) + ',' + (y) + 'L' + ((x + w * 2) + a * dx) + ',' + ((y) + a * dy));
            var door3 = paper.path('M' + (x + w - 2) + ',' + (y + ((t / 2) * dy)) + 'L' + (x + w - 2) +  ',' + (y + (w * dy)) +
                'C' + (x + w - 2) +  ',' + (y + (w * dy)) + ' ' + (w * 2 + x - 2) + ',' + (y + (w * dy)) + ' ' + (w * 2 + x + 2) + ',' + (y + ((t / 2) * dy)));
            var door4 = paper.path('M' + (x + w - 2) + ',' + (y + ((t / 2) * dy)) + 'L' + (x + w - 2) +  ',' + (y + (w * dy)));
            var door5 = paper.rect(x + w, y - 1 - t / 2, w, t * 1.5);
            door1.attr({
                'fill': 'black'
            });
            door2.attr({
                'fill': 'black'
            });
            door5.attr({
                'fill': bgColor,
                'stroke': bgColor
            });
            door3.attr({
                'stroke-width': '2',
                'stroke': 'gray'
            });
            door4.attr({
                'stroke-width': '2',
                'stroke': 'black'
            });
            //var label = paper.text(x + offsetX / 2, l, (width / 100).toFixed(2) + ' m');
        }

        function verticalDoubleDoors(x, y, width, l, dx, dy) {
            var t = 10;
            var w = width / 4;
            var a = rightPythagorean(w);
            var door1 = paper.rect(x - t / 2, y, t, w);
            var door2 = paper.rect(x - t / 2, y + w * 3, t, w);
            var door3 = paper.path('M' + (x + ((t / 2) * dx)) + ',' + (y + w - 2) + 'L' + ((x + ((t / 2) * dx)) + w * dx) + ',' + (y + w - 2) +
                ' C' + ((x + ((t / 2) * dx)) + w * dx) + ',' + (y + w - 2) + ' ' + ((x + ((t / 2) * dx)) + w * dx) + ',' + (y + w - 2 + w) +
                ' ' + (x + ((t / 2) * dx)) + ',' + (y + w - 2 + w) + ' ' + (x + ((t / 2) * dx)) + ',' + (y + w - 2 + w) +
                ' ' + ((x + ((t / 2) * dx)) + w * dx) + ',' + (y + w - 2 + w) + ' ' + ((x + ((t / 2) * dx)) + w * dx) + ',' + (y + w * 3 + 2) +
                ' M' + ((x + ((t / 2) * dx)) + w * dx) + ',' + (y + w * 3 + 2) + 'L' + (x + ((t / 2) * dx)) + ',' + (y + w * 3 + 2));
            var door5 = paper.rect(x - t / 2, y + w, t, w * 2);
            door1.attr({
                'fill': 'black'
            });
            door2.attr({
                'fill': 'black'
            });
            door5.attr({
                'fill': bgColor,
                'stroke': bgColor
            });
        }

        function horizontalDoubleDoors(x, y, width, l, dx, dy) {
            var t = 10;
            var w = width / 4;
            var a = rightPythagorean(w);
            var door1 = paper.rect(x, y - t / 2, w, t);
            var door2 = paper.rect(x + w * 3, y - t / 2, w, t);
            var door3 = paper.path('M' + (x + w - 2) + ',' + (y + ((t / 2) * dy)) + 'L' + (x + w - 2) +  ',' + (y + (w * dy)) +
                ' C' + (x + w - 2) +  ',' + (y + (w * dy)) + ' ' + (x + w - 2 + w) + ',' + (y + (w * dy)) +
                ' ' + (x + w - 2 + w) + ',' + (y + ((t / 2) * dy)) + ' ' + (x + w - 2 + w) + ',' + (y + ((t / 2) * dy)) +
                ' ' + (x + w - 2 + w) + ',' + (y + ((t / 2) * dy) + w * dy) + ' ' + (x + w * 3 + 2) + ',' + (y + ((t / 2) * dy) + w * dy) +
                ' M' + (x + w * 3 + 2) + ',' + (y + ((t / 2) * dy) + w * dy) + 'L' + (x + w * 3 + 2) + ',' + (y + ((t / 2) * dy)));
            var door5 = paper.rect(x + w, y - t / 2, w * 2, t);
            door1.attr({
                'fill': 'black'
            });
            door2.attr({
                'fill': 'black'
            });
            door5.attr({
                'fill': bgColor,
                'stroke': bgColor
            });
        }

        Floorplan.prototype.createFloor = function() {
            var floor = paper.rect(offsetX, offsetY, this.length, this.width);
            floor.attr({
                'stroke-width': '4',
                'stroke': 'gray'
            });
            var xl = offsetX - 25,
                xr = this.length + offsetX + 25,
                xt = this.length / 2 + offsetX,
                xb = this.length / 2 + offsetX;
            var yl = this.width / 2 + offsetY,
                yr = this.width / 2 + offsetY,
                yt = offsetY - 25,
                yb = this.width + offsetY + 25;

            var labelLeft = paper.text(xl, yl, (this.width / 100).toFixed(2) + ' m');
            var labelRight = paper.text(xr, yr, (this.width / 100).toFixed(2) + ' m');

            var labelTop = paper.text(xt, yt, (this.length / 100).toFixed(2) + ' m');
            var labelBottom = paper.text(xb, yb, (this.length / 100).toFixed(2) + ' m');

            var lineLeft = verticalLine.call(this, xl);
            var lineRight = verticalLine.call(this, xr);

            var labelTop = horizontalLine.call(this, yt);
            var labelBottom = horizontalLine.call(this, yb);
        };
        Floorplan.prototype.createRoom = function(obj) {
            var room = paper.rect(obj.x + offsetX, obj.y + offsetY, obj.width, obj.length);
            room.attr({
                'stroke': 'black',
                'stroke-width': '4'
            });
            var label = paper.text(obj.x + offsetX + obj.width / 2, obj.y + offsetY + obj.length / 2, obj.name);
            label.attr({
                'font-size': '15px',
                'font-weight': 'bold'
            });
            if(typeof obj.door != 'object') return;
            var doorFunc;
            var vx, vy1, vy2, vy3, vy4, hx1, hx2, hx3, hx4, hy, lx1, lx2, ly1, ly2;
            switch(obj.door.where) {
                case 'left':
                    x = offsetX + obj.x;
                    y = offsetY + obj.y + doorEdge;
                    l = x + obj.door.width / 2 - 10;
                    dx = 1;
                    dy = 1;
                    doorFunc = verticalDoor;

                    vx = offsetX + obj.x + obj.width - ra / 2;
                    vy1 = offsetY + obj.y + ra / 2;
                    vy2 = offsetY + obj.y + obj.length / 2 - ra / 4;
                    vy3 = offsetY + obj.y + obj.length / 2 + ra / 4;
                    vy4 = offsetY + obj.y + obj.length - ra / 2;
                    hx1 = offsetX + obj.x + ra / 2;
                    hx2 = offsetX + obj.x + obj.width / 2 - ra / 2;
                    hx3 = offsetX + obj.x + obj.width / 2 + ra / 2;
                    hx4 = offsetX + obj.x + obj.width - ra / 2;
                    hy = offsetY + obj.y + obj.length - ra / 2;
                    lx1 = offsetX + obj.x + obj.width - ra / 2;
                    lx2 = offsetX + obj.x + obj.width / 2;
                    ly1 = offsetY + obj.y + obj.length / 2;
                    ly2 = offsetY + obj.y + obj.length - ra / 2;
                    break;
                case 'right':
                    x = offsetX + obj.x + obj.width;
                    y = offsetY + obj.y + doorEdge;
                    l = x + obj.door.width / 2 + 5;
                    dx = -1;
                    dy = 1;
                    doorFunc = verticalDoor;

                    vx = offsetX + obj.x + ra / 2;
                    vy1 = offsetY + obj.y + ra / 2;
                    vy2 = offsetY + obj.y + obj.length / 2 - ra / 4;
                    vy3 = offsetY + obj.y + obj.length / 2 + ra / 4;
                    vy4 = offsetY + obj.y + obj.length - ra / 2;
                    hx1 = offsetX + obj.x + ra / 2;
                    hx2 = offsetX + obj.x + obj.width / 2 - ra / 2;
                    hx3 = offsetX + obj.x + obj.width / 2 + ra / 2;
                    hx4 = offsetX + obj.x + obj.width - ra / 2;
                    hy = offsetY + obj.y + obj.length - ra / 2;
                    lx1 = offsetX + obj.x + ra / 2;
                    lx2 = offsetX + obj.x + obj.width / 2;
                    ly1 = offsetY + obj.y + obj.length / 2;
                    ly2 = offsetY + obj.y + obj.length - ra / 2;
                    break;
                case 'top':
                    y = offsetY + obj.y;
                    x = offsetX + obj.x + doorEdge;
                    l = y + obj.door.width / 3 - 5;
                    dx = -1;
                    dy = 1;
                    doorFunc = horizontalDoor;

                    vx = offsetX + obj.x + obj.width - ra / 2;
                    vy1 = offsetY + obj.y + ra / 2;
                    vy2 = offsetY + obj.y + obj.length / 2 - ra / 4;
                    vy3 = offsetY + obj.y + obj.length / 2 + ra / 4;
                    vy4 = offsetY + obj.y + obj.length - ra / 2;
                    hx1 = offsetX + obj.x + ra / 2;
                    hx2 = offsetX + obj.x + obj.width / 2 - ra / 2;
                    hx3 = offsetX + obj.x + obj.width / 2 + ra / 2;
                    hx4 = offsetX + obj.x + obj.width - ra / 2;
                    hy = offsetY + obj.y + obj.length - ra / 2;
                    lx1 = offsetX + obj.x + obj.width - ra / 2;
                    lx2 = offsetX + obj.x + obj.width / 2;
                    ly1 = offsetY + obj.y + obj.length / 2;
                    ly2 = offsetY + obj.y + obj.length - ra / 2;
                    break;
                case 'bottom':
                    y = offsetY + obj.y + obj.length;
                    x = offsetX + obj.x + doorEdge;
                    l = y - obj.door.width / 3 + 5;
                    dx = -1;
                    dy = -1;
                    doorFunc = horizontalDoor;

                    vx = offsetX + obj.x + obj.width - ra / 2;
                    vy1 = offsetY + obj.y + ra / 2;
                    vy2 = offsetY + obj.y + obj.length / 2 - ra / 4;
                    vy3 = offsetY + obj.y + obj.length / 2 + ra / 4;
                    vy4 = offsetY + obj.y + obj.length - ra / 2;
                    hx1 = offsetX + obj.x + ra / 2;
                    hx2 = offsetX + obj.x + obj.width / 2 - ra / 2;
                    hx3 = offsetX + obj.x + obj.width / 2 + ra / 2;
                    hx4 = offsetX + obj.x + obj.width - ra / 2;
                    hy = offsetY + obj.y + ra / 2;
                    lx1 = offsetX + obj.x + obj.width - ra / 2;
                    lx2 = offsetX + obj.x + obj.width / 2;
                    ly1 = offsetY + obj.y + obj.length / 2;
                    ly2 = offsetY + obj.y + ra / 2;
                    break;
            }

            if(typeof vx != 'undefined') {
                var line = paper.path('M' + vx + ',' + vy1 + 'L' + vx + ',' + vy2 + 
                    'M' + vx + ',' + vy3 + 'L' + vx + ',' + vy4 + 
                    'M' + hx1 + ',' + hy + 'L' + hx2 + ',' + hy + 
                    'M' + hx3 + ',' + hy + 'L' + hx4 + ',' + hy);
                var label1 = paper.text(lx1, ly1, (obj.length / 2).toFixed(2) + ' m');
                var label2 = paper.text(lx2, ly2, (obj.width / 2).toFixed(2) + ' m');
            }
            doorFunc(x, y, obj.door.width, l, dx, dy);
            //var m1 = paper.text(obj.x + offsetX + obj.width / 2, obj.y + offsetY + obj.length / 2 + 25, (obj.length / 100).toFixed(2) + ' m');
            //var m2 = paper.text(obj.x + offsetX + obj.width / 2 + 50, obj.y + offsetY + obj.length / 2, (obj.width / 100).toFixed(2) + ' m');
        };
        Floorplan.prototype.createDoor = function(obj) {
            if(typeof obj.where == 'undefined') return;
            var doorFunc, x, y, l, dx, dy;
            switch (obj.where) {
                case 'left':
                    x = offsetX;
                    y = offsetY + obj.y;
                    l = x + obj.width / 2 - 10;
                    dx = 1;
                    dy = 1;
                    doorFunc = obj.num == 1 ? verticalDoor : verticalDoubleDoors;
                    break;
                case 'right':
                    x = this.length + offsetX;
                    y = offsetY + obj.y;
                    l = x - obj.width / 2 + 5;
                    dx = -1;
                    dy = 1;
                    doorFunc = obj.num == 1 ? verticalDoor : verticalDoubleDoors;
                    break;
                case 'top':
                    y = offsetY;
                    x = offsetX + obj.x;
                    l = y + obj.width / 3 - 5;
                    dx = -1;
                    dy = 1;
                    doorFunc = obj.num == 1 ? horizontalDoor : horizontalDoubleDoors;
                    break;
                case 'bottom':
                    y = this.width + offsetY;
                    x = offsetX + obj.x;
                    l = y - obj.width / 3 + 5;
                    dx = -1;
                    dy = -1;
                    doorFunc = obj.num == 1 ? horizontalDoor : horizontalDoubleDoors;
                    break;
            }
            doorFunc(x, y, obj.width * obj.num, l, dx, dy);
        };
        Floorplan.prototype.createWindow = function(obj) {
            if(typeof obj.where == 'undefined') return;
            var x, y;
            var windowFunc, l = 0;
            switch (obj.where) {
                case 'left':
                    x = offsetX;
                    y = offsetY + obj.y;
                    l = x + 25;
                    windowFunc = verticalWindow;
                    break;
                case 'right':
                    x = this.length + offsetX;
                    y = offsetY + obj.y;
                    l = x - 25;
                    windowFunc = verticalWindow;
                    break;
                case 'top':
                    y = offsetY;
                    x = offsetX + obj.x;
                    l = y + 15;
                    windowFunc = horizontalWindow;
                    break;
                case 'bottom':
                    y = this.width + offsetY;
                    x = offsetX + obj.x;
                    l = y - 15;
                    windowFunc = horizontalWindow;
            }
            windowFunc(x, y, obj.width, l);
        };
        Floorplan.prototype.createWall = function (obj) {
            if(typeof obj.orientation == 'undefined') return;
            var w = 0, l = 0;
            switch(obj.orientation) {
                case 'vertical':
                    w = obj.thickness;
                    l = obj.width;
                    break;
                case 'horizontal':
                    w = obj.width;
                    l = obj.thickness;
                    break;
            }
            var wall = paper.rect(obj.x + offsetX, obj.y + offsetY, w, l);
            wall.attr({
                fill: 'black'
            });
        };
        Floorplan.prototype.createLabel = function (obj) {
            if(typeof obj.x == 'undefined') return;
            var label = paper.text(obj.x, obj.y, obj.label);
            label.attr({
                'font-size': '15px',
                'font-weight': 'bold'
            });
        };
        return Floorplan;
    })();
    window.convertToImage = function() {
        canvg('floorplan-canvas', $svg.html());
        $svg.hide();
        $canvas.hide();
        var $img = $('<img />');
        $img.attr('src', $canvas[0].toDataURL('image/png'));
        $('#floorplan').append($img);
    };
    window.Floorplan = Floorplan;
})();