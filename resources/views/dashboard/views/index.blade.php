<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ App\Models\Setting::title() }} | {{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('storage/' . App\Models\Setting::logo()) }}" type="image/x-icon">
    
		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css') }}/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{ asset('css') }}/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css') }}/style.css"/>
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      
      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }
      
      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }
      
      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }
      
      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }
      
      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      
      </style>

<link rel="stylesheet" href="{{ URL::asset('/css/trix.css') }}">
<script type="text/javascript" src="{{ URL::asset('/js/trix.js') }}"></script>

<style>
  
  trix-toolbar [data-trix-button-group="file-tools"]{
    display: none;
  }
</style>
    
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('css') }}/dashboard.css">
    
    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('js') }}/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    @include('dashboard.layouts.header')
    
<div class="container-fluid">
  <div class="row">
    @if (auth()->check() && !auth()->user()->email_verified_at)
        <div class="alert alert-danger mb-n1 text-center text-danger" role="alert">
          Anda belum verifikasi email, 
          <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="text-danger btn btn-link p-0 m-0 align-baseline">{{ __(' Verifikasi ulang!') }}</button>.
        </form>
        </div>
        @if (session('resent'))
          <div class="container">
            <div class="row justify-content-end">
              <div class="col-md-6">
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
              </div>
            </div>
          </div>
        @endif
    @endif
    @include('dashboard.layouts.sidebar')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('container')
    </main>

      <!-- jQuery Plugins -->
      <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
      <script type="text/javascript" src="{{ asset('js') }}/jquery.min.js"></script>
      <script type="text/javascript" src="{{ asset('js') }}/bootstrap.min.js"></script>
      <script type="text/javascript" src="{{ asset('js') }}/main.js"></script>
      <script src="/js/dashboard.js"></script>

  </body>
</html>
