<?php
defined('BASEPATH') or exit('No direct script access allowed');

hooks()->add_action('after_email_templates', 'add_hris_email_templates');
/**
 * Check whether column exists in a table
 * Custom function because Codeigniter is caching the tables and this is causing issues in migrations
 * @param  string $column column name to check
 * @param  string $table table name to check
 * @return boolean
 */
function handle_rec_proposal_file($id)
{

    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {

        hooks()->do_action('before_upload_contract_attachment', $id);
        $path = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/proposal/' . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename    = unique_filename($path, $_FILES['file']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI           = &get_instance();
                $attachment   = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype'  => $_FILES['file']['type'],
                ];
                $CI->misc_model->add_attachment_to_database($id, 'rec_proposal', $attachment);

                return true;
            }
        }
    }

    return false;
}

/**
 * reformat currency rec
 * @param  string $value
 * @return string
 */
function reformat_currency_rec($value)
{
    return str_replace(',', '', $value);
}

/**
 * get rec dpm name
 * @param  int $id
 * @return string
 */
function get_rec_dpm_name($id)
{
    $CI           = &get_instance();
    if ($id != 0) {
        $CI->db->where('departmentid', $id);
        $dpm = $CI->db->get(db_prefix() . 'departments')->row();
        if ($dpm->name) {
            return $dpm->name;
        } else {
            return '';
        }
    } else {
        return '';
    }
}

/**
 * get rec position name
 * @param  int $id
 * @return string
 */
function get_rec_position_name($id)
{
    $CI           = &get_instance();
    if ($id != 0) {
        $CI->db->where('position_id', $id);
        $dpm = $CI->db->get(db_prefix() . 'rec_job_position')->row();
        if ($dpm->position_name) {
            return $dpm->position_name;
        } else {
            return '';
        }
    } else {
        return '';
    }
}

/**
 * handle rec campaign file
 * @param  int $id 
 * @return bool
 */
function handle_rec_campaign_file($id)
{
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {

        hooks()->do_action('before_upload_contract_attachment', $id);
        $path = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/campaign/' . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename    = unique_filename($path, $_FILES['file']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI           = &get_instance();
                $attachment   = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype'  => $_FILES['file']['type'],
                ];
                $CI->misc_model->add_attachment_to_database($id, 'rec_campaign', $attachment);

                return true;
            }
        }
    }

    return false;
}

/**
 * handle rec candidate file
 * @param  int $id
 * @return bool
 */
function handle_rec_candidate_file($id)
{
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {

        hooks()->do_action('before_upload_contract_attachment', $id);
        $path = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/files/' . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename    = unique_filename($path, $_FILES['file']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI           = &get_instance();
                $attachment   = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype'  => $_FILES['file']['type'],
                ];
                $CI->misc_model->add_attachment_to_database($id, 'rec_cadidate_file', $attachment);
                return true;
            }
        }
    }
    return false;
}

/**
 * handle rec candidate avar file
 * @param  int $id
 * @return bool   
 */
function handle_rec_candidate_avar_file($id)
{

    if (isset($_FILES['cd_avar']['name']) && $_FILES['cd_avar']['name'] != '') {

        hooks()->do_action('before_upload_contract_attachment', $id);
        $path = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['cd_avar']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename    = unique_filename($path, $_FILES['cd_avar']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI           = &get_instance();
                $attachment   = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype'  => $_FILES['cd_avar']['type'],
                ];
                $CI->misc_model->add_attachment_to_database($id, 'rec_cadidate_avar', $attachment);

                return true;
            }
        }
    }

    return false;
}

/**
 * get rec campaign hp
 * @param  string $id
 * @return string
 */
function get_rec_campaign_hp($id = '')
{
    $CI           = &get_instance();
    if ($id != '') {
        $CI->db->where('cp_id', $id);
        return $CI->db->get(db_prefix() . 'rec_campaign')->row();
    } elseif ($id == '') {
        return $CI->db->get(db_prefix() . 'rec_campaign')->result_array();
    }
}


function get_camption_name($id = '')
{
    $CI = &get_instance();
    if ($id != '') {
        $CI->db->select('rank_name');
        $CI->db->where('id', $id);
        return $CI->db->get(db_prefix() . 'job_rank')->row();
    }
}

function get_camption_rank_level($id = '')
{
    $CI = &get_instance();
    if ($id != '') {
        $CI->db->select('rank_level');
        $CI->db->where('id', $id);
        return $CI->db->get(db_prefix() . 'job_rank')->row();
    }
}

function get_select_option_name_by_id($table = '', $id = '', $name = '')
{
    $CI = &get_instance();
    if ($id != '') {
        $CI->db->select($name);
        $CI->db->where('id', $id);
        $query = $CI->db->get(db_prefix() . $table);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->$name;
        } else {
            return '';
        }
    }
    return '';
}



/**
 * get status candidate
 * @param  int $status
 * @return string
 */
function get_status_candidate($status)
{
    $result = '';
    if ($status == 1) {
        $result = '<span class="label label inline-block project-status-' . $status . ' application-style"> ' . _l('application') . ' </span>';
    } elseif ($status == 2) {
        $result = '<span class="label label inline-block project-status-' . $status . ' potential-style"> ' . _l('potential') . ' </span>';
    } elseif ($status == 3) {
        $result = '<span class="label label inline-block project-status-' . $status . ' interview-style"> ' . _l('interview') . ' </span>';
    } elseif ($status == 4) {
        $result = '<span class="label label inline-block project-status-' . $status . ' won_interview-style"> ' . _l('won_interview') . ' </span>';
    } elseif ($status == 5) {
        $result = '<span class="label label inline-block project-status-' . $status . ' send_offer-style"> ' . _l('send_offer') . ' </span>';
    } elseif ($status == 6) {
        $result = '<span class="label label inline-block project-status-' . $status . ' elect-style"> ' . _l('elect') . ' </span>';
    } elseif ($status == 7) {
        $result = '<span class="label label inline-block project-status-' . $status . ' non_elect-style"> ' . _l('non_elect') . ' </span>';
    } elseif ($status == 8) {
        $result = '<span class="label label inline-block project-status-' . $status . ' unanswer-style"> ' . _l('unanswer') . ' </span>';
    } elseif ($status == 9) {
        $result = '<span class="label label inline-block project-status-' . $status . ' transferred-style"> ' . _l('transferred') . ' </span>';
    } elseif ($status == 10) {
        $result = '<span class="label label inline-block project-status-' . $status . ' freedom-style"> ' . _l('freedom') . ' </span>';
    }
    return $result;
}

/**
 * candidate profile image
 * @param  int $id     
 * @param  array  $classes
 * @param  string $type   
 * @param  array  $img_attrs
 * @return string
 */
function candidate_profile_image($id, $classes = ['staff-profile-image'], $type = 'small', $img_attrs = [])
{
    $CI           = &get_instance();
    $url = base_url('assets/images/user-placeholder.jpg');
    $_attributes = '';
    foreach ($img_attrs as $key => $val) {
        $_attributes .= $key . '=' . '"' . html_escape($val) . '" ';
    }
    $blankImageFormatted = '<img src="' . $url . '" ' . $_attributes . ' class="' . implode(' ', $classes) . '"/>';
    $CI->db->where('rel_id', $id);
    $CI->db->where('rel_type', 'rec_cadidate_avar');
    $result = $CI->db->get(db_prefix() . 'files')->row();

    if (!$result) {
        return $blankImageFormatted;
    }

    if ($result && $result->file_name !== null) {
        $profileImagePath = RECRUITMENT_PATH . 'candidate/avartar/' . $id . '/' . $result->file_name;
        if (file_exists($profileImagePath)) {
            $profile_image = '<img ' . $_attributes . ' src="' . site_url($profileImagePath) . '" class="' . implode(' ', $classes) . '" />';
        } else {
            return $blankImageFormatted;
        }
    } else {
        $profile_image = '<img src="' . $url . '" ' . $_attributes . ' class="' . implode(' ', $classes) . '" />';
    }

    return $profile_image;
}

/**
 * get candidate name
 * @param  int $id
 * @return string
 */
function get_candidate_name($id)
{
    $CI           = &get_instance();
    $CI->db->where('id', $id);
    $candidate = $CI->db->get(db_prefix() . 'rec_candidate')->row();
    if ($candidate && $candidate->candidate_name != '') {
        return $candidate->candidate_name . ' ' . $candidate->last_name;
    } else {
        return '';
    }
}

/**
 * get candidate interview
 * @param  int $id
 * @return 
 */
function get_candidate_interview($id)
{
    $CI = &get_instance();
    $CI->db->where('interview', $id);
    $data_rs = array();
    $cdinterview = $CI->db->get(db_prefix() . 'cd_interview')->result_array();
    foreach ($cdinterview as $cd) {
        $data_rs[] = $cd['candidate'];
    }
    return $data_rs;
}

/**
 * count criteria
 * @param  int $id
 * @return int
 */
function count_criteria($id)
{
    $CI           = &get_instance();
    $CI->db->where('evaluation_form', $id);
    $list = $CI->db->get(db_prefix() . 'rec_list_criteria')->result_array();

    return count($list);
}

/**
 * get criteria name
 * @param  int $id
 * @return string
 */
function get_criteria_name($id)
{
    $CI           = &get_instance();
    $CI->db->where('criteria_id', $id);
    $CI->db->select('criteria_title');
    $list = $CI->db->get(db_prefix() . 'rec_criteria')->row();
    if ($list->criteria_title) {
        return $list->criteria_title;
    } else {
        return '';
    }
}

/**
 * handle rec set transfer record
 * @param  int $id
 * @return bool
 */
function handle_rec_set_transfer_record($id)
{

    if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '') {
        hooks()->do_action('before_upload_contract_attachment', $id);
        $path = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['attachment']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename    = unique_filename($path, $_FILES['attachment']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI           = &get_instance();
                $attachment   = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype'  => $_FILES['attachment']['type'],
                ];
                $CI->misc_model->add_attachment_to_database($id, 'rec_set_transfer', $attachment);

                return true;
            }
        }
    }

    return false;
}

/**
 * Gets the staff email by identifier.
 *
 * @param      int   $id     The identifier
 *
 * @return     String  The staff email by identifier.
 */
function get_staff_email_by_id_rec($id)
{
    $CI           = &get_instance();
    $CI->db->where('staffid', $id);
    $staff = $CI->db->select('email')->from(db_prefix() . 'staff')->get()->row();

    return ($staff ? $staff->email : '');
}


/**
 * [handle rec candidate file form description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function handle_rec_candidate_file_form($id)
{
    if (isset($_FILES['file-input']['name']) && $_FILES['file-input']['name'] != '') {

        hooks()->do_action('before_upload_contract_attachment', $id);
        $path = RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/files/' . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['file-input']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename    = unique_filename($path, $_FILES['file-input']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI           = &get_instance();
                $attachment   = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype'  => $_FILES['file-input']['type'],
                ];
                $CI->misc_model->add_attachment_to_database($id, 'rec_cadidate_file', $attachment);

                return true;
            }
        }
    }
    return false;
}

/**
 * Format html task assignees
 * This function is used to save up on query
 * @param  string $ids   string coma separated assignee staff id
 * @param  string $names compa separated in the same order like assignee ids
 * @return string
 */
function format_members_by_ids_and_names_recruitment($ids, $names, $hidden_export_table = true, $image_class = 'staff-profile-image-small')
{
    $outputAssignees = '';
    $exportAssignees = '';

    $assignees   = explode(',', $names);
    $assigneeIds = explode(',', $ids);
    foreach ($assignees as $key => $assigned) {
        $assignee_id = $assigneeIds[$key];
        $assignee_id = trim($assignee_id);
        if ($assigned != '') {
            $outputAssignees .= '<a href="' . admin_url('profile/' . $assignee_id) . '">' .
                staff_profile_image($assignee_id, [
                    $image_class . ' mright5',
                ], 'small', [
                    'data-toggle' => 'tooltip',
                    'data-title'  => $assigned,
                ]) . '</a>';
            $exportAssignees .= $assigned . ', ';
        }
    }

    if ($exportAssignees != '') {
        $outputAssignees .= '<span class="hide">' . mb_substr($exportAssignees, 0, -2) . '</span>';
    }

    return $outputAssignees;
}

/**
 * get_kan ban status candidate color
 * @param  integer  $status 
 * @param  boolean $name   
 * @return string         
 */
function get_kan_ban_status_candidate_color($status_id, $statuses, $name = false)
{
    // Check if status_id exists in the statuses array
    if (array_key_exists($status_id, $statuses)) {
        if ($name) {
            return $statuses[$status_id]['status'];
        } else {
            return 'background-color: ' . $statuses[$status_id]['color'] . ';';
        }
    }

    return '';
}


/**
 * Used for customer forms eq. leads form, builded from the form builder plugin
 * @param  object $field field from database
 * @return mixed
 */
function render_form_builder_field_recruitment($field)
{

    $type         = $field->type;
    $classNameCol = 'col-md-12';
    if (isset($field->className)) {
        if (strpos($field->className, 'form-col') !== false) {
            $classNames = explode(' ', $field->className);
            if (is_array($classNames)) {
                $classNameColArray = array_filter($classNames, function ($class) {
                    return startsWith($class, 'form-col');
                });

                $classNameCol = implode(' ', $classNameColArray);
                $classNameCol = trim($classNameCol);

                $classNameCol = str_replace('form-col-xs', 'col-xs', $classNameCol);
                $classNameCol = str_replace('form-col-sm', 'col-sm', $classNameCol);
                $classNameCol = str_replace('form-col-md', 'col-md', $classNameCol);
                $classNameCol = str_replace('form-col-lg', 'col-lg', $classNameCol);

                // Default col-md-X
                $classNameCol = str_replace('form-col', 'col-md', $classNameCol);
            }
        }
    }

    echo '<div class="' . $classNameCol . '">';
    if ($type == 'header' || $type == 'paragraph') {
        echo '<' . $field->subtype . ' class="' . (isset($field->className) ? $field->className : '') . '">' . check_for_links(nl2br($field->label)) . '</' . $field->subtype . '>';
    } else {
        echo '<div class="form-group" data-type="' . $type . '" data-name="' . $field->name . '" data-required="' . (isset($field->required) ? true : 'false') . '">';
        echo '<label class="control-label" for="' . $field->name . '">' . (isset($field->required) ? ' <span class="text-danger">* </span> ' : '') . $field->label . '' . (isset($field->description) ? ' <i class="fa fa-question-circle" data-toggle="tooltip" data-title="' . $field->description . '" data-placement="' . (is_rtl(true) ? 'left' : 'right') . '"></i>' : '') . '</label>';
        if (isset($field->subtype) && $field->subtype == 'color') {
            echo '<div class="input-group colorpicker-input">
     <input' . (isset($field->required) ? ' required="true"' : '') . ' placeholder="' . (isset($field->placeholder) ? $field->placeholder : '') . '" type="text"' . (isset($field->value) ? ' value="' . $field->value . '"' : '') . ' name="' . $field->name . '" id="' . $field->name . '" class="' . (isset($field->className) ? $field->className : '') . '" />
         <span class="input-group-addon"><i></i></span>
     </div>';
        } elseif (($type == 'file' || $type == 'text' || $type == 'number') && ($field->name != 'skill')) {
            $ftype = isset($field->subtype) ? $field->subtype : $type;
            echo '<input' . (isset($field->required) ? ' required="true"' : '') . (isset($field->placeholder) ? ' placeholder="' . $field->placeholder . '"' : '') . ' type="' . $ftype . '" name="' . $field->name . '" id="' . $field->name . '" class="' . (isset($field->className) ? $field->className : '') . '" value="' . (isset($field->value) ? $field->value : '') . '"' . ($field->type == 'file' ? ' accept="' . get_form_accepted_mimes() . '" filesize="' . file_upload_max_size() . '"' : '') . '>';
        } elseif ($type == 'textarea') {
            echo '<textarea' . (isset($field->required) ? ' required="true"' : '') . ' id="' . $field->name . '" name="' . $field->name . '" rows="' . (isset($field->rows) ? $field->rows : '4') . '" class="' . (isset($field->className) ? $field->className : '') . '" placeholder="' . (isset($field->placeholder) ? $field->placeholder : '') . '">' . (isset($field->value) ? $field->value : '') . '</textarea>';
        } elseif ($type == 'date') {
            echo '<input' . (isset($field->required) ? ' required="true"' : '') . ' placeholder="' . (isset($field->placeholder) ? $field->placeholder : '') . '" type="text" class="' . (isset($field->className) ? $field->className : '') . ' datepicker" name="' . $field->name . '" id="' . $field->name . '" value="' . (isset($field->value) ? _d($field->value) : '') . '">';
        } elseif ($type == 'datetime-local') {
            echo '<input' . (isset($field->required) ? ' required="true"' : '') . ' placeholder="' . (isset($field->placeholder) ? $field->placeholder : '') . '" type="text" class="' . (isset($field->className) ? $field->className : '') . ' datetimepicker" name="' . $field->name . '" id="' . $field->name . '" value="' . (isset($field->value) ? _dt($field->value) : '') . '">';
        } elseif ($type == 'select') {
            echo '<select' . (isset($field->required) ? ' required="true"' : '') . '' . (isset($field->multiple) ? ' multiple="true"' : '') . ' class="' . (isset($field->className) ? $field->className : '') . '" name="' . $field->name . (isset($field->multiple) ? '[]' : '') . '" id="' . $field->name . '"' . (isset($field->values) && count($field->values) > 10 ? 'data-live-search="true"' : '') . 'data-none-selected-text="' . (isset($field->placeholder) ? $field->placeholder : '') . '">';
            $values = [];
            if (isset($field->values) && count($field->values) > 0) {
                foreach ($field->values as $option) {
                    echo '<option value="' . $option->value . '" ' . (isset($option->selected) ? ' selected' : '') . '>' . $option->label . '</option>';
                }
            }
            echo '</select>';
        } elseif ($type == 'checkbox-group') {
            $values = [];
            if (isset($field->values) && count($field->values) > 0) {
                $i = 0;
                echo '<div class="chk">';
                foreach ($field->values as $checkbox) {
                    echo '<div class="checkbox' . ((isset($field->inline) && $field->inline == 'true') || (isset($field->className) && strpos($field->className, 'form-inline-checkbox') !== false) ? ' checkbox-inline' : '') . '">';
                    echo '<input' . (isset($field->required) ? ' required="true"' : '') . ' class="' . (isset($field->className) ? $field->className : '') . '" type="checkbox" id="chk_' . $field->name . '_' . $i . '" value="' . $checkbox->value . '" name="' . $field->name . '[]"' . (isset($checkbox->selected) ? ' checked' : '') . '>';
                    echo '<label for="chk_' . $field->name . '_' . $i . '">';
                    echo html_entity_decode($checkbox->label);
                    echo '</label>';
                    echo '</div>';
                    $i++;
                }
                echo '</div>';
            }
        }
        echo '</div>';
    }
    echo '</div>';
}


/**
 * row options exist
 * @param  string $name 
 *        
 */
function recruitment_row_options_exist($name)
{
    $CI = &get_instance();
    $i = count($CI->db->query('Select * from ' . db_prefix() . 'options where name = ' . $name)->result_array());
    if ($i == 0) {
        return 0;
    }
    if ($i > 0) {
        return 1;
    }
}

/**
 * Gets the recruitment option.
 *
 * @param      <type>        $name   The name
 *
 * @return     array|string  The recruitment option.
 */
function get_recruitment_option($name)
{
    $CI = &get_instance();
    $options = [];
    $val  = '';
    $name = trim($name);


    if (!isset($options[$name])) {
        // is not auto loaded
        $CI->db->select('value');
        $CI->db->where('name', $name);
        $row = $CI->db->get(db_prefix() . 'options')->row();
        if ($row) {
            $val = $row->value;
        }
    } else {
        $val = $options[$name];
    }

    return $val;
}

function get_tab_option($name)
{
    $CI = &get_instance();
    $options = [];
    $val  = '';
    $name = trim($name);


    if (!isset($options[$name])) {
        // is not auto loaded
        $CI->db->select('value');
        $CI->db->where('name', $name);
        $row = $CI->db->get(db_prefix() . 'options')->row();
        if ($row) {
            $val = $row->value;
        }
    } else {
        $val = $options[$name];
    }

    return $val;
}

/**
 * handle company attchment
 * @param  integer $id
 * @return array or row
 */
function handle_company_attachments($id)
{

    if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])) {
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }
    $path = RECRUITMENT_COMPANY_UPLOAD . $id . '/';
    $CI   = &get_instance();

    if (isset($_FILES['file']['name'])) {
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {

            _maybe_create_upload_path($path);
            $filename    = $_FILES['file']['name'];
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $attachment   = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype'  => $_FILES['file']['type'],
                ];

                $CI->misc_model->add_attachment_to_database($id, 'rec_company', $attachment);
            }
        }
    }
}

/**
 * get industry name
 * @param  integer $id 
 * @return string     
 */
function get_rec_industry_name($id)
{
    $CI = &get_instance();
    $CI->db->where('id', $id);
    $job_industry = $CI->db->get(db_prefix() . 'job_industry')->row();

    if ($job_industry) {
        return $job_industry->industry_name;
    } else {
        return '';
    }
}

/**
 * get company name
 * @param  integer $id 
 * @return string    
 */
function get_rec_company_name($id)
{
    $CI = &get_instance();
    $CI->db->where('id', $id);
    $rec_company = $CI->db->get(db_prefix() . 'rec_company')->row();

    if ($rec_company) {
        return $rec_company->company_name;
    } else {
        return '';
    }
}

/*separation portal v1.1.2*/

/**
 * app rec portal head
 * @param  [type] $language 
 * @return [type]           
 */
function app_rec_portal_head($language = null)
{
    // $language param is deprecated
    if (is_null($language)) {
        $language = $GLOBALS['language'];
    }
    if (file_exists(FCPATH . 'assets/css/custom.css')) {
        echo '<link href="' . base_url('assets/css/custom.css') . '" rel="stylesheet" type="text/css" id="custom-css">' . PHP_EOL;
    }
    hooks()->do_action('app_rec_portal_head');
}

/**
 * get template part rec portal
 * @param      string   $name    The name
 * @param      array    $data    The data
 * @param      boolean  $return  The return
 *
 * @return     string   The template part.
 */
function get_template_part_rec_portal($name, $data = [], $return = false)
{
    if ($name === '') {
        return '';
    }

    $CI   = &get_instance();
    $path = 'recruitment_portal/template_parts/';

    if ($return == true) {
        return $CI->load->view($path . $name, $data, true);
    }

    $CI->load->view($path . $name, $data);
}

/**
 * init rec_portal area assets.
 */
function init_rec_portal_area_assets()
{
    // Used by themes to add assets
    hooks()->do_action('app_rec_portal_assets');

    hooks()->do_action('app_client_assets_added');
}

/**
 * { register theme rec_portal assets hook }
 *
 * @param      <type>   $function  The function
 *
 * @return     boolean  
 */
function register_theme_rec_portal_assets_hook($function)
{
    if (hooks()->has_action('app_rec_portal_assets', $function)) {
        return false;
    }

    return hooks()->add_action('app_rec_portal_assets', $function, 1);
}

/**
 * { app theme head hook }
 */
function app_theme_rec_portal_head_hook()
{
    $CI = &get_instance();
    ob_start();
    echo get_custom_fields_hyperlink_js_function();

    if (
        get_option('use_recaptcha_customers_area') == 1
        && get_option('recaptcha_secret_key') != ''
        && get_option('recaptcha_site_key') != ''
    ) {
        echo "<script src='https://www.google.com/recaptcha/api.js'></script>";
    }

    $isRTL = (is_rtl_rec(true) ? 'true' : 'false');

    $locale = get_locale_key($GLOBALS['language']);

    $maxUploadSize = file_upload_max_size();

    $date_format = get_option('dateformat');
    $date_format = explode('|', $date_format);
    $date_format = $date_format[0]; ?>
    <script>
        <?php if (is_staff_logged_in()) {
        ?>
            var admin_url = '<?php echo admin_url(); ?>';
        <?php
        } ?>

        var site_url = '<?php echo site_url(''); ?>',
            app = {},
            cfh_popover_templates = {};

        app.isRTL = '<?php echo html_entity_decode($isRTL); ?>';
        app.is_mobile = '<?php echo is_mobile(); ?>';
        app.months_json = '<?php echo json_encode([_l('January'), _l('February'), _l('March'), _l('April'), _l('May'), _l('June'), _l('July'), _l('August'), _l('September'), _l('October'), _l('November'), _l('December')]); ?>';

        app.browser = "<?php echo strtolower($CI->agent->browser()); ?>";
        app.max_php_ini_upload_size_bytes = "<?php echo html_entity_decode($maxUploadSize); ?>";
        app.locale = "<?php echo html_entity_decode($locale); ?>";

        app.options = {
            calendar_events_limit: "<?php echo get_option('calendar_events_limit'); ?>",
            calendar_first_day: "<?php echo get_option('calendar_first_day'); ?>",
            tables_pagination_limit: "<?php echo get_option('tables_pagination_limit'); ?>",
            enable_google_picker: "<?php echo get_option('enable_google_picker'); ?>",
            google_client_id: "<?php echo get_option('google_client_id'); ?>",
            google_api: "<?php echo get_option('google_api_key'); ?>",
            default_view_calendar: "<?php echo get_option('default_view_calendar'); ?>",
            timezone: "<?php echo get_option('default_timezone'); ?>",
            allowed_files: "<?php echo get_option('allowed_files'); ?>",
            date_format: "<?php echo html_entity_decode($date_format); ?>",
            time_format: "<?php echo get_option('time_format'); ?>",
        };

        app.lang = {
            file_exceeds_maxfile_size_in_form: "<?php echo _l('file_exceeds_maxfile_size_in_form'); ?>" + ' (<?php echo bytesToSize('', $maxUploadSize); ?>)',
            file_exceeds_max_filesize: "<?php echo _l('file_exceeds_max_filesize'); ?>" + ' (<?php echo bytesToSize('', $maxUploadSize); ?>)',
            validation_extension_not_allowed: "<?php echo _l('validation_extension_not_allowed'); ?>",
            sign_document_validation: "<?php echo _l('sign_document_validation'); ?>",
            dt_length_menu_all: "<?php echo _l('dt_length_menu_all'); ?>",
            drop_files_here_to_upload: "<?php echo _l('drop_files_here_to_upload'); ?>",
            browser_not_support_drag_and_drop: "<?php echo _l('browser_not_support_drag_and_drop'); ?>",
            confirm_action_prompt: "<?php echo _l('confirm_action_prompt'); ?>",
            datatables: <?php echo json_encode(get_datatables_language_array()); ?>,
            discussions_lang: <?php echo json_encode(get_project_discussions_language_array()); ?>,
        };
        window.addEventListener('load', function() {
            custom_fields_hyperlink();
        });
    </script>
<?php

    _do_clients_area_deprecated_js_vars($date_format, $locale, $maxUploadSize, $isRTL);

    $contents = ob_get_contents();
    ob_end_clean();
    echo html_entity_decode($contents);
}

/**
 * get company name
 * @param  integer $id 
 * @return string    
 */
function get_rec_channel_form_key($id)
{
    $CI = &get_instance();
    $CI->db->where('id', $id);
    $rec_campaign_form_web = $CI->db->get(db_prefix() . 'rec_campaign_form_web')->row();

    if ($rec_campaign_form_web) {
        return $rec_campaign_form_web->form_key;
    } else {
        return '';
    }
}

/**
 * is_rtl_rec
 * @param  boolean $client_area 
 * @return boolean              
 */
function is_rtl_rec($client_area = false)
{
    $CI = &get_instance();

    if ($client_area == true) {
        // Client not logged in and checked from clients area
        if (get_option('rtl_support_client') == 1) {
            return true;
        }
    } elseif (is_staff_logged_in()) {
        if (isset($GLOBALS['current_user'])) {
            $direction = $GLOBALS['current_user']->direction;
        } else {
            $CI->db->select('direction')->from(db_prefix() . 'staff')->where('staffid', get_staff_user_id());
            $direction = $CI->db->get()->row()->direction;
        }

        if ($direction == 'rtl') {
            return true;
        } elseif ($direction == 'ltr') {
            return false;
        } elseif (empty($direction)) {
            if (get_option('rtl_support_admin') == 1) {
                return true;
            }
        }

        return false;
    } elseif ($client_area == false) {
        if (get_option('rtl_support_admin') == 1) {
            return true;
        }
    }

    return false;
}

/**
 * re pdf logo url
 * @return [type] 
 */
function re_pdf_logo_url()
{
    $custom_pdf_logo_image_url = get_option('custom_pdf_logo_image_url');
    $width                     = get_option('pdf_logo_width');
    $logoUrl                   = '';

    if ($width == '') {
        $width = 120;
    }
    if ($custom_pdf_logo_image_url != '') {
        $logoUrl = $custom_pdf_logo_image_url;
    } else {
        if (get_option('company_logo_dark') != '' && file_exists(get_upload_path_by_type('company') . get_option('company_logo_dark'))) {
            $logoUrl = get_upload_path_by_type('company') . get_option('company_logo_dark');
        } elseif (get_option('company_logo') != '' && file_exists(get_upload_path_by_type('company') . get_option('company_logo'))) {
            $logoUrl = get_upload_path_by_type('company') . get_option('company_logo');
        }
    }

    $logoImage = '';
    if ($logoUrl != '') {
        $logoImage = '<img class="logo_width" src="' . $logoUrl . '">';
    }

    return hooks()->apply_filters('pdf_logo_url', $logoImage);
}

/**
 * rec get status modules
 * @param  [type] $module_name 
 * @return [type]              
 */
function rec_get_status_modules($module_name)
{
    $CI = &get_instance();
    $sql = 'select * from ' . db_prefix() . 'modules where module_name = "' . $module_name . '" AND active =1 ';
    $module = $CI->db->query($sql)->row();
    if ($module) {
        return true;
    } else {
        return false;
    }
}


function check_date_included_in_other($id, $candidate, $embarkation_date, $table)
{
    if ($candidate > 0 && $table != '' && $id > 0) {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->where('candidate', $candidate);
        $CI->db->where('id !=', $id);
        $CI->db->where("'$embarkation_date' BETWEEN embarkation_date AND disembarkation_date", NULL, FALSE);
        $CI->db->where('embarkation_date !=', $embarkation_date);
        // $CI->db->where('disembarkation_date !=', $embarkation_date);
        $data = $CI->db->get(db_prefix() . $table)->result_array();

        if (!empty($data)) {
            return "color: red;";
        } else {
            return '';
        }
    }
    return '';
}

function check_on_board($candidate, $table, $is_edit = "")
{
    if ($candidate > 0 && $table != '') {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->where('candidate', $candidate);

        if ($is_edit != 1) {
            $CI->db->group_start();
            $CI->db->where('disembarkation_date IS NULL', null, false);
            $CI->db->or_where('disembarkation_date', '0000-00-00');
            $CI->db->group_end();
        }
        $data = $CI->db->get(db_prefix() . $table)->result_array();
        if (!empty($data)) {
            return 'true';
        } else {
            return 'false';
        }
    }
    return 'false';
}


function calculateBoardingPeriod($embarkation_date, $disembarkation_date)
{
    if ($embarkation_date && $disembarkation_date) {
        $formats = ["Y-m-d", "j.n.Y", "m/d/Y", "d-m-Y", "M j, Y"];
        $embarkation = null;
        $disembarkation = null;

        foreach ($formats as $format) {
            $embarkation = DateTime::createFromFormat($format, $embarkation_date);
            $disembarkation = DateTime::createFromFormat($format, $disembarkation_date);
            if ($embarkation && $disembarkation) {
                break;
            }
        }
        if ($embarkation && $disembarkation) {
            $difference = $embarkation->diff($disembarkation);
            $years = $difference->y;
            $months = $difference->m;
            $days = $difference->d + 1;
            if ($days >= 31) {
                $months += 1;
                $days = 0;
            }
            $formattedDifference = $years . 'Y ' . $months . 'M ' . $days . 'D';
            return $formattedDifference;
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function calculateBoardingPeriodDays($embarkation_date, $disembarkation_date)
{
    if ($embarkation_date && $disembarkation_date) {
        $formats = ["Y-m-d", "j.n.Y", "m/d/Y", "d-m-Y", "M j, Y"];
        $embarkation = null;
        $disembarkation = null;
        foreach ($formats as $format) {
            $embarkation = DateTime::createFromFormat($format, $embarkation_date);
            $disembarkation = DateTime::createFromFormat($format, $disembarkation_date);
            if ($embarkation && $disembarkation) {
                break;
            }
        }
        if ($embarkation && $disembarkation) {
            $difference = $embarkation->diff($disembarkation);
            $total_days = $difference->days + 1;
            return $total_days . ' days';
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function calculateAge($dateString)
{
    if ($dateString != '' && $dateString != "0000-00-00" && $dateString != null) {
        $today = new DateTime();
        $birthDate = new DateTime($dateString);
        $age = $today->diff($birthDate)->y;
        return $age;
    } else {
        return '';
    }
}

function formatDays($days)
{
    if ($days != '') {
        $years = floor($days / 365);
        $remainingDays = $days % 365;
        $months = floor($remainingDays / 30);
        $days = $remainingDays % 30;
        return sprintf('%2dY %2dM %2dD', $years, $months, $days);
    }
}

function get_country_name_by_id($country_id)
{
    $CI = &get_instance();
    $CI->db->select('name');
    $CI->db->where('id', $country_id);
    $result = $CI->db->get(db_prefix() . 'countries_new')->row();
    return isset($result->name) ? $result->name : '';
}

function get_state_name_by_id($state_id)
{
    $CI = &get_instance();
    $CI->db->select('name,country_id');
    $CI->db->where('id', $state_id);
    $result = $CI->db->get(db_prefix() . 'states_new')->row();
    return isset($result) ? $result : '';
}

function countexpiryandfollowup($candidate_id)
{
    $CI = &get_instance();
    $CI->db->select('
    SUM(CASE WHEN rec.expiry_date < CURDATE() AND rec.hideexpire = 0 THEN 1 ELSE 0 END) AS expired_count', FALSE);
    $CI->db->select('SUM(CASE WHEN rec.expiry_date > CURDATE() AND DATEDIFF(rec.expiry_date, CURDATE()) < job.expiration_date THEN 1 ELSE 0 END) AS to_follow_up', FALSE);
    $CI->db->from('tblrec_travel_identification as rec');
    $CI->db->join('tbljob_travel_identification as job', 'rec.document_type = job.id', 'left');
    $CI->db->where('rec.candidate', $candidate_id);
    $CI->db->group_by('rec.candidate');
    $query = $CI->db->get();
    $licence1 = $query->row_array();
    $CI->db->select('
    SUM(CASE WHEN rec.expiry_date < CURDATE() AND rec.hideexpire = 0 THEN 1 ELSE 0 END) AS expired_count', FALSE);
    $CI->db->select('SUM(CASE WHEN rec.expiry_date > CURDATE() AND DATEDIFF(rec.expiry_date, CURDATE()) < job.expiration_date THEN 1 ELSE 0 END) AS to_follow_up', FALSE);
    $CI->db->from('tblrec_other_licence_identification as rec');
    $CI->db->join('tbljob_other_licence_identification as job', 'rec.document_type = job.id', 'left');
    $CI->db->where('rec.candidate', $candidate_id);
    $CI->db->group_by('rec.candidate');
    $query = $CI->db->get();
    $licence2 = $query->row_array();
    $CI->db->select('
    SUM(CASE WHEN rec.expiry_date < CURDATE() AND rec.hideexpire = 0 THEN 1 ELSE 0 END) AS expired_count', FALSE);
    $CI->db->select('SUM(CASE WHEN rec.expiry_date > CURDATE() AND DATEDIFF(rec.expiry_date, CURDATE()) < job.expiration_date THEN 1 ELSE 0 END) AS to_follow_up', FALSE);
    $CI->db->from('tblrec_licence_3 as rec');
    $CI->db->join('tbljob_licence_3 as job', 'rec.document_type = job.id', 'left');
    $CI->db->where('rec.candidate', $candidate_id);
    $CI->db->group_by('rec.candidate');
    $query = $CI->db->get();
    $licence3 = $query->row_array();
    $CI->db->select('
    SUM(CASE WHEN rec.expiry_date < CURDATE() AND rec.hideexpire = 0 THEN 1 ELSE 0 END) AS expired_count', FALSE);
    $CI->db->select('SUM(CASE WHEN rec.expiry_date > CURDATE() AND DATEDIFF(rec.expiry_date, CURDATE()) < job.expiration_date THEN 1 ELSE 0 END) AS to_follow_up', FALSE);
    $CI->db->from('tblrec_licence_4 as rec');
    $CI->db->join('tbljob_licence_4 as job', 'rec.document_type = job.id', 'left');
    $CI->db->where('rec.candidate', $candidate_id);
    $CI->db->group_by('rec.candidate');
    $query = $CI->db->get();
    $licence4 = $query->row_array();
    $CI->db->select('
    SUM(CASE WHEN rec.expiry_date < CURDATE() AND rec.hideexpire = 0 THEN 1 ELSE 0 END) AS expired_count', FALSE);
    $CI->db->select('SUM(CASE WHEN rec.expiry_date > CURDATE() AND DATEDIFF(rec.expiry_date, CURDATE()) < job.expiration_date THEN 1 ELSE 0 END) AS to_follow_up', FALSE);
    $CI->db->from('tblrec_licence_5 as rec');
    $CI->db->join('tbljob_licence_5 as job', 'rec.document_type = job.id', 'left');
    $CI->db->where('rec.candidate', $candidate_id);
    $CI->db->group_by('rec.candidate');
    $query = $CI->db->get();
    $licence5 = $query->row_array();
    $CI->db->select('
    SUM(CASE WHEN rec.expiry_date < CURDATE() AND rec.hideexpire = 0 THEN 1 ELSE 0 END) AS expired_count', FALSE);
    $CI->db->select('SUM(CASE WHEN rec.expiry_date > CURDATE() AND DATEDIFF(rec.expiry_date, CURDATE()) < job.expiration_date THEN 1 ELSE 0 END) AS to_follow_up', FALSE);
    $CI->db->from('tblrec_licence_6 as rec');
    $CI->db->join('tbljob_licence_6 as job', 'rec.document_type = job.id', 'left');
    $CI->db->where('rec.candidate', $candidate_id);
    $CI->db->group_by('rec.candidate');
    $query = $CI->db->get();
    $licence6 = $query->row_array();
    $total_expired_count = 0;
    $total_to_follow_up = 0;
    foreach ([$licence1, $licence2, $licence3, $licence4, $licence5, $licence6] as $licence) {
        $total_expired_count += (int)$licence['expired_count'];
        $total_to_follow_up += (int)$licence['to_follow_up'];
    }
    return array(
        'expired_count' => $total_expired_count,
        'to_follow_up'  => $total_to_follow_up
    );
}

function remainingformatDays($days)
{
    if ($days != '') {
        $isNegative = $days < 0;
        $days = abs($days);
        $years = floor($days / 365);
        $remainingDays = $days % 365;
        $months = floor($remainingDays / 30);
        $days = $remainingDays % 30;
        $result = sprintf('%2dY %2dM %2dD', $years, $months, $days);
        if ($isNegative) {
            $result = '-' . $result;
        }
        return $result;
    }
    return '0Y 0M 0D';
}

function get_transaction_history($candidate_id, $id)
{
    $CI = &get_instance();
    $CI->db->select('care_time');
    $CI->db->where('candidate', $candidate_id);
    $CI->db->where('travel_id', $id);
    $CI->db->order_by('id', 'DESC');
    $CI->db->limit(1);
    $result = $CI->db->get(db_prefix() . 'cd_care')->row();
    return isset($result->care_time) ? $result->care_time : '';
}

function get_transaction_license_history($candidate_id, $id)
{
    $CI = &get_instance();
    $CI->db->select('care_time');
    $CI->db->where('candidate', $candidate_id);
    $CI->db->where('license_id', $id);
    $CI->db->order_by('id', 'DESC');
    $CI->db->limit(1);
    $result = $CI->db->get(db_prefix() . 'cd_care')->row();
    return isset($result->care_time) ? $result->care_time : '';
}

function get_transaction_license_3_history($candidate_id, $id)
{
    $CI = &get_instance();
    $CI->db->select('care_time');
    $CI->db->where('candidate', $candidate_id);
    $CI->db->where('license_3', $id);
    $CI->db->order_by('id', 'DESC');
    $CI->db->limit(1);
    $result = $CI->db->get(db_prefix() . 'cd_care')->row();
    return isset($result->care_time) ? $result->care_time : '';
}

function get_transaction_license_4_history($candidate_id, $id)
{
    $CI = &get_instance();
    $CI->db->select('care_time');
    $CI->db->where('candidate', $candidate_id);
    $CI->db->where('license_4', $id);
    $CI->db->order_by('id', 'DESC');
    $CI->db->limit(1);
    $result = $CI->db->get(db_prefix() . 'cd_care')->row();
    return isset($result->care_time) ? $result->care_time : '';
}

function get_transaction_license_5_history($candidate_id, $id)
{
    $CI = &get_instance();
    $CI->db->select('care_time');
    $CI->db->where('candidate', $candidate_id);
    $CI->db->where('license_5', $id);
    $CI->db->order_by('id', 'DESC');
    $CI->db->limit(1);
    $result = $CI->db->get(db_prefix() . 'cd_care')->row();
    return isset($result->care_time) ? $result->care_time : '';
}

function get_transaction_license_6_history($candidate_id, $id)
{
    $CI = &get_instance();
    $CI->db->select('care_time');
    $CI->db->where('candidate', $candidate_id);
    $CI->db->where('license_6', $id);
    $CI->db->order_by('id', 'DESC');
    $CI->db->limit(1);
    $result = $CI->db->get(db_prefix() . 'cd_care')->row();
    return isset($result->care_time) ? $result->care_time : '';
}

function get_document_type($type, $id)
{
    $CI = &get_instance();
    $CI->db->select('document_type');
    if ($type == 'travel') {
        $CI->db->where('id', $id);
        $query = $CI->db->get(db_prefix() . 'job_travel_identification');
    } elseif ($type == 'licence') {
        $CI->db->where('id', $id);
        $query = $CI->db->get(db_prefix() . 'job_other_licence_identification');
    } elseif ($type == 'license_3') {
        $CI->db->where('id', $id);
        $query = $CI->db->get(db_prefix() . 'job_licence_3');
    } elseif ($type == 'license_4') {
        $CI->db->where('id', $id);
        $query = $CI->db->get(db_prefix() . 'job_licence_4');
    } elseif ($type == 'license_5') {
        $CI->db->where('id', $id);
        $query = $CI->db->get(db_prefix() . 'job_licence_5');
    } elseif ($type == 'license_6') {
        $CI->db->where('id', $id);
        $query = $CI->db->get(db_prefix() . 'job_licence_6');
    } else {
        return ['document_type' => ''];
    }
    $result = $query->row_array();
    if ($type == 'travel') {
        log_message('debug', 'Travel Query: ' . $CI->db->last_query());
        log_message('debug', 'Travel Result: ' . print_r($result, true));
    }
    return $result ? $result : ['document_type' => ''];
}

if (!function_exists('add_hris_email_templates')) {
    /**
     * @return void
     */
    function add_hris_email_templates()
    {
        $CI = &get_instance();
        $data['hris_templete'] = $CI->emails_model->get(['type' => 'hris', 'language' => 'english']);
        $CI->load->view('recruitment/email_templates', $data);
    }
}

function get_viesel_name_id($id)
{
    $CI = &get_instance();
    $CI->db->select('vessel_name');
    $CI->db->where('candidate', $id);
    $CI->db->where('cur_onboard', 1);
    $query = $CI->db->get(db_prefix() . 'rec_on_board_company');
    $result = $query->row_array();
    return !empty($result['vessel_name']) ? $result['vessel_name'] : '';
}

function get_minning_agency_name($manning_agency_id)
{
    $CI = &get_instance();
    $CI->db->where('id', $manning_agency_id);
    $query = $CI->db->get(db_prefix() . 'manning_agency');
    $result = $query->row_array();
    $name = '';
    if (!empty($result)) {
        $name = $result['agency_name'] . ' - ' . $result['code'];
        return $name;
    }
    return '';
}


function data_tables_init_custom($aColumns, $sIndexColumn, $sTable, $join = [], $where = [], $additionalSelect = [], $sGroupBy = '', $searchAs = [], $is_follow_up = false, $follow_up_arr)
{
    $CI          = &get_instance();
    $data      = $CI->input->post();
    /*
     * Paging
     */
    $sLimit = '';
    if ((is_numeric($CI->input->post('start'))) && $CI->input->post('length') != '-1') {
        $sLimit = 'LIMIT ' . intval($CI->input->post('start')) . ', ' . intval($CI->input->post('length'));
    }
    $allColumns = [];
    foreach ($aColumns as $column) {
        // if found only one dot
        if (substr_count($column, '.') == 1 && strpos($column, ' as ') === false) {
            $_column = explode('.', $column);
            if (isset($_column[1])) {
                if (startsWith($_column[0], db_prefix())) {
                    $_prefix = prefixed_table_fields_wildcard($_column[0], $_column[0], $_column[1]);
                    array_push($allColumns, $_prefix);
                } else {
                    array_push($allColumns, $column);
                }
            } else {
                array_push($allColumns, $_column[0]);
            }
        } else {
            array_push($allColumns, $column);
        }
    }
    /*
     * Ordering
     */
    $nullColumnsAsLast = get_null_columns_that_should_be_sorted_as_last();
    $sOrder = '';
    if (!$is_follow_up) {
        if ($CI->input->post('order')) {
            $sOrder = 'ORDER BY ';
            foreach ($CI->input->post('order') as $key => $val) {
                $columnName = $aColumns[intval($data['order'][$key]['column'])];
                $dir        = strtoupper($data['order'][$key]['dir']);
                $type       = $data['order'][$key]['type'] ?? null;
                // Security
                if (!in_array($dir, ['ASC', 'DESC'])) {
                    $dir = 'ASC';
                }
                if (strpos($columnName, ' as ') !== false) {
                    $columnName = strbefore($columnName, ' as');
                }
                // First Checking Is For Eq Tablename.Column Name
                // Second Checking There Is Already Prefixed Table Name In The Column Name
                // This Will Work On The First Table Sorting - Checked By The Draw Parameters
                // In Future Sorting User Must Sort Like He Want And The Duedates Won't Be Always Last
                if ((in_array($sTable . '.' . $columnName, $nullColumnsAsLast)
                    || in_array($columnName, $nullColumnsAsLast))) {
                    $sOrder .= $columnName . ' IS NULL ' . $dir . ', ' . $columnName;
                } else {
                    // Custom Fields Sorting Support For Number Type Custom Fields
                    if ($type === 'number') {
                        $sOrder .= hooks()->apply_filters('datatables_query_order_column', 'CAST(' . $columnName . ' as SIGNED)', $sTable);
                    } elseif ($type === 'date_picker') {
                        $sOrder .= hooks()->apply_filters('datatables_query_order_column', 'CAST(' . $columnName . ' as DATE)', $sTable);
                    } elseif ($type === 'date_picker_time') {
                        $sOrder .= hooks()->apply_filters('datatables_query_order_column', 'CAST(' . $columnName . ' as DATETIME)', $sTable);
                    } else {
                        $sOrder .= hooks()->apply_filters('datatables_query_order_column', $columnName, $sTable);
                    }
                }
                $sOrder .= ' ' . $dir . ', ';
            }
            if (trim($sOrder) == 'ORDER BY') {
                $sOrder = '';
            }
            $sOrder = rtrim($sOrder, ', ');
            if (
                get_option('save_last_order_for_tables') == '1'
                && $CI->input->post('last_order_identifier')
                && $CI->input->post('order')
            ) {
                // https://stackoverflow.com/questions/11195692/json-encode-sparse-php-array-as-json-array-not-json-object
                $indexedOnly = [];
                foreach ($CI->input->post('order') as $row) {
                    $indexedOnly[] = array_values($row);
                }
                $meta_name = $CI->input->post('last_order_identifier') . '-table-last-order';
                update_staff_meta(get_staff_user_id(), $meta_name, json_encode($indexedOnly, JSON_NUMERIC_CHECK));
            }
        }
    } else {
        if ($follow_up_arr != '') {
            $sOrder = 'ORDER BY FIELD(' . db_prefix() . 'rec_candidate.id,' . $follow_up_arr . ')';
        }
    }
    /*
     * Filtering
     * NOTE This Does Not Match The Built-In DataTables Filtering Which Does It
     * Word By Word On Any Field. It's Possible To Do Here, But Concerned About Efficiency
     * On Very Large Tables, And MySQL's Regex Functionality Is Very Limited
     */
    $sWhere = '';
    if ((isset($data['search'])) && $data['search']['value'] != '') {
        $search_value = $data['search']['value'];
        $search_value = trim($search_value);
        $sWhere             = 'WHERE (';
        $sMatchCustomFields = [];
        // Not working, do not use it
        $useMatchForCustomFieldsTableSearch = hooks()->apply_filters('use_match_for_custom_fields_table_search', 'false');
        for ($i = 0; $i < count($aColumns); $i++) {
            $columnName = $aColumns[$i];
            if (strpos($columnName, ' as ') !== false) {
                $columnName = strbefore($columnName, ' as');
            }
            if (stripos($columnName, 'AVG(') === false && stripos($columnName, 'SUM(') === false) {
                if (($data['columns'][$i]) && $data['columns'][$i]['searchable'] == 'true') {
                    if (isset($searchAs[$i])) {
                        $columnName = $searchAs[$i];
                    }
                    // Custom Fields Values Are FULLTEXT And Should Be Searched With MATCH
                    // Not Working ATM
                    if ($useMatchForCustomFieldsTableSearch === 'true' && startsWith($columnName, 'ctable_')) {
                        $sMatchCustomFields[] = $columnName;
                    } else {
                        $sWhere .= 'convert(' . $columnName . ' USING utf8)' . " LIKE '%" . $CI->db->escape_like_str($search_value) . "%' ESCAPE '!' OR ";
                    }
                }
            }
        }
        if (count($sMatchCustomFields) > 0) {
            $s = $CI->db->escape_str($search_value);
            foreach ($sMatchCustomFields as $matchCustomField) {
                $sWhere .= "MATCH ({$matchCustomField}) AGAINST (CONVERT(BINARY('{$s}') USING utf8)) OR ";
            }
        }
        if (count($additionalSelect) > 0) {
            foreach ($additionalSelect as $searchAdditionalField) {
                if (strpos($searchAdditionalField, ' as ') !== false) {
                    $searchAdditionalField = strbefore($searchAdditionalField, ' as');
                }
                if (stripos($columnName, 'AVG(') === false && stripos($columnName, 'SUM(') === false) {
                    // Use index
                    $sWhere .= 'convert(' . $searchAdditionalField . ' USING utf8)' . " LIKE '%" . $CI->db->escape_like_str($search_value) . "%'ESCAPE '!' OR ";
                }
            }
        }
        $sWhere = substr_replace($sWhere, '', -3);
        $sWhere .= ')';
    } else {
        // Check For Custom Filtering
        $searchFound = 0;
        $sWhere      = 'WHERE (';
        foreach ($aColumns as $i => $column) {
            if (isset($data['columns'][$i]) && $data['columns'][$i]['searchable'] == 'true') {
                $search_value = $data['columns'][$i]['search']['value'];
                $columnName = $column;
                if (strpos($columnName, ' as ') !== false) {
                    $columnName = strbefore($columnName, ' as');
                }
                if ($search_value != '') {
                    // Add condition for current column
                    $likeClause = $CI->db->escape_like_str($search_value);
                    $sWhere .= "convert($columnName USING utf8) LIKE '%$likeClause%' ESCAPE '!' OR ";
                    // Process additional select fields if any
                    if (count($additionalSelect) > 0) {
                        foreach ($additionalSelect as $searchAdditionalField) {
                            $sWhere .= "convert($searchAdditionalField USING utf8) LIKE '%$likeClause%' ESCAPE '!' OR ";
                        }
                    }
                    $searchFound++;
                }
            }
        }
        if ($searchFound > 0) {
            $sWhere = substr_replace($sWhere, '', -3);
            $sWhere .= ')';
        } else {
            $sWhere = '';
        }
    }
    /*
     * SQL queries
     * Get data to display
     */
    $additionalColumns = '';
    if (count($additionalSelect) > 0) {
        $additionalColumns = ',' . implode(',', $additionalSelect);
    }
    $where = implode(' ', $where);
    if ($sWhere == '') {
        $where = trim($where);
        if (startsWith($where, 'AND') || startsWith($where, 'OR')) {
            if (startsWith($where, 'OR')) {
                $where = substr($where, 2);
            } else {
                $where = substr($where, 3);
            }
            $where = 'WHERE ' . $where;
        }
    }
    $join = implode(' ', $join);
    $resultQuery = '
    SELECT ' . str_replace(' , ', ' ', implode(', ', $allColumns)) . ' ' . $additionalColumns . "
    FROM $sTable
    " . $join . "
    $sWhere
    " . $where . "
    $sGroupBy
    $sOrder
    $sLimit
    ";
    $rResult = hooks()->apply_filters(
        'datatables_sql_query_results',
        $CI->db->query($resultQuery)->result_array(),
        [
            'table' => $sTable,
            'limit' => $sLimit,
            'order' => $sOrder,
        ]
    );
    /* Data set length after filtering */
    $iFilteredTotal = $CI->db->query("
        SELECT COUNT(*) as iFilteredTotal
        FROM $sTable
        " . $join . "
        $sWhere
        " . $where . "
        $sGroupBy
    ")->row()->iFilteredTotal;

    if (startsWith($where, 'AND')) {
        $where = 'WHERE ' . substr($where, 3);
    }
    /* Total data set length */
    $iTotal = $CI->db->query("SELECT COUNT(*) as iTotal from $sTable $join $where")->row()->iTotal;
    return [
        'rResult' => $rResult,
        'output'  => [
            'draw'                 => $data['draw'] ? intval($data['draw']) : 0,
            'iTotalRecords'        => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData'               => [],
        ],
    ];
}
// get_contract_template
// $contract_template = $this->db->get(db_prefix() . 'rec_contract_template_for_crew')->result_array();
// if ($contract_template) {
//     return $contract_template;
// }
// return [];
function get_contract_template_dropdown()
{
    $CI          = &get_instance();
    $contract_template = $CI->db->get(db_prefix() . 'rec_contract_template_for_crew')->result_array();
    $filterrd_drop_down = [];
    $filterrd_drop_down[] = ['id' => '', 'contract_template_name' => ''];
    foreach ($contract_template as $key => $value) {
        $filterrd_drop_down[] = $value;
    }
    return $filterrd_drop_down;
}

function rec_contract_pdf($template_content_msg, $tag = '')
{
    return app_pdf('contract', module_dir_path(RECRUITMENT_MODULE_NAME) . '/libraries/pdf/Contract_pdf', $template_content_msg, $tag);
}

function get_rec_contract_name($contract_template_id)
{
    if ($contract_template_id) {
        $CI = &get_instance();
        $CI->db->where('id', $contract_template_id);
        $contract_template = $CI->db->get(db_prefix() . 'rec_contract_template_for_crew')->result_array();
        if (!empty($contract_template)) {
            $contract_template = $contract_template[0];
            return isset($contract_template['contract_template_name']) ? $contract_template['contract_template_name'] : '';
        }
    }
    return '';
}

function upload_con_signed_contract($file, $contract_name, $candidate_id)
{
    $module_path = module_dir_path(RECRUITMENT_MODULE_NAME);
    $upload_path  = $module_path . 'assets/image/' . $candidate_id;
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0755, true);
    }
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];

    $file_arr = explode('.', $file_name);
    $new_file_name = time() . '_' .  $contract_name . '.' . $file_arr[1];
    $new_file_name = str_replace(' ', '_', $new_file_name);

    $target_file = $upload_path . '/' . $new_file_name;
    if (move_uploaded_file($file_tmp_name, $target_file)) {
        return $new_file_name;
    }
}

function get_on_board_company($candidate_id)
{
    $CI = &get_instance();
    $CI->db->where('candidate', $candidate_id);
    $CI->db->order_by('id', 'DESC');
    $data = $CI->db->get(db_prefix() . 'rec_on_board_company')->result_array();
    if (!empty($data) && isset($data[0]) && !empty($data[0])) {
        return $data[0];
    }
}


function get_job_vessel_name($id)
{
    $CI = &get_instance();
    $CI->db->where('id', $id);
    $data = $CI->db->get(db_prefix() . 'job_vessel')->result_array();
    if (!empty($data) && isset($data[0]) && !empty($data[0])) {
        return $data[0]['vessel_name'];
    }
    return '';
}

function custom_filed_setting_principals($id = '')
{
    $CI = &get_instance();
    if ($id == '') {
        $data = $CI->db->get(db_prefix() . 'custom_filed_setting_principals')->result_array();
        if (!empty($data)) {
            return $data;
        }
        return [];
    } else {
        $CI->db->where('id', $id);
        $data = $CI->db->get(db_prefix() . 'custom_filed_setting_principals')->result_array();
        if (!empty($data) && isset($data[0]) && !empty($data[0])) {
            return $data[0];
        }
        return [];
    }
}

function get_job_vessel_name_list($id = '')
{
    $CI = &get_instance();
    if ($id == '') {
        $data = $CI->db->order_by('vessel_info_name', 'ASC')
            ->get(db_prefix() . 'job_vessel_name')
            ->result_array();
        if (!empty($data)) {
            return $data;
        }
        return [];
    } else {
        $CI->db->where('id', $id);
        $data = $CI->db->get(db_prefix() . 'job_vessel_name')->result_array();
        if (!empty($data) && isset($data[0]) && !empty($data[0])) {
            return $data[0];
        }
        return [];
    }
}


// job_duty
function get_job_duty($id = '')
{
    $CI = &get_instance();
    if ($id == '') {
        $data = $CI->db->order_by('duty_name', 'ASC')
            ->get(db_prefix() . 'job_duty')
            ->result_array();
        if (!empty($data)) {
            return $data;
        }
        return [];
    } else {
        $CI->db->where('id', $id);
        $data = $CI->db->get(db_prefix() . 'job_duty')->result_array();
        if (!empty($data) && isset($data[0]) && !empty($data[0])) {
            return $data[0];
        }
        return [];
    }
}

function contract_duration_data_get($id = '')
{
    $data = [
        ['id' => '1 month', 'name' => '1'],
        ['id' => '2', 'name' => '2'],
        ['id' => '3', 'name' => '3'],
        ['id' => '4', 'name' => '4'],
        ['id' => '5', 'name' => '5'],
        ['id' => '6', 'name' => '6'],
        ['id' => '7', 'name' => '7'],
        ['id' => '8', 'name' => '8'],
        ['id' => '9', 'name' => '9'],
        ['id' => '10', 'name' => '10'],
        ['id' => '11', 'name' => '11'],
        ['id' => '12', 'name' => '12']
    ];
    if ($id != '') {
        foreach ($data as $key => $value) {
            if ($value['id'] == $id) {
                return $value;
            }
        }
        return [];
    }
    return $data;
}


function get_seafarer_identification_details($type = '')
{
    $CI = &get_instance();
    $CI->db->where('id', 6);
    $data = $CI->db->get(db_prefix() . 'job_travel_identification')->result_array();
    if (!empty($data) && isset($data[0]) && !empty($data[0])) {
        if ($type == 'name') {
            return $data[0]['document_type'];
        } else {
            return 'seafarers_record_book_SRB_SIRB';
        }
    }
    return '';
}

function get_vessel_info_in_crew_list($id)
{
    $CI = &get_instance();
    $CI->db->select(db_prefix() . 'job_vessel_name.vessel_info_name as vessel_name, ' . db_prefix() . 'rec_on_board_company.embarkation_date, ' . db_prefix() . 'rec_on_board_company.disembarkation_date');
    $CI->db->where(db_prefix() . 'rec_on_board_company.id', $id);
    // job_vessel_name join in this table to get vessel name in crew list page
    $CI->db->join(db_prefix() . 'job_vessel_name', db_prefix() . 'rec_on_board_company.vessel_name = ' . db_prefix() . 'job_vessel_name.id', 'left');
    $data = $CI->db->get(db_prefix() . 'rec_on_board_company')->result_array();
    if (!empty($data) && isset($data[0]) && !empty($data[0])) {
        return $data[0];
    }
    return '';
}


// function calculate_total_days($records)
// {
//     $totalDays = 0;

//     foreach ($records as $row) {

//         if (empty($row['embarkation_date'])) {
//             continue;
//         }

//         $start = new DateTime($row['embarkation_date']);
//         $end   = !empty($row['disembarkation_date'])
//             ? new DateTime($row['disembarkation_date'])
//             : new DateTime();

//         $totalDays += $start->diff($end)->days;
//     }

//     return $totalDays;
// }

// function current_rank_career($candidate_id)
// {
//     if (!is_numeric($candidate_id)) {
//         return false;
//     }

//     $CI = &get_instance();

//     /*
//      * --------------------------------------------------------
//      * STEP 1 : Get latest record from onboard company table
//      * --------------------------------------------------------
//      */
//     $CI->db->where('candidate', $candidate_id);
//     $CI->db->order_by('id', 'DESC');
//     $latest_record = $CI->db->get(db_prefix() . 'rec_on_board_company')->row_array();

//     // If no record found then stop
//     if (empty($latest_record)) {
//         return false;
//     }

//     /*
//      * --------------------------------------------------------
//      * STEP 2 : Get current rank from latest record
//      * --------------------------------------------------------
//      */
//     $current_rank = $latest_record['rank'];

//     /*
//      * --------------------------------------------------------
//      * STEP 3 : Get all records from onboard company table
//      * having the same rank
//      * --------------------------------------------------------
//      */
//     $CI->db->where('candidate', $candidate_id);
//     $CI->db->where('rank', $current_rank);
//     $on_board_company = $CI->db->get(db_prefix() . 'rec_on_board_company')->result_array();

//     /*
//      * --------------------------------------------------------
//      * STEP 4 : Get all records from onboard other company table
//      * having the same rank
//      * --------------------------------------------------------
//      */
//     $CI->db->where('candidate', $candidate_id);
//     $CI->db->where('rank', $current_rank);
//     $rec_on_board_other_company = $CI->db->get(db_prefix() . 'rec_on_board_other_company')->result_array();

//     /*
//      * --------------------------------------------------------
//      * STEP 5 : Merge both record sets
//      * --------------------------------------------------------
//      */
//     $all_records = array_merge(
//         $on_board_company,
//         $rec_on_board_other_company
//     );

//     /*
//      * --------------------------------------------------------
//      * STEP 6 : Calculate total sailing days
//      * Uses your existing helper function
//      * --------------------------------------------------------
//      */
//     $total_days = calculate_total_days($all_records);

//     /*
//      * --------------------------------------------------------
//      * STEP 7 : Convert total days into Years / Months / Days
//      * 365 Days = 1 Year
//      * 30 Days = 1 Month
//      * --------------------------------------------------------
//      */
//     $years = floor($total_days / 365);
//     $remaining_days = $total_days % 365;

//     $months = floor($remaining_days / 30);
//     $days = $remaining_days % 30;

//     $total_period = "{$years}Y {$months}M {$days}D";

//     /*
//      * --------------------------------------------------------
//      * STEP 8 : Return result
//      * --------------------------------------------------------
//      */
//     // return [
//     //     'rank' => $current_rank,
//     //     'total_days' => $total_days,
//     //     'total_period' => $total_period,
//     //     'company_records' => $on_board_company,
//     //     'other_company_records' => $rec_on_board_other_company,
//     //     'all_records' => $all_records,
//     // ];
//     return $total_period;
// }

function calculate_total_period($records)
{
    $years  = 0;
    $months = 0;
    $days   = 0;

    foreach ($records as $row) {

        if (empty($row['boarding_period'])) {
            continue;
        }

        preg_match(
            '/(\d+)Y\s+(\d+)M\s+(\d+)D/',
            trim($row['boarding_period']),
            $matches
        );

        if (!empty($matches)) {
            $years  += (int) $matches[1];
            $months += (int) $matches[2];
            $days   += (int) $matches[3];
        }
    }

    /*
     * Convert Days -> Months
     * 30 Days = 1 Month
     */
    $months += floor($days / 30);
    $days = $days % 30;

    /*
     * Convert Months -> Years
     * 12 Months = 1 Year
     */
    $years += floor($months / 12);
    $months = $months % 12;

    return "{$years}Y {$months}M {$days}D";
}

function current_rank_career($candidate_id)
{
    if (!is_numeric($candidate_id)) {
        return false;
    }

    $CI = &get_instance();

    /*
     * STEP 1
     * Get latest onboard company record
     */
    $CI->db->where('candidate', $candidate_id);
    $CI->db->order_by('id', 'DESC');
    $latest_record = $CI->db->get(db_prefix() . 'rec_on_board_company')->row_array();

    if (empty($latest_record)) {
        return false;
    }

    /*
     * STEP 2
     * Get latest rank
     */
    $current_rank = $latest_record['rank'];

    /*
     * STEP 3
     * Get all company records with same rank
     */
    $CI->db->where('candidate', $candidate_id);
    $CI->db->where('rank', $current_rank);
    $on_board_company = $CI->db->get(db_prefix() . 'rec_on_board_company')->result_array();

    /*
     * STEP 4
     * Get all other company records with same rank
     */
    $CI->db->where('candidate', $candidate_id);
    $CI->db->where('rank', $current_rank);
    $rec_on_board_other_company = $CI->db->get(db_prefix() . 'rec_on_board_other_company')->result_array();

    /*
     * STEP 5
     * Merge records
     */
    $all_records = array_merge(
        $on_board_company,
        $rec_on_board_other_company
    );

    /*
     * STEP 6
     * Calculate total boarding period
     * using boarding_period field
     */
    $total_period = calculate_total_period($all_records);

    /*
     * Return only total period
     */
    return $total_period;
}
