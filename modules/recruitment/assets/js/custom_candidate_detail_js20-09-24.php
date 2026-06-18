<script>
	init_selectpicker();

	$(function() {
		function calculateBoardingPerioddays(embarkation_date, disembarkation_date) {
			if (embarkation_date !== '' && disembarkation_date !== '') {
				var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
				var embarkation = moment(embarkation_date, formats);
				var disembarkation = moment(disembarkation_date, formats);
				var difference = Math.abs(disembarkation.diff(embarkation));
				var millisecondsPerDay = 1000 * 60 * 60 * 24;
				var daysDifference = Math.floor(difference / millisecondsPerDay);

				return (daysDifference + 1) + ' days';
			} else {
				return '';
			}
		}

		function calculateBoardingPeriod(embarkation_date, disembarkation_date) {
			if (embarkation_date && disembarkation_date) {
				var formats = ["YYYY-MM-DD", "D.M.YYYY", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
				var embarkation = null;
				var disembarkation = null;

				function parseDate(dateString, format) {
					return moment(dateString, format, true).isValid() ? moment(dateString, format) : null;
				}

				for (var i = 0; i < formats.length; i++) {
					embarkation = parseDate(embarkation_date, formats[i]);
					disembarkation = parseDate(disembarkation_date, formats[i]);
					if (embarkation && disembarkation) {
						break;
					}
				}

				if (embarkation && disembarkation) {
					var years = disembarkation.diff(embarkation, 'years');
					embarkation.add(years, 'years');

					var months = disembarkation.diff(embarkation, 'months');
					embarkation.add(months, 'months');

					var days = disembarkation.diff(embarkation, 'days') + 1;

					if (days >= 31) {
						months += 1;
						days = 0;
					}

					var formattedDifference = years + 'Y ' + months + 'M ' + days + 'D';
					return formattedDifference;
				} else {
					return '';
				}
			} else {
				return '';
			}
		}

		function calculateBoardingPeriodmonth(embarkation_date, disembarkation_date) {
			if (embarkation_date && disembarkation_date) {
				var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
				var embarkation = moment(embarkation_date, formats);
				var disembarkation = moment(disembarkation_date, formats);

				var differenceInMilliseconds = Math.abs(disembarkation.diff(embarkation));
				var daysDifference = differenceInMilliseconds / (1000 * 60 * 60 * 24);
				var monthsDifference = daysDifference / 30;
				var formattedMonthsDifference = monthsDifference.toFixed(1);
				return formattedMonthsDifference;

			} else {
				return '';
			}
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

		// function updateRenewRequestContent() {
		// 	if ($('#request_renew').is(':checked')) {
		// 		$('.renew_request_content').show();
		// 	} else {
		// 		$('.renew_request_content').hide();
		// 	}
		// }

		function updateRenewRequestContent() {
			var selectedValue = $("select[name='request_renew']").val();
			if (selectedValue === null || selectedValue === "" || selectedValue === "0") {
				$(".renew_request_content").hide();
			} else {
				$(".renew_request_content").show();
			}
		}




		$(".family_info_detail_edit").on("click", function() {
			var id = $(this).attr("data-id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/editFamilyCandidate/" + id,
				success: function(response) {
					$('#family_details_modal').modal('show');
					var data = JSON.parse(response);
					$("input[name='family_info_id']").val(data.id);
					$("input[name='family_candidate_id']").val(data.candidate);
					$("select[name='edit_family_religion']").selectpicker('destroy');
					$("select[name='edit_family_religion']").val(data.family_religion);
					$("select[name='edit_family_religion']").selectpicker('refresh');
					$("#edit_family_name").val(data.family_name);
					$("select[name='edit_family_id_no']").selectpicker('destroy');
					$("select[name='edit_family_id_no']").val(data.id_no);
					$("select[name='edit_family_id_no']").selectpicker('refresh');
					$("#edit_family_birthday").val(data.birthday);
					var age = calculateAge(data.birthday);
					$('.update_age').val(age);
					$("#edit_family_final_academy_career").val(data.final_academy_career);
					$("#edit_family_school").val(data.school);
					$("#edit_family_major").val(data.major);
					$("#edit_family_position").val(data.position);
					$("#edit_family_grade").val(data.grade);
					$("#edit_family_basic_deduction").val(data.basic_deduction);
					$("#edit_family_child_bearing").val(data.child_bearing);
					$("#edit_family_contact_number").val(data.contact_number);
					$("#edit_family_contact_number2").val(data.contact_number2);
				},
				// error: error,
			});
		});

		$(".education_info_detail_edit").on("click", function() {
			var id = $(this).attr("data-id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/editEducationCandidate/" + id,
				success: function(response) {
					$('#editEducationinfoModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='education_id']").val(data.id);
					$("input[name='edit_education_candidate_id']").val(data.candidate);
					$("#edit_education_year").val(data.year);
					// $("#edit_course_type").val(data.course_type);
					$("select[name='course_type[]']").selectpicker('destroy');
					$("select[name='course_type[]']").val(data.course_type);
					$("select[name='course_type[]']").selectpicker('refresh');
					$("#edit_course_name").val(data.course_name);
					$("#edit_edu_start_date").val(data.edu_start_date);
					$("#edit_edu_start_date").val(data.edu_start_date);
					$("#edit_edu_finish_date").val(data.edu_finish_date);
					$("#edit_edu_date").val(data.edu_date);
					$("#edit_valid_date").val(data.valid_date);
					$("#edit_edu_institution").val(data.edu_institution);
					$("#edit_completed_edu").val(data.completed_edu);
				},
				// error: error,
			});

		});

		$(".school_info_detail_edit").on("click", function() {
			var id = $(this).attr("data-id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/editSchoolCandidate/" + id,
				success: function(response) {
					$('#editSchoolinfoModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='school_id']").val(data.id);
					$("input[name='edit_school_candidate_id']").val(data.candidate);
					$("#edit_enterance_date").val(data.enterance_date);
					$("#edit_graduation_date").val(data.graduation_date);
					$("#edit_university").val(data.university);
					$("#edit_school_name").val(data.school_name);
					// $("#edit_faculty").val(data.faculty);
					$("#edit_major_name").val(data.major_name);
					$("#edit_year_of_graduation").val(data.year_of_graduation);
					// $("#edit_final_academic_career").val(data.final_academic_career);
					$("#edit_academic_career_type").val(data.academic_career_type);
					$("#edit_remark").val(data.remark);
				},
				// error: error,
			});

		});

		$(".reward_info_detail_edit").on("click", function() {
			var id = $(this).attr("data-id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_reward_detail_candidate/" + id,
				success: function(response) {
					$('#addupdateRewardinfoModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='reward_id']").val(data.id);
					$("input[name='add_reward_candidate_id']").val(data.candidate);
					$("#app_date").val(data.app_date);
					$("#award_punishment").val(data.award_punishment);
					$("#grade_rank").val(data.grade_rank);
					$("#award_punishment_kind").val(data.award_punishment_kind);
					$("#award_punishment_reason").val(data.award_punishment_reason);
					$("#rewards_remark").val(data.rewards_remark);
					$("#reward_label").text("Edit Reward Info");
				},
				// error: error,
			});
		});


		$(".edit_medical_info_detail").on("click", function() {
			var id = $(this).attr("data-id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_medical_detail_candidate/" + id,
				success: function(response) {
					$('#addMedicalinfoModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='medical_id']").val(data.id);
					$("input[name='add_medical_candidate_id']").val(data.candidate);
					$("#medical_test_date").val(data.medical_test_date);
					$("#valid_test_date").val(data.valid_test_date);
					$("#medical_test_division").val(data.medical_test_division);
					$("#judgement_y_n").val(data.judgement_y_n);
					$("#medical_hospital").val(data.medical_hospital);
					$("#judgement").val(data.judgement);
					$("#final_option").val(data.final_option);
					$("#medical_remark").val(data.medical_remark);
					$("#medical_label").text("Edit Medical Info");
				},
				// error: error,
			});
		});

		$(".edit_promotion_info_detail").on("click", function() {
			var id = $(this).attr("data-id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_promotion_detail_candidate/" + id,
				success: function(response) {
					$('#addPromotioninfoModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='promotion_id']").val(data.id);
					$("input[name='add_promotion_candidate_id']").val(data.candidate);
					$("#promotion_app_date").val(data.app_date);
					$("#final_grade").val(data.final_grade);
					$("#promotion_grade").val(data.promotion_grade);
					$("#final_depart").val(data.final_depart);
					$("#length_of_stay").val(data.length_of_stay);
					$("#promotion_label").text("Edit Promotion Info");
				},
				// error: error,
			});
		});

		$(".edit_licence_info_detail").on("click", function() {
			var id = $(this).attr("data-id");
			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_licence_detail_candidate/" + id,
				success: function(response) {
					$('#addLicenceinfoModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='licence_id']").val(data.id);
					$("input[name='add_licence_candidate_id']").val(data.candidate);
					// $("#lic_kind_division").val(data.kind_division);
					$("select[name='lic_kind_division[]']").selectpicker('destroy');
					$("select[name='lic_kind_division[]']").val(data.kind_division);
					$("select[name='lic_kind_division[]']").selectpicker('refresh');
					$("#lic_licence_no").val(data.licence_no);
					$("#lic_acquisition_date").val(data.acquisition_date);
					$("#lic_exipiry_date").val(data.exipiry_date);
					$("#lic_issue_authority").val(data.issue_authority);
					$("#licence_remark").val(data.remark);
					$("#licence_label").text("Edit License Info");
				},
				// error: error,
			});
		});

		$(".edit_passport_info_detail").on("click", function() {
			var id = $(this).attr("data-id");
			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_passport_detail_candidate/" + id,
				success: function(response) {
					$('#addPassportinfoModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='passport_id']").val(data.id);
					$("input[name='add_passport_candidate_id']").val(data.candidate);
					$("input[name='passport_no']").val(data.passport_no);
					$("#acquisition_date").val(data.acquisition_date);
					$("#issue_date").val(data.issue_date);
					$("#exipiry_date").val(data.exipiry_date);
					$("#issue_authority").val(data.issue_authority);
					$("input[name='remark']").val(data.remark);
					$("input[name='expiration_date_passport']").val(data.expiration_date_passport);
					$("select[name='document_type_password']").selectpicker('destroy');
					$("select[name='document_type_password']").val(data.document_type_password);
					$("select[name='document_type_password']").selectpicker('refresh');
					$("#passpord_label").text("Edit Passport Info");
				},
				// error: error,
			});
		});

		// $('#request_renew').change(function() {
		// 	updateRenewRequestContent();
		// });





		$("#document_type_password").on("change", function() {
			var id = $(this).val();

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/get_document_type_passport/" + id,
				success: function(response) {
					var data = JSON.parse(response);
					$("#expiration_date_passport").val(data)
				},
			});

		});

		$("body").on("click", '.edit_travel_info_detail', function() {
			var candidate_id = $(this).data("candidate_id") || 0;
			var setting_id = $(this).data("setting_id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_travel_detail_candidate/" + candidate_id + '/' + setting_id,
				success: function(response) {
					var data = JSON.parse(response);
					$('#addTravelinfoModal').modal('show');

					$("select[name='request_renew']").selectpicker('destroy');
					$("select[name='request_renew']").val(data.request_renew);
					$("select[name='request_renew']").selectpicker('refresh');

					updateRenewRequestContent();

					$("select[name='document_type']").selectpicker('destroy');
					$("select[name='document_type']").val(data.document_type);
					$("select[name='document_type']").selectpicker('refresh');



					var baseUrl = "<?php echo module_dir_url(RECRUITMENT_MODULE_NAME . '/uploads/candidate/travel_file/'); ?>";
					if (data.attach_file) {
						$("#licencefilelabel").html(
							`<a href="${baseUrl}${data.attach_file}" target="_blank">${data.attach_file}</a> 
   						 <span class="delete-icon" style="cursor:pointer; color:red;" data-id="${data.id}">&#10006;</span>`
						);
					}


					var expiry_date_obj_new = new Date(data.expiry_date);
					var current_date_obj_new = new Date();
					var interval_remaining_new = expiry_date_obj_new - current_date_obj_new;
					var remaining_days_new = Math.floor(interval_remaining_new / (1000 * 60 * 60 * 24)); // Whole days

					if (expiry_date_obj_new > current_date_obj_new) {
						if (expiry_date_obj_new) {
							remaining_days_new += 1;
						} else {
							remaining_days_new = '';
						}
					}

					if (remaining_days_new < 0 && remaining_days_new != '' && data.no_expired != 1) {
						$('#divhideexpire2').show();
						if (data.hideexpire == 1) {
							$('#hideexpire2').prop('checked', true);
						} else {
							$('#hideexpire2').prop('checked', false);
						}
					} else {
						$('#divhideexpire2').hide();
					}

					$("textarea[name='renew_request_status_update']").val(data.renew_request_status_update);
					$("input[name='travel_id']").val(data.id);

					$("input[name='licence_no']").val(data.licence_no);
					$("input[name='expiry_date']").val(data.expiry_date);
					$("input[name='acquisition_date']").val(data.acquisition_date);
					$("#expiration_date").val(data.expiration_date);
					$("input[name='issue_authority']").val(data.issue_authority);
					$("input[name='remark']").val(data.remark);
				},
			});
		});


		$("body").on("click", '.edit_other_licence_info_detail', function() {
			var candidate_id = $(this).data("candidate_id") || 0;
			var setting_id = $(this).data("setting_id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_other_license_detail_candidate/" + candidate_id + '/' + setting_id,
				success: function(response) {
					var data = JSON.parse(response);
					$('#addotherLicenceinfoModal').modal('show');

					$("select[name='document_type']").selectpicker('destroy');
					$("select[name='document_type']").val(data.document_type);
					$("select[name='document_type']").selectpicker('refresh');

					var baseUrl = "<?php echo module_dir_url(RECRUITMENT_MODULE_NAME . '/uploads/candidate/other_licence_file/'); ?>";
					if (data.attach_file) {
						$("#otherlicencefilelabel").html(
							`<a href="${baseUrl}${data.attach_file}" target="_blank">${data.attach_file}</a> 
   						 <span class="other-licence-delete-icon" style="cursor:pointer; color:red;" data-id="${data.id}">&#10006;</span>`
						);
					}

					var expiry_date_obj_new = new Date(data.expiry_date);
					var current_date_obj_new = new Date();

					var interval_remaining_new = expiry_date_obj_new - current_date_obj_new;

					var remaining_days_new = Math.floor(interval_remaining_new / (1000 * 60 * 60 * 24)); // Whole days

					if (expiry_date_obj_new > current_date_obj_new) {
						if (expiry_date_obj_new) {
							remaining_days_new += 1;
						} else {
							remaining_days_new = '';
						}
					}

					if (remaining_days_new < 0 && remaining_days_new != '' && data.no_expired != 1) {
						$('#divhideexpire').show();
						if (data.hideexpire == 1) {
							$('#hideexpire').prop('checked', true);
						} else {
							$('#hideexpire').prop('checked', false);
						}
					} else {
						$('#divhideexpire').hide();
					}

					$("textarea[name='renew_request_status_update']").val(data.renew_request_status_update);
					$("input[name='other_licence_id']").val(data.id);

					$("input[name='licence_no']").val(data.licence_no);
					$("input[name='expiry_date']").val(data.expiry_date);
					$("input[name='acquisition_date']").val(data.acquisition_date);
					$("#expiration_date").val(data.expiration_date);
					$("input[name='issue_authority']").val(data.issue_authority);
					$("input[name='remark']").val(data.remark);
				},
			});
		});

		$("body").on("click", '.edit_licence_3_info_detail', function() {
			var candidate_id = $(this).data("candidate_id") || 0;
			var setting_id = $(this).data("setting_id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_license_3_detail_candidate/" + candidate_id + '/' + setting_id,
				success: function(response) {
					var data = JSON.parse(response);
					$('#addLicence3infoModal').modal('show');

					$("select[name='document_type']").selectpicker('destroy');
					$("select[name='document_type']").val(data.document_type);
					$("select[name='document_type']").selectpicker('refresh');

					var baseUrl = "<?php echo module_dir_url(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_3_file/'); ?>";
					if (data.attach_file) {
						$("#licence3filelabel").html(
							`<a href="${baseUrl}${data.attach_file}" target="_blank">${data.attach_file}</a> 
   						 <span class="licence3-delete-icon" style="cursor:pointer; color:red;" data-id="${data.id}">&#10006;</span>`
						);
					}

					$("textarea[name='renew_request_status_update']").val(data.renew_request_status_update);
					$("input[name='licence_3_id']").val(data.id);

					$("input[name='licence_no']").val(data.licence_no);
					$("input[name='expiry_date']").val(data.expiry_date);

					var expiry_date_obj_new = new Date(data.expiry_date);
					var current_date_obj_new = new Date();
					var interval_remaining_new = expiry_date_obj_new - current_date_obj_new;
					var remaining_days_new = Math.floor(interval_remaining_new / (1000 * 60 * 60 * 24)); // Whole days

					if (expiry_date_obj_new > current_date_obj_new) {
						if (expiry_date_obj_new) {
							remaining_days_new += 1;
						} else {
							remaining_days_new = '';
						}
					}

					if (remaining_days_new < 0 && remaining_days_new != '' && data.no_expired != 1) {
						$('#divhideexpire3').show();
						if (data.hideexpire == 1) {
							$('#hideexpire3').prop('checked', true);
						} else {
							$('#hideexpire3').prop('checked', false);
						}
					} else {
						$('#divhideexpire2').hide();
					}
					$("input[name='acquisition_date']").val(data.acquisition_date);
					$("#expiration_date").val(data.expiration_date);
					$("input[name='issue_authority']").val(data.issue_authority);
					$("input[name='remark']").val(data.remark);
				},
			});
		});


		$("body").on("click", '.edit_licence_4_info_detail', function() {
			var candidate_id = $(this).data("candidate_id") || 0;
			var setting_id = $(this).data("setting_id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_license_4_detail_candidate/" + candidate_id + '/' + setting_id,
				success: function(response) {
					var data = JSON.parse(response);
					$('#addLicence4infoModal').modal('show');

					$("select[name='document_type']").selectpicker('destroy');
					$("select[name='document_type']").val(data.document_type);
					$("select[name='document_type']").selectpicker('refresh');

					var baseUrl = "<?php echo module_dir_url(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_4_file/'); ?>";
					if (data.attach_file) {
						$("#licence4filelabel").html(
							`<a href="${baseUrl}${data.attach_file}" target="_blank">${data.attach_file}</a> 
   						 <span class="licence4-delete-icon" style="cursor:pointer; color:red;" data-id="${data.id}">&#10006;</span>`
						);
					}

					$("textarea[name='renew_request_status_update']").val(data.renew_request_status_update);
					$("input[name='licence_4_id']").val(data.id);

					$("input[name='licence_no']").val(data.licence_no);
					$("input[name='expiry_date']").val(data.expiry_date);

					var expiry_date_obj_new = new Date(data.expiry_date);
					var current_date_obj_new = new Date();
					var interval_remaining_new = expiry_date_obj_new - current_date_obj_new;
					var remaining_days_new = Math.floor(interval_remaining_new / (1000 * 60 * 60 * 24)); // Whole days

					if (expiry_date_obj_new > current_date_obj_new) {
						if (expiry_date_obj_new) {
							remaining_days_new += 1;
						} else {
							remaining_days_new = '';
						}
					}

					if (remaining_days_new < 0 && remaining_days_new != '' && data.no_expired != 1) {
						$('#divhideexpire4').show();
						if (data.hideexpire == 1) {
							$('#hideexpire4').prop('checked', true);
						} else {
							$('#hideexpire4').prop('checked', false);
						}
					} else {
						$('#divhideexpire4').hide();
					}
					$("input[name='acquisition_date']").val(data.acquisition_date);
					$("#expiration_date").val(data.expiration_date);
					$("input[name='issue_authority']").val(data.issue_authority);
					$("input[name='remark']").val(data.remark);
				},
			});
		});

		$("body").on("click", '.edit_licence_5_info_detail', function() {
			var candidate_id = $(this).data("candidate_id") || 0;
			var setting_id = $(this).data("setting_id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_license_5_detail_candidate/" + candidate_id + '/' + setting_id,
				success: function(response) {
					var data = JSON.parse(response);
					$('#addLicence5infoModal').modal('show');

					$("select[name='document_type']").selectpicker('destroy');
					$("select[name='document_type']").val(data.document_type);
					$("select[name='document_type']").selectpicker('refresh');

					var baseUrl = "<?php echo module_dir_url(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_5_file/'); ?>";
					if (data.attach_file) {
						$("#licence5filelabel").html(
							`<a href="${baseUrl}${data.attach_file}" target="_blank">${data.attach_file}</a> 
   						 <span class="licence5-delete-icon" style="cursor:pointer; color:red;" data-id="${data.id}">&#10006;</span>`
						);
					}

					$("textarea[name='renew_request_status_update']").val(data.renew_request_status_update);
					$("input[name='licence_5_id']").val(data.id);
					$("input[name='licence_no']").val(data.licence_no);
					$("input[name='expiry_date']").val(data.expiry_date);
					var expiry_date_obj_new = new Date(data.expiry_date);
					var current_date_obj_new = new Date();
					var interval_remaining_new = expiry_date_obj_new - current_date_obj_new;
					var remaining_days_new = Math.floor(interval_remaining_new / (1000 * 60 * 60 * 24)); // Whole days

					if (expiry_date_obj_new > current_date_obj_new) {
						if (expiry_date_obj_new) {
							remaining_days_new += 1;
						} else {
							remaining_days_new = '';
						}
					}

					if (remaining_days_new < 0 && remaining_days_new != '' && data.no_expired != 1) {
						$('#divhideexpire5').show();
						if (data.hideexpire == 1) {
							$('#hideexpire5').prop('checked', true);
						} else {
							$('#hideexpire5').prop('checked', false);
						}
					} else {
						$('#divhideexpire5').hide();
					}
					$("input[name='acquisition_date']").val(data.acquisition_date);
					$("#expiration_date").val(data.expiration_date);
					$("input[name='issue_authority']").val(data.issue_authority);
					$("input[name='remark']").val(data.remark);
				},
			});
		});

		$("body").on("click", '.edit_licence_6_info_detail', function() {
			var candidate_id = $(this).data("candidate_id") || 0;
			var setting_id = $(this).data("setting_id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_license_6_detail_candidate/" + candidate_id + '/' + setting_id,
				success: function(response) {
					var data = JSON.parse(response);
					$('#addLicence6infoModal').modal('show');

					$("select[name='document_type']").selectpicker('destroy');
					$("select[name='document_type']").val(data.document_type);
					$("select[name='document_type']").selectpicker('refresh');

					var baseUrl = "<?php echo module_dir_url(RECRUITMENT_MODULE_NAME . '/uploads/candidate/licence_6_file/'); ?>";
					if (data.attach_file) {
						$("#licence6filelabel").html(
							`<a href="${baseUrl}${data.attach_file}" target="_blank">${data.attach_file}</a> 
   						 <span class="licence6-delete-icon" style="cursor:pointer; color:red;" data-id="${data.id}">&#10006;</span>`
						);
					}

					$("textarea[name='renew_request_status_update']").val(data.renew_request_status_update);
					$("input[name='licence_6_id']").val(data.id);
					$("input[name='licence_no']").val(data.licence_no);
					$("input[name='expiry_date']").val(data.expiry_date);

					var expiry_date_obj_new = new Date(data.expiry_date);
					var current_date_obj_new = new Date();
					var interval_remaining_new = expiry_date_obj_new - current_date_obj_new;
					var remaining_days_new = Math.floor(interval_remaining_new / (1000 * 60 * 60 * 24)); // Whole days

					if (expiry_date_obj_new > current_date_obj_new) {
						if (expiry_date_obj_new) {
							remaining_days_new += 1;
						} else {
							remaining_days_new = '';
						}
					}

					if (remaining_days_new < 0 && remaining_days_new != '' && data.no_expired != 1) {
						$('#divhideexpire6').show();
						if (data.hideexpire == 1) {
							$('#hideexpire6').prop('checked', true);
						} else {
							$('#hideexpire6').prop('checked', false);
						}
					} else {
						$('#divhideexpire6').hide();
					}
					$("input[name='acquisition_date']").val(data.acquisition_date);
					$("#expiration_date").val(data.expiration_date);
					$("input[name='issue_authority']").val(data.issue_authority);
					$("input[name='remark']").val(data.remark);
				},
			});
		});

		$("#licencefilelabel").on("click", ".delete-icon", function() {
			var id = $(this).data("id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					url: admin_url + "recruitment/delete_licence_image/",
					type: 'POST',
					data: {
						id: id
					},
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							$("#licencefilelabel").empty();
							alert_float('success', response.message);
						} else {
							alert_float('success', response.message);
						}
					},
					error: function() {
						alert_float('warning', 'An error occurred while trying to delete the file.');
					}
				});
			}
		});


		$("#otherlicencefilelabel").on("click", ".other-licence-delete-icon", function() {
			var id = $(this).data("id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					url: admin_url + "recruitment/delete_other_licence_image/",
					type: 'POST',
					data: {
						id: id
					},
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							$("#otherlicencefilelabel").empty();
							alert_float('success', response.message);
						} else {
							alert_float('success', response.message);
						}
					},
					error: function() {
						alert_float('warning', 'An error occurred while trying to delete the file.');
					}
				});
			}
		});

		$("#licence3filelabel").on("click", ".licence3-delete-icon", function() {
			var id = $(this).data("id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					url: admin_url + "recruitment/delete_licence3_image/",
					type: 'POST',
					data: {
						id: id
					},
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							$("#licence3filelabel").empty();
							alert_float('success', response.message);
						} else {
							alert_float('success', response.message);
						}
					},
					error: function() {
						alert_float('warning', 'An error occurred while trying to delete the file.');
					}
				});
			}
		});

		$("#licence4filelabel").on("click", ".licence4-delete-icon", function() {
			var id = $(this).data("id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					url: admin_url + "recruitment/delete_licence4_image/",
					type: 'POST',
					data: {
						id: id
					},
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							$("#licence4filelabel").empty();
							alert_float('success', response.message);
						} else {
							alert_float('success', response.message);
						}
					},
					error: function() {
						alert_float('warning', 'An error occurred while trying to delete the file.');
					}
				});
			}
		});

		$("#licence5filelabel").on("click", ".licence5-delete-icon", function() {
			var id = $(this).data("id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					url: admin_url + "recruitment/delete_licence5_image/",
					type: 'POST',
					data: {
						id: id
					},
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							$("#licence5filelabel").empty();
							alert_float('success', response.message);
						} else {
							alert_float('success', response.message);
						}
					},
					error: function() {
						alert_float('warning', 'An error occurred while trying to delete the file.');
					}
				});
			}
		});

		$("#licence6filelabel").on("click", ".licence6-delete-icon", function() {
			var id = $(this).data("id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					url: admin_url + "recruitment/delete_licence6_image/",
					type: 'POST',
					data: {
						id: id
					},
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							$("#licence6filelabel").empty();
							alert_float('success', response.message);
						} else {
							alert_float('success', response.message);
						}
					},
					error: function() {
						alert_float('warning', 'An error occurred while trying to delete the file.');
					}
				});
			}
		});


		$("select[name='request_renew']").on("change", function() {
			updateRenewRequestContent();
		});

		$(".edit_travel_request_renew").on("click", function() {
			var candidate_id = $(this).data("candidate_id") || 0;
			var setting_id = $(this).data("setting_id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_travel_detail_candidate/" + candidate_id + '/' + setting_id,
				success: function(response) {
					var data = JSON.parse(response);
					$('#addrequestrenewinfoModal').modal('show');
					$("input[name='travel_id']").val(data.id);
					$("select[name='template_for']").selectpicker('destroy');
					$("select[name='template_for']").val(data.request_renew);
					$("select[name='template_for']").selectpicker('refresh');
					$("#renew_request_status_update_modal").val(data.renew_request_status_update);
				},
			});
		});


		$(".edit_contract_info_detail").on("click", function() {
			var candidate_id = $(this).data("candidate_id") || 0;
			var setting_id = $(this).data("setting_id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_contract_detail_candidate/" + candidate_id + '/' + setting_id,
				success: function(response) {
					var data = JSON.parse(response);
					$('#addContractinfoModal').modal('show');
					$("input[name='contract_id']").val(data.tr_id);
					$("input[name='document_type']").val(data.id);
					$("input[name='licence_no']").val(data.licence_no);
					$("input[name='expiry_date']").val(data.expiry_date);
					$("input[name='acquisition_date']").val(data.acquisition_date);
					$("#expiration_date").val(data.expiration_date);
					$("input[name='issue_authority']").val(data.issue_authority);
					$("input[name='remark']").val(data.remark);
				},
			});
		});


		$(".edit_document_info_detail").on("click", function() {
			var id = $(this).attr("data-id");
			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_document_detail_candidate/" + id,
				success: function(response) {
					$('#addDocumentinfoModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='document_id']").val(data.id);
					$("input[name='add_document_candidate_id']").val(data.candidate);
					// $("#doc_kind_division").val(data.kind_division);
					$("select[name='doc_kind_division[]']").selectpicker('destroy');
					$("select[name='doc_kind_division[]']").val(data.kind_division);
					$("select[name='doc_kind_division[]']").selectpicker('refresh');
					$("#doc_licence_no").val(data.licence_no);
					$("#doc_issue_date").val(data.issue_date);
					$("#doc_exipiry_date").val(data.exipiry_date);
					$("#doc_issue_authority").val(data.issue);
					$("#doc_remark").val(data.remark);
					$("#document_label").text("Edit Document Info");
				},
				// error: error,
			});
		});


		$(".edit_flag_info_detail").on("click", function() {
			var id = $(this).attr("data-id");
			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_flag_detail_candidate/" + id,
				success: function(response) {
					$('#addflaginfoModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='flag_id']").val(data.id);
					$("input[name='add_flag_candidate_id']").val(data.candidate);
					$("select[name='flag_kind_division[]']").selectpicker('destroy');
					$("select[name='flag_kind_division[]']").val(data.kind_division);
					$("select[name='flag_kind_division[]']").selectpicker('refresh');
					$("#flag_licence_no").val(data.licence_no);
					$("#flag_issue_date").val(data.issue_date);
					$("#flag_exipiry_date").val(data.exipiry_date);
					$("#flag_issue_authority").val(data.issue);
					$("#flag_remark").val(data.remark);
					$("#flag_label").text("Edit Flag Info");
				},
			});
		});

		$(".psc_info_detail_edit").on("click", function() {
			var id = $(this).attr("data-id");
			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_psc_detail_candidate/" + id,
				success: function(response) {
					$('#addPscinfoModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='psc_id']").val(data.id);
					$("input[name='add_psc_candidate_id']").val(data.candidate);
					$("#psc_date").val(data.date);
					$("#vessel").val(data.vessel);
					$("#inspection").val(data.inspection);
					$("#country").val(data.country);
					$("#mou").val(data.mou);
					$("#port").val(data.port);
					$("#result").val(data.result);
					$("#deficiency").val(data.deficiency);
					$("#psc_label").text("Edit Psc Info");
				},
				// error: error,
			});
		});

		$(".family_info_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteFamilyCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$(".travel_info_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deletetravelInfo/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$(".license_2_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deletelicense2Info/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.license_3_detail_delete', function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deletelicense3Info/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.license_4_detail_delete', function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deletelicense4Info/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.license_5_detail_delete', function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deletelicense5Info/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.license_6_detail_delete', function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deletelicense6Info/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.psc_info_detail_delete', function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {

				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deletePscCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});
		$("body").on("click", '.education_info_detail_delete', function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteEducationCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}

		});

		$("body").on("click", '.school_info_detail_delete', function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteSchoolCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.reward_info_detail_delete', function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteRewardCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.edit_medical_info_detail_delete', function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteMedicalCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.promotion_info_detail_delete', function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deletePromotionCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.licence_info_detail_delete', function() {
			var confirm = window.confirm("Are You Sure you Want to Delete?");
			if (confirm) {
				var id = $(this).attr("data-id");
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteLicenseCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.passport_info_detail_delete', function() {
			var confirm = window.confirm("Are You Sure you Want to Delete?");
			if (confirm) {
				var id = $(this).attr("data-id");
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deletePassportCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);
						setTimeout(function() {
							window.location.reload();
						}, 500);
					},
				});
			}
		});

		$("body").on("click", '.document_info_detail_delete', function() {
			var confirm = window.confirm("Are You Sure you Want to Delete?");
			if (confirm) {
				var id = $(this).attr("data-id");
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteDocumentCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$("body").on("click", '.flag_info_detail_delete', function() {
			var confirm = window.confirm("Are You Sure you Want to Delete?");
			if (confirm) {
				var id = $(this).attr("data-id");
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteFlagCandidate/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
				});
			}
		});

		$('#addOnBoardCompanyModal').on('show.bs.modal', function() {
			<?php $is_edit = '0'; ?>
			var checkbox = '<?php echo check_on_board($candidate->id, 'rec_on_board_company', $is_edit); ?>';

			if (checkbox !== 'true') {
				$('#cur_onboard_section').show();
			} else {
				$('#cur_onboard_section').hide();
			}
		});

		$('#addOnBoardOtherCompanyModal').on('show.bs.modal', function() {
			<?php $is_edit = '0'; ?>
			var checkbox = '<?php echo check_on_board($candidate->id, 'rec_on_board_other_company', $is_edit); ?>';

			if (checkbox !== 'true') {
				$('#cur_onboard_other_section').show();
			} else {
				$('#cur_onboard_other_section').hide();
			}
		});

		$(".edit_on_board_company_detail").on("click", function() {
			var id = $(this).attr("data-id");
			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_on_board_company/" + id,
				success: function(response) {
					$('#addOnBoardCompanyModal').modal('show');
					var data = JSON.parse(response);

					$("input[name='on_board_company_id']").val(data.id);
					$("input[name='add_on_board_company_candidate_id']").val(data.candidate);
					$("select[name='grade_rank']").selectpicker('destroy');
					$("select[name='grade_rank']").val(data.grade_rank);
					$("select[name='grade_rank']").selectpicker('refresh');
					$("input[name='rank']").val(data.rank);
					$("select[name='vessel_name']").selectpicker('destroy');
					$("select[name='vessel_name']").val(data.vessel_name);
					$("select[name='vessel_name']").selectpicker('refresh');
					$("select[name='vessel_type[]']").selectpicker('destroy');
					$("select[name='vessel_type[]']").val(data.vessel_type);
					$("select[name='vessel_type[]']").selectpicker('refresh');
					$("input[name='gross_ton']").val(data.gross_ton);
					$("input[name='engine_type']").val(data.engine_type);
					$("input[name='eng_output']").val(data.eng_output);
					$("input[name='embarkation_date']").val(data.embarkation_date);
					$("input[name='disembarkation_date']").val(data.disembarkation_date);
					$("input[name='last_embarkation_date']").val(data.disembarkation_date_validate);
					var formatted_boarding_periods = calculateBoardingPerioddays(data.embarkation_date, data.disembarkation_date);
					var formatted_boarding_period = calculateBoardingPeriod(data.embarkation_date, data.disembarkation_date);
					// var formatted_boarding_period_month = calculateBoardingPeriodmonth(data.embarkation_date, data.disembarkation_date);

					<?php $is_edit = 1; ?>

					var checkbox = '<?php echo check_on_board($candidate->id, 'rec_on_board_company', $is_edit); ?>';

					$("input[name='cur_onboard']").attr('data-test', checkbox);

					if (checkbox !== 'true') {
						$('#cur_onboard_section').hide();
					} else {
						$('#cur_onboard_section').show();
					}

					if (data.cur_onboard == 1) {
						$('#cur_onboard_section').show();
						$('#cur_onboard').prop('checked', true);
						$("input[name='disembarkation_date']").prop('disabled', true);
					} else {
						$('#cur_onboard_section').hide();
						$("input[name='disembarkation_date']").prop('disabled', false);
						$('#cur_onboard').prop('checked', false);
					}
					$("input[name='boarding_periods']").val(formatted_boarding_periods);
					$("input[name='boarding_period']").val(formatted_boarding_period);
					// $("input[name='boarding_month']").val(formatted_boarding_period_month);
					$("input[name='ramaining_days']").val(data.ramaining_days);
					$("input[name='calculation_y_n']").val(data.calculation_y_n);
					$("input[name='emp_no']").val(data.emp_no);
					$("input[name='employment']").val(data.employment);
					$("input[name='ship_owner']").val(data.ship_owner);
					$("input[name='employer']").val(data.employer);
					$("select[name='rank[]']").selectpicker('destroy');
					$("select[name='rank[]']").val(data.rank);
					$("select[name='rank[]']").selectpicker('refresh');
					$("#on_board_company_label").text("<?php echo _l('edit_on_board_company'); ?>");
				},
				// error: error,
			});
		});

		$(".edit_on_board_other_company_detail").on("click", function() {
			var id = $(this).attr("data-id");
			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_get_on_board_other_company/" + id,
				success: function(response) {
					$('#addOnBoardOtherCompanyModal').modal('show');
					var data = JSON.parse(response);

					$("input[name='on_board_other_company_id']").val(data.id);
					$("input[name='add_on_board_other_company_candidate_id']").val(data.candidate);
					$("input[name='company_name']").val(data.company_name);
					// $("select[name='vessel_name']").selectpicker('destroy');
					// $("select[name='vessel_name']").val(data.vessel_name);
					// $("select[name='vessel_name']").selectpicker('refresh');
					$("input[name='vessel_name']").val(data.vessel_name);
					$("select[name='vessel_type[]']").selectpicker('destroy');
					$("select[name='vessel_type[]']").val(data.vessel_type);
					$("select[name='vessel_type[]']").selectpicker('refresh');
					$("select[name='grade_rank_duty_other']").selectpicker('destroy');
					$("select[name='grade_rank_duty_other']").val(data.grade_rank_duty_other);
					$("select[name='grade_rank_duty_other']").selectpicker('refresh');
					$("input[name='gross_ton']").val(data.gross_ton);
					$("input[name='engine_type']").val(data.engine_type);
					$("input[name='eng_output']").val(data.eng_output);
					$("input[name='sailing_area']").val(data.sailing_area);
					$("input[name='last_embarkation_other_date']").val(data.disembarkation_date_validate);
					$("input[name='embarkation_other_date']").val(data.embarkation_date);
					$("input[name='disembarkation_other_date']").val(data.disembarkation_date);
					var formatted_boarding_periods = calculateBoardingPerioddays(data.embarkation_date, data.disembarkation_date);
					var formatted_boarding_period = calculateBoardingPeriod(data.embarkation_date, data.disembarkation_date);

					<?php $is_edit = 1; ?>

					var checkbox = '<?php echo check_on_board($candidate->id, 'rec_on_board_other_company', $is_edit); ?>';

					// $("input[name='cur_onboard_other']").attr('data-test', checkbox);

					// if (checkbox !== 'true') {
					// 	$('#cur_onboard_other_section').hide();
					// } else {
					// 	$('#cur_onboard_other_section').show();
					// }
					// if (data.cur_onboard == 1) {
					// 	$('#cur_onboard_other').prop('checked', true);
					// 	$("input[name='disembarkation_other_date']").prop('disabled', true);
					// } else {
					// 	$('#cur_onboard_other').prop('checked', false);
					// 	$("input[name='disembarkation_other_date']").prop('disabled', false);
					// }
					// var formatted_boarding_period_month = calculateBoardingPeriodmonth(data.embarkation_date, data.disembarkation_date);
					var formatted_boarding_periods = calculateBoardingPerioddays(data.embarkation_date, data.disembarkation_date);
					var formatted_boarding_period = calculateBoardingPeriod(data.embarkation_date, data.disembarkation_date);
					$("input[name='boarding_other_periods']").val(formatted_boarding_periods);
					$("input[name='boarding_other_period']").val(formatted_boarding_period);
					// $("input[name='boarding_other_month']").val(formatted_boarding_period_month);
					$("input[name='approval_rate']").val(data.approval_rate);
					$("input[name='remark']").val(data.remark);
					$("select[name='rank_other[]']").selectpicker('destroy');
					$("select[name='rank_other[]']").val(data.rank);
					$("select[name='rank_other[]']").selectpicker('refresh');
					$("#on_board_other_company_label").text("<?php echo _l('edit_on_board_other_company'); ?>");

				},
				// error: error,
			});
		});

		$(".edit_on_board_in_land_detail").on("click", function() {
			var id = $(this).attr("data-id");
			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_on_board_in_land/" + id,
				success: function(response) {
					$('#addOnBoardInLandModal').modal('show');
					var data = JSON.parse(response);

					$("input[name='on_board_in_land_id']").val(data.id);
					$("input[name='add_on_board_in_land_candidate_id']").val(data.candidate);
					$("input[name='company_name']").val(data.company_name);
					$("input[name='hire_date']").val(data.hire_date);
					$("input[name='resignation_date']").val(data.resignation_date);
					$("input[name='work_dep']").val(data.work_dep);
					$("input[name='responsibility_work']").val(data.responsibility_work);
					$("input[name='final_position']").val(data.final_position);
					$("input[name='retire_reason']").val(data.retire_reason);
					$("input[name='other_company_career']").val(data.other_company_career);
					$("input[name='remark']").val(data.remark);

					$("#on_board_in_land_label").text("Edit In Land");
				},
				// error: error,
			});
		});

		$(".edit_crew_transaction_detail").on("click", function() {
			var id = $(this).attr("data-id");

			$.ajax({
				type: "post",
				url: admin_url + "recruitment/edit_crew_transaction_detail/" + id,
				success: function(response) {
					$('#editcrewtransactionModal').modal('show');
					var data = JSON.parse(response);
					$("input[name='hid']").val(data.id);
					$("input[name='care_result']").val(data.care_result);
					$("input[name='care_time']").val(data.care_time);
					$("textarea[name='description']").val(data.description);
				},
				// error: error,
			});
		});

		$(".on_board_company_detail_delete").on("click", function() {
			var confirm = window.confirm('Are You Sure you Want to Delete?');
			if (confirm) {
				var id = $(this).attr("data-id");
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteOnBoardCompany/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$(".on_board_other_company_detail_delete").on("click", function() {
			var confirm = window.confirm('Are You Sure you Want to Delete?');
			if (confirm) {
				var id = $(this).attr("data-id");
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteOnBoardOtherCompany/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});


		$(".crew_transaction_detail_delete").on("click", function() {
			var confirm = window.confirm('Are You Sure you Want to Delete?');
			if (confirm) {
				var id = $(this).attr("data-id");
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deletecrewtransactionhistory/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);
						window.location.href();
					},
					// error: error,
				});
			}
		});



		$(".on_board_in_land_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");
			if (confirm("Are you sure you want to delete this license?")) {
				$.ajax({
					type: "post",
					url: admin_url + "recruitment/deleteOnBoardInLand/" + id,
					success: function(response) {
						var data = JSON.parse(response);
						alert_float('success', data.message);

						setTimeout(function() {
							window.location.reload();
						}, 1200);
					},
					// error: error,
				});
			}
		});

		$('#addOnBoardCompanyModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			var last_embarkation_date = $("input[name='last_embarkation_date_old']").val();
			$("input[name='last_embarkation_date']").val(last_embarkation_date);
			$("input[name='on_board_company_id']").val('');
			$("#on_board_company_label").text("<?php echo _l('add_on_board_company'); ?>");
		});

		$('#addLicenceinfoModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			$("input[name='licence_id']").val('');
			$("#licence_label").text("<?php echo _l('add_on_board_company'); ?>");
		});

		$('#addPassportinfoModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			$("input[name='passport_id']").val('');
			$("#passpord_label").text("<?php echo _l('add_passpord_info'); ?>");
		});

		$('#addOnBoardOtherCompanyModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			var last_embarkation_date = $("input[name='last_embarkation_other_date_old']").val();
			$("input[name='last_embarkation_other_date']").val(last_embarkation_date);
			$("input[name='on_board_other_company_id']").val('');
			$("#on_board_other_company_label").text("<?php echo _l('add_on_board_other_company'); ?>");
		});

		$('#addOnBoardInLandModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			$("input[name='on_board_in_land_id']").val('');
			$("#on_board_in_land_label").text("<?php echo _l('add_on_board_in_land'); ?>");
		});

		$('#addDocumentinfoModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			$("input[name='document_id']").val('');
			$("#document_label").text("<?php echo _l('add_document_info'); ?>");
		});

		$('#addflaginfoModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			$("input[name='flag_id']").val('');
			$("#flag_label").text("<?php echo _l('add_flag_info'); ?>");
		});

		$('#addPromotioninfoModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			$("input[name='promotion_id']").val('');
			$("#promotion_label").text("<?php echo _l('add_promotion_info'); ?>");
		});

		$('#addEducationinfoModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			$("input[name='education_id']").val('');
		});

		$('#addupdateRewardinfoModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			$("input[name='reward_id']").val('');
			$("#reward_label").text("<?php echo _l('add_reward_info'); ?>");
		});

		$('#addMedicalinfoModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			$("input[name='medical_id']").val('');
			$("#medical_label").text("<?php echo _l('add_medical_info'); ?>");
		});

		$('#addPscinfoModal').on('hidden.bs.modal', function() {
			$(this).find('form').trigger('reset');
			$("input[name='psc_id']").val('');
			$("#psc_label").text("<?php echo _l('add_psi_info'); ?>");
		});

	});

	function editemergencyInfo() {
		$('#emergencyEditButton').hide();
		$('#emergencySaveButtonDiv').show();

		$('#fullnameEditField').hide();
		$('#fullnameSaveField').show();

		$('#gender_edit').hide();
		$('#gender_save').show();

		$('#birthday_edit').hide();
		$('#birthday_save').show();

		$('#birthday_age_edit').hide();
		$('#birthday_age_save').show();

		$('#marital_status_edit').hide();
		$('#marital_status_save').show();

		$('#nationality_edit').hide();
		$('#nationality_save').show();

		// $('#department_edit').hide();
		// $('#department_save').show();

		$('#identification_edit').hide();
		$('#identification_save').show();

		$('#identification_edit').hide();
		$('#identification_save').show();

		$('#retired_edit').hide();
		$('#retired_save').show();

		$('#place_of_issue_edit').hide();
		$('#place_of_issue_save').show();

		$('#graduated_edit').hide();
		$('#graduated_save').show();

		$('#religion_edit').hide();
		$('#religion_save').show();

		// $('#candidate_code_edit').hide();
		// $('#candidate_code_save').show();

		// $('#camption_name_edit').hide();
		// $('#camption_name_save').show();

		// $('#emp_status_edit').hide();
		// $('#emp_status_save').show();

		$('#nation_edit').hide();
		$('#nation_save').show();

		// $('#department_date_edit').hide();
		// $('#department_date_save').show();

		// $('#hired_date_edit').hide();
		// $('#hired_date_save').show();

		$('#desired_salary_edit').hide();
		$('#desired_salary_save').show();

		$('#days_for_identity_edit').hide();
		$('#days_for_identity_save').show();

		$('#academy_type_edit').hide();
		$('#academy_type_save').show();

		$('#employertype_edit').hide();
		$('#employertype_save').show();

		$('#weight_edit').hide();
		$('#weight_save').show();

		// $('#promotion_edit').hide();
		// $('#promotion_save').show();

		$('#municipality_edit').hide();
		$('#municipality_Save').show();

		$('#provincegEditField').hide();
		$('#provincegSaveField').show();

		$('#deatilas_address_edit').hide();
		$('#deatilas_address_save').show();

		$('#hired_type_edit').hide();
		$('#hired_type_save').show();

		$('#height_edit').hide();
		$('#height_save').show();

		$('#vsl_career_edit').hide();
		$('#vsl_career_save').show();

		$('#rank_career_edit').hide();
		$('#rank_career_save').show();

		$('#regionEditField').hide();
		$('#regionSaveField').show();

		$('#lastnameEditField').hide();
		$('#lastnameSaveField').show();

		editPersonalInfo();
	}

	function editPersonalInfo() {
		$('#PersonalEditButton').hide();
		$('#personalSaveButtonDiv').show();

		$('#hobbyEditField').hide();
		$('#hobbySaveField').show();

		$('#workingEditField').hide();
		$('#workingSaveField').show();

		$('#disabilityEditField').hide();
		$('#disabilitySaveField').show();

		$('#disabilityratingEditField').hide();
		$('#disabilityratingSaveField').show();

		$('#disability_rating_date_edit').hide();
		$('#disability_rating_date_Save').show();

		$('#safety_shoes_edit').hide();
		$('#safety_shoes_Save').show();

		$('#religion_edit').hide();
		$('#religion_save').show();

		$('#wedding_edit').hide();
		$('#wedding_save').show();

		$('#veterna_division_edit').hide();
		$('#veterna_division_save').show();

		$('#veterna_no_edit').hide();
		$('#veterna_no_save').show();

		$('#veterna_relationships_edit').hide();
		$('#veterna_relationships_save').show();

		$('#native_religion_edit').hide();
		$('#native_religion_save').show();

		$('#present_resident_kor_edit').hide();
		$('#present_resident_kor_save').show();

		$('#present_resident_eng_edit').hide();
		$('#present_resident_eng_save').show();

		$('#email_edit').hide();
		$('#email_save').show();

		$('#home_contact_number_edit').hide();
		$('#home_contact_number_save').show();

		$('#emergency_contact_number_edit').hide();
		$('#emergency_contact_number_save').show();

		$('#phonenumber_edit').hide();
		$('#phonenumber_save').show();

	}

	$(document).ready(function() {
		function calculateBoardingPerioddays(embarkation_date, disembarkation_date) {
			if (embarkation_date !== '' && disembarkation_date !== '') {
				var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
				var embarkation = moment(embarkation_date, formats);
				var disembarkation = moment(disembarkation_date, formats);
				var difference = Math.abs(disembarkation.diff(embarkation));
				var millisecondsPerDay = 1000 * 60 * 60 * 24;
				var daysDifference = Math.floor(difference / millisecondsPerDay);

				return (daysDifference + 1) + ' days';
			} else {
				return '';
			}
		}

		function calculateBoardingPeriod(embarkation_date, disembarkation_date) {
			if (embarkation_date && disembarkation_date) {
				var formats = ["YYYY-MM-DD", "D.M.YYYY", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
				var embarkation = null;
				var disembarkation = null;

				function parseDate(dateString, format) {
					return moment(dateString, format, true).isValid() ? moment(dateString, format) : null;
				}

				for (var i = 0; i < formats.length; i++) {
					embarkation = parseDate(embarkation_date, formats[i]);
					disembarkation = parseDate(disembarkation_date, formats[i]);

					if (embarkation && disembarkation) {
						break;
					}
				}

				if (embarkation && disembarkation) {
					var duration = moment.duration(disembarkation.diff(embarkation));
					var years = duration.years();
					var months = duration.months();
					var days = duration.days();

					days += 1;

					// if (days > moment(embarkation).daysInMonth()) {
					// 	days -= moment(embarkation).daysInMonth();
					// 	months += 1;
					// }
					if (years >= 1) {
						days += 1;
					}

					var formattedDifference = years + 'Y ' + months + 'M ' + days + 'D';
					return formattedDifference;
				} else {
					return '';
				}
			} else {
				return '';
			}
		}


		function calculateBoardingPeriodmonth(embarkation_date, disembarkation_date) {
			if (embarkation_date && disembarkation_date) {
				var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
				var embarkation = moment(embarkation_date, formats);
				var disembarkation = moment(disembarkation_date, formats);

				var differenceInMilliseconds = Math.abs(disembarkation.diff(embarkation));
				var daysDifference = differenceInMilliseconds / (1000 * 60 * 60 * 24);
				var monthsDifference = daysDifference / 30;
				var formattedMonthsDifference = monthsDifference.toFixed(1);
				return formattedMonthsDifference;

			} else {
				return '';
			}
		}


		var initial_embarkation_date = $('#embarkation_date').val();
		var initial_disembarkation_date = $('#disembarkation_date').val();
		var boarding_periods = calculateBoardingPerioddays(initial_embarkation_date, initial_disembarkation_date);
		var boarding_period = calculateBoardingPeriod(initial_embarkation_date, initial_disembarkation_date);
		var boarding_period_month = calculateBoardingPeriodmonth(initial_embarkation_date, initial_disembarkation_date);

		$('#boarding_periods').val(boarding_periods);
		$('#boarding_period').val(boarding_period);
		// $('#boarding_month').val(boarding_period_month);

		$('#embarkation_date').on('change', function() {
			var embarkation_date = $(this).val();
			var disembarkation_date = $('#disembarkation_date').val();
			var boarding_periods = calculateBoardingPerioddays(embarkation_date, disembarkation_date);
			var boarding_period = calculateBoardingPeriod(embarkation_date, disembarkation_date);
			var boarding_period_month = calculateBoardingPeriodmonth(embarkation_date, disembarkation_date);

			$('#boarding_periods').val(boarding_periods);
			$('#boarding_period').val(boarding_period);
			// $('#boarding_month').val(boarding_period_month);

		});

		$('#cur_onboard').change(function() {
			if ($(this).is(':checked')) {
				$('#disembarkation_date').prop('disabled', true);
			} else {
				$('#disembarkation_date').prop('disabled', false);
			}
		});

		$('#cur_onboard').change();

		// $('#cur_onboard_other').change(function() {
		// 	if ($(this).is(':checked')) {
		// 		$('#disembarkation_other_date').prop('disabled', true);
		// 	} else {
		// 		$('#disembarkation_other_date').prop('disabled', false);
		// 	}
		// });

		// $('#cur_onboard_other').change();

		$('#disembarkation_date').on('change', function() {
			var embarkation_date = $('#embarkation_date').val();
			var disembarkation_date = $(this).val();
			var boarding_periods = calculateBoardingPerioddays(embarkation_date, disembarkation_date);
			var boarding_period_month = calculateBoardingPeriodmonth(embarkation_date, disembarkation_date);
			var boarding_period = calculateBoardingPeriod(embarkation_date, disembarkation_date);
			$('#boarding_periods').val(boarding_periods);
			$('#boarding_period').val(boarding_period);
			// $('#boarding_month').val(boarding_period_month);
		});
	});

	$(document).ready(function() {

		function compareDatesother() {
			var embarkationDate = $('#embarkation_other_date').val();
			var disembarkationDate = $('#disembarkation_other_date').val();
			var validDates = true;

			if (embarkationDate && disembarkationDate) {
				var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];

				var embarkation = moment(embarkationDate, formats);
				var disembarkation = moment(disembarkationDate, formats);

				if (disembarkation.isSame(embarkation)) {
					alert_float('warning', 'Date is not valid (Embarkation and Disembarkation Dates cannot be the same)');
					validDates = false;
				}

				if (disembarkation.isBefore(embarkation)) {
					alert_float('warning', 'Date is not valid (Earlier Date than Disembarkation Date)');
					validDates = false;
				}


			}
			if (validDates) {
				$('#sm_btn_other').prop('disabled', false);
			} else {
				$('#sm_btn_other').prop('disabled', true);
			}
		}

		$('#embarkation_other_date').change(function() {
			var other_company_date_validation_check_box = $("#other_company_date_validation_check_box").val();
			if (other_company_date_validation_check_box == 'false') {
				compareDatesother();
			}
		});

		$('#disembarkation_other_date').change(function() {
			var other_company_date_validation_check_box = $("#other_company_date_validation_check_box").val();
			if (other_company_date_validation_check_box == 'false') {
				compareDatesother();
			}
		});


		function compareDates() {
			var embarkationDate = $('#embarkation_date').val();
			var disembarkationDate = $('#disembarkation_date').val();
			var validDates = true;

			if (embarkationDate && disembarkationDate) {
				var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
				var embarkation = moment(embarkationDate, formats);
				var disembarkation = moment(disembarkationDate, formats);

				if (disembarkation.isSame(embarkation)) {
					alert_float('warning', 'Date is not valid (Embarkation and Disembarkation Dates cannot be the same)');
					validDates = false;
				}

				if (disembarkation.isBefore(embarkation)) {
					alert_float('warning', 'Date is not valid (Earlier Date than Disembarkation Date)');
					validDates = false;
				}
			}
			if (validDates) {
				$('#sm_btn_').prop('disabled', false);
			} else {
				$('#sm_btn_').prop('disabled', true);
			}
		}

		$('#embarkation_date').change(function() {
			var company_date_validation_check_box = $("#company_date_validation_check_box").val();
			if (company_date_validation_check_box == 'false') {
				compareDates();
			}
		});

		$('#disembarkation_date').change(function() {
			var company_date_validation_check_box = $("#company_date_validation_check_box").val();
			if (company_date_validation_check_box == 'false') {
				compareDates();
			}
		});

		function calculateBoardingPerioddays(embarkation_date, disembarkation_date) {
			if (embarkation_date !== '' && disembarkation_date !== '') {
				var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
				var embarkation = moment(embarkation_date, formats);
				var disembarkation = moment(disembarkation_date, formats);
				var difference = Math.abs(disembarkation.diff(embarkation));
				var millisecondsPerDay = 1000 * 60 * 60 * 24;
				var daysDifference = Math.floor(difference / millisecondsPerDay);

				return (daysDifference + 1) + ' days';
			} else {
				return '';
			}
		}

		function calculateBoardingPeriod(embarkation_date, disembarkation_date) {
			if (embarkation_date && disembarkation_date) {
				var formats = ["YYYY-MM-DD", "D.M.YYYY", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
				var embarkation = null;
				var disembarkation = null;

				function parseDate(dateString, format) {
					return moment(dateString, format, true).isValid() ? moment(dateString, format) : null;
				}

				for (var i = 0; i < formats.length; i++) {
					embarkation = parseDate(embarkation_date, formats[i]);
					disembarkation = parseDate(disembarkation_date, formats[i]);

					if (embarkation && disembarkation) {
						break;
					}
				}

				if (embarkation && disembarkation) {
					var duration = moment.duration(disembarkation.diff(embarkation));
					var years = duration.years();
					var months = duration.months();
					var days = duration.days();

					days += 1;

					if (years >= 1) {
						days += 1;
					}

					var formattedDifference = years + 'Y ' + months + 'M ' + days + 'D';
					return formattedDifference;
				} else {
					return '';
				}
			} else {
				return '';
			}
		}

		function calculateBoardingPeriodmonth(embarkation_date, disembarkation_date) {
			if (embarkation_date && disembarkation_date) {
				var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
				var embarkation = moment(embarkation_date, formats);
				var disembarkation = moment(disembarkation_date, formats);

				var differenceInMilliseconds = Math.abs(disembarkation.diff(embarkation));
				var daysDifference = differenceInMilliseconds / (1000 * 60 * 60 * 24);
				var monthsDifference = daysDifference / 30;
				var formattedMonthsDifference = monthsDifference.toFixed(1);
				return formattedMonthsDifference;

			} else {
				return '';
			}
		}

		var initial_embarkation_other_date = $('#embarkation_other_date').val();
		var initial_disembarkation_other_date = $('#disembarkation_other_date').val();
		var boarding_other_periods = calculateBoardingPerioddays(initial_embarkation_other_date, initial_disembarkation_other_date);
		var boarding_other_period_month = calculateBoardingPeriodmonth(initial_embarkation_other_date, initial_disembarkation_other_date);
		var boarding_other_period = calculateBoardingPeriod(initial_embarkation_other_date, initial_disembarkation_other_date);

		$('#boarding_other_period').val(boarding_other_period);
		$('#boarding_other_periods').val(boarding_other_periods);
		// $('#boarding_other_month').val(boarding_other_period_month);

		$('#embarkation_other_date').on('change', function() {
			var embarkation_other_date = $(this).val();
			var disembarkation_other_date = $('#disembarkation_other_date').val();
			var boarding_other_periods = calculateBoardingPerioddays(embarkation_other_date, disembarkation_other_date);
			var boarding_other_period_month = calculateBoardingPeriodmonth(embarkation_other_date, disembarkation_other_date);
			var boarding_other_period = calculateBoardingPeriod(embarkation_other_date, disembarkation_other_date);
			$('#boarding_other_period').val(boarding_other_period);
			$('#boarding_other_periods').val(boarding_other_periods);
			// $('#boarding_other_month').val(boarding_other_period_month);
		});

		$('#disembarkation_other_date').on('change', function() {
			var embarkation_other_date = $('#embarkation_other_date').val();
			var disembarkation_other_date = $(this).val();
			var boarding_other_periods = calculateBoardingPerioddays(embarkation_other_date, disembarkation_other_date);
			var boarding_other_period_month = calculateBoardingPeriodmonth(embarkation_other_date, disembarkation_other_date);
			var boarding_other_period = calculateBoardingPeriod(embarkation_other_date, disembarkation_other_date);
			$('#boarding_other_period').val(boarding_other_period);
			$('#boarding_other_periods').val(boarding_other_periods);
		});

	});

	$(document).ready(function() {

		var table = null;
		if (!$.fn.DataTable.isDataTable('#vessel_table_board')) {
			table = $('#vessel_table_board').DataTable({
				"paging": true,
				"searching": true,
				"ordering": true,
				"info": true
			});
		} else {
			table = $('#vessel_table_board').DataTable();
		}

		$('#vessel_filter_board, #rank_filter, #duty_filter, #on_board_filter').selectpicker();
		updateTotalBoardingPeriod();
		set_vsl_carrer();
		$('#vessel_filter_board').on('changed.bs.select', function() {
			filterTable('#vessel_filter_board', 4);
		});
		$('#rank_filter').on('changed.bs.select', function() {
			filterTable('#rank_filter', 2);
		});
		$('#duty_filter').on('changed.bs.select', function() {
			var duty_selector = $("#duty_filter").val();
			$("#duty_filter_other").val(duty_selector).trigger('change').selectpicker('refresh');
			filterTable('#duty_filter', 3);
		});
		$('#on_board_filter').on('changed.bs.select', function() {
			filterTable('#on_board_filter', 10);
		});

		function filterTable(filterSelector, columnIdx, dutyValue = '', vslValue = '') {
			var selectedNames = $(filterSelector).find('option:selected').map(function() {
				// return '^' + $.trim($(this).text()) + '$';
				return $(this).text().trim();
			}).get();

			if (selectedNames.length === 0) {
				table.column(columnIdx).search('').draw();
			} else {
				// table.column(columnIdx).search(selectedNames.join('|'), true, false).draw();
				table.column(columnIdx).search('^' + selectedNames.join('$|^') + '$', true, false).draw();
			}
			updateTotalBoardingPeriod(selectedNames, dutyValue, vslValue);
		}

		function updateTotalBoardingPeriod(selectedNames = '', dutyValue = '', vslValue = '') {

			var TotalBoardingPeriod = calculateTotalBoardingDays();

			if (selectedNames == '' || selectedNames.length == 0) {
				$('.main_hire_career').text(TotalBoardingPeriod[0] + 'Y ' + TotalBoardingPeriod[1] + 'M ' + TotalBoardingPeriod[2] + 'D');
			}
			if (selectedNames.length == 1 && selectedNames[0] === vslValue) {
				$('.vsl_type').text(vslValue);
				$('.main_vsl_career').text(TotalBoardingPeriod[0] + 'Y ' + TotalBoardingPeriod[1] + 'M ' + TotalBoardingPeriod[2] + 'D');
			}
			if (selectedNames.length == 1 && selectedNames[0] == dutyValue) {
				$('.rank_duty').text(dutyValue);
				$('#document_rank_duty').val(dutyValue);
				$('.main_rank_career').text(TotalBoardingPeriod[0] + 'Y ' + TotalBoardingPeriod[1] + 'M ' + TotalBoardingPeriod[2] + 'D');
			}

			$('.board_total_boarding_days').text(TotalBoardingPeriod[0] + 'Y ' + TotalBoardingPeriod[1] + 'M ' + TotalBoardingPeriod[2] + 'D');
		}

		function set_vsl_carrer() {
			var vslotherfirstRowData = table.row(0).data();
			var vslotherfirstCell = table.cell(0, 4).node();
			var vslothercustomValueAttr = $(vslotherfirstCell).attr('data-vslrid');
			var vslValue = vslotherfirstRowData[4];

			$("#vessel_filter_board").val(vslothercustomValueAttr).trigger('change').selectpicker('refresh');
			filterTable('#vessel_filter_board', 4, '', vslValue);
			$("#vessel_filter_board").val('').trigger('change').selectpicker('refresh');
			filterTable('#vessel_filter_board', 4);

			var firstRowData = table.row(0).data();
			var firstCell = table.cell(0, 3).node();
			var customValueAttr = $(firstCell).attr('data-id');

			var dutyValue = firstRowData[3];
			$("#duty_filter").val(customValueAttr).trigger('change').selectpicker('refresh');
			filterTable('#duty_filter', 3, dutyValue);
			$("#duty_filter").val('').trigger('change').selectpicker('refresh');
			filterTable('#duty_filter', 3);
			// $("#vessel_filter_board").trigger('changed.bs.select');
		}

		function calculateTotalBoardingDays() {
			var total = 0;
			var years = 0;
			var months = 0;
			var days = 0;
			table.rows({
				search: 'applied'
			}).every(function() {
				var rowData = this.data();
				var boardingDays = rowData[11];
				var t = parseBoardingPeriod(boardingDays);
				years += t[0];
				months += t[1];
				days += t[2];
			});
			var remain_days = days % 30;
			var extra_month = Math.floor(days / 30);
			months += extra_month;

			var remain_months = months % 12;
			var extra_year = Math.floor(months / 12);
			years += extra_year;
			return [years, remain_months, remain_days];
		}

		function parseBoardingPeriod(periodString) {
			// Assuming periodString is in the format "Y M D"
			var parts = periodString.split(' ');
			var year = parseInt(parts[0].replace('Y', '')) || 0;
			var month = parseInt(parts[1].replace('M', '')) || 0;
			var day = parseInt(parts[2].replace('D', '')) || 0;
			return [year, month, day];
		}
	});


	$(document).ready(function() {
		var table = null;

		if (!$.fn.DataTable.isDataTable('#vessel_table_other')) {
			table = $('#vessel_table_other').DataTable({
				"paging": true,
				"searching": true,
				"ordering": true,
				"info": true
			});
		} else {
			table = $('#vessel_table_other').DataTable();
		}

		$('#vessel_filter_other, #vessel_filter_board_other, #rank_filter_other, #duty_filter_other').selectpicker();
		updateTotalBoardingPeriodOther();
		set_rank_carrer();

		$('#vessel_filter_other').on('changed.bs.select', function() {
			filterTableOther('#vessel_filter_other', 5);
		});
		$('#vessel_filter_board_other').on('changed.bs.select', function() {
			filterTableOther('#vessel_filter_board_other', 5);
		});
		$('#rank_filter_other').on('changed.bs.select', function() {
			filterTableOther('#rank_filter_other', 1);
		});
		// $('#on_other_filter').on('changed.bs.select', function() {
		// 	filterTableOther('#on_other_filter', 11);
		// });
		$('#duty_filter_other').on('changed.bs.select', function() {
			filterTableOther('#duty_filter_other', 2);
		});


		function filterTableOther(filterSelector, columnIdx, dutyValue = '', vslValue = '') {

			var selectedNames = $(filterSelector).find('option:selected').map(function() {
				// return '^' + $.trim($(this).text()) + '$';
				return $(this).text().trim();
			}).get();

			if (selectedNames.length === 0) {
				table.column(columnIdx).search('').draw();
			} else {
				// table.column(columnIdx).search(selectedNames.join('|'), true, false).draw();
				table.column(columnIdx).search('^' + selectedNames.join('$|^') + '$', true, false).draw();
			}
			updateTotalBoardingPeriodOther(selectedNames, dutyValue, vslValue);
		}


		function other_rank_count(hire_career, other_boarding_period) {
			var hireCareerParts = hire_career.match(/(\d+)Y (\d+)M (\d+)D/);
			var hireYears = parseInt(hireCareerParts[1], 10);
			var hireMonths = parseInt(hireCareerParts[2], 10);
			var hireDays = parseInt(hireCareerParts[3], 10);

			var otherPeriodParts = other_boarding_period.match(/(\d+)Y (\d+)M (\d+)D/);
			var otherYears = parseInt(otherPeriodParts[1], 10);
			var otherMonths = parseInt(otherPeriodParts[2], 10);
			var otherDays = parseInt(otherPeriodParts[3], 10);


			var totalYears = hireYears + otherYears;
			var totalMonths = hireMonths + otherMonths;
			var totalDays = hireDays + otherDays;

			// Handling overflow for days and months
			if (totalDays >= 30) {
				totalMonths += Math.floor(totalDays / 30);
				totalDays = totalDays % 30;
			}

			if (totalMonths >= 12) {
				totalYears += Math.floor(totalMonths / 12);
				totalMonths = totalMonths % 12;
			}

			var totalPeriod = totalYears + 'Y ' + totalMonths + 'M ' + totalDays + 'D';
			$(".other_hire_career").text(other_boarding_period)
			$(".total_hire_career").text(totalPeriod)
		}

		function updateTotalBoardingPeriodOther(selectedNames = '', dutyValue = '', vslValue = '') {
			var TotalBoardingotherPeriod = calculateTotalBoardingOtherDays();

			var other_duty_rank_label = $("#document_rank_duty").val();


			if (selectedNames == '' || selectedNames.length == 0) {
				var other_boarding_period = TotalBoardingotherPeriod[0] + 'Y ' + TotalBoardingotherPeriod[1] + 'M ' + TotalBoardingotherPeriod[2] + 'D';
				var hire_career = $('.main_hire_career').text();
				other_rank_count(hire_career, other_boarding_period)
			}

			if (selectedNames.length === 1 && selectedNames[0] === vslValue) {
				$(".vsl_other_type").text(selectedNames);
				$('.other_vsl_career').text(TotalBoardingotherPeriod[0] + 'Y ' + TotalBoardingotherPeriod[1] + 'M ' + TotalBoardingotherPeriod[2] + 'D');
			}

			if (!other_duty_rank_label) {
				var other_duty_rank_label_empty = "0Y 0M 0D";
				$('.main_other_rank_career').text('0Y ' + '0M ' + '0D');
			}

			if (other_duty_rank_label) {
				$(".other_rank_duty").text(other_duty_rank_label);
				$('.main_other_rank_career').text(TotalBoardingotherPeriod[0] + 'Y ' + TotalBoardingotherPeriod[1] + 'M ' + TotalBoardingotherPeriod[2] + 'D');
			}

			$('.other_total_boarding_days').text(TotalBoardingotherPeriod[0] + 'Y ' + TotalBoardingotherPeriod[1] + 'M ' + TotalBoardingotherPeriod[2] + 'D');
		}

		function set_rank_carrer() {
			var rankotherfirstRowData = table.row(0).data();
			var vslotherfirstCell = table.cell(0, 4).node();
			var vslothercustomValueAttr = $(vslotherfirstCell).attr('data-vslotherid');
			var vslValue = rankotherfirstRowData[4];

			$("#vessel_filter_board_other").val(vslothercustomValueAttr).trigger('change').selectpicker('refresh');
			filterTableOther('#vessel_filter_board_other', 4, '', vslValue); // Passing only vslValue
			$("#vessel_filter_board_other").val('').trigger('change').selectpicker('refresh');
			filterTableOther('#vessel_filter_board_other', 4);

			var firstRowData = table.row(0).data();
			var firstCell = table.cell(0, 2).node();
			var customValueAttr = $(firstCell).attr('data-otherid');
			var dutyValue = firstRowData[2];

			$("#duty_filter_other").val(customValueAttr).trigger('change').selectpicker('refresh');
			filterTableOther('#duty_filter_other', 2, dutyValue); // Passing only dutyValue
			$("#duty_filter_other").val('').trigger('change').selectpicker('refresh');
			filterTableOther('#duty_filter_other', 2);
		}

		function calculateTotalBoardingOtherDays() {
			var years = 0;
			var months = 0;
			var days = 0;

			table.rows({
				search: 'applied'
			}).every(function() {
				var rowData = this.data();
				var boardingDays = rowData[12]; // Assuming this is the boarding days column
				var t = parseBoardingOtherPeriod(boardingDays);
				years += t[0];
				months += t[1];
				days += t[2];
			});

			var remain_days = days % 30;
			var extra_month = Math.floor(days / 30);
			months += extra_month;

			var remain_months = months % 12;
			var extra_year = Math.floor(months / 12);
			years += extra_year;

			return [years, remain_months, remain_days];
		}

		function parseBoardingOtherPeriod(periodString) {
			if (!periodString) {
				return [0, 0, 0];
			}
			var parts = periodString.split(' ');
			if (parts.length > 2) {
				var year = parseInt(parts[0].replace('Y', '')) || 0;
				var month = parseInt(parts[1].replace('M', '')) || 0;
				var day = parseInt(parts[2].replace('D', '')) || 0;
				return [year, month, day];
			} else {
				return [0, 0, 0];
			}
		}
	});




























	function get_state() {
		var country_id = $("#personal_info_region").val();

		$.ajax({
			url: '<?php echo admin_url('recruitment/get_states_by_country'); ?>',
			type: 'POST',
			data: {
				country_id: country_id
			},
			success: function(response) {
				var data = JSON.parse(response);
				$('#personal_info_province').empty();
				$('#personal_info_province').append('<option value="" selected disabled>Select State</option>');
				if (data.length > 0) {
					data.forEach(function(state) {
						$('#personal_info_province').append('<option value="' + state.id + '">' + state.name + '</option>');
					});
				}
				$('#personal_info_province').selectpicker('refresh');

				// Clear and refresh city dropdown
				$('#personal_info_municipality').empty();
				$('#personal_info_municipality').append('<option value="" selected disabled>Select City</option>');
				$('#personal_info_municipality').selectpicker('refresh');
			}
		});
	}

	function get_city() {
		var state_id = $('#personal_info_province').val();
		$.ajax({
			url: '<?php echo admin_url('recruitment/get_cities_by_state'); ?>',
			type: 'POST',
			data: {
				state_id: state_id
			},
			success: function(response) {
				var data = JSON.parse(response);
				$('#personal_info_municipality').empty();
				$('#personal_info_municipality').append('<option value="" selected disabled>Select City</option>');
				if (data.length > 0) {
					data.forEach(function(city) {
						$('#personal_info_municipality').append('<option value="' + city.id + '">' + city.name + '</option>');
					});
				}
				$('#personal_info_municipality').selectpicker('refresh');
			}
		});
	}

	$(document).on('change', '#personal_info_region', function() {
		get_state();
	});

	$(document).on('change', '#personal_info_province', function() {
		get_city();
	});
</script>