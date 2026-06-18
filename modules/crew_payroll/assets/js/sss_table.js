$(document).ready(function () {
  $('select[name="DataTables_Table_0_length"]').val("10").trigger("change");
  $(".sorting").addClass("table_th");
  $(".edit_tab").on("click", function () {
    var btn_data_id = $(this).data("id");
    var values = {};
    values["compensation_from"] = $(
      ".compensation_from_data_info_" + btn_data_id
    ).html();
    values["compensation_to"] = $(
      ".compensation_to_data_info_" + btn_data_id
    ).html();
    values["monthly_salary_credit_regular_ss_ec"] = $(
      ".monthly_salary_credit_regular_ss_ec_data_info_" + btn_data_id
    ).html();
    values["monthly_salary_credit_regular_wisp"] = $(
      ".monthly_salary_credit_regular_wisp_data_info_" + btn_data_id
    ).html();
    values["monthly_salary_credit_regular_total"] = $(
      ".monthly_salary_credit_regular_total_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_regular_ss_er"] = $(
      ".amount_of_contributions_regular_ss_er_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_regular_ss_ee"] = $(
      ".amount_of_contributions_regular_ss_ee_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_regular_ss_total"] = $(
      ".amount_of_contributions_regular_ss_total_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_ec_er"] = $(
      ".amount_of_contributions_ec_er_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_ec_ee"] = $(
      ".amount_of_contributions_ec_ee_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_ec_total"] = $(
      ".amount_of_contributions_ec_total_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_wisp_er"] = $(
      ".amount_of_contributions_wisp_er_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_wisp_ee"] = $(
      ".amount_of_contributions_wisp_ee_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_wisp_total"] = $(
      ".amount_of_contributions_wisp_total_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_total_er"] = $(
      ".amount_of_contributions_total_er_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_total_ee"] = $(
      ".amount_of_contributions_total_ee_data_info_" + btn_data_id
    ).html();
    values["amount_of_contributions_total"] = $(
      ".amount_of_contributions_total_data_info_" + btn_data_id
    ).html();
    Object.keys(values).forEach(function (key) {
      var class_name = "input_" + key + "_data_" + btn_data_id;
      $("." + class_name).val(values[key]);
      $("." + class_name).show();
      var hide_data_info_class = key + "_data_info_" + btn_data_id;
      $("." + hide_data_info_class).hide();
    });

    $(this).hide();
    $(".save_" + btn_data_id).show();
  });

  $(".save").on("click", function () {
    var btn_data_id = $(this).data("id");
    var values = {};
    values["compensation_from"] = $(
      ".input_compensation_from_data_" + btn_data_id
    ).val();
    values["compensation_to"] = $(
      ".input_compensation_to_data_" + btn_data_id
    ).val();
    values["monthly_salary_credit_regular_ss_ec"] = $(
      ".input_monthly_salary_credit_regular_ss_ec_data_" + btn_data_id
    ).val();
    values["monthly_salary_credit_regular_wisp"] = $(
      ".input_monthly_salary_credit_regular_wisp_data_" + btn_data_id
    ).val();
    values["monthly_salary_credit_regular_total"] = $(
      ".input_monthly_salary_credit_regular_total_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_regular_ss_er"] = $(
      ".input_amount_of_contributions_regular_ss_er_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_regular_ss_ee"] = $(
      ".input_amount_of_contributions_regular_ss_ee_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_regular_ss_total"] = $(
      ".input_amount_of_contributions_regular_ss_total_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_ec_er"] = $(
      ".input_amount_of_contributions_ec_er_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_ec_ee"] = $(
      ".input_amount_of_contributions_ec_ee_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_ec_total"] = $(
      ".input_amount_of_contributions_ec_total_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_wisp_er"] = $(
      ".input_amount_of_contributions_wisp_er_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_wisp_ee"] = $(
      ".input_amount_of_contributions_wisp_ee_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_wisp_total"] = $(
      ".input_amount_of_contributions_wisp_total_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_total_er"] = $(
      ".input_amount_of_contributions_total_er_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_total_ee"] = $(
      ".input_amount_of_contributions_total_ee_data_" + btn_data_id
    ).val();
    values["amount_of_contributions_total"] = $(
      ".input_amount_of_contributions_total_data_" + btn_data_id
    ).val();
    $.ajax({
      url: admin_url + "crew_payroll/save_sss_table",
      type: "POST",
      data: {
        id: btn_data_id,
        compensation_from: values["compensation_from"],
        compensation_to: values["compensation_to"],
        monthly_salary_credit_regular_ss_ec:
          values["monthly_salary_credit_regular_ss_ec"],
        monthly_salary_credit_regular_wisp:
          values["monthly_salary_credit_regular_wisp"],
        monthly_salary_credit_regular_total:
          values["monthly_salary_credit_regular_total"],
        amount_of_contributions_regular_ss_er:
          values["amount_of_contributions_regular_ss_er"],
        amount_of_contributions_regular_ss_ee:
          values["amount_of_contributions_regular_ss_ee"],
        amount_of_contributions_regular_ss_total:
          values["amount_of_contributions_regular_ss_total"],
        amount_of_contributions_ec_er: values["amount_of_contributions_ec_er"],
        amount_of_contributions_ec_ee: values["amount_of_contributions_ec_ee"],
        amount_of_contributions_ec_total:
          values["amount_of_contributions_ec_total"],
        amount_of_contributions_wisp_er:
          values["amount_of_contributions_wisp_er"],
        amount_of_contributions_wisp_ee:
          values["amount_of_contributions_wisp_ee"],
        amount_of_contributions_wisp_total:
          values["amount_of_contributions_wisp_total"],
        amount_of_contributions_total_er:
          values["amount_of_contributions_total_er"],
        amount_of_contributions_total_ee:
          values["amount_of_contributions_total_ee"],
        amount_of_contributions_total: values["amount_of_contributions_total"],
      },
      success: function (res) {},
    });

    Object.keys(values).forEach(function (key) {
      var class_name = "input_" + key + "_data_" + btn_data_id;
      $("." + class_name).hide();
      var hide_data_info_class = key + "_data_info_" + btn_data_id;
      $("." + hide_data_info_class).show();
      $("." + hide_data_info_class).html(values[key]);
    });

    $(this).hide();
    $(".edit_tab_" + btn_data_id).show();
  });
});