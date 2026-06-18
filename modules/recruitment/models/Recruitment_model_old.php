<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Recruitment Model
 */
class Recruitment_model extends App_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * get job position
	 * @param  boolean $id
	 * @return object
	 */
	public function get_job_position($id = false)
	{

		if (is_numeric($id)) {
			$this->db->where('position_id', $id);

			return $this->db->get(db_prefix() . 'rec_job_position')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tblrec_job_position')->result_array();
		}
	}

	/**
	 * add job position
	 * @param object $data
	 */
	public function add_job_position($data)
	{

		if (isset($data['job_skill'])) {
			$data['job_skill'] = implode(',', $data['job_skill']);
		}

		$this->db->insert(db_prefix() . 'rec_job_position', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update job position
	 * @param  object $data
	 * @param  int $id
	 * @return bool
	 */
	public function update_job_position($data, $id)
	{
		if (isset($data['job_skill'])) {
			$data['job_skill'] = implode(',', $data['job_skill']);
		} else {

			$data['job_skill'] = '';
		}

		$this->db->where('position_id', $id);
		$this->db->update(db_prefix() . 'rec_job_position', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete job position
	 * @param  int $id
	 * @return bool
	 */
	public function delete_job_position($id)
	{
		$this->db->where('position_id', $id);
		$this->db->delete(db_prefix() . 'rec_job_position');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	public function delete_country($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'countries_new');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	public function delete_followup($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_followup');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function delete_travel($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_travel_identification');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	public function delete_travel_info($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_travel_identification');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	public function delete_other_licence($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_other_licence_identification');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	public function delete_licence_3($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_licence_3');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	public function delete_licence_4($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_licence_4');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	public function delete_licence_5($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_licence_5');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	public function delete_licence_6($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_licence_6');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function emp_delete_contract($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_employee_contract');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function delete_request_renew($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'request_renew_list');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function delete_state($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'states_new');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add recruitment proposal
	 * @param object $data
	 */
	public function add_recruitment_proposal($data)
	{
		if (isset($data['file'])) {
			unset($data['file']);
		}
		$data['salary_from'] = reformat_currency_rec($data['salary_from']);
		$data['salary_to'] = reformat_currency_rec($data['salary_to']);
		$data['from_date'] = to_sql_date($data['from_date']);
		$data['to_date'] = to_sql_date($data['to_date']);
		$data['date_add'] = date('Y-m-d');
		$data['status'] = 1;
		$this->db->insert(db_prefix() . 'rec_proposal', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update recruitment proposal
	 * @param  object $data
	 * @param  int $id
	 * @return bool
	 */
	public function update_recruitment_proposal($data, $id)
	{
		if (isset($data['file'])) {
			unset($data['file']);
		}
		$data['salary_from'] = reformat_currency_rec($data['salary_from']);
		$data['salary_to'] = reformat_currency_rec($data['salary_to']);
		$data['from_date'] = to_sql_date($data['from_date']);
		$data['to_date'] = to_sql_date($data['to_date']);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_proposal', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete recruitment proposal
	 * @param  int $id
	 * @return bool
	 */
	public function delete_recruitment_proposal($id)
	{
		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_proposal');
		$attachments = $this->db->get('tblfiles')->result_array();
		foreach ($attachments as $attachment) {
			$this->delete_proposal_attachment($attachment['id']);
		}
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'rec_proposal');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function delete_city($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'cities_new');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get rec proposal
	 * @param  string $id
	 * @return object
	 */
	public function get_rec_proposal($id = '')
	{
		if ($id != '') {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'rec_proposal')->row();
		} elseif ($id == '') {
			return $this->db->get(db_prefix() . 'rec_proposal')->result_array();
		}
	}

	/**
	 * get rec proposal by status
	 * @param  int $status
	 * @return object
	 */
	public function get_rec_proposal_by_status($status)
	{
		$this->db->where('status', $status);
		return $this->db->get(db_prefix() . 'rec_proposal')->result_array();
	}

	/**
	 * get proposal file
	 * @param  object $proposal
	 * @return int
	 */
	public function get_proposal_file($proposal)
	{
		$this->db->where('rel_id', $proposal);
		$this->db->where('rel_type', 'rec_proposal');
		return $this->db->get('tblfiles')->result_array();
	}

	/**
	 * delete proposal attachment
	 * @param  int $id
	 * @return bool
	 */
	public function delete_proposal_attachment($id)
	{
		$attachment = $this->get_proposal_attachments('', $id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/proposal/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/proposal/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/proposal/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/proposal/' . $attachment->rel_id);
				}
			}
		}
		return $deleted;
	}

	/**
	 * get proposal attachments
	 * @param  object $proposal
	 * @param  string $id
	 * @return int
	 */
	public function get_proposal_attachments($proposal, $id = '')
	{
		// If is passed id get return only 1 attachment
		if (is_numeric($id)) {
			$this->db->where('id', $id);
		} else {
			$this->db->where('rel_id', $proposal);
		}
		$this->db->where('rel_type', 'rec_proposal');
		$result = $this->db->get('tblfiles');
		if (is_numeric($id)) {
			return $result->row();
		}
		return $result->result_array();
	}

	/**
	 * get file
	 * @param  int  $id
	 * @param  boolean $rel_id
	 * @return object
	 */
	public function get_file($id, $rel_id = false)
	{
		$this->db->where('id', $id);
		$file = $this->db->get('tblfiles')->row();

		if ($file && $rel_id) {
			if ($file->rel_id != $rel_id) {
				return false;
			}
		}
		return $file;
	}

	/**
	 * approve reject proposal
	 * @param  int $type
	 * @param  int $id
	 * @return bool
	 */
	public function approve_reject_proposal($type, $id)
	{
		if ($type == 'approved') {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'rec_proposal', ['status' => 2]);
			if ($this->db->affected_rows() > 0) {
				return 'approved';
			}
			return false;
		} elseif ($type == 'reject') {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'rec_proposal', ['status' => 4]);
			if ($this->db->affected_rows() > 0) {
				return 'reject';
			}
			return false;
		}
	}

	/**
	 * add recruitment campaign
	 * @param object $data
	 */
	public function add_recruitment_campaign($data)
	{
		if (isset($data['display_salary'])) {
			$data['display_salary'] = 1;
		} else {
			$data['display_salary'] = 0;
		}

		if (isset($data['file'])) {
			unset($data['file']);
		}
		if (isset($data['cp_proposal'])) {
			$data['cp_proposal'] = implode(',', $data['cp_proposal']);
		}

		if (isset($data['cp_manager'])) {
			$data['cp_manager'] = implode(',', $data['cp_manager']);
		}

		if (isset($data['cp_follower'])) {
			$data['cp_follower'] = implode(',', $data['cp_follower']);
		}

		$data['cp_salary_from'] = reformat_currency_rec($data['cp_salary_from']);
		$data['cp_salary_to'] = reformat_currency_rec($data['cp_salary_to']);
		$data['cp_from_date'] = to_sql_date($data['cp_from_date']);
		$data['cp_to_date'] = to_sql_date($data['cp_to_date']);
		$data['cp_date_add'] = date('Y-m-d');
		$data['cp_status'] = 1;
		$data['cp_add_from'] = get_staff_user_id();
		$this->db->insert(db_prefix() . 'rec_campaign', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update recruitment campaign
	 * @param  object $data
	 * @param  int $id
	 * @return bool
	 */
	public function update_recruitment_campaign($data, $id)
	{
		if (isset($data['display_salary'])) {
			$data['display_salary'] = 1;
		} else {
			$data['display_salary'] = 0;
		}

		if (isset($data['file'])) {
			unset($data['file']);
		}
		if (isset($data['cp_proposal'])) {
			$data['cp_proposal'] = implode(',', $data['cp_proposal']);
		}

		if (isset($data['cp_manager'])) {
			$data['cp_manager'] = implode(',', $data['cp_manager']);
		}

		if (isset($data['cp_follower'])) {
			$data['cp_follower'] = implode(',', $data['cp_follower']);
		}
		$data['cp_salary_from'] = reformat_currency_rec($data['cp_salary_from']);
		$data['cp_salary_to'] = reformat_currency_rec($data['cp_salary_to']);
		$data['cp_from_date'] = to_sql_date($data['cp_from_date']);
		$data['cp_to_date'] = to_sql_date($data['cp_to_date']);
		$data['cp_add_from'] = get_staff_user_id();

		$this->db->where('cp_id', $id);
		$this->db->update(db_prefix() . 'rec_campaign', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete recruitment campaign
	 * @param  [type] $id
	 * @return [type]
	 */
	public function delete_recruitment_campaign($id)
	{
		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_campaign');
		$attachments = $this->db->get('tblfiles')->result_array();
		foreach ($attachments as $attachment) {
			$this->delete_campaign_attachment($attachment['id']);
		}
		$this->db->where('cp_id', $id);
		$this->db->delete(db_prefix() . 'rec_campaign');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * get rec campaign
	 * @param  string $id
	 * @return object
	 */
	public function get_rec_campaign($id = '')
	{
		if ($id != '') {
			$this->db->where('cp_id', $id);
			return $this->db->get(db_prefix() . 'rec_campaign')->row();
		} elseif ($id == '') {
			return $this->db->get(db_prefix() . 'rec_campaign')->result_array();
		}
	}

	/**
	 * get campaign_file
	 * @param  object $proposal
	 * @return object
	 */
	public function get_campaign_file($proposal)
	{
		$this->db->where('rel_id', $proposal);
		$this->db->where('rel_type', 'rec_campaign');
		return $this->db->get('tblfiles')->result_array();
	}

	/**
	 * delete campaign attachment
	 * @param  int $id
	 * @return bool
	 */
	public function delete_campaign_attachment($id)
	{
		$attachment = $this->get_campaign_attachments('', $id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/campaign/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/campaign/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/campaign/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/campaign/' . $attachment->rel_id);
				}
			}
		}

		return $deleted;
	}

	/**
	 * get campaign attachments
	 * @param  object $campaign
	 * @param  int $id
	 * @return object
	 */
	public function get_campaign_attachments($campaign, $id = '')
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
		} else {
			$this->db->where('rel_id', $campaign);
		}
		$this->db->where('rel_type', 'rec_campaign');
		$result = $this->db->get('tblfiles');
		if (is_numeric($id)) {
			return $result->row();
		}

		return $result->result_array();
	}

	/**
	 * add candidate
	 * @param object $data
	 */
	public function add_candidate($data, $file = "")
	{
		$data['birthday'] = $data['birthday'];

		if (!$this->check_format_date($data['birthday'])) {
			$data['birthday'] = to_sql_date($data['birthday']);
		}

		$data['hired_date'] = to_sql_date($data['hired_date']);
		$data['promotion'] = to_sql_date($data['promotion']);
		$data['department_date'] = to_sql_date($data['department_date']);

		if (isset($data['disability_rating_date'])) {
			$data['disability_rating_date'] = to_sql_date($data['disability_rating_date']);
		}

		$data['status'] = 1;
		$data['date_add'] = date('Y-m-d');

		if (isset($data['from_date'])) {
			$from_date = $data['from_date'];
			unset($data['from_date']);
		}

		if (isset($data['to_date'])) {
			$to_date = $data['to_date'];
			unset($data['to_date']);
		}

		if (isset($data['company'])) {
			$company = $data['company'];
			unset($data['company']);
		}

		if (isset($data['position'])) {
			$position = $data['position'];
			unset($data['position']);
		}

		if (isset($data['contact_person'])) {
			$contact_person = $data['contact_person'];
			unset($data['contact_person']);
		}

		if (isset($data['salary'])) {
			$salary = $data['salary'];
			unset($data['salary']);
		}

		if (isset($data['reason_quitwork'])) {
			$reason_quitwork = $data['reason_quitwork'];
			unset($data['reason_quitwork']);
		}

		if (isset($data['job_description'])) {
			$job_description = $data['job_description'];
			unset($data['job_description']);
		}

		if (isset($data['literacy_from_date'])) {
			$literacy_from_date = $data['literacy_from_date'];
			unset($data['literacy_from_date']);
		}

		if (isset($data['literacy_to_date'])) {
			$literacy_to_date = $data['literacy_to_date'];
			unset($data['literacy_to_date']);
		}

		if (isset($data['diploma'])) {
			$diploma = $data['diploma'];
			unset($data['diploma']);
		}

		if (isset($data['training_places'])) {
			$training_places = $data['training_places'];
			unset($data['training_places']);
		}

		if (isset($data['specialized'])) {
			$specialized = $data['specialized'];
			unset($data['specialized']);
		}

		if (isset($data['training_form'])) {
			$training_form = $data['training_form'];
			unset($data['training_form']);
		}

		if (isset($data['relationship'])) {
			$relationship = $data['relationship'];
			unset($data['relationship']);
		}

		if (isset($data['name'])) {
			$name = $data['name'];
			unset($data['name']);
		}

		if (isset($data['fi_birthday'])) {
			$fi_birthday = $data['fi_birthday'];
			unset($data['fi_birthday']);
		}

		if (isset($data['job'])) {
			$job = $data['job'];
			unset($data['job']);
		}

		if (isset($data['address'])) {
			$address = $data['address'];
			unset($data['address']);
		}

		if (isset($data['phone'])) {
			$phone = $data['phone'];
			unset($data['phone']);
		}

		if (isset($data['rank'])) {
			$data['rank'] = implode(',', $data['rank']);
		}

		if (isset($data['department'])) {
			$data['department'] = $data['department'];
		}

		if (isset($data['status_type'])) {
			$data['status_type'] = implode(',', $data['status_type']);
		}

		if (isset($data['reward_file_name'])) {
			unset($data['reward_file_name']);
		}

		if (isset($data['licence_attach_file_name'])) {
			unset($data['licence_attach_file_name']);
		}

		if (isset($data['doc_attach_file_name'])) {
			unset($data['doc_attach_file_name']);
		}

		$this->db->insert(db_prefix() . 'rec_candidate', $data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			foreach ($from_date as $key => $val) {
				if ($from_date[$key] != '') {

					if (!$this->check_format_date($val)) {
						$val = to_sql_date($val);
					}
					if (!$this->check_format_date($to_date[$key])) {
						$to_date[$key] = to_sql_date($to_date[$key]);
					}

					$this->db->insert(db_prefix() . 'cd_work_experience', [
						'candidate' => $insert_id,
						'from_date' => $val,
						'to_date' => $to_date[$key],
						'company' => $company[$key],
						'position' => $position[$key],
						'contact_person' => $contact_person[$key],
						'salary' => $salary[$key],
						'reason_quitwork' => $reason_quitwork[$key],
						'job_description' => $job_description[$key],
					]);
				}
			}

			foreach ($literacy_from_date as $key => $val) {
				if ($literacy_from_date[$key] != '') {

					if (!$this->check_format_date($val)) {
						$val = to_sql_date($val);
					}

					if (!$this->check_format_date($literacy_to_date[$key])) {
						$literacy_to_date[$key] = to_sql_date($literacy_to_date[$key]);
					}

					$this->db->insert(db_prefix() . 'cd_literacy', [
						'candidate' => $insert_id,
						'literacy_from_date' => $val,
						'literacy_to_date' => $literacy_to_date[$key],
						'diploma' => $diploma[$key],
						'training_places' => $training_places[$key],
						'specialized' => $specialized[$key],
						'training_form' => $training_form[$key],
					]);
				}
			}

			foreach ($relationship as $key => $val) {
				if ($relationship[$key] != '') {

					if (!$this->check_format_date($fi_birthday[$key])) {
						$fi_birthday[$key] = to_sql_date($fi_birthday[$key]);
					}

					$this->db->insert(db_prefix() . 'cd_family_infor', [
						'candidate' => $insert_id,
						'relationship' => $val,
						'name' => $name[$key],
						'fi_birthday' => $fi_birthday[$key],
						'job' => $job[$key],
						'address' => $address[$key],
						'phone' => $phone[$key],
					]);
				}
			}

			return $insert_id;
		}
	}

	/**
	 * change status campaign
	 * @param  int $status
	 * @param  int $id
	 * @return bool
	 */
	public function change_status_campaign($status, $id)
	{
		$this->db->where('cp_id', $id);
		$this->db->update(db_prefix() . 'rec_campaign', ['cp_status' => $status]);
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * get Family Candidate
	 * @param  string $id
	 * @return object
	 */

	public function get_family_candidate($id = '')
	{
		$this->db->where('id', $id);
		$family_info = $this->db->get(db_prefix() . 'rec_family')->row();

		if (!$family_info) {
			return false;
		}
		return $family_info;
	}

	/**
	 * get Education Candidate
	 * @param  string $id
	 * @return object
	 */

	public function get_education_candidate($id = '')
	{
		$this->db->where('id', $id);
		$eduaction_info = $this->db->get(db_prefix() . 'rec_education')->row();

		if (!$eduaction_info) {
			return false;
		}
		return $eduaction_info;
	}

	public function get_school_candidate($id = '')
	{
		$this->db->where('id', $id);
		$school_info = $this->db->get(db_prefix() . 'rec_school')->row();

		if (!$school_info) {
			return false;
		}
		return $school_info;
	}

	/**
	 * get Reward
	 * @param  string $id
	 * @return object
	 */

	public function get_reward_candidate($id = '')
	{
		$this->db->where('id', $id);
		$reward_info = $this->db->get(db_prefix() . 'rec_reward')->row();

		if (!$reward_info) {
			return false;
		}
		return $reward_info;
	}

	public function get_reward_by_candidate_id($id = '')
	{
		$this->db->where('candidate', $id);
		$reward_info = $this->db->get(db_prefix() . 'rec_reward')->result_array();

		if (!$reward_info) {
			return false;
		}
		return $reward_info;
	}

	public function get_licence_by_candidate_id($id = '')
	{
		$this->db->where('candidate', $id);
		$reward_info = $this->db->get(db_prefix() . 'rec_licence')->result_array();

		if (!$reward_info) {
			return false;
		}
		return $reward_info;
	}

	public function get_document_by_candidate_id($id = '')
	{
		$this->db->where('candidate', $id);
		$reward_info = $this->db->get(db_prefix() . 'rec_document')->result_array();

		if (!$reward_info) {
			return false;
		}
		return $reward_info;
	}

	/**
	 * get Licence
	 * @param  string $id
	 * @return object
	 */

	public function get_licence_candidate($id = '')
	{
		$this->db->where('id', $id);
		$licence_info = $this->db->get(db_prefix() . 'rec_licence')->row();

		if (!$licence_info) {
			return false;
		}
		return $licence_info;
	}

	public function get_passport_candidate($id = '')
	{
		$this->db->where('id', $id);
		$passport_info = $this->db->get(db_prefix() . 'rec_passport')->row();

		if (!$passport_info) {
			return false;
		}
		return $passport_info;
	}



	public function get_travel_info($id = '')
	{
		$this->db->where('id', $id);
		return $this->db->get(db_prefix() . 'rec_travel_identification')->row();
	}

	public function get_other_license_info($id = '')
	{
		$this->db->select('rec_other_licence_identification.*, job_other_licence_identification.no_expired');
		$this->db->from(db_prefix() . 'rec_other_licence_identification'); // Main table
		$this->db->join(db_prefix() . 'job_other_licence_identification', db_prefix() . 'rec_other_licence_identification.document_type = ' . db_prefix() . 'job_other_licence_identification.id', 'left');
		$this->db->where('rec_other_licence_identification.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_license_3_info($id = '')
	{
		$this->db->where('id', $id);
		return $this->db->get(db_prefix() . 'rec_licence_3')->row();
	}

	public function get_license_4_info($id = '')
	{
		$this->db->where('id', $id);
		return $this->db->get(db_prefix() . 'rec_licence_4')->row();
	}

	public function get_license_5_info($id = '')
	{
		$this->db->where('id', $id);
		return $this->db->get(db_prefix() . 'rec_licence_5')->row();
	}

	public function get_license_6_info($id = '')
	{
		$this->db->where('id', $id);
		return $this->db->get(db_prefix() . 'rec_licence_6')->row();
	}

	public function get_contract_info($candidate_id = '', $id = '')
	{
		$query = $this->db->select([
			'job.id',
			'job.emp_document_type',
			'rec.expiry_date',
			'job.emp_expiration_date',
			'rec.id as tr_id',
			'rec.candidate',
			'rec.licence_no',
			'rec.acquisition_date',
			'rec.issue_authority',
			'rec.attach_file',
			'rec.remark',
			'rec.expiration_date as rec_expiration_date'
		])
			->from(db_prefix() . 'job_employee_contract as job')
			->join(
				db_prefix() . 'rec_employee_contract as rec',
				'rec.document_type = job.id AND (rec.candidate = ' . $this->db->escape($candidate_id) . ' OR rec.candidate IS NULL)',
				'left'
			);
		if ($id != '' && $id != 0) {
			$query->or_where('job.id', $id);
		}
		return $query->get()->row();
	}

	/**
	 * get Document
	 * @param  string $id
	 * @return object
	 */

	public function get_document_candidate($id = '')
	{
		$this->db->where('id', $id);
		$docuemnt_info = $this->db->get(db_prefix() . 'rec_document')->row();

		if (!$docuemnt_info) {
			return false;
		}
		return $docuemnt_info;
	}

	/**
	 * get Flag
	 * @param  string $id
	 * @return object
	 */

	public function get_flag_candidate($id = '')
	{
		$this->db->where('id', $id);
		$flag_info = $this->db->get(db_prefix() . 'rec_flag')->row();

		if (!$flag_info) {
			return false;
		}
		return $flag_info;
	}

	/**
	 * get Medical
	 * @param  string $id
	 * @return object
	 */
	public function get_medical_candidate($id = '')
	{
		$this->db->where('id', $id);
		$medical_info = $this->db->get(db_prefix() . 'rec_medical')->row();

		if (!$medical_info) {
			return false;
		}
		return $medical_info;
	}

	/**
	 * get Promotion
	 * @param  string $id
	 * @return object
	 */
	public function get_promotion_candidate($id = '')
	{
		$this->db->where('id', $id);
		$medical_info = $this->db->get(db_prefix() . 'rec_promotion')->row();

		if (!$medical_info) {
			return false;
		}
		return $medical_info;
	}

	/**
	 * get PSC
	 * @param  string $id
	 * @return object
	 */
	public function get_psc_candidate($id = '')
	{
		$this->db->where('id', $id);
		$psc_info = $this->db->get(db_prefix() . 'rec_psc')->row();

		if (!$psc_info) {
			return false;
		}
		return $psc_info;
	}

	/**
	 * get candidates
	 * @param  string $id
	 * @return object
	 */
	public function get_candidates($id = '')
	{
		if ($id == '') {
			return $this->db->get(db_prefix() . 'rec_candidate')->result_array();
		} else {
			$this->db->where('id', $id);
			$candidate = $this->db->get(db_prefix() . 'rec_candidate')->row();

			$this->db->where('candidate', $id);
			$candidate->literacy = $this->db->get(db_prefix() . 'cd_literacy')->result_array();

			$this->db->where('candidate', $id);
			$candidate->family_infor = $this->db->get(db_prefix() . 'cd_family_infor')->result_array();

			$this->db->where('candidate', $id);
			$candidate->education = $this->db->get(db_prefix() . 'rec_education')->result_array();

			$this->db->where('candidate', $id);
			$candidate->promotion_info = $this->db->get(db_prefix() . 'rec_promotion')->result_array();

			$this->db->where('candidate', $id);
			$candidate->school = $this->db->get(db_prefix() . 'rec_school')->result_array();

			$this->db->where('candidate', $id);
			$candidate->work_experience = $this->db->get(db_prefix() . 'cd_work_experience')->result_array();

			$this->db->where('candidate', $id);
			$candidate->family_info = $this->db->get(db_prefix() . 'rec_family')->result_array();

			$this->db->where('candidate', $id);
			$candidate->reward_info = $this->db->get(db_prefix() . 'rec_reward')->result_array();

			$this->db->where('candidate', $id);
			$candidate->licence_info = $this->db->get(db_prefix() . 'rec_licence')->result_array();

			$this->db->where('candidate', $id);
			$candidate->document_info = $this->db->get(db_prefix() . 'rec_document')->result_array();

			$this->db->where('candidate', $id);
			$candidate->passport_info = $this->db->get(db_prefix() . 'rec_passport')->result_array();

			$query = $this->db->select([
				'job.id',
				'job.order_no',
				'job.no_expired',
				'job.display_info',
				'job.document_type',
				'rec.expiry_date',
				'job.expiration_date',
				'rec.id as tr_id',
				'rec.candidate',
				'rec.hideexpire',
				'rec.request_renew',
				'rec.licence_no',
				'rec.acquisition_date',
				'rec.issue_authority',
				'rec.attach_file',
				'rec.remark',
				'rec.expiration_date as rec_expiration_date'
			])
				->from(db_prefix() . 'job_travel_identification as job')
				->join(
					db_prefix() . 'rec_travel_identification as rec',
					'rec.document_type = job.id AND (rec.candidate = ' . $this->db->escape($id) . ' OR rec.candidate IS NULL)',
					'left'
				)
				->get();

			$candidate->travel_info = $query->result_array();


			$query = $this->db->select([
				'job.id',
				'job.order_no',
				'job.no_expired',
				'job.display_info',
				'job.document_type',
				'rec.expiry_date',
				'job.expiration_date',
				'rec.id as tr_id',
				'rec.candidate',
				'rec.hideexpire',
				'rec.licence_no',
				'rec.acquisition_date',
				'rec.issue_authority',
				'rec.attach_file',
				'rec.remark',
				'rec.expiration_date as rec_expiration_date'
			])
				->from(db_prefix() . 'job_other_licence_identification as job')
				->join(
					db_prefix() . 'rec_other_licence_identification as rec',
					'rec.document_type = job.id AND (rec.candidate = ' . $this->db->escape($id) . ' OR rec.candidate IS NULL)',
					'left'
				)
				->get();

			$candidate->other_licence_info = $query->result_array();


			$query = $this->db->select([
				'job.id',
				'job.order_no',
				'job.no_expired',
				'job.display_info',
				'job.document_type',
				'rec.expiry_date',
				'job.expiration_date',
				'rec.id as tr_id',
				'rec.candidate',
				'rec.hideexpire',
				'rec.licence_no',
				'rec.acquisition_date',
				'rec.issue_authority',
				'rec.attach_file',
				'rec.remark',
				'rec.expiration_date as rec_expiration_date'
			])
				->from(db_prefix() . 'job_licence_3 as job')
				->join(
					db_prefix() . 'rec_licence_3 as rec',
					'rec.document_type = job.id AND (rec.candidate = ' . $this->db->escape($id) . ' OR rec.candidate IS NULL)',
					'left'
				)
				->get();

			$candidate->rec_licence_3 = $query->result_array();


			$query = $this->db->select([
				'job.id',
				'job.order_no',
				'job.no_expired',
				'job.display_info',
				'rec.hideexpire',
				'job.document_type',
				'rec.expiry_date',
				'job.expiration_date',
				'rec.id as tr_id',
				'rec.candidate',
				'rec.licence_no',
				'rec.acquisition_date',
				'rec.issue_authority',
				'rec.attach_file',
				'rec.remark',
				'rec.expiration_date as rec_expiration_date'
			])
				->from(db_prefix() . 'job_licence_4 as job')
				->join(
					db_prefix() . 'rec_licence_4 as rec',
					'rec.document_type = job.id AND (rec.candidate = ' . $this->db->escape($id) . ' OR rec.candidate IS NULL)',
					'left'
				)
				->get();

			$candidate->rec_licence_4 = $query->result_array();


			$query = $this->db->select([
				'job.id',
				'job.order_no',
				'job.no_expired',
				'job.display_info',
				'job.document_type',
				'rec.expiry_date',
				'rec.hideexpire',
				'job.expiration_date',
				'rec.id as tr_id',
				'rec.candidate',
				'rec.licence_no',
				'rec.acquisition_date',
				'rec.issue_authority',
				'rec.attach_file',
				'rec.remark',
				'rec.expiration_date as rec_expiration_date'
			])
				->from(db_prefix() . 'job_licence_5 as job')
				->join(
					db_prefix() . 'rec_licence_5 as rec',
					'rec.document_type = job.id AND (rec.candidate = ' . $this->db->escape($id) . ' OR rec.candidate IS NULL)',
					'left'
				)
				->get();

			$candidate->rec_licence_5 = $query->result_array();


			$query = $this->db->select([
				'job.id',
				'job.order_no',
				'job.no_expired',
				'job.display_info',
				'job.document_type',
				'rec.expiry_date',
				'rec.hideexpire',
				'job.expiration_date',
				'rec.id as tr_id',
				'rec.candidate',
				'rec.licence_no',
				'rec.acquisition_date',
				'rec.issue_authority',
				'rec.attach_file',
				'rec.remark',
				'rec.expiration_date as rec_expiration_date'
			])
				->from(db_prefix() . 'job_licence_6 as job')
				->join(
					db_prefix() . 'rec_licence_6 as rec',
					'rec.document_type = job.id AND (rec.candidate = ' . $this->db->escape($id) . ' OR rec.candidate IS NULL)',
					'left'
				)
				->get();

			$candidate->rec_licence_6 = $query->result_array();

			$query_contract = $this->db->select([
				'job.id',
				'job.order_no',
				'job.emp_document_type',
				'rec.expiry_date',
				'job.emp_expiration_date',
				'rec.id as tr_id',
				'rec.candidate',
				'rec.licence_no',
				'rec.acquisition_date',
				'rec.issue_authority',
				'rec.attach_file',
				'rec.remark',
				'rec.expiration_date as rec_expiration_date'
			])
				->from(db_prefix() . 'job_employee_contract as job')
				->join(
					db_prefix() . 'rec_employee_contract as rec',
					'rec.document_type = job.id AND (rec.candidate = ' . $this->db->escape($id) . ' OR rec.candidate IS NULL)',
					'left'
				)
				->get();

			$candidate->contract_info = $query_contract->result_array();

			$this->db->where('candidate', $id);
			$candidate->flag_info = $this->db->get(db_prefix() . 'rec_flag')->result_array();

			$this->db->where('candidate', $id);
			$candidate->medical_info = $this->db->get(db_prefix() . 'rec_medical')->result_array();

			$this->db->where('rel_id', $id);
			$this->db->where('rel_type', 'rec_cadidate_avar');
			$candidate->avar = $this->db->get(db_prefix() . 'files')->row();

			$this->db->where('rel_id', $id);
			$this->db->where('rel_type', 'rec_cadidate_file');
			$candidate->file = $this->db->get(db_prefix() . 'files')->result_array();

			$this->db->from(db_prefix() . 'cd_care');
			$this->db->where(db_prefix() . 'cd_care.candidate', $id);
			$this->db->order_by(db_prefix() . 'cd_care.id', 'desc');
			$candidate->care = $this->db->get()->result_array();

			$this->db->where('candidate', $id);
			$this->db->order_by('embarkation_date', 'desc');
			$candidate->on_board_company = $this->db->get(db_prefix() . 'rec_on_board_company')->result_array();

			$this->db->where('candidate', $id);
			$candidate->psc_info = $this->db->get(db_prefix() . 'rec_psc')->result_array();

			$this->db->where('candidate', $id);
			$this->db->order_by('embarkation_date', 'desc');
			$candidate->on_board_other_company = $this->db->get(db_prefix() . 'rec_on_board_other_company')->result_array();

			$this->db->where('candidate', $id);
			$candidate->on_board_in_land = $this->db->get(db_prefix() . 'rec_on_board_in_land')->result_array();

			return $candidate;
		}
	}



	public function get_onborad_status($id)
	{
		$this->db->select('COUNT(*) as cur_onboard');
		$this->db->where('candidate', $id);
		$this->db->where('cur_onboard', 1);
		$result = $this->db->get(db_prefix() . 'rec_on_board_company')->row();
		return $result;
	}

	public function update_vessel_emp_status($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update(db_prefix() . 'rec_candidate', $data);
	}

	/**
	 * update reward info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_reward_info_cadidate($data)
	{
		$id = $data['reward_id'];

		if (!empty($data['reward_file'])) {
			$updated['app_date'] = to_sql_date($data['app_date']);
			$updated['award_punishment'] = $data['award_punishment'];
			$updated['grade_rank'] = $data['grade_rank'];
			$updated['award_punishment_kind'] = $data['award_punishment_kind'];
			$updated['award_punishment_reason'] = $data['award_punishment_reason'];
			$updated['rewards_remark'] = $data['rewards_remark'];
			$updated['reward_file'] = $data['reward_file'];
		} else {
			$updated['app_date'] = to_sql_date($data['app_date']);
			$updated['award_punishment'] = $data['award_punishment'];
			$updated['grade_rank'] = $data['grade_rank'];
			$updated['award_punishment_kind'] = $data['award_punishment_kind'];
			$updated['award_punishment_reason'] = $data['award_punishment_reason'];
			$updated['rewards_remark'] = $data['rewards_remark'];
		}
		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_reward', $updated);

		if (!$success) {
			return true;
		}
		return true;
	}

	/**
	 * update reward info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_licence_info_cadidate($data)
	{
		$id = $data['licence_id'];

		if (!empty($data['licence_attach_file'])) {
			$updated['kind_division'] = implode('', $data['lic_kind_division']);
			$updated['licence_no'] = $data['lic_licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['lic_acquisition_date']);
			$updated['exipiry_date'] = to_sql_date($data['lic_exipiry_date']);
			$updated['issue_authority'] = $data['lic_issue_authority'];
			$updated['remark'] = $data['licence_remark'];
			$updated['attach_file'] = $data['licence_attach_file'];
		} else {
			$updated['kind_division'] = implode('', $data['lic_kind_division']);
			$updated['licence_no'] = $data['lic_licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['lic_acquisition_date']);
			$updated['exipiry_date'] = to_sql_date($data['lic_exipiry_date']);
			$updated['issue_authority'] = $data['lic_issue_authority'];
			$updated['remark'] = $data['licence_remark'];
		}
		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_licence', $updated);

		if (!$success) {
			return true;
		}

		return true;
	}

	public function update_passport_info_cadidate($data)
	{
		$id = $data['passport_id'];

		$updated = [
			'passport_no' => $data['passport_no'],
			'document_type_password' => $data['document_type_password'],
			'expiration_date_passport' => $data['expiration_date_passport'],
			'acquisition_date' => to_sql_date($data['acquisition_date']),
			'issue_date' => to_sql_date($data['issue_date']),
			'exipiry_date' => to_sql_date($data['exipiry_date']),
			'issue_authority' => $data['issue_authority'],
			'remark' => $data['remark'],
		];

		if (!empty($data['attach_file'])) {
			$updated['attach_file'] = $data['attach_file'];
		}

		$this->db->where('id !=', $id);
		$this->db->where('candidate', $data['add_passport_candidate_id']);
		$this->db->where('document_type_password', $data['document_type_password']);
		$existing_record = $this->db->get(db_prefix() . 'rec_passport')->row_array();

		if ($existing_record) {
			return false;
		}

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_passport', $updated);

		return $success;
	}

	public function add_update_travel_info_cadidate($data)
	{
		$candidate_id = $data['add_travel_candidate_id'];
		$id = $data['travel_id'];

		$hideexpired = 0;
		if ($data['hideexpire'] == 'on') {
			$hideexpired = 1;
		}

		if (!empty($data['attach_file'])) {
			$updated['document_type'] = $data['document_type'];
			// $updated['request_renew'] =  $data['request_renew'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['remark'] = $data['remark'];
			$updated['hideexpire'] = $hideexpired;
			$updated['attach_file'] = $data['attach_file'];
		} else {
			$updated['document_type'] = $data['document_type'];
			// $updated['request_renew'] =  $data['request_renew'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['hideexpire'] = $hideexpired;
			$updated['remark'] = $data['remark'];
		}
		unset($data);
		if ($id != '') {
			$this->db->where('id', $id);
			$success = $this->db->update(db_prefix() . 'rec_travel_identification', $updated);
		} else {
			$this->db->insert(db_prefix() . 'rec_travel_identification', [
				'candidate' => $candidate_id,
				'document_type' => $updated['document_type'],
				// 'request_renew' => $updated['request_renew'],
				'licence_no' => $updated['licence_no'],
				'acquisition_date' => to_sql_date($updated['acquisition_date']),
				'expiry_date' => to_sql_date($updated['expiry_date']),
				'issue_authority' => $updated['issue_authority'],
				'attach_file' => isset($updated['attach_file']) ? $updated['attach_file'] : '',
				'renew_request_status_update' => $updated['renew_request_status_update'],
				'remark' => $updated['remark'],
			]);
		}
		if (!$success) {
			return true;
		}
		return true;
	}


	public function add_update_other_licence_detail_candidate($data)
	{
		$candidate_id = $data['add_other_licence_candidate_id'];
		$id = $data['other_licence_id'];

		$hideexpired = 0;
		if ($data['hideexpire'] == 'on') {
			$hideexpired = 1;
		}

		if (!empty($data['attach_file'])) {

			$updated['document_type'] = $data['document_type'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['remark'] = $data['remark'];
			$updated['hideexpire'] = $hideexpired;
			$updated['attach_file'] = $data['attach_file'];
		} else {
			$updated['document_type'] = $data['document_type'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['hideexpire'] = $hideexpired;
			$updated['remark'] = $data['remark'];
		}
		unset($data);
		if ($id != '') {
			$this->db->where('id', $id);
			$success = $this->db->update(db_prefix() . 'rec_other_licence_identification', $updated);
		} else {
			$this->db->insert(db_prefix() . 'rec_other_licence_identification', [
				'candidate' => $candidate_id,
				'document_type' => $updated['document_type'],
				'licence_no' => $updated['licence_no'],
				'acquisition_date' => to_sql_date($updated['acquisition_date']),
				'expiry_date' => to_sql_date($updated['expiry_date']),
				'issue_authority' => $updated['issue_authority'],
				'attach_file' => isset($updated['attach_file']) ? $updated['attach_file'] : '',
				'renew_request_status_update' => $updated['renew_request_status_update'],
				'remark' => $updated['remark'],
			]);
		}
		if (!$success) {
			return true;
		}
		return true;
	}


	public function add_update_licence_3_detail_candidate($data)
	{
		$candidate_id = $data['add_licence_3_candidate_id'];
		$id = $data['licence_3_id'];

		$hideexpired = 0;
		if ($data['hideexpire'] == 'on') {
			$hideexpired = 1;
		}

		if (!empty($data['attach_file'])) {
			$updated['document_type'] = $data['document_type'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['remark'] = $data['remark'];
			$updated['hideexpire'] = $hideexpired;
			$updated['attach_file'] = $data['attach_file'];
		} else {
			$updated['document_type'] = $data['document_type'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['hideexpire'] = $hideexpired;
			$updated['remark'] = $data['remark'];
		}
		unset($data);
		if ($id != '') {
			$this->db->where('id', $id);
			$success = $this->db->update(db_prefix() . 'rec_licence_3', $updated);
		} else {
			$this->db->insert(db_prefix() . 'rec_licence_3', [
				'candidate' => $candidate_id,
				'document_type' => $updated['document_type'],
				'licence_no' => $updated['licence_no'],
				'acquisition_date' => to_sql_date($updated['acquisition_date']),
				'expiry_date' => to_sql_date($updated['expiry_date']),
				'issue_authority' => $updated['issue_authority'],
				'attach_file' => isset($updated['attach_file']) ? $updated['attach_file'] : '',
				'renew_request_status_update' => $updated['renew_request_status_update'],
				'remark' => $updated['remark'],
			]);
		}
		if (!$success) {
			return true;
		}
		return true;
	}

	public function add_update_licence_4_detail_candidate($data)
	{
		$candidate_id = $data['add_licence_4_candidate_id'];
		$id = $data['licence_4_id'];

		$hideexpired = 0;
		if ($data['hideexpire'] == 'on') {
			$hideexpired = 1;
		}

		if (!empty($data['attach_file'])) {
			$updated['document_type'] = $data['document_type'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['remark'] = $data['remark'];
			$updated['hideexpire'] = $hideexpired;
			$updated['attach_file'] = $data['attach_file'];
		} else {
			$updated['document_type'] = $data['document_type'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['hideexpire'] = $hideexpired;
			$updated['remark'] = $data['remark'];
		}
		unset($data);
		if ($id != '') {
			$this->db->where('id', $id);
			$success = $this->db->update(db_prefix() . 'rec_licence_4', $updated);
		} else {
			$this->db->insert(db_prefix() . 'rec_licence_4', [
				'candidate' => $candidate_id,
				'document_type' => $updated['document_type'],
				'licence_no' => $updated['licence_no'],
				'acquisition_date' => to_sql_date($updated['acquisition_date']),
				'expiry_date' => to_sql_date($updated['expiry_date']),
				'issue_authority' => $updated['issue_authority'],
				'attach_file' => isset($updated['attach_file']) ? $updated['attach_file'] : '',
				'renew_request_status_update' => $updated['renew_request_status_update'],
				'remark' => $updated['remark'],
			]);
		}
		if (!$success) {
			return true;
		}
		return true;
	}

	public function add_update_licence_5_detail_candidate($data)
	{
		$candidate_id = $data['add_licence_5_candidate_id'];
		$id = $data['licence_5_id'];

		$hideexpired = 0;
		if ($data['hideexpire'] == 'on') {
			$hideexpired = 1;
		}

		if (!empty($data['attach_file'])) {
			$updated['document_type'] = $data['document_type'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['remark'] = $data['remark'];
			$updated['hideexpire'] = $hideexpired;
			$updated['attach_file'] = $data['attach_file'];
		} else {
			$updated['document_type'] = $data['document_type'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['hideexpire'] = $hideexpired;
			$updated['remark'] = $data['remark'];
		}
		unset($data);
		if ($id != '') {
			$this->db->where('id', $id);
			$success = $this->db->update(db_prefix() . 'rec_licence_5', $updated);
		} else {
			$this->db->insert(db_prefix() . 'rec_licence_5', [
				'candidate' => $candidate_id,
				'document_type' => $updated['document_type'],
				'licence_no' => $updated['licence_no'],
				'acquisition_date' => to_sql_date($updated['acquisition_date']),
				'expiry_date' => to_sql_date($updated['expiry_date']),
				'issue_authority' => $updated['issue_authority'],
				'attach_file' => isset($updated['attach_file']) ? $updated['attach_file'] : '',
				'renew_request_status_update' => $updated['renew_request_status_update'],
				'remark' => $updated['remark'],
			]);
		}
		if (!$success) {
			return true;
		}
		return true;
	}

	public function add_update_licence_6_detail_candidate($data)
	{
		$candidate_id = $data['add_licence_6_candidate_id'];
		$id = $data['licence_6_id'];

		$hideexpired = 0;
		if ($data['hideexpire'] == 'on') {
			$hideexpired = 1;
		}

		if (!empty($data['attach_file'])) {
			$updated['document_type'] = $data['document_type'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['remark'] = $data['remark'];
			$updated['hideexpire'] = $hideexpired;
			$updated['attach_file'] = $data['attach_file'];
		} else {
			$updated['document_type'] = $data['document_type'];
			$updated['renew_request_status_update'] = $data['renew_request_status_update'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['hideexpire'] = $hideexpired;
			$updated['remark'] = $data['remark'];
		}
		unset($data);
		if ($id != '') {
			$this->db->where('id', $id);
			$success = $this->db->update(db_prefix() . 'rec_licence_6', $updated);
		} else {
			$this->db->insert(db_prefix() . 'rec_licence_6', [
				'candidate' => $candidate_id,
				'document_type' => $updated['document_type'],
				'licence_no' => $updated['licence_no'],
				'acquisition_date' => to_sql_date($updated['acquisition_date']),
				'expiry_date' => to_sql_date($updated['expiry_date']),
				'issue_authority' => $updated['issue_authority'],
				'attach_file' => isset($updated['attach_file']) ? $updated['attach_file'] : '',
				'renew_request_status_update' => $updated['renew_request_status_update'],
				'remark' => $updated['remark'],
			]);
		}
		if (!$success) {
			return true;
		}
		return true;
	}

	public function update_renew_request($data)
	{
		$id = $data['travel_id'];
		$updated['renew_request_status_update'] = $data['renew_request_status_update_modal'];
		$updated['request_renew'] = $data['template_for'];

		if ($id != '') {
			$this->db->where('id', $id);
			$success = $this->db->update(db_prefix() . 'rec_travel_identification', $updated);
		}
		if (!$success) {
			return true;
		}
		return true;
	}

	public function add_update_contract_info_cadidate($data)
	{
		$candidate_id = $data['add_contract_candidate_id'];
		$id = $data['contract_id'];

		if (!empty($data['attach_file'])) {
			$updated['document_type'] = $data['document_type'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['remark'] = $data['remark'];
			$updated['attach_file'] = $data['attach_file'];
		} else {
			$updated['document_type'] = $data['document_type'];
			$updated['licence_no'] = $data['licence_no'];
			$updated['acquisition_date'] = to_sql_date($data['acquisition_date']);
			$updated['expiry_date'] = to_sql_date($data['expiry_date']);
			$updated['issue_authority'] = $data['issue_authority'];
			$updated['remark'] = $data['remark'];
			$updated['attach_file'] = $data['attach_file'];
		}
		unset($data);
		if ($id != '') {
			$this->db->where('id', $id);
			$success = $this->db->update(db_prefix() . 'rec_employee_contract', $updated);
		} else {
			$this->db->insert(db_prefix() . 'rec_employee_contract', [
				'candidate' => $candidate_id,
				'document_type' => $updated['document_type'],
				'licence_no' => $updated['licence_no'],
				'acquisition_date' => to_sql_date($updated['acquisition_date']),
				'expiry_date' => to_sql_date($updated['expiry_date']),
				'issue_authority' => $updated['issue_authority'],
				'attach_file' => $updated['attach_file'],
				'remark' => $updated['remark'],
			]);
		}
		if (!$success) {
			return true;
		}
		return true;
	}

	/**
	 * update document info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_document_info_cadidate($data)
	{
		$id = $data['document_id'];

		if (!empty($data['doc_attach_file'])) {
			$updated['kind_division'] = implode('', $data['doc_kind_division']);
			$updated['licence_no'] = $data['doc_licence_no'];
			$updated['issue_date'] = to_sql_date($data['doc_issue_date']);
			$updated['exipiry_date'] = to_sql_date($data['doc_exipiry_date']);
			$updated['issue'] = $data['doc_issue_authority'];
			$updated['remark'] = $data['doc_remark'];
			$updated['attach_file'] = $data['doc_attach_file'];
		} else {
			$updated['kind_division'] = implode('', $data['doc_kind_division']);
			$updated['licence_no'] = $data['doc_licence_no'];
			$updated['issue_date'] = to_sql_date($data['doc_issue_date']);
			$updated['exipiry_date'] = to_sql_date($data['doc_exipiry_date']);
			$updated['issue'] = $data['doc_issue_authority'];
			$updated['remark'] = $data['doc_remark'];
		}
		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_document', $updated);

		if (!$success) {
			return true;
		}

		return true;
	}

	/**
	 * update Flag info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_flag_info_cadidate($data)
	{
		$id = $data['flag_id'];

		if (!empty($data['flag_attach_file'])) {
			$updated['kind_division'] = implode('', $data['flag_kind_division']);
			$updated['licence_no'] = $data['flag_licence_no'];
			$updated['issue_date'] = to_sql_date($data['flag_issue_date']);
			$updated['exipiry_date'] = to_sql_date($data['flag_exipiry_date']);
			$updated['issue'] = $data['flag_issue_authority'];
			$updated['remark'] = $data['flag_remark'];
			$updated['attach_file'] = $data['flag_attach_file'];
		} else {
			$updated['kind_division'] = implode('', $data['flag_kind_division']);
			$updated['licence_no'] = $data['flag_licence_no'];
			$updated['issue_date'] = to_sql_date($data['flag_issue_date']);
			$updated['exipiry_date'] = to_sql_date($data['flag_exipiry_date']);
			$updated['issue'] = $data['flag_issue_authority'];
			$updated['remark'] = $data['flag_remark'];
		}
		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_flag', $updated);

		if (!$success) {
			return true;
		}

		return true;
	}

	/**
	 * update Medical info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_medical_info_cadidate($data)
	{
		$id = $data['medical_id'];
		$updated['medical_test_date'] = to_sql_date($data['medical_test_date']);
		$updated['valid_test_date'] = to_sql_date($data['valid_test_date']);
		$updated['medical_test_division'] = $data['medical_test_division'];
		$updated['judgement_y_n'] = $data['judgement_y_n'];
		$updated['medical_hospital'] = $data['medical_hospital'];
		$updated['judgement'] = $data['judgement'];
		$updated['final_option'] = $data['final_option'];
		$updated['medical_remark'] = $data['medical_remark'];

		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_medical', $updated);

		if (!$success) {
			return true;
		}
		return true;
	}

	/**
	 * update promotion info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_promotion_info_cadidate($data)
	{
		$id = $data['promotion_id'];
		$updated['app_date'] = to_sql_date($data['promotion_app_date']);
		$updated['final_grade'] = $data['final_grade'];
		$updated['promotion_grade'] = $data['promotion_grade'];
		$updated['final_depart'] = $data['final_depart'];
		$updated['length_of_stay'] = $data['length_of_stay'];

		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_promotion', $updated);

		if (!$success) {
			return true;
		}

		return true;
	}

	/**
	 * update PSI info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_psi_info_cadidate($data)
	{
		$id = $data['psc_id'];
		$updated['date'] = to_sql_date($data['psc_date']);
		$updated['vessel'] = $data['vessel'];
		$updated['inspection'] = $data['inspection'];
		$updated['mou'] = $data['mou'];
		$updated['country'] = $data['country'];
		$updated['port'] = $data['port'];
		$updated['result'] = $data['result'];
		$updated['deficiency'] = $data['deficiency'];
		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_psc', $updated);

		if (!$success) {
			return true;
		}

		return true;
	}

	/**
	 * add medical_info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function add_medical_info_cadidate($data)
	{
		$candidateid = $data['add_medical_candidate_id'];
		if ($candidateid != '') {

			$this->db->insert(db_prefix() . 'rec_medical', [
				'candidate' => $candidateid,
				'medical_test_date' => to_sql_date($data['medical_test_date']),
				'valid_test_date' => to_sql_date($data['valid_test_date']),
				'medical_test_division' => $data['medical_test_division'],
				'judgement_y_n' => $data['judgement_y_n'],
				'medical_hospital' => $data['medical_hospital'],
				'judgement' => $data['judgement'],
				'final_option' => $data['final_option'],
				'medical_remark' => $data['medical_remark'],
			]);
			return true;
		}
		return false;
	}

	/**
	 * add promotion_info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function add_promotion_info_cadidate($data)
	{
		$candidateid = $data['add_promotion_candidate_id'];
		if ($candidateid != '') {
			$this->db->insert(db_prefix() . 'rec_promotion', [
				'candidate' => $candidateid,
				'app_date' => to_sql_date($data['promotion_app_date']),
				'final_grade' => $data['final_grade'],
				'promotion_grade' => $data['promotion_grade'],
				'final_depart' => $data['final_depart'],
				'length_of_stay' => $data['length_of_stay'],
			]);
			return true;
		}
		return false;
	}

	/**
	 * add psc_info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function add_psi_info_cadidate($data)
	{
		$candidateid = $data['add_psc_candidate_id'];
		if ($candidateid != '') {

			$this->db->insert(db_prefix() . 'rec_psc', [
				'candidate' => $candidateid,
				'date' => to_sql_date($data['psc_date']),
				'vessel' => $data['vessel'],
				'inspection' => $data['inspection'],
				'mou' => $data['mou'],
				'country' => $data['country'],
				'port' => $data['port'],
				'result' => $data['result'],
				'deficiency' => $data['deficiency'],
			]);
			return true;
		}
		return false;
	}

	/**
	 * update personal_info
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_personal_info($data, $id)
	{
		$updated['hobby'] = $data['hobby'];
		$updated['working_clothes'] = $data['working_clothes'];
		// $updated['disability'] = $data['disability'];
		// $updated['disability_rating'] = $data['disability_rating'];
		// $updated['disability_rating_date'] = to_sql_date($data['disability_rating_date']);
		$updated['personal_info_region'] = $data['personal_info_region'];
		$updated['personal_info_province'] = $data['personal_info_province'];
		$updated['personal_info_municipality'] = $data['personal_info_municipality'];

		$updated['safety_shoes'] = $data['safety_shoes'];
		$updated['religion'] = $data['religion'];
		$updated['wedding'] = $data['wedding'];
		$updated['veterna_division'] = $data['veterna_division'];
		$updated['veterna_no'] = $data['veterna_no'];
		$updated['veterna_relationships'] = $data['veterna_relationships'];
		$updated['native_religion'] = $data['native_religion'];
		$updated['present_resident_kor'] = $data['present_resident_kor'];
		$updated['present_resident_eng'] = $data['present_resident_eng'];
		$updated['email'] = $data['email'];
		$updated['home_contact_number'] = $data['home_contact_number'];
		$updated['phonenumber'] = $data['phonenumber'];
		$updated['emergency_contact_number'] = $data['emergency_contact_number'];

		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_candidate', $updated);

		if (!$success) {
			return true;
		}

		return true;
	}


	public function update_emergency_info($data, $id)
	{

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_candidate', $data);

		if (!$success) {
			return true;
		}

		return true;
	}

	/**
	 * Delete Family info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_family_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_family');

		if (!$delete) {
			return false;
		}
		return true;
	}

	/**
	 * Delete Education info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_education_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_education');

		if (!$delete) {
			return false;
		}
		return true;
	}

	/**
	 * update School info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_school_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_school');

		if (!$delete) {
			return false;
		}
		return true;
	}

	/**
	 * Delete Reward info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_reward_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_reward');

		if (!$delete) {
			return false;
		}
		return true;
	}

	public function delete_rec_travel_info($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_travel_identification');

		if (!$delete) {
			return false;
		}
		return true;
	}

	public function delete_license_2_info($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_other_licence_identification');

		if (!$delete) {
			return false;
		}
		return true;
	}

	public function delete_license_3_info($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_licence_3');

		if (!$delete) {
			return false;
		}
		return true;
	}

	public function delete_license_4_info($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_licence_4');

		if (!$delete) {
			return false;
		}
		return true;
	}

	public function delete_license_5_info($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_licence_5');

		if (!$delete) {
			return false;
		}
		return true;
	}

	public function delete_license_6_info($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_licence_6');

		if (!$delete) {
			return false;
		}
		return true;
	}

	/**
	 * Delete Licence info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_licence_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_licence');

		if (!$delete) {
			return false;
		}
		return true;
	}

	public function delete_passport_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_passport');

		if (!$delete) {
			return false;
		}
		return true;
	}

	/**
	 * Delete document info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_document_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_document');

		if (!$delete) {
			return false;
		}
		return true;
	}

	public function delete_attach_file($id)
	{
		$this->db->set('attach_file', NULL);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_travel_identification');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_licence3_file($id)
	{
		$this->db->set('attach_file', NULL);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_licence_3');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_licence4_file($id)
	{
		$this->db->set('attach_file', NULL);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_licence_4');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_licence5_file($id)
	{
		$this->db->set('attach_file', NULL);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_licence_5');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_licence6_file($id)
	{
		$this->db->set('attach_file', NULL);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_licence_6');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}



	public function delete_other_licence_file($id)
	{
		$this->db->set('attach_file', NULL);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_other_licence_identification');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Delete flag info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_flag_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_flag');

		if (!$delete) {
			return false;
		}
		return true;
	}

	/**
	 * Delete Medical info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_medical_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_medical');

		if (!$delete) {
			return false;
		}
		return true;
	}

	/**
	 * Delete Promotion info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_promotion_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_promotion');

		if (!$delete) {
			return false;
		}
		return true;
	}

	/**
	 * Delete PSI info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_psi_candidate($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_psc');

		if (!$delete) {
			return false;
		}
		return true;
	}

	/**
	 * update Family info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function update_family_info_cadidate($data, $id)
	{

		$updated['family_religion'] = $data['edit_family_religion'];
		$updated['family_name'] = $data['edit_family_name'];
		$updated['candidate'] = $data['family_candidate_id'];
		$updated['id_no'] = $data['edit_family_id_no'];
		$updated['birthday'] = to_sql_date($data['edit_family_birthday']);
		$updated['age'] = $data['edit_family_age'];
		$updated['final_academy_career'] = $data['edit_family_final_academy_career'];
		$updated['school'] = $data['edit_family_school'];
		$updated['major'] = $data['edit_family_major'];
		$updated['position'] = $data['edit_family_position'];
		$updated['grade'] = $data['edit_family_grade'];
		$updated['basic_deduction'] = $data['edit_family_basic_deduction'];
		$updated['child_bearing'] = $data['edit_family_child_bearing'];
		$updated['contact_number'] = $data['edit_family_contact_number'];
		$updated['contact_number2'] = $data['edit_family_contact_number2'];

		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_family', $updated);

		return true;
	}

	/**
	 * update Education info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function update_education_info_cadidate($data, $id)
	{
		$updated['year'] = $data['edit_education_year'];
		$updated['course_type'] = implode('', $data['course_type']);
		$updated['course_name'] = $data['edit_course_name'];
		$updated['edu_start_date'] = to_sql_date($data['edit_edu_start_date']);
		$updated['edu_finish_date'] = to_sql_date($data['edit_edu_finish_date']);
		$updated['edu_date'] = $data['edit_edu_date'];
		// $updated['valid_date'] = to_sql_date($data['edit_valid_date']);
		$updated['edu_institution'] = $data['edit_edu_institution'];
		$updated['completed_edu'] = $data['edit_completed_edu'];
		unset($data);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_education', $updated);
		return true;
	}

	public function update_school_info_cadidate($data, $id)
	{
		$updated['enterance_date'] = to_sql_date($data['edit_enterance_date']);
		$updated['graduation_date'] = to_sql_date($data['edit_graduation_date']);
		$updated['university'] = $data['edit_university'];
		$updated['school_name'] = $data['edit_school_name'];
		$updated['faculty'] = $data['edit_faculty'];
		$updated['major_name'] = $data['edit_major_name'];
		$updated['year_of_graduation'] = $data['edit_year_of_graduation'];
		$updated['final_academic_career'] = $data['edit_final_academic_career'];
		$updated['academic_career_type'] = $data['edit_academic_career_type'];
		$updated['remark'] = $data['edit_remark'];
		unset($data);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_school', $updated);
		return true;
	}

	/**
	 * Add Family info cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function add_family_info_cadidate($data)
	{

		$candidateid = $data['add_family_candidate_id'];
		if ($candidateid != '') {
			$this->db->insert(db_prefix() . 'rec_family', [
				'candidate' => $candidateid,
				'family_religion' => $data['edit_family_religion'],
				'family_name' => $data['edit_family_name'],
				'id_no' => $data['edit_family_id_no'],
				'birthday' => to_sql_date($data['edit_family_birthday']),
				'age' => $data['edit_family_age'],
				'final_academy_career' => $data['edit_family_final_academy_career'],
				'school' => $data['edit_family_school'],
				'major' => $data['edit_family_major'],
				'company' => $data['edit_family_position'],
				'position' => $data['edit_family_position'],
				// 'grade' => $data['edit_family_basic_deduction'],
				// 'basic_deduction' => $data['edit_family_basic_deduction'],
				// 'child_bearing' => $data['edit_family_child_bearing'],
				'contact_number' => $data['edit_family_contact_number'],
				'contact_number2' => $data['edit_family_contact_number2'],

			]);
			return true;
		}
		return false;
	}

	public function add_reward_info_cadidate($data)
	{
		$candidateid = $data['add_reward_candidate_id'];
		if ($candidateid != '') {
			$this->db->insert(db_prefix() . 'rec_reward', [
				'candidate' => $candidateid,
				'app_date' => to_sql_date($data['app_date']),
				'award_punishment' => $data['award_punishment'],
				'grade_rank' => $data['grade_rank'],
				'reward_file' => $data['reward_file'],
				'award_punishment_kind' => $data['award_punishment_kind'],
				'award_punishment_reason' => $data['award_punishment_reason'],
				'rewards_remark' => $data['rewards_remark'],
			]);
			return true;
		}
		return false;
	}

	public function add_licence_info_cadidate($data)
	{
		$candidateid = $data['add_licence_candidate_id'];
		$lic_kind_division = implode('', $data['lic_kind_division']);
		$lic_exipiry_date = to_sql_date($data['lic_exipiry_date']) != "" ?  $data['lic_exipiry_date']  : null;
		if ($candidateid != '') {
			$this->db->insert(db_prefix() . 'rec_licence', [
				'candidate' => $candidateid,
				'acquisition_date' => to_sql_date($data['lic_acquisition_date']),
				'kind_division' => $lic_kind_division,
				'licence_no' => $data['lic_licence_no'],
				'exipiry_date' => $lic_exipiry_date,
				'issue_authority' => $data['lic_issue_authority'],
				'attach_file' => $data['licence_attach_file'],
				'remark' => $data['licence_remark'],
			]);
			return true;
		}
		return false;
	}

	public function add_passport_info_candidate($data)
	{
		$candidateid = $data['add_passport_candidate_id'];
		$expiry_date = to_sql_date($data['exipiry_date']) != "" ? to_sql_date($data['exipiry_date']) : null;

		if ($candidateid != '') {
			$this->db->where('candidate', $candidateid);
			$this->db->where('document_type_password', $data['document_type_password']);
			$existing_record = $this->db->get(db_prefix() . 'rec_passport')->row_array();

			if (!$existing_record) {
				$this->db->insert(db_prefix() . 'rec_passport', [
					'candidate' => $candidateid,
					'document_type_password' => $data['document_type_password'],
					'passport_no' => $data['passport_no'],
					'acquisition_date' => to_sql_date($data['acquisition_date']),
					'issue_date' => to_sql_date($data['issue_date']),
					'exipiry_date' => $expiry_date,
					'issue_authority' => $data['issue_authority'],
					'attach_file' => $data['attach_file'],
					'expiration_date_passport' => $data['expiration_date_passport'],
					'remark' => $data['remark'],
				]);
				return true; // Indicate success
			} else {
				return false; // Document type password exists
			}
		}
		return false; // Candidate ID is empty
	}


	public function add_document_info_cadidate($data)
	{
		$candidateid = $data['add_document_candidate_id'];
		$doc_kind_division = implode('', $data['doc_kind_division']);
		$doc_exipiry_date = to_sql_date($data['doc_exipiry_date']) != "" ?  $data['doc_exipiry_date']  : null;
		if ($candidateid != '') {
			$this->db->insert(db_prefix() . 'rec_document', [
				'candidate' => $candidateid,
				'kind_division' => $doc_kind_division,
				'licence_no' => $data['doc_licence_no'],
				'issue_date' => to_sql_date($data['doc_issue_date']),
				'exipiry_date' => $doc_exipiry_date,
				'issue' => $data['doc_issue_authority'],
				'attach_file' => $data['doc_attach_file'],
				'remark' => $data['doc_remark'],
			]);
			return true;
		}
		return false;
	}

	public function add_flag_info_cadidate($data)
	{
		$candidateid = $data['add_flag_candidate_id'];
		$flag_kind_division = implode('', $data['flag_kind_division']);
		$flag_exipiry_date = to_sql_date($data['flag_exipiry_date']) != "" ?  $data['flag_exipiry_date']  : null;
		if ($candidateid != '') {
			$this->db->insert(db_prefix() . 'rec_flag', [
				'candidate' => $candidateid,
				'kind_division' => $flag_kind_division,
				'licence_no' => $data['flag_licence_no'],
				'issue_date' => to_sql_date($data['flag_issue_date']),
				'exipiry_date' => $flag_exipiry_date,
				'issue' => $data['flag_issue_authority'],
				'attach_file' => $data['flag_attach_file'],
				'remark' => $data['flag_remark'],
			]);
			return true;
		}
		return false;
	}

	public function add_education_info_cadidate($data)
	{
		$candidateid = $data['add_education_candidate_id'];
		$course_type = implode('', $data['course_type']);
		if ($candidateid != '') {
			$this->db->insert(db_prefix() . 'rec_education', [
				'candidate' => $candidateid,
				'year' => $data['education_year'],
				'course_type' => $course_type,
				'course_name' => $data['course_name'],
				'edu_start_date' => to_sql_date($data['edu_start_date']),
				'edu_finish_date' => to_sql_date($data['edu_finish_date']),
				'edu_date' => $data['edu_date'],
				// 'valid_date' => to_sql_date($data['valid_date']),
				'edu_institution' => $data['edu_institution'],
				'completed_edu' => $data['completed_edu'],
			]);
			return true;
		}
		return false;
	}

	public function add_school_info_cadidate($data)
	{
		$candidateid = $data['add_school_candidate_id'];
		if ($candidateid != '') {
			$this->db->insert(db_prefix() . 'rec_school', [
				'candidate' => $candidateid,
				'enterance_date' => to_sql_date($data['enterance_date']),
				'graduation_date' => to_sql_date($data['graduation_date']),
				'university' => $data['university'],
				'school_name' => $data['school_name'],
				// 'faculty' => $data['faculty'],
				'major_name' => $data['major_name'],
				'year_of_graduation' => $data['year_of_graduation'],
				// 'final_academic_career' => $data['final_academic_career'],
				'academic_career_type' => $data['academic_career_type'],
				'remark' => $data['remark'],
			]);
			return true;
		}
		return false;
	}

	/**
	 * update cadidate
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_cadidate($data, $id, $file = "")
	{

		if (!$this->check_format_date($data['birthday'])) {
			$data['birthday'] = to_sql_date($data['birthday']);
		}

		if (isset($data['from_date'])) {
			$from_date = $data['from_date'];
			unset($data['from_date']);
		}

		if (isset($data['to_date'])) {
			$to_date = $data['to_date'];
			unset($data['to_date']);
		}

		if (isset($data['company'])) {
			$company = $data['company'];
			unset($data['company']);
		}

		if (isset($data['position'])) {
			$position = $data['position'];
			unset($data['position']);
		}

		if (isset($data['contact_person'])) {
			$contact_person = $data['contact_person'];
			unset($data['contact_person']);
		}

		if (isset($data['salary'])) {
			$salary = $data['salary'];
			unset($data['salary']);
		}

		if (isset($data['reason_quitwork'])) {
			$reason_quitwork = $data['reason_quitwork'];
			unset($data['reason_quitwork']);
		}

		if (isset($data['job_description'])) {
			$job_description = $data['job_description'];
			unset($data['job_description']);
		}

		if (isset($data['literacy_from_date'])) {
			$literacy_from_date = $data['literacy_from_date'];
			unset($data['literacy_from_date']);
		}

		if (isset($data['literacy_to_date'])) {
			$literacy_to_date = $data['literacy_to_date'];
			unset($data['literacy_to_date']);
		}

		if (isset($data['diploma'])) {
			$diploma = $data['diploma'];
			unset($data['diploma']);
		}

		if (isset($data['training_places'])) {
			$training_places = $data['training_places'];
			unset($data['training_places']);
		}

		if (isset($data['specialized'])) {
			$specialized = $data['specialized'];
			unset($data['specialized']);
		}

		if (isset($data['training_form'])) {
			$training_form = $data['training_form'];
			unset($data['training_form']);
		}

		if (isset($data['relationship'])) {
			$relationship = $data['relationship'];
			unset($data['relationship']);
		}

		if (isset($data['name'])) {
			$name = $data['name'];
			unset($data['name']);
		}

		if (isset($data['fi_birthday'])) {
			$fi_birthday = $data['fi_birthday'];
			unset($data['fi_birthday']);
		}

		if (isset($data['job'])) {
			$job = $data['job'];
			unset($data['job']);
		}

		if (isset($data['address'])) {
			$address = $data['address'];
			unset($data['address']);
		}

		if (isset($data['phone'])) {
			$phone = $data['phone'];
			unset($data['phone']);
		}

		if (isset($data['rank'])) {
			$data['rank'] = implode(',', $data['rank']);
		}



		if (isset($data['status_type'])) {
			$data['status_type'] = implode(',', $data['status_type']);
		}

		if (isset($data['hired_date'])) {
			$data['hired_date'] = to_sql_date($data['hired_date']);
		}

		if (isset($data['promotion'])) {
			$data['promotion'] = to_sql_date($data['promotion']);
		}

		if (isset($data['department_date'])) {
			$data['department_date'] = to_sql_date($data['department_date']);
		}

		if (isset($data['disability_rating_date'])) {
			$data['disability_rating_date'] = to_sql_date($data['disability_rating_date']);
		}

		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_candidate', $data);

		$this->db->where('candidate', $id);
		$this->db->delete('cd_work_experience');
		foreach ($from_date as $key => $val) {
			if ($from_date[$key] != '') {

				if (!$this->check_format_date($val)) {
					$val = to_sql_date($val);
				}
				if (!$this->check_format_date($to_date[$key])) {
					$to_date[$key] = to_sql_date($to_date[$key]);
				}

				$this->db->insert(db_prefix() . 'cd_work_experience', [
					'candidate' => $id,
					'from_date' => $val,
					'to_date' => $to_date[$key],
					'company' => $company[$key],
					'position' => $position[$key],
					'contact_person' => $contact_person[$key],
					'salary' => $salary[$key],
					'reason_quitwork' => $reason_quitwork[$key],
					'job_description' => $job_description[$key],
				]);
			}
		}

		$this->db->where('candidate', $id);
		$this->db->delete('cd_literacy');
		foreach ($literacy_from_date as $key => $val) {
			if ($literacy_from_date[$key] != '') {

				if (!$this->check_format_date($val)) {
					$val = to_sql_date($val);
				}

				if (!$this->check_format_date($literacy_to_date[$key])) {
					$literacy_to_date[$key] = to_sql_date($literacy_to_date[$key]);
				}

				$this->db->insert(db_prefix() . 'cd_literacy', [
					'candidate' => $id,
					'literacy_from_date' => $val,
					'literacy_to_date' => $literacy_to_date[$key],
					'diploma' => $diploma[$key],
					'training_places' => $training_places[$key],
					'specialized' => $specialized[$key],
					'training_form' => $training_form[$key],
				]);
			}
		}

		$this->db->where('candidate', $id);
		$this->db->delete('cd_family_infor');
		foreach ($relationship as $key => $val) {
			if ($relationship[$key] != '') {

				if (!$this->check_format_date($fi_birthday[$key])) {
					$fi_birthday[$key] = to_sql_date($fi_birthday[$key]);
				}

				$this->db->insert(db_prefix() . 'cd_family_infor', [
					'candidate' => $id,
					'relationship' => $val,
					'name' => $name[$key],
					'fi_birthday' => $fi_birthday[$key],
					'job' => $job[$key],
					'address' => $address[$key],
					'phone' => $phone[$key],
				]);
			}
		}

		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_cadidate_avar');
		$avar = $this->db->get(db_prefix() . 'files')->row();

		if ($avar && (isset($_FILES['cd_avar']['name']) && $_FILES['cd_avar']['name'] != '')) {
			if (empty($avar->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $avar->rel_id . '/' . $avar->file_name);
			}
			$this->db->where('id', $avar->id);
			$this->db->delete('tblfiles');

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/' . $avar->rel_id)) {
				// Check if no avars left, so we can delete the folder also
				$other_avars = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/' . $avar->rel_id);
				if (count($other_avars) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/' . $avar->rel_id);
				}
			}
		}

		return true;
	}

	/**
	 * add interview schedules
	 * @param object $data
	 */
	public function add_interview_schedules($data)
	{

		$data['interview_day'] = $data['interview_day'];

		if (!$this->check_format_date($data['interview_day'])) {
			$data['interview_day'] = to_sql_date($data['interview_day']);
		}

		$data['interviewer'] = implode(',', $data['interviewer']);
		$data['added_from'] = get_staff_user_id();
		$data['added_date'] = date('Y-m-d');

		$data['from_hours'] = ($data['interview_day'] . ' ' . $data['from_time'] . ':00');
		$data['to_hours'] = $data['interview_day'] . ' ' . $data['to_time'] . ':00';

		if (!$this->check_format_date($data['interview_day'])) {
			$data['from_hours'] = to_sql_date($data['interview_day']) . ' ' . $data['from_time'] . ':00';
		}

		if (!$this->check_format_date($data['interview_day'])) {
			$data['to_hours'] = to_sql_date($data['interview_day']) . ' ' . $data['to_time'] . ':00';
		}

		if (isset($data['candidate'])) {
			$candidate = $data['candidate'];
			unset($data['candidate']);
		}

		$this->db->insert(db_prefix() . 'rec_interview', $data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			if (count($candidate) > 0) {
				foreach ($candidate as $can) {
					$this->db->insert(db_prefix() . 'cd_interview', [
						'candidate' => $can,
						'interview' => $insert_id,
					]);
				}
			}
			return $insert_id;
		}
	}

	/**
	 * update interview schedules
	 * @param  object $data
	 * @param  int $id
	 * @return bool
	 */
	public function update_interview_schedules($data, $id)
	{
		$data['interview_day'] = to_sql_date($data['interview_day']);
		$data['interviewer'] = implode(',', $data['interviewer']);
		$data['added_from'] = get_staff_user_id();
		$data['added_date'] = date('Y-m-d');

		$data['from_hours'] = ($data['interview_day'] . ' ' . $data['from_time'] . ':00');
		$data['to_hours'] = $data['interview_day'] . ' ' . $data['to_time'] . ':00';

		if (!$this->check_format_date($data['interview_day'])) {
			$data['from_hours'] = to_sql_date($data['interview_day']) . ' ' . $data['from_time'] . ':00';
		}

		if (!$this->check_format_date($data['interview_day'])) {
			$data['to_hours'] = to_sql_date($data['interview_day']) . ' ' . $data['to_time'] . ':00';
		}

		if (isset($data['candidate'])) {
			$candidate = $data['candidate'];
			unset($data['candidate']);
		}
		$this->db->where('interview', $id);
		$this->db->delete(db_prefix() . 'cd_interview');

		if (count($candidate) > 0) {
			foreach ($candidate as $can) {
				$this->db->insert(db_prefix() . 'cd_interview', [
					'candidate' => $can,
					'interview' => $id,
				]);
			}
		}

		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_interview', $data);

		return true;
	}

	/**
	 * delete candidate
	 * @param  int $id
	 * @return bool
	 */
	public function delete_candidate($id)
	{
		$reward_datas = $this->get_reward_by_candidate_id($id);
		$licence_datas = $this->get_licence_by_candidate_id($id);
		$document_datas = $this->get_document_by_candidate_id($id);

		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_cadidate_file');
		$attachments = $this->db->get('tblfiles')->result_array();
		foreach ($attachments as $attachment) {
			$this->delete_candidate_attachment($attachment['id']);
		}

		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_cadidate_avar');
		$avartar = $this->db->get('tblfiles')->result_array();
		foreach ($avartar as $avar) {
			$this->delete_candidate_avar_attachment($avar['id']);
		}

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'cd_interview');

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'cd_skill');

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'rec_family');

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'rec_candidate');

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'rec_education');

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'rec_school');

		$this->db->where('candidate', $id);
		$reward_deleted = $this->db->delete(db_prefix() . 'rec_reward');

		if ($reward_deleted) {
			$rewardfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/reward_file');
			foreach ($reward_datas as $data) {
				if (!empty($data)) {
					$targetDir = $rewardfileDir . $data['reward_file'];
					if (file_exists($targetDir)) {
						unlink($targetDir);
					}
				}
			}
		}

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'rec_medical');

		$this->db->where('candidate', $id);
		$licence_deleted = $this->db->delete(db_prefix() . 'rec_licence');

		if ($licence_deleted) {
			$licencefileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_file');
			foreach ($licence_datas as $data) {
				if (!empty($data)) {
					$targetDir = $licencefileDir . $data['attach_file'];
					if (file_exists($targetDir)) {
						unlink($targetDir);
					}
				}
			}
		}

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'rec_document');

		if ($document_datas) {
			$documentfileDir = module_dir_path(RECRUITMENT_MODULE_NAME . '/uploads/candidate/document_file');
			foreach ($document_datas as $data) {
				if (!empty($data)) {
					$targetDir = $documentfileDir . $data['attach_file'];
					if (file_exists($targetDir)) {
						unlink($targetDir);
					}
				}
			}
		}

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'rec_promotion');

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'rec_on_board_company');

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'rec_on_board_in_land');

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'rec_on_board_other_company');


		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'rec_psc');

		// if ($this->db->affected_rows() > 0) {
		// 	return true;
		// }
		return true;
	}

	/**
	 * delete candidate attachment
	 * @param  int $id
	 * @return bool
	 */
	public function delete_candidate_attachment($id)
	{
		$attachment = $this->get_candidate_attachments('', $id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/files/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/files/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/files/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/files/' . $attachment->rel_id);
				}
			}
		}
		return $deleted;
	}

	/**
	 * delete candidate avar attachment
	 * @param  int $id
	 * @return bool
	 */
	public function delete_candidate_avar_attachment($id)
	{
		$attachment = $this->get_candidate_avar_attachments('', $id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $attachment->rel_id);
				}
			}
		}
		return $deleted;
	}

	/**
	 * get candidate avar attachments
	 * @param  object $candidate
	 * @param  string $id
	 * @return object
	 */
	public function get_candidate_avar_attachments($candidate, $id = '')
	{
		// If is passed id get return only 1 attachment
		if (is_numeric($id)) {
			$this->db->where('id', $id);
		} else {
			$this->db->where('rel_id', $candidate);
		}
		$this->db->where('rel_type', 'rec_cadidate_avar');
		$result = $this->db->get('tblfiles');
		if (is_numeric($id)) {
			return $result->row();
		}

		return $result->result_array();
	}

	/**
	 * get candidate attachments
	 * @param  object $candidate
	 * @param  string $id
	 * @return object
	 */
	public function get_candidate_attachments($candidate, $id = '')
	{
		// If is passed id get return only 1 attachment
		if (is_numeric($id)) {
			$this->db->where('id', $id);
		} else {
			$this->db->where('rel_id', $candidate);
		}
		$this->db->where('rel_type', 'rec_cadidate_file');
		$result = $this->db->get('tblfiles');
		if (is_numeric($id)) {
			return $result->row();
		}
		return $result->result_array();
	}

	/**
	 * add care candidate
	 * @param object $data
	 */
	public function add_care_candidate($data)
	{
		$document = '';

		if (!empty($data['travel_id']) && $data['travel_id'] != 0) {
			$document = $this->get_travel_document_name_by_id($data['travel_id']);
		} elseif (!empty($data['license_id']) && $data['license_id'] != 0) {
			$document = $this->get_other_license_document_name_by_id($data['license_id']);
		} elseif (!empty($data['license_3']) && $data['license_3'] != 0) {
			$document = $this->get_license_3_document_name_by_id($data['license_3']);
		} elseif (!empty($data['license_4']) && $data['license_4'] != 0) {
			$document = $this->get_license_4_document_name_by_id($data['license_4']);
		} elseif (!empty($data['license_5']) && $data['license_5'] != 0) {
			$document = $this->get_license_5_document_name_by_id($data['license_5']);
		} elseif (!empty($data['license_6']) && $data['license_6'] != 0) {
			$document = $this->get_license_6_document_name_by_id($data['license_6']);
		}
		$data['document_type'] = $document['document_type'];
		$data['care_time'] = to_sql_date($data['care_time'], true);
		$data['add_from'] = get_staff_user_id();
		$data['add_time'] = date('Y-m-d H:i:s');
		$this->db->insert(db_prefix() . 'cd_care', $data);

		$this->db->last_query();
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	/**
	 * rating candidate
	 * @param  object $data
	 * @return bool
	 */
	public function rating_candidate($data)
	{
		$rs = 0;
		$assessor = get_staff_user_id();
		$evaluation_date = date('Y-m-d H:i:s');
		$this->db->where('candidate', $data['candidate']);
		$rate = $this->db->get(db_prefix() . 'rec_cd_evaluation')->result_array();
		if (count($rate) > 0) {
			$this->db->where('candidate', $data['candidate']);
			$this->db->delete(db_prefix() . 'rec_cd_evaluation');
		}

		foreach ($data['rating'] as $key => $value) {

			$this->db->insert(db_prefix() . 'rec_cd_evaluation', [
				'criteria' => $key,
				'rate_score' => $value,
				'assessor' => $assessor,
				'evaluation_date' => $evaluation_date,
				'percent' => $data['percent'][$key],
				'candidate' => $data['candidate'],
				'feedback' => $data['feedback'],
				'group_criteria' => $data['group'][$key],
			]);
			if ($this->db->insert_id()) {
				$rs++;
			}
		}
		if ($rs > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function send_email_candidate($candidate, $email_data)
	{
		$inbox = array();
		$inbox['to'] = $candidate->email;
		$inbox['sender_name'] = $candidate->candidate_name;
		$inbox['subject'] = $email_data->template_name;
		$inbox['body'] = json_decode($email_data->template_html_css);
		$inbox['date_received'] = date('Y-m-d H:i:s');
		$inbox['from_email'] = get_option('smtp_email');

		try {
			if (strlen(get_option('smtp_host')) > 0 && strlen(get_option('smtp_password')) > 0 && strlen(get_option('smtp_username')) > 0) {
				$ci = &get_instance();
				$ci->email->initialize();
				$ci->email->clear(true);
				$ci->email->from($inbox['from_email'], $inbox['sender_name']);
				$ci->email->to($inbox['to']);
				$ci->email->subject($inbox['subject']);
				$ci->email->message($inbox['body']);

				if (!$ci->email->send(true)) {
					$error_message = $ci->email->print_debugger();
					throw new Exception($error_message);
				} else {
					$care = array();
					$care['candidate'] = $candidate->id;
					$care['send_time'] = $inbox['date_received'];
					$care['mail_result'] = 'Sent';
					$care['type'] = 'Crew Send Mail';
					$this->db->insert(db_prefix() . 'candidate_send_mail', $care);
				}
			}
		} catch (Exception $e) {
			log_message('error', 'Email sending failed: ' . $e->getMessage());
			show_error('Email sending failed: ' . $e->getMessage());
		}
		return true;
	}

	/**
	 * send mail candidate
	 * @param  object $data
	 * @return bool
	 */
	public function send_mail_candidate($data)
	{
		$staff_id = get_staff_user_id();
		$inbox = array();
		$inbox['to'] = $data['email'];
		$inbox['sender_name'] = get_staff_full_name($staff_id);
		$inbox['subject'] = _strip_tags($data['subject']);
		$inbox['body'] = _strip_tags($data['content']);
		$inbox['body'] = nl2br_save_html($inbox['body']);
		$inbox['date_received'] = date('Y-m-d H:i:s');
		$inbox['from_email'] = get_staff_email_by_id_rec($staff_id);

		if (strlen(get_option('smtp_host')) > 0 && strlen(get_option('smtp_password')) > 0 && strlen(get_option('smtp_username')) > 0) {
			$ci = &get_instance();
			$ci->email->initialize();
			$ci->load->library('email');
			$ci->email->clear(true);
			$ci->email->from($inbox['from_email'], $inbox['sender_name']);
			$ci->email->to($inbox['to']);
			$ci->email->subject($inbox['subject']);
			$ci->email->message($inbox['body']);
			$ci->email->send(true);
		}

		$care = array();
		$care['care_time'] = $inbox['date_received'];
		$care['add_from'] = $staff_id;
		$care['add_time'] = $inbox['date_received'];
		$care['candidate'] = $data['candidate'];
		$care['care_result'] = 'Sent';
		$care['type'] = 'send_mail';
		$this->db->insert(db_prefix() . 'cd_care', $care);

		return true;
	}

	/**
	 * send mail list candidate
	 * @param  object $data
	 * @return object
	 */
	public function send_mail_list_candidate($data)
	{
		$staff_id = get_staff_user_id();
		$inbox = array();
		$inbox['to'] = implode(',', $data['email']);
		$inbox['sender_name'] = get_staff_full_name($staff_id);
		$inbox['subject'] = _strip_tags($data['subject']);
		$inbox['body'] = _strip_tags($data['content']);
		$inbox['body'] = nl2br_save_html($inbox['body']);
		$inbox['date_received'] = date('Y-m-d H:i:s');
		$inbox['from_email'] = get_staff_email_by_id_rec($staff_id);

		if (strlen(get_option('smtp_host')) > 0 && strlen(get_option('smtp_password')) > 0 && strlen(get_option('smtp_username')) > 0) {

			$ci = &get_instance();
			$ci->email->initialize();
			$ci->load->library('email');
			$ci->email->clear(true);
			$ci->email->from($inbox['from_email'], $inbox['sender_name']);
			$ci->email->to($inbox['to']);
			$ci->email->subject($inbox['subject']);
			$ci->email->message($inbox['body']);
			$ci->email->send(true);
		}

		$care = array();
		foreach ($data['candidate'] as $cd) {
			$care['care_time'] = $inbox['date_received'];
			$care['add_from'] = $staff_id;
			$care['add_time'] = $inbox['date_received'];
			$care['candidate'] = $cd;
			$care['care_result'] = 'Sent';
			$care['type'] = 'send_mail';
			$this->db->insert(db_prefix() . 'cd_care', $care);
		}
		return true;
	}

	/**
	 * check candidate interview
	 * @param  object $data
	 * @return object
	 */
	public function check_candidate_interview($data)
	{
		$data['interview_day'] = to_sql_date($data['interview_day']);
		$cd = $data['candidate'];

		$from_hours = $data['interview_day'] . ' ' . $data['from_time'] . ':00';
		$to_hours = $data['interview_day'] . ' ' . $data['to_time'] . ':00';

		if (!isset($data['id'])) {
			$list = $this->db->query('SELECT * FROM tblrec_interview ri LEFT JOIN tblcd_interview ON tblcd_interview.interview = ri.id WHERE tblcd_interview.candidate = ' . $cd . ' AND (((ri.from_hours <= "' . $from_hours . '") AND (ri.to_hours >= "' . $from_hours . '")) OR  ((ri.from_hours <= "' . $to_hours . '") AND (ri.to_hours >= "' . $to_hours . '")) OR  ((ri.from_hours >= "' . $from_hours . '") AND (ri.to_hours <= "' . $to_hours . '")) )')->result_array();
			return $list;
		} else {
			$lists = $this->db->query('SELECT * FROM tblrec_interview ri LEFT JOIN tblcd_interview ON tblcd_interview.interview = ri.id WHERE tblcd_interview.candidate = ' . $cd . ' AND ri.id != ' . $data['id'] . ' AND (((ri.from_hours <= "' . $from_hours . '") AND (ri.to_hours >= "' . $from_hours . '")) OR  ((ri.from_hours <= "' . $to_hours . '") AND (ri.to_hours >= "' . $to_hours . '")) OR  ((ri.from_hours >= "' . $from_hours . '") AND (ri.to_hours <= "' . $to_hours . '")) )')->result_array();
			return $lists;
		}
	}

	/**
	 * get list cd
	 * @return object
	 */

	public function get_list_cd()
	{
		$this->db->select('id, CONCAT(candidate_name," ",last_name) as label');
		return $this->db->get(db_prefix() . 'rec_candidate')->result_array();
	}

	/**
	 * get list candidates interview
	 * @param  int $id
	 * @return object
	 */
	public function get_list_candidates_interview($id)
	{
		return $this->db->query('SELECT * FROM tblcd_interview LEFT JOIN tblrec_candidate on tblrec_candidate.id = tblcd_interview.candidate where tblcd_interview.interview = ' . $id)->result_array();
	}

	/**
	 * delete interview schedule
	 * @param  int $id
	 * @return bool
	 */
	public function delete_interview_schedule($id)
	{
		$this->db->where('interview', $id);
		$this->db->delete(db_prefix() . 'cd_interview');
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'rec_interview');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * get interview schedule
	 * @param  string $id
	 * @return object
	 */
	public function get_interview_schedule($id = '')
	{
		if ($id == '') {
			return $this->db->get(db_prefix() . 'rec_interview')->result_array();
		} else {
			$this->db->where('id', $id);
			$intv_sch = $this->db->get(db_prefix() . 'rec_interview')->row();
			$intv_sch->list_candidate = $this->get_list_candidates_interview($id);
			return $intv_sch;
		}
	}

	/**
	 * add evaluation criteria
	 * @param object $data
	 */
	public function add_evaluation_criteria($data)
	{
		$data['add_from'] = get_staff_user_id();
		$data['add_date'] = date('Y-m-d');
		$this->db->insert(db_prefix() . 'rec_criteria', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update evaluation criteria
	 * @param  object $data
	 * @param  int $id
	 * @return bool
	 */
	public function update_evaluation_criteria($data, $id)
	{
		$this->db->where('criteria_id', $id);
		$this->db->update(db_prefix() . 'rec_criteria', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete evaluation criteria
	 * @param  int $id
	 * @return bool
	 */
	public function delete_evaluation_criteria($id)
	{
		$affected_rows = 0;
		$this->db->where('group_criteria', $id);
		$rs = $this->db->get(db_prefix() . 'rec_criteria')->result_array();
		foreach ($rs as $value) {
			$this->db->where('criteria_id', $value['criteria_id']);
			$this->db->delete(db_prefix() . 'rec_criteria');
			if ($this->db->affected_rows() > 0) {
				$affected_rows++;
			}
		}

		$this->db->where('criteria_id', $id);
		$this->db->delete(db_prefix() . 'rec_criteria');
		if ($this->db->affected_rows() > 0) {
			$affected_rows++;
		}

		if ($affected_rows > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get group evaluation criteria
	 * @param  string $id
	 * @return object
	 */
	public function get_group_evaluation_criteria($id = '')
	{
		if ($id == '') {
			$this->db->where('group_criteria', 0);
			$group = $this->db->get(db_prefix() . 'rec_criteria')->result_array();
		} else {
			$this->db->where('group_criteria', $id);
			$group = $this->db->get(db_prefix() . 'rec_criteria')->row();
		}
		return $group;
	}

	/**
	 * get list child criteria
	 * @return object
	 */
	public function get_list_child_criteria()
	{
		$list_group = $this->get_group_evaluation_criteria();
		$rs = array();
		$list = array();
		$parent = array();
		foreach ($list_group as $gr) {
			$parent[] = $gr;
			$this->db->where('group_criteria', $gr['criteria_id']);
			$rs = $this->db->get(db_prefix() . 'rec_criteria')->result_array();
			foreach ($rs as $value) {
				$parent[] = $value;
			}
		}
		return $parent;
	}

	/**
	 * get criteria by group
	 * @param  int $id
	 * @return object
	 */
	public function get_criteria_by_group($id)
	{
		$this->db->where('group_criteria', $id);
		$rs = $this->db->get(db_prefix() . 'rec_criteria')->result_array();
		return $rs;
	}

	/**
	 * add evaluation form
	 * @param object $data
	 */
	public function add_evaluation_form($data)
	{
		$data['add_from'] = get_staff_user_id();
		$data['add_date'] = date('Y-m-d');

		if (isset($data['job_position'])) {
			$data['position'] = $data['job_position'];
			unset($data['job_position']);
		}

		if (isset($data['group_criteria'])) {
			$group_criteria = $data['group_criteria'];
			unset($data['group_criteria']);
		}

		if (isset($data['evaluation_criteria'])) {
			$evaluation_criteria = $data['evaluation_criteria'];
			unset($data['evaluation_criteria']);
		}

		if (isset($data['percent'])) {
			$percent = $data['percent'];
			unset($data['percent']);
		}

		$this->db->insert(db_prefix() . 'rec_evaluation_form', $data);
		$insert_id = $this->db->insert_id();
		if (isset($insert_id)) {
			foreach ($evaluation_criteria as $key => $value) {
				foreach ($value as $per => $val) {
					$this->db->insert(db_prefix() . 'rec_list_criteria', [
						'evaluation_form' => $insert_id,
						'group_criteria' => $group_criteria[$key],
						'evaluation_criteria' => $val,
						'percent' => $percent[$key][$per],
					]);
				}
			}
			return $insert_id;
		}
	}

	/**
	 * update evaluation form
	 * @param  object $data
	 * @param  int $id
	 * @return bool
	 */
	public function update_evaluation_form($data, $id)
	{
		if (isset($data['job_position'])) {
			$data['position'] = $data['job_position'];
			unset($data['job_position']);
		}

		if (isset($data['group_criteria'])) {
			$group_criteria = $data['group_criteria'];
			unset($data['group_criteria']);
		}

		if (isset($data['evaluation_criteria'])) {
			$evaluation_criteria = $data['evaluation_criteria'];
			unset($data['evaluation_criteria']);
		}

		if (isset($data['percent'])) {
			$percent = $data['percent'];
			unset($data['percent']);
		}

		$this->db->where('form_id', $id);
		$this->db->update(db_prefix() . 'rec_evaluation_form', $data);

		$this->db->where('evaluation_form', $id);
		$this->db->delete(db_prefix() . 'rec_list_criteria');

		foreach ($evaluation_criteria as $key => $value) {
			foreach ($value as $per => $val) {
				$this->db->insert(db_prefix() . 'rec_list_criteria', [
					'evaluation_form' => $id,
					'group_criteria' => $group_criteria[$key],
					'evaluation_criteria' => $val,
					'percent' => $percent[$key][$per],
				]);
			}
		}

		return true;
	}

	/**
	 * delete evaluation form
	 * @param  int $id
	 * @return bool
	 */
	public function delete_evaluation_form($id)
	{
		$affected_rows = 0;

		$this->db->where('form_id', $id);
		$this->db->delete(db_prefix() . 'rec_evaluation_form');
		if ($this->db->affected_rows() > 0) {
			$affected_rows++;
		}

		$this->db->where('evaluation_form', $id);
		$this->db->delete(db_prefix() . 'rec_list_criteria');
		if ($this->db->affected_rows() > 0) {
			$affected_rows++;
		}

		if ($affected_rows > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get list evaluation form
	 * @param  string $id
	 * @return object
	 */
	public function get_list_evaluation_form($id = '')
	{
		if ($id == '') {
			return $this->db->get(db_prefix() . 'rec_evaluation_form')->result_array();
		} else {
			$this->db->where('form_id', $id);
			return $this->db->get(db_prefix() . 'rec_evaluation_form')->row();
		}
	}

	/**
	 * get list criteria edit
	 * @param  int $id
	 * @return object
	 */
	public function get_list_criteria_edit($id)
	{
		$group_criteria = 0;
		$evaluation_criteria = 0;

		$groups = $this->get_group_evaluation_criteria();
		$list_group = $this->db->query('SELECT distinct(tblrec_list_criteria.group_criteria) as id, criteria_title FROM tblrec_list_criteria
                      LEFT JOIN tblrec_criteria on tblrec_criteria.criteria_id = tblrec_list_criteria.group_criteria where tblrec_list_criteria.evaluation_form = ' . $id)->result_array();
		$html = '<div class="new-kpi-group-al">';
		$count_group = 0;
		foreach ($list_group as $gr) {
			$group_criteria++;

			$list_criter = $this->db->query('select evaluation_criteria, criteria_title, percent from tblrec_list_criteria
                        left join tblrec_criteria on tblrec_criteria.criteria_id = tblrec_list_criteria.evaluation_criteria
                         where tblrec_list_criteria.evaluation_form = ' . $id . ' AND tblrec_list_criteria.group_criteria = ' . $gr['id'])->result_array();
			$criterias = $this->get_criteria_by_group($gr['id']);
			$i = 'fa-plus';
			$class = 'success';
			$click = 'new_kpi_group';
			if ($count_group > 0) {
				$i = 'fa-minus';
				$class = 'danger';
				$click = 'remove_kpi_group';
			}

			$html .= '<div id="new_kpi_group" class="col-md-12">
                              <div class="row margin-top-10">
                                <div class="col-md-12">
                                    <label for="group_criteria[' . $count_group . ']" class="control-label"><span class="text-danger">* </span>' . _l('group_criteria') . '</label>
                                      <select onchange="group_criteria_change(this)" name="group_criteria[' . $count_group . ']" class="selectpicker" id="group_criteria[' . $count_group . ']" data-width="100%" data-none-selected-text="' . _l('dropdown_non_selected_tex') . '" required>
                                        <option value=""></option>';
			foreach ($groups as $kpi_coll) {
				$select = '';
				if ($kpi_coll['criteria_id'] == $gr['id']) {
					$select = 'selected';
				}
				$html .= '<option value="' . $kpi_coll['criteria_id'] . '" ' . $select . '> ' . $kpi_coll['criteria_title'] . '</option>';
			}
			$html .= '</select>
                                </div>

                              </div>
                                <br>
                              <div class="row " >

                                <div class="col-md-11 new-kpi-al pull-right margin-left-right-20-0">';
			$count_criter = 0;
			foreach ($list_criter as $li) {
				$evaluation_criteria++;

				$l_i = 'fa-plus';
				$l_class = 'success';
				$l_click = 'new_kpi';
				if ($count_criter > 0) {
					$l_i = 'fa-minus';
					$l_class = 'danger';
					$l_click = 'remove_kpi';
				}

				$html .= '<div id ="new_kpi" class="row padding-bottom-5">';

				$html .= '<div class="col-md-7 padding-right-0">
                                      <label for="evaluation_criteria[' . $count_group . '][' . $count_criter . ']" class="control-label get_id_row " value ="' . $count_criter . '" ><span class="text-danger">* </span>' . _l('evaluation_criteria') . '</label>
                                      <select name="evaluation_criteria[' . $count_group . '][' . $count_criter . ']" class="selectpicker" id="evaluation_criteria[' . $count_group . '][' . $count_criter . ']" data-width="100%" data-none-selected-text="' . _l('dropdown_non_selected_tex') . '" data-sl-id="e_criteria[' . $count_group . ']" required>
                                        <option value=""></option>';
				foreach ($criterias as $cr) {
					$select_cr = '';
					if ($cr['criteria_id'] == $li['evaluation_criteria']) {
						$select_cr = 'selected';
					}
					$html .= '<option value="' . $cr['criteria_id'] . '" ' . $select_cr . '> ' . $cr['criteria_title'] . '</option>';
				}

				$html .= '</select>
                                    </div>

                                    <div class="col-md-3 padding-right-0">
                                      <label for="percent[' . $count_group . '][' . $count_criter . ']" class="control-label"><span class="text-danger">* </span>' . _l('proportion') . '</label>
                                      <input type="number" id="percent[' . $count_group . '][' . $count_criter . ']" name="percent[' . $count_group . '][' . $count_criter . ']" class="form-control" min="1" max="100" step="1" value="' . $li['percent'] . '" aria-invalid="false" required>
                                    </div>
                                    <div class="col-md-1 lightheight-84-nowrap" name="button_add_kpi">
                                      <button name="add" class="btn ' . $l_click . ' btn-' . $l_class . ' border-radius-20" data-ticket="true" type="button"><i class="fa ' . $l_i . '"></i></button>
                                    </div>
                                  </div>';
				$count_criter++;
			}
			$html .= '</div>

                              </div>

                              <div class="row">
                                <div class="col-md-2 lightheight-84-nowrap" name="button_add_kpi_group">
                                        <button name="add_kpi_group" class="btn ' . $click . ' btn-' . $class . ' border-radius-20" data-ticket="true" type="button"><i class="fa ' . $i . '"></i></button>
                                </div>
                              </div>

                            </div>';

			$count_group++;
		}

		$result = [];
		$result['html'] = $html;
		$result['group_criteria'] = $group_criteria;
		$result['evaluation_criteria'] = $evaluation_criteria;

		return $result;
	}

	/**
	 * get evaluation form by position
	 * @param  string $position
	 * @return object
	 */
	public function get_evaluation_form_by_position($position = '')
	{
		$this->db->where('position', $position);
		$e_form = $this->db->get(db_prefix() . 'rec_evaluation_form')->row();

		if (!isset($e_form)) {
			$this->db->where('position', 0);
			$e_form = $this->db->get(db_prefix() . 'rec_evaluation_form')->row();
		}

		if ($e_form) {
			$rs['groups'] = $this->db->query('SELECT distinct(tblrec_list_criteria.group_criteria) as id, criteria_title FROM tblrec_list_criteria
                          LEFT JOIN tblrec_criteria on tblrec_criteria.criteria_id = tblrec_list_criteria.group_criteria where tblrec_list_criteria.evaluation_form = ' . $e_form->form_id)->result_array();

			$rs['criteria'] = $this->db->query('select tblrec_list_criteria.group_criteria as group_cr, evaluation_criteria, criteria_title, percent from tblrec_list_criteria
                            left join tblrec_criteria on tblrec_criteria.criteria_id = tblrec_list_criteria.evaluation_criteria
                             where tblrec_list_criteria.evaluation_form = ' . $e_form->form_id)->result_array();
			return $rs;
		} else {
			return '';
		}
	}

	/**
	 * get cd evaluation
	 * @param  object $candidate
	 * @return object
	 */
	public function get_cd_evaluation($candidate)
	{
		$this->db->where('candidate', $candidate);
		return $this->db->get(db_prefix() . 'rec_cd_evaluation')->result_array();
	}

	/**
	 * get interview by candidate
	 * @param  object $candidate
	 * @return object
	 */
	public function get_interview_by_candidate($candidate)
	{
		return $this->db->query('SELECT * FROM tblcd_interview LEFT JOIN tblrec_interview on tblrec_interview.id = tblcd_interview.interview where tblcd_interview.candidate = ' . $candidate)->result_array();
	}

	/**
	 * change status candidate
	 * @param  int $status
	 * @param  int $id
	 * @return bool
	 */
	public function change_status_candidate($status, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_candidate', ['status' => $status]);
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * add setting tranfer
	 * @param object $data
	 */
	public function add_setting_tranfer($data)
	{
		$data['add_from'] = get_staff_user_id();
		$data['add_date'] = date('Y-m-d');
		if (isset($data['email_to'])) {
			$data['email_to'] = implode(',', $data['email_to']);
		}

		$this->db->insert(db_prefix() . 'rec_set_transfer_record', $data);
		$insert_id = $this->db->insert_id();
		if (isset($insert_id)) {
			return $insert_id;
		}
	}

	/**
	 * update setting tranfer
	 * @param  object $data
	 * @param  int $id
	 * @return bool
	 */
	public function update_setting_tranfer($data, $id)
	{
		$rs = 0;
		if (isset($data['email_to'])) {
			$data['email_to'] = implode(',', $data['email_to']);
		}

		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_set_transfer');
		$avar = $this->db->get(db_prefix() . 'files')->row();

		if ($avar && (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '')) {
			if (empty($avar->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id . '/' . $avar->file_name);
			}
			$this->db->where('id', $avar->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$rs++;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id)) {
				// Check if no avars left, so we can delete the folder also
				$other_avars = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id);
				if (count($other_avars) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id);
				}
			}
		}

		$this->db->where('set_id', $id);
		$this->db->update(db_prefix() . 'rec_set_transfer_record', $data);
		if ($this->db->affected_rows() > 0) {
			$rs++;
		}

		if ($rs > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete setting tranfer
	 * @param  int $id
	 * @return object
	 */
	public function delete_setting_tranfer($id)
	{
		$rs = 0;
		$this->db->where('set_id', $id);
		$this->db->delete(db_prefix() . 'rec_set_transfer_record');
		if ($this->db->affected_rows() > 0) {
			$rs++;
		}

		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_set_transfer');
		$avar = $this->db->get(db_prefix() . 'files')->row();

		if ($avar) {
			if (empty($avar->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id . '/' . $avar->file_name);
			}
			$this->db->where('id', $avar->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$rs++;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id)) {
				// Check if no avars left, so we can delete the folder also
				$other_avars = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id);
				if (count($other_avars) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id);
				}
			}
		}

		if ($rs > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get list set transfer
	 * @param  boolean $id
	 * @return object
	 */
	public function get_list_set_transfer($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('set_id', $id);
			return $this->db->get(db_prefix() . 'rec_set_transfer_record')->row();
		}

		if ($id == false) {
			return $this->db->get(db_prefix() . 'rec_set_transfer_record')->result_array();
		}
	}

	/**
	 * get step transfer setting
	 * @return object
	 */
	public function get_step_transfer_setting()
	{
		return $this->db->query('SELECT * FROM tblrec_set_transfer_record order by tblrec_set_transfer_record.order ASC;')->result_array();
	}

	/**
	 * action transfer hr
	 * @param  object $data
	 * @return object
	 */
	public function action_transfer_hr($data)
	{
		$this->db->where('rel_id', $data['id']);
		$this->db->where('rel_type', 'rec_set_transfer');
		$file = $this->db->get(db_prefix() . 'files')->row();
		$inbox = array();
		$inbox['to'] = $data['email'];
		$inbox['sender_name'] = get_option('companyname');
		$inbox['subject'] = _strip_tags($data['subject']);
		$inbox['body'] = _strip_tags($data['content']);
		$inbox['body'] = nl2br_save_html($inbox['body']);
		$inbox['date_received'] = date('Y-m-d H:i:s');
		$inbox['from_email'] = get_option('smtp_email');

		if (strlen(get_option('smtp_host')) > 0 && strlen(get_option('smtp_password')) > 0 && strlen(get_option('smtp_username')) > 0) {

			$ci = &get_instance();
			$ci->email->initialize();
			$ci->load->library('email');
			$ci->email->clear(true);
			$ci->email->from($inbox['from_email'], $inbox['sender_name']);
			$ci->email->to($inbox['to']);
			$ci->email->subject($inbox['subject']);
			$ci->email->message($inbox['body']);

			if ($file) {
				$attachment_url = site_url(RECRUITMENT_PATH . 'set_transfer/' . $data['id'] . '/' . $file->file_name);
				$ci->email->attach($attachment_url);
			}

			$ci->email->send(true);
		}
	}

	/**
	 * get rec dashboard count
	 * @return object
	 */
	public function get_rec_dashboard_count()
	{
		$rs = [];

		$total = $this->db->query('Select * from tblrec_campaign')->result_array();
		$inprogress = $this->db->query('Select * from tblrec_campaign where cp_status = 3')->result_array();
		$planning = $this->db->query('Select * from tblrec_campaign where cp_status = 1')->result_array();
		$finish = $this->db->query('Select * from tblrec_campaign where cp_status = 4')->result_array();
		$candidate_need = $this->db->query('Select amount_recruiment from tblrec_proposal')->result_array();
		$recruited = $this->db->query('Select * from tblrec_candidate where status = 6')->result_array();
		$upcomming_intv = $this->get_upcoming_interview();

		$rs['candidate_need'] = 0;
		foreach ($candidate_need as $cd) {
			$rs['candidate_need'] += $cd['amount_recruiment'];
		}

		$rs['recruiting'] = 0;
		foreach ($inprogress as $cd) {
			$rs['recruiting'] += $cd['cp_amount_recruiment'];
		}

		$rs['upcomming_intv'] = count($upcomming_intv);
		$rs['recruited'] = count($recruited);
		$rs['total'] = count($total);
		$rs['inprogress'] = count($inprogress);
		$rs['planning'] = count($planning);
		$rs['finish'] = count($finish);

		return $rs;
	}

	/**
	 * rec plan chart by status
	 * @return object
	 */
	public function rec_plan_chart_by_status()
	{
		$plans = $this->get_rec_proposal();

		$chart = [];
		$status_1 = ['name' => _l('planning'), 'color' => '#777', 'y' => 0, 'z' => 100];
		$status_2 = ['name' => _l('approved'), 'color' => '#ff6f00', 'y' => 0, 'z' => 100];
		$status_3 = ['name' => _l('made_finish'), 'color' => '#03a9f4', 'y' => 0, 'z' => 100];
		$status_4 = ['name' => _l('reject'), 'color' => '#fc2d42', 'y' => 0, 'z' => 100];

		foreach ($plans as $pl) {

			if ($pl['status'] == 1) {
				$status_1['y'] += 1;
			} elseif ($pl['status'] == 2) {
				$status_2['y'] += 1;
			} elseif ($pl['status'] == 3) {
				$status_3['y'] += 1;
			} elseif ($pl['status'] == 4) {
				$status_4['y'] += 1;
			}
		}

		if ($status_1['y'] > 0) {
			array_push($chart, $status_1);
		}
		if ($status_2['y'] > 0) {
			array_push($chart, $status_2);
		}
		if ($status_3['y'] > 0) {
			array_push($chart, $status_3);
		}
		if ($status_4['y'] > 0) {
			array_push($chart, $status_4);
		}

		return $chart;
	}

	/**
	 * rec campaign chart by status
	 * @return object
	 */
	public function rec_campaign_chart_by_status()
	{
		$campaign = $this->get_rec_campaign();

		$chart = [];
		$status_1 = ['name' => _l('planning'), 'color' => '#c53da9', 'y' => 0, 'z' => 100];
		$status_2 = ['name' => _l('in_progress'), 'color' => '#28B8DA', 'y' => 0, 'z' => 100];
		$status_3 = ['name' => _l('finish'), 'color' => '#84C529', 'y' => 0, 'z' => 100];
		$status_4 = ['name' => _l('cancel'), 'color' => '#fb3b3b', 'y' => 0, 'z' => 100];

		foreach ($campaign as $cp) {

			if ($cp['cp_status'] == 1) {
				$status_1['y'] += 1;
			} elseif ($cp['cp_status'] == 3) {
				$status_2['y'] += 1;
			} elseif ($cp['cp_status'] == 4) {
				$status_3['y'] += 1;
			} elseif ($cp['cp_status'] == 5) {
				$status_4['y'] += 1;
			}
		}

		if ($status_1['y'] > 0) {
			array_push($chart, $status_1);
		}
		if ($status_2['y'] > 0) {
			array_push($chart, $status_2);
		}
		if ($status_3['y'] > 0) {
			array_push($chart, $status_3);
		}
		if ($status_4['y'] > 0) {
			array_push($chart, $status_4);
		}
		return $chart;
	}

	/**
	 * get upcoming interview
	 * @return object
	 */
	public function get_upcoming_interview()
	{
		return $this->db->query('select * from tblrec_interview where from_hours >= "' . date('Y-m-d H:i:s') . '"')->result_array();
	}

	/**
	 * get form
	 * @param  string $where
	 * @return object
	 */
	public function get_form($where)
	{
		$this->db->where($where);
		return $this->db->get(db_prefix() . 'rec_campaign_form_web')->row();
	}

	/**
	 * add recruitment channel
	 * @param [object $data
	 */
	public function add_recruitment_channel($data)
	{
		if (isset($data['r_form_name'])) {
			$r_form_name = $data['r_form_name'];
		}

		$data['form_data'] = preg_replace('/=\\\\/m', "=''", $data['form_data']);
		if (isset($data['notify_lead_imported'])) {
			$data['notify_lead_imported'] = 1;
		} else {
			$data['notify_lead_imported'] = 0;
		}

		$data = $this->convert_data_campaign($data);
		$data['success_submit_msg'] = nl2br($data['success_submit_msg']);
		$data['form_key'] = app_generate_hash();

		if (isset($data['notify_ids_staff']) && $data['notify_ids_staff'] != null) {
			$data['notify_ids_staff'] = implode(',', $data['notify_ids_staff']);
		}

		if (isset($data['notify_ids_roles']) && $data['notify_ids_roles'] != null) {
			$data['notify_ids_roles'] = implode(',', $data['notify_ids_roles']);
		}

		$data['r_form_name'] = $r_form_name;
		$this->db->insert(db_prefix() . 'rec_campaign_form_web', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * convert data campaign
	 * @param  object $data
	 * @return object
	 */
	public function convert_data_campaign($data)
	{

		$data_out['rec_campaign_id'] = isset($data['rec_campaign_id']) ? $data['rec_campaign_id'] : '';
		$data_out['form_type'] = isset($data['form_type']) ? $data['form_type'] : '';

		$data_out['lead_status'] = isset($data['lead_status']) ? $data['lead_status'] : '';
		$data_out['notify_ids_staff'] = isset($data['notify_ids_staff']) ? $data['notify_ids_staff'] : '';
		$data_out['notify_ids_roles'] = isset($data['notify_ids_roles']) ? $data['notify_ids_roles'] : '';
		$data_out['form_key'] = isset($data['form_key']) ? $data['form_key'] : '';
		$data_out['notify_lead_imported'] = isset($data['notify_lead_imported']) ? $data['notify_lead_imported'] : '';
		$data_out['notify_type'] = isset($data['notify_type']) ? $data['notify_type'] : '';
		$data_out['notify_ids'] = isset($data['notify_ids']) ? $data['notify_ids'] : '';
		$data_out['responsible'] = isset($data['responsible']) ? $data['responsible'] : '';
		$data_out['form_data'] = isset($data['form_data']) ? $data['form_data'] : '';
		$data_out['recaptcha'] = isset($data['recaptcha']) ? $data['recaptcha'] : '';
		$data_out['submit_btn_name'] = isset($data['submit_btn_name']) ? $data['submit_btn_name'] : '';
		$data_out['success_submit_msg'] = isset($data['success_submit_msg']) ? $data['success_submit_msg'] : '';
		$data_out['language'] = isset($data['language']) ? $data['language'] : '';
		$data_out['allow_duplicate'] = isset($data['allow_duplicate']) ? $data['allow_duplicate'] : '';
		$data_out['mark_public'] = isset($data['mark_public']) ? $data['mark_public'] : '';
		$data_out['track_duplicate_field'] = isset($data['track_duplicate_field']) ? $data['track_duplicate_field'] : '';
		$data_out['track_duplicate_field_and'] = isset($data['track_duplicate_field_and']) ? $data['track_duplicate_field_and'] : '';
		$data_out['create_task_on_duplicate'] = isset($data['create_task_on_duplicate']) ? $data['create_task_on_duplicate'] : '';

		return $data_out;
	}

	/**
	 * get recruitment channel
	 * @param  boolean $id
	 * @return object
	 */
	public function get_recruitment_channel($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);

			return $this->db->get(db_prefix() . 'rec_campaign_form_web')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tblrec_campaign_form_web')->result_array();
		}
	}

	/**
	 * delete recruitment channel
	 * @param  int $id
	 * @return bool
	 */
	public function delete_recruitment_channel($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'rec_campaign_form_web');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * count cv from recruitment channel
	 * @param  int $id
	 * @param  object $recruitment_channel
	 * @return object
	 */
	public function count_cv_from_recruitment_channel($id, $recruitment_channel)
	{
		$this->db->where('rec_campaign', $id);
		$this->db->where('recruitment_channel', $recruitment_channel);
		return $this->db->count_all_results(db_prefix() . 'rec_candidate');
	}

	/**
	 * count row all candidate profile
	 * @return object
	 */
	public function count_row_all_candidate_profile()
	{
		return $this->db->count_all('rec_candidate');
	}

	/**
	 * add candidate forms
	 * @param object $data
	 * @param string $form_key
	 */
	public function add_candidate_forms($data, $form_key = '')
	{
		//Remove terms conditions checkbox
		if (isset($data['accept_terms_and_conditions'])) {
			unset($data['accept_terms_and_conditions']);
		}

		$this->db->where('form_key', $form_key);
		$rec_campaign_form_web = $this->db->get(db_prefix() . 'rec_campaign_form_web')->row();
		$count_row = $this->recruitment_model->count_row_all_candidate_profile();

		if (isset($data['birthday'])) {
			$data['birthday'] = $data['birthday'];
			if (!$this->check_format_date($data['birthday'])) {
				$data['birthday'] = to_sql_date($data['birthday']);
			}
		}

		if (isset($data['days_for_identity'])) {

			$data['days_for_identity'] = $data['days_for_identity'];
			if (!$this->check_format_date($data['days_for_identity'])) {
				$data['days_for_identity'] = to_sql_date($data['days_for_identity']);
			}
		}

		/*general candidate code*/
		$sql_where = 'SELECT * FROM ' . db_prefix() . 'rec_candidate order by id desc limit 1';
		$last_candidate_id = $this->db->query($sql_where)->row();

		if ($last_candidate_id) {
			$last_id = (int) ($last_candidate_id->id) + 1;
			$data['candidate_code'] = "WEB_" . $last_id;
		} else {
			$data['candidate_code'] = "WEB_1";
		}

		$data['recruitment_channel'] = 1; /*type: forms*/

		if (isset($data['rec_campaignid'])) {
			$data['rec_campaign'] = $data['rec_campaignid'];
			unset($data['rec_campaignid']);
		}

		if (isset($data['desired_salary'])) {
			$data['desired_salary'] = $data['desired_salary'];
			unset($data['desired_salary']);
		}

		if ($rec_campaign_form_web) {
			$data['status'] = $rec_campaign_form_web->lead_status;
		}

		$data['date_add'] = date('Y-m-d');

		if (isset($data['from_date'])) {
			$from_date = $data['from_date'];

			if (!$this->check_format_date($data['from_date'])) {
				$from_date = to_sql_date($data['from_date']);
			}

			unset($data['from_date']);
		} else {
			$from_date = '';
		}

		if (isset($data['to_date'])) {
			$to_date = $data['to_date'];

			if (!$this->check_format_date($data['to_date'])) {
				$to_date = to_sql_date($data['to_date']);
			}

			unset($data['to_date']);
		} else {
			$to_date = '';
		}

		if (isset($data['company'])) {
			$company = $data['company'];
			unset($data['company']);
		} else {
			$company = '';
		}

		if (isset($data['contact_person'])) {
			$contact_person = $data['contact_person'];
			unset($data['contact_person']);
		} else {
			$contact_person = '';
		}

		if (isset($data['salary'])) {
			$salary = $data['salary'];
			unset($data['salary']);
		} else {
			$salary = '';
		}

		if (isset($data['reason_quitwork'])) {
			$reason_quitwork = $data['reason_quitwork'];
			unset($data['reason_quitwork']);
		} else {

			$reason_quitwork = '';
		}

		if (isset($data['job_description'])) {
			$job_description = $data['job_description'];
			unset($data['job_description']);
		} else {
			$job_description = '';
		}

		if (isset($data['literacy_from_date'])) {
			$literacy_from_date = $data['literacy_from_date'];

			if (!$this->check_format_date($data['literacy_from_date'])) {
				$literacy_from_date = to_sql_date($data['literacy_from_date']);
			}

			unset($data['literacy_from_date']);
		} else {
			$literacy_from_date = '';
		}

		if (isset($data['literacy_to_date'])) {
			$literacy_to_date = $data['literacy_to_date'];

			if (!$this->check_format_date($data['literacy_to_date'])) {
				$literacy_to_date = to_sql_date($data['literacy_to_date']);
			}

			unset($data['literacy_to_date']);
		} else {
			$literacy_to_date = '';
		}

		if (isset($data['diploma'])) {
			$diploma = $data['diploma'];
			unset($data['diploma']);
		}

		if (isset($data['training_places'])) {
			$training_places = $data['training_places'];
			unset($data['training_places']);
		}

		if (isset($data['specialized'])) {
			$specialized = $data['specialized'];
			unset($data['specialized']);
		}

		if (isset($data['training_form'])) {
			$training_form = $data['training_form'];
			unset($data['training_form']);
		}

		if (isset($data['relationship'])) {
			$relationship = $data['relationship'];
			unset($data['relationship']);
		}

		if (isset($data['name'])) {
			$name = $data['name'];
			unset($data['name']);
		}

		if (isset($data['fi_birthday'])) {
			$fi_birthday = $data['fi_birthday'];

			if (!$this->check_format_date($data['fi_birthday'])) {
				$fi_birthday = to_sql_date($data['fi_birthday']);
			}

			unset($data['fi_birthday']);
		} else {
			$fi_birthday = '';
		}

		if (isset($data['job'])) {
			$job = $data['job'];
			unset($data['job']);
		}

		if (isset($data['address'])) {
			$address = $data['address'];
			unset($data['address']);
		}

		if (isset($data['phone'])) {
			$phone = $data['phone'];
			unset($data['phone']);
		}
		if (isset($data['position'])) {
			$position_id = $data['position'];
			unset($data['position']);
		}
		if (isset($data['year_experience'])) {
			$data['year_experience'] = $data['year_experience'];
			unset($data['year_experience']);
		}

		if (isset($data['recruitment_channel'])) {
			$data['recruitment_channel'] = $data['recruitment_channel'];
			unset($data['recruitment_channel']);
		}

		if (isset($data['key'])) {
			unset($data['key']);
		}

		if (isset($data['key'])) {
			unset($data['key']);
		}
		if (isset($data['zip'])) {
			unset($data['zip']);
		}

		if (isset($data['position_id'])) {
			$data['position_id'] = $data['position_id'];
			unset($data['position_id']);
		}

		if (isset($data['skill'])) {
			$data['skill'] = implode(',', $data['skill']);
		}

		$this->db->insert(db_prefix() . 'rec_candidate', $data);
		$insert_id = $this->db->insert_id();

		if ($insert_id) {

			if (isset($position_id)) {

				$this->db->insert(db_prefix() . 'cd_work_experience', [
					'candidate' => $insert_id,
					'from_date' => $from_date,
					'to_date' => $to_date,
					'company' => $company,
					'position' => $position_id,
					'contact_person' => $contact_person,
					'salary' => $salary,
					'reason_quitwork' => $reason_quitwork,
					'job_description' => $job_description,
				]);
			}

			if (isset($diploma)) {

				$this->db->insert(db_prefix() . 'cd_literacy', [

					'candidate' => $insert_id,
					'literacy_from_date' => $literacy_from_date,
					'literacy_to_date' => $literacy_to_date,
					'diploma' => isset($diploma) ? $diploma : '',
					'training_places' => isset($training_places) ? $training_places : '',
					'specialized' => isset($specialized) ? $specialized : '',
					'training_form' => isset($training_form) ? $training_form : '',
				]);
			}

			if (isset($relationship)) {

				$this->db->insert(db_prefix() . 'cd_family_infor', [
					'candidate' => $insert_id,
					'relationship' => isset($training_form) ? $cd_family_infor : '',
					'name' => isset($name) ? $name : '',
					'fi_birthday' => $fi_birthday,
					'job' => isset($job) ? $job : '',
					'address' => isset($address) ? $address : '',
					'phone' => isset($phone) ? $phone : '',
				]);
			}

			/*send notifi to personal related*/

			if ($rec_campaign_form_web->notify_lead_imported == 1) {

				$additional_data = '';
				$mes = 'notify_new_candidate';
				$link = 'recruitment/candidate/' . $insert_id;

				if ($rec_campaign_form_web->notify_type == 'assigned') {
					$notified = add_notification([
						'description' => $mes,
						'touserid' => $rec_campaign_form_web->responsible,
						'link' => $link,
						'additional_data' => serialize([
							$additional_data,
						]),
					]);
					if ($notified) {
						pusher_trigger_notification([$rec_campaign_form_web->responsible]);
					}
				} elseif ($rec_campaign_form_web->notify_type == 'roles') {

					$str_roles = $rec_campaign_form_web->notify_ids_roles;
					if (strlen($str_roles) > 0) {

						$sql_role = 'role IN (' . $str_roles . ')';
						$this->db->where($sql_role);
						$arr_staff = $this->db->get(db_prefix() . 'staff')->result_array();

						if (count($arr_staff) > 0) {
							foreach ($arr_staff as $staff_value) {

								$notified = add_notification([
									'description' => $mes,
									'touserid' => $staff_value['staffid'],
									'link' => $link,
									'additional_data' => serialize([
										$additional_data,
									]),
								]);

								if ($notified) {
									pusher_trigger_notification([$staff_value['staffid']]);
								}
							}
						}
					}
				} elseif ($rec_campaign_form_web->notify_type == 'specific_staff') {
					$str_staff = $rec_campaign_form_web->notify_ids_staff;
					if (strlen($str_staff) > 0) {
						$arr_staff = explode(",", $str_staff);
						foreach ($arr_staff as $staff_value) {

							$notified = add_notification([
								'description' => $mes,
								'touserid' => $staff_value,
								'link' => $link,
								'additional_data' => serialize([
									$additional_data,
								]),
							]);

							if ($notified) {
								pusher_trigger_notification([$staff_value]);
							}
						}
					}
				}
			}
			return $insert_id;
		}
	}

	/**
	 * update recruitment channel
	 * @param  object $data
	 * @param  int $id
	 * @return bool
	 */
	public function update_recruitment_channel($data, $id)
	{
		if (isset($data['r_form_name'])) {
			$r_form_name = $data['r_form_name'];
		}

		$data['form_data'] = preg_replace('/=\\\\/m', "=''", $data['form_data']);
		if (isset($data['notify_lead_imported'])) {
			$data['notify_lead_imported'] = 1;
		} else {
			$data['notify_lead_imported'] = 0;
		}

		$data = $this->convert_data_campaign($data);
		$data['success_submit_msg'] = nl2br($data['success_submit_msg']);
		$data['form_key'] = app_generate_hash();

		if (isset($data['notify_ids_staff']) && $data['notify_ids_staff'] != null) {
			$data['notify_ids_staff'] = implode(',', $data['notify_ids_staff']);
		}

		if (isset($data['notify_ids_roles']) && $data['notify_ids_roles'] != null) {
			$data['notify_ids_roles'] = implode(',', $data['notify_ids_roles']);
		}

		$data['r_form_name'] = $r_form_name;
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_campaign_form_web', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get calendar interview schedule data
	 * @param  [type]  $start
	 * @param  [type]  $end
	 * @param  boolean $filters
	 * @return [type]
	 */
	public function get_calendar_interview_schedule_data($start, $end, $data)
	{
		$data = [];
		$list_interview = $this->get_interview_schedule();

		foreach ($list_interview as $interview) {

			$calendar['title'] = $interview['is_name'];
			$calendar['color'] = '#7cb342';
			$calendar['_tooltip'] = $interview['is_name'] . "\n" . ' Day: ' . _d($interview['interview_day']) . "\n" . ' Start: ' . ($interview['from_time']) . ' End: ' . ($interview['to_time']);

			$calendar['url'] = admin_url('recruitment/interview_schedule/' . $interview['id']);
			$calendar['start'] = $interview['from_hours'];
			$calendar['end'] = $interview['to_hours'];
			array_push($data, $calendar);
		}

		return $data;
	}

	/**
	 * check format date Y-m-d
	 *
	 * @param      String   $date   The date
	 *
	 * @return     boolean
	 */
	public function check_format_date($date)
	{
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * do kanban query
	 * @param  [type]  $status
	 * @param  string  $search
	 * @param  integer $page
	 * @param  boolean $count
	 * @param  array   $where
	 * @return [type]
	 */
	public function do_kanban_query($status, $search = '', $page = 1, $count = false, $where = [])
	{
		$candidates_profile_limit = 50;
		$candidate_where = '';

		$this->db->select('*');

		$this->db->from(db_prefix() . 'rec_candidate');
		$this->db->where('status', $status);

		$this->db->where($where);

		if ($candidate_where != '') {
			$this->db->where($candidate_where);
		}

		$this->db->order_by('id', 'desc');

		if ($count == false) {
			if ($page > 1) {
				$page--;
				$position = ($page * $candidates_profile_limit);
				$this->db->limit($candidates_profile_limit, $position);
			} else {
				$this->db->limit($candidates_profile_limit);
			}
		}

		if ($count == false) {
			return $this->db->get()->result_array();
		}
		return $this->db->count_all_results();
	}

	/**
	 * get recruitment channel form rec campaingn
	 * @param  integer $id
	 * @return array
	 */
	public function get_recruitment_channel_form_campaingn($campaingn_id)
	{
		$form_id = '';
		/*get form id from rec_campain*/
		$rec_campain_value = $this->get_rec_campaign($campaingn_id);
		if ($rec_campain_value) {
			$form_id = $rec_campain_value->rec_channel_form_id;
		}
		$this->db->where('id', $form_id);
		$data = $this->db->get(db_prefix() . 'rec_campaign_form_web')->row();
		return $data;
	}

	/**
	 * get skill
	 * @param  boolean $id
	 * @return object
	 */
	public function get_skill($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);

			return $this->db->get(db_prefix() . 'rec_skill')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tblrec_skill')->result_array();
		}
	}

	/**
	 * add skill
	 * @param object $data
	 */
	public function add_skill($data)
	{
		$this->db->insert(db_prefix() . 'rec_skill', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update skill
	 * @param  object $data
	 * @param  int $id
	 * @return bool
	 */
	public function update_skill($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_skill', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete skill
	 * @param  int $id
	 * @return bool
	 */
	public function delete_skill($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'rec_skill');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * do kanban query
	 * @param  [type]  $status
	 * @param  string  $search
	 * @param  integer $page
	 * @param  boolean $count
	 * @param  array   $where
	 * @return [type]
	 */
	public function do_recruitment_portal_search($status, $search = '', $page = 1, $count = false, $where = [])
	{

		$rec_campaign_limit = 10;

		$rec_campaign_where = '';

		$this->db->select('*,' . db_prefix() . 'rec_campaign.company_id');
		$this->db->from(db_prefix() . 'rec_campaign');

		$this->db->join(db_prefix() . 'rec_job_position', '' . db_prefix() . 'rec_job_position.position_id = ' . db_prefix() . 'rec_campaign.cp_position', 'left');

		$this->db->join(db_prefix() . 'rec_company', '' . db_prefix() . 'rec_campaign.company_id = ' . db_prefix() . 'rec_company.id', 'left');

		$this->db->join(db_prefix() . 'job_industry', '' . db_prefix() . 'rec_job_position.industry_id = ' . db_prefix() . 'job_industry.id', 'left');

		$this->db->where('cp_status', '3');

		$this->db->group_start();

		$this->db->like('campaign_code', $search);
		$this->db->or_like('campaign_name', $search);
		$this->db->or_like('cp_proposal', $search);
		$this->db->or_like(db_prefix() . 'rec_job_position.position_name', $search);

		$this->db->or_like('cp_form_work', $search);
		$this->db->or_like('cp_form_work', str_replace(' ', '_', $search));
		$this->db->or_like('cp_workplace', $search);
		$this->db->or_like('cp_salary_from', $search);
		$this->db->or_like('cp_salary_to', $search);
		$this->db->or_like('cp_ages_from', $search);
		$this->db->or_like('cp_ages_to', $search);
		$this->db->or_like('cp_gender', $search);
		$this->db->or_like('cp_literacy', $search);

		$this->db->or_like('cp_experience', $search);
		$this->db->or_like('cp_experience', str_replace(' ', '_', $search));
		$this->db->or_like('company_name', $search);
		$this->db->or_like('company_industry', $search);
		$this->db->or_like('company_address', $search);
		$this->db->or_like('industry_name', $search);
		$this->db->or_like('industry_description', $search);

		$this->db->group_end();

		$this->db->where($where);

		if ($rec_campaign_where != '') {
			$this->db->where($rec_campaign_where);
		}

		$this->db->order_by('cp_id', 'desc');

		if ($count == false) {
			if ($page > 1) {
				$page--;
				$position = ($page * $rec_campaign_limit);
				$this->db->limit($rec_campaign_limit, $position);
			} else {
				$this->db->limit($rec_campaign_limit);
			}
		}

		if ($count == false) {
			$data = $this->db->get()->result_array();

			/*get company logo*/
			foreach ($data as $key => $value) {
				$data[$key]['company_logo'] = RECRUITMENT_PATH . 'no_logo.jpg';
				$data[$key]['alt_logo'] = 'no_logo.jpg';

				if (($value['company_id'] != '') && ($value['company_id'] != 0)) {
					$this->db->where('rel_id', $value['company_id']);
					$this->db->where('rel_type', "rec_company");
					$logo = $this->db->get(db_prefix() . 'files')->row();
					if ($logo) {
						$data[$key]['company_logo'] = RECRUITMENT_PATH . '/company_images/' . $value['company_id'] . '/' . $logo->file_name;
						$data[$key]['alt_logo'] = $logo->file_name;
					}
				}
			}
			return $data;
		}

		return $this->db->count_all_results();
	}

	/**
	 * [do_recruitment_portal_search
	 * @param  [type]  $status
	 * @param  string  $search
	 * @param  integer $page
	 * @param  boolean $count
	 * @param  array   $where
	 * @return [type]
	 */
	public function do_recruitment_show_more_job($status, $search = '', $page = 1, $count = false, $where = [])
	{
		$arr_job = $this->do_recruitment_portal_search($status, $search, $page, $count, $where = []);

		$string_job = '';
		if (count($arr_job) > 0) {
			foreach ($arr_job as $key => $rec_value) {

				$string_job .= '<div class="job" id="job_68268">';

				$string_job .= '<div class="row">';
				$string_job .= '<div class="col-md-12">';
				$string_job .= '<div class="row">';

				$string_job .= '<div class="job_content col-md-12">';

				if (!isset($rec_value["company_id"]) || ($rec_value["company_id"] == "0")) {

					$string_job .= '<div class="job-company-logo col-md-2 hide">';
				} else {
					$string_job .= '<div class="job-company-logo col-md-2 ">';
				}

				$string_job .= '<img class="images_w_table" src="' . site_url($rec_value['company_logo']) . '" alt="' . $rec_value['alt_logo'] . '">';
				$string_job .= '</div>';
				if (!isset($rec_value["company_id"]) || ($rec_value["company_id"] == "0")) {
					$string_job .= '<div class="job__description col-md-7 job__description_margin">';
				} else {
					$string_job .= '<div class="job__description col-md-7 ">';
				}

				$string_job .= '<div class="job__body">';
				$string_job .= '<div class="details">';

				$string_job .= '<h2 class="title"><a class="bold a-color" data-controller="utm-tracking" href="' . site_url("recruitment/recruitment_portal/job_detail/" . $rec_value['cp_id']) . '">' . $rec_value['campaign_name'] . '</a>';
				$string_job .= '</h2>';

				$string_job .= '<div class="salary not-signed-in">';

				$string_job .= '<a class="view-salary text-muted " data-toggle="modal" data-target="#sign-in-modal" rel="nofollow" href="#">' . _l($rec_value['company_name']) . '</a>';
				$string_job .= '</div>';

				$string_job .= '<div class="salary not-signed-in">';

				$string_job .= '<div class="job-bottom">';
				$string_job .= '<div class="tag-list ">';
				if ($rec_value['cp_form_work']) {
					$string_job .= '<a class="job__skill ilabel mkt-track ' . $rec_value['cp_form_work'] . '-color" data-controller="utm-tracking" href="#">
                                                                    <span>
                                                                    ' . _l($rec_value['cp_form_work']) . '
                                                                    </span>
                                                                </a>';
				}

				$string_job .= '<a class="job__skill ilabel-cp-workplace  mkt-track " data-controller="utm-tracking" href="#">

                                                                <span> - ' . $rec_value['cp_workplace'] . '</span>
                                                           		</a>';

				$string_job .= '</div>';

				$string_job .= '</div>';

				$string_job .= '</div>';

				$string_job .= '<div class="salary not-signed-in">';

				$string_job .= '<h5 class="view-salary bold " data-toggle="modal" data-target="#sign-in-modal" rel="nofollow" href="#">' . _l($rec_value['position_name']) . '</h5>';
				$string_job .= '</div>';

				$string_job .= '<div class="job-description">';

				$string_job .= '<p>' . $rec_value['cp_job_description'] . ' ...' . '</p>';
				$string_job .= '</div>';

				$string_job .= '</div>';
				$string_job .= '</div>';

				$string_job .= '</div>';

				$string_job .= '<div class="city_and_posted_date hidden-xs col-md-3">';

				$string_job .= '<div class="feature-view_detail new text ">';
				$string_job .= '<a class="bold a-color text-uppercase" data-controller="utm-tracking" href="' . site_url('recruitment/recruitment_portal/job_detail/' . $rec_value['cp_id']) . '">' . _l('view_detail') . '</a>';
				$string_job .= '</div>';

				if (strtotime(date("Y-m-d")) > strtotime($rec_value['cp_to_date'])) {
					$string_job .= '<div class="feature new text ">' . _l('overdue') . '</div>';
				} else {
					$string_job .= '<div class=""></div>';
				}

				$string_job .= '<div class="distance-time-job-posted">';
				$string_job .= '<span class="distance-time highlight">' .
					$rec_value['cp_from_date'] . ' - ' . $rec_value['cp_to_date'] . '
                                </span>';
				$string_job .= '</div>';

				$string_job .= '</div>';
				$string_job .= '</div>';
				$string_job .= '</div>';

				$string_job .= '</div>';
				$string_job .= '</div> ';

				$string_job .= '</div>';
			}

			$status = true;
		} else {

			$status = false;
		}

		$data = [];
		$data['value'] = $string_job;
		$data['status'] = $status;
		$data['page'] = (int) $page + 1;

		return $data;
	}

	/**
	 * list position by campaign
	 * @param  integer $campaingn_id
	 * @return string
	 */
	public function list_position_by_campaign($campaingn_id)
	{
		$options = '';
		if ($campaingn_id) {
			$this->db->where('cp_id', $campaingn_id);
			$rec_campaign = $this->db->get(db_prefix() . 'rec_campaign')->row();
			if ($rec_campaign) {
				$position = $this->get_job_position($rec_campaign->cp_position);
				if ($position) {
					$options .= '<option value=""></option>';
					$options .= '<option value="' . $position->position_id . '">' . $position->position_name . '</option>';
				}
			}
		} else {
			$position = $this->get_job_position();
			if (count($position) > 0) {
				$options .= '<option value=""></option>';

				foreach ($position as $po_value) {
					$options .= '<option value="' . $po_value['position_id'] . '">' . $po_value['position_name'] . '</option>';
				}
			}
		}
		return $options;
	}

	/**
	 * { recruitment campaign setting }
	 *
	 * @param      <type>   $data   The data
	 *
	 * @return     boolean
	 */
	public function recruitment_campaign_setting($data)
	{
		$val = $data['input_name_status'] == 'true' ? 1 : 0;
		$this->db->where('name', $data['input_name']);
		$this->db->update(db_prefix() . 'options', [
			'value' => $val,
		]);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function tab_display_setting_reward($data)
	{

		$val = $data['input_name_status'] == 'true' ? 1 : 0;
		$this->db->where('name', $data['input_name']);
		$this->db->update(db_prefix() . 'options', [
			'value' => $val,
		]);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function tab_expiration_date_setting($data)
	{
		$val = $data['recruitment_tab_expiration_date_setting'];
		$this->db->where('name', 'recruitment_tab_expiration_date_setting');
		$this->db->update(db_prefix() . 'options', [
			'value' => $val,
		]);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function tab_display_setting_medical($data)
	{
		$val = $data['input_name_status'] == 'true' ? 1 : 0;
		$this->db->where('name', $data['input_name']);
		$this->db->update(db_prefix() . 'options', [
			'value' => $val,
		]);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function tab_display_setting_psc($data)
	{
		$val = $data['input_name_status'] == 'true' ? 1 : 0;
		$this->db->where('name', $data['input_name']);
		$this->db->update(db_prefix() . 'options', [
			'value' => $val,
		]);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	/**
	 * get skill
	 * @param  boolean $id
	 * @return object
	 */
	public function get_company($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'rec_company')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tblrec_company')->result_array();
		}
	}

	/**
	 * add skill
	 * @param object $data
	 */
	public function add_company($data)
	{
		$this->db->insert(db_prefix() . 'rec_company', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update skill
	 * @param  object $data
	 * @param  int $id
	 * @return bool
	 */
	public function update_company($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_company', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete skill
	 * @param  int $id
	 * @return bool
	 */
	public function delete_company($id)
	{

		/*delete file*/
		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_company');

		$array_file = $this->db->get(db_prefix() . 'files')->result_array();
		if (count($array_file) > 0) {
			foreach ($array_file as $key => $file_value) {
				$this->delete_company_file($file_value['id']);
			}
		}

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'rec_company');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * get company attachments
	 * @param  integer $company_id
	 * @return array
	 */
	public function get_company_attachments($company_id)
	{

		$this->db->order_by('dateadded', 'desc');
		$this->db->where('rel_id', $company_id);
		$this->db->where('rel_type', 'rec_company');

		return $this->db->get(db_prefix() . 'files')->result_array();
	}

	/**
	 * delete company file
	 * @param  integer $attachment_id
	 * @return boolean
	 */
	public function delete_company_file($attachment_id)
	{
		$deleted = false;
		$attachment = $this->get_company_attachments_delete($attachment_id);

		if ($attachment) {
			if (empty($attachment->external)) {
				if (file_exists(RECRUITMENT_COMPANY_UPLOAD . $attachment->rel_id . '/' . $attachment->file_name)) {
					unlink(RECRUITMENT_COMPANY_UPLOAD . $attachment->rel_id . '/' . $attachment->file_name);
				} else {
					unlink('modules/recruitment/uploads/company_images/' . $attachment->rel_id . '/' . $attachment->file_name);
				}
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete(db_prefix() . 'files');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
				log_activity('commodity Attachment Deleted [commodityID: ' . $attachment->rel_id . ']');
			}
			if (file_exists(RECRUITMENT_COMPANY_UPLOAD . $attachment->rel_id . '/' . $attachment->file_name)) {
				if (is_dir(RECRUITMENT_COMPANY_UPLOAD . $attachment->rel_id)) {
					// Check if no attachments left, so we can delete the folder also
					$other_attachments = list_files(RECRUITMENT_COMPANY_UPLOAD . $attachment->rel_id);
					if (count($other_attachments) == 0) {
						// okey only index.html so we can delete the folder also
						delete_dir(RECRUITMENT_COMPANY_UPLOAD . $attachment->rel_id);
					}
				}
			} else {
				if (is_dir('modules/recruitment/uploads/company_images/' . $attachment->rel_id)) {
					$other_attachments = list_files('modules/recruitment/uploads/company_images/' . $attachment->rel_id);
					if (count($other_attachments) == 0) {
						delete_dir('modules/recruitment/uploads/company_images/' . $attachment->rel_id);
					}
				}
			}
		}

		return $deleted;
	}

	/**
	 * get company attachments delete
	 * @param  integer $id
	 * @return object
	 */
	public function get_company_attachments_delete($id)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'files')->row();
		}
	}

	/**
	 * get industry
	 * @param  boolean $id
	 * @return array
	 */
	public function get_industry($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_industry')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_industry')->result_array();
		}
	}

	/**
	 * get industry
	 * @param  boolean $id
	 * @return array
	 */
	public function get_department($id = false)
	{

		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_department')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_department')->result_array();
		}
	}

	/**
	 * get industry
	 * @param  boolean $id
	 * @return array
	 */
	public function get_status($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_status')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_status')->result_array();
		}
	}

	/**
	 * get rank
	 * @param  boolean $id
	 * @return array
	 */
	public function get_rank($id = false)
	{

		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_rank')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_rank')->result_array();
		}
	}

	/**
	 * get vessel
	 * @param  boolean $id
	 * @return array
	 */
	public function get_vessel($id = false)
	{

		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_vessel')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_vessel')->result_array();
		}
	}

	/**
	 * get vessel name
	 * @param  boolean $id
	 * @return array
	 */
	public function get_vessel_name($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_vessel_name')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_vessel_name')->result_array();
		}
	}

	/**
	 * get duty
	 * @param  boolean $id
	 * @return array
	 */
	public function get_duty($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_duty')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_duty')->result_array();
		}
	}

	public function get_status_application($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			$this->db->order_by('order_no', 'asc');
			return $this->db->get(db_prefix() . 'job_followup')->row();
		}

		if ($id == false) {
			$this->db->order_by('order_no', 'desc');
			return $this->db->query('select * from tbljob_followup')->result_array();
		}
	}

	/**
	 * get course
	 * @param  boolean $id
	 * @return array
	 */
	public function get_course_type($id = false)
	{

		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_course')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_course')->result_array();
		}
	}

	/**
	 * get kind
	 * @param  boolean $id
	 * @return array
	 */
	public function get_kind_license_type($id = false)
	{

		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_kind')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_kind')->result_array();
		}
	}

	/**
	 * get kind
	 * @param  boolean $id
	 * @return array
	 */
	public function get_kind_document_type($id = false)
	{

		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_kind_document')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_kind_document')->result_array();
		}
	}

	/**
	 * get kind
	 * @param  boolean $id
	 * @return array
	 */
	public function get_emp_status_list($id = false)
	{

		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_emp_status')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tbljob_emp_status')->result_array();
		}
	}

	/**
	 * get kind flag
	 * @param  boolean $id
	 * @return array
	 */
	public function get_kind_flag_type($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_kind_flag')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tbljob_kind_flag')->result_array();
		}
	}

	public function get_request_renew($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'request_renew_list')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tblrequest_renew_list')->result_array();
		}
	}

	/**
	 * get relation list
	 * @param  boolean $id
	 * @return array
	 */
	public function get_relation_list($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_relation_filed')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tbljob_relation_filed')->result_array();
		}
	}

	/**
	 * get marital status list
	 * @param  boolean $id
	 * @return array
	 */
	public function get_marital_status_list($id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'job_marital_status')->row();
		}
		if ($id == false) {
			return $this->db->query('select * from tbljob_marital_status')->result_array();
		}
	}


	/**
	 * add industry
	 * @param array $data
	 */
	public function add_industry($data)
	{
		$this->db->insert(db_prefix() . 'job_industry', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update industry
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_industry($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_industry', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete industry
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_industry($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_industry');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add department
	 * @param array $data
	 */
	public function add_department($data)
	{
		$this->db->insert(db_prefix() . 'job_department', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update department
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_department($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_department', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete department
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_department($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_department');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete department
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_vessel($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_vessel');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add rank
	 * @param array $data
	 */
	public function add_rank($data)
	{
		$this->db->insert(db_prefix() . 'job_rank', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * add vessel
	 * @param array $data
	 */
	public function add_vessel_type($data)
	{
		$this->db->insert(db_prefix() . 'job_vessel', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update rank
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_rank($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_rank', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}


	/**
	 * update marital_status
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_marital_status_filed($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_marital_status', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * update relation
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_relation_filed($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_relation_filed', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete rank
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_rank($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_rank');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * delete marital status
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_marital_status($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_marital_status');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete relation
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_relation($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_relation_filed');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}


	/**
	 * add course
	 * @param array $data
	 */
	public function add_course_type($data)
	{
		$this->db->insert(db_prefix() . 'job_course', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update rank
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_course_type($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_course', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * update vessel
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_vessel_type($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_vessel', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete rank
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_course($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_course');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}


	/**
	 * add status
	 * @param array $data
	 */
	public function add_status($data)
	{
		$this->db->insert(db_prefix() . 'job_status', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update status
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_status($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_status', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete status
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_status($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_status');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get rec campaign detail
	 * @param  integer $id
	 * @return  object
	 */
	public function get_rec_campaign_detail($id)
	{
		$this->db->where('cp_id', $id);
		$rec_campaign = $this->db->get(db_prefix() . 'rec_campaign')->row();

		if ($rec_campaign) {
			/*get rec job position*/
			$this->db->where('position_id', $rec_campaign->cp_position);
			$rec_job_position = $this->db->get(db_prefix() . 'rec_job_position')->row();
			$rec_campaign->position_name = '';
			$rec_campaign->position_description = '';
			$rec_campaign->industry_name = '';
			$rec_campaign->industry_description = '';
			$rec_campaign->company_name = '';
			$rec_campaign->company_description = '';
			$rec_campaign->company_address = '';
			$rec_campaign->company_industry = '';
			$rec_campaign->company_logo = RECRUITMENT_PATH . 'no_logo.jpg';
			$rec_campaign->alt_logo = 'no_logo.jpg';

			if ($rec_job_position) {
				$rec_campaign->position_name = $rec_job_position->position_name;
				$rec_campaign->position_description = $rec_job_position->position_description;

				/*get job industry*/
				$this->db->where('id', $rec_job_position->industry_id);
				$rec_job_industry = $this->db->get(db_prefix() . 'job_industry')->row();

				if ($rec_job_industry) {
					$rec_campaign->industry_name = $rec_job_industry->industry_name;
					$rec_campaign->industry_description = $rec_job_industry->industry_description;
				}

				/*get job skill*/
				if ($rec_job_position->job_skill) {

					$this->db->where('id IN ' . '(' . $rec_job_position->job_skill . ')');
					$rec_job_skill = $this->db->get(db_prefix() . 'rec_skill')->result_array();

					$rec_campaign->rec_job_skill = $rec_job_skill;
				}

				/*get job company*/
				$this->db->where('id', $rec_campaign->company_id);
				$rec_company = $this->db->get(db_prefix() . 'rec_company')->row();

				if ($rec_company) {
					$rec_campaign->company_name = $rec_company->company_name;
					$rec_campaign->company_description = $rec_company->company_description;
					$rec_campaign->company_address = $rec_company->company_address;
					$rec_campaign->company_industry = $rec_company->company_industry;

					/*get company logo*/
					$this->db->where('rel_id', $rec_campaign->company_id);
					$this->db->where('rel_type', "rec_company");
					$logo = $this->db->get(db_prefix() . 'files')->row();
					if ($logo) {
						$rec_campaign->company_logo = RECRUITMENT_PATH . '/company_images/' . $rec_campaign->company_id . '/' . $logo->file_name;
						$rec_campaign->alt_logo = $logo->file_name;
					}

					/*get job in company*/
					$this->db->select('*,' . db_prefix() . 'rec_campaign.company_id');
					$this->db->from(db_prefix() . 'rec_campaign');

					$this->db->join(db_prefix() . 'rec_job_position', '' . db_prefix() . 'rec_job_position.position_id = ' . db_prefix() . 'rec_campaign.cp_position', 'left');

					$this->db->join(db_prefix() . 'rec_company', '' . db_prefix() . 'rec_campaign.company_id = ' . db_prefix() . 'rec_company.id', 'left');

					$this->db->join(db_prefix() . 'job_industry', '' . db_prefix() . 'rec_job_position.industry_id = ' . db_prefix() . 'job_industry.id', 'left');

					$this->db->where(db_prefix() . 'rec_campaign.company_id', $rec_company->id);
					$this->db->where('cp_id !=', $id);
					$this->db->where('cp_status =', '3');

					$this->db->order_by('cp_id', 'desc');
					$this->db->limit(10);

					$job_in_company = $this->db->get()->result_array();
					/*get company logo*/
					foreach ($job_in_company as $key => $value) {
						$job_in_company[$key]['company_logo'] = RECRUITMENT_PATH . 'no_logo.jpg';
						$job_in_company[$key]['alt_logo'] = 'no_logo.jpg';

						if (($value['company_id'] != '') && ($value['company_id'] != 0)) {
							$this->db->where('rel_id', $value['company_id']);
							$this->db->where('rel_type', "rec_company");
							$logo = $this->db->get(db_prefix() . 'files')->row();
							if ($logo) {
								$job_in_company[$key]['company_logo'] = RECRUITMENT_PATH . '/company_images/' . $value['company_id'] . '/' . $logo->file_name;
								$job_in_company[$key]['alt_logo'] = $logo->file_name;
							}
						}
					}
					$rec_campaign->job_in_company = $job_in_company;
				}
			}
		}
		return $rec_campaign;
	}

	/**
	 * portal send mail to friend
	 * @param  [type] $data
	 * @return [type]
	 */
	public function portal_send_mail_to_friend($data)
	{
		$inbox['body'] = _strip_tags($data['content']);
		$inbox['body'] = nl2br_save_html($inbox['body']);

		$ci = &get_instance();
		$ci->email->initialize();
		$ci->load->library('email');
		$ci->email->clear(true);

		if (strlen(get_option('smtp_host_sms_email')) > 0 && strlen(get_option('smtp_password_sms_email')) > 0 && strlen(get_option('smtp_username_sms_email'))) {

			$ci->email->from(get_option('smtp_email_sms_email'), get_option('companyname'));
		} else {
			$ci->email->from(get_option('smtp_email'), get_option('companyname'));
		}

		$ci->email->to($data['email']);

		$ci->email->message(get_option('email_header') . $inbox['body'] . get_option('email_footer'));

		$ci->email->subject(_strip_tags($data['subject']));

		if ($ci->email->send(true)) {
			return true;
		}
	}

	public function get_tranfer_personnel_file($id)
	{
		$data = [];
		$arr_file = $this->re_get_attachments_file($id, 'rec_set_transfer');

		$htmlfile = '';
		//get file attachment html
		if (isset($arr_file)) {
			$htmlfile = '<div class="row col-md-12" id="attachment_file">';
			foreach ($arr_file as $attachment) {
				$href_url = site_url('modules/recruitment/uploads/set_transfer/' . $attachment['rel_id'] . '/' . $attachment['file_name']) . '" download';
				if (!empty($attachment['external'])) {
					$href_url = $attachment['external_link'];
				}
				$htmlfile .= '<div class="display-block contract-attachment-wrapper">';
				$htmlfile .= '<div class="col-md-10">';
				$htmlfile .= '<div class="col-md-1 mr-5">';
				$htmlfile .= '<a name="preview-btn" onclick="preview_file_tranfer_personnel(this); return false;" rel_id = "' . $attachment['rel_id'] . '" id = "' . $attachment['id'] . '" href="Javascript:void(0);" class="mbot10 btn btn-success pull-left" data-toggle="tooltip" title data-original-title="' . _l("preview_file") . '">';
				$htmlfile .= '<i class="fa fa-eye"></i>';
				$htmlfile .= '</a>';
				$htmlfile .= '</div>';
				$htmlfile .= '<div class=col-md-9>';
				$htmlfile .= '<div class="pull-left"><i class="' . get_mime_class($attachment['filetype']) . '"></i></div>';
				$htmlfile .= '<a href="' . $href_url . '>' . $attachment['file_name'] . '</a>';
				$htmlfile .= '<p class="text-muted">' . $attachment["filetype"] . '</p>';
				$htmlfile .= '</div>';
				$htmlfile .= '</div>';
				$htmlfile .= '<div class="col-md-2 text-right">';
				if (is_admin() || hrm_permissions('recruitment', '', 'delete')) {
					$htmlfile .= '<a href="#" class="text-danger" onclick="delete_tranfer_personnel_attachment(this,' . $attachment['id'] . '); return false;"><i class="fa fa fa-times"></i></a>';
				}
				$htmlfile .= '</div>';
				$htmlfile .= '<div class="clearfix"></div><hr/>';
				$htmlfile .= '</div>';
			}
			$htmlfile .= '</div>';
		}

		$data['htmlfile'] = $htmlfile;

		return $data;
	}

	/**
	 * re get attachments file
	 * @param  [type] $rel_id
	 * @param  [type] $rel_type
	 * @return [type]
	 */
	public function re_get_attachments_file($rel_id, $rel_type, $id = false)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			$this->db->where('rel_type', $rel_type);
			$result = $this->db->get(db_prefix() . 'files');
			return $result->row();
		}

		if ($id == false) {
			$this->db->order_by('dateadded', 'desc');
			$this->db->where('rel_id', $rel_id);
			$this->db->where('rel_type', $rel_type);
			return $this->db->get(db_prefix() . 'files')->result_array();
		}
	}

	/**
	 * delete transfer personnal attachment file
	 * @param  [type] $attachment_id
	 * @return [type]
	 */
	public function delete_transfer_personnal_attachment_file($id)
	{
		$attachment = $this->re_get_attachments_file('', 'rec_set_transfer', $id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $attachment->rel_id);
				}
			}
		}

		return $deleted;
	}

	/**
	 * rec add staff
	 * @param  [type] $data
	 * @return [type]
	 */
	public function rec_add_staff($data)
	{
		$data['birthday'] = to_sql_date($data['birthday']);
		$data['days_for_identity'] = to_sql_date($data['days_for_identity']);
		if (isset($data['fakeusernameremembered'])) {
			unset($data['fakeusernameremembered']);
		}
		if (isset($data['fakepasswordremembered'])) {
			unset($data['fakepasswordremembered']);
		}
		if (isset($data['DataTables_Table_3_length'])) {
			unset($data['DataTables_Table_3_length']);
		}
		if (isset($data['DataTables_Table_1_length'])) {
			unset($data['DataTables_Table_1_length']);
		}
		if (isset($data['DataTables_Table_2_length'])) {
			unset($data['DataTables_Table_2_length']);
		}
		if (isset($data['DataTables_Table_11_length'])) {
			unset($data['DataTables_Table_11_length']);
		}
		if (isset($data['DataTables_Table_12_length'])) {
			unset($data['DataTables_Table_12_length']);
		}
		if (isset($data['DataTables_Table_13_length'])) {
			unset($data['DataTables_Table_13_length']);
		}
		// First check for all cases if the email exists.
		$this->db->where('email', $data['email']);
		$email = $this->db->get(db_prefix() . 'staff')->row();
		if ($email) {
			die('Email already exists');
		}
		$data['admin'] = 0;
		if (is_admin()) {
			if (isset($data['administrator'])) {
				$data['admin'] = 1;
				unset($data['administrator']);
			}
		}

		$send_welcome_email = true;
		$original_password = $data['password'];
		if (!isset($data['send_welcome_email'])) {
			$send_welcome_email = false;
		} else {
			unset($data['send_welcome_email']);
		}

		$data['password'] = app_hash_password($data['password']);
		$data['datecreated'] = date('Y-m-d H:i:s');
		if (isset($data['departments'])) {
			$departments = $data['departments'];
			unset($data['departments']);
		}

		$permissions = [];
		if (isset($data['permissions'])) {
			$permissions = $data['permissions'];
			unset($data['permissions']);
		}

		if (isset($data['custom_fields'])) {
			$custom_fields = $data['custom_fields'];
			unset($data['custom_fields']);
		}
		if (isset($data['nationality'])) {
			unset($data['nationality']);
		}
		if ($data['admin'] == 1) {
			$data['is_not_staff'] = 0;
		}

		$this->db->insert(db_prefix() . 'staff', $data);
		$data['lastname'] = '';
		$staffid = $this->db->insert_id();
		if ($staffid) {
			$slug = $data['firstname'] . ' ' . $data['lastname'];

			if ($slug == ' ') {
				$slug = 'unknown-' . $staffid;
			}

			if ($send_welcome_email == true) {
				send_mail_template('staff_created', $data['email'], $staffid, $original_password);
			}

			$this->db->where('staffid', $staffid);
			$this->db->update(db_prefix() . 'staff', [
				'media_path_slug' => slug_it($slug),
			]);

			if (isset($custom_fields)) {
				handle_custom_fields_post($staffid, $custom_fields);
			}
			if (isset($departments)) {
				foreach ($departments as $department) {
					$this->db->insert(db_prefix() . 'staff_departments', [
						'staffid' => $staffid,
						'departmentid' => $department,
					]);
				}
			}

			// Delete all staff permission if is admin we dont need permissions stored in database (in case admin check some permissions)
			$this->rec_update_permissions($data['admin'] == 1 ? [] : $permissions, $staffid);

			log_activity('New Staff Member Added [ID: ' . $staffid . ', ' . $data['firstname'] . ' ' . $data['lastname'] . ']');

			// Get all announcements and set it to read.
			$this->db->select('announcementid');
			$this->db->from(db_prefix() . 'announcements');
			$this->db->where('showtostaff', 1);
			$announcements = $this->db->get()->result_array();
			foreach ($announcements as $announcement) {
				$this->db->insert(db_prefix() . 'dismissed_announcements', [
					'announcementid' => $announcement['announcementid'],
					'staff' => 1,
					'userid' => $staffid,
				]);
			}
			hooks()->do_action('staff_member_created', $staffid);
			return $staffid;
		}

		return false;
	}

	/**
	 * rec update permissions
	 * @param  [type] $permissions
	 * @param  [type] $id
	 * @return [type]
	 */
	public function rec_update_permissions($permissions, $id)
	{
		$this->db->where('staff_id', $id);
		$this->db->delete('staff_permissions');

		$is_staff_member = is_staff_member($id);

		foreach ($permissions as $feature => $capabilities) {
			foreach ($capabilities as $capability) {
				if ($feature == 'leads' && !$is_staff_member) {
					continue;
				}

				$this->db->insert('staff_permissions', ['staff_id' => $id, 'feature' => $feature, 'capability' => $capability]);
			}
		}
		return true;
	}

	/**
	 * candidate export pdf
	 * @param  [type] $export_candidate
	 * @return [type]
	 */
	public function candidate_export_pdf($export_candidate)
	{
		return app_pdf('export_candidate', module_dir_path(RECRUITMENT_MODULE_NAME, 'libraries/pdf/Export_candidate_pdf.php'), $export_candidate);
	}

	/**
	 * get candidate profile by id
	 * @param  [type] $ids
	 * @return [type]
	 */
	public function get_candidate_profile_by_id($ids)
	{
		$arr_id = implode(",", $ids);

		$this->db->where('id IN (' . $arr_id . ')');
		$candidates = $this->db->get(db_prefix() . 'rec_candidate')->result_array();

		$this->db->where('candidate IN (' . $arr_id . ')');
		$literacy = $this->db->get(db_prefix() . 'cd_literacy')->result_array();

		$candidate_literacy = [];
		foreach ($literacy as $value) {
			$candidate_literacy[$value['candidate']][] = $value;
		}

		$this->db->where('candidate IN (' . $arr_id . ')');
		$work_experience = $this->db->get(db_prefix() . 'cd_work_experience')->result_array();

		$candidate_experience = [];
		foreach ($work_experience as $w_value) {
			$candidate_experience[$w_value['candidate']][] = $w_value;
		}

		$this->db->where('rel_id IN (' . $arr_id . ')');
		$this->db->where('rel_type', 'rec_cadidate_avar');
		$result = $this->db->get(db_prefix() . 'files')->result_array();

		$cadidate_avatar = [];
		foreach ($result as $avatar) {
			$cadidate_avatar[$avatar['rel_id']] = $avatar;
		}

		/*get job skill*/

		$rec_job_skill = $this->db->get(db_prefix() . 'rec_skill')->result_array();
		$rec_skill = [];
		foreach ($rec_job_skill as $value) {
			$rec_skill[$value['id']] = $value['skill_name'];
		}

		//get job name by campaign
		$sql_where = 'SELECT cp.cp_id, jp.position_name FROM ' . db_prefix() . 'rec_campaign as cp
		left join ' . db_prefix() . 'rec_job_position as jp on cp.cp_position = jp.position_id
		';
		$campaigns = $this->db->query($sql_where)->result_array();

		$job_positions = [];
		foreach ($campaigns as $campaign) {
			$job_positions[$campaign['cp_id']] = $campaign['position_name'];
		}

		$data = [];
		$data['candidate'] = $candidates;
		$data['candidate_literacy'] = $candidate_literacy;
		$data['candidate_experience'] = $candidate_experience;
		$data['cadidate_avatar'] = $cadidate_avatar;
		$data['rec_skill'] = $rec_skill;
		$data['job_positions'] = $job_positions;

		return $data;
	}

	/**
	 * get last staff id
	 * @return [type]
	 */
	public function get_last_staff_id()
	{
		$sql_where = "SELECT * FROM " . db_prefix() . "staff
    	order by staffid desc
    	limit 1
    	;";

		$staff = $this->db->query($sql_where)->row();
		if ($staff) {
			return $staff->staffid;
		} else {
			return 1;
		}
	}

	/**
	 * get on_board_company
	 * @param  string $id
	 * @return object
	 */

	public function get_on_board_company($id = '')
	{
		$this->db->where('id', $id);
		$on_board_company_info = $this->db->get(db_prefix() . 'rec_on_board_company')->row();

		if (!$on_board_company_info) {
			return false;
		}
		return $on_board_company_info;
	}

	/**
	 * get on_board_other_company
	 * @param  string $id
	 * @return object
	 */

	public function get_on_board_other_company($id = '')
	{
		$this->db->where('id', $id);
		$on_board_other_company_info = $this->db->get(db_prefix() . 'rec_on_board_other_company')->row();

		if (!$on_board_other_company_info) {
			return false;
		}
		return $on_board_other_company_info;
	}

	/**
	 * get on_board_in_land
	 * @param  string $id
	 * @return object
	 */

	public function get_on_board_in_land($id = '')
	{
		$this->db->where('id', $id);
		$on_board_in_land_info = $this->db->get(db_prefix() . 'rec_on_board_in_land')->row();

		if (!$on_board_in_land_info) {
			return false;
		}
		return $on_board_in_land_info;
	}

	public function get_crew_transaction($id = '')
	{
		$this->db->where('id', $id);
		$care_transaction = $this->db->get(db_prefix() . 'cd_care')->row();

		if (!$care_transaction) {
			return false;
		}
		return $care_transaction;
	}
	/**
	 * add on_board_company
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function add_on_board_company($data)
	{

		$candidateid = $data['add_on_board_company_candidate_id'];
		if ($candidateid != '') {

			$rank = implode(',', $data['rank']);
			$vessel_type = implode(',', $data['vessel_type']);

			$cur_onboard = 0;
			if ($data['cur_onboard'] == 'on') {
				$cur_onboard = 1;

				// $vessel_name = get_select_option_name_by_id('job_vessel_name', $data['vessel_name'], 'vessel_info_name');

				// $department_id = $this->db->select('id')->where('department_name', $vessel_name)->get(db_prefix() . 'job_department')->row();

				// if (isset($department_id->id)) {
				// 	$response = $department_id->id;
				// } else {

				// 	$visel_name['department_name'] = $vessel_name;
				// 	$response = $this->add_department($visel_name);
				// }

				// $updated['department'] = $response;
				// $updated['emp_status'] = 2;
				// $updated['rank'] = $rank;
				// $this->db->where('id', $candidateid);
				// $this->db->update(db_prefix() . 'rec_candidate', $updated);
			}

			$sucess = $this->db->insert(db_prefix() . 'rec_on_board_company', [
				'candidate' => $candidateid,
				'vessel_name' => $data['vessel_name'],
				'grade_rank' => $data['grade_rank'],
				'rank' => $rank,
				'vessel_type' => $vessel_type,
				'gross_ton' => $data['gross_ton'],
				'engine_type' => $data['engine_type'],
				'eng_output' => $data['eng_output'],
				'embarkation_date' => to_sql_date($data['embarkation_date']),
				'disembarkation_date' => to_sql_date($data['disembarkation_date']),
				'cur_onboard' => $cur_onboard,
				'boarding_period' => $data['boarding_period'],
				'ramaining_days' => $data['ramaining_days'],
				'calculation_y_n' => $data['calculation_y_n'],
				'emp_no' => $data['emp_no'],
				'employment' => $data['employment'],
				'ship_owner' => $data['ship_owner'],
				'employer' => $data['employer'],
			]);

			if ($sucess) {
				$get_onborad_status = $this->recruitment_model->get_latest_onborad_record($candidateid);
				if ($get_onborad_status['cur_onboard'] != 1) {
					$status_on_board['emp_status'] = 1;
					$status_on_board['department'] = '';
					$status_on_board['rank'] = $get_onborad_status['rank'];
					$this->recruitment_model->update_vessel_emp_status($status_on_board, $candidateid);
				} else {

					$vessel_name = get_select_option_name_by_id('job_vessel_name', $get_onborad_status['vessel_name'], 'vessel_info_name');

					$department_id = $this->db->select('id')->where('department_name', $vessel_name)->get(db_prefix() . 'job_department')->row();

					if (isset($department_id->id)) {
						$response = $department_id->id;
					} else {
						$department_data['department_name'] = $vessel_name;
						$response = $this->add_department($department_data);
					}

					$status_on_board['emp_status'] = 2;
					$status_on_board['department'] = $response;
					$status_on_board['rank'] = $get_onborad_status['rank'];
					$this->recruitment_model->update_vessel_emp_status($status_on_board, $candidateid);
				}
				return true;
			}
			return true;
		}
		return false;
	}

	/**
	 * add on_board_other_company
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function add_on_board_other_company($data)
	{
		$candidateid = $data['add_on_board_other_company_candidate_id'];
		$cur_onboard_other = 0;
		if ($data['cur_onboard_other'] == 'on') {
			$cur_onboard_other = 1;
		}

		$rank = implode(',', $data['rank_other']);
		$vessel_type = implode(',', $data['vessel_type']);

		if ($candidateid != '') {
			$this->db->insert(db_prefix() . 'rec_on_board_other_company', [
				'candidate' => $candidateid,
				'rank' => $rank,
				'grade_rank_duty_other' => $data['grade_rank_duty_other'],
				'company_name' => $data['company_name'],
				'vessel_name' => $data['vessel_name'],
				'vessel_type' => $vessel_type,
				'gross_ton' => $data['gross_ton'],
				'engine_type' => $data['engine_type'],
				'eng_output' => $data['eng_output'],
				'sailing_area' => $data['sailing_area'],
				'embarkation_date' => to_sql_date($data['embarkation_other_date']),
				'disembarkation_date' => to_sql_date($data['disembarkation_other_date']),
				'boarding_period' => $data['boarding_other_period'],
				'approval_rate' => $data['approval_rate'],
				'cur_onboard' => $cur_onboard_other,
				'remark' => $data['remark'],
			]);
			return true;
		}
		return false;
	}

	/**
	 * add on_board_in_land
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function add_on_board_in_land($data)
	{
		$candidateid = $data['add_on_board_in_land_candidate_id'];
		if ($candidateid != '') {
			$this->db->insert(db_prefix() . 'rec_on_board_in_land', [
				'candidate' => $candidateid,
				'company_name' => $data['company_name'],
				'hire_date' =>  to_sql_date($data['hire_date']),
				'resignation_date' => to_sql_date($data['resignation_date']),
				'work_dep' => $data['work_dep'],
				'responsibility_work' => $data['responsibility_work'],
				'final_position' => $data['final_position'],
				'retire_reason' => $data['retire_reason'],
				'other_company_career' => $data['other_company_career'],
				'remark' => $data['remark'],
			]);
			return true;
		}
		return false;
	}

	/**
	 * update on_board_company
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_on_board_company($data)
	{
		$id = $data['on_board_company_id'];
		$candidateid = $data['add_on_board_company_candidate_id'];
		$cur_onboard = 0;
		if ($data['cur_onboard'] == 'on') {
			$cur_onboard = 1;
		}
		$updated['vessel_name'] = $data['vessel_name'];
		$updated['grade_rank'] = $data['grade_rank'];
		$updated['rank'] = implode(',', $data['rank']);
		$updated['vessel_type'] = implode(',', $data['vessel_type']);
		$updated['gross_ton'] = $data['gross_ton'];
		$updated['engine_type'] = $data['engine_type'];
		$updated['eng_output'] = $data['eng_output'];
		$updated['embarkation_date'] = to_sql_date($data['embarkation_date']);
		$updated['disembarkation_date'] = to_sql_date($data['disembarkation_date']);
		$updated['cur_onboard'] = $cur_onboard;
		$updated['boarding_period'] = $data['boarding_period'];
		$updated['ramaining_days'] = $data['ramaining_days'];
		$updated['calculation_y_n'] = $data['calculation_y_n'];
		$updated['emp_no'] = $data['emp_no'];
		$updated['employment'] = $data['employment'];
		$updated['ship_owner'] = $data['ship_owner'];
		$updated['employer'] = $data['employer'];

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_on_board_company', $updated);

		// if ($data['cur_onboard'] == 'on') {

		// 	$viesel_id = get_viesel_name_id($candidateid);
		// 	$vessel_name = get_select_option_name_by_id('job_vessel_name', $viesel_id, 'vessel_info_name');

		// 	$department_id = $this->db->select('id')->where('department_name', $vessel_name)->get(db_prefix() . 'job_department')->row();

		// 	if (isset($department_id->id)) {
		// 		$response = $department_id->id;
		// 	} else {
		// 		$department_data['department_name'] = $vessel_name;
		// 		$response = $this->add_department($department_data);
		// 	}
		// 	$updated_c['department'] = $response;
		// 	$updated_c['emp_status'] = 2;
		// 	$updated_c['rank'] = implode(',', $data['rank']);

		// 	$this->db->where('id', $candidateid);
		// 	$this->db->update(db_prefix() . 'rec_candidate', $updated_c);
		// }

		if ($success) {
			// $get_onborad_status = $this->recruitment_model->get_onborad_status($candidateid);

			// if ($get_onborad_status->cur_onboard != 1) {
			// 	$status_on_board['emp_status'] = 1;
			// 	$status_on_board['department'] = '';
			// 	$this->recruitment_model->update_vessel_emp_status($status_on_board, $candidateid);
			// }

			$get_onborad_status = $this->recruitment_model->get_latest_onborad_record($candidateid);
			if ($get_onborad_status['cur_onboard'] != 1) {
				$status_on_board['emp_status'] = 1;
				$status_on_board['department'] = '';
				$status_on_board['rank'] = $get_onborad_status['rank'];
				$this->recruitment_model->update_vessel_emp_status($status_on_board, $candidateid);
			} else {

				$vessel_name = get_select_option_name_by_id('job_vessel_name', $get_onborad_status['vessel_name'], 'vessel_info_name');

				$department_id = $this->db->select('id')->where('department_name', $vessel_name)->get(db_prefix() . 'job_department')->row();

				if (isset($department_id->id)) {
					$response = $department_id->id;
				} else {
					$department_data['department_name'] = $vessel_name;
					$response = $this->add_department($department_data);
				}

				$status_on_board['emp_status'] = 2;
				$status_on_board['department'] = $response;
				$status_on_board['rank'] = $get_onborad_status['rank'];
				$this->recruitment_model->update_vessel_emp_status($status_on_board, $candidateid);
			}
			return true;
		}
		return true;
	}

	public function add_emp_status($data)
	{
		$this->db->insert(db_prefix() . 'job_emp_status', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_crew_transaction($data)
	{
		$id = $data['hid'];

		$updated['care_time'] = _d($data['care_time']);
		$updated['care_result'] = $data['care_result'];
		$updated['description'] = $data['description'];
		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'cd_care', $updated);
	}

	/**
	 * update on_board_other_company
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_on_board_other_company($data)
	{
		$id = $data['on_board_other_company_id'];
		$cur_onboard_other = 0;
		if ($data['cur_onboard_other'] == 'on') {
			$cur_onboard_other = 1;
		}

		$updated['rank'] = implode('', $data['rank_other']);
		$updated['grade_rank_duty_other'] = $data['grade_rank_duty_other'];
		$updated['company_name'] = $data['company_name'];
		$updated['vessel_name'] = $data['vessel_name'];
		$updated['vessel_type'] = implode('', $data['vessel_type']);
		$updated['gross_ton'] = $data['gross_ton'];
		$updated['engine_type'] = $data['engine_type'];
		$updated['eng_output'] = $data['eng_output'];
		$updated['sailing_area'] = $data['sailing_area'];
		$updated['embarkation_date'] = to_sql_date($data['embarkation_other_date']);
		$updated['disembarkation_date'] = to_sql_date($data['disembarkation_other_date']);
		$updated['boarding_period'] = $data['boarding_other_period'];
		$updated['cur_onboard'] = $cur_onboard_other;
		$updated['approval_rate'] = $data['approval_rate'];
		$updated['remark'] = $data['remark'];

		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_on_board_other_company', $updated);

		if (!$success) {
			return true;
		}

		return true;
	}

	/**
	 * update on_board_in_land
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */
	public function update_on_board_in_land($data)
	{
		$id = $data['on_board_in_land_id'];
		$updated['company_name'] = $data['company_name'];
		$updated['hire_date'] = to_sql_date($data['hire_date']);
		$updated['resignation_date'] =  to_sql_date($data['resignation_date']);
		$updated['work_dep'] = $data['work_dep'];
		$updated['responsibility_work'] = $data['responsibility_work'];
		$updated['final_position'] = $data['final_position'];
		$updated['retire_reason'] = $data['retire_reason'];
		$updated['other_company_career'] = $data['other_company_career'];
		$updated['remark'] = $data['remark'];

		unset($data);

		$this->db->where('id', $id);
		$success = $this->db->update(db_prefix() . 'rec_on_board_in_land', $updated);

		if (!$success) {
			return true;
		}

		return true;
	}

	/**
	 * Delete on_board_company
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_on_board_company($id)
	{

		$this->db->select('candidate,cur_onboard');
		$this->db->where('id', $id);
		$this->db->from(db_prefix() . 'rec_on_board_company');
		$candidate = $this->db->get()->row_array();

		$candidateid = $candidate['candidate'];

		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_on_board_company');

		if ($delete) {

			$get_onborad_status = $this->recruitment_model->get_latest_onborad_record($candidateid);
			if ($get_onborad_status['cur_onboard'] != 1) {
				$status_on_board['emp_status'] = 1;
				$status_on_board['department'] = '';
				$status_on_board['rank'] = $get_onborad_status['rank'];
				$this->recruitment_model->update_vessel_emp_status($status_on_board, $candidateid);
			} else {

				$vessel_name = get_select_option_name_by_id('job_vessel_name', $get_onborad_status['vessel_name'], 'vessel_info_name');

				$department_id = $this->db->select('id')->where('department_name', $vessel_name)->get(db_prefix() . 'job_department')->row();

				if (isset($department_id->id)) {
					$response = $department_id->id;
				} else {
					$department_data['department_name'] = $vessel_name;
					$response = $this->add_department($department_data);
				}

				$status_on_board['emp_status'] = 2;
				$status_on_board['department'] = $response;
				$status_on_board['rank'] = $get_onborad_status['rank'];
				$this->recruitment_model->update_vessel_emp_status($status_on_board, $candidateid);
			}
		}
		return true;
	}

	public function get_latest_onborad_record($id)
	{
		$this->db->select('candidate, rank, cur_onboard, vessel_name, embarkation_date');
		$this->db->from(db_prefix() . 'rec_on_board_company');
		$this->db->where('candidate', $id);
		$this->db->order_by('embarkation_date', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}

	/**
	 * Delete on_board_other_company
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_on_board_other_company($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_on_board_other_company');

		if (!$delete) {
			return false;
		}
		return true;
	}

	public function deletecrewtransactionhistory($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('cd_care');

		if (!$delete) {
			return false;
		}
		return true;
	}

	/**
	 * Delete on_board_in_land
	 * @param  object $data
	 * @param  int $id
	 * @return
	 */

	public function delete_on_board_in_land($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('rec_on_board_in_land');

		if (!$delete) {
			return false;
		}
		return true;
	}

	public function check_date_validation($candidate_id)
	{
		$this->db->select('disembarkation_date');
		$this->db->where('candidate', $candidate_id);
		$this->db->from(db_prefix() . 'rec_on_board_company');
		$this->db->order_by('disembarkation_date', 'desc');
		return  $this->db->get()->row();
	}
	public function check_date_validation_edit($candidate_id, $id)
	{
		$this->db->select('disembarkation_date,');
		$this->db->where('id < ', $id);
		$this->db->where('candidate', $candidate_id);
		$this->db->from(db_prefix() . 'rec_on_board_company');
		$this->db->order_by('disembarkation_date', 'desc');
		return  $this->db->get()->row();
	}

	public function check_date_other_validation($candidate_id)
	{
		$this->db->select('disembarkation_date');
		$this->db->where('candidate', $candidate_id);
		$this->db->from(db_prefix() . 'rec_on_board_other_company');
		$this->db->order_by('disembarkation_date', 'desc');
		return  $this->db->get()->row();
	}
	public function check_date_other_validation_edit($candidate_id, $id)
	{
		$this->db->select('disembarkation_date');
		$this->db->where('id < ', $id);
		$this->db->where('candidate', $candidate_id);
		$this->db->from(db_prefix() . 'rec_on_board_other_company');
		$this->db->order_by('disembarkation_date', 'desc');
		return  $this->db->get()->row();
	}

	/**
	 * add kind
	 * @param array $data
	 */
	public function add_kind($data)
	{
		$this->db->insert(db_prefix() . 'job_kind', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * add relation
	 * @param array $data
	 */
	public function add_relation_filed($data)
	{
		$this->db->insert(db_prefix() . 'job_relation_filed', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * add marital status
	 * @param array $data
	 */
	public function add_marital_status_filed($data)
	{
		$this->db->insert(db_prefix() . 'job_marital_status', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * add kind document
	 * @param array $data
	 */
	public function add_kind_document($data)
	{
		$this->db->insert(db_prefix() . 'job_kind_document', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * add kind flag
	 * @param array $data
	 */
	public function add_kind_flag($data)
	{
		$this->db->insert(db_prefix() . 'job_kind_flag', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update kind
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_kind($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_kind', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/** 
	 * update emp status
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_emp_status($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_emp_status', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/** 
	 * update kind document
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_kind_document($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_kind_document', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/** 
	 * update kind flag
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_kind_flag($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_kind_flag', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete kind
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_kind($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_kind');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * delete kind document
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_kind_document($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_kind_document');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * delete kind document
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_kind_flag($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_kind_flag');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	public function tab_display_setting_hris($data)
	{
		$val = $data['input_name_status'] == 'true' ? 1 : 0;
		$this->db->where('name', $data['input_name']);
		$this->db->update(db_prefix() . 'options', [
			'value' => $val,
		]);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function tab_custom_filed_setting_details($data)
	{
		$val = $data['input_name_status'] == 'true' ? 1 : 0;
		$this->db->where('name', $data['input_name']);
		$this->db->update(db_prefix() . 'options', [
			'value' => $val,
		]);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * delete delete_duty_name
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_duty_name($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_duty');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}


	/**
	 * delete delete_vessel_name
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete_vessel_name($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'job_vessel_name');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * add vessel
	 * @param array $data
	 */
	public function add_vessel_name($data)
	{
		$this->db->insert(db_prefix() . 'job_vessel_name', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}


	/**
	 * add duty
	 * @param array $data
	 */
	public function add_duty($data)
	{
		$this->db->insert(db_prefix() . 'job_duty', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * add country
	 * @param array $data
	 */
	public function add_country($data)
	{
		$this->db->insert(db_prefix() . 'countries_new', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function add_followup($data)
	{
		$this->db->insert(db_prefix() . 'job_followup', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function add_city($data)
	{
		if ($data['country_id']) {
			unset($data['country_id']);
		}

		$this->db->insert(db_prefix() . 'cities_new', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function add_travel_setting($data)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->insert(db_prefix() . 'job_travel_identification', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function add_licence_3_setting($data)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->insert(db_prefix() . 'job_licence_3', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function add_licence_4_setting($data)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->insert(db_prefix() . 'job_licence_4', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function add_licence_5_setting($data)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->insert(db_prefix() . 'job_licence_5', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function add_licence_6_setting($data)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->insert(db_prefix() . 'job_licence_6', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function add_other_licence_setting($data)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->insert(db_prefix() . 'job_other_licence_identification', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function add_employee_setting($data)
	{
		$this->db->insert(db_prefix() . 'job_employee_contract', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function add_request_renew_filed($data)
	{
		$this->db->insert(db_prefix() . 'request_renew_list', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function update_travel_setting($data, $id)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_travel_identification', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_licence_3_setting($data, $id)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_licence_3', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_licence_4_setting($data, $id)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_licence_4', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_licence_5_setting($data, $id)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_licence_5', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_licence_6_setting($data, $id)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_licence_6', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}


	public function update_other_licence_setting($data, $id)
	{
		$data['no_expired'] = $data['no_expired'] == 'on' ? 1 : 0;
		$data['display_info'] = $data['display_info'] == 'on' ? 1 : 0;
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_other_licence_identification', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_employee_setting($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_employee_contract', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_request_renew_filed($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'request_renew_list', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * add country
	 * @param array $data
	 */
	public function add_state($data)
	{
		$this->db->insert(db_prefix() . 'states_new', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update country
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_country($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'countries_new', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_followup($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_followup', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_city($data, $id)
	{
		if ($data['country_id']) {
			unset($data['country_id']);
		}
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'cities_new', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_state($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'states_new', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}



	/**
	 * update duty
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_duty($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_duty', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}



	/**
	 * update vessel name
	 * @param  array $data
	 * @param  integer $id
	 * @return boolean
	 */
	public function update_vessel_name($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'job_vessel_name', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	// get country
	public function get_country()
	{
		$country =	$this->db->get('tblcountries_new')->result_array();
		if (!empty($country)) {
			return $country;
		} else {
			return [];
		}
	}

	// get travel
	public function get_travel()
	{
		$travel =	$this->db->get('job_travel_identification')->result_array();
		if (!empty($travel)) {
			return $travel;
		} else {
			return [];
		}
	}

	public function get_other_licence()
	{
		$travel =	$this->db->get('job_other_licence_identification')->result_array();
		if (!empty($travel)) {
			return $travel;
		} else {
			return [];
		}
	}

	public function get_licence_3()
	{
		$licence_3 =	$this->db->get('job_licence_3')->result_array();
		if (!empty($licence_3)) {
			return $licence_3;
		} else {
			return [];
		}
	}

	public function get_licence_4()
	{
		$licence_4 =	$this->db->get('job_licence_4')->result_array();
		if (!empty($licence_4)) {
			return $licence_4;
		} else {
			return [];
		}
	}

	public function get_licence_5()
	{
		$licence_5 =	$this->db->get('job_licence_5')->result_array();
		if (!empty($licence_5)) {
			return $licence_5;
		} else {
			return [];
		}
	}

	public function get_licence_6()
	{
		$licence_6 =	$this->db->get('job_licence_6')->result_array();
		if (!empty($licence_6)) {
			return $licence_6;
		} else {
			return [];
		}
	}

	public function get_document_by_id($id)
	{
		$this->db->where('id', $id);
		$document =	$this->db->get('job_travel_identification')->row_array();
		if (!empty($document)) {
			return $document['expiration_date'];
		} else {
			return [];
		}
	}

	public function get_travel_document_name_by_id($id)
	{
		$this->db->select('document_type');
		$this->db->where('id', $id);
		return $this->db->get('rec_travel_identification')->row_array();
	}

	public function get_other_license_document_name_by_id($id)
	{
		$this->db->select('document_type');
		$this->db->where('id', $id);
		return $this->db->get('rec_other_licence_identification')->row_array();
	}

	public function get_license_3_document_name_by_id($id)
	{
		$this->db->select('document_type');
		$this->db->where('id', $id);
		return $this->db->get('rec_licence_3')->row_array();
	}

	public function get_license_4_document_name_by_id($id)
	{
		$this->db->select('document_type');
		$this->db->where('id', $id);
		return $this->db->get('rec_licence_4')->row_array();
	}

	public function get_license_5_document_name_by_id($id)
	{
		$this->db->select('document_type');
		$this->db->where('id', $id);
		return $this->db->get('rec_licence_5')->row_array();
	}

	public function get_license_6_document_name_by_id($id)
	{
		$this->db->select('document_type');
		$this->db->where('id', $id);
		return $this->db->get('rec_licence_6')->row_array();
	}

	public function get_contract_emp()
	{
		$travel =	$this->db->get('job_employee_contract')->result_array();
		if (!empty($travel)) {
			return $travel;
		} else {
			return [];
		}
	}

	// get State
	public function get_state()
	{
		$state =	$this->db->get('tblstates_new')->result_array();
		if (!empty($state)) {
			return $state;
		} else {
			return [];
		}
	}

	// get City
	public function get_city()
	{
		$city =	$this->db->get('tblcities_new')->result_array();
		if (!empty($city)) {
			return $city;
		} else {
			return [];
		}
	}

	public function get_states_by_country($country_id)
	{
		if (is_numeric($country_id)) {
			$this->db->where('country_id', $country_id);
			$state =	$this->db->get('tblstates_new')->result_array();
			if (!empty($state)) {
				return $state;
			}
		}
		return [];
	}

	public function get_states_by_country_cities($country_id)
	{
		if (is_numeric($country_id)) {
			$this->db->where('country_id', $country_id);
			$state = $this->db->get('tblstates_new')->result_array();
			return !empty($state) ? $state : [];
		}
		return [];
	}


	// get_cities_by_state

	public function get_cities_by_state($state_id)
	{
		if (is_numeric($state_id)) {
			$this->db->where('state_id', $state_id);
			$cities =	$this->db->get('tblcities_new')->result_array();
			if (!empty($cities)) {
				return $cities;
			}
		}
		return [];
	}

	public function get_hire_carreer($candidate_id, $type = "")
	{
		$this->db->select("
		CONCAT(
			SUM(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(boarding_period, 'Y', 1), 'Y', -1) AS UNSIGNED)), 'Y ', 
			SUM(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(boarding_period, 'Y', -1), 'M', 1), 'M', -1) AS UNSIGNED)), 'M ', 
			SUM(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(boarding_period, 'M', -1), 'D', 1) AS UNSIGNED)), 'D'
		) AS total_boarding_period", false);
		$this->db->from(db_prefix() . 'rec_on_board_company');
		$this->db->where('candidate', $candidate_id);

		if ($type != '') {
			$this->db->where('vessel_type', $type);
		}

		$query = $this->db->get();

		return $query->row()->total_boarding_period;
	}

	public function tab_display_setting_recruitment_history($data)
	{
		$val = $data['input_name_status'] == 'true' ? 1 : 0;
		$this->db->where('name', $data['input_name']);
		$this->db->update(db_prefix() . 'options', [
			'value' => $val,
		]);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function tab_display_setting_capacity_profile($data)
	{
		$val = $data['input_name_status'] == 'true' ? 1 : 0;
		$this->db->where('name', $data['input_name']);
		$this->db->update(db_prefix() . 'options', [
			'value' => $val,
		]);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function tab_display_setting_promotion($data)
	{
		$val = $data['input_name_status'] == 'true' ? 1 : 0;
		$this->db->where('name', $data['input_name']);
		$this->db->update(db_prefix() . 'options', [
			'value' => $val,
		]);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_manning_agency($data)
	{
		$this->db->insert(db_prefix() . 'manning_agency', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function update_manning_agency($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'manning_agency', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function get_manning_agency()
	{
		$manning_agency = $this->db->get(db_prefix() . 'manning_agency')->result_array();
		if ($manning_agency) {
			return $manning_agency;
		}

		return [];
	}

	public function delete_manning_agency($id)
	{
		if (is_numeric($id) && $id > 0) {
			$this->db->where('id', $id);
			$this->db->delete(db_prefix() . 'manning_agency');
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	public function get_manning_agency_by_id($id)
	{
		if (is_numeric($id) && $id > 0) {
			$this->db->where('id', $id);
			$manning_agency =	$this->db->get(db_prefix() . 'manning_agency')->result_array();
			if (!empty($manning_agency)) {
				return $manning_agency;
			}
		}
		return [];
	}

	public function get_manning_agency_list($code_first = false)
	{
		if ($code_first) {
			$this->db->select('id, CONCAT(code, " - ", agency_name) AS manning_agency_name');
		} else {
			$this->db->select('id, CONCAT(agency_name, " - ", code) AS manning_agency_name');
		}
		$this->db->from(db_prefix() . 'manning_agency');
		$query = $this->db->get();
		$result = $query->result_array();
		if ($result) {
			return $result;
		}

		return [];
	}
}
