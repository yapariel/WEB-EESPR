$(document).ready(function() {
    $.material.init();

    fetch_categories();
});

function view_results(id){
    window.sessionStorage['view_category_id'] = id;
    window.location.href="quiz_results.php";
}

function fetch_categories() {
    $.ajax({
        url: '../server/category',
        async: true,
        type: 'GET',
        headers: {
            'X-Auth-Token': $("input[name='csrf']").val()
        },
        success: function(response) {
            var decode = response;
            $('#lessons').empty();
            for (var i = 0; i < decode.category.length; i++) {
                var row = decode.category;
                var html = '<div class="panel panel-inverse">\
                                <div class="panel-heading">\
                                    <h3 class="panel-title"></h3>\
                                </div>\
                                <div class="panel-body">\
                                    <h3>'+ row[i].name +'</h3>\
                                    <p><a data-id="'+ row[i].id +'" class="btn btn-inverse" href="javascript:view_results('+ row[i].id +')">View</a></p>\
                                </div>\
                            </div>';
                $("#lessons").append(html);
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