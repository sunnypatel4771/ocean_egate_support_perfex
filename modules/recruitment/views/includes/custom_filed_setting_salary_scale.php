<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
    <div class="_buttons">
        <a href="#" onclick="show_custom_filed_setting_salary_scale_modal(); return false;" class="btn btn-info pull-left display-block">
            <?php echo _l('new_salary_scale'); ?>
        </a>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-panel-heading" />
    <div class="clearfix"></div>
    <table class="table dt-table">
        <thead>
            <th>#</th>
            <th>Principal</th>
            <th>Vessel Name</th>
            <th>Job Duty</th>
            <th>Basic Monthly Salary</th>
            <th>Hours of Work</th>
            <th>Overtime</th>
            <th>Vacation Leave w/ Pay</th>
            <th>Other Allowances</th>
            <th>Subsistence</th>
            <th>Supervisory</th>
            <th>Provident Fund</th>
            <th><?php echo _l('options'); ?></th>
        </thead>
        <tbody>
            <?php foreach ($custom_filed_setting_salary_scale_data as $salary_scale) {
            ?>
                <tr>
                    <td><?php echo html_entity_decode($salary_scale['id']); ?></td>
                    <td>
                        <?php
                        $principal_data = custom_filed_setting_principals($salary_scale['principal']);
                        echo isset($principal_data['principal_name']) ? $principal_data['principal_name'] : '';
                        ?>
                    </td>
                    <td>
                        <?php
                        $vessel_name_data = get_job_vessel_name_list($salary_scale['vessel_name']);
                        echo isset($vessel_name_data['vessel_info_name']) ? $vessel_name_data['vessel_info_name'] : '';
                        ?>
                    </td>
                    <td>
                        <?php
                        $position_data = get_job_duty($salary_scale['position']);
                        echo isset($position_data['duty_name']) ? $position_data['duty_name'] : '';
                        ?>
                    </td>
                    <td><?php echo html_entity_decode($salary_scale['basic_month_salary']); ?></td>
                    <td><?php echo html_entity_decode($salary_scale['hours_of_work']); ?></td>
                    <td><?php echo html_entity_decode($salary_scale['overtime']); ?></td>
                    <td><?php echo html_entity_decode($salary_scale['vacation_leave_w_pay']); ?></td>
                    <td><?php echo html_entity_decode($salary_scale['other_allowance_s']); ?></td>
                    <td><?php echo html_entity_decode($salary_scale['subsistence']); ?></td>
                    <td><?php echo html_entity_decode($salary_scale['supervisory']); ?></td>
                    <td><?php echo html_entity_decode($salary_scale['provident_fund']); ?></td>
                    <td>
                        <a href="#" class="btn btn-default btn-icon edit_custom_filed_setting_salary_scale" data-id="<?php echo $salary_scale['id']; ?>"><i class="fa fa-pencil-square"></i></a>
                        <a href="<?php echo admin_url('recruitment/delete_custom_filed_setting_salary_scale/' . $salary_scale['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php  }
            ?>
        </tbody>
    </table>

    <div class="modal fade" id="custom_filed_setting_salary_scale_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('recruitment/save_custom_filed_setting_salary_scale')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="edit-title"><?php echo _l('edit_salary_scale'); ?></span>
                        <span class="add-title"><?php echo _l('new_salary_scale'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form">
                                <input type="hidden" name="hid" id="hid">

                                <div class="col-sm-6">
                                    <?php
                                    $custom_filed_setting_principal = custom_filed_setting_principals();
                                    echo render_select('principal', $custom_filed_setting_principal, array('id', 'principal_name'), 'Principal');
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    $job_vessel_names = get_job_vessel_name_list();
                                    echo render_select('vessel_name', $job_vessel_names, array('id', 'vessel_info_name'), 'Vessel Name');
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    $job_duty = get_job_duty();
                                    echo render_select('position', $job_duty, array('id', 'duty_name'), 'Job Duty');
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    echo render_input('basic_month_salary', 'Basic Monthly Salary', '', 'number');
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    echo render_input('hours_of_work', 'Hours of Work', '', 'number');
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    echo render_input('overtime', 'Overtime', '', 'number');
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    echo render_input('vacation_leave_w_pay', 'Vacation Leave w/ Pay', '', 'number');
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    echo render_input('other_allowance_s', 'Other Allowances', '', 'number');
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    echo render_input('subsistence', 'Subsistence', '', 'number');
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    echo render_input('supervisory', 'Supervisory', '', 'number');
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    echo render_input('provident_fund', 'Provident Fund', '', 'number');
                                    ?>
                                </div>


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