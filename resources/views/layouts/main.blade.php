<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Page</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('login/css/style.css')}}" />

</head>

<body class="img js-fullheight" style="background-image: url({{asset('login/images/bg.jpg')}})">

    @yield('container')

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    {{-- <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}

    <!-- Core plugin JavaScript-->
    {{-- <script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script> --}}

    <script src="{{asset('login/js/popper.js')}}"></script>
    <script src="{{asset('login/js/main.js')}}"></script>
</body>
</html>
