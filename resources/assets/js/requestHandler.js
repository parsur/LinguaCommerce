class requestHandler {
    // Constructor
    constructor(dt,formId,url) {
        window.dt = dt; // DataTable 
        window.formId = formId; // Form Id
        window.url = url; // Url
    }

    // modal
    modal() {
        $('#formModal').modal('show');
        $(window.formId)[0].reset();
        $('#form_output').html('');
    }

    // Insert
    insert() {
        // Store or Update
        $(window.formId).on('submit', function (event) {
            event.preventDefault();
            // Form Data
            var form_data = new FormData(this);
            form_data.append('file',form_data);

            $.ajax({
                url: "/" + window.url + "/new",
                method: "POST",
                contentType: false,
                processData: false,
                cache: false,
                data: form_data,
                success: function (data) { 
                    success(data);
                },
                error: function (data) {
                    if(data)
                        error(data);
                }
            })
        });
    }

    // Delete
    delete(id) {
        $('#confirmModal').modal('show');
        $('#ok_button').click(function () {
            $.ajax({
                url: "/" + window.url + "/delete/" + id,
                method: "get",
                success: function(data) {
                    $('#confirmModal').modal('hide');
                    window.dt.draw(false);
                }
            })
        });
    }
}

// Success
function success(data) {
    $('#form_output').html(data.success);
    $('#button_action').val('insert');
    window.dt.draw(false);
    $(window.formId)[0].reset();
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