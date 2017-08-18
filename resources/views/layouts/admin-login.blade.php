<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">

    <title>债权管理系统</title>

    <link href="{{ asset('css/style.default.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body class="signin">

<!-- Preloader -->
<!-- <div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div> -->

<section>

    <div class="signinpanel">

        @yield('content')

        <div class="signup-footer">
            <div class="pull-left">
                &copy; {{ date('Y-m') }}. All Rights Reserved. Credit Manage
            </div>
            <div class="pull-right">
                Created By: <a href="#" target="_blank">Credit Manage Team</a>
            </div>
        </div>

    </div><!-- signin -->

</section>


<script src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/modernizr.min.js') }}"></script>
<script src="{{ asset('js/retina.min.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
