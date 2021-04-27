@extends('layouts.admin')
@section('title','لیست سفارشات')


@section('content')
    {{-- Order details --}}
    <x-page title="جزئیات سفارش" description="جزئیات سفارش کاربر به همراه دوره های مربوط">
        <x-slot name="content">
            {{-- User information --}}
            <div class="table-responsive">
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
                            <td>{{ $order->factor }}</td>
                            <td>{{ $order->total_price }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-page>


    {{-- If it were not empty --}}
    @if(count($orderCourses))
        {{-- Cart --}}
        <div class="row mr-0 ml-0">
            @foreach($orderCourses as $order)
                <div class="col-md-3 mt-3"> 
                    <div class="card">
                        <div class="card-body">
                            {{-- Image --}}
                            @foreach($order->course->media->where('type', 0) as $media)
                                <img class="card-img-top mb-3" src="/images/{{ $media->url }}"> 
                            @endforeach 
                            {{-- Name --}}
                            <h5 class="card-title">{{ $order->course->name }}</h5>
                            {{-- Price --}}
                            <p class="card-text">{{ $order->course->price }} تومان</p>
                            {{-- Files --}}
                            @foreach($order->course->files as $file) 
                                <a href="{{ $file->url }}">{{ $file->title }}</a> <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

