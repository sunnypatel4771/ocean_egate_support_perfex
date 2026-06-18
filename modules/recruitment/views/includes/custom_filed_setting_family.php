<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
    <!-- relation family -->
    <div class="_buttons">
        <a href="#" onclick="new_relation_family(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('relation_name_family'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('relation_name_family'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($relation_list_family as $relation) { ?>
                <tr>
                    <td><?php echo html_entity_decode($relation['relation_name']); ?></td>
                    <td>
                        <a href="#" onclick="edit_relation_family(this,<?php echo html_entity_decode($relation['id']); ?>); return false" data-name="<?php echo html_entity_decode($relation['relation_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_relation/' . $relation['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="relation" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/relation_filed')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_relation'); ?></span>
                        <span class="add-title"><?php echo _l('new_relation'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_relation"></div>
                            <div class="form">
                                <?php echo render_input('relation_name', 'relation_name'); ?>
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


     <!-- marital_status family -->
     <div class="_buttons">
        <a href="#" onclick="new_marital_status_family(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('marital_status_name_family'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('marital_status_name_family'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php 
            foreach ($marital_status_list_family as $marital_status) { ?>
                <tr>
                    <td><?php echo html_entity_decode($marital_status['marital_status_name']); ?></td>
                    <td>
                        <a href="#" onclick="edit_marital_status_family(this,<?php echo html_entity_decode($marital_status['id']); ?>); return false" data-name="<?php echo html_entity_decode($marital_status['marital_status_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_marital_status/' . $marital_status['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="marital_status" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/marital_status_filed')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_marital_status'); ?></span>
                        <span class="add-title"><?php echo _l('marital_status_name_family'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_marital_status"></div>
                            <div class="form">
                                <?php echo render_input('marital_status_name', 'marital_status_name'); ?>
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