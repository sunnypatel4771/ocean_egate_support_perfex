$(document).on("click", "#add_payroll_table_btn", function () {
  $("#payroll_table_modal .add-title").show();
  $("#payroll_table_modal .edit-title").hide();
  $("#payroll_table_modal").modal("show");
  reset_form();
});

appValidateForm($("#payroll_table_setting_form"), {
  vessel_code: "required",
  rank_code: "required",
});

$(document).on("change", "#vessel_code", function () {
  var id = $(this).val();
  if (id != "") {
    $.ajax({
      url: admin_url + "crew_payroll/get_vessel_group_name_by_vessel_code",
      type: "POST",
      data: {
        id: id,
      },
      success: function (res) {
        var data = JSON.parse(res);
        if (data.status == 1) {
          $("#vessel_group_name").val(data.vessel_group_name);
        }
      },
    });
  }
});

// rank_code
$(document).on("change", "#rank_code", function () {
  var id = $(this).val();
  if (id != "") {
    $.ajax({
      url: admin_url + "crew_payroll/get_rank_by_rank_code",
      type: "POST",
      data: {
        id: id,
      },
      success: function (res) {
        var data = JSON.parse(res);
        if (data.status == 1) {
          $("#rank").val(data.rank);
        }
      },
    });
  }
});

$(document).on("click", ".edit_payroll_table_setting", function () {
  var id = $(this).data("id");
  if (id != "") {
    $.ajax({
      url: admin_url + "crew_payroll/get_payroll_table_setting",
      type: "POST",
      data: {
        id: id,
      },
      success: function (res) {
        var data = JSON.parse(res);
        if (data.status == 1) {
          $("#hid").val(data.data.id);
          $("#payroll_table_modal .add-title").hide();
          $("#payroll_table_modal .edit-title").show();
          $("#payroll_table_modal").modal("show");
          $("#vessel_code").val(data.data.vessel_code).change();
          $("#rank_code").val(data.data.rank_code).change();

          $("#basic_wages_onb").val(data.data.basic_wages_onb);
          $("#basic_wages_trv").val(data.data.basic_wages_trv);
          $("#leave").val(data.data.leave);
          $("#education_allowance").val(data.data.education_allowance);
          $("#guranteed_overtime").val(data.data.guranteed_overtime);
          $("#operational_allowance").val(data.data.operational_allowance);
          $("#supplementary_allowance").val(data.data.supplementary_allowance);
          $("#owners_bonus").val(data.data.owners_bonus);
          $("#other_earnings_1").val(data.data.other_earnings_1);
          $("#other_earnings_2").val(data.data.other_earnings_2);
          $("#philhelth_empee").val(data.data.philhelth_empee);
          $("#social_security_system_empee").val(
            data.data.social_security_system_empee
          );
          $("#slopchest").val(data.data.slopchest);
          $("#pag_lbig_housing_program_empee").val(
            data.data.pag_lbig_housing_program_empee
          );
          $("#sss_mandatory_provident_fund_empee").val(
            data.data.sss_mandatory_provident_fund_empee
          );
          $("#provident_fund_kaupthing_empee").val(
            data.data.provident_fund_kaupthing_empee
          );
          $("#cash_advance_paid_onboard").val(
            data.data.cash_advance_paid_onboard
          );
          $("#other_deduction_1").val(data.data.other_deduction_1);
          $("#other_deduction_2").val(data.data.other_deduction_2);
          $("#other_deduction_3").val(data.data.other_deduction_3);
          $("#other_deduction_4").val(data.data.other_deduction_4);
          $("#other_deduction_5").val(data.data.other_deduction_5);
          $("#other_deduction_6").val(data.data.other_deduction_6);
          $("#other_deduction_7").val(data.data.other_deduction_7);
        }
      },
    });
  }
});

function reset_form() {
  $("#hid").val("");
  $("#vessel_code").val("").change();
  $("#rank_code").val("").change();
  $("#basic_wages_onb").val("");
  $("#basic_wages_trv").val("");
  $("#leave").val("");
  $("#education_allowance").val("");
  $("#guranteed_overtime").val("");
  $("#operational_allowance").val("");
  $("#supplementary_allowance").val("");
  $("#owners_bonus").val("");
  $("#other_earnings_1").val("");
  $("#other_earnings_2").val("");
  $("#philhelth_empee").val("");
  $("#social_security_system_empee").val("");
  $("#slopchest").val("");
  $("#pag_lbig_housing_program_empee").val("");
  $("#sss_mandatory_provident_fund_empee").val("");
  $("#provident_fund_kaupthing_empee").val("");
  $("#cash_advance_paid_onboard").val("");
  $("#other_deduction_1").val("");
  $("#other_deduction_2").val("");
  $("#other_deduction_3").val("");
  $("#other_deduction_4").val("");
  $("#other_deduction_5").val("");
  $("#other_deduction_6").val("");
  $("#other_deduction_7").val("");
}

// $(document).on("change", "#vessel_code_filter, #rank_code_filter", function () {
//   // Get current URL and parameters
//   var currentUrl = new URL(window.location.href);
//   var params = new URLSearchParams(currentUrl.search);

//   // Get the latest selected values from inputs
//   var vessel_code = $("#vessel_code_filter").val();
//   var rank_code = $("#rank_code_filter").val();

//   // === Read existing filter values from URL if not selected ===
//   // This is the FIX to preserve older values even if dropdown hasn't changed
//   if (!vessel_code && params.has("vessel_code_filter")) {
//     vessel_code = params.get("vessel_code_filter");
//   }

//   if (!rank_code && params.has("rank_code_filter")) {
//     rank_code = params.get("rank_code_filter");
//   }

//   // === Update filters ===
//   // Only set filters if a value exists
//   if (vessel_code) {
//     params.set("vessel_code_filter", vessel_code);
//   } else {
//     params.delete("vessel_code_filter");
//   }

//   if (rank_code) {
//     params.set("rank_code_filter", rank_code);
//   } else {
//     params.delete("rank_code_filter");
//   }

//   // Apply the updated query string to URL
//   currentUrl.search = params.toString();
//   window.location.href = currentUrl.toString();
// });


$(document).on("change", "#vessel_code_filter, #rank_code_filter", function () {
  // Get current URL and its parameters
  var currentUrl = new URL(window.location.href);
  var params = new URLSearchParams(currentUrl.search);

  // Get the latest selected values from dropdowns
  var vessel_code = $("#vessel_code_filter").val();
  var rank_code = $("#rank_code_filter").val();

  // ✅ Handle vessel_code
  if (vessel_code && vessel_code !== "") {
    params.set("vessel_code_filter", vessel_code);
  } else {
    params.delete("vessel_code_filter");
  }

  // ✅ Handle rank_code
  if (rank_code && rank_code !== "") {
    params.set("rank_code_filter", rank_code);
  } else {
    params.delete("rank_code_filter");
  }

  // Apply cleaned search parameters to URL
  currentUrl.search = params.toString();

  // Redirect to final URL
  window.location.href = currentUrl.toString();
});
