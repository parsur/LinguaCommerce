@component('mail::message')
# Introduction

The body of your message.
Price: {{ $order->price }}
<br>
Factor: {{ $order->factor }}
<br>
Course names: 
@foreach($carts as $cart)
    {{ $cart->course->name }}
    <br>
    @foreach($cart->course->files as $file)
        @once Course files: @endonce
        {{ $file->title }}
    @endforeach
@endforeach

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
