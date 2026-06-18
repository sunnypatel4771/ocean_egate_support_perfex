$(document).ready(function () {
  $(".payroll_setup_tab").on("click", function () {
    $(this).parent().find(".tab_text").hide();
    $(this).parent().find("input").show();
    $(this).parent().find(".save-btn").show();
    $(this).hide();
  });

  $(".save-btn").on("click", function () {
    var input_value = $(this).closest(".col-sm-12").find("input").val();
    var input_name = $(this).parent().find("input").attr("name");
    $.ajax({
      url: admin_url + "crew_payroll/payroll_setup_tab_update",
      type: "POST",
      data: {
        name: input_name,
        value: input_value,
      },
      success: function (response) {
        $(this).parent().find(".save-btn").hide();
        $(this).parent().find(".payroll_setup_tab").show();
        $(this).parent().find("input").hide();
        $(this).parent().find(".tab_text").text(input_value).show();
      }.bind(this),
      error: function () {
        alert("Error saving data.");
      },
    });
  });
});
