@extends('layouts.admin')
@section('افزودن توضیحات مقاله')

@section('content')
   <x-description title="" model="Article">
       <x-slot name="content">
            <label for="articles">انتخاب مقاله:</label>
            <select class="custom-select" name="articles[]" id="articles" multiple>
                @foreach($articles as $article)
                    <option value="{{ $article->id }}">{{ $article->name }}</option>
                @endforeach
            </select>
       </x-slot>
   </x-description>
@endsection

@section('scripts')
    @parent
    <script>
        // Articles
        $('#articles').select2({width: '100%'});

        $(document).ready(function () {
            // Actions(DataTable,Form,Url)
            let action = new requestHandler('','#courseDescription','course/description');
            // Insert
            action.insert();
        });
    </script>
@endsection
