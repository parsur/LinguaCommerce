@extends('layouts.admin')
@section('title','لیست سفارشات')


@section('content')
    <x-page title="جزئیات سفارش" description="جزئیات سفارش کاربر به همراه محصولات مربوط" formId="">
        <x-slot name="content">
            {{-- User information --}}
            <div class="table-responsive mb-2">
                <table class="table table-light table-bordered text-center text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">نام کاربر</th>
                            <th scope="col">شماره تلفن</th>
                            <th scope="col">ایمیل</th>
                            <th scope="col">فاکتور خرید</th>
                            <th scope="col">هزینه کل</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->phone_number }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->order_factor }}</td>
                            <td>{{ $order->total_price }} تومان</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-page>

    {{-- If it were not empty --}}
    @if(count($carts))
        {{-- Course List --}}
        <div class="col-md-12">
            <h4>لیست دوره ها</h4>
            {{-- Cart --}}
            @foreach($carts as $cart)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            {{-- Image --}}
                            <img class="card-img-top mb-3" src="/images/{{ $cart->course->image[0]->image_url }}">
                            {{-- Name --}}
                            <h5 class="card-title">{{ $cart->course->name }}</h5>
                            {{-- Price --}}
                            <p class="card-text">{{ $cart->course->price }} تومان</p>
                            {{-- Status --}}
                            @if($cart->course->status == 0) <p class="card-text">موجود</p> @else <p class="card-text">ناموجود</p> @endif
                            {{-- Description --}}
                            {{-- {!! $cart->course->description->description !!} --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

