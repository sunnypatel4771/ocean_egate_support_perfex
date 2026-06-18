<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
    <!-- department -->
    <div class="_buttons">
        <a href="#" onclick="new_department(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_department'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('department_name'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($department_list as $department) { ?>
                <tr>
                    <td><?php echo html_entity_decode($department['department_name']); ?></td>
                    <td>
                        <a href="#" onclick="edit_department(this,<?php echo html_entity_decode($department['id']); ?>); return false" data-name="<?php echo html_entity_decode($department['department_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_department/' . $department['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="department" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/department')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_department'); ?></span>
                        <span class="add-title"><?php echo _l('new_department'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_department"></div>
                            <div class="form">
                                <?php echo render_input('department_name', 'department_name'); ?>
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

    <!-- Status -->
    <div class="_buttons">
        <a href="#" onclick="new_status(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_status'); ?>
        </a>
    </div>

    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('status_name'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($status_list as $status) { ?>
                <tr>
                    <td><?php echo html_entity_decode($status['status_name']); ?></td>
                    <td>
                        <a href="#" onclick="edit_status(this,<?php echo html_entity_decode($status['id']); ?>); return false" data-name="<?php echo html_entity_decode($status['status_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_status/' . $status['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="status" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/status')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_status'); ?></span>
                        <span class="add-title"><?php echo _l('new_status'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_status"></div>
                            <div class="form">
                                <?php echo render_input('status_name', 'status_name'); ?>
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

    <!-- Rank -->
    <div class="_buttons">
        <a href="#" onclick="new_rank(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_rank'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('code'); ?></th>
            <th><?php echo _l('rank_name'); ?></th>
            <th><?php echo _l('rank_level'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($rank_list as $rank) { ?>
                <tr>
                    <td><?php echo html_entity_decode($rank['code']); ?></td>
                    <td><?php echo html_entity_decode($rank['rank_name']); ?></td>
                    <td><?php echo html_entity_decode($rank['rank_level']); ?></td>
                    <td>
                        <a href="#" onclick="edit_rank(this,<?php echo html_entity_decode($rank['id']); ?>); return false" data-name="<?php echo html_entity_decode($rank['rank_name']); ?>" data-rank_level="<?php echo html_entity_decode($rank['rank_level']); ?>" data-code="<?php echo html_entity_decode($rank['code']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_rank/' . $rank['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="rank" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/rank')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_rank'); ?></span>
                        <span class="add-title"><?php echo _l('new_rank'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('code', 'code'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="additional_rank"></div>
                            <div class="form">
                                <?php echo render_input('rank_name', 'rank_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form">
                                <?php echo render_input('rank_level', 'rank_level', '', 'number'); ?>
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


    <!-- course type -->
    <div class="_buttons">
        <a href="#" onclick="new_course_type(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_course_type'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('course_name'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($course_list as $course) { ?>
                <tr>
                    <td><?php echo html_entity_decode($course['course_name']); ?></td>
                    <td>
                        <a href="#" onclick="edit_course_type(this,<?php echo html_entity_decode($course['id']); ?>); return false" data-name="<?php echo html_entity_decode($course['course_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_course/' . $course['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="course" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/course_type')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_course_type'); ?></span>
                        <span class="add-title"><?php echo _l('new_course_type'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_course"></div>
                            <div class="form">
                                <?php echo render_input('course_name', 'course_name'); ?>
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


    <!-- Vessel Type -->
    <div class="_buttons">
        <a href="#" onclick="new_vessel_type(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_vessel_type'); ?>
        </a>
    </div>

    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('vessel_name'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($vessel_list as $vessel) { ?>
                <tr>
                    <td><?php echo html_entity_decode($vessel['vessel_name']); ?></td>
                    <td>
                        <a href="#" onclick="edit_vessel_type(this,<?php echo html_entity_decode($vessel['id']); ?>); return false" data-name="<?php echo html_entity_decode($vessel['vessel_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_vessel/' . $vessel['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="vessel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/vessel')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_vessel'); ?></span>
                        <span class="add-title"><?php echo _l('new_vessel'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_vessel"></div>
                            <div class="form">
                                <?php echo render_input('vessel_name', 'vessel_name'); ?>
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


    <!-- new_vessel_info -->
    <div class="_buttons">
        <a href="#" onclick="new_vessel_info(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_vessel_info'); ?>
        </a>
    </div>

    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th><?php echo _l('vessel_info_name'); ?></th>
            <th><?php echo _l('imo_number'); ?></th>
            <th><?php echo _l('grt'); ?></th>
            <th><?php echo _l('year_built'); ?></th>
            <th><?php echo _l('flag'); ?></th>
            <th><?php echo _l('type_of_vessel'); ?></th>
            <th><?php echo _l('classification_society'); ?></th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($vessel_name_list as $vessel_name) { ?>
                <tr>
                    <td><?php echo html_entity_decode($vessel_name['vessel_info_name']); ?></td>
                    <td><?php echo html_entity_decode($vessel_name['imo_number']); ?></td>
                    <td><?php echo html_entity_decode(number_format($vessel_name['grt'])); ?></td>
                    <td><?php echo html_entity_decode($vessel_name['year_built']); ?></td>
                    <td><?php echo html_entity_decode($vessel_name['flag']); ?></td>
                    <td><?php echo html_entity_decode(get_job_vessel_name($vessel_name['type_of_vessel'])); ?></td>
                    <td><?php echo html_entity_decode($vessel_name['classification_society']); ?></td>
                    <td>
                        <!-- <a href="#" onclick="edit_vessel_name(this,<?php // echo html_entity_decode($vessel_name['id']); ?>); return false" data-name="<?php // echo html_entity_decode($vessel_name['vessel_info_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a> -->

                        <button class="btn btn-default btn-icon edit_vessel_name" data-id="<?php echo html_entity_decode($vessel_name['id']); ?>"><i class="fa fa-pencil-square"></i></button>

                        <a href="<?php echo admin_url('recruitment/delete_vessel_name/' . $vessel_name['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="vessel_info_name" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/vessel_info_name')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title_vessel"><?php echo _l('edit_vessel_info'); ?></span>
                        <span class="add-title_vessel"><?php echo _l('new_vessel_info'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="additional_vessel_info_name"></div>
                            <div class="form">
                                <input type="hidden" id="id" name="id">
                                <?php echo render_input('vessel_info_name', 'vessel_info_name'); ?>
                                <?php echo render_input('imo_number', 'imo_number', '', 'number'); ?>
                                <?php echo render_input('grt', 'grt', '', 'number'); ?>
                                <?php echo render_date_input('year_built', 'year_built'); ?>
                                <?php echo render_input('flag', 'flag'); ?>
                                <?php // echo render_input('type_of_vessel', 'type_of_vessel'); 
                                ?>
                                <?php
                                echo render_select('type_of_vessel', $vessel_list, array('id', 'vessel_name'), 'type_of_vessel');
                                ?>
                                <?php echo render_input('classification_society', 'classification_society'); ?>

                                <?php // foreach ($vessel_list as $vessel) { 
                                ?>
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
</div>

<!-- new duity -->
<div class="_buttons">
    <a href="#" onclick="new_duty_info(); return false;" class="btn btn-info pull-left display-block">
        <?php echo _l('new_duty_info'); ?>
    </a>
</div>


<div class="clearfix"></div>
<hr class="hr-panel-heading" />
<div class="clearfix"></div>
<table class="table dt-table">
    <thead>
        <th><?php echo _l('duty_name'); ?></th>
        <th><?php echo _l('options'); ?></th>
    </thead>
    <tbody>
        <?php foreach ($duty_list as $duty_name) { ?>
            <tr>
                <td><?php echo html_entity_decode($duty_name['duty_name']); ?></td>
                <td>
                    <a href="#" onclick="edit_duty(this,<?php echo html_entity_decode($duty_name['id']); ?>); return false" data-name="<?php echo html_entity_decode($duty_name['duty_name']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square"></i></a>
                    <a href="<?php echo admin_url('recruitment/delete_duty_name/' . $duty_name['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="modal fade" id="duty" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open(admin_url('recruitment/duty')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span class="edit-duty"><?php echo _l('edit_duty_info'); ?></span>
                    <span class="add-duty"><?php echo _l('new_duty_info'); ?></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="additional_duty_name"></div>
                        <div class="form">
                            <?php echo render_input('duty_name', 'duty_name'); ?>
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
</div>

</body>

</html>