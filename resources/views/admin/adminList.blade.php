@extends('layouts.admin')
@section('title','پنل مدیریت ادمین ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="ادمین" buttonValue="افزودن ادمین">
    <x-slot name="table">
      {!! $adminTable->table(['class' => 'table table-striped table-bordered table-hover-responsive dt_responsive nowrap text-center']) !!}
    </x-slot>
  </x-header>


  {{-- Insert Modal --}}
  <x-admin.insert size="modal-l" formId="adminForm">
    <x-slot name="content">
      {{-- Name --}}
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="name">نام:</label>
          <input name="name" id="name" type="text" class="form-control" placeholder="نام">
        </div>
        {{-- Email --}}
        <div class="col-md-12 mb-3">
          <label for="email">ایمیل:</label>
          <input name="email" id="email" type="email" class="form-control" placeholder="ایمیل">
        </div>
        {{-- Passwords --}}
        <div class="col-md-12 mb-3">
          <label for="password">رمز جدید:</label>
          <input name="password" id="password" class="form-control" placeholder="رمز جدید">
        </div>
        <div class="col-md-12 mb-3">
          <label for="password2">تکرار رمز جدید:</label>
          <input name="password2" id="password2"  class="form-control" placeholder="تکرار رمز جدید">
        </div>
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا از حذف ادمین مطمئن هستید؟"/>

@endsection


@section('scripts')
  @parent

  {{-- Admin Table --}}
  {!! $adminTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Admin DataTable
      let dt = window.LaravelDataTables['adminTable'];

      // Actions
      let action = new requestHandler(dt,'#adminForm','admin');

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
        $('#form_output').html('');
        $('#formModal').modal('show');

        $.ajax({
          url: "{{ url('admin/edit') }}",
          method: "get",
          data: {id: id},
          success: function(data) {
            $('#id').val(id);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#password').val('رمز عبور جدید');
            $('#password2').val('رمز عبور جدید');
          }
        })
      }
    });
  </script>
@endsection
