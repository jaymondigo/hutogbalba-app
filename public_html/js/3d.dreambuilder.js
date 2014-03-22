(function() {

    //require DreamBuilder object to be loaded first

    if (typeof DreamBuilder != 'object') {
        var message = 'DreamBuilder object is required.';
        console.error(message);
        alert(message);
    }

    var renderer, scene, camera, controls;

    var $sketcher = $('#sketcher');

    //get the renderer dimensions

    var width = $sketcher.width();

    var height = $sketcher.height();

    var wall = {
        left: {
            object: null,
            x: ['length', -1],
            z: 'height',
            position: 'vertical',
            width: 'width'
        },
        top: {
            object: null,
            y: ['width', 1],
            z: 'height',
            position: 'horizontal',
            width: 'length'
        },
        right: {
            object: null,
            x: ['length', 1],
            z: 'height',
            position: 'vertical',
            width: 'width'
        },
        bottom: {
            object: null,
            y: ['width', -1],
            z: 'height',
            position: 'horizontal',
            width: 'length'
        }
    };

    var room = {
        left: {
            position: 'vertical'
        },
        top: {
            position: 'horizontal'
        },
        right: {
            position: 'vertical'
        },
        bottom: {
            position: 'horizontal'
        }
    };

    //keep track objects

    var rooms = [];
    var walls = [];
    var doors = [];
    var windows = [];

    //keep track dimensions

    var roomz = [];
    var wallz = [];
    var doorz = [];
    var windowz = [];
    var roof = {};
    var that;

    //degrees to radians
    var d2r = function(d) {
        return d * Math.PI / 180;
    };

    //radians to degress
    var r2d = function(r) {
        return r * 180 / Math.PI;
    };

    //get side and angle measurement of the right triangle

    /*
	@param A: number => angle A in degress
	@param b: number => side b
	*/
    var triangleElevation = function(obj) {
        var triangle = {
            A: obj.A,
            b: obj.b,
            B: 90 - obj.A,
            C: 90
        };
        triangle.c = triangle.b / Math.cos(d2r(triangle.A));
        triangle.a = Math.sqrt(Math.pow(triangle.c, 2) - Math.pow(triangle.b, 2));
        return triangle;
    };

    //handle window resiZE
    var onWindowResize = function() {
        width = $sketcher.width();
        height = $sketcher.height();
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
    };

    var animate = function() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    };

    //initialize three.js
    var init = function() {
        that = this;
        scene = new THREE.Scene();
        scene.add(camera);
        var rendererOptions = {
            antialias: true,
            preserveDrawingBuffer: true, //preserve for screenshot
            alpha: true,
            transparent: true,
            opacity: 1
        };
        renderer = Detector.webgl ? new THREE.WebGLRenderer(rendererOptions) : new THREE.CanvasRenderer(rendererOptions);
        renderer.setSize(width, height);
        renderer.setClearColor(0x000000, 0);
        document.getElementById('sketcher').appendChild(renderer.domElement);
        camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
        camera.position.x = 5;
        camera.position.z = 1000;
        controls = new THREE.TrackballControls(camera, renderer.domElement);
        window.addEventListener('resize', onWindowResize, false);
        var light = new THREE.AmbientLight(0xffffff); // white light
        scene.add(light);
        //add grass to the ground
        var t = THREE.ImageUtils.loadTexture(baseUrl + '/img/grass.jpg');
        t.wrapS = t.wrapT = THREE.RepeatWrapping;
        var material = new THREE.MeshPhongMaterial({
            map: t
        });
        var grass = new THREE.Mesh(new THREE.CubeGeometry(500, 500, 1), material);
        grass.position.z = -1;
        scene.add(grass);
        animate();
        window.renderer = renderer;
    };

    var Roof = function(obj) {
        var geometry = new THREE.CubeGeometry(0.1, obj.height, obj.width);
        var material = new THREE.MeshPhongMaterial({
            map: THREE.ImageUtils.loadTexture(baseUrl + '/img/roof/' + DreamBuilder.roof.element + '.png')
        });
        var mesh = new THREE.Mesh(geometry, material);
        //tilt roof 66 deg
        mesh.rotation.z = d2r(66) * obj.lat;
        //rotate roof 90 deg down
        mesh.rotation.x = d2r(90);
        mesh.position.x = obj.height / 2.2 * obj.lat;
        mesh.position.z = DreamBuilder.get('height') + (DreamBuilder.get('length') / 10.12);
        document.addEventListener('showRoof', function(e) {
            mesh.material.visible = true;
        });
        document.addEventListener('hideRoof', function(e) {
            mesh.material.visible = false;
        });
        return mesh;
    };

    var Floor = function(obj) {
        var geometry = new THREE.CubeGeometry(obj.length, obj.width, 1);
        var f = DreamBuilder.floor.type == 'ceramic_tile' ? 'ceramic_tile.png' : 'hardwood_floor.png';
        var t = THREE.ImageUtils.loadTexture(baseUrl + '/img/floor/' + f);
        t.wrapS = t.wrapT = THREE.RepeatWrapping;
        var material = new THREE.MeshPhongMaterial({
            map: t
        });
        var mesh = new THREE.Mesh(geometry, material);
        return mesh;
    };

    var Wall = function(obj) {
        var w = wall[obj.where];
        var move;
        var geometry;
        switch (obj.position) {
            case 'vertical':
                geometry = new THREE.CubeGeometry(1, obj.width, obj.height);
                move = 'x';
                break;
            case 'horizontal':
                geometry = new THREE.CubeGeometry(obj.width, 1, obj.height);
                move = 'y';
                break;
        }
        var t = THREE.ImageUtils.loadTexture(baseUrl + '/img/wall/' + DreamBuilder.wall.element + '.png');
        t.wrapS = t.wrapT = THREE.RepeatWrapping;
        var material = new THREE.MeshPhongMaterial({
            map: t
        });
        var mesh = new THREE.Mesh(geometry, material);
        mesh.position[move] = DreamBuilder.get(w[move][0]) / 2 * w[move][1];
        mesh.position.z = obj.height / 2;
        return mesh;
    };

    var Room = function(obj) {
        var geometry = new THREE.CubeGeometry(obj.width, obj.length, DreamBuilder.get('height'));
        var material = new THREE.MeshPhongMaterial({
            map: THREE.ImageUtils.loadTexture(baseUrl + '/img/room.jpg')
        });
        var mesh = new THREE.Mesh(geometry, material);
        mesh.position.z = DreamBuilder.get('height') / 2;
        mesh.position.x = obj.x - DreamBuilder.get('length') / 2 + obj.width / 2;
        mesh.position.y = (DreamBuilder.get('width') - obj.length - obj.y) / 2;
        return mesh;
    };

    var Cylinder = function(obj) {
        var geometry = new THREE.CylinderGeometry(obj.tr, obj.br, obj.height, 50);
        var material = new THREE.MeshBasicMaterial({
            color: Math.random() * 0xffffff
        });
        var mesh = new THREE.Mesh(geometry, material);
        mesh.position.z = 150;
        mesh.rotation.x = d2r(90);
        return mesh;
    };

    var Window = function(obj) {

    };

    var d = DreamBuilder.THREED = function(obj) {
        init.call(this);
    };

    d.prototype.init = init;

    d.prototype.createRoof = function(obj) {
        var triangle = triangleElevation({
            A: 25,
            b: DreamBuilder.get('length') / 2
        });
        var h = triangle.c + (triangle.c / 7.5);
        var w = DreamBuilder.get('width') + (DreamBuilder.get('width') / 5);
        var left = new Roof({
            height: h,
            width: w,
            pz: triangle.a,
            lat: 1 // tilt roof positive deg
        });
        var right = new Roof({
            height: h,
            width: w,
            pz: triangle.a,
            lat: -1 //tilt roof negative deg
        });
        scene.add(left);
        scene.add(right);
        roof.length = h;
        roof.width = w;
        return this;
    };

    d.prototype.createFloor = function(obj) {
        scene.add(new Floor({
            length: DreamBuilder.get('length'),
            width: DreamBuilder.get('width'),
        }));
        return this;
    };

    d.prototype.createWall = function(obj) {
        var w = new Wall({
            height: obj.height,
            width: DreamBuilder.get(wall[obj.where].width),
            where: obj.where,
            position: wall[obj.where].position
        });
        wall[obj.where].object = w;
        scene.add(w);
        return this;
    };

    d.prototype.createWalls = function(obj) {
        ['left', 'top', 'right', 'bottom'].forEach(function(where) {
            that.createWall({
                height: DreamBuilder.get('height'),
                where: where
            });
        });
    };

    d.prototype.createRoom = function(obj) {
        var left = new Room({
            width: 1,
            length: obj.length,
            x: obj.px,
            y: obj.py * 2
        });
        var top = new Room({
            width: obj.width,
            length: 1,
            x: obj.px,
            y: obj.py * 2
        });
        var right = new Room({
            width: 1,
            length: obj.length,
            x: obj.px + obj.width - 2,
            y: obj.py * 2
        });
        var bottom = new Room({
            width: obj.width,
            length: 1,
            x: obj.px,
            y: (obj.py + obj.length) * 2 - 2
        });
        scene.add(left);
        scene.add(top);
        scene.add(right);
        scene.add(bottom);
    };

    d.prototype.createDoor = function(obj) {
        var x = 0,
            y = 0,
            rotate = false;
        switch (obj.where) {
            case 'left':
                x = 0 - DreamBuilder.get('length') / 2;
                y = DreamBuilder.get('width') / 2 - obj.width / 2 - (obj.y || 0);
                break;
            case 'right':
                x = DreamBuilder.get('length') / 2;
                y = DreamBuilder.get('width') / 2 - obj.width / 2 - (obj.y || 0);
                break;
            case 'top':
                x = obj.x - DreamBuilder.get('length') / 2 - obj.width / 2 + obj.width;
                y = DreamBuilder.get('width') / 2;
                rotate = -90;
                break;
            case 'bottom':
                x = obj.x - DreamBuilder.get('length') / 2 - obj.width / 2 + obj.width;
                y = 0 - DreamBuilder.get('width') / 2;
                rotate = 90;
                break;
        }
        var geometry = new THREE.CubeGeometry(2, obj.width, obj.length);
        var material = new THREE.MeshPhongMaterial({
            map: THREE.ImageUtils.loadTexture(baseUrl + '/img/door.jpg')
        });
        var mesh = new THREE.Mesh(geometry, material);
        mesh.position.z = obj.length / 2;
        mesh.position.x = x
        mesh.position.y = y;
        if (rotate) mesh.rotation.z = d2r(rotate);
        scene.add(mesh);
    };

    d.prototype.createCR = function(obj) {
        var color = Math.random() * 0xffffff;
        var geometry1 = new THREE.CylinderGeometry(25, 25, 10, 50);
        var material1 = new THREE.MeshBasicMaterial({
            color: color
        });
        var mesh1 = new THREE.Mesh(geometry1, material1);
        var geometry2 = new THREE.CylinderGeometry(2, 15, 15, 50);
        var material2 = new THREE.MeshBasicMaterial({
            color: color
        });
        var mesh2 = new THREE.Mesh(geometry2, material2);
        mesh1.rotation.x = d2r(90);
        mesh2.rotation.x = d2r(90);
        mesh1.position.z = 175;
        mesh2.position.z = 165;
        mesh2.position.y = 10;
        scene.add(mesh1);
        scene.add(mesh2);
    };

    d.prototype.createWindow = function(obj) {
        var x = 0,
            y = 0,
            rotate = false;
        switch (obj.where) {
            case 'left':
                x = 0 - DreamBuilder.get('length') / 2;
                y = DreamBuilder.get('width') / 2 - obj.width / 2 - obj.y;
                break;
            case 'right':
                x = DreamBuilder.get('length') / 2;
                y = DreamBuilder.get('width') / 2 - obj.width / 2 - obj.y;
                break;
            case 'top':
                x = obj.x - DreamBuilder.get('length') / 2 - obj.width / 2 + obj.width;
                y = DreamBuilder.get('width') / 2;
                rotate = -90;
                break;
            case 'bottom':
                x = obj.x - DreamBuilder.get('length') / 2 - obj.width / 2 + obj.width;
                y = 0 - DreamBuilder.get('width') / 2;
                rotate = 90;
                break;
        }
        var geometry = new THREE.CubeGeometry(2, obj.width, obj.length);
        var material = new THREE.MeshPhongMaterial({
            map: THREE.ImageUtils.loadTexture(baseUrl + '/img/window.jpg')
        });
        var mesh = new THREE.Mesh(geometry, material);
        mesh.position.z = DreamBuilder.get('height') - obj.t - obj.length / 2;
        mesh.position.x = x
        mesh.position.y = y;
        if (rotate) {
            mesh.rotation.z = d2r(rotate);
        }
        scene.add(mesh);
    };

    d.prototype.churva = function() {
        var geometry = new THREE.SphereGeometry(50, 100, 100);
        var material = new THREE.MeshBasicMaterial({
            color: 0xff0000
        });
        var mesh = new THREE.Mesh(geometry, material);
        mesh.position.z = 100;
        scene.add(mesh);
    };

    window.showRoof = function() {
        var sr = new CustomEvent('showRoof', {});
        document.dispatchEvent(sr);
    };

    window.hideRoof = function() {
        var hr = new CustomEvent('hideRoof', {});
        document.dispatchEvent(hr);
    };

    window.screenshot = function(callback) {
        callback(renderer.domElement.toDataURL());
    };

})();