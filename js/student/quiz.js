"use strict";

var quizData = [];
var c = 1;

document.addEventListener("backbutton", onBackKeyDown, false);
function onBackKeyDown(e) {
  e.preventDefault();
}

$(document).ready(function () {
  $.material.init();

  var id = window.sessionStorage["category_id"];
  var s_time = window.sessionStorage["time"];

  console.log("check_exam(id);", s_time);
  check_exam(id);

  fetch_quiz(id);

  $("#div1").addClass("first current");
  $("#time_limit").val(s_time);
});

$("#next").click(function () {
  $(".current")
    .removeClass("current")
    .hide()
    .next()
    .fadeIn(500)
    .addClass("current");

  if ($(".current").hasClass("last")) {
    $("#next").attr("disabled", true);
    $(".confirmend").removeClass("hide");
  } else {
    $(".confirmend").addClass("hide");
  }

  if ($(".current").hasClass("first")) {
    $("#prev").attr("disabled", true);
  } else {
    $("#prev").removeClass("hide");
  }

  $("#prev").attr("disabled", null);
});

$("#prev").click(function () {
  $(".current")
    .removeClass("current")
    .hide()
    .prev()
    .fadeIn(500)
    .addClass("current");

  if ($(".current").hasClass("first")) {
    $("#prev").attr("disabled", true);
    $(".confirmend").addClass("hide");
  } else {
    $("#prev").removeClass("hide");
    $(".confirmend").addClass("hide");
  }
  $("#next").attr("disabled", null);
});

$(".confirmend").on("click", function () {
  BootstrapDialog.show({
    title: "Delete",
    message: "Are you sure to Submit this exam?",
    buttons: [
      {
        label: "Yes",
        cssClass: "btn-primary",
        action: function (dialog) {
          submit();
          dialog.close();
        },
      },
      {
        label: "No",
        cssClass: "btn-warning",
        action: function (dialog) {
          dialog.close();
        },
      },
    ],
  });
});

function check_exam(id) {
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
        alert(decode.msg);
        window.location.href = "main.php";
        return;
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

function fetch_quiz(id) {
  var target = document.getElementById("target1");
  var spinner = new Spinner({
    radius: 30,
    length: 0,
    width: 10,
    trail: 40,
  }).spin(target);

  $.ajax({
    url: "../server/quiz/exam/" + id,
    async: false,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;

      quizData = decode.quiz;
      var count = quizData.length;
      $("#category_id").val(decode.category);

      if (count > 0) {
        $("#notification").addClass("hide");
        $("#timer").removeClass("hide");
        $("#next").removeClass("hide");

        var time = window.sessionStorage["time"];
        var limit = time * 60 * 1000;
        var endTimeDiff = new Date().getTime() + limit;

        if (time != 0) {
          setInterval(function () {
            submit();
            alert("Thank You for taking the quiz!");
            window.location.href = "results.php";
          }, limit);
        }

        $("#countdown").countdown(endTimeDiff, function (event) {
          $(this).html(event.strftime("%H:%M:%S"));
        });
      } else {
        $("#notification").removeClass("hide");
        $("#timer").addClass("hide");
        $("#next").addClass("hide");
      }

      $(".main").empty();
      for (var i = 0; i < quizData.length; i++) {
        var row = quizData[i];
        var html = "";

        if (c == count) {
          html = '<div id="div' + c + '" class="question last">';
          if (row.file == null) {
            html +=
              '<div class="jumbotron">\
                                    <h3>Question No. ' +
              c +
              "</h3>" +
              row.content +
              "\
                                </div>";
          } else {
            html +=
              '<div class="jumbotron">\
                                    <h3>Question No. ' +
              c +
              "</h3>" +
              row.content +
              '\
                                    <img src="../server/upload/choice/thumbs/' +
              row.file +
              '" width="200px" alt="..." class="img-thumbnail img-responsive">\
                                </div>';
          }
        } else {
          html = '<div id="div' + c + '" class="question">';
          if (row.file == null) {
            html +=
              '<div class="jumbotron">\
                                    <h3>Question No. ' +
              c +
              "</h3>" +
              row.content +
              "\
                                </div>";
          } else {
            html +=
              '<div class="jumbotron">\
                                    <h3>Question No. ' +
              c +
              "</h3>" +
              row.content +
              '\
                                    <img src="../server/upload/choice/thumbs/' +
              row.file +
              '" width="200px" alt="..." class="img-thumbnail img-responsive">\
                                </div>';
          }
        }

        html +=
          '<fieldset>\
                            <div class="form-group">\
                                <div class="col-lg-12">';

        for (var a = 0; a < row.choices.length; a++) {
          var choice = row.choices[a];

          if (choice.file == null) {
            html +=
              '<div class="col-lg-6 col-md-6 col-sm-6">\
                                <div class="radio radio-primary">\
                                    <label>\
                                        <input type="radio" name="ans' +
              c +
              '" data-id="' +
              row.id +
              '" data-choice="' +
              choice.id +
              '"  value="' +
              choice.id +
              '">' +
              choice.answer +
              "<br>\
                                    </label>\
                                </div>\
                            </div>";
          } else {
            html +=
              '<div class="col-lg-6 col-md-6 col-sm-6">\
                                <div class="radio radio-primary">\
                                    <label>\
                                        <input type="radio" name="ans' +
              c +
              '" data-id="' +
              row.id +
              '" data-choice="' +
              choice.id +
              '"  value="' +
              choice.id +
              '">' +
              choice.answer +
              "<br>\
                                    </label>\
                                </div>\
                            </div>";
          }
        }

        html +=
          '<input type="hidden" name="question[]" value="' +
          row.id +
          '" >\
                            </div>\
                        </div>\
                    </fieldset>\
                </div>';

        $(".main").append(html);
        c++;
      }

      $.material.init();
      spinner.stop();
    },
    error: function (error) {
      spinner.stop();
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

function submit() {
  var formData = new FormData();
  var a = 1;
  var data = {};
  var arr = [];

  $.each($('input[name^="question\\["]').serializeArray(), function () {
    data[this.name] = this.value;
    arr.push(data[this.name]);
  });

  formData.append("category_id", $("#category_id").val());
  formData.append("question", JSON.stringify(arr));
  for (var i = 0; i < quizData.length; i++) {
    formData.append("ans" + a, $("input[name=ans" + a + "]:checked").val());
    a++;
  }

  $.ajax({
    url: "../server/quiz/",
    type: "POST",
    contentType: false,
    processData: false,
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    data: formData,
    success: function (response) {
      var decode = response;
      console.log("decode: ", decode);
      $.notify(decode.msg, "success");
      setTimeout(function () {
        window.location.href = "lessons.php";
      }, 1000);
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
