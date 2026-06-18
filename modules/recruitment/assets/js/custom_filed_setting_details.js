// emp_status
function new_emp_status(){
    "use strict";
    $('#emp_status').modal('show');
    $('.edit-title').addClass('hide');
    $('.add-title').removeClass('hide');
    
    $('#emp_status input[name="emp_status_name"]').val('');
    $('#additional_emp_status').html('');
}
function edit_emp_status(invoker,id){
    "use strict";
    $('#additional_emp_status').append(hidden_input('id',id));
    $('#emp_status input[name="emp_status_name"]').val($(invoker).data('name'));

    $('#emp_status').modal('show');
    $('.add-title').addClass('hide');
    $('.edit-title').removeClass('hide');
}



function tab_custom_filed_setting_details(invoker){
    "use strict";
    var input_name = invoker.value;
    var input_name_status = $('input[id="'+invoker.value+'"]').is(":checked");
    
    var data = {};
        data.input_name = input_name;
        data.input_name_status = input_name_status;
    $.post(admin_url + 'recruitment/tab_custom_filed_setting_details', data).done(function(response){
          response = JSON.parse(response); 
          if (response.success == true) {
              alert_float('success', response.message);
          }else{
              alert_float('warning', response.message);

          }
      });

}
