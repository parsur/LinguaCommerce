<div class="container-fluid mt-3 right-text">
    {{-- Header --}}
    <h2 class="mt-4">{{ $title }}</h2>
    <ol class="breadcrumb mb-4 right-text">
        <li class="breadcrumb-item">{{ $description }}</li>
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
    </form>
</div>

