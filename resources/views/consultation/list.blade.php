@extends('layouts.admin')
@section('title','لیست مشاوره')

@section('content')
  {{-- Header --}}
  <x-header pageName="مشاوره">
    <x-slot name="table">
      {!! $consultationTable->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center'], false) !!}
    </x-slot>
  </x-header>

  {{-- Delete --}}
  <x-delete title="آیا مایل به حذف این درخواست مشاوره هستید؟"/>
@endsection

@section('scripts')
  @parent

  <script src="{{ asset('js/tinymceInitReadOnly.js') }}"></script>

  {{-- Course Table --}}
  {!! $consultationTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Actions(DataTable,Form,Url)
      let dt = window.LaravelDataTables['consultationTable'];
      let action = new requestHandler(dt,'#consultationForm','consultation');

      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
    });
  </script>
@endsection
