<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
Module Name: Crew Payroll
Description: Crew Payroll
Version: 1.0.10
Requires at least: 2.3.*
Author: Egate Inc
*/
define('CREW_PAYROLL_MODULE_NAME', 'crew_payroll');

hooks()->add_action('app_admin_footer', 'crew_payroll_footer_components');
hooks()->add_action('add_candidate_detail_tab', 'add_candidate_detail_tab');
hooks()->add_action('add_tab_content_for_tab', 'add_tab_content_for_tab');
hooks()->add_action('admin_init', 'crew_payroll_add_menu_item');
// hooks()->add_action('add_setting_tab_candidate', 'add_setting_tab_candidate');
/**
 * Register activation module hook
 */
register_activation_hook(CREW_PAYROLL_MODULE_NAME, 'crewpayroll_module_activation_hook');

$CI = &get_instance();
$CI->load->helper(CREW_PAYROLL_MODULE_NAME . '/crewpayroll');

function crewpayroll_module_activation_hook()
{
	$CI = &get_instance();
	require_once __DIR__ . '/install.php';
}

/**
 * Register language files, must be registered if the module is using languages
 */
register_language_files(CREW_PAYROLL_MODULE_NAME, [CREW_PAYROLL_MODULE_NAME]);

function crew_payroll_add_menu_item()
{
	$CI = &get_instance();
	$CI->app_menu->add_setup_menu_item('crew_payroll', [
		'href'     => admin_url('crew_payroll/index'),
		'name'     => _l('crew_payroll'),
		'position' => 10,
	]);
}

function crew_payroll_footer_components()
{
	$CI = &get_instance();
	$viewuri = $_SERVER['REQUEST_URI'];

	if (!(strpos($viewuri, '/admin/recruitment/candidate') === false)) {
		echo '<script src="' . module_dir_url(CREW_PAYROLL_MODULE_NAME, 'assets/js/candidate.js') . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/crew_payroll/index?group=sss_setting_tab') === false)) {
		echo '<script src="' . module_dir_url(CREW_PAYROLL_MODULE_NAME, 'assets/js/sss_setting.js') . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/crew_payroll/index?group=sss_table_tab') === false)) {
		echo '<script src="' . module_dir_url(CREW_PAYROLL_MODULE_NAME, 'assets/js/sss_table.js') . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/crew_payroll/recruitment_payroll?group=payroll_history') === false)) {
		echo '<script src="' . module_dir_url(CREW_PAYROLL_MODULE_NAME, 'assets/js/payroll_history.js') . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/crew_payroll/index?group=payroll_period') === false)) {
		echo '<script src="' . module_dir_url(CREW_PAYROLL_MODULE_NAME, 'assets/js/payroll_period.js') . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/crew_payroll/recruitment_payroll?group=payroll_group_per_vessel') === false)) {
		echo '<script src="' . module_dir_url(CREW_PAYROLL_MODULE_NAME, 'assets/js/payroll_group_per_vessel.js') . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/crew_payroll/recruitment_payroll?group=payroll_table_setting') === false)) {
		echo '<script src="' . module_dir_url(CREW_PAYROLL_MODULE_NAME, 'assets/js/payroll_table_setting.js') . '"></script>';
	}
}

function add_candidate_detail_tab()
{
	echo '
	<li role="presentation">
		<a href="#payroll_setup" aria-controls="payroll_setup" role="tab" data-toggle="tab" aria-controls="payroll_setup">
			<i class="fa fa-paperclip"></i>&nbsp;Payroll Setup
		</a>
    </li>
	<li role="presentation">
        <a href="#payroll_history" aria-controls="payroll_history" role="tab" data-toggle="tab" aria-controls="payroll_history">
            <i class="fa fa-paperclip"></i>&nbsp;Payroll History
		</a>
    </li>
	<li role="presentation">
        <a href="#eargings" aria-controls="eargings" role="tab" data-toggle="tab" aria-controls="eargings">
            <i class="fa fa-paperclip"></i>&nbsp;Eargings
		</a>
    </li>
    <li role="presentation">
		<a href="#deduction" aria-controls="deduction" role="tab" data-toggle="tab" aria-controls="deduction">
			<i class="fa fa-paperclip"></i>&nbsp;Deduction
		</a>
    </li>
		';
}

function add_tab_content_for_tab($data)
{
	$CI = &get_instance();
	$candidate_id = $data['candidate_id'];
	$deduction_data = get_deduction_by_candidate_id($candidate_id);
	$view_data['deduction_data'] = $deduction_data;
	$view_data['candidate_id'] = $candidate_id;
	echo $CI->load->view('crew_payroll/deduction', $view_data);
}
