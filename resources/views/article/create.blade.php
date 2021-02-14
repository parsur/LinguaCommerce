@extends('layouts.create', ['table' => ($article) ? $article->id : "", 'title' => 'مقاله', 'formId' => 'articleForm'])

@section('form')
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="title">تیتر:</label>
            <input name="title" id="title" type="text" placeholder="تیتر">
        </div>
    </div>
@endsection

@section('scripts')
@parent
    <script>
        let action = new requestHandler(null, '#articleForm', 'article');
        // Insert
        action.insert();

        // Display edit
        var id = $('#id').val();
        if (id != '') {
            edit(id);
        }
        // Edit
        function edit($id) {
            $('#form_output').html('');

            $.ajax({
                url: "{{ url('article/edit') }}",
                data: { id: $id },
                success: function (data) {
                    dataDisplay(data);
                }
            })
        }
        // Display data after editing
        function dataDisplay(data) {
            $('#button_action').val('update');
            $('#action').val('ویرایش');
            $('#title').val(data.title);
            $('#price').val(data.price);
            $('#description').val(data.description_type.description);
            $('#status').val(data.statuses.status).trigger('change');
            $('#subCategories').val(data.subCategory_id).trigger('change');
            $('#categories').val(data.category_id).trigger('change');
            mediaDisplay(data.media);
        }

        // Display media data after editing
        function mediaDisplay(data) {
            for (var all in data) {
                if(data[all].type === 0) {
                    // Image
                    setImage(data[all].media_url);
                }
                else if(data[all].type === 1) {
                    $('#aparat_url').val(data[all].media_url);
                }
            }
        }

        // Set Image
        function setImage(image) {
            var img = document.getElementById("image");
            img.src = "/images/" + image;
            img.classList.add("courseImage");
            // Hidden image
            document.getElementById("image_hidden").value = image;
        }

        // Get media after selecting the picture
        document.getElementById("media_url").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                setImageTarget(e);
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };

        // Set image target
        function setImageTarget(image) {
            // get loaded data and render thumbnail.
            var img = document.getElementById("image");
            img.src = image.target.result;
            img.classList.add("courseImage");
            // Hidden image
            document.getElementById("image_hidden").value = image.target.result;
        }
    </script>
@endsection 

