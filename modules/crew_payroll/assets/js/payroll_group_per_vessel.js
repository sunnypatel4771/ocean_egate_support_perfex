$("#add_payroll_group_per_vessel_btn").on("click", function () {
  $("#hid").val("");
  $("#code").val("");
  $("#vessel_group_name").val("");
  $("#vessel_details").val("");
  $("#payroll_group_per_vessel_modal .add-title").show();
  $("#payroll_group_per_vessel_modal .edit-title").hide();
  $("#payroll_group_per_vessel_modal").modal("show");
});

appValidateForm($("#payroll_group_per_vessel_form"), {
  code: "required",
  vessel_group_name: "required",
  vessel_details: "required",
});

$(document).on("click", ".edit_payroll_group_per_vessel", function () {
  var id = $(this).data("id");
  if (id != "" && id > 0) {
    $.ajax({
      url: admin_url + "crew_payroll/get_payroll_group_per_vessel",
      type: "POST",
      data: {
        id: id,
      },
      success: function (res) {
        var data = JSON.parse(res);
        if (data.status == 1) {
          var data = data.data;
          $("#hid").val(data.id);
          $("#code").val(data.code);
          $("#vessel_group_name").val(data.vessel_group_name);
          $("#vessel_details").val(data.vessel_details);
          $("#payroll_group_per_vessel_modal .add-title").hide();
          $("#payroll_group_per_vessel_modal .edit-title").show();
          $("#payroll_group_per_vessel_modal").modal("show");
        }
      },
    });
  }
});
