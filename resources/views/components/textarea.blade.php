{{-- Textarea --}}
<label for="{{ $key }}">{{ $name }}:</label>
<textarea name="{{ $key }}" id="{{ $key }}" rows="{{ $rows ?? 3 }}" class="form-control" 
    placeholder="{{ $name }}">{{ $value ?? null }}</textarea>