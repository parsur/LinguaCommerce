<div class="row">
    {{-- courses --}}
    <div class="col-md-6 mb-3">
        @include('includes.form.courseSelectBox')
    </div>
    {{-- Image --}}
    <div class="col-md-6 mb-4">
        <h6 id="imageLabel">تصویر:</h6>
        <input type="file" id="image" name="image" />
        {{-- Hidden Image --}}
        <input type="hidden" id="hidden_image" name="hidden_image"/>
        {{-- Image to be shown --}}
        <img id="picture">
    </div>
</div>