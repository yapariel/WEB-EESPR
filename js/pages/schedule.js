$(document).ready(function() {

    fetch_all_schedules();

    $('table.paginated').each(function() {
        var currentPage = 0;
        var numPerPage = 10;
        var $table = $(this);
        $table.bind('repaginate', function() {
            $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pagination"></div>');
        for (var page = 0; page < numPages; page++) {
            $('<span class="page-number"></span>').text(page + 1).bind('click', {
                newPage: page
            }, function(event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        $pager.insertBefore($table).find('span.page-number:first').addClass('active');
    });
    
    $("#tbl_sched").tablesorter();
});

$('#filter').keyup(function() {
    var rex = new RegExp($(this).val(), 'i');
    $('.searchable tr').hide();
    $('.searchable tr').filter(function() {
        return rex.test($(this).text());
    }).show();

});

$('#addSchedule').on('hide.bs.modal', function(e) {
    $("#description").val('');
    $('#start_date').val('');
    $("#end_date").val('');
    $('#start_time').val('');
    $("#end_time").val('');
    $("#id").val('');
});


$(document).on("click", ".remove-icon", function() {
    var id = $(this).data('id');

    BootstrapDialog.show({
        title: 'Delete',
        message: 'Are you sure to delete this record?',
        buttons: [{
            label: 'Yes',
            cssClass: 'btn-primary',
            action: function(dialog) {
                deletedata(id);
                dialog.close();
            }
        }, {
            label: 'No',
            cssClass: 'btn-warning',
            action: function(dialog) {
                dialog.close();
            }
        }]
    });
});

$(document).on("click", ".edit-icon", function() {
    var id = $(this).data('id');
    getData(id);
});

function resetHelpInLine() {
    $('span.help-inline').each(function() {
        $(this).text('');
    });
}


function refresh() {
    fetch_all_schedules();
}

function save() {
    resetHelpInLine();

    var empty = false;

    $('input[type="text"]').each(function() {
        $(this).val($(this).val().trim());
    });

    if ($('#description').val() == '') {
        $('#description').next('span').text('Exam Schedule Description is required');
        empty = true;
    }

    if ($('#start_date').val() == '') {
        $('#start_date').next('span').text('Start Date for the Exam is required');
        empty = true;
    }

    if ($('#end_date').val() == '') {
        $('#end_date').next('span').text('End Date for the Exam is required');
        empty = true;
    }

    if ($('#start_time').val() == '') {
        $('#start_time').next('span').text('Start Time for the Exam is required');
        empty = true;
    }

    if ($('#end_time').val() == '') {
        $('#end_time').next('span').text('End Time for the Exam is required');
        empty = true;
    }

    if (empty == true) {
        $.notify('Please input all the required fields correctly.', "error");
        return false;
    }

    if (!checkValue('description', $('#description').val())) {
        if ($("#id").val() === '') {
            $.ajax({
                url: '../server/schedules/',
                async: false,
                type: 'POST',
                headers: {
                    'X-Auth-Token': $("input[name='csrf']").val()
                },
                data: {
                    description: $('#description').val(),
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    start_time: $('#start_time').val(),
                    end_time : $('#end_time').val()
                },
                success: function(response) {
                    var decode = response;
                    if (decode.success == true) {
                        $('#addSchedule').modal('hide');
                        refresh();
                        $.notify("Record successfully saved", "success");
                    } else if (decode.success === false) {
                        $.notify(decode.msg, "error");
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
        } else {
            $.ajax({
                url: '../server/schedules/' + $('#id').val(),
                async: false,
                type: 'PUT',
                headers: {
                    'X-Auth-Token': $("input[name='csrf']").val()
                },
                data: {
                    description: $('#description').val(),
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    start_time: $('#start_time').val(),
                    end_time : $('#end_time').val()
                },
                success: function(response) {
                    var decode = response;
                    console.log('decode: ', decode);
                    if (decode.success == true) {
                        $('#addSchedule').modal('hide');
                        refresh();
                        $.notify("Record successfully updated", "success");
                    } else if (decode.success === false) {
                        $.notify(decode.msg, "error");
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
    }
}


function create_sched() {
    $("#description").prop('disabled', false);
    $("#start_date").prop('disabled', false);
    $("#end_date").prop('disabled', false);
    $("#start_time").prop('disabled', false);
    $("#end_time").prop('disabled', false);

    $("#description").val('');
    $('#start_date').val('');
    $("#end_date").val('');
    $('#start_time').val('');
    $("#end_time").val('');
    $("#id").val('');

    $('#addSchedule').modal('show');
}

function fetch_all_schedules() {
    $('#tbl_sched tbody > tr').remove();

    var target = document.getElementById('target1')
    var spinner = new Spinner({
        radius: 30,
        length: 0,
        width: 10,
        trail: 40
    }).spin(target);

    $.ajax({
        url: '../server/schedules/',
        async: false,
        type: 'GET',
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        success: function(response) {
            var decode = response;
            if (decode) {
                if (decode.exam_sched.length > 0) {
                    for (var i = 0; i < decode.exam_sched.length; i++) {
                        var row = decode.exam_sched;
                        var html = '<tr class="odd">\
                                        <td class="sorting">' + row[i].description + '</td>\
                                        <td class="sorting">' + row[i].start_date + '</td>\
                                        <td class="sorting">' + row[i].end_date + '</td>\
                                        <td class="sorting">' + row[i].start_time + '</td>\
                                        <td class="sorting">' + row[i].end_time + '</td>\
                                        <td class=" ">\
                                          <div class="text-right">\
                                            <a class="edit-icon btn btn-success btn-xs" data-id="' + row[i].id + '">\
                                              <i class="fa fa-pencil"></i>\
                                            </a>\
                                            <a class="remove-icon btn btn-danger btn-xs" data-id="' + row[i].id + '">\
                                              <i class="fa fa-remove"></i>\
                                            </a>\
                                          </div>\
                                        </td>\
                                </tr>';
                        $("#tbl_sched tbody").append(html);
                    }


                    $.notify("All records display", "info");
                }
                spinner.stop();
            }
        },
        error: function(error) {
            console.log('error: ', error);
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
            }
            return;
        }
    });
}

function deletedata(id) {
    $.ajax({
        url: '../server/schedules/' + id,
        async: true,
        type: 'DELETE',
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        success: function(response) {
            var decode = response;
            if (decode.success == true) {
                $.notify("Record successfully deleted", "success");
                refresh();
            } else if (decode.success === false) {
                $.notify(decode.msg, "error");
                return;
            }

        },
        error: function(error) {
            console.log('error: ', error);
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
            }
            return;
        }
    });
}

function getData(id) {
    $.ajax({
        url: '../server/schedules/' + id,
        async: true,
        type: 'GET',
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        success: function(response) {
            var decode = response;
            console.log('response: ', decode);
            if (decode.success == true) {

                $("#description").val(decode.exam_sched.description);
                $('#start_date').val(decode.exam_sched.start_date);
                $("#end_date").val(decode.exam_sched.end_date);
                $('#start_time').val(decode.exam_sched.start_time);
                $("#end_time").val(decode.exam_sched.end_time);
                $("#id").val(decode.exam_sched.id);

                $('#addSchedule').modal('show');
            } else if (decode.success === false) {
                $.notify(decode.msg, "error");
                return;
            }

        },
        error: function(error) {
            console.log('error: ', error);
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
            }
            return;
        }
    });
}


function checkValue(field, value) {
    var invalid = false;
    $.ajax({
        url: '../server/schedules/check/' + field + '/' + value,
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
