@extends('layouts.admin')
@section('افزودن توضیحات دوره')
@section('content')
    <div class="container-fluid mt-3 right-text">
        {{-- Header --}}
        <h2 class="mt-4">افزودن توضیحات</h2>
        <ol class="breadcrumb mb-4 right-text">
            <li class="breadcrumb-item">توضیح مربوط به دوره خود را بنویسید</li>
        </ol>

        {{-- Success Or Error Output --}}
        <span id="form_output"></span>
        
        {{-- Form Submittion --}}
        <form id="courseDescription" class="background_table" enctype="multipart/form-data">
            @csrf
            {{-- Course model for polymorphism relationship --}}
            <input type="hidden" id="model" name="model" value="App\Models\Course">

            <!-- Description -->
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="description">توضیح</label>
                    <textarea id="description" name="description" Placeholder="توضیح" rows="5" class="form-control"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="courses"></label>
                    <select class="browser-default custom-select" name="courses" id="courses">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button class="btn btn-primary mb-3 mt-3" type="submit">تاييد</button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            // Actions(DataTable,Form,Url)
            let action = new requestHandler('','#courseDescription','course/description');
            // Insert
            action.insert();
        });
    </script>
@endsection
