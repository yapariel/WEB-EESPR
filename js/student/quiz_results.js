 $(function() {
     $.material.init();
     getresults();
 });


function getresults() {
    var target = document.getElementById('target1')
    var spinner = new Spinner({
        radius: 30,
        length: 0,
        width: 10,
        trail: 40
    }).spin(target);

    var category_id = window.sessionStorage['view_category_id'];

    $('#tblResults tbody > tr').remove();

    $.ajax({
        url: '../server/quiz/resultsdetailed/'+category_id,
        async: true,
        type: 'GET',
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        success: function(response) {
            var decode = response;
            if (decode) {
                if (decode.results.length > 0) {
                    for (var i = 0; i < decode.results.length; i++) {
                        var row = decode.results;
                        var html = '<tr>\
                        				<td class="sorting">' + (i + 1) + '</td>\
                                        <td class="sorting">' + row[i].questions + '</td>\
                                        <td class="sorting">' + row[i].yourchoice + '</td>\
                                        <td class="sorting">' + row[i].correctans + '</td>\
                                </tr>';
                        $("#tblResults tbody").append(html);
                    }
                }
                spinner.stop();
            }
        },
        error: function(error) {
            console.log('error: ', error);
            spinner.stop();
            if (error.responseText) {
                var msg = JSON.parse(error.responseText)
                $.notify(msg.msg, "error");
            }
            return;
        }
    });
}