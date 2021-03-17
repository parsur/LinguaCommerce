<div class="row">
  {{-- Name --}}
  <div class="col-md-12 mb-3">
    <x-input key="name" name="نام" />
  </div>
  {{-- Email --}}
  <div class="col-md-12 mb-3">
    <x-input key="email" name="ایمیل" />
  </div>
  {{-- Phone number --}}
  <div class="col-md-12 mb-3">
    <x-input key="phone_number" name="تلفن همراه" />
  </div>
  {{-- Passwords --}}
  <div class="col-md-12 mb-3">
    <label for="password">رمز جدید:</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="رمز جدید" autocomplete="new-password">
  </div>
  <div class="col-md-12">
    <label for="password-confirm">تکرار رمز جدید:</label>
    <input type="password" name="password-confirm" id="password-confirm" class="form-control" placeholder="تکرار رمز جدید" autocomplete="new-password">
  </div>
</div>