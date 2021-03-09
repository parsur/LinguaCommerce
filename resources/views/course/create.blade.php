@extends('layouts.admin')

@section('content')
    <x-admin.page title="ذخیره دوره" description="دوره خود را اضافه یا ویرایش کنید" formId="courseForm">
        <x-slot name="content">
            {{-- Hidden Input --}}
            <input type="hidden" name="id" id="id" value="{{ ($course) ? $course->id : "" }}" />
 
            {{-- Name --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">نام:</label>
                    <input name="name" id="name" type="text" placeholder="نام">
                </div>
                {{-- Price --}}
                <div class="col-md-6 mb-3">
                    <label for="price">هزینه:</label>
                    <input name="price" id="price" type="text" placeholder="هزینه">
                </div>
            </div>
 
            {{-- Include Form --}}
            @include('includes.courseArticle.form', ['table' => $course])
        </x-slot>
    </x-admin.page>
@endsection

@section('scripts')
@parent
    {{-- Tinymce initialization --}}
    <script src="{{ asset('js/tinymceInit.js') }}"></script>

    <script>
        // Select2
        $('#categories').select2({ width:'100%' });
        $('#subCategories').select2({width:'100%'});

        // Action object
        let action = new requestHandler(null, '#courseForm', 'course');

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
                url: "{{ url('course/edit') }}",
                data: { id: $id },
                success: function (data) {
                    displayData(data);
                }
            })
        }
        // Display data after editing
        function displayData(data) {
            $('#button_action').val('update');
            $('#action').val('ویرایش');
            $('#name').val(data.name);
            $('#price').val(data.price);
            $('#description').val(data.description.description);
            $('#status').val(data.statuses.status).trigger('change');
        }

        // Ajax Category Based on Sub Category
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
    </script>
@endsection 