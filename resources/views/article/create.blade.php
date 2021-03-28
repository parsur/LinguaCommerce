@extends('layouts.admin')

@section('content')
    <x-page title="ذخیره مقاله" description="مقاله خود را اضافه یا ویرایش کنید" formId="articleForm">
        <x-slot name="content">
            {{-- Hidden Inputs --}}
            <input type="hidden" name="id" id="id" value="{{ $article->id ?? "" }}" />
 
            {{-- Form --}}
            <div class="row">
                <div class="col-md-12 mb-3">
                    <x-input key="title" name="تیتر" />
                </div>
            </div>
 
            {{-- Include Form --}}
            @include('includes.courseArticle.form', ['table' => $article])

        </x-slot>
    </x-page>
@endsection

@section('scripts')
@parent
    {{-- ckeditor initialization --}}
    <script src="{{ asset('js/ckeditor/ckeditorInit.js') }}"></script>

    <script>
        let action = new RequestHandler(null, '#articleForm', 'article');
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
                    displayData(data);
                }
            })
        }
        // Display data after editing
        function displayData(data) {
            $('#button_action').val('update');
            $('#action').val('ویرایش');
            $('#title').val(data.title);
            $('#price').val(data.price);
            editor.setData(data.description.description);
            $('#status').val(data.statuses.status).trigger('change');
            $('#subCategories').val(data.subCategory_id).trigger('change');
            $('#categories').val(data.category_id).trigger('change');
        }
    </script>

@endsection 

