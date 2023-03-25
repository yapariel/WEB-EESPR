$(document).ready(function () {
  $("#category_name").prop("disabled", true);
  $("#btn-save").attr("disabled", true);
  $("#btn-reset").hide();

  fetch_all_course();

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

  $("#tbl_courses").tablesorter();
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

$("#passing_score").keypress(function (e) {
  if (e.which == 13) {
    save();
    e.preventDefault();
  }
});

$("#course_name").keypress(function (e) {
  if (e.which == 13) {
    save();
    e.preventDefault();
  }
});

$("#addcourse").on("hide.bs.modal", function (e) {
  $("#btn-save").attr("disabled", true);
  $("#course_name").val("");
  $("#course_code").val("");
  $("#passing_score").val("");
  $("#course_id").val("");
});

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

function resetHelpInLine() {
  $("span.help-inline").each(function () {
    $(this).text("");
  });
}

function refresh() {
  fetch_all_course();
}

function save() {
  resetHelpInLine();

  var empty = false;

  $('input[type="text"]').each(function () {
    $(this).val($(this).val().trim());
  });

  if ($("#course_code").val() == "") {
    $("#course_code").next("span").text("Course Code is required.");
    empty = true;
  }

  if ($("#course_name").val() == "") {
    $("#course_name").next("span").text("Course Name is required.");
    empty = true;
  }

  if ($("#passing_score").val() == "") {
    $("#passing_score").next("span").text("Passing Score is required.");
    empty = true;
  }

  if (empty == true) {
    $.notify("Please input all the required fields correctly.", "error");
    return false;
  }

  if (
    checkValue("coursecode", $("#course_code").val(), $("#course_id").val()) ==
    false
  ) {
    if (
      checkValue(
        "coursename",
        $("#course_name").val(),
        $("#course_id").val()
      ) == false
    ) {
      if ($("#course_id").val() === "") {
        $.ajax({
          url: "../server/courses/",
          async: false,
          type: "POST",
          headers: {
            "X-Auth-Token": $("input[name='csrf']").val(),
          },
          data: {
            coursename: $("#course_name").val(),
            coursecode: $("#course_code").val(),
            passing_score: $("#passing_score").val(),
          },
          success: function (response) {
            var decode = response;
            if (decode.success == true) {
              $("#addcourse").modal("hide");
              refresh();
              $.notify("Record successfully saved", "success");
            } else if (decode.success === false) {
              $("#btn-save").button("reset");
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
          url: "../server/courses/" + $("#course_id").val(),
          async: false,
          type: "PUT",
          headers: {
            "X-Auth-Token": $("input[name='csrf']").val(),
          },
          data: {
            coursename: $("#course_name").val(),
            coursecode: $("#course_code").val(),
            passing_score: $("#passing_score").val(),
          },
          success: function (response) {
            var decode = response;
            console.log("decode: ", decode);
            if (decode.success == true) {
              $("#addcourse").modal("hide");
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
              var msg = JSON.parse(error.responseText);
              $.notify(msg.msg, "error");
            }
            return;
          },
        });
      }
    }
  }
}

function create_course() {
  $("#course_name").prop("disabled", false);
  $("#course_code").prop("disabled", false);
  $("#passing_score").prop("disabled", false);
  $("#btn-save").removeAttr("disabled");
  $("#btn-reset").show();
  $("#course_name").val("");
  $("#course_code").val("");
  $("#passing_score").val("");
  $("#course_id").val("");

  $("#addcourse").modal("show");
}

function fetch_all_course() {
  $("#tbl_courses tbody > tr").remove();

  var target = document.getElementById("target1");
  var spinner = new Spinner({
    radius: 30,
    length: 0,
    width: 10,
    trail: 40,
  }).spin(target);

  $.ajax({
    url: "../server/courses/",
    async: false,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode) {
        if (decode.courses.length > 0) {
          for (var i = 0; i < decode.courses.length; i++) {
            var row = decode.courses;
            var html =
              '<tr class="odd">\
                                        <td class="sorting">' +
              row[i].coursecode +
              '</td>\
                                        <td class="sorting">' +
              row[i].coursename +
              '</td>\
                                        <td class="sorting">' +
              row[i].passing_score +
              '</td>\
                                        <td class=" ">\
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
            $("#tbl_courses tbody").append(html);
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

function deletedata(id) {
  $.ajax({
    url: "../server/courses/" + id,
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
      console.log("error: ", error);
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
    url: "../server/courses/" + id,
    async: true,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      console.log("response: ", decode);
      if (decode.success == true) {
        $("#btn-save").removeAttr("disabled");

        $("#course_name").val(decode.course.coursename);
        $("#course_code").val(decode.course.coursecode);
        $("#passing_score").val(decode.course.passing_score);
        $("#course_id").val(decode.course.id);

        $("#addcourse").modal("show");
      } else if (decode.success === false) {
        $.notify(decode.msg, "error");
        return;
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

function checkValue(field, value, id) {
  var invalid = false;
  $.ajax({
    url: "../server/courses/check/" + field + "/" + value + "/" + id,
    async: false,
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    type: "GET",
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
