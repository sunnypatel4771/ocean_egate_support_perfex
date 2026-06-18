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
              <a href="<?php echo admin_url('crew_payroll/recruitment_payroll?group=' . $group); ?>" data-group="<?php echo html_entity_decode($group); ?>">
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


<script>

  // var exchange_rates_ids = [
  //   "1_usd_to_php",
  // ];
  // console.log(exchange_rates_ids);

  // // Step 2: Loop through array and add change event
  // $.each(exchange_rates_ids, function(index, id) {
  //   $("#" + id).change(function() {
  //     var input_name = $(this).attr('name');
  //     var input_value = $(this).val();
  //     console.log('input_value', input_value);

  //     $.ajax({
  //       url: admin_url + "crew_payroll/save_recruitment_payroll", // Replace with your actual URL to save the data
  //       type: "POST",
  //       data: {
  //         name: input_name,
  //         value: input_value,
  //       },
  //     });




  //   });
  // });
</script>

</body>

</html>