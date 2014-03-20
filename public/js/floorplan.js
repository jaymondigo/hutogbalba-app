(function() {
    var offsetX = 100,
        offsetY = 100,
        bgColor = 'white';
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
            var name = paper.text(offsetX / 2, offsetY / 3, obj.name);
            name.attr({
                'font-style': 'italic',
                'font-size': '10px'
            });
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
            var label = paper.text(l, y + width / 2, (width / 100).toFixed(2) + ' m');
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
            var label = paper.text(x + width / 2, l, (width / 100).toFixed(2) + ' m');
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
            var label = paper.text(l, y + width / 2, (width / 100).toFixed(2) + ' m');
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
            var label = paper.text(x + offsetX / 2, l, (width / 100).toFixed(2) + ' m');
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
                'stroke': 'gray',
                'stroke-width': '4'
            });
            var label = paper.text(obj.x + offsetX + obj.width / 2, obj.y + offsetY + obj.length / 2, obj.name);
            label.attr({
                'font-size': '15px',
                'font-weight': 'bold'
            });
            var m1 = paper.text(obj.x + offsetX + obj.width / 2, obj.y + offsetY + obj.length / 2 + 25, (obj.length / 100).toFixed(2) + ' m');
            var m2 = paper.text(obj.x + offsetX + obj.width / 2 + 50, obj.y + offsetY + obj.length / 2, (obj.width / 100).toFixed(2) + ' m');
        };
        Floorplan.prototype.createDoor = function(obj) {
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