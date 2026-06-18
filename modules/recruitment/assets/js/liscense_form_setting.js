// travel family

function new_travel() {
  "use strict";
  $("#travel").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");
  $('#travel input[name="document_type"]').val("");
  $('#travel input[name="order_no"]').val("");
  $('#travel input[name="expiration_date"]').val("");
  $('#travel input[name="no_expired"]').prop('checked', false);
  $('#travel input[name="display_info"]').prop('checked', false);
  $("#additional_travel").html("");
}

function edit_travel(invoker, id) {
  "use strict";
  $("#additional_travel").append(hidden_input("id", id));
  $('#travel input[name="document_type"]').val($(invoker).data("name"));
  $('#travel input[name="expiration_date"]').val($(invoker).data("date"));
  $('#travel input[name="order_no"]').val($(invoker).data("order"));
  var isChecked = $(invoker).data("cheked") == 1;
  var isCheckeddisplay = $(invoker).data("display_info") == 1;
  $('#travel input[name="no_expired"]').prop('checked', isChecked);
  $('#travel input[name="display_info"]').prop('checked', isCheckeddisplay);
  $("#travel").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

function new_emp_travel() {
  "use strict";
  $("#emp_contract").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");
  $('#emp_contract input[name="emp_document_type"]').val("");
  $('#emp_contract input[name="emp_expiration_date"]').val("");
  $('#emp_contract input[name="order_no"]').val("");
  $("#additional_contract").html("");
}

function edit_emp_travel(invoker, id) {
  "use strict";
  $("#additional_contract").append(hidden_input("id", id));
  $('#emp_contract input[name="emp_document_type"]').val(
    $(invoker).data("name")
  );
  $('#emp_contract input[name="emp_expiration_date"]').val(
    $(invoker).data("date")
  );
  $('#emp_contract input[name="order_no"]').val($(invoker).data("order"));
  $("#emp_contract").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

function new_request_renew() {
  "use strict";
  $("#request_renew").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");
  $('#request_renew input[name="name"]').val("");
  $("#additional_request_renew").html("");
}

function edit_request_renew(invoker, id) {
  "use strict";
  $("#additional_request_renew").append(hidden_input("id", id));
  $('#request_renew input[name="name"]').val(
    $(invoker).data("name")
  );
  $('#request_renew input[name="font_color"]').val(
    $(invoker).data("color")
  );
  $("#request_renew").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

$('#rename_travel_and_identification').on('click', function() {
  $('#travel_and_identification_header').hide();
  $('#rename_travel_and_identification').hide();

  $('#travel_and_identification_input').show();

  $('#travel_and_identification_input input').focus();
});

function new_other_licence() {
  "use strict";
  $("#other_licence").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");
  $('#other_licence input[name="document_type"]').val("");
  $('#other_licence input[name="order_no"]').val("");
  $('#other_licence input[name="expiration_date"]').val("");
  $('#other_licence input[name="no_expired"]').prop('checked', false);
  $('#other_licence input[name="display_info"]').prop('checked', false);
  $("#additional_other_licence").html("");
}

function edit_other_licence(invoker, id) {
  "use strict";
  $("#additional_other_licence").append(hidden_input("id", id));
  $('#other_licence input[name="document_type"]').val($(invoker).data("name"));
  $('#other_licence input[name="expiration_date"]').val($(invoker).data("date"));
  $('#other_licence input[name="order_no"]').val($(invoker).data("order"));
  var isChecked = $(invoker).data("cheked") == 1;
  var isCheckeddisplay = $(invoker).data("display_info") == 1;
  $('#other_licence input[name="no_expired"]').prop('checked', isChecked);
  $('#other_licence input[name="display_info"]').prop('checked', isCheckeddisplay);
  $("#other_licence").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

function new_licence_3() {
  "use strict";
  $("#licence_3_modal").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");
  $('#licence_3_modal input[name="document_type"]').val("");
  $('#licence_3_modal input[name="order_no"]').val("");
  $('#licence_3_modal input[name="expiration_date"]').val("");
  $('#licence_3_modal input[name="no_expired"]').prop('checked', false);
  $('#licence_3_modal input[name="display_info"]').prop('checked', false);
  $("#additional_licence_3").html("");
}

function edit_licence_3(invoker, id) {
  "use strict";
  $("#additional_licence_3").append(hidden_input("id", id));
  $('#licence_3_modal input[name="document_type"]').val($(invoker).data("name"));
  $('#licence_3_modal input[name="expiration_date"]').val($(invoker).data("date"));
  $('#licence_3_modal input[name="order_no"]').val($(invoker).data("order"));
  var isChecked = $(invoker).data("cheked") == 1;
  var isCheckeddisplay = $(invoker).data("display_info") == 1;
  $('#licence_3_modal input[name="no_expired"]').prop('checked', isChecked);
  $('#licence_3_modal input[name="display_info"]').prop('checked', isCheckeddisplay);
  $("#licence_3_modal").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

function new_licence_4() {
  "use strict";
  $("#licence_4_modal").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");
  $('#licence_4_modal input[name="document_type"]').val("");
  $('#licence_4_modal input[name="order_no"]').val("");
  $('#licence_4_modal input[name="expiration_date"]').val("");
  $('#licence_4_modal input[name="no_expired"]').prop('checked', false);
  $('#licence_4_modal input[name="display_info"]').prop('checked', false);
  $("#additional_licence_4").html("");
}

function edit_licence_4(invoker, id) {
  "use strict";
  $("#additional_licence_4").append(hidden_input("id", id));
  $('#licence_4_modal input[name="document_type"]').val($(invoker).data("name"));
  $('#licence_4_modal input[name="expiration_date"]').val($(invoker).data("date"));
  $('#licence_4_modal input[name="order_no"]').val($(invoker).data("order"));
  var isChecked = $(invoker).data("cheked") == 1;
  var isCheckeddisplay = $(invoker).data("display_info") == 1;
  $('#licence_4_modal input[name="no_expired"]').prop('checked', isChecked);
  $('#licence_4_modal input[name="display_info"]').prop('checked', isCheckeddisplay);
  $("#licence_4_modal").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

function new_licence_5() {
  "use strict";
  $("#licence_5_modal").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");
  $('#licence_5_modal input[name="document_type"]').val("");
  $('#licence_5_modal input[name="order_no"]').val("");
  $('#licence_5_modal input[name="expiration_date"]').val("");
  $('#licence_5_modal input[name="no_expired"]').prop('checked', false);
  $('#licence_5_modal input[name="display_info"]').prop('checked', false);
  $("#additional_licence_5").html("");
}

function edit_licence_5(invoker, id) {
  "use strict";
  $("#additional_licence_5").append(hidden_input("id", id));
  $('#licence_5_modal input[name="document_type"]').val($(invoker).data("name"));
  $('#licence_5_modal input[name="expiration_date"]').val($(invoker).data("date"));
  $('#licence_5_modal input[name="order_no"]').val($(invoker).data("order"));
  var isChecked = $(invoker).data("cheked") == 1;
  var isCheckeddisplay = $(invoker).data("display_info") == 1;
  $('#licence_5_modal input[name="no_expired"]').prop('checked', isChecked);
  $('#licence_5_modal input[name="display_info"]').prop('checked', isCheckeddisplay);
  $("#licence_5_modal").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

function new_licence_6() {
  "use strict";
  $("#licence_6_modal").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");
  $('#licence_6_modal input[name="document_type"]').val("");
  $('#licence_6_modal input[name="order_no"]').val("");
  $('#licence_6_modal input[name="expiration_date"]').val("");
  $('#licence_6_modal input[name="no_expired"]').prop('checked', false);
  $('#licence_6_modal input[name="display_info"]').prop('checked', false);
  $("#additional_licence_6").html("");
}

function edit_licence_6(invoker, id) {
  "use strict";
  $("#additional_licence_6").append(hidden_input("id", id));
  $('#licence_6_modal input[name="document_type"]').val($(invoker).data("name"));
  $('#licence_6_modal input[name="expiration_date"]').val($(invoker).data("date"));
  $('#licence_6_modal input[name="order_no"]').val($(invoker).data("order"));
  var isChecked = $(invoker).data("cheked") == 1;
  var isCheckeddisplay = $(invoker).data("display_info") == 1;
  $('#licence_6_modal input[name="no_expired"]').prop('checked', isChecked);
  $('#licence_6_modal input[name="display_info"]').prop('checked', isCheckeddisplay);
  $("#licence_6_modal").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}


$('#rename_other_licence').on('click', function() {
  $('#other_licence_header').hide();
  $('#rename_other_licence').hide();

  $('#other_licence_input').show();

  $('#other_licence_input input').focus();
});


$('#rename_licence_3').on('click', function() {
  $('#licence_3_header').hide();
  $('#rename_licence_3').hide();

  $('#licence_3_input').show();

  $('#licence_3_input input').focus();
});

$('#rename_licence_4').on('click', function() {
  $('#licence_4_header').hide();
  $('#rename_licence_4').hide();

  $('#licence_4_input').show();

  $('#licence_4_input input').focus();
});

$('#rename_licence_5').on('click', function() {
  $('#licence_5_header').hide();
  $('#rename_licence_5').hide();

  $('#licence_5_input').show();

  $('#licence_5_input input').focus();
});

$('#rename_licence_6').on('click', function() {
  $('#licence_6_header').hide();
  $('#rename_licence_6').hide();

  $('#licence_6_input').show();

  $('#licence_6_input input').focus();
});



// $("#travel").on("hidden.bs.modal", function () {
//     var $form = $(this).find('form');
//     $form.find('input[name="document_type"]').val('');
//     $form.find('input[name="expiration_date"]').val('');
//     var validator = $form.validate();
//     validator.resetForm();
//     $form.find('.form-group').removeClass('has-error');
//   });
  
// $("#emp_contract").on("hidden.bs.modal", function () {
//   var $form = $(this).find('form');
//   $form.find('input[name="emp_document_type"]').val('');
//   $form.find('input[name="emp_expiration_date"]').val('');
//   var validator = $form.validate();
//   validator.resetForm();
//   $form.find('.form-group').removeClass('has-error');
// });

// // order no validation

// appValidateForm(
//   $("#travel-form"),
//   {
//     document_type: "required",
//     expiration_date: "required",
//     order_no: {
//       required: true,
//       remote: {
//         url: admin_url + "recruitment/order_no_travel_exists",
//         type: "post",
//         data: {
//           check_no: function () {
//             return $('input[name="order_no"]').val();
//           },
//           id: function () {
//             return $('input[name="id"]').val();
//           },
//         },
//       },
//     },
//   },
//   travelsubmithandler,
//   {
//     order_no: {
//       remote: "order must be unique.",
//     },
//   }
// );

// function travelsubmithandler(form) {
//   form.submit();
// }



// appValidateForm(
//   $("#emp_contract-form"),
//   {
//     emp_document_type: "required",
//     emp_expiration_date: "required",
//     order_no: {
//       required: true,
//       remote: {
//         url: admin_url + "recruitment/order_no_contract_exists",
//         type: "post",
//         data: {
//           check_no: function () {
//             return $('input[name="order_no"]').val();
//           },
//           id: function () {
//             return $('input[name="id"]').val();
//           },
//         },
//       },
//     },
//   },
//   contractsubmithandler,
//   {
//     order_no: {
//       remote: "order must be unique.",
//     },
//   }
// );
// function contractsubmithandler(form) {
//   form.submit();
// }


