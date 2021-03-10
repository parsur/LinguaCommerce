<div class="row">
    {{-- Name --}}
    <div class="col-md-6 mb-2">
      <label for="name">نام:</label>
      <input name="name" id="name" type="text" placeholder="نام">
    </div>
    {{-- Category --}}
    <div class="col-md-6 mb-2">
      <label for="categories">در دسته بندی اول:</label>
      <select class="custom-select" id="categories" name="categories">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    {{-- Status --}}
    <div class="col-md-12">
        <label for="status"></label>
        <select id="status" name="status" class="custom-select">
          <option value="0">موجود</option>
          <option value="1">ناموجود</option>
        </select>
    </div>
</div>