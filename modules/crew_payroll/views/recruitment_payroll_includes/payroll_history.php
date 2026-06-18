<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-2" style="text-align: center; margin-top: 7px;">
                <label for="payroll_reference_filter">Payroll Reference</label>
            </div>

            <div class="col-sm-2">
                <?php
                $payroll_reference_filter = '';
                if (!empty($_GET)) {
                    $payroll_reference_filter = isset($_GET['payroll_reference_filter']) ? $_GET['payroll_reference_filter'] : '';
                }
                ?>
                <input type="number" class="form-control" id="payroll_reference_filter" value="<?php echo $payroll_reference_filter; ?>">
            </div>

            <div class="col-sm-1" style="text-align: right; margin-top: 7px;">
                <label for="from_filter">From</label>
            </div>

            <div class="col-sm-2">
                <?php
                $from_filter = '';
                if (!empty($_GET)) {
                    $from_filter = isset($_GET['from_filter']) ? $_GET['from_filter'] : '';
                }
                ?>
                <div class="input-group date">
                    <input type="text" class="form-control datepicker" id="from_filter" value="<?php echo $from_filter; ?>">
                    <div class="input-group-addon">
                        <i class="fa-regular fa-calendar calendar-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-sm-1" style="text-align: right; margin-top: 7px;">
                <label for="to_filter">To</label>
            </div>

            <div class="col-sm-2">
                <?php
                $to_filter = '';
                if (!empty($_GET)) {
                    $to_filter = isset($_GET['to_filter']) ? $_GET['to_filter'] : '';
                }
                ?>
                <div class="input-group date">
                    <input type="text" class="form-control datepicker" id="to_filter" value="<?php echo $to_filter; ?>">
                    <div class="input-group-addon">
                        <i class="fa-regular fa-calendar calendar-icon"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-sm-12" style="margin-top: 10px;">
        <?php $candidate_payroll_history = get_all_candidate_payroll_history($_GET); ?>
        <table class="table table-bordered dt-table dt-inline dataTable no-footer" data-order-col="4" data-order-type="desc">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Payroll Reference</th>
                    <th></th>
                    <th>From</th>
                    <th>To</th>
                    <th>Days</th>
                    <th title="<?php echo get_option('basic_wages_onb_shortcode'); ?>"><?php echo get_option('basic_wages_onb'); ?></th>
                    <th title="<?php echo get_option('basic_wages_trv_shortcode'); ?>"><?php echo get_option('basic_wages_trv'); ?></th>
                    <th title="<?php echo get_option('leave_shortcode'); ?>"><?php echo get_option('leave'); ?></th>
                    <th title="<?php echo get_option('education_allowance_shortcode'); ?>"><?php echo get_option('education_allowance'); ?></th>
                    <th title="<?php echo get_option('guranteed_overtime_shortcode'); ?>"><?php echo get_option('guranteed_overtime'); ?></th>
                    <th title="<?php echo get_option('operational_allowance_shortcode'); ?>"><?php echo get_option('operational_allowance'); ?></th>
                    <th title="<?php echo get_option('supplementary_allowance_shortcode'); ?>"><?php echo get_option('supplementary_allowance'); ?></th>
                    <th title="<?php echo get_option('owners_bonus_shortcode'); ?>"><?php echo get_option('owners_bonus'); ?></th>
                    <th title="<?php echo get_option('other_earnings_1_shortcode'); ?>"><?php echo get_option('other_earnings_1'); ?></th>
                    <th title="<?php echo get_option('other_earnings_2_shortcode'); ?>"><?php echo get_option('other_earnings_2'); ?></th>

                    <th title="<?php echo get_option('philhelth_empee_shortcode'); ?>" style="color: red;"><?php echo get_option('philhelth_empee'); ?></th>
                    <th title="<?php echo get_option('social_security_system_empee_shortcode'); ?>" style="color: red;"><?php echo get_option('social_security_system_empee'); ?></th>
                    <th title="<?php echo get_option('slopchest_shortcode'); ?>" style="color: red;"><?php echo get_option('slopchest'); ?></th>
                    <th title="<?php echo get_option('pag_lbig_housing_program_empee_shortcode'); ?>" style="color: red;"><?php echo get_option('pag_lbig_housing_program_empee'); ?></th>
                    <th title="<?php echo get_option('sss_mandatory_provident_fund_empee_shortcode'); ?>" style="color: red;"><?php echo get_option('sss_mandatory_provident_fund_empee'); ?></th>
                    <th title="<?php echo get_option('provident_fund_kaupthing_empee_shortcode'); ?>" style="color: red;"><?php echo get_option('provident_fund_kaupthing_empee'); ?></th>
                    <th title="<?php echo get_option('cash_advance_paid_onboard_shortcode'); ?>" style="color: red;"><?php echo get_option('cash_advance_paid_onboard'); ?></th>

                    <th title="<?php echo get_option('other_deduction_1_shortcode'); ?>" style="color: blue;"><?php echo get_option('other_deduction_1'); ?></th>
                    <th title="<?php echo get_option('other_deduction_2_shortcode'); ?>" style="color: blue;"><?php echo get_option('other_deduction_2'); ?></th>
                    <th title="<?php echo get_option('other_deduction_3_shortcode'); ?>" style="color: blue;"><?php echo get_option('other_deduction_3'); ?></th>
                    <th title="<?php echo get_option('other_deduction_4_shortcode'); ?>" style="color: blue;"><?php echo get_option('other_deduction_4'); ?></th>
                    <th title="<?php echo get_option('other_deduction_5_shortcode'); ?>" style="color: blue;"><?php echo get_option('other_deduction_5'); ?></th>
                    <th title="<?php echo get_option('other_deduction_6_shortcode'); ?>" style="color: blue;"><?php echo get_option('other_deduction_6'); ?></th>
                    <th title="<?php echo get_option('other_deduction_7_shortcode'); ?>" style="color: blue;"><?php echo get_option('other_deduction_7'); ?></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($candidate_payroll_history as $key => $value) { ?>
                    <tr>
                        <td><?php echo $value['id']; ?></td>
                        <td style="text-wrap: nowrap;"><?php echo $value['full_candidate_name']; ?></td>
                        <td><?php echo $value['payroll_reference']; ?></td>
                        <td><a href="<?php echo admin_url('crew_payroll/payroll_history_pdf/' . $value['id']) ?>" class="btn btn-default btn-with-tooltip"><i class="fa fa-print"></i></a></td>
                        <td style="text-wrap: nowrap;"><?php echo $value['from']; ?></td>
                        <td style="text-wrap: nowrap;"><?php echo $value['to']; ?></td>
                        <td><?php echo $value['days']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['basic_wages_onb']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['basic_wages_trv']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['leave']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['education_allowance']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['guranteed_overtime']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['operational_allowance']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['supplementary_allowance']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['owners_bonus']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['other_earnings_1']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['other_earnings_2']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['philhelth_empee']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['social_security_system_empee']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['slopchest']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['pag_lbig_housing_program_empee']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['sss_mandatory_provident_fund_empee']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['provident_fund_kaupthing_empee']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['cash_advance_paid_onboard']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['other_deduction_1']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['other_deduction_2']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['other_deduction_3']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['other_deduction_4']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['other_deduction_5']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['other_deduction_6']); ?></td>
                        <td style="text-align: right;"><?php echo number_format($value['other_deduction_7']); ?></td>
                        <td>
                            <!-- <button class="edit_payroll_history" data-id="<?php echo $value['id']; ?>" style="border: none; background: none;">
                                <i class="fa fa-edit"></i>
                            </button> -->
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

</div>