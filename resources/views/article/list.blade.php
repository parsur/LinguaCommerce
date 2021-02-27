@extends('layouts.admin')
@section('title','مدیریت مقالات')

@section('content')
  {{-- Header --}}
  <x-header pageName="مقالات" buttonValue="">
    <x-slot name="table">
      {!! $articleTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف مقاله هستید؟"/>
@endsection


@section('scripts')
  @parent
  {{-- Article Table --}}
  {!! $articleTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Article DataTable
      let dt = window.LaravelDataTables['articleTable'];
      // Actions(DataTable,Form,Url)
      let action = new requestHandler(dt,'#articleForm','article');

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
          url: "{{ url('articleVideo/edit') }}",
          data: {id: id},
          success: function(data) {
            $('#id').val(id);
            $('#button_action').val('update');
            $('#action').val('ویرایش');
            $('#title').val(data.title);
            if(data.status == 0) 
              $('#status').val(0).trigger('change');
            else if(data.status == 1) 
              $('#status').val(1).trigger('change');
          }
        })
      }
    });
  </script>
@endsection
