{{-- Input for insertion --}}
<label for="{{ $key }}">{{ $name }}:</label>
<input type="{{ $type ?? 'text' }}" name="{{ $key }}" id="{{ $key }}" value="{{ $value ?? null }}" class="form-control" placeholder="{{ $name }}">