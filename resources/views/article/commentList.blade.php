@extends('layouts.admin')
@section('title','مدیریت دیدگاه مقاله')

@section('content')
  {{-- Header --}}
  <x-header pageName="دیدگاه مقاله">
    <x-slot name="table">
      <x-table :table="$articleCommentTable" />
    </x-slot>
  </x-header>

  {{-- Form --}}
  @include('includes.courseArticle.commentSubmission')

  {{-- Delete --}}
  <x-delete title="آیا مایل به حذف دیدگاه درباره مقاله هستید؟"/>
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
      let action = new RequestHandler(dt,'','articleComment');
      
      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
    });
  </script>
@endsection
