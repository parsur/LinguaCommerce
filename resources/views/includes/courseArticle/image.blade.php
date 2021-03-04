 {{-- Image --}}
 <div class="col-md-6 mb-4">
    <h6 class="imageLabel">تصویر:</h6>
    <input type="file" id="images" name="images[]" multiple="multiple" accept="image/x-png,image/gif,image/jpeg,image/jpg"/>
    {{-- Hidden Image --}}
    <input type="hidden" id="hidden_image" name="hidden_image"/>
    {{-- Image to be shown --}}
    <img id="picture" class="image">
</div>