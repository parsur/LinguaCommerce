@extends('layouts.admin')
@section('title', 'لیست ویدئو ها')

@section('content')
    {{-- Header --}}
    <x-header pageName="ویدئو ها" buttonValue="ویدئو">
        <x-slot name="table">
            {!! $videoTable->table(['class' => 'table table-bordered table-striped table-hover-responsive w-100 nowrap text-center']) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-lg" formId="videoForm">
        <x-slot name="content">
            {{-- Form --}}
            @include('includes.form.video')
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="آیا مایل به حذف ویدئو هستید؟" />
    
@endsection

@section('scripts')
    @parent
    {{-- Course Image DataTable --}}
    {!! $videoTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Select2
            $('#categories').select2({
                width: '100%'
            });

            // Course Image DataTable And Action Object
            let dt = window.LaravelDataTables['videoTable'];
            let action = new requestHandler(dt, '#videoForm', 'video');

            // Record modal
            $('#create_record').click(function() {
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
                var id = $url;
                $('#form_output').html('');
                $('#formModal').modal('show');

                $.ajax({
                    url: "{{ url('video/edit') }}",
                    method: "get",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#id').val(id);
                        $('#action').val('ویرایش');
                        $('#button_action').val('update');
                        $('#aparat_url').val(data.media_id).trigger('change');
                    }
                })
            }
        });

    </script>
@endsection
