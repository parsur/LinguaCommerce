<div class="row"> 
    {{-- Video List form --}}
    @include('includes.courseArticle.video')

    {{-- Categories --}}
    <div class="col-md-12">
        <label for="categories">دسته بندی اول:</label>
        <select name="categories" id="categories" class="custom-select">
            <option value="">دسته بندی اول</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
     
</div>