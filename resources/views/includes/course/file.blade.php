<div class="row">
    {{-- Title --}}
    <div class="col-md-12 mb-3">
        <label for="title">عنوان:</label>
        <input type="text" name="title" id="title" placeholder="عنوان" />
    </div>
    {{-- Files --}}
    <div class="col-md-12 mb-3">
        <label for="url">محتوا:</label>
        <textarea name="url" id="url" class="form-control" rows="5" placeholder="لینک محتوا"></textarea>
    </div>
    <div class="col-md-12">
        {{-- Course Select Box --}}
        @include('includes.form.course')
    </div>
</div>