<div class="row">
    {{-- Title --}}
    <div class="col-md-12 mb-3">
        <x-input key="title" name="عنوان" />
    </div>
    {{-- Files --}}
    <div class="col-md-12 mb-3">
        <x-textarea key="url" name="لینک محتوا" rows="5" />
    </div>
    <div class="col-md-12">
        {{-- Course Select Box --}}
        @include('includes.form.course')
    </div>
</div>