$("#pacient-form").submit(function (e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: "action_ajax_form.php",
    data: $("#pacient-form").serialize(),
    success: function (data) {
      $("#wdh_result_form").html(data);
    }
  });
});