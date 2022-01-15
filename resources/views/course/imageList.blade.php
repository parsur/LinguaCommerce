@extends('layouts.admin')
@section('title','لیست تصاویر دوره')

@section('content')

  {{-- Header --}}
  <x-header pageName="تصاویر دوره" buttonValue="تصاویر دوره">  
    <x-slot name="table">
      <x-table :table="$courseImageTable" />
    </x-slot>
  </x-header>

  {{-- Insert --}}
  <x-insert size="modal-lg" formId="courseImageForm">
    <x-slot name="content">
      <div class="row">
        <div class="col-md-6 mb-3">
          {{-- Course select box --}}
          @include('includes.form.course')
        </div>
        
        {{-- Image --}}
        @include('includes.courseArticle.image')
      </div>
    </x-slot>
  </x-insert>

  {{-- Delete --}}
  <x-delete title="تصویر دوره"/>

@endsection

@section('scripts')
  @parent
  {{-- Course Image DataTable --}}
  {!! $courseImageTable->scripts() !!}
  
  {{-- Image handler --}}
  <script src="{{ asset('js/ImageHandler.js') }}"></script>

  {{-- Image Preview --}}
  <script src="{{ asset('js/imagePreview.js') }}"></script>

  <script>
    $(document).ready(function () {  
      // Course Image DataTable And Action Object
      let dt = window.LaravelDataTables['courseImageTable'];
      let action = new RequestHandler(dt,'#courseImageForm','courseImage');

      // Image handler
      let imageHandler = new ImageHandler('course');

      // Record modal
      $('#create_record').click(function () {
        action.cleanDropbox('#course');
        imageHandler.setPicture();
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
          url: "{{ url('courseImage/edit') }}",
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
