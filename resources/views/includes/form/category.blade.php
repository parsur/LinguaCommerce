<div class="row">
    {{-- Name --}}
    <div class="col-md-12 mb-3">
      <x-input key="name" name="نام" />
    </div>
    {{-- Status --}}
    <div class="col-md-12">
      <label for="status">وضعیت:</label>
      <select id="status" name="status" class="custom-select">
        <option value="0">موجود</option>
        <option value="1">ناموجود</option>
      </select>
    </div>
</div>