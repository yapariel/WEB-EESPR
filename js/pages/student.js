$(document).ready(function () {
  fetch_courses();

  fetch_all_student();
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

$(document).on("click", ".key-icon", function () {
  var id = $(this).data("id");
  getAccounts(id);
  $("#keyStudent").modal("show");
});

$(document).on("click", ".result-icon", function () {
  var studentid = $(this).data("studentid");
  var name = $(this).data("name");

  window.sessionStorage["studentid"] = studentid;
  window.sessionStorage["StudentName"] = name;
  window.location.href = "flot.php";
});

function fetch_courses() {
  $.ajax({
    url: "../server/courses/",
    async: true,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      $("#pref_course").empty();
      $("#u_pref_course").empty();
      for (var i = 0; i < decode.courses.length; i++) {
        var row = decode.courses;
        var html =
          '<option value="' +
          row[i].id +
          '">' +
          row[i].coursename +
          "</option>";
        $("#pref_course").append(html);
        $("#u_pref_course").append(html);
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

function resetHelpInLine() {
  $("span.help-inline").each(function () {
    $(this).text("");
  });
}

function refresh() {
  fetch_all_student();
}

function fetch_all_student() {
  $("#tbl_students tbody > tr").remove();
  var target = document.getElementById("target1");
  var spinner = new Spinner({
    radius: 30,
    length: 0,
    width: 10,
    trail: 40,
  }).spin(target);

  $.ajax({
    url: "../server/student/",
    async: false,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode) {
        if (decode.student.length > 0) {
          for (var i = 0; i < decode.student.length; i++) {
            var row = decode.student;
            var html =
              '<tr class="odd">\
                                        <td class="sorting">' +
              row[i].lname +
              ", " +
              row[i].fname +
              '</td>\
                                        <td class="sorting">' +
              row[i].mobileno +
              '</td>\
                                        <td class="sorting">' +
              row[i].gender +
              '</td>\
                                        <td class="sorting">' +
              (row[i].birthdate == "" || row[i].pref_course1 == null
                ? ""
                : row[i].birthdate) +
              '</td>\
                                        <td class="sorting">' +
              (row[i].pref_course1 == "" || row[i].pref_course1 == null
                ? ""
                : row[i].pref_course1) +
              '</td>\
                                        <td class=" ">\
                                          <div class="text-right">\
                                            <a class="result-icon btn btn-primary btn-sm" data-name="' +
              row[i].lname +
              ", " +
              row[i].fname +
              '" data-studentid="' +
              row[i].studid +
              '">\
                                              <i class="fa fa-file-text-o"></i>\
                                            </a>\
                                            <a class="edit-icon btn btn-success btn-sm" data-id="' +
              row[i].id +
              '">\
                                              <i class="fa fa-pencil"></i>\
                                            </a>\
                                            <a class="key-icon btn btn-warning btn-sm" data-id="' +
              row[i].id +
              '">\
                                              <i class="fa fa-key"></i>\
                                            </a>\
                                            <a class="remove-icon btn btn-danger btn-sm" data-id="' +
              row[i].id +
              '">\
                                              <i class="fa fa-remove"></i>\
                                            </a>\
                                          </div>\
                                        </td>\
                                </tr>';
            $("#tbl_students tbody").append(html);
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
  }).done(function () {
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

    $("#tbl_students").tablesorter();
  });
}

function deletedata(id) {
  $.ajax({
    url: "../server/student/" + id,
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
    url: "../server/student/" + id,
    async: true,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      console.log("response: ", decode);
      if (decode.success == true) {
        $("#u_studid").val(decode.student.studid);
        $("#u_fname").val(decode.student.fname);
        $("#u_lname").val(decode.student.lname);
        $("#u_mobileno").val(decode.student.mobileno);
        $("#u_email").val(decode.student.email);
        $("#u_gender").val(decode.student.gender);
        $("#u_address").val(decode.student.address);
        $("#u_graduated").val(decode.student.graduated);
        $("#u_last_school").val(decode.student.last_school);
        $("#u_birthdate").val(decode.student.birthdate);
        $("#u_pref_course").val(decode.student.pref_course);

        $("#id").val(decode.student.id);
        $("#user_id").val(decode.student.user_id);

        $("#editStudent").modal("show");
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

function getAccounts(id) {
  $.ajax({
    url: "../server/student/" + id,
    async: true,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      console.log("response: ", decode);
      if (decode.success == true) {
        $("#key_username").val(decode.student.username);

        $("#key_id").val(decode.student.id);
        $("#key_user_id").val(decode.student.user_id);

        $("#keyStudent").modal("show");
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

function create_student() {
  $("#addstudent").modal("show");
}

function create_student_bulk() {
  $("#addbulkstudent").modal("show");
}

function clear() {
  $("#studid").val("");
  $("#fname").val("");
  $("#lname").val("");
  $("#mobileno").val("");
  $("#email").val("");
  $("#gender").val("");
  $("#address").val("");
  $("#birthdate").val("");
  $("#graduated").val("");
  $("#last_school").val("");
  $("#pref_course").val("");

  $("#username").val("");
  $("#password").val("");
  $("#password2").val("");
}

function clearEdit() {
  $("#u_studid").val("");
  $("#u_fname").val("");
  $("#u_lname").val("");
  $("#u_mobileno").val("");
  $("#u_email").val("");
  $("#u_gender").val("");
  $("#u_address").val("");
  $("#u_birthdate").val("");
  $("#u_graduated").val("");
  $("#u_last_school").val("");
  $("#u_pref_course").val("");
}

function clearkey() {
  $("#key_username").val("");
  $("#key_password").val("");
  $("#key_password2").val("");
}

function save() {
  resetHelpInLine();

  var empty = false;

  $('input[type="text"]').each(function () {
    $(this).val($(this).val().trim());
  });

  if ($("#studid").val() == "") {
    $("#studid").next("span").text("Examinee ID is required.");
    empty = true;
  }

  if ($("#fname").val() == "") {
    $("#fname").next("span").text("First Name is required.");
    empty = true;
  }

  if ($("#lname").val() == "") {
    $("#lname").next("span").text("Last Name is required.");
    empty = true;
  }

  if ($("#email").val() == "") {
    $("#email").next("span").text("Email Address is required.");
    empty = true;
  }

  if ($("#mobileno").val() == "") {
    $("#mobileno").next("span").text("Mobile No is required.");
    empty = true;
  }

  if ($("#username").val() == "") {
    $("#username").next("span").text("Username is required.");
    empty = true;
  }

  if ($("#password").val() == "") {
    $("#password").next("span").text("Password is required.");
    empty = true;
  }

  if ($("#password2").val() == "") {
    $("#password2").next("span").text("Confirm Password is required.");
    empty = true;
  }

  if ($("#password").val() !== $("#password2").val()) {
    $("#password2")
      .next("span")
      .text("Password and Confirm Password must be the same.");
    empty = true;
  }

  if (empty == true) {
    $.notify("Please input all the required fields correctly.", "error");
    return false;
  }

  if (checkName($("#lname").val(), $("#fname").val()) == false) {
    if (checkValue("studid", $("#studid").val()) == false) {
      if (checkValue("email", $("#email").val()) == false) {
        if (checkAccount("username", $("#username").val()) == false) {
          $.ajax({
            url: "../server/student/",
            async: false,
            type: "POST",
            headers: {
              "X-Auth-Token": $("input[name='csrf']").val(),
            },
            data: {
              studid: $("#studid").val(),
              fname: $("#fname").val(),
              lname: $("#lname").val(),
              mobileno: $("#mobileno").val(),
              email: $("#email").val(),
              address: $("#address").val(),
              birthdate: $("#birthdate").val(),
              graduated: $("#graduated").val(),
              last_school: $("#last_school").val(),
              pref_course: $("#pref_course").val(),
              gender: $("#gender").val(),
              username: $("#username").val(),
              password: $("#password").val(),
            },
            success: function (response) {
              var decode = response;
              if (decode.success == true) {
                $("#addstudent").modal("hide");
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
        }
      }
    }
  }
}

function update() {
  resetHelpInLine();

  var empty = false;

  $('input[type="text"]').each(function () {
    $(this).val($(this).val().trim());
  });

  if ($("#u_studid").val() == "") {
    $("#u_studid").next("span").text("Examinee ID is required.");
    empty = true;
  }

  if ($("#u_fname").val() == "") {
    $("#u_fname").next("span").text("First Name is required.");
    empty = true;
  }

  if ($("#u_lname").val() == "") {
    $("#u_lname").next("span").text("Last Name is required.");
    empty = true;
  }

  if ($("#u_email").val() == "") {
    $("#u_email").next("span").text("Email Address is required.");
    empty = true;
  }

  if ($("#u_mobileno").val() == "") {
    $("#u_mobileno").next("span").text("Mobile No is required.");
    empty = true;
  }

  if (empty == true) {
    $.notify("Please input all the required fields correctly.", "error");
    return false;
  }

  $.ajax({
    url: "../server/student/" + ($("#id").val() + "-" + $("#user_id").val()),
    async: false,
    type: "PUT",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    data: {
      studid: $("#u_studid").val(),
      fname: $("#u_fname").val(),
      lname: $("#u_lname").val(),
      mobileno: $("#u_mobileno").val(),
      email: $("#u_email").val(),
      address: $("#u_address").val(),
      birthdate: $("#u_birthdate").val(),
      graduated: $("#u_graduated").val(),
      last_school: $("#u_last_school").val(),
      pref_course: $("#u_pref_course").val(),
      gender: $("#u_gender").val(),
    },
    success: function (response) {
      var decode = response;
      console.log("decode: ", decode);
      if (decode.success == true) {
        $("#editStudent").modal("hide");
        refresh();
        clear();
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

function updateAccount() {
  resetHelpInLine();

  var empty = false;

  $('input[type="text"]').each(function () {
    $(this).val($(this).val().trim());
  });

  if ($("#key_username").val() == "") {
    $("#key_username").next("span").text("Username is required.");
    empty = true;
  }

  if ($("#key_password").val() == "") {
    $("#key_password").next("span").text("Password is required.");
    empty = true;
  }

  if ($("#key_password2").val() == "") {
    $("#key_password2").next("span").text("Password is required.");
    empty = true;
  }

  if ($("#key_password").val() !== $("#key_password2").val()) {
    $("#key_password")
      .next("span")
      .text("Password and Confirmed Password should match.");
    empty = true;
  }

  if (empty == true) {
    $.notify("Please input all the required fields correctly.", "error");
    return false;
  }

  $.ajax({
    url:
      "../server/student/account/" +
      ($("#key_id").val() + "-" + $("#key_user_id").val()),
    async: false,
    type: "PUT",
    data: {
      username: $("#key_username").val(),
      password: $("#key_password").val(),
      password2: $("#key_password2").val(),
    },
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode.success == true) {
        $.notify("User Account successfully updated", "success");
        $("#keyStudent").modal("hide");
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
      return;
    },
  });
}

function checkValue(field, value) {
  var invalid = false;
  $.ajax({
    url: "../server/student/check/" + field + "/" + value,
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

function checkAccount(field, value) {
  var invalid = false;
  $.ajax({
    url: "../server/student/checkaccount/" + field + "/" + value,
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

function checkName(lastname, firstname) {
  var invalid = false;
  $.ajax({
    url: "../server/student/checkName/" + lastname + "/" + firstname,
    async: false,
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    type: "GET",
    success: function (response) {
      var decode = response;
      if (decode.success == true) {
        $.notify(lastname + ", " + firstname + " - " + decode.msg, "error");
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
