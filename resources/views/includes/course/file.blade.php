<div class="row">
    {{-- Title --}}
    <div class="col-md-12 mb-2">
        <label for="title">عنوان:</label>
        <input type="text" name="title" id="title" placeholder="عنوان" />
    </div>
    {{-- Files --}}
    <div class="col-md-12 mb-2">
        <label for="url">محتوا:</label>
        <textarea name="url" id="url" class="form-control" rows="5" placeholder="لینک محتوا"></textarea>
    </div>
    {{-- Course Select Box --}}
    @include('includes.form.course')
</div>