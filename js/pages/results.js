$(document).ready(function() {

    var studentid = window.sessionStorage['studentid'];
    $('#StudentName').text(window.sessionStorage['StudentName']);

    fetch_all_passers(studentid);

});

function refresh() {
    var studentid = window.sessionStorage['studentid'];
    $('#StudentName').text(window.sessionStorage['StudentName']);

    fetch_all_passers(studentid);
}

function fetch_all_passers(studentid) {
    $('#wrapTable').empty();
    var target = document.getElementById('target1');
    var spinner = new Spinner({
        radius: 30,
        length: 0,
        width: 10,
        trail: 40
    }).spin(target);

    $.ajax({
        url: '../server/reports/results/' + studentid,
        async: false,
        type: 'GET',
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        success: function(response) {
            var decode = response;
            if (decode) {
                if (decode.data.length > 0) {
                    var htmlStr = '';
                    var total = 0;
                    var score = 0;
                    for (var i = 0; i < decode.summary.length; i++) {
                        var row = decode.summary;
                        if(row[i].score !== null){
                            total += parseInt(row[i].total);
                            score += parseInt(row[i].score);
                            htmlStr = '<p class="lead">' + row[i].name.toUpperCase() +': <strong>' + row[i].score + '/' + row[i].total + '</strong></p>';
                            $('#result_summary').append(htmlStr);
                        }
                    };
                    htmlStr = '<p class="lead"><strong>TOTAL: ' + score +'/'+ total + '</strong></p>';
                    $('#result_summary').append(htmlStr);

                    for (var i = 0; i < decode.data.length; i++) {
                        var row = decode.data;
                        var table = '<h2 class="text-primary">' + row[i].category_name + '</h2><table class="table table-striped table-bordered table-hover" id="dataTables-example' + i + '">\
                                    <thead><tr>\
                                    <th width="5%">#</th><th>Question</th><th>Your Answer</th><th>Correct Answer</th><th width="5%" class="text-center"></th>\
                                    </tr></thead><tbody></tbody></table>';
                        $('#wrapTable').append(table);
                        $('#dataTables-example' + i + ' tbody > tr').remove();

                        for (var a = 0; a < row[i].quiz.length; a++) {
                            var row1 = row[i].quiz;

                            if (row1[a].isCorrect === true) {
                                var isCorrect = '<i class="fa fa-check"></i>';
                            } else {
                                var isCorrect = '<i class="fa fa-times"></i>';
                            }

                            var html = '<tr class="odd">\
                                    <td>' + (a + 1) + '</td>\
                                    <td>' + $(row1[a].questions).text() + '</td>\
                                    <td class="text-center">' + row1[a].yourchoice + '</td>\
                                    <td>' + row1[a].correctans + '</td>\
                                    <td>' + isCorrect + '</td>\
                                </tr>';
                            $("#dataTables-example" + i + " tbody").append(html);
                        }
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

function fetch_courses() {
    $.ajax({
        url: '../server/courses/',
        async: false,
        type: 'GET',
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        success: function(response) {
            var decode = response;
            $('#cboFilters').empty();

            $("#cboFilters").append('<option id="0" value="all">All</option>');
            for (var i = 0; i < decode.courses.length; i++) {
                var row = decode.courses;
                var html = '<option id="' + row[i].id + '" value="' + row[i].id + '">' + row[i].coursename + '</option>';
                $("#cboFilters").append(html);
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
