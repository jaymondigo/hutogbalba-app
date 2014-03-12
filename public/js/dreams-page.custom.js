window.baseUrl = $('[base-url]').attr('base-url');
//$alert({type:'warning || danger || success', message: ''});
window.$alert = function(params) {

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
    window.open(strWindowUrl, "_blank", "scrollbars=1,resizable=1");

});