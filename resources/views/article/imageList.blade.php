@extends('layouts.admin')
@section('title','لیست تصاویر مقاله')

@section('content')

  {{-- Header --}}
  <x-header pageName="تصاویر مقاله" buttonValue="تصاویر مقاله">  
    <x-slot name="table">
      <x-table :table="$articleImageTable" />
    </x-slot>
  </x-header>

  {{-- Insert --}}
  <x-insert size="modal-lg" formId="articleImageForm">
    <x-slot name="content">
      <div class="row">
        {{-- Article --}}
        <div class="col-md-6 mb-3">
          @include('includes.form.article')
        </div>
        {{-- Image --}}
        @include('includes.courseArticle.image')
      </div>
    </x-slot>
  </x-insert>

  {{-- Delete --}}
  <x-delete title="آیا مایل به حذف تصویر مقاله هستید؟"/>

@endsection

@section('scripts')
  @parent
  {{-- Article Image DataTable --}}
  {!! $articleImageTable->scripts() !!}

  {{-- Image handler --}}
  <script src="{{ asset('js/ImageHandler.js') }}"></script>

  {{-- Image Preview --}}
  <script src="{{ asset('js/imagePreview.js') }}"></script>
  
  <script>
    $(document).ready(function () {
      // Article Image DataTable And Action Object
      let dt = window.LaravelDataTables['articleImageTable'];
      let action = new RequestHandler(dt,'#articleImageForm','articleImage');

      // Image handler
      let imageHandler = new ImageHandler('course');

      // Record modal
      $('#create_record').click(function () {
        imageHandler.picture();
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
          url: "{{ url('articleImage/edit') }}",
          method: "get",
          data: {id: $id},
          success: function(data) {
            action.editOnSuccess($id);
            imageHandler.successfulEdit(data);  
          }
        })
      }
    });
  </script>

@endsection
