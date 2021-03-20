@extends('layouts.admin')
@section('title','لیست ویدئو مقاله')

@section('content')
    {{-- Header --}}
    <x-header pageName="ویدئو مقاله" buttonValue="ویدئو مقاله">
        <x-slot name="table">
            {!! $articleVideoTable->table(['class' => 'table table-bordered table-striped w-100 text-center'], false) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-insert size="modal-lg" formId="articleVideoForm">
        <x-slot name="content">
            <div class="row">
                {{-- Video --}}
                @include('includes.courseArticle.video')
                {{-- Article --}}
                <div class="col-md-12">
                    @include('includes.form.article')
                </div>
            </div>
        </x-slot>
    </x-insert>

    {{-- Delete Modal --}}
    <x-delete title="آیا مایل به حذف ویدئو مقاله هستید؟" />
@endsection

@section('scripts')
    @parent

    {!! $articleVideoTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Article video DataTable And Action Object
            let dt = window.LaravelDataTables['articleVideoTable'];
            let action = new RequestHandler(dt,'#articleVideoForm','articleVideo');

            // Record modal
            $('#create_record').click(function () {
                $('#article').val('').trigger('change');
                action.modal();
            });

            // Insert
            action.insert();

            // Delete
            window.showConfirmationModal = function showConfirmationModal(url) {
                action.delete(url);
            }
            // Edit
            window.showEditModal = function showEditModal(id) {
                edit(id);
            }
            function edit($id) {
                action.edit();

                $.ajax({
                    url: "{{ url('articleVideo/edit') }}",
                    method: "get",
                    data: {id: $id},
                    success: function(data) {
                        console.log(data.media_id);
                        $('#id').val($id);
                        $('#action').val('ویرایش');
                        $('#button_action').val('update');
                        $('#aparat_url').val(data.url);
                        $('#article').val(data.media_id).trigger('change');
                    }
                })
            }
        });
    </script>
@endsection