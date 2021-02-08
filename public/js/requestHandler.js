class requestHandler {
    // Constructor
    constructor(formId,url) {
        // Form Id
        this.formId = formId;
        // Url
        this.url = url;
    }

    // modal
    modal() {
        $('#formModal').modal('show');
        $(this.formId)[0].reset();
        $('#form_output').html('');
    }

    // Insert
    insert(dt) {
        // Ajax Setup
        $.ajaxSetup({
            processing: true,
            dataType: "json"
        });

        // Form And Url
        let form = this.formId;
        let url = this.url;

        // Store or Update
        $(this.formId).on('submit', function (event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "/" + url + "/new",
                method: "POST",
                data: form_data,
                success: function (data) { 
                    $('#form_output').html(data.success);
                    $('#button_action').val('insert');
                    dt.draw(false);
                    $(form)[0].reset();
                },
                error: function (data) {
                    error(data);
                }
            })
        });
    }

    // Delete
    delete(id) {
        // Id and Url
        var id = id;
        var url = this.url;

        $('#confirmModal').modal('show');
        $('#ok_button').click(function () {
            $.ajax({
                url: "/" + url + "/delete/" + id,
                mathod: "get",
                success: function(data) {
                    $('#confirmModal').modal('hide');
                    dt.draw(false);
                }
            })
        });
    }
}


// Error Handler
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