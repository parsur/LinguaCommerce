{{-- Coupon --}}
<div class="row">
  {{-- Name --}}
  <div class="col-md-12 mb-3">
    <x-input key="coupon_code" name="کد تخفیف" />
  </div>
  {{-- Email --}}
  <div class="col-md-12 mb-3">
    <x-input key="value" name="مقدار قیمت" />
  </div>
  {{-- Phone number --}}
  <div class="col-md-12 mb-3">
    <x-input key="percentage_off" name="درصد تخفیف" />
  </div>
  {{-- Course --}}
  <div class="col-md-12">
    @include('includes.form.course',['multiple' => 'multiple', 'name' => 'courses[]'])
  </div>
</div>