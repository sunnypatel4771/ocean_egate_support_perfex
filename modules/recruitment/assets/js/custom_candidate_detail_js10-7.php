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
					$("#edit_family_religion").val(data.family_religion);
					$("#edit_family_name").val(data.family_name);
					$("#edit_family_id_no").val(data.id_no);
					$("#edit_family_birthday").val(data.birthday);
					$("#edit_family_age").val(data.age);
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
					$("#edit_faculty").val(data.faculty);
					$("#edit_major_name").val(data.major_name);
					$("#edit_year_of_graduation").val(data.year_of_graduation);
					$("#edit_final_academic_career").val(data.final_academic_career);
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
		});

		$(".psc_info_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");

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
		});

		$(".education_info_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");
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

		});

		$(".school_info_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");
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
		});

		$(".reward_info_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");
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
		});

		$(".edit_medical_info_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");
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
		});

		$(".promotion_info_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");
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
		});

		$(".licence_info_detail_delete").on("click", function() {
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

		$(".document_info_detail_delete").on("click", function() {
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


		$(".flag_info_detail_delete").on("click", function() {
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
					$("input[name='vessel_name']").val(data.vessel_name);
					$("input[name='grade_rank']").val(data.grade_rank);
					$("input[name='rank']").val(data.rank);
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

					if (data.cur_onboard == 1) {
						$('#cur_onboard').prop('checked', true);
						$("input[name='disembarkation_date']").prop('disabled', true);
					} else {
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
					$("input[name='vessel_name']").val(data.vessel_name);
					$("select[name='vessel_type[]']").selectpicker('destroy');
					$("select[name='vessel_type[]']").val(data.vessel_type);
					$("select[name='vessel_type[]']").selectpicker('refresh');
					$("input[name='gross_ton']").val(data.gross_ton);
					$("input[name='engine_type']").val(data.engine_type);
					$("input[name='eng_output']").val(data.eng_output);
					$("input[name='sailing_area']").val(data.sailing_area);
					$("input[name='last_embarkation_other_date']").val(data.disembarkation_date_validate);
					$("input[name='embarkation_other_date']").val(data.embarkation_date);
					$("input[name='disembarkation_other_date']").val(data.disembarkation_date);
					var formatted_boarding_periods = calculateBoardingPerioddays(data.embarkation_date, data.disembarkation_date);
					var formatted_boarding_period = calculateBoardingPeriod(data.embarkation_date, data.disembarkation_date);
					if (data.cur_onboard == 1) {
						$('#cur_onboard_other').prop('checked', true);
						$("input[name='disembarkation_other_date']").prop('disabled', true);
					} else {
						$('#cur_onboard_other').prop('checked', false);
						$("input[name='disembarkation_other_date']").prop('disabled', false);
					}
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

		$(".on_board_in_land_detail_delete").on("click", function() {
			var id = $(this).attr("data-id");
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

		$('#cur_onboard_other').change(function() {
			if ($(this).is(':checked')) {
				$('#disembarkation_other_date').prop('disabled', true);
			} else {
				$('#disembarkation_other_date').prop('disabled', false);
			}
		});

		$('#cur_onboard_other').change();

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
			// $('#boarding_other_month').val(boarding_other_period_month);
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

		$('#vessel_filter_board, #rank_filter, #on_board_filter').selectpicker();
		updateTotalBoardingPeriod();

		$('#vessel_filter_board').on('changed.bs.select', function() {
			filterTable('#vessel_filter_board', 4);
		});

		$('#rank_filter').on('changed.bs.select', function() {
			filterTable('#rank_filter', 3);
		});

		$('#on_board_filter').on('changed.bs.select', function() {
			filterTable('#on_board_filter', 10);
		});

		function filterTable(filterSelector, columnIdx) {
			var selectedNames = $(filterSelector).find('option:selected').map(function() {
				return $(this).text().trim();
			}).get();

			if (selectedNames.length === 0) {
				table.column(columnIdx).search('').draw();
			} else {
				table.column(columnIdx).search(selectedNames.join('|'), true, false).draw();
			}

			updateTotalBoardingPeriod();
		}

		function updateTotalBoardingPeriod() {
			var TotalBoardingPeriod = calculateTotalBoardingDays();
			// var totalDays = calculateTotalBoardingDays();
			// var years = Math.floor(totalDays / 365);
			// var months = Math.floor((totalDays % 365) / 30);
			// var days = totalDays % 30;

			$('.board_total_boarding_days').text(TotalBoardingPeriod[0] + 'Y ' + TotalBoardingPeriod[1] + 'M ' + TotalBoardingPeriod[2] + 'D');
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

		$('#vessel_filter_other, #rank_filter_other, #on_other_filter').selectpicker();

		updateTotalBoardingPeriodOther();

		$('#vessel_filter_other, #rank_filter_other, #on_other_filter').on('changed.bs.select', function() {
			filterTableOther();
		});

		function filterTableOther() {
			var filters = [{
					selector: '#vessel_filter_other',
					columnIdx: 4
				},
				{
					selector: '#rank_filter_other',
					columnIdx: 1
				},
				{
					selector: '#on_other_filter',
					columnIdx: 11
				}
			];

			$.each(filters, function(index, filter) {
				var selectedNames = $(filter.selector).find('option:selected').map(function() {
					return $(this).text().trim();
				}).get();

				if (selectedNames.length === 0) {
					table.column(filter.columnIdx).search('').draw();
				} else {
					table.column(filter.columnIdx).search(selectedNames.join('|'), true, false).draw();
				}
			});

			updateTotalBoardingPeriodOther();
		}

		function updateTotalBoardingPeriodOther() {
			var TotalBoardingotherPeriod = calculateTotalBoardingOtherDays();
			$('.other_total_boarding_days').text(TotalBoardingotherPeriod[0] + 'Y ' + TotalBoardingotherPeriod[1] + 'M ' + TotalBoardingotherPeriod[2] + 'D');
		}

		function calculateTotalBoardingOtherDays() {
			var total = 0;
			var total = 0;
			var years = 0;
			var months = 0;
			var days = 0;
			table.rows().every(function() {
				var rowData = this.data();
				var boardingDays = rowData[12];
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
				return 0;
			}
			var parts = periodString.split(' ');
			var year = parseInt(parts[0].replace('Y', '')) || 0;
			var month = parseInt(parts[1].replace('M', '')) || 0;
			var day = parseInt(parts[2].replace('D', '')) || 0;

			return [year, month, day];
		}
	});
</script>