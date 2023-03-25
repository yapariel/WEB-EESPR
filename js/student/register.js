$(document).ready(function() {
    clearFields();
    fetch_courses();
});

function resetHelpInLine() {
    $('span.help-inline').each(function() {
        $(this).text('');
    });
}

function clearFields() {
    resetHelpInLine();

    $('#studid').val('');
    $('#fname').val('');
    $('#lname').val('');
    $('#email').val('');
    $('#mobileno').val('');
    $('#username').val('');
    $('#address').val('');
    $('#course').val('');
    $('#birthdate').val('');
    $('#gradschool').val('');
}

function save() {
    resetHelpInLine();

    var empty = false;

    $('input[type="text"]').each(function() {
        $(this).val($(this).val().trim());
    });

    if ($('#studid').val() == '') {
        $('#studid').next('span').text('Student ID is required.');
        empty = true;
    }

    if ($('#fname').val() == '') {
        $('#fname').next('span').text('First Name is required.');
        empty = true;
    }

    if ($('#lname').val() == '') {
        $('#lname').next('span').text('Last Name is required.');
        empty = true;
    }

    if ($('#email').val() == '') {
        $('#email').next('span').text('Email Address is required.');
        empty = true;
    }

    if ($('#mobileno').val() == '') {
        $('#mobileno').next('span').text('Mobile No is required.');
        empty = true;
    }

    if ($('#username').val() == '') {
        $('#username').next('span').text('Username is required.');
        empty = true;
    }

    if ($('#address').val() == '') {
        $('#address').next('span').text('Address is required.');
        empty = true;
    }

    if ($('#gradschool').val() == '') {
        $('#gradschool').next('span').text('Graduated School is required.');
        empty = true;
    }

    if (empty == true) {
        $.notify('Please input all the required fields correctly.', "error");
        return false;
    }

    if (checkName($('#lname').val(), $('#fname').val()) == false) {
        if (checkValue('studid', $('#studid').val()) == false) {
            if (checkValue('email', $('#email').val()) == false) {
                if (checkAccount('username', $('#username').val()) == false) {
                    $.ajax({
                        url: '../server/student/signup',
                        async: false,
                        type: 'POST',
                        crossDomain: true,
                        dataType: 'json',
                        data: {
                            studid: $('#studid').val(),
                            fname: $('#fname').val(),
                            lname: $('#lname').val(),
                            mobileno: $('#mobileno').val(),
                            username: $('#username').val(),
                            email: $('#email').val(),
                            gender: $('#gender').val(),
                            address: $('#address').val(),
                            birthdate: $('#birthdate').val(),
                            gradschool: $('#gradschool').val(),
                            graduated: $('#graduated').val(),
                            course: $('#course').val()
                        },
                        success: function(response) {
                            var decode = response;
                            if (decode.success == true) {
                                $.notify("Record successfully saved", "success");
                                clearFields();
                                setTimeout(function() {
                                    window.location.href = "thank.php";
                                }, 1000);
                            } else if (decode.success === false) {
                                $.notify(decode.msg, "error");
                                return;
                            }
                        },
                        error: function(error) {
                            console.log("Error:");
                            console.log(error.responseText);
                            console.log(error.message);
                            return;
                        }
                    });
                }
            }
        }
    }
}

function checkValue(field, value) {
    var invalid = false;
    $.ajax({
        url: '../server/student/signcheck/' + field + '/' + value,
        async: false,
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        type: 'GET',
        success: function(response) {
            var decode = response;
            if (decode.success == true) {
                $.notify(value + ' - ' + decode.msg, "error");
                invalid = true;
            } else if (decode.success === false) {
                invalid = false;
            }
        },
        error: function(error) {
            console.log('error: ', error);
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
                invalid = true;
            }
        }
    });
    console.log('checkValue: ', invalid);
    return invalid;
}

function checkAccount(field, value) {
    var invalid = false;
    $.ajax({
        url: '../server/student/checkaccount/' + field + '/' + value,
        async: false,
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        type: 'GET',
        success: function(response) {
            var decode = response;
            if (decode.success == true) {
                $.notify(value + ' - ' + decode.msg, "error");
                invalid = true;
            } else if (decode.success === false) {
                invalid = false;
            }
        },
        error: function(error) {
            console.log('error: ', error);
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
                invalid = true;
            }
        }
    });
    console.log('checkValue: ', invalid);
    return invalid;
}

function checkName(lastname, firstname) {
    var invalid = false;
    $.ajax({
        url: '../server/student/signcheckName/' + lastname + '/' + firstname,
        async: false,
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        type: 'GET',
        success: function(response) {
            var decode = response;
            if (decode.success == true) {
                $.notify((lastname + ', ' + firstname) + ' - ' + decode.msg, "error");
                invalid = true;
            } else if (decode.success === false) {
                invalid = false;
            }
        },
        error: function(error) {
            console.log('error: ', error);
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
                invalid = true;
            }
        }
    });
    console.log('checkValue: ', invalid);
    return invalid;
}

function fetch_courses() {
    $.ajax({
        url: '../server/courses/signup',
        async: true,
        type: 'GET',
        success: function(response) {
            var decode = response;
            $('#course').empty();
            for (var i = 0; i < decode.courses.length; i++) {
                var row = decode.courses;
                var html = '<option id="' + row[i].id + '" value="' + row[i].id + '">' + row[i].coursecode + '</option>';
                $("#course").append(html);
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
