@component('mail::message')
# Introduction

The body of your message.

<div>
    Price: {{ $order->total_price }}
    Factor: {{ $order->factor }}
</div>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
