<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url('/favicon.ico') }}" sizes="16x16">
    <meta name="admin-path" content="{{ url('/admin') }}">
    <meta name="base-path" content="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') | KABEGO</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">

    <script src="{{ asset('assets/common/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/common/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
    
    <script type="text/javascript">
        const ADMINURL = $('meta[name="admin-path"]').attr('content');
        const BASEURL = $('meta[name="base-path"]').attr('content');
        const CSRFTOKEN = document.querySelector("meta[name=csrf-token]").content
        axios.defaults.headers.common['X-CSRF-Token'] = CSRFTOKEN;
    </script>

    <link rel="stylesheet" href="{{ asset('assets/common/css/bootstrap4-classes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/common/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/common/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/common/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/browser.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/plugins/sweetalert/sweetalert.css') }}">
    @yield('styles')

    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>

</head>

<body>
    <header class="sticky">
        <nav class="navbar navbar-default px-25 border-0 border-radius-0 bg-white shadow mb-0">
            <div class="container-fluid d-md-flex">
                <div class="navbar-header align-self-center">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand theme-green" href="{{ URL::to('/') }}">
                        <img style="width: 125px;padding: 10px;margin-left: 35px" src="{{ asset('assets/admin/images/CHAI-Logo.png') }}" >     
                    </a>
                </div>
                <div class="collapse navbar-collapse ml-auto" id="myNavbar">

                    <ul class="nav navbar-nav navbar-right" @if(!Auth::check()) style="visibility:hidden" @endif>
                        <li class="dropdown">
                            <a class="dropdown-toggle bold" data-toggle="dropdown" href="#">
                                @if(Auth::check())
                                    {{ ucwords(auth()->user()->first_name)." ".ucwords(auth()->user()->last_name) }} 
                                @endif
                                <span><img style="width: 15px" src="{{ asset('assets/admin/images/icons/down.png') }}"></span>
                            </a>
                            <ul class="dropdown-menu header-menu">
                                <li>
                                    <a href="{{ url('/logout') }}" class="pb-2"><span>
                                        <img src="{{ asset('assets/admin/images//icons/right_circle.svg') }}"></span>Log Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>