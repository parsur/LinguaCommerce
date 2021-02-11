@extends('layouts.admin')
@section('title','دسته بندی سطح-۱')

@section('content')
    
    {{-- Header --}}
    <x-header pageName="دسته بندی ۱" buttonValue="افزودن دسته بندی">
        <x-slot name="table">
            {!! $categoryTable->table(['class' => 'table table-bordered table-striped table-hover-responsive dt_responsive nowrap text-center'], false) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-l" formId="categoryForm">
        <x-slot name="content">
            <div class="row">
                {{-- Name --}}
                <div class="col-md-12 mb-3">
                    <label for="title">نام:</label>
                    <input name="name" id="name" type="text" placeholder="نام دسته بندی">
                </div>
                {{-- Status --}}
                <div class="col-md-12">
                    <label for="status">وضعیت:</label>
                    <select id="status" name="status" class="custom-select">
                        <option value="0">فعال</option>
                        <option value="1">غیرفعال</option>
                    </select>
                </div>
            </div>
        </x-slot>
    </x-admin.insert>
    
    {{-- Delete --}}
    <x-admin.delete title="آیا مایل به حذف دسته بندی اول هستید؟" />

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
