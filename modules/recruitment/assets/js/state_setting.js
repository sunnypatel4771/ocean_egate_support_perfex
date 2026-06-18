// relation family
function new_state() {
  "use strict";
  $("#state").modal("show");
  $(".edit-title").addClass("hide");
  $(".add-title").removeClass("hide");

  $('#state input[name="name"]').val("");
  $("#additional_state").html("");
}
function edit_state(invoker, id) {
  "use strict";
  $("#additional_state").append(hidden_input("id", id));
  $('#state input[name="name"]').val($(invoker).data("name"));

  $("select[name='country_id']").selectpicker("destroy");
  $("select[name='country_id']").val($(invoker).data("country"));
  $("select[name='country_id']").selectpicker("refresh");

  $("#state").modal("show");
  $(".add-title").addClass("hide");
  $(".edit-title").removeClass("hide");
}

$("#state").on("hidden.bs.modal", function () {
    var $form = $(this).find('form');
    $form.find('input[name="country_id"]').val('');
    $form.find('input[name="name"]').val('');
    var validator = $form.validate();
    validator.resetForm();
    $form.find('.form-group').removeClass('has-error');
  });

appValidateForm(
    $("#state-form"),
    {
      country_id: 'required',
      name: {
        required: true,
        remote: {
          url: admin_url + "recruitment/check_state_name_exist",
          type: "post",
          data: {
            name: function () {
              return $('input[name="name"]').val();
            },
            country_id: function () {
              return $('select[name="country_id"]').val();
            },
            id: function () {
              return $('input[name="id"]').val();
            },
          },
        },
      },
    },
    statesubmithandler,
    {
      name: {
        remote: "State Name must be unique.",
      },
    }
  );
  
  $('select[name="country_id"]').on('change', function () {
    $('input[name="name"]').valid();
  });
  
  function statesubmithandler(form) {
    form.submit();
  }
  
