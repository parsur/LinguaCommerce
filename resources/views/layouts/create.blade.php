@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-3 right-text">
        {{-- Header --}}
        <h2 class="mt-4">ذخیره  {{ $title }}</h2>
        <ol class="breadcrumb mb-4 right-text">
            <li class="breadcrumb-item">{{ $title }} خود را اضافه یا ویرایش کنید</li>
        </ol>

        {{-- Success Or Error Output --}}
        <span id="form_output"></span>
        
        {{-- Form Submittion --}}
        <form id="{{ $formId }}" class="background_table" enctype="multipart/form-data">
            @csrf

            {{-- Hidden Inputs --}}
            <input type="hidden" name="id" id="id" value="{{ $table }}" />
            <input type="hidden" name="button_action" id="button_action" value="insert" />

            {{-- Form --}}
            @yield('form')

            <div class="row">
                {{-- Status --}}
                <div class="col-md-6 mb-3">
                    <label for="status">وضعیت:</label>
                    <select id="status" name="status" class="custom-select">
                        <option value="0">فعال</option>
                        <option value="1">غیرفعال</option>
                    </select>
                </div>
                {{-- Media Url --}}
                <div class="col-md-6 mb-3">
                    <label for="media_url">انتخاب عکس ها:</label>
                    <br>
                    <input type="file" id="media_url" name="media_url[]" multiple />
                    {{-- Image --}}
                    <input type="hidden" id="image_hidden" name="image_hidden" />
                    <img id="image" name="image" />
                </div>
            </div>
            <div class="row">
                {{-- Aparat Url --}}
                <div class="col-md-12 mb-3">
                    <label for="aparat_url">لینک ویدئو آپارات:</label>
                    <textarea rows="4" id="aparat_url" name="aparat_url" type="url" class="form-control" placeholder="لینک ویدئو آپارات"></textarea>
                </div>
            </div>
            <div class="row">
                {{-- Category --}}
                <div class="col-md-6 mb-3">
                    <label for="categories">دسته بندی سطح-۱</label>
                    <select name="categories" id="categories" class="custom-select">
                        <option value="">دسته بندی سطح-۱</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- Sub Category --}}
                <div class="col-md-6">
                    <label for="subCategories">دسته بندی سطح-۲</label>
                    <select name="subCategories" id="subCategories" class="custom-select">
                        <option value="">دسته بندی سطح-۲</option>
                        @foreach($subCategories as $subCategory)
                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- Description --}}
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="description">توضیح:</label>
                    <textarea id="description" name="description" rows="5" class="form-control"></textarea>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="col-md-12 mb-3" align="center">
                <input type="submit" name="submit" id="action" value="تایید" class="btn btn-primary" />
                <button type="button" class="btn btn-danger" data-dismiss="modal">خروج</button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
@parent
    <script src="{{ asset('js/tinymce.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('js/tinymceInit.js') }}" referrerpolicy="origin"></script>
@endsection


