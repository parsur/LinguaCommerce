@extends('layouts.admin')
@section('title','مدیریت مقالات')

@section('content')
  {{-- Header --}}
  <x-header pageName="مقالات">
    <x-slot name="table">
      <x-table :table="$articleTable" />
    </x-slot>
  </x-header>

  {{-- Delete --}}
  <x-delete title="آیا مایل به حذف مقاله هستید؟"/>
@endsection


@section('scripts')
  @parent
  {{-- Article Table --}}
  {!! $articleTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Article DataTable
      let dt = window.LaravelDataTables['articleTable'];
      // Actions(DataTable,Form,Url)
      let action = new RequestHandler(dt,'#articleForm','article');

      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
    });
  </script>
@endsection
