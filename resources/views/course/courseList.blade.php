@extends('layouts.admin')
@section('title','مدیریت دوره ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="دوره" buttonValue="افزودن دوره">
    <x-slot name="table">
      {!! $courseTable->table(['class' => 'table table-striped table-bordered table-hover-responsive dt_responsive nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-lg" formId="courseForm">
    <x-slot name="content">
      {{-- Name --}}
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="name">نام:</label>
          <input name="name" id="name" type="text" placeholder="نام">
        </div>
        {{-- Price --}}
        <div class="col-md-6 mb-3">
          <label for="price">هزینه:</label>
          <input name="price" id="price" type="text" placeholder="هزینه">
        </div>
      </div>
      <div class="row">
        {{-- Status --}}
        <div class="col-md-12 mb-3">
          <label for="status">وضعیت:</label>
          <select id="status" name="status" class="custom-select">
            <option value="0">فعال</option>
            <option value="1">غیرفعال</option>
          </select>
        </div>
      </div>
      <div class="row">
        {{-- Category --}}
        <div class="col-md-6 mb-3"> 
          <label for="categories">دسته بندی سطح-۱</label>
          <select name="categories" id="categories" class="custom-select">
            <option value="">دسته بندی سطح-۱</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        {{-- Sub Category --}}
        <div class="col-md-6">
          <label for="subCategories">دسته بندی سطح-۲</label>
          <select name="subCategories" id="subCategories" class="custom-select">
            <option value="">دسته بندی سطح-۲</option>
            @foreach($subCategories as $subCategory)
              <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف دوره هستید؟"/>
@endsection


@section('scripts')
  @parent

  {{-- Course Table --}}
  {!! $courseTable->scripts() !!}

  <script>
    $(document).ready(function () {
      
      // Actions(DataTable,Form,Url)
      let dt = window.LaravelDataTables['courseTable'];
      let action = new requestHandler(dt,'#courseForm','course');

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
          url: "{{ url('course/edit') }}",
          data: {id: id},
          success: function(data) {
            console.log(data.statuses.status);
            $('#id').val(id);
            $('#button_action').val('update');
            $('#action').val('ویرایش');
            $('#name').val(data.name);
            $('#price').val(data.price);
            $('#status').val(data.statuses.status).trigger('change');
            $('#subCategories').val(data.subCategory_id).trigger('change');
            $('#categories').val(data.category_id).trigger('change');
          }
        })
      }

      // Ajax/ Categories based on Sub Categories
      $('#categories').on('change', function (e) {
        console.log(e);
        var c_id = e.target.value;
        $.get('/subCategory?category_id=' + c_id, function (data) {
          $('#subCategories').empty();
          $("#subCategories").append('<option value="">دسته بندی سطح-۲</option>');
          $.each(data, function (index, subCat) {
            $("#subCategories").append('<option value="' + subCat.id + '">' + subCat.name + '</option>');
          });
        });
      });


    });
  </script>
@endsection
