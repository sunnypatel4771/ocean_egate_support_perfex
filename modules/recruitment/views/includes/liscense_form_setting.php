<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
    <div class="_buttons">
        <div class="pull-left">
            <div id="travel_and_identification_container">
                <h3 id="travel_and_identification_header" class="inline-block" style="margin-right: 10px;">
                    <?php echo get_option('travel_lable_admin'); ?>
                </h3>
                <?php if (is_admin()) { ?>
                    <span id="rename_travel_and_identification" class="btn btn-default btn-icon" style="margin-right: 10px;">
                        <i class="fa fa-pencil-square"></i>
                    </span>
                    <div id="travel_and_identification_input" style="display: none; align-items: center;">
                        <?php echo form_open(admin_url('recruitment/update_travel_lable')); ?>
                        <?php echo render_input('travel_lable_admin', '', get_option('travel_lable_admin'), 'text'); ?>
                        <button type="submit" id="save_travel_label" class="btn btn-primary">Save</button>
                        <?php echo form_close(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="pull-right">
            <a href="#" onclick="new_travel(); return false;" class="btn btn-info">
                <?php echo _l('Add'); ?>
            </a>
        </div>
    </div>

    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('order_no'); ?></th>
            <th><?php echo _l('document_type'); ?></th>
            <th><?php echo _l('expiration_date_setting'); ?></th>
            <th><?php echo _l('main'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($travel_list as $travel) { ?>
                <tr  title="This data cannot be edited or deleted through the system. If you need to modify or remove it, the changes must be made manually in the database.">
                    <td><?php echo html_entity_decode($travel['order_no']); ?></td>
                    <td><?php echo html_entity_decode($travel['document_type']); ?></td>
                    <?php if ($travel['no_expired'] == '1') { ?>
                        <td><?php echo _l('expiration'); ?></td>
                    <?php } else { ?>
                        <td><?php echo html_entity_decode($travel['expiration_date']); ?></td>
                    <?php } ?>
                    <?php if ($travel['display_info'] == '1') { ?>
                        <td><?php echo _l('Yes'); ?></td>
                    <?php } else { ?>
                        <td><?php echo _l('No'); ?></td>
                    <?php } ?>
                    <td>
                        <a href="#" onclick="edit_travel(this,<?php echo html_entity_decode($travel['id']); ?>); return false" data-name="<?php echo html_entity_decode($travel['document_type']); ?>"
                            data-cheked="<?php echo html_entity_decode($travel['no_expired']); ?>" data-display_info="<?php echo html_entity_decode($travel['display_info']); ?>" data-date="<?php echo html_entity_decode($travel['expiration_date']); ?>" data-order="<?php echo html_entity_decode($travel['order_no']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <?php
                        if ($travel['id'] != 6) { ?>
                            <a href="<?php echo admin_url('recruitment/delete_travel/' . $travel['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                        <?php } ?>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="travel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/travel_filed'), array('id' => 'travel-form-form')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_travel'); ?></span>
                        <span class="add-title"><?php echo _l('new_travel'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_travel"></div>
                            <div class="form">
                                <?php echo render_input('order_no', 'order_no', '', 'text'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('document_type', 'travel_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="additional_travel"></div>
                            <div class="form">
                                <?php echo render_input('expiration_date', 'expiration_date_setting', '', 'number'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="no_expired" name="no_expired">
                                <label for="no_expired"><?php echo _l('no_expired') ?></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="display_info" name="display_info">
                                <label for="display_info"><?php echo _l('display_info') ?></label>
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

    <!-- licence other -->

    <div class="_buttons">
        <div class="pull-left">
            <div id="other_licence_container">
                <h3 id="other_licence_header" class="inline-block" style="margin-right: 10px;">
                    <?php echo get_option('other_licence_lable_admin'); ?>
                </h3>
                <?php if (is_admin()) { ?>
                    <span id="rename_other_licence" class="btn btn-default btn-icon" style="margin-right: 10px;">
                        <i class="fa fa-pencil-square"></i>
                    </span>
                    <div id="other_licence_input" style="display: none; align-items: center;">
                        <?php echo form_open(admin_url('recruitment/update_other_licence_lable')); ?>
                        <?php echo render_input('other_licence_lable_admin', '', get_option('other_licence_lable_admin'), 'text'); ?>
                        <button type="submit" id="save_other_licence_label" class="btn btn-primary">Save</button>
                        <?php echo form_close(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="pull-right">
            <a href="#" onclick="new_other_licence(); return false;" class="btn btn-info">
                <?php echo _l('Add'); ?>
            </a>
        </div>
    </div>

    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('order_no'); ?></th>
            <th><?php echo _l('document_type'); ?></th>
            <th><?php echo _l('expiration_date_setting'); ?></th>
            <th><?php echo _l('main'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($other_licences as $other_licence) { ?>
                <tr>
                    <td><?php echo html_entity_decode($other_licence['order_no']); ?></td>
                    <td><?php echo html_entity_decode($other_licence['document_type']); ?></td>
                    <?php if ($other_licence['no_expired'] == '1') { ?>
                        <td><?php echo _l('expiration'); ?></td>
                    <?php } else { ?>
                        <td><?php echo html_entity_decode($other_licence['expiration_date']); ?></td>
                    <?php } ?>
                    <?php if ($other_licence['display_info'] == '1') { ?>
                        <td><?php echo _l('Yes'); ?></td>
                    <?php } else { ?>
                        <td><?php echo _l('No'); ?></td>
                    <?php } ?>
                    <td>
                        <a href="#" onclick="edit_other_licence(this,<?php echo html_entity_decode($other_licence['id']); ?>); return false" data-name="<?php echo html_entity_decode($other_licence['document_type']); ?>"
                            data-cheked="<?php echo html_entity_decode($other_licence['no_expired']); ?>" data-display_info="<?php echo html_entity_decode($other_licence['display_info']); ?>" data-date="<?php echo html_entity_decode($other_licence['expiration_date']); ?>" data-order="<?php echo html_entity_decode($other_licence['order_no']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_other_licence/' . $other_licence['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="other_licence" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/other_licence_filed'), array('id' => 'other_licence-form-form')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_other_licence'); ?></span>
                        <span class="add-title"><?php echo _l('new_other_licence'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_other_licence"></div>
                            <div class="form">
                                <?php echo render_input('order_no', 'order_no', '', 'text'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('document_type', 'travel_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="additional_travel"></div>
                            <div class="form">
                                <?php echo render_input('expiration_date', 'expiration_date_setting', '', 'number'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="no_expired_other" name="no_expired">
                                <label for="no_expired_other"><?php echo _l('no_expired') ?></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="other_display_info" name="display_info">
                                <label for="other_display_info"><?php echo _l('display_info') ?></label>
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



    <!--- Licence 3 ---->

    <div class="_buttons">
        <div class="pull-left">
            <div id="licence_3_container">
                <h3 id="licence_3_header" class="inline-block" style="margin-right: 10px;">
                    <?php echo get_option('licence_3_lable_admin'); ?>
                </h3>
                <?php if (is_admin()) { ?>
                    <span id="rename_licence_3" class="btn btn-default btn-icon" style="margin-right: 10px;">
                        <i class="fa fa-pencil-square"></i>
                    </span>
                    <div id="licence_3_input" style="display: none; align-items: center;">
                        <?php echo form_open(admin_url('recruitment/update_licence_3_lable')); ?>
                        <?php echo render_input('licence_3_lable_admin', '', get_option('licence_3_lable_admin'), 'text'); ?>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <?php echo form_close(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="pull-right">
            <a href="#" onclick="new_licence_3(); return false;" class="btn btn-info">
                <?php echo _l('Add'); ?>
            </a>
        </div>
    </div>

    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('order_no'); ?></th>
            <th><?php echo _l('document_type'); ?></th>
            <th><?php echo _l('expiration_date_setting'); ?></th>
            <th><?php echo _l('main'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($licences_3 as $licence_3) { ?>
                <tr>
                    <td><?php echo html_entity_decode($licence_3['order_no']); ?></td>
                    <td><?php echo html_entity_decode($licence_3['document_type']); ?></td>
                    <?php if ($licence_3['no_expired'] == '1') { ?>
                        <td><?php echo _l('expiration'); ?></td>
                    <?php } else { ?>
                        <td><?php echo html_entity_decode($licence_3['expiration_date']); ?></td>
                    <?php } ?>
                    <?php if ($licence_3['display_info'] == '1') { ?>
                        <td><?php echo _l('Yes'); ?></td>
                    <?php } else { ?>
                        <td><?php echo _l('No'); ?></td>
                    <?php } ?>
                    <td>
                        <a href="#" onclick="edit_licence_3(this,<?php echo html_entity_decode($licence_3['id']); ?>); return false" data-name="<?php echo html_entity_decode($licence_3['document_type']); ?>"
                            data-cheked="<?php echo html_entity_decode($licence_3['no_expired']); ?>" data-display_info="<?php echo html_entity_decode($licence_3['display_info']); ?>" data-date="<?php echo html_entity_decode($licence_3['expiration_date']); ?>" data-order="<?php echo html_entity_decode($licence_3['order_no']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_licence_3/' . $licence_3['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="licence_3_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/licence_3_filed'), array('id' => 'licence_3-form-form')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_licence_3'); ?></span>
                        <span class="add-title"><?php echo _l('new_licence_3'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_licence_3"></div>
                            <div class="form">
                                <?php echo render_input('order_no', 'order_no', '', 'text'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('document_type', 'travel_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="additional_travel"></div>
                            <div class="form">
                                <?php echo render_input('expiration_date', 'expiration_date_setting', '', 'number'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="no_expired_3" name="no_expired">
                                <label for="no_expired_3"><?php echo _l('no_expired') ?></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="display_info_3" name="display_info">
                                <label for="display_info_3"><?php echo _l('display_info') ?></label>
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

    <!--- Licence 4 ---->

    <div class="_buttons">
        <div class="pull-left">
            <div id="licence_4_container">
                <h3 id="licence_4_header" class="inline-block" style="margin-right: 10px;">
                    <?php echo get_option('licence_4_lable_admin'); ?>
                </h3>
                <?php if (is_admin()) { ?>
                    <span id="rename_licence_4" class="btn btn-default btn-icon" style="margin-right: 10px;">
                        <i class="fa fa-pencil-square"></i>
                    </span>
                    <div id="licence_4_input" style="display: none; align-items: center;">
                        <?php echo form_open(admin_url('recruitment/update_licence_4_lable')); ?>
                        <?php echo render_input('licence_4_lable_admin', '', get_option('licence_4_lable_admin'), 'text'); ?>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <?php echo form_close(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="pull-right">
            <a href="#" onclick="new_licence_4(); return false;" class="btn btn-info">
                <?php echo _l('Add'); ?>
            </a>
        </div>
    </div>

    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('order_no'); ?></th>
            <th><?php echo _l('document_type'); ?></th>
            <th><?php echo _l('expiration_date_setting'); ?></th>
            <th><?php echo _l('main'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($licences_4 as $licence_4) { ?>
                <tr>
                    <td><?php echo html_entity_decode($licence_4['order_no']); ?></td>
                    <td><?php echo html_entity_decode($licence_4['document_type']); ?></td>
                    <?php if ($licence_4['no_expired'] == '1') { ?>
                        <td><?php echo _l('expiration'); ?></td>
                    <?php } else { ?>
                        <td><?php echo html_entity_decode($licence_4['expiration_date']); ?></td>
                    <?php } ?>
                    <?php if ($licence_4['display_info'] == '1') { ?>
                        <td><?php echo _l('Yes'); ?></td>
                    <?php } else { ?>
                        <td><?php echo _l('No'); ?></td>
                    <?php } ?>
                    <td>
                        <a href="#" onclick="edit_licence_4(this,<?php echo html_entity_decode($licence_4['id']); ?>); return false" data-name="<?php echo html_entity_decode($licence_4['document_type']); ?>"
                            data-cheked="<?php echo html_entity_decode($licence_4['no_expired']); ?>" data-display_info="<?php echo html_entity_decode($licence_4['display_info']); ?>" data-date="<?php echo html_entity_decode($licence_4['expiration_date']); ?>" data-order="<?php echo html_entity_decode($licence_4['order_no']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_licence_4/' . $licence_4['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="licence_4_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/licence_4_filed'), array('id' => 'licence_4-form-form')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_licence_4'); ?></span>
                        <span class="add-title"><?php echo _l('new_licence_4'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_licence_4"></div>
                            <div class="form">
                                <?php echo render_input('order_no', 'order_no', '', 'text'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('document_type', 'travel_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="additional_travel"></div>
                            <div class="form">
                                <?php echo render_input('expiration_date', 'expiration_date_setting', '', 'number'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="no_expired_4" name="no_expired">
                                <label for="no_expired_4"><?php echo _l('no_expired') ?></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="display_info_4" name="display_info">
                                <label for="display_info_4"><?php echo _l('display_info') ?></label>
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

    <!--- Licence 5 ---->

    <div class="_buttons">
        <div class="pull-left">
            <div id="licence_5_container">
                <h3 id="licence_5_header" class="inline-block" style="margin-right: 10px;">
                    <?php echo get_option('licence_5_lable_admin'); ?>
                </h3>
                <?php if (is_admin()) { ?>
                    <span id="rename_licence_5" class="btn btn-default btn-icon" style="margin-right: 10px;">
                        <i class="fa fa-pencil-square"></i>
                    </span>
                    <div id="licence_5_input" style="display: none; align-items: center;">
                        <?php echo form_open(admin_url('recruitment/update_licence_5_lable')); ?>
                        <?php echo render_input('licence_5_lable_admin', '', get_option('licence_5_lable_admin'), 'text'); ?>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <?php echo form_close(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="pull-right">
            <a href="#" onclick="new_licence_5(); return false;" class="btn btn-info">
                <?php echo _l('Add'); ?>
            </a>
        </div>
    </div>

    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('order_no'); ?></th>
            <th><?php echo _l('document_type'); ?></th>
            <th><?php echo _l('expiration_date_setting'); ?></th>
            <th><?php echo _l('main'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($licences_5 as $licence_5) { ?>
                <tr>
                    <td><?php echo html_entity_decode($licence_5['order_no']); ?></td>
                    <td><?php echo html_entity_decode($licence_5['document_type']); ?></td>
                    <?php if ($licence_5['no_expired'] == '1') { ?>
                        <td><?php echo _l('expiration'); ?></td>
                    <?php } else { ?>
                        <td><?php echo html_entity_decode($licence_5['expiration_date']); ?></td>
                    <?php } ?>
                    <?php if ($licence_5['display_info'] == '1') { ?>
                        <td><?php echo _l('Yes'); ?></td>
                    <?php } else { ?>
                        <td><?php echo _l('No'); ?></td>
                    <?php } ?>
                    <td>
                        <a href="#" onclick="edit_licence_5(this,<?php echo html_entity_decode($licence_5['id']); ?>); return false" data-name="<?php echo html_entity_decode($licence_5['document_type']); ?>"
                            data-cheked="<?php echo html_entity_decode($licence_5['no_expired']); ?>" data-display_info="<?php echo html_entity_decode($licence_5['display_info']); ?>" data-date="<?php echo html_entity_decode($licence_5['expiration_date']); ?>" data-order="<?php echo html_entity_decode($licence_5['order_no']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_licence_5/' . $licence_5['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="licence_5_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/licence_5_filed'), array('id' => 'licence_5-form-form')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_licence_5'); ?></span>
                        <span class="add-title"><?php echo _l('new_licence_5'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_licence_5"></div>
                            <div class="form">
                                <?php echo render_input('order_no', 'order_no', '', 'text'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('document_type', 'travel_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="additional_travel"></div>
                            <div class="form">
                                <?php echo render_input('expiration_date', 'expiration_date_setting', '', 'number'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="no_expired_5" name="no_expired">
                                <label for="no_expired_5"><?php echo _l('no_expired') ?></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="display_info_5" name="display_info">
                                <label for="display_info_5"><?php echo _l('display_info') ?></label>
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

    <!--- Licence 6 ---->

    <div class="_buttons">
        <div class="pull-left">
            <div id="licence_6_container">
                <h3 id="licence_6_header" class="inline-block" style="margin-right: 10px;">
                    <?php echo get_option('licence_6_lable_admin'); ?>
                </h3>
                <?php if (is_admin()) { ?>
                    <span id="rename_licence_6" class="btn btn-default btn-icon" style="margin-right: 10px;">
                        <i class="fa fa-pencil-square"></i>
                    </span>
                    <div id="licence_6_input" style="display: none; align-items: center;">
                        <?php echo form_open(admin_url('recruitment/update_licence_6_lable')); ?>
                        <?php echo render_input('licence_6_lable_admin', '', get_option('licence_6_lable_admin'), 'text'); ?>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <?php echo form_close(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="pull-right">
            <a href="#" onclick="new_licence_6(); return false;" class="btn btn-info">
                <?php echo _l('Add'); ?>
            </a>
        </div>
    </div>

    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('order_no'); ?></th>
            <th><?php echo _l('document_type'); ?></th>
            <th><?php echo _l('expiration_date_setting'); ?></th>
            <th><?php echo _l('main'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($licences_6 as $licence_6) { ?>
                <tr>
                    <td><?php echo html_entity_decode($licence_6['order_no']); ?></td>
                    <td><?php echo html_entity_decode($licence_6['document_type']); ?></td>
                    <?php if ($licence_6['no_expired'] == '1') { ?>
                        <td><?php echo _l('expiration'); ?></td>
                    <?php } else { ?>
                        <td><?php echo html_entity_decode($licence_6['expiration_date']); ?></td>
                    <?php } ?>
                    <?php if ($licence_6['display_info'] == '1') { ?>
                        <td><?php echo _l('Yes'); ?></td>
                    <?php } else { ?>
                        <td><?php echo _l('No'); ?></td>
                    <?php } ?>
                    <td>
                        <a href="#" onclick="edit_licence_6(this,<?php echo html_entity_decode($licence_6['id']); ?>); return false" data-name="<?php echo html_entity_decode($licence_6['document_type']); ?>"
                            data-cheked="<?php echo html_entity_decode($licence_6['no_expired']); ?>" data-display_info="<?php echo html_entity_decode($licence_6['display_info']); ?>" data-date="<?php echo html_entity_decode($licence_6['expiration_date']); ?>" data-order="<?php echo html_entity_decode($licence_6['order_no']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_licence_6/' . $licence_6['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="licence_6_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/licence_6_filed'), array('id' => 'licence_6-form-form')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_licence_6'); ?></span>
                        <span class="add-title"><?php echo _l('new_licence_6'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_licence_6"></div>
                            <div class="form">
                                <?php echo render_input('order_no', 'order_no', '', 'text'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('document_type', 'travel_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="additional_travel"></div>
                            <div class="form">
                                <?php echo render_input('expiration_date', 'expiration_date_setting', '', 'number'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="no_expired_6" name="no_expired">
                                <label for="no_expired_6"><?php echo _l('no_expired') ?></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="display_info_6" name="display_info">
                                <label for="display_info_6"><?php echo _l('display_info') ?></label>
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

    <!-- contract_of_employee -->

    <div class="_buttons">
        <h3 class="pull-left"><?php echo _l('contract_of_employee'); ?></h3>
        <a href="#" onclick="new_emp_travel(); return false;" class="btn btn-info pull-right display-block">
            <?php echo _l('Add'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('order_no'); ?></th>
            <th><?php echo _l('document_document_type'); ?></th>
            <th><?php echo _l('document_expiration_date_setting'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($contract_of_employee as $contract) { ?>
                <tr>
                    <td><?php echo html_entity_decode($contract['order_no']); ?></td>
                    <td><?php echo html_entity_decode($contract['emp_document_type']); ?></td>
                    <td><?php echo html_entity_decode($contract['emp_expiration_date']); ?></td>
                    <td>
                        <a href="#" onclick="edit_emp_travel(this,<?php echo html_entity_decode($contract['id']); ?>); return false" data-name="<?php echo html_entity_decode($contract['emp_document_type']); ?>" data-date="<?php echo html_entity_decode($contract['emp_expiration_date']); ?>" data-order="<?php echo html_entity_decode($contract['order_no']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/emp_delete_contract/' . $contract['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="emp_contract" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/emp_contract_filed'), array('id' => 'emp_contract-form')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('emp_edit_contract'); ?></span>
                        <span class="add-title"><?php echo _l('emp_new_contract'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_emp_"></div>
                            <div class="form">
                                <?php echo render_input('order_no', 'order_no', '', 'text'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('emp_document_type', 'emp_contract_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="additional_contract"></div>
                            <div class="form">
                                <?php echo render_input('emp_expiration_date', 'emp_expiration_date_setting', '', 'number'); ?>
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


    <!-- request_renew -->

    <div class="_buttons">
        <h3 class="pull-left"><?php echo _l('request_renew'); ?></h3>
        <a href="#" onclick="new_request_renew(); return false;" class="btn btn-info pull-right display-block">
            <?php echo _l('Add'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('id'); ?></th>
            <th><?php echo _l('name'); ?></th>
            <th><?php echo _l('font_color'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($request_renew_list as $request_renew) { ?>
                <tr>
                    <td><?php echo html_entity_decode($request_renew['id']); ?></td>
                    <td><?php echo html_entity_decode($request_renew['name']); ?></td>
                    <td style="color: <?php echo $request_renew['font_color']; ?>;"><?php echo html_entity_decode($request_renew['font_color']); ?></td>
                    <td>
                        <a href="#" onclick="edit_request_renew(this,<?php echo html_entity_decode($request_renew['id']); ?>); return false" data-name="<?php echo html_entity_decode($request_renew['name']); ?>" data-color="<?php echo html_entity_decode($request_renew['font_color']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_request_renew/' . $request_renew['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="request_renew" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/request_renew_filed'), array('id' => 'request_renew-form')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_request_renew'); ?></span>
                        <span class="add-title"><?php echo _l('new_request_renew'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_request_renew"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('name', 'request_renew_label'); ?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <?php echo render_input('font_color', 'font_color', '', 'color'); ?>
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
</div>
</body>

</html>