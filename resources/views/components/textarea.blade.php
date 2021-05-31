<div class="{{ $class ?? null }}">
    {{-- Label --}}
    <label for="{{ $key }}">{{ $placeholder }}:</label>
    {{-- Textarea --}}
    <textarea name="{{ $key }}" id="{{ $key }}" rows="{{ $rows ?? 3 }}" class="form-control" 
        placeholder="{{ $placeholder }}">{{ optional($value) }}</textarea>
</div>