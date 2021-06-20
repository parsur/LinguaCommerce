class RequestHandler {
    // Constructor
    constructor(dt,formId,url) {
        window.dt = dt; // Datatable 
        window.formId = formId; // Form id
        window.url = url; // Url
    }

    // modal
    openInsertionModal() {
        $('#formModal').modal('show');
        $('#button_action').val('insert');
        $('#action').val('تایید');
        $('#form_output').html('');
        $(window.formId)[0].reset();
    }

    // Insert
    insert() {
        // Store or Update
        $(window.formId).on('submit', function (event) {
            event.preventDefault();
            // Form Data
            var form_data = new FormData(this);
            form_data.append('file', form_data);

            $.ajax({
                url: "/" + window.url + "/store",
                method: "POST",
                contentType: false,
                processData: false,
                cache: false,
                data: form_data,
                success: function (data) { 
                    success(data);
                },
                error: function (data) {
                    error(data);
                }
            })
        });
    }

    // Delete
    delete(id) {
        $('#confirmationModal').modal('show'); // Confirm
        $('#deleteSubmission').click(function () {
            $.ajax({
                url: "/" + window.url + "/delete/" + id,
                method: "get",
                success: function(data) {
                    $('#confirmationModal').modal('hide');
                    window.dt.draw(false);
                }
            })
        });
    }

    // Default edit data
    reloadModal() {
        $('#form_output').html('');
        $('#formModal').modal('show');
    }

    // Edit on success
    editOnSuccess(id) {
        $('#id').val(id);
        $('#button_action').val('update');
        $('#action').val('ویرایش');
    }
}

// Success
function success(data) {
    $('#form_output').html(data.message);
    $(window.formId)[0].reset();
    if(window.dt != null) {
        window.dt.draw(false);
    }
}

// Error
function error(data) {
    // Parse To Json
    var data = JSON.parse(data.responseText);
    // Error
    error_html = '';
    for(var all in data.errors) {
        error_html += '<div class="alert alert-danger">' + data.errors[all] + '</div>';
    }
    $('#form_output').html(error_html);
}