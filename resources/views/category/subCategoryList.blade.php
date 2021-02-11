@extends('layouts.admin')
@section('title','لیست دسته بندی سطح-۲')

@section('content')
  {{-- Header --}}
  <x-header pageName="دسته بندی ۲" buttonValue="افزودن دسته بندی دوم">
    <x-slot name="table">
      {!! $subCategoryTable->table(['class' => 'table table-bordered table-striped table-hover-responsive dt_responsive nowrap text-center'], false) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-lg" formId="subCategoryForm">
    <x-slot name="content">
      <div class="row rtl">
        {{-- Name --}}
        <div class="col-md-6">
          <label for="name">نام:</label>
          <input name="name" id="name" type="text" placeholder="نام">
        </div>
        {{-- Category --}}
        <div class="col-md-6 mb-1 lrt">
          <label for="categories">در دسته بندی سطح-۱:</label>
          <select class="browser-default custom-select" id="categories" name="categories">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        {{-- Status --}}
        <div class="col-md-12">
            <label for="status"></label>
            <select id="status" name="status" class="browser-default custom-select">
              <option value="0">فعال</option>
              <option value="1">غیر فعال</option>
            </select>
        </div>
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف دسته بندی دوم هستید؟" />

@endsection

@section('scripts')
@parent

  {!! $subCategoryTable->scripts() !!}

  <script>
    $(document).ready(function () {

        // Actions(DataTable,Form,Url)
        let dt = window.LaravelDataTables['subCategoryTable'];
        let action = new requestHandler(dt,'#subCategoryForm','subCategory');

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
        window.showEditModal = function showEditModal(url) {
            edit(url);
        }
        function edit($url) {
            var id = $url;
            $('#formModal').modal('show');
            $('#form_output').html('');

            $.ajax({
                url: "{{ url('subCategory/edit') }}",
                method: "get",
                data: {id,id},
                success: function(data) {
                    $('#id').val(data.id);
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


