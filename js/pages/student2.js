$(document).ready(function () {
  clear();
  fetch_courses();
});

function resetHelpInLine() {
  $("span.help-inline").each(function () {
    $(this).text("");
  });
}

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
      for (var i = 0; i < decode.courses.length; i++) {
        var row = decode.courses;
        var html =
          '<option value="' +
          row[i].id +
          '">' +
          row[i].coursename +
          "</option>";
        $("#pref_course").append(html);
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

function clear() {
  $("#studid").val("");
  $("#fname").val("");
  $("#lname").val("");
  $("#email").val("");
  $("#mobileno").val("");
  $("#gender").val("");
  $("#address").val("");
  $("#last_school").val("");
  $("#pref_course").val("");

  $("#username").val("");
  $("#password").val("");
  $("#password2").val("");
}

function save() {
  resetHelpInLine();
  var target = document.getElementById("target1");
  var spinner = new Spinner({
    radius: 30,
    length: 0,
    width: 10,
    trail: 40,
  }).spin(target);

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
    $("#username").parent().next("span").text("Username is required.");
    empty = true;
  }

  if ($("#password").val() == "") {
    $("#password").parent().next("span").text("Password is required.");
    empty = true;
  }

  if ($("#password2").val() == "") {
    $("#password2").parent().next("span").text("Confirm Password is required.");
    empty = true;
  }

  if ($("#password").val() !== $("#password2").val()) {
    $("#password2")
      .parent()
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
                clear();
                $.notify("Record successfully saved", "success");
                spinner.stop();
              } else if (decode.success === false) {
                $.notify(decode.msg, "error");
                spinner.stop();
                return;
              }
            },
            error: function (error) {
              spinner.stop();
              console.log("Error:");
              console.log(error.responseText);
              console.log(error.message);
              if (error.responseText) {
                var msg = JSON.parse(error.responseText);
                $.notify(msg, "error");
              }
              return;
            },
          });
        }
      }
    }
  }
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
