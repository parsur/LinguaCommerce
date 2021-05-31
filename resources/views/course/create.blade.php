@extends('layouts.admin')


@section('content')
    <x-page title="ذخیره دوره" description="دوره خود را اضافه یا ویرایش کنید" formId="courseForm">
        <x-slot name="content">
            {{-- Hidden Input --}}
            <input type="hidden" name="id" id="id" value="{{ $course->id ?? null }}" />
 
            <div class="row">
                {{-- Name --}}
                <x-input key="name" name="نام" class="col-md-6 mb-3" />
                {{-- Price --}}
                <x-input key="price" name="هزینه" class="col-md-6 mb-3" />
            </div>
 
            {{-- Include Form --}}
            @include('includes.courseArticle.form', ['table' => $course])
        </x-slot>
    </x-page>
@endsection

@section('scripts')
@parent
    {{-- ckeditor initialization --}}
    <script src="{{ asset('js/ckeditor/ckeditorInit.js') }}"></script>

    {{-- Sub categories based on categories --}}
    <script src="{{ asset('js/subcategoryWithCategory.js') }}"></script>

    <script>
        // Action object
        let action = new RequestHandler(null, '#courseForm', 'course');

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
        // Display data for editing
        function displayData(data) {
            $('#button_action').val('update');
            $('#action').val('ویرایش');
            $('#name').val(data.name);
            $('#price').val(data.price);
            editor.setData(data.description.description);
            $('#status').val(data.statuses.status).trigger('change');
        }

    </script>
@endsection 