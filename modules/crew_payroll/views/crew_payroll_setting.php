<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-3">
        <ul class="nav navbar-pills navbar-pills-flat nav-tabs nav-stacked">
          <?php
          foreach ($tab as $group) {
          ?>
            <li<?php if ($i == 0) {
                  echo " class='active'";
                } ?>>
              <a href="<?php echo admin_url('crew_payroll/index?group=' . $group); ?>" data-group="<?php echo html_entity_decode($group); ?>">
                <?php echo _l($group); ?></a>
              </li>
            <?php $i++;
          } ?>
        </ul>
      </div>
      <div class="col-md-9">
        <div class="panel_s">
          <div class="panel-body">
            <?php $this->load->view($tabs['view']); ?>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <?php echo form_close(); ?>
    <div class="btn-bottom-pusher"></div>
  </div>
</div>
<div id="new_version"></div>
<?php init_tail(); ?>
<?php // require('modules/recruitment/assets/js/company_js.php'); 
?>

<script>
  if ($('select[name="criteria_type"]').val() == 'criteria') {
    $('select[name="group_criteria"]').attr('required', '');
    $('#select_group_criteria').removeClass('hide');
  } else {
    $('select[name="group_criteria"]').removeAttr('required');
    $('#select_group_criteria').addClass('hide');
  }
  $(document).ready(function() {
    $(".payroll_setup_tab").on("click", function() {
      // Hide the text (first <p>) and show the input field
      $(this).parent().find(".tab_text").hide();
      $(this).parent().find(".tab_text_order").hide();
      $(this).parent().find(".tab_text_shortcode").hide();
      $(this).parent().find("input").show();
      $(this).parent().find(".save-btn").show(); // Show the save button
      $(this).hide(); // Hide the edit icon
    });

    // When the "save" button is clicked
    $(".save-btn").on("click", function() {
      var input_value_1 = $(this).closest(".col-sm-12").find("input.input_field").val();
      var input_name_1 = $(this).parent().find("input.input_field").attr("name");
      var input_value_2 = $(this).closest(".col-sm-12").find("input.input_order").val();
      var input_name_2 = $(this).parent().find("input.input_order").attr("name");
      var input_value_3 = $(this).closest(".col-sm-12").find("input.input_shortcode").val();
      var input_name_3 = $(this).parent().find("input.input_shortcode").attr("name");

      // AJAX call to save the data
      $.ajax({
        url: admin_url + "crew_payroll/payroll_setup_tab_update", // Replace with your actual URL to save the data
        type: "POST",
        data: {
          input_value_1: input_value_1,
          input_name_1: input_name_1,
          input_value_2: input_value_2,
          input_name_2: input_name_2,
          input_value_3: input_value_3,
          input_name_3: input_name_3,
        },
        success: function(response) {
          // On success, hide the save button and show the edit button again
          $(this).parent().find(".save-btn").hide();
          $(this).parent().find(".payroll_setup_tab").show();
          // Hide the input field and show the updated text
          $(this).parent().find("input.input_field").hide();
          $(this).parent().find("input.input_order").hide();
          $(this).parent().find("input.input_shortcode").hide();
          $(this).parent().find(".tab_text").text(input_value_1).show();
          $(this).parent().find(".tab_text_order").text(input_value_2).show();
          $(this).parent().find(".tab_text_shortcode").text(input_value_3).show();
        }.bind(this), // Bind 'this' so it's referring to the correct context
        error: function() {
          alert("Error Saving Data.");
        },
      });
    });
  });

  var ids = [
    "basic_wages_onb_can_view",
    "basic_wages_trv_can_view",
    "guranteed_overtime_can_view",
    "education_allowance_can_view",
    "leave_can_view",
    "operational_allowance_can_view",
    "supplementary_allowance_can_view",
    "owners_bonus_can_view",
    "slopchest_can_view",
    "social_security_system_empee_can_view",
    "philhelth_empee_can_view",
    "pag_lbig_housing_program_empee_can_view",
    "sss_mandatory_provident_fund_empee_can_view",
    "provident_fund_kaupthing_empee_can_view",
    "cash_advance_paid_onboard_can_view",
    "other_deduction_1_can_view",
    "other_deduction_2_can_view",
    "other_deduction_3_can_view",
    "other_deduction_4_can_view",
    "other_deduction_5_can_view",
    "other_deduction_6_can_view",
    "other_deduction_7_can_view",
    "other_earnings_1_can_view",
    "other_earnings_2_can_view",
  ];

  $.each(ids, function(index, id) {
    $("#" + id).change(function() {
      var input_name = $(this).attr('name');
      var input_value = $(this).is(':checked') ? 1 : 0;
      $.ajax({
        url: admin_url + "crew_payroll/payroll_setup_tab_update",
        type: "POST",
        data: {
          input_name_1: input_name,
          input_value_1: input_value,
        },
        success: function(response) {}
      });
    });
  });

  $(document).on("click", "#add_new_payroll_data", function() {
    $("#add_new_payroll_data_modal").modal('show');
  })

  $(document).on("click", ".edit_payroll_table", function() {
    var data_id = $(this).data('id');
    if (data_id != '' && data_id > 0) {
      $.ajax({
        url: admin_url + "crew_payroll/edit_payroll_table",
        type: "POST",
        data: {
          id: data_id
        },
        success: function(res) {
          var data = JSON.parse(res);
          if (data.status == 1) {
            var payroll_table_data = data.data;
            $("#hid").val(payroll_table_data.id);
            $("#code").val(payroll_table_data.code);
            $("#rank").val(payroll_table_data.rank);
            $("#basic_wages_onb").val(payroll_table_data.basic_wages_onb);
            $("#basic_wages_trv").val(payroll_table_data.basic_wages_trv);
            $("#guranteed_overtime").val(payroll_table_data.guranteed_overtime);
            $("#education_allowance").val(payroll_table_data.education_allowance);
            $("#leave").val(payroll_table_data.leave);
            $("#operational_allowance").val(payroll_table_data.operational_allowance);
            $("#supplementary_allowance").val(payroll_table_data.supplementary_allowance);
            $("#owners_bonus").val(payroll_table_data.owners_bonus);
            $("#other_earnings_1").val(payroll_table_data.other_earnings_1);
            $("#other_earnings_2").val(payroll_table_data.other_earnings_2);
            $("#slopchest").val(payroll_table_data.slopchest);
            $("#social_security_system_empee").val(payroll_table_data.social_security_system_empee);
            $("#philhelth_empee").val(payroll_table_data.philhelth_empee);
            $("#pag_lbig_housing_program_empee").val(payroll_table_data.pag_lbig_housing_program_empee);
            $("#sss_mandatory_provident_fund_empee").val(payroll_table_data.sss_mandatory_provident_fund_empee);
            $("#provident_fund_kaupthing_empee").val(payroll_table_data.provident_fund_kaupthing_empee);
            $("#cash_advance_paid_onboard").val(payroll_table_data.cash_advance_paid_onboard);
            $("#other_deduction_1").val(payroll_table_data.other_deduction_1);
            $("#other_deduction_2").val(payroll_table_data.other_deduction_2);
            $("#other_deduction_3").val(payroll_table_data.other_deduction_3);
            $("#other_deduction_4").val(payroll_table_data.other_deduction_4);
            $("#other_deduction_5").val(payroll_table_data.other_deduction_5);
            $("#other_deduction_6").val(payroll_table_data.other_deduction_6);
            $("#other_deduction_7").val(payroll_table_data.other_deduction_7);
            $("#add_new_payroll_data_modal").modal('show');
          }
        }
      })
    }
  })

  $(document).on("click", "#add_new_payroll_period_btn", function() {
    $(".edit-title").hide();
    $(".add-title").show();
    $("#payroll_period_modal").modal('show');
  })

  // $(document).on("change", "#payroll_period_modal #from, #payroll_period_modal #to", function() {

  // })

  $(document).on("change", "#payroll_period_modal #from, #payroll_period_modal #to", function() {
    var fromDate = $('#payroll_period_modal #from').val();
    var toDate = $('#payroll_period_modal #to').val();
    if (fromDate !== "" && toDate !== "") {
      var start = new Date(fromDate);
      var end = new Date(toDate);
      var diffTime = end - start;
      var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

      if (diffDays < 0) {
        console.log("To Date is Before From Date!");
      } else {
        $('#payroll_period_modal #days').val(diffDays);
      }
    }
  });

  $(document).on("click", ".edit_payroll_period", function() {
    var id = $(this).data('id');
    if (id != '' && id > 0) {
      $.ajax({
        url: admin_url + "crew_payroll/get_payroll_period",
        type: "POST",
        data: {
          id: id
        },
        success: function(res) {
          var data = JSON.parse(res);
          if (data.status == 1) {
            $('#payroll_period_modal #id').val(data.data.id);
            $('#payroll_period_modal #from').val(data.data.from);
            $('#payroll_period_modal #to').val(data.data.to);
            $('#payroll_period_modal #days').val(data.data.days);
            $('#payroll_period_modal #payroll_reference').val(data.data.payroll_reference);
            $('#payroll_period_modal #remarks').val(data.data.remarks);
            $('#payroll_period_modal #exchange_rate').val(data.data.exchange_rate);
            $(".edit-title").show();
            $(".add-title").hide();
            $("#payroll_period_modal").modal('show');
          }
        }
      });
    }
  })
</script>
</body>

</html>