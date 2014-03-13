(function() {
    $.ajax({
        type: 'GET',
        url: baseUrl + '/dreamer/dream-house/' + DreamBuilder.ID,
        data: {
            id: DreamBuilder.ID
        },
        dataType: 'json',
        success: function(data) {
            data = data.properties;
            data = JSON.parse(data);
            var divider = (data.length / 250) > (data.width / 250) ? data.length / 250 : data.width / 250;
            DreamBuilder.setLength(data.length / divider).setWidth(data.width / divider).setHeight(data.height / divider);
            DreamBuilder.wall = data.wall;
            DreamBuilder.roof = data.roof;
            DreamBuilder.floor = data.floor;
            var d = new DreamBuilder.THREED();
            d.createFloor(data.floor);
            d.createWalls(data.wall);
            d.createRoof(data.roof);
            if (typeof data.rooms != 'undefined') {
                $.each(data.rooms, function(index, room) {
                    d.createRoom({
                        px: room.x / divider,
                        py: room.y / divider,
                        width: room.width / divider,
                        length: room.length / divider,
                        name: room.name
                    });
                });
            }
            if (typeof data.doors != 'undefined') {
                $.each(data.doors, function(index, door) {
                    d.createDoor({
                        length: door.length / divider,
                        width: door.width / divider,
                        where: door.where,
                        x: door.x / divider,
                        y: door.y / divider
                    });
                });
            }
            if (typeof data.windows != 'undefined') {
                $.each(data.windows, function(index, win) {
                    d.createWindow({
                        length: win.length / divider,
                        width: win.width / divider,
                        where: win.where,
                        x: win.x / divider,
                        y: win.y / divider,
                        t: (data.height - 100 - win.length) / divider
                    });
                });
            }
        }
    });
    $('#screenshot').click(function(e) {
        screenshot(function(url) {
            blob = window.dataURLtoBlob && window.dataURLtoBlob(url);
            var formData = new FormData();
            formData.append('picture', blob, 'picture.png');
            formData.append('id', DreamBuilder.ID);
            $.ajax({
                url: baseUrl + '/dreamer/upload-screenshot',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    alert('screenshot successfully saved!');
                }
            });

            // $.post(baseUrl + '/dreamer/upload-screenshot', {
            //     id: DreamBuilder.ID,
            //     url: url
            // }, function(resp) {
            //     console.log(resp);
            // });
            //window.open(url, '_blank ');
        });
    });
    $('#toggleRoof').click(function(e) {
        var $t = $(this);
        if (parseInt($t.attr('data-show'))) {
            $t.attr('data-show', 0);
            $t.html('Show Roof ');
            hideRoof();
        } else {
            $t.attr('data-show', 1);
            $t.html('Hide Roof ');
            showRoof();
        }
    });

})();