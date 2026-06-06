<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Manup Template">
  <meta name="keywords" content="Manup, unica, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SIRHCM2026 - @yield('title', 'HOME')</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&amp;display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="{{ Storage::url('css/bootstrap.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ Storage::url('css/font-awesome.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ Storage::url('css/elegant-icons.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ Storage::url('css/owl.carousel.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ Storage::url('css/magnific-popup.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ Storage::url('css/slicknav.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ Storage::url('css/style.css')}}" type="text/css">
  @vite('resources/js/app.js')
</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>
  @include('components.header')
  @yield('content')
  @include('components.footer')

  <script src="{{ Storage::url('js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{ Storage::url('js/bootstrap.min.js')}}"></script>
  <script src="{{ Storage::url('js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{ Storage::url('js/jquery.countdown.min.js')}}"></script>
  <script src="{{ Storage::url('js/jquery.slicknav.js')}}"></script>
  <script src="{{ Storage::url('js/owl.carousel.min.js')}}"></script>
  <script src="{{ Storage::url('js/main.js')}}"></script>
</body>

</html>
