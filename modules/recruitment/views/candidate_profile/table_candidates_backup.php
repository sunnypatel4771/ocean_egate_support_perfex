<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'id',
    'candidate_code',
    'rank',
    'candidate_name',
    '1',
    'emp_status',
    'department',
    '2',
    'address_country',
    'state',
    'email',
    'phonenumber',
    'birthday',
    // 'rec_campaign',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'rec_candidate';
$join         = [];
$where = [];
$string_query = '';

// $campaign_filter = $this->ci->input->post('campaign_filter');
// $status_filter = $this->ci->input->post('status_filter');

// if (isset($campaign_filter) && ($campaign_filter != '')) {
//     $campaign_filter = implode(',', $campaign_filter);
//     $string_query .= " rec_campaign IN (" . $campaign_filter . ") AND";
// }

// if (isset($status_filter) && ($status_filter != '')) {
//     $status_filter = implode(',', $status_filter);
//     $string_query .= " status IN (" . $status_filter . ") AND";
// }

// if ($string_query != '') {
//     $string_query = rtrim($string_query, " AND");
//     $where = ["where" . ' ' . $string_query];
// }

$religion = $this->ci->input->post('religion');
$province = $this->ci->input->post('province');
$rank = $this->ci->input->post('rank');
$vessel_name = $this->ci->input->post('vessel_name');


if (isset($rank) && ($rank != '')) {
    $rank = implode(',', $rank);
    $string_query .= " rank IN (" . $rank . ") AND";
}

if (isset($vessel_name) && ($vessel_name != '')) {
    $vessel_name = implode(',', $vessel_name);
    $string_query .= " department IN (" . $vessel_name . ") AND";
}

if (isset($religion) && ($religion != '')) {
    $religion = implode(',', $religion);
    $string_query .= " address_country IN (" . $religion . ") AND";
}

if (isset($province) && ($province != '')) {
    $province = implode(',', $province);
    $string_query .= " state IN (" . $province . ") AND";
}

if ($string_query != '') {
    $string_query = rtrim($string_query, " AND");
    $where = ["where" . ' ' . $string_query];
}



$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['id', 'last_name', 'rate', 'status']);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];

        if ($aColumns[$i] == 'id') {
            $_data = $aRow['id'];
        } elseif ($aColumns[$i] == 'candidate_name') {
            $name = '<a href="' . admin_url('recruitment/candidate/' . $aRow['id']) . '">' . candidate_profile_image($aRow['id'], [
                'staff-profile-image-small mright5',
            ], 'small') . '</a>';

            $name .= '<a href="' . admin_url('recruitment/candidate/' . $aRow['id']) . '" >' . $aRow['candidate_name'] . ' ' . $aRow['last_name'] . '</a>';

            $name .= '<div class="row-options">';

            $name .= '<a href="' . admin_url('recruitment/candidate/' . $aRow['id']) . '" >' . _l('view') . '</a>';

            if (has_permission('recruitment', '', 'edit') || is_admin()) {
                $name .= ' | <a href="' . admin_url('recruitment/candidates/' . $aRow['id']) . '" >' . _l('edit') . '</a>';
            }

            if (has_permission('recruitment', '', 'delete') || is_admin()) {
                $name .= ' | <a href="' . admin_url('recruitment/delete_candidate/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
            }

            $name .= '| <a style="cursor:pointer;" class="text-success bold" onclick="email_template_manage_send_mail(\'candidate\', ' . $aRow['id'] . '); return false;">
            <span class="fa fa-envelope"></span>'
            . _l('email_template_manage_send_mail') . '</a>';

            $name .= '</div>';

            $_data = $name;
        } elseif ($aColumns[$i] == 'rank') {
            $camption_name = get_camption_name($aRow['rank']);
            $_data = isset($camption_name->rank_name) ? $camption_name->rank_name : '';
        } elseif ($aColumns[$i] == 'birthday') {
            $_data = _d($aRow['birthday']);
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
            $countData = countexpiryandfollowup($aRow['id']);
            $expired_count = $countData['expired_count'];
            $to_follow_up = $countData['to_follow_up'];

            $_data = '';

            if (has_permission('recruitment', '', 'edit') || is_admin()) {
                if ($aRow['status'] == 6) {
                    if ($expired_count > 0) {
                        $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow['id']) . '" title="' . _l('number_of_expired_liscense_document') . '" style="background-color: #FF0000; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $expired_count . '</a>&nbsp;';
                    }
                    if ($to_follow_up > 0) {
                        $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow['id']) . '" title="' . _l('number_of_document_to_be_renewed') . '" style="background-color: #0000FF; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $to_follow_up . '</a>&nbsp;';
                    }
                } else {
                    if ($expired_count > 0) {
                        $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow['id']) . '" title="' . _l('number_of_expired_liscense_document') . '" style="background-color: #FF0000; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $expired_count . '</a>&nbsp;';
                    }
                    if ($to_follow_up > 0) {
                        $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow['id']) . '" title="' . _l('number_of_document_to_be_renewed') . '" style="background-color: #0000FF; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $to_follow_up . '</a>&nbsp;';
                    }
                }
            } else {
                if ($expired_count > 0) {
                    $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow['id']) . '" title="' . _l('number_of_expired_liscense_document') . '" style="background-color: #FF0000; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $expired_count . '</a>&nbsp;';
                }
                if ($to_follow_up > 0) {
                    $_data .= '<a href="' . admin_url('recruitment/candidate/' . $aRow['id']) . '" title="' . _l('number_of_document_to_be_renewed') . '" style="background-color: #0000FF; color: white; padding: 5px; border-radius: 50%; display: inline-block; width: 20px; height: 20px; text-align: center; line-height: 10px;">' . $to_follow_up . '</a>&nbsp;';
                }
            }
        } elseif ($aColumns[$i] == 'emp_status') {
            $emp_status = get_select_option_name_by_id('job_emp_status', $aRow['emp_status'], 'emp_status_name');
            $_data =  $emp_status;
        } elseif ($aColumns[$i] == 'department') {
            $department_name = get_select_option_name_by_id('job_department', $aRow['department'], 'department_name');
            $_data =  $department_name;
        }  elseif ($aColumns[$i] == '2') {
            $vessel = get_select_option_name_by_id('job_emp_status', $aRow['emp_status'], 'emp_status_name');
           
            if($vessel == 'ONBOARD') {
                $viesel_id = get_viesel_name_id($aRow['id']);
                $_data =get_select_option_name_by_id('job_vessel_name', $viesel_id, 'vessel_info_name');
            } else {
                $_data =  $vessel;
            }
        }
         elseif ($aColumns[$i] == 'address_country') {
            $region = get_select_option_name_by_id('countries_new', $aRow['address_country'], 'name');
            $_data = $region;
        } elseif ($aColumns[$i] == 'state') {
            $state = get_select_option_name_by_id('states_new', $aRow['state'], 'name');
            $_data = $state;
        }
        // elseif ($aColumns[$i] == 'rate') {
        //     if (has_permission('recruitment', '', 'edit') || is_admin()) {
        //         if ($aRow['status'] == 6) {
        //             $_data = '<a href="' . admin_url('recruitment/transfer_to_hr/' . $aRow['id']) . '" class="btn btn-success" >' . _l('tranfer_personnels') . '</a>';
        //         } else {
        //             $_data = '';
        //         }
        //     } else {
        //         $_data = '';
        //     }
        // } elseif ($aColumns[$i] == 'status') {
        //     $_data = get_status_candidate($aRow['status']);
        // }


        $row[] = $_data;
    }

    $output['aaData'][] = $row;
}
