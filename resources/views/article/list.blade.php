@extends('layouts.admin')
@section('title','مدیریت مقالات')

@section('content')
  {{-- Header --}}
  <x-header pageName="مقالات" buttonValue="">
    <x-slot name="table">
      {!! $articleTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-l" formId="courseForm">
    <x-slot name="content">
      {{-- Title --}}
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="title">تیتر:</label>
          <input name="title" id="title" type="text" placeholder="نام">
        </div>
      </div>
      {{-- Categories --}}
      <div class="row">
        <div class="col-md-6 mb-3"> 
          <label for="categories">دسته بندی سطح-۱</label>
          <select name="categories" id="categories" class="custom-select">
            <option value="">دسته بندی سطح-۱</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        {{-- Sub Categories --}}
        <div class="col-md-6 mb-3"> 
          <label for="categories">دسته بندی سطح-۲</label>
          <select name="categories" id="subCategories" class="custom-select">
            <option value="">دسته بندی سطح-۲</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      {{-- Status --}}
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="status">وضعیت:</label>
          <select id="status" name="status" class="custom-select">
            <option value="0">فعال</option>
            <option value="1">غیرفعال</option>
          </select>
        </div>
      </div>
      
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف مقاله هستید؟"/>
@endsection


@section('scripts')
  @parent

  {{-- Article Table --}}
  {!! $articleTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Article DataTable
      let dt = window.LaravelDataTables['articleTable'];
      // Actions(DataTable,Form,Url)
      let action = new requestHandler(dt,'#articleForm','article');
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
          url: "{{ url('article/edit') }}",
          data: {id: id},
          success: function(data) {
            $('#id').val(id);
            $('#button_action').val('update');
            $('#action').val('ویرایش');
            $('#title').val(data.title);
            if(data.status == 0) 
              $('#status').val(0).trigger('change');
            else if(data.status == 1) 
              $('#status').val(1).trigger('change');
          }
        })
      }
    });
  </script>
@endsection
