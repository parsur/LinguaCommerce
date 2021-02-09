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
                <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            {{-- Admin --}}
                            <x-admin.urlAddress text="ادمین" fontAwesome="fa fa-users" route="{{ url('admin/list') }}" />

                            {{-- Courses --}}
                            <li class="nav-item has-treeview menu-open">
                                {{-- This menu has sub menus --}}
                                <x-admin.urlAddressParent text="دوره" fontAwesome="fas fa-graduation-cap" />

                                <ul class="nav nav-treeview">
                                    {{-- Courses --}}
                                    <x-admin.urlAddress text="لیست دوره ها" fontAwesome="null" route="{{ url('course/list') }}" />
                                    {{-- Description --}}
                                    <x-admin.urlAddress text="افزودن توضیح دوره" fontAwesome="null" route="{{ url('course/newDescription') }}" />
                                </ul>
                            </li>
                            {{-- Articles --}}
                            <li class="nav-item has-treeview menu-open">
                                {{-- This menu has sub menus --}}
                                <x-admin.urlAddressParent text="مقاله" fontAwesome="fa fa-newspaper-o" />

                                <ul class="nav nav-treeview">
                                    {{-- Articles --}}
                                    <x-admin.urlAddress text="لیست مقالات" fontAwesome="null" route="{{ url('article/list') }}" />
                                    {{-- Description --}}
                                    <x-admin.urlAddress text="افزودن توضیح دوره" fontAwesome="null" route="{{ url('article/newDescription') }}" />
                                </ul>
                            </li>
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
                    تمامی کپی رایت این وبسایت متعلق به سارا رجبی خواهد بود.
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
        {{-- Ajax Setup --}}
        <script>
            // Ajax Setup
            $.ajaxSetup({
                processing: true,
                dataType: "json"
            });
        </script>

    @show
</body>
