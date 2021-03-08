@extends('layouts.admin')
@section('title', 'لیست محتوای دوره')


@section('content')
  {{-- Header --}}
  <x-header pageName="محتوای دوره" buttonValue="محتوای دوره">  
    <x-slot name="table">
      {!! $courseFileTable->table(['class' => 'table table-bordered table-striped table-hover-responsive w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-lg" formId="courseFileForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.course.file')
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف محتوای دوره هستید؟"/>
@endsection

@section('scripts')
  @parent
  {{-- Course file DataTable --}}
  {!! $courseFileTable->scripts() !!}

  <script>

    $(document).ready(function () {
      // Select2  
      $('#course').select2({ width:'100%'});

      // Course Image DataTable And Action Object
      let dt = window.LaravelDataTables['courseFileTable'];
      let action = new requestHandler(dt,'#courseFileForm','courseFile');

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
          url: "{{ url('courseFile/edit') }}",
          method: "get",
          data: {id: $url},
          dataType: "json",
          success: function(data) {
            $('#id').val($url);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
            $('#hidden_files').val(data.url);
            $('#courses').val(data.course_id).trigger('change');
          }
        })
      }
    });
  </script>

@endsection