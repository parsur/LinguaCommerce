@extends('layouts.admin')
@section('title','مدیریت دوره ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="دوره" buttonValue="">
    <x-slot name="table">
      {!! $courseTable->table(['class' => 'table table-striped table-bordered table-hover-responsive dt_responsive nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف دوره هستید؟"/>
@endsection

@section('scripts')
  @parent
  {{-- Course Table --}}
  {!! $courseTable->scripts() !!}

  <script>
    $(document).ready(function () {
      
      // Actions(DataTable,Form,Url)
      let dt = window.LaravelDataTables['courseTable'];
      let action = new requestHandler(dt,'#courseForm','course');

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

      // // Edit
      // window.showEditModal = function showEditModal(url) {
      //   edit(url);
      // }
      // function edit($url) {
      //   var id = $url;
      //   $('#formModal').modal('show');
      //   $('#form_output').html('');

      //   $.ajax({
      //     url: "{{ url('course/edit') }}",
      //     data: {id: id},
      //     success: function(data) {
      //       console.log(data.statuses.status);
      //       $('#id').val(id);
      //       $('#button_action').val('update');
      //       $('#action').val('ویرایش');
      //       $('#name').val(data.name);
      //       $('#price').val(data.price);
      //       $('#status').val(data.statuses.status).trigger('change');
      //       $('#subCategories').val(data.subCategory_id).trigger('change');
      //       $('#categories').val(data.category_id).trigger('change');
      //     }
      //   })
      // }

    });
  </script>
@endsection
