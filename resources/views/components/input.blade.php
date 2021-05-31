<div class="{{ $class ?? null }}">
        {{-- Label--}}
        <label for="{{ $key }}">{{ $name }}:</label>
        {{-- Input --}}
        <input type="{{ $type ?? 'text' }}" name="{{ $key }}" id="{{ $key }}" 
                value="{{ $value ?? null }}" class="form-control" placeholder="{{ $name }}">
</div>