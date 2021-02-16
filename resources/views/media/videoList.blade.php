@extends('layouts.admin')
@section('title','لیست آپارات')

@section('content')
    {{-- Header --}}
    <x-header pageName="ویدئو" buttonValue="ویدئو">
        <x-slot name="table">
            {!! $videoTable->table(['class' => 'table table-bordered table-striped table-hover-responsive w-100 nowrap text-center'], false) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-lg" formId="videoForm">
        <x-slot name="content">
            <div class="row">
                {{-- Video --}}
                <div class="col-md-12 mb-3">
                  <label for="aparat_url">لینک ویدئو:</label>
                  <textarea rows="4" id="aparat_url" name="aparat_url" type="text" class="form-control" placeholder="لینک ویدئو آپارات"></textarea>
                </div>
            </div>
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
                    <label for="courses">انتخاب مقاله:</label>
                    <select id="articles" name="articles[]" class="custom-select" multiple>
                    @foreach($articles as $article)
                        <option value="{{ $article->id }}" multiple>{{ $article->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="آیا مایل به حذف ویدئو هستید؟" />

@endsection


@section('scripts')
    @parent
    {!! $videoTable->scripts() !!}

    <script>
        $(document).ready(function() {

            // Select2
            $('#courses').select2({ width:'100%'});
            $('#articles').select2({ width:'100%'});

            // Video DataTable And Action Object
            let dt = window.LaravelDataTables['videoTable'];
            let action = new requestHandler(dt,'#videoForm','video');

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
                    url: "{{ url('video/edit') }}",
                    method: "get",
                    data: {id: $url},
                    success: function(data) {
                        $('#id').val($url);
                        $('#action').val('ویرایش');
                        $('#button_action').val('update');
                        $('#aparat_url').val(data.video_url);
                        $('#courses').val(data.video_id).trigger('change');
                    }
                })
            }
        });
    </script>
@endsection