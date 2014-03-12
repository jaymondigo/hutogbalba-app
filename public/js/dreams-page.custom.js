window.childWindow = '';
//$alert({type:'warning || danger || success', message: ''});
window.$alert = function(params) {
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
}

$(document).on('click', '#view-3d', function() {
    houseId = $(this).attr('house-id');

    if (houseId == '') {
        $alert({
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
    } else {
        childWindow.location.reload();
    }
    childWindow.focus();
});