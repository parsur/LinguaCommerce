@extends('layouts.admin')
@section('title','لیست تصاویر مقاله')

@section('content')

  {{-- Header --}}
  <x-header pageName="تصاویر مقاله" buttonValue="تصاویر مقاله">  
    <x-slot name="table">
      {!! $articleImageTable->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-insert size="modal-lg" formId="articleImageForm">
    <x-slot name="content">
      <div class="row">
        {{-- Image --}}
        @include('includes.courseArticle.image')
        {{-- Article --}}
        <div class="col-md-6 mt-3">
          @include('includes.form.article')
        </div>
      </div>
    </x-slot>
  </x-insert>

  {{-- Delete Modal --}}
  <x-delete title="آیا مایل به حذف تصویر مقاله هستید؟"/>

@endsection

@section('scripts')
  @parent
  {{-- Article Image DataTable --}}
  {!! $articleImageTable->scripts() !!}

  <script>

    $(document).ready(function () {
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
          success: function(data) {
            $('#id').val($url);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
            $('#picture').attr("src", "/images/" + data.url);
            $('#hidden_image').val(data.url);
            $('#articles').val(data.media_id).trigger('change');
          }
        })
      }
    });
  </script>
  {{-- Image Preview --}}
  <script src="{{ asset('js/imagePreview.js') }}"></script>
  
@endsection
