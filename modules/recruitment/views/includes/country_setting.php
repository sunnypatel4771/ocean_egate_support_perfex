<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
    <div class="_buttons">
        <a href="#" onclick="new_country(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('add_country'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>

    <div class="col-md-12">
        <?php hooks()->do_action('forms_table_start'); ?>
        <?php render_datatable([
            _l('country_name'),
            _l('options'),
        ], 'country_list_table'); ?>
    </div>

    <div class="modal fade" id="country" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/add_update_country'), array('id' => 'country-form')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_country'); ?></span>
                        <span class="add-title"><?php echo _l('new_country'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_country"></div>
                            <div class="form">
                                <?php echo render_input('name', 'country_name'); ?>
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
    </body>



    </html>


    <?php init_tail(); ?>

    <script>
        $(function() {
            initDataTable('.table-country_list_table',
                admin_url + 'recruitment/country_table/', undefined, undefined,
                'undefined', [0, 'desc']);
        });
    </script>