function resetHelpInLine() {
  $("span.help-inline").each(function () {
    $(this).text("");
  });
}

function saveProfile() {
  resetHelpInLine();

  var empty = false;

  $('input[type="text"]').each(function () {
    $(this).val($(this).val().trim());
  });

  if ($("#email").val() == "") {
    $("#email").next("span").text("Email Address is required.");
    empty = true;
  }

  if ($("#mobileno").val() == "") {
    $("#mobileno").next("span").text("Mobile No. is required.");
    empty = true;
  }

  if (empty == true) {
    $.notify("Please input all the required fields correctly.", "error");
    return false;
  }

  $.ajax({
    url: "../server/student/profile",
    async: false,
    type: "PUT",
    data: {
      email: $("#email").val(),
      mobileno: $("#mobileno").val(),
    },
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode.success == true) {
        $.notify("User Profile successfully updated", "success");
        $("#profileModal").modal("hide");
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

function saveAccount() {
  resetHelpInLine();

  var empty = false;

  $('input[type="text"]').each(function () {
    $(this).val($(this).val().trim());
  });

  if ($("#username").val() == "") {
    $("#username").next("span").text("Username is required.");
    empty = true;
  }

  if ($("#password").val() == "") {
    $("#password").next("span").text("Password is required.");
    empty = true;
  }

  if ($("#password").val() == "") {
    $("#password").next("span").text("Password is required.");
    empty = true;
  } else if ($("#password").val().length < 8) {
    $("#password").next("span");
    empty = true;
  } else if (
    !(
      /[a-zA-Z]/.test($("#password").val()) &&
      /[0-9]/.test($("#password").val()) &&
      /[^a-zA-Z0-9]/.test($("#password").val())
    )
  ) {
    $("#password").next("span");
    empty = true;
  }

  if ($("#password2").val() == "") {
    $("#password2").next("span").text("Password is required.");
    empty = true;
  }

  if ($("#password").val() !== $("#password2").val()) {
    $("#password")
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
      ($("#student_id").val() + "-" + $("#user_id").val()),
    async: false,
    type: "PUT",
    data: {
      username: $("#username").val(),
      password: $("#password").val(),
    },
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode.success == true) {
        $.notify("User Account successfully updated", "success");
        $("#accountModal").modal("hide");
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
