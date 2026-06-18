<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Sea Man
Description: Sea Man - Crew Data Base
Version: 1.1.6
Requires at least: 2.3.*
Author: Egate Inc
*/
define('RECRUITMENT_MODULE_NAME', 'recruitment');
define('VIESEL_TYPE', 2);
define('RECRUITMENT_MODULE_UPLOAD_FOLDER', module_dir_path(RECRUITMENT_MODULE_NAME, 'uploads'));
define('RECRUITMENT_PATH', 'modules/recruitment/uploads/');
define('RECRUITMENT_COMPANY_UPLOAD', module_dir_path(RECRUITMENT_MODULE_NAME, 'uploads/company_images/'));
define('TEMFOLDER_EXPORT_CANDIDATE', module_dir_path(RECRUITMENT_MODULE_NAME, 'uploads/export_candidate/'));
define('CANDIDATE_IMAGE_UPLOAD', module_dir_path(RECRUITMENT_MODULE_NAME, 'uploads/candidate/avartar/'));

// this is for crew contract template id which is defult for all crew and this can not be deleted and on the crew side can not be edited 
define('GOVERNMENT_CONTRACT_1', 24);

hooks()->add_action('admin_init', 'recruitment_permissions');
hooks()->add_action('app_admin_head', 'recruitment_head_components');
hooks()->add_action('app_admin_footer', 'recruitment_add_footer_components');
hooks()->add_action('admin_init', 'recruitment_module_init_menu_items');

hooks()->add_action('app_customers_portal_head', 'recruitment_portal_add_head_components');
hooks()->add_action('app_customers_portal_footer', 'recruitment_portal_add_footer_components');
hooks()->add_action('forms_head', 'forms_add_head_components');
hooks()->add_action('forms_footer', 'forms_add_footer_components');

define('RE_REVISION', 116);

/**
 * Register activation module hook
 */
register_activation_hook(RECRUITMENT_MODULE_NAME, 'recruitment_module_activation_hook');
register_merge_fields(RECRUITMENT_MODULE_NAME . '/merge_fields/contract_template_merge_fields');

// register_merge_fields('recruitment/merge_fields/hris_merge_fields');

/**
 * Load the module helper
 */
$CI = &get_instance();
$CI->load->helper(RECRUITMENT_MODULE_NAME . '/recruitment');

function recruitment_module_activation_hook()
{
	$CI = &get_instance();
	require_once __DIR__ . '/install.php';
}

/**
 * Register language files, must be registered if the module is using languages
 */
register_language_files(RECRUITMENT_MODULE_NAME, [RECRUITMENT_MODULE_NAME]);

/**
 * Init goals module menu items in setup in admin_init hook
 * @return null
 */
function recruitment_module_init_menu_items()
{

	$CI = &get_instance();
	if (has_permission('recruitment', '', 'view')) {
		$CI->app_menu->add_sidebar_menu_item('recruitment', [
			'name' => _l('recruitment'),
			'icon' => 'fa fa-address-book',
			'position' => 30,
		]);
		// $CI->app_menu->add_sidebar_children_item('recruitment', [
		// 	'slug' => 'recruitment_dashboard',
		// 	'name' => _l('dashboard'),
		// 	'icon' => 'fa fa-home',
		// 	'href' => admin_url('recruitment/dashboard'),
		// 	'position' => 1,
		// ]);

		// if (get_recruitment_option('recruitment_create_campaign_with_plan') == 0) {
		// 	$CI->app_menu->add_sidebar_children_item('recruitment', [
		// 		'slug' => 'recruitment-proposal',
		// 		'name' => _l('_proposal'),
		// 		'icon' => 'fa fa-address-card-o',
		// 		'href' => admin_url('recruitment/recruitment_proposal'),
		// 		'position' => 2,
		// 	]);
		// }

		// $CI->app_menu->add_sidebar_children_item('recruitment', [
		// 	'slug' => 'recruitment-campaign',
		// 	'name' => _l('campaign'),
		// 	'icon' => 'fa fa-sitemap',
		// 	'href' => admin_url('recruitment/recruitment_campaign'),
		// 	'position' => 3,
		// ]);

		$CI->app_menu->add_sidebar_children_item('recruitment', [
			'slug' => 'candidate-profile',
			'name' => _l('candidate_profile'),
			'icon' => 'fa fa-user',
			'href' => admin_url('recruitment/candidate_profile'),
			'position' => 4,
		]);

		// $CI->app_menu->add_sidebar_children_item('recruitment', [
		// 	'slug' => 'interview-schedule',
		// 	'name' => _l('interview_schedule'),
		// 	'icon' => 'fa fa-calendar',
		// 	'href' => admin_url('recruitment/interview_schedule'),
		// 	'position' => 5,
		// ]);

		// $CI->app_menu->add_sidebar_children_item('recruitment', [
		// 	'slug' => 'recruitment-channel',
		// 	'name' => _l('_recruitment_channel'),
		// 	'icon' => 'fa fa-feed',
		// 	'href' => admin_url('recruitment/recruitment_channel'),
		// 	'position' => 6,
		// ]);

		// $CI->app_menu->add_sidebar_children_item('recruitment', [
		// 	'slug' => 'recruitment-portal',
		// 	'name' => _l('recruitment_portal'),
		// 	'icon' => 'fa fa-bars menu-icon',
		// 	'href' => site_url('recruitment/recruitment_portal'),
		// 	'position' => 7,
		// ]);

		$CI->app_menu->add_sidebar_children_item('recruitment', [
			'slug' => 'rec_settings',
			'name' => _l('setting'),
			'icon' => 'fa fa-gears',
			'href' => admin_url('recruitment/setting'),
			'position' => 8,
		]);


		if ($CI->app_modules->is_active('crew_payroll')) {
			$CI->app_menu->add_sidebar_children_item('recruitment', [
				'slug' => 'payroll',
				'name' => _l('payroll'),
				'icon' => 'fa fa-gears',
				'href' => admin_url('crew_payroll/recruitment_payroll'),
				'position' => 8,
			]);
		}
	}
}

/**
 * recruitment permissions
 * @return
 */
function recruitment_permissions()
{
	$capabilities = [];
	$capabilities['capabilities'] = [
		'view' => _l('permission_view') . '(' . _l('permission_global') . ')',
		'create' => _l('permission_create'),
		'edit' => _l('permission_edit'),
		'delete' => _l('permission_delete'),
	];
	register_staff_capabilities('recruitment', $capabilities, _l('recruitment'));
}

/**
 * add head components
 */
function recruitment_head_components()
{
	$CI = &get_instance();
	$viewuri = $_SERVER['REQUEST_URI'];
	if (!(strpos($viewuri, '/admin/recruitment') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/styles.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
	if (!(strpos($viewuri, '/admin/recruitment/dashboard') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/dashboard.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
	if (!(strpos($viewuri, '/admin/recruitment/candidates') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/candidate.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
	if (!(strpos($viewuri, '/admin/recruitment/candidate') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/candidate_detail.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
	if (!(strpos($viewuri, '/admin/recruitment/setting') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/setting.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
	if (!(strpos($viewuri, '/admin/recruitment/interview_schedule') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/interview_schedule_preview.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
	if (!(strpos($viewuri, '/admin/recruitment/recruitment_campaign') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/campaign_preview.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
	if (!(strpos($viewuri, '/admin/recruitment/candidate_profile') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/candidate_profile.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
	if (!(strpos($viewuri, '/admin/recruitment/recruitment_proposal') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/recruitment_proposal.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
	if (!(strpos($viewuri, '/admin/recruitment/recruitment_campaign') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/recruitment_proposal.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
	if (!(strpos($viewuri, '/admin/recruitment/setting?group=company') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/company.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}

	if (!(strpos($viewuri, '/admin/recruitment/recruitment_portal/job_detail') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/recruitment_proposal.css') . '?v=' . RE_REVISION . '"  rel="stylesheet" type="text/css" />';
	}
}

/**
 * add footer_components
 * @return
 */
function recruitment_add_footer_components()
{
	$CI = &get_instance();
	$viewuri = $_SERVER['REQUEST_URI'];

	if (!(strpos($viewuri, '/admin/recruitment') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/deactivate_hotkey.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/dashboard') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/plugins/highcharts/highcharts.js') . '"></script>';
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/plugins/highcharts/modules/variable-pie.js') . '"></script>';
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/plugins/highcharts/modules/export-data.js') . '"></script>';
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/plugins/highcharts/modules/accessibility.js') . '"></script>';
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/plugins/highcharts/modules/exporting.js') . '"></script>';
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/plugins/highcharts/highcharts-3d.js') . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/recruitment_proposal') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/proposal.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/candidates') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/candidate.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/candidate_profile') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/candidate_profile.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/transfer_to_hr') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/transferhr.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/setting?group=evaluation_criteria') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/evaluation_criteria.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/setting?group=evaluation_form') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/evaluation_form.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/setting?group=job_position') === false) || !(strpos($viewuri, '/admin/recruitment/setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/job_position.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/setting?group=tranfer_personnel') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/tranfer_personnel.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/interview_schedule') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/interview_schedule.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/recruitment_campaign') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/campaign.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/recruitment_campaign') === false)) {
	}
	if (!(strpos($viewuri, '/admin/recruitment/recruitment_channel') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/channel.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/calendar_interview_schedule') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/interview_schedule.js') . '?v=' . RE_REVISION . '"></script>';
	}
	if (!(strpos($viewuri, '/admin/recruitment/setting?group=skills') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/skill.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=recruitment_campaign_setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/recruitment_campaign_setting.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=tab_display_setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/tab_display_setting.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=liscense_form_setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/liscense_form_setting.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=expiration_date_setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/expiration_date_setting.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=hris_setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/hris_setting.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=industry_list') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/industry.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=custom_filed_setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/custom_filed_setting.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=custom_filed_setting_license') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/custom_filed_setting_license.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=custom_filed_setting_family') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/custom_filed_setting_family.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=custom_filed_setting_principals') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/custom_filed_setting_principals.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=custom_filed_setting_salary_scale') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/custom_filed_setting_salary_scale.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=custom_filed_setting_details') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/custom_filed_setting_details.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/recruitment_portal/job_detail') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/job_detail_portal.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=country_setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/country_setting.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=state_setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/state_setting.js') . '?v=' . RE_REVISION . '"></script>';
	}


	if (!(strpos($viewuri, '/admin/recruitment/setting?group=city_setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/city_setting.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=followup_highlight_setting') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/followup_highlight_setting.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=manning_agency') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/manning_agency.js') . '?v=' . RE_REVISION . '"></script>';
	}

	if (!(strpos($viewuri, '/admin/recruitment/setting?group=contract_template') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/contract_template.js') . '?v=' . RE_REVISION . '"></script>';
	}
}


/**
 * recruitment portal add head components
 * 
 */
function recruitment_portal_add_head_components()
{
	$CI = &get_instance();
	$viewuri = $_SERVER['REQUEST_URI'];

	if (!(strpos($viewuri, 'recruitment/recruitment_portal') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/recruitment_portal.css') . '"  rel="stylesheet" type="text/css" />';
	}
}

/**
 * recruitment portal add footer components
 * 
 */
function recruitment_portal_add_footer_components()
{
	$CI = &get_instance();
	$viewuri = $_SERVER['REQUEST_URI'];

	if (!(strpos($viewuri, 'recruitment/recruitment_portal') === false)) {
		echo '<script src="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/js/recruitment_portal.js') . '"></script>';
	}
}

/**
 * forms add head components
 * 
 */
function forms_add_head_components()
{
	$CI = &get_instance();
	$viewuri = $_SERVER['REQUEST_URI'];

	if (!(strpos($viewuri, 'recruitment/forms') === false)) {
		echo '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/forms.css') . '"  rel="stylesheet" type="text/css" />';
	}
}

/**
 * forms add footer components
 * 
 */
function forms_add_footer_components()
{
	$CI = &get_instance();
	$viewuri = $_SERVER['REQUEST_URI'];
}
