@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3 right-text">
        {{-- Header --}}
        <h2 class="mt-4">لیست تنظیمات</h2>
        <ol class="breadcrumb mb-4 right-text">
            <li class="breadcrumb-item">صفحه تنظیمات</li>
        </ol>

        {{-- Success Or Error Output --}}
        <span id="form_output"></span>
        
        {{-- Form Submittion --}}
        <form id="homeSetting" class="background_table" enctype="multipart/form-data">
            @csrf
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
                <div class="col-md-4 mb-3">
                    <input value="{{ $setting_header }}" type="text" class="form-control" name="header"
                        class="custom-file-input" placeholder="تیتر">
                </div>
                <div class="col-md-4 mb-3">
                    <input value="{{ $setting_sub_header }}" type="text" class="form-control" name="sub_header"
                        class="custom-file-input" placeholder="تیتر وسط">
                </div>
                <div class="col-md-4 mb-3">
                    <input value="{{ $setting_header_button }}" type="text" class="form-control" name="header_button"
                        class="custom-file-input" placeholder="متن دکمه">
                </div>
            </div>
            <!-- About Us -->
            <div class="row">
                <div class="col-md-12">
                    <h5>درباره ما</h5>
                    <hr>
                    <label for="about_us_headerText">نوشته اول بخش درباره ما</label>
                    <textarea rows="2" type="text" class="form-control mb-2" name="about_us_headerText" class="custom-file-input"
                        placeholder="نوشته اول بخش درباره ما">{{ $setting_about_us_headerText }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="about_us_image">تصویر درباره ما</label>
                    <br>
                    <input type="file" name="about_us_image"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="about_us_imageSize">اندازه عکس بخش درباره ما</label>
                    <input value="{{ $setting_about_us_imageSize }}" Placeholder="اندازه عکس بخش درباره ما" name="about_us_imageSize" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="about_us_header">تیتر اول بخش درباره ما</label>
                    <input value="{{ $setting_about_us_header }}" Placeholder="تیتر اول بخش درباره ما" name="about_us_header" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="about_us_text">توضیح بخش اول درباره ما</label>
                    <textarea rows="2" type="text" class="form-control mb-3" name="about_us_text"
                        placeholder="توضیح بخش اول درباره ما">{{ $setting_about_us_text }}</textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="about_us_header2">تیتر دوم بخش درباره ما</label>
                    <input value="{{ $setting_about_us_header2 }}" Placeholder="تیتر دوم بخش درباره ما" name="about_us_header2" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="about_us_text2">توضیح دوم بخش درباره ما</label>
                    <textarea rows="2" type="text" class="form-control mb-3" name="about_us_text2"
                        placeholder="توضیح دوم بخش درباره ما">{{ $setting_about_us_text2 }}</textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="about_us_header3">تیتر سوم بخش درباره ما</label>
                    <input value="{{ $setting_about_us_header3 }}" Placeholder="تیتر سوم بخش درباره ما" name="about_us_header3" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="about_us_text3">توضیح سوم بخش درباره ما</label>
                    <textarea rows="2" type="text" class="form-control mb-3" name="about_us_text3"
                        placeholder="توضیح سوم بخش درباره ما">{{ $setting_about_us_text3 }}</textarea>
                </div>
            </div>
            <!-- Why Us? -->
            <div class="row">
                <div class="col-md-12">
                    <h5>چرا ما؟</h5>
                    <hr>
                    <label for="why_us_text">نوشته بخش چرا ما</label>
                    <textarea rows="2" type="text" class="form-control mb-2" name="why_us_text" class="custom-file-input"
                        placeholder="نوشته بخش چرا ما">{{ $setting_why_us_text }}</textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="why_us_image">عکس بخش چرا ما</label>
                    <br>
                    <input type="file" name="why_us_image"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="why_us_imageSize">اندازه عکس بخش چرا ما</label>
                    <input value="{{ $setting_why_us_imageSize }}" Placeholder="اندازه عکس بخش چرا ما" name="why_us_imageSize" class="form-control"/>
                </div>
            </div>
            <!-- Services -->
            <div class="row">
                <div class="col-md-12">
                    <h5>خدمات</h5>
                    <hr>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="service_header">تیتر اول بخش خدمات</label>
                    <input value="{{ $setting_service_header }}" Placeholder="تیتر اول بخش خدمات" name="service_header" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="service_text">توضیح اول بخش خدمات</label>
                    <textarea Placeholder="توضیح اول بخش خدمات" name="service_text" class="form-control">{{ $setting_service_text }}</textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="servie_header2">تیتر دوم بخش خدمات</label>
                    <input value="{{ $setting_service_header2 }}" Placeholder="تیتر دوم بخش خدمات" name="service_header2" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="service_text2">توضیح دوم بخش خدمات</label>
                    <textarea rows="2" type="text" class="form-control mb-3" name="service_text2"
                        placeholder="توضیح دوم بخش خدمات">{{ $setting_service_text2 }}</textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="service_header3">تیتر سوم بخش خدمات</label>
                    <input value="{{ $setting_service_header3 }}" Placeholder="تیتر سوم بخش خدمات" name="service_header3" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="service_text3">توضیح سوم بخش خدمات</label>
                    <textarea rows="2" type="text" class="form-control mb-3" name="service_text3"
                        placeholder="توضیح سوم بخش خدمات">{{ $setting_service_text3 }}</textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="service_header4">تیتر چهارم بخش درباره ما</label>
                    <input value="{{ $setting_service_header4 }}" Placeholder="تیتر چهارم بخش خدمات" name="service_header4" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="setvice_text4">توضیح چهارم بخش درباره ما</label>
                    <textarea rows="2" type="text" class="form-control mb-3" name="service_text4"
                        placeholder="توضیح چهارم بخش خدمات">{{ $setting_service_text4 }}</textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="setvice_header3">تیتر پنجم بخش خدمات</label>
                    <input value="{{ $setting_service_header5 }}" Placeholder="تیتر پنجم بخش خدمات" name="service_header5" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="service_text5">توضیح پنجم بخش خدمات</label>
                    <textarea rows="2" type="text" class="form-control mb-3" name="service_text5"
                        placeholder="توضیح پنجم بخش خدمات">{{ $setting_service_text5 }}</textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="service_header6">تیتر ششم بخش خدمات</label>
                    <input value="{{ $setting_service_header6 }}" Placeholder="تیتر ششم بخش خدمات" name="service_header6" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="service_text6">توضیح ششم بخش درباره ما</label>
                    <textarea rows="2" type="text" class="form-control mb-3" name="service_text6"
                        placeholder="توضیح ششم بخش درباره ما">{{ $setting_service_text6 }}</textarea>
                </div>
            </div>
            <!-- Contact Us -->
            <div class="row">
                <div class="col-md-12">
                    <h5>تماس با ما</h5>
                    <hr>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="address">آدرس</label>
                    <textarea Placeholder="آدرس" name="address" class="form-control">{{ $setting_address }}</textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email">ایمیل</label>
                    <input value="{{ $setting_email_footer }}" Placeholder="ایمیل" name="email" class="form-control"/>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="phone_number">تلفن همراه</label>
                    <input value="{{ $setting_phone_number }}" Placeholder="تلفن همراه" name="phone_number" class="form-control"/>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button class="btn btn-primary mb-3 mt-3" type="submit">تاييد</button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        // Insert Home Setting
        $('#homeSetting').on('submit', function(event) {
            event.preventDefault();
            var form_data = new FormData(this);
            form_data.append('file',form_data);
            $.ajax({
                url: "{{ route('setting.storeSetting') }}",
                method: "POST",
                data: form_data,
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {
                    $('#form_output').html(data.success);
                    $('#homeSetting')[0].reset();
                }
            })
        });
    </script>
@endsection
