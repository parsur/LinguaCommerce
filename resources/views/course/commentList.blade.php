@extends('layouts.admin')
@section('title','مدیریت دیدگاه دوره')

@section('content')
  {{-- Header --}}
  <x-header pageName="دیدگاه دوره" buttonValue="">
    <x-slot name="table">
      {!! $courseCommentTable->table(['class' => 'table table-striped table-bordered w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Form --}}
  @include('includes.courseArticle.commentSubmission')

  {{-- Delete Modal --}}
  <x-delete title="آیا مایل به حذف دیدگاه دوره هستید؟"/>
@endsection

@section('scripts')
  @parent
  {{-- Course Table --}}
  {!! $courseCommentTable->scripts() !!}
  {{-- Course comment submission --}}
  <script src="{{ asset('js/commentSubmission.js') }}"></script>

  <script>
    $(document).ready(function () {
      // Actions(DataTable,Form,Url)
      let dt = window.LaravelDataTables['courseCommentTable'];
      let action = new requestHandler(dt,'','courseComment');
      // Delete 
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
    });
  </script>
@endsection
