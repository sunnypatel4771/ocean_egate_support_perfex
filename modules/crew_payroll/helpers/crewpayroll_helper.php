<?php

defined('BASEPATH') or exit('No direct script access allowed');

function get_deduction_by_candidate_id($candidate_id)
{
    $CI = &get_instance();
    $CI->load->model("crew_payroll/Crewpayroll_model");
    $duduction_data = $CI->Crewpayroll_model->get_deduction_data($candidate_id);
    return $duduction_data;
}

function get_payroll_set_up_val_for_edit($name, $select, $candidateId)
{
    $where['candidate_id'] = $candidateId;
    $where['name'] = $name;
    $CI = &get_instance();
    if (is_array($where) && !empty($where) && $select != '') {
        $candidate_id = isset($where['candidate_id']) ? $where['candidate_id'] : 0;
        if (is_numeric($candidate_id) && $candidate_id > 0) {
            $CI->db->select($select);
            $CI->db->where('candidate_id', $candidate_id);
            $CI->db->where('name', $where['name']);
            $payroll_setup_data = $CI->db->get(db_prefix() . 'rec_payroll_set_up')->result_array();
            if (!empty($payroll_setup_data[0])) {
                return $payroll_setup_data[0][$select];
            }
        }
    }
    return '';
}

function get_sss_setting($id, $column)
{
    $CI = &get_instance();
    $CI->db->select($column);
    $CI->db->where('data_id', $id);
    $sss_setting_data = $CI->db->get(db_prefix() . 'rec_sss_setting')->result_array();
    if (!empty($sss_setting_data[0])) {
        return $sss_setting_data[0][$column];
    }
}

function get_sss_table($id, $column)
{
    $CI = &get_instance();
    $CI->db->select($column);
    $CI->db->where('data_id', $id);
    $sss_table_data = $CI->db->get(db_prefix() . 'rec_sss_table')->result_array();
    if (!empty($sss_table_data[0])) {
        return $sss_table_data[0][$column];
    }
}

function get_crew_payroll_new($candidate_id, $name, $select)
{
    $CI = &get_instance();
    $CI->db->select($select);
    $CI->db->where('candidate_id', $candidate_id);
    $CI->db->where('name', $name);
    $rec_candidate_payroll_new = $CI->db->get(db_prefix() . 'rec_candidate_payroll_new')->result_array();
    if (!empty($rec_candidate_payroll_new)) {
        return isset($rec_candidate_payroll_new[0][$select]) ? $rec_candidate_payroll_new[0][$select] : '';
    }
    return '';
}

function earnigs_deduction_fields($type = '')
{
    $fields = [
        'basic_wages_onb' => 'earning',
        'basic_wages_trv' => 'earning',
        'guranteed_overtime' => 'earning',
        'education_allowance' => 'earning',
        'leave' => 'earning',
        'operational_allowance' => 'earning',
        'supplementary_allowance' => 'earning',
        'owners_bonus' => 'earning',
        'slopchest' => 'deduction',
        'social_security_system_empee' => 'deduction',
        'philhelth_empee' => 'deduction',
        'pag_lbig_housing_program_empee' => 'deduction',
        'sss_mandatory_provident_fund_empee' => 'deduction',
        'provident_fund_kaupthing_empee' => 'deduction',
        'cash_advance_paid_onboard' => 'deduction',
        'other_deduction_1' => 'deduction_private',
        'other_deduction_2' => 'deduction_private',
        'other_deduction_3' => 'deduction_private',
        'other_deduction_4' => 'deduction_private',
        'other_deduction_5' => 'deduction_private',
        'other_deduction_6' => 'deduction_private',
        'other_deduction_7' => 'deduction_private',
    ];
    $data = [];
    foreach ($fields as $field => $field_type) {
        $data[$field] = [
            'type' => $field_type,
            $field => get_option($field),
            "{$field}_can_view" => get_option("{$field}_can_view")
        ];
    }
    if ($type != '') {
        return array_values(array_filter($data, function ($item) use ($type) {
            return $item['type'] === $type;
        }));
    }
    return $data;
}

function make_field_section_html($field, $candidate_id, $type, $can_view)
{
    if ($field != '' && $candidate_id != '' && $candidate_id > 0 && $type != '') {
        $html = '';
        if ($can_view == 1) {
            $html .= '<div class="col-sm-12" style="display: flex; margin-top: 15px;">';
            $html .= '<div style="width: 7%;" class="text-center"></div>';
            $html .= '<div style="width: 15%;" class="text-center">';
            $html .= '<p class="tab_text" style="margin: 0px;">' . get_option($field) . '</p>';
            $html .= '</div>';
            $html .= '<div style="width: 8%; padding: 0px 10px;" class="text-center">';
            $value = get_crew_payroll_new($candidate_id, $field, 'rate');
            $name = $field . '[]';
            $class = $field . '_rate';
            $input = render_input($name, '', $value, 'number', ['step' => "0.01"], [], '', $class);
            $html .= $input;
            $html .= '</div>';
            $html .= '<div style="width: 8%; padding: 0px 10px;" class="text-center">';
            $value = get_crew_payroll_new($candidate_id, $field, 'qty');
            $name = $field . '[]';
            $class = $field . '_qty';
            $input = render_input($name, '', $value, 'number', ['step' => "0.01"], [], '', $class);
            $html .= $input;
            $html .= '</div>';
            $html .= '</div>';
            return $html;
        }
    }
    return '';
}

function get_payroll_setting_tab_detail()
{
    $keys = [
        'basic_wages_onb',
        'basic_wages_trv',
        'leave',
        'education_allowance',
        'guranteed_overtime',
        'operational_allowance',
        'supplementary_allowance',
        'owners_bonus',
        'other_earnings_1',
        'other_earnings_2',
        'philhelth_empee',
        'social_security_system_empee',
        'slopchest',
        'pag_lbig_housing_program_empee',
        'sss_mandatory_provident_fund_empee',
        'provident_fund_kaupthing_empee',
        'cash_advance_paid_onboard',
        'other_deduction_1',
        'other_deduction_2',
        'other_deduction_3',
        'other_deduction_4',
        'other_deduction_5',
        'other_deduction_6',
        'other_deduction_7',
    ];
    $data = [];
    foreach ($keys as $key) {
        $data[$key] = [
            'name' => get_option($key),
            'order' => (int)get_option($key . '_order'),
            'shortcode' => get_option($key . '_shortcode'),
            'db_name' => $key,
        ];
    }
    uasort($data, function ($a, $b) {
        return $a['order'] <=> $b['order'];
    });
    if (!empty($data)) {
        return $data;
    }
    return [];
}

function get_payroll_table_list_for_dropdown($select_payroll_code = 0)
{
    $CI = &get_instance();
    if ($select_payroll_code != 0 && $select_payroll_code > 0) {
        $CI->db->where('id', $select_payroll_code);
    }
    $data = $CI->db->get(db_prefix() . 'rec_payroll_data')->result_array();
    if ($data) {
        return $data;
    }
    return [];
}

function get_crew_saved_payroll_data($payroll_data_id)
{
    if (is_numeric($payroll_data_id) && $payroll_data_id > 0 && $payroll_data_id != '') {
        $CI = &get_instance();
        $CI->db->where('id', $payroll_data_id);
        $data = $CI->db->get(db_prefix() . 'rec_payroll_data')->result_array();
        if (!empty($data) && isset($data[0]) && !empty($data[0])) {
            $data = $data[0];
            return $data;
        }
    }
    return [];
}


// for new setup of payroll setup
function payroll_setup_keys($type)
{
    if ($type == 'earning') {
        $keys = [
            'basic_wages_onb',
            'basic_wages_trv',
            'leave',
            'education_allowance',
            'guranteed_overtime',
            'operational_allowance',
            'supplementary_allowance',
            'owners_bonus',
            'other_earnings_1',
            'other_earnings_2',
        ];
    } elseif ($type == 'deduction_official') {
        $keys = [
            'philhelth_empee',
            'social_security_system_empee',
            'slopchest',
            'pag_lbig_housing_program_empee',
            'sss_mandatory_provident_fund_empee',
            'provident_fund_kaupthing_empee',
            'cash_advance_paid_onboard',
        ];
    } elseif ($type == 'deduction_private') {
        $keys = [
            'other_deduction_1',
            'other_deduction_2',
            'other_deduction_3',
            'other_deduction_4',
            'other_deduction_5',
            'other_deduction_6',
            'other_deduction_7',
        ];
    }
    return $keys;
}

function crew_payroll_field()
{
    $field = [
        [
            'key' => 'name',
            'value' => 'Name',
        ],
        [
            'key' => 'rate',
            'value' => 'Rate',
        ],
        [
            'key' => 'qty',
            'value' => 'QTY',
        ],
        [
            'key' => 'amount',
            'value' => 'Amount',
        ],
        [
            'key' => 'remark',
            'value' => 'Remark',
        ],
        [
            'key' => 'bank_name',
            'value' => 'Bank Name',
        ],
        [
            'key' => 'account_name',
            'value' => 'Account Name',
        ],
        [
            'key' => 'account_no',
            'value' => 'Account No',
        ],
    ];
    return $field;
}

function table_html_function($payroll_setup_keys, $candidate_id, $type)
{
    $html = '';
    if (!empty($payroll_setup_keys)) {
        $html .= '<table class="table table-bordered" style="margin-top: 10px;">';
        $html .= '<thead><tr>';
        $fields = crew_payroll_field();
        foreach ($fields as $col) {
            if ($col['value'] == 'Rate') {
                $col['value'] = 'Current Rate';
            }
            if ($col['value'] == 'Name') {
                $html .= '<th style="width: 20%;">' . $col['value'] . '</th>';
            } else if($col['value'] == 'Current Rate'){
                $html .= '<th style="width: 7%;">' . $col['value'] . '</th>';
            } else if($col['value'] == 'QTY'){
                $html .= '<th style="width: 5%;">' . $col['value'] . '</th>';
            } else if($col['value'] == 'Amount'){
                $html .= '<th style="width: 6%;">' . $col['value'] . '</th>';
            }else{
                $html .= '<th>' . $col['value'] . '</th>';
            }
        }
        $html .= '</tr></thead>';
        $html .= '<tbody>';
        $earning_total = 0;
        foreach ($payroll_setup_keys as $payroll_key) {
            $html .= '<tr>';
            foreach ($fields as $index => $col) {
                $value = get_crew_payroll_new($candidate_id, $payroll_key, $col['key']);
                if ($col['key'] == 'name') {
                    $value = get_option($payroll_key);
                    $shortcode = get_option($payroll_key . '_shortcode');
                    $order = get_option($payroll_key . '_order');
                    if ($shortcode != '') {
                        $value = $order . ' - ' . $value . ' - ' . $shortcode;
                    }
                }
                $value = $value != 0 ? $value : '';
                if ($col['key'] === 'amount') {
                    $earning_total += floatval($value);
                }
                if (is_numeric($value)) {
                    if ($col['key'] !== 'account_no') {
                        $value = number_format($value);
                    }
                }
                if ($col['key'] == 'name') {
                    $html .= '<td>' . $value . '</td>';
                } else {
                    $html .= '<td style="text-align: right;">' . $value . '</td>';
                }
            }
            $html .= '</tr>';
        }

        $total_amount = 0;
        if ($type != '' && $type == 'earning') {
            $total_amount = '<span style="color: blue;">'. number_format($earning_total) . '</span>';
        } elseif ($type != '' && $type == 'deduction_official') {
            $total_amount = '<span style="color: red;">'. number_format($earning_total) . '</span>';
        } elseif ($type != '' && $type == 'deduction_private') {
            $total_amount = '<span style="color: red;">'. number_format($earning_total) . '</span>';
        }

        $html .= '<tr style="border: none; border: 1px solid white;">';
        $html .= '<td colspan="3" style="text-align: right; border: none;"></td>';
        $html .= '<td style="text-align: right; color: blue;">' . $total_amount . '</td>';
        $html .= '</tr>';

        $html .= '</tbody>';
        $html .= '</table>';
        if ($type != '' && $type == 'earning') {
            $html .= '<input type="hidden" id="earning_total" value="' . number_format($earning_total) . '">';
        } elseif ($type != '' && $type == 'deduction_official') {
            $html .= '<input type="hidden" id="deduction_official_total" value="' . number_format($earning_total) . '">';
        } elseif ($type != '' && $type == 'deduction_private') {
            $html .= '<input type="hidden" id="deduction_private_total" value="' . number_format($earning_total) . '">';
        }
    }
    return $html;
}

function show_crew_earning_table($candidate_id, $type)
{
    if (!empty($candidate_id) && $candidate_id != '' && $type != '') {
        $payroll_setup_keys = payroll_setup_keys($type);
        $html = table_html_function($payroll_setup_keys, $candidate_id, $type);
        return $html;
    }
}

function table_html_function_modal($payroll_setup_keys, $candidate_id, $type)
{
    $html = '';
    if (!empty($payroll_setup_keys)) {
        $html .= '<table class="table table-bordered">';
        $html .= '<thead><tr>';
        $fields = crew_payroll_field();
        foreach ($fields as $col) {
            $th_style = "";
            $th_title = "";
            if ($col['value'] == 'Rate') {
                $col['value'] = 'Updated Rate';
            }

            if ($col['value'] == 'Amount') {
                $col['value'] = 'New Rate';
                $th_title = 'title="New Rate to be applied"';
            }

            if ($col['value'] == 'Name') {
                $th_style = "width: 220px;";
            }
            $html .= '<th style="' . $th_style . '" ' . $th_title . '>' . $col['value'] . '</th>';
        }
        $html .= '</tr></thead>';
        $html .= '<tbody>';
        $earning_total = 0;
        foreach ($payroll_setup_keys as $payroll_key) {
            $html .= '<tr>';
            $html .= '<td>' . get_option($payroll_key . '_order') . ' - ' . get_option($payroll_key) . ' <br></td>';
            foreach ($fields as $index => $col) {
                $value = get_crew_payroll_new($candidate_id, $payroll_key, $col['key']);
                if ($col['key'] == 'name') {
                    //$value = get_option($payroll_key);
                    continue;
                }
                $is_readonly = '';
                $old_value = '';
                if ($col['key'] == 'amount') {
                    $is_readonly = 'readonly';
                }
                $value = $value != 0 ? $value : '';
                if ($col['key'] == 'rate') {
                    $old_value = 'Current : <span style="color: blue;">' . $value . '</span>';
                    // $is_readonly = 'readonly';
                }
                if ($col['key'] == 'qty') {
                    $value = 1;
                    // $is_readonly = 'readonly';
                }
                if ($col['key'] == 'bank_name') {
                    $html .= '<td><input type="text" id="' . $payroll_key . '_' . $col['key'] . '" name="' . $payroll_key . '[]" value="' . $value . '" style="width: 100%;" class="form-control" ' . $is_readonly . '>' . $old_value . '</td>';
                } elseif ($col['key'] == 'account_name') {
                    $html .= '<td><input type="text" id="' . $payroll_key . '_' . $col['key'] . '" name="' . $payroll_key . '[]" value="' . $value . '" style="width: 100%;" class="form-control" ' . $is_readonly . '>' . $old_value . '</td>';
                } else {
                    $html .= '<td><input type="number" id="' . $payroll_key . '_' . $col['key'] . '" name="' . $payroll_key . '[]" value="' . $value . '" style="width: 100%;" class="form-control" ' . $is_readonly . '>' . $old_value . '</td>';
                }
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<input type="hidden" id="type_text" value="' . $type . '">';
    }
    return $html;
}

function modal_table_html_detail($candidate_id, $type)
{
    if (!empty($candidate_id) && $candidate_id != '' && $type != '') {
        $payroll_setup_keys = payroll_setup_keys($type);
        $html = table_html_function_modal($payroll_setup_keys, $candidate_id, $type);
        return $html;
    }
}

function get_payroll_history_data($candidate_id)
{
    if ($candidate_id != '' && $candidate_id > 0) {
        $CI = &get_instance();
        $CI->db->where('candidate_id', $candidate_id);
        $data = $CI->db->get(db_prefix() . 'rec_payroll_history')->result_array();
        if (!empty($data) && $data) {
            return $data;
        }
    }
    return [];
}

function is_exist_payroll_history($candidate_id, $data)
{
    if (is_numeric($candidate_id) && $candidate_id != '' && $candidate_id > 0 && !empty($data)) {
        $payroll_history_data = get_payroll_history_data($candidate_id);
        if (!empty($payroll_history_data)) {
            foreach ($payroll_history_data as $key => $value) {
                if (isset($data['payroll_reference'])) {
                    if ($value['payroll_reference'] == $data['payroll_reference']) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}

function get_all_candidate_payroll_history($get)
{
    $CI = &get_instance();
    $CI->db->select(db_prefix() . "rec_payroll_history.*, CONCAT('#', " . db_prefix() . "rec_candidate.candidate_code, ' ', " . db_prefix() . "rec_candidate.candidate_name, ' ', " . db_prefix() . "rec_candidate.last_name) AS full_candidate_name");
    $CI->db->join(db_prefix() . 'rec_candidate', db_prefix() . 'rec_candidate.id = ' . db_prefix() . 'rec_payroll_history.candidate_id');
    if (!empty($get)) {
        if (isset($get['payroll_reference_filter'])) {
            $payroll_reference_filter = $get['payroll_reference_filter'];
            $CI->db->like(db_prefix() . "rec_payroll_history.payroll_reference", $payroll_reference_filter);
        }
        if (isset($get['from_filter'])) {
            $from_filter = $get['from_filter'];
            $CI->db->like(db_prefix() . "rec_payroll_history.from", $from_filter);
        }
        if (isset($get['to_filter'])) {
            $to_filter = $get['to_filter'];
            $CI->db->like(db_prefix() . "rec_payroll_history.to", $to_filter);
        }
    }
    $CI->db->order_by(db_prefix() . "rec_payroll_history.from", "DESC");
    $data = $CI->db->get(db_prefix() . 'rec_payroll_history')->result_array();

    if (!empty($data) && $data) {
        return $data;
    }
    return [];
}

function add_payroll_setup_total($candidate_id)
{
    if (is_numeric($candidate_id) && $candidate_id != '' && $candidate_id > 0) {
        $earning_setup_keys = payroll_setup_keys('earning');
        $deduction_official_setup_keys = payroll_setup_keys('deduction_official');
        $deduction_private_setup_keys = payroll_setup_keys('deduction_private');
        $CI = &get_instance();
        $CI->db->where('candidate_id', $candidate_id);
        $data = $CI->db->get(db_prefix() . 'rec_candidate_payroll_new')->result_array();
        $earning_total = 0;
        $deduction_official_total = 0;
        $deduction_private_total = 0;
        foreach ($data as $key => $value) {
            foreach ($earning_setup_keys as $k => $v) {
                if ($v == $value['name']) {
                    $earning_total += $value['amount'];
                    continue;
                }
            }
            foreach ($deduction_official_setup_keys as $k => $v) {
                if ($v == $value['name']) {
                    $deduction_official_total += $value['amount'];
                    continue;
                }
            }
            foreach ($deduction_private_setup_keys as $k => $v) {
                if ($v == $value['name']) {
                    $deduction_private_total += $value['amount'];
                    continue;
                }
            }
        }

        $is_exist = check_payroll_setup_total_exist($candidate_id);
        if (!$is_exist) {
            $insert_data['candidate_id'] = $candidate_id;
            $insert_data['earnings_total'] = $earning_total;
            $insert_data['deduction_official_total'] = $deduction_official_total;
            $insert_data['deduction_private_total'] = $deduction_private_total;
            $CI->db->insert(db_prefix() . 'rec_payroll_setup_total', $insert_data);
        } else {
            $insert_data['candidate_id'] = $candidate_id;
            $insert_data['earnings_total'] = $earning_total;
            $insert_data['deduction_official_total'] = $deduction_official_total;
            $insert_data['deduction_private_total'] = $deduction_private_total;
            $CI->db->where('candidate_id', $candidate_id);
            $CI->db->update(db_prefix() . 'rec_payroll_setup_total', $insert_data);
        }
    }
}

function get_payroll_setup_total($candidate_id, $select)
{
    if (is_numeric($candidate_id) && $candidate_id != '' && $candidate_id > 0 && $select != '') {
        $CI = &get_instance();
        $CI->db->select($select);
        $CI->db->where('candidate_id', $candidate_id);
        $data = $CI->db->get(db_prefix() . 'rec_payroll_setup_total')->result_array();
        if ($data && !empty($data) && isset($data[0]) && !empty($data[0])) {
            return number_format($data[0][$select]);
        }
    }
    return 0;
}

function check_payroll_setup_total_exist($candidate_id)
{
    $CI = &get_instance();
    if (is_numeric($candidate_id) && $candidate_id != '' && $candidate_id > 0) {
        $CI->db->where('candidate_id', $candidate_id);
        $query = $CI->db->get(db_prefix() . 'rec_payroll_setup_total');
        if ($query->num_rows() > 0) {
            return true;
        }
    }
    return false;
}

function payroll_history_pdf($payroll_history_data, $tag = '')
{
    return app_pdf('payroll_history', module_dir_path(CREW_PAYROLL_MODULE_NAME) . '/libraries/pdf/Payroll_history_pdf', $payroll_history_data, $tag);
}

function get_vessel_code_options()
{
    $CI = &get_instance();
    // $CI->db->select('id , code');
    $CI->db->select('id, CONCAT(vessel_group_name, " - ", code) as Name');
    $data = $CI->db->get(db_prefix() . 'payroll_group_per_vessel')->result_array();
    if (!empty($data) && $data) {
        return $data;
    }
    return [];
}

function get_rank_code_options()
{
    $CI = &get_instance();
    // $CI->db->select('id, CONCAT(rank_name, " - ", code) as Name');
    $CI->db->select('id, 
    TRIM(
        CONCAT_WS(" - ", 
            NULLIF(rank_name, ""), 
            NULLIF(code, "")
        )
    ) as Name');
    $data = $CI->db->get(db_prefix() . 'job_rank')->result_array();
    if (!empty($data) && $data) {
        return $data;
    }
    return [];
}

function get_vessel_group_name_by_vessel_code($id)
{
    if ($id != '' && is_numeric($id)) {
        $CI = &get_instance();
        $CI->db->select('vessel_group_name');
        $CI->db->where('id', $id);
        $data = $CI->db->get(db_prefix() . 'payroll_group_per_vessel')->result_array();
        if (!empty($data) && isset($data[0]) && !empty($data[0])) {
            $data = $data[0];
            if (isset($data['vessel_group_name'])) {
                return $data['vessel_group_name'];
            }
        }
    }
    return '';
}

function get_rank_by_rank_code($id)
{
    if ($id != '' && is_numeric($id)) {
        $CI = &get_instance();
        $CI->db->select('rank_name');
        $CI->db->where('id', $id);
        $data = $CI->db->get(db_prefix() . 'job_rank')->result_array();
        if (!empty($data) && isset($data[0]) && !empty($data[0])) {
            $data = $data[0];
            if (isset($data['rank_name'])) {
                return $data['rank_name'];
            }
        }
    }
    return '';
}

function get_vessel_code_name($id, $select)
{
    if ($id != '' && is_numeric($id)) {
        $CI = &get_instance();
        $CI->db->select($select);
        $CI->db->where('id', $id);
        $data = $CI->db->get(db_prefix() . 'payroll_group_per_vessel')->result_array();
        if (!empty($data) && isset($data[0]) && !empty($data[0])) {
            $data = $data[0];
            if (isset($data[$select])) {
                return $data[$select];
            }
        }
    }
    return '';
}

function get_rank_code_name($id, $select)
{
    if ($id != '' && is_numeric($id)) {
        $CI = &get_instance();
        $CI->db->select($select);
        $CI->db->where('id', $id);
        $data = $CI->db->get(db_prefix() . 'job_rank')->result_array();
        if (!empty($data) && isset($data[0]) && !empty($data[0])) {
            $data = $data[0];
            if (isset($data[$select])) {
                return $data[$select];
            }
        }
    }
    return '';
}


function get_payroll_table_setting_data($filter = array())
{
    $CI = &get_instance();
    if (is_array($filter) && !empty($filter)) {
        if (isset($filter['vessel_code_filter']) && $filter['vessel_code_filter'] != '') {
            $CI->db->where('vessel_code', $filter['vessel_code_filter']);
        }

        if (isset($filter['rank_code_filter']) && $filter['rank_code_filter'] != '') {
            $CI->db->where('rank_code', $filter['rank_code_filter']);
        }
    }
    $data = $CI->db->get(db_prefix() . 'payroll_table_setting')->result_array();
    if (!empty($data) && $data) {
        return $data;
    }
    return [];
}

function check_payroll_table_setting_exsist_or_not($data)
{
    $CI = &get_instance();
    $CI->db->where('vessel_code', $data['vessel_code']);
    $CI->db->where('rank_code', $data['rank_code']);
    $data = $CI->db->get(db_prefix() . 'payroll_table_setting')->result_array();
    if (count($data) > 0) {
        return true;
    }
    return false;
}

function add_candidate_payroll_selection_detail($insert_candidate_payroll_selection_detail)
{
    if (!empty($insert_candidate_payroll_selection_detail)) {
        $CI = &get_instance();
        if (isset($insert_candidate_payroll_selection_detail['candidate_id'])) {
            $CI->db->where('candidate_id', $insert_candidate_payroll_selection_detail['candidate_id']);
            $data = $CI->db->get(db_prefix() . 'candidate_payroll_selection_detail')->result_array();
            if (count($data) > 0) {
                $CI->db->where('candidate_id', $insert_candidate_payroll_selection_detail['candidate_id']);
                $CI->db->update(db_prefix() . 'candidate_payroll_selection_detail', $insert_candidate_payroll_selection_detail);
            } else {
                $CI->db->insert(db_prefix() . 'candidate_payroll_selection_detail', $insert_candidate_payroll_selection_detail);
            }
        }
    }
}

function get_candidate_payroll_selection_detail($candidate_id)
{
    if (is_numeric($candidate_id) && $candidate_id != '' && $candidate_id > 0) {
        $CI = &get_instance();
        $CI->db->where('candidate_id', $candidate_id);
        $data = $CI->db->get(db_prefix() . 'candidate_payroll_selection_detail')->result_array();
        if (!empty($data) && isset($data[0]) && !empty($data[0])) {
            $data = $data[0];
            // <td> echo get_vessel_code_name($value['vessel_code'], 'code'); </td>
            // <td> echo get_vessel_code_name($value['vessel_code'], 'vessel_group_name'); </td>
            // <td> echo get_rank_code_name($value['rank_code'], 'code'); </td>
            // <td> echo get_rank_code_name($value['rank_code'], 'rank_name'); </td>
            $rank_code = isset($data['rank_code']) ? $data['rank_code'] : '';
            $vessel_code = isset($data['vessel_code']) ? $data['vessel_code'] : '';
            if ($rank_code != '' && $vessel_code != '') {
                // $vessel = get_vessel_code_name($vessel_code, 'code') . ' - ' . get_vessel_code_name($vessel_code, 'vessel_group_name');
                $vessel = get_vessel_code_name($vessel_code, 'vessel_group_name') . ' - ' . get_vessel_code_name($vessel_code, 'code');
                $rank = get_rank_code_name($rank_code, 'code') . ' - ' . get_rank_code_name($rank_code, 'rank_name');
                // $rank = get_rank_code_name($rank_code, 'rank_name') . ' - ' . get_rank_code_name($rank_code, 'code');
                $return['vessel'] = $vessel;
                $return['rank'] = $rank;
                return $return;
            }
        }
    }
    return [];
}


function get_payroll_rate_per_principal($id){
    if (is_numeric($id) && $id > 0) {
        $CI = &get_instance();
        $CI->db->where('id', $id);
        $data = $CI->db->get(db_prefix() . 'payroll_rate_per_principal')->result_array();
        if (!empty($data) && !empty($data[0])) {
            return $data[0];
        }
    }
    return [];
}