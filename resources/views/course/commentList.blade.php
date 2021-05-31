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
  <x-delete title="آیا مایل به حذف دیدگاه دوره هستید؟"/>
@endsection

@section('scripts')
  @parent
  {{-- Course table --}}
  {!! $courseCommentTable->scripts() !!}

  {{-- Course comment submission --}}
  <script src="{{ asset('js/commentSubmission.js') }}"></script>

  <script>
    $(document).ready(function () {
      // Actions(dataTable,form,url)
      let dt = window.LaravelDataTables['courseCommentTable'];
      let action = new RequestHandler(dt,'','courseComment');
      // Delete 
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
    });
  </script>
@endsection
