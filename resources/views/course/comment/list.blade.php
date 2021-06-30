@extends('layouts.admin')
@section('title','مدیریت دیدگاه دوره')

@section('content')
  {{-- Header --}}
  <x-header pageName="دیدگاه دوره">
    <x-slot name="table">
      <x-table :table="$courseCommentTable" />
    </x-slot>
  </x-header>

  {{-- Form --}}
  @include('includes.courseArticle.commentSubmission')

  {{-- Delete --}}
  <x-delete title="دیدگاه دوره"/>
@endsection

@section('scripts')
  @parent

  {{-- Course Table --}}
  {!! $courseCommentTable->scripts() !!}
  {{-- Course comment submission --}}
  <script src="{{ asset('js/commentSubmission.js') }}"></script>

  <script>

    let commentSubmissiom = new commentSubmission();

    $(document).ready(function () {
      // Actions(DataTable,Form,Url)
      let dt = window.LaravelDataTables['courseCommentTable'];
      let action = new RequestHandler(dt,'','courseComment');

      // Delete 
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
      // Comment submission
      window.showSubmissionModal = function showSubmissionModal(id) {
        // Opening modal
        comment.modal(id);
        // Comment confirmation
        comment.submit('course');
      }
    });
  </script>
@endsection
