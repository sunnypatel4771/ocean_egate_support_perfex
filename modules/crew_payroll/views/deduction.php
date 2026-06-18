<div role="tabpanel" class="tab-pane" id="payroll_setup">

    <?php
    add_payroll_setup_total($candidate_id);
    ?>
    <div class="row">
        <div class="col-sm-12" style="margin-bottom: 10px;">
            <!-- <p>Total Receiving : <span id="total_receiving"></span></p>
            <button class="pull-right btn btn-danger" id="process_payroll_btn" data-candidate_id="<?php echo $candidate_id; ?>">Process Payroll</button> -->
            <!-- <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-3" style="text-align: center;">
                    <span style="color: blue; font-size: 20px;  padding: 8px; border-radius: 5px; border: 2px solid blue;">Net Income : <span id="total_receiving" style="color: red;"></span></span>
                </div>
                <div class="col-sm-1">
                    <button class="pull-right btn btn-danger" id="process_payroll_btn" data-candidate_id="<?php echo $candidate_id; ?>">Process Payroll</button>
                </div>
            </div> -->
        </div>
        <div class="col-sm-12">

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <p style="font-size: 15px;"><span style="font-weight: bolder; font-size: 16px;">Total Earnings :</span> <span id="earnings" style="color: blue;"></span></p>

                <div class="row">
                    <!-- <div class="col-sm-8"></div> -->
                    <div class="col-sm-8" style="text-align: center; margin-top: 5px;">
                        <span style="color: blue; font-size: 16px;  padding: 6px; border-radius: 5px; border: 2px solid blue;">Net Income : <span id="total_receiving" style="color: red;"></span></span>
                    </div>
                    <div class="col-sm-4">
                        <button class="pull-right btn btn-danger" id="process_payroll_btn" data-candidate_id="<?php echo $candidate_id; ?>">Process Payroll</button>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; gap: 40px; align-items: center; font-size: 15px;">
                    <?php
                    $candidate_payroll_selection_detail = get_candidate_payroll_selection_detail($candidate_id);
                    if (!empty($candidate_payroll_selection_detail)) {
                        if (isset($candidate_payroll_selection_detail['vessel'])) {
                            echo "<p style='margin: 0;'>Vessel : <span style='color: blue;'>" . $candidate_payroll_selection_detail['vessel'] . "</span></p>";
                        }

                        if (isset($candidate_payroll_selection_detail['rank'])) {
                            echo "<p style='margin: 0;'>Rank : <span class='candidate_payroll_selection_detail_rank' style='color: blue;'>" . $candidate_payroll_selection_detail['rank'] . "</span></p>";
                        }
                    }
                    ?>
                    <button style="padding-top: 3px; padding-bottom: 3px;" class="edit_payroll_setup btn btn-info" data-type="earning" data-candidate_id="<?php echo $candidate_id; ?>">
                        Edit Income Details
                    </button>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-1">

        </div> -->
        <div class="col-sm-12">
            <?php
            echo show_crew_earning_table($candidate_id, 'earning');
            ?>
            <!-- <p style="font-size: 17px; color: red;">Earnings Total : <?php echo get_payroll_setup_total($candidate_id, 'earnings_total'); ?></p> -->
            <!-- <hr> -->
            <div style="display: flex; gap: 40px; justify-content: space-between;">
                <span style="font-size: 15px;"><span style="font-weight: bolder;"> Deduction - Official :</span> <span id="deduction_official" style="color: red;"></span></span>
                <button style="padding-top: 3px; padding-bottom: 3px;" class="edit_payroll_setup btn btn-info" data-type="deduction_official" data-candidate_id="<?php echo $candidate_id; ?>">Edit Deduction Official</button>
            </div>
        </div>

        <div class="col-sm-12">
            <?php echo show_crew_earning_table($candidate_id, 'deduction_official'); ?>
            <!-- <p style="font-size: 17px; color: red;">Deduction Official Total : <?php echo get_payroll_setup_total($candidate_id, 'deduction_official_total'); ?></p> -->
            <!-- <hr> -->
            <div style="display: flex; gap: 40px; justify-content: space-between;">
                <span style="font-size: 15px;"><span style="font-weight: bolder;"> Deduction - Private :</span> <span id="deduction_private" style="color: red;"></span></span>
                <button style="padding-top: 3px; padding-bottom: 3px;" class="edit_payroll_setup btn btn-info" data-type="deduction_private" data-candidate_id="<?php echo $candidate_id; ?>">Edit Deduction Private</button>
            </div>
        </div>

        <div class="col-sm-12">
            <?php echo show_crew_earning_table($candidate_id, 'deduction_private'); ?>
            <!-- <p style="font-size: 17px; color: red;">Deduction Private Total : <?php echo get_payroll_setup_total($candidate_id, 'deduction_private_total'); ?></p> -->
        </div>
    </div>
</div>

<div role="tabpanel" class="tab-pane" id="payroll_history">
    <?php $payroll_history_data = get_payroll_history_data($candidate_id); ?>
    <table class="table table-bordered dt-table dt-inline dataTable no-footer" data-order-col="3" data-order-type="desc">
        <thead>
            <tr>
                <th>Id</th>
                <th>Payroll Reference</th>
                <th></th>
                <th>From</th>
                <th>To</th>
                <th>Days</th>
                <th>Exchange Rate</th>
                <th title="<?php echo get_option('basic_wages_onb_shortcode') ?>"><?php echo get_option('basic_wages_onb'); ?></th>
                <th title="<?php echo get_option('basic_wages_trv_shortcode') ?>"><?php echo get_option('basic_wages_trv'); ?></th>
                <th title="<?php echo get_option('leave_shortcode') ?>"><?php echo get_option('leave'); ?></th>
                <th title="<?php echo get_option('education_allowance_shortcode') ?>"><?php echo get_option('education_allowance'); ?></th>
                <th title="<?php echo get_option('guranteed_overtime_shortcode') ?>"><?php echo get_option('guranteed_overtime'); ?></th>
                <th title="<?php echo get_option('operational_allowance_shortcode') ?>"><?php echo get_option('operational_allowance'); ?></th>
                <th title="<?php echo get_option('supplementary_allowance_shortcode') ?>"><?php echo get_option('supplementary_allowance'); ?></th>
                <th title="<?php echo get_option('owners_bonus_shortcode') ?>"><?php echo get_option('owners_bonus'); ?></th>
                <th title="<?php echo get_option('other_earnings_1_shortcode') ?>"><?php echo get_option('other_earnings_1'); ?></th>
                <th title="<?php echo get_option('other_earnings_2_shortcode') ?>"><?php echo get_option('other_earnings_2'); ?></th>

                <th>Earnings Total</th>

                <th title="<?php echo get_option('philhelth_empee_shortcode') ?>" style="color: red;"><?php echo get_option('philhelth_empee'); ?></th>
                <th title="<?php echo get_option('social_security_system_empee_shortcode') ?>" style="color: red;"><?php echo get_option('social_security_system_empee'); ?></th>
                <th title="<?php echo get_option('slopchest_shortcode') ?>" style="color: red;"><?php echo get_option('slopchest'); ?></th>
                <th title="<?php echo get_option('pag_lbig_housing_program_empee_shortcode') ?>" style="color: red;"><?php echo get_option('pag_lbig_housing_program_empee'); ?></th>
                <th title="<?php echo get_option('sss_mandatory_provident_fund_empee_shortcode') ?>" style="color: red;"><?php echo get_option('sss_mandatory_provident_fund_empee'); ?></th>
                <th title="<?php echo get_option('provident_fund_kaupthing_empee_shortcode') ?>" style="color: red;"><?php echo get_option('provident_fund_kaupthing_empee'); ?></th>
                <th title="<?php echo get_option('cash_advance_paid_onboard_shortcode') ?>" style="color: red;"><?php echo get_option('cash_advance_paid_onboard'); ?></th>

                <th style="color: red;">Deduction Official Total</th>

                <th title="<?php echo get_option('other_deduction_1_shortcode') ?>" style="color: blue;"><?php echo get_option('other_deduction_1'); ?></th>
                <th title="<?php echo get_option('other_deduction_2_shortcode') ?>" style="color: blue;"><?php echo get_option('other_deduction_2'); ?></th>
                <th title="<?php echo get_option('other_deduction_3_shortcode') ?>" style="color: blue;"><?php echo get_option('other_deduction_3'); ?></th>
                <th title="<?php echo get_option('other_deduction_4_shortcode') ?>" style="color: blue;"><?php echo get_option('other_deduction_4'); ?></th>
                <th title="<?php echo get_option('other_deduction_5_shortcode') ?>" style="color: blue;"><?php echo get_option('other_deduction_5'); ?></th>
                <th title="<?php echo get_option('other_deduction_6_shortcode') ?>" style="color: blue;"><?php echo get_option('other_deduction_6'); ?></th>
                <th title="<?php echo get_option('other_deduction_7_shortcode') ?>" style="color: blue;"><?php echo get_option('other_deduction_7'); ?></th>
                <th style="color: blue;">Deduction Private Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payroll_history_data as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['id']; ?></td>
                    <td><?php echo $value['payroll_reference']; ?></td>
                    <td><a href="<?php echo admin_url('crew_payroll/payroll_history_pdf/' . $value['id']); ?>" class="btn btn-default btn-with-tooltip"><i class="fa fa-print"></i></a></td>
                    <td style="text-wrap: nowrap;"><?php echo $value['from']; ?></td>
                    <td style="text-wrap: nowrap;"><?php echo $value['to']; ?></td>
                    <td><?php echo $value['days']; ?></td>
                    <td><?php echo $value['exchange_rate']; ?></td>
                    <td><?php echo number_format($value['basic_wages_onb']); ?></td>
                    <td><?php echo number_format($value['basic_wages_trv']); ?></td>
                    <td><?php echo number_format($value['leave']); ?></td>
                    <td><?php echo number_format($value['education_allowance']); ?></td>
                    <td><?php echo number_format($value['guranteed_overtime']); ?></td>
                    <td><?php echo number_format($value['operational_allowance']); ?></td>
                    <td><?php echo number_format($value['supplementary_allowance']); ?></td>
                    <td><?php echo number_format($value['owners_bonus']); ?></td>
                    <td><?php echo number_format($value['other_earnings_1']); ?></td>
                    <td><?php echo number_format($value['other_earnings_2']); ?></td>

                    <td><?php echo get_payroll_setup_total($candidate_id, 'earnings_total'); ?></td>

                    <td><?php echo number_format($value['philhelth_empee']); ?></td>
                    <td><?php echo number_format($value['social_security_system_empee']); ?></td>
                    <td><?php echo number_format($value['slopchest']); ?></td>
                    <td><?php echo number_format($value['pag_lbig_housing_program_empee']); ?></td>
                    <td><?php echo number_format($value['sss_mandatory_provident_fund_empee']); ?></td>
                    <td><?php echo number_format($value['provident_fund_kaupthing_empee']); ?></td>
                    <td><?php echo number_format($value['cash_advance_paid_onboard']); ?></td>

                    <td><?php echo get_payroll_setup_total($candidate_id, 'deduction_official_total'); ?></td>

                    <td><?php echo number_format($value['other_deduction_1']); ?></td>
                    <td><?php echo number_format($value['other_deduction_2']); ?></td>
                    <td><?php echo number_format($value['other_deduction_3']); ?></td>
                    <td><?php echo number_format($value['other_deduction_4']); ?></td>
                    <td><?php echo number_format($value['other_deduction_5']); ?></td>
                    <td><?php echo number_format($value['other_deduction_6']); ?></td>
                    <td><?php echo number_format($value['other_deduction_7']); ?></td>

                    <td><?php echo get_payroll_setup_total($candidate_id, 'deduction_private_total'); ?></td>
                    <td>
                        <button class="edit_payroll_history" data-id="<?php echo $value['id']; ?>" style="border: none; background: none;">
                            <i class="fa fa-edit"></i>
                        </button>
                        <a href="<?php echo admin_url('crew_payroll/delete_payroll_history/' . $value['id'] . '/' . $value['candidate_id']); ?>" class="_delete " style="border: none; background: none;">
                            <i class="fa-regular fa-trash-can fa-lg" style="color: red;"></i>
                        </a>
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>

</div>

<div role="tabpanel" class="tab-pane" id="eargings">
    <h1></h1>
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

<div class="modal fade" id="edit_payroll_setup_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
        <?php echo form_open_multipart(admin_url('crew_payroll/save_payroll_setup')); ?>
        <div class="modal-content width-100">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span id="on_board_company_label">Update Wage Setup</span>
                </h4>
            </div>
            <div class="modal-body">

                <?php
                $payroll_table_dropdown = get_payroll_table_list_for_dropdown();
                $crew_saved_payroll_data = get_crew_saved_payroll_data($candidate->payroll_table_id);
                ?>
                <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate->id; ?>">
                <input type="hidden" name="vessel_code" id="vessel_code">
                <input type="hidden" name="rank_code" id="rank_code">
                <div class="row select_payroll_code_dropdowns_box" style="width: 100%;">
                    <div class="col-sm-3" style="padding: 7px; font-size: 16px; padding-left: 40px;">Select Wage Code</div>
                    <!-- <div class="col-sm-3">
                        <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate->id; ?>">
                        <?php
                        // $id = isset($crew_saved_payroll_data['id']) ? $crew_saved_payroll_data['id'] : '';
                        // $id = '';
                        // echo render_select('select_payroll_code', $payroll_table_dropdown, ['id', 'code'], '', $id);
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <?php
                        // $rank = isset($crew_saved_payroll_data['rank']) ? $crew_saved_payroll_data['rank'] : '';
                        // $rank = '';
                        // echo render_input('select_payroll_rank', '', $rank, 'text', ['readonly' => 'readonly']);
                        ?>
                    </div> -->
                    <?php
                    $candidate_payroll_selection_detail = get_candidate_payroll_selection_detail($candidate_id);
                    ?>
                    <div class="col-sm-3">
                        <?php
                        $vessel_code_options = get_vessel_code_options();
                        ?>
                        <select id="vessel_code_selecter" class="selectpicker">
                            <option value="">Select vessel</option>
                            <?php
                            if (!empty($vessel_code_options)) {
                                foreach ($vessel_code_options as $key => $value) {
                                    if ($value['Name'] == $candidate_payroll_selection_detail['vessel']) {
                                        echo '<option value="' . $value['id'] . '" selected>' . $value['Name'] . '</option>';
                                    } else {
                                        echo '<option value="' . $value['id'] . '">' . $value['Name'] . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <?php
                        // $rank_code_options = get_rank_code_options();
                        ?>
                        <!-- <select id="rank_code_selecter" class="selectpicker">
                            <option value="">Select Rank</option> -->
                        <?php
                        // if (!empty($rank_code_options)) {
                        //     foreach ($rank_code_options as $key => $value) { 
                        ?>
                        <!-- <option value="<?php echo $value['id']; ?>"><?php echo $value['Name']; ?></option> -->
                        <?php
                        // }
                        // }
                        ?>
                        <!-- </select> -->
                        <select name="" id="rank_code_selecter" class="selectpicker">

                        </select>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 modal_table"></div>
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

<div class="modal fade" id="select_payroll_period_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content width-100">
            <?php echo form_open_multipart(admin_url('crew_payroll/add_payroll_history')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span id="on_board_company_label">Select Payroll Period</span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id; ?>">
                    <div class="col-sm-12 payroll_period_div">

                    </div>

                    <div class="col-sm-12 summary_payroll_history_div" style="margin-top: 20px;">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="candidate_id" id="candidate_id">
                                <input type="hidden" name="from" id="from">
                                <input type="hidden" name="to" id="to">
                                <input type="hidden" name="days" id="days">
                                <input type="hidden" name="payroll_reference" id="payroll_reference">
                                <input type="hidden" name="exchange_rate" id="exchange_rate">
                                <input type="hidden" name="basic_wages_onb" id="basic_wages_onb">
                                <input type="hidden" name="basic_wages_trv" id="basic_wages_trv">
                                <input type="hidden" name="leave" id="leave">
                                <input type="hidden" name="education_allowance" id="education_allowance">
                                <input type="hidden" name="guranteed_overtime" id="guranteed_overtime">
                                <input type="hidden" name="operational_allowance" id="operational_allowance">
                                <input type="hidden" name="supplementary_allowance" id="supplementary_allowance">
                                <input type="hidden" name="owners_bonus" id="owners_bonus">
                                <input type="hidden" name="other_earnings_1" id="other_earnings_1">
                                <input type="hidden" name="other_earnings_2" id="other_earnings_2">
                                <input type="hidden" name="philhelth_empee" id="philhelth_empee">
                                <input type="hidden" name="social_security_system_empee" id="social_security_system_empee">
                                <input type="hidden" name="slopchest" id="slopchest">
                                <input type="hidden" name="pag_lbig_housing_program_empee" id="pag_lbig_housing_program_empee">
                                <input type="hidden" name="sss_mandatory_provident_fund_empee" id="sss_mandatory_provident_fund_empee">
                                <input type="hidden" name="provident_fund_kaupthing_empee" id="provident_fund_kaupthing_empee">
                                <input type="hidden" name="cash_advance_paid_onboard" id="cash_advance_paid_onboard">
                                <input type="hidden" name="other_deduction_1" id="other_deduction_1">
                                <input type="hidden" name="other_deduction_2" id="other_deduction_2">
                                <input type="hidden" name="other_deduction_3" id="other_deduction_3">
                                <input type="hidden" name="other_deduction_4" id="other_deduction_4">
                                <input type="hidden" name="other_deduction_5" id="other_deduction_5">
                                <input type="hidden" name="other_deduction_6" id="other_deduction_6">
                                <input type="hidden" name="other_deduction_7" id="other_deduction_7">
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12" style="font-weight: bold; text-align: center; margin-bottom: 10px;">Earnings </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('basic_wages_onb'); ?></div>
                                    <div class="col-sm-6 basic_wages_onb_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('basic_wages_trv'); ?></div>
                                    <div class="col-sm-6 basic_wages_trv_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('leave'); ?></div>
                                    <div class="col-sm-6 leave_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('education_allowance'); ?></div>
                                    <div class="col-sm-6 education_allowance_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('guranteed_overtime'); ?></div>
                                    <div class="col-sm-6 guranteed_overtime_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('operational_allowance'); ?></div>
                                    <div class="col-sm-6 operational_allowance_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('supplementary_allowance'); ?></div>
                                    <div class="col-sm-6 supplementary_allowance_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('owners_bonus'); ?></div>
                                    <div class="col-sm-6 owners_bonus_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('other_earnings_1'); ?></div>
                                    <div class="col-sm-6 other_earnings_1_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('other_earnings_2'); ?></div>
                                    <div class="col-sm-6 other_earnings_2_text" style="text-align: right;"></div>
                                </div>

                                <!-- <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;">Earnings Total : </div>
                                    <div class="col-sm-6" style="text-align: right;"><?php echo get_payroll_setup_total($candidate_id, 'earnings_total'); ?></div>
                                </div> -->
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12" style="font-weight: bold; text-align: center; margin-bottom: 10px;">
                                        Deduction - Official
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('philhelth_empee'); ?></div>
                                    <div class="col-sm-6 philhelth_empee_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('social_security_system_empee'); ?></div>
                                    <div class="col-sm-6 social_security_system_empee_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('slopchest'); ?></div>
                                    <div class="col-sm-6 slopchest_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('pag_lbig_housing_program_empee'); ?></div>
                                    <div class="col-sm-6 pag_lbig_housing_program_empee_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('sss_mandatory_provident_fund_empee'); ?></div>
                                    <div class="col-sm-6 sss_mandatory_provident_fund_empee_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('provident_fund_kaupthing_empee'); ?></div>
                                    <div class="col-sm-6 provident_fund_kaupthing_empee_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('cash_advance_paid_onboard'); ?></div>
                                    <div class="col-sm-6 cash_advance_paid_onboard_text" style="text-align: right;"></div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;">Deduction Official Total : </div>
                                    <div class="col-sm-6" style="text-align: right;"><?php echo get_payroll_setup_total($candidate_id, 'deduction_official_total'); ?></div>
                                </div> -->
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12" style="font-weight: bold; text-align: center; margin-bottom: 10px;">Deduction - Private </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('other_deduction_1'); ?></div>
                                    <div class="col-sm-6 other_deduction_1_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('other_deduction_2'); ?></div>
                                    <div class="col-sm-6 other_deduction_2_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('other_deduction_3'); ?></div>
                                    <div class="col-sm-6 other_deduction_3_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('other_deduction_4'); ?></div>
                                    <div class="col-sm-6 other_deduction_4_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('other_deduction_5'); ?></div>
                                    <div class="col-sm-6 other_deduction_5_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('other_deduction_6'); ?></div>
                                    <div class="col-sm-6 other_deduction_6_text" style="text-align: right;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;"><?php echo get_option('other_deduction_7'); ?></div>
                                    <div class="col-sm-6 other_deduction_7_text" style="text-align: right;"></div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;">Deduction Private Total : </div>
                                    <div class="col-sm-6" style="text-align: right;"><?php echo get_payroll_setup_total($candidate_id, 'deduction_private_total'); ?></div>
                                </div> -->
                            </div>

                        </div>

                        <div class="row" style="margin-top: 15px; font-size: 16px;">
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;">Earnings Total : </div>
                                    <div class="col-sm-6" style="text-align: right; color: red;"><?php echo get_payroll_setup_total($candidate_id, 'earnings_total'); ?></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;">Deduction Official Total : </div>
                                    <div class="col-sm-6" style="text-align: right; color: red;"><?php echo get_payroll_setup_total($candidate_id, 'deduction_official_total'); ?></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-6" style="text-wrap: nowrap;">Deduction Private Total : </div>
                                    <div class="col-sm-6" style="text-align: right; color: red;"><?php echo get_payroll_setup_total($candidate_id, 'deduction_private_total'); ?></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="button" id="save_payroll_history_btn" class="btn btn-info">Select</button>
                <button type="submit" id="save_payroll_history" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_payroll_history_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content width-100">
            <?php echo form_open_multipart(admin_url('crew_payroll/update_payroll_history')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span id="on_board_company_label">Edit Payroll History</span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id; ?>">

                    <div class="col-sm-4">
                        <?php
                        echo render_date_input('from', _l('from'));
                        ?>
                    </div>

                    <div class="col-sm-4">
                        <?php
                        echo render_date_input('to', _l('to'));
                        ?>
                    </div>

                    <div class="col-sm-4">
                        <?php
                        echo render_input('days', _l('days'), '', 'number', ['readonly' => 'readonly']);
                        ?>
                    </div>

                    <div class="col-sm-12">
                        <h4 style="font-weight: bold;">Earnings </h4>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('basic_wages_onb', get_option('basic_wages_onb'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('basic_wages_trv', get_option('basic_wages_trv'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('leave', get_option('leave'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('education_allowance', get_option('education_allowance'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('guranteed_overtime', get_option('guranteed_overtime'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('operational_allowance', get_option('operational_allowance'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('supplementary_allowance', get_option('supplementary_allowance'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('owners_bonus', get_option('owners_bonus'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('other_earnings_1', get_option('other_earnings_1'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('other_earnings_2', get_option('other_earnings_2'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-12">
                        <h4 style="font-weight: bold;">Deduction - Official </h4>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('philhelth_empee', get_option('philhelth_empee'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('social_security_system_empee', get_option('social_security_system_empee'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('slopchest', get_option('slopchest'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('pag_lbig_housing_program_empee', get_option('pag_lbig_housing_program_empee'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('sss_mandatory_provident_fund_empee', get_option('sss_mandatory_provident_fund_empee'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('provident_fund_kaupthing_empee', get_option('provident_fund_kaupthing_empee'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('cash_advance_paid_onboard', get_option('cash_advance_paid_onboard'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-12">
                        <h4 style="font-weight: bold;">Deduction - Private </h4>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('other_deduction_1', get_option('other_deduction_1'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('other_deduction_2', get_option('other_deduction_2'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('other_deduction_3', get_option('other_deduction_3'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('other_deduction_4', get_option('other_deduction_4'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('other_deduction_5', get_option('other_deduction_5'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('other_deduction_6', get_option('other_deduction_6'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo render_input('other_deduction_7', get_option('other_deduction_7'), '', 'number'); ?>
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

<!-- <div class="modal fade" id="summary_payroll_history_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content width-100">
            <?php // echo form_open_multipart(admin_url('crew_payroll/add_payroll_history')); 
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span id="on_board_company_label"></span>
                </h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
            <?php // echo form_close(); 
            ?>
        </div>
    </div>
</div> -->