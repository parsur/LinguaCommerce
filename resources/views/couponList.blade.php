@extends('layouts.admin')
@section('title','لیست تخفیف')

@section('content')
    {{-- Header --}}
    <x-header pageName="تخفیف" buttonValue="کد تخفیف">
      <x-slot name="table">
        {{-- Table --}}
        <x-table :table="$couponTable" />
      </x-slot>
    </x-header>

    {{-- Insert --}}
    <x-insert size="modal-l" formId="couponForm">
      <x-slot name="content">
        {{-- Form --}}
        <div class="row">
          {{-- Discount code --}}
          <x-input key="coupon_code" name="کد تخفیف" class="col-md-12 mb-3" />
          {{-- Type --}}
          <div class="col-md-12 mb-3">
            <label for="type">نوع:</label>
            <select id="type" name="type" class="custom-select">
              <option value="0">هزینه</option>
              <option value="1">درصد</option>
            </select>
          </div>
          {{-- Value --}}
          <x-input key="value" name="مقدار" class="col-md-12 mb-3" />
          {{-- Status --}}
          <div class="col-md-12 mb-3">
            @include('includes.form.status')
          </div>
          {{-- Course --}}
          <div class="col-md-12">
            @include('includes.form.course',['multiple' => 'multiple', 'name' => 'courses[]'])
          </div>
        </div>
      </x-slot>
    </x-insert>

    {{-- Delete --}}
    <x-delete title="آیا مایل به حذف کد تخفیف هستید؟"/>
@endsection

@section('scripts')
    @parent
    {{-- Category scripts --}}
    {!! $couponTable->scripts() !!}
    
    <script>
      $(document).ready(function () {
        // Category table and action object
        let dt = window.LaravelDataTables["couponTable"];
        let action = new RequestHandler(dt,'#couponForm','coupon');

        // create modal
        $('#create_record').click(function () {
          $('#courses').val('').trigger('change');
          action.openModal();
        });

        // Insert
        action.insert();

        // Delete
        window.showConfirmationModal = function showConfirmationModal(url) {
          action.delete(url);
        }
        
        // Edit
        window.showEditModal = function showEditModal(id) {
          edit(id);
        }
        function edit($id) {
          action.reloadModal();

          $.ajax({
            url: "{{ url('coupon/edit') }}",
            method: "get",
            data: {id: $id},
            success: function(data) {
              action.editOnSuccess($id);
              $('#coupon_code').val(data.code);
              $('#value').val(data.value);
              $('#percentage_off').val(data.percentge_off);
              $('select[name="courses[]"]').val(data.course_id).trigger('change');
            } 
          })
        }
      });
    </script>
@endsection

