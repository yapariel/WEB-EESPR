$(document).ready(function () {
  $("#cboFilters").bind("change", filters);

  fetch_courses();
  fetch_years();

  filters();

  $("#dataTables-example").DataTable({
    responsive: true,
  });
});

function refresh() {
  filters();

  $("#dataTables-example").DataTable({
    responsive: true,
  });
}

function exportToExcel(obj, elem, sheetname) {
  return ExcellentExport.excel(obj, elem, sheetname);
}

function filters() {
  var value = $("#cboFilters").val();
  if (value === "all") {
    $("#wrapTable").empty();
    var table =
      '<table class="table table-striped table-bordered table-hover" id="dataTables-example">\
                <thead><tr>\
                <th>Examinee ID</th><th>Name</th><th>Total Score</th>\
                </tr></thead><tbody></tbody></table>';
    $("#wrapTable").append(table);

    fetch_all_passers("../server/reports/passers2/" + $("#cboYear").val());
  } else {
    $("#wrapTable").empty();
    var table =
      '<table class="table table-striped table-bordered table-hover" id="dataTables-example">\
                <thead><tr>\
                <th>Examinee ID</th><th>Name</th><th>Total Score</th>\
                </tr></thead><tbody></tbody></table>';
    $("#wrapTable").append(table);

    fetch_all_passers(
      "../server/reports/passers/" + value + "/" + $("#cboYear").val()
    );
  }
}

function fetch_all_passers(url) {
  $("#dataTables-example tbody > tr").remove();

  var target = document.getElementById("target1");
  var spinner = new Spinner({
    radius: 30,
    length: 0,
    width: 10,
    trail: 40,
  }).spin(target);

  $.ajax({
    url: url,
    async: false,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      if (decode) {
        if (decode.passers.length > 0) {
          for (var i = 0; i < decode.passers.length; i++) {
            var row = decode.passers;

            if (typeof row[i].suggest_course != "undefined") {
              var courses = row[i].suggest_course
                .map(function (elem) {
                  return elem.coursecode;
                })
                .join(", ");

              var html =
                '<tr class="odd">\
	                                        <td>' +
                row[i].studid +
                "</td>\
	                                        <td>" +
                row[i].lname +
                ", " +
                row[i].fname +
                '</td>\
	                                        <td class="text-center">' +
                row[i].TotalScore +
                "</td>\
		                                </tr>";
            } else {
              var html =
                '<tr class="odd">\
	                                        <td>' +
                row[i].studid +
                "</td>\
	                                        <td>" +
                row[i].lname +
                ", " +
                row[i].fname +
                '</td>\
	                                        <td class="text-center">' +
                row[i].TotalScore +
                "</td>\
		                                </tr>";
            }

            $("#dataTables-example tbody").append(html);
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

function fetch_courses() {
  $.ajax({
    url: "../server/courses/",
    async: false,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      $("#cboFilters").empty();

      $("#cboFilters").append('<option id="0" value="all">All</option>');
      for (var i = 0; i < decode.courses.length; i++) {
        var row = decode.courses;
        var html =
          '<option id="' +
          row[i].id +
          '" value="' +
          row[i].id +
          '">' +
          row[i].coursename +
          "</option>";
        $("#cboFilters").append(html);
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

function fetch_years() {
  $.ajax({
    url: "../server/reports/year",
    async: false,
    type: "GET",
    headers: {
      "X-Auth-Token": $("input[name='csrf']").val(),
    },
    success: function (response) {
      var decode = response;
      $("#cboYear").empty();
      for (var i = 0; i < decode.results_year.length; i++) {
        var row = decode.results_year;
        var html =
          '<option value="' + row[i].cYear + '">' + row[i].cYear + "</option>";
        $("#cboYear").append(html);
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
