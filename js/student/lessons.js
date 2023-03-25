$(document).ready(function () {
  $.material.init();
  fetch_categories();
});

function start_quiz(id, time) {
  $.ajax({
    url: "../server/quiz/checkexam/" + id,
    async: false,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode.success == true) {
        // $.notify(decode.msg, "error");
        alert(decode.msg);
        return;
      } else if (decode.success === false) {
        window.sessionStorage["category_id"] = id;
        window.sessionStorage["time"] = time;
        window.location.href = "quiz.php";
      }
    },
    error: function (error) {
      console.log("Error:");
      console.log(error.responseText);
      console.log(error.message);
      return;
    },
  });
}

function fetch_categories() {
  $.ajax({
    url: "../server/category/quiz",
    async: true,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      $("#lessons").empty();
      for (var i = 0; i < decode.category.length; i++) {
        var row = decode.category;
        var html =
          '<div class="panel panel-warning">\
                                <div class="panel-heading">\
                                    <h3 class="panel-title"></h3>\
                                </div>\
                                <div class="panel-body"><h3>' +
          row[i].name +
          " (<small>" +
          row[i].time +
          " mins.</small>)</h3>";

        if (row[i].score > 0 && row[i].score != null) {
          html +=
            '<p>\
                                <a data-id="' +
            row[i].id +
            '" class="btn btn-primary" href="javascript:start_quiz(' +
            row[i].id +
            "," +
            row[i].time +
            ')">DONE</a>\
                                <i class="mdi-action-done"></i>\
                            </p>';
        } else {
          html +=
            '<p>\
                                <a data-id="' +
            row[i].id +
            '" class="btn btn-warning" href="javascript:start_quiz(' +
            row[i].id +
            "," +
            row[i].time +
            ')">TAKE</a>\
                            </p>';
        }
        html += "</div></div>";
        $("#lessons").append(html);
      }
    },
    error: function (error) {
      console.log("Error:");
      console.log(error.responseText);
      console.log(error.message);
      if (error.responseText) {
        var msg = JSON.parse(error.responseText);
        $.notify(msg.msg, "error");
      }
      return;
    },
  });
}
