<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
    <!-- emp_status -->
    <div class="_buttons">
        <a href="#" onclick="new_emp_status(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_emp_status'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('emp_status_name'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($emp_status_list as $emp_status) { ?>
                <tr>
                    <td><?php echo html_entity_decode($emp_status['emp_status_name']); ?></td>
                    <td>
                        <a href="#" onclick="edit_emp_status(this,<?php echo html_entity_decode($emp_status['id']); ?>); return false" data-name="<?php echo html_entity_decode($emp_status['emp_status_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_emp_status/' . $emp_status['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="emp_status" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/emp_status')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_emp_status'); ?></span>
                        <span class="add-title"><?php echo _l('new_emp_status'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_emp_status"></div>
                            <div class="form">
                                <?php echo render_input('emp_status_name', 'emp_status_name'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                    <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
<div class="clearfix"></div>

<hr class="hr-panel-heading" />
    <div class="form-group">
    <div class="checkbox checkbox-primary">
        <input onchange="tab_custom_filed_setting_details(this); return false" type="checkbox" id="tab_custom_filed_setting_details" name="purchase_setting[tab_custom_filed_setting_details]"
            <?php if (get_tab_option('tab_custom_filed_setting_details') == 1) {
                echo 'checked';
            } ?> value="tab_custom_filed_setting_details">
        <label for="tab_custom_filed_setting_details"><?php echo _l('tab_custom_filed_setting_details_label'); ?>
        </label>
    </div>
</div>
</div>
</body>
</html>