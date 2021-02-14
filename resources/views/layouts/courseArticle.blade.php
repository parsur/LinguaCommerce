@extends('layouts.admin')

@section('content')
    <x-admin.create title="{{ $title }}" formId="{{ $formId }}">
        <x-slot name="content">
            {{-- Hidden Inputs --}}
            <input type="hidden" name="id" id="id" value="{{ $table }}" />
            <input type="hidden" name="button_action" id="button_action" value="insert" />
 
            {{-- Form --}}
            @yield('form')
 
            {{-- Include Form --}}
            @include('includes.courseArticleForm')
        </x-slot>
    </x-admin.create>
@endsection

@section('scripts')
@parent
    <script>
        // Display media data after editing
        function mediaDisplay(data) {
            for (var all in data) {
                if(data[all].type === 0) {
                    // Image
                    setImage(data[all].media_url);
                }
                else if(data[all].type === 1) {
                    $('#aparat_url').val(data[all].media_url);
                }
            }
        }

        // Set Image
        function setImage(image) {
            var img = document.getElementById("image");
            img.src = "/images/" + image;
            img.classList.add("courseImage");
            // Hidden image
            document.getElementById("image_hidden").value = image;
        }

        // Get media after selecting the picture
        document.getElementById("media_url").onchange = function () {
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
            var img = document.getElementById("image");
            img.src = image.target.result;
            img.classList.add("courseImage");
            // Hidden image
            document.getElementById("image_hidden").value = image.target.result;
        }
    </script>
@endsection


