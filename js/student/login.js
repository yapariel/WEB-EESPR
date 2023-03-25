$(document).ready(function () {
  $.material.init();
});

function resetHelpInLine() {
  $("span.help-inline").each(function () {
    $(this).text("");
  });
}

$(document).on("click", ".btn-login", function () {
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

  if ($("#terms-and-conditions").prop("checked") == false) {
    $("#terms-and-conditions").next("label").css("color", "red");
    empty = true;
  } else {
    $("#terms-and-conditions").next("label").css("color", "");
  }

  if (empty == true) {
    $.notify("Please input all the required fields correctly.", "error");
    return false;
  }

  $.ajax({
    url: "../server/student/auth",
    async: false,
    type: "POST",
    crossDomain: true,
    dataType: "json",
    data: {
      username: $("#username").val(),
      password: $("#password").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode.success == true) {
        setTimeout(function () {
          window.location.href = decode.url;
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
});
