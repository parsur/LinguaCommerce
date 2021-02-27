@extends('layouts.admin')
@section('title','لیست تصاویر دوره')

@section('content')

  {{-- Header --}}
  <x-header pageName="عکس دوره" buttonValue="عکس دوره">  
    <x-slot name="table">
      {!! $courseImageTable->table(['class' => 'table table-bordered table-striped table-hover-responsive w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-lg" formId="courseImageForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.image')
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف تصویر دوره هستید؟"/>

@endsection

@section('scripts')
  @parent
  {{-- Course Image DataTable --}}
  {!! $courseImageTable->scripts() !!}

  <script>

    $(document).ready(function () {

      // Select2  
      $('#courses').select2({ width:'100%'});

      // Course Image DataTable And Action Object
      let dt = window.LaravelDataTables['courseImageTable'];
      let action = new requestHandler(dt,'#courseImageForm','courseImage');

      // Record modal
      $('#create_record').click(function () {
        $('#courses').val('').trigger('change');
        $("#picture").attr("src", "");
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
          url: "{{ url('courseImage/edit') }}",
          method: "get",
          data: {id: $url},
          dataType: "json",
          success: function(data) {
            $('#id').val($url);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
            $("#picture").attr("src", "");
            $('#hidden_image').val(data.image_url);
            $('#courses').val(data.image_id).trigger('change');
          }
        })
      }
    });
  </script>
  {{-- Image Preview --}}
  <script src="{{ asset('js/imagePreview.js') }}"></script>

@endsection
