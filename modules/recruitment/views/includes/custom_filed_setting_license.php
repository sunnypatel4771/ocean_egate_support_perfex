<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
    <!-- kind licence -->
    <div class="_buttons">
        <a href="#" onclick="new_kind_license(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('kind_name_licence'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('kind_name_licence'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($kind_list_license as $kind) { ?>
                <tr>
                    <td><?php echo html_entity_decode($kind['kind_name']); ?></td>
                    <td>
                        <a href="#" onclick="edit_kind_license(this,<?php echo html_entity_decode($kind['id']); ?>); return false" data-name="<?php echo html_entity_decode($kind['kind_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_kind/' . $kind['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="kind" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/kind')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_kind'); ?></span>
                        <span class="add-title"><?php echo _l('new_kind'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_kind"></div>
                            <div class="form">
                                <?php echo render_input('kind_name', 'kind_name'); ?>
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
    <br>

    <!-- document -->

    <div class="_buttons">
        <a href="#" onclick="new_kind_document(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_kind_name_document'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('kind_name_document'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($kind_list_document as $kind) { ?>
                <tr>
                    <td><?php echo html_entity_decode($kind['kind_document_name']); ?></td>
                    <td>
                        <a href="#" onclick="edit_kind_document(this,<?php echo html_entity_decode($kind['id']); ?>); return false" data-name="<?php echo html_entity_decode($kind['kind_document_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_kind_document/' . $kind['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="kinddocument" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/kinddocument')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_kind_document'); ?></span>
                        <span class="add-title"><?php echo _l('new_kind_name_document'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_kind_document"></div>
                            <div class="form">
                                <?php echo render_input('kind_document_name', 'kind_name'); ?>
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

    <!-- flag -->


    <div class="_buttons">
        <a href="#" onclick="new_kind_flag(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_kind_name_flag'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('kind_name_flag'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($kind_list_flag as $kind) { ?>
                <tr>
                    <td><?php echo html_entity_decode($kind['kind_flag_name']); ?></td>
                    <td>
                        <a href="#" onclick="edit_kind_flag(this,<?php echo html_entity_decode($kind['id']); ?>); return false" data-name="<?php echo html_entity_decode($kind['kind_flag_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_kind_flag/' . $kind['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="kindflag" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/kindflag')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_kind_flag'); ?></span>
                        <span class="add-title"><?php echo _l('new_kind_name_flag'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_kind_flag"></div>
                            <div class="form">
                                <?php echo render_input('kind_flag_name', 'kind_name'); ?>
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