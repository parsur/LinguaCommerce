// Submission
window.showSubmissionModal = function showSubmissionModal(id) {
  $('#form_output').html('');
  $('#submissionModal').modal('show');
  $('#submission').val(id);
}

// Store or Update
$("#submission").click(function(e) {
  e.preventDefault();
  $.ajax({
    method: "POST",
    url: "/courseComment/submit/",
    data: { 
      submission: $(this).val(),
    },
    success: function(data) {
      $('#form_output').html(data.success);
    }
  });
});
  