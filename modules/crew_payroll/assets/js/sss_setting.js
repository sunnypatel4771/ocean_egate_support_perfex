$(document).ready(function () {
  $(".edit_tab").on("click", function () {
    var btn_data_id = $(this).data("id");
    var from_val = $(".from_data_info_" + btn_data_id).html();
    var to = $(".to_data_info_" + btn_data_id).html();
    var amount = $(".amount_data_info_" + btn_data_id).html();
    var remarks = $(".remarks_data_info_" + btn_data_id).html();
    if (from_val != "") {
      $(".input_from_data_" + btn_data_id).val(from_val);
    }
    if (to != "") {
      $(".input_to_data_" + btn_data_id).val(to);
    }
    if (amount != "") {
      $(".input_amount_data_" + btn_data_id).val(amount);
    }
    if (remarks != "") {
      $(".input_remarks_data_" + btn_data_id).val(remarks);
    }
    $(".input_from_data_" + btn_data_id).show();
    $(".input_to_data_" + btn_data_id).show();
    $(".input_amount_data_" + btn_data_id).show();
    $(".input_remarks_data_" + btn_data_id).show();
    $(".from_data_info_" + btn_data_id).hide();
    $(".to_data_info_" + btn_data_id).hide();
    $(".amount_data_info_" + btn_data_id).hide();
    $(".remarks_data_info_" + btn_data_id).hide();
    $(this).hide();
    $(".save_" + btn_data_id).show();
  });

  $(".save").on("click", function () {
    var btn_data_id = $(this).data("id");
    var from = $(".input_from_data_" + btn_data_id).val();
    var to = $(".input_to_data_" + btn_data_id).val();
    var amount = $(".input_amount_data_" + btn_data_id).val();
    var remarks = $(".input_remarks_data_" + btn_data_id).val();
    $.ajax({
      url: admin_url + "crew_payroll/save_sss_setting",
      type: "POST",
      data: {
        id: btn_data_id,
        from: from,
        to: to,
        amount: amount,
        remarks: remarks,
      },
      success: function (res) {},
    });
    $(".input_from_data_" + btn_data_id).hide();
    $(".input_to_data_" + btn_data_id).hide();
    $(".input_amount_data_" + btn_data_id).hide();
    $(".input_remarks_data_" + btn_data_id).hide();
    $(".from_data_info_" + btn_data_id).show();
    $(".from_data_info_" + btn_data_id).html(from);
    $(".to_data_info_" + btn_data_id).show();
    $(".to_data_info_" + btn_data_id).html(to);
    $(".amount_data_info_" + btn_data_id).show();
    $(".amount_data_info_" + btn_data_id).html(amount);
    $(".remarks_data_info_" + btn_data_id).show();
    $(".remarks_data_info_" + btn_data_id).html(remarks);
    $(this).hide();
    $(".edit_tab_" + btn_data_id).show();
  });

  var infoFromElements = $(".info_from");
  var info_from_class_arr = infoFromElements
    .map(function () {
      var allClasses = $(this).attr("class").split(" ");
      var filteredClasses = allClasses.filter(function (className) {
        return className !== "info_from";
      });
      return filteredClasses.join(" ");
    })
    .get();

  for (let i = 0; i < 30; i++) {
    var n = i + 1;
    var from_amount = n * 1000;
    var class_name = info_from_class_arr[i];
    var from_p = $("." + class_name);
    if (from_p.html() == "") {
      from_p.html(from_amount);
    }
  }

  var infoToElements = $(".info_to");
  var info_to_class_arr = infoToElements
    .map(function () {
      var allClasses = $(this).attr("class").split(" ");
      var filteredClasses = allClasses.filter(function (className) {
        return className !== "info_to";
      });
      return filteredClasses.join(" ");
    })
    .get();

  for (let i = 0; i < 30; i++) {
    var n = i + 1;
    var to_amount = 2000 + i * 1000;
    var class_name = info_to_class_arr[i];
    var to_p = $("." + class_name);
    if (to_p.html() == "") {
      to_p.html(to_amount);
    }
  }
});
