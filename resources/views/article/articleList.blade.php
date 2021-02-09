@extends('layouts.admin')
@section('title','مدیریت مقالات')

@section('content')
  {{-- Header --}}
  <x-header pageName="مقاله" buttonValue="افزودن مقاله">
    <x-slot name="table">
      {!! $courseTable->table(['class' => 'table table-striped table-bordered table-hover-responsive dt_responsive nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-l" formId="courseForm">
    <x-slot name="content">
      {{-- Name --}}
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="name">نام:</label>
          <input name="name" id="name" type="text" class="form-control" placeholder="نام">
        </div>
        {{--  --}}
        <div class="col-md-12 mb-3">
          <label for="price">هزینه:</label>
          <input name="price" id="price" type="text" class="form-control" placeholder="هزینه">
        </div>
        {{-- Status --}}
        <div class="col-md-12 mb-3">
          <label for="status">وضعیت:</label>
          <select id="status" name="status" class="browser-default custom-select">
            <option value="0">فعال</option>
            <option value="1">غیرفعال</option>
          </select>
        </div>
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا از حذف ادمین مطمئن هستید؟"/>
@endsection


@section('scripts')
  @parent

  {{-- Course Table --}}
  {!! $courseTable->scripts() !!}

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
