class commentSubmission {
  
  // Opening modal
  modal(id) {
    $('#form_output').html('');
    $('#submissionModal').modal('show');  
    $('#submission').val(id);
  }

  // Store or Update
  submit(table) {
    $("#submission").click(function(e) {
      $.ajax({
        type: "POST",
        url: "/" + table + "Comment/submission",
        data: { 
          submission: $(this).val(),
        },
        success: function(data) {
          $('#form_output').html(data.message);
        }
      })
    });
  }
}
  