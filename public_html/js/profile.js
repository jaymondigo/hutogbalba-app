baseUrl = $('[base-url]').attr('base-url');

if ($('#error-password').length > 0) {
    $("#change-pass-dialog").modal('show');
}

$('.editable').prop('contenteditable', true);

$(document).on('keyup', '[name="password_confirmation"], [name="password"]', function() {
    newPass = $('[name="password"]').val();
    confPass = $('[name="password_confirmation"]').val();

    console.log(newPass, confPass);
    if (newPass != confPass) {
        $('#submit-change-pass').prop('disabled', true);
        $('#password-alert').show();
    } else {
        $('.pass-con-alert').remove();
        $('#password-alert').hide();
        $('#submit-change-pass').prop('disabled', false);
    }

});

$(document).on('keyup', '.editable', function() {
    $('#saveChanges').prop('disabled', false);
});

$(document).on('click', '#saveChanges', function() {
    inputs = $('.editable');
    data = {};

    data['id'] = $('[name="id"]').val();
    $.each(inputs, function(i, input) {
        data[$(input).attr('id')] = $(input).html();
    });

    $.post(baseUrl + '/user/update-info', data, function(resp) {
        if (resp.length <= 0) {
            $('#error-info').remove();
            $('.content').prepend(' <div id="success-info" class="alert alert-success alert-dismissable" style="padding-left:10px; margin-left:0px;">' + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + '<a href="#" class="alert-link">' + 'User info successfully updated' + '</a>' + '</div>');
        } else {
            $('#success-info').remove();
            $('.content').prepend(' <div id="error-info" class="alert alert-danger alert-dismissable" style="padding-left:10px; margin-left:0px;">' + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + '<a href="#" class="alert-link">' + 'Something went wrong. Please try again.' + '</a>' + '</div>');
        }
    });
});

$(document).on('click', '#avatar', function() {
    $('[name="avatar"]').click();
});

$(document).on('change', '[name="avatar"]', function() {
    $('[name="avatar-form"]').submit();
});