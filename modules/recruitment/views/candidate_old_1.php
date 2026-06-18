<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">

            <?php $editSummary = isset($_GET['editsummary']) ? $_GET['editsummary'] : ''; ?>
            <?php if (isset($candidate)) {
              echo form_hidden('candidateid', $candidate->id);
              echo form_open_multipart(admin_url('recruitment/add_update_candidate/' . $candidate->id), array('id' => 'recruitment-candidate-form'));
            } else {
              echo form_open_multipart(admin_url('recruitment/add_update_candidate'), array('id' => 'recruitment-candidate-form'));
            } ?>


            <?php if ($editSummary == 'editsummary') { ?>

              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading"><?php echo _l($title); ?></div>
                  <div class="panel-body">
                    <div class="row col-md-12" id="general_information">
                      <div class="col-md-3">
                        <div class="picture-container pull-left">
                          <div class="picture">
                            <img src="<?php if (isset($candidate->avar)) {
                                        echo site_url(RECRUITMENT_PATH . 'candidate/avartar/' . $candidate->id . '/' . $candidate->avar->file_name);
                                      } else {
                                        echo site_url(RECRUITMENT_PATH . 'none_avatar.jpg');
                                      } ?>" class="width-height-160" id="wizardPicturePreview" title="">
                            <input name="cd_avar" type="file" id="wizard-picture" accept=".png, .jpg, .jpeg" class="">
                          </div>
                          <h5 class=""><?php echo _l('choose_picture'); ?></h5><br>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-4">
                            <?php $candidate_name = (isset($candidate) ? $candidate->candidate_name : '');
                            echo render_input('candidate_name', 'first_name', $candidate_name, '', array('readonly' => true)) ?>
                          </div>

                          <div class="col-md-4">
                            <?php $last_name = (isset($candidate) ? $candidate->last_name : '');
                            echo render_input('last_name', 'last_name', $last_name, '', array('readonly' => true)) ?>
                          </div>

                          <div class="col-md-4">
                            <?php $candidate_code = (isset($candidate) ? $candidate->candidate_code : '');
                            echo render_input('candidate_code', 'candidate_code', $candidate_code, '', array('readonly' => true)) ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-4">
                            <?php $rank = (isset($candidate) ? $candidate->rank : '');
                            echo render_select('rank[]', $ranks, ['id', 'rank_name'], 'rank', $rank, ['data-actions-box' => true], [], '', '', false); ?>
                          </div>

                          <div class="col-md-4">
                            <?php $emp_status = (isset($candidate) ? $candidate->emp_status : '');
                            echo render_select('emp_status', $emp_status_list, ['id', 'emp_status_name'], 'emp_status', $emp_status, ['data-actions-box' => true], [], '', '', false); ?>
                          </div>

                          <div class="col-md-4"><?php ?>
                            <?php $department = (isset($candidate) ? $candidate->department : '');
                            echo render_select('department', $department_data, ['id', 'department_name'], 'department', $department, ['data-actions-box' => true], [], '', '', true); ?>
                          </div>

                          <div class="col-md-4">
                            <?php $department_date = (isset($candidate) ? $candidate->department_date : '');
                            echo render_date_input('department_date', 'department_date', _d($department_date)); ?>
                          </div>

                          <div class="col-md-4">
                            <?php $hired_type = (isset($candidate) ? $candidate->hired_type : '');
                            echo render_input('hired_type', 'hired_type', $hired_type); ?>
                          </div>

                          <div class="col-md-4">
                            <?php $hired_date = (isset($candidate) ? $candidate->hired_date : '');
                            echo render_date_input('hired_date', 'hired_date', _d($hired_date)); ?>
                          </div>

                          <div class="col-md-4">
                            <?php $promotion = (isset($candidate) ? $candidate->promotion : '');
                            echo render_date_input('promotion', 'promotion', _d($promotion)); ?>
                          </div>

                          <div class="col-md-4">
                            <?php $ereg_no = (isset($candidate) ? $candidate->ereg_no : '');
                            echo render_input('ereg_no', 'ereg_no', $ereg_no); ?>

                          </div>

                          <div class="col-md-4">
                            <?php $employer = (isset($candidate) ? $candidate->employer : '');
                            echo render_input('employer', 'employer', $employer); ?>
                          </div>

                        </div>
                      </div>



                      <div class="col-md-12">
                        <div class="row">

                          <div class="col-md-3">
                            <?php $nationality = (isset($candidate) ? $candidate->nationality : '');
                            echo render_input('nationality', 'nationality', $nationality, '', array('readonly' => true)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $hire_career = (isset($candidate) ? $candidate->hire_career : '');
                            echo render_input('hire_career', 'hire_career', $hire_career, 'text', array('readonly' => true)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $vsl_career = (isset($candidate) ? $candidate->vsl_career : '');
                            echo render_input('vsl_career', 'vsl_career', $vsl_career, 'text', array('readonly' => true)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $rank_career = (isset($candidate) ? $candidate->rank_career : '');
                            echo render_input('rank_career', 'rank_career', $rank_career, 'text', array('readonly' => true)); ?>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row">

                          <div class="col-md-3">
                            <?php $birthday = (isset($candidate) ? $candidate->birthday : '');
                            echo render_date_input('birthday', 'birthday', _d($birthday), array('readonly' => true)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $religion = (isset($candidate) ? $candidate->religion : '');
                            echo render_input('religion', 'religion', $religion, '', array('readonly' => true)); ?>
                          </div>

                          <div class="col-md-3">
                            <label for="gender"><?php echo _l('gender'); ?></label>
                            <select name="gender" id="gender" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>" disabled>
                              <option value=""></option>
                              <option value="male" <?php if (isset($candidate) && $candidate->gender == 'male') {
                                                      echo 'selected';
                                                    } ?>><?php echo _l('male'); ?></option>
                              <option value="female" <?php if (isset($candidate) && $candidate->gender == 'female') {
                                                        echo 'selected';
                                                      } ?>><?php echo _l('female'); ?></option>
                            </select>
                          </div>

                          <div class="col-md-3">
                            <label for="marital_status" class="control-label"><?php echo _l('marital_status'); ?></label>
                            <select name="marital_status" class="selectpicker" id="marital_status" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" disabled>
                              <option value=""></option>
                              <option value="<?php echo 'single'; ?>" <?php if (isset($candidate) && $candidate->marital_status == 'single') {
                                                                        echo 'selected';
                                                                      } ?>><?php echo _l('single'); ?></option>
                              <option value="<?php echo 'married'; ?>" <?php if (isset($candidate) && $candidate->marital_status == 'married') {
                                                                          echo 'selected';
                                                                        } ?>><?php echo _l('married'); ?></option>
                              <option value="<?php echo 'divorce'; ?>" <?php if (isset($candidate) && $candidate->marital_status == 'divorce') {
                                                                          echo 'selected';
                                                                        } ?>><?php echo _l('divorce'); ?></option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-3">
                           
                            <?php $selected_country = isset($candidate) ? $candidate->address_country : 0;
                            echo render_select('address_country', !empty($countries) ? $countries : [], ['id', 'name'], 'Region', isset($selected_country) ? $selected_country : '', array('disabled' => true));
                            ?>
                          </div>

                          <div class="col-md-3">
                            <?php
                            $selected_state = isset($candidate) ? $candidate->state : 0;
                            ?>
                            <?php echo render_select('state', isset($edit_states) ? $edit_states : [], ['id', 'name'], 'Province', $selected_state, array('disabled' => true)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $selected_city = isset($candidate) ? $candidate->city : 0; ?>
                            <?php echo render_select('city', isset($edit_cities) ? $edit_cities : [], ['id', 'name'], 'Municipality / City', $selected_city, array('disabled' => true)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php
                            $resident = (isset($candidate) ? $candidate->resident : '');
                            echo render_input('resident', 'resident', $resident, '', array('readonly' => true)); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

            <?php if ($editSummary == 'editpersonalinfo') { ?>

              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading"><?php echo _l($title); ?></div>
                  <div class="panel-body">
                    <div class="row col-md-12" id="general_information">
                      <div class="col-md-3">
                        <div class="picture-container pull-left">
                          <div class="picture">
                            <img src="<?php if (isset($candidate->avar)) {
                                        echo site_url(RECRUITMENT_PATH . 'candidate/avartar/' . $candidate->id . '/' . $candidate->avar->file_name);
                                      } else {
                                        echo site_url(RECRUITMENT_PATH . 'none_avatar.jpg');
                                      } ?>" class="width-height-160" id="wizardPicturePreview" title="">
                            <input name="cd_avar" type="file" id="wizard-picture" accept=".png, .jpg, .jpeg" class="">
                          </div>
                          <h5 class=""><?php echo _l('choose_picture'); ?></h5><br>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-3">
                            <?php $candidate_name = (isset($candidate) ? $candidate->candidate_name : '');
                            echo render_input('candidate_name', 'first_name', $candidate_name) ?>
                          </div>

                          <div class="col-md-3">
                            <?php $last_name = (isset($candidate) ? $candidate->last_name : '');
                            echo render_input('last_name', 'last_name', $last_name) ?>
                          </div>

                          <div class="col-md-3">
                            <label for="gender"><?php echo _l('gender'); ?></label>
                            <select name="gender" id="gender" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>">
                              <option value=""></option>
                              <option value="male" <?php if (isset($candidate) && $candidate->gender == 'male') {
                                                      echo 'selected';
                                                    } ?>><?php echo _l('male'); ?></option>
                              <option value="female" <?php if (isset($candidate) && $candidate->gender == 'female') {
                                                        echo 'selected';
                                                      } ?>><?php echo _l('female'); ?></option>
                            </select>
                          </div>

                          <div class="col-md-3">
                            <label for="marital_status" class="control-label"><?php echo _l('marital_status'); ?></label>
                            <select name="marital_status" class="selectpicker" id="marital_status" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                              <option value=""></option>
                              <option value="<?php echo 'single'; ?>" <?php if (isset($candidate) && $candidate->marital_status == 'single') {
                                                                        echo 'selected';
                                                                      } ?>><?php echo _l('single'); ?></option>
                              <option value="<?php echo 'married'; ?>" <?php if (isset($candidate) && $candidate->marital_status == 'married') {
                                                                          echo 'selected';
                                                                        } ?>><?php echo _l('married'); ?></option>
                              <option value="<?php echo 'divorce'; ?>" <?php if (isset($candidate) && $candidate->marital_status == 'divorce') {
                                                                          echo 'selected';
                                                                        } ?>><?php echo _l('divorce'); ?></option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="row">

                          <div class="col-md-3">
                            <?php $email = (isset($candidate) ? $candidate->email : '');
                            echo render_input('email', 'email', $email); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $height = (isset($candidate) ? $candidate->height : '');
                            echo render_input('height', 'height', $height); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $weight = (isset($candidate) ? $candidate->weight : '');
                            echo render_input('weight', 'weight', $weight); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $nationality = (isset($candidate) ? $candidate->nationality : '');
                            echo render_input('nationality', 'nationality', $nationality); ?>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-3">
                            <?php $birthday = (isset($candidate) ? $candidate->birthday : '');
                            echo render_date_input('birthday', 'birthday', _d($birthday)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $birthplace = (isset($candidate) ? $candidate->birthplace : '');
                            echo render_input('birthplace', 'birthplace', $birthplace) ?>
                          </div>

                          <div class="col-md-3">
                            <?php $religion = (isset($candidate) ? $candidate->religion : '');
                            echo render_input('religion', 'religion', $religion); ?>
                          </div>

                          <div class="col-md-3">
                            <?php echo render_input('file', 'file_campaign', '', 'file') ?>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-3">
                            <?php $selected_country = isset($candidate) ? $candidate->address_country : 0;
                            echo render_select('address_country', !empty($countries) ? $countries : [], ['id', 'name'], 'Region', isset($selected_country) ? $selected_country : '');
                            ?>
                          </div>

                          <div class="col-md-3">
                            <?php
                            $selected_state = isset($candidate) ? $candidate->state : 0;
                            ?>
                            <?php echo render_select('state', isset($edit_states) ? $edit_states : [], ['id', 'name'], 'Province', $selected_state); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $selected_city = isset($candidate) ? $candidate->city : 0; ?>
                            <?php echo render_select('city', isset($edit_cities) ? $edit_cities : [], ['id', 'name'], 'Municipality / City', $selected_city); ?>
                          </div>

                          <div class="col-md-3">
                            <?php
                            $resident = (isset($candidate) ? $candidate->resident : '');
                            echo render_input('resident', 'resident', $resident); ?>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row">

                          <div class="col-md-2" style="width: 20%;">
                            <?php $skype = (isset($candidate) ? $candidate->skype : '');
                            echo render_input('skype', 'skype', $skype); ?>
                          </div>

                          <div class="col-md-2" style="width: 20%;">
                            <?php $facebook = (isset($candidate) ? $candidate->facebook : '');
                            echo render_input('facebook', 'facebook', $facebook); ?>
                          </div>

                          <div class="col-md-2" style="width: 20%;">
                            <?php $linkedin = (isset($candidate) ? $candidate->linkedin : '');
                            echo render_input('linkedin', 'linkedin', $linkedin); ?>
                          </div>

                          <div class="col-md-2" style="width: 20%;">
                            <?php $phonenumber = (isset($candidate) ? $candidate->phonenumber : '');
                            echo render_input('phonenumber', 'phonenumber', $phonenumber); ?>
                          </div>

                          <div class="col-md-2" style="width: 20%;">
                            <?php $specially = (isset($candidate) ? $candidate->specially : '');
                            echo render_input('specially', 'specially', $specially); ?>
                          </div>

                          <div class="col-md-4">
                            <?php
                            $rows = [];
                            $rows['rows'] = 6;
                            $interests = (isset($candidate) ? $candidate->interests : '');
                            echo render_textarea('interests', 'interests', $interests, $rows) ?>
                          </div>

                          <div class="col-md-4">
                            <?php
                            $rows = [];
                            $rows['rows'] = 6;
                            $current_accommodation = (isset($candidate) ? $candidate->current_accommodation : '');
                            echo render_textarea('current_accommodation', 'current_accommodation', $current_accommodation, $rows) ?>
                          </div>

                          <div class="col-md-4">
                            <?php $introduce_yourself = (isset($candidate) ? $candidate->introduce_yourself : '');
                            $rows = [];
                            $rows['rows'] = 6;
                            echo render_textarea('introduce_yourself', 'introduce_yourself', $introduce_yourself, $rows) ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading"><?php echo _l('personal_information_emergency') ?></div>
                  <div class="panel-body">
                    <div class="personal_information">
                      <div class="row" id="personal_information">
                        <div class="col-md-12">
                          <div class="col-md-3">
                            <?php $hobby = (isset($candidate) ? $candidate->hobby : '');
                            echo render_input('hobby', 'personal_info_emergency', $hobby); ?>
                          </div>
                          

                          <div class="col-md-3">
                            <?php $working_clothes = (isset($candidate) ? $candidate->working_clothes : '');
                            echo render_input('working_clothes', 'relationship_to_the_emergency_contact_person', $working_clothes); ?>
                          </div>


                          <div class="col-md-3">
                            <?php $emergency_contact_number = (isset($candidate) ? $candidate->emergency_contact_number : '');
                            echo render_input('emergency_contact_number', 'emergency_contact_number', $emergency_contact_number); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $veterna_no = (isset($candidate) ? $candidate->veterna_no : '');
                            echo render_input('veterna_no', 'emergency_contact_number_2', $veterna_no); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $veterna_relationships = (isset($candidate) ? $candidate->veterna_relationships : '');
                            echo render_input('veterna_relationships', 'email_address', $veterna_relationships); ?>
                          </div>



                          <div class="col-md-3">
                            <?php $native_religion = (isset($candidate) ? $candidate->native_religion : '');
                            echo render_input('native_religion', 'e_c_other_social_media_acc_link', $native_religion); ?>
                          </div>

                          <!-- <div class="col-md-3">
                            <?php //$family_register = (isset($candidate) ? $candidate->family_register : '');
                            //echo render_input('family_register', 'family_register', $family_register); 
                            ?>
                          </div> -->

                          <!-- <div class="col-md-3">
                            <?php //$pay_account = (isset($candidate) ? $candidate->pay_account : '');
                            //echo render_input('pay_account', 'pay_account', $pay_account); 
                            ?>
                          </div> -->

                          <!-- <div class="col-md-3">
                            <?php //$safety_shoes = (isset($candidate) ? $candidate->safety_shoes : '');
                            //echo render_input('safety_shoes', 'address', $safety_shoes); 
                            ?>
                          </div> -->


                          <!-- <div class="col-md-3">
                            <?php //$home_contact_number = (isset($candidate) ? $candidate->home_contact_number : '');
                            //echo render_input('home_contact_number', 'home_contact_number', $home_contact_number); 
                            ?>
                          </div> -->

                          <!-- <div class="col-md-3">
                            <?php //$emergency = (isset($candidate) ? $candidate->emergency : '');
                            //echo render_input('emergency', 'emergency', $emergency); 
                            ?>
                          </div> -->


                        </div>
                        <div class="col-md-12">
                          <div class="col-md-3">
                            <?php echo render_select('personal_info_region', !empty($countries) ? $countries : [], ['id', 'name'], 'Region', isset($candidate->personal_info_region) ? $candidate->personal_info_region : '');
                            ?>
                          </div>

                          <div class="col-md-3">
                            <?php
                            $selected_state = isset($candidate->personal_info_province) ? $candidate->personal_info_province : 0;
                            echo render_select('personal_info_province', isset($states) ? $states : [], ['id', 'name'], 'Province', $selected_state);
                            ?>
                          </div>

                          <div class="col-md-3">
                            <?php
                            $selected_city = isset($candidate->personal_info_municipality) ? $candidate->personal_info_municipality : 0;
                            echo render_select('personal_info_municipality', isset($cities) ? $cities : [], ['id', 'name'], 'Municipality / City', $selected_city);
                            ?>
                          </div>

                          <div class="col-md-3">
                            <?php $veterna_division = (isset($candidate) ? $candidate->veterna_division : '');
                            echo render_input('veterna_division', 'detailed_address', $veterna_division); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

            <?php if ($editSummary == '') { ?>
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading"><?php echo _l($title); ?></div>
                  <div class="panel-body">
                    <div class="row col-md-12" id="general_information">
                      <div class="col-md-3">
                        <div class="picture-container pull-left">
                          <div class="picture">
                            <img src="<?php if (isset($candidate->avar)) {
                                        echo site_url(RECRUITMENT_PATH . 'candidate/avartar/' . $candidate->id . '/' . $candidate->avar->file_name);
                                      } else {
                                        echo site_url(RECRUITMENT_PATH . 'none_avatar.jpg');
                                      } ?>" class="width-height-160" id="wizardPicturePreview" title="">
                            <input name="cd_avar" type="file" id="wizard-picture" accept=".png, .jpg, .jpeg" class="">
                          </div>
                          <h5 class=""><?php echo _l('choose_picture'); ?></h5><br>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-3">
                            <?php $candidate_name = (isset($candidate) ? $candidate->candidate_name : '');
                            echo render_input('candidate_name', 'first_name', $candidate_name) ?>
                          </div>

                          <div class="col-md-3">
                            <?php $last_name = (isset($candidate) ? $candidate->last_name : '');
                            echo render_input('last_name', 'last_name', $last_name) ?>
                          </div>

                          <div class="col-md-3">
                            <label for="gender"><?php echo _l('gender'); ?></label>
                            <select name="gender" id="gender" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>">
                              <option value=""></option>
                              <option value="male" <?php if (isset($candidate) && $candidate->gender == 'male') {
                                                      echo 'selected';
                                                    } ?>><?php echo _l('male'); ?></option>
                              <option value="female" <?php if (isset($candidate) && $candidate->gender == 'female') {
                                                        echo 'selected';
                                                      } ?>><?php echo _l('female'); ?></option>
                            </select>
                          </div>

                          <div class="col-md-3">
                            <label for="marital_status" class="control-label"><?php echo _l('marital_status'); ?></label>
                            <select name="marital_status" class="selectpicker" id="marital_status" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                              <option value=""></option>
                              <option value="<?php echo 'single'; ?>" <?php if (isset($candidate) && $candidate->marital_status == 'single') {
                                                                        echo 'selected';
                                                                      } ?>><?php echo _l('single'); ?></option>
                              <option value="<?php echo 'married'; ?>" <?php if (isset($candidate) && $candidate->marital_status == 'married') {
                                                                          echo 'selected';
                                                                        } ?>><?php echo _l('married'); ?></option>
                              <option value="<?php echo 'divorce'; ?>" <?php if (isset($candidate) && $candidate->marital_status == 'divorce') {
                                                                          echo 'selected';
                                                                        } ?>><?php echo _l('divorce'); ?></option>
                            </select>
                          </div>

                          <!-- <div class="col-md-3">
                            <?php //$status_type = (isset($candidate) ? $candidate->status_type : '');
                            //echo render_select('status_type[]', $status_data, ['id', 'status_name'], 'status_name', $status_type, ['data-actions-box' => true], [], '', '', false); 
                            ?>
                          </div> -->
                          <!-- <div class="col-md-3">
                          <label for="rec_campaign"><?php //echo _l('recruitment_campaign'); 
                                                    ?></label>
                          <select name="rec_campaign" id="rec_campaign" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php //echo _l('ticket_settings_none_assigned'); 
                                                                                                                                                                ?>">
                            <option value=""></option>
                            <?php //foreach ($rec_campaigns as $s) { 
                            ?>
                              <option value="<?php //echo html_entity_decode($s['cp_id']); 
                                              ?>" <?php //if (isset($candidate) && $s['cp_id'] == $candidate->rec_campaign) {
                                                  //echo 'selected';
                                                  //} 
                                                  ?>><?php //echo html_entity_decode($s['campaign_code'] . ' - ' . $s['campaign_name']); 
                                                      ?></option>
                            <?php //} 
                            ?>
                          </select>
                          <br><br>
                        </div> -->

                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="row">

                          <div class="col-md-3">
                            <?php $email = (isset($candidate) ? $candidate->email : '');
                            echo render_input('email', 'email', $email); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $height = (isset($candidate) ? $candidate->height : '');
                            echo render_input('height', 'height', $height); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $weight = (isset($candidate) ? $candidate->weight : '');
                            echo render_input('weight', 'weight', $weight); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $nationality = (isset($candidate) ? $candidate->nationality : '');
                            echo render_input('nationality', 'nationality', $nationality); ?>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-3">
                            <?php $birthday = (isset($candidate) ? $candidate->birthday : '');
                            echo render_date_input('birthday', 'birthday', _d($birthday)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $birthplace = (isset($candidate) ? $candidate->birthplace : '');
                            echo render_input('birthplace', 'birthplace', $birthplace) ?>
                          </div>

                          <div class="col-md-3">
                            <?php $religion = (isset($candidate) ? $candidate->religion : '');
                            echo render_input('religion', 'religion', $religion); ?>
                          </div>

                          <!-- <div class="col-md-3">
                            <?php //$home_town = (isset($candidate) ? $candidate->home_town : '');
                            //echo render_input('home_town', 'home_town', $home_town) 
                            ?>
                          </div> -->

                          <div class="col-md-3">
                            <?php echo render_input('file', 'file_campaign', '', 'file') ?>
                          </div>
                        </div>
                      </div>

                      <!-- <div class="col-md-12">
                        <div class="row"> -->
                      <!-- <div class="col-md-3">
                          <?php //$arrAtt = array();
                          //$arrAtt['data-type'] = 'currency';
                          //$desired_salary = (isset($candidate) ? app_format_money($candidate->desired_salary, '') : '');
                          ?>
                        </div> -->

                      <!-- </div>
                      </div> -->

                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-3">
                            <?php $selected_country = isset($candidate) ? $candidate->address_country : 0;
                            echo render_select('address_country', !empty($countries) ? $countries : [], ['id', 'name'], 'Region', isset($selected_country) ? $selected_country : '');
                            ?>
                          </div>

                          <div class="col-md-3">
                            <?php
                            $selected_state = isset($candidate) ? $candidate->state : 0;
                            ?>
                            <input type="hidden" id="seelcted_state_value" value="<?php echo $selected_state; ?>" />
                            <?php echo render_select('state', isset($edit_states) ? $edit_states : [], ['id', 'name'], 'Province', $selected_state); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $selected_city = isset($candidate) ? $candidate->city : 0; ?>
                            <input type="hidden" id="seelcted_city_value" value="<?php echo $selected_city; ?>" />
                            <?php echo render_select('city', isset($edit_cities) ? $edit_cities : [], ['id', 'name'], 'Municipality / City', $selected_city); ?>
                          </div>

                          <div class="col-md-3">
                            <?php
                            $resident = (isset($candidate) ? $candidate->resident : '');
                            echo render_input('resident', 'resident', $resident); ?>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row">

                          <div class="col-md-2" style="width: 20%;">
                            <?php $skype = (isset($candidate) ? $candidate->skype : '');
                            echo render_input('skype', 'skype', $skype); ?>
                          </div>

                          <div class="col-md-2" style="width: 20%;">
                            <?php $facebook = (isset($candidate) ? $candidate->facebook : '');
                            echo render_input('facebook', 'facebook', $facebook); ?>
                          </div>

                          <div class="col-md-2" style="width: 20%;">
                            <?php $linkedin = (isset($candidate) ? $candidate->linkedin : '');
                            echo render_input('linkedin', 'linkedin', $linkedin); ?>
                          </div>

                          <div class="col-md-2" style="width: 20%;">
                            <?php $phonenumber = (isset($candidate) ? $candidate->phonenumber : '');
                            echo render_input('phonenumber', 'phonenumber', $phonenumber); ?>
                          </div>

                          <div class="col-md-2" style="width: 20%;">
                            <?php $specially = (isset($candidate) ? $candidate->specially : '');
                            echo render_input('specially', 'specially', $specially); ?>
                          </div>

                          <div class="col-md-4">
                            <?php
                            $rows = [];
                            $rows['rows'] = 6;
                            $interests = (isset($candidate) ? $candidate->interests : '');
                            echo render_textarea('interests', 'interests', $interests, $rows) ?>
                          </div>

                          <div class="col-md-4">
                            <?php
                            $rows = [];
                            $rows['rows'] = 6;
                            $current_accommodation = (isset($candidate) ? $candidate->current_accommodation : '');
                            echo render_textarea('current_accommodation', 'current_accommodation', $current_accommodation, $rows) ?>
                          </div>

                          <div class="col-md-4">
                            <?php $introduce_yourself = (isset($candidate) ? $candidate->introduce_yourself : '');
                            $rows = [];
                            $rows['rows'] = 6;
                            echo render_textarea('introduce_yourself', 'introduce_yourself', $introduce_yourself, $rows) ?>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row">
                          <!-- <div class="col-md-6">
                            <?php
                            //$rows = [];
                            //$rows['rows'] = 4;
                            //$present_resident_kor = (isset($candidate) ? $candidate->present_resident_kor : '');
                            //echo render_textarea('present_resident_kor', 'present_resident_kor', $present_resident_kor, $rows) 
                            ?>
                          </div> -->

                          <!-- <div class="col-md-6">
                            <?php
                            //$rows = [];
                            //$rows['rows'] = 4;
                            //$present_resident_eng = (isset($candidate) ? $candidate->present_resident_eng : '');
                            //echo render_textarea('present_resident_eng', 'present_resident_eng', $present_resident_eng, $rows) 
                            ?>
                          </div> -->
                        </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>

            <?php } ?>


            <?php if ($editSummary == '') { ?>

              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading"><?php echo _l('personal_information_emergency') ?></div>
                  <div class="panel-body">
                    <div class="personal_information">
                      <div class="row" id="personal_information">
                        <div class="col-md-12">
                          <div class="col-md-3">
                            <?php $hobby = (isset($candidate) ? $candidate->hobby : '');
                            echo render_input('hobby', 'personal_info_emergency', $hobby); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $working_clothes = (isset($candidate) ? $candidate->working_clothes : '');
                            echo render_input('working_clothes', 'relationship_to_the_emergency_contact_person', $working_clothes); ?>
                          </div>


                          <div class="col-md-3">
                            <?php $emergency_contact_number = (isset($candidate) ? $candidate->emergency_contact_number : '');
                            echo render_input('emergency_contact_number', 'emergency_contact_number', $emergency_contact_number); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $veterna_no = (isset($candidate) ? $candidate->veterna_no : '');
                            echo render_input('veterna_no', 'emergency_contact_number_2', $veterna_no); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $veterna_relationships = (isset($candidate) ? $candidate->veterna_relationships : '');
                            echo render_input('veterna_relationships', 'email_address', $veterna_relationships); ?>
                          </div>



                          <div class="col-md-3">
                            <?php $native_religion = (isset($candidate) ? $candidate->native_religion : '');
                            echo render_input('native_religion', 'e_c_other_social_media_acc_link', $native_religion); ?>
                          </div>

                          <!-- <div class="col-md-3">
                            <?php //$family_register = (isset($candidate) ? $candidate->family_register : '');
                            //echo render_input('family_register', 'family_register', $family_register); 
                            ?>
                          </div> -->

                          <!-- <div class="col-md-3">
                            <?php //$pay_account = (isset($candidate) ? $candidate->pay_account : '');
                            //echo render_input('pay_account', 'pay_account', $pay_account); 
                            ?>
                          </div> -->

                          <!-- <div class="col-md-3">
                            <?php //$safety_shoes = (isset($candidate) ? $candidate->safety_shoes : '');
                            //echo render_input('safety_shoes', 'address', $safety_shoes); 
                            ?>
                          </div> -->


                          <!-- <div class="col-md-3">
                            <?php //$home_contact_number = (isset($candidate) ? $candidate->home_contact_number : '');
                            //echo render_input('home_contact_number', 'home_contact_number', $home_contact_number); 
                            ?>
                          </div> -->

                          <!-- <div class="col-md-3">
                            <?php //$emergency = (isset($candidate) ? $candidate->emergency : '');
                            //echo render_input('emergency', 'emergency', $emergency); 
                            ?>
                          </div> -->


                        </div>
                        <div class="col-md-12">
                          <div class="col-md-3">
                            <?php echo render_select('personal_info_region', !empty($countries) ? $countries : [], ['id', 'name'], 'Region', isset($candidate->personal_info_region) ? $candidate->personal_info_region : '');
                            ?>
                          </div>

                          <div class="col-md-3">
                            <?php
                            $selected_state = isset($candidate->personal_info_province) ? $candidate->personal_info_province : 0;
                            echo render_select('personal_info_province', isset($states) ? $states : [], ['id', 'name'], 'Province', $selected_state);
                            ?>
                          </div>

                          <div class="col-md-3">
                            <?php
                            $selected_city = isset($candidate->personal_info_municipality) ? $candidate->personal_info_municipality : 0;
                            echo render_select('personal_info_municipality', isset($cities) ? $cities : [], ['id', 'name'], 'Municipality / City', $selected_city);
                            ?>
                          </div>

                          <div class="col-md-3">
                            <?php $veterna_division = (isset($candidate) ? $candidate->veterna_division : '');
                            echo render_input('veterna_division', 'detailed_address', $veterna_division); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>


            <?php if ($editSummary == '') { ?>

              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading"><?php echo _l('professional_career') ?></div>
                  <div class="panel-body">
                    <div class="personal_information">
                      <div class="row" id="personal_information">

                        <div class="col-md-12">

                          <div class="col-md-3">
                            <?php $candidate_code = (isset($candidate) ? $candidate->candidate_code : '');
                            echo render_input('candidate_code', 'candidate_code', $candidate_code) ?>
                          </div>

                          <!-- <div class="col-md-3">
                            <?php //$rank = (isset($candidate) ? $candidate->rank : '');
                           // echo render_select('rank[]', $ranks, ['id', 'rank_name'], 'rank', $rank, ['data-actions-box' => true], [], '', '', false); ?>
                          </div> -->


                          <div class="col-md-3">
                            <div class="form-group">
                              <?php
                              $selected_rank = isset($candidate) ? $candidate->rank : '';
                              ?>
                              <label for="department"><?php echo _l("rank") ?></label>
                              <select name="rank[]" id="rank" class="form-control select2" data-actions-box="true" disabled>
                                <option value="">Select Rank</option>
                                <?php foreach ($ranks as $rank) { ?>
                                  <option value="<?php echo $rank['id']; ?>" <?php echo $selected_rank == $rank['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($rank['rank_name']); ?>
                                  </option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <?php $emp_status = (isset($candidate) ? $candidate->emp_status : '');
                            echo render_select('emp_status', $emp_status_list, ['id', 'emp_status_name'], 'emp_status', $emp_status, ['data-actions-box' => true], [], '', '', false); ?>
                          </div>


                          <div class="col-md-3">
                            <div class="form-group">
                              <?php
                              $selected_department = isset($candidate) ? $candidate->department : '';
                              ?>
                              <label for="department"><?php echo _l("department") ?></label>
                              <select name="department" id="department" class="form-control select2" data-actions-box="true" disabled>
                                <option value=""></option>
                                <?php foreach ($department_data as $department) { ?>
                                  <option value="<?php echo $department['id']; ?>" <?php echo $selected_department == $department['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($department['department_name']); ?>
                                  </option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <?php $department_date = (isset($candidate) ? $candidate->department_date : '');
                            echo render_date_input('department_date', 'department_date', _d($department_date)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $hired_type = (isset($candidate) ? $candidate->hired_type : '');
                            echo render_input('hired_type', 'hired_type', $hired_type); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $hired_date = (isset($candidate) ? $candidate->hired_date : '');
                            echo render_date_input('hired_date', 'hired_date', _d($hired_date)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $promotion = (isset($candidate) ? $candidate->promotion : '');
                            echo render_date_input('promotion', 'promotion', _d($promotion)); ?>
                          </div>


                          <div class="col-md-3">
                            <?php $ereg_no = (isset($candidate) ? $candidate->ereg_no : '');
                            echo render_input('ereg_no', 'ereg_no', $ereg_no); ?>

                          </div>

                          <div class="col-md-3">
                            <?php $manning_agency = (isset($candidate) ? $candidate->manning_agency : '');
                            echo render_select('manning_agency', $manning_agency_list, ['id', 'manning_agency_name'], 'manning_agency', $manning_agency, ['data-actions-box' => true], [], '', '', false); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $employer = (isset($candidate) ? $candidate->employer : '');
                            echo render_input('employer', 'employer', $employer); ?>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-3">
                            <?php $vsl_career = (isset($candidate) ? $candidate->vsl_career : '');
                            echo render_input('vsl_career', 'vsl_career', $vsl_career, 'text', array('readonly' => true)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $rank_career = (isset($candidate) ? $candidate->rank_career : '');
                            echo render_input('rank_career', 'rank_career', $rank_career, 'text', array('readonly' => true)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $hire_career = (isset($candidate) ? $candidate->hire_career : '');
                            echo render_input('hire_career', 'hire_career', $hire_career, 'text', array('readonly' => true)); ?>
                          </div>

                          <div class="col-md-3">
                            <?php $status_type = (isset($candidate) ? $candidate->status_type : '');
                            echo render_select('status_type[]', $status_data, ['id', 'status_name'], 'status_name', $status_type, ['data-actions-box' => true], [], '', '', false); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

            <?php if ($editSummary == '') { ?>

              <?php if (get_tab_option('tab_custom_filed_setting_details') == 0 || !get_tab_option('tab_custom_filed_setting_details')) { ?>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading"><?php echo _l('work_experience') ?></div>
                    <div class="panel-body">
                      <div class="work_experience">
                        <?php if (isset($candidate) && count($candidate->work_experience) > 0) {
                          foreach ($candidate->work_experience as $key => $val) {
                        ?>
                            <div class="row col-md-12" id="work_experience-item">
                              <div class="col-md-3">
                                <?php $from_date = _d($val['from_date']);
                                echo render_date_input('from_date[' . $key . ']', 'from_date', _d($from_date)); ?>
                              </div>

                              <div class="col-md-3">
                                <?php $to_date = _d($val['to_date']);
                                echo render_date_input('to_date[' . $key . ']', 'to_date', _d($to_date)); ?>
                              </div>

                              <div class="col-md-3">
                                <?php $company = _d($val['company']);
                                echo render_input('company[' . $key . ']', 'company', $company); ?>
                              </div>

                              <div class="col-md-3">
                                <?php $position = _d($val['position']);
                                echo render_input('position[' . $key . ']', 'position', $position); ?>
                              </div>

                              <div class="col-md-3">
                                <?php $contact_person = $val['contact_person'];
                                echo render_input('contact_person[' . $key . ']', 'contact_person', $contact_person) ?>
                              </div>
                              <div class="col-md-3">
                                <?php $salary = $val['salary'];
                                echo render_input('salary[' . $key . ']', 'salary', $salary) ?>
                              </div>

                              <div class="col-md-3">
                                <?php $reason_quitwork = $val['reason_quitwork'];
                                echo render_input('reason_quitwork[' . $key . ']', 'reason_quitwork', $reason_quitwork) ?>
                              </div>

                              <div class="col-md-12">
                                <?php $job_description = $val['job_description'];
                                echo render_textarea('job_description[' . $key . ']', 'job_description', $job_description) ?>
                              </div>

                              <?php if ($key == 0) { ?>
                                <div class="col-md-12 line-height-content">
                                  <span class="input-group-btn pull-bot">
                                    <button name="add" class="btn new_work_experience btn-success border-radius-4" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
                                  </span>
                                </div>
                              <?php } else { ?>
                                <div class="col-md-12 line-height-content">
                                  <span class="input-group-btn pull-bot">
                                    <button name="add" class="btn remove_work_experience btn-danger border-radius-4" data-ticket="true" type="button"><i class="fa fa-minus"></i></button>
                                  </span>
                                </div>
                              <?php } ?>
                            </div>

                          <?php }
                        } else { ?>
                          <div class="row col-md-12" id="work_experience-item">
                            <div class="col-md-3">
                              <?php echo render_date_input('from_date[0]', 'from_date', ''); ?>
                            </div>

                            <div class="col-md-3">
                              <?php echo render_date_input('to_date[0]', 'to_date', ''); ?>
                            </div>

                            <div class="col-md-3">
                              <?php echo render_input('company[0]', 'company') ?>
                            </div>

                            <div class="col-md-3">
                              <?php echo render_input('position[0]', 'position') ?>
                            </div>

                            <div class="col-md-3">
                              <?php echo render_input('contact_person[0]', 'contact_person') ?>
                            </div>
                            <div class="col-md-3">
                              <?php echo render_input('salary[0]', 'salary') ?>
                            </div>

                            <div class="col-md-6">
                              <?php echo render_input('reason_quitwork[0]', 'reason_quitwork') ?>
                            </div>

                            <div class="col-md-12">
                              <p class="bold"><?php echo _l('job_description'); ?></p>
                              <?php echo render_textarea('job_description[0]', '', ''); ?>
                            </div>

                            <div class="col-md-12 line-height-content">
                              <span class="input-group-btn pull-bot">
                                <button name="add" class="btn new_work_experience btn-success border-radius-4" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
                              </span>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>

            <?php } ?>

            <?php if ($editSummary == '') { ?>

              <?php if (get_tab_option('tab_custom_filed_setting_details') == 0 || !get_tab_option('tab_custom_filed_setting_details')) { ?>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading"><?php echo _l('literacy') ?></div>
                    <div class="panel-body">
                      <div class="list_literacy">
                        <?php if (isset($candidate) && count($candidate->literacy) > 0) {
                          foreach ($candidate->literacy as $key => $val) {
                        ?>
                            <div class="row col-md-12" id="literacy-item">
                              <div class="col-md-2">
                                <?php $literacy_from_date = _d($val['literacy_from_date']);
                                echo render_date_input('literacy_from_date[' . $key . ']', 'from_date', _d($literacy_from_date)); ?>
                              </div>

                              <div class="col-md-2">
                                <?php $literacy_to_date = _d($val['literacy_to_date']);
                                echo render_date_input('literacy_to_date[' . $key . ']', 'to_date', _d($literacy_to_date)); ?>
                              </div>

                              <div class="col-md-2">
                                <?php $diploma = $val['diploma'];
                                echo render_input('diploma[' . $key . ']', 'diploma', $diploma) ?>
                              </div>

                              <div class="col-md-2">
                                <?php $training_places = $val['training_places'];
                                echo render_input('training_places[' . $key . ']', 'training_places', $training_places) ?>
                              </div>

                              <div class="col-md-2">
                                <?php $specialized = $val['specialized'];
                                echo render_input('specialized[' . $key . ']', 'specialized', $specialized) ?>
                              </div>
                              <div class="col-md-2">
                                <?php $training_form = $val['training_form'];
                                echo render_input('training_form[' . $key . ']', 'training_form', $training_form) ?>
                              </div>
                              <?php if ($key == 0) { ?>
                                <div class="col-md-12 line-height-content">
                                  <span class="input-group-btn pull-bot">
                                    <button name="add" class="btn new_literacy btn-success border-radius-4" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
                                  </span>
                                </div>
                              <?php } else { ?>
                                <div class="col-md-12 line-height-content">
                                  <span class="input-group-btn pull-bot">
                                    <button name="add" class="btn remove_literacy btn-danger border-radius-4" data-ticket="true" type="button"><i class="fa fa-minus"></i></button>
                                  </span>
                                </div>
                              <?php } ?>
                            </div>
                          <?php }
                        } else { ?>
                          <div class="row col-md-12" id="literacy-item">
                            <div class="col-md-2">
                              <?php echo render_date_input('literacy_from_date[0]', 'from_date', ''); ?>
                            </div>

                            <div class="col-md-2">
                              <?php echo render_date_input('literacy_to_date[0]', 'to_date', ''); ?>
                            </div>

                            <div class="col-md-2">
                              <?php echo render_input('diploma[0]', 'diploma') ?>
                            </div>

                            <div class="col-md-2">
                              <?php echo render_input('training_places[0]', 'training_places') ?>
                            </div>

                            <div class="col-md-2">
                              <?php echo render_input('specialized[0]', 'specialized') ?>
                            </div>
                            <div class="col-md-2">
                              <?php echo render_input('training_form[0]', 'training_form') ?>
                            </div>

                            <div class="col-md-12 line-height-content">
                              <span class="input-group-btn pull-bot">
                                <button name="add" class="btn new_literacy btn-success border-radius-4" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
                              </span>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>

              <?php if (get_tab_option('tab_custom_filed_setting_details') == 0 || !get_tab_option('tab_custom_filed_setting_details')) { ?>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading"><?php echo _l('family_infor') ?></div>
                    <div class="panel-body">
                      <div class="list_family_infor">
                        <?php if (isset($candidate) && count($candidate->family_infor) > 0) {
                          foreach ($candidate->family_infor as $key => $val) {
                        ?>
                            <div class="row col-md-12" id="family_infor-item">
                              <div class="col-md-2">
                                <?php $relationship = $val['relationship'];
                                echo render_input('relationship[' . $key . ']', 'relationship', $relationship); ?>
                              </div>

                              <div class="col-md-2">
                                <?php $name = $val['name'];
                                echo render_input('name[' . $key . ']', 'name', $name); ?>
                              </div>

                              <div class="col-md-2">
                                <?php $fi_birthday = _d($val['fi_birthday']);
                                echo render_date_input('fi_birthday[' . $key . ']', 'birthday', _d($fi_birthday)) ?>
                              </div>

                              <div class="col-md-2">
                                <?php $job = $val['job'];
                                echo render_input('job[' . $key . ']', 'job', $job) ?>
                              </div>

                              <div class="col-md-2">
                                <?php $address = $val['address'];
                                echo render_input('address[' . $key . ']', 'address', $address) ?>
                              </div>
                              <div class="col-md-2">
                                <?php $phone = $val['phone'];
                                echo render_input('phone[' . $key . ']', 'phone', $phone) ?>
                              </div>
                              <?php if ($key == 0) { ?>
                                <div class="col-md-12 line-height-content">
                                  <span class="input-group-btn pull-bot">
                                    <button name="add" class="btn new_family_infor btn-success border-radius-4" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
                                  </span>
                                </div>
                              <?php } else { ?>
                                <div class="col-md-12 line-height-content">
                                  <span class="input-group-btn pull-bot">
                                    <button name="add" class="btn remove_family_infor btn-danger border-radius-4" data-ticket="true" type="button"><i class="fa fa-minus"></i></button>
                                  </span>
                                </div>
                              <?php } ?>
                            </div>
                          <?php }
                        } else { ?>
                          <div class="row col-md-12" id="family_infor-item">
                            <div class="col-md-2">
                              <?php echo render_input('relationship[0]', 'relationship', ''); ?>
                            </div>

                            <div class="col-md-2">
                              <?php echo render_input('name[0]', 'name', ''); ?>
                            </div>

                            <div class="col-md-2">
                              <?php echo render_date_input('fi_birthday[0]', 'birthday') ?>
                            </div>

                            <div class="col-md-2">
                              <?php echo render_input('job[0]', 'job') ?>
                            </div>

                            <div class="col-md-2">
                              <?php echo render_input('address[0]', 'address') ?>
                            </div>
                            <div class="col-md-2">
                              <?php echo render_input('phone[0]', 'phone') ?>
                            </div>

                            <div class="col-md-12 line-height-content">
                              <span class="input-group-btn pull-bot">
                                <button name="add" class="btn new_family_infor btn-success border-radius-4" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
                              </span>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <hr>
            <?php } ?>

            <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php init_tail(); ?>
<?php require 'modules/recruitment/assets/js/custom_candidate_js.php'; ?>
</body>

</html>