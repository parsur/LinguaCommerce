<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/orderVerification.css') }}">
        <title>تایید سفارش</title>
    </head>

    <body>
        <main>
            {{-- Success --}}
            @if (isset($success))
                <x-orderVerification :message="$success" />
            {{-- Error --}}
            @elseif (isset($error))
                <x-orderVerification :message="$error" class="failiure" />
            @endif
        </main>
    </body>
</html>
