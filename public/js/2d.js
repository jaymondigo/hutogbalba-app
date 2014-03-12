(function () {

	$.ajax({

		url: 'samples/house.json',

		type: 'GET',

		dataType: 'json',

		success: function (data) {

			DreamBuilder.house.length = data.length;
			DreamBuilder.house.width = data.width;
			DreamBuilder.house.height = data.height;
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


			$('#sketchpad').empty();

			DreamBuilder.setLength(DreamBuilder.house.length).setWidth(DreamBuilder.house.width).setHeight(DreamBuilder.house.height);

			d = new DreamBuilder.TWOD();

			d.createFloor();

			$.each(data.rooms, function (i, room) {

				d.createRoom({

					px: room.x,

					py: room.y,

					width: room.width,

					length: room.length,

					name: room.name

				});

			});

			$.each(data.windows, function (i, win) {

				d.createWindow({

					where: win.where,

					x: win.x,

					width: win.width,

					length: win.length

				});

			});

			$.each(data.doors, function (i, door) {

				d.createDoor({

					where: door.where,

					x: door.x,

					width: door.width,

					length: door.length

				});

			});

			window.d = d;

		},

		error: function (xhr, error) {

			console.error(error);

		}

	});

})();