// relation family
function new_country(){
    "use strict";
    $('#country').modal('show');
    $('.edit-title').addClass('hide');
    $('.add-title').removeClass('hide');
    
    $('#country input[name="name"]').val('');
    $('#additional_country').html('');
}
function edit_country(invoker,id){
    "use strict";
    $('#additional_country').append(hidden_input('id',id));
    $('#country input[name="name"]').val($(invoker).data('name'));

    $('#country').modal('show');
    $('.add-title').addClass('hide');
    $('.edit-title').removeClass('hide');
}



appValidateForm(
  $("#country-form"),
  {
    name: {
      required: true,
      remote: {
        url: admin_url + "recruitment/check_country_name_exist",
        type: "post",
        data: {
            name: function () {
            return $('input[name="name"]').val();
          },
          id: function () {
            return $('input[name="id"]').val();
          },
        },
      },
    },
  },
  countrysubmithandler,
  {
    name: {
      remote: "Country Name must be unique.",
    },
  }
);

function countrysubmithandler(form) {
  form.submit();
}
