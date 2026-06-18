<?php
update_option('basic_wages_onb', 'Basic Wages ( ONB )');
update_option('basic_wages_onb_can_view', 1);
update_option('basic_wages_onb_order', 1);
update_option('basic_wages_onb_shortcode', '');

update_option('basic_wages_trv', 'Basic Wages ( TRV )');
update_option('basic_wages_trv_can_view', 1);
update_option('basic_wages_trv_order', 2);
update_option('basic_wages_trv_shortcode', '');

update_option('guranteed_overtime', 'Guranteed Overtime');
update_option('guranteed_overtime_can_view', 1);
update_option('guranteed_overtime_order', 3);
update_option('guranteed_overtime_shortcode', '');

update_option('education_allowance', 'Education Allowance');
update_option('education_allowance_can_view', 1);
update_option('education_allowance_order', 4);
update_option('education_allowance_shortcode', '');

update_option('leave', 'Leave');
update_option('leave_can_view', 1);
update_option('leave_order', 5);
update_option('leave_shortcode', '');

update_option('operational_allowance', 'Operational Allowance');
update_option('operational_allowance_can_view', 1);
update_option('operational_allowance_order', 6);
update_option('operational_allowance_shortcode', '');

update_option('supplementary_allowance', 'Supplementary Allowance');
update_option('supplementary_allowance_can_view', 1);
update_option('supplementary_allowance_order', 7);
update_option('supplementary_allowance_shortcode', '');

update_option('owners_bonus', 'Owners Bonus');
update_option('owners_bonus_can_view', 1);
update_option('owners_bonus_order', 8);
update_option('owners_bonus_shortcode', '');

update_option('other_earnings_1', 'Other 1');
update_option('other_earnings_1_can_view', 1);
update_option('other_earnings_1_order', 9);
update_option('other_earnings_1_shortcode', '');

update_option('other_earnings_2', 'Other 2');
update_option('other_earnings_2_can_view', 1);
update_option('other_earnings_2_order', 10);
update_option('other_earnings_2_shortcode', '');




update_option('slopchest', "Slopchest");
update_option('slopchest_can_view', 1);
update_option('slopchest_order', 11);
update_option('slopchest_shortcode', '');

update_option('social_security_system_empee', "Social Security System &#40;Emp'ee&#41;");
update_option('social_security_system_empee_can_view', 1);
update_option('social_security_system_empee_order', 12);
update_option('social_security_system_empee_shortcode', '');

update_option('philhelth_empee', "Philhelth (Emp'ee)");
update_option('philhelth_empee_can_view', 1);
update_option('philhelth_empee_order', 13);
update_option('philhelth_empee_shortcode', '');

update_option('pag_lbig_housing_program_empee', "Pag-lbig Housing Program (Emp'ee)");
update_option('pag_lbig_housing_program_empee_can_view', 1);
update_option('pag_lbig_housing_program_empee_order', 14);
update_option('pag_lbig_housing_program_empee_shortcode', '');

update_option('sss_mandatory_provident_fund_empee', "SSS Mandatory Provident Fund (Emp'ee)");
update_option('sss_mandatory_provident_fund_empee_can_view', 1);
update_option('sss_mandatory_provident_fund_empee_order', 15);
update_option('sss_mandatory_provident_fund_empee_shortcode', '');

update_option('provident_fund_kaupthing_empee', "Provident Fund-Kaupthing (Emp'ee)");
update_option('provident_fund_kaupthing_empee_can_view', 1);
update_option('provident_fund_kaupthing_empee_order', 16);
update_option('provident_fund_kaupthing_empee_shortcode', '');

update_option('cash_advance_paid_onboard', "Cash Advance Paid Onboard");
update_option('cash_advance_paid_onboard_can_view', 1);
update_option('cash_advance_paid_onboard_order', 17);
update_option('cash_advance_paid_onboard_shortcode', '');

//added new deduction field
update_option('other_deduction_1', "Other Deduction #1");
update_option('other_deduction_1_can_view', 1);
update_option('other_deduction_1_order', 18);
update_option('other_deduction_1_shortcode', '');

update_option('other_deduction_2', "Other Deduction #2");
update_option('other_deduction_2_can_view', 1);
update_option('other_deduction_2_order', 19);
update_option('other_deduction_2_shortcode', '');

update_option('other_deduction_3', "Other Deduction #3");
update_option('other_deduction_3_can_view', 1);
update_option('other_deduction_3_order', 20);
update_option('other_deduction_3_shortcode', '');

update_option('other_deduction_4', "Other Deduction #4");
update_option('other_deduction_4_can_view', 1);
update_option('other_deduction_4_order', 21);
update_option('other_deduction_4_shortcode', '');

update_option('other_deduction_5', "Other Deduction #5");
update_option('other_deduction_5_can_view', 1);
update_option('other_deduction_5_order', 22);
update_option('other_deduction_5_shortcode', '');

update_option('other_deduction_6', "Other Deduction #6");
update_option('other_deduction_6_can_view', 1);
update_option('other_deduction_6_order', 23);
update_option('other_deduction_6_shortcode', '');

update_option('other_deduction_7', "Other Deduction #7");
update_option('other_deduction_7_can_view', 1);
update_option('other_deduction_7_order', 24);
update_option('other_deduction_7_shortcode', '');
//added new deduction field

defined('BASEPATH') or exit('No direct script access allowed');
if (!$CI->db->table_exists(db_prefix() . 'rec_deduction')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "rec_deduction` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `candidate_id` int(11) NULL,
      `status` int(11) NULL,
      `name` varchar(255) NULL,
      `bank_acc` varchar(255) NULL,
      `amount` int(11) NULL,
      `deduction_memo` varchar(255) NULL,
      `file` varchar(255) NULL,
      `remark` varchar(255) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'rec_payroll_set_up')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "rec_payroll_set_up` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NULL,
      `basic` varchar(255) NULL,
      `rate` varchar(255) NULL,
      `candidate_id` int(11) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'rec_sss_setting')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "rec_sss_setting` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `from` varchar(255) NULL,
      `to` varchar(255) NULL,
      `amount` varchar(255) NULL,
      `remarks` varchar(11) NULL,
      `data_id` int(11) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'rec_sss_table')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "rec_sss_table` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `compensation_from` varchar(255) NULL ,
      `compensation_to` varchar(255) NULL ,
      `monthly_salary_credit_regular_ss_ec` varchar(255) NULL ,
      `monthly_salary_credit_regular_wisp` varchar(255) NULL ,
      `monthly_salary_credit_regular_total` varchar(255) NULL ,
      `amount_of_contributions_regular_ss_er` varchar(255) NULL ,
      `amount_of_contributions_regular_ss_ee` varchar(255) NULL ,
      `amount_of_contributions_regular_ss_total` varchar(255) NULL ,
      `amount_of_contributions_ec_er` varchar(255) NULL ,
      `amount_of_contributions_ec_ee` varchar(255) NULL ,
      `amount_of_contributions_ec_total` varchar(255) NULL ,
      `amount_of_contributions_wisp_er` varchar(255) NULL ,
      `amount_of_contributions_wisp_ee` varchar(255) NULL ,
      `amount_of_contributions_wisp_total` varchar(255) NULL ,
      `amount_of_contributions_total_er` varchar(255) NULL ,
      `amount_of_contributions_total_ee` varchar(255) NULL ,
      `amount_of_contributions_total` varchar(255) NULL ,
      `data_id` int(11) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'rec_candidate_payroll_new')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "rec_candidate_payroll_new` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `candidate_id` int(11) NULL,
      `name` varchar(255) NULL,
      `rate` int(11) NULL,
      `qty` int(11) NULL,
      `amount` int(11) NULL,
      `remark` varchar(255) NULL,
      `bank_name` varchar(255) NULL,
      `account_name` varchar(255) NULL,
      `account_no` varchar(255) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'rec_payroll_data')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "rec_payroll_data` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `code` varchar(255) NULL,
      `rank` varchar(255) NULL,
      `basic_wages_onb` int(11) NULL,
      `basic_wages_trv` int(11) NULL,
      `guranteed_overtime` int(11) NULL,
      `education_allowance` int(11) NULL,
      `leave` int(11) NULL,
      `operational_allowance` int(11) NULL,
      `supplementary_allowance` int(11) NULL,
      `owners_bonus` int(11) NULL,
      `other_earnings_1` int(11) NULL,
      `other_earnings_2` int(11) NULL,
      `slopchest` int(11) NULL,
      `social_security_system_empee` int(11) NULL,
      `philhelth_empee` int(11) NULL,
      `pag_lbig_housing_program_empee` int(11) NULL,
      `sss_mandatory_provident_fund_empee` int(11) NULL,
      `provident_fund_kaupthing_empee` int(11) NULL,
      `cash_advance_paid_onboard` int(11) NULL,
      `other_deduction_1` int(11) NULL,
      `other_deduction_2` int(11) NULL,
      `other_deduction_3` int(11) NULL,
      `other_deduction_4` int(11) NULL,
      `other_deduction_5` int(11) NULL,
      `other_deduction_6` int(11) NULL,
      `other_deduction_7` int(11) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->field_exists('payroll_table_id', db_prefix() . 'rec_candidate')) {
  $CI->db->query('ALTER TABLE `' . db_prefix() . "rec_candidate`
    ADD COLUMN `payroll_table_id` int(11) DEFAULT NULL
  ;");
}


if (!$CI->db->table_exists(db_prefix() . 'rec_payroll_period')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "rec_payroll_period` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `from` date NULL,
      `to` date NULL,
      `days` int(11) NULL,
      `payroll_reference` BIGINT(20) NULL,
      `remarks` varchar(255) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'rec_payroll_history')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "rec_payroll_history` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `candidate_id` int(11) NULL,
      `payroll_reference` BIGINT(20) NULL,
      `from` date NULL,
      `to` date NULL,
      `days` int(11) NULL,
      `basic_wages_onb` int(11) NULL,
      `basic_wages_trv` int(11) NULL,
      `leave` int(11) NULL,
      `education_allowance` int(11) NULL,
      `guranteed_overtime` int(11) NULL,
      `operational_allowance` int(11) NULL,
      `supplementary_allowance` int(11) NULL,
      `owners_bonus` int(11) NULL,
      `other_earnings_1` int(11) NULL,
      `other_earnings_2` int(11) NULL,
      `philhelth_empee` int(11) NULL,
      `social_security_system_empee` int(11) NULL,
      `slopchest` int(11) NULL,
      `pag_lbig_housing_program_empee` int(11) NULL,
      `sss_mandatory_provident_fund_empee` int(11) NULL,
      `provident_fund_kaupthing_empee` int(11) NULL,
      `cash_advance_paid_onboard` int(11) NULL,
      `other_deduction_1` int(11) NULL,
      `other_deduction_2` int(11) NULL,
      `other_deduction_3` int(11) NULL,
      `other_deduction_4` int(11) NULL,
      `other_deduction_5` int(11) NULL,
      `other_deduction_6` int(11) NULL,
      `other_deduction_7` int(11) NULL,     
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->field_exists('exchange_rate', db_prefix() . 'rec_payroll_history')) {
  $CI->db->query('ALTER TABLE `' . db_prefix() . "rec_payroll_history`
    ADD COLUMN `exchange_rate` int(11) DEFAULT NULL
  ;");
}

if (!$CI->db->field_exists('exchange_rate', db_prefix() . 'rec_payroll_period')) {
  $CI->db->query('ALTER TABLE `' . db_prefix() . "rec_payroll_period`
    ADD COLUMN `exchange_rate` int(11) DEFAULT NULL
  ;");
}

if (!$CI->db->table_exists(db_prefix() . 'rec_payroll_setup_total')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "rec_payroll_setup_total` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `candidate_id` int(11) NULL,
      `earnings_total` int(11) NULL,
      `deduction_official_total` int(11) NULL,
      `deduction_private_total` int(11) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'payroll_group_per_vessel')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "payroll_group_per_vessel` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `code` varchar(255) NULL,
      `vessel_group_name` varchar(255) NULL,
      `vessel_details` varchar(255) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}


if (!$CI->db->table_exists(db_prefix() . 'payroll_table_setting')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "payroll_table_setting` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `vessel_code` int(11) NULL,
      `vessel_group_name` varchar(255) NULL,
      `rank_code` int(11) NULL,
      `rank` varchar(255) NULL,
      `basic_wages_onb` int(11) NULL,
      `basic_wages_trv` int(11) NULL,
      `leave` int(11) NULL,
      `education_allowance` int(11) NULL,
      `guranteed_overtime` int(11) NULL,
      `operational_allowance` int(11) NULL,
      `supplementary_allowance` int(11) NULL,
      `owners_bonus` int(11) NULL,
      `other_earnings_1` int(11) NULL,
      `other_earnings_2` int(11) NULL,
      `philhelth_empee` int(11) NULL,
      `social_security_system_empee` int(11) NULL,
      `slopchest` int(11) NULL,
      `pag_lbig_housing_program_empee` int(11) NULL,
      `sss_mandatory_provident_fund_empee` int(11) NULL,
      `provident_fund_kaupthing_empee` int(11) NULL,
      `cash_advance_paid_onboard` int(11) NULL,
      `other_deduction_1` int(11) NULL,
      `other_deduction_2` int(11) NULL,
      `other_deduction_3` int(11) NULL,
      `other_deduction_4` int(11) NULL,
      `other_deduction_5` int(11) NULL,
      `other_deduction_6` int(11) NULL,
      `other_deduction_7` int(11) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'candidate_payroll_selection_detail')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "candidate_payroll_selection_detail` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `rank_code` int(11) NULL,
      `vessel_code` int(11) NULL,
      `candidate_id` int(11) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}
