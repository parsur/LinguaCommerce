@extends('layouts.courseArticle', ['table' => ($course) ? $course->id : "", 'title' => 'دوره', 'formId' => 'courseForm'])

@section('form')
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
@endsection

@section('scripts')
@parent
    <script>
        let action = new requestHandler(null, '#courseForm', 'course');
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
            $('#title').val(data.title);
            $('#price').val(data.price);
            $('#description').val(data.description_type.description);
            $('#status').val(data.statuses.status).trigger('change');
            $('#subCategories').val(data.subCategory_id).trigger('change');
            $('#categories').val(data.category_id).trigger('change');
            mediaDisplay(data.media);
        }
    </script>
@endsection 