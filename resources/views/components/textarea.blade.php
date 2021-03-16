{{-- Textarea --}}
<label for="{{ $key }}">{{ $name }}</label>
<textarea name="{{ $key }}" id="{{ $key }}" rows="{{ $rows }}" class="form-control" 
    placeholder="{{ $name }}">{{ $value }}</textarea>