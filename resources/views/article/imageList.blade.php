@extends('layouts.admin')
@section('title','لیست تصاویر مقاله')

@section('content')

  {{-- Header --}}
  <x-header pageName="عکس مقاله" buttonValue="عکس مقاله">  
    <x-slot name="table">
      {!! $articleImageTable->table(['class' => 'table table-bordered table-striped table-hover-responsive w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-lg" formId="articleImageForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.image')
      
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف تصویر مقاله هستید؟"/>

@endsection

@section('scripts')
  @parent
  {{-- Article Image DataTable --}}
  {!! $articleImageTable->scripts() !!}

  <script>

    $(document).ready(function () {

      // Select2  
      $('#articles').select2({ width:'100%'});

      // Article Image DataTable And Action Object
      let dt = window.LaravelDataTables['articleImageTable'];
      let action = new requestHandler(dt,'#articleImageForm','articleImage');

      // Record modal
      $('#create_record').click(function () {
        $('#articles').val('').trigger('change');
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
          url: "{{ url('articleImage/edit') }}",
          method: "get",
          data: {id: $url},
          dataType: "json",
          success: function(data) {
            $('#id').val($url);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
            $("#picture").attr("src", "");
            $('#hidden_image').val(data.image_url);
            $('#articles').val(data.image_id).trigger('change');
          }
        })
      }
    });
  </script>
  {{-- Image Preview --}}
  <script src="{{ asset('js/imagePreview.js') }}"></script>
  
@endsection
