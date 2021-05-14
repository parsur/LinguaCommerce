@extends('layouts.admin')
@section('title','لیست تخفیفات')

@section('content')
    {{-- Header --}}
    <x-header pageName="تخفیف" buttonValue="کد تخفیف">
        <x-slot name="table">
        {!! $couponTable->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center'], false) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-insert size="modal-l" formId="couponForm">
        <x-slot name="content">
          {{-- Form --}}
          @include('includes.form.coupon')
        </x-slot>
    </x-insert>

    {{-- Delete --}}
    <x-delete title="آیا مایل به حذف کد تخفیف هستید؟"/>
@endsection

@section('scripts')
    @parent
    {{-- Category Scripts --}}
    {!! $couponTable->scripts() !!}
    
    <script>
        $(document).ready(function () {
          // Category Table and Action Object
          let dt = window.LaravelDataTables["couponTable"];
          let action = new RequestHandler(dt,'#couponForm','coupon');

          // create modal
          $('#create_record').click(function () {
            $('#courses').val('').trigger('change');
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
                url: "{{ url('coupon/edit') }}",
                method: "get",
                data: {id: $id},
                success: function(data) {
                    $('#id').val($id);
                    $('#button_action').val('update');
                    $('#action').val('ویرایش');
                    $('#name').val(data.name);
                    $('#status').val(data.statuses.status).trigger('change');
                } 
            })
          }
        });
    </script>
@endsection

