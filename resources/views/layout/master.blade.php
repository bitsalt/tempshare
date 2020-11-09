<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name', '') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- Styles -->
    <link href="{{ asset('assets/plugins/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/ti-icons/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- plugin css -->
    @stack('plugin-styles')
    @livewireStyles
    <!-- end plugin css -->

    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- end common css -->

    <!-- wcpss css -->
    <link href="{{ asset('css/wcpss.css') }}" rel="stylesheet">


</head>
<body class="sidebar-toggle-display sidebar-hidden" data-base-url="{{url('/')}}">

<div class="container-scroller" id="app">
    @include('layout.header')
    <div class="container-fluid page-body-wrapper">
        @include('partials.settings-panel')
        @include('partials.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('layout.footer')
        </div>
    </div>
</div>

<!-- base js -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}" defer></script>
<!-- end base js -->

<!-- plugin js -->
@stack('plugin-scripts')
@livewireScripts
<!-- end plugin js -->

<!-- common js -->
<script src="{{ asset('assets/js/off-canvas.js') }}" defer></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}" defer></script>
<!-- script src="{{ asset('assets/js/misc.js') }}" defer></script -->
<script src="{{ asset('assets/js/settings.js') }}" defer></script>
<script src="{{ asset('assets/js/todolist.js') }}" defer></script>
<!-- end common js -->

@stack('custom-scripts')
</body>
</html>
