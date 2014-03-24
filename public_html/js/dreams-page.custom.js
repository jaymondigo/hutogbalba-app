window.childWindow = '';
//$DBSAlert({type:'warning || danger || success', message: ''});
window.$DBSAlert = function(params) {

    if ($('#alert-con').length <= 0) {
        $('.notification').html('<div id="alert-con" class="alert alert-success alert-dismissable" style="padding-left:10px; margin-left:0px;">' +
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
            '<a href="#" class="alert-link" notification-content>' +
            'Alert!' +
            '</a>' +
            '</div>');
    }

    $('#alert-con').removeClass('alert-success').removeClass('alert-danger').removeClass('alert-warning');

    $('#alert-con').addClass('alert-' + params.type);

    $('[notification-content]').html(params.message);

    $('.notification').show();

    setTimeout(function() {
        $('.notification').fadeOut();
    }, 3000);
}

$(document).on('click', '#view-3d', function() {
    houseId = DreamBuilder.ID;

    if (houseId == '' || houseId == 0) {
        $DBSAlert({
            type: 'warning',
            message: 'Please save your house design first!'
        });
        return false;
    }
    // var strWindowFeatures = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    // var strWindowName = 'Preview 3D - House Design ID #' + houseId;
    var strWindowUrl = baseUrl + '/dreamer/preview3d/' + houseId;
    // window.open(strWindowUrl, "_blank", strWindowFeatures);
    if (childWindow == '' || childWindow.closed) {
        childWindow = window.open(strWindowUrl, "_blank", "scrollbars=no,resizable=no");
    }

    childWindow.location.href = strWindowUrl;

    childWindow.focus();
});

$(document).on('click', '#view-floorplan', function() {
    houseId = parseInt(DreamBuilder.ID);

    if (typeof houseId != 'number' || houseId == NaN || houseId == 0) {
        $DBSAlert({
            type: 'warning',
            message: 'Please save your house design first!'
        });
        return false;
    }
    // var strWindowFeatures = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    // var strWindowName = 'Preview 3D - House Design ID #' + houseId;
    var strWindowUrl = baseUrl + '/dreamer/preview-floorplan/' + houseId;
    // window.open(strWindowUrl, "_blank", strWindowFeatures);
    if (childWindow == '' || childWindow.closed) {
        childWindow = window.open(strWindowUrl, "_blank", "scrollbars=no,resizable=no");
    }

    childWindow.location.href = strWindowUrl;

    childWindow.focus();
});

$(document).on('click', '[view-dream]', function() {
    id = $(this).data('id');
    $.get(baseUrl + '/dreamer/preview-dream/' + id, function(resp) {
        $('[dream-content]').html(resp);
    });
});

$(document).on('click', '[view-estimate]', function() {
    houseId = parseInt(DreamBuilder.ID);

    if (typeof houseId != 'number' || houseId == NaN || houseId == '' || houseId == 0) {
        $DBSAlert({
            type: 'warning',
            message: 'Please save your house design first!'
        });
        return false;
    }
    $.get(baseUrl + '/dreamer/estimate/' + houseId, function(resp) {
        $('[estimate-content]').html(resp);
        $('.product-type').each(function(i, product) {
            type = $(this).attr('type');
            $.get(baseUrl + '/product/select/' + type, {
                i: i
            }, function(resp) {
                $('[type="' + resp['type'] + '"]').html(resp['html']);

                price = $('[name="price[' + i + ']"]').val();

                price = price == null || typeof price == 'undefined' ? 0 : price * 1;
                $('[p-price=' + resp['type'] + ']').html(price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

                calculatePrices();

            }, 'json');
        });


    });

    $('#estimate-dialog').modal('show');
});
$(document).on('click', '[view-options]', function() {
    id = $(this).data('id');
    $.get(baseUrl + '/dreamer/options', function(resp) {
        $('[options-content]').html(resp);
    });
});

$(document).on('change', '[price-options]', function() {
    calculatePrices();
});

window.calculatePrices = function() {
    total = 0;
    $.each($('[p-qnty]'), function(i, data) {
        type = $(data).attr('p-qnty');

        qnty = $(data).text();
        price = $('[name="price[' + i + ']"]').val();

        $('[p-price="' + type + '"]').text(price);
        price_cost = qnty * price;

        $('[p-tprice="' + type + '"]').text(price_cost.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        total += price_cost;
    });

    $('[overall-total-price]').html(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
}


$('#sketchpad').css('height', $(window).height());
$('#sketchpad').css('min-height', $(window).height());
$('#sketchpad').bind('mousewheel', function(event) {
    if (event.originalEvent.wheelDelta >= 0) {
        zoom({
            type: 'in'
        });
        return false;
    } else {
        zoom({
            type: 'out'
        });
        return false;
    }
});

$.fn.attachDragger = function(e) {
    var attachment = false,
        lastPosition, position, difference;
    $($(this).selector).on("mousedown mouseup mousemove", function(e) {

        if (e.target.nodeName == 'rect')
            return true;

        if (e.type == "mousedown") attachment = true, lastPosition = [e.clientX, e.clientY];
        if (e.type == "mouseup") attachment = false;
        if (e.type == "mousemove" && attachment == true) {
            position = [e.clientX, e.clientY];
            difference = [(position[0] - lastPosition[0]), (position[1] - lastPosition[1])];
            $(this).scrollLeft($(this).scrollLeft() - difference[0]);
            $(this).scrollTop($(this).scrollTop() - difference[1]);
            lastPosition = [e.clientX, e.clientY];
        }
    });
    $(window).on("mouseup", function() {
        attachment = false;

    });


}

$('#sketchpad').attachDragger();

$(document).on('mousedown', '[zoom-in]', function() {
    zoom({
        type: 'in'
    });
});

$(document).on('mousedown', '[zoom-out]', function() {
    zoom({
        type: 'out'
    });
});

$(document).on('mousedown', '[zoom-orig]', function() {
    zoom({
        type: 'normal'
    });
});

$('#sketchpad svg').css('zoom', 'normal');

function zoom(obj) {
    z = $('#sketchpad svg').css('zoom');
    m = z * 100;
    switch (obj.type) {
        case 'normal':
            $('#sketchpad svg').css('zoom', 'normal');
            break;
        case 'in':
            $('#sketchpad svg').css('zoom', m + 1 * 1 + '%');
            break;

        case 'out':
            $('#sketchpad svg').css('zoom', m - 1 * 1 + '%');
            break;
        default:

            break;

    }
}

$(document).on('click', '[action-tools]', function() {
    $('#sketchpad').css('zoom', 'normal');
});
$(document).on('mousedown', '#sketchpad', function() {
    $('html, body').animate({
        scrollTop: $(this).offset().top - 70
    }, 1000);
});