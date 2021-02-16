@extends('layouts.admin')
@section('title','لیست تصاویر')

@section('content')

  {{-- Header --}}
  <x-header pageName="عکس" buttonValue="عکس">  
    <x-slot name="table">
      {!! $imageTable->table(['class' => 'table table-bordered table-striped table-hover-responsive w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-lg" formId="imageForm">
    <x-slot name="content">
      <div class="row">
        {{-- Course --}}
        <div class="col-md-6 mb-3">
          <label for="courses">انتخاب دوره:</label>
          <select id="courses" name="courses[]" class="custom-select" multiple>
            @foreach($courses as $course)
              <option value="{{ $course->id }}" multiple>{{ $course->name }}</option>
            @endforeach
          </select>
        </div>
        {{-- Article --}}
        <div class="col-md-6 mb-3">
          <label for="articles">انتخاب مقاله:</label>
          <select id="articles" name="articles[]" class="custom-select" multiple>
            @foreach($articles as $article)
              <option value="{{ $article->id }}" multiple>{{ $article->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        {{-- Image --}}
        <div class="col-md-12">
          <label for="image">تصویر:</label>
          <br>
          <input type="file" id="image" name="image" />
          {{-- Image to be shown --}}
          <img id="picture">
          {{-- Hidden Image --}}
          <input type="hidden" id="hidden_image" name="hidden_image"/>
        </div>
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف تصویر هستید؟"/>

@endsection

@section('scripts')
  @parent
  {{-- Image DataTable --}}
  {!! $imageTable->scripts() !!}

  <script>
    $(document).ready(function () {

      // Select2
      $('#courses').select2({ width:'100%'});
      $('#articles').select2({ width:'100%'});

      // Video DataTable And Action Object
      let dt = window.LaravelDataTables['imageTable'];
      let action = new requestHandler(dt,'#imageForm','image');

      // Record modal
      $('#create_record').click(function () {
        action.modal();
      });

      // Insert
      action.insert();

      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
      // Edit
      window.showEditModal = function showEditModal(url) {
        edit(url);
      }
      function edit($url) {
        $('#form_output').html('');
        $('#formModal').modal('show');

        $.ajax({
          url: "{{ url('image/edit') }}",
          method: "get",
          data: {id: $url},
          dataType: "json",
          success: function(data) {
            console.log(data.image_url);
            $('#id').val($url);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
            $('#hidden_image').val(data.image_url);
            $('#courses').val(data.image_id).trigger('change');
            $('#articles').val(data.image_id).trigger('change');
          }
        })
      }
    });

    // Get media after selecting the picture
    document.getElementById("image").onchange = function () {
      var reader = new FileReader();

      reader.onload = function (e) {
        setImageTarget(e);
      };
      // read the image file as a data URL.
      reader.readAsDataURL(this.files[0]);
    };

    // Set image target
    function setImageTarget(image) {
      // get loaded data and render thumbnail.
      var img = document.getElementById("picture");
      img.src = image.target.result;
      img.classList.add("image");
      // Image input style
      document.getElementById("image").style.marginBottom = "20px";
      // Hidden input
      document.getElementById("hidden_image").value = image.target.result;
    }
  </script>
@endsection
