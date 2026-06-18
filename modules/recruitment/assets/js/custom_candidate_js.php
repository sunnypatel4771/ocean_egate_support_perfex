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



    var initial_promotion_date = $('#promotion').val();
    var initial_department_date = $('#department_date').val();
    var initial_vsl_career = calculateVSLCareer(initial_promotion_date, initial_department_date);
    $('#vsl_career').val(initial_vsl_career);

    var initial_promotion_date = $('#promotion').val();
    var initial_rank_career = calculateRankCareer(initial_promotion_date);
    $('#rank_career').val(initial_rank_career);
  });

  function get_state() {
    var country_id = $("#address_country").val();
    var state_id = $('#seelcted_state_value').val();

    $.ajax({
      url: '<?php echo admin_url('recruitment/get_states_by_country'); ?>',
      type: 'POST',
      data: {
        country_id: country_id
      },
      success: function(response) {
        var data = JSON.parse(response);
        $('#state').empty();
        $('#state').append('<option value="" selected disabled>Select State</option>');
        if (data.length > 0) {
          data.forEach(function(state) {
            if(state.id == state_id){
              $('#state').append('<option value="' + state.id + '" selected >' + state.name + '</option>');
            }else{
              $('#state').append('<option value="' + state.id + '">' + state.name + '</option>');
            }
          });
        }
        $('#state').val(state_id).selectpicker('refresh');
        $('#city').empty();
        $('#city').append('<option value="" selected disabled>Select City</option>');
        $('#city').selectpicker('refresh');
        $('#state').trigger('change');
      }
    });
  }

  function get_city() {
    var state_id = $('#state').val();
    var city_id = $('#seelcted_city_value').val();
    
    
    $.ajax({
      url: '<?php echo admin_url('recruitment/get_cities_by_state'); ?>',
      type: 'POST',
      data: {
        state_id: state_id
      },
      success: function(response) {
        var data = JSON.parse(response);
        $('#city').empty();
        $('#city').append('<option value="" selected disabled>Select City</option>');
        if (data.length > 0) {
          data.forEach(function(city) {
            if(city.id == city_id){
              $('#city').append('<option value="' + city.id + '" selected >' + city.name + '</option>');
            } else {
              $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
            }
          });
        }
        $('#city').val(city_id).selectpicker('refresh');
      }
    });
  }

  $(document).on('change', '#address_country', function() {
    get_state();
  });

  $(document).on('change', '#state', function() {
    get_city();
  });

  $(document).ready(function() {
      var country_id = $("#address_country").val();
      $('#address_country').trigger('change');
  });

  function get_personal_info_province() {
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

        $('#personal_info_municipality').empty();
        $('#personal_info_municipality').append('<option value="" selected disabled>Select City</option>');
        $('#personal_info_municipality').selectpicker('refresh');
      }
    });
  }

  function get_personal_info_municipality() {
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
    get_personal_info_province();
  });

  $(document).on('change', '#emp_status', function() {
    var emp_status = $(this).val();
    var candidateid = $('input[name="candidateid"]').val();
    var $departmentSelect = $("select[name='department']");

    $departmentSelect.prop('readonly', true);

    if (candidateid) {
        if (emp_status == 1) {
            // When emp_status is 1, set the value to emp_status
            $departmentSelect.val(emp_status);
            $departmentSelect.trigger('change'); // Trigger change event if needed
        } else if (emp_status == 2) {
            $.ajax({
                url: '<?php echo admin_url('recruitment/get_viesel_name_by_emp_status'); ?>',
                type: 'POST',
                data: {
                    candidateid: candidateid
                },
                success: function(response) {
                    var vessel_id = JSON.parse(response);

                    if (vessel_id === null || vessel_id === '') {
                        $departmentSelect.val('');
                        alert_float('warning', 'Vessel Name is Not Found');
                    } else {
                        $departmentSelect.val(vessel_id);
                    }
                    $departmentSelect.trigger('change'); // Trigger change event if needed
                }
            });
        } else if (emp_status == 3) {
            // When emp_status is 3, clear the value
            $departmentSelect.val('');
            $departmentSelect.trigger('change'); // Trigger change event if needed
        }
    }
});

  $(document).on('change', '#personal_info_province', function() {
    get_personal_info_municipality();
  });


// new changes 

  function get_state_2() {
    var country_id = $("#address_country").val();
    var state_id = $('#seelcted_state_value_2').val();

    $.ajax({
      url: '<?php echo admin_url('recruitment/get_states_by_country'); ?>',
      type: 'POST',
      data: {
        country_id: country_id
      },
      success: function(response) {
        var data = JSON.parse(response);
        $('#state_2').empty();
        $('#state_2').append('<option value="" selected disabled>Select State</option>');
        if (data.length > 0) {
          data.forEach(function(state) {
            if(state.id == state_id){
              $('#state_2').append('<option value="' + state.id + '" selected >' + state.name + '</option>');
            }else{
              $('#state_2').append('<option value="' + state.id + '">' + state.name + '</option>');
            }
          });
        }
        $('#state_2').val(state_id).selectpicker('refresh');
        $('#city_2').empty();
        $('#city_2').append('<option value="" selected disabled>Select City</option>');
        $('#city_2').selectpicker('refresh');
        $('#state_2').trigger('change');
      }
    });
  }

  function get_city_2() {
    var state_id = $('#state_2').val();
    var city_id = $('#seelcted_city_value_2').val();
    
    
    $.ajax({
      url: '<?php echo admin_url('recruitment/get_cities_by_state'); ?>',
      type: 'POST',
      data: {
        state_id: state_id
      },
      success: function(response) {
        var data = JSON.parse(response);
        $('#city_2').empty();
        $('#city_2').append('<option value="" selected disabled>Select City</option>');
        if (data.length > 0) {
          data.forEach(function(city) {
            if(city.id == city_id){
              $('#city_2').append('<option value="' + city.id + '" selected >' + city.name + '</option>');
            } else {
              $('#city_2').append('<option value="' + city.id + '">' + city.name + '</option>');
            }
          });
        }
        $('#city_2').val(city_id).selectpicker('refresh');
      }
    });
  }

  $(document).on('change', '#address_country_2', function() {
    get_state_2();
  });

  $(document).on('change', '#state_2', function() {
    get_city_2();
  });

  $(document).ready(function() {
      var country_id = $("#address_country_2").val();
      $('#address_country_2').trigger('change');
  });
</script>