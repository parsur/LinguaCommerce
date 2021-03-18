<div class="container-fluid mt-3 right-text">
    {{-- List --}}
    <h2 class="mt-4">لیست {{ $pageName }}</h2>
    <ol class="breadcrumb mb-4 right-text">
        <li class="breadcrumb-item">صفحه {{ $pageName }}</li>
    </ol>

    {{-- Button --}}
    @if($buttonValue != '')
        <button type="button" name="create_record" id="create_record"
            class="btn btn-success btn-sm text-right">افزودن {{ $buttonValue }}</button>
        <hr>
    @endif
    
    {{-- Responsive Table --}}
    <div class="table-responsive">
        {{ $table }}
    </div>
</div>
