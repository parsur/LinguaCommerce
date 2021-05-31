@extends('layouts.admin')
@section('title','مدیریت دوره ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="دوره">
    <x-slot name="table">
      <x-table :table="$courseTable" />
    </x-slot>
  </x-header>

  {{-- Delete --}}
  <x-delete title="آیا مایل به حذف دوره هستید؟"/>

@endsection

@section('scripts')
  @parent
  {{-- Course Table --}}
  {!! $courseTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Actions(DataTable,Form,Url)
      let dt = window.LaravelDataTables['courseTable'];
      let action = new RequestHandler(dt,'','course');

      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
    });
  </script>
@endsection
