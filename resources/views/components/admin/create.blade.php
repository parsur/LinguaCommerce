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

        {{-- Content --}}
        @if(isset($content))
            {{ $content }}
        @endif

        {{-- Buttons --}}
        <div class="col-md-12 mb-3" align="center">
            <input type="submit" name="submit" id="action" value="تایید" class="btn btn-primary" />
            <button type="button" class="btn btn-danger" data-dismiss="modal">خروج</button>
        </div>
    </form>
</div>

