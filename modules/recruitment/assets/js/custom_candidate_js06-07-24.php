<script>
  $(document).ready(function() {
    $("#wizard-picture").change(function() {
      readURL(this);
    });

    function calculateVSLCareer(promotion_date, department_date) {
      if (promotion_date !== '' && department_date !== '') {
        var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
        var promotion = moment(promotion_date, formats);
        var department = moment(department_date, formats);
        var difference = Math.abs(department.diff(promotion));
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var daysDifference = Math.floor(difference / millisecondsPerDay);

        return daysDifference + ' days';
      } else {
        return '';
      }
    }

    function calculateRankCareer(promotion_date) {
      if (promotion_date !== '') {
        var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
        var promotion = moment(promotion_date, formats);
        var now = moment();
        var difference = Math.abs(now.diff(promotion));
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var daysDifference = Math.floor(difference / millisecondsPerDay);

        return daysDifference + ' days';
      } else {
        return '';
      }
    }

    $('#hired_date').on('change', function() {
      var hired_date = $(this).val();
      if (hired_date !== '') {
        var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
        var now = moment();
        var hired = moment(hired_date, formats);
        var difference = Math.abs(now.diff(hired));
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var daysDifference = Math.floor(difference / millisecondsPerDay);

        $('#hire_career').val(daysDifference + ' days');
      } else {
        $('#hire_career').val('');
      }
    });

    $('#promotion').on('change', function() {
      var promotion_date = $(this).val();
      var department_date = $('#department_date').val();
      var formatted_vsl_career = calculateVSLCareer(promotion_date, department_date);
      $('#vsl_career').val(formatted_vsl_career);
    });

    $('#promotion').on('change', function() {
      var promotion_date = $(this).val();
      var formatted_rank_career = calculateRankCareer(promotion_date);
      $('#rank_career').val(formatted_rank_career);
    });

    $('#department_date').on('change', function() {
      var promotion_date = $('#promotion').val();
      var department_date = $(this).val();
      var formatted_vsl_career = calculateVSLCareer(promotion_date, department_date);
      $('#vsl_career').val(formatted_vsl_career);
    });

    function calculateBoardingPerioddays(key) {
      var embarkation_date = $('input[name="embarkation_date[' + key + ']"]').val();
      var disembarkation_date = $('input[name="disembarkation_date[' + key + ']"]').val();

      if (embarkation_date !== '' && disembarkation_date !== '') {
        var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
        var embarkation = moment(embarkation_date, formats);
        var disembarkation = moment(disembarkation_date, formats);
        var difference = Math.abs(disembarkation.diff(embarkation));
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var daysDifference = Math.floor(difference / millisecondsPerDay);
        var date_limit_for_embarkation = $('input[name="embarkation_date[' + key + ']"]').data('date');
        var date_limit_for_embarkation_formet = moment(embarkation_date, formats)

        if (embarkation_date < date_limit_for_embarkation) {
          alert_float('warning', 'Date is not valid (Embarkation Date Must be Bigger Then ' + date_limit_for_embarkation + '');
          validDates = false;
        }
        if (disembarkation.isSame(embarkation)) {
          alert_float('warning', 'Date is not valid (Embarkation and Disembarkation Dates cannot be the same)');
          validDates = false;
        }

        if (disembarkation.isBefore(embarkation)) {
          alert_float('warning', 'Date is not valid (Earlier Date than Disembarkation Date)');
          validDates = false;
        }

        return daysDifference + ' days';
      } else {
        return '';
      }
    }

    // function calculateBoardingPeriodmonth(key) {
    //   var embarkation_date = $('input[name="embarkation_date[' + key + ']"]').val();
    //   var disembarkation_date = $('input[name="disembarkation_date[' + key + ']"]').val();

    //   if (embarkation_date !== '' && disembarkation_date !== '') {
    //     var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
    //     var embarkation = moment(embarkation_date, formats);
    //     var disembarkation = moment(disembarkation_date, formats);
    //     var difference = Math.abs(disembarkation.diff(embarkation));
    //     var millisecondsPerDay = 1000 * 60 * 60 * 24;
    //     var daysDifference = Math.floor(difference / millisecondsPerDay);
    // 		var monthsDifference = daysDifference / 30;
    // 		var formattedMonthsDifference = monthsDifference.toFixed(1);
    // 		return formattedMonthsDifference;

    // 	} else {
    // 		return '';
    // 	}
    // }

    function calculateBoardingPeriod(key) {
      var embarkation_date = $('input[name="embarkation_date[' + key + ']"]').val();
      var disembarkation_date = $('input[name="disembarkation_date[' + key + ']"]').val();

      if (embarkation_date !== '' && disembarkation_date !== '') {

        var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
        var embarkation = moment(embarkation_date, formats);
        var disembarkation = moment(disembarkation_date, formats);
        var durationInDays = Math.abs(disembarkation.diff(embarkation, 'days'));

        // Calculate years, months, and remaining days
        var years = Math.floor(durationInDays / 365);
        var months = Math.floor((durationInDays % 365) / 30);
        var days = durationInDays % 30;

        var result = '';
        result += years + 'Y ';
        result += months + 'M ';
        result += days + 'D';

        if (result.trim() === '0Y 0M 0D') {
          result = '0Y 0M 0D';
        }

        return result.trim();
      } else {
        return '';
      }
    }


    // other 
    function calculateBoardingPeriodotherdays(key) {
      var embarkation_date = $('input[name="embarkation_other_date[' + key + ']"]').val();
      var disembarkation_date = $('input[name="disembarkation_other_date[' + key + ']"]').val();

      if (embarkation_date !== '' && disembarkation_date !== '') {
        var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
        var embarkation = moment(embarkation_date, formats);
        var disembarkation = moment(disembarkation_date, formats);
        var difference = Math.abs(disembarkation.diff(embarkation));
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var daysDifference = Math.floor(difference / millisecondsPerDay);
        var date_limit_for_embarkation = $('input[name="embarkation_other_date[' + key + ']"]').data('date');
        var date_limit_for_embarkation_formet = moment(embarkation_date, formats)

        if (embarkation_date < date_limit_for_embarkation) {
          alert_float('warning', 'Date is not valid (Embarkation Date Must be Bigger Then ' + date_limit_for_embarkation + '');
          validDates = false;
        }
        if (disembarkation.isSame(embarkation)) {
          alert_float('warning', 'Date is not valid (Embarkation and Disembarkation Dates cannot be the same)');
          validDates = false;
        }

        if (disembarkation.isBefore(embarkation)) {
          alert_float('warning', 'Date is not valid (Earlier Date than Disembarkation Date)');
          validDates = false;
        }

        return daysDifference + ' days';
      } else {
        return '';
      }
    }

    // function calculateBoardingPeriodothermonth(key) {
    //   var embarkation_date = $('input[name="embarkation_other_date[' + key + ']"]').val();
    //   var disembarkation_date = $('input[name="disembarkation_other_date[' + key + ']"]').val();

    //   if (embarkation_date !== '' && disembarkation_date !== '') {
    //     var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
    //     var embarkation = moment(embarkation_date, formats);
    //     var disembarkation = moment(disembarkation_date, formats);
    //     var difference = Math.abs(disembarkation.diff(embarkation));
    //     var millisecondsPerDay = 1000 * 60 * 60 * 24;
    //     var daysDifference = Math.floor(difference / millisecondsPerDay);
    // 		var monthsDifference = daysDifference / 30;
    // 		var formattedMonthsDifference = monthsDifference.toFixed(1);
    // 		return formattedMonthsDifference;

    // 	} else {
    // 		return '';
    // 	}
    // }

    function calculateBoardingotherPeriod(key) {
      var embarkation_date = $('input[name="embarkation_other_date[' + key + ']"]').val();
      var disembarkation_date = $('input[name="disembarkation_other_date[' + key + ']"]').val();

      if (embarkation_date !== '' && disembarkation_date !== '') {

        var formats = ["YYYY-MM-DD", "D.M.Y", "MM/DD/YYYY", "DD-MM-YYYY", "MMM D, YYYY"];
        var embarkation = moment(embarkation_date, formats);
        var disembarkation = moment(disembarkation_date, formats);
        var durationInDays = Math.abs(disembarkation.diff(embarkation, 'days'));

        // Calculate years, months, and remaining days
        var years = Math.floor(durationInDays / 365);
        var months = Math.floor((durationInDays % 365) / 30);
        var days = durationInDays % 30;

        var result = '';
        result += years + 'Y ';
        result += months + 'M ';
        result += days + 'D';

        if (result.trim() === '0Y 0M 0D') {
          result = '0Y 0M 0D';
        }

        return result.trim();
      } else {
        return '';
      }
    }

    // End other

    $('input[name^="embarkation_date"]').each(function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var boarding_periods = calculateBoardingPerioddays(key);
      // var boarding_period_month = calculateBoardingPeriodmonth(key);
      var boarding_period = calculateBoardingPeriod(key);
      $('input[name="boarding_periods[' + key + ']"]').val(boarding_periods);
      // $('input[name="boarding_month[' + key + ']"]').val(boarding_period_month);
      $('input[name="boarding_period[' + key + ']"]').val(boarding_period);
    });

    $('input[name^="embarkation_other_date"]').each(function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var boarding_periods = calculateBoardingPeriodotherdays(key);
      // var boarding_period_month = calculateBoardingPeriodothermonth(key);
      var boarding_period = calculateBoardingotherPeriod(key);
      $('input[name="boarding_other_periods[' + key + ']"]').val(boarding_periods);
      // $('input[name="boarding_other_month[' + key + ']"]').val(boarding_period_month);
      $('input[name="boarding_other_period[' + key + ']"]').val(boarding_period);
    });

    $('input[name^="disembarkation_date"]').each(function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var formatted_boarding_periods = calculateBoardingPerioddays(key);
      // var boarding_period_month = calculateBoardingPeriodmonth(key);
      var boarding_period = calculateBoardingPeriod(key);
      $('input[name="boarding_periods[' + key + ']"]').val(formatted_boarding_periods);
      // $('input[name="boarding_month[' + key + ']"]').val(boarding_period_month);
      $('input[name="boarding_period[' + key + ']"]').val(boarding_period);
    });

    $('input[name^="disembarkation_other_date"]').each(function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var formatted_boarding_periods = calculateBoardingPeriodotherdays(key);
      // var boarding_period_month = calculateBoardingPeriodothermonth(key);
      var boarding_period = calculateBoardingotherPeriod(key);
      $('input[name="boarding_other_periods[' + key + ']"]').val(formatted_boarding_periods);
      // $('input[name="boarding_other_month[' + key + ']"]').val(boarding_period_month);
      $('input[name="boarding_other_period[' + key + ']"]').val(boarding_period);
    });


    $(document).on('change', 'input[name^="embarkation_date"]', function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var formatted_boarding_periods = calculateBoardingPerioddays(key);
      var boarding_period = calculateBoardingPeriod(key);
      $('input[name="boarding_periods[' + key + ']"]').val(formatted_boarding_periods);
      $('input[name="boarding_period[' + key + ']"]').val(boarding_period);
    });

    $(document).on('change', 'input[name^="embarkation_other_date"]', function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var formatted_boarding_periods = calculateBoardingPeriodotherdays(key);
      var boarding_period = calculateBoardingotherPeriod(key);
      $('input[name="boarding_other_periods[' + key + ']"]').val(formatted_boarding_periods);
      $('input[name="boarding_other_period[' + key + ']"]').val(boarding_period);
    });

    $(document).on('change', 'input[name^="disembarkation_date"]', function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var formatted_boarding_periods = calculateBoardingPerioddays(key);
      var boarding_period = calculateBoardingPeriod(key);
      $('input[name="boarding_periods[' + key + ']"]').val(formatted_boarding_periods);
      $('input[name="boarding_period[' + key + ']"]').val(boarding_period);
    });

    $(document).on('change', 'input[name^="disembarkation_other_date"]', function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var formatted_boarding_periods = calculateBoardingPeriodotherdays(key);
      var boarding_period = calculateBoardingotherPeriod(key);
      $('input[name="boarding_other_periods[' + key + ']"]').val(formatted_boarding_periods);
      $('input[name="boarding_other_period[' + key + ']"]').val(boarding_period);
    });


    $('input[name^="cur_onboard"]').each(function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var isChecked = $(this).prop('checked');

      if (isChecked) {
        $('input[name="disembarkation_date[' + key + ']"]').prop('disabled', true);
      } else {
        $('input[name="disembarkation_date[' + key + ']"]').prop('disabled', false);
      }
    });

    $(document).on('change', 'input[name^="cur_onboard"]', function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var isChecked = $(this).prop('checked');

      if (isChecked) {
        $('input[name="disembarkation_date[' + key + ']"]').prop('disabled', true);
      } else {
        $('input[name="disembarkation_date[' + key + ']"]').prop('disabled', false);
      }
    });

    $('input[name^="cur_other_onboard"]').each(function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var isChecked = $(this).prop('checked');

      if (isChecked) {
        $('input[name="disembarkation_other_date[' + key + ']"]').prop('disabled', true);
      } else {
        $('input[name="disembarkation_other_date[' + key + ']"]').prop('disabled', false);
      }
    });

    $(document).on('change', 'input[name^="cur_other_onboard"]', function() {
      var key = $(this).attr('name').match(/\[(.*?)\]/)[1];
      var isChecked = $(this).prop('checked');

      if (isChecked) {
        $('input[name="disembarkation_other_date[' + key + ']"]').prop('disabled', true);
      } else {
        $('input[name="disembarkation_other_date[' + key + ']"]').prop('disabled', false);
      }
    });


    var initial_promotion_date = $('#promotion').val();
    var initial_department_date = $('#department_date').val();
    var initial_vsl_career = calculateVSLCareer(initial_promotion_date, initial_department_date);
    $('#vsl_career').val(initial_vsl_career);

    var initial_promotion_date = $('#promotion').val();
    var initial_rank_career = calculateRankCareer(initial_promotion_date);
    $('#rank_career').val(initial_rank_career);
  });
</script>