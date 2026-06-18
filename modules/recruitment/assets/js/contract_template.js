$(document).ready(function (){

  // initDataTable('.table-templates', admin_url + 'email_template_manage/lists' , false , false , [] , [0,"desc"] );

  // init_editor('textarea[name="template_content"]');
  init_editor('textarea[name="template_content"]', {
    toolbar: "fontfamily fontsize | forecolor backcolor | bold italic underline | alignleft aligncenter alignright alignjustify | image link | bullist numlist | restoredraft"
});

// if (template_id > 0 )
//       fnc_template_dlg(template_id);
$(function () {
  appValidateForm($("#contract_template_form"), {
    contract_template_name: "required",
    // template_content: "required",
  });
});

});



$('.add_merge_field').on('click', function(e) {

  e.preventDefault();

  tinymce.activeEditor.execCommand('mceInsertContent', false, $(this).find('.add_merge_field_span').text());

});

function new_contract_template() {
    $("#contract_template_modal").modal("show");
    $(".edit-title").addClass("hide");
    $(".add-title").removeClass("hide");
  
    $("#contract_template_name").val("");
    $("#contract_template_id").val("");
    tinymce.get('template_content').setContent( "" );
  }
  
  $(function () {
    appValidateForm($("#manning_agency_form"), {
      code: "required",
      agency_name: "required",
    });
  });
  
  $(document).on("click", ".delete_contract_template", function () {
    var confirm = window.confirm("Are you sure you want to perform this action?");
    if (confirm) {
      var id = $(this).data("id");
      $.ajax({
        url: admin_url + "recruitment/delete_contract_template",
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


  $(document).on("click", ".edit_contract_template", function () {
    var id = $(this).data("id");
    $.ajax({
      url: admin_url + "recruitment/get_contract_template",
      type: "POST",
      data: {
        id: id,
      },
      success: function (res) {
        var data = JSON.parse(res);
        console.log("data:", data);
        if (data.status == 1) {
          var contract_template = data.contract_template;
          console.log("contract_template:", contract_template);
          // $("#code").val(contract_template.code);
          $("#contract_template_name").val(contract_template.contract_template_name);
          $("#contract_template_id").val(contract_template.id);
          tinymce.activeEditor.execCommand('mceInsertContent', false, contract_template.template_content);
          $("#contract_template_modal").modal("show");
          $(".edit-title").removeClass("hide");
          $(".add-title").addClass("hide");
        } else {
          alert_float("danger", "No data Found");
        }
      },
    });
  });
  