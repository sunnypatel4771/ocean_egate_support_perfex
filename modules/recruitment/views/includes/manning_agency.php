<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
    <!-- emp_status -->
    <div class="_buttons">
        <a href="#" onclick="new_minning_agency(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_manning_agency'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table" id="manning_agency_table">
        <thead>
            <th><?php echo _l('code'); ?></th>
            <th><?php echo _l('agency_name'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($manning_agency_list as $manning_agency) { ?>
                <tr>
                    <td><?php echo html_entity_decode($manning_agency['code']); ?></td>
                    <td><?php echo html_entity_decode($manning_agency['agency_name']); ?></td>
                    <td>
                        <a href="#" class="btn btn-default btn-icon edit_manning_agency" data-id="<?php echo $manning_agency['id'] ?>"><i class="fa fa-pencil-square" ></i></a>
                        <a href="#" class="btn btn-danger btn-icon delete_manning_agency" data-id="<?php echo $manning_agency['id'] ?>"><i class="fa fa-remove" ></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="manning_agency_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/save_manning_agency'), ['id' => 'manning_agency_form']); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_manning_agency'); ?></span>
                        <span class="add-title"><?php echo _l('new_manning_agency'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="manning_agency_id" name="id">
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('code', _l('code')); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('agency_name', _l('agency_name')); ?>
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
</div>
</div>

<script>
    // $(function() {
    //     initDataTable('.table-country_list_table',
    //         admin_url + 'recruitment/country_table/', undefined, undefined,
    //         'undefined', [0, 'desc']);
    // });
</script>
</body>

</html>