class ImageHandler {
    // Constructor
    constructor(model) {
        window.model = model; // DataTable 
    }

    // Style of picture
    picture() {
        // Select2
        $('#' + window.model).val('').trigger('change');
        // Picture
        $("#picture").attr("src", "");
        $("#picture").attr("alt", "عکس خود را وارد نمایید");
        // Hidden image
        $('#hidden_image').val(null);
    }

    // Successful edit
    successfulEdit(data) {
        $('#action').val('ویرایش');
        $('#button_action').val('update');
        $('#picture').attr("src", "/images/" + data.url);
        $('#hidden_image').val(data.url);
        $('#' + window.model).val(data.media_id).trigger('change');
    }
}
