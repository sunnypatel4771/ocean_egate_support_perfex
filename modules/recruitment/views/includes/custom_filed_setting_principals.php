<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
    <div class="_buttons">
        <a href="#" onclick="show_custom_filed_setting_principals_modal(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_principal'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('principal_name'); ?></th>
            <th><?php echo _l('principal_address'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($custom_filed_setting_principal_data as $principal) {
            ?>
                <tr>
                    <td><?php echo html_entity_decode($principal['principal_name']); ?></td>
                    <td><?php echo html_entity_decode($principal['principal_address']); ?></td>
                    <td>
                        <a href="#" class="btn btn-default btn-icon edit_custom_filed_setting_principal" data-id="<?php echo $principal['id']; ?>"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_custom_filed_setting_principals/' . $principal['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php  }
            ?>
        </tbody>
    </table>

    <div class="modal fade" id="custom_filed_setting_principals_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/save_custom_filed_setting_principals')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_principal'); ?></span>
                        <span class="add-title"><?php echo _l('new_principal'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form">
                                <input type="hidden" name="hid" id="hid">
                                <?php echo render_input('principal_name', 'principal_name'); ?>
                                <?php echo render_input('principal_address', 'principal_address'); ?>
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
    </div><br>
</div>


</body>

</html>