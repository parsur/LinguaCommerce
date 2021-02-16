@extends('layouts.admin')

@section('content')
    <x-admin.page title="ذخیره مقاله" description="مقاله خود را اضافه یا ویرایش کنید" formId="articleForm">
        <x-slot name="content">
            {{-- Hidden Inputs --}}
            <input type="hidden" name="id" id="id" value="{{ ($article) ? $article->id : "" }}" />
 
            {{-- Form --}}
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="title">تیتر:</label>
                    <input name="title" id="title" type="text" placeholder="تیتر">
                </div>
            </div>
 
            {{-- Include Form --}}
            @include('includes.courseArticle.form')

        </x-slot>
    </x-admin.page>
@endsection

@section('scripts')
@parent

    <script>
        let action = new requestHandler(null, '#articleForm', 'article');
        // Media
        let media = new mediaDisplay();
        // Insert
        action.insert();

        // Check if id exists
        let id = $('#id').val();
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
                    setImage(data[all].image_url);
                }
            }
        }

        // Set Image
        function setImage(image) {
            var img = document.getElementById("image");
            img.src = "/images/" + image;
            img.classList.add("image");
            // Hidden image
            document.getElementById("hidden_image").value = image;
        }

        // Get media after selecting the picture
        document.getElementById("image_url").onchange = function () {
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
            img.classList.add("image");
            // Hidden image
            document.getElementById("hidden_image").value = image.target.result;
        }
    </script>

@endsection 

