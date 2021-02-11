@extends('layouts.admin')
@section('افزودن توضیحات دوره')
@section('content')
    
    <x-description title="دوره" model="Course">
        <x-slot name="content">
            <label for="courses">انتخاب دوره:</label>
            <select class="custom-select" name="courses[]" id="courses" multiple>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </x-slot>
    </x-description>

@endsection


@section('scripts')
    @parent
    <script>
        // Courses
        $('#courses').select2({width: '100%'});

        $(document).ready(function () {
            // Actions(DataTable,Form,Url)
            let action = new requestHandler('','#courseDescription','course/description');
            // Insert
            action.insert();
        });
    </script>
@endsection
