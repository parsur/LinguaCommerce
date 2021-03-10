@extends('layouts.admin')
@section('title','دسته بندی اول')

@section('content')
    {{-- Header --}}
    <x-header pageName="دسته بندی اول" buttonValue="دسته بندی اول">
        <x-slot name="table">
            {!! $categoryTable->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center'], false) !!} 
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-insert size="modal-l" formId="categoryForm">
        <x-slot name="content">
            {{-- Form --}}
            @include('includes.form.category')
        </x-slot>
    </x-insert>
    
    {{-- Delete --}}
    <x-delete title="آیا مایل به حذف دسته بندی اول هستید؟" />
@endsection

@section('scripts')
    @parent
    {{-- Category Scripts --}}
    {!! $categoryTable->scripts() !!}
    
    <script>
        $(document).ready(function () {
            // Category Table and Action Object
            let dt = window.LaravelDataTables["categoryTable"];
            let action = new requestHandler(dt,'#categoryForm','category');

            // create modal
            $('#create_record').click(function () {
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
                $('#formModal').modal('show');
                $('#form_output').html('');

                $.ajax({
                    url: "{{ url('category/edit') }}",
                    method: 'get',
                    data: { id: id },
                    success: function (data) {  
                        $('#id').val(id);
                        $('#button_action').val('update');
                        $('#action').val('ویرایش');
                        $('#name').val(data.name);
                        $('#status').val(data.statuses.status).trigger('change');
                    }
                })
            }
        });
    </script>
@endsection
