
function tab_display_setting_reward(invoker){
    "use strict";
    var input_name = invoker.value;
    var input_name_status = $('input[id="'+invoker.value+'"]').is(":checked");
    
    var data = {};
        data.input_name = input_name;
        data.input_name_status = input_name_status;
    $.post(admin_url + 'recruitment/tab_display_setting_reward', data).done(function(response){
          response = JSON.parse(response); 
          if (response.success == true) {
              alert_float('success', response.message);
          }else{
              alert_float('warning', response.message);

          }
      });

}

function tab_display_setting_medical(invoker){
    "use strict";
    var input_name = invoker.value;
    var input_name_status = $('input[id="'+invoker.value+'"]').is(":checked");
    
    var data = {};
        data.input_name = input_name;
        data.input_name_status = input_name_status;
    $.post(admin_url + 'recruitment/tab_display_setting_medical', data).done(function(response){
          response = JSON.parse(response); 
          if (response.success == true) {
              alert_float('success', response.message);
          }else{
              alert_float('warning', response.message);

          }
      });

}

function tab_display_setting_psc(invoker){
    "use strict";
    var input_name = invoker.value;
    var input_name_status = $('input[id="'+invoker.value+'"]').is(":checked");
    
    var data = {};
        data.input_name = input_name;
        data.input_name_status = input_name_status;
    $.post(admin_url + 'recruitment/tab_display_setting_psc', data).done(function(response){
          response = JSON.parse(response); 
          if (response.success == true) {
              alert_float('success', response.message);
          }else{
              alert_float('warning', response.message);

          }
      });

}

function tab_display_setting_recruitment_history(invoker){
    "use strict";
    var input_name = invoker.value;
    var input_name_status = $('input[id="'+invoker.value+'"]').is(":checked");
    
    var data = {};
        data.input_name = input_name;
        data.input_name_status = input_name_status;
    $.post(admin_url + 'recruitment/tab_display_setting_recruitment_history', data).done(function(response){
          response = JSON.parse(response); 
          if (response.success == true) {
              alert_float('success', response.message);
          }else{
              alert_float('warning', response.message);

          }
      });
}

function tab_display_setting_capacity_profile(invoker){
    "use strict";
    var input_name = invoker.value;
    var input_name_status = $('input[id="'+invoker.value+'"]').is(":checked");
    
    var data = {};
        data.input_name = input_name;
        data.input_name_status = input_name_status;
    $.post(admin_url + 'recruitment/tab_display_setting_capacity_profile', data).done(function(response){
          response = JSON.parse(response); 
          if (response.success == true) {
              alert_float('success', response.message);
          }else{
              alert_float('warning', response.message);

          }
      });
}


function tab_display_setting_promotion(invoker){
    "use strict";
    var input_name = invoker.value;
    var input_name_status = $('input[id="'+invoker.value+'"]').is(":checked");
    
    var data = {};
        data.input_name = input_name;
        data.input_name_status = input_name_status;
    $.post(admin_url + 'recruitment/tab_display_setting_promotion', data).done(function(response){
          response = JSON.parse(response); 
          if (response.success == true) {
              alert_float('success', response.message);
          }else{
              alert_float('warning', response.message);

          }
      });
}

function tab_display_setting_contract(invoker){
    "use strict";
    var input_name = invoker.value;
    var input_name_status = $('input[id="'+invoker.value+'"]').is(":checked");
    
    var data = {};
        data.input_name = input_name;
        data.input_name_status = input_name_status;
    $.post(admin_url + 'recruitment/tab_display_setting_contract', data).done(function(response){
          response = JSON.parse(response); 
          if (response.success == true) {
              alert_float('success', response.message);
          }else{
              alert_float('warning', response.message);

          }
      });
}
