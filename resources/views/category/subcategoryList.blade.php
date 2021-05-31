@extends('layouts.admin')
@section('title','لیست دسته بندی سطح-۲')

@section('content')
  {{-- Header --}}
  <x-header pageName="دسته بندی دوم" buttonValue="دسته بندی دوم">
    <x-slot name="table">
      <x-table :table="$subcategoryTable" />
    </x-slot>
  </x-header>

  {{-- Insert --}}
  <x-insert size="modal-lg" formId="subcategoryForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.category')

      {{-- Category --}}
      <div class="row">
        <div class="col-md-12 mt-3">
          <label for="categories">در دسته بندی اول:</label>
          <select class="custom-select" id="categories" name="categories">
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </x-slot>
  </x-insert>

  {{-- Delete --}}
  <x-delete title="آیا مایل به حذف دسته بندی دوم هستید؟" />

@endsection

@section('scripts')
@parent

  {!! $subcategoryTable->scripts() !!}
  
  <script>
    $(document).ready(function () {
      // Actions(DataTable,Form,Url)
      let dt = window.LaravelDataTables['subcategoryTable'];
      let action = new RequestHandler(dt,'#subcategoryForm','subcategory');

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
      window.showEditModal = function showEditModal(id) {
          edit(id);
      }
      function edit($id) {
        action.edit();

        $.ajax({
          url: "{{ url('subcategory/edit') }}",
          method: "get",
          data: {id: $id},
          success: function(data) {
            $('#id').val($id);
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


