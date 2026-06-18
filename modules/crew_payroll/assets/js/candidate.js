$(document).on("click", "#edit_deduction", function () {
  var id = $(this).data("id");
  $.ajax({
    url: admin_url + "crew_payroll/get_deduction",
    data: {
      id: id,
    },
    type: "POST",
    success: function (res) {
      var data = JSON.parse(res);
      if (data.status == 1) {
        $("#deduction-form #name").val(data.data.name);
        $("#deduction-form #bank_acc").val(data.data.bank_acc);
        $("#deduction-form #amount").val(data.data.amount);
        $("#deduction-form #deduction_memo").val(data.data.deduction_memo);
        $("#deduction-form #remark").val(data.data.remark);
        $("#deduction-form #deduction_id").val(data.data.id);
        if (data.data.status == 1) {
          $("#deduction-form #status").prop("checked", true);
        }
        if (data.data.ded_file != "") {
          $("#edit_deduction_file").show();
          $("#edit_deduction_file").html(data.data.ded_file);
        }
        $("#addDeductionModal").modal("show");
      }
    },
  });
});
$("#addDeductionModal").on("hidden.bs.modal", function () {
  $("#edit_deduction_file").hide();
  $("#edit_deduction_file").html("");
  $("#deduction-form #deduction_id").val("");
  $("#deduction-form").trigger("reset");
});

$(document).ready(function () {
  function render_table() {
    initDataTable(
      $(".table-deduction_table"),
      admin_url + "crew_payroll/table_deduction",
      undefined,
      undefined
    );
  }
  render_table();
});

// $(document).on(
//   "input",
//   ".basic_wages_onb_rate, .basic_wages_onb_qty",
//   function () {
//     var $row = $(this).closest(".col-sm-12");
//     var rate = parseFloat($row.find(".basic_wages_onb_rate").val()) || 0;
//     var qty = parseFloat($row.find(".basic_wages_onb_qty").val()) || 0;
//     var amount = rate * qty;
//     $row.find(".basic_wages_onb_amount").val(amount.toFixed(2));
//   }
// );

// $(document).on(
//   "input",
//   "input[class*='_rate'], input[class*='_qty']",
//   function () {
//     var $input = $(this);
//     var className = $input.attr("class"); // example: "form-control basic_wages_onb_rate"

//     // Find the prefix like "basic_wages_onb" or "basic_wages_trv"
//     var prefix = className
//       .split(" ")
//       .filter((c) => c.includes("_rate") || c.includes("_qty"))[0]
//       .replace("_rate", "")
//       .replace("_qty", "");

//     var $row = $input.closest(".col-sm-12");

//     var rate = parseFloat($row.find("." + prefix + "_rate").val()) || 0;
//     console.log("rate", rate);

//     var qty = parseFloat($row.find("." + prefix + "_qty").val()) || 0;
//     console.log("qty", qty);
//     var amount = rate * qty;
//     console.log("amount", amount);

//     $row.find("." + prefix + "_amount").val(amount.toFixed(2));
//   }
// );

// 1. Function to calculate total sum
// function calculateTotalAmount() {
//   var total = 0;
//   $("input[class*='earning']").each(function () {
//     var val = parseFloat($(this).val()) || 0;
//     total += val;
//   });
//   $(".earnig_total_amount").text(total.toFixed(2)); //display in span/div
// }

// function calculateTotalAmount_deduction() {
//   var total = 0;
//   $("input[class*='deduction']").each(function () {
//     var val = parseFloat($(this).val()) || 0;
//     total += val;
//   });
//   $(".deduction_amount").text(total.toFixed(2));
// }

// function calculateTotalAmount_deduction_private() {
//   var total = 0;
//   $("input.dedu_private").each(function () {
//     var val = parseFloat($(this).val()) || 0;
//     total += val;
//   });
//   $(".deduction_amount_private").text(total.toFixed(2));
// }

// $(document).on("input", "input[id*='_rate'], input[id*='_qty']", function () {
//   var $input = $(this);
//   var $input_parent = $(this).parent();
//   var className = $input.attr("id");
//   var prefix = className
//     .split(" ")
//     .filter((c) => c.includes("_rate") || c.includes("_qty"))[0]
//     .replace("_rate", "")
//     .replace("_qty", "");

//   // var $row = $input_parent.closest(".col-sm-12");
//   // $($input_parent + ' td ' + prefix + '_amount').val(amount.toFixed(2))
//   // var rate = parseFloat($($input_parent + " td" + prefix + "_rate").val()) || 0;
//   console.log("rate", rate);

//   var qty = parseFloat($row.find("." + prefix + "_qty").val()) || 0;
//   // var amount = rate * qty;
//   // $row.find("#" + prefix + "_amount").val(amount.toFixed(2));
//   calculateTotalAmount();
//   calculateTotalAmount_deduction();
//   calculateTotalAmount_deduction_private();
//   calculatetotal_receiving();
// });

// calculateTotalAmount();
// calculateTotalAmount_deduction();
// calculateTotalAmount_deduction_private();
// function calculatetotal_receiving() {
//   let earningText = $(".earnig_total_amount").text().trim();
//   let deductionText = $(".deduction_amount").text().trim();
//   let deduction_private_Text = $(".deduction_amount_private").text().trim();
//   let earning = parseFloat(earningText) || 0;
//   let deduction = parseFloat(deductionText) || 0;
//   let total = earning - deduction - deduction_private_Text;
//   let value_text = "Total Receiving : " + total.toFixed(2);
//   $(".total_receiving").text(value_text);
// }
// calculatetotal_receiving();

var keys = [
  "basic_wages_onb",
  "basic_wages_trv",
  "leave",
  "education_allowance",
  "guranteed_overtime",
  "operational_allowance",
  "supplementary_allowance",
  "owners_bonus",
  "other_earnings_1",
  "other_earnings_2",
  "philhelth_empee",
  "social_security_system_empee",
  "slopchest",
  "pag_lbig_housing_program_empee",
  "sss_mandatory_provident_fund_empee",
  "provident_fund_kaupthing_empee",
  "cash_advance_paid_onboard",
  "other_deduction_1",
  "other_deduction_2",
  "other_deduction_3",
  "other_deduction_4",
  "other_deduction_5",
  "other_deduction_6",
  "other_deduction_7",
];

var earning = [
  "basic_wages_onb",
  "basic_wages_trv",
  "leave",
  "education_allowance",
  "guranteed_overtime",
  "operational_allowance",
  "supplementary_allowance",
  "owners_bonus",
  "other_earnings_1",
  "other_earnings_2",
];

var deduction_official = [
  "philhelth_empee",
  "social_security_system_empee",
  "slopchest",
  "pag_lbig_housing_program_empee",
  "sss_mandatory_provident_fund_empee",
  "provident_fund_kaupthing_empee",
  "cash_advance_paid_onboard",
];
var deduction_private = [
  "other_deduction_1",
  "other_deduction_2",
  "other_deduction_3",
  "other_deduction_4",
  "other_deduction_5",
  "other_deduction_6",
  "other_deduction_7",
];

$(document).on("change", "#select_payroll_code", function () {
  var select_payroll_code = $(this).val();
  var type_text = $("#type_text").val();
  if (select_payroll_code != "" && select_payroll_code > 0) {
    $.ajax({
      url: admin_url + "crew_payroll/get_payroll_table_data_by_code",
      data: {
        select_payroll_code: select_payroll_code,
      },
      type: "POST",
      success: function (res) {
        var data = JSON.parse(res);
        if (data.status == 1) {
          var payroll_table = data.data;
          if (type_text == "earning") {
            keys = earning;
          }
          $("#select_payroll_rank").val(payroll_table.rank);
          keys.forEach((e) => {
            var class_name = e + "_rate";
            $("#" + class_name)
              .val(payroll_table[e])
              .trigger("change");
          });
        }
      },
    });
  }
});

var vessel_code_selecter = $("#vessel_code_selecter").val();
function get_rank_code_list_by_vessel_code(vessel_code_selecter) {
  $.ajax({
    url: admin_url + "crew_payroll/get_rank_code_list_by_vessel_code",
    type: "POST",
    data: {
      vessel_code_selecter: vessel_code_selecter,
    },
    success: function (res) {
      $("#edit_payroll_setup_modal #vessel_code").val(vessel_code_selecter);
      var data = JSON.parse(res);
      if (data.status == 1) {
        var data = data.data;
        var html = "<option value=''>Select Rank</option>";
        var candidate_payroll_selection_detail_rank = $(
          ".candidate_payroll_selection_detail_rank"
        ).text();
        // console.log("candidate_payroll_selection_detail_rank" , candidate_payroll_selection_detail_rank);
        var candidate_payroll_selection_detail_rank_id;
        data.forEach((e) => {
          if (candidate_payroll_selection_detail_rank == e.name) {
            candidate_payroll_selection_detail_rank_id = e.id;
            html += '<option value="' + e.id + '" selected>' + e.name + "</option>";
          } else {
            html += '<option value="' + e.id + '">' + e.name + "</option>";
          }
        });
        // console.log("candidate_payroll_selection_detail_rank_id" , candidate_payroll_selection_detail_rank_id);
        $("#rank_code_selecter").html("");
        $("#rank_code_selecter").html(html);
        $("#rank_code_selecter").selectpicker("refresh");
        $("#rank_code_selecter").val(candidate_payroll_selection_detail_rank_id).change();
        // $("#rank_code_selecter").trigger("change");
      }
    },
  });
}

$(document).on("click", ".edit_payroll_setup", function () {
  var type = $(this).data("type");
  var candidate_id = $(this).data("candidate_id");
  if (type != "" && candidate_id != "" && candidate_id > 0) {
    $.ajax({
      url: admin_url + "crew_payroll/get_payroll_setup_modal_detail",
      type: "POST",
      data: {
        type: type,
        candidate_id: candidate_id,
      },
      success: function (res) {
        var data = JSON.parse(res);
        if (data.status == 1) {
          $(".modal_table").html("");
          $(".modal_table").html(data.html);
          if (vessel_code_selecter != "") {
            get_rank_code_list_by_vessel_code(vessel_code_selecter);
          }
          $("#edit_payroll_setup_modal").modal("show");
          if (type == "earning") {
            $(".select_payroll_code_dropdowns_box").show();
          } else {
            $(".select_payroll_code_dropdowns_box").hide();
          }
        }
      },
    });
  }
});

setTimeout(() => {
  var earning_total = $("#earning_total").val();
  $("#earnings").html(earning_total);

  var deduction_official_total = $("#deduction_official_total").val();
  $("#deduction_official").html(deduction_official_total);

  var deduction_private_total = $("#deduction_private_total").val();
  $("#deduction_private").html(deduction_private_total);
  var clean_earning_total = parseFloat(earning_total.replace(/,/g, "")) || 0;
  var clean_deduction_official_total =
    parseFloat(deduction_official_total.replace(/,/g, "")) || 0;
  var clean_deduction_private_total =
    parseFloat(deduction_private_total.replace(/,/g, "")) || 0;

  var total_receiving =
    clean_earning_total -
    clean_deduction_official_total -
    clean_deduction_private_total;
  // var total_receiving =
  //   parseFloat(earning_total) -
  //   parseFloat(deduction_official_total) -
  //   parseFloat(deduction_private_total);
  var formatted_total = total_receiving.toLocaleString("en-US", {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  });
  $("#total_receiving").html(formatted_total);
}, 500);

$(document).on(
  "input change",
  'input[id$="_rate"], input[id$="_qty"]',
  function () {
    const inputId = $(this).attr("id");
    const key = inputId.replace(/_(rate|qty)$/, "");
    const rate = parseFloat($("#" + key + "_rate").val()) || 0;
    const qty = parseFloat($("#" + key + "_qty").val()) || 0;
    const amount = rate * qty;
    $("#" + key + "_amount").val(amount.toFixed(2));
  }
);

$(document).on("click", "#process_payroll_btn", function () {
  var candidate_id = $(this).data("candidate_id");
  $.ajax({
    url: admin_url + "crew_payroll/get_payroll_period_data",
    data: {
      candidate_id: candidate_id,
    },
    type: "POST",
    success: function (res) {
      var data = JSON.parse(res);
      if (data.status == 1) {
        $("#select_payroll_period_modal .payroll_period_div").html(data.html);
        $("#select_payroll_period_modal .summary_payroll_history_div").hide();
        $("#select_payroll_period_modal #save_payroll_history").hide();
        $("#select_payroll_period_modal").modal("show");
      }
    },
  });
});

$(document).on("click", "#save_payroll_history_btn", function () {
  var candidate_id = $("#select_payroll_period_modal #candidate_id").val();
  var checkedBox = $(".payroll_period_checkbox:checked");

  if (checkedBox.length === 0) {
    alert("Please Select One Payroll Period.");
    return;
  }

  var selectedId = checkedBox.data("id");
  if (candidate_id != "" && candidate_id > 0) {
    $.ajax({
      url: admin_url + "crew_payroll/save_payroll_history",
      type: "POST",
      data: {
        candidate_id: candidate_id,
        selectedId: selectedId,
      },
      success: function (res) {
        var data = JSON.parse(res);
        if (data.status == 1) {
          // alert_float("success", data.msg);
          // $("#summary_payroll_history_modal").modal("show");
          // $("#select_payroll_period_modal").modal("hide");
          // summary_payroll_history_div
          $("#select_payroll_period_modal .summary_payroll_history_div").show();
          $("#select_payroll_period_modal #save_payroll_history").show();
          $("#select_payroll_period_modal #save_payroll_history_btn").hide();
          var payroll_history_summary = data.data;
          $(
            "#select_payroll_period_modal .summary_payroll_history_div #candidate_id"
          ).val(payroll_history_summary.candidate_id);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div #exchange_rate"
          ).val(payroll_history_summary.exchange_rate);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div #from"
          ).val(payroll_history_summary.from);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div #to"
          ).val(payroll_history_summary.to);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div #days"
          ).val(payroll_history_summary.days);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div #payroll_reference"
          ).val(payroll_history_summary.payroll_reference);

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #basic_wages_onb"
          ).val(payroll_history_summary.basic_wages_onb);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .basic_wages_onb_text"
          ).html(
            Number(payroll_history_summary.basic_wages_onb).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #basic_wages_trv"
          ).val(payroll_history_summary.basic_wages_trv);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .basic_wages_trv_text"
          ).html(
            Number(payroll_history_summary.basic_wages_trv).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #leave"
          ).val(payroll_history_summary.leave);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .leave_text"
          ).html(Number(payroll_history_summary.leave).toLocaleString());

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #education_allowance"
          ).val(payroll_history_summary.education_allowance);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .education_allowance_text"
          ).html(
            Number(payroll_history_summary.education_allowance).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #guranteed_overtime"
          ).val(payroll_history_summary.guranteed_overtime);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .guranteed_overtime_text"
          ).html(
            Number(payroll_history_summary.guranteed_overtime).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #operational_allowance"
          ).val(payroll_history_summary.operational_allowance);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .operational_allowance_text"
          ).html(
            Number(
              payroll_history_summary.operational_allowance
            ).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #supplementary_allowance"
          ).val(payroll_history_summary.supplementary_allowance);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .supplementary_allowance_text"
          ).html(
            Number(
              payroll_history_summary.supplementary_allowance
            ).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #owners_bonus"
          ).val(payroll_history_summary.owners_bonus);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .owners_bonus_text"
          ).html(Number(payroll_history_summary.owners_bonus).toLocaleString());

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #other_earnings_1"
          ).val(payroll_history_summary.other_earnings_1);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .other_earnings_1_text"
          ).html(
            Number(payroll_history_summary.other_earnings_1).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #other_earnings_2"
          ).val(payroll_history_summary.other_earnings_2);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .other_earnings_2_text"
          ).html(
            Number(payroll_history_summary.other_earnings_2).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #philhelth_empee"
          ).val(payroll_history_summary.philhelth_empee);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .philhelth_empee_text"
          ).html(
            Number(payroll_history_summary.philhelth_empee).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #social_security_system_empee"
          ).val(payroll_history_summary.social_security_system_empee);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .social_security_system_empee_text"
          ).html(
            Number(
              payroll_history_summary.social_security_system_empee
            ).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #slopchest"
          ).val(payroll_history_summary.slopchest);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .slopchest_text"
          ).html(Number(payroll_history_summary.slopchest).toLocaleString());

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #pag_lbig_housing_program_empee"
          ).val(payroll_history_summary.pag_lbig_housing_program_empee);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .pag_lbig_housing_program_empee_text"
          ).html(
            Number(
              payroll_history_summary.pag_lbig_housing_program_empee
            ).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #sss_mandatory_provident_fund_empee"
          ).val(payroll_history_summary.sss_mandatory_provident_fund_empee);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .sss_mandatory_provident_fund_empee_text"
          ).html(
            Number(
              payroll_history_summary.sss_mandatory_provident_fund_empee
            ).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #provident_fund_kaupthing_empee"
          ).val(payroll_history_summary.provident_fund_kaupthing_empee);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .provident_fund_kaupthing_empee_text"
          ).html(
            Number(
              payroll_history_summary.provident_fund_kaupthing_empee
            ).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #cash_advance_paid_onboard"
          ).val(payroll_history_summary.cash_advance_paid_onboard);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .cash_advance_paid_onboard_text"
          ).html(
            Number(
              payroll_history_summary.cash_advance_paid_onboard
            ).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #other_deduction_1"
          ).val(payroll_history_summary.other_deduction_1);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .other_deduction_1_text"
          ).html(
            Number(payroll_history_summary.other_deduction_1).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #other_deduction_2"
          ).val(payroll_history_summary.other_deduction_2);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .other_deduction_2_text"
          ).html(
            Number(payroll_history_summary.other_deduction_2).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #other_deduction_3"
          ).val(payroll_history_summary.other_deduction_3);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .other_deduction_3_text"
          ).html(
            Number(payroll_history_summary.other_deduction_3).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #other_deduction_4"
          ).val(payroll_history_summary.other_deduction_4);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .other_deduction_4_text"
          ).html(
            Number(payroll_history_summary.other_deduction_4).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #other_deduction_5"
          ).val(payroll_history_summary.other_deduction_5);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .other_deduction_5_text"
          ).html(
            Number(payroll_history_summary.other_deduction_5).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #other_deduction_6"
          ).val(payroll_history_summary.other_deduction_6);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .other_deduction_6_text"
          ).html(
            Number(payroll_history_summary.other_deduction_6).toLocaleString()
          );

          $(
            "#select_payroll_period_modal .summary_payroll_history_div #other_deduction_7"
          ).val(payroll_history_summary.other_deduction_7);
          $(
            "#select_payroll_period_modal .summary_payroll_history_div .other_deduction_7_text"
          ).html(
            Number(payroll_history_summary.other_deduction_7).toLocaleString()
          );
        } else {
          // alert_float("danger", data.msg);
        }
      },
    });
  }
});

$(document).on("change", ".payroll_period_checkbox", function () {
  $(".payroll_period_checkbox").not(this).prop("checked", false);
});

$(document).on("click", ".edit_payroll_history", function () {
  var id = $(this).data("id");
  if (id != "" && id > 0) {
    $.ajax({
      url: admin_url + "crew_payroll/edit_payroll_history",
      type: "POST",
      data: {
        id: id,
      },
      success: function (res) {
        var data = JSON.parse(res);
        if (data.status == 1) {
          $("#edit_payroll_history_modal #id").val(data.data.id);
          $("#edit_payroll_history_modal #from").val(data.data.from);
          $("#edit_payroll_history_modal #to").val(data.data.to);
          $("#edit_payroll_history_modal #days").val(data.data.days);
          $("#edit_payroll_history_modal #basic_wages_onb").val(
            data.data.basic_wages_onb
          );
          $("#edit_payroll_history_modal #basic_wages_trv").val(
            data.data.basic_wages_trv
          );
          $("#edit_payroll_history_modal #leave").val(data.data.leave);
          $("#edit_payroll_history_modal #education_allowance").val(
            data.data.education_allowance
          );
          $("#edit_payroll_history_modal #guranteed_overtime").val(
            data.data.guranteed_overtime
          );
          $("#edit_payroll_history_modal #operational_allowance").val(
            data.data.operational_allowance
          );
          $("#edit_payroll_history_modal #supplementary_allowance").val(
            data.data.supplementary_allowance
          );
          $("#edit_payroll_history_modal #owners_bonus").val(
            data.data.owners_bonus
          );
          $("#edit_payroll_history_modal #other_earnings_1").val(
            data.data.other_earnings_1
          );
          $("#edit_payroll_history_modal #other_earnings_2").val(
            data.data.other_earnings_2
          );
          $("#edit_payroll_history_modal #philhelth_empee").val(
            data.data.philhelth_empee
          );
          $("#edit_payroll_history_modal #social_security_system_empee").val(
            data.data.social_security_system_empee
          );
          $("#edit_payroll_history_modal #slopchest").val(data.data.slopchest);
          $("#edit_payroll_history_modal #pag_lbig_housing_program_empee").val(
            data.data.pag_lbig_housing_program_empee
          );
          $(
            "#edit_payroll_history_modal #sss_mandatory_provident_fund_empee"
          ).val(data.data.sss_mandatory_provident_fund_empee);
          $("#edit_payroll_history_modal #provident_fund_kaupthing_empee").val(
            data.data.provident_fund_kaupthing_empee
          );
          $("#edit_payroll_history_modal #cash_advance_paid_onboard").val(
            data.data.cash_advance_paid_onboard
          );
          $("#edit_payroll_history_modal #other_deduction_1").val(
            data.data.other_deduction_1
          );
          $("#edit_payroll_history_modal #other_deduction_2").val(
            data.data.other_deduction_2
          );
          $("#edit_payroll_history_modal #other_deduction_3").val(
            data.data.other_deduction_3
          );
          $("#edit_payroll_history_modal #other_deduction_4").val(
            data.data.other_deduction_4
          );
          $("#edit_payroll_history_modal #other_deduction_5").val(
            data.data.other_deduction_5
          );
          $("#edit_payroll_history_modal #other_deduction_6").val(
            data.data.other_deduction_6
          );
          $("#edit_payroll_history_modal #other_deduction_7").val(
            data.data.other_deduction_7
          );
          $("#edit_payroll_history_modal").modal("show");
        }
      },
    });
  }
});

$(document).on(
  "change",
  "#edit_payroll_history_modal #from, #edit_payroll_history_modal #to",
  function () {
    var fromDate = $("#edit_payroll_history_modal #from").val();
    var toDate = $("#edit_payroll_history_modal #to").val();
    if (fromDate !== "" && toDate !== "") {
      var start = new Date(fromDate);
      var end = new Date(toDate);
      var diffTime = end - start;
      var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

      if (diffDays < 0) {
        console.log("To Date is Before From Date!");
      } else {
        $("#edit_payroll_history_modal #days").val(diffDays);
      }
    }
  }
);

// $(document).on(
//   "change",
//   "#vessel_code_selecter , #rank_code_selecter",
//   function () {
//     var vessel_code_selecter = $("#vessel_code_selecter").val();
//     var rank_code_selecter = $("#rank_code_selecter").val();
//     if (vessel_code_selecter != "" && rank_code_selecter != "") {
//       $.ajax({
//         url:
//           admin_url + "crew_payroll/get_payroll_table_data_by_rank_and_vessel",
//         data: {
//           vessel_code_selecter: vessel_code_selecter,
//           rank_code_selecter: rank_code_selecter,
//         },
//         type: "POST",
//         success: function (res) {
//           $("#edit_payroll_setup_modal #vessel_code").val(vessel_code_selecter);
//           $("#edit_payroll_setup_modal #rank_code").val(rank_code_selecter);
//           var data = JSON.parse(res);
//           if (data.status == 1) {
//             var payroll_table_data = data.data;
//             console.log("payroll_table_data", payroll_table_data);

//             keys = earning;

//             keys.forEach((e) => {
//               var class_name = e + "_rate";
//               $("#" + class_name)
//                 .val(payroll_table_data[e])
//                 .trigger("change");
//             });
//           }
//         },
//       });
//     }
//   }
// );

$(document).on("change", "#vessel_code_selecter", function () {
  var vessel_code_selecter = $(this).val();
  if (vessel_code_selecter != "") {
    $.ajax({
      url: admin_url + "crew_payroll/get_rank_code_list_by_vessel_code",
      type: "POST",
      data: {
        vessel_code_selecter: vessel_code_selecter,
      },
      success: function (res) {
        $("#edit_payroll_setup_modal #vessel_code").val(vessel_code_selecter);
        var data = JSON.parse(res);
        if (data.status == 1) {
          var data = data.data;
          var html = "<option value=''>Select Rank</option>";
          data.forEach((e) => {
            html += '<option value="' + e.id + '">' + e.name + "</option>";
          });
          $("#rank_code_selecter").html("");
          $("#rank_code_selecter").html(html);
          $("#rank_code_selecter").selectpicker("refresh");
        }
      },
    });
  }
});

$(document).on("change", "#rank_code_selecter", function () {
  var rank_code_selecter = $(this).val();
  var vessel_code_selecter = $("#vessel_code_selecter").val();
  if (rank_code_selecter != "" && vessel_code_selecter != "") {
    $("#edit_payroll_setup_modal #rank_code").val(rank_code_selecter);
    $("#edit_payroll_setup_modal #vessel_code").val(vessel_code_selecter);
    $.ajax({
      url: admin_url + "crew_payroll/get_payroll_table_data_by_rank_and_vessel",
      data: {
        vessel_code_selecter: vessel_code_selecter,
        rank_code_selecter: rank_code_selecter,
      },
      type: "POST",
      success: function (res) {
        $("#edit_payroll_setup_modal #vessel_code").val(vessel_code_selecter);
        $("#edit_payroll_setup_modal #rank_code").val(rank_code_selecter);
        var data = JSON.parse(res);
        if (data.status == 1) {
          var payroll_table_data = data.data;
          console.log("payroll_table_data", payroll_table_data);

          keys = earning;

          keys.forEach((e) => {
            var class_name = e + "_rate";
            $("#" + class_name)
              .val(payroll_table_data[e])
              .trigger("change");
          });
        }
      },
    });
  }
});
