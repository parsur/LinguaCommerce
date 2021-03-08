@extends('layouts.admin')
@section('title','لیست ویدئو مقاله')

@section('content')
    {{-- Header --}}
    <x-header pageName="ویدئو دوره" buttonValue="ویدئو دوره">
        <x-slot name="table">
            {!! $courseVideoTable->table(['class' => 'table table-bordered table-striped table-hover-responsive w-100 nowrap text-center'], false) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-lg" formId="courseVideoForm">
        <x-slot name="content">
            {{-- Form --}}
            @include('includes.course.video')
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="آیا مایل به حذف ویدئو دوره هستید؟" />

@endsection


@section('scripts')
    @parent

    {!! $courseVideoTable->scripts() !!}

    <script>
        $(document).ready(function() {

            // Select2
            $('#course').select2({ width:'100%'});

            // COurse Video DataTable And Action Object
            let dt = window.LaravelDataTables['courseVideoTable'];
            let action = new requestHandler(dt,'#courseVideoForm','courseVideo');

            // Record modal
            $('#create_record').click(function () {
                $('#courses').val('').trigger('change');
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
                    url: "{{ url('courseVideo/edit') }}",
                    method: "get",
                    data: {id: $url},
                    success: function(data) {
                        $('#id').val($url);
                        $('#action').val('ویرایش');
                        $('#button_action').val('update');
                        $('#aparat_url').val(data.url);
                        $('#courses').val(data.media_id).trigger('change');
                    }
                })
            }
        });
    </script>
    
@endsection