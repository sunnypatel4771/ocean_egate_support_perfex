function new_minning_agency() {
  $("#manning_agency_modal").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");

  $('#code').val("");
  $("#agency_name").val("");
  $("#manning_agency_id").val("");
}

$(function () {
  appValidateForm($("#manning_agency_form"), {
    code: "required",
    agency_name: "required",
  });
});

$(document).on("click", ".delete_manning_agency", function () {
  var confirm = window.confirm("Are you sure you want to perform this action?");
  if (confirm) {
    var id = $(this).data("id");
    $.ajax({
      url: admin_url + "recruitment/delete_manning_agency",
      type: "POST",
      data: {
        id: id,
      },
      success: function (res) {
        var data = JSON.parse(res);
        if (data.status == 1) {
          alert_float("success", data.msg);
          setTimeout(function () {
            window.location.reload();
          }, 800);
        } else {
          alert_float("danger", data.msg);
        }
      },
    });
  }
});

$(document).on("click", ".edit_manning_agency", function () {
  var id = $(this).data("id");
  $.ajax({
    url: admin_url + "recruitment/get_manning_agency",
    type: "POST",
    data: {
      id: id,
    },
    success: function (res) {
      var data = JSON.parse(res);
      console.log("data:", data);
      if (data.status == 1) {
        var manning_agency = data.manning_agency;
        console.log("manning_agency:", manning_agency);
        $("#code").val(manning_agency.code);
        $("#agency_name").val(manning_agency.agency_name);
        $("#manning_agency_id").val(manning_agency.id);

        $("#manning_agency_modal").modal("show");
        $(".edit-title").removeClass("hide");
        $(".add-title").addClass("hide");
      } else {
        alert_float("danger", "No data Found");
      }
    },
  });
});
