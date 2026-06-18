<?php init_head(); ?>
<style>
	.general-infor-hr {
		margin-bottom: 0px !important;
	}

	.hidden-expire1 {
		display: none;
	}

	.hidden-expire2 {
		display: none;
	}

	.hidden-expire3 {
		display: none;
	}

	.hidden-expire4 {
		display: none;
	}

	.hidden-expire5 {
		display: none;
	}

	.hidden-expire6 {
		display: none;
	}
</style>
<div id="wrapper">
	<div class="content">
		<div class="panel_s">
			<div class="panel-body">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<a href="<?php echo admin_url('recruitment/candidate_profile'); ?>" class="btn btn-info mright5 pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i>
								Back To List</a>
						</div>
						<div class="col-md-6">
							<a href="#" onclick="email_template_manage_send_mail('candidate', <?php echo $candidate->id; ?>)" class="btn btn-info pull-right display-block mright5">
								<i class="fa fa-envelope"></i> <?php echo _l('send_mail'); ?>
							</a>
						</div>
					</div>
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
					<!-- <a href="Javascript:void(0);" id="toggle_popup_approval" class="btn btn-success display-block pull-right"><i class="fa fa-user-md"></i><?php //echo ' ' . _l('rec_care') . ' '; 
																																								?><i class="fa fa-caret-down"></i></a> -->
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
					<!-- <a href="#" onclick="send_mail_candidate(); return false;" class="btn btn-info pull-right display-block mright5"><i class="fa fa-envelope"></i><?php //echo ' ' . _l('send_mail'); 
																																										?></a> -->

					<!-- <a href="#" class="btn btn-warning pull-right mright5" data-toggle="modal" data-target="#candidate_rating"><i class="fa fa-star"></i><?php echo ' ' . _l('rate_candidate'); ?></a>
					<div class="col-md-3 pull-right">
						<select name="change_status" id="change_status" onchange="change_status_candidate(this,<?php //echo html_entity_decode($candidate->id); 
																												?>); return false;" class="selectpicker" data-width="100%" data-none-selected-text="<?php //echo _l('change_status_to'); 
																																																	?>">
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
					</div> -->
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
									<a href="#personal_info" aria-controls="personal_info" role="tab" data-toggle="tab" aria-controls="personal_info">
										<i class="fa fa-user"></i>&nbsp;<?php echo _l('personal_info'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#licence_document_info" aria-controls="licence_document_info" role="tab" data-toggle="tab" aria-controls="licence_document_info">
										<i class="fa fa-hospital"></i>&nbsp;<?php echo _l('licence_document_info'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#education_info" aria-controls="education_info" role="tab" data-toggle="tab" aria-controls="education_info">
										<i class="fa fa-book"></i>&nbsp;<?php echo _l('education_info'); ?>
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
								<?php if (get_tab_option('recruitment_create_campaign_tab_promotion') == 1) { ?>
									<li role="presentation">
										<a href="#promotion_info" aria-controls="promotion_info" role="tab" data-toggle="tab" aria-controls="promotion_info">
											<i class="fa fa-hospital"></i>&nbsp;<?php echo _l('promotion'); ?>
										</a>
									</li>
								<?php } ?>
								<li role="presentation">
									<a href="#on_board" aria-controls="on_board" role="tab" data-toggle="tab" aria-controls="on_board">
										<i class="fa fa-sitemap"></i>&nbsp;<?php echo _l('on_board'); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#transaction_histroy" aria-controls="transaction_histroy" role="tab" data-toggle="tab" aria-controls="transaction_histroy">
										<i class="fa fa-sitemap"></i>&nbsp;<?php echo _l('transaction_histroy'); ?>
									</a>
								</li>
								<?php if (get_tab_option('recruitment_create_campaign_tab_psc') == 1) { ?>
									<li role="presentation">
										<a href="#psc_info" aria-controls="psc_info" role="tab" data-toggle="tab" aria-controls="psc_info">
											<i class="fa fa-university"></i>&nbsp;<?php echo _l('psc'); ?>
										</a>
									</li>
								<?php } ?>
								<?php if (get_tab_option('recruitment_create_campaign_tab_recruitment_history') == 1) { ?>
									<li role="presentation">
										<a href="#history_recruitment" aria-controls="history_recruitment" role="tab" data-toggle="tab" aria-controls="history_recruitment">
											<i class="fa fa-calendar"></i>&nbsp;<?php echo _l('history_recruitment'); ?>
										</a>
									</li>
								<?php } ?>

								<?php if (get_tab_option('recruitment_create_campaign_tab_capacity_profile') == 1) { ?>
									<li role="presentation">
										<a href="#capacity_profile" aria-controls="capacity_profile" role="tab" data-toggle="tab" aria-controls="capacity_profile">
											<i class="fa fa-address-card"></i>&nbsp;<?php echo _l('capacity_profile'); ?>
										</a>
									</li>
								<?php } ?>

								<li role="presentation">
									<a href="#attachment" aria-controls="attachment" role="tab" data-toggle="tab" aria-controls="attachment">
										<i class="fa fa-paperclip"></i>&nbsp;<?php echo _l('attachment'); ?>
									</a>
								</li>

								<?php if (get_tab_option('contract') == 1) { ?>
									<li role="presentation">
										<a href="#contract" aria-controls="contract" role="tab" data-toggle="tab" aria-controls="contract">
											<i class="fa fa-address-card"></i>&nbsp;<?php echo _l('contract'); ?>
										</a>
									</li>
								<?php } ?>

								<?php
								hooks()->do_action('add_candidate_detail_tab');
								?>
							</ul>
						</div>
					</div>

					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="detail">
							<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('general_infor'); ?></p>
							<!-- <a href="<?php //echo admin_url('recruitment/candidates/' . $candidate->id . '?editsummary=editsummary') 
											?>" style="margin-top: 14px;" class="btn btn-info pull-right ">Edit</a> -->
							<hr class="margin-top-10 general-infor-hr" />
							<div class="col-md-2 padding-left-right-0 margin-top-15" style="padding-right: 10px;">
								<div class="picture-container margin-top-10 pull-left">
									<div class="picture pull-left">
										<img style="width: 100%;" src="<?php if (isset($candidate->avar)) {
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
											<td class="bold" width="30%"><?php echo _l('age'); ?></td>
											<td><?php echo html_entity_decode(calculateAge($candidate->birthday)); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('marital_status'); ?></td>
											<td><?php echo _l($candidate->marital_status); ?></td>
										</tr>
										<!-- <tr class="project-overview">
											<td class="bold"><?php //echo _l('nation'); 
																?></td>
											<td><?php //echo html_entity_decode($candidate->nation); 
												?></td>
										</tr> -->
										<tr class="project-overview">
											<td class="bold"><?php echo _l('nationality'); ?></td>
											<td><?php echo html_entity_decode($candidate->nationality); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold" width="30%"><?php echo _l('birthday'); ?></td>
											<td><?php echo _d($candidate->birthday); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('religion'); ?></td>
											<td><?php echo html_entity_decode($candidate->religion); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('department'); ?></td>
											<!-- dhaval changes -->
											<?php 
											$candidate_payroll_selection_detail = get_candidate_payroll_selection_detail($candidate->id);
											$payroll_vessel = isset($candidate_payroll_selection_detail['vessel']) ? ' ( ' .$candidate_payroll_selection_detail['vessel'] . ' )' : '';
											?>
											<td><?php echo get_select_option_name_by_id('job_department', $candidate->department, 'department_name') . '<span title="Payroll Data" style="color: red;">' .$payroll_vessel . '</span>'; ?></td>
											<!-- dhaval changes -->
										</tr>



										<!-- <tr class="project-overview">
											<td class="bold"><?php //echo _l('promotion'); 
																?></td>
											<td><?php //echo html_entity_decode($candidate->promotion); 
												?></td>
										</tr> -->

										<tr class="project-overview">
											<td class="bold"><?php echo _l('resident'); ?></td>
											<?php $resident = (isset($candidate) ? $candidate->resident : ''); ?>
											<td><?php echo $resident; ?>&nbsp;&nbsp;&nbsp;<?php echo get_select_option_name_by_id('cities_new', $candidate->city, 'name'); ?>&nbsp;&nbsp;&nbsp;<?php echo get_select_option_name_by_id('states_new', $candidate->state, 'name'); ?>&nbsp;&nbsp;&nbsp;<?php echo get_select_option_name_by_id('countries_new', $candidate->address_country, 'name'); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('hire_career'); ?></td>
											<td style="color: blue;"><span class="main_hire_career"></span></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('other_hire_career'); ?></td>
											<td style="color: blue;"><span class="other_hire_career"></span></td>
										</tr>

										<tr class="project-overview">
											<td style="color: blue;" class="bold"><?php echo _l('total_hire_career'); ?></td>
											<td style="color: blue;"><span class="total_hire_career"></span></td>
										</tr>

										<!-- <tr class="project-overview">
											<td class="bold"><?php //echo _l('height'); 
																?></td>
											<td><?php //echo html_entity_decode($candidate->height); 
												?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php //echo _l('weight'); 
																?></td>
											<td><?php //echo html_entity_decode($candidate->weight); 
												?></td>
										</tr> -->
										<!-- <tr class="project-overview">
											<td class="bold"><?php //echo _l('graduated'); 
																?></td>
											<td><?php //echo _l($candidate->graduated); 
												?></td>
										</tr> -->

										<!-- <tr class="project-overview">
											<td class="bold"><?php //echo _l('country'); 
																?></td>
											<td><?php //echo get_select_option_name_by_id('countries_new', $candidate->address_country, 'name'); 
												?></td>
										</tr> -->
										<!-- <tr class="project-overview">
											<td class="bold"><?php //echo _l('province'); 
																?></td>
											<td><?php //echo get_select_option_name_by_id('states_new', $candidate->state, 'name'); 
												?></td>
										</tr> -->

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
											<td class="bold" width="30%"><?php echo _l('rank_name_official'); ?></td>
											<?php $camption_name = get_camption_name($candidate->rank); ?>
											<?php 
											$candidate_payroll_selection_detail = get_candidate_payroll_selection_detail($candidate->id);
											$payroll_rank = isset($candidate_payroll_selection_detail['rank']) ? ' ( ' .$candidate_payroll_selection_detail['rank'] . ' )' : '';
											?>
											<td>
												<?php echo isset($camption_name->rank_name) ? $camption_name->rank_name : '' ?>
												<span title="Payroll Data" style="color: red;"><?php echo $payroll_rank; ?></span>
											</td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('emp_status'); ?></td>
											<td><?php echo $emp_status_lable; ?></td>
										</tr>
										<!-- <tr class="project-overview">
											<td class="bold"><?php //echo _l('academy_type'); 
																?></td>
											<td><?php //echo html_entity_decode($candidate->academy_type); 
												?></td>
										</tr> -->

										<tr class="project-overview">
											<td class="bold"><?php echo _l('department_date'); ?></td>
											<td><?php echo _d($candidate->department_date); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('hired_type'); ?></td>
											<td><?php echo $candidate->hired_type; ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('hired_date'); ?></td>
											<td style="color: blue;"><?php echo _d($candidate->hired_date); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('manning_agency'); ?></td>
											<td><?php echo get_minning_agency_name($candidate->manning_agency); ?></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('employer'); ?></td>
											<td><?php echo $candidate->employer; ?></td>
										</tr>
										<!-- <tr class="project-overview">
											<?php //$vsl_career = (isset($candidate) ? $candidate->vsl_career : ''); 
											?>
											<td class="bold"><?php //echo _l('vsl_career'); 
																?></td>
											<td style="color: blue;"><span class="main_vsl_career"></span>&nbsp;&nbsp;<span style="color: black;">(<span class="vsl_type"></span>)</span></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php //echo _l('other_vsl_career'); 
																?></td>
											<td style="color: blue;"><span class="other_vsl_career"></span>&nbsp;&nbsp;<span style="color: black;">(<span class="vsl_other_type"></span>)</span></td>
										</tr>

										<tr class="project-overview">
											<td style="color: blue;"><?php //echo _l('main_total_vsl_career'); 
																		?></td>
											<td style="color: blue;"><span class="main_total_vsl_career"></span>&nbsp;&nbsp;</td>
										</tr> -->

										<tr class="project-overview">
											<td class="bold"><?php echo _l('promotion'); ?></td>
											<td><?php echo _d($candidate->promotion); ?></td>
										</tr>
										<tr class="project-overview">
											<td class="bold"><?php echo _l('ereg_no'); ?></td>
											<td><?php echo html_entity_decode($candidate->ereg_no); ?></td>
										</tr>

										<tr class="project-overview">
											<?php $rank_career = (isset($candidate) ? $candidate->rank_career : ''); ?>

											<td class="bold"><input type="hidden" id="document_rank_duty" value=""><?php echo _l('rank_career_candidate'); ?></td>
											<td style="color: blue;"><span class="main_rank_career"></span>&nbsp;&nbsp;<span style="color: black;">(<span class="rank_duty"></span>)</span></td>
										</tr>

										<tr class="project-overview">
											<td class="bold"><?php echo _l('rank_other_career'); ?></td>
											<td style="color: blue;"><span class="main_other_rank_career"></span>&nbsp;&nbsp;<span style="color: black;">(<span class="other_rank_duty"></span>)</span></td>
										</tr>

										<tr class="project-overview">
											<td style="color: blue;"><?php echo _l('main_total_rank_career'); ?></td>
											<td style="color: blue;"><span class="main_total_rank_career"></span>&nbsp;&nbsp;</td>
										</tr>

										<!-- <tr class="project-overview">
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr> -->
									</tbody>
								</table>
							</div>

							<div class="row">
								<div class="col-md-12">
									<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('personal_info_emergency'); ?></p>


									<hr class="margin-top-10 general-infor-hr" />
									<div class="col-md-12">
										<div class="col-md-6">
										</div>
										<div class="col-md-6">
											<div id="personalSaveButtonDiv" style="display:none;">
												<button type="submit" id="personalSaveButton" style="margin-bottom: 10px;" class="btn btn-info pull-right"><?php echo _l('Save'); ?></button>
											</div>
										</div>
									</div>

									<div class="col-md-2 padding-left-right-2">
									</div>

									<div class="col-md-5 padding-left-right-0">

										<table class="table border table-striped margin-top-0 project_view_table">
											<tbody>
												<tr class="project-overview">
													<td class="bold"><?php echo _l('personal_info_emergency'); ?></td>
													<td><?php echo _l($candidate->hobby); ?></td>
												</tr>

												<tr class="project-overview">
													<td class="bold"><?php echo _l('email_address'); ?></td>
													<td><?php echo _l($candidate->veterna_relationships); ?></td>
												</tr>



												<tr class="project-overview">
													<td class="bold"><?php echo _l('emergency_contact_number'); ?></td>
													<td><?php echo _l($candidate->emergency_contact_number); ?></td>
												</tr>


												<tr class="project-overview">
													<td class="bold"><?php echo _l('resident'); ?></td>
													<?php $veterna_division = (isset($candidate) ? $candidate->veterna_division : ''); ?>
													<td><?php echo $veterna_division; ?>&nbsp;&nbsp;&nbsp;<?php
																											echo get_select_option_name_by_id('cities_new', $candidate->personal_info_municipality, 'name');
																											?>&nbsp;&nbsp;&nbsp;<?php
																																echo get_select_option_name_by_id('states_new', $candidate->personal_info_province, 'name');
																																?>&nbsp;&nbsp;&nbsp;<?php
																																					echo get_select_option_name_by_id('countries_new', $candidate->personal_info_region, 'name');
																																					?></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="col-md-5 padding-left-right-0">
										<table class="table border table-striped margin-top-0 project_view_table">
											<tbody>

												<tr class="project-overview">
													<td class="bold"><?php echo _l('relationship_to_the_emergency_contact_person'); ?></td>
													<td id="workingEditField"><?php echo _l($candidate->working_clothes); ?></td>
												</tr>


												<tr class="project-overview">
													<td class="bold"><?php echo _l('e_c_other_social_media_acc_link'); ?></td>
													<td id="native_religion_edit"><?php echo _l($candidate->native_religion); ?></td>
												</tr>

												<tr class="project-overview">
													<td class="bold"><?php echo _l('emergency_contact_number_2'); ?></td>
													<td id="veterna_no_edit"><?php echo _l($candidate->veterna_no); ?></td>
												</tr>
											</tbody>
										</table>
									</div>

									<!-- <div class="col-md-12 padding-left-right-2"> -->
									<!-- <hr class="other_infor-hr" /> -->
									<!-- </div> -->


									<!-- </form> -->
								</div>

							</div>

							<!-- Travel and identification document -->
							<div class="col-md-12">
								<div class="row" style="padding: 0;">
									<div class="col-md-12" style="display: flex; padding: 0px; align-items: center; justify-content: space-between;">
										<p style="font-size: 18px; margin-bottom: 5px; background-color: black; color: white; border-radius:.220rem;border-color:black;" class="bold btn btn-info other_infor-style"><?php echo get_option('travel_lable_admin'); ?></p>
										<div class="checkbox checkbox-primary" style="font-size: 18px; margin-bottom: 0;">
											<input type="checkbox" id="view_all_2" name="view_all_2" onchange="candidatetoggleTableRows('travel_info')">
											<label style="font-size: 18px; margin: 0;" for="view_all_2"><?php echo _l('view_all_label'); ?></label>
										</div>
									</div>
								</div>
							</div>

							<hr class="other_infor-hr" />
							<?php if (count($candidate->travel_info) > 0) { ?>
								<table class="table dt-table margin-top-0 travel_info">
									<thead>
										<th><?php echo _l('no'); ?></th>
										<th><?php echo _l('document_type'); ?></th>
										<th><?php echo _l('licence_no'); ?></th>
										<th><?php echo _l('acquisition_date'); ?></th>
										<th><?php echo _l('expiry_date'); ?></th>
										<th><?php echo _l('issue_authority'); ?></th>
										<th><?php echo _l('attach_file'); ?></th>
										<th><?php echo _l('remark'); ?></th>
										<th><?php echo _l('remaining_days'); ?></th>
										<th><?php echo _l('remaining_expiration'); ?></th>
										<th><?php echo _l('Renewal'); ?></th>
										<th><?php echo _l('latest_update'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->travel_info as $wetravel) {

											$expiration = $wetravel['expiration_date'];
											$daysToAdd = (int)$expiration;
											$today = new DateTime();
											$futureDate = $today->modify("+{$daysToAdd} days");
											$expiryDate = DateTime::createFromFormat('Y-m-d', $wetravel['expiry_date']);
											$expiry_date_obj = new DateTime($wetravel['expiry_date']);
											$current_date_obj = new DateTime();
											$interval = $current_date_obj->diff($expiry_date_obj);
											$days_remaining = $interval->days;

											$current_date_obj_new = new DateTime();
											$expiry_date_obj_new = new DateTime($wetravel['expiry_date']);
											$interval_remaining_new = $current_date_obj_new->diff($expiry_date_obj_new);
											$remaining_days_new = $interval_remaining_new->format('%r%a');
											if ($expiry_date_obj_new > $current_date_obj_new) {
												if ($wetravel['expiry_date'] != '') {
													$remaining_days_new += 1;
												} else {
													$remaining_days_new = '';
												}
											}

											$date = new DateTime($wetravel['expiry_date']);
											$date->modify('-' . $wetravel['expiration_date'] . ' days');
											$after_minus_date =  $date->format('Y-m-d');
											$givenDate = new DateTime($after_minus_date);
											$today = new DateTime();

											$interval = $today->diff($givenDate);
											if ($wetravel['expiry_date'] != '') {
												if ($givenDate < $today) {
													$remaining_days = '-' . $interval->days;
												} else {
													$remaining_days = ' ' . ($interval->days + 1);
												}
											} else {
												$remaining_days = '';
											}

											$badgeStyle = 'color: white; cursor:pointer; padding: 5px; border-radius: 6px; display: inline-block; width: 98px; text-align: center;';

											if ($remaining_days_new < 0 && $remaining_days_new != '' && $wetravel['no_expired'] != 1) {
												$expiry_travel_status = 'color: #FF0000';
												$status = '<span style="' . $badgeStyle . ' background-color: #FF0000;">' . _l('expired') . '</span>';
											} elseif ($remaining_days_new > $wetravel['expiration_date']) {
												$expiry_travel_status = 'color: #000000';
												$status = '';
											} elseif ($remaining_days_new > 0 && $remaining_days_new < $wetravel['expiration_date'] && $wetravel['no_expired'] != 1) {
												$expiry_travel_status = 'color: #0000FF';
												$status = '<span style="' . $badgeStyle . ' background-color: #0000FF;">' . _l('alert') . '</span>';
											} else {
												if (
													$wetravel['no_expired'] == 1 &&
													!empty($wetravel['licence_no']) ||
													!empty($wetravel['acquisition_date']) ||
													!empty($wetravel['issue_authority']) ||
													!empty($wetravel['attach_file']) ||
													!empty($wetravel['remark']) ||
													!empty($remaining_days_new)
												) {
													$expiry_travel_status = 'color: #000000';
													$status = '';
												} else {
													$expiry_travel_status = 'color: #CECEBF';
													$status = '';
												}
											}
										?>
											<?php if ($wetravel['display_info'] == '1') { ?>
												<tr class="project-overview-2" data-expiry-status-2="<?php echo $expiry_travel_status; ?>">

													<td class="text-right" style="<?php echo $expiry_travel_status; ?>">
														<?php echo html_entity_decode($wetravel['order_no']); ?>
													</td>
													<td style="<?php echo $expiry_travel_status; ?>">
														<?php echo html_entity_decode($wetravel['document_type']); ?>
													</td>
													<td style="<?php echo $expiry_travel_status; ?>">
														<?php echo $wetravel['licence_no']; ?>
													</td>
													<td style="<?php echo $expiry_travel_status; ?>">
														<?php echo _d($wetravel['acquisition_date']); ?>
													</td>
													<td style="<?php echo $expiry_travel_status; ?>">
														<?php echo _d($wetravel['expiry_date']); ?>
													</td>
													<td style="<?php echo $expiry_travel_status; ?>">
														<?php echo html_entity_decode($wetravel['issue_authority']); ?>
													</td>
													<?php
													$travelfileDir = module_dir_url('recruitment', 'uploads/candidate/travel_file/');
													$travel_filename = $travelfileDir . $wetravel['attach_file'];
													?>
													<td>
														<a style="<?php echo $expiry_travel_status; ?>" href="<?php echo html_entity_decode($travel_filename); ?>" target="_blank"><?php echo html_entity_decode($wetravel['attach_file']); ?></a>
													</td>
													<td style="<?php echo $expiry_travel_status; ?>"><?php echo html_entity_decode($wetravel['remark']); ?></td>
													<?php if ($wetravel['no_expired'] == 1) { ?>
														<td class="text-right" style="<?php echo $expiry_travel_status; ?>"><?php echo _l('no_need'); ?></td>
														<td class="text-right" style="<?php echo $expiry_travel_status; ?>"><?php echo _l('no_need'); ?></td>
													<?php } else { ?>
														<td class="text-right" style="<?php echo $expiry_travel_status; ?>" title="<?php echo _l('remaining_days_title') ?>"><?php echo remainingformatDays($remaining_days_new); ?><br><?php echo $remaining_days_new; ?></td>
														<td class="text-right" title="<?php echo _l('remaining_expiration_title') ?>" style="<?php echo  $expiry_travel_status; ?>"><?php echo remainingformatDays($remaining_days); ?><br><?php echo $remaining_days; ?>&nbsp;&nbsp;<a title="<?php echo _l('days_for_advance_expiration_notice') ?>" style="color: #B9B9C8;"><span>(<span><?php echo $wetravel['expiration_date']; ?><span>)<span></a></td>
													<?php } ?>
													<td>
														<a type="button"
															class="edit_travel_request_renew"
															data-candidate_id="<?php echo $wetravel['candidate']; ?>"
															data-setting_id="<?php echo $wetravel['id']; ?>">
															<?php echo $status; ?>
														</a>
													</td>

													<?php $transaction_details = get_transaction_history($wetravel['candidate'], $wetravel['tr_id']) ?>
													<td><?php echo $transaction_details; ?></td>

													<td class="text-center">
														<a href="Javascript:void(0);" class="edit_travel_info_detail" data-candidate_id="<?php echo $candidate->id; ?>" data-setting_id="<?php echo $wetravel['tr_id']; ?>"><i class="fa fa-edit"></i></a>
													</td>
												</tr>
											<?php } ?>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>

							<!-- End Travel and identification document -->

							<div class="col-md-12" style="padding: 0;">
								<p style="font-size: 18px; margin-bottom: 10px; background-color: black; color: white; border-radius:.220rem;border-color:black;" class="bold btn btn-info other_infor-style"><?php echo _l('school_info'); ?></p>
							</div>

							<hr class="other_infor-hr" />

							<?php if (count($candidate->school) > 0) { ?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('enterance_date'); ?></th>
										<th><?php echo _l('graduation_date'); ?></th>
										<th><?php echo _l('university'); ?></th>
										<th><?php echo _l('school_name'); ?></th>
										<!-- <th><?php //echo _l('faculty'); 
													?></th> -->
										<th><?php echo _l('major_name'); ?></th>
										<th><?php echo _l('year_of_graduation'); ?></th>
										<!-- <th><?php //echo _l('final_academic_career'); 
													?></th> -->
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
												<!-- <td><?php //echo  html_entity_decode($we['faculty']); 
															?></td> -->
												<td><?php echo  html_entity_decode($we['major_name']); ?></td>
												<td><?php echo  html_entity_decode($we['year_of_graduation']); ?></td>

												<!-- <td><?php //echo  html_entity_decode($we['final_academic_career']); 
															?></td> -->
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

							<?php if (get_tab_option('tab_custom_filed_setting_details') == 0 || !get_tab_option('tab_custom_filed_setting_details')) { ?>
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('other_infor'); ?></p>
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
												<td class="bold"><?php echo _l('retired'); ?></td>
												<td><?php echo html_entity_decode($candidate->retired); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('hired_type'); ?></td>
												<td><?php echo html_entity_decode($candidate->hired_type); ?></td>
											</tr>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('employer'); ?></td>
												<td><?php echo html_entity_decode($candidate->employer); ?></td>
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
												<td class="bold"><?php echo _l('emergency'); ?></td>
												<td><?php echo html_entity_decode($candidate->emergency); ?></td>
											</tr>
											<!-- <tr class="project-overview">
											<td> &nbsp;</td>
											<td></td>
										</tr> -->
										</tbody>
									</table>
								</div>

								<div class="row col-md-12">
									<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('work_experience'); ?></p>
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
									<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('literacy'); ?></p>
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
									<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('family_infor'); ?></p>
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
							<?php } ?>
						</div>

						<div role="tabpanel" class="tab-pane" id="personal_info">

							<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('personal_information'); ?></p>

							<!-- <a href="<?php //echo admin_url('recruitment/candidates/' . $candidate->id . '?editsummary=editpersonalinfo') 
											?>" style="margin-top: 14px;" class="btn btn-info pull-right ">Edit</a> -->

							<a href="<?php echo admin_url('recruitment/candidates/' . $candidate->id . '') ?>" style="margin-top: 14px;" class="btn btn-info pull-right ">Edit</a>

							<form method="get" id="emergencyInfoForm" action="<?php echo admin_url('recruitment/emergency_info/' . $candidate->id) ?>">
								<hr class="margin-top-10 general-infor-hr" />
								<div class="col-md-12">

									<div class="col-md-6">

										<div id="emergencySaveButtonDiv" style="display:none;">
											<button type="submit" id="emergencySaveButton" style="margin-bottom: 10px;" class="btn btn-info pull-right"><?php echo _l('Save'); ?></button>
										</div>
									</div>
								</div>

								<div class="col-md-2 padding-left-right-0 margin-top-15" style="padding-right: 10px;">
									<div class="picture-container margin-top-10 pull-left">
										<div class="picture pull-left">
											<img style="width: 100%;" src="<?php if (isset($candidate->avar)) {
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
												<td class="bold"><?php echo _l('full_name'); ?></td>
												<td id="fullnameEditField"><?php echo _l($candidate->candidate_name); ?></td>
												<td id="fullnameSaveField" style="display: none;"> <?php $full_name = (isset($candidate) ? $candidate->candidate_name : '');
																									echo render_input('candidate_name', '', $full_name); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('nationality'); ?></td>
												<td id="nationality_edit"><?php echo _l($candidate->nationality); ?></td>
												<td id="nationality_save" style="display: none;"> <?php $nationality = (isset($candidate) ? $candidate->nationality : '');
																									echo render_input('nationality', '', $nationality); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('birthday'); ?></td>
												<td id="birthday_edit"><?php echo _l($candidate->birthday); ?></td>
												<td id="birthday_save" style="display: none;">
													<?php echo render_date_input('birthday', '', _d($candidate->birthday)); ?>
												</td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('birthplace'); ?></td>
												<td id="email_edit"><?php echo _l($candidate->birthplace); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('marital_status'); ?></td>
												<td id="marital_status_edit"><?php echo _l($candidate->marital_status); ?></td>
												<td id="marital_status_save" style="display: none;">
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
												</td>
											</tr>


											<tr class="project-overview">
												<td class="bold"><?php echo _l('height'); ?></td>
												<td id="height_edit"><?php echo _l($candidate->height); ?></td>
												<td id="height_save" style="display: none;"> <?php $height = (isset($candidate) ? $candidate->height : '');
																								echo render_input('height', '', $height); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('resident'); ?></td>
												<?php $resident = (isset($candidate) ? $candidate->resident : ''); ?>
												<td><?php echo $resident; ?>&nbsp;&nbsp;&nbsp;<?php echo get_select_option_name_by_id('cities_new', $candidate->city, 'name'); ?>&nbsp;&nbsp;&nbsp;<?php echo get_select_option_name_by_id('states_new', $candidate->state, 'name'); ?>&nbsp;&nbsp;&nbsp;<?php echo get_select_option_name_by_id('countries_new', $candidate->address_country, 'name'); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('skype'); ?></td>
												<td id="email_edit"><?php echo _l($candidate->skype); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('facebook'); ?></td>
												<td id="email_edit"><?php echo _l($candidate->facebook); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('linkedin'); ?></td>
												<td id="email_edit"><?php echo _l($candidate->linkedin); ?></td>
											</tr>

										</tbody>
									</table>
								</div>
								<div class="col-md-5 padding-left-right-0">
									<table class="table border table-striped margin-top-0 project_view_table">
										<tbody>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('last_name'); ?></td>
												<td id="lastnameEditField"><?php echo _l($candidate->last_name); ?></td>
												<td id="lastnameSaveField" style="display: none;"> <?php $last_name = (isset($candidate) ? $candidate->last_name : '');
																									echo render_input('last_name', '', $last_name); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('gender'); ?></td>
												<td id="gender_edit"><?php echo _l($candidate->gender); ?></td>
												<td id="gender_save" style="display: none;">
													<select name="gender" id="gender" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>">
														<option value=""></option>
														<option value="male" <?php if (isset($candidate) && $candidate->gender == 'male') {
																					echo 'selected';
																				} ?>><?php echo _l('male'); ?></option>
														<option value="female" <?php if (isset($candidate) && $candidate->gender == 'female') {
																					echo 'selected';
																				} ?>><?php echo _l('female'); ?></option>
													</select>
												</td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('age'); ?></td>
												<td id="birthday_age_edit"><?php echo _l(calculateAge($candidate->birthday)); ?></td>
												<td id="birthday_age_save" style="display: none;">
													<?php echo render_input('age', '', calculateAge(_d($candidate->birthday)), '', array('disabled' => 'true')); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('email'); ?></td>
												<td id="email_edit"><?php echo _l($candidate->email); ?></td>
												<td id="email_save" style="display: none;"> <?php $email = (isset($candidate) ? $candidate->email : '');
																							echo render_input('email', '', $email); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('phonenumber'); ?></td>
												<td id="phonenumber_edit"><?php echo _l($candidate->phonenumber); ?></td>
												<td id="phonenumber_save" style="display: none;"> <?php $phonenumber = (isset($candidate) ? $candidate->phonenumber : '');
																									echo render_input('phonenumber', '', $phonenumber); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('weight'); ?></td>
												<td id="weight_edit"><?php echo _l($candidate->weight); ?></td>
												<td id="weight_save" style="display: none;"> <?php $weight = (isset($candidate) ? $candidate->weight : '');
																								echo render_input('weight', '', $weight); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('speciality'); ?></td>
												<td><?php echo _l($candidate->speciality); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('interests'); ?></td>
												<td><?php echo _l($candidate->interests); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('current_accommodation'); ?></td>
												<td><?php echo _l($candidate->current_accommodation); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('introduce_yourself'); ?></td>
												<td><?php echo _l($candidate->introduce_yourself); ?></td>
											</tr>
											<tr class="project-overview">
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</tbody>
									</table>
								</div>
							</form>

							<div class="row">

								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('personal_info_emergency'); ?></p>

								<hr class="margin-top-10 general-infor-hr" />
								<div class="col-md-12">
									<div class="col-md-6">
									</div>
									<div class="col-md-6">
										<div id="personalSaveButtonDiv" style="display:none;">
											<button type="submit" id="personalSaveButton" style="margin-bottom: 10px;" class="btn btn-info pull-right"><?php echo _l('Save'); ?></button>
										</div>
									</div>
								</div>

								<div class="col-md-2 padding-left-right-2">
								</div>

								<div class="col-md-5 padding-left-right-0">

									<table class="table border table-striped margin-top-0 project_view_table">
										<tbody>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('personal_info_emergency'); ?></td>
												<td><?php echo _l($candidate->hobby); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('email_address'); ?></td>
												<td><?php echo _l($candidate->veterna_relationships); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('emergency_contact_number'); ?></td>
												<td><?php echo _l($candidate->emergency_contact_number); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('resident'); ?></td>
												<?php $veterna_division = (isset($candidate) ? $candidate->veterna_division : ''); ?>
												<td><?php echo $veterna_division; ?>&nbsp;&nbsp;&nbsp;<?php
																										echo get_select_option_name_by_id('cities_new', $candidate->personal_info_municipality, 'name');
																										?>&nbsp;&nbsp;&nbsp;<?php
																															echo get_select_option_name_by_id('states_new', $candidate->personal_info_province, 'name');
																															?>&nbsp;&nbsp;&nbsp;<?php
																																				echo get_select_option_name_by_id('countries_new', $candidate->personal_info_region, 'name'); ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-5 padding-left-right-0">
									<table class="table border table-striped margin-top-0 project_view_table">
										<tbody>
											<tr class="project-overview">
												<td class="bold"><?php echo _l('relationship_to_the_emergency_contact_person'); ?></td>
												<td><?php echo _l($candidate->working_clothes); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('e_c_other_social_media_acc_link'); ?></td>
												<td><?php echo _l($candidate->native_religion); ?></td>
											</tr>

											<tr class="project-overview">
												<td class="bold"><?php echo _l('emergency_contact_number_2'); ?></td>
												<td id="veterna_no_edit"><?php echo _l($candidate->veterna_no); ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<!-- <div class="col-md-12 padding-left-right-2"> -->
							<!-- <hr class="other_infor-hr" /> -->
							<!-- </div> -->

							<div class="col-md-6 padding-left-right-2">
								<table class="table border table-striped margin-top-0 project_view_table">
									<tbody>

										<tr class="project-overview hide">
											<td class="bold"><?php echo _l('present_resident_kor'); ?></td>
											<td id="present_resident_kor_edit"><?php echo _l($candidate->present_resident_kor); ?></td>
											<td id="present_resident_kor_save" style="display: none;"> <?php
																										$rows = [];
																										$rows['rows'] = 4;
																										$present_resident_kor = (isset($candidate) ? $candidate->present_resident_kor : '');
																										echo render_textarea('present_resident_kor', '', $present_resident_kor, $rows) ?>
											</td>
										</tr>
										<tr class="project-overview hide">
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
										<!-- <tr class="project-overview">
												<td class="bold"><?php // echo _l('email'); 
																	?></td>
												<td id="email_edit"><?php // echo _l($candidate->email); 
																	?></td>
												<td id="email_save" style="display: none;"> <?php // $email = (isset($candidate) ? $candidate->email : '');
																							//	echo render_input('email', '', $email); 
																							?></td>
											</tr> -->
									</tbody>
								</table>
							</div>
							<!-- </form> -->

							<div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('school_information'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addSchoolinfoModal"><?php echo _l('Add'); ?></button>
								<hr class="other_infor-hr" />
								<?php if (count($candidate->school) > 0) { ?>
									<table class="table dt-table margin-top-0">
										<thead>
											<th><?php echo _l('enterance_date'); ?></th>
											<th><?php echo _l('graduation_date'); ?></th>
											<th><?php echo _l('university'); ?></th>
											<th><?php echo _l('school_name'); ?></th>
											<!-- <th><?php //echo _l('faculty'); 
														?></th> -->
											<th><?php echo _l('major_name'); ?></th>
											<th><?php echo _l('year_of_graduation'); ?></th>
											<!-- <th><?php //echo _l('final_academic_career'); 
														?></th> -->
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
													<!-- <td><?php //echo  html_entity_decode($we['faculty']); 
																?></td> -->
													<td><?php echo  html_entity_decode($we['major_name']); ?></td>
													<td><?php echo  html_entity_decode($we['year_of_graduation']); ?></td>

													<!-- <td><?php //echo  html_entity_decode($we['final_academic_career']); 
																?></td> -->
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

							<div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('family_information'); ?></p>

								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addFamilyinfoModal"><?php echo _l('Add'); ?></button>

								<hr class="other_infor-hr" />

								<?php if (count($candidate->family_info) > 0) { ?>
									<table class="table dt-table margin-top-0">
										<thead>
											<th><?php echo _l('family_name'); ?></th>
											<th><?php echo _l('family_religion'); ?></th>
											<th><?php echo _l('id_no'); ?></th>
											<th><?php echo _l('birthday'); ?></th>
											<th><?php echo _l('age'); ?></th>
											<th><?php echo _l('final_academy_career'); ?></th>
											<th><?php echo _l('school'); ?></th>
											<th><?php echo _l('major'); ?></th>
											<!-- <th><?php //echo _l('company'); 
														?></th> -->
											<th><?php echo _l('position'); ?></th>
											<!-- <th><?php //echo _l('grade'); 
														?></th> -->
											<!-- <th><?php //echo _l('basic_deduction'); 
														?></th> -->
											<!-- <th><?php //echo _l('child_bearing'); 
														?></th> -->
											<th><?php echo _l('contact_number'); ?></th>
											<th><?php echo _l('contact_number2'); ?></th>
											<th><?php echo _l('action'); ?></th>
										</thead>
										<tbody>
											<?php foreach ($candidate->family_info as $we) { ?>
												<tr class="project-overview">
													<td><?php echo html_entity_decode($we['family_name']); ?></td>
													<td><?php echo get_select_option_name_by_id('job_relation_filed', $we['family_religion'], 'relation_name'); ?></td>
													<td><?php echo get_select_option_name_by_id('job_marital_status', $we['id_no'], 'marital_status_name'); ?></td>
													<td><?php echo _d($we['birthday']); ?></td>
													<td><?php echo html_entity_decode(calculateAge($we['birthday'])); ?></td>
													<td><?php echo html_entity_decode($we['final_academy_career']); ?></td>
													<td><?php echo html_entity_decode(_l($we['school'])); ?></td>
													<td><?php echo html_entity_decode($we['major']); ?></td>
													<!-- <td><?php //echo html_entity_decode($we['company']); 
																?></td> -->
													<td><?php echo html_entity_decode($we['position']); ?></td>
													<!-- <td><?php //echo html_entity_decode($we['grade']); 
																?></td>
												<td><?php //echo html_entity_decode($we['basic_deduction']); 
													?></td>
												<td><?php //echo html_entity_decode($we['child_bearing']); 
													?></td> -->
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
						</div>

						<div role="tabpanel" class="tab-pane" id="education_info">
							<div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('eduaction_info'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addEducationinfoModal"><?php echo _l('Add'); ?></button>
								<hr class="other_infor-hr" />
							</div>

							<?php if (count($candidate->education) > 0) { ?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php echo _l('year_number'); ?></th>
										<th><?php echo _l('year'); ?></th>
										<th><?php echo _l('course_type'); ?></th>
										<th><?php echo _l('course_name'); ?></th>
										<th><?php echo _l('edu_start_date'); ?></th>
										<th><?php echo _l('edu_finish_date'); ?></th>
										<th><?php echo _l('edu_date'); ?></th>
										<!-- <th><?php //echo _l('valid_date'); 
													?></th> -->
										<th><?php echo _l('edu_institution'); ?></th>
										<th><?php echo _l('completed_edu'); ?></th>
										<th><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php $counter = 1; ?>
										<?php foreach ($candidate->education as $we) { ?>
											<tr class="project-overview">
												<td><?php echo $counter++; ?></td>
												<td>
													<?php
													echo html_entity_decode($we['year']);
													?>
												</td>
												<td>
													<?php echo get_select_option_name_by_id('job_course', $we['course_type'], 'course_name'); ?>
												</td>
												<!-- <td><?php //echo html_entity_decode($we['course_type']); 
															?></td> -->
												<td><?php echo html_entity_decode($we['course_name']); ?></td>
												<td><?php echo _d($we['edu_start_date']); ?></td>
												<td><?php echo _d($we['edu_finish_date']); ?></td>
												<td><?php echo html_entity_decode($we['edu_date']); ?></td>
												<!-- <td><?php //echo _d($we['valid_date']); 
															?></td> -->
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

						<?php if (get_tab_option('recruitment_create_campaign_tab_reward') == 1) { ?>
							<div role="tabpanel" class="tab-pane" id="reward_info">
								<div class="col-md-12">

									<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('reward_info'); ?></p>

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
									<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('medical_info'); ?></p>
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
													<td class="text-center">
														<a href="Javascript:void(0);" class="edit_medical_info_detail" data-id="<?php echo $we['id']; ?>">
															<i class="fa fa-edit"></i>
														</a>&nbsp;
														<a href="Javascript:void(0);" class="edit_medical_info_detail_delete" data-id="<?php echo $we['id']; ?>">
															<i style="color: red;" class="fa fa-trash"></i>
														</a>
													</td>
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

							<!-- Travel and identification document -->
							<div class="col-md-12" style="padding: 0;">
								<div style="display: flex; align-items: center; justify-content: space-between;">
									<p style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;" class="bold btn btn-info other_infor-style"><?php echo get_option('travel_lable_admin'); ?></p>
									<div class="checkbox checkbox-primary" style="font-size: 18px; margin-bottom: 0;">
										<input type="checkbox" id="view_all" name="view_all" onchange="toggleTableRows('travel_document')">
										<label style="font-size: 18px; margin: 0;" for="view_all"><?php echo _l('view_all_label'); ?></label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addTravelinfoModal"><?php echo _l('Add'); ?></button>
									</div>
								</div>
							</div>

							<hr class="other_infor-hr" />
							<?php if (count($candidate->travel_info) > 0) { ?>
								<table class="table dt-table  margin-top-0 travel_document">
									<thead>
										<th width="3%"><?php echo _l('no'); ?></th>
										<th width="15%"><?php echo _l('document_type'); ?></th>
										<th width="16%"><?php echo _l('licence_no'); ?></th>
										<th width="4%"><?php echo _l('acquisition_date'); ?></th>
										<th width="4%"><?php echo _l('expiry_date'); ?></th>
										<th width="9%"><?php echo _l('issue_authority'); ?></th>
										<th width="2%"><?php echo _l('attach_file'); ?></th>
										<th width="8%"><?php echo _l('remark'); ?></th>
										<th width="6%"><?php echo _l('remaining_days'); ?></th>
										<th width="6%"><?php echo _l('remaining_expiration'); ?></th>
										<th width="10%"><?php echo _l('Renewal'); ?></th>
										<th width="10%"><?php echo _l('latest_update'); ?></th>
										<th width="2%"><?php echo _l('hideexpire'); ?></th>
										<th width="5%"><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->travel_info as $wetravel) {

											$expiration = $wetravel['expiration_date'];
											$daysToAdd = (int)$expiration;
											$today = new DateTime();
											$futureDate = $today->modify("+{$daysToAdd} days");
											$expiryDate = DateTime::createFromFormat('Y-m-d', $wetravel['expiry_date']);
											$expiry_date_obj = new DateTime($wetravel['expiry_date']);
											$current_date_obj = new DateTime();
											$interval = $current_date_obj->diff($expiry_date_obj);
											$days_remaining = $interval->days;

											$current_date_obj_new = new DateTime();
											$expiry_date_obj_new = new DateTime($wetravel['expiry_date']);
											$interval_remaining_new = $current_date_obj_new->diff($expiry_date_obj_new);
											$remaining_days_new = $interval_remaining_new->format('%r%a');
											if ($expiry_date_obj_new > $current_date_obj_new) {
												if ($wetravel['expiry_date'] != '') {
													$remaining_days_new += 1;
												} else {
													$remaining_days_new = '';
												}
											}

											$date = new DateTime($wetravel['expiry_date']);
											$date->modify('-' . $wetravel['expiration_date'] . ' days');
											$after_minus_date =  $date->format('Y-m-d');
											$givenDate = new DateTime($after_minus_date);
											$today = new DateTime();

											$interval = $today->diff($givenDate);
											if ($wetravel['expiry_date'] != '') {
												if ($givenDate < $today) {
													$remaining_days = '-' . $interval->days;
												} else {
													$remaining_days = ' ' . ($interval->days + 1);
												}
											} else {
												$remaining_days = '';
											}

											$badgeStyle = 'color: white; cursor:pointer; padding: 5px; border-radius: 6px; display: inline-block; width: 98px; text-align: center;';

											if ($remaining_days_new < 0 && $remaining_days_new != '' && $wetravel['no_expired'] != 1) {
												$expiry_travel_status = 'color: #FF0000';
												$status = '<span class="pull-left mright5" style="' . $badgeStyle . ' background-color: #FF0000;">' . _l('expired') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_candidate" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_candidate(' . $wetravel['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="crew_call" style="display:none;"><a style="padding: 2px 10px 3px 10px; href="#" onclick="crew_call(' . $wetravel['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_test" style="display:none;"><a style="padding: 2px 10px 3px 10px; href="#" onclick="crew_test(' . $wetravel['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px; href="#" onclick="crew_interview(' . $wetravel['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} elseif ($remaining_days_new > $wetravel['expiration_date']) {
												$expiry_travel_status = 'color: #000000';
												$status = '';
											} elseif ($remaining_days_new > 0 && $remaining_days_new < $wetravel['expiration_date'] && $wetravel['no_expired'] != 1) {
												$expiry_travel_status = 'color: #0000FF';
												$status = '<span  class="pull-left mright5" style="' . $badgeStyle . ' background-color: #0000FF;">' . _l('alert') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_candidate" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_candidate(' . $wetravel['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="crew_call" style="display:none;"><a style="padding: 2px 10px 3px 10px; href="#" onclick="crew_call(' . $wetravel['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_test" style="display:none;"><a style="padding: 2px 10px 3px 10px; href="#" onclick="crew_test(' . $wetravel['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px; href="#" onclick="crew_interview(' . $wetravel['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} else {
												if (
													$wetravel['no_expired'] == 1 &&
													!empty($wetravel['licence_no']) ||
													!empty($wetravel['acquisition_date']) ||
													!empty($wetravel['issue_authority']) ||
													!empty($wetravel['attach_file']) ||
													!empty($wetravel['remark']) ||
													!empty($remaining_days_new)
												) {
													$expiry_travel_status = 'color: #000000';
													$status = '';
												} else {
													$expiry_travel_status = 'color: #CECEBF';
													$status = '';
												}
											}
										?>

											<tr class="project-overview <?php echo ($wetravel['hideexpire'] == 1) ? 'hidden-expire1' : ''; ?>" data-expiry-status="<?php echo $expiry_travel_status; ?>">

												<td class="text-right" style="<?php echo $expiry_travel_status; ?>">
													<?php echo html_entity_decode($wetravel['order_no']); ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>">
													<?php echo html_entity_decode($wetravel['document_type']); ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>">
													<?php echo $wetravel['licence_no']; ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>">
													<?php echo _d($wetravel['acquisition_date']); ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>">
													<?php echo _d($wetravel['expiry_date']); ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>">
													<?php echo html_entity_decode($wetravel['issue_authority']); ?>
												</td>
												<?php
												$travelfileDir = module_dir_url('recruitment', 'uploads/candidate/travel_file/');
												$travel_filename = $travelfileDir . $wetravel['attach_file'];
												?>
												<td>
													<?php if ($wetravel['attach_file']) { ?>
														<a style="<?php echo $expiry_travel_status; ?>" href="<?php echo html_entity_decode($travel_filename); ?>" target="_blank"><i title="<?php echo html_entity_decode($wetravel['attach_file']); ?>" class="fa-solid fa-file"></i></a>
													<?php } ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>"><?php echo html_entity_decode($wetravel['remark']); ?></td>

												<?php if ($wetravel['no_expired'] == 1) { ?>
													<td class="text-right" style="<?php echo $expiry_travel_status; ?>"><?php echo _l('no_need'); ?></td>
													<td class="text-right" style="<?php echo $expiry_travel_status; ?>"><?php echo _l('no_need'); ?></td>
												<?php } else { ?>
													<td class="text-right" style="<?php echo $expiry_travel_status; ?>" title="<?php echo _l('remaining_days_title') ?>"><?php echo remainingformatDays($remaining_days_new); ?><br><?php echo $remaining_days_new; ?></td>
													<td class="text-right" title="<?php echo _l('remaining_expiration_title') ?>" style="<?php echo  $expiry_travel_status; ?>"><?php echo remainingformatDays($remaining_days); ?><br><?php echo $remaining_days; ?>&nbsp;&nbsp;<a title="<?php echo _l('days_for_advance_expiration_notice') ?>" style="color: #B9B9C8;"><span>(<span><?php echo $wetravel['expiration_date']; ?><span>)<span></a></td>
												<?php } ?>

												<td><?php echo html_entity_decode($status); ?></td>

												<?php $transaction_details = get_transaction_history($candidate->id, $wetravel['tr_id']) ?>
												<td><?php echo $transaction_details; ?></td>
												<?php
												$hidestatus = '';

												if ($wetravel['hideexpire'] == 1) {
													$hidestatus = 'Yes';
												} else {
													$hidestatus = '';
												}
												?>

												<td><?php echo html_entity_decode($hidestatus); ?></td>

												<td class="text-center">
													<!-- <a title="<?php //echo _l('view_transaction')
																	?>" href="Javascript:void(0);" class="btn btn-info pull-left display-block mright5 crew_sorting_data"  style="padding: 2px 10px 3px 10px;" data-type="Candidate Send Mail">
														<i class="fa fa-eye"></i>
													</a> -->
													<a href="Javascript:void(0);" class="edit_travel_info_detail" data-candidate_id="<?php echo $candidate->id; ?>" data-setting_id="<?php echo $wetravel['tr_id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="travel_info_detail_delete" data-id="<?php echo $wetravel['tr_id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>
							<!-- End Travel and identification document -->

							<!-- other licence -->
							<div class="col-md-12" style="padding: 0;">
								<div style="display: flex; align-items: center; justify-content: space-between;">
									<p style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;" class="bold btn btn-info other_infor-style"><?php echo get_option('other_licence_lable_admin'); ?></p>
									<div class="checkbox checkbox-primary" style="font-size: 18px; margin-bottom: 0;">
										<input type="checkbox" id="view_all_other_licence" name="view_all" onchange="otherlicencetoggleTableRows('other_licence_document')">
										<label style="font-size: 18px; margin: 0;" for="view_all_other_licence"><?php echo _l('view_all_other_label'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addotherLicenceinfoModal"><?php echo _l('Add'); ?></button>
									</div>
								</div>
							</div>

							<hr class="other_infor-hr" />

							<?php if (count($candidate->other_licence_info) > 0) { ?>
								<table class="table dt-table  margin-top-0 other_licence_document">
									<thead>
										<!-- <th width="2%"><?php //echo _l('no'); 
															?></th>
										<th width="15%"><?php //echo _l('document_type'); 
														?></th>
										<th width="5%"><?php //echo _l('licence_no'); 
														?></th>
										<th><?php //echo _l('acquisition_date'); 
											?></th>
										<th><?php //echo _l('expiry_date'); 
											?></th>
										<th width="5%"><?php //echo _l('issue_authority'); 
														?></th> -->

										<th width="3%"><?php echo _l('no'); ?></th>
										<th width="15%"><?php echo _l('document_type'); ?></th>
										<th width="16%"><?php echo _l('licence_no'); ?></th>
										<th width="4%"><?php echo _l('acquisition_date'); ?></th>
										<th width="4%"><?php echo _l('expiry_date'); ?></th>
										<th width="9%"><?php echo _l('issue_authority'); ?></th>
										<th width="2%"><?php echo _l('attach_file'); ?></th>
										<th width="8%"><?php echo _l('remark'); ?></th>
										<th width="6%"><?php echo _l('remaining_days'); ?></th>
										<th width="6%"><?php echo _l('remaining_expiration'); ?></th>
										<th width="10%"><?php echo _l('Renewal'); ?></th>
										<th width="10%"><?php echo _l('latest_update'); ?></th>
										<th width="2%"><?php echo _l('hideexpire'); ?></th>
										<th width="5%"><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->other_licence_info as $weotherlicence) {

											$expiration = $weotherlicence['expiration_date'];
											$daysToAdd = (int)$expiration;
											$today = new DateTime();
											$futureDate = $today->modify("+{$daysToAdd} days");
											$expiryDate = DateTime::createFromFormat('Y-m-d', $weotherlicence['expiry_date']);
											$expiry_date_obj = new DateTime($weotherlicence['expiry_date']);
											$current_date_obj = new DateTime();
											$interval = $current_date_obj->diff($expiry_date_obj);
											$days_remaining = $interval->days;

											$current_date_obj_new = new DateTime();
											$expiry_date_obj_new = new DateTime($weotherlicence['expiry_date']);
											$interval_remaining_new = $current_date_obj_new->diff($expiry_date_obj_new);
											$remaining_days_new = $interval_remaining_new->format('%r%a');
											if ($expiry_date_obj_new > $current_date_obj_new) {
												if ($weotherlicence['expiry_date'] != '') {
													$remaining_days_new += 1;
												} else {
													$remaining_days_new = '';
												}
											}

											$date = new DateTime($weotherlicence['expiry_date']);
											$date->modify('-' . $weotherlicence['expiration_date'] . ' days');
											$after_minus_date =  $date->format('Y-m-d');
											$givenDate = new DateTime($after_minus_date);
											$today = new DateTime();

											$interval = $today->diff($givenDate);
											if ($weotherlicence['expiry_date'] != '') {
												if ($givenDate < $today) {
													$remaining_days = '-' . $interval->days;
												} else {
													$remaining_days = ' ' . ($interval->days + 1);
												}
											} else {
												$remaining_days = '';
											}

											$badgeStyle = 'color: white; cursor:pointer; padding: 5px; border-radius: 6px; display: inline-block; width: 98px; text-align: center;';

											if ($remaining_days_new < 0 && $remaining_days_new != '' && $weotherlicence['no_expired'] != 1) {
												$expiry_travel_status = 'color: #FF0000';
												$status = '<span class="pull-left mright5" style="' . $badgeStyle . ' background-color: #FF0000;">' . _l('expired') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_other_license" style="display:none;"><a  style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_other_license(' . $weotherlicence['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div style="display:none;" class="other_licence_call" ><a  style="padding: 2px 10px 3px 10px; href="#" onclick="other_licence_call(' . $weotherlicence['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_license_test" style="display:none;"><a style="padding: 2px 10px 3px 10px; href="#" onclick="crew_license_test(' . $weotherlicence['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_license_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px; href="#" onclick="crew_license_interview(' . $weotherlicence['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} elseif ($remaining_days_new > $weotherlicence['expiration_date']) {
												$expiry_travel_status = 'color: #000000';
												$status = '';
											} elseif ($remaining_days_new > 0 && $remaining_days_new < $weotherlicence['expiration_date'] && $weotherlicence['no_expired'] != 1) {
												$expiry_travel_status = 'color: #0000FF';
												$status = '<span  class="pull-left mright5" style="' . $badgeStyle . ' background-color: #0000FF;">' . _l('alert') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_other_license" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_other_license(' . $weotherlicence['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="other_licence_call" style="display:none;"><a  style="padding: 2px 10px 3px 10px; href="#" onclick="other_licence_call(' . $weotherlicence['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_license_test" style="display:none;"><a style="padding: 2px 10px 3px 10px; href="#" onclick="crew_license_test(' . $weotherlicence['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_license_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px; href="#" onclick="crew_license_interview(' . $weotherlicence['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} else {
												if (
													$weotherlicence['no_expired'] == 1 &&
													!empty($weotherlicence['licence_no']) ||
													!empty($weotherlicence['acquisition_date']) ||
													!empty($weotherlicence['issue_authority']) ||
													!empty($weotherlicence['attach_file']) ||
													!empty($weotherlicence['remark']) ||
													!empty($remaining_days_new)
												) {
													$expiry_travel_status = 'color: #000000';
													$status = '';
												} else {
													$expiry_travel_status = 'color: #CECEBF';
													$status = '';
												}
											}
										?>
											<tr class="project-overview-3 <?php echo ($weotherlicence['hideexpire'] == 1) ? 'hidden-expire2' : ''; ?>" data-expiry-status="<?php echo $expiry_travel_status; ?>">

												<td class="text-right" style="<?php echo $expiry_travel_status; ?>">
													<?php echo html_entity_decode($weotherlicence['order_no']); ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>">
													<?php echo html_entity_decode($weotherlicence['document_type']); ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>">
													<?php echo $weotherlicence['licence_no']; ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>">
													<?php echo _d($weotherlicence['acquisition_date']); ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>">
													<?php echo _d($weotherlicence['expiry_date']); ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>">
													<?php echo html_entity_decode($weotherlicence['issue_authority']); ?>
												</td>
												<?php
												$otherlicencefileDir = module_dir_url('recruitment', 'uploads/candidate/other_licence_file/');
												$travel_filename = $otherlicencefileDir . $weotherlicence['attach_file'];
												?>
												<td>
													<?php if ($weotherlicence['attach_file']) { ?>
														<a style="<?php echo $expiry_travel_status; ?>" href="<?php echo html_entity_decode($travel_filename); ?>" target="_blank"><i title="<?php echo html_entity_decode($weotherlicence['attach_file']); ?>" class="fa-solid fa-file"></i></a>
													<?php } ?>
												</td>
												<td style="<?php echo $expiry_travel_status; ?>"><?php echo html_entity_decode($weotherlicence['remark']); ?></td>

												<?php if ($weotherlicence['no_expired'] == 1) { ?>
													<td class="text-right" style="<?php echo $expiry_travel_status; ?>"><?php echo _l('no_need'); ?></td>
													<td class="text-right" style="<?php echo $expiry_travel_status; ?>"><?php echo _l('no_need'); ?></td>
												<?php } else { ?>
													<td class="text-right" style="<?php echo $expiry_travel_status; ?>" title="<?php echo _l('remaining_days_title') ?>"><?php echo remainingformatDays($remaining_days_new); ?><br><?php echo $remaining_days_new; ?></td>
													<td class="text-right" title="<?php echo _l('remaining_expiration_title') ?>" style="<?php echo  $expiry_travel_status; ?>"><?php echo remainingformatDays($remaining_days); ?><br><?php echo $remaining_days; ?>&nbsp;&nbsp;<a title="<?php echo _l('days_for_advance_expiration_notice') ?>" style="color: #B9B9C8;"><span>(<span><?php echo $weotherlicence['expiration_date']; ?><span>)<span></a></td>
												<?php } ?>


												<td><?php echo html_entity_decode($status); ?></td>

												<?php $transaction_details = get_transaction_license_history($candidate->id, $weotherlicence['tr_id']) ?>
												<td><?php echo $transaction_details; ?></td>
												<?php
												$hidestatus = '';

												if ($weotherlicence['hideexpire'] == 1) {
													$hidestatus = 'Yes';
												} else {
													$hidestatus = '';
												}
												?>

												<td><?php echo html_entity_decode($hidestatus); ?></td>
												<td class="text-center">
													<a href="Javascript:void(0);" class="edit_other_licence_info_detail" data-candidate_id="<?php echo $candidate->id; ?>" data-setting_id="<?php echo $weotherlicence['tr_id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="license_2_detail_delete" data-id="<?php echo $weotherlicence['tr_id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>

							<!-- End other licence -->

							<!-- licence 3 -->

							<div class="col-md-12" style="padding: 0;">
								<div style="display: flex; align-items: center; justify-content: space-between;">
									<p style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;" class="bold btn btn-info other_infor-style"><?php echo get_option('licence_3_lable_admin'); ?></p>
									<div class="checkbox checkbox-primary" style="font-size: 18px; margin-bottom: 0;">
										<!-- <input type="checkbox" id="view_hidden_3" name="view_hidden_3">
										<label style="font-size: 18px; margin: 0;" for="view_hidden_3"><?php //echo _l('view_hidden_label'); 
																										?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
										<input type="checkbox" id="view_all_licence_3" name="view_all" onchange="licence3toggleTableRows('licence_3_document')">
										<label style="font-size: 18px; margin: 0;" for="view_all_licence_3"><?php echo _l('view_all_licence_3_label'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addLicence3infoModal"><?php echo _l('Add'); ?></button>
									</div>
								</div>
							</div>

							<hr class="other_infor-hr" />

							<?php if (count($candidate->rec_licence_3) > 0) { ?>
								<table class="table dt-table  margin-top-0 licence_3_document">
									<thead>
										<th width="3%"><?php echo _l('no'); ?></th>
										<th width="15%"><?php echo _l('document_type'); ?></th>
										<th width="16%"><?php echo _l('licence_no'); ?></th>
										<th width="4%"><?php echo _l('acquisition_date'); ?></th>
										<th width="4%"><?php echo _l('expiry_date'); ?></th>
										<th width="9%"><?php echo _l('issue_authority'); ?></th>
										<th width="2%"><?php echo _l('attach_file'); ?></th>
										<th width="8%"><?php echo _l('remark'); ?></th>
										<th width="6%"><?php echo _l('remaining_days'); ?></th>
										<th width="6%"><?php echo _l('remaining_expiration'); ?></th>
										<th width="10%"><?php echo _l('Renewal'); ?></th>
										<th width="10%"><?php echo _l('latest_update'); ?></th>
										<th width="2%"><?php echo _l('hideexpire'); ?></th>
										<th width="5%"><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->rec_licence_3 as $welicence_3) {

											$expiration = $welicence_3['expiration_date'];
											$daysToAdd = (int)$expiration;
											$today = new DateTime();
											$futureDate = $today->modify("+{$daysToAdd} days");
											$expiryDate = DateTime::createFromFormat('Y-m-d', $welicence_3['expiry_date']);
											$expiry_date_obj = new DateTime($welicence_3['expiry_date']);
											$current_date_obj = new DateTime();
											$interval = $current_date_obj->diff($expiry_date_obj);
											$days_remaining = $interval->days;

											$current_date_obj_new = new DateTime();
											$expiry_date_obj_new = new DateTime($welicence_3['expiry_date']);
											$interval_remaining_new = $current_date_obj_new->diff($expiry_date_obj_new);
											$remaining_days_new = $interval_remaining_new->format('%r%a');
											if ($expiry_date_obj_new > $current_date_obj_new) {
												if ($welicence_3['expiry_date'] != '') {
													$remaining_days_new += 1;
												} else {
													$remaining_days_new = '';
												}
											}

											$date = new DateTime($welicence_3['expiry_date']);
											$date->modify('-' . $welicence_3['expiration_date'] . ' days');
											$after_minus_date =  $date->format('Y-m-d');
											$givenDate = new DateTime($after_minus_date);
											$today = new DateTime();

											$interval = $today->diff($givenDate);
											if ($welicence_3['expiry_date'] != '') {
												if ($givenDate < $today) {
													$remaining_days = '-' . $interval->days;
												} else {
													$remaining_days = ' ' . ($interval->days + 1);
												}
											} else {
												$remaining_days = '';
											}

											$badgeStyle = 'color: white; cursor:pointer; padding: 5px; border-radius: 6px; display: inline-block; width: 98px; text-align: center;';

											if ($remaining_days_new < 0 && $remaining_days_new != '' && $welicence_3['no_expired'] != 1) {
												$expiry_licenece_3_status = 'color: #FF0000';
												$status = '<span class="pull-left mright5" style="' . $badgeStyle . ' background-color: #FF0000;">' . _l('expired') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_licence_3" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_licence_3(' . $welicence_3['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="call_licence_3" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="call_licence_3(' . $welicence_3['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_licence_3_test" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_3_test(' . $welicence_3['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_licence_3_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_3_interview(' . $welicence_3['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} elseif ($remaining_days_new > $welicence_3['expiration_date']) {
												$expiry_licenece_3_status = 'color: #000000';
												$status = '';
											} elseif ($remaining_days_new > 0 && $remaining_days_new < $welicence_3['expiration_date'] && $welicence_3['no_expired'] != 1) {
												$expiry_licenece_3_status = 'color: #0000FF';
												$status = '<span class="pull-left mright5" style="' . $badgeStyle . ' background-color: #0000FF;">' . _l('alert') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_licence_3" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_licence_3(' . $welicence_3['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="call_licence_3" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="call_licence_3(' . $welicence_3['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_licence_3_test" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_3_test(' . $welicence_3['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_licence_3_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_3_interview(' . $welicence_3['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} else {
												if (
													$welicence_3['no_expired'] == 1 &&
													!empty($welicence_3['licence_no']) ||
													!empty($welicence_3['acquisition_date']) ||
													!empty($welicence_3['issue_authority']) ||
													!empty($welicence_3['attach_file']) ||
													!empty($welicence_3['remark']) ||
													!empty($remaining_days_new)
												) {
													$expiry_licenece_3_status = 'color: #000000';
													$status = '';
												} else {
													$expiry_licenece_3_status = 'color: #CECEBF';
													$status = '';
												}
											}
										?>
											<tr class="project-overview-4 <?php echo ($welicence_3['hideexpire'] == 1) ? 'hidden-expire3' : ''; ?>" data-expiry-status="<?php echo $expiry_licenece_3_status; ?>">

												<td class="text-right" style="<?php echo $expiry_licenece_3_status; ?>">
													<?php echo html_entity_decode($welicence_3['order_no']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_3_status; ?>">
													<?php echo html_entity_decode($welicence_3['document_type']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_3_status; ?>">
													<?php echo $welicence_3['licence_no']; ?>
												</td>
												<td style="<?php echo $expiry_licenece_3_status; ?>">
													<?php echo _d($welicence_3['acquisition_date']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_3_status; ?>">
													<?php echo _d($welicence_3['expiry_date']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_3_status; ?>">
													<?php echo html_entity_decode($welicence_3['issue_authority']); ?>
												</td>
												<?php
												$otherlicencefileDir = module_dir_url('recruitment', 'uploads/candidate/licence_3_file/');
												$travel_filename = $otherlicencefileDir . $welicence_3['attach_file'];
												?>
												<td>
													<?php if ($welicence_3['attach_file']) { ?>
														<a style="<?php echo $expiry_licenece_3_status; ?>" href="<?php echo html_entity_decode($travel_filename); ?>" target="_blank"><i title="<?php echo html_entity_decode($welicence_3['attach_file']); ?>" class="fa-solid fa-file"></i></a>
													<?php } ?>
												</td>
												<td style="<?php echo $expiry_licenece_3_status; ?>"><?php echo html_entity_decode($welicence_3['remark']); ?></td>

												<?php if ($welicence_3['no_expired'] == 1) { ?>
													<td class="text-right" style="<?php echo $expiry_licenece_3_status; ?>"><?php echo _l('no_need'); ?></td>
													<td class="text-right" style="<?php echo $expiry_licenece_3_status; ?>"><?php echo _l('no_need'); ?></td>
												<?php } else { ?>
													<td class="text-right" style="<?php echo $expiry_licenece_3_status; ?>" title="<?php echo _l('remaining_days_title') ?>"><?php echo remainingformatDays($remaining_days_new); ?><br><?php echo $remaining_days_new; ?></td>
													<td class="text-right" title="<?php echo _l('remaining_expiration_title') ?>" style="<?php echo  $expiry_licenece_3_status; ?>"><?php echo remainingformatDays($remaining_days); ?><br><?php echo $remaining_days; ?>&nbsp;&nbsp;<a title="<?php echo _l('days_for_advance_expiration_notice') ?>" style="color: #B9B9C8;"><span>(<span><?php echo $welicence_3['expiration_date']; ?><span>)<span></a></td>
												<?php } ?>

												<td><?php echo html_entity_decode($status); ?></td>

												<?php $transaction_details = get_transaction_license_3_history($candidate->id, $welicence_3['tr_id']) ?>
												<td><?php echo $transaction_details; ?></td>

												<?php
												$hidestatus = '';

												if ($welicence_3['hideexpire'] == 1) {
													$hidestatus = 'Yes';
												} else {
													$hidestatus = '';
												}
												?>

												<td><?php echo html_entity_decode($hidestatus); ?></td>
												<td class="text-center">
													<a href="Javascript:void(0);" class="edit_licence_3_info_detail" data-candidate_id="<?php echo $candidate->id; ?>" data-setting_id="<?php echo $welicence_3['tr_id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="license_3_detail_delete" data-id="<?php echo $welicence_3['tr_id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>

							<!-- End licence 3-->

							<!-- licence 4 -->

							<div class="col-md-12" style="padding: 0;">
								<div style="display: flex; align-items: center; justify-content: space-between;">
									<p style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;" class="bold btn btn-info other_infor-style"><?php echo get_option('licence_4_lable_admin'); ?></p>
									<div class="checkbox checkbox-primary" style="font-size: 18px; margin-bottom: 0;">
										<!-- <input type="checkbox" id="view_hidden_4" name="view_hidden_4">
										<label style="font-size: 18px; margin: 0;" for="view_hidden_4"><?php //echo _l('view_hidden_label'); 
																										?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
										<input type="checkbox" id="view_all_licence_4" name="view_all" onchange="licence4toggleTableRows('licence_4_document')">
										<label style="font-size: 18px; margin: 0;" for="view_all_licence_4"><?php echo _l('view_all_licence_4_label'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addLicence4infoModal"><?php echo _l('Add'); ?></button>
									</div>
								</div>
							</div>

							<hr class="other_infor-hr" />

							<?php if (count($candidate->rec_licence_4) > 0) { ?>
								<table class="table dt-table  margin-top-0 licence_4_document">
									<thead>
										<th width="3%"><?php echo _l('no'); ?></th>
										<th width="15%"><?php echo _l('document_type'); ?></th>
										<th width="16%"><?php echo _l('licence_no'); ?></th>
										<th width="4%"><?php echo _l('acquisition_date'); ?></th>
										<th width="4%"><?php echo _l('expiry_date'); ?></th>
										<th width="9%"><?php echo _l('issue_authority'); ?></th>
										<th width="2%"><?php echo _l('attach_file'); ?></th>
										<th width="8%"><?php echo _l('remark'); ?></th>
										<th width="6%"><?php echo _l('remaining_days'); ?></th>
										<th width="6%"><?php echo _l('remaining_expiration'); ?></th>
										<th width="10%"><?php echo _l('Renewal'); ?></th>
										<th width="10%"><?php echo _l('latest_update'); ?></th>
										<th width="2%"><?php echo _l('hideexpire'); ?></th>
										<th width="5%"><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->rec_licence_4 as $welicence_4) {

											$expiration = $welicence_4['expiration_date'];
											$daysToAdd = (int)$expiration;
											$today = new DateTime();
											$futureDate = $today->modify("+{$daysToAdd} days");
											$expiryDate = DateTime::createFromFormat('Y-m-d', $welicence_4['expiry_date']);
											$expiry_date_obj = new DateTime($welicence_4['expiry_date']);
											$current_date_obj = new DateTime();
											$interval = $current_date_obj->diff($expiry_date_obj);
											$days_remaining = $interval->days;

											$current_date_obj_new = new DateTime();
											$expiry_date_obj_new = new DateTime($welicence_4['expiry_date']);
											$interval_remaining_new = $current_date_obj_new->diff($expiry_date_obj_new);
											$remaining_days_new = $interval_remaining_new->format('%r%a');
											if ($expiry_date_obj_new > $current_date_obj_new) {
												if ($welicence_4['expiry_date'] != '') {
													$remaining_days_new += 1;
												} else {
													$remaining_days_new = '';
												}
											}

											$date = new DateTime($welicence_4['expiry_date']);
											$date->modify('-' . $welicence_4['expiration_date'] . ' days');
											$after_minus_date =  $date->format('Y-m-d');
											$givenDate = new DateTime($after_minus_date);
											$today = new DateTime();

											$interval = $today->diff($givenDate);
											if ($welicence_4['expiry_date'] != '') {
												if ($givenDate < $today) {
													$remaining_days = '-' . $interval->days;
												} else {
													$remaining_days = ' ' . ($interval->days + 1);
												}
											} else {
												$remaining_days = '';
											}

											$badgeStyle = 'color: white; cursor:pointer; padding: 5px; border-radius: 6px; display: inline-block; width: 98px; text-align: center;';

											if ($remaining_days_new < 0 && $remaining_days_new != '' && $welicence_4['no_expired'] != 1) {
												$expiry_licenece_4_status = 'color: #FF0000';
												$status = '<span class="pull-left mright5" style="' . $badgeStyle . ' background-color: #FF0000;">' . _l('expired') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_licence_4" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_licence_4(' . $welicence_4['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="call_licence_4" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="call_licence_4(' . $welicence_4['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_licence_4_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_4_interview(' . $welicence_4['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} elseif ($remaining_days_new > $welicence_4['expiration_date']) {
												$expiry_licenece_4_status = 'color: #000000';
												$status = '';
											} elseif ($remaining_days_new > 0 && $remaining_days_new < $welicence_4['expiration_date'] && $welicence_4['no_expired'] != 1) {
												$expiry_licenece_4_status = 'color: #0000FF';
												$status = '<span class="pull-left mright5" style="' . $badgeStyle . ' background-color: #0000FF;">' . _l('alert') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_licence_4" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_licence_4(' . $welicence_4['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="call_licence_4" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="call_licence_4(' . $welicence_4['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_licence_4_test" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_4_test(' . $welicence_4['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_licence_4_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_4_interview(' . $welicence_4['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} else {
												if (
													$welicence_4['no_expired'] == 1 &&
													!empty($welicence_4['licence_no']) ||
													!empty($welicence_4['acquisition_date']) ||
													!empty($welicence_4['issue_authority']) ||
													!empty($welicence_4['attach_file']) ||
													!empty($welicence_4['remark']) ||
													!empty($remaining_days_new)
												) {
													$expiry_licenece_4_status = 'color: #000000';
													$status = '';
												} else {
													$expiry_licenece_4_status = 'color: #CECEBF';
													$status = '';
												}
											}
										?>
											<tr class="project-overview-41 <?php echo ($welicence_4['hideexpire'] == 1) ? 'hidden-expire4' : ''; ?>" data-expiry-status="<?php echo $expiry_licenece_4_status; ?>">

												<td class="text-right" style="<?php echo $expiry_licenece_4_status; ?>">
													<?php echo html_entity_decode($welicence_4['order_no']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_4_status; ?>">
													<?php echo html_entity_decode($welicence_4['document_type']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_4_status; ?>">
													<?php echo $welicence_4['licence_no']; ?>
												</td>
												<td style="<?php echo $expiry_licenece_4_status; ?>">
													<?php echo _d($welicence_4['acquisition_date']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_4_status; ?>">
													<?php echo _d($welicence_4['expiry_date']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_4_status; ?>">
													<?php echo html_entity_decode($welicence_4['issue_authority']); ?>
												</td>
												<?php
												$otherlicencefileDir = module_dir_url('recruitment', 'uploads/candidate/licence_4_file/');
												$travel_filename = $otherlicencefileDir . $welicence_4['attach_file'];
												?>
												<td>
													<?php if ($welicence_4['attach_file']) { ?>
														<a style="<?php echo $expiry_licenece_4_status; ?>" href="<?php echo html_entity_decode($travel_filename); ?>" target="_blank"><i title="<?php echo html_entity_decode($welicence_4['attach_file']); ?>" class="fa-solid fa-file"></i></a>
													<?php } ?>
												</td>
												<td style="<?php echo $expiry_licenece_4_status; ?>"><?php echo html_entity_decode($welicence_4['remark']); ?></td>

												<?php if ($welicence_4['no_expired'] == 1) { ?>
													<td class="text-right" style="<?php echo $expiry_licenece_4_status; ?>"><?php echo _l('no_need'); ?></td>
													<td class="text-right" style="<?php echo $expiry_licenece_4_status; ?>"><?php echo _l('no_need'); ?></td>
												<?php } else { ?>
													<td class="text-right" style="<?php echo $expiry_licenece_4_status; ?>" title="<?php echo _l('remaining_days_title') ?>"><?php echo remainingformatDays($remaining_days_new); ?><br><?php echo $remaining_days_new; ?></td>
													<td class="text-right" title="<?php echo _l('remaining_expiration_title') ?>" style="<?php echo  $expiry_licenece_4_status; ?>"><?php echo remainingformatDays($remaining_days); ?><br><?php echo $remaining_days; ?>&nbsp;&nbsp;<a title="<?php echo _l('days_for_advance_expiration_notice') ?>" style="color: #B9B9C8;"><span>(<span><?php echo $welicence_4['expiration_date']; ?><span>)<span></a></td>
												<?php } ?>

												<td><?php echo html_entity_decode($status); ?></td>

												<?php $transaction_details = get_transaction_license_4_history($candidate->id, $welicence_4['tr_id']) ?>
												<td><?php echo $transaction_details; ?></td>
												<?php
												$hidestatus = '';

												if ($welicence_4['hideexpire'] == 1) {
													$hidestatus = 'Yes';
												} else {
													$hidestatus = '';
												}
												?>

												<td><?php echo html_entity_decode($hidestatus); ?></td>
												<td class="text-center">
													<a href="Javascript:void(0);" class="edit_licence_4_info_detail" data-candidate_id="<?php echo $candidate->id; ?>" data-setting_id="<?php echo $welicence_4['tr_id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="license_4_detail_delete" data-id="<?php echo $welicence_4['tr_id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>

							<!-- End licence 4-->

							<!-- licence 5 -->

							<div class="col-md-12" style="padding: 0;">
								<div style="display: flex; align-items: center; justify-content: space-between;">
									<p style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;" class="bold btn btn-info other_infor-style"><?php echo get_option('licence_5_lable_admin'); ?></p>
									<div class="checkbox checkbox-primary" style="font-size: 18px; margin-bottom: 0;">
										<!-- <input type="checkbox" id="view_hidden_5" name="view_hidden_5">
										<label style="font-size: 18px; margin: 0;" for="view_hidden_5"><?php //echo _l('view_hidden_label'); 
																										?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
										<input type="checkbox" id="view_all_licence_5" name="view_all" onchange="licence5toggleTableRows('licence_5_document')">
										<label style="font-size: 18px; margin: 0;" for="view_all_licence_5"><?php echo _l('view_all_licence_5_label'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addLicence5infoModal"><?php echo _l('Add'); ?></button>
									</div>
								</div>
							</div>

							<hr class="other_infor-hr" />

							<?php if (count($candidate->rec_licence_5) > 0) { ?>
								<table class="table dt-table  margin-top-0 licence_5_document">
									<thead>
										<th width="3%"><?php echo _l('no'); ?></th>
										<th width="15%"><?php echo _l('document_type'); ?></th>
										<th width="16%"><?php echo _l('licence_no'); ?></th>
										<th width="4%"><?php echo _l('acquisition_date'); ?></th>
										<th width="4%"><?php echo _l('expiry_date'); ?></th>
										<th width="9%"><?php echo _l('issue_authority'); ?></th>
										<th width="2%"><?php echo _l('attach_file'); ?></th>
										<th width="8%"><?php echo _l('remark'); ?></th>
										<th width="6%"><?php echo _l('remaining_days'); ?></th>
										<th width="6%"><?php echo _l('remaining_expiration'); ?></th>
										<th width="10%"><?php echo _l('Renewal'); ?></th>
										<th width="10%"><?php echo _l('latest_update'); ?></th>
										<th width="2%"><?php echo _l('hideexpire'); ?></th>
										<th width="5%"><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->rec_licence_5 as $welicence_5) {

											$expiration = $welicence_5['expiration_date'];
											$daysToAdd = (int)$expiration;
											$today = new DateTime();
											$futureDate = $today->modify("+{$daysToAdd} days");
											$expiryDate = DateTime::createFromFormat('Y-m-d', $welicence_5['expiry_date']);
											$expiry_date_obj = new DateTime($welicence_5['expiry_date']);
											$current_date_obj = new DateTime();
											$interval = $current_date_obj->diff($expiry_date_obj);
											$days_remaining = $interval->days;

											$current_date_obj_new = new DateTime();
											$expiry_date_obj_new = new DateTime($welicence_5['expiry_date']);
											$interval_remaining_new = $current_date_obj_new->diff($expiry_date_obj_new);
											$remaining_days_new = $interval_remaining_new->format('%r%a');
											if ($expiry_date_obj_new > $current_date_obj_new) {
												if ($welicence_5['expiry_date'] != '') {
													$remaining_days_new += 1;
												} else {
													$remaining_days_new = '';
												}
											}

											$date = new DateTime($welicence_5['expiry_date']);
											$date->modify('-' . $welicence_5['expiration_date'] . ' days');
											$after_minus_date =  $date->format('Y-m-d');
											$givenDate = new DateTime($after_minus_date);
											$today = new DateTime();

											$interval = $today->diff($givenDate);
											if ($welicence_5['expiry_date'] != '') {
												if ($givenDate < $today) {
													$remaining_days = '-' . $interval->days;
												} else {
													$remaining_days = ' ' . ($interval->days + 1);
												}
											} else {
												$remaining_days = '';
											}

											$badgeStyle = 'color: white; cursor:pointer; padding: 5px; border-radius: 6px; display: inline-block; width: 98px; text-align: center;';

											if ($remaining_days_new < 0 && $remaining_days_new != '' && $welicence_5['no_expired'] != 1) {
												$expiry_licenece_5_status = 'color: #FF0000';
												$status = '<span class="pull-left mright5" style="' . $badgeStyle . ' background-color: #FF0000;">' . _l('expired') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_licence_5" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_licence_5(' . $welicence_5['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="call_licence_5" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="call_licence_5(' . $welicence_5['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_licence_5_test" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_5_test(' . $welicence_5['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_licence_5_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_5_interview(' . $welicence_5['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} elseif ($remaining_days_new > $welicence_5['expiration_date']) {
												$expiry_licenece_5_status = 'color: #000000';
												$status = '';
											} elseif ($remaining_days_new > 0 && $remaining_days_new < $welicence_5['expiration_date'] && $welicence_5['no_expired'] != 1) {
												$expiry_licenece_5_status = 'color: #0000FF';
												$status = '<span class="pull-left mright5" style="' . $badgeStyle . ' background-color: #0000FF;">' . _l('alert') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_licence_5" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_licence_5(' . $welicence_5['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="call_licence_5" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="call_licence_5(' . $welicence_5['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_licence_5_test" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_5_test(' . $welicence_5['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_licence_5_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_5_interview(' . $welicence_5['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} else {
												if (
													$welicence_5['no_expired'] == 1 &&
													!empty($welicence_5['licence_no']) ||
													!empty($welicence_5['acquisition_date']) ||
													!empty($welicence_5['issue_authority']) ||
													!empty($welicence_5['attach_file']) ||
													!empty($welicence_5['remark']) ||
													!empty($remaining_days_new)
												) {
													$expiry_licenece_5_status = 'color: #000000';
													$status = '';
												} else {
													$expiry_licenece_5_status = 'color: #CECEBF';
													$status = '';
												}
											}
										?>
											<tr class="project-overview-5 <?php echo ($welicence_5['hideexpire'] == 1) ? 'hidden-expire5' : ''; ?>" data-expiry-status="<?php echo $expiry_licenece_5_status; ?>">

												<td class="text-right" style="<?php echo $expiry_licenece_5_status; ?>">
													<?php echo html_entity_decode($welicence_5['order_no']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_5_status; ?>">
													<?php echo html_entity_decode($welicence_5['document_type']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_5_status; ?>">
													<?php echo $welicence_5['licence_no']; ?>
												</td>
												<td style="<?php echo $expiry_licenece_5_status; ?>">
													<?php echo _d($welicence_5['acquisition_date']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_5_status; ?>">
													<?php echo _d($welicence_5['expiry_date']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_5_status; ?>">
													<?php echo html_entity_decode($welicence_5['issue_authority']); ?>
												</td>
												<?php
												$otherlicencefileDir = module_dir_url('recruitment', 'uploads/candidate/licence_5_file/');
												$travel_filename = $otherlicencefileDir . $welicence_5['attach_file'];
												?>
												<td>
													<?php if ($welicence_5['attach_file']) { ?>
														<a style="<?php echo $expiry_licenece_5_status; ?>" href="<?php echo html_entity_decode($travel_filename); ?>" target="_blank"><i title="<?php echo html_entity_decode($welicence_5['attach_file']); ?>" class="fa-solid fa-file"></i></a>
													<?php } ?>
												</td>
												<td style="<?php echo $expiry_licenece_5_status; ?>"><?php echo html_entity_decode($welicence_5['remark']); ?></td>

												<?php if ($welicence_5['no_expired'] == 1) { ?>
													<td class="text-right" style="<?php echo $expiry_licenece_5_status; ?>"><?php echo _l('no_need'); ?></td>
													<td class="text-right" style="<?php echo $expiry_licenece_5_status; ?>"><?php echo _l('no_need'); ?></td>
												<?php } else { ?>
													<td class="text-right" style="<?php echo $expiry_licenece_5_status; ?>" title="<?php echo _l('remaining_days_title') ?>"><?php echo remainingformatDays($remaining_days_new); ?><br><?php echo $remaining_days_new; ?></td>
													<td class="text-right" title="<?php echo _l('remaining_expiration_title') ?>" style="<?php echo  $expiry_licenece_5_status; ?>"><?php echo remainingformatDays($remaining_days); ?><br><?php echo $remaining_days; ?>&nbsp;&nbsp;<a title="<?php echo _l('days_for_advance_expiration_notice') ?>" style="color: #B9B9C8;"><span>(<span><?php echo $welicence_5['expiration_date']; ?><span>)<span></a></td>
												<?php } ?>

												<td><?php echo html_entity_decode($status); ?></td>

												<?php $transaction_details = get_transaction_license_5_history($candidate->id, $welicence_5['tr_id']) ?>
												<td><?php echo $transaction_details; ?></td>
												<?php

												$hidestatus = '';

												if ($welicence_5['hideexpire'] == 1) {
													$hidestatus = 'Yes';
												} else {
													$hidestatus = '';
												}
												?>

												<td><?php echo html_entity_decode($hidestatus); ?></td>
												<td class="text-center">
													<a href="Javascript:void(0);" class="edit_licence_5_info_detail" data-candidate_id="<?php echo $candidate->id; ?>" data-setting_id="<?php echo $welicence_5['tr_id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="license_5_detail_delete" data-id="<?php echo $welicence_5['tr_id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>

							<!-- End licence 5-->

							<!-- licence 6 -->

							<div class="col-md-12" style="padding: 0;">
								<div style="display: flex; align-items: center; justify-content: space-between;">
									<p style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;" class="bold btn btn-info other_infor-style"><?php echo get_option('licence_6_lable_admin'); ?></p>
									<div class="checkbox checkbox-primary" style="font-size: 18px; margin-bottom: 0;">
										<!-- <input type="checkbox" id="view_hidden_6" name="view_hidden_6">
										<label style="font-size: 18px; margin: 0;" for="view_hidden_6"><?php //echo _l('view_hidden_label'); 
																										?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
										<input type="checkbox" id="view_all_licence_6" name="view_all" onchange="licence6toggleTableRows('licence_6_document')">
										<label style="font-size: 18px; margin: 0;" for="view_all_licence_6"><?php echo _l('view_all_licence_6_label'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addLicence6infoModal"><?php echo _l('Add'); ?></button>
									</div>
								</div>
							</div>

							<hr class="other_infor-hr" />

							<?php if (count($candidate->rec_licence_6) > 0) { ?>
								<table class="table dt-table  margin-top-0 licence_6_document">
									<thead>
										<th width="3%"><?php echo _l('no'); ?></th>
										<th width="15%"><?php echo _l('document_type'); ?></th>
										<th width="16%"><?php echo _l('licence_no'); ?></th>
										<th width="4%"><?php echo _l('acquisition_date'); ?></th>
										<th width="4%"><?php echo _l('expiry_date'); ?></th>
										<th width="9%"><?php echo _l('issue_authority'); ?></th>
										<th width="2%"><?php echo _l('attach_file'); ?></th>
										<th width="8%"><?php echo _l('remark'); ?></th>
										<th width="6%"><?php echo _l('remaining_days'); ?></th>
										<th width="6%"><?php echo _l('remaining_expiration'); ?></th>
										<th width="10%"><?php echo _l('Renewal'); ?></th>
										<th width="10%"><?php echo _l('latest_update'); ?></th>
										<th width="2%"><?php echo _l('hideexpire'); ?></th>
										<th width="5%"><?php echo _l('action'); ?></th>
									</thead>
									<tbody>
										<?php foreach ($candidate->rec_licence_6 as $welicence_6) {

											$expiration = $welicence_6['expiration_date'];
											$daysToAdd = (int)$expiration;
											$today = new DateTime();
											$futureDate = $today->modify("+{$daysToAdd} days");
											$expiryDate = DateTime::createFromFormat('Y-m-d', $welicence_6['expiry_date']);
											$expiry_date_obj = new DateTime($welicence_6['expiry_date']);
											$current_date_obj = new DateTime();
											$interval = $current_date_obj->diff($expiry_date_obj);
											$days_remaining = $interval->days;

											$current_date_obj_new = new DateTime();
											$expiry_date_obj_new = new DateTime($welicence_6['expiry_date']);
											$interval_remaining_new = $current_date_obj_new->diff($expiry_date_obj_new);
											$remaining_days_new = $interval_remaining_new->format('%r%a');
											if ($expiry_date_obj_new > $current_date_obj_new) {
												if ($welicence_6['expiry_date'] != '') {
													$remaining_days_new += 1;
												} else {
													$remaining_days_new = '';
												}
											}

											$date = new DateTime($welicence_6['expiry_date']);
											$date->modify('-' . $welicence_6['expiration_date'] . ' days');
											$after_minus_date =  $date->format('Y-m-d');
											$givenDate = new DateTime($after_minus_date);
											$today = new DateTime();

											$interval = $today->diff($givenDate);
											if ($welicence_6['expiry_date'] != '') {
												if ($givenDate < $today) {
													$remaining_days = '-' . $interval->days;
												} else {
													$remaining_days = ' ' . ($interval->days + 1);
												}
											} else {
												$remaining_days = '';
											}

											$badgeStyle = 'color: white; cursor:pointer; padding: 5px; border-radius: 6px; display: inline-block; width: 98px; text-align: center;';

											if ($remaining_days_new < 0 && $remaining_days_new != '' && $welicence_6['no_expired'] != 1) {
												$expiry_licenece_6_status = 'color: #FF0000';
												$status = '<span class="pull-left mright5" style="' . $badgeStyle . ' background-color: #FF0000;">' . _l('expired') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_licence_6" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_licence_6(' . $welicence_6['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="call_licence_6" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="call_licence_6(' . $welicence_6['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_licence_6_test" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_6_test(' . $welicence_6['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_licence_6_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_6_interview(' . $welicence_6['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} elseif ($remaining_days_new > $welicence_6['expiration_date']) {
												$expiry_licenece_6_status = 'color: #000000';
												$status = '';
											} elseif ($remaining_days_new > 0 && $remaining_days_new < $welicence_6['expiration_date'] && $welicence_6['no_expired'] != 1) {
												$expiry_licenece_6_status = 'color: #0000FF';
												$status = '<span class="pull-left mright5" style="' . $badgeStyle . ' background-color: #0000FF;">' . _l('alert') . '</span>';
												$status .= '<a style="padding: 2px 10px 3px 10px;" href="#" onclick="email_template_manage_send_mail(\'candidate\', ' . $candidate->id . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a>';
												$status .= '<div class="sendmail_licence_6" style="display:none;"><a style="padding: 2px 10px 3px 10px; color:blue" href="#" onclick="sendmail_licence_6(' . $welicence_6['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-envelope"></i></a></div>';
												$status .= '<div class="call_licence_6" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="call_licence_6(' . $welicence_6['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-phone"></i></a></div>';
												$status .= '<div class="crew_licence_6_test" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_6_test(' . $welicence_6['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-forward"></i></a></div>';
												$status .= '<div class="crew_licence_6_interview" style="display:none;"><a style="padding: 2px 10px 3px 10px;" href="#" onclick="crew_licence_6_interview(' . $welicence_6['tr_id'] . ')" class="btn btn-info pull-left display-block mright5"><i style="font-size:13px;" class="fa fa-microphone"></i></a></div>';
											} else {
												if (
													$welicence_6['no_expired'] == 1 &&
													!empty($welicence_6['licence_no']) ||
													!empty($welicence_6['acquisition_date']) ||
													!empty($welicence_6['issue_authority']) ||
													!empty($welicence_6['attach_file']) ||
													!empty($welicence_6['remark']) ||
													!empty($remaining_days_new)
												) {
													$expiry_licenece_6_status = 'color: #000000';
													$status = '';
												} else {
													$expiry_licenece_6_status = 'color: #CECEBF';
													$status = '';
												}
											}
										?>
											<tr class="project-overview-6 <?php echo ($welicence_6['hideexpire'] == 1) ? 'hidden-expire6' : ''; ?>" data-expiry-status="<?php echo $expiry_licenece_6_status; ?>">

												<td class="text-right" style="<?php echo $expiry_licenece_6_status; ?>">
													<?php echo html_entity_decode($welicence_6['order_no']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_6_status; ?>">
													<?php echo html_entity_decode($welicence_6['document_type']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_6_status; ?>">
													<?php echo $welicence_6['licence_no']; ?>
												</td>
												<td style="<?php echo $expiry_licenece_6_status; ?>">
													<?php echo _d($welicence_6['acquisition_date']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_6_status; ?>">
													<?php echo _d($welicence_6['expiry_date']); ?>
												</td>
												<td style="<?php echo $expiry_licenece_6_status; ?>">
													<?php echo html_entity_decode($welicence_6['issue_authority']); ?>
												</td>
												<?php
												$otherlicencefileDir = module_dir_url('recruitment', 'uploads/candidate/licence_6_file/');
												$travel_filename = $otherlicencefileDir . $welicence_6['attach_file'];
												?>
												<td>
													<?php if ($welicence_6['attach_file']) { ?>
														<a style="<?php echo $expiry_licenece_6_status; ?>" href="<?php echo html_entity_decode($travel_filename); ?>" target="_blank"><i title="<?php echo html_entity_decode($welicence_6['attach_file']); ?>" class="fa-solid fa-file"></i></a>
													<?php } ?>
												</td>
												<td style="<?php echo $expiry_licenece_6_status; ?>"><?php echo html_entity_decode($welicence_6['remark']); ?></td>

												<?php if ($welicence_6['no_expired'] == 1) { ?>
													<td class="text-right" style="<?php echo $expiry_licenece_6_status; ?>"><?php echo _l('no_need'); ?></td>
													<td class="text-right" style="<?php echo $expiry_licenece_6_status; ?>"><?php echo _l('no_need'); ?></td>
												<?php } else { ?>
													<td class="text-right" style="<?php echo $expiry_licenece_6_status; ?>" title="<?php echo _l('remaining_days_title') ?>"><?php echo remainingformatDays($remaining_days_new); ?><br><?php echo $remaining_days_new; ?></td>
													<td class="text-right" title="<?php echo _l('remaining_expiration_title') ?>" style="<?php echo  $expiry_licenece_6_status; ?>"><?php echo remainingformatDays($remaining_days); ?><br><?php echo $remaining_days; ?>&nbsp;&nbsp;<a title="<?php echo _l('days_for_advance_expiration_notice') ?>" style="color: #B9B9C8;"><span>(<span><?php echo $welicence_6['expiration_date']; ?><span>)<span></a></td>
												<?php } ?>

												<td><?php echo html_entity_decode($status); ?></td>

												<?php $transaction_details = get_transaction_license_6_history($candidate->id, $welicence_6['tr_id']) ?>
												<td><?php echo $transaction_details; ?></td>
												<?php
												$hidestatus = '';

												if ($welicence_6['hideexpire'] == 1) {
													$hidestatus = 'Yes';
												} else {
													$hidestatus = '';
												}
												?>

												<td><?php echo html_entity_decode($hidestatus); ?></td>
												<td class="text-center">
													<a href="Javascript:void(0);" class="edit_licence_6_info_detail" data-candidate_id="<?php echo $candidate->id; ?>" data-setting_id="<?php echo $welicence_6['tr_id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="license_6_detail_delete" data-id="<?php echo $welicence_6['tr_id']; ?>"><i style="color: red;" class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>

							<!-- End licence 6-->

							<!-- contract_of_employee -->
							<!-- <div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php //echo _l('contract_of_employee'); 
																																																							?></p>
								<hr class="other_infor-hr" />
							</div> -->
							<!-- <?php //if (count($candidate->contract_info) > 0) { 
									?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php //echo _l('no'); 
											?></th>
										<th><?php //echo _l('document_type'); 
											?></th>
										<th><?php //echo _l('licence_no'); 
											?></th>
										<th><?php //echo _l('acquisition_date'); 
											?></th>
										<th><?php //echo _l('expiry_date'); 
											?></th>
										<th><?php //echo _l('issue_authority'); 
											?></th>
										<th><?php //echo _l('attach_file'); 
											?></th>
										<th><?php //echo _l('remark'); 
											?></th>
										<th><?php //echo _l('remaining_days'); 
											?></th>
										<th><?php //echo _l('remaining_expiration'); 
											?></th>
										<th><?php //echo _l('status'); 
											?></th>
										<th><?php //echo _l('action'); 
											?></th>
									</thead>
									<tbody>
										<?php //foreach ($candidate->contract_info as $wetcontract) {
										?>
											<tr class="project-overview">
												<?php
												// $expiration = $wetcontract['emp_expiration_date'];
												// $daysToAdd = (int)$expiration;
												// $today = new DateTime();
												// $futureDate = $today->modify("+{$daysToAdd} days");
												// $expiryDate = DateTime::createFromFormat('Y-m-d', $wetcontract['expiry_date']);

												// $current_date_obj_contract = new DateTime();
												// $expiry_date_obj_contract = new DateTime($wetcontract['expiry_date']);
												// $interval_remaining_contract = $current_date_obj_contract->diff($expiry_date_obj_contract);
												// $remaining_days_contract = $interval_remaining_contract->format('%r%a');
												// if ($expiry_date_obj_contract > $current_date_obj_contract) {
												// 	if ($wetcontract['expiry_date'] != '') {
												// 		$remaining_days_contract += 1;
												// 	} else {
												// 		$remaining_days_contract = '';
												// 	}
												// }

												// $expiry_date_obj = new DateTime($wetcontract['expiry_date']);
												// $current_date_obj = new DateTime();
												// $interval = $current_date_obj->diff($expiry_date_obj);
												// $days_remaining = $interval->days;

												// $date = new DateTime($wetcontract['expiry_date']);
												// $date->modify('-' . $wetcontract['emp_expiration_date'] . ' days');
												// $after_minus_date =  $date->format('Y-m-d');
												// $givenDate = new DateTime($after_minus_date);
												// $today = new DateTime();

												// $interval = $today->diff($givenDate);

												// if ($wetcontract['expiry_date'] != '') {
												// 	if ($givenDate < $today) {
												// 		$remaining_days = '-' . $interval->days;
												// 	} else {
												// 		$remaining_days = ' ' . ($interval->days + 1);
												// 	}
												// } else {
												// 	$remaining_days = '';
												// }

												// $badgeStyle = 'color: white; cursor:pointer; padding: 5px; border-radius: 6px; display: inline-block; width: 98px; text-align: center;';


												// if ($remaining_days_contract < 0 && $remaining_days_contract != '') {
												// 	$expiry_contract_status = 'color: #FF0000';
												// 	$status = '<span style="' . $badgeStyle . ' background-color: #FF0000;">' . _l('expired') . '</span>';
												// } else if ($remaining_days_contract > $wetcontract['emp_expiration_date']) {
												// 	$expiry_contract_status = 'color: #000000';
												// 	$status = '';
												// } elseif ($remaining_days_contract > 0 && $remaining_days_contract < $wetcontract['emp_expiration_date']) {
												// 	$expiry_contract_status = 'color: #0000FF';
												// 	$status = '<span style="' . $badgeStyle . ' background-color: #0000FF;">' . _l('alert') . '</span>';
												// } else {
												// 	$expiry_contract_status = 'color: #CECEBF';
												// 	$status = '';
												// }

												// if ($expiryDate != '') {
												// 	$expiry_contract_status = ($expiryDate < $futureDate) ? "color: red;" : 'color: #0000FF';
												// } else {
												// 	$expiry_contract_status = '';
												// }

												?>
												<td class="text-right" style="<?php //echo $expiry_contract_status; 
																				?>"><?php //echo html_entity_decode($wetcontract['order_no']); 
																					?></td>
												<td style="<?php //echo $expiry_contract_status; 
															?>"><?php //echo html_entity_decode($wetcontract['emp_document_type']); 
																?></td>
												<td style="<?php //echo $expiry_contract_status; 
															?>"><?php //echo $wetcontract['licence_no']; 
																?></td>
												<td style="<?php //echo $expiry_contract_status; 
															?>"><?php //echo _d($wetcontract['acquisition_date']); 
																?></td>
												<td style="<?php //echo $expiry_contract_status; 
															?>"><?php //echo _d($wetcontract['expiry_date']); 
																?></td>
												<td style="<?php //echo $expiry_contract_status; 
															?>"><?php //echo html_entity_decode($wetcontract['issue_authority']); 
																?></td>
												<?php
												//$contractfileDir = module_dir_url('recruitment', 'uploads/candidate/contract_file/');
												//$contract_filename = $contractfileDir . $wetcontract['attach_file'];
												?>
												<td>
													<a style="<?php //echo $expiry_contract_status; 
																?>" href="<?php //echo html_entity_decode($contract_filename); 
																			?>" target="_blank"><?php //echo html_entity_decode($wetcontract['attach_file']); 
																								?></a>
												</td>

												<td style="<?php //echo $expiry_contract_status; 
															?>"><?php //echo html_entity_decode($wetcontract['remark']); 
																?></td>

												<td class="text-right" title="<?php //echo _l('remaining_days_title') 
																				?>" style="<?php //echo $expiry_contract_status; 
																							?>"><?php //echo $remaining_days_contract; 
																								?></td>

												<td class="text-right" title="<?php //echo _l('remaining_expiration_title') 
																				?>" style="<?php //echo $expiry_contract_status; 
																							?>"><?php //echo $remaining_days; 
																								?>&nbsp;&nbsp;<a title="<?php //echo _l('days_for_advance_expiration_notice') 
																														?>" style="color: #B9B9C8;"><span>(<span><?php //echo $wetcontract['emp_expiration_date']; 
																																									?><span>)<span></a></td>

												<td><?php //echo html_entity_decode($status); 
													?></td>


												<td class="text-center">

													<a href="Javascript:void(0);" class="edit_contract_info_detail" data-candidate_id="<?php //echo $wetcontract['candidate']; 
																																		?>" data-setting_id="<?php //echo $wetcontract['id']; 
																																								?>"><i class="fa fa-edit"></i></a>&nbsp;
												</td>
											</tr>
										<?php //} 
										?>
									</tbody>
								</table>
							<?php //} else { 
							?>
								<p><?php //echo _l('no_result'); 
									?></p>
							<?php //} 
							?> <br> -->
							<!-- End contract_of_employee -->

							<!-- Passport -->
							<!-- <div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php //echo _l('passport_info'); 
																																																							?></p>

								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addPassportinfoModal"><?php //echo _l('Add'); 
																																					?></button>
								<hr class="other_infor-hr" />
							</div> -->
							<!-- <?php //if (count($candidate->passport_info) > 0) { 
									?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php //echo _l('document_type'); 
											?></th>
										<th><?php //echo _l('passport_no'); 
											?></th>
										<th><?php //echo _l('acquisition_date'); 
											?></th>
										<th><?php //echo _l('issue_date'); 
											?></th>
										<th><?php //echo _l('exipiry_date'); 
											?></th>
										<th><?php //echo _l('issue_authority'); 
											?></th>
										<th><?php //echo _l('attach_file'); 
											?></th>
										<th><?php //echo _l('remark'); 
											?></th>
										<th><?php //echo _l('remaining_days'); 
											?></th>
										<th><?php //echo _l('remaining_expiration'); 
											?></th>
										<th><?php //echo _l('status'); 
											?></th>
										<th><?php //echo _l('action'); 
											?></th>
									</thead>
									<tbody>
										<?php //foreach ($candidate->passport_info as $we) {
										// $expiration = get_option('recruitment_tab_expiration_date_setting');
										// $daysToAdd = (int)$expiration;
										// $today = new DateTime();
										// $futureDate = $today->modify("+{$daysToAdd} days");
										// $expiryDate = DateTime::createFromFormat('Y-m-d', $we['exipiry_date']);
										// $expiry_status = ($expiryDate < $futureDate) ? "color: red;" : '';

										// $expiration = $we['expiration_date_passport'];
										// $daysToAdd = (int)$expiration;
										// $today = new DateTime();
										// $futureDate = $today->modify("+{$daysToAdd} days");
										// $expiryDate = DateTime::createFromFormat('Y-m-d', $we['exipiry_date']);

										// $current_date_obj_contract = new DateTime();
										// $expiry_date_obj_contract = new DateTime($we['exipiry_date']);
										// $interval_remaining_contract = $current_date_obj_contract->diff($expiry_date_obj_contract);
										// $remaining_days_contract = $interval_remaining_contract->format('%r%a');
										// if ($expiry_date_obj_contract > $current_date_obj_contract) {
										// 	if ($we['exipiry_date'] != '') {
										// 		$remaining_days_contract += 1;
										// 	} else {
										// 		$remaining_days_contract = '';
										// 	}
										// }

										// $expiry_date_obj = new DateTime($we['exipiry_date']);
										// $current_date_obj = new DateTime();
										// $interval = $current_date_obj->diff($expiry_date_obj);
										// $days_remaining = $interval->days;

										// $date = new DateTime($we['exipiry_date']);
										// $date->modify('-' . $we['expiration_date_passport'] . ' days');
										// $after_minus_date =  $date->format('Y-m-d');
										// $givenDate = new DateTime($after_minus_date);
										// $today = new DateTime();

										// $interval = $today->diff($givenDate);

										// if ($we['exipiry_date'] != '') {
										// 	if ($givenDate < $today) {
										// 		$remaining_days = '-' . $interval->days;
										// 	} else {
										// 		$remaining_days = ' ' . ($interval->days + 1);
										// 	}
										// } else {
										// 	$remaining_days = '';
										// }

										// $badgeStyle = 'color: white; cursor:pointer; padding: 5px; border-radius: 6px; display: inline-block; width: 98px; text-align: center;';

										// if ($remaining_days_contract < 0 && $remaining_days_contract != '') {
										// 	$expiry_status = 'color: #FF0000';
										// 	$status = '<span style="' . $badgeStyle . ' background-color: #FF0000;">' . _l('expired') . '</span>';
										// } else if ($remaining_days_contract > $we['expiration_date_passport']) {
										// 	$expiry_status = 'color: #000000';
										// 	$status = '';
										// } elseif ($remaining_days_contract > 0 && $remaining_days_contract < $we['expiration_date_passport']) {
										// 	$expiry_status = 'color: #0000FF';
										// 	$status = '<span style="' . $badgeStyle . ' background-color: #0000FF;">' . _l('alert') . '</span>';
										// } else {
										// 	$expiry_status = 'color: #CECEBF';
										// 	$status = '';
										// }
										?>
											<tr class="project-overview">
												<td><?php //echo get_select_option_name_by_id('job_travel_identification', $we['document_type_password'], 'document_type'); 
													?></td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo html_entity_decode($we['passport_no']); 
																?></td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo _d($we['acquisition_date']); 
																?></td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo _d($we['issue_date']); 
																?></td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo _d($we['exipiry_date']); 
																?></td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo html_entity_decode($we['issue_authority']); 
																?></td>
												<?php
												// $passportfileDir = module_dir_url('recruitment', 'uploads/candidate/passport_file/');
												// $passport_filename = $passportfileDir . $we['attach_file'];
												?>
												<td>
													<a style="<?php //echo $expiry_status; 
																?>" href="<?php //echo html_entity_decode($passport_filename); 
																			?>" target="_blank"><?php //echo html_entity_decode($we['attach_file']); 
																								?></a>
												</td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo html_entity_decode($we['remark']); 
																?></td>

												<td class="text-right" title="<?php //echo _l('remaining_days_title') 
																				?>" style="<?php //echo $expiry_status; 
																							?>"><?php //echo $remaining_days_contract; 
																								?></td>

												<td class="text-right" title="<?php //echo _l('remaining_expiration_title') 
																				?>" style="<?php //echo $expiry_status; 
																							?>"><?php //echo $remaining_days; 
																								?>&nbsp;&nbsp;<a title="<?php //echo _l('days_for_advance_expiration_notice') 
																														?>" style="color: #B9B9C8;"><span>(<span><?php //echo $we['expiration_date_passport']; 
																																									?><span>)<span></a></td>

												<td><?php //echo html_entity_decode($status); 
													?></td>
												<td class="text-center">
													<a href="Javascript:void(0);" class="edit_passport_info_detail" data-id="<?php //echo $we['id']; 
																																?>"><i class="fa fa-edit"></i></a>&nbsp;
													<a href="Javascript:void(0);" class="passport_info_detail_delete" data-id="<?php //echo $we['id']; 
																																?>"><i style="color: red;" class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php //} 
										?>
									</tbody>
								</table>
							<?php //} else { 
							?> -->
							<p><?php //echo _l('no_result'); 
								?></p>
							<?php //} 
							?> <br>
							<!-- End Passport -->

							<!-- LICENCE -->
							<!-- <div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php //echo _l('licence_info'); 
																																																							?></p>

								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addLicenceinfoModal"><?php //echo _l('Add'); 
																																				?></button>

								<hr class="other_infor-hr" />
							</div> -->
							<!-- <?php //if (count($candidate->licence_info) > 0) { 
									?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php //echo _l('lic_kind_division'); 
											?></th>
										<th><?php //echo _l('lic_licence_no'); 
											?></th>
										<th><?php //echo _l('lic_acquisition_date'); 
											?></th>
										<th><?php //echo _l('lic_exipiry_date'); 
											?></th>
										<th><?php //echo _l('lic_issue_authority'); 
											?></th>
										<th><?php //echo _l('licence_attach_file'); 
											?></th>
										<th><?php //echo _l('licence_remark'); 
											?></th>
										<th><?php //echo _l('action'); 
											?></th>
									</thead>
									<tbody>
										<?php //foreach ($candidate->licence_info as $we) {
										// $expiryDateflag = new DateTime($we['exipiry_date']);
										// $oneYearAgoflag = new DateTime('+1 year');
										// $expiry_status = $expiryDateflag < $oneYearAgoflag && $we['exipiry_date'] != null ? "color: red;" : '';
										?>
											<tr class="project-overview">
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo get_select_option_name_by_id('job_kind', $we['kind_division'], 'kind_name'); 
																?></td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo html_entity_decode($we['licence_no']); 
																?></td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo _d($we['acquisition_date']); 
																?></td>
												<?php
												//if ($we['exipiry_date'] != null) {
												// $currentDatelic = new DateTime();
												// $oneYearAgolic = new DateTime('+1 year');
												// $expiryDatelics = new DateTime($we['exipiry_date']);
												//if ($expiryDatelics < $oneYearAgolic) {
												//echo '<td><span style="color: red;">' . $expiryDatelics->format('Y-m-d') . '</span></td>';
												//} else {
												//echo '<td>' . $expiryDatelics->format('Y-m-d') . '</td>';
												//}
												//} else {
												//echo '<td></td>';
												//}
												?>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo html_entity_decode($we['issue_authority']); 
																?></td>
												<?php
												// $licencefileDir = module_dir_url('recruitment/uploads/candidate/licence_file/');
												// $licence_filename =  $licencefileDir . $we['attach_file'];
												?>
												<td style="<?php //echo $expiry_status; 
															?>">
													<a href="<?php //echo html_entity_decode($licence_filename); 
																?>" target="_blank"><?php //echo html_entity_decode($we['attach_file']); 
																					?></a>
												</td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo html_entity_decode($we['remark']); 
																?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="edit_licence_info_detail" data-id="<?php //echo $we['id']; 
																																				?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="licence_info_detail_delete" data-id="<?php //echo $we['id']; 
																																																																	?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php //} 
										?>
									</tbody>
								</table>
							<?php //} else { 
							?>
								<p><?php //echo _l('no_result'); 
									?></p>
							<?php //} 
							?> <br> -->

							<!-- <div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php //echo _l('document_info'); 
																																																							?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addDocumentinfoModal"><?php //echo _l('Add'); 
																																					?></button>
								<hr class="other_infor-hr" />
							</div> -->
							<!-- <?php //if (count($candidate->document_info) > 0) { 
									?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php //echo _l('doc_kind_division'); 
											?></th>
										<th><?php //echo _l('doc_licence_no'); 
											?></th>
										<th><?php //echo _l('doc_issue_date'); 
											?></th>
										<th><?php //echo _l('doc_exipiry_date'); 
											?></th>
										<th><?php //echo _l('doc_issue_authority'); 
											?></th>
										<th><?php //echo _l('doc_attach_file'); 
											?></th>
										<th><?php //echo _l('doc_remark'); 
											?></th>
										<th><?php //echo _l('action'); 
											?></th>
									</thead>
									<tbody>
										<?php //foreach ($candidate->document_info as $wea) {
										// $expiryDateflag = new DateTime($wea['exipiry_date']);
										// $oneYearAgoflag = new DateTime('+1 year');
										// $expiry_status = $expiryDateflag < $oneYearAgoflag && $wea['exipiry_date'] != null ? "color: red;" : '';
										?>
											<tr class="project-overview">
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo get_select_option_name_by_id('job_kind_document', $wea['kind_division'], 'kind_document_name'); 
																?></td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo html_entity_decode($wea['licence_no']); 
																?></td>
												<?php
												//if (!empty($wea['exipiry_date'])) { 
												?>
													<td style="<?php //echo $expiry_status; 
																?>"><?php //echo _d($wea['issue_date']); 
																	?></td>
												<?php //} else { 
												?>
													<td><?php //echo _d($wea['issue_date']); 
														?></td>
												<?php //} 
												?>
												<?php
												// if ($wea['exipiry_date'] != null) {
												// 	$currentDatelic = new DateTime();
												// 	$oneYearAgolic = new DateTime('+1 year');

												// 	$expiryDatedoc = new DateTime($wea['exipiry_date']);
												// 	if ($expiryDatedoc < $oneYearAgolic) {
												// 		echo '<td><span style="color: red;">' . $expiryDatedoc->format('Y-m-d') . '</span></td>';
												// 	} else {
												// 		echo '<td>' . $expiryDatedoc->format('Y-m-d') . '</td>';
												// 	}
												// } else {
												// 	echo '<td></td>';
												// }
												?>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo _d($wea['issue']); 
																?></td>
												<?php
												// $documentfileDir = module_dir_url('recruitment/uploads/candidate/document_file/');
												// $document_filename =  $documentfileDir . $wea['attach_file'];
												?>
												<td style="<?php //echo $expiry_status; 
															?>">
													<a href="<?php //echo html_entity_decode($document_filename); 
																?>" target="_blank"><?php //echo html_entity_decode($wea['attach_file']); 
																					?></a>
												</td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo html_entity_decode($wea['remark']); 
																?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="edit_document_info_detail" data-id="<?php //echo $wea['id']; 
																																					?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="document_info_detail_delete" data-id="<?php //echo $wea['id']; 
																																																																		?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php //} 
										?>
									</tbody>
								</table> -->
							<?php //} else { 
							?>
							<!-- <p><?php //echo _l('no_result'); 
									?></p> -->
							<?php //} 
							?> <br>

							<!-- start flag -->
							<!-- <div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 4px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php //echo _l('flag_info'); 
																																																							?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addflaginfoModal"><?php //echo _l('Add'); 
																																				?></button>
								<hr class="other_infor-hr" />
							</div> -->
							<!-- <?php //if (count($candidate->flag_info) > 0) { 
									?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php //echo _l('doc_kind_division'); 
											?></th>
										<th><?php //echo _l('doc_licence_no'); 
											?></th>
										<th><?php //echo _l('doc_issue_date'); 
											?></th>
										<th><?php //echo _l('doc_exipiry_date'); 
											?></th>
										<th><?php //echo _l('doc_issue_authority'); 
											?></th>
										<th><?php //echo _l('doc_attach_file'); 
											?></th>
										<th><?php //echo _l('doc_remark'); 
											?></th>
										<th><?php //echo _l('action'); 
											?></th>
									</thead>
									<tbody>
										<?php //foreach ($candidate->flag_info as $we) {

										// $expiryDateflag = new DateTime($we['exipiry_date']);
										// $oneYearAgoflag = new DateTime('+1 year');
										// $expiry_status = $expiryDateflag < $oneYearAgoflag && $we['exipiry_date'] != null ? "color: red;" : '';
										?>
											<tr class="project-overview">
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo get_select_option_name_by_id('job_kind_flag', $we['kind_division'], 'kind_flag_name'); 
																?></td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo html_entity_decode($we['licence_no']); 
																?></td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo _d($we['issue_date']); 
																?></td>
												<?php
												// if ($we['exipiry_date']) {
												// 	$currentDateflag = new DateTime();
												// 	$oneYearAgoflag = new DateTime('+1 year');

												// 	$expiryDateflag = new DateTime($we['exipiry_date']);

												// 	if ($expiryDateflag < $oneYearAgoflag) {
												// 		echo '<td><span style="color: red;">' . $expiryDateflag->format('Y-m-d') . '</span></td>';
												// 	} else {
												// 		echo '<td>' . $expiryDateflag->format('Y-m-d') . '</td>';
												// 	}
												// } else {
												// 	echo '<td></td>';
												// }
												?>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo _d($we['issue']); 
																?></td>
												<?php
												// $flagfileDir = module_dir_url('recruitment/uploads/candidate/flag_file/');
												// $flag_filename =  $flagfileDir . $we['attach_file'];
												?>
												<td style="<?php //echo $expiry_status; 
															?>">
													<a href="<?php //echo html_entity_decode($flag_filename); 
																?>" target="_blank"><?php //echo html_entity_decode($we['attach_file']); 
																					?></a>
												</td>
												<td style="<?php //echo $expiry_status; 
															?>"><?php //echo html_entity_decode($we['remark']); 
																?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="edit_flag_info_detail" data-id="<?php //echo $we['id']; 
																																				?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="flag_info_detail_delete" data-id="<?php //echo $we['id']; 
																																																																?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php //} 
										?>
									</tbody>
								</table>
							<?php //} else { 
							?>
								<p><?php //echo _l('no_result'); 
									?></p>
							<?php //} 
							?> -->
						</div>
						<!-- End flag -->

						<?php if (get_tab_option('recruitment_create_campaign_tab_psc') == 1) { ?>
							<div role="tabpanel" class="tab-pane" id="psc_info">
								<div class="col-md-12">
									<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('psc_info'); ?></p>
									<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addPscinfoModal"><?php echo _l('Add'); ?></button>
									<hr class="other_infor-hr" />
								</div>
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
							<div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('promotion_info'); ?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addPromotioninfoModal"><?php echo _l('Add'); ?></button>
								<hr class="other_infor-hr" />
							</div>
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
						</div>

						<div role="tabpanel" class="tab-pane" id="history_recruitment">
							<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('campaign_has_joined'); ?></p>
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
							<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('interview_schedule'); ?></p>
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


						</div>

						<div role="tabpanel" class="tab-pane" id="capacity_profile">
							<div class="row col-md-12">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('candidate_evaluation'); ?></p>
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
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('result'); ?></p>
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
						<div role="tabpanel" class="tab-pane" id="transaction_histroy">
							<div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php echo _l('care_history'); ?></p>
								<hr class="other_infor-hr" />
								<?php if (count($candidate->care) > 0) {
								?>
									<table class="table dt-table margin-top-0">
										<thead>
											<tr>
												<th><?php echo _l('type'); ?></th>
												<th><?php echo _l('caregiver'); ?></th>
												<th><?php echo _l('rec_time'); ?></th>
												<th><?php echo _l('document_type'); ?></th>
												<th><?php echo _l('result_test'); ?></th>
												<th><?php echo _l('description_label'); ?></th>
												<th><?php echo _l('action'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($candidate->care as $care) {
											?>
												<tr class="project-overview-transaction">
													<td><?php echo _l($care['type']); ?></td>
													<td>
														<?php
														$_data = '<a href="' . admin_url('staff/profile/' . $care['add_from']) . '">' . staff_profile_image($care['add_from'], [
															'staff-profile-image-small',
														]) . '</a>';
														$_data .= ' <a href="' . admin_url('staff/profile/' . $care['add_from']) . '">' . get_staff_full_name($care['add_from']) . '</a>';
														echo $_data;
														?>
													</td>
													<td><?php echo _d($care['care_time']); ?></td>
													<?php
													if (!empty($care['travel_id']) && $care['travel_id'] != 0) {
														$document = get_document_type('travel', $care['document_type']);
													} elseif (!empty($care['license_id']) && $care['license_id'] != 0) {
														$document = get_document_type('licence', $care['document_type']);
													} elseif (!empty($care['license_3']) && $care['license_3'] != 0) {
														$document = get_document_type('license_3', $care['document_type']);
													} elseif (!empty($care['license_4']) && $care['license_4'] != 0) {
														$document = get_document_type('license_4', $care['document_type']);
													} elseif (!empty($care['license_5']) && $care['license_5'] != 0) {
														$document = get_document_type('license_5', $care['document_type']);
													} elseif (!empty($care['license_6']) && $care['license_6'] != 0) {
														$document = get_document_type('license_6', $care['document_type']);
													} else {
														$document = ['document_type' => ''];
													}
													?>
													<td><?php echo html_entity_decode($document['document_type']); ?></td>
													<td><?php echo html_entity_decode($care['care_result']); ?></td>
													<td><?php echo html_entity_decode($care['description']); ?></td>
													<td>
														<a href="Javascript:void(0);" class="edit_crew_transaction_detail" data-id="<?php echo $care['id']; ?>">
															<i class="fa fa-pencil-alt"></i>
														</a>&nbsp;
														<a href="Javascript:void(0);" class="crew_transaction_detail_delete" data-id="<?php echo $care['id']; ?>">
															<i style="color: red;" class="fa fa-minus-square"></i>
														</a>
													</td>

												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } else { ?>
									<p><?php echo _l('no_result'); ?></p>
								<?php } ?>
							</div>
						</div>
						<!-- On-board START----------------------------------->

						<div role="tabpanel" class="tab-pane" id="on_board">

							<div class="row">

								<div class="col-md-4" style="padding: 0;">

									<div class="col-md-12" style="display: flex;">
										<p class="bold btn btn-info other_infor-style margin-top-15"
											style="font-size: 18px; margin-bottom: 15px; background-color: black; color: white; border-radius:.220rem;border-color:black;">
											<?php echo _l('on_board_company'); ?>
										</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<p class="bold general-infor-color" style="margin-top: 15px;font-size: 17px;font-weight: 700;">
											<?php echo _l('total_boarding_period'); ?> :
											<span class="board_total_boarding_days"></span>
										</p>
									</div>
								</div>

								<div class="col-md-8" style="padding: 0;">

									<div class="col-md-3" style="margin-top: 8px;width: 21%;">
										<select name="on_board_filter[]" id="on_board_filter" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_on_board'); ?>">
											<option value="Yes">Yes</option>
											<option value="No">No</option>
										</select>
									</div>

									<div class="col-md-3" style="margin-top: 8px;width: 21%;">
										<select name="duty_filter[]" id="duty_filter" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_duty'); ?>">
											<?php foreach ($duty_list as $duty) { ?>
												<option value="<?php echo $duty['id']; ?>"><?php echo $duty['duty_name']; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="col-md-3" style="margin-top: 8px;width: 21%;">
										<select name="rank_filter[]" id="rank_filter" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_rank'); ?>">
											<?php foreach ($rank_list as $rank) { ?>
												<option value="<?php echo $rank['id']; ?>"><?php echo $rank['rank_name']; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="col-md-2" style="margin-top: 8px;width: 21%;">
										<select name="vessel_filter_board[]" id="vessel_filter_board" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_vessel'); ?>">
											<?php foreach ($vessel_list as $vessel) { ?>
												<option value="<?php echo $vessel['id']; ?>"><?php echo $vessel['vessel_name']; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="col-md-1 pull-right" style="margin-top: 8px;">
										<!-- Add Button -->
										<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addOnBoardCompanyModal">
											<?php echo _l('Add'); ?>
										</button>
									</div>
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
											<th><?php echo _l('rank_name_official'); ?></th>
											<th><?php echo _l('grade_rank_duty'); ?></th>
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
											<!-- <th><?php //echo _l('emp_no'); 
														?></th> -->
											<!-- <th><?php //echo _l('employment'); 
														?></th> -->
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
												<td><?php echo get_select_option_name_by_id('job_vessel_name', $we['vessel_name'], 'vessel_info_name'); ?></td>
												<td><?php echo get_select_option_name_by_id('job_rank', $we['rank'], 'rank_name'); ?></td>
												<td data-id="<?php echo $we['grade_rank']; ?>"><?php echo get_select_option_name_by_id('job_duty', $we['grade_rank'], 'duty_name'); ?></td>

												<td data-vslrid="<?php echo $we['vessel_type']; ?>"><?php echo get_select_option_name_by_id('job_vessel', $we['vessel_type'], 'vessel_name'); ?></td>
												<td><?php echo html_entity_decode($we['gross_ton']); ?></td>
												<td><?php echo html_entity_decode($we['engine_type']); ?></td>
												<td><?php echo html_entity_decode($we['eng_output']); ?></td>
												<td style="<?php echo check_date_included_in_other($we['id'], $we['candidate'], $we['embarkation_date'], 'rec_on_board_company');?>"><?php echo _d($we['embarkation_date']); ?></td>
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

												if (!empty($disembarkation_date)) {
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
															$result = sprintf("%dY %dM %dD", $years, $months, $days);
														}
													?>
														<td><?php echo isset($result) ? $result : '';  ?></td>
													<?php }
												} else { ?>
													<td><?php echo calculateBoardingPeriod($embarkation_date, _d(date('Y-m-d'))); ?></td>
												<?php } ?>

												<?php
												if (!empty($disembarkation_date)) {
													$total_days = calculateBoardingPeriodDays($embarkation_date, $disembarkation_date); ?>
													<td><?php echo $total_days; ?></td>
												<?php } else {
													$total_days = calculateBoardingPeriodDays($embarkation_date, _d(date('Y-m-d'))); ?>
													<td>
														<p style="display:none;"><?php echo $total_days; ?></p>
													</td>
												<?php } ?>
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
												<!-- <td><?php //echo html_entity_decode($we['emp_no']); 
															?></td>
												<td><?php //echo html_entity_decode($we['employment']); 
													?></td> -->
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


							<div class="row">
								<div class="col-md-5" style="padding: 0;">
									<div class="col-md-12" style="display: flex;">
										<p class="bold btn btn-info other_infor-style margin-top-15"
											style="font-size: 18px; margin-bottom: 4px; background-color: black; color: white; border-radius:.220rem;border-color:black;">
											<?php echo _l('on_board_other_company'); ?>
										</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<p class="bold general-infor-color" style="margin-top: 15px;font-size: 17px;font-weight: 700;">
											<?php echo _l('total_boarding_period'); ?> :
											<span class="other_total_boarding_days"></span>
										</p>
									</div>
								</div>

								<div class="col-md-7" style="padding: 0;">

									<div class="col-md-2" style="margin-top: 8px;width: 25%;">
										<select name="duty_filter_other[]" id="duty_filter_other" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_duty'); ?>">
											<?php foreach ($duty_list as $duty) { ?>
												<option value="<?php echo $duty['id']; ?>"><?php echo $duty['duty_name']; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="col-md-2" style="margin-top: 8px;width: 25%;">
										<select name="rank_filter_other[]" id="rank_filter_other" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_rank'); ?>">
											<?php foreach ($rank_list as $rank) { ?>
												<option value="<?php echo $rank['id']; ?>"><?php echo $rank['rank_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-2" style="margin-top: 8px;width: 25%;">
										<select name="vessel_filter_board_other[]" id="vessel_filter_board_other" class="selectpicker" multiple data-live-search="false" data-none-selected-text="<?php echo _l('filter_by_vessel'); ?>">
											<?php foreach ($vessel_list as $vessel) { ?>
												<option value="<?php echo $vessel['id']; ?>"><?php echo $vessel['vessel_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-1 pull-right" style="margin-top: 8px;">
										<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addOnBoardOtherCompanyModal"><?php echo _l('Add'); ?></button>
									</div>
								</div>
							</div>
							<hr class="other_infor-hr" />
							<?php if (count($candidate->on_board_other_company) > 0) { ?>
								<table id="vessel_table_other" class="table dt-table margin-top-0" data-order-col="9" data-order-type="desc">
									<thead>
										<th><?php echo _l('no'); ?></th>
										<th><?php echo _l('rank_name'); ?></th>
										<th><?php echo _l('grade_rank_duty'); ?></th>
										<th><?php echo _l('company_name'); ?></th>
										<th><?php echo _l('vessel_name'); ?></th>
										<th><?php echo _l('vessel_type'); ?></th>
										<th><?php echo _l('gross_ton'); ?></th>
										<th><?php echo _l('engine_type'); ?></th>
										<th><?php echo _l('eng_output'); ?></th>
										<th><?php echo _l('sailing_area'); ?></th>
										<th><?php echo _l('embarkation_date'); ?></th>
										<th><?php echo _l('disembarkation_date'); ?></th>
										<!-- <th><?php //echo _l('cur_onboard'); 
													?></th> -->
										<th><?php echo _l('boarding_period'); ?></th>
										<th><?php echo _l('boarding_periods'); ?></th>
										<!-- <th><?php //echo _l('boarding_month'); 
													?></th> -->
										<!-- <th><?php //echo _l('approval_rate'); 
													?></th> -->
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
												<td data-otherid="<?php echo $we['grade_rank_duty_other']; ?>"><?php echo get_select_option_name_by_id('job_duty', $we['grade_rank_duty_other'], 'duty_name'); ?></td>
												<td><?php echo html_entity_decode($we['company_name']); ?></td>
												<td><?php echo html_entity_decode($we['vessel_name']); ?></td>
												<td data-vslotherid="<?php echo $we['vessel_type']; ?>"><?php echo get_select_option_name_by_id('job_vessel', $we['vessel_type'], 'vessel_name'); ?></td>
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
												<!-- <td><?php
															//if ($we['cur_onboard'] == '1') {
															//echo "Yes";
															//} elseif ($we['cur_onboard'] == 0) {
															//echo "No";
															//}
															?></td> -->
												<?php
												$boarding_period = html_entity_decode($we['boarding_period']);
												$embarkation_date = html_entity_decode($we['embarkation_date']);
												$disembarkation_date = html_entity_decode($we['disembarkation_date']);
												if (!empty($disembarkation_date)) {
													if (preg_match('/^(\d+Y )?(\d+M )?(\d+D)$/', $boarding_period, $matches)) { ?>
														<td><?php echo calculateBoardingPeriod($embarkation_date, $disembarkation_date); ?></td>
													<?php  } else {
														preg_match('/(\d+)/', $boarding_period, $matches);
														if (isset($matches[1])) {
															$days = (int)$matches[1];
															// Convert Days To Years, Months, And Days
															$years = floor($days / 365);
															$remaining_days = $days % 365;
															$months = floor($remaining_days / 30);
															$days = $remaining_days % 30;
															$result = sprintf("%dY %dM %dD", $years, $months, $days);
														}
													?>
														<td><?php echo isset($result) ? $result : '';  ?></td>
													<?php }
												} else { ?>
													<td><?php echo calculateBoardingPeriod($embarkation_date, _d(date('Y-m-d'))); ?></td>
												<?php } ?>

												<?php
												if (!empty($disembarkation_date)) {
													$total_days = calculateBoardingPeriodDays($embarkation_date, $disembarkation_date); ?>
													<td><?php echo $total_days; ?></td>
												<?php } else {
													$total_days = calculateBoardingPeriodDays($embarkation_date, _d(date('Y-m-d'))); ?>
													<td>
														<p style="display:none;"><?php echo $total_days; ?></p>
													</td>
												<?php } ?>

												<!-- <td><?php //echo html_entity_decode($we['approval_rate']); 
															?></td> -->
												<td><?php echo html_entity_decode($we['remark']); ?></td>
												<td class="text-center">
													<a href="Javascript:void(0);" class="edit_on_board_other_company_detail" data-id="<?php echo $we['id']; ?>">
														<i class="fa fa-edit"></i>
													</a>&nbsp;
													<a href="Javascript:void(0);" class="on_board_other_company_detail_delete" data-id="<?php echo $we['id']; ?>">
														<i style="color: red;" class="fa fa-trash"></i>
													</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } else { ?>
								<p><?php echo _l('no_result'); ?></p>
							<?php } ?> <br>
							<!-- <div class="col-md-12" style="padding: 0;">
								<p class="bold btn btn-info other_infor-style margin-top-15" style="font-size: 18px; margin-bottom: 2px; background-color: black; color: white; border-radius:.220rem;border-color:black;"><?php //echo _l('on_board_in_land'); 
																																																							?></p>
								<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addOnBoardInLandModal"><?php //echo _l('Add'); 
																																					?></button>
							</div>
							<hr class="other_infor-hr" />
							<?php //if (count($candidate->on_board_in_land) > 0) { 
							?>
								<table class="table dt-table margin-top-0">
									<thead>
										<th><?php //echo _l('company_name'); 
											?></th>
										<th><?php //echo _l('hire_date'); 
											?></th>
										<th><?php //echo _l('resignation_date'); 
											?></th>
										<th><?php //echo _l('work_dep'); 
											?></th>
										<th><?php //echo _l('responsibility_work'); 
											?></th>
										<th><?php //echo _l('final_position'); 
											?></th>
										<th><?php //echo _l('retire_reason'); 
											?></th>
										<th><?php //echo _l('other_company_career'); 
											?></th>
										<th><?php //echo _l('remark'); 
											?></th>
										<th><?php //echo _l('action'); 
											?></th>
									</thead>
									<tbody>
										<?php //foreach ($candidate->on_board_in_land as $we) { 
										?>
											<tr class="project-overview">
												<td><?php //echo html_entity_decode($we['company_name']); 
													?></td>
												<td><?php //echo _d($we['hire_date']); 
													?></td>
												<td><?php //echo _d($we['resignation_date']); 
													?></td>
												<td><?php //echo html_entity_decode($we['work_dep']); 
													?></td>
												<td><?php //echo html_entity_decode($we['responsibility_work']); 
													?></td>
												<td><?php //echo html_entity_decode($we['final_position']); 
													?></td>
												<td><?php //echo html_entity_decode($we['retire_reason']); 
													?></td>
												<td><?php //echo html_entity_decode($we['other_company_career']); 
													?></td>
												<td><?php //echo html_entity_decode($we['remark']); 
													?></td>
												<td class="text-center"><a href="Javascript:void(0);" class="edit_on_board_in_land_detail" data-id="<?php //echo $we['id']; 
																																					?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="Javascript:void(0);" class="on_board_in_land_detail_delete" data-id="<?php //echo $we['id']; 
																																																																			?>"><i style="color: red;" class="fa fa-trash"></i></a></td>
											</tr>
										<?php //} 
										?>
									</tbody>
								</table>
							<?php //} else { 
							?>
								<p><?php //echo _l('no_result'); 
									?></p>
							<?php //} 
							?> <br> -->
						</div>


						<!-- On-board END----------------------------------->

						<div role="tabpanel" class="tab-pane" id="contract">
							<div class="row">

								<div class="col-sm-12">
									<button type="submit" class="btn btn-primary" data-toggle="modal" id="add_contract_btn">Add Contract</button>
								</div>

								<div class="col-sm-12" style="margin-top: 10px;">
									<div class="table-responsive">
										<?php render_datatable([
											_l('ID'),
											_l('contract_name_tbl'),
											_l('con_start_date_tbl'),
											_l('con_finish_date_tbl'),
											_l('contract_template'),
											_l('con_signed_contract'),
											_l('action'),
										], 'rec_contract_list'); ?>
									</div>
								</div>

							</div>

						</div>

						<?php
						$hook_data = [
							'candidate_id' => $candidate->id
						];
						hooks()->do_action('add_tab_content_for_tab', $hook_data);
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="add_contract_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-xl">
		<?php echo form_open_multipart(admin_url('recruitment/add_contract'), array('id' => 'add_contract-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="contract_title" class="add_contract_title"><?php echo _l('add_contract'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php // echo form_hidden('add_education_candidate_id', $candidate->id); 
					?>
					<input type="hidden" name="add_education_candidate_id" , id="add_education_candidate_id" value="<?php echo $candidate->id; ?>">
					<input type="hidden" name="rec_contract_id" id="rec_contract_id">
					<input type="hidden" id="defult_contract_template_id" value="<?php echo GOVERNMENT_CONTRACT_1; ?>">
					<div class="col-md-6">
						<?php echo render_input('contract_name', _l('contract_name'), ''); ?>
					</div>
					<div class="col-md-6">
						<?php //echo render_input('course_type', 'course_type', ''); 
						$contract_template_dropdown = get_contract_template_dropdown();
						?>
						<?php echo render_select('contract_template', $contract_template_dropdown, ['id', 'contract_template_name'], _l('contract_template'), '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('con_start_date', _l('con_start_date'), ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('con_finish_date', _l('con_finish_date'), ''); ?>
					</div>

					<div class="col-sm-12">
						<?php echo render_input('con_signed_contract', _l('con_signed_contract'), '', 'file', ['placeholder' => _l('con_signed_contract'), 'id' => 'con_signed_contract']); ?>
						<div id="con_signed_contract_edit_iamge"></div>
					</div>

					<!-- <div class="col-md-6">
						<?php // echo render_input('edu_date', 'edu_date', '', 'number'); 
						?>
					</div>
					<div class="col-md-6">
						<?php // echo render_input('education_year', 'education_year', ''); 
						?>
					</div>
					<div class="col-md-6">
						<?php // echo render_input('edu_institution', 'edu_institution', ''); 
						?>
					</div>
					<div class="col-md-6">
						<?php // echo render_input('completed_edu', 'completed_edu', ''); 
						?>
					</div> -->
					<!-- <div class="col-md-6">
						<?php //echo render_date_input('valid_date', 'valid_date', ''); 
						?>
					</div> -->
					<div class="col-md-12 template_edit_error"></div>
					<div class="col-md-12 contract_template_content_textarea">
						<textarea class="tinymce tinymce-manual" id="template_content" name="template_content"></textarea>
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



<div class="modal fade" id="care_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/care_candidate'), array('id' => 'care_candidate-form', 'name' => 'care_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button d type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<?php $attr = [];
						$attr = ['disabled' => "true"];
						echo render_input('candidate', 'candidate_label', $candidate->candidate_code . ' - ' . $candidate->candidate_name . ' ' . $candidate->last_name, 'text', $attr);
						echo form_hidden('candidate', $candidate->id);
						echo form_hidden('travel_id', '');
						echo form_hidden('license_id', '');
						echo form_hidden('license_3', '');
						echo form_hidden('license_4', '');
						echo form_hidden('license_5', '');
						echo form_hidden('license_6', '');
						?>
					</div>
					<div class="col-md-6">
						<?php echo render_datetime_input('care_time', 'care_time', date('Y-m-d H:i:s')); ?>
					</div>

					<div class="col-md-12" id="care_rs">
					</div>
					<div class="col-md-12">
						<?php echo render_textarea('description', 'description_label') ?>
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
						<?php echo render_textarea('content', 'content', '', array(), array(), '') ?>
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
						<?php echo render_input('edit_family_name', 'family_name'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_select('edit_family_religion', $relation_list_family, ['id', 'relation_name'], 'family_religion', '', ['data-actions-box' => true], [], '', '', true); ?>
					</div>
					<div class="col-md-6">
						<!-- <?php //echo render_input('edit_family_id_no', 'id_no'); 
								?> -->
						<?php echo render_select('edit_family_id_no', $marital_status_list_family, ['id', 'marital_status_name'], 'id_no', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('edit_family_birthday', 'birthday', '', array('data-date-end-date' => _d(date('Y-m-d'))), [], '', 'update_birthdate'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_family_age', 'age', '', 'text', array('readonly' => true), [], '', 'update_age'); ?>
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
					<div class="col-md-12">
						<?php echo render_input('edit_family_position', 'position'); ?>
					</div>
					<!-- <div class="col-md-6">
						<?php //echo render_input('edit_family_grade', 'grade'); 
						?>
					</div>
					<div class="col-md-6">
						<?php //echo render_input('edit_family_basic_deduction', 'basic_deduction'); 
						?>
					</div>
					<div class="col-md-6">
						<?php //echo render_input('edit_family_child_bearing', 'child_bearing'); 
						?>
					</div> -->
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
						<?php echo render_input('edit_family_name', 'family_name'); ?>
					</div>
					<div class="col-md-6">
						<!-- <?php //echo render_input('edit_family_religion', 'family_religion', ''); 
								?> -->
						<?php echo render_select('edit_family_religion', $relation_list_family, ['id', 'relation_name'], 'family_religion', '', ['data-actions-box' => true], [], '', '', true); ?>
					</div>
					<div class="col-md-6">
						<!-- <?php //echo render_input('edit_family_id_no', 'id_no'); 
								?> -->
						<?php echo render_select('edit_family_id_no', $marital_status_list_family, ['id', 'marital_status_name'], 'id_no', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('edit_family_birthday', 'birthday', '', array('data-date-end-date' => _d(date('Y-m-d'))), [], '',	'add_birthdate'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_family_age', 'age', '', 'text', array('readonly' => true), [], '', 'add_age'); ?>
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
					<div class="col-md-12">
						<?php echo render_input('edit_family_position', 'position'); ?>
					</div>
					<!-- <div class="col-md-6">
						<?php //echo render_input('edit_family_grade', 'grade'); 
						?>
					</div>
					<div class="col-md-6">
						<?php //echo render_input('edit_family_basic_deduction', 'basic_deduction'); 
						?>
					</div>
					<div class="col-md-6">
						<?php //echo render_input('edit_family_child_bearing', 'child_bearing'); 
						?>
					</div> -->
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
						<?php echo render_input('course_name', 'course_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php //echo render_input('course_type', 'course_type', ''); 
						?>
						<?php echo render_select('course_type[]', $course_list, ['id', 'course_name'], 'course_type', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('edu_start_date', 'edu_start_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('edu_finish_date', 'edu_finish_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edu_date', 'edu_date', '', 'number'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('education_year', 'education_year', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edu_institution', 'edu_institution', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('completed_edu', 'completed_edu', ''); ?>
					</div>
					<!-- <div class="col-md-6">
						<?php //echo render_date_input('valid_date', 'valid_date', ''); 
						?>
					</div> -->
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
						<?php echo render_input('edit_course_name', 'course_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_select('course_type[]', $course_list, ['id', 'course_name'], 'course_type', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('edit_edu_start_date', 'edu_start_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('edit_edu_finish_date', 'edu_finish_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_edu_date', 'edu_date', '', 'number'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_education_year', 'education_year', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_edu_institution', 'edu_institution', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_completed_edu', 'completed_edu', ''); ?>
					</div>
					<!-- <div class="col-md-6">
						<?php //echo render_date_input('edit_valid_date', 'valid_date', ''); 
						?>
					</div> -->
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
						<?php echo render_input('school_name', 'school_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('year_of_graduation', 'year_of_graduation', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('major_name', 'major_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('academic_career_type', 'academic_career_type', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('university', 'university', ''); ?>
					</div>
					<!-- <div class="col-md-6">
						<?php //echo render_input('final_academic_career', 'final_academic_career', ''); 
						?>
					</div> -->
					<!-- <div class="col-md-6">
						<?php //echo render_input('faculty', 'faculty', ''); 
						?>
					</div> -->
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
						<?php echo render_input('edit_school_name', 'school_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_year_of_graduation', 'year_of_graduation', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_major_name', 'major_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_academic_career_type', 'academic_career_type', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('edit_university', 'university', ''); ?>
					</div>
					<!-- <div class="col-md-6">
						<?php //echo render_input('edit_final_academic_career', 'final_academic_career', ''); 
						?>
					</div> -->
					<!-- <div class="col-md-6">
						<?php //echo render_input('edit_faculty', 'faculty', ''); 
						?>
					</div> -->
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

<div class="modal fade" id="addPassportinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_passpord_detail_candidate'), array('id' => 'add_update_passpord_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="passpord_label"><?php echo _l('add_passpord_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_passport_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('passport_id', ''); ?>
					<div class="col-md-12">
						<?php echo render_select('document_type_password', $travel_list, ['id', 'document_type'], 'document_type', '', ['data-actions-box' => true], [], '', '', true); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('passport_no', 'passport_no', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('acquisition_date', 'acquisition_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('issue_date', 'issue_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('exipiry_date', 'exipiry_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('issue_authority', 'issue_authority', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('attach_file', 'attach_file', '', 'file'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('expiration_date_passport', 'expiration_date', '', 'number'); ?>
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

<div class="modal fade" id="addTravelinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_travel_detail_candidate'), array('id' => 'add_update_travel_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="travel_label"><?php echo _l('edit_travel_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_travel_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('travel_id', ''); ?>
					<?php echo form_hidden('document_type', ''); ?>
					<div class="col-md-12">
						<?php echo render_select('document_type', $travel_list, ['id', 'document_type'], 'document_type', '', ['data-actions-box' => true], [], '', '', true); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('licence_no', 'licence_no', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('acquisition_date', 'acquisition_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('expiry_date', 'expiry_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('issue_authority', 'issue_authority', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('attach_file', 'attach_file', '', 'file'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('remark', 'remark', ''); ?>
					</div>
					<div class="col-md-12">
						<span id="licencefilelabel"></span>
					</div>
					<div class="col-md-12">
						<!-- <div class="checkbox checkbox-primary">
							<input type="checkbox" id="request_renew" name="request_renew" value="1">
							<label for="request_renew"><?php //echo _l('request_renew_label'); 
														?></label>
						</div> -->
						<!-- <?php //echo render_select('request_renew', $request_renew_list, ['id', 'name'], 'request_renew_label', '', ['data-actions-box' => true], [], '', '', true); 
								?> -->
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 renew_request_content" style="display:none;">
						<?php echo render_textarea('renew_request_status_update', 'renew_request_status_update', '', array(), array(), '') ?>
					</div>

					<div class="col-md-6" id="divhideexpire2" style="display: none;">
						<div class="checkbox checkbox-primary">
							<input type="checkbox" id="hideexpire2" name="hideexpire" data-test=''>
							<label for="hideexpire2">
								<?php echo _l('hideexpire'); ?>
							</label>
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
</div>

<div class="modal fade" id="addotherLicenceinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_other_licence_detail_candidate'), array('id' => 'add_update_other_licence_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="other_licence_label"><?php echo _l('edit_other_licence_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_other_licence_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('other_licence_id', ''); ?>
					<?php echo form_hidden('document_type', ''); ?>
					<div class="col-md-12">
						<?php echo render_select('document_type', $other_licences, ['id', 'document_type'], 'document_type', '', ['data-actions-box' => true], [], '', '', true); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('licence_no', 'licence_no', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('acquisition_date', 'acquisition_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('expiry_date', 'expiry_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('issue_authority', 'issue_authority', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('attach_file', 'attach_file', '', 'file'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('remark', 'remark', ''); ?>
					</div>
					<div class="col-md-12">
						<span id="otherlicencefilelabel"></span>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 renew_request_content" style="display:none;">
						<?php echo render_textarea('renew_request_status_update', 'renew_request_status_update', '', array(), array(), '') ?>
					</div>

					<div class="col-md-6" id="divhideexpire" style="display: none;">
						<div class="checkbox checkbox-primary">
							<input type="checkbox" id="hideexpire" name="hideexpire" data-test=''>
							<label for="hideexpire">
								<?php echo _l('hideexpire'); ?>
							</label>
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
</div>

<div class="modal fade" id="addLicence3infoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_licence_3_detail_candidate'), array('id' => 'add_update_licence_3_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="licence_3_label"><?php echo _l('edit_licence_3_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_licence_3_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('licence_3_id', ''); ?>
					<?php echo form_hidden('document_type', ''); ?>
					<div class="col-md-12">
						<?php echo render_select('document_type', $licences_3, ['id', 'document_type'], 'document_type', '', ['data-actions-box' => true], [], '', '', true); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('licence_no', 'licence_no', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('acquisition_date', 'acquisition_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('expiry_date', 'expiry_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('issue_authority', 'issue_authority', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('attach_file', 'attach_file', '', 'file'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('remark', 'remark', ''); ?>
					</div>
					<div class="col-md-12">
						<span id="licence3filelabel"></span>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 renew_request_content" style="display:none;">
						<?php echo render_textarea('renew_request_status_update', 'renew_request_status_update', '', array(), array(), '') ?>
					</div>

					<div class="col-md-6" id="divhideexpire3" style="display: none;">
						<div class="checkbox checkbox-primary">
							<input type="checkbox" id="hideexpire3" name="hideexpire" data-test=''>
							<label for="hideexpire3">
								<?php echo _l('hideexpire'); ?>
							</label>
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
</div>

<div class="modal fade" id="addLicence4infoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_licence_4_detail_candidate'), array('id' => 'add_update_licence_4_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="licence_4_label"><?php echo _l('edit_licence_4_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_licence_4_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('licence_4_id', ''); ?>
					<?php echo form_hidden('document_type', ''); ?>
					<div class="col-md-12">
						<?php echo render_select('document_type', $licences_4, ['id', 'document_type'], 'document_type', '', ['data-actions-box' => true], [], '', '', true); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('licence_no', 'licence_no', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('acquisition_date', 'acquisition_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('expiry_date', 'expiry_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('issue_authority', 'issue_authority', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('attach_file', 'attach_file', '', 'file'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('remark', 'remark', ''); ?>
					</div>
					<div class="col-md-12">
						<span id="licence4filelabel"></span>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 renew_request_content" style="display:none;">
						<?php echo render_textarea('renew_request_status_update', 'renew_request_status_update', '', array(), array(), '') ?>
					</div>

					<div class="col-md-6" id="divhideexpire4" style="display: none;">
						<div class="checkbox checkbox-primary">
							<input type="checkbox" id="hideexpire4" name="hideexpire" data-test=''>
							<label for="hideexpire4">
								<?php echo _l('hideexpire'); ?>
							</label>
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
</div>

<div class="modal fade" id="addLicence5infoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_licence_5_detail_candidate'), array('id' => 'add_update_licence_5_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="licence_5_label"><?php echo _l('edit_licence_5_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_licence_5_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('licence_5_id', ''); ?>
					<?php echo form_hidden('document_type', ''); ?>
					<div class="col-md-12">
						<?php echo render_select('document_type', $licences_5, ['id', 'document_type'], 'document_type', '', ['data-actions-box' => true], [], '', '', true); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('licence_no', 'licence_no', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('acquisition_date', 'acquisition_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('expiry_date', 'expiry_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('issue_authority', 'issue_authority', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('attach_file', 'attach_file', '', 'file'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('remark', 'remark', ''); ?>
					</div>
					<div class="col-md-12">
						<span id="licence5filelabel"></span>
					</div>
					<div class="col-md-12">
						<span id="otherlicencefilelabel"></span>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 renew_request_content" style="display:none;">
						<?php echo render_textarea('renew_request_status_update', 'renew_request_status_update', '', array(), array(), '') ?>
					</div>

					<div class="col-md-6" id="divhideexpire5" style="display: none;">
						<div class="checkbox checkbox-primary">
							<input type="checkbox" id="hideexpire5" name="hideexpire" data-test=''>
							<label for="hideexpire5">
								<?php echo _l('hideexpire'); ?>
							</label>
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
</div>

<div class="modal fade" id="addLicence6infoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_licence_6_detail_candidate'), array('id' => 'add_update_licence_6_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="licence_6_label"><?php echo _l('edit_licence_6_info'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_licence_6_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('licence_6_id', ''); ?>
					<?php echo form_hidden('document_type', ''); ?>
					<div class="col-md-12">
						<?php echo render_select('document_type', $licences_6, ['id', 'document_type'], 'document_type', '', ['data-actions-box' => true], [], '', '', true); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('licence_no', 'licence_no', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('acquisition_date', 'acquisition_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('expiry_date', 'expiry_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('issue_authority', 'issue_authority', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('attach_file', 'attach_file', '', 'file'); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('remark', 'remark', ''); ?>
					</div>
					<div class="col-md-12">
						<span id="licence6filelabel"></span>
					</div>
					<div class="col-md-12">
						<span id="otherlicencefilelabel"></span>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 renew_request_content" style="display:none;">
						<?php echo render_textarea('renew_request_status_update', 'renew_request_status_update', '', array(), array(), '') ?>
					</div>

					<div class="col-md-6" id="divhideexpire6" style="display: none;">
						<div class="checkbox checkbox-primary">
							<input type="checkbox" id="hideexpire6" name="hideexpire" data-test=''>
							<label for="hideexpire6">
								<?php echo _l('hideexpire'); ?>
							</label>
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
</div>

<div class="modal fade" id="addrequestrenewinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/update_renew_request'), array('id' => 'update_renew_request')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="travel_label"><?php echo _l('renew_request_status_update'); ?></span>
				</h4>
			</div>
			<div class="modal-body">

				<div class="row">
					<?php echo form_hidden('add_travel_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('travel_id', ''); ?>
					<?php echo form_hidden('document_type', ''); ?>
					<div class="col-md-12 renew_request_content">
						<?php echo render_textarea('renew_request_status_update_modal', 'renew_request_status_update', '', array(), array(), '') ?>
					</div>
					<?php
					if ($candidate->phonenumber) {
					?>
						<div class="col-md-12">
							<p>Call : <a href="tel:+4733378901"><?php echo $candidate->phonenumber; ?></a></p>
						</div><br><br>
					<?php } ?>
					<div class="col-md-12">
						<?php echo render_select('template_for', $email_templates_list, ['id', ['template_name']], 'emailcanvas_template_for', $element_data->template_for ?? '', ['data-none-selected-text' => _l('emailcanvas_template_for_first_select')]); ?>
					</div>
					<div class="col-md-3">
						<button id="sendEmailButton" onclick="send_email_candidate(); return false;" class="btn btn-primary">
							<?php echo _l('send_email') ?>
						</button><br><br>
					</div>
					<div class="col-md-9">
						<p id="count_email"><?php echo _l('email_sent'); ?>: <?php echo $email_templates_count; ?></p><br><br>
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
</div>

<div class="modal fade" id="addContractinfoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/add_update_contract_detail_candidate'), array('id' => 'add_update_contract_detail_candidate-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="contract_label"><?php echo _l('emp_edit_contract'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('add_contract_candidate_id', $candidate->id); ?>
					<?php echo form_hidden('contract_id', ''); ?>
					<?php echo form_hidden('document_type', ''); ?>
					<div class="col-md-6">
						<?php echo render_input('licence_no', 'licence_no', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('acquisition_date', 'acquisition_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_date_input('expiry_date', 'expiry_date', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('issue_authority', 'issue_authority', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('attach_file', 'attach_file', '', 'file'); ?>
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
						<?php
						echo render_select('flag_kind_division[]', $kind_list_flag, ['id', 'kind_flag_name'], 'flag_kind_division', '', ['data-actions-box' => true], [], '', '', false);
						?>
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
						<?php echo render_select('vessel_name', $vessel_name_list, ['id', 'vessel_info_name'], 'vessel_name', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_select('grade_rank', $duty_list, ['id', 'duty_name'], 'grade_rank_duty', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_select('rank[]', $rank_list, ['id', 'rank_name'], 'rank_name_official', '', ['data-actions-box' => true], [], '', '', false); ?>
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
					<!-- <div class="col-md-6">
						<?php //echo render_input('ramaining_days', 'ramaining_days', ''); 
						?>
					</div> -->
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
					<!-- <?php
							//$on_board_check_box =  check_on_board($candidate->id, 'rec_on_board_company');
							//if ($on_board_check_box != 'true') {
							?> -->
					<div class="col-md-6" id="cur_onboard_section">
						<div class="checkbox checkbox-primary">
							<input type="checkbox" id="cur_onboard" name="cur_onboard" data-test=''>
							<label for="cur_onboard">
								<?php echo _l('cur_onboard'); ?>
							</label>
						</div>
					</div>
					<!-- <?php //} 
							?> -->
					<div class="col-md-6">
						<?php echo render_date_input('disembarkation_date', 'disembarkation_date', '', ['data-date-end-date' => date('Y-m-d')]); ?>
					</div>
					<!-- <div class="col-md-6">
						<?php //echo render_input('calculation_y_n', 'calculation_y_n', ''); 
						?>
					</div> -->
					<!-- <div class="col-md-6">
						<?php //echo render_input('emp_no', 'emp_no', ''); 
						?>
					</div> -->
					<!-- <div class="col-md-6">
						<?php //echo render_input('employment', 'employment', ''); 
						?>
					</div> -->
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
					<!-- <div class="col-md-6">
						<?php //echo render_select('vessel_name', $vessel_name_list, ['id', 'vessel_info_name'], 'vessel_name', '', ['data-actions-box' => true], [], '', '', false); 
						?>
					</div> -->
					<div class="col-md-6">
						<?php echo render_input('vessel_name', 'vessel_name', ''); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_select('grade_rank_duty_other', $duty_list, ['id', 'duty_name'], 'grade_rank_duty', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_select('rank_other[]', $rank_list, ['id', 'rank_name'], 'rank_name_official', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_select('vessel_type[]', $vessel_list, ['id', 'vessel_name'], 'vessel_type', '', ['data-actions-box' => true], [], '', '', false); ?>
					</div>
					<div class="col-md-6">
						<?php echo render_input('company_name', 'company_name', ''); ?>
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
					// $on_board_check_box =  check_on_board($candidate->id, 'rec_on_board_other_company');
					// if ($on_board_check_box != 'true') { 
					?>
					<!-- <div class="col-md-6">
						<div class="checkbox checkbox-primary" id="cur_onboard_other_section">
							<input type="checkbox" id="cur_onboard_other" name="cur_onboard_other" data-test=''>
							<label for="cur_onboard_other">
								<?php //echo _l('cur_onboard_other'); 
								?>
							</label>
						</div>
					</div> -->
					<!-- <?php //} 
							?> -->
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
					<!-- <div class="col-md-12">
						<?php //echo render_input('approval_rate', 'approval_rate', ''); 
						?>
					</div> -->
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

<div class="modal fade" id="editcrewtransactionModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<?php echo form_open_multipart(admin_url('recruitment/update_crew_transaction'), array('id' => 'update_crew_transaction-form')); ?>
		<div class="modal-content width-100">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span id="crew_label"><?php echo _l('edit_crew_label'); ?></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php echo form_hidden('hid', ''); ?>
					<div class="col-md-6">
						<?php $attr = [];
						$attr = ['disabled' => "true"];
						echo render_input('candidate', 'candidate_label', $candidate->candidate_code . ' - ' . $candidate->candidate_name . ' ' . $candidate->last_name, 'text', $attr);
						echo form_hidden('candidate', $candidate->id);
						?>
					</div>
					<div class="col-md-6">
						<?php echo render_datetime_input('care_time', 'care_time'); ?>
					</div>

					<div class="col-md-12">
						<?php echo render_input('care_result', 'care_result');
						?>
					</div>

					<div class="col-md-12">
						<?php echo render_textarea('description', 'description_label') ?>
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
		$(document).on('click', "#add_contract_btn", function() {
			$("#add_contract_modal").modal('show');
			$("#add_contract-form").trigger("reset");
			tinymce.get('template_content').setContent('');
			tinyMCE.remove(".tinymce-manual");
			$(".contract_template_content_textarea").hide();
			$("#rec_contract_id").val('');
			$("#con_signed_contract_edit_iamge").html('');
		})
		// $('.trasection_history').DataTable();
		var hashurl = window.location.hash;
		if (hashurl) {
			$('.nav-tabs a[href="' + hashurl + '"]').tab('show');
		}
		var activeTab = localStorage.getItem('activeTab');
		if (activeTab) {
			$('.nav-tabs a[href="' + activeTab + '"]').tab('show');
		}
		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			var tabName = $(e.target).attr('href');
			localStorage.setItem('activeTab', tabName);
		});
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
		//other
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

<script>
	function parsePeriod(period) {
		if (!period || !period.match(/(\d+)Y\s+(\d+)M\s+(\d+)D/)) {
			return {
				years: 0,
				months: 0,
				days: 0
			};
		}
		var parts = period.match(/(\d+)Y\s+(\d+)M\s+(\d+)D/);
		return {
			years: parseInt(parts[1], 10),
			months: parseInt(parts[2], 10),
			days: parseInt(parts[3], 10)
		};
	}

	function sumPeriods(period1, period2) {
		var p1 = parsePeriod(period1);
		var p2 = parsePeriod(period2);
		var totalDays = p1.days + p2.days;
		var totalMonths = p1.months + p2.months;
		var totalYears = p1.years + p2.years;
		if (totalDays >= 30) {
			totalMonths += Math.floor(totalDays / 30);
			totalDays = totalDays % 30;
		}
		if (totalMonths >= 12) {
			totalYears += Math.floor(totalMonths / 12);
			totalMonths = totalMonths % 12;
		}
		return `${totalYears}Y ${totalMonths}M ${totalDays}D`;
	}
	$(document).ready(function() {
		$(".contract_template_content_textarea").hide();
		var main_rank_career = $(".main_rank_career").text().trim();
		var main_other_rank_career = $(".main_other_rank_career").text().trim();
		var totalCareer = sumPeriods(main_rank_career, main_other_rank_career);
		if (main_rank_career || main_other_rank_career) {
			$(".main_total_rank_career").text(totalCareer);
		}

		function calculateAge(dateString) {
			var today = new Date();
			var birthDate = new Date(dateString);
			var age = today.getFullYear() - birthDate.getFullYear();
			var m = today.getMonth() - birthDate.getMonth();
			if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
				age--;
			}
			return age;
		}
		$('.update_birthdate').on('change', function() {
			var birthday = $(this).val();
			if (birthday) {
				var age = calculateAge(birthday);
				$('.update_age').val(age);
			}
		});
		$('.add_birthdate').on('change', function() {
			var birthday = $(this).val();
			if (birthday) {
				var age = calculateAge(birthday);
				$('.add_age').val(age);
			}
		});
		appValidateForm($('#add_update_passpord_detail_candidate-form'), {
			document_type_password: 'required',
		});
		var main_vsl_career = $(".main_vsl_career").text().trim();
		var other_vsl_career = $(".other_vsl_career").text().trim();
		var totalvslCareer = sumPeriods(main_vsl_career, other_vsl_career);
		if (main_vsl_career || other_vsl_career) {
			$(".main_total_vsl_career").text(totalvslCareer);
		}
		licenceallrows('travel_document');
		otherlicenceallrows('other_licence_document');
		licence3allrows('licence_3_document');
		licence4allrows('licence_4_document');
		licence5allrows('licence_5_document');
		licence6allrows('licence_6_document');
	});

	function send_email_candidate() {
		var candidate_id = $('input[name="add_travel_candidate_id"]').val();
		var email_template_id = $('#template_for').val();
		var $button = $('#sendEmailButton');
		$button.prop('disabled', true);
		$button.addClass('disabled');
		$.ajax({
			type: "post",
			url: admin_url + "recruitment/send_email_candidate",
			data: {
				candidate_id: candidate_id,
				email_template_id: email_template_id
			},
			success: function(response) {
				var data = JSON.parse(response);
				if (data.rs == true) {
					alert_float('success', 'Mail has been sent');
					$button.prop('disabled', false);
					$button.removeClass('disabled');
					$('#addrequestrenewinfoModal').find('input, textarea').val('');
					$('#addrequestrenewinfoModal').find('form')[0].reset();
					$('#template_for').selectpicker('refresh');
					$('#addrequestrenewinfoModal').modal('hide');
					if (data.count_email) {
						$('#count_email').html('<?php echo _l('email_sent'); ?>: ' + data.count_email);
					}
				} else {
					alert_float('danger', 'Mail has not been sent');
					$('#addrequestrenewinfoModal').modal('hide');
				}
			},
			error: function() {
				alert_float('danger', 'Please select Email Templete');
				$('#addrequestrenewinfoModal').modal('hide');
			},
		});
	}

	function licenceallrows(table_class = 'travel_document') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('#' + table_id + '_info').hide();
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
	}

	function otherlicenceallrows(table_class = 'other_licence_document') {
		if (table_class != '') {

			var table_id = $('.' + table_class).attr('id');
			$('#' + table_id + '_info').hide();
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
	}

	function licence3allrows(table_class = 'licence_3_document') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('#' + table_id + '_info').hide();
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
	}

	function licence4allrows(table_class = 'licence_4_document') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('#' + table_id + '_info').hide();
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
	}

	function licence5allrows(table_class = 'licence_5_document') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('#' + table_id + '_info').hide();
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
	}

	function licence6allrows(table_class = 'licence_6_document') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('#' + table_id + '_info').hide();
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
	}

	function toggleTableRows(table_class = '') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
		var viewAllChecked = document.getElementById('view_all').checked;
		var rows = document.querySelectorAll('.project-overview');
		if (viewAllChecked) {
			$('.hidden-expire1').show();
		} else {
			$('.hidden-expire1').hide();
		}
		rows.forEach(function(row) {
			var expiryStatus = row.getAttribute('data-expiry-status');
			if (viewAllChecked || expiryStatus !== 'color: #CECEBF') {
				row.style.display = '';
			} else {
				row.style.display = 'none';
			}
			if (viewAllChecked) {
				$('.hidden-expire1').show();
			} else {
				$('.hidden-expire1').hide();
			}
		});
	}
	document.addEventListener('DOMContentLoaded', function() {
		toggleTableRows();
	});

	function otherlicencetoggleTableRows(table_class = '') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
		var viewAllChecked = document.getElementById('view_all_other_licence').checked;
		var rows = document.querySelectorAll('.project-overview-3');
		if (viewAllChecked) {
			$('.hidden-expire2').show();
		} else {
			$('.hidden-expire2').hide();
		}
		rows.forEach(function(row) {
			var expiryStatus = row.getAttribute('data-expiry-status');
			if (viewAllChecked || expiryStatus !== 'color: #CECEBF') {
				row.style.display = '';
			} else {
				row.style.display = 'none';
			}
			if (viewAllChecked) {
				$('.hidden-expire2').show();
			} else {
				$('.hidden-expire2').hide();
			}
		});
	}
	document.addEventListener('DOMContentLoaded', function() {
		otherlicencetoggleTableRows();
	});

	function licence3toggleTableRows(table_class = '') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
		var viewAllChecked = document.getElementById('view_all_licence_3').checked;
		var rows = document.querySelectorAll('.project-overview-4');
		if (viewAllChecked) {
			$('.hidden-expire3').show();
		} else {
			$('.hidden-expire3').hide();
		}
		rows.forEach(function(row) {
			var expiryStatus = row.getAttribute('data-expiry-status');
			if (viewAllChecked || expiryStatus !== 'color: #CECEBF') {
				row.style.display = '';
			} else {
				row.style.display = 'none';
			}
			if (viewAllChecked) {
				$('.hidden-expire3').show();
			} else {
				$('.hidden-expire3').hide();
			}
		});
	}
	document.addEventListener('DOMContentLoaded', function() {
		licence3toggleTableRows();
	});

	function licence4toggleTableRows(table_class = '') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
		var viewAllChecked = document.getElementById('view_all_licence_4').checked;
		var rows = document.querySelectorAll('.project-overview-41');
		if (viewAllChecked) {
			$('.hidden-expire4').show();
		} else {
			$('.hidden-expire4').hide();
		}
		rows.forEach(function(row) {
			var expiryStatus = row.getAttribute('data-expiry-status');
			if (viewAllChecked || expiryStatus !== 'color: #CECEBF') {
				row.style.display = '';
			} else {
				row.style.display = 'none';
			}
			if (viewAllChecked) {
				$('.hidden-expire4').show();
			} else {
				$('.hidden-expire4').hide();
			}
		});
	}
	document.addEventListener('DOMContentLoaded', function() {
		licence4toggleTableRows();
	});

	function licence5toggleTableRows(table_class = '') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
		var viewAllChecked = document.getElementById('view_all_licence_5').checked;
		var rows = document.querySelectorAll('.project-overview-5');
		if (viewAllChecked) {
			$('.hidden-expire5').show();
		} else {
			$('.hidden-expire5').hide();
		}
		rows.forEach(function(row) {
			var expiryStatus = row.getAttribute('data-expiry-status');
			if (viewAllChecked || expiryStatus !== 'color: #CECEBF') {
				row.style.display = '';
			} else {
				row.style.display = 'none';
			}
			if (viewAllChecked) {
				$('.hidden-expire5').show();
			} else {
				$('.hidden-expire5').hide();
			}
		});
	}
	document.addEventListener('DOMContentLoaded', function() {
		licence5toggleTableRows();
	});

	function licence6toggleTableRows(table_class = '') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
		var viewAllChecked = document.getElementById('view_all_licence_6').checked;
		var rows = document.querySelectorAll('.project-overview-6');
		if (viewAllChecked) {
			$('.hidden-expire6').show();
		} else {
			$('.hidden-expire6').hide();
		}
		rows.forEach(function(row) {
			var expiryStatus = row.getAttribute('data-expiry-status');
			if (viewAllChecked || expiryStatus !== 'color: #CECEBF') {
				row.style.display = '';
			} else {
				row.style.display = 'none';
			}
			if (viewAllChecked) {
				$('.hidden-expire6').show();
			} else {
				$('.hidden-expire6').hide();
			}
		});
	}
	document.addEventListener('DOMContentLoaded', function() {
		licence6toggleTableRows();
	});
	viewhiddenTable1();
	viewhiddenTable2();
	viewhiddenTable3();
	viewhiddenTable4();
	viewhiddenTable5();
	viewhiddenTable6();
	$('#view_hidden_1').change(function() {
		viewhiddenTable1();
	});
	$('#view_hidden_2').change(function() {
		viewhiddenTable2();
	});
	$('#view_hidden_3').change(function() {
		viewhiddenTable3();
	});
	$('#view_hidden_4').change(function() {
		viewhiddenTable4();
	});
	$('#view_hidden_5').change(function() {
		viewhiddenTable5();
	});
	$('#view_hidden_6').change(function() {
		viewhiddenTable6();
	});

	function viewhiddenTable1() {
		if ($('#view_hidden_1').is(':checked')) {
			$('.hidden-expire1').show();
			// $('.sendmail_candidate').show();
			// $('.crew_call').show();
			// $('.crew_test').show();
			// $('.crew_interview').show();
		} else {
			$('.hidden-expire1').hide();
			// $('.sendmail_candidate').hide();
			// $('.crew_call').hide();
			// $('.crew_test').hide();
			// $('.crew_interview').hide();
		}
	}

	function viewhiddenTable2() {
		if ($('#view_hidden_2').is(':checked')) {
			$('.hidden-expire2').show();
			// $('.sendmail_other_license').show();
			// $('.other_licence_call').show();
			// $('.crew_license_test').show();
			// $('.crew_license_interview').show();
		} else {
			$('.hidden-expire2').hide();
			// $('.sendmail_other_license').hide();
			// $('.other_licence_call').hide();
			// $('.crew_license_test').hide();
			// $('.crew_license_interview').hide();
		}
	}

	function viewhiddenTable3() {
		if ($('#view_hidden_3').is(':checked')) {
			$('.hidden-expire3').show();
			// $('.sendmail_licence_3').show();
			// $('.call_licence_3').show();
			// $('.crew_licence_3_test').show();
			// $('.crew_licence_3_interview').show();
		} else {
			$('.hidden-expire3').hide();
			// $('.sendmail_licence_3').hide();
			// $('.call_licence_3').hide();
			// $('.crew_licence_3_test').hide();
			// $('.crew_licence_3_interview').hide();
		}
	}

	function viewhiddenTable4() {
		if ($('#view_hidden_4').is(':checked')) {
			$('.hidden-expire4').show();
			// $('.sendmail_licence_4').show();
			// $('.call_licence_4').show();
			// $('.crew_licence_4_test').show();
			// $('.crew_licence_4_interview').show();
		} else {
			$('.hidden-expire4').hide();
			// $('.sendmail_licence_4').hide();
			// $('.call_licence_4').hide();
			// $('.crew_licence_4_test').hide();
			// $('.crew_licence_4_interview').hide();
		}
	}

	function viewhiddenTable5() {
		if ($('#view_hidden_5').is(':checked')) {
			$('.hidden-expire5').show();
			// $('.sendmail_licence_5').show();
			// $('.call_licence_5').show();
			// $('.crew_licence_5_test').show();
			// $('.crew_licence_5_interview').show();
		} else {
			$('.hidden-expire5').hide();
			// $('.sendmail_licence_5').hide();
			// $('.call_licence_5').hide();
			// $('.crew_licence_5_test').hide();
			// $('.crew_licence_5_interview').hide();
		}
	}

	function viewhiddenTable6() {
		if ($('#view_hidden_6').is(':checked')) {
			$('.hidden-expire6').show();
			// $('.sendmail_licence_6').show();
			// $('.call_licence_6').show();
			// $('.crew_licence_6_test').show();
			// $('.crew_licence_6_interview').show();
		} else {
			$('.hidden-expire6').hide();
			// $('.sendmail_licence_6').hide();
			// $('.call_licence_6').hide();
			// $('.crew_licence_6_test').hide();
			// $('.crew_licence_6_interview').hide();
		}
	}

	function candidatetoggleTableRows(table_class = '') {
		if (table_class != '') {
			var table_id = $('.' + table_class).attr('id');
			$('select[name="' + table_id + '_length"]').val('-1').trigger('change');
		}
		var viewAllChecked = document.getElementById('view_all_2').checked;
		var rows = document.querySelectorAll('.project-overview-2');
		rows.forEach(function(row) {
			var expiryStatus = row.getAttribute('data-expiry-status-2');
			if (viewAllChecked || expiryStatus !== 'color: #CECEBF') {
				row.style.display = '';
			} else {
				row.style.display = 'none';
			}
		});
	}
	document.addEventListener('DOMContentLoaded', function() {
		candidatetoggleTableRows();
	});

	$(document).on('click', '.crew_sorting_data', function() {
		var type = $(this).data('type');
		$('tr.project-overview-transaction').hide();
		$('tr.project-overview-transaction').each(function() {
			var rowType = $(this).find('td:first').text().trim();
			if (rowType === type) {
				$(this).show();
			}
		});
		$('a[href="#transaction_histroy"]').tab('show');
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		var target = $(e.target).attr("href");
		if (target !== "#transaction_histroy") {
			$('tr.project-overview-transaction').show();
		}
	});

	$(document).on("change", "#contract_template", function() {
		var id = $(this).val();
		var candidate_id = $("#add_education_candidate_id").val();
		$.ajax({
			url: admin_url + "recruitment/get_contract_template_detail",
			type: "POST",
			data: {
				id: id,
				candidate_id: candidate_id
			},
			success: function(res) {
				var data = JSON.parse(res);
				if (data.status == 1) {
					$(".contract_template_content_textarea").show();
					init_editor('textarea[name="template_content"]');
					var contract_template = data.contract_template;
					setTimeout(() => {
						tinymce.get('template_content').setContent(contract_template.template_content_msg);
					}, 500);
				} else {
					alert_float("danger", "No data Found");
				}
			},
		});
	})
</script>
</body>

</html>