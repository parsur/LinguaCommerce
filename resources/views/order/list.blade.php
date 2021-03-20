@extends('layouts.admin')
@section('title','لیست سفارشات')

@section('content')
  {{-- Header --}}
  <x-header pageName="سفارشات">
      <x-slot name="table">
          {!! $orderTable->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center'], false) !!}
      </x-slot>
  </x-header>

  {{-- Delete --}}
  <x-delete title="آیا مایل به حذف سفارش هستید؟"/>
@endsection

@section('scripts')
  @parent
  {{-- Course Table --}}
  {!! $orderTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Actions(DataTable,Form,Url)
      let dt = window.LaravelDataTables['orderTable'];
      let action = new RequestHandler(dt,'#orderForm','order');

      // Delete
      window.showConfirmationModal = function showConfirmationModal(id) {
        action.delete(id);
      }
    });
  </script>
@endsection
