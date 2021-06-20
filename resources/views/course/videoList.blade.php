@extends('layouts.admin')
@section('title','لیست ویدئو مقاله')

@section('content')
    {{-- Header --}}
    <x-header pageName="ویدئو دوره" buttonValue="ویدئو دوره">
        <x-slot name="table">
            <x-table :table="$courseVideoTable" />
        </x-slot>
    </x-header>

    {{-- Insert --}}
    <x-insert size="modal-lg" formId="courseVideoForm">
        <x-slot name="content">
            <div class="row">
                {{-- Video --}}
                @include("includes.courseArticle.video")
                
                <div class="col-md-12">
                  {{-- Courses --}}
                  @include('includes.form.course')
                </div>
            </div>
        </x-slot>
    </x-insert>

    {{-- Delete --}}
    <x-delete title="ویدئو دوره" />

@endsection


@section('scripts')
    @parent

    {!! $courseVideoTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Course Video DataTable And Action Object
            let dt = window.LaravelDataTables['courseVideoTable'];
            let action = new RequestHandler(dt,'#courseVideoForm','courseVideo');

            // Record modal
            $('#create_record').click(function () {
                $('#course').val('').trigger('change');
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
                    url: "{{ url('courseVideo/edit') }}",
                    method: "get",
                    data: {id: $id},
                    success: function(data) {
                        action.editData($id);
                        $('#aparat_url').val(data.url);
                        $('#course').val(data.media_id).trigger('change');
                    }
                })
            }
        });
    </script>
    
@endsection