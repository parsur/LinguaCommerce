@extends('layouts.admin')
@section('title', 'لیست محتوای دوره')


@section('content')
    {{-- Header --}}
    <x-header pageName="محتوای دوره" buttonValue="محتوای دوره">
      <x-slot name="table">
        {!! $courseFileTable->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center']) !!}
      </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-insert size="modal-lg" formId="courseFileForm">
      <x-slot name="content">
        {{-- Form --}}
        @include('includes.course.file')
      </x-slot>
    </x-insert>

    {{-- Delete Modal --}}
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
                    url: "{{ url('courseFile/edit') }}",
                    method: "get",
                    data: {id: $id},
                    success: function(data) {
                        $('#id').val($id);
                        $('#action').val('ویرایش');
                        $('#button_action').val('update');
                        $('#title').val(data.title);
                        $('#url').val(data.url);
                        $('#course').val(data.course_id).trigger('change');
                    }
                })
            }
        });

    </script>

@endsection
