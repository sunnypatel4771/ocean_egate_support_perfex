<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contract_template_merge_fields extends App_merge_fields
{
    public function build()
    {
        return [
            [
                'name'      => 'Candidate Name',
                'key'       => '{candidate_name}',
                'available' => [
                    'candidate_name',
                ],
            ],
            [
                'name'      => 'Manning Agency',
                'key'       => '{manning_agency}',
                'available' => [
                    'manning_agency',
                ],
            ],
            [
                'name'      => 'Principal',
                'key'       => '{employer}',
                'available' => [
                    'employer',
                ],
            ],

            [
                'name'      => 'Gender',
                'key'       => '{gender}',
                'available' => [
                    'gender',
                ],
            ],
            [
                'name'      => 'Birthdate', // $candidate->birthday
                'key'       => '{birthday}',
                'available' => [
                    'birthday',
                ],
            ],
            [
                'name'      => 'Birth place', //$candidate->birthplace
                'key'       => '{birthplace}',
                'available' => [
                    'birthplace',
                ],
            ],
            [
                'name'      => 'Address',
                'key'       => '{address}',
                'available' => [
                    'address',
                ],
            ],
            [
                'name'      => 'EREG NO',
                'key'       => '{ereg_no}',
                'available' => [
                    'ereg_no',
                ],
            ],
            [
                'name'      => 'Last Name',
                'key'       => '{last_name}',
                'available' => [
                    'last_name',
                ],
            ],
            // 1 
            [
                'name'      => 'Cellphone No', //$candidate->phonenumber
                'key'       => '{phonenumber}',
                'available' => [
                    'phonenumber',
                ],
            ],
            [
                'name'      => 'Email Address', // $candidate->email
                'key'       => '{email}',
                'available' => [
                    'email',
                ],
            ],
            [
                'name'      => 'Marital Status', // $candidate->marital_status
                'key'       => '{marital_status}',
                'available' => [
                    'marital_status',
                ],
            ],

            [
                'name'      => 'Official Rank', // $candidate->rank
                'key'       => '{rank}',
                'available' => [
                    'rank',
                ],
            ],

            [
                'name'      => 'Principal',
                'key'       => '{principal}',
                'available' => [
                    'principal',
                ],
            ],

            [
                'name'      => 'Vessel Name',
                'key'       => '{vessel_name}',
                'available' => [
                    'vessel_name',
                ],
            ],

            [
                'name'      => 'Job Duty',
                'key'       => '{position}',
                'available' => [
                    'position',
                ],
            ],

            [
                'name'      => 'Basic Monthly Salary',
                'key'       => '{basic_month_salary}',
                'available' => [
                    'basic_month_salary',
                ],
            ],

            [
                'name'      => 'Hours of Work',
                'key'       => '{hours_of_work}',
                'available' => [
                    'hours_of_work',
                ],
            ],

            [
                'name'      => 'Overtime',
                'key'       => '{overtime}',
                'available' => [
                    'overtime',
                ],
            ],

            [
                'name'      => 'Vacation Leave w/ Pay',
                'key'       => '{vacation_leave_w_pay}',
                'available' => [
                    'vacation_leave_w_pay',
                ],
            ],

            [
                'name'      => 'Other Allowances',
                'key'       => '{other_allowance_s}',
                'available' => [
                    'other_allowance_s',
                ],
            ],

            [
                'name'      => 'Subsistence',
                'key'       => '{subsistence}',
                'available' => [
                    'subsistence',
                ],
            ],

            [
                'name'      => 'Supervisory',
                'key'       => '{supervisory}',
                'available' => [
                    'supervisory',
                ],
            ],

            [
                'name'      => 'Contract Duration',
                'key'       => '{contract_duration}',
                'available' => [
                    'contract_duration',
                ],
            ],

            [
                'name'      => get_seafarer_identification_details('name'),
                'key'       => '{' . get_seafarer_identification_details() . '}',
                'available' => [
                    get_seafarer_identification_details(),
                ],
            ],
            // principal
            [
                'name'      => 'Principal Address',
                'key'       => '{principal_address}',
                'available' => [
                    'principal_address',
                ],
            ],

            [
                'name'      => 'IMO Number',
                'key'       => '{imo_number}',
                'available' => [
                    'imo_number',
                ],
            ],

            [
                'name'      => 'Gross Registered Tonnage (GRT)',
                'key'       => '{gross_registered_tonnage}',
                'available' => [
                    'gross_registered_tonnage',
                ],
            ],

            [
                'name'      => 'Year Built',
                'key'       => '{year_built}',
                'available' => [
                    'year_built',
                ],
            ],

            [
                'name'      => 'Flag',
                'key'       => '{flag}',
                'available' => [
                    'flag',
                ],
            ],

            [
                'name'      => 'Type of Vessel',
                'key'       => '{type_of_vessel}',
                'available' => [
                    'type_of_vessel',
                ],
            ],

            [
                'name'      => 'Classification Society',
                'key'       => '{classification_society}',
                'available' => [
                    'classification_society',
                ],
            ],

            [
                'name'      => 'Licence No',
                'key'       => '{licence_no}',
                'available' => [
                    'licence_no',
                ],
            ],



        ];
    }

    /**
     * Merge field for appointments
     * @param  mixed $hira 
     * @return array
     */
    public function format($share_obj, $candidate_id)
    {
        if (!empty($share_obj)) {
            $this->ci->load->model('recruitment_model');
            $fields = [];
            foreach ($share_obj as $key => $value) {
                preg_match_all('/\{(.*?)\}/', $value, $matches);
                $value = $matches[1];
                $not_avalable = [];
                if (in_array($value[0], $not_avalable)) {
                    $fields[$value[0]] = '';
                } elseif ($value[0] == 'principal' || $value[0] == 'employer') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->where('cur_onboard', 1);
                    $this->ci->db->order_by('id', 'DESC');
                    $employer = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row()->employer;
                    if (is_numeric($employer)) {
                        $this->ci->db->where('id', $employer);
                        $principal = $this->ci->db->get(db_prefix() . 'custom_filed_setting_principals')->row()->principal_name;
                    } else {
                        $principal = $employer;
                    }
                    $fields[$value[0]] = $principal;
                } elseif ($value[0] == 'vessel_name') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->where('cur_onboard', 1);
                    $this->ci->db->order_by('id', 'DESC');
                    $vessel_name = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row()->vessel_name;
                    if (is_numeric($vessel_name)) {
                        $this->ci->db->where('id', $vessel_name);
                        $vessel_name = $this->ci->db->get(db_prefix() . 'job_vessel_name')->row()->vessel_info_name;
                    } else {
                        $vessel_name = '';
                    }
                    $fields[$value[0]] = $vessel_name;
                } elseif ($value[0] == 'position') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->where('cur_onboard', 1);
                    $this->ci->db->order_by('id', 'DESC');
                    $position = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row()->grade_rank;
                    if (is_numeric($position)) {
                        $this->ci->db->where('id', $position);
                        $position = $this->ci->db->get(db_prefix() . 'job_duty')->row()->duty_name;
                    } else {
                        $position = '';
                    }
                    $fields[$value[0]] = $position;
                } elseif ($value[0] == get_seafarer_identification_details()) {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->where('document_type', 6);
                    $licence_no = $this->ci->db->get(db_prefix() . 'rec_travel_identification')->row()->licence_no;
                    $fields[$value[0]] = $licence_no;
                } elseif ($value[0] == 'contract_duration') {
                    $this->ci->db->where('candidate_id', $candidate_id);
                    $this->ci->db->order_by('id', 'DESC');
                    $contract_duration = $this->ci->db->get(db_prefix() . 'rec_contract')->row()->contract_duration;
                    $fields[$value[0]] = $contract_duration;
                } elseif ($value[0] == 'principal_address') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->where('cur_onboard', 1);
                    $this->ci->db->order_by('id', 'DESC');
                    $employer = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row()->employer;
                    if (is_numeric($employer)) {
                        $this->ci->db->where('id', $employer);
                        $principal_address = $this->ci->db->get(db_prefix() . 'custom_filed_setting_principals')->row()->principal_address;
                    } else {
                        $principal_address = $employer;
                    }
                    $fields[$value[0]] = $principal_address;
                } elseif ($value[0] == 'imo_number') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->order_by('id', 'DESC');
                    $this->ci->db->where('cur_onboard', 1);
                    $vessel_name = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row()->vessel_name;
                    $imo_number = '';
                    if (is_numeric($vessel_name)) {
                        $this->ci->db->where('id', $vessel_name);
                        $imo_number = $this->ci->db->get(db_prefix() . 'job_vessel_name')->row()->imo_number;
                    } else {
                        $imo_number = '';
                    }
                    $fields[$value[0]] = $imo_number;
                } elseif ($value[0] == 'gross_registered_tonnage') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->order_by('id', 'DESC');
                    $this->ci->db->where('cur_onboard', 1);
                    $vessel_name = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row()->vessel_name;
                    $gross_registered_tonnage = '';
                    if (is_numeric($vessel_name)) {
                        $this->ci->db->where('id', $vessel_name);
                        $gross_registered_tonnage = $this->ci->db->get(db_prefix() . 'job_vessel_name')->row()->grt;
                    } else {
                        $gross_registered_tonnage = '';
                    }
                    $fields[$value[0]] = $gross_registered_tonnage;
                } elseif ($value[0] == 'year_built') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->order_by('id', 'DESC');
                    $this->ci->db->where('cur_onboard', 1);
                    $vessel_name = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row()->vessel_name;
                    $year_built = '';
                    if (is_numeric($vessel_name)) {
                        $this->ci->db->where('id', $vessel_name);
                        $year_built = $this->ci->db->get(db_prefix() . 'job_vessel_name')->row()->year_built;
                    } else {
                        $year_built = '';
                    }
                    $fields[$value[0]] = $year_built;
                } elseif ($value[0] == 'flag') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->order_by('id', 'DESC');
                    $this->ci->db->where('cur_onboard', 1);
                    $vessel_name = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row()->vessel_name;
                    $flag = '';
                    if (is_numeric($vessel_name)) {
                        $this->ci->db->where('id', $vessel_name);
                        $flag = $this->ci->db->get(db_prefix() . 'job_vessel_name')->row()->flag;
                    } else {
                        $flag = '';
                    }
                    $fields[$value[0]] = $flag;
                } elseif ($value[0] == 'type_of_vessel') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->where('cur_onboard', 1);
                    $this->ci->db->order_by('id', 'DESC');
                    $vessel_name = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row()->vessel_name;
                    $type_of_vessel = '';
                    if (is_numeric($vessel_name)) {
                        $this->ci->db->where('id', $vessel_name);
                        $type_of_vessel = $this->ci->db->get(db_prefix() . 'job_vessel_name')->row()->type_of_vessel;
                    } else {
                        $type_of_vessel = '';
                    }
                    // job_vessel
                    if ($type_of_vessel != '') {
                        $this->ci->db->where('id', $type_of_vessel);
                        $type_of_vessel = $this->ci->db->get(db_prefix() . 'job_vessel')->row()->vessel_name;
                        $fields[$value[0]] = $type_of_vessel;
                    } else {
                        $fields[$value[0]] = '';
                    }
                } elseif ($value[0] == 'classification_society') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->order_by('id', 'DESC');
                    $this->ci->db->where('cur_onboard', 1);
                    $vessel_name = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row()->vessel_name;
                    $classification_society = '';
                    if (is_numeric($vessel_name)) {
                        $this->ci->db->where('id', $vessel_name);
                        $classification_society = $this->ci->db->get(db_prefix() . 'job_vessel_name')->row()->classification_society;
                    } else {
                        $classification_society = '';
                    }
                    $fields[$value[0]] = $classification_society;
                } elseif ($value[0] == 'basic_month_salary') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->order_by('id', 'DESC');
                    $this->ci->db->where('cur_onboard', 1);
                    $on_board_company_data = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row();

                    // custom_filed_setting_salary_scale
                    $this->ci->db->where('principal', $on_board_company_data->employer);
                    $this->ci->db->where('vessel_name', $on_board_company_data->vessel_name);
                    $this->ci->db->where('position', $on_board_company_data->grade_rank);

                    $basic_month_salary = $this->ci->db->get(db_prefix() . 'custom_filed_setting_salary_scale')->row()->basic_month_salary;
                    $fields[$value[0]] = $basic_month_salary;
                } elseif ($value[0] == 'hours_of_work' || $value[0] == 'overtime' || $value[0] == 'vacation_leave_w_pay' || $value[0] == 'other_allowance_s' || $value[0] == 'subsistence' || $value[0] == 'supervisory') {
                    $this->ci->db->where('candidate', $candidate_id);
                    $this->ci->db->order_by('id', 'DESC');
                    $this->ci->db->where('cur_onboard', 1);
                    $on_board_company_data = $this->ci->db->get(db_prefix() . 'rec_on_board_company')->row();

                    // custom_filed_setting_salary_scale
                    $this->ci->db->where('principal', $on_board_company_data->employer);
                    $this->ci->db->where('vessel_name', $on_board_company_data->vessel_name);
                    $this->ci->db->where('position', $on_board_company_data->grade_rank);
                    $field_value = $this->ci->db->get(db_prefix() . 'custom_filed_setting_salary_scale')->row();
                    // $field_value = $this->ci->db->get(db_prefix() . 'custom_filed_setting_salary_scale')->row()->$value[0];
                    if ($value[0] == 'hours_of_work') {
                        $fields[$value[0]] = $field_value->hours_of_work;
                    } elseif ($value[0] == 'overtime') {
                        $fields[$value[0]] = $field_value->overtime;
                    } elseif ($value[0] == 'vacation_leave_w_pay') {
                        $fields[$value[0]] = $field_value->vacation_leave_w_pay;
                    } elseif ($value[0] == 'other_allowance_s') {
                        $fields[$value[0]] = $field_value->other_allowance_s;
                    } elseif ($value[0] == 'subsistence') {
                        $fields[$value[0]] = $field_value->subsistence;
                    } elseif ($value[0] == 'supervisory') {
                        $fields[$value[0]] = $field_value->supervisory;
                    }
                } elseif ($value[0] == 'licence_no') {
                    $licence = $this->ci->db
                        ->where('candidate', $candidate_id)
                        ->where('mark', 1)
                        ->get(db_prefix() . 'rec_licence_3')
                        ->row();

                    $licence_no = !empty($licence) ? $licence->licence_no : '';
                    $fields[$value[0]] = $licence_no;
                } else {
                    $candidate_detail = $this->ci->recruitment_model->get_candidate_detail_by_field($value[0], $candidate_id);
                    if (!empty($candidate_detail)) {
                        $candidate_detail = $candidate_detail[0];
                        $fields_val = isset($candidate_detail[$value[0]]) ? $candidate_detail[$value[0]] : '';
                        $fields[$value[0]] = $fields_val;
                    }
                }
            }
            return $fields;
        }
        return [];
        // return $fields;
    }
}
