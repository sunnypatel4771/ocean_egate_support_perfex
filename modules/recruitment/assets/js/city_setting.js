// Function to initialize the modal for adding a new city
function new_city() {
    "use strict";
    $("#city").modal("show");
    $(".edit-title").addClass("hide");
    $(".add-title").removeClass("hide");
  
    $('#city input[name="name"]').val("");
    $('select[name="state_id"]').empty().append('<option value=""></option>').selectpicker("refresh");
    $('select[name="country_id"]').val("").selectpicker("refresh");
  
    $("#additional_city").html(""); // Clear additional fields
  }
  
  // Function to initialize the modal for editing an existing city
  function edit_city(invoker, id) {
    "use strict";
    $("#additional_city").html(hidden_input("id", id));
    $('#city input[name="name"]').val($(invoker).data("name"));
  
    // Update state and country dropdowns
    var stateId = $(invoker).data("state");
    var countryId = $(invoker).data("country");
  
    // Set country and refresh state dropdown
    $("select[name='country_id']").selectpicker("val", countryId).selectpicker("refresh");
    
    // Fetch and update states based on the selected country
    updateStatesDropdown(countryId, function() {
      // After states are updated, set the selected state
      $("select[name='state_id']").val(stateId).selectpicker("refresh");
    });
  
    $("#city").modal("show");
    $(".add-title").addClass("hide");
    $(".edit-title").removeClass("hide");
  }
  
  // Update states dropdown based on the selected country
  function updateStatesDropdown(countryId, callback) {
    if (countryId) {
      $.ajax({
        url: admin_url + "recruitment/get_states_by_country_cities/" + countryId,
        type: "GET",
        dataType: "json",
        success: function (response) {
          var $stateSelect = $('select[name="state_id"]');
          $stateSelect.empty();
  
          // Check if response contains states
          if (response.length > 0) {
            $stateSelect.append('<option value="">Select State</option>');
            $.each(response, function (key, value) {
              $stateSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
            });
          } else {
            $stateSelect.append('<option value="">No States Available</option>');
          }
  
          $stateSelect.selectpicker('refresh');
  
          if (callback) {
            callback(); // Call the callback function after updating states
          }
        },
        error: function (xhr, status, error) {
          console.error("Error: " + error);
        },
      });
    } else {
      $('select[name="state_id"]').empty().append('<option value="">Select State</option>').selectpicker('refresh');
    }
  }
  
  // Reset form and validation when modal is hidden
  $("#city").on("hidden.bs.modal", function () {
    var $form = $(this).find("form");
    $form.find('input[name="state_id"]').val("");
    $form.find('input[name="name"]').val("");
    var validator = $form.validate();
    validator.resetForm();
    $form.find(".form-group").removeClass("has-error");
  });
  
  $(document).ready(function () {
    // Update states dropdown based on selected country
    $('select[name="country_id"]').on("change", function () {
      var countryId = $(this).val();
      updateStatesDropdown(countryId);
    });
  
    // Form validation and submission
    appValidateForm(
      $("#city-form"),
      {
        state_id: "required",
        country_id: "required",
        name: {
          required: true,
          remote: {
            url: admin_url + "recruitment/check_city_name_exist",
            type: "post",
            data: {
              name: function () {
                return $('input[name="name"]').val();
              },
              state_id: function () {
                return $('select[name="state_id"]').val();
              },
              id: function () {
                return $('input[name="id"]').val();
              },
            },
          },
        },
      },
      citisubmithandler,
      {
        name: {
          remote: "City Name must be unique.",
        },
      }
    );
  
    // Validate city name on state change
    $('select[name="state_id"]').on("change", function () {
      $('input[name="name"]').valid();
    });
  
    function citisubmithandler(form) {
      form.submit();
    }
  });
  