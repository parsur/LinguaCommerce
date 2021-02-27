@extends('layouts.admin')
@section('title','لیست سفارشات')


@section('content')
    <div class="container-fluid">
        {{-- Header --}}
        <h3 class="mt-4">جزئیات سفارش</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">مشاهده جزئیات سفارش</li>
        </ol>
        {{-- User information --}}
        <div class="table-responsive mb-2">
            <table class="table table-striped table-bordered text-center text-nowrap">
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
        {{-- Course List --}}
        <h4>لیست دوره ها</h4>
    </div>
    
    @foreach($carts as $cart)
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    @foreach($cart->course->image as $image)
                    <img class="card-img-top mb-3" src="/images/{{ $image->image_url }}">
                    @endforeach
                    <h5 class="card-title">{{ $cart->course->name }}</h5>
                    <p class="card-text">{{ $cart->course->price }} تومان</p>
                    @if($cart->course->status == 0) <p class="card-text">موجود</p> @else <p class="card-text">ناموجود</p> @endif
                </div>
            </div>
        </div>
    @endforeach
@endsection

