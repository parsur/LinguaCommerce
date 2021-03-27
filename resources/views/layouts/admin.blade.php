<!DOCTYPE html>
<html lang="en">

<!-- Head -->
@section('head')
    <head>
        {{-- TinyMce --}}
        <script src="https://cdn.tiny.cloud/1/j7pd9et1cw5vwcu34uqsawojdofcldb4jwhtc13w4qwa7uh5/tinymce/5/tinymce.min.js" 
            referrerpolicy="origin"></script>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="پنل ادمین، کنترل ادمین"> 
        <meta name="keywords" content="ادمین، داشبورد، پنل">  
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        {{-- App --}}
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
@show

<body id="body" class="hold-transition sidebar-mini">
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
                            <x-urlAddress text="ادمین" fontAwesome="fas fa-user-plus" route="{{ url('admin/list') }}" />

                            {{-- User --}}
                            <x-urlAddress text="کاربر" fontAwesome="fa fa-user" route="{{ url('user/list') }}" />

                            {{-- Courses --}}
                            <x-urlAddressParent text="دوره" fontAwesome="fas fa-graduation-cap">
                                <x-slot name="content">
                                    {{-- List --}}
                                    <x-urlAddress text="دوره ها" fontAwesome="null" route="{{ url('course/list') }}" />
                                    {{-- New Course --}}
                                    <x-urlAddress text="افزودن دوره" fontAwesome="null" route="{{ url('course/new') }}" />
                                    {{-- Image List --}}
                                    <x-urlAddress text="تصاویر پوستر" fontAwesome="null" route="{{ url('courseImage/list') }}" />
                                    {{-- Video List --}}
                                    <x-urlAddress text="ویدئو های پوستر" fontAwesome="null" route="{{ url('courseVideo/list') }}" />
                                    {{-- Content List --}}
                                    <x-urlAddress text="محتوا" fontAwesome="null" route="{{ url('courseFile/list ') }}" /> 
                                    {{-- Comment List --}}
                                    <x-urlAddress text="نظرات" fontAwesome="null" route="{{ url('courseComment/list ') }}" /> 
                                </x-slot>
                            </x-urlAddressParent>

                            {{-- Articles --}}
                            <x-urlAddressParent text="مقاله" fontAwesome="fas fa-newspaper">
                                <x-slot name="content">
                                    {{-- List --}}
                                    <x-urlAddress text="مقالات" fontAwesome="null" route="{{ url('article/list') }}" />
                                    {{-- New Article --}}
                                    <x-urlAddress text="افزودن مقاله" fontAwesome="null" route="{{ url('article/new') }}" />
                                    {{-- Image List --}}
                                    <x-urlAddress text="تصاویر پوستر" fontAwesome="null" route="{{ url('articleImage/list ') }}" />
                                    {{-- Video List --}}
                                    <x-urlAddress text="ویدئو های پوستر" fontAwesome="null" route="{{ url('articleVideo/list ') }}" /> 
                                    {{-- Comment List --}}
                                    <x-urlAddress text="نظرات" fontAwesome="null" route="{{ url('articleComment/list ') }}" />        
                                </x-slot>
                            </x-urlAddressParent>
                            
                            {{-- Categories --}}
                            <x-urlAddressParent Text="دسته بندی ها" fontAwesome="fa fa-list">
                                <x-slot name="content">
                                    {{-- Categories --}}
                                    <x-urlAddress text="دسته بندی اول" fontAwesome="null" route="{{ url('category/list') }}" />
                                    {{-- Sub Categories --}}
                                    <x-urlAddress text="دسته بندی دوم" fontAwesome="null" route="{{ url('subCategory/list') }}" />
                                </x-slot>
                            </x-admin.urlAddressParent>

                            {{-- Why me --}}
                            <x-urlAddress text="مشاوره" fontAwesome="fas fa-handshake" route="{{ url('consultation/list') }}"/>

                            {{-- Why me --}}
                            <x-urlAddress text="چرا من" fontAwesome="fa fa-question" route="{{ url('whyMe/new') }}"/>

                            {{-- Orders --}}
                            <x-urlAddress text="سفارشات" fontAwesome="fab fa-first-order" route="{{ url('order/list') }}"/>

                            {{-- Settings --}}
                            <x-urlAddress text="تنظیمات صفحه اصلی" fontAwesome="fa fa-cog" route="{{ url('homeSetting/new') }}"/>
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
        <script src="{{ asset('js/RequestHandler.js') }}"></script>

        <script>
            // Ajax Setup
            $.ajaxSetup({ 
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                processing: true,
                dataType: "json"
            });
            // Select2
            $('select').select2({ width: '100%'});
        </script>
    @show
</body>
