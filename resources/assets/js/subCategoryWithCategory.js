// Ajax category Based on Sub category
$('#categories').on('change', function (e) {
    var category_id = e.target.value;
    $.get('/subCategory?category_id=' + category_id, function (data) {
        $('#subCategories').empty();
        $("#subCategories").append('<option value="">دسته بندی سطح-۲</option>');
        $.each(data, function (index, subCat) {
            $("#subCategories").append('<option value="' + subCat.id + '">' + subCat.name + '</option>');
        })
    })
})