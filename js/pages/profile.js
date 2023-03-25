$(document).ready(function() {
    currentUser();
});

$('#myTabs a').click(function(e) {
    e.preventDefault();
    $(this).tab('show')
});

function resetHelpInLine() {
    $('span.help-inline').each(function() {
        $(this).text('');
    });
}

function currentUser() {
    $.ajax({
        url: '../server/users/auth/',
        async: false,
        headers: {
            'X-Auth-Token' : $("input[name='csrf']" ).val()
        },
        type: 'GET',
        success: function(response) {
            $("#fname").val(response.fname);
            $("#lname").val(response.lname);
            $("#email").val(response.email);
            $("#username").val(response.username);
            $('#mobileno').val(response.mobileno);
        },
        error: function(error) {
            console.log("Error:");
            console.log(error.responseText);
            console.log(error.message);
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
            }
            return;
        }
    });
}


function saveAccount() {
    resetHelpInLine();

    var empty = false;

    $('input[type="text"]').each(function() {
        $(this).val($(this).val().trim());
    });

    if ($('#username').val() == '') {
        $('#username').next('span').text('Username is required.');
        empty = true;
    }

    if ($('#password').val() == '') {
        $('#password').next('span').text('Password is required.');
        empty = true;
    }

    if ($('#password2').val() == '') {
        $('#password2').next('span').text('Confirm Password is required.');
        empty = true;
    }

    if ($('#password').val() !== $('#password2').val()) {
        $('#password').next('span').text('Password and Confirm password must be the same.');
        empty = true;
    }

    if (empty == true) {
        $.notify('Please input all the required fields correctly.', "error");
        return false;
    }

    $.ajax({
        url: '../server/users/account/' + $('#user_id').val(),
        async: false,
        type: 'PUT',
        headers: {
            'X-Auth-Token' : $("input[name='csrf']" ).val()
        },
        data: {
            username: $('#username').val(),
            password: $('#password').val()
        },
        success: function(response) {
            var decode = response;
            if (decode.success == true) {
                $.notify(decode.msg, "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else if (decode.success === false) {
                $.notify(decode.error, "error");
                return;
            }
        },
        error: function(error) {
            console.log("Error:");
            console.log(error.responseText);
            console.log(error.message);
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
            }
            return;
        }
    });
}


function saveProfile() {
    resetHelpInLine();

    var empty = false;

    $('input[type="text"]').each(function() {
        $(this).val($(this).val().trim());
    });

    if ($('#fname').val() == '') {
        $('#fname').next('span').text('Username is required.');
        empty = true;
    }

    if ($('#lname').val() == '') {
        $('#lname').next('span').text('Password is required.');
        empty = true;
    }

    if ($('#email').val() == '') {
        $('#email').next('span').text('Confirm Password is required.');
        empty = true;
    }

    if ($('#mobileno').val() == '') {
        $('#mobileno').next('span').text('Password and Confirm password must be the same.');
        empty = true;
    }

    if (empty == true) {
        $.notify('Please input all the required fields correctly.', "error");
        return false;
    }

    $.ajax({
        url: '../server/users/profile/' + $('#user_id').val(),
        async: false,
        type: 'PUT',
        headers: {
            'X-Auth-Token' : $("input[name='csrf']" ).val()
        },
        data: {
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            mobileno: $('#mobileno').val()
        },
        success: function(response) {
            var decode = response;
            if (decode.success == true) {
                $.notify(decode.msg, "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else if (decode.success === false) {
                $.notify(decode.error, "error");
                return;
            }
        },
        error: function(error) {
            console.log("Error:");
            console.log(error.responseText);
            console.log(error.message);
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
            }
            return;
        }
    });

}

