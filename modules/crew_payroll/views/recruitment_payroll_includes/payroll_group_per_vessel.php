<div class="row">
    <div class="col-sm-12">
        <button class="btn btn-info" id="add_payroll_group_per_vessel_btn">Add</button>
    </div>

    <div class="col-sm-12" style="margin-top: 10px;">
        <table class="table table-bordered dt-table dt-inline dataTable no-footer">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Vessel Group Name</th>
                    <th>Vessel Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($payroll_group_per_vessel_data) && is_array($payroll_group_per_vessel_data)) {
                    foreach ($payroll_group_per_vessel_data as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['code']; ?></td>
                            <td><?php echo $value['vessel_group_name']; ?></td>
                            <td><?php echo $value['vessel_details']; ?></td>
                            <td>
                                <button class="edit_payroll_group_per_vessel" data-id="<?php echo $value['id']; ?>" style="border: none; background: none;">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a href="<?php echo admin_url('crew_payroll/delete_payroll_group_per_vessel/' . $value['id']); ?>" class="_delete " style="border: none; background: none;">
                                    <i class="fa-regular fa-trash-can fa-lg" style="color: red;"></i>
                                </a>
                            </td>
                        </tr>
                <?php  }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>




<div class="modal fade" id="payroll_group_per_vessel_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content width-100">
            <?php echo form_open_multipart(admin_url('crew_payroll/add_payroll_group_per_vessel'), ['id' => "payroll_group_per_vessel_form"]); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span class="add-title">Add Payroll Group Per Vessel</span>
                    <span class="edit-title">Edit Payroll Group Per Vessel</span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hid" name="hid">
                    <div class="col-md-12">
                        <?php
                        echo render_input('code', _l('code'));
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?php
                        echo render_input('vessel_group_name', _l('vessel_group_name'));
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?php
                        echo render_input('vessel_details', _l('vessel_details'));
                        ?>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>