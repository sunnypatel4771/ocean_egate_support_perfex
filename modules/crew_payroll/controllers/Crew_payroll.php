<?php

defined('BASEPATH') or exit('No direct script access allowed');

class crew_payroll extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('crewpayroll_model');
	}

	public function index()
	{
		$data['group'] = $this->input->get('group');
		$data['title'] = _l('sss_setting_tab');
		$data['tab'][] = 'payroll_setting_tab';
		$data['tab'][] = 'sss_setting_tab';
		$data['tab'][] = 'sss_table_tab';
		$data['tab'][] = 'payroll_table';
		$data['tab'][] = 'payroll_period';
		if ($data['group'] == '') {
			$data['group'] = 'payroll_setting_tab';
		}
		if ($data['group'] == 'payroll_table') {
			$data['payroll_table_data'] = $this->crewpayroll_model->get_payroll_data();
		}

		if ($data['group'] == 'payroll_period') {
			$data['payroll_period_data'] = $this->crewpayroll_model->get_payroll_period();
		}
		$data['tabs']['view'] = 'includes/' . $data['group'];
		$this->load->view('crew_payroll_setting', $data);
	}

	public function add_update_deduction()
	{
		$post = $this->input->post();
		$candidate_id = isset($post['candidate_id']) ? $post['candidate_id'] : '';
		$deduction_id = isset($post['deduction_id']) ? $post['deduction_id'] : '';
		if (isset($_FILES['file']) && !empty($_FILES['file']) && isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
			$deduction_file = $_FILES['file'];
			$module_path = module_dir_path(CREW_PAYROLL_MODULE_NAME);
			$upload_path  = $module_path . 'uploads/deduction/' . $candidate_id;
			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0755, true);
			}
			$file_name = $deduction_file['name'];
			$file_tmp_name = $deduction_file['tmp_name'];
			$file_arr = explode('.', $file_name);
			$new_file_name = $file_arr[0] . time() . '_' . $candidate_id . '.' . $file_arr[1];
			$new_file_name = str_replace(' ', '_', $new_file_name);
			$target_file = $upload_path . '/' . $new_file_name;
			if (move_uploaded_file($file_tmp_name, $target_file)) {
				$post['file'] =  $new_file_name;
			}
		}
		if (!isset($post['status'])) {
			$post['status'] = 0;
		}
		if (isset($post['deduction_id'])) {
			unset($post['deduction_id']);
		}
		if ($deduction_id != '' && $deduction_id > 0) {
			if ($this->crewpayroll_model->update_deduction($post, $deduction_id)) {
				set_alert('success', _l('deduction_updated'));
				redirect(admin_url('recruitment/candidate/' . $candidate_id));
			} else {
				set_alert('error', _l('somthig_gone_wrong'));
				redirect(admin_url('recruitment/candidate/' . $candidate_id));
			}
		} else {
			$save_id = $this->crewpayroll_model->save_deduction($post);
			if ($save_id) {
				set_alert('success', _l('deduction_saved'));
				redirect(admin_url('recruitment/candidate/' . $candidate_id));
			} else {
				set_alert('error', _l('somthig_gone_wrong'));
				redirect(admin_url('recruitment/candidate/' . $candidate_id));
			}
		}
	}

	public function delete_deduction($id, $candidate_id)
	{
		if ($id > 0) {
			$deduction = $this->crewpayroll_model->get_deduction($id);
			if (isset($deduction[0]) && !empty($deduction[0])) {
				$deduction_file = $deduction[0]['file'];
				if ($deduction_file != '') {
					$path = module_dir_path(CREW_PAYROLL_MODULE_NAME) . 'uploads/deduction/' . $candidate_id . '/' . $deduction_file;
					if (file_exists($path)) {
						unlink($path);
					}
				}
			}
			if ($this->crewpayroll_model->delete_deduction($id)) {
				set_alert('success', _l('deduction_deleted'));
				redirect(admin_url('recruitment/candidate/' . $candidate_id));
			}
		}
		set_alert('error', _l('somthig_gone_wrong'));
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}

	public function get_deduction()
	{
		$post = $this->input->post();
		$id = isset($post['id']) ? $post['id'] : 0;
		$res['status'] = 0;
		$res['data'] = [];
		if ($id > 0) {
			$deduction = $this->crewpayroll_model->get_deduction($id);
			if (isset($deduction[0]) && !empty($deduction[0])) {
				$dedu = $deduction[0];
				$deduction_file_name = $dedu['file'];
				if ($deduction_file_name != '') {
					$ded_file_path = site_url("modules/" . CREW_PAYROLL_MODULE_NAME . '/uploads/deduction/' . $dedu['candidate_id'] . '/' . $dedu['file']);
					$ded_file = '<img src="' . $ded_file_path . '" height="80px" width="auto">';
					$dedu['ded_file'] = $ded_file;
				}
				$res['status'] = 1;
				$res['data'] = $dedu;
			}
		}
		echo json_encode($res);
		die;
	}

	public function table_deduction()
	{
		if ($this->input->is_ajax_request()) {
			$this->app->get_table_data(module_views_path('crew_payroll', 'tables/table_deduction'));
		}
	}

	public function payroll_setup_tab_update()
	{
		$post = $this->input->post();
		if ($post) {
			$input_name_1 = isset($post['input_name_1']) ? $post['input_name_1'] : '';
			$input_value_1 = isset($post['input_value_1']) ? $post['input_value_1'] : '';
			update_option($input_name_1, $input_value_1);
			$input_name_2 = isset($post['input_name_2']) ? $post['input_name_2'] : '';
			$input_value_2 = isset($post['input_value_2']) ? $post['input_value_2'] : '';
			update_option($input_name_2, $input_value_2);
			$input_name_3 = isset($post['input_name_3']) ? $post['input_name_3'] : '';
			$input_value_3 = isset($post['input_value_3']) ? $post['input_value_3'] : '';
			update_option($input_name_3, $input_value_3);
		}
	}

	public function save_payroll_setup()
	{
		$post = $this->input->post();
		$candidate_id = isset($post['candidate_id']) ? $post['candidate_id'] : 0;
		if (isset($post['candidate_id'])) {
			unset($post['candidate_id']);
		}
		if (isset($post['select_payroll_code'])) {
			unset($post['select_payroll_code']);
		}
		if (isset($post['select_payroll_rank'])) {
			unset($post['select_payroll_rank']);
		}
		$rank_code = isset($post['rank_code']) ? $post['rank_code'] : 0;
		$vessel_code = isset($post['vessel_code']) ? $post['vessel_code'] : 0;
		$insert_candidate_payroll_selection_detail['candidate_id'] = $candidate_id;
		$insert_candidate_payroll_selection_detail['rank_code'] = $rank_code;
		$insert_candidate_payroll_selection_detail['vessel_code'] = $vessel_code;
		add_candidate_payroll_selection_detail($insert_candidate_payroll_selection_detail);
		if (isset($post['vessel_code'])) {
			unset($post['vessel_code']);
		}

		if (isset($post['rank_code'])) {
			unset($post['rank_code']);
		}

		foreach ($post as $key => $value) {
			$data['candidate_id'] = $candidate_id;
			$data['name'] = $key;
			$is_exist = $this->crewpayroll_model->check_candidate_payroll_new_extst($data);
			$data['rate'] = $value[0];
			$data['qty'] = $value[1];
			$data['amount'] = $value[2];
			$data['remark'] = $value[3];
			$data['bank_name'] = $value[4];
			$data['account_name'] = $value[5];
			$data['account_no'] = $value[6];
			if ($is_exist) {
				$this->crewpayroll_model->update_candidate_payroll_new_setup($data);
			} else {
				$this->crewpayroll_model->save_candidate_payroll_new_setup($data);
			}
		}
		set_alert('success', _l('payroll_setup_saved'));
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}

	public function save_sss_setting()
	{
		$post = $this->input->post();
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			unset($post['id']);
			$post['data_id'] = $id;
			$is_exsist = $this->crewpayroll_model->check_sss_setting_exxist($id);
			if ($is_exsist) {
				$this->crewpayroll_model->update_sss_setting($post, $id);
			} else {
				$this->crewpayroll_model->save_sss_setting($post);
			}
		}
	}

	public function save_sss_table()
	{
		$post = $this->input->post();
		if ($post) {
			$id = isset($post['id']) ? $post['id'] : 0;
			unset($post['id']);
			$post['data_id'] = $id;
			$is_exsist = $this->crewpayroll_model->check_sss_table_exsist($id);
			if ($is_exsist) {
				$this->crewpayroll_model->update_sss_table($post, $id);
			} else {
				$this->crewpayroll_model->save_sss_table($post);
			}
		}
	}

	public function recruitment_payroll()
	{
		$data['group'] = $this->input->get('group');
		$data['title'] = 'Payroll';
		$data['tab'][] = 'exchange_rate';
		$data['tab'][] = 'payroll_history';
		$data['tab'][] = 'payroll_group_per_vessel';
		$data['tab'][] = 'payroll_table_setting';
		if ($data['group'] == '') {
			$data['group'] = 'exchange_rate';
		}

		if ($data['group'] == 'payroll_group_per_vessel') {
			$data['payroll_group_per_vessel_data'] = $this->crewpayroll_model->get_payroll_group_per_vessel_data();
		}

		// if ($data['group'] == 'payroll_table_setting') {
		// 	$data['payroll_table_setting_data'] = $this->crewpayroll_model->get_payroll_table_setting_data();
		// }
		$data['tabs']['view'] = 'recruitment_payroll_includes/' . $data['group'];
		$this->load->view('recruitment_payroll', $data);
	}

	public function save_recruitment_payroll()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			foreach ($post as $key => $value) {
				update_option($key, $value);
			}
			set_alert('success', _l('Payroll Saved'));
		}
		redirect(admin_url('crew_payroll/recruitment_payroll?group=exchange_rate'));
	}

	public function save_payroll_data()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$hid = isset($post['hid']) ? $post['hid'] : 0;
				if (isset($post['hid'])) {
					unset($post['hid']);
				}
				if ($hid != '' && $hid > 0) {
					$this->crewpayroll_model->update_payroll_data($post, $hid);
					set_alert('success', _l('Payroll Updated'));
				} else {
					$insert_id = $this->crewpayroll_model->save_payroll_data($post);
					if ($insert_id) {
						set_alert('success', _l('Payroll Saved'));
					}
				}
			}
		}
		redirect(admin_url('crew_payroll/index?group=payroll_table'));
	}

	public function edit_payroll_table()
	{
		if ($this->input->post()) {
			$res['status'] = 0;
			$res['data'] = [];
			$post = $this->input->post();
			if (!empty($post)) {
				$id = isset($post['id']) ? $post['id'] : 0;
				if ($id > 0) {
					$data = $this->crewpayroll_model->get_payroll_data_by_id($id);
					if (!empty($data)) {
						$res['status'] = 1;
						$res['data'] = $data;
					}
				}
			}
		}
		echo json_encode($res);
		exit;
	}

	public function delete_payroll_table($id)
	{
		if ($id != '' && $id > 0) {
			$is_deleted = $this->crewpayroll_model->delete_payroll_data($id);
			if ($is_deleted) {
				set_alert('success', _l('Payroll Deleted'));
			} else {
				set_alert('danger', _l('Something Gone Wrong!'));
			}
		}
		redirect(admin_url('crew_payroll/index?group=payroll_table'));
	}

	public function get_payroll_table_data_by_code()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			$res['status'] = 0;
			$res['data'] = [];
			if (!empty($post)) {
				$select_payroll_code = isset($post['select_payroll_code']) ? $post['select_payroll_code'] : 0;
				if ($select_payroll_code != '' && $select_payroll_code > 0) {
					$data = get_payroll_table_list_for_dropdown($select_payroll_code);
					if (!empty($data) && isset($data[0]) && !empty($data[0])) {
						$data = $data[0];
						$res['status'] = 1;
						$res['data'] = $data;
					}
				}
			}
		}
		echo json_encode($res);
		exit;
	}

	public function add_payroll_table_data_for_crew()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$payroll_table_id = isset($post['select_payroll_code']) ? $post['select_payroll_code'] : 0;
				$candidate_id = isset($post['candidate_id']) ? $post['candidate_id'] : 0;
				if ($payroll_table_id > 0 && $payroll_table_id != '' && $candidate_id > 0 && $candidate_id != '') {
					$data['payroll_table_id'] = $payroll_table_id;
					$this->crewpayroll_model->add_payroll_table_code_for_crew($candidate_id, $data);
					$payroll_data = get_payroll_table_list_for_dropdown($payroll_table_id);
					if (!empty($payroll_data) && isset($payroll_data[0]) && !empty($payroll_data[0])) {
						$payroll_data = $payroll_data[0];
						if (isset($payroll_data['id'])) {
							unset($payroll_data['id']);
						}
						if (isset($payroll_data['code'])) {
							unset($payroll_data['code']);
						}
						if (isset($payroll_data['rank'])) {
							unset($payroll_data['rank']);
						}
						foreach ($payroll_data as $key => $value) {
							$where['candidate_id'] = $candidate_id;
							$where['name'] = $key;
							$is_exist = $this->crewpayroll_model->check_candidate_payroll_new_extst($where);
							if ($is_exist) {
								$where['rate'] = $value;
								$this->crewpayroll_model->update_candidate_payroll_new_setup($where);
							} else {
								$where['rate'] = $value;
								$this->crewpayroll_model->save_candidate_payroll_new_setup($where);
							}
						}
					}
				}
				set_alert('success', 'Payroll Data Saved');
				redirect(admin_url('recruitment/candidate/' . $candidate_id));
			}
		}
	}

	public function get_payroll_setup_modal_detail()
	{
		if ($this->input->post()) {
			$res['status'] = 0;
			$res['html'] = '';
			$post_data = $this->input->post();
			if (!empty($post_data)) {
				$candidate_id = isset($post_data['candidate_id']) ? $post_data['candidate_id'] : 0;
				$type = isset($post_data['type']) ? $post_data['type'] : 0;
				if ($type != '' && $candidate_id != '' && $candidate_id > 0) {
					$html = modal_table_html_detail($candidate_id, $type);
					$res['status'] = 1;
					$res['html'] = $html;
				}
			}
		}
		echo json_encode($res);
		exit;
	}

	public function save_payroll_period()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			$id = isset($post['id']) ? $post['id'] : 0;
			if (isset($post['id'])) {
				unset($post['id']);
			}
			if (!empty($post)) {
				if ($id != '' && $id > 0) {

					$from = isset($post['from']) ? $post['from'] : '0000-00-00';
					$to = isset($post['to']) ? $post['to'] : '0000-00-00';
					$from_short = date('ymd', strtotime($from));
					$to_short = date('ymd', strtotime($to));
					$payroll_reference = $from_short . $to_short;
					$post['payroll_reference'] = $payroll_reference;
					$is_updated = $this->crewpayroll_model->update_payroll_period($post, $id);
					if ($is_updated) {
						set_alert('success', _l('payroll_period_updated'));
					}
				} else {
					$from = isset($post['from']) ? $post['from'] : '0000-00-00';
					$to = isset($post['to']) ? $post['to'] : '0000-00-00';
					$from_short = date('ymd', strtotime($from));
					$to_short = date('ymd', strtotime($to));
					$payroll_reference = $from_short . $to_short;
					$post['payroll_reference'] = $payroll_reference;

					$save_id = $this->crewpayroll_model->save_payroll_period($post);
					if ($save_id) {
						set_alert('success', _l('payroll_period_saved'));
					}
				}
			}
		}
		redirect(admin_url('crew_payroll/index?group=payroll_period'));
	}

	public function get_payroll_period()
	{
		$res['status'] = 0;
		$res['data'] = [];
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$id = isset($post['id']) ? $post['id'] : 0;
				if ($id != '' && $id > 0) {
					$data = $this->crewpayroll_model->get_payroll_period_by_id($id);
					if (!empty($data)) {
						$res['status'] = 1;
						$res['data'] = $data;
					}
				}
			}
		}
		echo json_encode($res);
		exit;
	}

	public function delete_payroll_period($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			$is_deleted = $this->crewpayroll_model->delete_payroll_period($id);
			if ($is_deleted) {
				set_alert('success', _l('payroll_period_delted'));
			}
		}
		redirect(admin_url('crew_payroll/index?group=payroll_period'));
	}

	public function get_payroll_period_data()
	{
		$res['status'] = 0;
		$res['html'] = '';
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$candidate_id = isset($post['candidate_id']) ? $post['candidate_id'] : 0;
				if ($candidate_id != '' && $candidate_id > 0) {

					$payroll_period_data = $this->crewpayroll_model->get_payroll_period();
					if (!empty($payroll_period_data)) {
						$html = "<table class='table table-bordered dt-table dt-inline dataTable no-footer'>";

						$html .= "<thead><tr>";
						$html .= "<th></th>";
						$html .= "<th>From</th>";
						$html .= "<th>To</th>";
						$html .= "<th>Days</th>";
						$html .= "<th>Exchange Rate</th>";
						$html .= "<th>Payroll Reference</th>";
						$html .= "<th>Remarks</th>";
						$html .= "</tr></thead>";

						$html .= "<tbody>";
						foreach ($payroll_period_data as $key => $value) {
							$is_exist = is_exist_payroll_history($candidate_id, $value);
							if ($is_exist) {
								$disabled = 'disabled';
								$color = "color: lightgray;";
							} else {
								$disabled = '';
								$color = '';
							}
							$html .= "<tr>";
							$html .= "<td><input type='checkbox' class='payroll_period_checkbox' data-id='" . $value['id'] . "' style='width: 20px; height: 20px; cursor: pointer;' " . $disabled . "></td>";
							$html .= "<td style='" . $color . "'>" . $value['from'] . "</td>";
							$html .= "<td style='" . $color . "'>" . $value['to'] . "</td>";
							$html .= "<td style='" . $color . "'>" . $value['days'] . "</td>";
							$html .= "<td style='color: red;'>" . $value['exchange_rate'] . "</td>";
							$html .= "<td style='" . $color . "'>" . $value['payroll_reference'] . "</td>";
							$html .= "<td style='" . $color . "'>" . $value['remarks'] . "</td>";
							$html .= "</tr>";
						}
						$html .= "</tbody>";
						$html .= "</table>";
						$res['status'] = 1;
						$res['html'] = $html;
					}
				}
			}
		}

		echo json_encode($res);
		exit;
	}

	public function save_payroll_history()
	{
		$res['status'] = 0;
		$res['data'] = [];
		if ($this->input->post()) {
			$post = $this->input->post();
			$candidate_id = isset($post['candidate_id']) ? $post['candidate_id'] : 0;
			$selectedId = isset($post['selectedId']) ? $post['selectedId'] : 0;

			$payroll_period_data = $this->crewpayroll_model->get_payroll_period_by_id($selectedId);
			if (isset($payroll_period_data['payroll_reference'])) {
				$is_exist = $this->crewpayroll_model->check_payroll_history($candidate_id, $payroll_period_data['payroll_reference']);
				if (!$is_exist) {
					if ($candidate_id != '' && $candidate_id > 0 && $selectedId != '' && $selectedId > 0) {
						$payroll_setting_tab_detail = get_payroll_setting_tab_detail();
						$insert_data = [];
						$insert_data['candidate_id'] = $candidate_id;
						if (!empty($payroll_period_data)) {
							$insert_data['from'] = isset($payroll_period_data['from']) ? $payroll_period_data['from'] : '';
							$insert_data['to'] = isset($payroll_period_data['to']) ? $payroll_period_data['to'] : '';
							$insert_data['days'] = isset($payroll_period_data['days']) ? $payroll_period_data['days'] : '';
							$insert_data['payroll_reference'] = isset($payroll_period_data['payroll_reference']) ? $payroll_period_data['payroll_reference'] : '';
							$insert_data['exchange_rate'] = isset($payroll_period_data['exchange_rate']) ? $payroll_period_data['exchange_rate'] : '';
						}
						foreach ($payroll_setting_tab_detail as $key => $value) {
							$insert_data[$key] = get_crew_payroll_new($candidate_id, $key, 'amount');
						}
						// $inserted_id = $this->crewpayroll_model->save_payroll_history($insert_data);
						// if ($inserted_id) {
						// 	$res['status'] = 1;
						// 	$res['msg'] = _l('payroll_history_saved');
						// }
						$res['status'] = 1;
						$res['data'] = $insert_data;
					}
				} else {
					$res['status'] = 0;
					$res['data'] = [];
				}
			}
		}
		echo json_encode($res);
		exit;
	}

	public function add_payroll_history()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			$candidate_id = isset($post['candidate_id']) ? $post['candidate_id'] : 0;
			if ($candidate_id != '' && $candidate_id > 0) {
				$inserted_id = $this->crewpayroll_model->save_payroll_history($post);
				if ($inserted_id) {
					// $res['status'] = 1;
					// $res['msg'] = _l('payroll_history_saved');
					set_alert('success', _l('payroll_history_saved'));
				}
				redirect(admin_url('recruitment/candidate/' . $candidate_id));
			}
		}
	}

	public function delete_payroll_history($id, $candidate_id)
	{
		if (is_numeric($id) && $id > 0 && $id != '' && is_numeric($candidate_id) && $candidate_id > 0 && $candidate_id != '') {
			$is_deleted = $this->crewpayroll_model->delete_payroll_history($id);
			if ($is_deleted) {
				set_alert('success', _l('payroll_history_delted'));
			}
		}
		redirect(admin_url('recruitment/candidate/' . $candidate_id));
	}

	public function edit_payroll_history()
	{
		$res['status'] = 0;
		$res['data'] = [];
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$id = isset($post['id']) ? $post['id'] : 0;
				if ($id != '' && $id > 0) {
					$payroll_history_data = $this->crewpayroll_model->get_payroll_history_by_id($id);
					if (!empty($payroll_history_data)) {
						$res['status'] = 1;
						$res['data'] = $payroll_history_data;
					}
				}
			}
		}
		echo json_encode($res);
		exit;
	}

	public function update_payroll_history()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$from = isset($post['from']) ? $post['from'] : '0000-00-00';
				$to = isset($post['to']) ? $post['to'] : '0000-00-00';
				$from_short = date('ymd', strtotime($from));
				$to_short = date('ymd', strtotime($to));
				$payroll_reference = $from_short . $to_short;
				$post['payroll_reference'] = $payroll_reference;
				$id = isset($post['id']) ? $post['id'] : 0;
				if (isset($post['id'])) {
					unset($post['id']);
				}
				$candidate_id = isset($post['candidate_id']) ? $post['candidate_id'] : 0;
				if ($id != '' && $id > 0) {
					$is_updated = $this->crewpayroll_model->update_payroll_history($post, $id);
					if ($is_updated) {
						set_alert('success', _l('payroll_history_updated'));
					}
				}
				redirect(admin_url('recruitment/candidate/' . $candidate_id));
			}
		}
	}

	public function payroll_history_pdf($payroll_history_id)
	{
		if (is_numeric($payroll_history_id) && $payroll_history_id != '' && $payroll_history_id > 0) {
			$payroll_history_data = $this->crewpayroll_model->get_payroll_history_by_id($payroll_history_id);
			if (!empty($payroll_history_data)) {
				$pdf = payroll_history_pdf($payroll_history_data, '');
				$pdf->Output(slug_it("Contract") . '.pdf', 'I');
			}
		}
	}

	public function add_payroll_group_per_vessel()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$hid = isset($post['hid']) ? $post['hid'] : 0;
				if (isset($post['hid'])) {
					unset($post['hid']);
				}
				if ($hid != '' && $hid > 0) {
					$this->crewpayroll_model->update_payroll_group_per_vessel($post, $hid);
					set_alert('success', _l('payroll_group_per_vessel_updated'));
					redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_group_per_vessel'));
				} else {
					$inserted_id = $this->crewpayroll_model->add_payroll_group_per_vessel($post);
					if ($inserted_id) {
						set_alert('success', _l('payroll_group_per_vessel_added'));
						redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_group_per_vessel'));
					}
				}
			}
		}
		set_alert('error', 'Something Gone Wrong!');
		redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_group_per_vessel'));
	}

	public function delete_payroll_group_per_vessel($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			$is_deleted = $this->crewpayroll_model->delete_payroll_group_per_vessel($id);
			if ($is_deleted) {
				set_alert('success', _l('payroll_group_per_vessel_deleted'));
				redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_group_per_vessel'));
			}
		}
		set_alert('error', 'Something Gone Wrong!');
		redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_group_per_vessel'));
	}

	public function get_payroll_group_per_vessel()
	{
		$res['data'] = [];
		$res['status'] = 0;
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$id = isset($post['id']) ? $post['id'] : 0;
				if ($id != '' && $id > 0) {
					$data = $this->crewpayroll_model->get_payroll_group_per_vessel($id);
					if (!empty($data) && isset($data[0]) && !empty($data[0])) {
						$res['data'] = $data[0];
						$res['status'] = 1;
					}
				}
			}
		}
		echo json_encode($res);
		exit;
	}

	// public function	get_vessel_group_name_by_vessel_code()
	// {
	// 	$res['status'] = 0;
	// 	$res['vessel_group_name'] = '';
	// 	if ($this->input->post()) {
	// 		$post = $this->input->post();
	// 		if (!empty($post)) {
	// 			$id = isset($post['id']) ? $post['id'] : '';
	// 			if ($id != '') {
	// 				$vessel_group_name = get_vessel_group_name_by_vessel_code($id);
	// 				$res['status'] = 1;
	// 				$res['vessel_group_name'] = $vessel_group_name;
	// 			}
	// 		}
	// 	}
	// 	echo json_encode($res);
	// 	exit;
	// }

	// public function get_rank_by_rank_code()
	// {
	// 	$res['status'] = 0;
	// 	$res['vessel_group_name'] = '';
	// 	if ($this->input->post()) {
	// 		$post = $this->input->post();
	// 		if (!empty($post)) {
	// 			$id = isset($post['id']) ? $post['id'] : '';
	// 			if ($id != '') {
	// 				$rank = get_rank_by_rank_code($id);
	// 				$res['status'] = 1;
	// 				$res['rank'] = $rank;
	// 			}
	// 		}
	// 	}
	// 	echo json_encode($res);
	// 	exit;
	// }

	public function add_payroll_table_setting()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$hid = isset($post['hid']) ? $post['hid'] : 0;
				if (isset($post['hid'])) {
					unset($post['hid']);
				}
				if ($hid != '' && $hid > 0) {
					$is_updated = $this->crewpayroll_model->update_payroll_table_setting($post, $hid);
					if ($is_updated) {
						set_alert('success', _l('payroll_payroll_table_setting_updated'));
						redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_table_setting'));
					}
				} else {
					$check_payroll_table_setting_exsist_or_not =  check_payroll_table_setting_exsist_or_not($post);
					if (!$check_payroll_table_setting_exsist_or_not) {
						$inserted_id = $this->crewpayroll_model->add_payroll_table_setting($post);
						if ($inserted_id) {
							set_alert('success', _l('payroll_payroll_table_setting_added'));
							redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_table_setting'));
						}
					} else {
						set_alert('warning', _l('Vessel Name and Rank can not be same'));
						redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_table_setting'));
					}
				}
			}
		}
		// redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_table_setting'));
	}

	public function delete_payroll_table_setting($id)
	{
		if (is_numeric($id) && $id > 0 && $id != '') {
			$is_deleted = $this->crewpayroll_model->delete_payroll_table_setting($id);
			if ($is_deleted) {
				set_alert('success', _l('payroll_table_setting_deleted'));
				redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_table_setting'));
			}
		}
		set_alert('error', 'Something Gone Wrong!');
		redirect(admin_url('crew_payroll/recruitment_payroll?group=payroll_table_setting'));
	}

	public function get_payroll_table_setting()
	{
		$res['data'] = [];
		$res['status'] = 0;
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$id = isset($post['id']) ? $post['id'] : 0;
				if ($id != '' && $id > 0) {
					$data = $this->crewpayroll_model->get_payroll_table_setting_by_id($id);
					if (isset($data[0]) && !empty($data[0])) {
						$res['data'] = $data[0];
						$res['status'] = 1;
					}
				}
			}
		}
		echo json_encode($res);
		exit;
	}

	public function get_payroll_table_data_by_rank_and_vessel()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			$res['status'] = 0;
			$res['data'] = [];

			if (!empty($post)) {
				$vessel_code_selecter = isset($post['vessel_code_selecter']) ? $post['vessel_code_selecter'] : 0;
				$rank_code_selecter = isset($post['rank_code_selecter']) ? $post['rank_code_selecter'] : 0;
				if ($vessel_code_selecter != '' && $rank_code_selecter != '') {
					$filter['vessel_code_filter'] = $vessel_code_selecter;
					$filter['rank_code_filter'] = $rank_code_selecter;
					$data = get_payroll_table_setting_data($filter);
					if (!empty($data) && isset($data[0]) && !empty($data[0])) {
						$data = $data[0];
						$res['status'] = 1;
						$res['data'] = $data;
					}
				}
			}
		}
		echo json_encode($res);
		exit;
	}

	function get_rank_code_list_by_vessel_code()
	{
		$res['status'] = 0;
		$res['data'] = [];
		if ($this->input->post()) {
			$post = $this->input->post();
			if (!empty($post)) {
				$vessel_code = isset($post['vessel_code_selecter']) ? $post['vessel_code_selecter'] : '';
				if ($vessel_code != '' && $vessel_code > 0) {
					$filter['vessel_code_filter'] = $vessel_code;
					$data = get_payroll_table_setting_data($filter);
					$rank_according_vessel_code = [];
					foreach ($data as $key => $value) {
						$rank_according_vessel_code_arr = [];
						$rank_according_vessel_code_arr['id'] = $value['rank_code'];
						$rank_according_vessel_code_arr['name'] = get_rank_code_name($value['rank_code'], 'code') . ' - ' . get_rank_code_name($value['rank_code'], 'rank_name');
						$rank_according_vessel_code[] = $rank_according_vessel_code_arr;
					}

					$res['status'] = 1;
					$res['data'] = $rank_according_vessel_code;
				}
			}
		}
		echo json_encode($res);
		exit;
	}
}
