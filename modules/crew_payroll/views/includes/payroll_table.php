<div class="row">
    <div class="col-sm-12">
        <button class="btn btn-info" id="add_new_payroll_data">Add New</button>
    </div>
    <div class="col-sm-12" style="margin-top: 10px;">
        <table class="table table-bordered dt-table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Code</td>
                    <td>Rank</td>
                    <?php
                    $payroll_setting_tab = get_payroll_setting_tab_detail();
                    if (!empty($payroll_setting_tab)) {
                        foreach ($payroll_setting_tab as $key => $value) { ?>
                            <td title="<?php echo $value['name']; ?>"><?php echo $value['shortcode']; ?></td>
                    <?php }
                    }
                    ?>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($payroll_table_data) && !empty($payroll_table_data)) {
                    foreach ($payroll_table_data as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['code']; ?></td>
                            <td><?php echo $value['rank']; ?></td>
                            <?php
                            $payroll_setting_tab = get_payroll_setting_tab_detail();
                            if (!empty($payroll_setting_tab)) {
                                foreach ($payroll_setting_tab as $key => $value_1) { ?>
                                    <td style="text-align: right;">
                                        <?php
                                        if ($value[$key] > 0) {
                                            echo number_format($value[$key]);
                                        }
                                        ?>
                                    </td>
                            <?php }
                            }
                            ?>
                            <td>
                                <button class="edit_payroll_table" data-id="<?php echo $value['id']; ?>" style="border: none; background: none;">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a href="<?php echo admin_url('crew_payroll/delete_payroll_table/' . $value['id']) ?>" class="_delete " style="border: none; background: none;">
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

<div class="modal fade" id="add_new_payroll_data_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <?php echo form_open(admin_url('crew_payroll/save_payroll_data')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span class="edit-title">Save Payroll</span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hid" name="hid">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align: right; vertical-align: middle; padding: 0; padding-right: 5px;"></td>
                                <td style="text-align: center; vertical-align: middle; padding: 0;">Code</td>
                                <td style="vertical-align: middle; padding: 5px;">
                                    <input type="text" class="form-control" name="code" id="code">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; vertical-align: middle; padding: 0; padding-right: 5px;"></td>
                                <td style="text-align: center; vertical-align: middle; padding: 0;">Rank</td>
                                <td style="vertical-align: middle; padding: 5px;">
                                    <input type="text" class="form-control" name="rank" id="rank">
                                </td>
                            </tr>
                            <?php
                            $payroll_setting_tab = get_payroll_setting_tab_detail();
                            if (!empty($payroll_setting_tab)) {
                                foreach ($payroll_setting_tab as $key => $value) { ?>
                                    <tr>
                                        <td style="text-align: right; vertical-align: middle; padding: 0; padding-right: 5px;">
                                            <?php echo $value['order']; ?>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle; padding: 0;">
                                            <?php echo $value['shortcode']; ?>
                                        </td>
                                        <td style="vertical-align: middle; padding: 5px;">
                                            <input type="number" class="form-control" name="<?php echo $key; ?>" id="<?php echo $key; ?>">
                                        </td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
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