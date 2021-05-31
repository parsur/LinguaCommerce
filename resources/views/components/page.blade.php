<div class="container-fluid mt-3">
    {{-- Header --}}
    <h2 class="mt-4">{{ $title }}</h2>
    <ol class="breadcrumb mb-4 right-text">
        <li class="breadcrumb-item">{{ $description }}</li>
    </ol>

    {{-- Success or error output --}}
    <span id="form_output"></span>
    
    {{-- Form Submittion --}}
    <form id="{{ $formId ?? null }}" class="tableBackground" enctype="multipart/form-data">
        @csrf

        {{-- Content --}}
        {{ $content ?? null }}
    </form>
</div>

