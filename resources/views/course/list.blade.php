@extends('layouts.admin')
@section('title','مدیریت دوره ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="دوره" buttonValue="">
    <x-slot name="table">
      {!! $courseTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

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

      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
    });
  </script>
@endsection
