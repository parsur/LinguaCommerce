@extends('layouts.admin')
@section('title','مدیریت ادمین ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="کاربر" buttonValue="کاربر">
    <x-slot name="table">
      <x-table :table="$userTable" />
    </x-slot>
  </x-header>

  {{-- Insert --}}
  <x-insert size="modal-l" formId="userForm">
    <x-slot name="content">
      {{-- User form --}}
      <div class="row">
        {{-- Name --}}
        <x-input key="name" name="نام" 
            class="col-md-12 mb-2" />
        {{-- Email --}}
        <x-input key="email" name="ایمیل" 
            class="col-md-12 mb-3" />
        {{-- Phone number --}}
        <x-input key="phone_number" name="تلفن همراه" 
          class="col-md-12 mb-3" />
        {{-- Passwords --}}
        <div class="col-md-12 mb-3">
          <label for="password">رمز جدید:</label>
          <input type="password" name="password" id="password" class="form-control" 
                    placeholder="رمز جدید" autocomplete="new-password">
        </div>
        <div class="col-md-12">
          <label for="password-confirm">تکرار رمز جدید:</label>
          <input type="password" name="password-confirm" id="password-confirm" class="form-control" 
                    placeholder="تکرار رمز جدید" autocomplete="new-password">
        </div>
      </div>
    </x-slot>
  </x-insert>

  {{-- Delete --}}
  <x-delete title="آیا از حذف کاربر مطمئن هستید؟"/>
@endsection


@section('scripts')
  @parent

  {{-- User table --}}
  {!! $userTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // User dataTable And action object
      let dt = window.LaravelDataTables['userTable'];
      let action = new RequestHandler(dt,'#userForm','user');

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
          url: "{{ url('user/edit') }}",
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
