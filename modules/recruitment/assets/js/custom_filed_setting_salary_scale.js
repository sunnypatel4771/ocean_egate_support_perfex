// relation family
function show_custom_filed_setting_salary_scale_modal() {
  "use strict";

  $("select[name='principal']").selectpicker("destroy");
  $("select[name='principal']").val("");
  $("select[name='principal']").selectpicker("refresh");

  $("select[name='vessel_name']").selectpicker("destroy");
  $("select[name='vessel_name']").val("");
  $("select[name='vessel_name']").selectpicker("refresh");

  $("select[name='position']").selectpicker("destroy");
  $("select[name='position']").val("");
  $("select[name='position']").selectpicker("refresh");

  $("#custom_filed_setting_salary_scale_modal #basic_month_salary").val("");
  $("#custom_filed_setting_salary_scale_modal #hours_of_work").val("");
  $("#custom_filed_setting_salary_scale_modal #overtime").val("");
  $("#custom_filed_setting_salary_scale_modal #vacation_leave_w_pay").val("");
  $("#custom_filed_setting_salary_scale_modal #other_allowance_s").val("");
  $("#custom_filed_setting_salary_scale_modal #subsistence").val("");
  $("#custom_filed_setting_salary_scale_modal #supervisory").val("");
  $("#custom_filed_setting_salary_scale_modal #provident_fund").val("");
  
  $("#custom_filed_setting_salary_scale_modal #hid").val("");

  $("#custom_filed_setting_salary_scale_modal").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");
}

$(document).on("click", ".edit_custom_filed_setting_salary_scale", function () {
  var id = $(this).data("id");
  //   console.log("id" , id);

  if (id > 0 && id != "") {
    $.ajax({
      url: admin_url + "recruitment/edit_custom_filed_setting_salary_scale",
      type: "post",
      data: {
        id: id,
      },
      success: function (res) {
        var res = JSON.parse(res);
        if (res.status == 1) {
          var custom_filed_setting_salary_scale =
            res.custom_filed_setting_salary_scale;

          $("select[name='principal']").selectpicker("destroy");
          $("select[name='principal']").val(
            custom_filed_setting_salary_scale.principal,
          );
          $("select[name='principal']").selectpicker("refresh");

          $("select[name='vessel_name']").selectpicker("destroy");
          $("select[name='vessel_name']").val(
            custom_filed_setting_salary_scale.vessel_name,
          );
          $("select[name='vessel_name']").selectpicker("refresh");

          $("select[name='position']").selectpicker("destroy");
          $("select[name='position']").val(
            custom_filed_setting_salary_scale.position,
          );
          $("select[name='position']").selectpicker("refresh");

          $("#custom_filed_setting_salary_scale_modal #basic_month_salary").val(
            custom_filed_setting_salary_scale.basic_month_salary,
          );
          $("#custom_filed_setting_salary_scale_modal #hours_of_work").val(
            custom_filed_setting_salary_scale.hours_of_work,
          );
          $("#custom_filed_setting_salary_scale_modal #overtime").val(
            custom_filed_setting_salary_scale.overtime,
          );
          $(
            "#custom_filed_setting_salary_scale_modal #vacation_leave_w_pay",
          ).val(custom_filed_setting_salary_scale.vacation_leave_w_pay);
          $("#custom_filed_setting_salary_scale_modal #other_allowance_s").val(
            custom_filed_setting_salary_scale.other_allowance_s,
          );
          $("#custom_filed_setting_salary_scale_modal #subsistence").val(
            custom_filed_setting_salary_scale.subsistence,
          );
          $("#custom_filed_setting_salary_scale_modal #supervisory").val(
            custom_filed_setting_salary_scale.supervisory,
          );

          $("#custom_filed_setting_salary_scale_modal #provident_fund").val(
            custom_filed_setting_salary_scale.provident_fund,
          );

          $("#custom_filed_setting_salary_scale_modal #hid").val(
            custom_filed_setting_salary_scale.id,
          );
          $("#custom_filed_setting_salary_scale_modal").modal("show");
          $(".edit-title").removeClass("hide");
          $(".add-title").addClass("hide");
        } else {
        }
      },
    });
  }
});
