@extends('layouts.admin')
@section('title','مدیریت ادمین ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="کاربر" buttonValue="کاربر">
    <x-slot name="table">
      {!! $userTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-l" formId="userForm">
    <x-slot name="content">
        {{-- User form --}}
        @include('includes.form.user')
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا از حذف کاربر مطمئن هستید؟"/>

@endsection


@section('scripts')
  @parent

  {{-- User Table --}}
  {!! $userTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // User DataTable And Action Object
      let dt = window.LaravelDataTables['userTable'];
      let action = new requestHandler(dt,'#userForm','user');

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
          url: "{{ url('user/edit') }}",
          method: "get",
          data: {id: id},
          success: function(data) {
            $('#id').val(id);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#phone_number').val(data.phone_number);
            $('#password').val('رمز عبور جدید');
            $('#password2').val('رمز عبور جدید');
          }
        })
      }
    });
  </script>
@endsection
