<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Crewpayroll_model extends App_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function save_deduction($data)
	{
		if (!empty($data)) {
			$this->db->insert(db_prefix() . 'rec_deduction', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
	}

	public function get_deduction_data($candidate_id)
	{
		if ($candidate_id > 0 && is_numeric($candidate_id)) {
			$this->db->where('candidate_id', $candidate_id);
			$deduction_data = $this->db->get(db_prefix() . 'rec_deduction')->result_array();
			return $deduction_data;
		}
	}

	public function delete_deduction($id)
	{
		if ($id > 0 && is_numeric($id)) {
			$this->db->where('id', $id);
			if ($this->db->delete(db_prefix() . 'rec_deduction')) {
				return true;
			}
		}
		return false;
	}

	public function get_deduction($id)
	{
		if ($id > 0 && is_numeric($id)) {
			$this->db->where('id', $id);
			$deduction = $this->db->get(db_prefix() . 'rec_deduction')->result_array();
			return $deduction;
		}
		return [];
	}

	public function update_deduction($data, $deduction_id)
	{
		if (!empty($data) && is_numeric($deduction_id)) {
			$this->db->where('id', $deduction_id);
			$this->db->update(db_prefix() . 'rec_deduction', $data);
			return true;
		}
		return false;
	}

	public function save_payroll_setup($data)
	{
		$this->db->insert(db_prefix() . 'rec_payroll_set_up', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function check_payroll_setup_extst($where)
	{
		$candidate_id = isset($where['candidate_id']) ? $where['candidate_id'] : 0;
		if (is_numeric($candidate_id) && $candidate_id > 0) {
			$this->db->where('candidate_id', $candidate_id);
			$this->db->where('name', $where['name']);
			$query = $this->db->get(db_prefix() . 'rec_payroll_set_up');
			if ($query->num_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	public function update_payroll_setup($data)
	{
		$candidate_id = isset($data['candidate_id']) ? $data['candidate_id'] : 0;
		if (is_numeric($candidate_id) && $candidate_id > 0) {
			$this->db->where('candidate_id', $candidate_id);
			$this->db->where('name', $data['name']);
			unset($data['name']);
			unset($data['candidate_id']);
			$this->db->update(db_prefix() . 'rec_payroll_set_up', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	public function save_sss_setting($data)
	{
		$this->db->insert(db_prefix() . 'rec_sss_setting', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function check_sss_setting_exxist($id)
	{
		if (is_numeric($id) && $id > 0) {
			$this->db->where('data_id', $id);
			$result = $this->db->get(db_prefix() . 'rec_sss_setting')->result_array();
			if (!empty($result)) {
				return true;
			}
		}
		return false;
	}

	public function update_sss_setting($data, $id)
	{
		if (!empty($data) && $id > 0) {
			$this->db->where('data_id', $id);
			if (isset($data['data_id'])) {
				unset($data['data_id']);
			}
			$this->db->update(db_prefix() . 'rec_sss_setting', $data);
		}
	}

	public function check_sss_table_exsist($id)
	{
		if (is_numeric($id) && $id > 0) {
			$this->db->where('data_id', $id);
			$result = $this->db->get(db_prefix() . 'rec_sss_table')->result_array();
			if (!empty($result)) {
				return true;
			}
		}
		return false;
	}

	public function save_sss_table($data)
	{
		$this->db->insert(db_prefix() . 'rec_sss_table', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function update_sss_table($data, $id)
	{
		if (!empty($data) && $id > 0) {
			$this->db->where('data_id', $id);
			if (isset($data['data_id'])) {
				unset($data['data_id']);
			}
			$this->db->update(db_prefix() . 'rec_sss_table', $data);
		}
	}

	public function save_candidate_payroll_new_setup($data)
	{
		$this->db->insert(db_prefix() . 'rec_candidate_payroll_new', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function update_candidate_payroll_new_setup($data)
	{
		$candidate_id = isset($data['candidate_id']) ? $data['candidate_id'] : 0;
		if (is_numeric($candidate_id) && $candidate_id > 0) {
			$this->db->where('candidate_id', $candidate_id);
			$this->db->where('name', $data['name']);
			unset($data['name']);
			unset($data['candidate_id']);
			$this->db->update(db_prefix() . 'rec_candidate_payroll_new', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	public function check_candidate_payroll_new_extst($where)
	{
		$candidate_id = isset($where['candidate_id']) ? $where['candidate_id'] : 0;
		if (is_numeric($candidate_id) && $candidate_id > 0) {
			$this->db->where('candidate_id', $candidate_id);
			$this->db->where('name', $where['name']);
			$query = $this->db->get(db_prefix() . 'rec_candidate_payroll_new');
			if ($query->num_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	public function save_payroll_data($data)
	{
		if (!empty($data)) {
			$this->db->insert(db_prefix() . 'rec_payroll_data', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
	}

	public function get_payroll_data()
	{
		$data = $this->db->get(db_prefix() . 'rec_payroll_data')->result_array();
		if (!empty($data)) {
			return $data;
		}
		return [];
	}

	public function get_payroll_data_by_id($id)
	{
		if (is_numeric($id) && $id > 0) {
			$this->db->where('id', $id);
			$data = $this->db->get(db_prefix() . 'rec_payroll_data')->result_array();
			if (!empty($data) && isset($data[0]) && !empty($data[0])) {
				return $data[0];
			}
			return [];
		}
	}

	public function update_payroll_data($data, $id)
	{
		if (!empty($data) && is_numeric($id) && $id > 0) {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'rec_payroll_data', $data);
			return true;
		}
	}

	public function delete_payroll_data($id)
	{
		if (is_numeric($id) && $id > 0) {
			$this->db->where('id', $id);
			$this->db->delete(db_prefix() . 'rec_payroll_data');
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	public function add_payroll_table_code_for_crew($candidate_id, $data)
	{
		if (is_numeric($candidate_id) && $candidate_id > 0 && !empty($data)) {
			$this->db->where('id', $candidate_id);
			$this->db->update(db_prefix() . 'rec_candidate', $data);
			return true;
		}
	}

	public function save_payroll_period($data)
	{
		if (!empty($data)) {
			$this->db->insert(db_prefix() . 'rec_payroll_period', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		return false;
	}

	public function update_payroll_period($data, $id)
	{
		if (!empty($data) && is_numeric($id) && $id > 0) {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'rec_payroll_period', $data);
			return true;
		}
		return false;
	}

	public function get_payroll_period()
	{
		$data = $this->db->get(db_prefix() . 'rec_payroll_period')->result_array();
		if (!empty($data) && $data) {
			return $data;
		}
		return false;
	}

	public function get_payroll_period_by_id($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			$this->db->where('id', $id);
			$data = $this->db->get(db_prefix() . 'rec_payroll_period')->result_array();
			if (!empty($data) && $data && isset($data[0]) && !empty($data[0])) {
				return $data[0];
			}
			return false;
		}
	}

	public function delete_payroll_period($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			if (is_numeric($id) && $id > 0) {
				$this->db->where('id', $id);
				$this->db->delete(db_prefix() . 'rec_payroll_period');
				if ($this->db->affected_rows() > 0) {
					return true;
				}
			}
			return false;
		}
	}

	public function save_payroll_history($data)
	{
		if (!empty($data)) {
			$this->db->insert(db_prefix() . 'rec_payroll_history', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		return false;
	}

	public function delete_payroll_history($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			if (is_numeric($id) && $id > 0) {
				$this->db->where('id', $id);
				$this->db->delete(db_prefix() . 'rec_payroll_history');
				if ($this->db->affected_rows() > 0) {
					return true;
				}
			}
			return false;
		}
	}

	public function check_payroll_history($candidate_id, $payroll_reference)
	{
		if (is_numeric($candidate_id) && $candidate_id > 0 && $payroll_reference != '') {
			$this->db->where('candidate_id', $candidate_id);
			$this->db->where('payroll_reference', $payroll_reference);
			$query = $this->db->get(db_prefix() . 'rec_payroll_history');
			if ($query->num_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	public function get_payroll_history_by_id($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			$this->db->where('id', $id);
			$data = $this->db->get(db_prefix() . 'rec_payroll_history')->result_array();
			if (!empty($data) && isset($data[0]) && !empty($data[0])) {
				return $data[0];
			}
		}
		return [];
	}

	public function update_payroll_history($data, $id)
	{
		if (is_numeric($id) && $id > 0 && $id != '' && !empty($data)) {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'rec_payroll_history', $data);
			return true;
		}
		return false;
	}

	public function add_payroll_group_per_vessel($data)
	{
		if (!empty($data)) {
			$this->db->insert(db_prefix() . 'payroll_group_per_vessel', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
	}

	public function get_payroll_group_per_vessel_data()
	{
		$data = $this->db->get(db_prefix() . 'payroll_group_per_vessel')->result_array();
		if (!empty($data) && $data) {
			return $data;
		}
		return [];
	}

	public function delete_payroll_group_per_vessel($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			$this->db->where('id', $id);
			$this->db->delete(db_prefix() . 'payroll_group_per_vessel');
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	public function get_payroll_group_per_vessel($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			$this->db->where('id', $id);
			$data = $this->db->get(db_prefix() . 'payroll_group_per_vessel')->result_array();
			if (!empty($data) && $data) {
				return $data;
			}
		}
		return [];
	}

	public function update_payroll_group_per_vessel($data, $id)
	{
		if (!empty($data) && is_numeric($id) && $id > 0 && $id != '') {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'payroll_group_per_vessel', $data);
		}
	}

	public function add_payroll_table_setting($data)
	{
		if (!empty($data)) {
			$this->db->insert(db_prefix() . 'payroll_table_setting', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
	}

	public function get_payroll_table_setting_data()
	{
		$data = $this->db->get(db_prefix() . 'payroll_table_setting')->result_array();
		if (!empty($data) && $data) {
			return $data;
		}
		return [];
	}

	public function delete_payroll_table_setting($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			$this->db->where('id', $id);
			$this->db->delete(db_prefix() . 'payroll_table_setting');
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	public function get_payroll_table_setting_by_id($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			$this->db->where('id', $id);
			$data = $this->db->get(db_prefix() . 'payroll_table_setting')->result_array();
			if (!empty($data) && $data) {
				return $data;
			}
		}
		return [];
	}

	public function update_payroll_table_setting($data, $id)
	{
		if (!empty($data) && is_numeric($id) && $id > 0 && $id != '') {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'payroll_table_setting', $data);
			return true;
		}
	}
}
