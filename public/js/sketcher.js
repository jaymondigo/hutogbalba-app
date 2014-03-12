(function() {

    var current = 4;
    var pi = function(s) {
        return parseInt($(s).val());
    };

    var d, $designs = $('#designs'),
        $length = $('input[name=length]'),
        $width = $('input[name=width]'),
        $area = $('input[name=area]');

    var showDialog = function() {
        $('#step' + current).modal();
    };

    var init = function() {
        $('#sketchpad').empty(); //clear the sketchpad
        //set the new house dimensions
        DreamBuilder.setLength(DreamBuilder.house.length).setWidth(DreamBuilder.house.width).setHeight(DreamBuilder.house.height);
        d = new DreamBuilder.TWOD();
        //draw the floor
        d.createFloor();
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
                    var $li = $('<li></li>');
                    $li.attr({
                        id: design.id,
                        'data-date-created': design.dateCreated
                    });
                    $li.text(design.name);
                    $ul.append($li);
                });
                $designs.append($ul);
            }
        });
    });

    $('#save').click(function(e) {

        if (typeof DreamBuilder.house.length == 'undefined' || DreamBuilder.house.length <= 0) {
            $alert({
                message: 'Nothing to save. Please create a new house design.',
                type: 'warning'
            });
            return false;
        }
        $.ajax({
            url: baseUrl + '/dreamer/save-dream',
            type: 'POST',
            data: {
                id: DreamBuilder.ID,
                house: DreamBuilder.house
            },
            success: function(data) {
                if (data.success) {
                    DreamBuilder.ID = data.ID;
                    $('#view-3d').attr('house-id', data.ID);
                    //save successful
                }
            }
        });
    });

    $('#step2-form').submit(function(e) {
        DreamBuilder.house.numFloors = pi('select[name=num-floors]');
        DreamBuilder.house.terrain = pi('input[name=terrain]');
        DreamBuilder.house.height = pi('input[name=height]');
        $('#step2').modal('hide');
        current = 3;
        showDialog();
        return false;
    });

    $('#step3-form').submit(function(e) {
        DreamBuilder.house.length = pi('input[name=length]');
        DreamBuilder.house.width = pi('input[name=width]');
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
        DreamBuilder.ID = 0;
        DreamBuilder.house.rooms = [];
        DreamBuilder.house.windows = [];
        DreamBuilder.house.doors = [];
        init();
    });

    $('#new-room-form').submit(function(e) {
        d.createRoom({
            px: 0,
            py: 0,
            width: pi('input[name=room-length]'),
            length: pi('input[name=room-width]'),
            name: $('input[name=room-name]').val()
        });
        $('#new-room-dialog').modal('hide');
        return false;
    });

    $('#new-door-form').submit(function(e) {
        var where = $('select[name=door-where]').val();
        var dim = $('input[name=door-dim]').val();
        dim = dim.split('x');
        var l = dim[0].split('.');
        var w = dim[1].split('.');
        var width = (parseInt(w[0]) * 12 + parseInt(w[1])) * 2.54;
        var length = (parseInt(l[0]) * 12 + parseInt(l[1])) * 2.54;
        d.createDoor({
            x: 0,
            width: width,
            length: length,
            where: where
        });
        $('#new-door-dialog').modal('hide');
        return false;
    });

    $('#new-window-form').submit(function(e) {
        var where = $('select[name=window-where]').val();
        var dim = $('input[name=window-dim]').val();
        dim = dim.split('x');
        var l = dim[0].split('.');
        var w = dim[1].split('.');
        var width = (parseInt(w[0]) * 12 + parseInt(w[1])) * 2.54;
        var length = (parseInt(l[0]) * 12 + parseInt(l[1])) * 2.54;
        d.createWindow({
            x: 0,
            width: width,
            length: length,
            where: where
        });
        $('#new-window-dialog').modal('hide');
        return false;
    });

    var area = function(e) {
        //calculate are of house
        $area.val(parseInt($length.val()) * parseInt($width.val()) / 10000);
    };

    $length.bind('change paste keyup', area);

    $width.bind('change paste keyup', area);

    var roomArea = function(e) {
        //calculate area of the room
        $('input[name=room-area]').val(pi('input[name=room-length]') * pi('input[name=room-width]') / 10000);
    };

    $('input[name=room-length]').bind('change paste keyup', roomArea);

    $('input[name=room-width]').bind('change paste keyup', roomArea);

    window.d = d;

})();