<?php
defined('BASEPATH') or exit('No direct script access allowed');
$aColumns = [
    db_prefix() . 'rec_candidate.id',
    db_prefix() . 'manning_agency.code',
    'candidate_code',
    db_prefix() . 'job_rank.rank_level',
    // db_prefix() . 'job_rank.rank_name as rank_name',
    'last_name',
    '1',
    db_prefix() . 'job_emp_status.emp_status_name',
    db_prefix() . 'rec_on_board_company.id',
    '2',
    '3',
    'address_country',
    'state',
    'email',
    'phonenumber',
    'birthday',
    'uniform_height',
    'uniform_waist',
    'uniform_working_gears',
    'uniform_shoes',
];
$rank_name = 3;
$sIndexColumn = db_prefix() . 'rec_candidate.id';
$sTable       = db_prefix() . 'rec_candidate';
$join         = [
    'LEFT JOIN ' . db_prefix() . 'job_rank ON ' . db_prefix() . 'rec_candidate.rank = ' . db_prefix() . 'job_rank.id',
    'LEFT JOIN ' . db_prefix() . 'manning_agency ON ' . db_prefix() . 'rec_candidate.manning_agency = ' . db_prefix() . 'manning_agency.id',
    'LEFT JOIN ' . db_prefix() . 'job_emp_status ON ' . db_prefix() . 'rec_candidate.emp_status = ' . db_prefix() . 'job_emp_status.id',
    'LEFT JOIN ' . db_prefix() . 'job_department ON ' . db_prefix() . 'rec_candidate.department = ' . db_prefix() . 'job_department.id',
    'LEFT JOIN ' . db_prefix() . 'rec_on_board_company ON ' . db_prefix() . 'rec_candidate.id = ' . db_prefix() . 'rec_on_board_company.candidate AND ' . db_prefix() . 'rec_on_board_company.cur_onboard = 1',
];
$where = [];
$string_query = '';
// Get filters from input
$religion = $this->ci->input->post('religion');
$province = $this->ci->input->post('province');
$rank = $this->ci->input->post('rank');
$vessel_name = $this->ci->input->post('vessel_name');
$emp_status = $this->ci->input->post('emp_status');
$manning_agency = $this->ci->input->post('manning_agency');
$follow_up_filter = $this->ci->input->post('follow_up_filter');

// Build query conditions based on filters
if (!empty($rank)) {
    $rank = implode(',', $rank);
    $string_query .= " " . db_prefix() . "rec_candidate.rank IN (" . $rank . ") AND";
}

if (!empty($vessel_name)) {
    $vessel_name = implode(',', $vessel_name);
    $string_query .= " " . db_prefix() . "rec_candidate.department IN (" . $vessel_name . ") AND";
}

if (!empty($religion)) {
    $religion = implode(',', $religion);
    $string_query .= " " . db_prefix() . "rec_candidate.address_country IN (" . $religion . ") AND";
}

if (!empty($province)) {
    $province = implode(',', $province);
    $string_query .= " " . db_prefix() . "rec_candidate.state IN (" . $province . ") AND";
}

if (!empty($emp_status)) {
    $emp_status = implode(',', $emp_status);
    $string_query .= " " . db_prefix() . "rec_candidate.emp_status IN (" . $emp_status . ") AND";
}

if (!empty($manning_agency)) {
    $manning_agency = implode(',', $manning_agency);
    $string_query .= " " . db_prefix() . "rec_candidate.manning_agency IN (" . $manning_agency . ") AND";
}

if ($string_query != '') {
    $string_query = rtrim($string_query, " AND");
    $where = ["WHERE " . $string_query];
}
$is_follow_up = false;
if ($follow_up_filter) {
    $CI = &get_instance();
    $CI->db->select('id');
    $candidate = $CI->db->get(db_prefix() . 'rec_candidate')->result_array();
    // $filter_id_arr = [];
    // foreach ($candidate as $key => $value) {
    //     $countData = countexpiryandfollowup($value['id']);
    //     $to_follow_up = $countData['to_follow_up'];
    //     $expired_count = $countData['expired_count'];
    //     if ($to_follow_up > 0 || $expired_count > 0) {
    //         $filter_id_arr[] = $value['id'];
    //     }
    // }
    // $where = [' AND ' . db_prefix() . 'rec_candidate.id IN (' . implode(',',$filter_id_arr) . ')'];
    $filter_id_arr_expired = [];
    $filter_id_arr_follow_up = [];

    foreach ($candidate as $key => $value) {
        $countData = countexpiryandfollowup($value['id']);
        $to_follow_up = $countData['to_follow_up'];
        $expired_count = $countData['expired_count'];
        // Classify candidates based on their counts
        if ($expired_count > 0) {
            $filter_id_arr_expired[] = $value['id']; // For expired candidates
        } elseif ($to_follow_up > 0) {
            $filter_id_arr_follow_up[] = $value['id']; // For follow-up candidates
        }
    }
    // Merge the arrays, expired first, followed by follow-ups
    $filter_id_arr = array_merge($filter_id_arr_expired, $filter_id_arr_follow_up);
    // Construct the WHERE clause
    if (!empty($filter_id_arr)) {
        $is_follow_up = true;
        $follow_up_arr = implode(',', $filter_id_arr);
        $where = [' AND ' . db_prefix() . 'rec_candidate.id IN (' . implode(',', $filter_id_arr) . ')'];
    } else {
        $where = []; // No IDs to filter
    }
}

$result = data_tables_init_custom($aColumns, $sIndexColumn, $sTable, $join, $where, [db_prefix() . 'rec_candidate.id', 'last_name', 'rate', 'status', 'candidate_name', db_prefix() . 'job_rank.rank_name'], '', [], $is_follow_up, $follow_up_arr);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];
        if ($aColumns[$i] ==  db_prefix() . 'rec_candidate.id') {
            $_data = $aRow[db_prefix() . 'rec_candidate.id'];
        } elseif ($aColumns[$i] == 'last_name') {
            $name = '';
            // $name = '<div>';
            // $name .= '<a href="' . admin_url('recruitment/candidate/' . $aRow[db_prefix() . 'rec_candidate.id']) . '">' . candidate_profile_image($aRow[db_prefix() . 'rec_candidate.id'],['staff-profile-image-small mright5',],'small') . '</a>';
            // $name .= '</div>';
            $name .= '<a style="text-wrap: nowrap;" href="' . admin_url('recruitment/candidate/' . $aRow[db_prefix() . 'rec_candidate.id']) . '" >' . $aRow['last_name'] . ' , ' .   $aRow['candidate_name'] . '</a>';
            $name .= '<div class="row-options">';
            $name .= '<a href="' . admin_url('recruitment/candidate/' . $aRow[db_prefix() . 'rec_candidate.id']) . '" >' . _l('view') . '</a>';
            if (has_permission('recruitment', '', 'edit') || is_admin()) {
                $name .= ' | <a href="' . admin_url('recruitment/candidates/' . $aRow[db_prefix() . 'rec_candidate.id']) . '" >' . _l('edit') . '</a>';
            }
            if (has_permission('recruitment', '', 'delete') || is_admin()) {
                $name .= ' | <a href="' . admin_url('recruitment/delete_candidate/' . $aRow[db_prefix() . 'rec_candidate.id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
            }
            $name .= '| <a style="cursor:pointer;" class="text-success bold" onclick="email_template_manage_send_mail(\'candidate\', ' . $aRow[db_prefix() . 'rec_candidate.id'] . '); return false;">
            <span class="fa fa-envelope"></span> ' . _l('email_template_manage_send_mail_candidate') . '</a><br>';
            $name .= '</div>';
            $_data = $name;
        } elseif ($aColumns[$i] ==  db_prefix() . 'job_rank.rank_level') {
            $rank_level = isset($aRow['tbljob_rank.rank_level']) ? $aRow['tbljob_rank.rank_level'] : 0;
            $_data = '<p style="text-wrap: nowrap;"><span style="color: white;" class="hide">' . $rank_level . '</span> ' . $aRow['rank_name'] . '</p>';
        } elseif ($aColumns[$i] == db_prefix() . 'job_rank.rank_name as rank_name') {
            $_data = $aRow['rank_name'];
        } elseif ($aColumns[$i] == 'birthday') {
            $_data = _d($aRow['birthday']);
        } elseif ($aColumns[$i] == 'uniform_height') {
            $_data = $aRow['uniform_height'];
        } elseif ($aColumns[$i] == 'uniform_waist') {
            $_data = $aRow['uniform_waist'];
        } elseif ($aColumns[$i] == 'uniform_working_gears') {
            $_data = $aRow['uniform_working_gears'];
        } elseif ($aColumns[$i] == 'uniform_shoes') {
            $_data = $aRow['uniform_shoes'];
        } elseif ($aColumns[$i] == 'rec_campaign') {
            if ($aRow['rec_campaign'] != null) {
                $cp = get_rec_campaign_hp($aRow['rec_campaign']);
                if (isset($cp)) {
                    $_data = $cp->campaign_code . ' - ' . $cp->campaign_name;
                } else {
                    $_data = '';
                }
            } else {
                $_data = '';
            }
        } elseif ($aColumns[$i] == '1') {
            $countData = countexpiryandfollowup($aRow[db_prefix() . 'rec_candidate.id']);
            $expired_count = $countData['expired_count'];
            $to_follow_up = $countData['to_follow_up'];
            $_data = '<p style="text-wrap: nowrap;">';
            if (has_permission('recruitment', '', 'edit') || is_admin()) {
                if ($aRow['status'] == 6) {
                    if ($expired_count > 0) {
                        $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow[db_prefix() . 'rec_candidate.id']) . '#licence_document_info" title="' . _l('number_of_expired_liscense_document') . '" style="background-color: #FF0000; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $expired_count . '</a>&nbsp;';
                    }
                    if ($to_follow_up > 0) {
                        $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow[db_prefix() . 'rec_candidate.id']) . '#licence_document_info" title="' . _l('number_of_document_to_be_renewed') . '" style="background-color: #0000FF; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $to_follow_up . '</a>&nbsp;';
                    }
                } else {
                    if ($expired_count > 0) {
                        $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow[db_prefix() . 'rec_candidate.id']) . '#licence_document_info" title="' . _l('number_of_expired_liscense_document') . '" style="background-color: #FF0000; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $expired_count . '</a>&nbsp;';
                    }
                    if ($to_follow_up > 0) {
                        $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow[db_prefix() . 'rec_candidate.id']) . '#licence_document_info" title="' . _l('number_of_document_to_be_renewed') . '" style="background-color: #0000FF; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $to_follow_up . '</a>&nbsp;';
                    }
                }
            } else {
                if ($expired_count > 0) {
                    $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow[db_prefix() . 'rec_candidate.id']) . '#licence_document_info" title="' . _l('number_of_expired_liscense_document') . '" style="background-color: #FF0000; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $expired_count . '</a>&nbsp;';
                }
                if ($to_follow_up > 0) {
                    $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow[db_prefix() . 'rec_candidate.id']) . '#licence_document_info" title="' . _l('number_of_document_to_be_renewed') . '" style="background-color: #0000FF; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $to_follow_up . '</a>&nbsp;';
                }
            }
            $_data .= '</p>';
        } elseif ($aColumns[$i] == db_prefix() . 'job_emp_status.emp_status_name') {
            $_data = '<p style="text-wrap: nowrap;">' . $aRow['tbljob_emp_status.emp_status_name'] . '</p>';
        } elseif ($aColumns[$i] == db_prefix() . 'rec_on_board_company.id') {
            // $_data = '<p style="text-wrap: nowrap;">' . $aRow['tblrec_on_board_company.id'] . '</p>';
            $vessel_data = get_vessel_info_in_crew_list($aRow['tblrec_on_board_company.id']);
            if (!empty($vessel_data['vessel_name'])) {
                $_data = '<p style="text-wrap: nowrap;">' . $vessel_data['vessel_name'] . '</p>';
            }else{
                $_data = '<p style="text-wrap: nowrap;"></p>';
            }
            
        } elseif ($aColumns[$i] == 'address_country') {
            $region = '<p style="text-wrap: nowrap;">' . get_select_option_name_by_id('countries_new', $aRow['address_country'], 'name') . '</p>';
            $_data = $region;
        } elseif ($aColumns[$i] == 'state') {
            $state = '<p style="text-wrap: nowrap;">' . get_select_option_name_by_id('states_new', $aRow['state'], 'name') . '</p>';
            $_data = $state;
        } elseif ($aColumns[$i] == '2') {
            // $on_board_company_data = get_on_board_company($aRow[db_prefix() . 'rec_candidate.id']);
            // $_data = $on_board_company_data['embarkation_date'] ?? '';
            $vessel_data = get_vessel_info_in_crew_list($aRow['tblrec_on_board_company.id']);
            if (!empty($vessel_data['embarkation_date'])) {
                $_data = '<p style="text-wrap: nowrap;">' . $vessel_data['embarkation_date'] . '</p>';
            }else{
                $_data = '<p style="text-wrap: nowrap;"></p>';
            }
        } elseif ($aColumns[$i] == '3') {
            // $on_board_company_data = get_on_board_company($aRow[db_prefix() . 'rec_candidate.id']);
            // $_data = $on_board_company_data['disembarkation_date'] ?? '';
            $vessel_data = get_vessel_info_in_crew_list($aRow['tblrec_on_board_company.id']);
            if (!empty($vessel_data['disembarkation_date'])) {
                $_data = '<p style="text-wrap: nowrap;">' . $vessel_data['disembarkation_date'] . '</p>';
            }else{
                $_data = '<p style="text-wrap: nowrap;"></p>';
            }
        }
        $row[] = $_data;
    }
    $output['aaData'][] = $row;
}
