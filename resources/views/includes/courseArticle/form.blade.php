<div class="row">
    {{-- Status --}}
    <div class="col-md-12 mb-3">
        <label for="status">وضعیت:</label>
        <select id="status" name="status" class="custom-select">
            <option value="0">فعال</option>
            <option value="1">غیرفعال</option>
        </select>
    </div>
</div>

<div class="row">
    {{-- Category --}}
    <div class="col-md-6 mb-3">
        <label for="categories">دسته بندی اول:</label>
        <select name="categories" id="categories" class="custom-select">
            <option value="">دسته بندی اول</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == optional($table)->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- Sub Category --}}
    <div class="col-md-6 mb-3">
        <label for="subCategories">دسته بندی سطح-۲:</label>
        <select id="subCategories" name="subCategories" class="custom-select">
            <option value="">دسته بندی سطح-۲</option>
            @foreach($subCategories as $subCategory)
                <option value="{{ $subCategory->id }}" {{ $subCategory->id == optional($table)->subCategory_id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
            @endforeach
        </select>
    </div>
</div>

{{-- Description --}}
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="description">توضیح:</label>
        <textarea id="description" name="description" rows="6" class="form-control"></textarea>
    </div>
</div>

{{-- Buttons --}}
<div class="col-md-12 mb-3" align="center">
    <input type="hidden" name="button_action" id="button_action" value="insert" />
    <input type="submit" name="submit" id="action" value="تایید" class="btn btn-primary" />
</div>