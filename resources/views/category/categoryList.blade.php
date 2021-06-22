@extends('layouts.admin')
@section('title','دسته بندی اول')

@section('content')
    {{-- Header --}}
    <x-header pageName="دسته بندی اول" buttonValue="دسته بندی اول">
        <x-slot name="table">
            <x-table :table="$categoryTable" />
        </x-slot>
    </x-header>

    {{-- Insert --}}
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
            // Category table and action object
            let dt = window.LaravelDataTables["categoryTable"];
            let action = new RequestHandler(dt,'#categoryForm','category');

            // create modal
            $('#create_record').click(function () {
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
                    url: "{{ url('category/edit') }}",
                    method: "get",
                    data: {id: $id},
                    success: function(data) {
                        action.editOnSuccess($id);
                        $('#name').val(data.name);
                        $('#status').val(data.statuses.status).trigger('change');
                    } 
                })
            }
        });
    </script>
@endsection
