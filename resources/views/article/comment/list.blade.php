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
  <x-delete title="دیدگاه مقاله"/>
@endsection

@section('scripts')
  @parent
  {{-- Article table --}}
  {!! $articleCommentTable->scripts() !!}
  {{-- Article comment submission --}}
  <script src="{{ asset('js/commentSubmission.js') }}"></script>

  <script>
    
    let comment = new commentSubmission();

    $(document).ready(function () {
      // Submission
      window.showSubmissionModal = function showSubmissionModal(id) {
        // Opening modal
        comment.modal(id);
        // comment confirmation
        comment.submit('article');
      }

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
