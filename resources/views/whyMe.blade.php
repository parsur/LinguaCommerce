@extends('layouts.admin')
@section('title', ' چرا من')

@section('content')
    <x-page title="چرا من" description="توضیحات مربوط به دستاورد ها، و ..." formId="whyMeForm">
        <x-slot name="content">
            {{-- Home setting form --}}
            <x-textarea key="description" placeholder="چرا من" value="{!! $whyMe->value !!}" />
            {{-- Submission --}}
            <div class="col-md-12 mt-3 text-center">
                <button class="btn btn-success" type="submit">تاييد</button>
            </div>
        </x-slot>
    </x-page>
@endsection

@section('scripts')
@parent
    {{-- ckeditor initialization --}}
    <script src="{{ asset('js/ckeditor/ckeditorInit.js') }}"></script>

    <script>
        let action = new RequestHandler(null, '#whyMeForm', 'whyMe');
        // Insert
        action.insert();
    </script>
@endsection
