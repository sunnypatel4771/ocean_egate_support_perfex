<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="panel_s">
			<div class="panel-body">
				<div class="col-md-12">
					<?php
					$get_base_currency = get_base_currency();
					$current_id = '';
					if ($get_base_currency) {
						$current_id = $get_base_currency->id;
					}
					?>
					<h4 class="bold col-md-5">
						<?php echo '#' . $candidate->candidate_code . ' - ' . $candidate->candidate_name . ' ' . $candidate->last_name; ?>
					</h4>
					<a href="Javascript:void(0);" id="toggle_popup_approval" class="btn btn-success display-block pull-right"><i class="fa fa-user-md"></i><?php echo ' ' . _l('rec_care') . ' '; ?><i class="fa fa-caret-down"></i></a>
					<ul id="popup_approval" class="dropdown-menu dropdown-menu-right min-width-440">
						<li>
							<br>
							<div class="col-md-12">
								<a href="#" onclick="interview(); return false;" class="btn btn-info pull-right display-block mright5 interview-background"><i class="fa fa-microphone"></i><?php echo ' ' . _l('interview'); ?></a>
								<a href="#" onclick="test(); return false;" class="btn btn-info pull-right display-block mright5 test-background"><i class="fa fa-forward"></i><?php echo ' ' . _l('test'); ?></a>
								<a href="#" onclick="call(); return false;" class="btn btn-info pull-right display-block mright5 call-background"><i class="fa fa-phone"></i><?php echo ' ' . _l('call'); ?></a>
								<a href="#" onclick="sendmail(); return false;" class="btn btn-info pull-right display-block mright5 send_mail-background"><i class="fa fa-envelope"></i><?php echo ' ' . _l('send_mail'); ?></a>

							</div>
							<br>&nbsp;<br />
						</li>
					</ul>
					<a href="#" onclick="send_mail_candidate(); return false;" class="btn btn-info pull-right display-block mright5"><i class="fa fa-envelope"></i><?php echo ' ' . _l('send_mail'); ?></a>

					<a href="#" class="btn btn-warning pull-right mright5" data-toggle="modal" data-target="#candidate_rating"><i class="fa fa-star"></i><?php echo ' ' . _l('rate_candidate'); ?></a>
					<div class="col-md-3 pull-right">
						<select name="change_status" id="change_status" onchange="change_status_candidate(this,<?php echo html_entity_decode($candidate->id); ?>); return false;" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('change_status_to'); ?>">
							<option value=""></option>
							<option value="1" class="<?php if ($candidate->status == 1) {
															echo 'hide';
														} ?>"><?php echo _l('application'); ?></option>
							<option value="2" class="<?php if ($candidate->status == 2) {
															echo 'hide';
														} ?>"><?php echo _l('potential'); ?></option>
							<option value="3" class="<?php if ($candidate->status == 3) {
															echo 'hide';
														} ?>"><?php echo _l('interview'); ?></option>
							<option value="4" class="<?php if ($candidate->status == 4) {
															echo 'hide';
														} ?>"><?php echo _l('won_interview'); ?></option>
							<option value="5" class="<?php if ($candidate->status == 5) {
															echo 'hide';
														} ?>"><?php echo _l('send_offer'); ?></option>
							<option value="6" class="<?php if ($candidate->status == 6) {
															echo 'hide';
														} ?>"><?php echo _l('elect'); ?></option>
							<option value="7" class="<?php if ($candidate->status == 7) {
															echo 'hide';
														} ?>"><?php echo _l('non_elect'); ?></option>
							<option value="8" class="<?php if ($candidate->status == 8) {
															echo 'hide';
														} ?>"><?php echo _l('unanswer'); ?></option>
							<option value="9" class="<?php if ($candidate->status == 9) {
															echo 'hide';
														} ?>"><?php echo _l('transferred'); ?></option>
							<option value="10" class="<?php if ($candidate->status == 10) {
															echo 'hide';
														} ?>"><?php echo _l('freedom'); ?></option>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="horizontal-scrollable-tabs preview-tabs-top">
						<div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
						<div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
						<div class="horizontal-tabs">
							<ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">
								<li role="presentation" class="active">
									<a href="#detail" aria-controls="detail" role="tab" data-toggle="tab" aria-controls="detail">
										<span class="glyphicon glyphicon-align-justify"></span>&nbsp;<?php echo _l('detail'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#education_info" aria-controls="education_info" role="tab" data-toggle="tab" aria-controls="education_info">
										<i class="fa fa-book"></i>&nbsp;<?php echo _l('education_info'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#school_info" aria-controls="school_info" role="tab" data-toggle="tab" aria-controls="school_info">
										<i class="fa fa-school"></i>&nbsp;<?php echo _l('schools_info'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#personal_info" aria-controls="personal_info" role="tab" data-toggle="tab" aria-controls="personal_info">
										<i class="fa fa-user"></i>&nbsp;<?php echo _l('personal_info'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#family_info" aria-controls="family_info" role="tab" data-toggle="tab" aria-controls="family_info">
										<i class="fa fa-users"></i>&nbsp;<?php echo _l('family_info'); ?>
									</a>
								</li>
								<?php
								if (get_tab_option('recruitment_create_campaign_tab_reward') == 1) { ?>
									<li role="presentation">
										<a href="#reward_info" aria-controls="reward_info" role="tab" data-toggle="tab" aria-controls="reward_info">
											<i class="fa fa-award"></i>&nbsp;<?php echo _l('reward'); ?>
										</a>
									</li>
								<?php } ?>
								<?php if (get_tab_option('recruitment_create_campaign_tab_medical') == 1) { ?>
									<li role="presentation">
										<a href="#medical_info" aria-controls="medical_info" role="tab" data-toggle="tab" aria-controls="medical_info">
											<i class="fa fa-hospital"></i>&nbsp;<?php echo _l('medical'); ?>
										</a>
									</li>
								<?php } ?>
								<li role="presentation">
									<a href="#licence_document_info" aria-controls="licence_document_info" role="tab" data-toggle="tab" aria-controls="licence_document_info">
										<i class="fa fa-hospital"></i>&nbsp;<?php echo _l('licence_document_info'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#promotion_info" aria-controls="promotion_info" role="tab" data-toggle="tab" aria-controls="promotion_info">
										<i class="fa fa-hospital"></i>&nbsp;<?php echo _l('promotion'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#on_board" aria-controls="on_board" role="tab" data-toggle="tab" aria-controls="on_board">
										<i class="fa fa-sitemap"></i>&nbsp;<?php echo _l('on_board'); ?>
									</a>
								</li>
								<?php if (get_tab_option('recruitment_create_campaign_tab_psc') == 1) { ?>
									<li role="presentation">
										<a href="#psc_info" aria-controls="psc_info" role="tab" data-toggle="tab" aria-controls="psc_info">
											<i class="fa fa-university"></i>&nbsp;<?php echo _l('psc'); ?>
										</a>
									</li>
								<?php } ?>
								<li role="presentation">
									<a href="#history_recruitment" aria-controls="history_recruitment" role="tab" data-toggle="tab" aria-controls="history_recruitment">
										<i class="fa fa-calendar"></i>&nbsp;<?php echo _l('history_recruitment'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#capacity_profile" aria-controls="capacity_profile" role="tab" data-toggle="tab" aria-controls="capacity_profile">
										<i class="fa fa-address-card"></i>&nbsp;<?php echo _l('capacity_profile'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#attachment" aria-controls="attachment" role="tab" data-toggle="tab" aria-controls="attachment">
										<i class="fa fa-paperclip"></i>&nbsp;<?php echo _l('attachment'); ?>
									</a>
								</li>

							</ul>
						</div>
					</div>




					<div class="tab-content">
						<div role="tabpanel" class="tab-pane" id="personal_info">
							<p class="bold margin-top-15 other_infor-style"><?php echo _l('personal_information'); ?></p>

							<form method="get" id="personalInfoForm" action="<?php echo admin_url('recruitment/personal_info/' . $candidate->id) ?>">

								<hr class="margin-top-10 general-infor-hr" />
								<div class="col-md-12">
									<div class="col-md-6">
										<p class="bold pull-left" style="text-align: center;"><?php echo _l('personal'); ?></p>
									</div>
									<div class="col-md-6">
										<a href="#" id="PersonalEditButton" style="margin-bottom: 10px;" class="btn btn-info pull-right" onclick="editPersonalInfo()"><?php echo _l('edit'); ?></a>
										<div id="personalSaveButtonDiv" style="display:none;">
											<button type="submit" id="personalSaveButton" style="margin-bottom: 10px;" class="btn btn-info pull-right"><?php echo _l('Save'); ?></button>
										</div>
									</div>
								</div>
								<hr style="margin: 17px;border: 1px solid #eee;" />

								<div class="col-md-6 padding-left-right-2">

									<table class="table border table-striped margin-top-0 project_view_table">
										<tbody>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('hobby'); ?></td>
												<td id="hobbyEditField"><?php echo _l($candidate->hobby); ?></td>
												<td id="hobbySaveField" style="display: none;"> <?php $hobby = (isset($candidate) ? $candidate->hobby : '');
																								echo render_input('hobby', '', $hobby); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('working_clothes'); ?></td>
												<td id="workingEditField"><?php echo _l($candidate->working_clothes); ?></td>
												<td id="workingSaveField" style="display: none;"> <?php $working_clothes = (isset($candidate) ? $candidate->working_clothes : '');
																									echo render_input('working_clothes', '', $working_clothes); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('disability'); ?></td>
												<td id="disabilityEditField"><?php echo _l($candidate->disability); ?></td>
												<td id="disabilitySaveField" style="display: none;">
													<select name="disability" id="disability" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>">
														<option value=""></option>
														<option value="Y" <?php if (isset($candidate) && $candidate->disability == 'Y') {
																				echo 'selected';
																			} ?>><?php echo _l('Y'); ?></option>
														<option value="N" <?php if (isset($candidate) && $candidate->disability == 'N') {
																				echo 'selected';
																			} ?>><?php echo _l('N'); ?></option>
													</select>
												</td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('disability_rating'); ?></td>
												<td id="disabilityratingEditField"><?php echo _l($candidate->disability_rating); ?></td>
												<td id="disabilityratingSaveField" style="display: none;"> <?php $disability_rating = (isset($candidate) ? $candidate->disability_rating : '');
																											echo render_input('disability_rating', '', $disability_rating); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('disability_rating_date'); ?></td>
												<td id="disability_rating_date_edit"><?php echo _l(_d($candidate->disability_rating_date)); ?></td>
												<td id="disability_rating_date_Save" style="display: none;"> <?php $disability_rating_date = (isset($candidate) ? _d($candidate->disability_rating_date) : '');
																												echo render_date_input('disability_rating_date', '', $disability_rating_date); ?></td>

											</tr>

										</tbody>
									</table>
								</div>
								<div class="col-md-6 padding-left-right-0">
									<table class="table border table-striped margin-top-0 project_view_table">
										<tbody>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('religion'); ?></td>
												<td id="religion_edit"><?php echo _l($candidate->religion); ?></td>
												<td id="religion_save" style="display: none;"> <?php $religion = (isset($candidate) ? $candidate->religion : '');
																								echo render_input('religion', '', $religion); ?></td>
											</tr>
											<!-- <tr class="project-overview">
												<td class="bold"><?php //echo _l('wedding'); 
																	?></td>
												<td id="wedding_edit"><?php //echo _l($candidate->wedding); 
																		?></td>
												<td id="wedding_save" style="display: none;"> <?php //$wedding = (isset($candidate) ? $candidate->wedding : ''); 
																								?>
													<select name="wedding" id="wedding" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php //echo _l('ticket_settings_none_assigned'); 
																																												?>">
														<option value=""></option>

														<option value=""></option>
														<option value="<?php //echo 'single'; 
																		?>" <?php //if (isset($candidate) && $candidate->marital_status == 'single') //{
																			//echo 'selected';
																			//} 
																			?>><?php //echo _l('single'); 
																				?></option>
														<option value="<?php //echo 'married'; 
																		?>" <?php //if (isset($candidate) && $candidate->marital_status == 'married') {
																			//echo 'selected';
																			//} 
																			?>><?php //echo _l('married'); 
																				?></option>
														<option value="<?php //echo 'widowed'; 
																		?>" <?php //if (isset($candidate) && $candidate->marital_status == 'widowed') {
																			//echo 'selected';
																			//} 
																			?>><?php //echo _l('widowed'); 
																				?></option>
													</select>
												</td>



											</tr> -->

											<tr class="project-overview">
												<td class="bold"><?php echo _l('safety_shoes'); ?></td>
												<td id="safety_shoes_edit"><?php echo _l($candidate->safety_shoes); ?></td>
												<td id="safety_shoes_Save" style="display: none;"> <?php $safety_shoes = (isset($candidate) ? $candidate->safety_shoes : '');
																									echo render_input('safety_shoes', '', $safety_shoes); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('veterna_division'); ?></td>
												<td id="veterna_division_edit"><?php echo _l($candidate->veterna_division); ?></td>
												<td id="veterna_division_save" style="display: none;"> <?php $veterna_division = (isset($candidate) ? $candidate->veterna_division : '');
																										echo render_input('veterna_division', '', $veterna_division); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('veterna_no'); ?></td>
												<td id="veterna_no_edit"><?php echo _l($candidate->veterna_no); ?></td>
												<td id="veterna_no_save" style="display: none;"> <?php $veterna_no = (isset($candidate) ? $candidate->veterna_no : '');
																									echo render_input('veterna_no', '', $veterna_no); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('veterna_relationships'); ?></td>
												<td id="veterna_relationships_edit"><?php echo _l($candidate->veterna_relationships); ?></td>
												<td id="veterna_relationships_save" style="display: none;"> <?php $veterna_relationships = (isset($candidate) ? $candidate->veterna_relationships : '');
																											echo render_input('veterna_relationships', '', $veterna_relationships); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold">&nbsp;&nbsp;</td>
												<td>&nbsp;&nbsp;</td>
											</tr>

										</tbody>
									</table>
								</div>

								<div class="col-md-12 padding-left-right-2">
									<hr class="other_infor-hr" />
								</div>

								<div class="col-md-6 padding-left-right-2">
									<table class="table border table-striped margin-top-0 project_view_table">
										<tbody>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('native_religion'); ?></td>
												<td id="native_religion_edit"><?php echo _l($candidate->native_religion); ?></td>
												<td id="native_religion_save" style="display: none;"> <?php $native_religion = (isset($candidate) ? $candidate->native_religion : '');
																										echo render_input('native_religion', '', $native_religion); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('present_resident_kor'); ?></td>
												<td id="present_resident_kor_edit"><?php echo _l($candidate->present_resident_kor); ?></td>
												<td id="present_resident_kor_save" style="display: none;"> <?php
																											$rows = [];
																											$rows['rows'] = 4;
																											$present_resident_kor = (isset($candidate) ? $candidate->present_resident_kor : '');
																											echo render_textarea('present_resident_kor', '', $present_resident_kor, $rows) ?>
												</td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('present_resident_eng'); ?></td>
												<td id="present_resident_eng_edit"><?php echo _l($candidate->present_resident_eng); ?></td>
												<td id="present_resident_eng_save" style="display: none;">
													<?php
													$rows = [];
													$rows['rows'] = 4;
													$present_resident_eng = (isset($candidate) ? $candidate->present_resident_eng : '');
													echo render_textarea('present_resident_eng', '', $present_resident_eng, $rows) ?>
												</td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('email'); ?></td>
												<td id="email_edit"><?php echo _l($candidate->email); ?></td>
												<td id="email_save" style="display: none;"> <?php $email = (isset($candidate) ? $candidate->email : '');
																							echo render_input('email', '', $email); ?></td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="col-md-6 padding-left-right-0">
									<table class="table border table-striped margin-top-0 project_view_table">
										<tbody>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('home_contact_number'); ?></td>
												<td id="home_contact_number_edit"><?php echo _l($candidate->home_contact_number); ?></td>
												<td id="home_contact_number_save" style="display: none;"> <?php $home_contact_number = (isset($candidate) ? $candidate->home_contact_number : '');
																											echo render_input('home_contact_number', '', $home_contact_number); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('phonenumber'); ?></td>
												<td id="phonenumber_edit"><?php echo _l($candidate->phonenumber); ?></td>
												<td id="phonenumber_save" style="display: none;"> <?php $phonenumber = (isset($candidate) ? $candidate->phonenumber : '');
																									echo render_input('phonenumber', '', $phonenumber); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('emergency_contact_number'); ?></td>
												<td id="emergency_contact_number_edit"><?php echo _l($candidate->emergency_contact_number); ?></td>
												<td id="emergency_contact_number_save" style="display: none;"> <?php $emergency_contact_number = (isset($candidate) ? $candidate->emergency_contact_number : '');
																												echo render_input('emergency_contact_number', '', $emergency_contact_number); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold">&nbsp;</td>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</form>

						</div>

						<div role="tabpanel" class="tab-pane" id="education_info">
							<div class="col-md-12">
								<p class="bold other_infor-style pull-left"><?php echo _l('eduaction_info'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addEducationinfoModal"><?php echo _l('Add'); ?></button>
							</div>

							<hr class="other_infor-hr" />

							<?php if (count($candidate->education) > 0) { ?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('year'); ?></th>
										<th><?php echo _l('course_type'); ?></th>
										<th><?php echo _l('course_name'); ?></th>
										<th><?php echo _l('edu_start_date'); ?></th>
										<th><?php echo _l('edu_finish_date'); ?></th>
										<th><?php echo _l('edu_date'); ?></th>
										<th><?php echo _l('valid_date'); ?></th>
										<th><?php echo _l('edu_institution'); ?></th>
										<th><?php echo _l('completed_edu'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->education as $we) { ?>
											<tr class="project-overview">
												<td><?php echo html_entity_decode($we['year']); ?></td>
												<td><?php echo get_select_option_name_by_id('job_course', $we['course_type'], 'course_name'); ?></td>
												<!-- <td><?php //echo html_entity_decode($we['course_type']); 
															?></td> -->
												<td><?php echo html_entity_decode($we['course_name']); ?></td>
												<td><?php echo _d($we['edu_start_date']); ?></td>
												<td><?php echo _d($we['edu_finish_date']); ?></td>
												<td><?php echo _d($we['edu_date']); ?></td>
												<td><?php echo _d($we['valid_date']); ?></td>
												<td><?php echo html_entity_decode($we['edu_institution']); ?></td>
												<td><?php echo html_entity_decode($we['completed_edu']); ?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="education_info_detail_edit" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="education_info_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>

											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?>
						</div>


						<div role="tabpanel" class="tab-pane" id="school_info">
							<div class="col-md-12">
								<p class="bold other_infor-style pull-left"><?php echo _l('school_info'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addSchoolinfoModal"><?php echo _l('Add'); ?></button>
							</div>

							<hr class="other_infor-hr" />

							<?php if (count($candidate->school) > 0) { ?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('enterance_date'); ?></th>
										<th><?php echo _l('graduation_date'); ?></th>
										<th><?php echo _l('university'); ?></th>
										<th><?php echo _l('school_name'); ?></th>
										<th><?php echo _l('faculty'); ?></th>
										<th><?php echo _l('major_name'); ?></th>
										<th><?php echo _l('year_of_graduation'); ?></th>
										<th><?php echo _l('final_academic_career'); ?></th>
										<th><?php echo _l('academic_career_type'); ?></th>
										<th><?php echo _l('remark'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->school as $we) { ?>
											<tr class="project-overview">
												<td><?php echo _d($we['enterance_date']); ?></td>
												<td><?php echo _d($we['graduation_date']); ?></td>
												<td><?php echo  html_entity_decode($we['university']); ?></td>
												<td><?php echo  html_entity_decode($we['school_name']); ?></td>
												<td><?php echo  html_entity_decode($we['faculty']); ?></td>
												<td><?php echo  html_entity_decode($we['major_name']); ?></td>
												<td><?php echo  html_entity_decode($we['year_of_graduation']); ?></td>

												<td><?php echo  html_entity_decode($we['final_academic_career']); ?></td>
												<td><?php echo  html_entity_decode($we['academic_career_type']); ?></td>
												<td><?php echo  html_entity_decode($we['remark']); ?></td>

												<td class="text-center"><a href="Javascript:void(0);" class="school_info_detail_edit" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="school_info_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>

											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?>
						</div>

						<div role="tabpanel" class="tab-pane" id="family_info">
							<div class="col-md-12">
								<p class="bold other_infor-style pull-left"><?php echo _l('family_info'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addFamilyinfoModal"><?php echo _l('Add'); ?></button>
							</div>

							<hr class="other_infor-hr" />

							<?php if (count($candidate->family_info) > 0) { ?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('family_religion'); ?></th>
										<th><?php echo _l('family_name'); ?></th>
										<th><?php echo _l('id_no'); ?></th>
										<th><?php echo _l('birthday'); ?></th>
										<th><?php echo _l('age'); ?></th>
										<th><?php echo _l('final_academy_career'); ?></th>
										<th><?php echo _l('school'); ?></th>
										<th><?php echo _l('major'); ?></th>
										<th><?php echo _l('company'); ?></th>
										<th><?php echo _l('position'); ?></th>
										<th><?php echo _l('grade'); ?></th>
										<th><?php echo _l('basic_deduction'); ?></th>
										<th><?php echo _l('child_bearing'); ?></th>
										<th><?php echo _l('contact_number'); ?></th>
										<th><?php echo _l('contact_number2'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->family_info as $we) { ?>
											<tr class="project-overview">
												<td><?php echo html_entity_decode($we['family_religion']); ?></td>
												<td><?php echo html_entity_decode($we['family_name']); ?></td>
												<td><?php echo html_entity_decode(_l($we['id_no'])); ?></td>
												<td><?php echo _d($we['birthday']); ?></td>
												<td><?php echo html_entity_decode($we['age']); ?></td>
												<td><?php echo html_entity_decode($we['final_academy_career']); ?></td>
												<td><?php echo html_entity_decode(_l($we['school'])); ?></td>
												<td><?php echo html_entity_decode($we['major']); ?></td>
												<td><?php echo html_entity_decode($we['company']); ?></td>
												<td><?php echo html_entity_decode($we['position']); ?></td>
												<td><?php echo html_entity_decode($we['grade']); ?></td>
												<td><?php echo html_entity_decode($we['basic_deduction']); ?></td>
												<td><?php echo html_entity_decode($we['child_bearing']); ?></td>
												<td><?php echo html_entity_decode($we['contact_number']); ?></td>
												<td><?php echo html_entity_decode($we['contact_number2']); ?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="family_info_detail_edit" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="family_info_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?>
						</div>

						<?php if (get_tab_option('recruitment_create_campaign_tab_reward') == 1) { ?>
							<div role="tabpanel" class="tab-pane" id="reward_info">
								<div class="col-md-12">
									<p class="bold other_infor-style pull-left"><?php echo _l('reward_info'); ?></p>
									<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addupdateRewardinfoModal"><?php echo _l('Add'); ?></button>
								</div>

								<hr class="other_infor-hr" />

								<?php if (count($candidate->reward_info) > 0) { ?>
									<table class="table dt-table margin-top-0">
										<thead>
											<th><?php echo _l('app_date'); ?></th>
											<th><?php echo _l('award_punishment'); ?></th>
											<th><?php echo _l('grade_rank'); ?></th>
											<th><?php echo _l('award_punishment_kind'); ?></th>
											<th><?php echo _l('award_punishment_reason'); ?></th>
											<th><?php echo _l('reward_file'); ?></th>
											<th><?php echo _l('rewards_remark'); ?></th>
											<th><?php echo _l('action'); ?></th>
										</thead>
										<tbody>
											<?php foreach ($candidate->reward_info as $we) { ?>
												<tr class="project-overview">
													<td><?php echo _d($we['app_date']); ?></td>
													<td><?php echo html_entity_decode($we['award_punishment']); ?></td>
													<td><?php echo html_entity_decode(_l($we['grade_rank'])); ?></td>
													<td><?php echo html_entity_decode($we['award_punishment_kind']); ?></td>
													<td><?php echo html_entity_decode($we['award_punishment_reason']); ?></td>
													<?php
													$rewardfileDir = module_dir_url('recruitment/uploads/candidate/reward_file/');
													$reward_filename =  $rewardfileDir . $we['reward_file'];
													?>
													<td>
														<a href="<?php echo html_entity_decode($reward_filename); ?>" target="_blank"><?php echo html_entity_decode($we['reward_file']); ?></a>
													</td>
													<td><?php echo html_entity_decode($we['rewards_remark']); ?></td>
													<td class="text-center"><a href="Javascript:void(0);" class="reward_info_detail_edit" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="reward_info_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } else { ?>
									<p><?php echo _l('no_result'); ?></p>
								<?php } ?>
							</div>
						<?php } ?>

						<?php if (get_tab_option('recruitment_create_campaign_tab_medical') == 1) { ?>
							<div role="tabpanel" class="tab-pane" id="medical_info">
								<div class="col-md-12">
									<p class="bold other_infor-style pull-left"><?php echo _l('medical_info'); ?></p>
									<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addMedicalinfoModal"><?php echo _l('Add'); ?></button>
								</div>

								<hr class="other_infor-hr" />

								<?php if (count($candidate->medical_info) > 0) { ?>
									<table class="table dt-table margin-top-0">
										<thead>
											<th><?php echo _l('medical_test_date'); ?></th>
											<th><?php echo _l('valid_test_date'); ?></th>
											<th><?php echo _l('medical_test_division'); ?></th>
											<th><?php echo _l('judgement_y_n'); ?></th>
											<th><?php echo _l('medical_hospital'); ?></th>
											<th><?php echo _l('judgement'); ?></th>
											<th><?php echo _l('final_option'); ?></th>
											<th><?php echo _l('medical_remark'); ?></th>
											<th><?php echo _l('action'); ?></th>
										</thead>
										<tbody>
											<?php foreach ($candidate->medical_info as $we) { ?>
												<tr class="project-overview">
													<td><?php echo _d($we['medical_test_date']); ?></td>
													<td><?php echo _d($we['valid_test_date']); ?></td>
													<td><?php echo html_entity_decode(_l($we['medical_test_division'])); ?></td>
													<td><?php echo html_entity_decode($we['judgement_y_n']); ?></td>
													<td><?php echo html_entity_decode($we['medical_hospital']); ?></td>
													<td><?php echo html_entity_decode($we['judgement']); ?></td>
													<td><?php echo html_entity_decode($we['final_option']); ?></td>
													<td><?php echo html_entity_decode($we['medical_remark']); ?></td>
													<td class="text-center"><a href="Javascript:void(0);" class="edit_medical_info_detail" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="edit_medical_info_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } else { ?>
									<p><?php echo _l('no_result'); ?></p>
								<?php } ?>
							</div>
						<?php } ?>

						<div role="tabpanel" class="tab-pane" id="licence_document_info">
							<div class="col-md-12">
								<p class="bold other_infor-style pull-left"><?php echo _l('licence_info'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addLicenceinfoModal"><?php echo _l('Add'); ?></button>
							</div>
							<hr class="other_infor-hr" />
							<?php if (count($candidate->licence_info) > 0) { ?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('lic_kind_division'); ?></th>
										<th><?php echo _l('lic_licence_no'); ?></th>
										<th><?php echo _l('lic_acquisition_date'); ?></th>
										<th><?php echo _l('lic_exipiry_date'); ?></th>
										<th><?php echo _l('lic_issue_authority'); ?></th>
										<th><?php echo _l('licence_attach_file'); ?></th>
										<th><?php echo _l('licence_remark'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->licence_info as $we) {
											
											
												$expiryDateflag = new DateTime($we['exipiry_date']);
												$oneYearAgoflag = new DateTime('+1 year');
												$expiry_status = $expiryDateflag < $oneYearAgoflag && $we['exipiry_date'] != null ? "color: red;" : '';	
											
											
										?>
											<tr class="project-overview">
												<td style="<?php echo $expiry_status; ?>"><?php echo get_select_option_name_by_id('job_kind', $we['kind_division'], 'kind_name'); ?></td>
												<td style="<?php echo $expiry_status; ?>"><?php echo html_entity_decode($we['licence_no']); ?></td>
												<td style="<?php echo $expiry_status; ?>"><?php echo _d($we['acquisition_date']); ?></td>

												<?php
												if ($we['exipiry_date'] != null) {
													$currentDatelic = new DateTime();
													$oneYearAgolic = new DateTime('+1 year');

													$expiryDatelics = new DateTime($we['exipiry_date']);
													if ($expiryDatelics < $oneYearAgolic) {
														echo '<td><span style="color: red; font-weight: bold;">' . $expiryDatelics->format('Y-m-d') . '</span></td>';
													} else {
														echo '<td>' . $expiryDatelics->format('Y-m-d') . '</td>';
													}
												} else {
													echo '<td></td>';
												}
												?>


												<td  style="<?php echo $expiry_status; ?>"><?php echo html_entity_decode($we['issue_authority']); ?></td>
												<?php
												$licencefileDir = module_dir_url('recruitment/uploads/candidate/licence_file/');
												$licence_filename =  $licencefileDir . $we['attach_file'];
												?>
												<td style="<?php echo $expiry_status; ?>">
													<a href="<?php echo html_entity_decode($licence_filename); ?>" target="_blank"><?php echo html_entity_decode($we['attach_file']); ?></a>
												</td>
												<td style="<?php echo $expiry_status; ?>"><?php echo html_entity_decode($we['remark']); ?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="edit_licence_info_detail" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="licence_info_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>

							<div class="col-md-12">
								<p class="bold other_infor-style pull-left"><?php echo _l('document_info'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addDocumentinfoModal"><?php echo _l('Add'); ?></button>
							</div>
							<hr class="other_infor-hr" />
							<?php if (count($candidate->document_info) > 0) { ?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('doc_kind_division'); ?></th>
										<th><?php echo _l('doc_licence_no'); ?></th>
										<th><?php echo _l('doc_issue_date'); ?></th>
										<th><?php echo _l('doc_exipiry_date'); ?></th>
										<th><?php echo _l('doc_issue_authority'); ?></th>
										<th><?php echo _l('doc_attach_file'); ?></th>
										<th><?php echo _l('doc_remark'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->document_info as $wea) {
											$expiryDateflag = new DateTime($wea['exipiry_date']);
											$oneYearAgoflag = new DateTime('+1 year');
											$expiry_status = $expiryDateflag < $oneYearAgoflag && $we['exipiry_date'] != null ? "color: red;" : '';
										?>
											<tr class="project-overview">
												<td style="<?php echo $expiry_status; ?>"><?php echo get_select_option_name_by_id('job_kind_document', $wea['kind_division'], 'kind_document_name'); ?></td>
												<td style="<?php echo $expiry_status; ?>"><?php echo html_entity_decode($wea['licence_no']); ?></td>
												<td style="<?php echo $expiry_status; ?>"><?php echo _d($wea['issue_date']); ?></td>
												<?php
												if ($wea['exipiry_date'] != null) {
													$currentDatelic = new DateTime();
													$oneYearAgolic = new DateTime('+1 year');

													$expiryDatedoc = new DateTime($wea['exipiry_date']);
													if ($expiryDatedoc < $oneYearAgolic) {
														echo '<td><span style="color: red; font-weight: bold;">' . $expiryDatedoc->format('Y-m-d') . '</span></td>';
													} else {
														echo '<td>' . $expiryDatedoc->format('Y-m-d') . '</td>';
													}
												} else {
													echo '<td></td>';
												}

												?>
												<td style="<?php echo $expiry_status; ?>"><?php echo _d($wea['issue']); ?></td>
												<?php
												$documentfileDir = module_dir_url('recruitment/uploads/candidate/document_file/');
												$document_filename =  $documentfileDir . $wea['attach_file'];
												?>
												<td style="<?php echo $expiry_status; ?>">
													<a href="<?php echo html_entity_decode($document_filename); ?>" target="_blank"><?php echo html_entity_decode($wea['attach_file']); ?></a>
												</td>
												<td style="<?php echo $expiry_status; ?>"><?php echo html_entity_decode($wea['remark']); ?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="edit_document_info_detail" data-id="<?php echo $wea['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="document_info_detail_delete" data-id="<?php echo $wea['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>

							<!-- start flag -->

							<div class="col-md-12">
								<p class="bold other_infor-style pull-left"><?php echo _l('flag_info'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addflaginfoModal"><?php echo _l('Add'); ?></button>
							</div>
							<hr class="other_infor-hr" />
							<?php if (count($candidate->flag_info) > 0) { ?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('doc_kind_division'); ?></th>
										<th><?php echo _l('doc_licence_no'); ?></th>
										<th><?php echo _l('doc_issue_date'); ?></th>
										<th><?php echo _l('doc_exipiry_date'); ?></th>
										<th><?php echo _l('doc_issue_authority'); ?></th>
										<th><?php echo _l('doc_attach_file'); ?></th>
										<th><?php echo _l('doc_remark'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->flag_info as $we) {

											$expiryDateflag = new DateTime($we['exipiry_date']);
											$oneYearAgoflag = new DateTime('+1 year');
											$expiry_status = $expiryDateflag < $oneYearAgoflag && $we['exipiry_date'] != null ? "color: red;" : '';
										?>
											<tr class="project-overview">
												<td style="<?php echo $expiry_status; ?>"><?php echo get_select_option_name_by_id('job_kind_flag', $we['kind_division'], 'kind_flag_name'); ?></td>
												<td style="<?php echo $expiry_status; ?>"><?php echo html_entity_decode($we['licence_no']); ?></td>
												<td style="<?php echo $expiry_status; ?>"><?php echo _d($we['issue_date']); ?></td>
												<?php
												if ($we['exipiry_date']) {
													$currentDateflag = new DateTime();
													$oneYearAgoflag = new DateTime('+1 year');

													$expiryDateflag = new DateTime($we['exipiry_date']);

													if ($expiryDateflag < $oneYearAgoflag) {
														echo '<td><span style="color: red; font-weight: bold;">' . $expiryDateflag->format('Y-m-d') . '</span></td>';
													} else {
														echo '<td>' . $expiryDateflag->format('Y-m-d') . '</td>';
													}
												} else {
													echo '<td></td>';
												}

												?>
												<td style="<?php echo $expiry_status; ?>"><?php echo _d($we['issue']); ?></td>
												<?php
												$flagfileDir = module_dir_url('recruitment/uploads/candidate/flag_file/');
												$flag_filename =  $flagfileDir . $we['attach_file'];
												?>
												<td style="<?php echo $expiry_status; ?>">
													<a href="<?php echo html_entity_decode($flag_filename); ?>" target="_blank"><?php echo html_entity_decode($we['attach_file']); ?></a>
												</td>
												<td style="<?php echo $expiry_status; ?>"><?php echo html_entity_decode($we['remark']); ?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="edit_flag_info_detail" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="flag_info_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?>

						</div> <br>

						<!-- End flag -->

						<?php if (get_tab_option('recruitment_create_campaign_tab_psc') == 1) { ?>
							<div role="tabpanel" class="tab-pane" id="psc_info">
								<div class="col-md-12">
									<p class="bold other_infor-style pull-left"><?php echo _l('psc_info'); ?></p>
									<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addPscinfoModal"><?php echo _l('Add'); ?></button>
								</div>

								<hr class="other_infor-hr" />

								<?php if (count($candidate->psc_info) > 0) { ?>
									<table class="table dt-table margin-top-0">
										<thead>
											<th><?php echo _l('psc_date'); ?></th>
											<th><?php echo _l('vessel'); ?></th>
											<th><?php echo _l('inspection'); ?></th>
											<th><?php echo _l('mou'); ?></th>
											<th><?php echo _l('country'); ?></th>
											<th><?php echo _l('port'); ?></th>
											<th><?php echo _l('result'); ?></th>
											<th><?php echo _l('deficiency'); ?></th>
											<th><?php echo _l('action'); ?></th>
										</thead>
										<tbody>
											<?php foreach ($candidate->psc_info as $we) { ?>
												<tr class="project-overview">
													<td><?php echo _d($we['date']); ?></td>
													<td><?php echo html_entity_decode($we['vessel']); ?></td>
													<td><?php echo  html_entity_decode($we['inspection']); ?></td>
													<td><?php echo  html_entity_decode($we['mou']); ?></td>
													<td><?php echo  html_entity_decode($we['country']); ?></td>
													<td><?php echo  html_entity_decode($we['port']); ?></td>
													<td><?php echo  html_entity_decode($we['result']); ?></td>
													<td><?php echo  html_entity_decode($we['deficiency']); ?></td>

													<td class="text-center"><a href="Javascript:void(0);" class="psc_info_detail_edit" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="psc_info_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>

												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } else { ?>
									<p><?php echo _l('no_result'); ?></p>
								<?php } ?>
							</div>
						<?php } ?>
						<div role="tabpanel" class="tab-pane" id="promotion_info">
							<div class="col-md-12">
								<p class="bold other_infor-style pull-left"><?php echo _l('promotion_info'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addPromotioninfoModal"><?php echo _l('Add'); ?></button>
							</div>

							<hr class="other_infor-hr" />

							<?php if (count($candidate->promotion_info) > 0) { ?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('promotion_app_date'); ?></th>
										<th><?php echo _l('final_grade'); ?></th>
										<th><?php echo _l('promotion_grade'); ?></th>
										<th><?php echo _l('final_depart'); ?></th>
										<th><?php echo _l('length_of_stay'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->promotion_info as $we) { ?>
											<tr class="project-overview">
												<td><?php echo _d($we['app_date']); ?></td>
												<td><?php echo html_entity_decode($we['final_grade']); ?></td>
												<td><?php echo html_entity_decode($we['promotion_grade']); ?></td>
												<td><?php echo html_entity_decode($we['final_depart']); ?></td>
												<td><?php echo html_entity_decode($we['length_of_stay']); ?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="edit_promotion_info_detail" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="promotion_info_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?>


						</div> <br>




						<div role="tabpanel" class="tab-pane active" id="detail">

							<p class="bold margin-top-15 general-infor-color"><?php echo _l('general_infor'); ?></p>
							<hr class="margin-top-10 general-infor-hr" />

							<div class="col-md-2 padding-left-right-0 margin-top-15">
								<div class="picture-container margin-top-10 pull-left">
									<div class="picture pull-left">
										<img class="width-height-160" src="<?php if (isset($candidate->avar)) {
																				echo site_url(RECRUITMENT_PATH . 'candidate/avartar/' . $candidate->id . '/' . $candidate->avar->file_name);
																			} else {
																				echo site_url(RECRUITMENT_PATH . 'none_avatar.jpg');
																			} ?>" class="picture-src" id="wizardPicturePreview" title="">

									</div>
								</div>
							</div>
							<div class="col-md-5 padding-left-right-0">
								<table class="table border table-striped margin-top-0 project_view_table">
									<tbody>
										<tr class="project-overview">
											<td class="bold" width="30%"><?php echo _l('full_name'); ?></td>
											<td><?php echo html_entity_decode($candidate->candidate_name . ' ' . $candidate->last_name); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('gender'); ?></td>
											<td><?php echo _l($candidate->gender); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('nation'); ?></td>
											<td><?php echo html_entity_decode($candidate->nation); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('marital_status'); ?></td>
											<td><?php echo _l($candidate->marital_status); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('height'); ?></td>
											<td><?php echo html_entity_decode($candidate->height); ?></td>
										</tr>


										<tr class="project-overview">
											<td class="bold"><?php echo _l('graduated'); ?></td>
											<td><?php echo _l($candidate->graduated); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('academy_type'); ?></td>
											<td><?php echo html_entity_decode($candidate->academy_type); ?></td>
										</tr>

									</tbody>
								</table>
							</div>
							<div class="col-md-5 padding-left-right-0">
								<table class="table border table-striped margin-top-0 project_view_table">
									<tbody>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('candidate_code'); ?></td>
											<td><?php echo html_entity_decode($candidate->candidate_code); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold" width="30%"><?php echo _l('rank_name'); ?></td>
											<?php $camption_name = get_camption_name($candidate->rank); ?>
											<td><?php echo isset($camption_name->rank_name) ? $camption_name->rank_name : '' ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold" width="30%"><?php echo _l('birthday'); ?></td>
											<td><?php echo _d($candidate->birthday); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('nationality'); ?></td>
											<td><?php echo html_entity_decode($candidate->nationality); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('religion'); ?></td>
											<td><?php echo html_entity_decode($candidate->religion); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('weight'); ?></td>
											<td><?php echo html_entity_decode($candidate->weight); ?></td>
										</tr>
										<tr class="project-overview">
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</div>

							<p class="bold other_infor-style"><?php echo _l('other_infor'); ?></p>
							<hr class="other_infor-hr" />

							<div class="col-md-6 padding-left-right-0">
								<table class="table border table-striped margin-top-0 project_view_table">
									<tbody>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('submission_date'); ?></td>
											<td><?php echo _d($candidate->date_add); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('identification'); ?></td>
											<td><?php echo html_entity_decode($candidate->identification); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('birthplace'); ?></td>
											<td><?php echo _l($candidate->birthplace); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('resident'); ?></td>
											<td><?php echo html_entity_decode($candidate->resident); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('phonenumber'); ?></td>
											<td><?php echo html_entity_decode($candidate->phonenumber); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('skype'); ?></td>
											<td><a href="<?php echo html_entity_decode($candidate->skype); ?>"><?php echo html_entity_decode($candidate->skype); ?></a></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('skill_name'); ?></td>
											<td><?php echo html_entity_decode($skill_name); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('introduce_yourself'); ?></td>
											<td><?php echo html_entity_decode($candidate->introduce_yourself); ?></td>
										</tr>


										<tr class="project-overview">
											<td class="bold"><?php echo _l('employertype'); ?></td>
											<td><?php echo html_entity_decode($candidate->employertype); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('hired_date'); ?></td>
											<td><?php echo _d($candidate->hired_date); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('promotion'); ?></td>
											<td><?php echo _d($candidate->promotion); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('retired'); ?></td>
											<td><?php echo html_entity_decode($candidate->retired); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('hired_type'); ?></td>
											<td><?php echo html_entity_decode($candidate->hired_type); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('department_date'); ?></td>
											<td><?php echo _d($candidate->department_date); ?></td>
										</tr>

									</tbody>
								</table>
							</div>

							<div class="col-md-6 padding-left-right-0">
								<table class="table border table-striped margin-top-0 project_view_table">
									<tbody>
										<tr class="project-overview">
											<td class="bold" width="30%"><?php echo _l('status'); ?></td>
											<td><?php echo get_status_candidate($candidate->status); ?></td>
											<!-- <td><?php //echo get_select_option_name_by_id('job_status', $candidate->status_type, 'status_name'); 
														?></td> -->
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('desired_salary'); ?></td>
											<td><?php echo app_format_money($candidate->desired_salary, $current_id); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('days_for_identity'); ?></td>
											<td><?php echo _d($candidate->days_for_identity); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('home_town'); ?></td>
											<td><?php echo html_entity_decode($candidate->home_town); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('current_accommodation'); ?></td>
											<td><?php echo html_entity_decode($candidate->current_accommodation); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('email'); ?></td>
											<td><a href="mailto:<?php echo html_entity_decode($candidate->email); ?>"><?php echo html_entity_decode($candidate->email); ?></a></td>

										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('facebook'); ?></td>
											<td><a href="<?php echo html_entity_decode($candidate->facebook); ?>"><?php echo html_entity_decode($candidate->facebook); ?></a></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('linkedin'); ?></td>
											<td><a href="<?php echo html_entity_decode($candidate->linkedin); ?>"><?php echo html_entity_decode($candidate->linkedin); ?></a></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('interests'); ?></td>
											<td><?php echo html_entity_decode($candidate->interests); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('regristration'); ?></td>
											<td><?php echo html_entity_decode($candidate->regristration); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('department'); ?></td>
											<td><?php echo get_select_option_name_by_id('job_department', $candidate->department, 'department_name'); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('emergency'); ?></td>
											<td><?php echo html_entity_decode($candidate->emergency); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('employer'); ?></td>
											<td><?php echo html_entity_decode($candidate->employer); ?></td>
										</tr>





										<!-- <tr class="project-overview">
											<td> &nbsp;</td>
											<td></td>
										</tr> -->
									</tbody>
								</table>
							</div>

							<div class="row col-md-12">
								<p class="bold other_infor-style"><?php echo _l('work_experience'); ?></p>
								<hr class="other_infor-hr" />

								<?php if (count($candidate->work_experience) > 0) { ?>
									<table class="table dt-table margin-top-0">
										<thead>
											<th><?php echo _l('from_date'); ?></th>
											<th><?php echo _l('to_date'); ?></th>
											<th><?php echo _l('company'); ?></th>
											<th><?php echo _l('position'); ?></th>
											<th><?php echo _l('contact_person'); ?></th>
											<th><?php echo _l('salary'); ?></th>
											<th><?php echo _l('reason_quitwork'); ?></th>
											<th><?php echo _l('job_description'); ?></th>
										</thead>
										<tbody>
											<?php foreach ($candidate->work_experience as $we) { ?>
												<tr class="project-overview">
													<td><?php echo _d($we['from_date']); ?></td>
													<td><?php echo _d($we['to_date']); ?></td>
													<td><?php echo html_entity_decode($we['company']); ?></td>
													<td><?php echo html_entity_decode($we['position']); ?></td>
													<td><?php echo html_entity_decode($we['contact_person']); ?></td>
													<td><?php echo html_entity_decode(app_format_money($we['salary'], $current_id)); ?></td>
													<td><?php echo html_entity_decode($we['reason_quitwork']); ?></td>
													<td><?php echo html_entity_decode($we['job_description']); ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } else { ?>
									<p><?php echo _l('no_result'); ?></p>
								<?php } ?>



								<p class="bold other_infor-style"><?php echo _l('literacy'); ?></p>
								<hr class="other_infor-hr" />
								<?php if (count($candidate->literacy) > 0) { ?>
									<table class="table dt-table margin-top-0">
										<thead>
											<th><?php echo _l('from_date'); ?></th>
											<th><?php echo _l('to_date'); ?></th>
											<th><?php echo _l('diploma'); ?></th>
											<th><?php echo _l('training_places'); ?></th>
											<th><?php echo _l('specialized'); ?></th>
											<th><?php echo _l('training_form'); ?></th>

										</thead>
										<tbody>
											<?php foreach ($candidate->literacy as $we) { ?>
												<tr class="project-overview">
													<td><?php echo _d($we['literacy_from_date']); ?></td>
													<td><?php echo _d($we['literacy_to_date']); ?></td>
													<td><?php echo html_entity_decode(_l($we['diploma'])); ?></td>
													<td><?php echo html_entity_decode($we['training_places']); ?></td>
													<td><?php echo html_entity_decode($we['specialized']); ?></td>
													<td><?php echo html_entity_decode($we['training_form']); ?></td>

												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } else { ?>
									<p><?php echo _l('no_result'); ?></p>
								<?php } ?>
								<p class="bold other_infor-style"><?php echo _l('family_infor'); ?></p>
								<hr class="other_infor-hr" />
								<?php if (count($candidate->family_infor) > 0) { ?>
									<table class="table dt-table margin-top-0">
										<thead>
											<th><?php echo _l('relationship'); ?></th>
											<th><?php echo _l('name'); ?></th>
											<th><?php echo _l('birthday'); ?></th>
											<th><?php echo _l('job'); ?></th>
											<th><?php echo _l('address'); ?></th>
											<th><?php echo _l('phone'); ?></th>

										</thead>
										<tbody>
											<?php foreach ($candidate->family_infor as $we) { ?>
												<tr class="project-overview">
													<td><?php echo html_entity_decode($we['relationship']); ?></td>
													<td><?php echo html_entity_decode($we['name']); ?></td>
													<td><?php echo _d($we['fi_birthday']); ?></td>
													<td><?php echo html_entity_decode($we['job']); ?></td>
													<td><?php echo html_entity_decode($we['address']); ?></td>
													<td><?php echo html_entity_decode($we['phone']); ?></td>

												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } else { ?>
									<p><?php echo _l('no_result'); ?></p>
								<?php } ?>
							</div>

						</div>

						<div role="tabpanel" class="tab-pane" id="history_recruitment">
							<p class="bold other_infor-style"><?php echo _l('campaign_has_joined'); ?></p>
							<hr class="other_infor-hr" />
							<?php if ($candidate->rec_campaign > 0) {
							?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('campaign'); ?></th>
										<th><?php echo _l('status'); ?></th>
										<th><?php echo _l('submission_date'); ?></th>
										<th><?php echo _l('desired_salary'); ?></th>
									</thead>
									<tbody>

										<tr class="project-overview">
											<td><?php
												$cp = get_rec_campaign_hp($candidate->rec_campaign);
												$datas = '';
												if (isset($cp)) {
													$datas = '<a href="' . admin_url('recruitment/recruitment_campaign/' . $cp->cp_id) . '">' . $cp->campaign_code . ' - ' . $cp->campaign_name . '</a>';
												}
												echo html_entity_decode($datas);
												?></td>
											<td><?php echo get_status_candidate($candidate->status); ?></td>
											<td><?php echo _d($candidate->date_add); ?></td>
											<td><?php echo app_format_money($candidate->desired_salary, $current_id); ?></td>
										</tr>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?>

							<p class="bold other_infor-style"><?php echo _l('interview_schedule'); ?></p>
							<hr class="other_infor-hr" />
							<table class="table dt-table margin-top-0">
								<thead>
									<th><?php echo _l('add_from'); ?></th>
									<th><?php echo _l('interview_schedules_name'); ?></th>
									<th><?php echo _l('rec_time'); ?></th>
									<th><?php echo _l('interview_day'); ?></th>
									<th><?php echo _l('recruitment_campaign'); ?></th>
									<th><?php echo _l('interviewer'); ?></th>
									<th><?php echo _l('date_add'); ?></th>
								</thead>
								<tbody>
									<?php foreach ($list_interview as $li) {
									?>
										<tr>
											<td>
												<?php
												$_data = '<a href="' . admin_url('staff/profile/' . $li['added_from']) . '">' . staff_profile_image($li['added_from'], [
													'staff-profile-image-small',
												]) . '</a>';
												$_data .= ' <a href="' . admin_url('staff/profile/' . $li['added_from']) . '">' . get_staff_full_name($li['added_from']) . '</a>';
												echo html_entity_decode($_data);
												?>
											</td>
											<td><?php echo html_entity_decode($li['is_name']) ?></td>
											<td><?php echo html_entity_decode($li['from_time'] . ' - ' . $li['to_time']); ?></td>
											<td><?php echo _d($li['interview_day']); ?></td>
											<td><?php
												$cp = get_rec_campaign_hp($li['campaign']);
												if ($li['campaign'] != '' && $li['campaign'] != 0) {
													if (isset($cp)) {
														$_data = $cp->campaign_code . ' - ' . $cp->campaign_name;
													} else {
														$_data = '';
													}
												} else {
													$_data = '';
												}

												echo html_entity_decode($_data);
												?>

											</td>
											<td>
												<?php
												$inv = explode(',', $li['interviewer']);
												$ata = '';
												foreach ($inv as $iv) {
													$ata .= '<a href="' . admin_url('staff/profile/' . $iv) . '">' . staff_profile_image($iv, [
														'staff-profile-image-small mright5',
													], 'small', [
														'data-toggle' => 'tooltip',
														'data-title' => get_staff_full_name($iv),
													]) . '</a>';
												}
												echo html_entity_decode($ata);
												?>
											</td>
											<td><?php echo _d($li['added_date']); ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>

							<p class="bold other_infor-style"><?php echo _l('care_history'); ?></p>
							<hr class="other_infor-hr" />
							<?php if ($candidate->care > 0) {
							?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('type'); ?></th>
										<th><?php echo _l('caregiver'); ?></th>
										<th><?php echo _l('rec_time'); ?></th>
										<th><?php echo _l('result'); ?></th>
										<th><?php echo _l('description'); ?></th>
									</thead>
									<tbody>

										<?php foreach ($candidate->care as $care) {
										?>
											<tr class="project-overview">
												<td><?php echo _l($care['type']); ?></td>
												<td>
													<?php
													$_data = '<a href="' . admin_url('staff/profile/' . $care['add_from']) . '">' . staff_profile_image($care['add_from'], [
														'staff-profile-image-small',
													]) . '</a>';
													$_data .= ' <a href="' . admin_url('staff/profile/' . $care['add_from']) . '">' . get_staff_full_name($care['add_from']) . '</a>';
													echo html_entity_decode($_data);
													?>
												</td>
												<td><?php echo _d($care['care_time']); ?></td>
												<td><?php echo html_entity_decode($care['care_result']); ?></td>
												<td><?php echo html_entity_decode($care['description']); ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?>

						</div>

						<div role="tabpanel" class="tab-pane" id="capacity_profile">

							<div class="row col-md-12">
								<p class="bold other_infor-style"><?php echo _l('candidate_evaluation'); ?></p>
								<hr class="other_infor-hr" />
							</div>

							<div class="col-md-6">
								<?php if (count($cd_evaluation) > 0) {
								?>
									<table class="table border table-striped margin-top-0">
										<tbody>
											<tr class="project-overview">
												<td class="bold" width="30%"><?php echo _l('assessor'); ?></td>
												<td><?php
													$_data = '<a href="' . admin_url('staff/profile/' . $assessor) . '">' . staff_profile_image($assessor, [
														'staff-profile-image-small',
													]) . '</a>';
													$_data .= ' <a href="' . admin_url('staff/profile/' . $assessor) . '">' . get_staff_full_name($assessor) . '</a>';
													echo html_entity_decode($_data);
													?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('evaluation_date'); ?></td>
												<td><?php echo _d($evaluation_date); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('avg_score'); ?></td>
												<td><?php echo html_entity_decode($avg_score); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('feedback'); ?></td>
												<td><?php echo html_entity_decode($feedback); ?></td>
											</tr>

										</tbody>
									</table>
								<?php } else { ?>
									<p class="bold text-danger"><?php echo _l('none_evaluation_for_cd'); ?></p>
								<?php } ?>
							</div>
							<div class="col-md-6">

							</div>
							<div class="row col-md-12">
								<p class="bold other_infor-style"><?php echo _l('result'); ?></p>
								<hr class="other_infor-hr" />
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('criteria_name'); ?></th>
										<th><?php echo _l('proportion'); ?></th>
										<th><?php echo _l('rec_score'); ?></th>
										<th><?php echo _l('result'); ?></th>

									</thead>
									<tbody>
										<?php if (count($data_group) > 0) {
											$count_gr = 1;
											foreach ($data_group as $key => $gr) {
										?>
												<tr>
													<td class="bold text-danger"><?php echo html_entity_decode($count_gr . '. ' . get_criteria_name($key)); ?></td>
													<td class="bold text-danger"><?php echo html_entity_decode($gr['toltal_percent'] . '%'); ?></td>
													<td class="bold text-danger"></td>
													<td class="bold text-danger"><?php echo html_entity_decode($gr['result']); ?></td>
												</tr>
												<?php $count_cr = 1;
												foreach ($cd_evaluation as $cd) {
													if ($cd['group_criteria'] == $key) {
												?>
														<tr>
															<td><?php echo html_entity_decode($count_gr . '.' . $count_cr . '. ' . get_criteria_name($cd['criteria'])); ?></td>
															<td><?php echo html_entity_decode($cd['percent'] . '%'); ?></td>
															<td>
																<?php
																$sp1 = '';
																$sp2 = '';
																$sp3 = '';
																$sp4 = '';
																$sp5 = '';
																if ($cd['rate_score'] == 1) {
																	$sp1 = ' checked';
																	$sp2 = '-o';
																	$sp3 = '-o';
																	$sp4 = '-o';
																	$sp5 = '-o';
																} elseif ($cd['rate_score'] == 2) {
																	$sp1 = ' checked';
																	$sp2 = ' checked';
																	$sp3 = '-o';
																	$sp4 = '-o';
																	$sp5 = '-o';
																} elseif ($cd['rate_score'] == 3) {
																	$sp1 = ' checked';
																	$sp2 = ' checked';
																	$sp3 = ' checked';
																	$sp4 = '-o';
																	$sp5 = '-o';
																} elseif ($cd['rate_score'] == 4) {
																	$sp1 = ' checked';
																	$sp2 = ' checked';
																	$sp3 = ' checked';
																	$sp4 = ' checked';
																	$sp5 = '-o';
																} elseif ($cd['rate_score'] == 5) {
																	$sp1 = ' checked';
																	$sp2 = ' checked';
																	$sp3 = ' checked';
																	$sp4 = ' checked';
																	$sp5 = ' checked';
																}
																?>
																<span class="fa fa-star<?php echo html_entity_decode($sp1); ?>"></span>
																<span class="fa fa-star<?php echo html_entity_decode($sp2); ?>"></span>
																<span class="fa fa-star<?php echo html_entity_decode($sp3); ?>"></span>
																<span class="fa fa-star<?php echo html_entity_decode($sp4); ?>"></span>
																<span class="fa fa-star<?php echo html_entity_decode($sp5); ?>"></span>
															</td>
															<td><?php echo html_entity_decode(($cd['rate_score'] * $cd['percent']) / 100); ?></td>
														</tr>
												<?php $count_cr++;
													}
												} ?>
										<?php $count_gr++;
											}
										} ?>
									</tbody>
								</table>
							</div>
						</div>

						<div role="tabpanel" class="tab-pane" id="attachment">
							<div id="candidate_pv_file">
								<br>
								<?php
								$file_html = '';
								if (count($candidate->file) > 0) {

									foreach ($candidate->file as $f) {
										$href_url = site_url(RECRUITMENT_PATH . 'candidate/files/' . $f['rel_id'] . '/' . $f['file_name']) . '" download';
										if (!empty($f['external'])) {
											$href_url = $f['external_link'];
										}
										$file_html .= '<div class="mbot15 row inline-block full-width" data-attachment-id="' . $f['id'] . '">
					              <div class="col-md-8">
					                 <a name="preview-ase-btn" onclick="preview_candidate_btn(this); return false;" rel_id = "' . $f['rel_id'] . '" id = "' . $f['id'] . '" href="Javascript:void(0);" class="mbot10 btn btn-success pull-left margin-right-5" data-toggle="tooltip" title data-original-title="' . _l('preview_file') . '"><i class="fa fa-eye"></i></a>
					                 <div class="pull-left"><i class="' . get_mime_class($f['filetype']) . '"></i></div>
					                 <a href=" ' . $href_url . '" target="_blank" download>' . $f['file_name'] . '</a>
					                 <br />
					                 <small class="text-muted">' . $f['filetype'] . '</small>
					              </div>
					              <div class="col-md-4 text-right">';
										if ($f['staffid'] == get_staff_user_id() || is_admin()) {
											$file_html .= '<a href="#" class="text-danger" onclick="delete_candidate_attachment(' . $f['id'] . '); return false;"><i class="fa fa-times"></i></a>';
										}
										$file_html .= '</div></div>';
									}
									$file_html .= '<hr />';
									echo html_entity_decode($file_html);
								}
								?>
							</div>
							<div id="candidate_file_data"></div>
						</div>


						<!-- On-board START----------------------------------->

						<div role="tabpanel" class="tab-pane" id="on_board">

							<div class="col-md-12">
								<p class="bold other_infor-style pull-left"><?php echo _l('on_board_company'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addOnBoardCompanyModal"><?php echo _l('Add'); ?></button>

								<div class="col-md-2 pull-right">
									<select name="on_board_filter[]" id="on_board_filter" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_on_board'); ?>">
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
								</div>

								<div class="col-md-2 pull-right">
									<select name="rank_filter[]" id="rank_filter" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_rank'); ?>">
										<?php foreach ($rank_list as $rank) { ?>
											<option value="<?php echo $rank['id']; ?>"><?php echo $rank['rank_name']; ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="col-md-2 pull-right">
									<select name="vessel_filter_board[]" id="vessel_filter_board" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_vessel'); ?>">
										<?php foreach ($vessel_list as $vessel) { ?>
											<option value="<?php echo $vessel['id']; ?>"><?php echo $vessel['vessel_name']; ?></option>
										<?php } ?>
									</select>
								</div>


								<div class="col-md-2 pull-right">
									<p class="bold general-infor-color pull-left"><?php echo _l('total_boarding_period'); ?> : <span class="board_total_boarding_days"></span></p>
								</div>
							</div>
							<hr class="other_infor-hr" />
							<br>
							<?php if (count($candidate->on_board_company) > 0) { ?>
								<table id="vessel_table_board" class="table dt-table" data-order-col="8" data-order-type="desc">
									<thead>
										<tr>
											<th><?php echo _l('no'); ?></th>
											<th><?php echo _l('vessel_name'); ?></th>
											<th><?php echo _l('grade_rank'); ?></th>
											<th><?php echo _l('rank_name'); ?></th>
											<th><?php echo _l('vessel_type'); ?></th>
											<th><?php echo _l('gross_ton'); ?></th>
											<th><?php echo _l('engine_type'); ?></th>
											<th><?php echo _l('eng_output'); ?></th>
											<th><?php echo _l('embarkation_date'); ?></th>
											<th><?php echo _l('disembarkation_date'); ?></th>
											<th><?php echo _l('cur_onboard'); ?></th>
											<th><?php echo _l('boarding_period'); ?></th>
											<th><?php echo _l('boarding_periods'); ?></th>
											<!-- <th><?php //echo _l('boarding_month'); 
														?></th> -->
											<!-- <th><?php //echo _l('ramaining_days'); 
														?></th> -->
											<!-- <th><?php //echo _l('calculation_y_n'); 
														?></th> -->
											<th><?php echo _l('emp_no'); ?></th>
											<th><?php echo _l('employment'); ?></th>
											<th><?php echo _l('ship_owner'); ?></th>
											<th><?php echo _l('employer'); ?></th>
											<th><?php echo _l('action'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;

										foreach ($candidate->on_board_company as $we) { ?>
											<tr class="project-overview">
												<td><?php echo $no++; ?></td>
												<td><?php echo html_entity_decode($we['vessel_name']); ?></td>
												<td><?php echo html_entity_decode($we['grade_rank']); ?></td>
												<td><?php echo get_select_option_name_by_id('job_rank', $we['rank'], 'rank_name'); ?></td>
												<td><?php echo get_select_option_name_by_id('job_vessel', $we['vessel_type'], 'vessel_name'); ?></td>
												<td><?php echo html_entity_decode($we['gross_ton']); ?></td>
												<td><?php echo html_entity_decode($we['engine_type']); ?></td>
												<td><?php echo html_entity_decode($we['eng_output']); ?></td>
												<td style="<?php echo check_date_included_in_other($we['id'], $we['candidate'], $we['embarkation_date'], 'rec_on_board_company'); ?>"><?php echo _d($we['embarkation_date']); ?></td>

												<td><?php
													if ($we['cur_onboard'] == '1') {
														echo '';
													} else {
														echo _d($we['disembarkation_date']);
													} ?>
												</td>
												<td><?php
													if ($we['cur_onboard'] == '1') {
														echo "Yes";
													} elseif ($we['cur_onboard'] == 0) {
														echo "No";
													}
													?></td>
												<?php
												$boarding_period = html_entity_decode($we['boarding_period']);
												$embarkation_date = html_entity_decode($we['embarkation_date']);
												$disembarkation_date = html_entity_decode($we['disembarkation_date']);
												if (preg_match('/^(\d+Y )?(\d+M )?(\d+D)$/', $boarding_period, $matches)) { ?>
													<td><?php echo calculateBoardingPeriod($embarkation_date, $disembarkation_date); ?></td>
												<?php  } else {
													preg_match('/(\d+)/', $boarding_period, $matches);
													if (isset($matches[1])) {
														$days = (int)$matches[1];
														// Convert days to years, months, and days
														$years = floor($days / 365);
														$remaining_days = $days % 365;
														$months = floor($remaining_days / 30);
														$days = $remaining_days % 30;
														// Format the result
														$result = sprintf("%dY %dM %dD", $years, $months, $days);
													}
												?>
													<td><?php echo isset($result) ? $result : '';  ?></td>
												<?php } ?>
												<?php
												$total_days = calculateBoardingPeriodDays($embarkation_date, $disembarkation_date);
												?>
												<td><?php echo $total_days; ?></td>
												<!-- <td>
													<?php
													//$days_in_month = 30;
													//$boarding_period_number = (int)$boarding_period;
													//$days_fraction = $boarding_period_number / $days_in_month;
													//echo number_format($days_fraction,1); 
													?>
												</td> -->

												<!-- <td><?php //echo html_entity_decode($we['ramaining_days']); 
															?></td>
												<td><?php //echo html_entity_decode($we['calculation_y_n']); 
													?></td> -->
												<td><?php echo html_entity_decode($we['emp_no']); ?></td>
												<td><?php echo html_entity_decode($we['employment']); ?></td>
												<td><?php echo html_entity_decode($we['ship_owner']); ?></td>
												<td><?php echo html_entity_decode($we['employer']); ?></td>
												<td class="text-center">
													<a href="Javascript:void(0);" class="edit_on_board_company_detail" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>
													<a href="Javascript:void(0);" class="on_board_company_detail_delete " data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?>

							<div class="col-md-12">
								<p class="bold other_infor-style pull-left"><?php echo _l('on_board_other_company'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addOnBoardOtherCompanyModal"><?php echo _l('Add'); ?></button>

								<div class="col-md-2 pull-right">
									<select name="on_other_filter[]" id="on_other_filter" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_on_board'); ?>">
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
								</div>

								<div class="col-md-2 pull-right">
									<select name="rank_filter_other[]" id="rank_filter_other" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_rank'); ?>">
										<?php foreach ($rank_list as $rank) { ?>
											<option value="<?php echo $rank['id']; ?>"><?php echo $rank['rank_name']; ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="col-md-2 pull-right">
									<select name="vessel_filter_other[]" id="vessel_filter_other" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_vessel'); ?>">
										<?php foreach ($vessel_list as $vessel) { ?>
											<option value="<?php echo $vessel['id']; ?>"><?php echo $vessel['vessel_name']; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-2 pull-right">
									<p class="bold general-infor-color pull-left"><?php echo _l('total_boarding_period'); ?> : <span class="other_total_boarding_days"></span></p>
								</div>
							</div>
							<hr class="other_infor-hr" />
							<?php if (count($candidate->on_board_other_company) > 0) { ?>
								<table id="vessel_table_other" class="table dt-table margin-top-0" data-order-col="9" data-order-type="desc">
									<thead>
										<th><?php echo _l('no'); ?></th>
										<th><?php echo _l('rank_name'); ?></th>
										<th><?php echo _l('company_name'); ?></th>
										<th><?php echo _l('vessel_name'); ?></th>
										<th><?php echo _l('vessel_type'); ?></th>
										<th><?php echo _l('gross_ton'); ?></th>
										<th><?php echo _l('engine_type'); ?></th>
										<th><?php echo _l('eng_output'); ?></th>
										<th><?php echo _l('sailing_area'); ?></th>
										<th><?php echo _l('embarkation_date'); ?></th>
										<th><?php echo _l('disembarkation_date'); ?></th>
										<th><?php echo _l('cur_onboard'); ?></th>
										<th><?php echo _l('boarding_period'); ?></th>
										<th><?php echo _l('boarding_periods'); ?></th>
										<!-- <th><?php //echo _l('boarding_month'); 
													?></th> -->
										<th><?php echo _l('approval_rate'); ?></th>
										<th><?php echo _l('remark'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php
										$no = 1;

										foreach ($candidate->on_board_other_company as $we) { ?>
											<tr class="project-overview">
												<td><?php echo $no++; ?></td>
												<td><?php echo get_select_option_name_by_id('job_rank', $we['rank'], 'rank_name'); ?></td>
												<td><?php echo html_entity_decode($we['company_name']); ?></td>
												<td><?php echo html_entity_decode($we['vessel_name']); ?></td>
												<td><?php echo get_select_option_name_by_id('job_vessel', $we['vessel_type'], 'vessel_name'); ?></td>
												<td><?php echo html_entity_decode($we['gross_ton']); ?></td>
												<td><?php echo html_entity_decode($we['engine_type']); ?></td>
												<td><?php echo html_entity_decode($we['eng_output']); ?></td>
												<td><?php echo html_entity_decode($we['sailing_area']); ?></td>

												<td style="<?php echo check_date_included_in_other($we['id'], $we['candidate'], $we['embarkation_date'], 'rec_on_board_other_company'); ?>"><?php echo _d($we['embarkation_date']); ?></td>

												<td><?php
													if ($we['cur_onboard'] == '1') {
														echo '';
													} else {
														echo _d($we['disembarkation_date']);
													} ?>
												</td>
												<td><?php
													if ($we['cur_onboard'] == '1') {
														echo "Yes";
													} elseif ($we['cur_onboard'] == 0) {
														echo "No";
													}
													?></td>
												<?php
												$boarding_period = html_entity_decode($we['boarding_period']);
												$embarkation_date = html_entity_decode($we['embarkation_date']);
												$disembarkation_date = html_entity_decode($we['disembarkation_date']);
												if (preg_match('/^(\d+Y )?(\d+M )?(\d+D)$/', $boarding_period, $matches)) { ?>
													<td><?php echo calculateBoardingPeriod($embarkation_date, $disembarkation_date); ?></td>
												<?php  } else {
													preg_match('/(\d+)/', $boarding_period, $matches);
													if (isset($matches[1])) {
														$days = (int)$matches[1];

														// Convert days to years, months, and days
														$years = floor($days / 365);
														$remaining_days = $days % 365;
														$months = floor($remaining_days / 30);
														$days = $remaining_days % 30;

														// Format the result
														$result = sprintf("%dY %dM %dD", $years, $months, $days);
													}

												?>
													<td><?php echo isset($result) ? $result : '' ?></td>
												<?php } ?>

												<td><?php echo calculateBoardingPeriodDays($embarkation_date, $disembarkation_date); ?></td>
												<td><?php echo html_entity_decode($we['approval_rate']); ?></td>
												<td><?php echo html_entity_decode($we['remark']); ?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="edit_on_board_other_company_detail" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="on_board_other_company_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>

							<div class="col-md-12">
								<p class="bold other_infor-style pull-left"><?php echo _l('on_board_in_land'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addOnBoardInLandModal"><?php echo _l('Add'); ?></button>
							</div>
							<hr class="other_infor-hr" />
							<?php if (count($candidate->on_board_in_land) > 0) { ?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('company_name'); ?></th>
										<th><?php echo _l('hire_date'); ?></th>
										<th><?php echo _l('resignation_date'); ?></th>
										<th><?php echo _l('work_dep'); ?></th>
										<th><?php echo _l('responsibility_work'); ?></th>
										<th><?php echo _l('final_position'); ?></th>
										<th><?php echo _l('retire_reason'); ?></th>
										<th><?php echo _l('other_company_career'); ?></th>
										<th><?php echo _l('remark'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->on_board_in_land as $we) { ?>
											<tr class="project-overview">
												<td><?php echo html_entity_decode($we['company_name']); ?></td>
												<td><?php echo _d($we['hire_date']); ?></td>
												<td><?php echo _d($we['resignation_date']); ?></td>
												<td><?php echo html_entity_decode($we['work_dep']); ?></td>
												<td><?php echo html_entity_decode($we['responsibility_work']); ?></td>
												<td><?php echo html_entity_decode($we['final_position']); ?></td>
												<td><?php echo html_entity_decode($we['retire_reason']); ?></td>
												<td><?php echo html_entity_decode($we['other_company_career']); ?></td>
												<td><?php echo html_entity_decode($we['remark']); ?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="edit_on_board_in_land_detail" data-id="<?php echo $we['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="on_board_in_land_detail_delete" data-id="<?php echo $we['id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>

						</div>

						<!-- On-board END----------------------------------->



					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="care_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/care_candidate'), array('id' => 'care_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button d type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">

				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<?php $attr = [];
						$attr = ['disabled' => "true"];
						echo render_input('candidate', 'candidate', $candidate->candidate_code . ' - ' . $candidate->candidate_name . ' ' . $candidate->last_name, 'text', $attr);

						echo form_hidden('candidate', $candidate->id);
						?>
					</div>
					<div class="col-md-6">
						<?php echo render_datetime_input('care_time', 'care_time') ?>
					</div>
					<div class="col-md-12" id="care_rs">

					</div>
					<div class="col-md-12">
						<?php echo render_textarea('description', 'description') ?>
					</div>
					<div id="type_care">

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" onclick="submit_care_candidate(); return false;" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="mail_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/send_mail_candidate'), array('id' => 'mail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span><?php echo _l('send_mail'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<?php $attr = [];
						$attr = ['disabled' => "true"];
						echo render_input('candidate', 'candidate', $candidate->candidate_code . ' - ' . $candidate->candidate_name . ' ' . $candidate->last_name, 'text', $attr);

						echo form_hidden('candidate', $candidate->id);
						?>
					</div>
					<div class="col-md-12">
						<?php echo render_input('email', 'email', $candidate->email); ?>
					</div>

					<div class="col-md-12">
						<?php echo render_input('subject', 'subject'); ?>
					</div>

					<div class="col-md-12">
						<?php echo render_textarea('content', 'content', '', array(), array(), '', 'tinymce') ?>
					</div>
					<div id="type_care">

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="family_details_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/update_family_detail_candidate'), array('id' => 'update_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span><?php echo _l('edit_family_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">

					<?php echo form_hidden('family_info_id', ''); ?>

					<?php echo form_hidden('family_candidate_id', ''); ?>

					<div class="col-md-6">
						<?php echo render_input('edit_family_religion', 'family_religion', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_name', 'family_name'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_id_no', 'id_no'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('edit_family_birthday', 'birthday'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_age', 'age'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_final_academy_career', 'final_academy_career'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_school', 'school'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_major', 'major'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_position', 'position'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_grade', 'grade'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_basic_deduction', 'basic_deduction'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_child_bearing', 'child_bearing'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_contact_number', 'contact_number'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_family_contact_number2', 'contact_number2'); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="addFamilyinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_family_detail_candidate'), array('id' => 'add_family_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span><?php echo _l('add_family_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">

					<?php echo form_hidden('add_family_candidate_id', $candidate->id); ?>

					<div class="col-md-6">
						<?php echo render_input('edit_family_religion', 'family_religion', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_name', 'family_name'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_id_no', 'id_no'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('edit_family_birthday', 'birthday'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_age', 'age'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_final_academy_career', 'final_academy_career'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_school', 'school'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_major', 'major'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_position', 'position'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_grade', 'grade'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_basic_deduction', 'basic_deduction'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_family_child_bearing', 'child_bearing'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_family_contact_number', 'contact_number'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_family_contact_number2', 'contact_number2'); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="addEducationinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_eduaction_detail_candidate'), array('id' => 'add_family_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="education_label"><?php echo _l('add_education_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_education_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('education_id', ''); ?>
					<div class="col-md-6">
						<?php echo render_input('education_year', 'education_year', ''); ?>
					</div>

					<div class="col-md-6">
						<?php //echo render_input('course_type', 'course_type', ''); 
						?>
						<?php echo render_select('course_type[]', $course_list, ['id', 'course_name'], 'course_type', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('course_name', 'course_name', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('edu_start_date', 'edu_start_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('edu_finish_date', 'edu_finish_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('edu_date', 'edu_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('valid_date', 'valid_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edu_institution', 'edu_institution', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('completed_edu', 'completed_edu', ''); ?>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="editEducationinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/update_eduaction_detail_candidate'), array('id' => 'add_family_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="education_label"><?php echo _l('edit_education_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('edit_education_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('education_id', ''); ?>
					<div class="col-md-6">
						<?php echo render_input('edit_education_year', 'education_year', ''); ?>
					</div>

					<div class="col-md-6">
						<?php //echo render_input('edit_course_type', 'course_type', ''); 
						?>
						<?php echo render_select('course_type[]', $course_list, ['id', 'course_name'], 'course_type', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_course_name', 'course_name', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('edit_edu_start_date', 'edu_start_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('edit_edu_finish_date', 'edu_finish_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('edit_edu_date', 'edu_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('edit_valid_date', 'valid_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_edu_institution', 'edu_institution', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('edit_completed_edu', 'completed_edu', ''); ?>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="addSchoolinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_school_detail_candidate'), array('id' => 'add_family_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span><?php echo _l('add_schhool_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_school_candidate_id', $candidate->id); ?>

					<div class="col-md-6">
						<?php echo render_date_input('enterance_date', 'enterance_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('graduation_date', 'graduation_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('university', 'university', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('school_name', 'school_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('faculty', 'faculty', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('major_name', 'major_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('year_of_graduation', 'year_of_graduation', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('final_academic_career', 'final_academic_career', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('academic_career_type', 'academic_career_type', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('remark', 'remark', ''); ?>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="editSchoolinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/update_school_detail_candidate'), array('id' => 'add_family_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span><?php echo _l('edit_schhool_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('edit_school_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('school_id', ''); ?>
					<div class="col-md-6">
						<?php echo render_date_input('edit_enterance_date', 'enterance_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('edit_graduation_date', 'graduation_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_university', 'university', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_school_name', 'school_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_faculty', 'faculty', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_major_name', 'major_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_year_of_graduation', 'year_of_graduation', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_final_academic_career', 'final_academic_career', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_academic_career_type', 'academic_career_type', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_remark', 'remark', ''); ?>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="addupdateRewardinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_reward_detail_candidate'), array('id' => 'add_family_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="reward_label"><?php echo _l('add_reward_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_reward_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('reward_id', ''); ?>
					<div class="col-md-6">
						<?php echo render_date_input('app_date', 'app_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('award_punishment', 'award_punishment', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('grade_rank', 'grade_rank', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('award_punishment_kind', 'award_punishment_kind', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('award_punishment_reason', 'award_punishment_reason', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('reward_file', 'reward_file', '', 'file'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('rewards_remark', 'rewards_remark', ''); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="addMedicalinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_medical_detail_candidate'), array('id' => 'add_medical_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="medical_label"><?php echo _l('add_medical_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_medical_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('medical_id', ''); ?>
					<div class="col-md-6">
						<?php echo render_date_input('medical_test_date', 'medical_test_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('valid_test_date', 'valid_test_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('medical_test_division', 'medical_test_division', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('judgement_y_n', 'judgement_y_n', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('medical_hospital', 'medical_hospital', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('judgement', 'judgement', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('final_option', 'final_option', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('medical_remark', 'medical_remark', ''); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="addPromotioninfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_promotion_detail_candidate'), array('id' => 'add_update_promotion_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="promotion_label"><?php echo _l('add_promotion_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_promotion_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('promotion_id', ''); ?>
					<div class="col-md-6">
						<?php echo render_date_input('promotion_app_date', 'promotion_app_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('final_grade', 'final_grade', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('promotion_grade', 'promotion_grade', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('final_depart', 'final_depart', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('length_of_stay', 'length_of_stay', ''); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="addPscinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_psi_detail_candidate'), array('id' => 'add_update_psc_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="psc_label"><?php echo _l('add_psc_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_psc_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('psc_id', ''); ?>
					<div class="col-md-6">
						<?php echo render_date_input('psc_date', 'psc_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('vessel', 'vessel', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('inspection', 'inspection', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('mou', 'mou', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('country', 'country', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('port', 'port', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('result', 'result', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('deficiency', 'deficiency', ''); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="addLicenceinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_licence_detail_candidate'), array('id' => 'add_update_licence_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="licence_label"><?php echo _l('add_licence_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_licence_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('licence_id', ''); ?>
					<div class="col-md-6">
						<?php echo render_select('lic_kind_division[]', $kind_list_license, ['id', 'kind_name'], 'lic_kind_division', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('lic_licence_no', 'lic_licence_no', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('lic_acquisition_date', 'lic_acquisition_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('lic_exipiry_date', 'lic_exipiry_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('lic_issue_authority', 'lic_issue_authority', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('licence_attach_file', 'licence_attach_file', '', 'file'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('licence_remark', 'licence_remark', ''); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="addDocumentinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_document_detail_candidate'), array('id' => 'add_update_document_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="document_label"><?php echo _l('add_document_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_document_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('document_id', ''); ?>
					<div class="col-md-6">
						<?php echo render_select('doc_kind_division[]', $kind_list_document, ['id', 'kind_document_name'], 'doc_kind_division', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('doc_licence_no', 'doc_licence_no', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('doc_issue_date', 'doc_issue_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('doc_exipiry_date', 'doc_exipiry_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('doc_issue_authority', 'doc_issue_authority', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('doc_attach_file', 'doc_attach_file', '', 'file'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('doc_remark', 'doc_remark', ''); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="addflaginfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_flag_detail_candidate'), array('id' => 'add_update_flag_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="flag_label"><?php echo _l('add_flag_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_flag_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('flag_id', ''); ?>

					<div class="col-md-6">
						<?php echo render_select('flag_kind_division[]', $kind_list_flag, ['id', 'kind_flag_name'], 'flag_kind_division', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('flag_licence_no', 'flag_licence_no', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('flag_issue_date', 'flag_issue_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_date_input('flag_exipiry_date', 'flag_exipiry_date', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('flag_issue_authority', 'flag_issue_authority', ''); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('flag_attach_file', 'flag_attach_file', '', 'file'); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('flag_remark', 'flag_remark', ''); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="candidate_rating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content width-100">
			<div class="modal-header">
				<button group="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">
					<span><?php echo _l('rate_candidate'); ?></span>
				</h4>
			</div>
			<?php echo form_open('admin/recruitment/rating_candidate', array('id' => 'rating-modal')); ?>
			<?php echo form_hidden('candidate', $candidate->id); ?>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<?php if ($evaluation != '') {
							$count_gr = 1;
							foreach ($evaluation['groups'] as $gr) {

						?>

								<h5 class="bold"><?php echo html_entity_decode($count_gr . '. ' . $gr['criteria_title']); ?></h5>
								<hr class="criteria_title-hr" />

								<?php
								$count_cr = 1;

								foreach ($evaluation['criteria'] as $cr) {
									if ($cr['group_cr'] == $gr['id']) {

								?>

										<p>
										<div class="star-rating">
											&nbsp;&nbsp;&nbsp;<?php echo html_entity_decode($count_gr . '.' . $count_cr . '. ' . $cr['criteria_title'] . ' (' . $cr['percent'] . '%)'); ?>
											<div class="pull-right font-size-125">
												<span class="fa fa-star-o margin-top-8" data-rating="1" data-id="<?php echo html_entity_decode($cr['evaluation_criteria']); ?>"></span>
												<span class="fa fa-star-o margin-top-8" data-rating="2" data-id="<?php echo html_entity_decode($cr['evaluation_criteria']); ?>"></span>
												<span class="fa fa-star-o margin-top-8" data-rating="3" data-id="<?php echo html_entity_decode($cr['evaluation_criteria']); ?>"></span>
												<span class="fa fa-star-o margin-top-8" data-rating="4" data-id="<?php echo html_entity_decode($cr['evaluation_criteria']); ?>"></span>
												<span class="fa fa-star-o margin-top-8" data-rating="5" data-id="<?php echo html_entity_decode($cr['evaluation_criteria']); ?>"></span>
												<input type="hidden" name="rating[<?php echo html_entity_decode($cr['evaluation_criteria']); ?>]" class="rating-value" value="">
												<input type="hidden" name="percent[<?php echo html_entity_decode($cr['evaluation_criteria']); ?>]" value="<?php echo html_entity_decode($cr['percent']); ?>">
												<input type="hidden" name="group[<?php echo html_entity_decode($cr['evaluation_criteria']); ?>]" value="<?php echo html_entity_decode($gr['id']); ?>">
											</div>

										</div>
										</p>

							<?php $count_cr++;
									}
								}
								$count_gr++;
							} ?>
							<?php echo render_textarea('feedback', 'feedback'); ?>
						<?php } else {
							echo '<p class="bold text-danger">' . _l('none_evaluetion_form') . '</p>';
						} ?>


					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button group="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button group="submit" onclick="submit_rating_candidate(); return false;" class="btn btn-info"><?php echo _l('submit'); ?></button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="addOnBoardCompanyModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_on_board_company'), array('id' => 'add_update_on_board_company-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="on_board_company_label"><?php echo _l('add_on_board_company'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_on_board_company_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('on_board_company_id', ''); ?>
					<div class="col-md-12" style="margin-bottom: 20px; display:none;">
						<input type="checkbox" id="company_date_validation_check_box" name="company_date_validation_check_box" value="<?php echo (get_tab_option('hris_setting_option') == 1) ? 'true' : 'false'; ?>" <?php if (get_tab_option('hris_setting_option') == 1) echo 'checked'; ?>>
						<label for="company_date_validation_check_box">Date Validation Required</label>
					</div>
					<div class="col-md-6">
						<?php echo render_input('vessel_name', 'vessel_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('grade_rank', 'grade_rank', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_select('rank[]', $rank_list, ['id', 'rank_name'], 'rank_name', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_select('vessel_type[]', $vessel_list, ['id', 'vessel_name'], 'vessel_type', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('gross_ton', 'gross_ton', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('engine_type', 'engine_type', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('eng_output', 'eng_output', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('ramaining_days', 'ramaining_days', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('boarding_period', 'boarding_period', '', 'text', array('readonly' => true)); ?>
					</div>
					<!-- <div class="col-md-6">
						<?php //echo render_input('boarding_month', 'boarding_month', '', 'text', array('disabled' => true)); 
						?>
					</div> -->
					<div class="col-md-6">
						<?php echo render_input('boarding_periods', 'boarding_periods', '', 'text', array('disabled' => true)); ?>
					</div>
					<div class="col-md-6">
						<?php
						echo render_date_input('embarkation_date', 'embarkation_date',  _d($last_embarkation_date), ['data-date-end-date' => date('Y-m-d')]); ?>
					</div>
					<?php
					echo form_hidden('last_embarkation_date', $last_embarkation_date);
					echo form_hidden('last_embarkation_date_old', $last_embarkation_date);
					?>
					<?php
					$on_board_check_box =  check_on_board($candidate->id, 'rec_on_board_company');
					if ($on_board_check_box != 'true') {
					?>
						<div class="col-md-6">
							<div class="checkbox checkbox-primary">
								<input type="checkbox" id="cur_onboard" name="cur_onboard" data-test='<?php echo $on_board_check_box; ?>'>
								<label for="cur_onboard">
									<?php echo _l('cur_onboard'); ?>
								</label>
							</div>
						</div>
					<?php } ?>
					<div class="col-md-6">
						<?php echo render_date_input('disembarkation_date', 'disembarkation_date', '', ['data-date-end-date' => date('Y-m-d')]); ?>
					</div>

					<div class="col-md-6">
						<?php echo render_input('calculation_y_n', 'calculation_y_n', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('emp_no', 'emp_no', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('employment', 'employment', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('ship_owner', 'ship_owner', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('employer', 'employer', ''); ?>
					</div>
				</div><!-- /.row -->
			</div><!-- /.modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn_conpany" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div><!-- /.modal-footer -->
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="addOnBoardOtherCompanyModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_on_board_other_company'), array('id' => 'add_update_on_board_other_company-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="on_board_other_company_label"><?php echo _l('add_on_board_other_company'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_on_board_other_company_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('on_board_other_company_id', ''); ?>
					<?php
					echo form_hidden('last_embarkation_other_date', $last_embarkation_other_date);
					echo form_hidden('last_embarkation_other_date_old', $last_embarkation_other_date);
					?>
					<div class="col-md-12" style="margin-bottom: 20px; display:none;">
						<input type="checkbox" id="other_company_date_validation_check_box" name="other_company_date_validation_check_box" value="<?php echo (get_tab_option('hris_setting_option') == 1) ? 'true' : 'false'; ?>" <?php if (get_tab_option('hris_setting_option') == 1) echo 'checked'; ?>>
						<label for="other_company_date_validation_check_box">Date Validation Required</label>
					</div>
					<div class="col-md-6">
						<?php echo render_select('rank_other[]', $rank_list, ['id', 'rank_name'], 'rank_name', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('company_name', 'company_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('vessel_name', 'vessel_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_select('vessel_type[]', $vessel_list, ['id', 'vessel_name'], 'vessel_type', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('gross_ton', 'gross_ton', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('engine_type', 'engine_type', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('eng_output', 'eng_output', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('sailing_area', 'sailing_area', ''); ?>
					</div>
					<div class="col-md-6">

						<?php echo render_date_input('embarkation_other_date', 'embarkation_other_date', _d($last_embarkation_other_date), ['data-date-end-date' => date('Y-m-d')]); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('disembarkation_other_date', 'disembarkation_other_date', '', ['data-date-end-date' => date('Y-m-d')]); ?>
					</div>
					<?php
					$on_board_check_box =  check_on_board($candidate->id, 'rec_on_board_other_company');
					if ($on_board_check_box != 'true') { ?>
						<div class="col-md-6">
							<div class="checkbox checkbox-primary">
								<input type="checkbox" id="cur_onboard_other" name="cur_onboard_other">
								<label for="cur_onboard_other">
									<?php echo _l('cur_onboard_other'); ?>
								</label>
							</div>
						</div>
					<?php } ?>
					<div class="col-md-6">
						<?php echo render_input('boarding_other_period', 'boarding_other_period', '', 'text', array('readonly' => true)); ?>
					</div>
					<!-- <div class="col-md-6">
						<?php //echo render_input('boarding_other_month', 'boarding_other_month', '', 'text', array('disabled' => true)); 
						?>
					</div> -->
					<div class="col-md-6">
						<?php echo render_input('boarding_other_periods', 'boarding_other_periods', '', 'text', array('disabled' => true)); ?>
					</div>

					<div class="col-md-12">
						<?php echo render_input('approval_rate', 'approval_rate', ''); ?>
					</div>
					<div class="col-md-12">
						<?php echo render_textarea('remark', 'remark', ''); ?>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn_other" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="addOnBoardInLandModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_on_board_in_land'), array('id' => 'add_update_on_board_in_land-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="on_board_in_land_label"><?php echo _l('add_on_board_in_land'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_on_board_in_land_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('on_board_in_land_id', ''); ?>

					<div class="col-md-6">
						<?php echo render_input('company_name', 'company_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('work_dep', 'work_dep', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('hire_date', 'hire_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('resignation_date', 'resignation_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('responsibility_work', 'responsibility_work', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('final_position', 'final_position', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('retire_reason', 'retire_reason', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('other_company_career', 'other_company_career', ''); ?>
					</div>
					<div class="col-md-12">
						<?php echo render_textarea('remark', 'remark', ''); ?>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button id="sm_btn" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div>

<?php init_tail(); ?>
<?php require 'modules/recruitment/assets/js/candidate_detail_js.php'; ?>
<?php require 'modules/recruitment/assets/js/custom_candidate_detail_js.php'; ?>

<script>
	$(document).ready(function() {

		var activeTab = localStorage.getItem('activeTab');
		if (activeTab) {
			$('.nav-tabs a[href="' + activeTab + '"]').tab('show');
		}

		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			var tabName = $(e.target).attr('href');
			localStorage.setItem('activeTab', tabName);
		});

		// var lastEmbarkationDate = '<?php //echo $last_embarkation_date; 
										?>';
		// var lastEmbarkationotherDate = '<?php //echo $last_embarkation_other_date; 
											?>';

		$('#embarkation_date').change(function() {
			var company_date_validation_check_box = $("#company_date_validation_check_box").val();
			if (company_date_validation_check_box == 'false') {
				var inputDateString = $(this).val();
				var inputDate = parseDate(inputDateString);
				var lastEmbarkationDate = $('input[name="last_embarkation_date"]').val();

				var lastDate = parseDate(lastEmbarkationDate);

				if (inputDate < lastDate) {
					alert_float('warning', 'Date is not valid (Embarkation not allow less than this date: ' + lastEmbarkationDate + ')');
					$('#sm_btn_conpany').prop('disabled', true);
				} else {
					$('#sm_btn_conpany').prop('disabled', false);
				}
			}
		});

		$("#company_date_validation_check_box").change(function() {
			if ($(this).is(':checked')) {
				$(this).val('true');
			} else {
				$(this).val('false');
			}
		})

		$("#other_company_date_validation_check_box").change(function() {
			if ($(this).is(':checked')) {
				$(this).val('true');
			} else {
				$(this).val('false');
			}
		})

		function parseDate(dateString) {
			var formatsToTry = ['YYYY-MM-DD', 'DD.MM.YYYY', 'MM/DD/YYYY']; // Add more formats as needed
			var parsedDate = null;

			formatsToTry.forEach(function(format) {
				var momentDate = moment(dateString, format, true); // Use moment.js for parsing
				if (momentDate.isValid()) {
					parsedDate = momentDate.toDate();
					return false; // Exit loop if a valid date is found
				}
			});

			return parsedDate;
		}

		// other 

		$('#embarkation_other_date').change(function() {
			var other_company_date_validation_check_box = $("#other_company_date_validation_check_box").val();
			if (other_company_date_validation_check_box == 'false') {
				var inputDateStringother = $(this).val();
				var lastEmbarkationotherDate = $('input[name="last_embarkation_other_date"]').val();

				var inputDateother = parseotherDate(inputDateStringother);

				var lastDateother = parseotherDate(lastEmbarkationotherDate);

				if (inputDateother < lastDateother) {
					alert_float('warning', 'Date is not valid (Embarkation not allow less than this date: ' + lastEmbarkationotherDate + ')');
					$('#sm_btn_other').prop('disabled', true);
				} else {
					$('#sm_btn_other').prop('disabled', false);
				}
			}
		});

		function parseotherDate(dateStringother) {
			var formatsToTry = ['YYYY-MM-DD', 'DD.MM.YYYY', 'MM/DD/YYYY'];
			var parsedDateother = null;

			formatsToTry.forEach(function(format) {
				var momentDate = moment(dateStringother, format, true);
				if (momentDate.isValid()) {
					parsedDateother = momentDate.toDate();
					return false;
				}
			});
			return parsedDateother;
		}
	});
	$(document).on('hide.bs.modal', "#addOnBoardOtherCompanyModal", function() {
		$("#other_company_date_validation_check_box").val('false')
	})

	$(document).on('hide.bs.modal', "#addOnBoardCompanyModal", function() {
		$("#company_date_validation_check_box").val('false')
	})
</script>
</body>

</html>