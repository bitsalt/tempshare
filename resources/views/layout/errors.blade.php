<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" type="assets/image/png" sizes="16x16" href="{{asset('images/wakeicon.ico')}}">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/wcpss.css') }}" rel="stylesheet">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
            margin-top: 10%;
        }

        .code {
            border-right: 2px solid;
            font-size: 26px;
            padding: 0 15px 0 15px;
            text-align: center;
        }

        .message {
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
<div id="main-wrapper">
    <header>
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <!-- Logo -->
            <div id="gb-logo" class="gb header left"><img src="{{asset('images/blue.png')}}" /></div>
            <!-- End Logo -->
        </nav>
    </header>
    <div id="wcpss-header">
        <!--div id="sp-section-name-outer" class="noprint"-->
        <div id="wcpss-title">
            <!--div id="sp-section-name"-->
            WCPSS Employee Health Screening
        </div>
    </div>
</div>

<div id="content">
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row mt-5">
            <div class="col-3">&nbsp;</div>
            <div class="col-6">
                <div class="flex-center">
                    @yield('info')
                </div>
            </div>
            <div class="col-3">&nbsp;</div>
        </div> <!-- End Page Content -->
    </div>
</div>


<footer class="footer">
    <div class="container">
        <span class="text-muted">© 2020 Wake County School System</span>
    </div>
</footer>


</body>
</html>
