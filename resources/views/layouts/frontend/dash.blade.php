<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- w3school font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @stack('css')
</head>
<body style="background-color:#f3f3f3;">
  <!-- start app section -->
    <div id="app">
      <!-- start top header -->
        @include('layouts.frontend.topHeader')
      <!-- end top header -->

      <!-- start navbar -->
        @include('layouts.frontend.navbar')
      <!-- end navbar -->

      <!-- start welcome section -->
        @include('layouts.frontend.welcome')
      <!-- end welcome section -->

      <!-- start search bar -->
        @include('layouts.frontend.search')
      <!-- end search bar -->

      <!-- start main content -->
          <div class="container mt-4" style="background-color: #f3f3f3;">
            <div class="row">
              <!-- start left sight ----------------------------------------------->
              <div class="col-lg-9 col-md-9">
                <main class="py-4">
                  @yield('content')
                </main>
              </div>
              <!-- end left sight -------------------------------------------------->

              <!-- start right site -->
                @include('layouts.frontend.rightSight')
              <!-- end right sight -->
          </div>
        </div>
      <!-- end main content -->

      <!-- start footer section -->
        @include('layouts.frontend.footer')
      <!-- end footer section -->
  </div>
<!-- end app section -->

@stack('jscript')


</body>
</html>
