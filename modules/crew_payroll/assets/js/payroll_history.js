// $(document).on("change", "#payroll_reference_filter", function () {
//   var payroll_reference_filter = $(this).val();
//   var href = window.location.href;
//   href += "&payroll_reference_filter=" + payroll_reference_filter;
// });

// $(document).on("change", "#payroll_reference_filter", function () {
//   var payroll_reference_filter = $(this).val();
//   var url = new URL(window.location.href);
//   url.searchParams.set("payroll_reference_filter", payroll_reference_filter);
//   window.location.href = url.toString();
// });

// $(document).on("change", "#from_filter", function () {
//   var from_filter = $(this).val();
//   var url = new URL(window.location.href);
//   url.searchParams.set("from_filter", from_filter);
//   window.location.href = url.toString();
// });

// $(document).on("change", "#to_filter", function () {
//   var to_filter = $(this).val();
//   var url = new URL(window.location.href);
//   url.searchParams.set("to_filter", to_filter);
//   window.location.href = url.toString();
// });

function updateURLParam(param, value) {
  const url = new URL(window.location.href);
  if (!value) {
    url.searchParams.delete(param);
  } else {
    url.searchParams.set(param, value);
  }
  window.location.href = url.toString();
}

$(document).on("change", "#payroll_reference_filter", function () {
  const val = $(this).val();
  updateURLParam("payroll_reference_filter", val);
});

$(document).on("change", "#from_filter", function () {
  const val = $(this).val();
  updateURLParam("from_filter", val);
});

$(document).on("change", "#to_filter", function () {
  const val = $(this).val();
  updateURLParam("to_filter", val);
});
