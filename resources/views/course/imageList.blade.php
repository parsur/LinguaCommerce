@extends('layouts.admin')
@section('title','لیست تصاویر دوره')

@section('content')

  {{-- Header --}}
  <x-header pageName="تصاویر دوره" buttonValue="تصاویر دوره">  
    <x-slot name="table">
      {!! $courseImageTable->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-insert size="modal-lg" formId="courseImageForm">
    <x-slot name="content">
      <div class="row">
        <div class="col-md-6 mb-2">
            {{-- Course Select Box --}}
            @include('includes.form.course')
        </div>
    
        {{-- Image --}}
        @include('includes.courseArticle.image')
      </div>
    </x-slot>
  </x-insert>

  {{-- Delete Modal --}}
  <x-delete title="آیا مایل به حذف تصویر دوره هستید؟"/>

@endsection

@section('scripts')
  @parent
  {{-- Course Image DataTable --}}
  {!! $courseImageTable->scripts() !!}

  <script>

    $(document).ready(function () {  
      // Course Image DataTable And Action Object
      let dt = window.LaravelDataTables['courseImageTable'];
      let action = new requestHandler(dt,'#courseImageForm','courseImage');

      // Record modal
      $('#create_record').click(function () {
        $('#courses').val('').trigger('change');
        $("#picture").attr("src", "");
        $('#hidden_image').val(null);
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
          url: "{{ url('courseImage/edit') }}",
          method: "get",
          data: {id: id},
          success: function(data) {
            $('#id').val(id);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
            $('#picture').attr("src", "/images/" + data.url);
            $('#hidden_image').val(data.url);
            $('#courses').val(data.media_id).trigger('change');
          }
        })
      }
    });
  </script>
  {{-- Image Preview --}}
  <script src="{{ asset('js/imagePreview.js') }}"></script>

@endsection
