baseUrl = $('[base-url]').attr('base-url');

$(document).on('click', '[action-add-vendor]', function() {
    $.get(baseUrl + '/vendor/create', function(data) {
        $('[add-vendor]').html(data);
    });
});

$(document).on('click', '[action-edit-vendor]', function() {
    id = $(this).attr('action-edit-vendor');
    $.get(baseUrl + '/vendor/' + id + '/edit', function(data) {
        console.log(data);
        $('[edit-vendor]').html(data);
    });
});

$(document).on('click', '[action-delete-vendor]', function() {
    id = $(this).attr('action-delete-vendor');
    $.get(baseUrl + '/vendor/delete/' + id, function(data) {
        $('[delete-vendor]').html(data);
    });
});

$(document).on('click', '[action-view-vendor]', function() {
    id = $(this).attr('action-view-vendor');
    $.get(baseUrl + '/vendor/' + id, function(data) {
        $('[view-vendor]').html(data);
    });
});