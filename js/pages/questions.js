jQuery.fn.CKEditorValFor = function (element_id) {
  return CKEDITOR.instances[element_id].getData();
};

$(document).ready(function () {
  CKEDITOR.replace("content");

  $(".fancybox").fancybox();

  fetch_categories();
  fetch_all_questions();

  $("table.paginated").each(function () {
    var currentPage = 0;
    var numPerPage = 10;
    var $table = $(this);
    $table.bind("repaginate", function () {
      $table
        .find("tbody tr")
        .hide()
        .slice(currentPage * numPerPage, (currentPage + 1) * numPerPage)
        .show();
    });
    $table.trigger("repaginate");
    var numRows = $table.find("tbody tr").length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pagination"></div>');
    for (var page = 0; page < numPages; page++) {
      $('<span class="page-number"></span>')
        .text(page + 1)
        .bind(
          "click",
          {
            newPage: page,
          },
          function (event) {
            currentPage = event.data["newPage"];
            $table.trigger("repaginate");
            $(this).addClass("active").siblings().removeClass("active");
          }
        )
        .appendTo($pager)
        .addClass("clickable");
    }
    $pager
      .insertBefore($table)
      .find("span.page-number:first")
      .addClass("active");
  });

  $("#tbl_questions").tablesorter();
});

$("#filter").keyup(function () {
  var rex = new RegExp($(this).val(), "i");
  $(".searchable tr").hide();
  $(".searchable tr")
    .filter(function () {
      return rex.test($(this).text());
    })
    .show();
});

$(document).on("click", ".confirmation", function () {});

$(document).on("click", ".remove-icon", function () {
  var id = $(this).data("id");

  BootstrapDialog.show({
    title: "Delete",
    message: "Are you sure to delete this record?",
    buttons: [
      {
        label: "Yes",
        cssClass: "btn-primary",
        action: function (dialog) {
          deletedata(id);
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

$(document).on("click", ".edit-icon", function () {
  var id = $(this).data("id");
  getData(id);
});

function create_question() {
  $("#questionsModal").modal("show");
}

function clear() {}

function refresh() {
  fetch_categories();
  fetch_all_questions();
}

function fetch_all_questions() {
  $("#tbl_questions tbody > tr").remove();

  var target = document.getElementById("target1");
  var spinner = new Spinner({
    radius: 30,
    length: 0,
    width: 10,
    trail: 40,
  }).spin(target);

  $.ajax({
    url: "../server/questions/",
    async: false,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode) {
        if (decode.questions.length > 0) {
          for (var i = 0; i < decode.questions.length; i++) {
            var row = decode.questions;
            var html =
              '<tr class="odd">\
                                        <td class="sorting" width="65%">' +
              $(row[i].content).text() +
              '</td>\
                                        <td class="sorting" width="35%">' +
              row[i].category +
              '</td>\
                                        <td class=" " width="15%">\
                                          <div class="text-right">\
                                            <a class="edit-icon btn btn-success btn-xs" data-id="' +
              row[i].id +
              '">\
                                              <i class="fa fa-pencil"></i>\
                                            </a>\
                                            <a class="remove-icon btn btn-danger btn-xs" data-id="' +
              row[i].id +
              '">\
                                              <i class="fa fa-remove"></i>\
                                            </a>\
                                          </div>\
                                        </td>\
                                </tr>';
            $("#tbl_questions tbody").append(html);
          }
          $.notify("All records display", "info");
        }
        spinner.stop();
      }
    },
    error: function (error) {
      console.log("error: ", error);
      if (error.responseText) {
        var msg = JSON.parse(error.responseText);
        $.notify(msg.msg, "error");
      }
      return;
    },
  });
}

function resetHelpInLine() {
  $("p.help-inline").each(function () {
    $(this).text("");
  });
}

// $("form#frmQuestions").submit(function(e) {
function save() {
  resetHelpInLine();

  var empty = false;

  $('input[type="text"]').each(function () {
    $(this).val($(this).val().trim());
  });

  var CKEDITOR = $().CKEditorValFor("content");

  if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
    $.notify("The File APIs are not fully supported in this browser.", "error");
    return;
  }

  if ($("#select_category").val() == "") {
    $("#select_category").next("p").text("Question Category is required.");
    empty = true;
  }

  if (CKEDITOR == "") {
    $("#content").next("p").text("Question Content is required.");
    $.notify("Question Content is required.", "error");
    empty = true;
  }

  if ($("#answer").val() == "") {
    $("#answer").next("p").text("Question Answer is required.");
    empty = true;
  }

  if ($("#choice2").val() == "") {
    $("#choice2").next("p").text("Question 2nd Choice is required.");
    empty = true;
  }

  if ($("#choice3").val() == "") {
    $("#choice3").next("p").text("Question 3rd Choice is required.");
    empty = true;
  }

  if ($("#choice4").val() == "") {
    $("#choice4").next("p").text("Question 4th Choice is required.");
    empty = true;
  }

  var inputs = $('input.answer[type="text"]');
  var result = inputs.filter(function (i, el) {
    return (
      inputs.not(this).filter(function () {
        return (
          this.value.toLowerCase().replace(" ", "") ===
          el.value.toLowerCase().replace(" ", "")
        );
      }).length !== 0
    );
  });

  if (result.length !== 0) {
    $.notify(
      "Question has answers that contains the same value. Please try again",
      "error"
    );
    empty = true;
  }

  if (empty == true) {
    $.notify("Please input all the required fields correctly.", "error");
    return;
  }

  var CKEDITOR = $().CKEditorValFor("content");

  var formData = new FormData();
  formData.append("content", CKEDITOR);
  formData.append("category_id", $("#category_id").val());

  formData.append("mainpic", $("#mainpic")[0].files[0]);
  formData.append("correctpic", $("#correctpic")[0].files[0]);
  formData.append("pic2", $("#pic2")[0].files[0]);
  formData.append("pic3", $("#pic3")[0].files[0]);
  formData.append("pic4", $("#pic4")[0].files[0]);

  formData.append("answer", $("#answer").val());
  formData.append("choice2", $("#choice2").val());
  formData.append("choice3", $("#choice3").val());
  formData.append("choice4", $("#choice4").val());

  formData.append("answerid", $("#answerid").val());
  formData.append("choice2id", $("#choice2id").val());
  formData.append("choice3id", $("#choice3id").val());
  formData.append("choice4id", $("#choice4id").val());
  formData.append("question_id", $("#question_id").val());

  formData.append("tmp_main", $("#tmp_main").val());
  formData.append("tmp_correct", $("#tmp_correct").val());
  formData.append("tmp_pic2", $("#tmp_pic2").val());
  formData.append("tmp_pic3", $("#tmp_pic3").val());
  formData.append("tmp_pic4", $("#tmp_pic4").val());

  if (checkValue("content", CKEDITOR) == false) {
    if ($("#question_id").val() === "") {
      $.ajax({
        url: "../server/questions/",
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
          if (decode.success == true) {
            $("#questionsModal").modal("hide");
            refresh();
            $.notify("Record successfully saved", "success");
            setTimeout(function () {
              window.location.reload();
            }, 1000);
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
            var msg = JSON.parse(error.responseText);
            $.notify(msg.msg, "error");
          }
          return;
        },
      });
    } else {
      $.ajax({
        url: "../server/questions/update",
        contentType: false,
        processData: false,
        type: "POST",
        data: formData,
        headers: {
          "X-Auth-Token": $("input[name='csrf']").val(),
        },
        success: function (response) {
          var decode = response;
          console.log("decode: ", decode);
          if (decode.success == true) {
            $("#questionsModal").modal("hide");
            refresh();
            $.notify("Record successfully updated", "success");
            setTimeout(function () {
              window.location.reload();
            }, 1000);
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
            var msg = JSON.parse(error.responseText);
            $.notify(msg.msg, "error");
          }
          return;
        },
      });
    }
  }

  // });
}

function fetch_categories() {
  $.ajax({
    url: "../server/category/",
    async: true,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      $("#category_id").empty();
      for (var i = 0; i < decode.category.length; i++) {
        var row = decode.category;
        var html =
          '<option id="' +
          row[i].id +
          '" value="' +
          row[i].id +
          '">' +
          row[i].name +
          "</option>";
        $("#category_id").append(html);
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

function deletedata(id) {
  $.ajax({
    url: "../server/questions/" + id,
    async: true,
    type: "DELETE",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode.success == true) {
        $.notify("Record successfully deleted", "success");
        refresh();
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
        var msg = JSON.parse(error.responseText);
        $.notify(msg.msg, "error");
      }
      return;
    },
  });
}

function getData(id) {
  $.ajax({
    url: "../server/questions/" + id,
    async: true,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode.success == true) {
        $("#category_id").val(decode.question.category_id);
        // $('#content').val(decode.question.content);
        CKEDITOR.instances["content"].setData(decode.question.content);

        $("#question_id").val(decode.question.id);

        $("#answer").val(decode.choices[0].answer);
        $("#answerid").val(decode.choices[0].id);

        $("#choice2").val(decode.choices[1].answer);
        $("#choice2id").val(decode.choices[1].id);

        $("#choice3").val(decode.choices[2].answer);
        $("#choice3id").val(decode.choices[2].id);

        $("#choice4").val(decode.choices[3].answer);
        $("#choice4id").val(decode.choices[3].id);

        $("#tmp_main").val(decode.question.file);
        $("#tmp_correct").val(decode.choices[0].file);
        $("#tmp_pic2").val(decode.choices[1].file);
        $("#tmp_pic3").val(decode.choices[2].file);
        $("#tmp_pic4").val(decode.choices[3].file);

        if (decode.question.file !== null) {
          var txt =
            '<div><a href="#" class="text-danger confirmation"><i class="fa fa-times"></i> Remove </a> | <a href="../server/upload/choice/' +
            decode.question.file +
            '" class="fancybox"><font class="text-primary">' +
            decode.question.file +
            "</font></a><br /></div>";
          $(txt).insertAfter($("#mainpic").next("p"));
        }
        if (decode.choices[0].file !== null) {
          var txt =
            '<div><a href="#" class="text-danger confirmation"><i class="fa fa-times"></i> Remove </a> | <a href="../server/upload/choice/' +
            decode.choices[0].file +
            '" class="fancybox"><font class="text-primary">' +
            decode.choices[0].file +
            "</font></a><br /></div>";
          $(txt).insertAfter("#correctpic");
        }
        if (decode.choices[1].file !== null) {
          var txt =
            '<div><a href="#" class="text-danger confirmation"><i class="fa fa-times"></i> Remove </a> | <a href="../server/upload/choice/' +
            decode.choices[1].file +
            '" class="fancybox"><font class="text-primary">' +
            decode.choices[1].file +
            "</font></a><br /></div>";
          $(txt).insertAfter("#pic2");
        }
        if (decode.choices[2].file !== null) {
          var txt =
            '<div><a href="#" class="text-danger confirmation"><i class="fa fa-times"></i> Remove </a> | <a href="../server/upload/choice/' +
            decode.choices[2].file +
            '" class="fancybox"><font class="text-primary">' +
            decode.choices[2].file +
            "</font></a><br /></div>";
          $(txt).insertAfter("#pic3");
        }
        if (decode.choices[3].file !== null) {
          var txt =
            '<div><a href="#" class="text-danger confirmation"><i class="fa fa-times"></i> Remove </a> | <a href="../server/upload/choice/' +
            decode.choices[3].file +
            '" class="fancybox"><font class="text-primary">' +
            decode.choices[3].file +
            "</font></a><br /></div>";
          $(txt).insertAfter("#pic4");
        }

        $(".fancybox").fancybox();
        $("#questionsModal").modal("show");
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
        var msg = JSON.parse(error.responseText);
        $.notify(msg.msg, "error");
      }
      return;
    },
  });
}

$("#questionsModal").on("hidden.bs.modal", function (e) {
  $("#mainpic").next().next("div").remove();
  $("#correctpic").next("div").remove();
  $("#pic2").next("div").remove();
  $("#pic3").next("div").remove();
  $("#pic4").next("div").remove();

  $("#question_id").val("");

  CKEDITOR.instances["content"].setData("");
  $("#mainpic").val("");
  $("#correctpic").val("");
  $("#pic2").val("");
  $("#pic3").val("");
  $("#pic4").val("");

  $("#answer").val("");
  $("#answerid").val("");

  $("#choice2").val("");
  $("#choice2id").val("");

  $("#choice3").val("");
  $("#choice3id").val("");

  $("#choice4").val("");
  $("#choice4id").val("");

  $("#tmp_main").val("");
  $("#tmp_correct").val("");
  $("#tmp_pic2").val("");
  $("#tmp_pic3").val("");
  $("#tmp_pic4").val("");
});

function mysql_real_escape_string(str) {
  return str.replace(/[\0\x08\x09\x1a\n\r"'\\\%]/g, function (char) {
    switch (char) {
      case "\0":
        return "\\0";
      case "\x08":
        return "\\b";
      case "\x09":
        return "\\t";
      case "\x1a":
        return "\\z";
      case "\n":
        return "\\n";
      case "\r":
        return "\\r";
      case '"':
      case "'":
      case "\\":
      case "%":
        return "\\" + char; // prepends a backslash to backslash, percent,
      // and double/single quotes
    }
  });
}

function checkValue(field, value) {
  var invalid = false;
  $.ajax({
    url: "../server/questions/check",
    async: false,
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    data: {
      field: field,
      value: value,
    },
    type: "POST",
    success: function (response) {
      var decode = response;
      if (decode.success == true) {
        $.notify(value + " - " + decode.msg, "error");
        invalid = true;
      } else if (decode.success === false) {
        invalid = false;
      }
    },
    error: function (error) {
      console.log("error: ", error);
      if (error.responseText) {
        var msg = JSON.parse(error.responseText);
        $.notify(msg.msg, "error");
        invalid = true;
      }
    },
  });
  console.log("checkValue: ", invalid);
  return invalid;
}
