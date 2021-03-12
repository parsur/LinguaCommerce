@extends('layouts.admin')
@section('title','لیست دسته بندی سطح-۲')

@section('head')
@parent
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css"> 
@endsection

@section('content')
  {{-- Header --}}
  <x-header pageName="دسته بندی دوم" buttonValue="دسته بندی دوم">
    <x-slot name="table">
      {!! $subCategoryTable->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center'], false) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-insert size="modal-lg" formId="subCategoryForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.subCategory')
    </x-slot>
  </x-insert>

  {{-- Delete Modal --}}
  <x-delete title="آیا مایل به حذف دسته بندی دوم هستید؟" />

@endsection

@section('scripts')
@parent

  {!! $subCategoryTable->scripts() !!}
  <script>
    $(document).ready(function () {

        // Actions(DataTable,Form,Url)
        let dt = window.LaravelDataTables['subCategoryTable'];
        let action = new requestHandler(dt,'#subCategoryForm','subCategory');

        // Record modal
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
                url: "{{ url('subCategory/edit') }}",
                method: "get",
                data: {id:id},
                success: function(data) {
                    $('#id').val(data.id);
                    $('#action').val('ویرایش');
                    $('#button_action').val('update');
                    $('#name').val(data.name);
                    $('#status').val(data.statuses.status).trigger('change');
                    $('#categories').val(data.category_id).trigger('change');
                }
            })
        }
    });
  </script>
@endsection


