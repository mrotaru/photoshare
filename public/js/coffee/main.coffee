jQuery ->
  $('#file_upload').change -> $('#file_name').val $(this).val()
  $('#browse_button').click -> $('#file_upload').click()
