@extends('layouts.admin')
@section('title','لیست ویدئو مقاله')

@section('content')
    {{-- Header --}}
    <x-header pageName="ویدئو مقاله" buttonValue="ویدئو مقاله">
        <x-slot name="table">
            <x-table :table="$articleVideoTable" />
        </x-slot>
    </x-header>

    {{-- Insert --}}
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

    {{-- Delete --}}
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
                action.cleanDropbox('#article'); 
                action.openModal();
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
                action.reloadModal();

                $.ajax({
                    url: "{{ url('articleVideo/edit') }}",
                    method: "get",
                    data: {id: $id},
                    success: function(data) {
                        action.editOnSuccess($id);
                        $('#aparat_url').val(data.url);
                        $('#article').val(data.media_id).trigger('change');
                    }
                })
            }
        });
    </script>
@endsection