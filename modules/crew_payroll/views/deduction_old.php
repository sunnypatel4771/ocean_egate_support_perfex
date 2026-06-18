<div role="tabpanel" class="tab-pane" id="payroll_setup">
    <div class="row">
        <div class="col-sm-12" style="display: flex; margin-top: 15px; margin-bottom: 20px;">
            <?php
            $payroll_table_dropdown = get_payroll_table_list_for_dropdown();
            $crew_saved_payroll_data = get_crew_saved_payroll_data($candidate->payroll_table_id);
            ?>
            <div class="row" style="width: 100%;">
                <?php echo form_open_multipart(admin_url('crew_payroll/add_payroll_table_data_for_crew')); ?>
                <div class="col-sm-2" style="padding: 7px; font-size: 16px; padding-left: 40px;">Select Payroll Code</div>
                <div class="col-sm-3">
                    <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate->id; ?>">
                    <?php
                    $id = isset($crew_saved_payroll_data['id']) ? $crew_saved_payroll_data['id'] : '';
                    echo render_select('select_payroll_code', $payroll_table_dropdown, ['id', 'code'], '', $id);
                    ?>
                </div>
                <div class="col-sm-3">
                    <?php
                    $rank = isset($crew_saved_payroll_data['rank']) ? $crew_saved_payroll_data['rank'] : '';
                    echo render_input('select_payroll_rank', '', $rank, 'text', ['readonly' => 'readonly']);
                    ?>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        <div class="col-sm-12" style="display: flex; margin-top: 15px; margin-bottom: 20px;">
            <div style="font-size: 17px; margin-left: 25px; font-size: 18px; font-weight: bold;" class="text-center total_receiving"></div>
        </div>
        <?php echo form_open_multipart(admin_url('crew_payroll/save_payroll_setup'), array('id' => 'payroll_setup_form')); ?>
        <input type="hidden" name="candidate_id" id="payroll_setup_candidate_id" value="<?php echo $candidate_id; ?>">
        <div class="col-sm-12" style="display: flex;">
            <div style="width: 7%; font-size: 17px; font-weight: bold;" class="text-center">Earnings</div>
            <div style="width: 15%;" class="text-center"></div>
            <div style="width: 8%;" class="text-center">Rate</div>
            <div style="width: 8%;" class="text-center">QTY</div>
            <div style="width: 8%;" class="text-center">Amount</div>
            <div style="width: 15%;" class="text-center">Remark</div>
            <div style="width: 15%;" class="text-center">Bank Name</div>
            <div style="width: 15%;" class="text-center">Account Name</div>
            <div style="width: 15%;" class="text-center">Account No.</div>
        </div>
        <div class="col-sm-12" style="display: flex; margin-top: 15px;">
            <div style="width: 7%; font-size: 17px;" class="text-center earnig_total_amount"></div>
        </div>
        <!-- 1 row -->
        <?php
        $basic_wages_onb_can_view = get_option('basic_wages_onb_can_view');
        if ($basic_wages_onb_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 15px;">
                <div style="width: 7%;" class="text-center"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('basic_wages_onb_shortcode') != '') {
                            $shortcode = '( ' . get_option('basic_wages_onb_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('basic_wages_onb'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_onb_rate = get_crew_payroll_new($candidate_id, 'basic_wages_onb', 'rate');
                    echo $basic_wages_onb_rate;
                    echo render_input('basic_wages_onb[]', '', '', 'number', ['step' => "0.01"], [], '', 'basic_wages_onb_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_onb_qty = get_crew_payroll_new($candidate_id, 'basic_wages_onb', 'qty');
                    echo $basic_wages_onb_qty;
                    echo render_input('basic_wages_onb[]', '', '', 'number', ['step' => "0.01"], [], '', 'basic_wages_onb_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_onb_amount = get_crew_payroll_new($candidate_id, 'basic_wages_onb', 'amount');
                    echo $basic_wages_onb_amount;
                    echo render_input('basic_wages_onb[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'basic_wages_onb_amount earning'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_onb_remark = get_crew_payroll_new($candidate_id, 'basic_wages_onb', 'remark');
                    echo $basic_wages_onb_remark;
                    echo render_input('basic_wages_onb[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_onb_bank_name = get_crew_payroll_new($candidate_id, 'basic_wages_onb', 'bank_name');
                    echo $basic_wages_onb_bank_name;
                    echo render_input('basic_wages_onb[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_onb_account_name = get_crew_payroll_new($candidate_id, 'basic_wages_onb', 'account_name');
                    echo $basic_wages_onb_account_name;
                    echo render_input('basic_wages_onb[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_onb_account_no = get_crew_payroll_new($candidate_id, 'basic_wages_onb', 'account_no');
                    echo $basic_wages_onb_account_no;
                    echo render_input('basic_wages_onb[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 1 row -->
        <!-- 2 row -->
        <?php
        $basic_wages_trv_can_view = get_option('basic_wages_trv_can_view');
        if ($basic_wages_trv_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('basic_wages_trv_shortcode') != '') {
                            $shortcode = '( ' . get_option('basic_wages_trv_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('basic_wages_trv'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_trv_rate = get_crew_payroll_new($candidate_id, 'basic_wages_trv', 'rate');
                    echo $basic_wages_trv_rate;
                    echo render_input('basic_wages_trv[]', '', '', 'number', ['step' => "0.01"], [], '', 'basic_wages_trv_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_trv_qty = get_crew_payroll_new($candidate_id, 'basic_wages_trv', 'qty');
                    echo $basic_wages_trv_qty;
                    echo render_input('basic_wages_trv[]', '', '', 'number', ['step' => "0.01"], [], '', 'basic_wages_trv_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_trv_amount = get_crew_payroll_new($candidate_id, 'basic_wages_trv', 'amount');
                    echo $basic_wages_trv_amount;
                    echo render_input('basic_wages_trv[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'basic_wages_trv_amount earning'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_trv_remark = get_crew_payroll_new($candidate_id, 'basic_wages_trv', 'remark');
                    echo $basic_wages_trv_remark;
                    echo render_input('basic_wages_trv[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_trv_bank_name = get_crew_payroll_new($candidate_id, 'basic_wages_trv', 'bank_name');
                    echo $basic_wages_trv_bank_name;
                    echo render_input('basic_wages_trv[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_trv_account_name = get_crew_payroll_new($candidate_id, 'basic_wages_trv', 'account_name');
                    echo $basic_wages_trv_account_name;
                    echo render_input('basic_wages_trv[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $basic_wages_trv_account_no = get_crew_payroll_new($candidate_id, 'basic_wages_trv', 'account_no');
                    echo $basic_wages_trv_account_no;
                    echo render_input('basic_wages_trv[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 2 row -->
        <!-- 3 row -->
        <?php
        $guranteed_overtime_can_view = get_option('guranteed_overtime_can_view');
        if ($guranteed_overtime_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('guranteed_overtime_shortcode') != '') {
                            $shortcode = '( ' . get_option('guranteed_overtime_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('guranteed_overtime'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $guranteed_overtime_rate = get_crew_payroll_new($candidate_id, 'guranteed_overtime', 'rate');
                    echo $guranteed_overtime_rate;
                    echo render_input('guranteed_overtime[]', '', '', 'number', ['step' => "0.01"], [], '', 'guranteed_overtime_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $guranteed_overtime_qty = get_crew_payroll_new($candidate_id, 'guranteed_overtime', 'qty');
                    echo $guranteed_overtime_qty;
                    echo render_input('guranteed_overtime[]', '', '', 'number', ['step' => "0.01"], [], '', 'guranteed_overtime_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $guranteed_overtime_amount = get_crew_payroll_new($candidate_id, 'guranteed_overtime', 'amount');
                    echo $guranteed_overtime_amount;
                    echo render_input('guranteed_overtime[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'guranteed_overtime_amount earning'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $guranteed_overtime_remark = get_crew_payroll_new($candidate_id, 'guranteed_overtime', 'remark');
                    echo $guranteed_overtime_remark;
                    echo render_input('guranteed_overtime[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $guranteed_overtime_bank_name = get_crew_payroll_new($candidate_id, 'guranteed_overtime', 'bank_name');
                    echo $guranteed_overtime_bank_name;
                    echo render_input('guranteed_overtime[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $guranteed_overtime_account_name = get_crew_payroll_new($candidate_id, 'guranteed_overtime', 'account_name');
                    echo $guranteed_overtime_account_name;
                    echo render_input('guranteed_overtime[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $guranteed_overtime_account_no = get_crew_payroll_new($candidate_id, 'guranteed_overtime', 'account_no');
                    echo $guranteed_overtime_account_no;
                    echo render_input('guranteed_overtime[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 3 row -->
        <!-- 4 row -->
        <?php
        $education_allowance_can_view = get_option('education_allowance_can_view');
        if ($education_allowance_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('education_allowance_shortcode') != '') {
                            $shortcode = '( ' . get_option('education_allowance_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('education_allowance'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $education_allowance_rate = get_crew_payroll_new($candidate_id, 'education_allowance', 'rate');
                    echo $education_allowance_rate;
                    echo render_input('education_allowance[]', '', '', 'number', ['step' => "0.01"], [], '', 'education_allowance_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $education_allowance_qty = get_crew_payroll_new($candidate_id, 'education_allowance', 'qty');
                    echo $education_allowance_qty;
                    echo render_input('education_allowance[]', '', '', 'number', ['step' => "0.01"], [], '', 'education_allowance_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $education_allowance_amount = get_crew_payroll_new($candidate_id, 'education_allowance', 'amount');
                    echo $education_allowance_amount;
                    echo render_input('education_allowance[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'education_allowance_amount earning'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $education_allowance_remark = get_crew_payroll_new($candidate_id, 'education_allowance', 'remark');
                    echo $education_allowance_remark;
                    echo render_input('education_allowance[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $education_allowance_bank_name = get_crew_payroll_new($candidate_id, 'education_allowance', 'bank_name');
                    echo $education_allowance_bank_name;
                    echo render_input('education_allowance[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $education_allowance_account_name = get_crew_payroll_new($candidate_id, 'education_allowance', 'account_name');
                    echo $education_allowance_account_name;
                    echo render_input('education_allowance[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $education_allowance_account_no = get_crew_payroll_new($candidate_id, 'education_allowance', 'account_no');
                    echo $education_allowance_account_no;
                    echo render_input('education_allowance[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 4 row -->
        <!-- 5 row -->
        <?php
        $leave_can_view = get_option('leave_can_view');
        if ($leave_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('leave_shortcode') != '') {
                            $shortcode = '( ' . get_option('leave_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('leave'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $leave_rate = get_crew_payroll_new($candidate_id, 'leave', 'rate');
                    echo $leave_rate;
                    echo render_input('leave[]', '', '', 'number', ['step' => "0.01"], [], '', 'leave_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $leave_qty = get_crew_payroll_new($candidate_id, 'leave', 'qty');
                    echo $leave_qty;
                    echo render_input('leave[]', '', '', 'number', ['step' => "0.01"], [], '', 'leave_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $leave_amount = get_crew_payroll_new($candidate_id, 'leave', 'amount');
                    echo $leave_amount;
                    echo render_input('leave[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'leave_amount earning'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $leave_remark = get_crew_payroll_new($candidate_id, 'leave', 'remark');
                    echo $leave_remark;
                    echo render_input('leave[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $leave_bank_name = get_crew_payroll_new($candidate_id, 'leave', 'bank_name');
                    echo $leave_bank_name;
                    echo render_input('leave[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $leave_account_name = get_crew_payroll_new($candidate_id, 'leave', 'account_name');
                    echo $leave_account_name;
                    echo render_input('leave[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $leave_account_no = get_crew_payroll_new($candidate_id, 'leave', 'account_no');
                    echo $leave_account_no;
                    echo render_input('leave[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 5 row -->
        <!-- 6 row -->
        <?php
        $operational_allowance_can_view = get_option('operational_allowance_can_view');
        if ($operational_allowance_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('operational_allowance_shortcode') != '') {
                            $shortcode = '( ' . get_option('operational_allowance_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('operational_allowance'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $operational_allowance_rate = get_crew_payroll_new($candidate_id, 'operational_allowance', 'rate');
                    echo $operational_allowance_rate;
                    echo render_input('operational_allowance[]', '', '', 'number', ['step' => "0.01"], [], '', 'operational_allowance_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $operational_allowance_qty = get_crew_payroll_new($candidate_id, 'operational_allowance', 'qty');
                    echo $operational_allowance_qty;
                    echo render_input('operational_allowance[]', '', '', 'number', ['step' => "0.01"], [], '', 'operational_allowance_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $operational_allowance_amount = get_crew_payroll_new($candidate_id, 'operational_allowance', 'amount');
                    echo $operational_allowance_amount;
                    echo render_input('operational_allowance[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'operational_allowance_amount earning'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $operational_allowance_remark = get_crew_payroll_new($candidate_id, 'operational_allowance', 'remark');
                    echo $operational_allowance_remark;
                    echo render_input('operational_allowance[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $operational_allowance_bank_name = get_crew_payroll_new($candidate_id, 'operational_allowance', 'bank_name');
                    echo $operational_allowance_bank_name;
                    echo render_input('operational_allowance[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $operational_allowance_account_name = get_crew_payroll_new($candidate_id, 'operational_allowance', 'account_name');
                    echo $operational_allowance_account_name;
                    echo render_input('operational_allowance[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $operational_allowance_account_no = get_crew_payroll_new($candidate_id, 'operational_allowance', 'account_no');
                    echo $operational_allowance_account_no;
                    echo render_input('operational_allowance[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 6 row -->
        <!-- 7 row -->
        <?php
        $supplementary_allowance_can_view = get_option('supplementary_allowance_can_view');
        if ($supplementary_allowance_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('supplementary_allowance_shortcode') != '') {
                            $shortcode = '( ' . get_option('supplementary_allowance_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('supplementary_allowance'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $supplementary_allowance_rate = get_crew_payroll_new($candidate_id, 'supplementary_allowance', 'rate');
                    echo $supplementary_allowance_rate;
                    echo render_input('supplementary_allowance[]', '', '', 'number', ['step' => "0.01"], [], '', 'supplementary_allowance_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $supplementary_allowance_qty = get_crew_payroll_new($candidate_id, 'supplementary_allowance', 'qty');
                    echo $supplementary_allowance_qty;
                    echo render_input('supplementary_allowance[]', '', '', 'number', ['step' => "0.01"], [], '', 'supplementary_allowance_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $supplementary_allowance_amount = get_crew_payroll_new($candidate_id, 'supplementary_allowance', 'amount');
                    echo $supplementary_allowance_amount;
                    echo render_input('supplementary_allowance[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'supplementary_allowance_amount earning'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $supplementary_allowance_remark = get_crew_payroll_new($candidate_id, 'supplementary_allowance', 'remark');
                    echo $supplementary_allowance_remark;
                    echo render_input('supplementary_allowance[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $supplementary_allowance_bank_name = get_crew_payroll_new($candidate_id, 'supplementary_allowance', 'bank_name');
                    echo $supplementary_allowance_bank_name;
                    echo render_input('supplementary_allowance[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $supplementary_allowance_account_name = get_crew_payroll_new($candidate_id, 'supplementary_allowance', 'account_name');
                    echo $supplementary_allowance_account_name;
                    echo render_input('supplementary_allowance[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $supplementary_allowance_account_no = get_crew_payroll_new($candidate_id, 'supplementary_allowance', 'account_no');
                    echo $supplementary_allowance_account_no;
                    echo render_input('supplementary_allowance[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 7 row -->
        <!-- 8 row -->
        <?php
        $owners_bonus_can_view = get_option('owners_bonus_can_view');
        if ($owners_bonus_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('owners_bonus_shortcode') != '') {
                            $shortcode = '( ' . get_option('owners_bonus_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('owners_bonus'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $owners_bonus_rate = get_crew_payroll_new($candidate_id, 'owners_bonus', 'rate');
                    echo $owners_bonus_rate;
                    echo render_input('owners_bonus[]', '', '', 'number', ['step' => "0.01"], [], '', 'owners_bonus_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $owners_bonus_qty = get_crew_payroll_new($candidate_id, 'owners_bonus', 'qty');
                    echo $owners_bonus_qty;
                    echo render_input('owners_bonus[]', '', '', 'number', ['step' => "0.01"], [], '', 'owners_bonus_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $owners_bonus_amount = get_crew_payroll_new($candidate_id, 'owners_bonus', 'amount');
                    echo $owners_bonus_amount;
                    echo render_input('owners_bonus[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'owners_bonus_amount earning'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $owners_bonus_remark = get_crew_payroll_new($candidate_id, 'owners_bonus', 'remark');
                    echo $owners_bonus_remark;
                    echo render_input('owners_bonus[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $owners_bonus_bank_name = get_crew_payroll_new($candidate_id, 'owners_bonus', 'bank_name');
                    echo $owners_bonus_bank_name;
                    echo render_input('owners_bonus[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $owners_bonus_account_name = get_crew_payroll_new($candidate_id, 'owners_bonus', 'account_name');
                    echo $owners_bonus_account_name;
                    echo render_input('owners_bonus[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $owners_bonus_account_no = get_crew_payroll_new($candidate_id, 'owners_bonus', 'account_no');
                    echo $owners_bonus_account_no;
                    echo render_input('owners_bonus[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 8 row -->
        <hr style="width: 100%; margin-left: 0px;border: 1px solid rgb(3,105,161);">
        <div class="col-sm-12" style="display: flex;">
            <div style="width: 12%; font-size: 17px; font-weight: bold;" class="text-center">Deduction - Official</div>
        </div>
        <div class="col-sm-12" style="display: flex; margin-top: 10px;">
            <div style="width: 7%;  font-size: 17px;" class="text-center deduction_amount"></div>
        </div>
        <!-- 9 row -->
        <?php
        $slopchest_can_view = get_option('slopchest_can_view');
        if ($slopchest_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;" class="text-center"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('slopchest_shortcode') != '') {
                            $shortcode = '( ' . get_option('slopchest_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('slopchest'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $slopchest_rate = get_crew_payroll_new($candidate_id, 'slopchest', 'rate');
                    echo $slopchest_rate;
                    echo render_input('slopchest[]', '', '', 'number', ['step' => "0.01"], [], '', 'slopchest_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $slopchest_qty = get_crew_payroll_new($candidate_id, 'slopchest', 'qty');
                    echo $slopchest_qty;
                    echo render_input('slopchest[]', '', '', 'number', ['step' => "0.01"], [], '', 'slopchest_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $slopchest_amount = get_crew_payroll_new($candidate_id, 'slopchest', 'amount');
                    echo $slopchest_amount;
                    echo render_input('slopchest[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'slopchest_amount deduction'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $slopchest_remark = get_crew_payroll_new($candidate_id, 'slopchest', 'remark');
                    echo $slopchest_remark;
                    echo render_input('slopchest[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $slopchest_bank_name = get_crew_payroll_new($candidate_id, 'slopchest', 'bank_name');
                    echo $slopchest_bank_name;
                    echo render_input('slopchest[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $slopchest_account_name = get_crew_payroll_new($candidate_id, 'slopchest', 'account_name');
                    echo $slopchest_account_name;
                    echo render_input('slopchest[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $slopchest_account_no = get_crew_payroll_new($candidate_id, 'slopchest', 'account_no');
                    echo $slopchest_account_no;
                    echo render_input('slopchest[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 9 row -->
        <!-- 10 row -->
        <?php
        $social_security_system_empee_can_view = get_option('social_security_system_empee_can_view');
        if ($social_security_system_empee_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('social_security_system_empee_shortcode') != '') {
                            $shortcode = '( ' . get_option('social_security_system_empee_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('social_security_system_empee'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $social_security_system_empee_rate = get_crew_payroll_new($candidate_id, 'social_security_system_empee', 'rate');
                    echo $social_security_system_empee_rate;
                    echo render_input('social_security_system_empee[]', '', '', 'number', ['step' => "0.01"], [], '', 'social_security_system_empee_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $social_security_system_empee_qty = get_crew_payroll_new($candidate_id, 'social_security_system_empee', 'qty');
                    echo $social_security_system_empee_qty;
                    echo render_input('social_security_system_empee[]', '', '', 'number', ['step' => "0.01"], [], '', 'social_security_system_empee_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $social_security_system_empee_amount = get_crew_payroll_new($candidate_id, 'social_security_system_empee', 'amount');
                    echo $social_security_system_empee_amount;
                    echo render_input('social_security_system_empee[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'social_security_system_empee_amount deduction'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $social_security_system_empee_remark = get_crew_payroll_new($candidate_id, 'social_security_system_empee', 'remark');
                    echo $social_security_system_empee_remark;
                    echo render_input('social_security_system_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $social_security_system_empee_bank_name = get_crew_payroll_new($candidate_id, 'social_security_system_empee', 'bank_name');
                    echo $social_security_system_empee_bank_name;
                    echo render_input('social_security_system_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $social_security_system_empee_account_name = get_crew_payroll_new($candidate_id, 'social_security_system_empee', 'account_name');
                    echo $social_security_system_empee_account_name;
                    echo render_input('social_security_system_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $social_security_system_empee_account_no = get_crew_payroll_new($candidate_id, 'social_security_system_empee', 'account_no');
                    echo $social_security_system_empee_account_no;
                    echo render_input('social_security_system_empee[]', '', '');
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 10 row -->
        <!-- 11 row -->
        <?php
        $philhelth_empee_can_view = get_option('philhelth_empee_can_view');
        if ($philhelth_empee_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('philhelth_empee_shortcode') != '') {
                            $shortcode = '( ' . get_option('philhelth_empee_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('philhelth_empee'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $philhelth_empee_rate = get_crew_payroll_new($candidate_id, 'philhelth_empee', 'rate');
                    echo $philhelth_empee_rate;
                    echo render_input('philhelth_empee[]', '', '', 'number', ['step' => "0.01"], [], '', 'philhelth_empee_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $philhelth_empee_qty = get_crew_payroll_new($candidate_id, 'philhelth_empee', 'qty');
                    echo $philhelth_empee_qty;
                    echo render_input('philhelth_empee[]', '', '', 'number', ['step' => "0.01"], [], '', 'philhelth_empee_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $philhelth_empee_amount = get_crew_payroll_new($candidate_id, 'philhelth_empee', 'amount');
                    echo $philhelth_empee_amount;
                    echo render_input('philhelth_empee[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'philhelth_empee_amount deduction'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $philhelth_empee_remark = get_crew_payroll_new($candidate_id, 'philhelth_empee', 'remark');
                    echo $philhelth_empee_remark;
                    echo render_input('philhelth_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $philhelth_empee_bank_name = get_crew_payroll_new($candidate_id, 'philhelth_empee', 'bank_name');
                    echo $philhelth_empee_bank_name;
                    echo render_input('philhelth_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $philhelth_empee_account_name = get_crew_payroll_new($candidate_id, 'philhelth_empee', 'account_name');
                    echo $philhelth_empee_account_name;
                    echo render_input('philhelth_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $philhelth_empee_account_no = get_crew_payroll_new($candidate_id, 'philhelth_empee', 'account_no');
                    echo $philhelth_empee_account_no;
                    echo render_input('philhelth_empee[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 11 row -->
        <!-- 12 row -->
        <?php
        $pag_lbig_housing_program_empee_can_view = get_option('pag_lbig_housing_program_empee_can_view');
        if ($pag_lbig_housing_program_empee_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('pag_lbig_housing_program_empee_shortcode') != '') {
                            $shortcode = '( ' . get_option('pag_lbig_housing_program_empee_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('pag_lbig_housing_program_empee'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $pag_lbig_housing_program_empee_rate = get_crew_payroll_new($candidate_id, 'pag_lbig_housing_program_empee', 'rate');
                    echo $pag_lbig_housing_program_empee_rate;
                    echo render_input('pag_lbig_housing_program_empee[]', '', '', 'number', ['step' => "0.01"], [], '', 'pag_lbig_housing_program_empee_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $pag_lbig_housing_program_empee_qty = get_crew_payroll_new($candidate_id, 'pag_lbig_housing_program_empee', 'qty');
                    echo $pag_lbig_housing_program_empee_qty;
                    echo render_input('pag_lbig_housing_program_empee[]', '', '', 'number', ['step' => "0.01"], [], '', 'pag_lbig_housing_program_empee_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $pag_lbig_housing_program_empee_amount = get_crew_payroll_new($candidate_id, 'pag_lbig_housing_program_empee', 'amount');
                    echo $pag_lbig_housing_program_empee_amount;
                    echo render_input('pag_lbig_housing_program_empee[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'pag_lbig_housing_program_empee_amount deduction'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $pag_lbig_housing_program_empee_remark = get_crew_payroll_new($candidate_id, 'pag_lbig_housing_program_empee', 'remark');
                    echo $pag_lbig_housing_program_empee_remark;
                    echo render_input('pag_lbig_housing_program_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $pag_lbig_housing_program_empee_bank_name = get_crew_payroll_new($candidate_id, 'pag_lbig_housing_program_empee', 'bank_name');
                    echo $pag_lbig_housing_program_empee_bank_name;
                    echo render_input('pag_lbig_housing_program_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $pag_lbig_housing_program_empee_account_name = get_crew_payroll_new($candidate_id, 'pag_lbig_housing_program_empee', 'account_name');
                    echo $pag_lbig_housing_program_empee_account_name;
                    echo render_input('pag_lbig_housing_program_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $pag_lbig_housing_program_empee_account_no = get_crew_payroll_new($candidate_id, 'pag_lbig_housing_program_empee', 'account_no');
                    echo $pag_lbig_housing_program_empee_account_no;
                    echo render_input('pag_lbig_housing_program_empee[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 12 row -->
        <!-- 13 row -->
        <?php
        $sss_mandatory_provident_fund_empee_can_view = get_option('sss_mandatory_provident_fund_empee_can_view');
        if ($sss_mandatory_provident_fund_empee_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('sss_mandatory_provident_fund_empee_shortcode') != '') {
                            $shortcode = '( ' . get_option('sss_mandatory_provident_fund_empee_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('sss_mandatory_provident_fund_empee'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $sss_mandatory_provident_fund_empee_rate = get_crew_payroll_new($candidate_id, 'sss_mandatory_provident_fund_empee', 'rate');
                    echo $sss_mandatory_provident_fund_empee_rate;
                    echo render_input('sss_mandatory_provident_fund_empee[]', '', '', 'number', ['step' => "0.01"], [], '', 'sss_mandatory_provident_fund_empee_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $sss_mandatory_provident_fund_empee_qty = get_crew_payroll_new($candidate_id, 'sss_mandatory_provident_fund_empee', 'qty');
                    echo $sss_mandatory_provident_fund_empee_qty;
                    echo render_input('sss_mandatory_provident_fund_empee[]', '', '', 'number', ['step' => "0.01"], [], '', 'sss_mandatory_provident_fund_empee_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $sss_mandatory_provident_fund_empee_amount = get_crew_payroll_new($candidate_id, 'sss_mandatory_provident_fund_empee', 'amount');
                    echo $sss_mandatory_provident_fund_empee_amount;
                    echo render_input('sss_mandatory_provident_fund_empee[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'sss_mandatory_provident_fund_empee_amount deduction'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $sss_mandatory_provident_fund_empee_remark = get_crew_payroll_new($candidate_id, 'sss_mandatory_provident_fund_empee', 'remark');
                    echo $sss_mandatory_provident_fund_empee_remark;
                    echo render_input('sss_mandatory_provident_fund_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $sss_mandatory_provident_fund_empee_bank_name = get_crew_payroll_new($candidate_id, 'sss_mandatory_provident_fund_empee', 'bank_name');
                    echo $sss_mandatory_provident_fund_empee_bank_name;
                    echo render_input('sss_mandatory_provident_fund_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $sss_mandatory_provident_fund_empee_account_name = get_crew_payroll_new($candidate_id, 'sss_mandatory_provident_fund_empee', 'account_name');
                    echo $sss_mandatory_provident_fund_empee_account_name;
                    echo render_input('sss_mandatory_provident_fund_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $sss_mandatory_provident_fund_empee_account_no = get_crew_payroll_new($candidate_id, 'sss_mandatory_provident_fund_empee', 'account_no');
                    echo $sss_mandatory_provident_fund_empee_account_no;
                    echo render_input('sss_mandatory_provident_fund_empee[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 13 row -->
        <!-- 14 row -->
        <?php
        $provident_fund_kaupthing_empee_can_view = get_option('provident_fund_kaupthing_empee_can_view');
        if ($provident_fund_kaupthing_empee_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('provident_fund_kaupthing_empee_shortcode') != '') {
                            $shortcode = '( ' . get_option('provident_fund_kaupthing_empee_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('provident_fund_kaupthing_empee'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $provident_fund_kaupthing_empee_rate = get_crew_payroll_new($candidate_id, 'provident_fund_kaupthing_empee', 'rate');
                    echo $provident_fund_kaupthing_empee_rate;
                    echo render_input('provident_fund_kaupthing_empee[]', '', '', 'number', ['step' => "0.01"], [], '', 'provident_fund_kaupthing_empee_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $provident_fund_kaupthing_empee_qty = get_crew_payroll_new($candidate_id, 'provident_fund_kaupthing_empee', 'qty');
                    echo $provident_fund_kaupthing_empee_qty;
                    echo render_input('provident_fund_kaupthing_empee[]', '', '', 'number', ['step' => "0.01"], [], '', 'provident_fund_kaupthing_empee_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $provident_fund_kaupthing_empee_amount = get_crew_payroll_new($candidate_id, 'provident_fund_kaupthing_empee', 'amount');
                    echo $provident_fund_kaupthing_empee_amount;
                    echo render_input('provident_fund_kaupthing_empee[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'provident_fund_kaupthing_empee_amount deduction'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $provident_fund_kaupthing_empee_remark = get_crew_payroll_new($candidate_id, 'provident_fund_kaupthing_empee', 'remark');
                    echo $provident_fund_kaupthing_empee_remark;
                    echo render_input('provident_fund_kaupthing_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $provident_fund_kaupthing_empee_bank_name = get_crew_payroll_new($candidate_id, 'provident_fund_kaupthing_empee', 'bank_name');
                    echo $provident_fund_kaupthing_empee_bank_name;
                    echo render_input('provident_fund_kaupthing_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $provident_fund_kaupthing_empee_account_name = get_crew_payroll_new($candidate_id, 'provident_fund_kaupthing_empee', 'account_name');
                    echo $provident_fund_kaupthing_empee_account_name;
                    echo render_input('provident_fund_kaupthing_empee[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $provident_fund_kaupthing_empee_account_no = get_crew_payroll_new($candidate_id, 'provident_fund_kaupthing_empee', 'account_no');
                    echo $provident_fund_kaupthing_empee_account_no;
                    echo render_input('provident_fund_kaupthing_empee[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 14 row -->
        <!-- 15 row -->
        <?php
        $cash_advance_paid_onboard_can_view = get_option('cash_advance_paid_onboard_can_view');
        if ($cash_advance_paid_onboard_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('cash_advance_paid_onboard_shortcode') != '') {
                            $shortcode = '( ' . get_option('cash_advance_paid_onboard_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('cash_advance_paid_onboard'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $cash_advance_paid_onboard_rate = get_crew_payroll_new($candidate_id, 'cash_advance_paid_onboard', 'rate');
                    echo $cash_advance_paid_onboard_rate;
                    echo render_input('cash_advance_paid_onboard[]', '', '', 'number', ['step' => "0.01"], [], '', 'cash_advance_paid_onboard_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $cash_advance_paid_onboard_qty = get_crew_payroll_new($candidate_id, 'cash_advance_paid_onboard', 'qty');
                    echo $cash_advance_paid_onboard_qty;
                    echo render_input('cash_advance_paid_onboard[]', '', '', 'number', ['step' => "0.01"], [], '', 'cash_advance_paid_onboard_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $cash_advance_paid_onboard_amount = get_crew_payroll_new($candidate_id, 'cash_advance_paid_onboard', 'amount');
                    echo $cash_advance_paid_onboard_amount;
                    echo render_input('cash_advance_paid_onboard[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'cash_advance_paid_onboard_amount deduction'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $cash_advance_paid_onboard_remark = get_crew_payroll_new($candidate_id, 'cash_advance_paid_onboard', 'remark');
                    echo $cash_advance_paid_onboard_remark;
                    echo render_input('cash_advance_paid_onboard[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $cash_advance_paid_onboard_bank_name = get_crew_payroll_new($candidate_id, 'cash_advance_paid_onboard', 'bank_name');
                    echo $cash_advance_paid_onboard_bank_name;
                    echo render_input('cash_advance_paid_onboard[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $cash_advance_paid_onboard_account_name = get_crew_payroll_new($candidate_id, 'cash_advance_paid_onboard', 'account_name');
                    echo $cash_advance_paid_onboard_account_name;
                    echo render_input('cash_advance_paid_onboard[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $cash_advance_paid_onboard_account_no = get_crew_payroll_new($candidate_id, 'cash_advance_paid_onboard', 'account_no');
                    echo $cash_advance_paid_onboard_account_no;
                    echo render_input('cash_advance_paid_onboard[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 15 row -->
        <hr style="width: 100%; margin-left: 0px;border: 1px solid rgb(3,105,161);">
        <div class="col-sm-12" style="display: flex;">
            <div style="width: 12%; font-size: 17px; font-weight: bold;" class="text-center">Deduction - Private</div>
        </div>
        <div class="col-sm-12" style="display: flex; margin-top: 10px;">
            <div style="width: 7%; font-size: 17px;" class="text-center deduction_amount_private"></div>
        </div>
        <!-- duduction private -->
        <!-- 16 row -->
        <?php
        $other_deduction_1_can_view = get_option('other_deduction_1_can_view');
        if ($other_deduction_1_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('other_deduction_1_shortcode') != '') {
                            $shortcode = '( ' . get_option('other_deduction_1_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('other_deduction_1'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_1_rate = get_crew_payroll_new($candidate_id, 'other_deduction_1', 'rate');
                    echo $other_deduction_1_rate;
                    echo render_input('other_deduction_1[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_rate other_deduction_1_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_1_qty = get_crew_payroll_new($candidate_id, 'other_deduction_1', 'qty');
                    echo $other_deduction_1_qty;
                    echo render_input('other_deduction_1[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_1_amount = get_crew_payroll_new($candidate_id, 'other_deduction_1', 'amount');
                    echo $other_deduction_1_amount;
                    echo render_input('other_deduction_1[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'other_dedu_private_1_amount dedu_private'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_1_remark = get_crew_payroll_new($candidate_id, 'other_deduction_1', 'remark');
                    echo $other_deduction_1_remark;
                    echo render_input('other_deduction_1[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_1_bank_name = get_crew_payroll_new($candidate_id, 'other_deduction_1', 'bank_name');
                    echo $other_deduction_1_bank_name;
                    echo render_input('other_deduction_1[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_1_account_name = get_crew_payroll_new($candidate_id, 'other_deduction_1', 'account_name');
                    echo $other_deduction_1_account_name;
                    echo render_input('other_deduction_1[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_1_account_no = get_crew_payroll_new($candidate_id, 'other_deduction_1', 'account_no');
                    echo $other_deduction_1_account_no;
                    echo render_input('other_deduction_1[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 16 row -->
        <!-- 17 row -->
        <?php
        $other_deduction_2_can_view = get_option('other_deduction_2_can_view');
        if ($other_deduction_2_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('other_deduction_2_shortcode') != '') {
                            $shortcode = '( ' . get_option('other_deduction_2_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('other_deduction_2'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_2_rate = get_crew_payroll_new($candidate_id, 'other_deduction_2', 'rate');
                    echo $other_deduction_2_rate;
                    echo render_input('other_deduction_2[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_rate other_deduction_2_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_2_qty = get_crew_payroll_new($candidate_id, 'other_deduction_2', 'qty');
                    echo $other_deduction_2_qty;
                    echo render_input('other_deduction_2[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_2_amount = get_crew_payroll_new($candidate_id, 'other_deduction_2', 'amount');
                    echo $other_deduction_2_amount;
                    echo render_input('other_deduction_2[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'other_dedu_private_1_amount dedu_private'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_2_remark = get_crew_payroll_new($candidate_id, 'other_deduction_2', 'remark');
                    echo $other_deduction_2_remark;
                    echo render_input('other_deduction_2[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_2_bank_name = get_crew_payroll_new($candidate_id, 'other_deduction_2', 'bank_name');
                    echo $other_deduction_2_bank_name;
                    echo render_input('other_deduction_2[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_2_account_name = get_crew_payroll_new($candidate_id, 'other_deduction_2', 'account_name');
                    echo $other_deduction_2_account_name;
                    echo render_input('other_deduction_2[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_2_account_no = get_crew_payroll_new($candidate_id, 'other_deduction_2', 'account_no');
                    echo $other_deduction_2_account_no;
                    echo render_input('other_deduction_2[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 17 row -->
        <!-- 18 row -->
        <?php
        $other_deduction_3_can_view = get_option('other_deduction_3_can_view');
        if ($other_deduction_3_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('other_deduction_3_shortcode') != '') {
                            $shortcode = '( ' . get_option('other_deduction_3_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('other_deduction_3'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_3_rate = get_crew_payroll_new($candidate_id, 'other_deduction_3', 'rate');
                    echo $other_deduction_3_rate;
                    echo render_input('other_deduction_3[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_rate other_deduction_3_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_3_qty = get_crew_payroll_new($candidate_id, 'other_deduction_3', 'qty');
                    echo $other_deduction_3_qty;
                    echo render_input('other_deduction_3[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_3_amount = get_crew_payroll_new($candidate_id, 'other_deduction_3', 'amount');
                    echo $other_deduction_3_amount;
                    echo render_input('other_deduction_3[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'other_dedu_private_1_amount dedu_private'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_3_remark = get_crew_payroll_new($candidate_id, 'other_deduction_3', 'remark');
                    echo $other_deduction_3_remark;
                    echo render_input('other_deduction_3[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_3_bank_name = get_crew_payroll_new($candidate_id, 'other_deduction_3', 'bank_name');
                    echo $other_deduction_3_bank_name;
                    echo render_input('other_deduction_3[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_3_account_name = get_crew_payroll_new($candidate_id, 'other_deduction_3', 'account_name');
                    echo $other_deduction_3_account_name;
                    echo render_input('other_deduction_3[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_3_account_no = get_crew_payroll_new($candidate_id, 'other_deduction_3', 'account_no');
                    echo $other_deduction_3_account_no;
                    echo render_input('other_deduction_3[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 18 row -->
        <!-- 19 row -->
        <?php
        $other_deduction_4_can_view = get_option('other_deduction_4_can_view');
        if ($other_deduction_4_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('other_deduction_4_shortcode') != '') {
                            $shortcode = '( ' . get_option('other_deduction_4_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('other_deduction_4'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_4_rate = get_crew_payroll_new($candidate_id, 'other_deduction_4', 'rate');
                    echo $other_deduction_4_rate;
                    echo render_input('other_deduction_4[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_rate other_deduction_4_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_4_qty = get_crew_payroll_new($candidate_id, 'other_deduction_4', 'qty');
                    echo $other_deduction_4_qty;
                    echo render_input('other_deduction_4[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_4_amount = get_crew_payroll_new($candidate_id, 'other_deduction_4', 'amount');
                    echo $other_deduction_4_amount;
                    echo render_input('other_deduction_4[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'other_dedu_private_1_amount dedu_private'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_4_remark = get_crew_payroll_new($candidate_id, 'other_deduction_4', 'remark');
                    echo $other_deduction_4_remark;
                    echo render_input('other_deduction_4[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_4_bank_name = get_crew_payroll_new($candidate_id, 'other_deduction_4', 'bank_name');
                    echo $other_deduction_4_bank_name;
                    echo render_input('other_deduction_4[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_4_account_name = get_crew_payroll_new($candidate_id, 'other_deduction_4', 'account_name');
                    echo $other_deduction_4_account_name;
                    echo render_input('other_deduction_4[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_4_account_no = get_crew_payroll_new($candidate_id, 'other_deduction_4', 'account_no');
                    echo $other_deduction_4_account_no;
                    echo render_input('other_deduction_4[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 19 row -->
        <!-- 20 row -->
        <?php
        $other_deduction_5_can_view = get_option('other_deduction_5_can_view');
        if ($other_deduction_5_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('other_deduction_5_shortcode') != '') {
                            $shortcode = '( ' . get_option('other_deduction_5_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('other_deduction_5'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_5_rate = get_crew_payroll_new($candidate_id, 'other_deduction_5', 'rate');
                    echo $other_deduction_5_rate;
                    echo render_input('other_deduction_5[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_rate other_deduction_5_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_5_qty = get_crew_payroll_new($candidate_id, 'other_deduction_5', 'qty');
                    echo $other_deduction_5_qty;
                    echo render_input('other_deduction_5[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_5_amount = get_crew_payroll_new($candidate_id, 'other_deduction_5', 'amount');
                    echo $other_deduction_5_amount;
                    echo render_input('other_deduction_5[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'other_dedu_private_1_amount dedu_private'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_5_remark = get_crew_payroll_new($candidate_id, 'other_deduction_5', 'remark');
                    echo $other_deduction_5_remark;
                    echo render_input('other_deduction_5[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_5_bank_name = get_crew_payroll_new($candidate_id, 'other_deduction_5', 'bank_name');
                    echo $other_deduction_5_bank_name;
                    echo render_input('other_deduction_5[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_5_account_name = get_crew_payroll_new($candidate_id, 'other_deduction_5', 'account_name');
                    echo $other_deduction_5_account_name;
                    echo render_input('other_deduction_5[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_5_account_no = get_crew_payroll_new($candidate_id, 'other_deduction_5', 'account_no');
                    echo $other_deduction_5_account_no;
                    echo render_input('other_deduction_5[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 20 row -->
        <!-- 21 row -->
        <?php
        $other_deduction_6_can_view = get_option('other_deduction_6_can_view');
        if ($other_deduction_6_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('other_deduction_6_shortcode') != '') {
                            $shortcode = '( ' . get_option('other_deduction_6_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('other_deduction_6'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_6_rate = get_crew_payroll_new($candidate_id, 'other_deduction_6', 'rate');
                    echo $other_deduction_6_rate;
                    echo render_input('other_deduction_6[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_rate other_deduction_6_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_6_qty = get_crew_payroll_new($candidate_id, 'other_deduction_6', 'qty');
                    echo $other_deduction_6_qty;
                    echo render_input('other_deduction_6[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_6_amount = get_crew_payroll_new($candidate_id, 'other_deduction_6', 'amount');
                    echo $other_deduction_6_amount;
                    echo render_input('other_deduction_6[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'other_dedu_private_1_amount dedu_private'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_6_remark = get_crew_payroll_new($candidate_id, 'other_deduction_6', 'remark');
                    echo $other_deduction_6_remark;
                    echo render_input('other_deduction_6[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_6_bank_name = get_crew_payroll_new($candidate_id, 'other_deduction_6', 'bank_name');
                    echo $other_deduction_6_bank_name;
                    echo render_input('other_deduction_6[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_6_account_name = get_crew_payroll_new($candidate_id, 'other_deduction_6', 'account_name');
                    echo $other_deduction_6_account_name;
                    echo render_input('other_deduction_6[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_6_account_no = get_crew_payroll_new($candidate_id, 'other_deduction_6', 'account_no');
                    echo $other_deduction_6_account_no;
                    echo render_input('other_deduction_6[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 21 row -->
        <!-- 22 row -->
        <?php
        $other_deduction_7_can_view = get_option('other_deduction_7_can_view');
        if ($other_deduction_7_can_view == 1) {
        ?>
            <div class="col-sm-12" style="display: flex; margin-top: 10px;">
                <div style="width: 7%;"></div>
                <div style="width: 15%;" class="text-center">
                    <p class="tab_text" style="margin: 0px;">
                        <?php
                        $shortcode = '';
                        if (get_option('other_deduction_7_shortcode') != '') {
                            $shortcode = '( ' . get_option('other_deduction_7_shortcode') . ' )';
                        }
                        ?>
                        <?php echo $shortcode . get_option('other_deduction_7'); ?>
                    </p>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_7_rate = get_crew_payroll_new($candidate_id, 'other_deduction_7', 'rate');
                    echo $other_deduction_7_rate;
                    echo render_input('other_deduction_7[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_rate other_deduction_7_rate'); ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_7_qty = get_crew_payroll_new($candidate_id, 'other_deduction_7', 'qty');
                    echo $other_deduction_7_qty;
                    echo render_input('other_deduction_7[]', '', '', 'number', ['step' => "0.01"], [], '', 'other_dedu_private_1_qty');
                    ?>
                </div>
                <div style="width: 8%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_7_amount = get_crew_payroll_new($candidate_id, 'other_deduction_7', 'amount');
                    echo $other_deduction_7_amount;
                    echo render_input('other_deduction_7[]', '', '', 'number', ['step' => "0.01", 'readonly' => 'readonly'], [], '', 'other_dedu_private_1_amount dedu_private'); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_7_remark = get_crew_payroll_new($candidate_id, 'other_deduction_7', 'remark');
                    echo $other_deduction_7_remark;
                    echo render_input('other_deduction_7[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_7_bank_name = get_crew_payroll_new($candidate_id, 'other_deduction_7', 'bank_name');
                    echo $other_deduction_7_bank_name;
                    echo render_input('other_deduction_7[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_7_account_name = get_crew_payroll_new($candidate_id, 'other_deduction_7', 'account_name');
                    echo $other_deduction_7_account_name;
                    echo render_input('other_deduction_7[]', '', ''); ?>
                </div>
                <div style="width: 15%; padding: 0px 10px;" class="text-center">
                    <?php
                    $other_deduction_7_account_no = get_crew_payroll_new($candidate_id, 'other_deduction_7', 'account_no');
                    echo $other_deduction_7_account_no;
                    echo render_input('other_deduction_7[]', '', ''); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- 22 row -->
        <!-- duduction private -->
        <div class="col-sm-12">
            <button class="btn btn-info" style="float: right;" type="submit">Save Setup value</button>
        </div>
        <?php echo  form_close(); ?>
    </div>
</div>

<div role="tabpanel" class="tab-pane" id="eargings">
    <h1>asdcvasvc</h1>
</div>
<div role="tabpanel" class="tab-pane" id="deduction">
    <div class="row">
        <div class="col-sm-12">
            <button class="btn btn-primary" style="margin-bottom: 10px;" data-toggle="modal" data-target="#addDeductionModal">Add</button>
            <?php
            render_datatable([
                _l('id'),
                _l('active'),
                _l('deduction_name'),
                _l('bank_acc'),
                _l('amount'),
                _l('deduction_memo'),
                _l('file_attachment'),
                _l('remarks'),
                _l('action'),
            ], 'deduction_table');
            ?>

        </div>
    </div>
</div>

<div class="modal fade" id="addDeductionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open_multipart(admin_url('crew_payroll/add_update_deduction'), array('id' => 'deduction-form')); ?>
        <div class="modal-content width-100">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span id="on_board_company_label"><?php echo _l('add_deduction'); ?></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="deduction_id" name="deduction_id">
                    <input type="hidden" id="candidate_id" name="candidate_id" value="<?php echo $candidate_id; ?>">
                    <div class="col-sm-12" style="margin-bottom: 10px;">
                        <input type="checkbox" id="status" name="status" value="1" style="margin: 0 5px;"><label for="status">Active</label>
                    </div>
                    <div class="col-sm-12">
                        <?php echo render_input('name', _l('deduction_name')); ?>
                    </div>
                    <div class="col-sm-12">
                        <?php echo render_input('bank_acc', _l('bank_acc')); ?>
                    </div>
                    <div class="col-sm-12">
                        <?php echo render_input('amount', _l('amount'), '', 'number'); ?>
                    </div>
                    <div class="col-sm-12">
                        <?php echo render_input('deduction_memo', _l('deduction_memo')); ?>
                    </div>
                    <div class="col-sm-12">
                        <?php echo render_input('file', _l('file'), '', 'file'); ?>
                    </div>
                    <div class="col-sm-12" style="display: none;" id="edit_deduction_file">
                    </div>
                    <div class="col-sm-12">
                        <?php echo render_input('remark', _l('remarks')); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button id="sm_btn_conpany" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>