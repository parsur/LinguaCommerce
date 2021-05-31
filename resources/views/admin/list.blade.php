@extends('layouts.admin')
@section('title','پنل مدیریت ادمین ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="ادمین" buttonValue="ادمین">
    <x-slot name="table">
      <x-table :table="$adminTable" />
    </x-slot>
  </x-header>


  {{-- Insert --}}
  <x-insert size="modal-l" formId="adminForm">
    <x-slot name="content">
      {{-- Admin list --}}
      <div class="row">
        {{-- Name --}}
        <x-input size="12" key="name" name="نام" class="col-md-12 mb-3" />
        {{-- Email --}}
        <x-input size="12" key="email" name="ایمیل" class="col-md-12 mb-3" />
        {{-- Phone number --}}
        <x-input key="phone_number" name="تلفن همراه" class="col-md-12 mb-3" />
        {{-- Passwords --}}
        <div class="col-md-12 mb-3">
          <label for="password">رمز جدید:</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="رمز جدید" 
            autocomplete="new-password">
        </div>
        <div class="col-md-12">
          <label for="password-confirm">تکرار رمز جدید:</label>
          <input type="password" name="password-confirm" id="password-confirm" class="form-control" placeholder="تکرار رمز جدید" 
            autocomplete="new-password">
        </div>
      </div>
    </x-slot>
  </x-insert>

  {{-- Delete --}}
  <x-delete title="آیا از حذف ادمین مطمئن هستید؟"/>

@endsection


@section('scripts')
  @parent


  {{-- Admin Table --}}
  {!! $adminTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Admin DataTable And Action Object
      let dt = window.LaravelDataTables['adminTable'];
      let action = new RequestHandler(dt,'#adminForm','admin');

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
          url: "{{ url('admin/edit') }}",
          method: "get",
          data: {id: $id},
          success: function(data) {
            $('#id').val($id);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#phone_number').val(data.phone_number);
            $('#password').val('NewPassword');
            $('#password-confirm').val('NewPassword');
          }
        })
      }
    });
  </script>
@endsection
