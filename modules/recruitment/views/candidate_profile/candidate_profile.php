<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12" id="small-table">
        <div class="panel_s">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <h4 class="no-margin font-bold"><i class="fa fa-user-o" aria-hidden="true"></i> <?php echo _l($title); ?></h4>
                <hr />
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">

                <!-- <a href="#" onclick="send_mail_candidate(); return false;" class="btn btn-success pull-left display-block mleft5"><i class="fa fa-envelope"></i><?php //echo ' ' . _l('send_mail'); 
                                                                                                                                                                      ?></a>

                <a href="<?php //if (!$this->input->get('project_id')) {
                          //echo admin_url('recruitment/switch_kanban/' . $switch_kanban);
                          // } else {
                          //echo admin_url('projects/view/' . $this->input->get('project_id') . '?group=project_tasks');
                          //}; 
                          ?>" class="btn btn-default mleft10 pull-left hidden-xs">
                  <?php //if ($switch_kanban == 1) {
                  //echo _l('switch_to_list_view');
                  //} else {
                  //echo _l('leads_switch_to_kanban');
                  //}; 
                  ?>
                </a> -->
              </div>
            </div>
            <br>


            <?php
            if ($this->session->has_userdata('candidate_profile_kanban_view') && $this->session->userdata('candidate_profile_kanban_view') == 'true') { ?>

              <hr class="hr-panel-heading hr-10" />
              <div class="clearfix"></div>
              <div class="kan-ban-tab kan-ban-overflow" id="kan-ban-tab">
                <div class="row">
                  <div id="kanban-params">
                    <?php echo form_hidden('project_id', $this->input->get('project_id')); ?>
                  </div>
                  <div class="container-fluid">
                    <div id="kan-ban"></div>
                  </div>
                </div>
              </div>
            <?php } else { ?>

              <div class="row">
                <div class="col-lg-1 pull-left">
                  <a href="<?php echo admin_url('recruitment/candidates'); ?>" class="btn btn-info pull-left display-block"><?php echo _l('new_candidate'); ?></a>
                </div>

                <div class="col-lg-1 pull-left">
                  <button class="btn btn-info pull-left display-block" id="follow_up_filter_btn"><?php echo _l('follow_up_filter_btn'); ?>
                  </button>
                  <input type="hidden" id="follow_up_filter" name="follow_up_filter" value="0">
                </div>

                <div class="col-lg-2 pull-right">
                  <select name="province[]" id="state" class="selectpicker" data-live-search="true" multiple="true" data-width="100%" data-none-selected-text="<?php echo _l('province'); ?>">

                    <?php foreach ($state as $s) { ?>
                      <option value="<?php echo html_entity_decode($s['id']); ?>"><?php echo html_entity_decode($s['name']); ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-lg-2 pull-right">
                  <select name="religion[]" id="religion" class="selectpicker" data-live-search="true" multiple="true" data-width="100%" data-none-selected-text="<?php echo _l('region'); ?>">

                    <?php foreach ($country as $s) { ?>
                      <option value="<?php echo html_entity_decode($s['id']); ?>"><?php echo html_entity_decode($s['name']); ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-lg-2 pull-right">
                  <select name="vessel_name[]" id="vessel_name" class="selectpicker" data-live-search="true" multiple="true" data-width="100%" data-none-selected-text="<?php echo _l('vessel_name'); ?>">
                    <?php foreach ($vessel_name_list as $s) { ?>
                      <option value="<?php echo html_entity_decode($s['id']); ?>"><?php echo html_entity_decode($s['department_name']); ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-lg-1 pull-right">
                  <select name="rank[]" id="rank" class="selectpicker" data-live-search="true" multiple="true" data-width="100%" data-none-selected-text="<?php echo _l('company_rank'); ?>">
                    <?php foreach ($rank_list as $s) { ?>
                      <option value="<?php echo html_entity_decode($s['id']); ?>"><?php echo html_entity_decode($s['rank_name']); ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-lg-1 pull-right">
                  <select name="emp_status[]" id="emp_status" class="selectpicker" data-live-search="true" multiple="true" data-width="100%" data-none-selected-text="<?php echo _l('emp_status'); ?>">
                    <?php foreach ($emp_status_list as $s) { ?>
                      <option value="<?php echo html_entity_decode($s['id']); ?>"><?php echo html_entity_decode($s['emp_status_name']); ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-lg-2 pull-right">
                  <select name="manning_agency[]" id="manning_agency" class="selectpicker" data-live-search="true" multiple="true" data-width="100%" data-none-selected-text="<?php echo _l('manning_agency'); ?>">
                    <?php foreach ($manning_agency_list as $s) { ?>
                      <option value="<?php echo html_entity_decode($s['id']); ?>"><?php echo html_entity_decode($s['manning_agency_name']); ?></option>
                    <?php } ?>
                  </select>
                </div>

              </div>

              <br>
              <!-- print barcode -->
              <?php echo form_open_multipart(admin_url('recruitment/item_print_candidate'), array('id' => 'item_print_candidate')); ?>
              <div class="modal bulk_actions" id="table_commodity_list_print_candidate" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><?php echo _l('print_candidate'); ?></h4>
                    </div>
                    <div class="modal-body">
                      <?php if (has_permission('recruitment', '', 'create') || is_admin()) { ?>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <select name="item_select_print_candidate[]" id="item_select_print_candidate" class="selectpicker" data-live-search="true" multiple="true" data-actions-box="true" data-width="100%" data-none-selected-text="<?php echo _l('select_candidate'); ?>">
                                <?php foreach ($candidates as $candidate) { ?>
                                  <option value="<?php echo html_entity_decode($candidate['id']); ?>"><?php echo html_entity_decode($candidate['candidate_code'] . '-' . $candidate['candidate_name'] . ' ' . $candidate['last_name']); ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>

                      <?php } ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>

                      <?php if (has_permission('recruitment', '', 'create') || is_admin()) { ?>

                        <button type="submit" class="btn btn-info"><?php echo _l('confirm'); ?></button>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php echo form_close(); ?>

              <a href="#" onclick="print_candidate_bulk_actions(); return false;" data-toggle="modal" data-table=".table-table_rec_candidate" data-target="#print_candidate_item" class=" hide print_candidate-bulk-actions-btn table-btn"><?php echo _l('print_candidate'); ?></a>

              <?php render_datatable(array(
                _l('id'),
                _l('manning_agency_tbl'),
                _l('candidate_code'),
                // _l('rank_level'),
                _l('rank_name'),
                _l('candidate_name'),
                _l('follow_up_tbl'),
                // _l('tranfer_personnel'),
                // _l('status'),
                _l('emp_status'),
                _l('vessel_name'),
                // _l('vessel'),

                _l('embarkation_date'),
                _l('disembarkation_date'),

                _l('region'),
                _l('province'),
                _l('email'),
                _l('phonenumber_tbl'),
                _l('birthday_tbl'),

                // uniform info
                'Height',
                'Waist',
                'Working Gears',
                'Shoes',
                // uniform info
                // _l('campaign'),
              ), 'table_rec_candidate'); ?>
            <?php } ?>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="mail_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <?php echo form_open_multipart(admin_url('recruitment/send_mail_list_candidate'), array('id' => 'mail_candidate-form')); ?>
    <div class="modal-content width-100">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          <span><?php echo _l('send_mail'); ?></span>
        </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label for="candidate"><?php echo _l('send_to'); ?></label>
            <select name="candidate[]" id="candidate" class="selectpicker" multiple="true" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>">

              <?php foreach ($candidates as $s) { ?>
                <option value="<?php echo html_entity_decode($s['id']); ?>"><?php echo html_entity_decode($s['candidate_code'] . ' ' . $s['candidate_name'] . ' ' . $s['last_name']); ?></option>
              <?php } ?>
            </select>
            <br><br>
          </div>
          <div class="col-md-12">

          </div>

          <div class="col-md-12">
            <?php echo render_input('subject', 'subject'); ?>
          </div>

          <div class="col-md-12">
            <?php echo render_textarea('content', 'content', '', array(), array(), '', 'tinymce'); ?>
          </div>
          <div id="type_care">

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
        <button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
<?php init_tail(); ?>

</body>

<script>
  $(document).ready(function() {
    localStorage.removeItem('activeTab');

    var state_from_local_storage = localStorage.getItem('state_filter');
    if (state_from_local_storage) {
      var state_from_local_storage = JSON.parse(state_from_local_storage);
      $('#state').val(state_from_local_storage);
      $('#state').selectpicker('refresh');
      var table_rec_candidate = $('.table-table_rec_candidate');
      table_rec_candidate.DataTable().ajax.reload();
    }

    var religion_from_local_storage = localStorage.getItem('religion_filter');
    if (religion_from_local_storage) {
      var religion_from_local_storage = JSON.parse(religion_from_local_storage);
      $('#religion').val(religion_from_local_storage);
      $('#religion').selectpicker('refresh');
      var table_rec_candidate = $('.table-table_rec_candidate');
      table_rec_candidate.DataTable().ajax.reload();
    }

    var vessel_name_from_local_storage = localStorage.getItem('vessel_name_filter');
    if (vessel_name_from_local_storage) {
      var vessel_name_from_local_storage = JSON.parse(vessel_name_from_local_storage);
      $('#vessel_name').val(vessel_name_from_local_storage);
      $('#vessel_name').selectpicker('refresh');
      var table_rec_candidate = $('.table-table_rec_candidate');
      table_rec_candidate.DataTable().ajax.reload();
    }

    var rank_from_local_storage = localStorage.getItem('rank_filter');
    if (rank_from_local_storage) {
      var rank_from_local_storage = JSON.parse(rank_from_local_storage);
      $('#rank').val(rank_from_local_storage);
      $('#rank').selectpicker('refresh');
      var table_rec_candidate = $('.table-table_rec_candidate');
      table_rec_candidate.DataTable().ajax.reload();
    }

    var emp_status_from_local_storage = localStorage.getItem('emp_status_filter');
    if (emp_status_from_local_storage) {
      var emp_status_from_local_storage = JSON.parse(emp_status_from_local_storage);
      $('#emp_status').val(emp_status_from_local_storage);
      $('#emp_status').selectpicker('refresh');
      var table_rec_candidate = $('.table-table_rec_candidate');
      table_rec_candidate.DataTable().ajax.reload();
    }

    var manning_agency_from_local_storage = localStorage.getItem('manning_agency_filter');
    if (manning_agency_from_local_storage) {
      var manning_agency_from_local_storage = JSON.parse(manning_agency_from_local_storage);
      $('#manning_agency').val(manning_agency_from_local_storage);
      $('#manning_agency').selectpicker('refresh');
      var table_rec_candidate = $('.table-table_rec_candidate');
      table_rec_candidate.DataTable().ajax.reload();
    }
  });

  $(document).on('change', "#state", function() {
    var state = $(this).val();
    localStorage.setItem('state_filter', JSON.stringify(state));
  });
  $(document).on('change', "#religion", function() {
    var religion = $(this).val();
    localStorage.setItem('religion_filter', JSON.stringify(religion));
  });
  $(document).on('change', "#vessel_name", function() {
    var vessel_name = $(this).val();
    localStorage.setItem('vessel_name_filter', JSON.stringify(vessel_name));
  });
  $(document).on('change', "#rank", function() {
    var rank = $(this).val();
    localStorage.setItem('rank_filter', JSON.stringify(rank));
  });
  $(document).on('change', "#emp_status", function() {
    var emp_status = $(this).val();
    localStorage.setItem('emp_status_filter', JSON.stringify(emp_status));
  });

  $(document).on('change', "#manning_agency", function() {
    var manning_agency = $(this).val();
    localStorage.setItem('manning_agency_filter', JSON.stringify(manning_agency));
  });
</script>

</html>