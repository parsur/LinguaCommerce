<div class="container-fluid">
    {{-- List --}}
    <h2 class="mt-4">لیست {{ $pageName }}</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">صفحه {{ $pageName }}</li>
    </ol>

    {{-- Button --}}
    @if($buttonValue != null)
        <button type="button" id="create_record"
            class="btn btn-success btn-sm">افزودن {{ $buttonValue }}</button>
        <hr>
    @endif
    
    {{-- Responsive Table --}}
    <div class="table-responsive">
        {{ $table }}
    </div>
</div>
