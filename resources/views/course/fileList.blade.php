@extends('layouts.admin')
@section('title', 'لیست محتوای دوره')


@section('content')
    {{-- Header --}}
    <x-header pageName="محتوای دوره" buttonValue="محتوای دوره">
      <x-slot name="table">
        <x-table :table="$courseFileTable" />
      </x-slot>
    </x-header>

    {{-- Insert --}}
    <x-insert size="modal-lg" formId="courseFileForm">
      <x-slot name="content">
        {{-- Form --}}
        <div class="row">
            {{-- Title --}}
            <x-input key="title" name="عنوان" class="col-md-12 mb-3"/>
            {{-- Files --}}
            <x-textarea key="url" placeholder="لینک محتوا" 
                rows="5"  class="col-md-12 mb-3" />
            {{-- Course select box --}}
            <div class="col-md-12">
                @include('includes.form.course')
            </div>
        </div>
      </x-slot>
    </x-insert>

    {{-- Delete --}}
    <x-delete title="آیا مایل به حذف محتوای دوره هستید؟" />
@endsection

@section('scripts')
    @parent
    {{-- Course file DataTable --}}
    {!! $courseFileTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Course Image DataTable And Action Object
            let dt = window.LaravelDataTables['courseFileTable'];
            let action = new RequestHandler(dt, '#courseFileForm', 'courseFile');

            // Record modal
            $('#create_record').click(function() {
                action.cleanDropbox('#course'); 
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
                    url: "{{ url('courseFile/edit') }}",
                    method: "get",
                    data: {id: $id},
                    success: function(data) {
                        action.editOnSuccess($id);   
                        $('#title').val(data.title);
                        $('#url').val(data.url);
                        $('#course').val(data.course_id).trigger('change');
                    }
                })
            }
        });
    </script>
@endsection
