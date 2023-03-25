$(document).ready(function () {
    $("#category_name").prop('disabled', true);
    $("#btn-save").attr('disabled', true);
    $("#btn-reset").hide();

    fetch_all_category();

    $('table.paginated').each(function () {
        var currentPage = 0;
        var numPerPage = 10;
        var $table = $(this);
        $table.bind('repaginate', function () {
            $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pagination"></div>');
        for (var page = 0; page < numPages; page++) {
            $('<span class="page-number"></span>').text(page + 1).bind('click', {
                newPage: page
            }, function (event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        $pager.insertBefore($table).find('span.page-number:first').addClass('active');
    });

    $("#tbl_category").tablesorter();
});

$('#filter').keyup(function () {
    var rex = new RegExp($(this).val(), 'i');
    $('.searchable tr').hide();
    $('.searchable tr').filter(function () {
        return rex.test($(this).text());
    }).show();

});

$('#category_name').keypress(function (e) {
    if (e.which == 13) {
        save();
        e.preventDefault();
    }
});

$('#addcategory').on('hide.bs.modal', function (e) {
    $("#category_name").prop('disabled', true);
    $("#btn-save").attr('disabled', true);
    $("#btn-reset").hide();
    $("#category_name").val('');
    $("#time").val('');
    $("#category_id").val('');
});


$(document).on("click", ".remove-icon", function () {
    var id = $(this).data('id');

    BootstrapDialog.show({
        title: 'Delete',
        message: 'Are you sure to delete this record?',
        buttons: [{
            label: 'Yes',
            cssClass: 'btn-primary',
            action: function (dialog) {
                deletedata(id);
                dialog.close();
            }
        }, {
            label: 'No',
            cssClass: 'btn-warning',
            action: function (dialog) {
                dialog.close();
            }
        }]
    });
});

$(document).on("click", ".edit-icon", function () {
    var id = $(this).data('id');
    getData(id);
});

function resetHelpInLine() {
    $('span.help-inline').each(function () {
        $(this).text('');
    });
}


function refresh() {
    fetch_all_category();
}

function save() {
    resetHelpInLine();

    var empty = false;

    $('input[type="text"]').each(function () {
        $(this).val($(this).val().trim());
    });

    if ($('#category_name').val() == '') {
        $('#category_name').next('span').text('Category Name is required.');
        empty = true;
    }

    if ($('#time').val() == '') {
        $('#time').next('span').text('Time Limit for Quiz is required.');
        empty = true;
    }

    if (empty == true) {
        $.notify('Please input all the required fields correctly.', "error");
        return false;
    }

    if (checkValue('name', $('#category_name').val()) == false) {

        if ($("#category_id").val() === '') {
            $.ajax({
                url: '../server/category/',
                async: false,
                type: 'POST',
                headers: {
                    'X-Auth-Token': $("input[name='csrf']").val()
                },
                data: {
                    category_name: $('#category_name').val(),
                    time: $("#time").val()
                },
                success: function (response) {
                    var decode = response;
                    if (decode.success == true) {
                        $('#addcategory').modal('hide');
                        refresh();
                        $.notify("Record successfully saved", "success");
                    } else if (decode.success === false) {
                        $('#btn-save').button('reset');
                        $.notify(decode.msg, "error");
                        return;
                    }
                },
                error: function (error) {
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
                url: '../server/category/' + $('#category_id').val(),
                async: false,
                type: 'PUT',
                headers: {
                    'X-Auth-Token': $("input[name='csrf']").val()
                },
                data: {
                    category_name: $('#category_name').val(),
                    time: $("#time").val()
                },
                success: function (response) {
                    var decode = response;
                    console.log('decode: ', decode);
                    if (decode.success == true) {
                        $('#addcategory').modal('hide');
                        refresh();
                        $.notify("Record successfully updated", "success");
                    } else if (decode.success === false) {
                        $.notify(decode.msg, "error");
                        return;
                    }
                },
                error: function (error) {
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


function create_category() {
    $("#category_name").prop('disabled', false);
    $("#time").prop('disabled', false)
    $("#btn-save").removeAttr('disabled');
    $("#btn-reset").show();
    $("#category_name").val('');
    $("#time").val('');

    $('#addcategory').modal('show');
}

function fetch_all_category() {
    var target = document.getElementById('target1')
    var spinner = new Spinner({
        radius: 30,
        length: 0,
        width: 10,
        trail: 40
    }).spin(target);

    $('#tbl_category tbody > tr').remove();

    $.ajax({
        url: '../server/category/',
        async: false,
        type: 'GET',
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        success: function (response) {
            var decode = response;
            if (decode) {
                if (decode.category.length > 0) {
                    for (var i = 0; i < decode.category.length; i++) {
                        var row = decode.category;
                        var html = '<tr class="odd">\
                                        <td class="sorting">' + row[i].name + '</td>\
                                        <td class="sorting">' + row[i].time + '</td>\
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
                        $("#tbl_category tbody").append(html);
                    }
                    $.notify("All records display", "info");
                }
                spinner.stop();
            }
        },
        error: function (error) {
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
        url: '../server/category/' + id,
        async: true,
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        type: 'DELETE',
        success: function (response) {
            var decode = response;
            if (decode.success == true) {
                $.notify("Record successfully deleted", "success");
                refresh();
                // clear_category();
            } else if (decode.success === false) {
                $.notify(decode.msg, "error");
                return;
            }

        },
        error: function (error) {
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
        url: '../server/category/' + id,
        async: true,
        type: 'GET',
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        success: function (response) {
            var decode = response;
            console.log('response: ', decode);
            if (decode.success == true) {
                $("#category_name").prop('disabled', false);
                $("#time").prop('disabled', false);

                $("#btn-save").removeAttr('disabled');
                $("#btn-reset").show();

                $("#category_name").val(decode.category.name);
                $("#time").val(decode.category.time);
                $("#category_id").val(decode.category.id);

                $('#addcategory').modal('show');
            } else if (decode.success === false) {
                $.notify(decode.msg, "error");
                return;
            }

        },
        error: function (error) {
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
    var check = false;
    $.ajax({
        url: '../server/category/check/' + field + '/' + value,
        async: false,
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        type: 'GET',
        success: function (response) {
            var decode = response;
            if (decode.success == true) {
                $.notify(decode.msg, "error");
                check = true;
            } else if (decode.success === false) {
                check = false;
            }
        },
        error: function (error) {
            console.log('error: ', error);
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
            }
            check = true;
        }
    });
    return check;
}
