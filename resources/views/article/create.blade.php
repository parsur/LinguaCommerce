@extends('layouts.courseArticle', ['table' => ($article) ? $article->id : "", 'title' => 'مقاله', 'formId' => 'articleForm'])

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

    

    </script>
@endsection 

