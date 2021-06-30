<div class="row">
    {{-- Status --}}
    <div class="col-md-12 mb-3">
        @include('includes.form.status')
    </div>

    {{-- Category --}}
    <div class="col-md-6 mb-3">
        <label for="categories">دسته بندی اول:</label>
        <select name="categories" id="categories" class="custom-select">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == optional($table)->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- Subcategories --}}
    <div class="col-md-6 mb-3">
        <label for="subcategories">دسته بندی سطح-۲:</label>
        <select id="subcategories" name="subcategories" class="custom-select">
            <option value="">دسته بندی سطح-۲</option>
            @foreach($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}" {{ $subcategory->id == optional($table)->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Description --}}
    <div class="col-md-12 fr-view mb-3">
        <x-textarea key="description" placeholder="توضیحات" />
    </div>
</div>

{{-- Buttons --}}
<div class="col-md-12 text-center mb-3">
    <input type="hidden" name="button_action" id="button_action" value="insert" />
    <input type="submit" name="action" id="action" value="تایید" class="btn btn-success" />
</div>
