<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Recruitment Controller
 */
class recruitment extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('recruitment_model');
	}

	/**
	 * setting
	 * @return view
	 */
	public function setting()
	{
		if (!has_permission('recruitment', '', 'edit') && !is_admin()) {
			access_denied('recruitment');
		}
		$data['group'] = $this->input->get('group');
		$data['title'] = _l('setting');
		// $data['tab'][] = 'job_position';
		// $data['tab'][] = 'evaluation_criteria';
		// $data['tab'][] = 'evaluation_form';
		// $data['tab'][] = 'tranfer_personnel';
		// $data['tab'][] = 'skills';
		// $data['tab'][] = 'company_list';
		// $data['tab'][] = 'industry_list';
		// $data['tab'][] = 'recruitment_campaign_setting';
		$data['tab'][] = 'tab_display_setting';
		$data['tab'][] = 'custom_filed_setting_details';
		$data['tab'][] = 'custom_filed_setting';
		$data['tab'][] = 'custom_filed_setting_license';
		$data['tab'][] = 'custom_filed_setting_family';

		$data['tab'][] = 'custom_filed_setting_principals';

		$data['tab'][] = 'custom_filed_setting_salary_scale';

		if (is_admin()) {
			$data['tab'][] = 'liscense_form_setting';
		}
		$data['tab'][] = 'followup_highlight_setting';
		if (is_admin()) {
			$data['tab'][] = 'country_setting';
		}
		if (is_admin()) {
			$data['tab'][] = 'state_setting';
		}
		if (is_admin()) {
			$data['tab'][] = 'city_setting';
		}
		$data['tab'][] = 'expiration_date_setting';

		$data['tab'][] = 'hris_setting';
		$data['tab'][] = 'manning_agency';
		$data['tab'][] = 'contract_template';

		if ($data['group'] == '') {
			$data['group'] = 'tab_display_setting';
		}

		if ($data['group'] == 'contract_template') {
			$this->load->library('merge_fields/contract_template_merge_fields');
			$mearge_field = $this->contract_template_merge_fields->build();
			$data['mearge_field'] = $mearge_field;
			$data['contract_templates'] = $this->recruitment_model->get_contract_template();
		}
		$data['tabs']['view'] = 'includes/' . $data['group'];

		$data['positions'] = $this->recruitment_model->get_job_position();

		$data['list_group'] = $this->recruitment_model->get_group_evaluation_criteria();

		$data['group_criterias'] = $this->recruitment_model->get_list_child_criteria();

		$data['list_form'] = $this->recruitment_model->get_list_evaluation_form();

		$data['list_set_tran'] = $this->recruitment_model->get_list_set_transfer();

		$data['skills'] = $this->recruitment_model->get_skill();

		$data['company_list'] = $this->recruitment_model->get_company();

		$data['industry_list'] = $this->recruitment_model->get_industry();

		$data['department_list'] = $this->recruitment_model->get_department();

		$data['status_list'] = $this->recruitment_model->get_status();

		$data['rank_list'] = $this->recruitment_model->get_rank();

		$data['request_renew_list'] = $this->recruitment_model->get_request_renew();

		$data['vessel_list'] = $this->recruitment_model->get_vessel();

		$data['vessel_name_list'] = $this->recruitment_model->get_vessel_name();

		$data['duty_list'] = $this->recruitment_model->get_duty();

		$data['course_list'] = $this->recruitment_model->get_course_type();

		$data['emp_status_list'] = $this->recruitment_model->get_emp_status_list();

		$data['kind_list_license'] = $this->recruitment_model->get_kind_license_type();

		$data['kind_list_document'] = $this->recruitment_model->get_kind_document_type();

		$data['kind_list_flag'] = $this->recruitment_model->get_kind_flag_type();

		$data['relation_list_family'] = $this->recruitment_model->get_relation_list();

		$data['marital_status_list_family'] = $this->recruitment_model->get_marital_status_list();

		$data['country']  = $this->recruitment_model->get_country();

		$data['travel_list']  = $this->recruitment_model->get_travel();

		$data['other_licences']  = $this->recruitment_model->get_other_licence();

		$data['licences_3']  = $this->recruitment_model->get_licence_3();

		$data['licences_4']  = $this->recruitment_model->get_licence_4();

		$data['licences_5']  = $this->recruitment_model->get_licence_5();

		$data['licences_6']  = $this->recruitment_model->get_licence_6();

		$data['contract_of_employee']  = $this->recruitment_model->get_contract_emp();

		$data['state']  = $this->recruitment_model->get_state();

		$data['city']  = $this->recruitment_model->get_city();

		$data['custom_filed_setting_principal_data'] = $this->recruitment_model->get_custom_filed_setting_principal_data();
		$data['custom_filed_setting_salary_scale_data'] = $this->recruitment_model->get_custom_filed_setting_salary_scale_data();


		$data['manning_agency_list'] = $this->recruitment_model->get_manning_agency();
		$this->load->view('manage_setting', $data);
	}

	/**
	 * job position
	 * @return redirect
	 */
	public function job_position()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_job_position($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully', _l('job_position'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=job_position'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_job_position($data, $id);
				if ($success) {
					$message = _l('updated_successfully', _l('job_position'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=job_position'));
			}
			die;
		}
	}

	/**
	 * delete job_position
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_job_position($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=job_position'));
		}
		$response = $this->recruitment_model->delete_job_position($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('job_position')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('job_position')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('job_position')));
		}
		redirect(admin_url('recruitment/setting?group=job_position'));
	}

	/**
	 * recruitmentproposal
	 * @param  string $id 
	 * @return view
	 */
	public function recruitment_proposal($id = '')
	{
		$this->load->model('departments_model');
		$this->load->model('staff_model');
		$this->load->model('currencies_model');
		$data['base_currency'] = $this->currencies_model->get_base_currency();

		$data['departments'] = $this->departments_model->get();
		$data['positions'] = $this->recruitment_model->get_job_position();
		$data['staffs'] = $this->staff_model->get();
		$data['proposal_id'] = $id;

		$data['title'] = _l('recruitment_proposal');
		$this->load->view('recruitment_proposal', $data);
	}

	/**
	 * proposal
	 * @return redirect
	 */
	public function proposal()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			$data = $this->input->post();
			$data['job_description'] = $this->input->post('job_description', false);
			if ($this->input->post('no_editor')) {
				$data['job_description'] = nl2br(clear_textarea_breaks($this->input->post('job_description')));
			}
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_recruitment_proposal($data);
				if ($id) {
					handle_rec_proposal_file($id);
					$success = true;
					$message = _l('added_successfully', _l('recruitment_proposal'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/recruitment_proposal'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_recruitment_proposal($data, $id);
				handle_rec_proposal_file($id);
				if ($success) {
					$message = _l('updated_successfully', _l('recruitment_proposal'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/recruitment_proposal'));
			}
			die;
		}
	}

	/**
	 * delete recruitment proposal
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_recruitment_proposal($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/recruitment_proposal'));
		}
		$response = $this->recruitment_model->delete_recruitment_proposal($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('recruitment_proposal')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('recruitment_proposal')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('recruitment_proposal')));
		}
		redirect(admin_url('recruitment/recruitment_proposal'));
	}

	/**
	 * table proposal
	 * @return
	 */
	public function table_proposal()
	{
		if ($this->input->is_ajax_request()) {
			$this->app->get_table_data(module_views_path('recruitment', 'table_proposal'));
		}
	}

	/**
	 * table campaign
	 * @return
	 */
	public function table_campaign()
	{
		if ($this->input->is_ajax_request()) {
			$this->app->get_table_data(module_views_path('recruitment', 'recruitment_campaign/table_campaign'));
		}
	}

	/**
	 * get proposal data ajax
	 * @param  integer $id
	 * @return view
	 */
	public function get_proposal_data_ajax($id)
	{
		$data['id'] = $id;
		$data['proposals'] = $this->recruitment_model->get_rec_proposal($id);
		$data['proposal_file'] = $this->recruitment_model->get_proposal_file($id);
		$this->load->view('proposal_preview', $data);
	}

	/**
	 * delete proposal attachment
	 * @param  int $id
	 * @return
	 */
	public function delete_proposal_attachment($id)
	{
		$this->load->model('misc_model');
		$file = $this->misc_model->get_file($id);
		if ($file->staffid == get_staff_user_id() || is_admin()) {
			echo html_entity_decode($this->recruitment_model->delete_proposal_attachment($id));
		} else {
			header('HTTP/1.0 400 Bad error');
			echo _l('access_denied');
			die;
		}
	}

	/**
	 * file
	 * @param  int $id
	 * @param  int $rel_id
	 * @return view
	 */
	public function file($id, $rel_id)
	{
		$data['discussion_user_profile_image_url'] = staff_profile_image_url(get_staff_user_id());
		$data['current_user_is_admin'] = is_admin();
		$data['file'] = $this->recruitment_model->get_file($id, $rel_id);
		if (!$data['file']) {
			header('HTTP/1.0 404 Not Found');
			die;
		}
		$this->load->view('_file', $data);
	}

	/**
	 * approve reject proposal
	 * @param  int $type
	 * @param  int $id
	 * @return redirect
	 */
	public function approve_reject_proposal($type, $id)
	{
		$result = $this->recruitment_model->approve_reject_proposal($type, $id);
		if ($result == 'approved') {
			set_alert('success', _l('approved') . ' ' . _l('recruitment_proposal') . ' ' . _l('successfully'));
		} elseif ($result == 'reject') {
			set_alert('success', _l('reject') . ' ' . _l('recruitment_proposal') . ' ' . _l('successfully'));
		} else {
			set_alert('warning', _l('action') . ' ' . _l('fail'));
		}
		redirect(admin_url('recruitment/recruitment_proposal#' . $id));
	}

	/**
	 * recruitment campaign
	 * @param  int $id
	 * @return view
	 */
	public function recruitment_campaign($id = '')
	{
		$this->load->model('departments_model');
		$this->load->model('staff_model');
		$this->load->model('currencies_model');
		$data['base_currency'] = $this->currencies_model->get_base_currency();
		$data['rec_proposal'] = $this->recruitment_model->get_rec_proposal_by_status(2);
		$data['departments'] = $this->departments_model->get();
		$data['positions'] = $this->recruitment_model->get_job_position();
		$data['staffs'] = $this->staff_model->get();
		$data['campaign_id'] = $id;
		$data['rec_channel_form']	= $this->recruitment_model->get_recruitment_channel();
		$data['company_list'] = $this->recruitment_model->get_company();
		$data['title'] = _l('recruitment_campaign');
		$this->load->view('recruitment_campaign/recruitment_campaign', $data);
	}

	/**
	 * campaign
	 * @return redirect
	 */
	public function campaign()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			$data = $this->input->post();
			$data['cp_job_description'] = $this->input->post('cp_job_description', false);
			if ($this->input->post('no_editor')) {
				$data['cp_job_description'] = trim(nl2br(clear_textarea_breaks($this->input->post('cp_job_description'))));
			}
			if (!$this->input->post('cp_id')) {
				$id = $this->recruitment_model->add_recruitment_campaign($data);
				if ($id) {
					handle_rec_campaign_file($id);
					$success = true;
					$message = _l('added_successfully', _l('recruitment_campaign'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/recruitment_campaign'));
			} else {
				$id = $data['cp_id'];
				unset($data['cp_id']);
				$success = $this->recruitment_model->update_recruitment_campaign($data, $id);
				handle_rec_campaign_file($id);
				if ($success) {
					$message = _l('updated_successfully', _l('recruitment_campaign'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/recruitment_campaign'));
			}
			die;
		}
	}

	/**
	 * delete recruitment campaign
	 * @param  int $id
	 * @return redirect
	 */
	public function delete_recruitment_campaign($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/recruitment_campaign'));
		}
		$response = $this->recruitment_model->delete_recruitment_campaign($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('recruitment_campaign')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('recruitment_campaign')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('recruitment_campaign')));
		}
		redirect(admin_url('recruitment/recruitment_campaign'));
	}

	/**
	 * campaign code exists
	 * @return
	 */
	public function campaign_code_exists()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {
				$cp_id = $this->input->post('cp_id');
				if ($cp_id != '') {
					$this->db->where('cp_id', $cp_id);
					$campaign = $this->db->get('tblrec_campaign')->row();
					if ($campaign->campaign_code == $this->input->post('campaign_code')) {
						echo json_encode(true);
						die();
					}
				}
				$this->db->where('campaign_code', $this->input->post('campaign_code'));
				$total_rows = $this->db->count_all_results('tblrec_campaign    ');
				if ($total_rows > 0) {
					echo json_encode(false);
				} else {
					echo json_encode(true);
				}
				die();
			}
		}
	}

	/**
	 * get campaign data ajax
	 * @param  int $id
	 * @return view
	 */
	public function get_campaign_data_ajax($id)
	{
		$this->load->model('departments_model');
		$data['id'] = $id;
		$data['campaigns'] = $this->recruitment_model->get_rec_campaign($id);
		$data['campaign_file'] = $this->recruitment_model->get_campaign_file($id);
		$data['departments'] = $this->departments_model->get();
		$data['rec_channel_form'] = $this->recruitment_model->get_recruitment_channel($data['campaigns']->rec_channel_form_id);
		$this->load->view('recruitment_campaign/campaign_preview', $data);
	}

	/**
	 * campaign file
	 * @param  int $id
	 * @param  int $rel_id
	 * @return
	 */
	public function campaign_file($id, $rel_id)
	{
		$data['discussion_user_profile_image_url'] = staff_profile_image_url(get_staff_user_id());
		$data['current_user_is_admin'] = is_admin();
		$data['file'] = $this->recruitment_model->get_file($id, $rel_id);
		if (!$data['file']) {
			header('HTTP/1.0 404 Not Found');
			die;
		}
		$this->load->view('recruitment_campaign/_file', $data);
	}

	/**
	 * delete campaign attachment
	 * @param  int $id
	 * @return
	 */
	public function delete_campaign_attachment($id)
	{
		$this->load->model('misc_model');
		$file = $this->misc_model->get_file($id);
		if ($file->staffid == get_staff_user_id() || is_admin()) {
			echo html_entity_decode($this->recruitment_model->delete_campaign_attachment($id));
		} else {
			header('HTTP/1.0 400 Bad error');
			echo _l('access_denied');
			die;
		}
	}

	/**
	 * Add Family Info profile
	 * @return view
	 */

	public function add_family_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['add_family_candidate_id'];
		$success = $this->recruitment_model->add_family_info_cadidate($data);
		if ($success == true) {
			$message = _l('added_successfully', _l('candidate_family_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $id));
	}

	/**
	 * Add Education Info profile
	 * @return view
	 */

	public function add_eduaction_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['add_education_candidate_id'];
		$success = $this->recruitment_model->add_education_info_cadidate($data);
		if ($success == true) {
			$message = _l('added_successfully', _l('candidate_education_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $id));
	}

	/**
	 * Add School Info profile
	 * @return view
	 */
	public function add_school_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['add_school_candidate_id'];
		$success = $this->recruitment_model->add_school_info_cadidate($data);
		if ($success == true) {
			$message = _l('added_successfully', _l('candidate_school_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $id));
	}

	/**
	 * candidate profile
	 * @return view
	 */
	public function candidate_profile()
	{
		if ($this->input->get('kanban')) {
			$this->switch_kanban(0, true);
		}

		$data['switch_kanban'] = false;
		$data['bodyclass']     = 'tasks-page';

		if ($this->session->userdata('candidate_profile_kanban_view') == 'true') {
			$data['switch_kanban'] = true;
			$data['bodyclass']     = 'tasks-page kan-ban-body';
		}
		$data['rec_campaigns'] = $this->recruitment_model->get_rec_campaign();

		$data['candidates'] = $this->recruitment_model->get_candidates();
		$data['title'] = _l('candidate_profile');

		$data['country']  = $this->recruitment_model->get_country();
		$data['state']  = $this->recruitment_model->get_state();
		$data['vessel_name_list'] = $this->recruitment_model->get_department();
		$data['rank_list'] = $this->recruitment_model->get_rank();
		$data['emp_status_list'] = $this->recruitment_model->get_emp_status_list();
		$data['manning_agency_list'] = $this->recruitment_model->get_manning_agency_list();

		$this->load->view('candidate_profile/candidate_profile', $data);
	}

	/**
	 * candidates
	 * @param  int $id
	 * @return
	 */

	public function candidates($id = '')
	{
		if ($id != '') {
			$data['candidate'] = $this->recruitment_model->get_candidates($id);
			$country_id = $data['candidate']->address_country;

			if ($country_id != '' && $country_id > 0) {
				$data['edit_states']  = $this->recruitment_model->get_states_by_country($country_id);
			}
			$state_id = $data['candidate']->state;
			if ($state_id != '' && $state_id > 0) {
				$data['edit_cities']  = $this->recruitment_model->get_cities_by_state($state_id);
			}
			$data['title'] = $data['candidate']->candidate_name . ' ' . $data['candidate']->last_name;
		} else {
			$data['title'] = _l('new_candidate');
		}
		$this->load->model('currencies_model');
		$data['base_currency'] = $this->currencies_model->get_base_currency();

		$data['rec_campaigns'] = $this->recruitment_model->get_rec_campaign();
		$data['skills'] = $this->recruitment_model->get_skill();
		$data['ranks'] = $this->recruitment_model->get_rank();
		$data['course_list'] = $this->recruitment_model->get_course_type();
		$data['vessel_list'] = $this->recruitment_model->get_vessel();
		$data['vessel_name_list'] = $this->recruitment_model->get_vessel_name();
		$data['duty_list'] = $this->recruitment_model->get_duty();
		$data['status_data'] = $this->recruitment_model->get_status();
		$data['kind_list_license'] = $this->recruitment_model->get_kind_license_type();
		$data['kind_list_document'] = $this->recruitment_model->get_kind_document_type();
		$data['kind_list_flag'] = $this->recruitment_model->get_kind_flag_type();
		$data['relation_list_family'] = $this->recruitment_model->get_relation_list();
		$data['marital_status_list_family'] = $this->recruitment_model->get_marital_status_list();

		$data['countries'] = $this->recruitment_model->get_country();
		$data['states'] = $this->recruitment_model->get_state();
		$data['cities'] = $this->recruitment_model->get_city();
		$data['department_data'] = $this->recruitment_model->get_department();
		$data['emp_status_list'] = $this->recruitment_model->get_emp_status_list();
		$data['manning_agency_list'] = $this->recruitment_model->get_manning_agency_list();
		$this->load->view('candidate_profile/candidate', $data);
	}

	/**
	 * update Personal Info
	 * @param int $id
	 */

	public function personal_info($id = '')
	{
		if ($id != '') {
			$data = $this->input->get();
			$success = $this->recruitment_model->update_personal_info($data, $id);
			if ($success == true) {
				$message = _l('updated_successfully', _l('candidate_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $id));
		}
	}

	public function emergency_info($id = '')
	{
		if ($id != '') {
			$data = $this->input->get();
			$success = $this->recruitment_model->update_emergency_info($data, $id);
			if ($success == true) {
				$message = _l('updated_successfully', _l('candidate_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $id));
		}
	}


	/**
	 * Edit Family Info
	 * @param int $id
	 */
	public function editFamilyCandidate($id = '')
	{
		if ($id != '') {
			$family_info = $this->recruitment_model->get_family_candidate($id);
			$family_info->birthday = _d($family_info->birthday);
		}
		echo json_encode($family_info);
		die;
	}

	/**
	 * Edit Education Info
	 * @param int $id
	 */
	public function editEducationCandidate($id = '')
	{
		if ($id != '') {
			$eduacation_info = $this->recruitment_model->get_education_candidate($id);
			$eduacation_info->edu_start_date = _d($eduacation_info->edu_start_date);
			$eduacation_info->edu_finish_date = _d($eduacation_info->edu_finish_date);
			$eduacation_info->edu_date = _d($eduacation_info->edu_date);
			$eduacation_info->valid_date = _d($eduacation_info->valid_date);
		}
		echo json_encode($eduacation_info);
		die;
	}

	public function editSchoolCandidate($id = '')
	{
		if ($id != '') {
			$school_info = $this->recruitment_model->get_school_candidate($id);
			$school_info->enterance_date = _d($school_info->enterance_date);
			$school_info->graduation_date = _d($school_info->graduation_date);
		}
		echo json_encode($school_info);
		die;
	}

	public function deleteFamilyCandidate($id = '')
	{
		if ($id != '') {
			$data = $this->recruitment_model->get_family_candidate($id);
			$candidateId = $data->candidate;
			unset($data);
			$success = $this->recruitment_model->delete_family_candidate($id);
		}

		if ($success == true) {
			$response['message'] = _l('deleted_successfully', _l('family_profile'));
		}

		echo json_encode($response);
		die;
	}

	public function deleteEducationCandidate($id = '')
	{
		if ($id != '') {
			$data = $this->recruitment_model->get_education_candidate($id);
			unset($data);
			$success = $this->recruitment_model->delete_education_candidate($id);
		}

		if ($success == true) {
			$response['message'] = _l('deleted_successfully', _l('education_profile'));
		}

		echo json_encode($response);
		die;
	}

	public function deleteSchoolCandidate($id = '')
	{
		if ($id != '') {
			$success = $this->recruitment_model->delete_school_candidate($id);
		}

		if ($success == true) {
			$response['message'] = _l('deleted_successfully', _l('school_profile'));
		}

		echo json_encode($response);
		die;
	}

	public function deleteRewardCandidate($id = '')
	{
		if ($id != '') {
			$data = $this->recruitment_model->get_reward_candidate($id);
			$filename = $data->reward_file;
			unset($data);
			$success = $this->recruitment_model->delete_reward_candidate($id);
		}

		if ($success == true) {
			$rewardfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/reward_file');

			$targetDir = $rewardfileDir . $filename;

			if (file_exists($targetDir)) {
				unlink($targetDir);
			}
			$response['message'] = _l('deleted_successfully', _l('reward_profile'));
		}
		echo json_encode($response);
		die;
	}

	public function deleteLicenseCandidate($id = '')
	{
		if ($id != '') {
			$data = $this->recruitment_model->get_licence_candidate($id);
			$filename = $data->attach_file;
			unset($data);
			$success = $this->recruitment_model->delete_licence_candidate($id);
		}

		if ($success == true) {
			$licensefileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_file');

			$targetDir = $licensefileDir . $filename;

			if (file_exists($targetDir)) {
				unlink($targetDir);
			}
			$response['message'] = _l('deleted_successfully', _l('licence_profile'));
		}
		echo json_encode($response);
		die;
	}

	public function deletePassportCandidate($id = '')
	{
		if ($id != '') {
			$data = $this->recruitment_model->get_passport_candidate($id);
			$filename = $data->attach_file;
			unset($data);
			$success = $this->recruitment_model->delete_passport_candidate($id);
		}

		if ($success == true) {
			$passportfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/passport_file');

			$targetDir = $passportfileDir . $filename;

			if (file_exists($targetDir)) {
				unlink($targetDir);
			}
			$response['message'] = _l('deleted_successfully', _l('passport_profile'));
		}
		echo json_encode($response);
		die;
	}


	public function deleteDocumentCandidate($id = '')
	{
		if ($id != '') {
			$data = $this->recruitment_model->get_document_candidate($id);
			$filename = $data->attach_file;
			unset($data);
			$success = $this->recruitment_model->delete_document_candidate($id);
		}

		if ($success == true) {
			$documentfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/document_file');

			$targetDir = $documentfileDir . $filename;

			if (file_exists($targetDir)) {
				unlink($targetDir);
			}
			$response['message'] = _l('deleted_successfully', _l('document_profile'));
		}
		echo json_encode($response);
		die;
	}

	public function deleteFlagCandidate($id = '')
	{
		if ($id != '') {
			$data = $this->recruitment_model->get_flag_candidate($id);
			$filename = $data->attach_file;
			unset($data);
			$success = $this->recruitment_model->delete_flag_candidate($id);
		}

		if ($success == true) {
			$flagfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/flag_file');

			$targetDir = $flagfileDir . $filename;

			if (file_exists($targetDir)) {
				unlink($targetDir);
			}
			$response['message'] = _l('deleted_successfully', _l('flag_profile'));
		}
		echo json_encode($response);
		die;
	}

	public function deleteMedicalCandidate($id = '')
	{
		if ($id != '') {
			$success = $this->recruitment_model->delete_medical_candidate($id);

			if ($success == true) {

				$response['message'] = _l('deleted_successfully', _l('medical_profile'));
			}
			echo json_encode($response);
			die;
		}
	}

	public function deletePromotionCandidate($id = '')
	{
		if ($id != '') {
			$success = $this->recruitment_model->delete_promotion_candidate($id);

			if ($success == true) {

				$response['message'] = _l('deleted_successfully', _l('promotion_profile'));
			}
			echo json_encode($response);
			die;
		}
	}

	public function deletePscCandidate($id = '')
	{
		if ($id != '') {
			$success = $this->recruitment_model->delete_psi_candidate($id);

			if ($success == true) {

				$response['message'] = _l('deleted_successfully', _l('psi_profile'));
			}
			echo json_encode($response);
			die;
		}
	}

	public function update_family_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['family_info_id'];
		$candidateId = $data['family_candidate_id'];
		unset($data['family_info_id']);
		$success = $this->recruitment_model->update_family_info_cadidate($data, $id);
		if ($success == true) {
			$message = _l('updated_successfully', _l('candidate_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidateId));
	}

	public function update_eduaction_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['education_id'];
		$candidateId = $data['edit_education_candidate_id'];
		unset($data['edit_education_candidate_id']);
		unset($data['education_id']);
		$success = $this->recruitment_model->update_education_info_cadidate($data, $id);
		if ($success == true) {
			$message = _l('updated_successfully', _l('candidate_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidateId));
	}

	public function update_school_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['school_id'];
		$candidateId = $data['edit_school_candidate_id'];
		unset($data['edit_school_candidate_id']);
		unset($data['school_id']);
		$success = $this->recruitment_model->update_school_info_cadidate($data, $id);
		if ($success == true) {
			$message = _l('updated_successfully', _l('candidate_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidateId));
	}



	/**
	 * add update candidate
	 * @param int $id
	 */
	public function add_update_candidate($id = '')
	{

		$data = $this->input->post();
		if ($data) {
			if ($id == '') {
				$ids = $this->recruitment_model->add_candidate($data, $_FILES);
				if ($ids) {
					handle_rec_candidate_file($ids);
					handle_rec_candidate_avar_file($ids);
					// 	$this->add_defult_contract_for_new_crew_member($ids);
					$success = true;
					$message = _l('added_successfully', _l('candidate_profile'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/candidate/' . $ids . '#detail'));
			} else {
				$success = $this->recruitment_model->update_cadidate($data, $id, $_FILES);
				if ($success == true) {
					handle_rec_candidate_file($id);
					handle_rec_candidate_avar_file($id);
					$message = _l('updated_successfully', _l('candidate_profile'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/candidate/' . $id . '#detail'));
			}
		}
	}

	public function add_update_reward_detail_candidate()
	{

		$data = $this->input->post();
		$id = $data['reward_id'];
		$candidate_id = $data['add_reward_candidate_id'];
		$rewardfileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/reward_file/';

		if ($id != '') {
			if (!empty($_FILES['reward_file']['tmp_name']) && $_FILES['reward_file']['tmp_name'] != '') {
				$getFiledata = $this->recruitment_model->get_reward_candidate($id);
				$oldfilename = $getFiledata->reward_file;
				$tmpFilePath = $_FILES['reward_file']['tmp_name'];
				_maybe_create_upload_path($rewardfileDir);
				$filename = unique_filename($rewardfileDir, $_FILES['reward_file']['name']);
				$newFilePath = $rewardfileDir . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
			}
			$data['reward_file'] = isset($filename) ? $filename : '';

			$success = $this->recruitment_model->update_reward_info_cadidate($data);
			if ($success == true) {
				$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/reward_file');

				$OldtargetDir = $removeoldfile . $oldfilename;

				if (file_exists($OldtargetDir)) {
					unlink($OldtargetDir);
				}

				$message = _l('added_successfully', _l('candidate_reward_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {
			if (!empty($_FILES['reward_file']['tmp_name']) && $_FILES['reward_file']['tmp_name'] != '') {
				$tmpFilePath = $_FILES['reward_file']['tmp_name'];
				_maybe_create_upload_path($rewardfileDir);
				$filename = unique_filename($rewardfileDir, $_FILES['reward_file']['name']);
				$newFilePath = $rewardfileDir . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
			}

			$data['reward_file'] = isset($filename) ? $filename : '';

			$success = $this->recruitment_model->add_reward_info_cadidate($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('candidate_reward_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}


	public function add_update_licence_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['licence_id'];
		$candidate_id = $data['add_licence_candidate_id'];
		$licencefileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/licence_file/';

		if ($id != '') {

			if (!empty($_FILES['licence_attach_file']['tmp_name']) && $_FILES['licence_attach_file']['tmp_name'] != '') {
				$getFiledata = $this->recruitment_model->get_licence_candidate($id);
				$oldfilename = $getFiledata->attach_file;
				$tmpFilePath = $_FILES['licence_attach_file']['tmp_name'];
				_maybe_create_upload_path($licencefileDir);
				$filename = unique_filename($licencefileDir, $_FILES['licence_attach_file']['name']);
				$newFilePath = $licencefileDir . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
			}
			$data['licence_attach_file'] = isset($filename) ? $filename : '';


			$success = $this->recruitment_model->update_licence_info_cadidate($data);
			if ($success == true) {
				$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_file');
				$OldtargetDir = $removeoldfile . $oldfilename;
				if (file_exists($OldtargetDir)) {
					unlink($OldtargetDir);
				}
				$message = _l('updated_successfully', _l('candidate_licence_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {

			if (!empty($_FILES['licence_attach_file']['tmp_name']) && $_FILES['licence_attach_file']['tmp_name'] != '') {
				$tmpFilePath = $_FILES['licence_attach_file']['tmp_name'];
				_maybe_create_upload_path($licencefileDir);
				$filename = unique_filename($licencefileDir, $_FILES['licence_attach_file']['name']);
				$newFilePath = $licencefileDir . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
			}

			$data['licence_attach_file'] = isset($filename) ? $filename : '';

			$success = $this->recruitment_model->add_licence_info_cadidate($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('candidate_licence_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}

	public function add_update_passpord_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['passport_id'];
		$candidate_id = $data['add_passport_candidate_id'];
		$passpportfileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/passport_file/';

		if ($id != '') {

			if (!empty($_FILES['attach_file']['tmp_name']) && $_FILES['attach_file']['tmp_name'] != '') {
				$getFiledata = $this->recruitment_model->get_passport_candidate($id);
				$oldfilename = $getFiledata->attach_file;
				$tmpFilePath = $_FILES['attach_file']['tmp_name'];
				_maybe_create_upload_path($passpportfileDir);
				$filename = unique_filename($passpportfileDir, $_FILES['attach_file']['name']);
				$newFilePath = $passpportfileDir . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
			}
			$data['attach_file'] = isset($filename) ? $filename : '';



			$success = $this->recruitment_model->update_passport_info_cadidate($data);
			if ($success) {
				if (!empty($data['attach_file'])) {
					$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/passport_file');
					$OldtargetDir = $removeoldfile . $oldfilename;

					if (file_exists($OldtargetDir)) {
						unlink($OldtargetDir);
					}
				}
				$message = _l('updated_successfully', _l('candidate_licence_profile'));
				set_alert('success', $message);
			} else {
				$message = _l('error_document_type');
				set_alert('danger', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {

			if (!empty($_FILES['attach_file']['tmp_name']) && $_FILES['attach_file']['tmp_name'] != '') {
				$tmpFilePath = $_FILES['attach_file']['tmp_name'];
				_maybe_create_upload_path($passpportfileDir);
				$filename = unique_filename($passpportfileDir, $_FILES['attach_file']['name']);
				$newFilePath = $passpportfileDir . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
			}

			$data['attach_file'] = isset($filename) ? $filename : '';

			$success = $this->recruitment_model->add_passport_info_candidate($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('candidate_passport_profile'));
				set_alert('success', $message);
			} else {
				$message = _l('error_document_type');
				set_alert('danger', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}

	public function add_update_travel_detail_candidate()
	{
		$data = $this->input->post();

		$id = $data['travel_id'];
		$candidate_id = $data['add_travel_candidate_id'];
		$travelfileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/travel_file/';

		$filename = '';

		if (!empty($_FILES['attach_file']['tmp_name']) && $_FILES['attach_file']['tmp_name'] != '') {
			$getFiledata = $this->recruitment_model->get_travel_info($id);
			$oldfilename = $getFiledata->attach_file;
			$tmpFilePath = $_FILES['attach_file']['tmp_name'];
			_maybe_create_upload_path($travelfileDir);
			$filename = unique_filename($travelfileDir, $_FILES['attach_file']['name']);
			$newFilePath = $travelfileDir . $filename;
			move_uploaded_file($tmpFilePath, $newFilePath);
		}
		$data['attach_file'] = isset($filename) ? $filename : '';

		$success = $this->recruitment_model->add_update_travel_info_cadidate($data);
		if ($success == true) {
			$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/travel_file');

			$OldtargetDir = $removeoldfile . $oldfilename;

			if (file_exists($OldtargetDir)) {
				unlink($OldtargetDir);
			}

			$message = _l('updated_successfully', _l('candidate_travel_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}


	public function add_update_other_licence_detail_candidate()
	{
		$data = $this->input->post();

		$id = $data['other_licence_id'];
		$candidate_id = $data['add_other_licence_candidate_id'];
		$otherlicencefileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/other_licence_file/';

		$filename = '';

		if (!empty($_FILES['attach_file']['tmp_name']) && $_FILES['attach_file']['tmp_name'] != '') {
			$getFiledata = $this->recruitment_model->get_other_license_info($id);
			$oldfilename = $getFiledata->attach_file;
			$tmpFilePath = $_FILES['attach_file']['tmp_name'];
			_maybe_create_upload_path($otherlicencefileDir);
			$filename = unique_filename($otherlicencefileDir, $_FILES['attach_file']['name']);
			$newFilePath = $otherlicencefileDir . $filename;
			move_uploaded_file($tmpFilePath, $newFilePath);
		}
		$data['attach_file'] = isset($filename) ? $filename : '';

		$success = $this->recruitment_model->add_update_other_licence_detail_candidate($data);
		if ($success == true) {
			$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/other_licence_file');

			$OldtargetDir = $removeoldfile . $oldfilename;

			if (file_exists($OldtargetDir)) {
				unlink($OldtargetDir);
			}

			$message = _l('updated_successfully', _l('candidate_travel_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}

	public function add_update_licence_3_detail_candidate()
	{
		$data = $this->input->post();

		$id = $data['licence_3_id'];
		$candidate_id = $data['add_licence_3_candidate_id'];
		$licence3fileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/licence_3_file/';

		$filename = '';

		if (!empty($_FILES['attach_file']['tmp_name']) && $_FILES['attach_file']['tmp_name'] != '') {
			$getFiledata = $this->recruitment_model->get_license_3_info($id);
			$oldfilename = $getFiledata->attach_file;
			$tmpFilePath = $_FILES['attach_file']['tmp_name'];
			_maybe_create_upload_path($licence3fileDir);
			$filename = unique_filename($licence3fileDir, $_FILES['attach_file']['name']);
			$newFilePath = $licence3fileDir . $filename;
			move_uploaded_file($tmpFilePath, $newFilePath);
		}
		$data['attach_file'] = isset($filename) ? $filename : '';

		$success = $this->recruitment_model->add_update_licence_3_detail_candidate($data);
		if ($success == true) {
			$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_3_file');

			$OldtargetDir = $removeoldfile . $oldfilename;

			if (file_exists($OldtargetDir)) {
				unlink($OldtargetDir);
			}

			$message = _l('updated_successfully', _l('candidate_travel_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}


	public function add_update_licence_4_detail_candidate()
	{
		$data = $this->input->post();

		$id = $data['licence_4_id'];
		$candidate_id = $data['add_licence_4_candidate_id'];
		$licence4fileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/licence_4_file/';

		$filename = '';

		if (!empty($_FILES['attach_file']['tmp_name']) && $_FILES['attach_file']['tmp_name'] != '') {
			$getFiledata = $this->recruitment_model->get_license_4_info($id);
			$oldfilename = $getFiledata->attach_file;
			$tmpFilePath = $_FILES['attach_file']['tmp_name'];
			_maybe_create_upload_path($licence4fileDir);
			$filename = unique_filename($licence4fileDir, $_FILES['attach_file']['name']);
			$newFilePath = $licence4fileDir . $filename;
			move_uploaded_file($tmpFilePath, $newFilePath);
		}
		$data['attach_file'] = isset($filename) ? $filename : '';

		$success = $this->recruitment_model->add_update_licence_4_detail_candidate($data);
		if ($success == true) {
			$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_4_file');

			$OldtargetDir = $removeoldfile . $oldfilename;

			if (file_exists($OldtargetDir)) {
				unlink($OldtargetDir);
			}

			$message = _l('updated_successfully', _l('candidate_travel_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}



	public function add_update_licence_5_detail_candidate()
	{
		$data = $this->input->post();

		$id = $data['licence_5_id'];
		$candidate_id = $data['add_licence_5_candidate_id'];
		$licence5fileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/licence_5_file/';

		$filename = '';

		if (!empty($_FILES['attach_file']['tmp_name']) && $_FILES['attach_file']['tmp_name'] != '') {
			$getFiledata = $this->recruitment_model->get_license_5_info($candidate_id, $id);
			$oldfilename = $getFiledata->attach_file;
			$tmpFilePath = $_FILES['attach_file']['tmp_name'];
			_maybe_create_upload_path($licence5fileDir);
			$filename = unique_filename($licence5fileDir, $_FILES['attach_file']['name']);
			$newFilePath = $licence5fileDir . $filename;
			move_uploaded_file($tmpFilePath, $newFilePath);
		}
		$data['attach_file'] = isset($filename) ? $filename : '';

		$success = $this->recruitment_model->add_update_licence_5_detail_candidate($data);
		if ($success == true) {
			$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_5_file');

			$OldtargetDir = $removeoldfile . $oldfilename;

			if (file_exists($OldtargetDir)) {
				unlink($OldtargetDir);
			}

			$message = _l('updated_successfully', _l('candidate_travel_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}

	public function add_update_licence_6_detail_candidate()
	{
		$data = $this->input->post();

		$id = $data['licence_6_id'];
		$candidate_id = $data['add_licence_6_candidate_id'];
		$licence6fileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/licence_6_file/';

		$filename = '';

		if (!empty($_FILES['attach_file']['tmp_name']) && $_FILES['attach_file']['tmp_name'] != '') {
			$getFiledata = $this->recruitment_model->get_license_6_info($candidate_id, $id);
			$oldfilename = $getFiledata->attach_file;
			$tmpFilePath = $_FILES['attach_file']['tmp_name'];
			_maybe_create_upload_path($licence6fileDir);
			$filename = unique_filename($licence6fileDir, $_FILES['attach_file']['name']);
			$newFilePath = $licence6fileDir . $filename;
			move_uploaded_file($tmpFilePath, $newFilePath);
		}
		$data['attach_file'] = isset($filename) ? $filename : '';

		$success = $this->recruitment_model->add_update_licence_6_detail_candidate($data);
		if ($success == true) {
			$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_6_file');

			$OldtargetDir = $removeoldfile . $oldfilename;

			if (file_exists($OldtargetDir)) {
				unlink($OldtargetDir);
			}

			$message = _l('updated_successfully', _l('candidate_travel_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}


	public function update_renew_request()
	{
		$data = $this->input->post();

		$candidate_id = $data['add_travel_candidate_id'];

		$success = $this->recruitment_model->update_renew_request($data);
		if ($success == true) {
			$message = _l('updated_successfully', _l('candidate_travel_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}

	public function add_update_contract_detail_candidate()
	{
		$data = $this->input->post();

		$id = $data['contract_id'];
		$candidate_id = $data['add_contract_candidate_id'];
		$contractfileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/contract_file/';

		if (!empty($_FILES['attach_file']['tmp_name']) && $_FILES['attach_file']['tmp_name'] != '') {
			$getFiledata = $this->recruitment_model->get_travel_info($id);
			$oldfilename = $getFiledata->attach_file;
			$tmpFilePath = $_FILES['attach_file']['tmp_name'];
			_maybe_create_upload_path($contractfileDir);
			$filename = unique_filename($contractfileDir, $_FILES['attach_file']['name']);
			$newFilePath = $contractfileDir . $filename;
			move_uploaded_file($tmpFilePath, $newFilePath);
		}
		$data['attach_file'] = isset($filename) ? $filename : '';

		$success = $this->recruitment_model->add_update_contract_info_cadidate($data);
		if ($success == true) {
			$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/passport_file');

			$OldtargetDir = $removeoldfile . $oldfilename;

			if (file_exists($OldtargetDir)) {
				unlink($OldtargetDir);
			}

			$message = _l('updated_successfully', _l('candidate_licence_profile'));
			set_alert('success', $message);
		}
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}



	public function add_update_document_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['document_id'];
		$candidate_id = $data['add_document_candidate_id'];
		$documentfileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/document_file/';

		if ($id != '') {
			if (!empty($_FILES['doc_attach_file']['tmp_name']) && $_FILES['doc_attach_file']['tmp_name'] != '') {
				$getFiledata = $this->recruitment_model->get_document_candidate($id);
				$oldfilename = $getFiledata->attach_file;
				$tmpFilePath = $_FILES['doc_attach_file']['tmp_name'];
				_maybe_create_upload_path($documentfileDir);
				$filename = unique_filename($documentfileDir, $_FILES['doc_attach_file']['name']);
				$newFilePath = $documentfileDir . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
			}

			$data['doc_attach_file'] = isset($filename) ? $filename : '';

			$success = $this->recruitment_model->update_document_info_cadidate($data);
			if ($success == true) {
				$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/document_file');
				$OldtargetDir = $removeoldfile . $oldfilename;
				if (file_exists($OldtargetDir)) {
					unlink($OldtargetDir);
				}
				$message = _l('updated_successfully', _l('candidate_document_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {
			if (!empty($_FILES['doc_attach_file']['tmp_name']) && $_FILES['doc_attach_file']['tmp_name'] != '') {
				$tmpFilePath = $_FILES['doc_attach_file']['tmp_name'];
				_maybe_create_upload_path($documentfileDir);
				$filename = unique_filename($documentfileDir, $_FILES['doc_attach_file']['name']);
				$newFilePath = $documentfileDir . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
			}

			$data['doc_attach_file'] = isset($filename) ? $filename : '';

			$success = $this->recruitment_model->add_document_info_cadidate($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('candidate_document_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}

	public function add_update_flag_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['flag_id'];
		$candidate_id = $data['add_flag_candidate_id'];
		$flagfileDir = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/flag_file/';

		if ($id != '') {
			if (!empty($_FILES['flag_attach_file']['tmp_name']) && $_FILES['flag_attach_file']['tmp_name'] != '') {
				$getFiledata = $this->recruitment_model->get_flag_candidate($id);
				$oldfilename = $getFiledata->attach_file;
				$tmpFilePath = $_FILES['flag_attach_file']['tmp_name'];
				_maybe_create_upload_path($flagfileDir);
				$filename = unique_filename($flagfileDir, $_FILES['flag_attach_file']['name']);
				$newFilePath = $flagfileDir . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
			}

			$data['flag_attach_file'] = isset($filename) ? $filename : '';

			$success = $this->recruitment_model->update_flag_info_cadidate($data);
			if ($success == true) {
				$removeoldfile = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/flag_file');
				$OldtargetDir = $removeoldfile . $oldfilename;
				if (file_exists($OldtargetDir)) {
					unlink($OldtargetDir);
				}
				$message = _l('updated_successfully', _l('candidate_flag_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {
			if (!empty($_FILES['flag_attach_file']['tmp_name']) && $_FILES['flag_attach_file']['tmp_name'] != '') {
				$tmpFilePath = $_FILES['flag_attach_file']['tmp_name'];
				_maybe_create_upload_path($flagfileDir);
				$filename = unique_filename($flagfileDir, $_FILES['flag_attach_file']['name']);
				$newFilePath = $flagfileDir . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
			}

			$data['flag_attach_file'] = isset($filename) ? $filename : '';

			$success = $this->recruitment_model->add_flag_info_cadidate($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('candidate_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}

	/**
	 * Add Update Medical
	 * @return
	 */

	public function add_update_medical_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['medical_id'];
		$candidate_id = $data['add_medical_candidate_id'];

		if ($id != '') {
			$success = $this->recruitment_model->update_medical_info_cadidate($data);
			if ($success == true) {
				$message = _l('updated_successfully', _l('candidate_medical_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {
			$success = $this->recruitment_model->add_medical_info_cadidate($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('candidate_medical_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}

	/**
	 * Add Update Promotion
	 * @return
	 */

	public function add_update_Promotion_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['promotion_id'];
		$candidate_id = $data['add_promotion_candidate_id'];

		if ($id != '') {
			$success = $this->recruitment_model->update_promotion_info_cadidate($data);
			if ($success == true) {
				$message = _l('updated_successfully', _l('candidate_promotion_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {
			$success = $this->recruitment_model->add_promotion_info_cadidate($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('candidate_promotion_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}

	/**
	 * Add Update PSC
	 * @return
	 */

	public function add_update_psi_detail_candidate()
	{
		$data = $this->input->post();
		$id = $data['psc_id'];
		$candidate_id = $data['add_psc_candidate_id'];
		if ($id != '') {
			$success = $this->recruitment_model->update_psi_info_cadidate($data);
			if ($success == true) {
				$message = _l('updated_successfully', _l('candidate_psc_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {
			$success = $this->recruitment_model->add_psi_info_cadidate($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('candidate_psc_profile'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}

	/**
	 * Edit Reward
	 * @return
	 */

	public function edit_reward_detail_candidate($id = '')
	{
		if ($id != '') {
			$reward_info = $this->recruitment_model->get_reward_candidate($id);
			$reward_info->app_date = _d($reward_info->app_date);
		}
		echo json_encode($reward_info);
		die;
	}

	/**
	 * Edit Licence_info
	 * @return
	 */

	public function edit_licence_detail_candidate($id = '')
	{
		if ($id != '') {
			$licence_info = $this->recruitment_model->get_licence_candidate($id);
			$licence_info->acquisition_date = _d($licence_info->acquisition_date);
			$licence_info->exipiry_date = _d($licence_info->exipiry_date);
		}
		echo json_encode($licence_info);
		die;
	}

	public function edit_passport_detail_candidate($id = '')
	{
		if ($id != '') {
			$passport_info = $this->recruitment_model->get_passport_candidate($id);
			$passport_info->acquisition_date = _d($passport_info->acquisition_date);
			$passport_info->exipiry_date = _d($passport_info->exipiry_date);
			$passport_info->issue_date = _d($passport_info->issue_date);
		}
		echo json_encode($passport_info);
		die;
	}

	public function edit_travel_detail_candidate($candidate_id = '', $id = '')
	{
		$travel_info = $this->recruitment_model->get_travel_info($id);
		if ($travel_info === null) {
			echo json_encode(['error' => 'No travel information found for the given criteria.']);
			return;
		}
		$travel_info->acquisition_date = _d($travel_info->acquisition_date);
		$travel_info->expiry_date = _d($travel_info->expiry_date);
		echo json_encode($travel_info);
	}


	public function edit_other_license_detail_candidate($candidate_id = '', $id = '')
	{
		$other_licence_info = $this->recruitment_model->get_other_license_info($id);
		$other_licence_info->acquisition_date = _d($other_licence_info->acquisition_date);
		$other_licence_info->expiry_date = _d($other_licence_info->expiry_date);
		echo json_encode($other_licence_info);
	}


	public function edit_license_3_detail_candidate($candidate_id = '', $id = '')
	{
		$licence_3_info = $this->recruitment_model->get_license_3_info($id);
		$licence_3_info->acquisition_date = _d($licence_3_info->acquisition_date);
		$licence_3_info->expiry_date = _d($licence_3_info->expiry_date);
		echo json_encode($licence_3_info);
	}

	public function edit_license_4_detail_candidate($candidate_id = '', $id = '')
	{
		$licence_4_info = $this->recruitment_model->get_license_4_info($id);
		$licence_4_info->acquisition_date = _d($licence_4_info->acquisition_date);
		$licence_4_info->expiry_date = _d($licence_4_info->expiry_date);
		echo json_encode($licence_4_info);
	}

	public function edit_license_5_detail_candidate($candidate_id = '', $id = '')
	{
		$licence_5_info = $this->recruitment_model->get_license_5_info($id);
		$licence_5_info->acquisition_date = _d($licence_5_info->acquisition_date);
		$licence_5_info->expiry_date = _d($licence_5_info->expiry_date);
		echo json_encode($licence_5_info);
	}

	public function edit_license_6_detail_candidate($candidate_id = '', $id = '')
	{
		$licence_6_info = $this->recruitment_model->get_license_6_info($id);
		$licence_6_info->acquisition_date = _d($licence_6_info->acquisition_date);
		$licence_6_info->expiry_date = _d($licence_6_info->expiry_date);
		echo json_encode($licence_6_info);
	}

	public function edit_contract_detail_candidate($candidate_id = '', $id = '')
	{
		$contract_info = $this->recruitment_model->get_contract_info($candidate_id, $id);
		$contract_info->acquisition_date = _d($contract_info->acquisition_date);
		$contract_info->expiry_date = _d($contract_info->expiry_date);
		echo json_encode($contract_info);
		die;
	}

	/**
	 * Edit Document
	 * @return
	 */

	public function edit_document_detail_candidate($id = '')
	{
		if ($id != '') {
			$document_info = $this->recruitment_model->get_document_candidate($id);
			$document_info->issue_date = _d($document_info->issue_date);
			$document_info->exipiry_date = _d($document_info->exipiry_date);
		}
		echo json_encode($document_info);
		die;
	}

	/**
	 * Edit Flag
	 * @return
	 */

	public function edit_flag_detail_candidate($id = '')
	{
		if ($id != '') {
			$flag_info = $this->recruitment_model->get_flag_candidate($id);
			$flag_info->issue_date = _d($flag_info->issue_date);
			$flag_info->exipiry_date = _d($flag_info->exipiry_date);
		}
		echo json_encode($flag_info);
		die;
	}

	/**
	 * Edit Medical
	 * @return
	 */

	public function edit_medical_detail_candidate($id = '')
	{
		if ($id != '') {
			$medical_info = $this->recruitment_model->get_medical_candidate($id);
			$medical_info->medical_test_date = _d($medical_info->medical_test_date);
			$medical_info->valid_test_date = _d($medical_info->valid_test_date);
		}
		echo json_encode($medical_info);
		die;
	}

	/**
	 * Edit Promotion
	 * @return
	 */

	public function edit_promotion_detail_candidate($id = '')
	{
		if ($id != '') {
			$promotion_info = $this->recruitment_model->get_promotion_candidate($id);
			$promotion_info->app_date = _d($promotion_info->app_date);
		}
		echo json_encode($promotion_info);
		die;
	}

	/**
	 * Edit PSC
	 * @return
	 */

	public function edit_psc_detail_candidate($id = '')
	{
		if ($id != '') {
			$psc_info = $this->recruitment_model->get_psc_candidate($id);
			$psc_info->date = _d($psc_info->date);
		}
		echo json_encode($psc_info);
		die;
	}

	/**
	 * table candidates
	 * @return
	 */
	public function table_candidates()
	{
		if ($this->input->is_ajax_request()) {
			$this->app->get_table_data(module_views_path('recruitment', 'candidate_profile/table_candidates'));
		}
	}

	/**
	 * change status campaign
	 * @param  int $status
	 * @param  int $cp_id
	 * @return
	 */
	public function change_status_campaign($status, $cp_id)
	{
		$change = $this->recruitment_model->change_status_campaign($status, $cp_id);
		if ($change == true) {
			$message = _l('change_status_campaign') . ' ' . _l('successfully');
			echo json_encode([
				'result' => $message,
			]);
		} else {
			$message = _l('change_status_campaign') . ' ' . _l('fail');
			echo json_encode([
				'result' => $message,
			]);
		}
	}

	/**
	 * candidate code exists
	 * @return
	 */
	public function candidate_code_exists()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {
				$candidate = $this->input->post('candidate');
				if ($candidate != '') {
					$this->db->where('id', $candidate);
					$cd = $this->db->get('tblrec_candidate')->row();
					if ($cd->candidate_code == $this->input->post('candidate_code')) {
						echo json_encode(true);
						die();
					}
				}
				$this->db->where('candidate_code', $this->input->post('candidate_code'));
				$total_rows = $this->db->count_all_results('tblrec_candidate');
				if ($total_rows > 0) {
					echo json_encode(false);
				} else {
					echo json_encode(true);
				}
				die();
			}
		}
	}

	/**
	 * candidate email exists
	 * @return
	 */
	public function candidate_email_exists()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {
				$candidate = $this->input->post('candidate');
				if ($candidate != '') {
					$this->db->where('id', $candidate);
					$_current_email = $this->db->get(db_prefix() . 'rec_candidate')->row();
					if ($_current_email->email == $this->input->post('email')) {
						echo json_encode(true);
						die();
					}
				}
				$this->db->where('email', $this->input->post('email'));
				$total_rows = $this->db->count_all_results(db_prefix() . 'rec_candidate');
				if ($total_rows > 0) {
					echo json_encode(false);
				} else {
					echo json_encode(true);
				}
				die();
			}
		}
	}

	/**
	 * interview schedule
	 * @param  int $id
	 * @return view
	 */
	public function interview_schedule($id = '')
	{
		$data['staffs'] = $this->staff_model->get();
		$data['candidates'] = $this->recruitment_model->get_candidates();
		$data['list_cd'] = $this->recruitment_model->get_list_cd();
		$data['rec_campaigns'] = $this->recruitment_model->get_rec_campaign();
		$data['positions'] = $this->recruitment_model->get_job_position();
		$data['interview_id'] = $id;
		$data['title'] = _l('interview_schedule');
		$this->load->view('interview_schedule/interview_schedule', $data);
	}

	/**
	 * get candidate infor change
	 * @param  object $candidate
	 * @return json
	 */
	public function get_candidate_infor_change($candidate)
	{
		$infor = $this->recruitment_model->get_candidates($candidate);
		echo json_encode([
			'email' => $infor->email,
			'phonenumber' => $infor->phonenumber,

		]);
	}

	/**
	 * interview schedules
	 * @return redirect
	 */
	public function interview_schedules()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {

				$id = $this->recruitment_model->add_interview_schedules($data);
				if ($id) {
					$message = _l('added_successfully', _l('interview_schedule'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/interview_schedule'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_interview_schedules($data, $id);

				if ($success) {
					$message = _l('updated_successfully', _l('interview_schedule'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/interview_schedule'));
			}
			die;
		}
	}

	/**
	 * deletecandidate
	 * @param  int $id
	 * @return redirect
	 */
	public function delete_candidate($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/candidate_profile'));
		}
		$response = $this->recruitment_model->delete_candidate($id);

		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('candidate')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('candidate')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('candidate')));
		}
		redirect(admin_url('recruitment/candidate_profile'));
	}


	/**
	 * table interview
	 * @return
	 */
	public function table_interview()
	{
		if ($this->input->is_ajax_request()) {
			$this->app->get_table_data(module_views_path('recruitment', 'interview_schedule/table_interview'));
		}
	}

	/**
	 * candidate
	 * @param  int $id
	 * @return view
	 */
	public function candidate($id)
	{
		$data['title'] = _l('candidate_detail');
		$data['candidate'] = $this->recruitment_model->get_candidates($id);
		$data['hire_carreer_total'] = $this->recruitment_model->get_hire_carreer($id);
		$data['vsl_career_total'] = $this->recruitment_model->get_hire_carreer($id, VIESEL_TYPE);
		$data['email_templates_list'] = $this->db->get(db_prefix() . 'emailcanvas_templates')->result_array();
		$this->db->where('candidate', $id);
		$this->db->from(db_prefix() . 'candidate_send_mail');
		$data['email_templates_count'] = $this->db->count_all_results();
		$data['rank_list'] = $this->recruitment_model->get_rank();
		$data['course_list'] = $this->recruitment_model->get_course_type();
		$data['kind_list_license'] = $this->recruitment_model->get_kind_license_type();
		$data['kind_list_flag'] = $this->recruitment_model->get_kind_flag_type();
		$data['vessel_list'] = $this->recruitment_model->get_vessel();
		$data['vessel_name_list'] = $this->recruitment_model->get_vessel_name();
		$data['duty_list'] = $this->recruitment_model->get_duty();
		$data['request_renew_list'] = $this->recruitment_model->get_request_renew();

		$data['travel_list']  = $this->recruitment_model->get_travel();
		$data['other_licences']  = $this->recruitment_model->get_other_licence();
		$data['licences_3']  = $this->recruitment_model->get_licence_3();
		$data['licences_4']  = $this->recruitment_model->get_licence_4();
		$data['licences_5']  = $this->recruitment_model->get_licence_5();
		$data['licences_6']  = $this->recruitment_model->get_licence_6();
		$last_embarkation_date = $this->recruitment_model->check_date_validation($id);
		$data['relation_list_family'] = $this->recruitment_model->get_relation_list();
		$data['marital_status_list_family'] = $this->recruitment_model->get_marital_status_list();
		$data['emp_status_list'] = $this->recruitment_model->get_emp_status_list();
		if (!empty($last_embarkation_date)) {
			$last_validate_date = $last_embarkation_date->disembarkation_date;
		}
		$set_embarkation_date = isset($last_validate_date) ? $last_validate_date : '';
		$data['last_embarkation_date'] = $set_embarkation_date;
		$last_embarkation_other_date = $this->recruitment_model->check_date_other_validation($id);
		$last_validate_other_date = isset($last_embarkation_other_date->disembarkation_date) ? $last_embarkation_other_date->disembarkation_date : '';
		$set_embarkation_other_date = isset($last_validate_other_date) ? $last_validate_other_date : '';
		$data['last_embarkation_other_date'] = $set_embarkation_other_date;
		$data['skill_name'] = '';
		if ($data['candidate']) {
			if ($data['candidate']->skill) {
				$skill_array = explode(',', $data['candidate']->skill);
				foreach ($skill_array as $value) {
					if ($value) {
						$skill_value = $this->recruitment_model->get_skill($value);
						if ($skill_value) {
							$data['skill_name'] .= $skill_value->skill_name . ', ';
						}
					}
				}
			}
		}
		if ($data['candidate']->rec_campaign > 0) {
			$campaign = $this->recruitment_model->get_rec_campaign($data['candidate']->rec_campaign);
			if ($campaign) {
				$data['evaluation'] = $this->recruitment_model->get_evaluation_form_by_position($campaign->cp_position);
			} else {
				$data['evaluation'] = '';
			}
		} else {
			$data['evaluation'] = '';
		}
		$data['list_interview'] = $this->recruitment_model->get_interview_by_candidate($id);
		$data['cd_evaluation'] = $this->recruitment_model->get_cd_evaluation($id);
		$data['assessor'] = '';
		$data['feedback'] = '';
		$data['evaluation_date'] = '';
		$data['avg_score'] = 0;
		$data['data_group'] = [];
		$rs_evaluation = [];
		if (count($data['cd_evaluation']) > 0) {
			$data['assessor'] = $data['cd_evaluation'][0]['assessor'];
			$data['feedback'] = $data['cd_evaluation'][0]['feedback'];
			$data['evaluation_date'] = $data['cd_evaluation'][0]['evaluation_date'];

			foreach ($data['cd_evaluation'] as $eval) {
				$data['avg_score'] += ($eval['rate_score'] * $eval['percent']) / 100;

				if (!isset($rs_evaluation[$eval['group_criteria']])) {
					$rs_evaluation[$eval['group_criteria']]['toltal_percent'] = 0;
					$rs_evaluation[$eval['group_criteria']]['result'] = 0;
				}
				$rs_evaluation[$eval['group_criteria']]['toltal_percent'] += $eval['percent'];
				$rs_evaluation[$eval['group_criteria']]['result'] += ($eval['rate_score'] * $eval['percent']) / 100;
			}

			$data['data_group'] = $rs_evaluation;
		}
		$data['countries'] = $this->recruitment_model->get_country();
		$data['states'] = $this->recruitment_model->get_state();
		$data['cities'] = $this->recruitment_model->get_city();
		$data['department_data'] = $this->recruitment_model->get_department();
		$data['ranks'] = $this->recruitment_model->get_rank();
		$data['emp_status_list'] = $this->recruitment_model->get_emp_status_list();
		// get_contract_template
		$data['contract_template_list'] = $this->recruitment_model->get_contract_template();

		// $get_onborad_status = $this->recruitment_model->get_onborad_status($id);

		$data['emp_status_lable'] = get_select_option_name_by_id('job_emp_status', $data['candidate']->emp_status, 'emp_status_name');

		// $data['rec_contract_list'] = $this->recruitment_model->get_rec_contract($id);

		$this->load->view('candidate_profile/candidate_detail', $data);
	}

	/**
	 * candidate file
	 * @param  int $id
	 * @param  int $rel_id
	 * @return view
	 */
	public function candidate_file($id, $rel_id)
	{
		$data['discussion_user_profile_image_url'] = staff_profile_image_url(get_staff_user_id());
		$data['current_user_is_admin'] = is_admin();
		$data['file'] = $this->recruitment_model->get_file($id, $rel_id);
		if (!$data['file']) {
			header('HTTP/1.0 404 Not Found');
			die;
		}
		$this->load->view('candidate_profile/_file', $data);
	}

	/**
	 * deletec andidate attachment
	 * @param  int $id
	 * @return
	 */
	public function delete_candidate_attachment($id)
	{
		$this->load->model('misc_model');
		$file = $this->misc_model->get_file($id);
		if ($file->staffid == get_staff_user_id() || is_admin()) {
			echo html_entity_decode($this->recruitment_model->delete_candidate_attachment($id));
		} else {
			header('HTTP/1.0 400 Bad error');
			echo _l('access_denied');
			die;
		}
	}

	/**
	 * care candidate
	 * @return json
	 */
	public function care_candidate()
	{
		if ($this->input->post()) {
			$data = $this->input->post();
			$id = $this->recruitment_model->add_care_candidate($data);
			if ($id) {
				$mess = _l('care_candidate_success');
				echo json_encode([
					'mess' => $mess,
				]);
			} else {
				$mess = _l('care_candidate_fail');
				echo json_encode([
					'mess' => $mess,
				]);
			}
		}
	}

	/**
	 * rating candidate
	 * @return json
	 */
	public function rating_candidate()
	{
		if ($this->input->post()) {
			$data = $this->input->post();

			$id = $this->recruitment_model->rating_candidate($data);
			if ($id == true) {
				$mess = _l('rating_candidate_success');
				echo json_encode([
					'mess' => $mess,
					'rate' => $data['rating'],
				]);
			} else {
				$mess = _l('rating_candidate_fail');
				echo json_encode([
					'mess' => $mess,
					'rate' => 0,
				]);
			}
		}
	}

	/**
	 * send mail candidate
	 * @return redirect
	 */
	public function send_mail_candidate()
	{
		if ($this->input->post()) {
			$data = $this->input->post();
			$rs = $this->recruitment_model->send_mail_candidate($data);
			if ($rs == true) {
				set_alert('success', _l('send_mail_successfully'));
			}
			redirect(admin_url('recruitment/candidate/' . $data['candidate']));
		}
	}

	public function send_email_candidate()
	{
		if ($this->input->post()) {
			$data = $this->input->post();

			$candidate_datails = $this->recruitment_model->get_candidates($data['candidate_id']);

			if (empty($data['email_template_id'])) {
				set_alert('warning', _l('select_email_templete'));
			}

			$get_email_templates = $this->db->where('id', $data['email_template_id'])->get(db_prefix() . 'emailcanvas_templates')->row();

			$rs = $this->recruitment_model->send_email_candidate($candidate_datails, $get_email_templates);

			$this->db->where('candidate', $data['candidate_id']);
			$this->db->from(db_prefix() . 'candidate_send_mail');
			$count = $this->db->count_all_results();

			echo json_encode([
				'return' => true,
				'rs' => $rs,
				'count_email' => $count
			]);
		}
	}

	/**
	 * send mail list candidate
	 * @return redirect
	 */
	public function send_mail_list_candidate()
	{
		if ($this->input->post()) {
			$data = $this->input->post();
			foreach ($data['candidate'] as $cd) {
				$cdate = $this->recruitment_model->get_candidates($cd);
				$data['email'][] = $cdate->email;
			}
			$rs = $this->recruitment_model->send_mail_list_candidate($data);
			if ($rs == true) {
				set_alert('success', _l('send_mail_successfully'));
			}
			redirect(admin_url('recruitment/candidate_profile'));
		}
	}

	/**
	 * check time interview
	 * @return json
	 */
	public function check_time_interview()
	{
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($data['candidate'] != '') {
				if ($data['interview_day'] == '' || $data['from_time'] == '' || $data['to_time'] == '') {
					$rs = _l('please_enter_the_full_interview_time');
					echo json_encode([
						'return' => true,
						'rs' => $rs,
					]);
				} elseif ($data['interview_day'] != '' && $data['from_time'] != '' && $data['to_time'] != '') {
					$check = $this->recruitment_model->check_candidate_interview($data);
					if (count($check) > 0) {
						$rs = _l('check_candidate_interview_1');
						echo json_encode([
							'return' => true,
							'rs' => $rs,
						]);
					} else {
						echo json_encode([
							'return' => false,
						]);
					}
				}
			}
		}
	}

	/**
	 * [get_candidate_edit_interview description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_candidate_edit_interview($id)
	{
		$list_cd = $this->recruitment_model->get_list_candidates_interview($id);
		$cd = $this->recruitment_model->get_candidates();
		$html = '';
		$count = 0;
		$total_candidate = 0;
		foreach ($list_cd as $l) {
			if ($count == 0) {
				$class = 'success';
				$class_btn = 'new_candidates';
				$i = 'plus';
			} else {
				$class_btn = 'remove_candidates';
				$class = 'danger';
				$i = 'minus';
			}
			$html .= '<div class="row col-md-12" id="candidates-item">
                        <div class="col-md-4 form-group">
                          <select name="candidate[' . $count . ']" onchange="candidate_infor_change(this); return false;" id="candidate[' . $count . ']" class="selectpicker"  data-live-search="true" data-width="100%" data-none-selected-text="' . _l('ticket_settings_none_assigned') . '" required>
                              <option value=""></option>';
			foreach ($cd as $s) {
				$attr = '';
				if ($s['id'] == $l['candidate']) {
					$attr = 'selected';
				}
				$html .= '<option value="' . $s['id'] . '" ' . $attr . ' >' . $s['candidate_code'] . ' ' . $s['candidate_name'] . ' ' . $s['last_name'] . '</option>';
			}
			$html .= '</select>
                        </div>
                        <div class="col-md-4">
                          <input type="text" disabled="true" name="email[' . $count . ']" id="email[' . $count . ']" value="' . $l['email'] . '" class="form-control" />
                        </div>
                        <div class="col-md-3">
                          <input type="text" disabled="true" name="phonenumber[' . $count . ']" id="phonenumber[' . $count . ']" value="' . $l['phonenumber'] . '" class="form-control" />
                        </div>
                        <div class="col-md-1 lightheight-34-nowrap">
                              <span class="input-group-btn pull-bot">
                                  <button name="add" class="btn ' . $class_btn . ' btn-' . $class . ' border-radius-4" data-ticket="true" type="button"><i class="fa fa-' . $i . '"></i></button>
                              </span>
                        </div>
                      </div>';
			$count++;
			$total_candidate++;
		}
		echo json_encode([
			'html' => $html,
			'total_candidate' => $total_candidate
		]);
	}

	/**
	 * delete interview schedule
	 * @param  int $id
	 * @return redirect
	 */
	public function delete_interview_schedule($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/interview_schedule'));
		}
		$response = $this->recruitment_model->delete_interview_schedule($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('interview_schedule')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('interview_schedule')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('interview_schedule')));
		}
		redirect(admin_url('recruitment/interview_schedule'));
	}

	/**
	 * get interview data ajax
	 * @param  int $id
	 * @return view
	 */
	public function get_interview_data_ajax($id)
	{
		$data['id'] = $id;
		$data['intv_sch'] = $this->recruitment_model->get_interview_schedule($id);
		$this->load->view('interview_schedule/intv_sch_preview', $data);
	}

	/**
	 * evaluation criteria
	 * @return redirect
	 */
	public function evaluation_criteria()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_evaluation_criteria($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully', _l('evaluation_criteria'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=evaluation_criteria'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_evaluation_criteria($data, $id);
				if ($success) {
					$message = _l('updated_successfully', _l('evaluation_criteria'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=evaluation_criteria'));
			}
			die;
		}
	}

	/**
	 * delete evaluation criteria
	 * @param  int $id
	 * @return redirect
	 */
	public function delete_evaluation_criteria($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=evaluation_criteria'));
		}
		$response = $this->recruitment_model->delete_evaluation_criteria($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('evaluation_criteria')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('evaluation_criteria')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('evaluation_criteria')));
		}
		redirect(admin_url('recruitment/setting?group=evaluation_criteria'));
	}

	/**
	 * get criteria by group
	 * @param  int $id
	 * @return json
	 */
	public function get_criteria_by_group($id)
	{
		$list = $this->recruitment_model->get_criteria_by_group($id);
		$html = '<option value=""></option>';
		foreach ($list as $li) {
			$html .= '<option value="' . $li['criteria_id'] . '">' . $li['criteria_title'] . '</option>';
		}
		echo json_encode([
			'html' => $html,
		]);
	}

	/**
	 * evaluation form
	 * @return redirect
	 */
	public function evaluation_form()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_evaluation_form($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully', _l('evaluation_form'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=evaluation_form'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_evaluation_form($data, $id);
				if ($success) {
					$message = _l('updated_successfully', _l('evaluation_form'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=evaluation_form'));
			}
			die;
		}
	}

	/**
	 * delete evaluation form
	 * @param  int $id
	 * @return redirect
	 */
	public function delete_evaluation_form($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=evaluation_form'));
		}
		$response = $this->recruitment_model->delete_evaluation_form($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('evaluation_form')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('evaluation_form')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('evaluation_form')));
		}
		redirect(admin_url('recruitment/setting?group=evaluation_form'));
	}

	/**
	 * get list criteria edit
	 * @param  int $id
	 * @return json
	 */
	public function get_list_criteria_edit($id)
	{
		$list = $this->recruitment_model->get_list_criteria_edit($id);
		echo json_encode([
			'html' => $list['html'],
			'group_criteria' => $list['group_criteria'],
			'evaluation_criteria' => $list['evaluation_criteria'],
		]);
	}

	/**
	 * change status candidate
	 * @param  int $status
	 * @param  int $id
	 * @return json
	 */
	public function change_status_candidate($status, $id)
	{
		$change = $this->recruitment_model->change_status_candidate($status, $id);
		if ($change == true) {

			$message = _l('change_status_campaign') . ' ' . _l('successfully');
			echo json_encode([
				'result' => $message,
			]);
		} else {
			$message = _l('change_status_campaign') . ' ' . _l('fail');
			echo json_encode([
				'result' => $message,
			]);
		}
	}

	/**
	 * change send to
	 * @param  int $type
	 * @return json
	 */
	public function change_send_to($type)
	{
		$this->load->model('staff_model');
		$this->load->model('departments_model');
		if ($type == 'staff') {
			$staff = $this->staff_model->get();
			echo json_encode([
				'type' => $type,
				'list' => $staff,
			]);
		} elseif ($type == 'department') {
			$dpm = $this->departments_model->get();
			echo json_encode([
				'type' => $type,
				'list' => $dpm,
			]);
		}
	}

	/**
	 * setting tranfer
	 * @return redirect
	 */
	public function setting_tranfer()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			$data['content'] = $this->input->post('content', false);
			if ($this->input->post('no_editor')) {
				$data['content'] = nl2br(clear_textarea_breaks($this->input->post('content')));
			}
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_setting_tranfer($data);
				if ($id) {
					handle_rec_set_transfer_record($id);
					$success = true;
					$message = _l('added_successfully', _l('setting_tranfer'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=tranfer_personnel'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_setting_tranfer($data, $id);
				handle_rec_set_transfer_record($id);
				if ($success) {
					$message = _l('updated_successfully', _l('setting_tranfer'));
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=tranfer_personnel'));
			}
			die;
		}
	}

	/**
	 * delete setting tranfer
	 * @param  int $id
	 * @return redirect
	 */
	public function delete_setting_tranfer($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=tranfer_personnel'));
		}
		$response = $this->recruitment_model->delete_setting_tranfer($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('setting_tranfer')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('setting_tranfer')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('setting_tranfer')));
		}
		redirect(admin_url('recruitment/setting?group=tranfer_personnel'));
	}

	/**
	 * transfer to hr
	 * @param  int $candidate
	 * @return view
	 */
	public function transfer_to_hr($candidate)
	{
		$this->load->model('roles_model');
		$data['candidate'] = $this->recruitment_model->get_candidates($candidate);
		$data['title'] = _l('tranfer_personnel');
		$data['roles'] = $this->roles_model->get();

		if (rec_get_status_modules('hr_profile')) {
			$prefix_str = get_hr_profile_option('staff_code_prefix');
			$next_number = (int) get_hr_profile_option('staff_code_number');
			$data['staff_code'] = $prefix_str . str_pad($next_number, 5, '0', STR_PAD_LEFT);
		} else {
			$prefix_str = 'EC';
			$next_number = (int)$this->recruitment_model->get_last_staff_id();
			$data['staff_code'] = $prefix_str . str_pad($next_number, 5, '0', STR_PAD_LEFT);
		}

		$this->load->view('candidate_profile/transfer_to_hr', $data);
	}

	/**
	 * transfer hr
	 * @param  int $candidate
	 * @return redirect
	 */
	public function transfer_hr($candidate)
	{

		if ($this->input->post()) {
			$data = $this->input->post();
			$id = $this->recruitment_model->rec_add_staff($data);
			if ($id) {
				$change = $this->recruitment_model->change_status_candidate(9, $candidate);
				if ($change == true) {
					set_alert('success', _l('added_successfully', _l('staff_member')));
				}

				redirect(admin_url('recruitment/candidate_profile'));
			}
		}
		redirect(admin_url('recruitment/candidate_profile'));
	}

	/**
	 * action transfer hr
	 * @param  int $candidate
	 * @return json
	 */
	public function action_transfer_hr($candidate)
	{
		$this->load->model('departments_model');
		$this->load->model('staff_model');
		$cd = $this->recruitment_model->get_candidates($candidate);
		$step_setting = $this->recruitment_model->get_step_transfer_setting();
		$step = [];
		foreach ($step_setting as $st) {
			$step['id'] = $st['set_id'];
			$step['subject'] = $st['subject'];
			$step['content'] = $st['content'];
			if ($st['send_to'] = 'candidate') {
				$step['email'] = $cd->email;
				$action_step = $this->recruitment_model->action_transfer_hr($step);
			}

			if ($st['send_to'] = 'staff') {
				$step['email'] = $st['email_to'];
				$action_step = $this->recruitment_model->action_transfer_hr($step);
			}

			if ($st['send_to'] = 'department') {
				$dpm = [];
				if (strlen($st['email_to']) == 1) {
					$dpm[] = $st['email_to'];
				} else {
					$dpm[] = explode(',', $st['email_to']);
				}
				$list_mail = [];
				foreach ($dpm as $dp) {
					$dpment = $this->departments_model->get($dp);
					if (isset($dpment->manager_id) && $dpment->manager_id != '') {
						$mng_dpm = $this->staff_model->get($dpment->manager_id);
						if ($mng_dpm != '') {
							$list_mail[] = $mng_dpm->email;
						} else {
							$list_mail[] = '';
						}
					}
				}
				$step['email'] = implode(',', $list_mail);
				$action_step = $this->recruitment_model->action_transfer_hr($step);
			}
		}
		echo json_encode([
			'rs' => _l('successful_personnel_file_transfer'),
		]);
	}

	/**
	 * dashboard
	 * @return view
	 */
	public function dashboard()
	{
		$data['title'] = _l('dashboard');

		$data['rec_campaign_chart_by_status'] = json_encode($this->recruitment_model->rec_campaign_chart_by_status());
		$data['rec_plan_chart_by_status'] = json_encode($this->recruitment_model->rec_plan_chart_by_status());
		$data['cp_count'] = $this->recruitment_model->get_rec_dashboard_count();
		$data['upcoming_interview'] = $this->recruitment_model->get_upcoming_interview();
		$this->load->view('dashboard', $data);
	}

	/**
	 * get recruitment proposal edit
	 * @param  int $id
	 * @return
	 */
	public function get_recruitment_proposal_edit($id)
	{
		$list = $this->recruitment_model->get_rec_proposal($id);
		if (isset($list)) {
			$description = $list->job_description;
		} else {
			$description = '';
		}
		echo json_encode([
			'description' => $description,
		]);
	}

	/**
	 * get recruitment campaign edit
	 * @param  int $id
	 * @return json
	 */
	public function get_recruitment_campaign_edit($id)
	{
		$list = $this->recruitment_model->get_rec_campaign($id);
		if (isset($list)) {
			$description = $list->cp_job_description;
		} else {
			$description = '';
		}
		echo json_encode([
			'description' => $description,

		]);
	}

	/**
	 * get tranfer personnel edit
	 * @param  int $id
	 * @return json
	 */
	public function get_tranfer_personnel_edit($id)
	{
		$list = $this->recruitment_model->get_list_set_transfer($id);
		$tranfer_personnel_file = $this->recruitment_model->get_tranfer_personnel_file($id);

		if (isset($list)) {
			$description = $list->content;
		} else {
			$description = '';
		}
		echo json_encode([
			'description' => $description,
			'htmlfile' => $tranfer_personnel_file['htmlfile'],
		]);
	}

	/**
	 * recruitment channel
	 * @param  int $id
	 * @return view
	 */
	public function recruitment_channel($id = '')
	{
		if (!has_permission('recruitment', '', 'view') && !is_admin()) {
			access_denied('_recruitment_channel');
		}
		$data['rec_channel_id'] = $id;
		$data['candidates'] = $this->recruitment_model->get_candidates();
		$data['title'] = _l('_recruitment_channel');

		$this->load->view('recruitment_channel/manage_recruitment_channel', $data);
	}

	/**
	 * add edit recruitment channel
	 * @param string $id [description]
	 */
	public function add_edit_recruitment_channel($id = '')
	{

		if ($this->input->post()) {
			$data = $this->input->post();

			if (!isset($data['recruitment_channel_id'])) {

				if (!has_permission('recruitment', '', 'create') && !is_admin()) {
					access_denied('_recruitment_channel');
				}

				$ids = $this->recruitment_model->add_recruitment_channel($data);
				if ($ids) {
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/recruitment_channel'));
			} else {

				$id = $data['recruitment_channel_id'];

				if (!has_permission('recruitment', '', 'edit') && !is_admin()) {
					access_denied('_recruitment_channel');
				}

				if (isset($data['recruitment_channel_id'])) {
					unset($data['recruitment_channel_id']);
				}

				$success = $this->recruitment_model->update_recruitment_channel($data, $id);
				if ($success == true) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/recruitment_channel'));
			}
		}

		if ($id != '') {
			/*edit*/
			$data['form'] = $this->recruitment_model->get_recruitment_channel($id);
			$data['formData'] = $data['form']->form_data;
			$data['recruitment_channel_id'] = $id;
		} else {
			/*add*/
			$data['title'] = _l('new_candidate');
			$data['formData'] = '';
			$data['form'] = $this->recruitment_model->get_form([
				'id' => 1,
			]);
		}

		$custom_fields = get_custom_fields('leads', 'type != "link"');
		$cfields = format_external_form_custom_fields($custom_fields);

		$data['languages'] = $this->app->get_available_languages();
		$data['cfields'] = $cfields;

		$data['members'] = $this->staff_model->get('', [
			'active' => 1,
			'is_not_staff' => 0,
		]);

		$db_fields = [];
		$fields = [
			'candidate_name',
			'last_name',
			'candidate_code',
			'birthday',
			'gender',
			'desired_salary',
			'birthplace',
			'home_town',
			'identification',
			'place_of_issue',
			'marital_status',
			'nation',
			'religion',
			'height',
			'weight',
			'email',
			'phonenumber',
			'company',
			'resident',
			'nationality',
			'zip',
			'introduce_yourself',
			'skype',
			'facebook',
			'current_accommodation',
			'position',
			'contact_person',
			'salary',
			'reason_quitwork',
			'job_description',
			'diploma',
			'training_places',
			'specialized',
			'training_form',
			'days_for_identity',
			'year_experience',
			'skill',
			'interests'
		];
		$className = 'form-control';

		foreach ($fields as $f) {
			$_field_object = new stdClass();
			$type = 'text';
			$subtype = '';
			$class = $className;
			if ($f == 'email') {
				$subtype = 'email';
			} elseif ($f == 'current_accommodation' || $f == 'address') {
				$type = 'textarea';
			} elseif ($f == 'nationality') {
				$type = 'select';
			} elseif ($f == 'marital_status') {
				$type = 'select';
			} elseif ($f == 'gender') {
				$type = 'select';
			} elseif ($f == 'diploma') {
				$type = 'select';
			} elseif ($f == 'days_for_identity') {
				$type = 'text';
				$class .= ' datepicker';
			} elseif ($f == 'birthday') {
				$type = 'text';
				$class .= ' datepicker';
			} elseif ($f == 'position') {
				$type = 'text';
			} elseif ($f == 'year_experience') {
				$type = 'select';
			} elseif ($f == 'skill') {
				$type = 'select';
			} elseif ($f == 'interests') {
				$type = 'textarea';
			}

			if ($f == 'candidate_name') {
				$label = _l('first_name');
			} elseif ($f == 'last_name') {
				$label = _l('last_name');
			} elseif ($f == 'email') {
				$label = _l('lead_add_edit_email');
			} elseif ($f == 'phonenumber') {
				$label = _l('lead_add_edit_phonenumber');
			} elseif ($f == 'candidate_code') {
				$label = _l('candidate_code');
			} elseif ($f == 'birthday') {
				$label = _l('birthday');
			} elseif ($f == 'gender') {
				$label = _l('gender');
			} elseif ($f == 'desired_salary') {
				$label = _l('desired_salary');
			} elseif ($f == 'birthplace') {
				$label = _l('birthplace');
			} elseif ($f == 'home_town') {
				$label = _l('home_town');
			} elseif ($f == 'identification') {
				$label = _l('identification');
			} elseif ($f == 'place_of_issue') {
				$label = _l('place_of_issue');
			} elseif ($f == 'marital_status') {
				$label = _l('marital_status');
			} elseif ($f == 'nationality') {
				$label = _l('nationality');
			} elseif ($f == 'nation') {
				$label = _l('nation');
			} elseif ($f == 'religion') {
				$label = _l('religion');
			} elseif ($f == 'height') {
				$label = _l('height');
			} elseif ($f == 'weight') {
				$label = _l('weight');
			} elseif ($f == 'introduce_yourself') {
				$label = _l('introduce_yourself');
			} elseif ($f == 'skype') {
				$label = _l('skype');
			} elseif ($f == 'facebook') {
				$label = _l('facebook');
			} elseif ($f == 'resident') {
				$label = _l('resident');
			} elseif ($f == 'current_accommodation') {
				$label = _l('current_accommodation');
			} elseif ($f == 'position') {
				$label = _l('position_in_the_old_company');
			} elseif ($f == 'contact_person') {
				$label = _l('contact_person');
			} elseif ($f == 'reason_quitwork') {
				$label = _l('reason_quitwork');
			} elseif ($f == 'salary') {
				$label = _l('salary');
			} elseif ($f == 'job_description') {
				$label = _l('job_description');
			} elseif ($f == 'diploma') {
				$label = _l('diploma');
			} elseif ($f == 'training_places') {
				$label = _l('training_places');
			} elseif ($f == 'specialized') {
				$label = _l('specialized');
			} elseif ($f == 'training_form') {
				$label = _l('training_form');
			} elseif ($f == 'diploma') {
				$label = _l('diploma');
			} elseif ($f == 'days_for_identity') {
				$label = _l('days_for_identity');
			} elseif ($f == 'year_experience') {
				$label = _l('experience');
			} elseif ($f == 'skill') {
				$label = _l('skill');
			} elseif ($f == 'interests') {
				$label = _l('interests');
			} else {
				$label = _l('lead_' . $f);
			}

			$field_array = [
				'subtype' => $subtype,
				'type' => $type,
				'label' => $label,
				'className' => $class,
				'name' => $f,
			];

			if ($f == 'nationality') {
				$field_array['values'] = [];

				$field_array['values'][] = [
					'label' => '',
					'value' => '',
					'selected' => false,
				];

				$countries = get_all_countries();
				foreach ($countries as $country) {
					$selected = false;
					if (get_option('customer_default_country') == $country['country_id']) {
						$selected = true;
					}

					if ((int) $country['country_id'] == '54') {
						$label = str_replace("'", "", $country['short_name']);

						array_push($field_array['values'], [
							'label' => $label,
							'value' => (int) $country['country_id'],
							'selected' => $selected,
						]);
					} else {
						array_push($field_array['values'], [
							'label' => $country['short_name'],
							'value' => (int) $country['country_id'],
							'selected' => $selected,
						]);
					}
				}
			}

			if ($f == 'skill') {
				$field_array['values'] = [];


				$field_array['multiple'] = true;

				$skills = $this->recruitment_model->get_skill();
				foreach ($skills as $skill) {
					$selected = false; {
						array_push($field_array['values'], [
							'label' => $skill['skill_name'],
							'value' => (int) $skill['id'],
							'selected' => $selected,
						]);
					}
				}
			}

			if ($f == 'marital_status') {
				$field_array['values'] = [];

				$field_array['values'][] = [
					'label' => '',
					'value' => '',
					'selected' => false,
				];
				array_push($field_array['values'], [
					'label' => _l('single'),
					'value' => 'single',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('married'),
					'value' => 'married',
					'selected' => false,
				]);
			}
			if ($f == 'gender') {
				$field_array['values'] = [];

				$field_array['values'][] = [
					'label' => '',
					'value' => '',
					'selected' => false,
				];
				array_push($field_array['values'], [
					'label' => _l('male'),
					'value' => 'male',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('female'),
					'value' => 'female',
					'selected' => false,
				]);
			}
			if ($f == 'diploma') {
				$field_array['values'] = [];

				$field_array['values'][] = [
					'label' => '',
					'value' => '',
					'selected' => false,
				];

				array_push($field_array['values'], [
					'label' => _l('primary_level'),
					'value' => 'primary_level',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('intermediate_level'),
					'value' => 'intermediate_level',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('college_level'),
					'value' => 'college_level',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('masters'),
					'value' => 'masters',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('doctor'),
					'value' => 'doctor',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('bachelor'),
					'value' => 'bachelor',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('engineer'),
					'value' => 'engineer',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('university'),
					'value' => 'university',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('intermediate_vocational'),
					'value' => 'intermediate_vocational',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('college_vocational'),
					'value' => 'college_vocational',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('in-service'),
					'value' => 'in-service',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('high_school'),
					'value' => 'high_school',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('intermediate_level_pro'),
					'value' => 'intermediate_level_pro',
					'selected' => false,
				]);
			}
			if ($f == 'year_experience') {
				$field_array['values'] = [];

				$field_array['values'][] = [
					'label' => _l('no_experience_yet'),
					'value' => 'no_experience_yet',
					'selected' => false,
				];
				array_push($field_array['values'], [
					'label' => _l('less_than_1_year'),
					'value' => 'less_than_1_year',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('1_year'),
					'value' => '1_year',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('2_years'),
					'value' => '2_years',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('3_years'),
					'value' => '3_years',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('4_years'),
					'value' => '4_years',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('5_years'),
					'value' => '5_years',
					'selected' => false,
				]);
				array_push($field_array['values'], [
					'label' => _l('over_5_years'),
					'value' => 'over_5_years',
					'selected' => false,
				]);
			}
			if ($f == 'name') {
				$field_array['required'] = true;
			}

			$_field_object->label = $label;
			$_field_object->name = $f;
			$_field_object->fields = [];
			$_field_object->fields[] = $field_array;
			$db_fields[] = $_field_object;
		}
		$data['bodyclass'] = 'web-to-lead-form';
		$data['db_fields'] = $db_fields;
		$data['par_id'] = $id;

		$data['list_rec_campaign'] = $this->recruitment_model->get_rec_campaign();
		$this->load->model('roles_model');

		$data['status'] = $this->recruitment_model->get_status_application();

		$data['roles'] = $this->roles_model->get();
		$this->load->view('recruitment_channel/recruitment_channel_detail', $data);
	}

	/**
	 * table recruitment channel
	 * @return
	 */
	public function table_recruitment_channel()
	{
		if ($this->input->is_ajax_request()) {
			$this->app->get_table_data(module_views_path('recruitment', 'recruitment_channel/table_recruitment_channel'));
		}
	}

	/**
	 * delete recruitment channel
	 * @param  int $id
	 * @return [type]
	 */
	public function delete_recruitment_channel($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/recruitment_campaign'));
		}

		if (!has_permission('recruitment', '', 'delete()') && !is_admin()) {
			access_denied('_recruitment_channel');
		}

		$response = $this->recruitment_model->delete_recruitment_channel($id);

		if ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}

		redirect(admin_url('recruitment/recruitment_channel'));
	}

	/**
	 * get recruitment channel data ajax
	 * @param  int $id
	 * @return view
	 */
	public function get_recruitment_channel_data_ajax($id)
	{

		$data['id'] = $id;

		$data['total_cv_form'] = $this->recruitment_model->count_cv_from_recruitment_channel($id, 1);

		$data['recruitment_channel'] = $this->recruitment_model->get_recruitment_channel($id);

		$this->load->view('recruitment_channel/recruitment_channel_preview', $data);
	}

	/**
	 * add candidate form recruitment channel
	 * @param redirect
	 */
	public function add_candidate_form_recruitment_channel($form_key)
	{
		$data = $this->input->post();
		if ($data) {
			$ids = $this->recruitment_model->add_candidate_forms($data, $form_key);
			if ($ids) {
				handle_rec_candidate_file_form($ids);
				handle_rec_candidate_avar_file($ids);
				$success = true;
				$message = _l('added_successfully', _l('candidate_profile'));
				set_alert('success', $message);
				redirect(site_url('recruitment/forms/wtl/' . $form_key));
			}
		}
	}


	/**
	 * calendar interview schedule
	 * @return view 
	 */
	public function calendar_interview_schedule()
	{

		$data['staffs'] = $this->staff_model->get();
		$data['candidates'] = $this->recruitment_model->get_candidates();
		$data['list_cd'] = $this->recruitment_model->get_list_cd();
		$data['rec_campaigns'] = $this->recruitment_model->get_rec_campaign();

		$data['title'] = _l('interview_schedule');

		$data['google_calendar_api']  = get_option('google_calendar_api_key');
		$data['title']                = _l('calendar');
		add_calendar_assets();
		$this->load->view('interview_schedule/calendar', $data);
	}

	/**
	 * get calendar interview schedule data
	 * @return json 
	 */
	public function get_calendar_interview_schedule_data()
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->recruitment_model->get_calendar_interview_schedule_data(
				$this->input->post('start'),
				$this->input->post('end'),
				'',
				'',
				$this->input->post()
			);
			echo json_encode($data);
			die();
		}
	}

	/**
	 * switch kanban, recruitment switch kan ban
	 * @param  integer $set    
	 * @param  boolean $manual 
	 * @return redirect         
	 */
	public function switch_kanban($set = 0, $manual = false)
	{
		if ($set == 1) {
			$set = 'false';
		} else {
			$set = 'true';
		}

		$this->session->set_userdata([
			'candidate_profile_kanban_view' => $set,
		]);
		if ($manual == false) {
			if (strpos($_SERVER['HTTP_REFERER'], 'project_id') !== false) {
				redirect(admin_url('tasks'));
			} else {
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	/**
	 * kanban
	 * @return [type] 
	 */
	public function kanban()
	{
		$data['statuses'] = $this->recruitment_model->get_status_application();
		echo html_entity_decode($this->load->view('candidate_profile/kan_ban', $data, true));
	}

	/**
	 * recruitment tasks kanban load more
	 * 
	 */
	public function recruitment_kanban_load_more()
	{
		$status = $this->input->get('status');
		$page   = $this->input->get('page');

		$candidates = $this->recruitment_model->do_kanban_query($status, $this->input->get('search'), $page, false, []);

		foreach ($candidates as $candidate) {
			$this->load->view('candidate_profile/_kan_ban_card', [
				'candidate'   => $candidate,
				'status' => $status,
			]);
		}
	}


	/**
	 * candidate change status
	 * @param  integer $status 
	 * @param  integer $id     
	 *          
	 */
	public function candidate_change_status($status, $id)
	{
		$change = $this->recruitment_model->change_status_candidate($status, $id);
		if ($change == true) {

			$message = _l('change_status_campaign') . ' ' . _l('successfully');
			echo json_encode([
				'success' => 'true',
				'message' => $message,
			]);
		} else {
			$message = _l('change_status_campaign') . ' ' . _l('fail');
			echo json_encode([
				'success' => 'false',
				'message' => $message,
			]);
		}
	}

	/**
	 * skill
	 * @return redirect
	 */
	public function skill()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_skill($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=skills'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_skill($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=skills'));
			}
			die;
		}
	}

	/**
	 * delete job_position
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_skill($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=skills'));
		}
		$response = $this->recruitment_model->delete_skill($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=skills'));
	}

	/**
	 * get position fill data
	 * @return html 
	 */
	public function get_position_fill_data()
	{
		$data = $this->input->post();

		$position = $this->recruitment_model->list_position_by_campaign($data['campaign']);

		echo json_encode([
			'position' => $position
		]);
	}

	/**
	 * recruitment campaign setting
	 * @return  json
	 */
	public function recruitment_campaign_setting()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->recruitment_campaign_setting($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}

	public function tab_display_setting_reward()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->tab_display_setting_reward($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}

	public function tab_expiration_date_setting()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->tab_expiration_date_setting($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}

	public function tab_display_setting_medical()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->tab_display_setting_medical($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}

	public function tab_display_setting_psc()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->tab_display_setting_psc($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}



	/**
	 * company add edit
	 * @param  string $id 
	 * @return json     
	 */
	public function company_add_edit($id = '')
	{
		$data = $this->input->post();
		if ($data) {
			if (!isset($data['id'])) {

				$ids = $this->recruitment_model->add_company($data);
				if ($ids) {

					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
					/*upload multifile*/
					echo json_encode([
						'url' => admin_url('recruitment/setting?group=company_list'),
						'companyid' => $ids,
					]);
					die;
				}
				echo json_encode([
					'url' => admin_url('recruitment/commodity_list'),
				]);
				die;
			} else {

				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_company($data, $id);

				/*update file*/

				if ($success == true) {

					$message = _l('updated_successfully');
					set_alert('success', $message);
				}

				echo json_encode([
					'url' => admin_url('recruitment/setting?group=company_list'),
					'companyid' => $id,
				]);
				die;
			}
		}
	}


	/**
	 * add company attachment
	 * @param integer $id 
	 */
	public function add_company_attachment($id)
	{

		handle_company_attachments($id);
		echo json_encode([

			'url' => admin_url('recruitment/setting?group=company_list'),
		]);
	}


	/**
	 * get company file url
	 * @param  integer $company_id 
	 * @return json             
	 */
	public function get_company_file_url($company_id)
	{
		$arr_company_file = $this->recruitment_model->get_company_attachments($company_id);
		/*get images old*/
		$images_old_value = '';

		if (count($arr_company_file) > 0) {
			foreach ($arr_company_file as $key => $value) {
				$images_old_value .= '<div class="dz-preview dz-image-preview image_old' . $value["id"] . '">';

				$images_old_value .= '<div class="dz-image">';
				if (file_exists(RECRUITMENT_COMPANY_UPLOAD . $value["rel_id"] . '/' . $value["file_name"])) {
					$images_old_value .= '<img class="image-w-h" data-dz-thumbnail alt="' . $value["file_name"] . '" src="' . site_url('modules/recruitment/uploads/company_images/' . $value["rel_id"] . '/' . $value["file_name"]) . '">';
				} else {
					$images_old_value .= '<img class="image-w-h" data-dz-thumbnail alt="' . $value["file_name"] . '" src="' . site_url('modules/purchase/uploads/company/company_images/' . $value["rel_id"] . '/' . $value["file_name"]) . '">';
				}

				$images_old_value .= '</div>';

				$images_old_value .= '<div class="dz-error-mark">';
				$images_old_value .= '<a class="dz-remove" data-dz-remove>Remove file';
				$images_old_value .= '</a>';
				$images_old_value .= '</div>';

				$images_old_value .= '<div class="remove_file">';

				$images_old_value .= '<a href="#" class="text-danger" onclick="delete_company_attachment(this,' . $value["id"] . '); return false;"><i class="fa fa fa-times"></i></a>';

				$images_old_value .= '</div>';

				$images_old_value .= '</div>';
			}
		}

		echo json_encode([
			'arr_images' => $images_old_value,
		]);
		die();
	}

	/**
	 * delete company file
	 * @param  integer $attachment_id 
	 * @return json                
	 */
	public function delete_company_file($attachment_id)
	{
		if (!has_permission('recruitment', '', 'delete') && !is_admin()) {
			access_denied('recruitment');
		}

		$file = $this->misc_model->get_file($attachment_id);
		echo json_encode([
			'success' => $this->recruitment_model->delete_company_file($attachment_id),
		]);
	}


	/**
	 * delete company
	 * @param  integer $id 
	 * @return redirect     
	 */
	public function delete_company($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=company_list'));
		}
		$response = $this->recruitment_model->delete_company($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced', _l('company')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted', _l('company')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('company')));
		}
		redirect(admin_url('recruitment/setting?group=company_list'));
	}


	/**
	 * industry
	 * @return redirect 
	 */
	public function industry()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_industry($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=industry_list'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_industry($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=industry_list'));
			}
			die;
		}
	}

	/**
	 * get department
	 * @return redirect 
	 */
	public function department()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_department($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_department($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			}
			die;
		}
	}

	/**
	 * get department
	 * @return redirect 
	 */
	public function emp_status()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_emp_status($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_details'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_emp_status($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_details'));
			}
			die;
		}
	}


	/**
	 * get kind
	 * @return redirect 
	 */
	public function kind()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_kind($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_kind($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
			}
			die;
		}
	}

	/**
	 * get kind document
	 * @return redirect 
	 */
	public function kinddocument()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_kind_document($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_kind_document($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
			}
			die;
		}
	}

	/**
	 * get kind flag
	 * @return redirect 
	 */
	public function kindflag()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_kind_flag($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_kind_flag($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
			}
			die;
		}
	}


	/**
	 *  add update relation filed
	 * @return redirect 
	 */
	public function relation_filed()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_relation_filed($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_family'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_relation_filed($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_family'));
			}
			die;
		}
	}


	/**
	 *  add update Country
	 * @return redirect 
	 */
	public function add_update_country()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_country($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=country_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_country($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=country_setting'));
			}
			die;
		}
	}

	/**
	 *  add update state
	 * @return redirect 
	 */
	public function add_update_state()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_state($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=state_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_state($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=state_setting'));
			}
			die;
		}
	}


	/**
	 *  add update relation filed
	 * @return redirect 
	 */
	public function marital_status_filed()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_marital_status_filed($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_family'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_marital_status_filed($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_family'));
			}
			die;
		}
	}

	/**
	 * get rank
	 * @return redirect 
	 */
	public function rank()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_rank($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_rank($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			}
			die;
		}
	}

	/**
	 * get course
	 * @return redirect 
	 */
	public function course_type()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_course_type($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_course_type($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			}
			die;
		}
	}

	/**
	 * get vessel
	 * @return redirect 
	 */
	public function vessel()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_vessel_type($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_vessel_type($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			}
			die;
		}
	}

	/**
	 * delete job_position
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_industry($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=industry_list'));
		}
		$response = $this->recruitment_model->delete_industry($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=industry_list'));
	}

	/**
	 * delete country
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_country($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=country_setting'));
		}
		$response = $this->recruitment_model->delete_country($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=country_setting'));
	}

	public function delete_state($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=state_setting'));
		}
		$response = $this->recruitment_model->delete_state($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=state_setting'));
	}

	/**
	 * delete job_department
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_department($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=department_list'));
		}
		$response = $this->recruitment_model->delete_department($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
	}

	/**
	 * delete emp status
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_emp_status($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=department_list'));
		}
		$response = $this->recruitment_model->delete_emp_status($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting_details'));
	}

	/**
	 * delete job_vessel
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_vessel($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
		}
		$response = $this->recruitment_model->delete_vessel($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
	}

	/**
	 * delete job_rank
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_rank($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
		}
		$response = $this->recruitment_model->delete_rank($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
	}

	/**
	 * delete relation
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_relation($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=custom_filed_setting_family'));
		}
		$response = $this->recruitment_model->delete_relation($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting_family'));
	}

	/**
	 * delete marital_status
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_marital_status($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=custom_filed_setting_family'));
		}
		$response = $this->recruitment_model->delete_marital_status($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting_family'));
	}

	public function delete_course($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
		}
		$response = $this->recruitment_model->delete_course($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
	}


	public function delete_kind($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
		}
		$response = $this->recruitment_model->delete_kind($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
	}

	public function delete_kind_document($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
		}
		$response = $this->recruitment_model->delete_kind_document($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
	}

	public function delete_kind_flag($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
		}
		$response = $this->recruitment_model->delete_kind_flag($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting_license'));
	}


	/**
	 * get status
	 * @return redirect 
	 */
	public function status()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_status($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_status($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			}
			die;
		}
	}



	/**
	 * delete job_status
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_status($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=status_list'));
		}
		$response = $this->recruitment_model->delete_status($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
	}

	/**
	 * delete transfer personnal attachment file
	 * @param  [type] $attachment_id 
	 * @return [type]                
	 */
	public function delete_transfer_personnal_attachment_file($attachment_id)
	{
		if (!has_permission('recruitment', '', 'delete') && !is_admin()) {
			access_denied('recruitment');
		}

		$file = $this->misc_model->get_file($attachment_id);
		$result = $this->recruitment_model->delete_transfer_personnal_attachment_file($attachment_id);

		if ($result == true) {
			$message = _l('transfer_personnel_file_s');
		} else {
			$message =  _l('transfer_personnel_file_f');
		}

		echo json_encode([
			'message' => $message,
			'success' => $result,
		]);
	}

	/**
	 * re preview transfer personnal file
	 * @param  [type] $id     
	 * @param  [type] $rel_id 
	 * @return [type]         
	 */
	public function re_preview_transfer_personnal_file($id, $rel_id)
	{
		$data['discussion_user_profile_image_url'] = staff_profile_image_url(get_staff_user_id());
		$data['current_user_is_admin']             = is_admin();
		$data['file'] = $this->recruitment_model->get_file($id, $rel_id);
		if (!$data['file']) {
			header('HTTP/1.0 404 Not Found');
			die;
		}
		$this->load->view('recruitment/includes/tranfer_personnel_file', $data);
	}

	/**
	 * get candidate sample
	 * @return [type] 
	 */
	public function get_candidate_sample()
	{
		if ($this->input->is_ajax_request()) {

			$cd = $this->recruitment_model->get_candidates();
			$html = '';
			$total_candidate = 1;
			$count = 0;

			$class = 'success';
			$class_btn = 'new_candidates';
			$i = 'plus';

			$html .= '<div class="row col-md-12" id="candidates-item">
                        <div class="col-md-4 form-group">
                          <select name="candidate[' . $count . ']" onchange="candidate_infor_change(this); return false;" id="candidate[' . $count . ']" class="selectpicker"  data-live-search="true" data-width="100%" data-none-selected-text="' . _l('ticket_settings_none_assigned') . '" required>
                              <option value=""></option>';
			foreach ($cd as $s) {
				$attr = '';
				$html .= '<option value="' . $s['id'] . '" ' . $attr . ' >' . $s['candidate_code'] . ' ' . $s['candidate_name'] . ' ' . $s['last_name'] . '</option>';
			}
			$html .= '</select>
                        </div>
                        <div class="col-md-4">
                          <input type="text" disabled="true" name="email[' . $count . ']" id="email[' . $count . ']" class="form-control" />
                        </div>
                        <div class="col-md-3">
                          <input type="text" disabled="true" name="phonenumber[' . $count . ']" id="phonenumber[' . $count . ']"  class="form-control" />
                        </div>
                        <div class="col-md-1 lightheight-34-nowrap">
                              <span class="input-group-btn pull-bot">
                                  <button name="add" class="btn ' . $class_btn . ' btn-' . $class . ' border-radius-4" data-ticket="true" type="button"><i class="fa fa-' . $i . '"></i></button>
                              </span>
                        </div>
                      </div>';

			echo json_encode([
				'html' => $html,
				'total_candidate' => $total_candidate,
			]);
		}
	}

	/**
	 * item print candidate
	 * @return [type] 
	 */
	public function item_print_candidate()
	{
		$data = $this->input->post();
		foreach (glob(TEMFOLDER_EXPORT_CANDIDATE . '*') as $file) {
			$file_arr = explode("/", $file);
			$filename = array_pop($file_arr);

			if (file_exists($file)) {
				unlink(TEMFOLDER_EXPORT_CANDIDATE . $filename);
			}
		}

		$candidate_ids = $data['item_select_print_candidate'];
		$get_candidate_profile = $this->recruitment_model->get_candidate_profile_by_id($candidate_ids);

		$candidate_profile = $get_candidate_profile['candidate'];
		$candidate_literacy = $get_candidate_profile['candidate_literacy'];
		$candidate_experience = $get_candidate_profile['candidate_experience'];
		$cadidate_avatar = $get_candidate_profile['cadidate_avatar'];

		foreach ($candidate_profile as $candidate) {
			$temp_candidate_literacy = '';
			$temp_candidate_experience = '';
			$temp_cadidate_avatar = '';

			if (isset($candidate_literacy[$candidate['id']])) {
				$temp_candidate_literacy = $candidate_literacy[$candidate['id']];
			}

			if (isset($candidate_experience[$candidate['id']])) {
				$temp_candidate_experience = $candidate_experience[$candidate['id']];
			}

			if (isset($cadidate_avatar[$candidate['id']])) {
				$temp_cadidate_avatar = $cadidate_avatar[$candidate['id']];
			}

			$data = [];
			$data['candidate'] = $candidate;
			$data['temp_candidate_literacy'] = $temp_candidate_literacy;
			$data['temp_candidate_experience'] = $temp_candidate_experience;
			$data['cadidate_avatar'] = $temp_cadidate_avatar;
			$data['rec_skill'] = $get_candidate_profile['rec_skill'];
			$data['job_positions'] = $get_candidate_profile['job_positions'];

			$html = $this->load->view('recruitment/candidate_profile/export_candidate_pdf', $data, true);

			$html .= '<link href="' . module_dir_url(RECRUITMENT_MODULE_NAME, 'assets/css/export_candidate_pdf.css') . '"  rel="stylesheet" type="text/css" />';

			try {
				$pdf = $this->recruitment_model->candidate_export_pdf($html);
			} catch (Exception $e) {
				echo html_entity_decode($e->getMessage());
				die;
			}

			$this->re_save_to_dir($pdf, strtoupper(slug_it($candidate['candidate_code'] . '-' . $candidate['candidate_name'] . ' ' . $candidate['last_name'])) . '.pdf');
		}

		$this->load->library('zip');

		foreach (glob(TEMFOLDER_EXPORT_CANDIDATE . '*') as $file) {
			$file_arr = explode("/", $file);
			$filename = array_pop($file_arr);

			$this->zip->read_file(TEMFOLDER_EXPORT_CANDIDATE . $filename);
		}

		$this->zip->download(slug_it(get_option('companyname')) . '-candidate_profile.zip');
		$this->zip->clear_data();
	}

	/**
	 * re save to dir
	 * @param  [type] $pdf       
	 * @param  [type] $file_name 
	 * @return [type]            
	 */
	private function re_save_to_dir($pdf, $file_name)
	{
		$dir = TEMFOLDER_EXPORT_CANDIDATE;

		$dir .= $file_name;

		$pdf->Output($dir, 'F');
	}



	/**
	 * Edit on_board_company
	 * @return
	 */

	public function edit_on_board_company($id = '')
	{
		if ($id != '') {
			$on_board_company_info = $this->recruitment_model->get_on_board_company($id);
			$last_embarkation_other_date = $this->recruitment_model->check_date_validation_edit($on_board_company_info->candidate, $id);
			$on_board_company_info->embarkation_date = _d($on_board_company_info->embarkation_date);
			$on_board_company_info->disembarkation_date = _d($on_board_company_info->disembarkation_date);
			$on_board_company_info->disembarkation_date_validate = isset($last_embarkation_other_date->disembarkation_date) ? _d($last_embarkation_other_date->disembarkation_date) : '';
		}
		echo json_encode($on_board_company_info);
		die;
	}

	/**
	 * Edit get_on_board_other_company
	 * @return
	 */

	public function edit_get_on_board_other_company($id = '')
	{
		if ($id != '') {
			$get_on_board_other_company_info = $this->recruitment_model->get_on_board_other_company($id);
			$last_embarkation_other_date = $this->recruitment_model->check_date_other_validation_edit($get_on_board_other_company_info->candidate, $id);
			$get_on_board_other_company_info->embarkation_date = _d($get_on_board_other_company_info->embarkation_date);
			$get_on_board_other_company_info->disembarkation_date = _d($get_on_board_other_company_info->disembarkation_date);
			$get_on_board_other_company_info->disembarkation_date_validate = isset($last_embarkation_other_date->disembarkation_date) ? _d($last_embarkation_other_date->disembarkation_date) : '';
		}
		echo json_encode($get_on_board_other_company_info);
		die;
	}

	/**
	 * Edit on_board_in_land
	 * @return
	 */

	public function edit_on_board_in_land($id = '')
	{
		if ($id != '') {
			$on_board_in_land_info = $this->recruitment_model->get_on_board_in_land($id);
			$on_board_in_land_info->hire_date = _d($on_board_in_land_info->hire_date);
			$on_board_in_land_info->resignation_date = _d($on_board_in_land_info->resignation_date);
		}
		echo json_encode($on_board_in_land_info);
		die;
	}

	public function edit_crew_transaction_detail($id = '')
	{
		if ($id != '') {
			$crew_transaction = $this->recruitment_model->get_crew_transaction($id);
			$crew_transaction->care_time = _dt($crew_transaction->care_time);
			$crew_transaction->add_time = _dt($crew_transaction->add_time);
		}
		echo json_encode($crew_transaction);
		die;
	}

	/**
	 * Add Update OnBoard Company
	 * @return
	 */

	public function add_update_on_board_company()
	{

		$data = $this->input->post();
		$id = $data['on_board_company_id'];
		$candidate_id = $data['add_on_board_company_candidate_id'];

		if ($id != '') {
			$success = $this->recruitment_model->update_on_board_company($data);
			if ($success == true) {
				$message = _l('updated_successfully', _l('on_board_company'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {
			$success = $this->recruitment_model->add_on_board_company($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('on_board_company'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}

	public function update_crew_transaction()
	{
		$data = $this->input->post();
		$id = $data['hid'];
		$candidate_id = $data['candidate'];

		if ($id != '') {
			$success = $this->recruitment_model->update_crew_transaction($data);
			if ($success == true) {
				$message = _l('updated_successfully', _l('crew_transaction'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}

	/**
	 * Add Update OnBoard Other Company
	 * @return
	 */

	public function add_update_on_board_other_company()
	{

		$data = $this->input->post();
		$id = $data['on_board_other_company_id'];
		$candidate_id = $data['add_on_board_other_company_candidate_id'];

		if ($id != '') {
			$success = $this->recruitment_model->update_on_board_other_company($data);
			if ($success == true) {
				$message = _l('updated_successfully', _l('on_board_other_company'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {

			$success = $this->recruitment_model->add_on_board_other_company($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('on_board_other_company'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}

	/**
	 * Add Update OnBoard In Land
	 * @return
	 */

	public function add_update_on_board_in_land()
	{

		$data = $this->input->post();
		$id = $data['on_board_in_land_id'];
		$candidate_id = $data['add_on_board_in_land_candidate_id'];

		if ($id != '') {
			$success = $this->recruitment_model->update_on_board_in_land($data);
			if ($success == true) {
				$message = _l('updated_successfully', _l('on_board_in_land'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		} else {
			$success = $this->recruitment_model->add_on_board_in_land($data);
			if ($success == true) {
				$message = _l('added_successfully', _l('on_board_in_land'));
				set_alert('success', $message);
			}
			redirect(admin_url('recruitment/candidate/' . $candidate_id));
		}
	}


	/**
	 * delete on_board_company
	 * @param  int $id
	 * @return
	 */
	public function deleteOnBoardCompany($id = '')
	{
		if ($id != '') {
			$success = $this->recruitment_model->delete_on_board_company($id);
		}

		if ($success == true) {
			$response['message'] = _l('deleted_successfully', _l('on_board_company'));
		}

		echo json_encode($response);
		die;
	}

	/**
	 * delete on_board_other_company
	 * @param  int $id
	 * @return
	 */
	public function deleteOnBoardOtherCompany($id = '')
	{
		if ($id != '') {
			$success = $this->recruitment_model->delete_on_board_other_company($id);
		}

		if ($success == true) {
			$response['message'] = _l('deleted_successfully', _l('on_board_other_company'));
		}

		echo json_encode($response);
		die;
	}

	public function deletecrewtransactionhistory($id = '')
	{
		if ($id != '') {
			$success = $this->recruitment_model->deletecrewtransactionhistory($id);
		}

		if ($success == true) {
			$response['message'] = _l('deleted_successfully', _l('crew_transaction'));
		}

		echo json_encode($response);
		die;
	}

	/**
	 * delete on_board_in_land
	 * @param  int $id
	 * @return
	 */
	public function deleteOnBoardInLand($id = '')
	{
		if ($id != '') {
			$success = $this->recruitment_model->delete_on_board_in_land($id);
		}

		if ($success == true) {
			$response['message'] = _l('deleted_successfully', _l('on_board_in_land'));
		}

		echo json_encode($response);
		die;
	}

	public function tab_display_setting_hris()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->tab_display_setting_hris($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}

	public function tab_custom_filed_setting_details()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->tab_custom_filed_setting_details($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}

	/**
	 * get vessel_info_name
	 * @return redirect 
	 */
	public function vessel_info_name()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_vessel_name($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_vessel_name($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			}
			die;
		}
	}


	/**
	 * get duty
	 * @return redirect 
	 */
	public function duty()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_duty($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_duty($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
			}
			die;
		}
	}

	/**
	 * delete duty
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_duty_name($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
		}
		$response = $this->recruitment_model->delete_duty_name($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
	}


	/**
	 * delete job_vessel_name
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_vessel_name($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
		}
		$response = $this->recruitment_model->delete_vessel_name($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=custom_filed_setting'));
	}

	public function get_states_by_country()
	{
		$post = $this->input->post();
		$country_id = isset($post['country_id']) ? $post['country_id'] : 0;
		$states = $this->recruitment_model->get_states_by_country($country_id);
		echo json_encode($states);
		exit;
	}

	public function get_states_by_country_cities($country_id)
	{
		$states = $this->recruitment_model->get_states_by_country_cities($country_id);
		echo json_encode($states);
	}

	public function get_cities_by_state()
	{
		$post = $this->input->post();
		$state_id = isset($post['state_id']) ? $post['state_id'] : 0;
		$cities = $this->recruitment_model->get_cities_by_state($state_id);
		echo json_encode($cities);
		exit;
	}

	public function city_table()
	{
		if (!has_permission('view', 'recruitment')) {
			ajax_access_denied();
		}
		$this->app->get_table_data(module_views_path('recruitment', 'table/citytable'));
	}

	public function country_table()
	{
		if (!has_permission('view', 'recruitment')) {
			ajax_access_denied();
		}
		$this->app->get_table_data(module_views_path('recruitment', 'table/countrytable'));
	}

	public function state_table()
	{
		if (!has_permission('view', 'recruitment')) {
			ajax_access_denied();
		}
		$this->app->get_table_data(module_views_path('recruitment', 'table/statetable'));
	}



	/**
	 *  add update city
	 * @return redirect 
	 */
	public function add_update_city()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_city($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=city_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_city($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=city_setting'));
			}
			die;
		}
	}

	public function travel_filed()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_travel_setting($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_travel_setting($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			}
			die;
		}
	}


	public function other_licence_filed()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_other_licence_setting($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_other_licence_setting($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			}
			die;
		}
	}


	public function licence_3_filed()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_licence_3_setting($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_licence_3_setting($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			}
			die;
		}
	}

	public function licence_4_filed()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_licence_4_setting($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_licence_4_setting($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			}
			die;
		}
	}

	public function licence_5_filed()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_licence_5_setting($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_licence_5_setting($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			}
			die;
		}
	}

	public function licence_6_filed()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_licence_6_setting($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_licence_6_setting($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			}
			die;
		}
	}

	public function emp_contract_filed()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_employee_setting($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_employee_setting($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			}
			die;
		}
	}

	public function delete_city($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=city_setting'));
		}
		$response = $this->recruitment_model->delete_city($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=city_setting'));
	}

	public function delete_travel($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
		}
		$response = $this->recruitment_model->delete_travel($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function delete_other_licence($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
		}
		$response = $this->recruitment_model->delete_other_licence($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function delete_licence_3($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
		}
		$response = $this->recruitment_model->delete_licence_3($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function delete_licence_4($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
		}
		$response = $this->recruitment_model->delete_licence_4($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function delete_licence_5($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
		}
		$response = $this->recruitment_model->delete_licence_5($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function delete_licence_6($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
		}
		$response = $this->recruitment_model->delete_licence_6($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}


	public function emp_delete_contract($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
		}
		$response = $this->recruitment_model->emp_delete_contract($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function delete_request_renew($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
		}
		$response = $this->recruitment_model->delete_request_renew($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function order_no_travel_exists()
	{
		$order_no = $this->input->post('order_no');
		$id = $this->input->post('id');

		if ($order_no) {
			$this->db->where('order_no', $order_no);
			$this->db->where_not_in('id', $id);
			$_current_order_no = $this->db->get(db_prefix() . 'job_travel_identification')->row();

			if ($_current_order_no) {
				echo json_encode(false);
				die();
			} else {
				echo json_encode(true);
				die();
			}
		}
	}

	public function order_no_contract_exists()
	{
		$order_no = $this->input->post('order_no');
		$id = $this->input->post('id');
		if ($order_no) {
			$this->db->where('order_no', $order_no);
			$this->db->where_not_in('id', $id);
			$_current_order_no = $this->db->get(db_prefix() . 'job_employee_contract')->row();

			if ($_current_order_no) {
				echo json_encode(false);
				die();
			} else {
				echo json_encode(true);
				die();
			}
		}
	}

	public function check_country_name_exist()
	{
		$country_name = $this->input->post('name');
		$id = $this->input->post('id');
		if ($country_name) {
			$this->db->where('name', $country_name);
			$this->db->where_not_in('id', $id);
			$_current_name = $this->db->get(db_prefix() . 'countries_new')->row();

			if ($_current_name) {
				echo json_encode(false);
				die();
			} else {
				echo json_encode(true);
				die();
			}
		}
	}

	public function check_state_name_exist()
	{
		$state_name = $this->input->post('name');
		$country_id = $this->input->post('country_id');
		$id = $this->input->post('id');
		if ($state_name) {
			$this->db->where('name', $state_name);
			$this->db->where('country_id', $country_id);
			$this->db->where_not_in('id', $id);
			$_current_name = $this->db->get(db_prefix() . 'states_new')->row();

			if ($_current_name) {
				echo json_encode(false);
				die();
			} else {
				echo json_encode(true);
				die();
			}
		}
	}

	public function check_city_name_exist()
	{
		$state_name = $this->input->post('name');
		$state_id = $this->input->post('state_id');
		$id = $this->input->post('id');
		if ($state_name) {
			$this->db->where('name', $state_name);
			$this->db->where('state_id', $state_id);
			$this->db->where_not_in('id', $id);
			$_current_name = $this->db->get(db_prefix() . 'cities_new')->row();

			if ($_current_name) {
				echo json_encode(false);
				die();
			} else {
				echo json_encode(true);
				die();
			}
		}
	}


	public function update_travel_lable()
	{
		$val = $this->input->post('travel_lable_admin');
		$name = 'travel_lable_admin';
		update_option($name, $val);
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function update_other_licence_lable()
	{
		$val = $this->input->post('other_licence_lable_admin');
		$name = 'other_licence_lable_admin';
		update_option($name, $val);
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function update_licence_3_lable()
	{
		$val = $this->input->post('licence_3_lable_admin');
		$name = 'licence_3_lable_admin';
		update_option($name, $val);
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function update_licence_4_lable()
	{
		$val = $this->input->post('licence_4_lable_admin');
		$name = 'licence_4_lable_admin';
		update_option($name, $val);
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function update_licence_5_lable()
	{
		$val = $this->input->post('licence_5_lable_admin');
		$name = 'licence_5_lable_admin';
		update_option($name, $val);
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function update_licence_6_lable()
	{
		$val = $this->input->post('licence_6_lable_admin');
		$name = 'licence_6_lable_admin';
		update_option($name, $val);
		redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
	}

	public function get_document_type_passport($id)
	{
		$data =  $this->recruitment_model->get_document_by_id($id);
		echo json_encode($data);
		die();
	}

	public function request_renew_filed()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();

			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_request_renew_filed($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_request_renew_filed($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=liscense_form_setting'));
			}
			die;
		}
	}

	public function delete_licence_image()
	{
		$id = $this->input->post('id');
		$response = ['success' => false, 'message' => ''];

		if ($id != '') {
			$getFiledata = $this->recruitment_model->get_travel_info($id);

			if ($getFiledata) {
				$oldfilename = $getFiledata->attach_file;
				$success = $this->recruitment_model->delete_attach_file($id);

				if ($success) {
					$rewardfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/travel_file');
					$targetDir = $rewardfileDir . $oldfilename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}

					$response['success'] = true;
					$response['message'] = _l('deleted_successfully', _l('licence_file'));
				} else {
					$response['message'] = _l('update_failed');
				}
			} else {
				$response['message'] = _l('file_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}


	public function delete_other_licence_image()
	{
		$id = $this->input->post('id');
		$response = ['success' => false, 'message' => ''];

		if ($id != '') {
			$getFiledata = $this->recruitment_model->get_other_license_info($id);

			if ($getFiledata) {
				$oldfilename = $getFiledata->attach_file;
				$success = $this->recruitment_model->delete_other_licence_file($id);

				if ($success) {
					$rewardfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/other_licence_file');
					$targetDir = $rewardfileDir . $oldfilename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}

					$response['success'] = true;
					$response['message'] = _l('deleted_successfully', _l('other_licence_file'));
				} else {
					$response['message'] = _l('update_failed');
				}
			} else {
				$response['message'] = _l('file_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}

	public function delete_licence3_image()
	{
		$id = $this->input->post('id');
		$response = ['success' => false, 'message' => ''];

		if ($id != '') {
			$getFiledata = $this->recruitment_model->get_license_3_info($id);

			if ($getFiledata) {
				$oldfilename = $getFiledata->attach_file;
				$success = $this->recruitment_model->delete_licence3_file($id);

				if ($success) {
					$rewardfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_3_file');
					$targetDir = $rewardfileDir . $oldfilename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}

					$response['success'] = true;
					$response['message'] = _l('deleted_successfully', _l('licence_file'));
				} else {
					$response['message'] = _l('update_failed');
				}
			} else {
				$response['message'] = _l('file_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}

	public function delete_licence4_image()
	{
		$id = $this->input->post('id');
		$response = ['success' => false, 'message' => ''];

		if ($id != '') {
			$getFiledata = $this->recruitment_model->get_license_4_info($id);

			if ($getFiledata) {
				$oldfilename = $getFiledata->attach_file;
				$success = $this->recruitment_model->delete_licence4_file($id);

				if ($success) {
					$rewardfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_4_file');
					$targetDir = $rewardfileDir . $oldfilename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}

					$response['success'] = true;
					$response['message'] = _l('deleted_successfully', _l('licence_file'));
				} else {
					$response['message'] = _l('update_failed');
				}
			} else {
				$response['message'] = _l('file_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}


	public function delete_licence5_image()
	{
		$id = $this->input->post('id');
		$response = ['success' => false, 'message' => ''];

		if ($id != '') {
			$getFiledata = $this->recruitment_model->get_license_5_info($id);

			if ($getFiledata) {
				$oldfilename = $getFiledata->attach_file;
				$success = $this->recruitment_model->delete_licence5_file($id);

				if ($success) {
					$rewardfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_5_file');
					$targetDir = $rewardfileDir . $oldfilename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}

					$response['success'] = true;
					$response['message'] = _l('deleted_successfully', _l('licence_file'));
				} else {
					$response['message'] = _l('update_failed');
				}
			} else {
				$response['message'] = _l('file_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}

	public function delete_licence6_image()
	{
		$id = $this->input->post('id');
		$response = ['success' => false, 'message' => ''];

		if ($id != '') {
			$getFiledata = $this->recruitment_model->get_license_6_info($id);

			if ($getFiledata) {
				$oldfilename = $getFiledata->attach_file;
				$success = $this->recruitment_model->delete_licence6_file($id);

				if ($success) {
					$rewardfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_6_file');
					$targetDir = $rewardfileDir . $oldfilename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}

					$response['success'] = true;
					$response['message'] = _l('deleted_successfully', _l('licence_file'));
				} else {
					$response['message'] = _l('update_failed');
				}
			} else {
				$response['message'] = _l('file_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}


	public function add_update_followup()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_followup($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=followup_highlight_setting'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_followup($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=followup_highlight_setting'));
			}
			die;
		}
	}

	public function followup_table()
	{
		if (!has_permission('view', 'recruitment')) {
			ajax_access_denied();
		}
		$this->app->get_table_data(module_views_path('recruitment', 'table/followup'));
	}

	public function delete_followup($id)
	{
		if (!$id) {
			redirect(admin_url('recruitment/setting?group=followup_highlight_setting'));
		}
		$response = $this->recruitment_model->delete_followup($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('is_referenced'));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('recruitment/setting?group=followup_highlight_setting'));
	}

	public function tab_display_setting_recruitment_history()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->tab_display_setting_recruitment_history($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}

	public function tab_display_setting_capacity_profile()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->tab_display_setting_capacity_profile($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}

	public function tab_display_setting_promotion()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->tab_display_setting_promotion($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}

	public function tab_display_setting_contract()
	{
		$data = $this->input->post();
		if ($data != 'null') {
			$value = $this->recruitment_model->tab_display_setting_contract($data);
			if ($value) {
				$success = true;
				$message = _l('updated_successfully');
			} else {
				$success = false;
				$message = _l('updated_false');
			}
			echo json_encode([
				'message' => $message,
				'success' => $success,
			]);
			die;
		}
	}

	public function deletetravelInfo($id = '')
	{
		$response = [];

		if ($id != '') {
			$data = $this->recruitment_model->get_travel_info($id);

			if ($data) {
				$filename = $data->attach_file;
				unset($data);
				$success = $this->recruitment_model->delete_rec_travel_info($id);

				if ($success) {
					$license_1fileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/travel_file');
					$targetDir = $license_1fileDir . $filename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}
					$response['message'] = _l('deleted_successfully', _l('license_1_info'));
				} else {
					$response['message'] = _l('delete_failed');
				}
			} else {
				$response['message'] = _l('license_1_info_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}

	public function deletelicense2Info($id = '')
	{
		$response = [];

		if ($id != '') {
			$data = $this->recruitment_model->get_other_license_info($id);

			if ($data) {
				$filename = $data->attach_file;
				unset($data);
				$success = $this->recruitment_model->delete_license_2_info($id);

				if ($success) {
					$license_2fileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/other_licence_file');
					$targetDir = $license_2fileDir . $filename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}
					$response['message'] = _l('deleted_successfully', _l('license_2_info'));
				} else {
					$response['message'] = _l('delete_failed');
				}
			} else {
				$response['message'] = _l('license_2_info_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}

	public function deletelicense3Info($id = '')
	{
		$response = [];

		if ($id != '') {
			$data = $this->recruitment_model->get_license_3_info($id);

			if ($data) {
				$filename = $data->attach_file;
				unset($data);
				$success = $this->recruitment_model->delete_license_3_info($id);

				if ($success) {
					$license_3fileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_3_file');
					$targetDir = $license_3fileDir . $filename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}
					$response['message'] = _l('deleted_successfully', _l('license_3_info'));
				} else {
					$response['message'] = _l('delete_failed');
				}
			} else {
				$response['message'] = _l('license_3_info_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}

	public function deletelicense4Info($id = '')
	{
		$response = [];

		if ($id != '') {
			$data = $this->recruitment_model->get_license_4_info($id);

			if ($data) {
				$filename = $data->attach_file;
				unset($data);
				$success = $this->recruitment_model->delete_license_4_info($id);

				if ($success) {
					$license_4fileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_4_file');
					$targetDir = $license_4fileDir . $filename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}
					$response['message'] = _l('deleted_successfully', _l('license_4_info'));
				} else {
					$response['message'] = _l('delete_failed');
				}
			} else {
				$response['message'] = _l('license_4_info_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}


	public function deletelicense5Info($id = '')
	{
		$response = [];

		if ($id != '') {
			$data = $this->recruitment_model->get_license_5_info($id);

			if ($data) {
				$filename = $data->attach_file;
				unset($data);
				$success = $this->recruitment_model->delete_license_5_info($id);

				if ($success) {
					$license_4fileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_5_file');
					$targetDir = $license_4fileDir . $filename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}
					$response['message'] = _l('deleted_successfully', _l('license_5_info'));
				} else {
					$response['message'] = _l('delete_failed');
				}
			} else {
				$response['message'] = _l('license_5_info_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}

	public function deletelicense6Info($id = '')
	{
		$response = [];

		if ($id != '') {
			$data = $this->recruitment_model->get_license_6_info($id);

			if ($data) {
				$filename = $data->attach_file;
				unset($data);
				$success = $this->recruitment_model->delete_license_6_info($id);

				if ($success) {
					$license_6fileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_6_file');
					$targetDir = $license_6fileDir . $filename;

					if (file_exists($targetDir)) {
						unlink($targetDir);
					}
					$response['message'] = _l('deleted_successfully', _l('license_6_info'));
				} else {
					$response['message'] = _l('delete_failed');
				}
			} else {
				$response['message'] = _l('license_6_info_not_found');
			}
		} else {
			$response['message'] = _l('invalid_id');
		}

		echo json_encode($response);
		die;
	}

	public function get_viesel_name_by_emp_status()
	{
		$id = $this->input->post('candidateid');
		$viesel_id = get_viesel_name_id($id);
		$vessel_name = get_select_option_name_by_id('job_vessel_name', $viesel_id, 'vessel_info_name');


		$department_id = $this->db->select('id')->where('department_name', $vessel_name)->get(db_prefix() . 'job_department')->row();

		if (isset($department_id->id)) {
			$response = $department_id->id;
		} else {
			$data['department_name'] = $vessel_name;
			$response = $this->recruitment_model->add_department($data);
		}

		echo json_encode($response);
		die;
	}

	public function save_manning_agency()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_manning_agency($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=manning_agency'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_manning_agency($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=manning_agency'));
			}
			die;
		}
	}

	public function delete_manning_agency()
	{
		$post = $this->input->post();
		$res['status'] = 0;
		$res['msg'] = 'Somthing Gone Wrong!';
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			if ($id > 0) {
				if ($this->recruitment_model->delete_manning_agency($id)) {
					$res['status'] = 1;
					$res['msg'] = _l('manning_agency_deleted');
				}
			}
		}
		echo json_encode($res);
		die;
	}

	public function get_manning_agency()
	{
		$post = $this->input->post();
		$res['status'] = 0;
		$res['manning_agency'] = [];
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			if ($id > 0) {
				$manning_agency = $this->recruitment_model->get_manning_agency_by_id($id);
				if (!empty($manning_agency)) {
					$res['status'] = 1;
					$res['manning_agency'] = $manning_agency[0];
				}
			}
		}
		echo json_encode($res);
		die;
	}

	public function save_contract_template()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			$data['template_content'] = $this->input->post('template_content', false);
			if (!$this->input->post('id')) {
				$id = $this->recruitment_model->add_contract_template($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=contract_template'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->recruitment_model->update_contract_template($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/setting?group=contract_template'));
			}
			die;
		}
	}

	public function delete_contract_template()
	{
		$post = $this->input->post();
		$res['status'] = 0;
		$res['msg'] = 'Something Gone Wrong!';
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			if ($id > 0) {
				if ($this->recruitment_model->delete_contract_template($id)) {
					$res['status'] = 1;
					$res['msg'] = _l('contract_template_deleted');
				}
			}
		}
		echo json_encode($res);
		die;
	}

	public function get_contract_template()
	{
		$post = $this->input->post();
		$res['status'] = 0;
		$res['contract_template'] = [];
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			if ($id > 0) {
				$contract_template = $this->recruitment_model->get_contract_template_by_id($id);
				if (!empty($contract_template)) {
					$res['status'] = 1;
					$res['contract_template'] = $contract_template[0];
				}
			}
		}
		echo json_encode($res);
		die;
	}

	public function get_contract_template_detail()
	{
		$post = $this->input->post();
		$res['status'] = 0;
		$res['contract_template'] = [];
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			$candidate_id = isset($post['candidate_id']) ? $post['candidate_id'] : 0;
			if ($id > 0) {
				$contract_template = $this->recruitment_model->get_contract_template_by_id($id);
				if (!empty($contract_template)) {
					$this->load->library('merge_fields/contract_template_merge_fields');

					$template_content = $contract_template[0]['template_content'];
					preg_match_all('/\{(.*?)\}/', $template_content, $matches);
					// Extract matched values
					$placeholders = $matches[0];
					$mearge_field = $this->contract_template_merge_fields->format($placeholders, $candidate_id);

					// $template_content_msg = str_replace(array_map(fn($key) => "{" . $key . "}", array_keys($mearge_field)), array_values($mearge_field), $template_content);

					foreach ($placeholders as $placeholder) {
						$key = trim($placeholder, '{}');
						if (!isset($mearge_field[$key]) || $mearge_field[$key] === null) {
							$mearge_field[$key] = '';
						}
					}

					$template_content_msg = str_replace(
						array_map(fn($key) => "{" . $key . "}", array_keys($mearge_field)),
						array_values($mearge_field),
						$template_content
					);

					$contract_template[0]['template_content_msg'] = $template_content_msg;
					$res['status'] = 1;
					$res['contract_template'] = $contract_template[0];
				}
			}
		}
		echo json_encode($res);
		die;
	}

	public function add_contract()
	{
		if ($this->input->post()) {
			$message = '';
			$data = $this->input->post();
			$data['template_content'] = $this->input->post('template_content', false);
			$data['candidate_id'] = isset($data['add_education_candidate_id']) ? $data['add_education_candidate_id'] : '';
			if (isset($data['add_education_candidate_id'])) {
				unset($data['add_education_candidate_id']);
			}
			$rec_contract_id = isset($data['rec_contract_id']) ? $data['rec_contract_id'] : '';
			if (isset($data['rec_contract_id'])) {
				unset($data['rec_contract_id']);
			}

			if ($rec_contract_id != '') {
				$old_contract_data = $this->recruitment_model->get_rec_contract_by_id($rec_contract_id);
				if ($_FILES && isset($_FILES['con_signed_contract']) && !empty($_FILES['con_signed_contract']) && $_FILES['con_signed_contract']['name'] != '') {
					$old_con_signed_contract = isset($old_contract_data[0]['con_signed_contract']) ? $old_contract_data[0]['con_signed_contract'] : '';
					$path = module_dir_path(RECRUITMENT_MODULE_NAME) .  'assets/image/' . $data['candidate_id'] . '/' . $old_con_signed_contract;
					if (file_exists($path)) {
						unlink($path);
					}

					$con_signed_contract = upload_con_signed_contract($_FILES['con_signed_contract'], $data['contract_name'], $data['candidate_id']);
					$data['con_signed_contract'] = $con_signed_contract;
				} else {
					if (!empty($old_contract_data)) {
						$old_contract_data = isset($old_contract_data[0]) && !empty($old_contract_data[0]) ? $old_contract_data[0] : [];
						if (!empty($old_contract_data)) {
							$data['con_signed_contract'] = $old_contract_data['con_signed_contract'];
						}
					}
				}
				// Check That If The Contract Are Defult Then User Can Not Edit That
				if (isset($data['contract_template']) && $data['contract_template'] == GOVERNMENT_CONTRACT_1) {
					$data['template_content'] = isset($old_contract_data['template_content']) ? $old_contract_data['template_content'] : '';
				}
				// Check That If The Contract Are Defult Then User Can Not Edit That
				$success = $this->recruitment_model->update_rec_contract($data, $rec_contract_id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/candidate/' . $data['candidate_id']));
			} else {
				if ($_FILES && isset($_FILES['con_signed_contract']) && !empty($_FILES['con_signed_contract']) && $_FILES['con_signed_contract']['name'] != '') {
					$con_signed_contract =  upload_con_signed_contract($_FILES['con_signed_contract'], $data['contract_name'], $data['candidate_id']);
					$data['con_signed_contract'] = $con_signed_contract;
				}
				$id = $this->recruitment_model->add_rec_contract($data);
				if ($id) {
					$success = true;
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('recruitment/candidate/' . $data['candidate_id']));
			}
		}
	}

	public function delete_rec_contract()
	{
		$post = $this->input->post();
		$res['status'] = 0;
		$res['msg'] = 'Somthing Gone Wrong!';
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			if ($id > 0) {
				$old_contract_data = $this->recruitment_model->get_rec_contract_by_id($id);
				// if ($this->recruitment_model->delete_rec_contract($id)) {
				// 	$old_con_signed_contract = isset($old_contract_data[0]['con_signed_contract']) ? $old_contract_data[0]['con_signed_contract'] : '';
				// 	$path = module_dir_path(RECRUITMENT_MODULE_NAME) .  'assets/image/' . $old_contract_data[0]['candidate_id'] . '/' . $old_con_signed_contract;
				//                 if (file_exists($path)) {
				//                     unlink($path);
				//                 }
				// 	$res['status'] = 1;
				// 	$res['msg'] = _l('contract_deleted');
				// }
				// Check That If The Contract Are Defult Then User Can Not Delete That
				if (isset($old_contract_data[0]['contract_template']) && $old_contract_data[0]['contract_template'] == GOVERNMENT_CONTRACT_1) {
					$res['status'] = 0;
					$res['msg'] = _l('You Can Not Delete This Contract');
					// Check That If The Contract Are Defult Then User Can Not Delete That
				} elseif ($this->recruitment_model->delete_rec_contract($id)) {
					$old_con_signed_contract = isset($old_contract_data[0]['con_signed_contract']) ? $old_contract_data[0]['con_signed_contract'] : '';
					$path = module_dir_path(RECRUITMENT_MODULE_NAME) .  'assets/image/' . $old_contract_data[0]['candidate_id'] . '/' . $old_con_signed_contract;
					if (file_exists($path)) {
						unlink($path);
					}
					$res['status'] = 1;
					$res['msg'] = _l('contract_deleted');
				}
			}
		}
		echo json_encode($res);
		die;
	}

	public function edit_rec_contract()
	{
		$post = $this->input->post();
		$res['status'] = 0;
		$res['contracts'] = [];
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			if ($id > 0) {
				$contract = $this->recruitment_model->get_rec_contract_by_id($id);
				if (!empty($contract)) {
					$res['status'] = 1;
					$res['contract'] = $contract[0];
					$res['rec_signed_contract'] = '';
					if (isset($contract[0]['con_signed_contract']) && $contract[0]['con_signed_contract'] != '') {
						$con_signed_contract = '<img src="' . site_url("modules/" . RECRUITMENT_MODULE_NAME . "/assets/image/" . $contract[0]['candidate_id'] . '/' . $contract[0]['con_signed_contract'] . "") . '" height="80px" width="auto" style="margin-bottom: 10px;">';
						$res['rec_signed_contract'] = $con_signed_contract;
					}
				}
			}
		}
		echo json_encode($res);
		die;
	}

	// public function rec_contract_pdf_btn($id){
	// 	if ($id != '') {
	// 		$contract = $this->recruitment_model->get_rec_contract_by_id($id);
	// 		if (!empty($contract)) {
	// 			$contract_template_id = $contract[0]['contract_template'];
	// 			$candidate_id = $contract[0]['candidate_id'];
	// 			$contract_template = $this->recruitment_model->get_contract_template_by_id($contract_template_id);
	// 			if (!empty($contract_template)) {
	// 				$this->load->library('merge_fields/contract_template_merge_fields');

	// 				$template_content = $contract_template[0]['template_content'];
	// 				preg_match_all('/\{(.*?)\}/', $template_content, $matches);
	// 				// Extract matched values
	// 				$placeholders = $matches[0];
	// 				$mearge_field = $this->contract_template_merge_fields->format($placeholders , $candidate_id);

	// 				// $template_content_msg = str_replace(array_map(fn($key) => "{" . $key . "}", array_keys($mearge_field)), array_values($mearge_field), $template_content);

	// 				foreach ($placeholders as $placeholder) {
	// 					$key = trim($placeholder, '{}');
	// 					if (!isset($mearge_field[$key]) || $mearge_field[$key] === null) {
	// 						$mearge_field[$key] = '';
	// 					}
	// 				}

	// 				$template_content_msg = str_replace(
	// 					array_map(fn($key) => "{" . $key . "}", array_keys($mearge_field)),
	// 					array_values($mearge_field),
	// 					$template_content
	// 				);
	// 				$pdf = rec_contract_pdf($template_content_msg, '', '12345');
	// 				$pdf->Output(slug_it("Contract") . '.pdf', 'I');
	// 			}
	// 		}

	// 	}
	// }

	public function rec_contract_pdf_btn($id)
	{
		if ($id != '') {
			$contract = $this->recruitment_model->get_rec_contract_by_id($id);
			$template_content_msg = isset($contract[0]['template_content']) ? $contract[0]['template_content'] : '';
			if (!empty($contract)) {
				$pdf = rec_contract_pdf($template_content_msg, '', '12345');
				$pdf->Output(slug_it("Contract") . '.pdf', 'I');
			}
		}
	}

	public function rec_contract_list_table($candidate_id)
	{
		$this->app->get_table_data(module_views_path('recruitment', 'table/rec_contract_list_table'), [
			'candidate_id' => $candidate_id,
		]);
	}

	// 	public function add_defult_contract_for_new_crew_member($candidate_id)
	// 	{
	// 		if (is_numeric($candidate_id) && $candidate_id > 0) {
	// 			$contract_template = $this->recruitment_model->get_contract_template_by_id(GOVERNMENT_CONTRACT_1);
	// 			$res = [];
	// 			if ($candidate_id != '' && $candidate_id > 0) {
	// 				if (!empty($contract_template)) {
	// 					$this->load->library('merge_fields/contract_template_merge_fields');

	// 					$template_content = $contract_template[0]['template_content'];
	// 					preg_match_all('/\{(.*?)\}/', $template_content, $matches);
	// 					// Extract matched values
	// 					$placeholders = $matches[0];
	// 					$mearge_field = $this->contract_template_merge_fields->format($placeholders, $candidate_id);

	// 					// $template_content_msg = str_replace(array_map(fn($key) => "{" . $key . "}", array_keys($mearge_field)), array_values($mearge_field), $template_content);

	// 					foreach ($placeholders as $placeholder) {
	// 						$key = trim($placeholder, '{}');
	// 						if (!isset($mearge_field[$key]) || $mearge_field[$key] === null) {
	// 							$mearge_field[$key] = '';
	// 						}
	// 					}

	// 					$template_content_msg = str_replace(
	// 						array_map(fn($key) => "{" . $key . "}", array_keys($mearge_field)),
	// 						array_values($mearge_field),
	// 						$template_content
	// 					);

	// 					$res['template_content_msg'] = $template_content_msg;
	// 				}
	// 				$insert_crew_contract_data = [
	// 					'candidate_id' => $candidate_id,
	// 					'contract_name' => 'Government Contract 1',
	// 					'contract_template' => GOVERNMENT_CONTRACT_1,
	// 					'template_content' => isset($res['template_content_msg']) ? $res['template_content_msg'] : '',
	// 				];

	// 				$is_exsist = $this->recruitment_model->check_contract_is_there_for_crew($candidate_id, GOVERNMENT_CONTRACT_1);
	// 				if ($is_exsist) {
	// 					$this->recruitment_model->add_rec_contract($insert_crew_contract_data);
	// 				}
	// 			}
	// 		}
	// 	}
	// cron function
	// 	public function set_defult_contract_to_all_crew()
	// 	{
	// 		$candidates = $this->recruitment_model->get_all_candidate_ids();
	// 		// contract_template detail 
	// 		$contract_template = $this->recruitment_model->get_contract_template_by_id(GOVERNMENT_CONTRACT_1);
	// 		$res = [];

	// 		// contract_template detail 

	// 		if (!empty($candidates)) {
	// 			foreach ($candidates as $key => $value) {
	// 				$candidate_id = isset($value['id']) ? $value['id'] : '';
	// 				if (!empty($contract_template)) {
	// 					$this->load->library('merge_fields/contract_template_merge_fields');

	// 					$template_content = $contract_template[0]['template_content'];
	// 					preg_match_all('/\{(.*?)\}/', $template_content, $matches);
	// 					// Extract matched values
	// 					$placeholders = $matches[0];
	// 					$mearge_field = $this->contract_template_merge_fields->format($placeholders, $candidate_id);

	// 					// $template_content_msg = str_replace(array_map(fn($key) => "{" . $key . "}", array_keys($mearge_field)), array_values($mearge_field), $template_content);

	// 					foreach ($placeholders as $placeholder) {
	// 						$key = trim($placeholder, '{}');
	// 						if (!isset($mearge_field[$key]) || $mearge_field[$key] === null) {
	// 							$mearge_field[$key] = '';
	// 						}
	// 					}

	// 					$template_content_msg = str_replace(
	// 						array_map(fn($key) => "{" . $key . "}", array_keys($mearge_field)),
	// 						array_values($mearge_field),
	// 						$template_content
	// 					);

	// 					$res['template_content_msg'] = $template_content_msg;
	// 				}

	// 				if ($candidate_id != '' && $candidate_id > 0) {
	// 					$insert_crew_contract_data = [
	// 						'candidate_id' => $candidate_id,
	// 						'contract_name' => 'Government Contract 1',
	// 						'contract_template' => GOVERNMENT_CONTRACT_1,
	// 						'template_content' => isset($res['template_content_msg']) ? $res['template_content_msg'] : '',
	// 					];

	// 					$is_exsist = $this->recruitment_model->check_contract_is_there_for_crew($candidate_id, GOVERNMENT_CONTRACT_1);
	// 					if ($is_exsist) {
	// 						$this->recruitment_model->add_rec_contract($insert_crew_contract_data);
	// 					}
	// 				}
	// 			}
	// 		}
	// 		echo '<pre>';
	// 		print_r('Done');
	// 		die;
	// 	}


	public function save_custom_filed_setting_principals()
	{
		$post = $this->input->post();
		if ($post) {
			$data = $this->input->post();
			$hid = isset($data['hid']) ? $data['hid'] : '';
			if (isset($data['hid'])) {
				unset($data['hid']);
			}
			if ($hid != '') {
				$id = $this->recruitment_model->update_custom_filed_setting_principals($data, $hid);
				set_alert('success', _l('updated_successfully'));
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_principals'));
			} else {
				$id = $this->recruitment_model->add_custom_filed_setting_principals($data);
				if ($id) {
					set_alert('success', _l('added_successfully'));
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_principals'));
			}
		}
	}

	public function edit_custom_filed_setting_principal()
	{
		$post = $this->input->post();
		$res['status'] = 0;
		$res['custom_filed_setting_principal'] = [];
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			if ($id > 0) {
				$custom_filed_setting_principal = $this->recruitment_model->get_custom_filed_setting_principal_data($id);
				if (!empty($custom_filed_setting_principal)) {
					$res['status'] = 1;
					$res['custom_filed_setting_principal'] = $custom_filed_setting_principal;
				}
			}
		}
		echo json_encode($res);
		die;
	}

	// delete_custom_filed_setting_principals
	public function delete_custom_filed_setting_principals($id = '')
	{
		if ($id > 0) {
			if ($this->recruitment_model->delete_custom_filed_setting_principals($id)) {
				set_alert('success', _l('deleted_successfully'));
			} else {
				set_alert('warning', _l('delete_failed'));
			}
		}

		redirect(admin_url('recruitment/setting?group=custom_filed_setting_principals'));
	}

	public function edit_vessel_name()
	{
		$post = $this->input->post();
		$res['status'] = 0;
		$res['vessel_name'] = [];
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			if ($id > 0) {
				$vessel_name = $this->recruitment_model->get_vessel_name($id);
				if (!empty($vessel_name)) {
					$res['status'] = 1;
					$res['vessel_name'] = $vessel_name;
				}
			}
		}
		echo json_encode($res);
		die;
	}

	public function save_custom_filed_setting_salary_scale()
	{
		$post = $this->input->post();
		if ($post) {
			$data = $this->input->post();
			$hid = isset($data['hid']) ? $data['hid'] : '';
			if (isset($data['hid'])) {
				unset($data['hid']);
			}
			if ($hid != '') {
				$id = $this->recruitment_model->update_custom_filed_setting_salary_scale($data, $hid);
				set_alert('success', _l('updated_successfully'));
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_salary_scale'));
			} else {
				$id = $this->recruitment_model->add_custom_filed_setting_salary_scale($data);
				if ($id) {
					set_alert('success', _l('added_successfully'));
				}
				redirect(admin_url('recruitment/setting?group=custom_filed_setting_salary_scale'));
			}
		}
	}

	public function delete_custom_filed_setting_salary_scale($id = '')
	{
		if ($id > 0) {
			if ($this->recruitment_model->delete_custom_filed_setting_salary_scale($id)) {
				set_alert('success', _l('deleted_successfully'));
			} else {
				set_alert('warning', _l('delete_failed'));
			}
		}

		redirect(admin_url('recruitment/setting?group=custom_filed_setting_salary_scale'));
	}

	public function edit_custom_filed_setting_salary_scale()
	{
		$post = $this->input->post();
		$res['status'] = 0;
		$res['custom_filed_setting_salary_scale'] = [];
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			if ($id > 0) {
				$custom_filed_setting_salary_scale = $this->recruitment_model->get_custom_filed_setting_salary_scale_data($id);
				if (!empty($custom_filed_setting_salary_scale)) {
					$res['status'] = 1;
					$res['custom_filed_setting_salary_scale'] = $custom_filed_setting_salary_scale;
				}
			}
		}
		echo json_encode($res);
		die;
	}

	public function update_licence_3_mark()
	{
		$tr_id = $this->input->post('tr_id');

		$response = [
			'success' => false,
			'message' => 'Invalid Request'
		];

		if ($tr_id > 0) {

			$record = $this->db
				->where('id', $tr_id)
				->get(db_prefix() . 'rec_licence_3')
				->row();

			if ($record) {

				$crew_id = $record->candidate;

				// Make all licences of this crew unmarked
				$this->db
					->where('candidate', $crew_id)
					->update(db_prefix() . 'rec_licence_3', [
						'mark' => 0
					]);

				// Mark selected licence
				$this->db
					->where('id', $tr_id)
					->update(db_prefix() . 'rec_licence_3', [
						'mark' => 1
					]);

				$response = [
					'success' => true,
					'message' => 'Updated Successfully'
				];
			}
		}

		echo json_encode($response);
		die;
	}

	public function quick_edit_crew_detail()
	{
		$post = $this->input->post();
		if (!empty($post)) {
			foreach ($post as $key => $value) {
				$data = [];
				if ($key == 'uniform_working_gears') {
					$data['uniform_working_gears'] = $value;
				}
				if ($key == 'uniform_shoes') {
					$data['uniform_shoes'] = $value;
				}
				if ($key == 'uniform_waist') {
					$data['uniform_waist'] = $value;
				}
				if ($key == 'weight') {
					$data['weight'] = $value;
				}
				if ($key == 'uniform_height') {
					$data['uniform_height'] = $value;
				}
				if (!empty($data)) {

					$updated = $this->db->update(db_prefix() . 'rec_candidate', $data);
					if ($updated) {
						set_alert('success', 'Data Updated');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
	}
}
