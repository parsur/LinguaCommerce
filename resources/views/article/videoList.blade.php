@extends('layouts.admin')
@section('title','لیست ویدئو مقاله')

@section('content')
    {{-- Header --}}
    <x-header pageName="ویدئو مقاله" buttonValue="ویدئو مقاله">
        <x-slot name="table">
            {!! $articleVideoTable->table(['class' => 'table table-bordered table-striped table-hover-responsive w-100 nowrap text-center'], false) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-lg" formId="articleVideoForm">
        <x-slot name="content">
            <div class="row">
                {{-- Video --}}
                <div class="col-md-12 mb-3">
                  <label for="aparat_url">لینک ویدئو:</label>
                  <textarea rows="3" id="aparat_url" name="aparat_url" type="text" class="form-control" placeholder="لینک ویدئو آپارات"></textarea>
                </div>

                {{-- Articles --}}
                <div class="col-md-12">
                    @include('includes.articleSelectBox')
                </div>
            </div>
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="آیا مایل به حذف ویدئو مقاله هستید؟" />

@endsection


@section('scripts')
    @parent

    {!! $articleVideoTable->scripts() !!}

    <script>
        $(document).ready(function() {

            // Select2
            $('#articles').select2({ width:'100%'});

            // Article video DataTable And Action Object
            let dt = window.LaravelDataTables['articleVideoTable'];
            let action = new requestHandler(dt,'#articleVideoForm','articleVideo');

            // Record modal
            $('#create_record').click(function () {
                $('#articles').val('').trigger('change');
                action.modal();
            });

            // Insert
            action.insert();

            // Delete
            window.showConfirmationModal = function showConfirmationModal(url) {
                action.delete(url);
            }
            // Edit
            window.showEditModal = function showEditModal(url) {
                edit(url);
            }
            function edit($url) {
                $('#form_output').html('');
                $('#formModal').modal('show');

                $.ajax({
                    url: "{{ url('articleVideo/edit') }}",
                    method: "get",
                    data: {id: $url},
                    success: function(data) {
                        $('#id').val($url);
                        $('#action').val('ویرایش');
                        $('#button_action').val('update');
                        $('#aparat_url').val(data.video_url);
                        $('#articles').val(data.video_id).trigger('change');
                    }
                })
            }
        });
    </script>
@endsection