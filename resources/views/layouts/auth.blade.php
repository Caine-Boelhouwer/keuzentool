<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="/favicon.png">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  {{-- <link href="{{ asset('css/style.min.css') }}" rel="stylesheet"> --}}
  <link href="/css/style.min.css" rel="stylesheet">
</head>

<body class="auth">

  <div class="grid-x grid-padding-x content_container">
    <div class="cell small-12 medium-6 large-4 side_content">
      <div class="img_container logo"></div>

      @yield('content')

    </div>

    <div class="cell small-12 medium-6 large-8 show-for-medium side_image">
      <div class="img_container"></div>

      {{-- <a href="https://www.indestad.nl/" class="go_to_link">Ga naar de Indestad website</a> --}}
    </div>
  </div>

</body>
</html>
