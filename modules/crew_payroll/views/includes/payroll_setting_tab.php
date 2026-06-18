<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php  ?>
<div class="row">
    <div class="col-sm-12">
        <p style="font-size: 18px; font-weight: bold;">Earnings</p>
    </div>
    <hr style="width: 100%; margin-left: 0px; border: 1px solid gray;">

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="basic_wages_onb_order" value="<?php echo get_option('basic_wages_onb_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('basic_wages_onb_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="basic_wages_onb_shortcode" value="<?php echo get_option('basic_wages_onb_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('basic_wages_onb_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('basic_wages_onb'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('basic_wages_onb') ?>" name="basic_wages_onb" style="display: none; width: 50%; width: 50%;">
        <?php
        $basic_wages_onb_can_view = get_option('basic_wages_onb_can_view');
        $checked = $basic_wages_onb_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="basic_wages_onb_can_view" id="basic_wages_onb_can_view" value="0" <?php echo $checked; ?>>

    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="basic_wages_trv_order" value="<?php echo get_option('basic_wages_trv_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('basic_wages_trv_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="basic_wages_trv_shortcode" value="<?php echo get_option('basic_wages_trv_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('basic_wages_trv_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('basic_wages_trv'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('basic_wages_trv') ?>" name="basic_wages_trv" style="display: none; width: 50%;">

        <?php
        $basic_wages_trv_can_view = get_option('basic_wages_trv_can_view');
        $checked = $basic_wages_trv_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="basic_wages_trv_can_view" id="basic_wages_trv_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="guranteed_overtime_order" value="<?php echo get_option('guranteed_overtime_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('guranteed_overtime_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="guranteed_overtime_shortcode" value="<?php echo get_option('guranteed_overtime_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('guranteed_overtime_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('guranteed_overtime'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('guranteed_overtime') ?>" name="guranteed_overtime" style="display: none; width: 50%;">

        <?php
        $guranteed_overtime_can_view = get_option('guranteed_overtime_can_view');
        $checked = $guranteed_overtime_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="guranteed_overtime_can_view" id="guranteed_overtime_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="education_allowance_order" value="<?php echo get_option('education_allowance_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('education_allowance_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="education_allowance_shortcode" value="<?php echo get_option('education_allowance_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('education_allowance_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('education_allowance'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('education_allowance') ?>" name="education_allowance" style="display: none; width: 50%;">

        <?php
        $education_allowance_can_view = get_option('education_allowance_can_view');
        $checked = $education_allowance_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="education_allowance_can_view" id="education_allowance_can_view" value="0" <?php echo $checked; ?>>

    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="leave_order" value="<?php echo get_option('leave_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('leave_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="leave_shortcode" value="<?php echo get_option('leave_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('leave_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('leave'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('leave') ?>" name="leave" style="display: none; width: 50%;">

        <?php
        $leave_can_view = get_option('leave_can_view');
        $checked = $leave_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="leave_can_view" id="leave_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="operational_allowance_order" value="<?php echo get_option('operational_allowance_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('operational_allowance_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="operational_allowance_shortcode" value="<?php echo get_option('operational_allowance_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('operational_allowance_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('operational_allowance'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('operational_allowance') ?>" name="operational_allowance" style="display: none; width: 50%;">

        <?php
        $operational_allowance_can_view = get_option('operational_allowance_can_view');
        $checked = $operational_allowance_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="operational_allowance_can_view" id="operational_allowance_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="supplementary_allowance_order" value="<?php echo get_option('supplementary_allowance_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('supplementary_allowance_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="supplementary_allowance_shortcode" value="<?php echo get_option('supplementary_allowance_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('supplementary_allowance_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('supplementary_allowance'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('supplementary_allowance') ?>" name="supplementary_allowance" style="display: none; width: 50%;">

        <?php
        $supplementary_allowance_can_view = get_option('supplementary_allowance_can_view');
        $checked = $supplementary_allowance_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="supplementary_allowance_can_view" id="supplementary_allowance_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="owners_bonus_order" value="<?php echo get_option('owners_bonus_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('owners_bonus_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="owners_bonus_shortcode" value="<?php echo get_option('owners_bonus_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('owners_bonus_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('owners_bonus'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('owners_bonus') ?>" name="owners_bonus" style="display: none; width: 50%;">
        <?php
        $owners_bonus_can_view = get_option('owners_bonus_can_view');
        $checked = $owners_bonus_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="owners_bonus_can_view" id="owners_bonus_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="other_earnings_1_order" value="<?php echo get_option('other_earnings_1_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('other_earnings_1_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="other_earnings_1_shortcode" value="<?php echo get_option('other_earnings_1_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('other_earnings_1_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('other_earnings_1'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('other_earnings_1') ?>" name="other_earnings_1" style="display: none; width: 50%;">
        <?php
        $other_earnings_1_can_view = get_option('other_earnings_1_can_view');
        $checked = $other_earnings_1_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="other_earnings_1_can_view" id="other_earnings_1_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="other_earnings_2_order" value="<?php echo get_option('other_earnings_2_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('other_earnings_2_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="other_earnings_2_shortcode" value="<?php echo get_option('other_earnings_2_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('other_earnings_2_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('other_earnings_2'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('other_earnings_2') ?>" name="other_earnings_2" style="display: none; width: 50%;">
        <?php
        $other_earnings_2_can_view = get_option('other_earnings_2_can_view');
        $checked = $other_earnings_2_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="other_earnings_2_can_view" id="other_earnings_2_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="margin-top: 15px;">
        <p style="font-size: 18px; font-weight: bold;">Deduction - Official</p>
    </div>
    <hr style="width: 100%; margin-left: 0px; border: 1px solid gray;">

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="slopchest_order" value="<?php echo get_option('slopchest_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('slopchest_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="slopchest_shortcode" value="<?php echo get_option('slopchest_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('slopchest_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('slopchest'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('slopchest'); ?>" name="slopchest" style="display: none; width: 50%;">
        <?php
        $slopchest_can_view = get_option('slopchest_can_view');
        $checked = $slopchest_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="slopchest_can_view" id="slopchest_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="social_security_system_empee_order" value="<?php echo get_option('social_security_system_empee_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('social_security_system_empee_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="social_security_system_empee_shortcode" value="<?php echo get_option('social_security_system_empee_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('social_security_system_empee_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('social_security_system_empee'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('social_security_system_empee') ?>" name="social_security_system_empee" style="display: none; width: 50%;">
        <?php
        $social_security_system_empee_can_view = get_option('social_security_system_empee_can_view');
        $checked = $social_security_system_empee_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="social_security_system_empee_can_view" id="social_security_system_empee_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="philhelth_empee_order" value="<?php echo get_option('philhelth_empee_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('philhelth_empee_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="philhelth_empee_shortcode" value="<?php echo get_option('philhelth_empee_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('philhelth_empee_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('philhelth_empee'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('philhelth_empee') ?>" name="philhelth_empee" style="display: none; width: 50%;">

        <?php
        $philhelth_empee_can_view = get_option('philhelth_empee_can_view');
        $checked = $philhelth_empee_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="philhelth_empee_can_view" id="philhelth_empee_can_view" value="0" <?php echo $checked; ?>>

    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="pag_lbig_housing_program_empee_order" value="<?php echo get_option('pag_lbig_housing_program_empee_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('pag_lbig_housing_program_empee_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="pag_lbig_housing_program_empee_shortcode" value="<?php echo get_option('pag_lbig_housing_program_empee_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('pag_lbig_housing_program_empee_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('pag_lbig_housing_program_empee'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('pag_lbig_housing_program_empee') ?>" name="pag_lbig_housing_program_empee" style="display: none; width: 50%;">

        <?php
        $pag_lbig_housing_program_empee_can_view = get_option('pag_lbig_housing_program_empee_can_view');
        $checked = $pag_lbig_housing_program_empee_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="pag_lbig_housing_program_empee_can_view" id="pag_lbig_housing_program_empee_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="sss_mandatory_provident_fund_empee_order" value="<?php echo get_option('sss_mandatory_provident_fund_empee_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('sss_mandatory_provident_fund_empee_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="sss_mandatory_provident_fund_empee_shortcode" value="<?php echo get_option('sss_mandatory_provident_fund_empee_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('sss_mandatory_provident_fund_empee_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('sss_mandatory_provident_fund_empee'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('sss_mandatory_provident_fund_empee') ?>" name="sss_mandatory_provident_fund_empee" style="display: none; width: 50%;">

        <?php
        $sss_mandatory_provident_fund_empee_can_view = get_option('sss_mandatory_provident_fund_empee_can_view');
        $checked = $sss_mandatory_provident_fund_empee_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="sss_mandatory_provident_fund_empee_can_view" id="sss_mandatory_provident_fund_empee_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="provident_fund_kaupthing_empee_order" value="<?php echo get_option('provident_fund_kaupthing_empee_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('provident_fund_kaupthing_empee_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="provident_fund_kaupthing_empee_shortcode" value="<?php echo get_option('provident_fund_kaupthing_empee_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('provident_fund_kaupthing_empee_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('provident_fund_kaupthing_empee'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('provident_fund_kaupthing_empee') ?>" name="provident_fund_kaupthing_empee" style="display: none; width: 50%;">

        <?php
        $provident_fund_kaupthing_empee_can_view = get_option('provident_fund_kaupthing_empee_can_view');
        $checked = $provident_fund_kaupthing_empee_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="provident_fund_kaupthing_empee_can_view" id="provident_fund_kaupthing_empee_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="cash_advance_paid_onboard_order" value="<?php echo get_option('cash_advance_paid_onboard_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('cash_advance_paid_onboard_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="cash_advance_paid_onboard_shortcode" value="<?php echo get_option('cash_advance_paid_onboard_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('cash_advance_paid_onboard_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('cash_advance_paid_onboard'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('cash_advance_paid_onboard') ?>" name="cash_advance_paid_onboard" style="display: none; width: 50%;">

        <?php
        $cash_advance_paid_onboard_can_view = get_option('cash_advance_paid_onboard_can_view');
        $checked = $cash_advance_paid_onboard_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="cash_advance_paid_onboard_can_view" id="cash_advance_paid_onboard_can_view" value="0" <?php echo $checked; ?>>
    </div>


    <div class="col-sm-12" style="margin-top: 15px;">
        <p style="font-size: 18px; font-weight: bold;">Deduction - Private</p>
    </div>
    <hr style="width: 100%; margin-left: 0px; border: 1px solid gray;">
    <!-- added new deduction field  -->
    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="other_deduction_1_order" value="<?php echo get_option('other_deduction_1_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_1_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="other_deduction_1_shortcode" value="<?php echo get_option('other_deduction_1_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_1_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('other_deduction_1'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('other_deduction_1') ?>" name="other_deduction_1" style="display: none; width: 50%;">

        <?php
        $other_deduction_1_can_view = get_option('other_deduction_1_can_view');
        $checked = $other_deduction_1_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="other_deduction_1_can_view" id="other_deduction_1_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="other_deduction_2_order" value="<?php echo get_option('other_deduction_2_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_2_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="other_deduction_2_shortcode" value="<?php echo get_option('other_deduction_2_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_2_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('other_deduction_2'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('other_deduction_2') ?>" name="other_deduction_2" style="display: none; width: 50%;">

        <?php
        $other_deduction_2_can_view = get_option('other_deduction_2_can_view');
        $checked = $other_deduction_2_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="other_deduction_2_can_view" id="other_deduction_2_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="other_deduction_3_order" value="<?php echo get_option('other_deduction_3_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_3_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="other_deduction_3_shortcode" value="<?php echo get_option('other_deduction_3_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_3_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('other_deduction_3'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('other_deduction_3') ?>" name="other_deduction_3" style="display: none; width: 50%;">

        <?php
        $other_deduction_3_can_view = get_option('other_deduction_3_can_view');
        $checked = $other_deduction_3_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="other_deduction_3_can_view" id="other_deduction_3_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="other_deduction_4_order" value="<?php echo get_option('other_deduction_4_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_4_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="other_deduction_4_shortcode" value="<?php echo get_option('other_deduction_4_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_4_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('other_deduction_4'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('other_deduction_4') ?>" name="other_deduction_4" style="display: none; width: 50%;">

        <?php
        $other_deduction_4_can_view = get_option('other_deduction_4_can_view');
        $checked = $other_deduction_4_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="other_deduction_4_can_view" id="other_deduction_4_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="other_deduction_5_order" value="<?php echo get_option('other_deduction_5_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_5_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="other_deduction_5_shortcode" value="<?php echo get_option('other_deduction_5_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_5_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('other_deduction_5'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('other_deduction_5'); ?>" name="other_deduction_5" style="display: none; width: 50%;">

        <?php
        $other_deduction_5_can_view = get_option('other_deduction_5_can_view');
        $checked = $other_deduction_5_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="other_deduction_5_can_view" id="other_deduction_5_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="other_deduction_6_order" value="<?php echo get_option('other_deduction_6_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_6_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="other_deduction_6_shortcode" value="<?php echo get_option('other_deduction_6_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_6_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('other_deduction_6'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('other_deduction_6') ?>" name="other_deduction_6" style="display: none; width: 50%;">

        <?php
        $other_deduction_6_can_view = get_option('other_deduction_6_can_view');
        $checked = $other_deduction_6_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="other_deduction_6_can_view" id="other_deduction_6_can_view" value="0" <?php echo $checked; ?>>
    </div>

    <div class="col-sm-12" style="display: flex; justify-content: left; align-items: center; gap: 50px; margin-bottom: 10px;">
        <i class="fa fa-edit payroll_setup_tab"></i>
        <button class="save-btn btn btn-info" style="display: none;" type="button">Save</button>

        <input type="number" class="form-control input_order" style="display: none; width: 50%; width: 50%;" name="other_deduction_7_order" value="<?php echo get_option('other_deduction_7_order'); ?>">
        <p class="tab_text_order" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_7_order'); ?></p>
        <input type="text" class="form-control input_shortcode" style="display: none; width: 50%; width: 50%;" name="other_deduction_7_shortcode" value="<?php echo get_option('other_deduction_7_shortcode'); ?>">
        <p class="tab_text_shortcode" style="margin: 0px; width: 10%;"><?php echo get_option('other_deduction_7_shortcode'); ?></p>

        <p class="tab_text" style="margin: 0px; width: 30%;"><?php echo get_option('other_deduction_7'); ?></p>
        <input type="text" class="form-control input_field" value="<?php echo get_option('other_deduction_7') ?>" name="other_deduction_7" style="display: none; width: 50%;">

        <?php
        $other_deduction_7_can_view = get_option('other_deduction_7_can_view');
        $checked = $other_deduction_7_can_view == 1 ? 'checked' : '';
        ?>
        <input type="checkbox" name="other_deduction_7_can_view" id="other_deduction_7_can_view" value="0" <?php echo $checked; ?>>
    </div>
    <!-- added new deduction field  -->
</div>
<?php ?>
<div class="clearfix"></div>