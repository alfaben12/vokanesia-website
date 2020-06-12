<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ setting('site.title') }} | @hasSection('title') @yield('title')  @else  {{ setting('site.description') }} @endif</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
  @include('layouts.style')
  {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}
  @yield('style')
  <script>
  window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
  </script>
</head>
<body>

  @include('layouts._nav')

  @yield('body')
  @include('layouts._footer')

  <div class="overlay"></div>
  @yield('modal')
  @include('layouts.script')
  {{-- <script type="text/javascript" src="{{ mix('js/app.js') }}"></script> --}}
  @yield('plugin')
  @yield('script')

</body>
</html>
