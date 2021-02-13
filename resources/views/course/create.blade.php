@extends('layouts.admin')
@section('افزودن دوره')
@section('content')

<x-admin.create title="دوره" formId="courseForm">
    <x-slot name="content">
        {{-- Hidden Inputs --}}
        <input type="hidden" name="id" id="id" value="{{ ($course) ? $course->id : "" }}" />
        <input type="hidden" name="button_action" id="button_action" value="insert" />

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
        <div class="row">
            {{-- Status --}}
            <div class="col-md-6 mb-3">
                <label for="status">وضعیت:</label>
                <select id="status" name="status" class="custom-select">
                    <option value="0">فعال</option>
                    <option value="1">غیرفعال</option>
                </select>
            </div>
            {{-- Media Url --}}
            <div class="col-md-6 mb-3">
                <label for="media_url">انتخاب عکس ها:</label>
                <br>
                <input type="file" name="media_url[]" multiple />
                {{-- Image --}}
                <input type="hidden" id="image" name="image" />
            </div>
        </div>
        <div class="row">
            {{-- Aparat Url --}}
            <div class="col-md-12 mb-3">
                <label for="aparat_url">لینک ویدئو آپارات:</label>
                <textarea rows="4" id="aparat_url" name="aparat_url" type="url" class="form-control" placeholder="لینک ویدئو آپارات"></textarea>
            </div>
        </div>
        <div class="row">
            {{-- Category --}}
            <div class="col-md-6 mb-3">
                <label for="categories">دسته بندی سطح-۱</label>
                <select name="categories" id="categories" class="custom-select">
                    <option value="">دسته بندی سطح-۱</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            {{-- Sub Category --}}
            <div class="col-md-6">
                <label for="subCategories">دسته بندی سطح-۲</label>
                <select name="subCategories" id="subCategories" class="custom-select">
                    <option value="">دسته بندی سطح-۲</option>
                    @foreach($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- Description --}}
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="description">توضیح:</label>
                <textarea id="description" name="description" rows="5" class="form-control"></textarea>
            </div>
        </div>
    </x-slot>
</x-admin.create>


@endsection


@section('scripts')
@parent

    {{-- Tinymce --}}
    <script src="{{ asset('js/tinymce.js') }}"></script>
    {{-- Tinymce Initialization --}}
    <script src="{{ asset('js/tinymceInit.js') }}"></script>

    <script>
        // Ajax/ Categories based on Sub Categories
        $('#categories').on('change', function (e) {
            var c_id = e.target.value;
            $.get('/subCategory?category_id=' + c_id, function (data) {
                $('#subCategories').empty();
                $("#subCategories").append('<option value="">دسته بندی سطح-۲</option>');
                $.each(data, function (index, subCat) {
                    $("#subCategories").append('<option value="' + subCat.id + '">' + subCat.name + '</option>');
                });
            });
        });

        $(document).ready(function () {

            // Actions(DataTable,Form,Url)
            let action = new requestHandler(null, '#courseForm', 'course');

            // Insert
            action.insert();

            var id = document.getElementById("id").value;
            if (id != null) {
                edit(id);
            }
            // Edit
            function edit($id) {
                $('#form_output').html('');

                $.ajax({
                    url: "{{ url('course/edit') }}",
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
                $('#name').val(data.name);
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
                    if(data[all].type == 0) {
                        $('#image').val("Image is not empty.");
                    }
                    else if(data[all].type == 1) {
                        $('#aparat_url').val(data[all].media_url);
                    }
                }
            }
        });
    </script>
@endsection