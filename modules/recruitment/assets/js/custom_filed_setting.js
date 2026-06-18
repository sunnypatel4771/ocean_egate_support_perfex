// Department
function new_department() {
  "use strict";
  $("#department").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");

  $('#department input[name="department_name"]').val("");
  $("#additional_department").html("");
}
function edit_department(invoker, id) {
  "use strict";
  $("#additional_department").append(hidden_input("id", id));
  $('#department input[name="department_name"]').val($(invoker).data("name"));

  $("#department").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

// status

function new_status() {
  "use strict";
  $("#status").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");

  $('#status input[name="status_name"]').val("");
  $("#additional_status").html("");
}
function edit_status(invoker, id) {
  "use strict";
  $("#additional_status").append(hidden_input("id", id));
  $('#status input[name="status_name"]').val($(invoker).data("name"));

  $("#status").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

// Rank

function new_rank() {
  "use strict";
  $("#rank").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");

  $('#rank input[name="rank_name"]').val("");
  $("#additional_rank").html("");
}
function edit_rank(invoker, id) {
  "use strict";
  $("#additional_rank").append(hidden_input("id", id));
  $('#rank input[name="rank_name"]').val($(invoker).data("name"));
  $('#rank input[name="rank_level"]').val($(invoker).data("rank_level"));
  $('#rank input[name="code"]').val($(invoker).data("code"));
  $("#rank").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

// Course

function new_course_type() {
  "use strict";
  $("#course").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");

  $('#course input[name="course_name"]').val("");
  $("#additional_course").html("");
}
function edit_course_type(invoker, id) {
  "use strict";
  $("#additional_course").append(hidden_input("id", id));
  $('#course input[name="course_name"]').val($(invoker).data("name"));

  $("#course").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

// vessel
function new_vessel_type() {
  "use strict";
  $("#vessel").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");

  $('#vessel input[name="vessel_name"]').val("");
  $("#additional_vessel").html("");
}
function edit_vessel_type(invoker, id) {
  "use strict";
  $("#additional_vessel").append(hidden_input("id", id));
  $('#vessel input[name="vessel_name"]').val($(invoker).data("name"));

  $("#vessel").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

// vessel name
function new_vessel_info() {
  "use strict";
  $("#vessel_info_name").modal("show");
  $(".edit-title_vessel").addClass("hide");
  $(".add-title_vessel").removeClass("hide");

  $('#vessel_info_name input[name="vessel_info_name"]').val("");
  $('#vessel_info_name input[name="imo_number"]').val("");
  $('#vessel_info_name input[name="grt"]').val("");
  $('#vessel_info_name input[name="year_built"]').val("");
  $('#vessel_info_name input[name="flag"]').val("");
  $('#vessel_info_name input[name="type_of_vessel"]').val("").change();
  $('#vessel_info_name input[name="classification_society"]').val("");
  $('#vessel_info_name form').trigger('reset');
  $('#vessel_info_name select[name="type_of_vessel"]')
    .prop('selectedIndex', 0)
    .selectpicker('refresh');
  $("#additional_vessel_info_name").html("");
}

function edit_vessel_name(invoker, id) {
  "use strict";
  $("#additional_vessel_info_name").append(hidden_input("id", id));
  $('#vessel_info_name input[name="vessel_info_name"]').val(
    $(invoker).data("name"),
  );

  $("#vessel_info_name").modal("show");
  $(".add-title_vessel").addClass("hide");
  $(".edit-title_vessel").removeClass("hide");
}

// Duty name
function new_duty_info() {
  "use strict";
  $("#duty").modal("show");
  $(".edit-duty").addClass("hide");
  $(".add-duty").removeClass("hide");

  $('#duty input[name="duty_name"]').val("");
  $("#additional_duty_name").html("");
}

function edit_duty(invoker, id) {
  "use strict";
  $("#additional_duty_name").append(hidden_input("id", id));
  $('#duty input[name="duty_name"]').val($(invoker).data("name"));

  $("#duty").modal("show");
  $(".add-duty").addClass("hide");
  $(".edit-duty").removeClass("hide");
}

// edit_vessel_name
$(document).on("click", ".edit_vessel_name", function () {
  var id = $(this).data("id");
  if (id > 0 && id != "") {
    $.ajax({
      url: admin_url + "recruitment/edit_vessel_name",
      type: "post",
      data: {
        id: id,
      },
      success: function (res) {
        var res = JSON.parse(res);

        if (res.status == 1) {
          var vessel_name = res.vessel_name;
          $("#vessel_info_name #id").val(vessel_name.id);
          $("#vessel_info_name #vessel_info_name").val(
            vessel_name.vessel_info_name,
          );
          $("#vessel_info_name #imo_number").val(vessel_name.imo_number);
          $("#vessel_info_name #grt").val(vessel_name.grt);
          $("#vessel_info_name #year_built").val(vessel_name.year_built);
          $("#vessel_info_name #flag").val(vessel_name.flag);
          $("#vessel_info_name #classification_society").val(
            vessel_name.classification_society,
          );
          $("#vessel_info_name #type_of_vessel")
            .val(vessel_name.type_of_vessel)
            .change();
          $("#vessel_info_name").modal("show");
          $(".edit-title_vessel").removeClass("hide");
          $(".add-title_vessel").addClass("hide");
        } else {
        }
      },
    });
  }
});
