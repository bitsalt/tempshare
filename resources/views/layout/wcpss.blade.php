<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" type="assets/image/png" sizes="16x16" href="{{asset('images/wakeicon.ico')}}">
    <title>{{ config('app.name', '') }}</title>
    <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/wcpss.css') }}" rel="stylesheet">

</head>
<body>
<div id="main-wrapper">
    <header>
        <nav class="navbar">
            <!-- Logo -->
            <div id="gb-logo" class="gb header left"><img src="{{asset('images/blue.png')}}" /></div>
            <!-- End Logo -->
        </nav>
    </header>
    <div id="wcpss-header">
        <div id="wcpss-title">
            <!--div id="sp-section-name"-->
            WCPSS Employee Health Screening
        </div>
        @if(isset($viewbag))
            <div class="pagetitle-info">
                <div class="user-info">{{ $viewbag['name'] }}</div>
                <div class="user-info">{{ date('l F jS Y') }}</div>
            </div>
        @endif
    </div>

    <div id="content">
        @yield('content')
    </div>

</div>
<footer class="footer">
    <div class="container">
        <span class="text-muted">© 2020 Wake County School System</span>
    </div>
</footer>


    <!-- Scripts -->
    <script>
        window.rootUrl = '{{url('')}}'; //establish a base url to use in javascript ajax calls
        var base_url = window.rootUrl;
        //var csrftoken = '{{-- csrf_token() --}}';
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}" defer></script>
    <script src="{{ asset('js/typeahead.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/wcpss.js') }}" defer></script>



</body>
</html>
