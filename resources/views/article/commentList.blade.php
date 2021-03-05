@extends('layouts.admin')
@section('title','مدیریت نظرات مقاله')

@section('content')
  {{-- Header --}}
  <x-header pageName="نظرات مقاله" buttonValue="">
    <x-slot name="table">
      {!! $articleCommentTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Form --}}
  @include('includes.courseArticle.commentSubmission')

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف نظر درباره مقاله هستید؟"/>
@endsection

@section('scripts')
  @parent
  {{-- Article table --}}
  {!! $articleCommentTable->scripts() !!}
  {{-- Article comment submission --}}
  <script src="{{ asset('js/commentSubmission.js') }}"></script>

  <script>
    $(document).ready(function () {
      // Actions(DataTable,Form,Url)
      let dt = window.LaravelDataTables['articleCommentTable'];
      let action = new requestHandler(dt,'','articleComment');
      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
    });
  </script>
@endsection
