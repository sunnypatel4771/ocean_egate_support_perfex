<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
    <!-- emp_status -->
    <div class="_buttons">
        <a href="#" onclick="new_contract_template(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_contract_template'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table" id="contract_template_table">
        <thead>
            <th><?php echo _l('code'); ?></th>
            <th><?php echo _l('name'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($contract_templates as $contract_template) { ?>
                <tr>
                    <td><?php echo html_entity_decode($contract_template['id']); ?></td>
                    <td><?php echo html_entity_decode($contract_template['contract_template_name']); ?></td>
                    <td>
                        <a href="#" class="btn btn-default btn-icon edit_contract_template" data-id="<?php echo $contract_template['id'] ?>"><i class="fa fa-pencil-square" ></i></a>
                        <?php
                        if ($contract_template['id'] != GOVERNMENT_CONTRACT_1) { ?>
                            <a href="#" class="btn btn-danger btn-icon delete_contract_template" data-id="<?php echo $contract_template['id'] ?>"><i class="fa fa-remove"></i></a>
                        <?php }
                        ?>
                        
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="contract_template_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl">
            <?php echo form_open(admin_url('recruitment/save_contract_template'), ['id' => 'contract_template_form']); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_contract_template'); ?></span>
                        <span class="add-title"><?php echo _l('new_contract_template'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="contract_template_id" name="id">

                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('contract_template_name', _l('contract_template_name')); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div style="border: 1px solid black; padding: 5px 10px; border-radius: 5px; margin-bottom: 10px;">
                                <a>
                                    <p style="padding: 0; margin: 0; margin-bottom: 10px;"><strong> <?php echo _l('available_merge_fields') ?> </strong></p>
                                </a>
                                <div style="height: 350px; overflow: auto" class="row">
                                    <?php foreach ($mearge_field as $merge_type => $merge_data) { ?>
                                        <div class="col-md-6 div_merge_fields filter_merge_<?php echo $merge_type; ?>" style="height: 20px !important;">
                                            <?php
                                                echo "<a href='#' class='add_merge_field' style='display: flex; width: 100%;'> 
                                                                    <span style='float: left; width: 60%; display: inline-block;'> " . $merge_data["name"] . " </span>  
                                                                    <span class='add_merge_field_span' style='float: right; width: 40%; text-align: left; display: inline-block;'> " . $merge_data["key"] . " </span> 
                                                                </a> <br />";
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <textarea class="tinymce tinymce-manual" id="template_content" name="template_content"></textarea>
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