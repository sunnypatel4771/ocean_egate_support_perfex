<div class="row">
    <div class="col-sm-12" style="display: flex; align-items: center; gap: 30px;">
        <button class="btn btn-info" id="add_payroll_table_btn">Add</button>
        <div style="display: flex; align-items: center; gap: 15px; justify-content: space-between;">
            <div>
                <?php
                $vessel_code_filter_selected = '';
                if (isset($_GET['vessel_code_filter']) && $_GET['vessel_code_filter'] != '') {
                    $vessel_code_filter_selected = $_GET['vessel_code_filter'];
                }
                $vessel_code_options = get_vessel_code_options();
                echo render_select('vessel_code_filter', $vessel_code_options, ['id', 'Name'], 'V-Code', $vessel_code_filter_selected);
                ?>
            </div>
            <div>
                <?php
                $rank_code_filter_selected = '';
                if (isset($_GET['rank_code_filter']) && $_GET['rank_code_filter'] != '') {
                    $rank_code_filter_selected = $_GET['rank_code_filter'];
                }
                $rank_code_options = get_rank_code_options();
                echo render_select('rank_code_filter', $rank_code_options, ['id', 'Name'], "Rank Code Filter", $rank_code_filter_selected);
                ?>
            </div>
        </div>
    </div>

    <div class="col-sm-12" style="margin-top: 10px;">
        <table class="table table-bordered dt-table dt-inline dataTable no-footer">
            <thead>
                <tr>
                    <th>ID</th>
                    <th title="<?php echo _l('vessel_code'); ?>"><?php echo _l('code'); ?></th>
                    <th>Vessel Group</th>
                    <th>R-Code</th>
                    <th>Rank</th>
                    <?php
                    $payroll_setting_tab = payroll_setup_keys('earning');
                    foreach ($payroll_setting_tab as $key => $value) { ?>
                        <th title="<?php echo get_option($value . '_order') . ' - ' . get_option($value); ?>"><?php echo get_option($value . '_shortcode'); ?></th>
                    <?php }
                    ?>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filter = [];
                if (isset($_GET['vessel_code_filter']) && $_GET['vessel_code_filter'] != '') {
                    $filter['vessel_code_filter'] = $_GET['vessel_code_filter'];
                }
                if (isset($_GET['rank_code_filter']) && $_GET['rank_code_filter'] != '') {
                    $filter['rank_code_filter'] = $_GET['rank_code_filter'];
                }
                $payroll_table_setting_data = get_payroll_table_setting_data($filter);
                if (isset($payroll_table_setting_data)) {
                    foreach ($payroll_table_setting_data as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo get_vessel_code_name($value['vessel_code'], 'code'); ?></td>
                            <td><?php echo get_vessel_code_name($value['vessel_code'], 'vessel_group_name'); ?></td>
                            <td><?php echo get_rank_code_name($value['rank_code'], 'code'); ?></td>
                            <td><?php echo get_rank_code_name($value['rank_code'], 'rank_name'); ?></td>
                            <?php
                            $payroll_setting_tab = payroll_setup_keys('earning');
                            foreach ($payroll_setting_tab as $key1 => $value1) { ?>
                                <td style="text-align: right;">
                                    <?php 
                                    if ($value[$value1] > 0) {
                                        echo number_format($value[$value1]); 
                                    }else{
                                        echo '';
                                    }
                                    
                                    ?>
                                </td>
                            <?php }
                            ?>
                            <td>
                                <button class="edit_payroll_table_setting" data-id="<?php echo $value['id']; ?>" style="border: none; background: none;">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a href="<?php echo admin_url('crew_payroll/delete_payroll_table_setting/' . $value['id']); ?>" class="_delete " style="border: none; background: none;">
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




<div class="modal fade" id="payroll_table_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content width-100">
            <?php echo form_open_multipart(admin_url('crew_payroll/add_payroll_table_setting'), ['id' => "payroll_table_setting_form"]); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span class="add-title">Add Payroll Table</span>
                    <span class="edit-title">Edit Payroll Table</span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hid" name="hid">
                    <div class="col-md-6">
                        <?php
                        $vessel_code_options = get_vessel_code_options();
                        echo render_select('vessel_code', $vessel_code_options, ['id', 'Name'], _l('vessel_code'));
                        ?>
                    </div>

                    <div class="col-md-6">
                        <?php
                        $rank_code_options = get_rank_code_options();
                        echo render_select('rank_code', $rank_code_options, ['id', 'Name'], _l('rank_code'));
                        ?>
                    </div>

                    <?php
                    $payroll_setting_tab = payroll_setup_keys('earning');
                    foreach ($payroll_setting_tab as $key => $value) { ?>
                        <div class="col-md-6">
                            <?php
                            $lable = get_option($value) . ' <span style="color: blue;"> ( ' . get_option($value . '_shortcode') . ' )</span>';
                            echo render_input($value, $lable, '', 'number');
                            ?>
                        </div>
                    <?php
                    }
                    ?>

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