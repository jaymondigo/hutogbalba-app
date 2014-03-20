(function() {
    hasInit = false;
    var current = 4;
    var maxWidth = 1000;
    var pi = function(s) {
        return parseInt($(s).val());
    };
    var pf = function(s) {
        return parseFloat($(s).val());
    };

    var d, $designs = $('#designs'),
        $length = $('input[name=length]'),
        $width = $('input[name=width]'),
        $area = $('input[name=area]');

    var showDialog = function() {
        $('#step' + current).modal();
    };

    var clearSketchpad = function() {
        DreamBuilder.rooms = 0;
        DreamBuilder.doors = 0;
        DreamBuilder.windows = 0;
        DreamBuilder.walls = 0;
        DreamBuilder.ID = 0;
        DreamBuilder.house.rooms = [];
        DreamBuilder.house.windows = [];
        DreamBuilder.house.doors = [];
        DreamBuilder.house.walls = [];
        $('#sketchpad').empty(); //clear the sketchpad
        hasInit = false;

    };

    var addDeleteBtn = function() {
        if ($('#delete').length <= 0)
            $('[file-menu]').append('<li><a href="#" id="delete">Delete</a></li>');
    }
    var rmDeleteBtn = function() {
        $('#delete').remove();
    }

    var enableBtns = function() {
        $('[action-tools]').prop('disabled', false).removeAttr('disabled');
        $('[action-view]').prop('disabled', false).removeAttr('disabled');
    }
    var disableBtns = function() {
        $('[action-tools]').prop('disabled', true).addAttr('disabled');
        $('[action-view]').prop('disabled', true).addAttr('disabled');
    }
    var init = function() {
        DreamBuilder.divider = DreamBuilder.house.length > maxWidth ? maxWidth / DreamBuilder.house.length : 1;
        //set the new house dimensions
        DreamBuilder.setLength(DreamBuilder.house.length).setWidth(DreamBuilder.house.width).setHeight(DreamBuilder.house.height);
        d = new DreamBuilder.TWOD();
        //draw the floor
        d.createFloor();

        enableBtns();

        hasInit = true;
    };

    $(document).on('click', '.modal .back', function(e) {
        //revert back to the previous dialog
        current--;
        showDialog();
    });

    $(document).on('click', '.modal .next', function(e) {
        //proceed to the next dialog
        current++;
        showDialog();
    });

    $('#new').click(function(e) {
        //show the first dialog
        current = 1;
        showDialog();
    });

    $('#open').click(function(e) {
        dId = DreamBuilder.ID;
        var confrm = true;

        if (dId != 0)
            confrm = confirm('Any unsave data will be lost. Please make sure that everything was saved.');

        if (!confrm)
            return false;

        $('#open-dialog').modal();
        //get available designs
        $.ajax({
            url: baseUrl + '/dreamer/my-dreams',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $designs.empty();
                var $ul = $('<ul></ul>');
                $.each(data, function(i, design) {
                    if (design.id == DreamBuilder.ID)
                        return;

                    var $li = $('<li></li>');
                    $li.attr({
                        id: design.id,
                        'data-date-created': design.dateCreated
                    });
                    $a = "<a href='javascript:void(0)' open-design='" + design.id + "'>" + design.name + "</a>";
                    $li.html($a);
                    $ul.append($li);
                });
                $designs.append($ul);
            }
        });
    });

    $('#save').click(function(e) {

        if (!hasInit) {
            $DBSAlert({
                message: 'Nothing to save. Please create a new house design.',
                type: 'warning'
            });
            return false;
        }

        if (DreamBuilder.ID == 0)
            $('#save-dialog').modal('show');
        else
            $('#saveHouse').click();

        enableBtns();
    });

    $('#saveHouse').click(function() {

        name = $('[name="design_name"]').val();
        name = name == '' ? DreamBuilder.NAME : name;
        $.ajax({
            url: baseUrl + '/dreamer/save-dream',
            type: 'POST',
            data: {
                id: DreamBuilder.ID,
                name: name,
                house: DreamBuilder.house
            },
            success: function(data) {
                if (data.success) {
                    if ($('#delete').length <= 0)
                        addDeleteBtn();

                    enableBtns();

                    $('#save-dialog').modal('hide');
                    DreamBuilder.ID = data.ID;
                    DreamBuilder.NAME = data.name;
                    $('[name="design_name"]').val(data.name);
                    $('#view-3d').attr('house-id', data.ID);
                    $DBSAlert({
                        type: 'success',
                        message: 'Dream house design successfully save!'
                    });
                } else {
                    $('.save-notification').show();
                    $('[save-notification-content]').html(data.errors);
                }
            }
        });
    });

    $(document).on('click', '[open-design]', function() {
        $id = $(this).attr('open-design');
        addDeleteBtn();
        clearSketchpad();
        $.get(baseUrl + '/dreamer/dream-house/' + $id, function(resp) {
            enableBtns();
            hasInit = true;

            DreamBuilder.ID = resp.id;
            DreamBuilder.NAME = resp.name;
            $('[name="design_name"]').val(resp.name);
            $('#open-dialog').modal('hide');
            $('[house-id]').attr('house-id', resp.id);
            //create 2d
            data = resp.properties;
            var data = JSON.parse(data);

            DreamBuilder.house.length = parseFloat(data.length);
            DreamBuilder.house.width = parseFloat(data.width);
            DreamBuilder.house.height = parseFloat(data.height);

            DreamBuilder.divider = DreamBuilder.house.length > maxWidth ? maxWidth / DreamBuilder.house.length : 1;

            DreamBuilder.house.wall = {
                dimension: data.wall.thickness,
                element: data.wall.element
            };
            DreamBuilder.house.floor = {
                type: data.floor.type,
                tile: data.floor.tile,
                wood: data.floor.wood
            };
            DreamBuilder.house.roof = {
                type: data.roof.type,
                pitch: data.roof.pitch,
                element: data.roof.element
            };
            DreamBuilder.house.numFloors = data.numFloors;
            DreamBuilder.house.terrain = data.terrain;
            DreamBuilder.setLength(DreamBuilder.house.length).setWidth(DreamBuilder.house.width).setHeight(DreamBuilder.house.height);
            d = new DreamBuilder.TWOD();
            d.createFloor();
            if (typeof data.rooms != 'undefined') {
                $.each(data.rooms, function(i, room) {
                    d.createRoom({
                        px: room.x,
                        py: room.y,
                        width: parseFloat(room.width),
                        length: parseFloat(room.length),
                        name: room.name
                    });
                });
            }
            if (typeof data.windows != 'undefined') {
                $.each(data.windows, function(i, win) {
                    d.createWindow({
                        where: win.where,
                        x: win.x,
                        y: win.y,
                        width: parseFloat(win.width),
                        length: parseFloat(win.length)
                    });
                });
            }
            if (typeof data.doors != 'undefined') {
                $.each(data.doors, function(i, door) {
                    d.createDoor({
                        where: door.where,
                        x: door.x,
                        y: door.y,
                        width: parseFloat(door.width),
                        length: parseFloat(door.length),
                        type: door.type,
                        num: parseInt(door.num)
                    });
                });
            }
            if(typeof data.walls != 'undefined') {
                $.each(data.walls, function (i, wall) {
                    d.createWall({
                        orientation: wall.orientation,
                        x: wall.x,
                        y: wall.y,
                        width: wall.width,
                        thickness: wall.thickness
                    });
                });
            }
        });
    });
    $(document).on('click', '#delete', function() {
        var confrm = confirm('Please confirm your action "Delete ' + DreamBuilder.NAME + '"!');

        if (!confrm)
            return false;
        $.post(baseUrl + '/dreamer/delete-dream', {
            id: DreamBuilder.ID
        }, function(resp) {
            clearSketchpad();
            $DBSAlert({
                message: 'Your dream house was deleted successfully!',
                type: 'success'
            });
        });
    });
    $('#step2-form').submit(function(e) {
        DreamBuilder.house.numFloors = pi('select[name=num-floors]');
        DreamBuilder.house.terrain = pf('input[name=terrain]') * 100;
        DreamBuilder.house.height = pf('input[name=height]') * 100;
        $('#step2').modal('hide');
        current = 3;
        showDialog();
        return false;
    });

    $('#step3-form').submit(function(e) {
        DreamBuilder.house.length = pf('input[name=length]') * 100;
        DreamBuilder.house.width = pf('input[name=width]') * 100;
        $('#step3').modal('hide');
        current = 4;
        showDialog();
        return false;
    });

    $('#step4-form').submit(function(e) {
        DreamBuilder.house.roof = {
            type: $('select[name=roof-type]').val(),
            pitch: $('select[name=roof-pitch]').val(),
            element: $('select[name=roof-element]').val()
        };
        DreamBuilder.house.wall = {
            dimension: pi('select[name=wall-dim]'),
            element: $('select[name=wall-element]').val()
        };
        DreamBuilder.house.floor = {
            type: $('select[name=floor-type]').val(),
            tile: $('select[name=tile-dim]').val(),
            wood: $('select[name=wood-element]').val()
        };
        $('#step4').modal('hide');
        current = 5;
        showDialog();
        return false;
    });

    $('#finish').click(function(e) {
        //reset house properties then initialize new
        clearSketchpad();
        init();
        rmDeleteBtn();
    });

    $('#new-room-form').submit(function(e) {
        if (!hasInit) {
            $('.modal').modal('hide');
            $DBSAlert({
                message: 'Create a house first before adding room.',
                type: 'warning'
            });

            return false;
        }
        d.createRoom({
            px: 0,
            py: 0,
            width: pf('input[name=room-length]') * 100,
            length: pf('input[name=room-width]') * 100,
            name: $('input[name=room-name]').val()
        });
        $('#new-room-dialog').modal('hide');
        return false;
    });

    $('#new-door-form').submit(function(e) {
        if (!hasInit) {
            $('.modal').modal('hide');
            $DBSAlert({
                message: 'Create a house first before adding door.',
                type: 'warning'
            });
            return false;
        }
        var where = $('select[name=door-where]').val();
        var dim = $('input[name=door-dim]').val();
        dim = dim.split('x');
        var l = dim[0].split('.');
        var w = dim[1].split('.');
        var width = (parseInt(w[0]) * 12 + parseInt(w[1])) * 2.54;
        var length = (parseInt(l[0]) * 12 + parseInt(l[1])) * 2.54;
        d.createDoor({
            x: 0,
            y: 0,
            width: width,
            length: length,
            where: where,
            type: $('input[name=door-dim]').data('type'),
            num: parseInt($('select[name=door-num]').val())
        });
        $('#new-door-dialog').modal('hide');
        return false;
    });

    $('#new-window-form').submit(function(e) {
        if (!hasInit) {
            $('.modal').modal('hide');
            $DBSAlert({
                message: 'Create a house first before adding window.',
                type: 'warning'
            });
            return false;
        }
        var where = $('select[name=window-where]').val();
        var dim = $('input[name=window-dim]').val();
        dim = dim.split('x');
        var l = dim[0].split('.');
        var w = dim[1].split('.');
        var width = (parseInt(w[0]) * 12 + parseInt(w[1])) * 2.54;
        var length = (parseInt(l[0]) * 12 + parseInt(l[1])) * 2.54;
        d.createWindow({
            x: 0,
            y: 0,
            width: width,
            length: length,
            where: where
        });
        $('#new-window-dialog').modal('hide');
        return false;
    });

    $('#new-wall-form').submit(function(e) {
        if (!hasInit) {
            $('.modal').modal('hide');
            $DBSAlert({
                message: 'Create a house first before adding window.',
                type: 'warning'
            });
            return false;
        }
        var width = pf('input[name=wall-width]') * 100;
        var thickness = pf('input[name=wall-thickness]');
        var orientation = $('input[name=wall-orientation]:checked').val();
        d.createWall({
            x: 0,
            y: 0,
            width: width,
            thickness: thickness,
            orientation: orientation
        });
        $('#new-wall-dialog').modal('hide');
        return false;
    });

    var area = function(e) {
        //calculate are of house
        $area.val(parseFloat($length.val()) * parseFloat($width.val()));
    };

    $length.bind('change paste keyup', area);

    $width.bind('change paste keyup', area);

    var roomArea = function(e) {
        //calculate area of the room
        $('input[name=room-area]').val(pf('input[name=room-length]') * pf('input[name=room-width]'));
    };

    $('input[name=room-length]').bind('change paste keyup', roomArea);

    $('input[name=room-width]').bind('change paste keyup', roomArea);

    window.d = d;

})();