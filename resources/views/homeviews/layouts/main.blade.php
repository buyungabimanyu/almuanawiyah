<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ App\Models\Setting::title() }} {{ ($title == 'Home') ? '' : '| ' . $title }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/' . App\Models\Setting::logo()) }}" type="image/x-icon">
    
		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css') }}/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css') }}/style.css"/>

  </head>
  <body>

    @include('homeviews.partials.navbar')

    @yield('container')

    @include('homeviews.partials.footbar')

      <!-- jQuery Plugins -->
      <script type="text/javascript" src="{{ asset('js') }}/jquery.min.js"></script>
      <script type="text/javascript" src="{{ asset('js') }}/bootstrap.min.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
      <script type="text/javascript" src="{{ asset('js') }}/google-map.js"></script>
      <script type="text/javascript" src="{{ asset('js') }}/main.js"></script>

  </body>
</html>
