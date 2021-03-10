<!-- Header -->
<div class="row">
    <div class="col-md-12 mb-3">
        <h5>سر تیتر</h5>
        <hr/>
        <input type="file" name="header_image"/>
    </div>
    <div class="col-md-12">
        <img class="image_form mb-3" src="/images/{{ $setting_header_image }}" />
    </div>
</div>
<div class="row">
    {{-- Header --}}
    <div class="col-md-4 mb-2">
        <label for="header">تیتر</label>
        <input type="text" value="{{ $setting_header }}"  name="header" placeholder="تیتر">
    </div>
    {{-- Sub header --}}
    <div class="col-md-4 mb-2">
        <label for="sub_header">تیتر وسط</label>
        <input type="text" value="{{ $setting_sub_header }}" name="sub_header" placeholder="تیتر وسط">
    </div>
    {{-- Header button --}}
    <div class="col-md-4 mb-2">
        <label for="header_button">متن دکمه</label>
        <input type="text" value="{{ $setting_header_button }}" name="header_button" placeholder="متن دکمه">
    </div>
</div>