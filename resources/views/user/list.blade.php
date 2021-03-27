@extends('layouts.admin')
@section('title','مدیریت ادمین ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="کاربر" buttonValue="کاربر">
    <x-slot name="table">
      {!! $userTable->table(['class' => 'table table-striped table-bordered w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-insert size="modal-l" formId="userForm">
    <x-slot name="content">
        {{-- User form --}}
        @include('includes.form.user')
    </x-slot>
  </x-insert>

  {{-- Delete Modal --}}
  <x-delete title="آیا از حذف کاربر مطمئن هستید؟"/>
@endsection


@section('scripts')
  @parent

  {{-- User Table --}}
  {!! $userTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // User DataTable And Action Object
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
