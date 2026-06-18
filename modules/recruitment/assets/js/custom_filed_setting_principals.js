// relation family
function show_custom_filed_setting_principals_modal() {
  "use strict";
  $("#custom_filed_setting_principals_modal").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");

  $('#custom_filed_setting_principals_modal input[name="relation_name"]').val(
    "",
  );
  $("#additional_relation").html("");
}

// edit_custom_filed_setting_principal

// on this button i need to call ajex call to fetch dta
$(document).on("click", ".edit_custom_filed_setting_principal", function () {
  var id = $(this).data("id");
  //   console.log("id" , id);

  if (id > 0 && id != "") {
    $.ajax({
      url: admin_url + "recruitment/edit_custom_filed_setting_principal",
      type: "post",
      data: {
        id: id,
      },
      success: function (res) {
        var res = JSON.parse(res);
        if (res.status == 1) {
          var custom_filed_setting_principal =
            res.custom_filed_setting_principal;
          $("#custom_filed_setting_principals_modal #principal_name").val(
            custom_filed_setting_principal.principal_name,
          );
          $("#custom_filed_setting_principals_modal #principal_address").val(
            custom_filed_setting_principal.principal_address,
          );
          $("#custom_filed_setting_principals_modal #hid").val(
            custom_filed_setting_principal.id,
          );
          $("#custom_filed_setting_principals_modal").modal("show");
          $(".edit-title").removeClass("hide");
          $(".add-title").addClass("hide");
        } else {
        }
      },
    });
  }
});
