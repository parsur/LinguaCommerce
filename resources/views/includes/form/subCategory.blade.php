{{-- Form --}}
@include('includes.form.category')
{{-- Category --}}
<div class="row">
  <div class="col-md-12 mb-2">
    <label for="categories">در دسته بندی اول:</label>
    <select class="custom-select" id="categories" name="categories">
      @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>
  </div>
</div>