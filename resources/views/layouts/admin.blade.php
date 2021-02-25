<!DOCTYPE html>
<html lang="en">

<!-- Head -->
@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="پنل ادمین، کنترل ادمین"> 
    <meta name="keywords" content="ادمین، داشبورد، پنل">  
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- App --}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
@show

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" rol="button" data-toggle="dropdown" aria-haspopup="true">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item text-danger" href="/logout">خروج</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary">
            <!-- Brand Logo -->
            <a href="/" class="brand-link text-center">
                <i class="fa fa-user"></i>
                @auth
                    <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
                @endauth
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            {{-- Admin --}}
                            <x-admin.urlAddress text="ادمین" fontAwesome="fas fa-user-plus" route="{{ url('admin/list') }}" />

                            {{-- User --}}
                            <x-admin.urlAddress text="کاربر" fontAwesome="fa fa-user" route="{{ url('user/list') }}" />

                            {{-- Courses --}}
                            <x-admin.urlAddressParent text="دوره" fontAwesome="fas fa-graduation-cap">
                                <x-slot name="content">
                                    {{-- Courses --}}
                                    <x-admin.urlAddress text="لیست دوره ها" fontAwesome="null" route="{{ url('course/list') }}" />
                                    {{-- New Course --}}
                                    <x-admin.urlAddress text="افزودن دوره" fontAwesome="null" route="{{ url('course/new') }}" />
                                    {{-- Image List --}}
                                    <x-admin.urlAddress text="لیست عکس ها" fontAwesome="null" route="{{ url('courseImage/list ') }}" />
                                    {{-- Video List --}}
                                    <x-admin.urlAddress text="لیست ویدئو ها" fontAwesome="null" route="{{ url('courseVideo/list ') }}" />
                                </x-slot>
                            </x-admin.urlAddressParent>

                            {{-- Articles --}}
                            <x-admin.urlAddressParent text="مقالات" fontAwesome="fas fa-newspaper">
                                <x-slot name="content">
                                    {{-- Articles --}}
                                    <x-admin.urlAddress text="لیست مقالات" fontAwesome="null" route="{{ url('article/list') }}" />
                                    {{-- New Article --}}
                                    <x-admin.urlAddress text="افزودن مقاله" fontAwesome="null" route="{{ url('article/new') }}" />
                                    {{-- Image List --}}
                                    <x-admin.urlAddress text="لیست عکس ها" fontAwesome="null" route="{{ url('articleImage/list ') }}" />
                                    {{-- Video List --}}
                                    <x-admin.urlAddress text="لیست ویدئو ها" fontAwesome="null" route="{{ url('articleVideo/list ') }}" />       
                                </x-slot>
                            </x-admin.urlAddressParent>


                            {{-- Categories --}}
                            <x-admin.urlAddressParent Text="دسته بندی ها" fontAwesome="fa fa-list">
                                <x-slot name="content">
                                    {{-- Categories --}}
                                    <x-admin.urlAddress text="دسته بندی اول" fontAwesome="null" route="{{ url('category/list') }}" />
                                    {{-- Sub Categories --}}
                                    <x-admin.urlAddress text="دسته بندی دوم" fontAwesome="null" route="{{ url('subCategory/list') }}" />
                                </x-slot>
                            </x-admin.urlAddressParent>

                            {{-- Settings --}}
                            <x-admin.urlAddressParent Text="تنظیمات" fontAwesome="fa fa-cog">
                                <x-slot name="content">
                                    {{-- Home --}}
                                    <x-admin.urlAddress text="صفحه خانه" fontAwesome="null" route="{{ url('category/list') }}" />
                                </x-slot>
                            </x-admin.urlAddressParent>

                            {{-- Orders --}}
                            <x-admin.urlAddress text="سفارشات" fontAwesome="fab fa-first-order" route="{{ url('order/list') }}"/>
                        </ul>
                    </nav>
                </div>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                @yield('content')
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <p>
                    تمامی حقوق این وبسایت متعلق به سارا رجبی خواهد بود.
                </p>
            </div>
        </footer>
    </div>

    <!-- SCRIPTS -->
    @section('scripts')
        {{-- App --}}
        <script src="{{ mix('js/app.js') }}"></script>
        {{-- Ajax Requests --}}
        <script src="{{ asset('js/requestHandler.js') }}"></script>
        {{-- Tinymce --}}
        <script src="{{ asset('js/tinymce.js') }}"></script>
        {{-- Ajax Setup --}}
        <script>
            $.ajaxSetup({
                processing: true,
                dataType: "json"
            });
        </script>

    @show
</body>
