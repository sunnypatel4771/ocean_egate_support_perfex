<style>
    .table_th {
        white-space: normal !important;
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        max-width: 200px !important;
        text-align: center !important;
    }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-lg-12 table-responsive">

        <table class="table table-bordered dt-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo _l('compensation_from'); ?></th>
                    <th><?php echo _l('compensation_to'); ?></th>
                    <th><?php echo _l('monthly_salary_credit_regular_ss_ec'); ?></th>
                    <th><?php echo _l('monthly_salary_credit_regular_wisp'); ?></th>
                    <th><?php echo _l('monthly_salary_credit_regular_total'); ?></th>
                    <th><?php echo _l('amount_of_contributions_regular_ss_er'); ?></th>
                    <th><?php echo _l('amount_of_contributions_regular_ss_ee'); ?></th>
                    <th><?php echo _l('amount_of_contributions_regular_ss_total'); ?></th>
                    <th><?php echo _l('amount_of_contributions_ec_er'); ?></th>
                    <th><?php echo _l('amount_of_contributions_ec_ee'); ?></th>
                    <th><?php echo _l('amount_of_contributions_ec_total'); ?></th>
                    <th><?php echo _l('amount_of_contributions_wisp_er'); ?></th>
                    <th><?php echo _l('amount_of_contributions_wisp_ee'); ?></th>
                    <th><?php echo _l('amount_of_contributions_wisp_total'); ?></th>
                    <th><?php echo _l('amount_of_contributions_total_er'); ?></th>
                    <th><?php echo _l('amount_of_contributions_total_ee'); ?></th>
                    <th><?php echo _l('amount_of_contributions_total'); ?></th>
                    <th><?php echo _l('action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < 60; $i++) {
                    $no = $i;
                ?>
                    <tr>
                        <td class="text-center">
                            <?php echo ++$no; ?>
                        </td>
                        <td>
                            <div class="text-center compensation_from_data_<?php echo $no; ?>">
                                <p class="info_from compensation_from_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'compensation_from'); ?></p>
                                <input type="text" class="form-control input_compensation_from_data_<?php echo $no; ?>" name="input_compensation_from_data_<?php echo $no; ?>" id="input_compensation_from_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <td>
                            <div class="text-center compensation_to_data_<?php echo $no; ?>">
                                <p class="info_from compensation_to_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'compensation_to'); ?></p>
                                <input type="text" class="form-control input_compensation_to_data_<?php echo $no; ?>" name="input_compensation_to_data_<?php echo $no; ?>" id="input_compensation_to_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 1 -->
                        <td>
                            <div class="text-center monthly_salary_credit_regular_ss_ec_data_<?php echo $no; ?>">
                                <p class="monthly_salary_credit_regular_ss_ec_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'monthly_salary_credit_regular_ss_ec'); ?></p>
                                <input type="text" class="form-control input_monthly_salary_credit_regular_ss_ec_data_<?php echo $no; ?>" name="input_monthly_salary_credit_regular_ss_ec_data_<?php echo $no; ?>" id="input_monthly_salary_credit_regular_ss_ec_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 1 -->
                        <!-- 2 -->
                        <td>
                            <div class="text-center monthly_salary_credit_regular_wisp_data_<?php echo $no; ?>">
                                <p class="monthly_salary_credit_regular_wisp_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'monthly_salary_credit_regular_wisp'); ?></p>
                                <input type="text" class="form-control input_monthly_salary_credit_regular_wisp_data_<?php echo $no; ?>" name="input_monthly_salary_credit_regular_wisp_data_<?php echo $no; ?>" id="input_monthly_salary_credit_regular_wisp_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 2 -->
                        <!-- 3 -->
                        <td>
                            <div class="text-center monthly_salary_credit_regular_total_data_<?php echo $no; ?>">
                                <p class="monthly_salary_credit_regular_total_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'monthly_salary_credit_regular_total'); ?></p>
                                <input type="text" class="form-control input_monthly_salary_credit_regular_total_data_<?php echo $no; ?>" name="input_monthly_salary_credit_regular_total_data_<?php echo $no; ?>" id="input_monthly_salary_credit_regular_total_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 3 -->
                        <!-- 4 -->
                        <td>
                            <div class="text-center amount_of_contributions_regular_ss_er_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_regular_ss_er_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_regular_ss_er'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_regular_ss_er_data_<?php echo $no; ?>" name="input_amount_of_contributions_regular_ss_er_data_<?php echo $no; ?>" id="input_amount_of_contributions_regular_ss_er_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 4 -->
                        <!-- 5 -->
                        <td>
                            <div class="text-center amount_of_contributions_regular_ss_ee_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_regular_ss_ee_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_regular_ss_ee'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_regular_ss_ee_data_<?php echo $no; ?>" name="input_amount_of_contributions_regular_ss_ee_data_<?php echo $no; ?>" id="input_amount_of_contributions_regular_ss_ee_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 5 -->
                        <!-- 6 -->
                        <td>
                            <div class="text-center amount_of_contributions_regular_ss_total_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_regular_ss_total_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_regular_ss_total'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_regular_ss_total_data_<?php echo $no; ?>" name="input_amount_of_contributions_regular_ss_total_data_<?php echo $no; ?>" id="input_amount_of_contributions_regular_ss_total_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 6 -->
                        <!-- 7 -->
                        <td>
                            <div class="text-center amount_of_contributions_ec_er_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_ec_er_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_ec_er'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_ec_er_data_<?php echo $no; ?>" name="input_amount_of_contributions_ec_er_data_<?php echo $no; ?>" id="input_amount_of_contributions_ec_er_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 7 -->
                        <!-- 8 -->
                        <td>
                            <div class="text-center amount_of_contributions_ec_ee_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_ec_ee_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_ec_ee'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_ec_ee_data_<?php echo $no; ?>" name="input_amount_of_contributions_ec_ee_data_<?php echo $no; ?>" id="input_amount_of_contributions_ec_ee_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 8 -->
                        <!-- 9 -->
                        <td>
                            <div class="text-center amount_of_contributions_ec_total_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_ec_total_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_ec_total'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_ec_total_data_<?php echo $no; ?>" name="input_amount_of_contributions_ec_total_data_<?php echo $no; ?>" id="input_amount_of_contributions_ec_total_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 9 -->
                        <!-- 10 -->
                        <td>
                            <div class="text-center amount_of_contributions_wisp_er_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_wisp_er_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_wisp_er'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_wisp_er_data_<?php echo $no; ?>" name="input_amount_of_contributions_wisp_er_data_<?php echo $no; ?>" id="input_amount_of_contributions_wisp_er_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 10 -->
                        <!-- 11 -->
                        <td>
                            <div class="text-center amount_of_contributions_wisp_ee_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_wisp_ee_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_wisp_ee'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_wisp_ee_data_<?php echo $no; ?>" name="input_amount_of_contributions_wisp_ee_data_<?php echo $no; ?>" id="input_amount_of_contributions_wisp_ee_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 11 -->
                        <!-- 12 -->
                        <td>
                            <div class="text-center amount_of_contributions_wisp_total_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_wisp_total_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_wisp_total'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_wisp_total_data_<?php echo $no; ?>" name="input_amount_of_contributions_wisp_total_data_<?php echo $no; ?>" id="input_amount_of_contributions_wisp_total_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 12 -->
                        <!-- 13 -->
                        <td>
                            <div class="text-center amount_of_contributions_total_er_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_total_er_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_total_er'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_total_er_data_<?php echo $no; ?>" name="input_amount_of_contributions_total_er_data_<?php echo $no; ?>" id="input_amount_of_contributions_total_er_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 13 -->
                        <!-- 14 -->
                        <td>
                            <div class="text-center amount_of_contributions_total_ee_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_total_ee_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_total_ee'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_total_ee_data_<?php echo $no; ?>" name="input_amount_of_contributions_total_ee_data_<?php echo $no; ?>" id="input_amount_of_contributions_total_ee_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 14 -->
                        <!-- 15 -->
                        <td>
                            <div class="text-center amount_of_contributions_total_data_<?php echo $no; ?>">
                                <p class="amount_of_contributions_total_data_info_<?php echo $no; ?>"><?php echo get_sss_table($no, 'amount_of_contributions_total'); ?></p>
                                <input type="text" class="form-control input_amount_of_contributions_total_data_<?php echo $no; ?>" name="input_amount_of_contributions_total_data_<?php echo $no; ?>" id="input_amount_of_contributions_total_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none; width: 100%;">
                            </div>
                        </td>
                        <!-- 15 -->
                        <td>
                            <div class="text-center">
                                <i class="fa fa-edit edit_tab edit_tab_<?php echo $no; ?>" data-id="<?php echo $no; ?>"></i>
                                <button class="btn btn-info save save_<?php echo $no; ?>" style="display: none;" data-id="<?php echo $no; ?>">Save</button>
                            </div>
                        </td>
                    </tr>
                <?php  }
                ?>
            </tbody>
        </table>
    </div>
</div>