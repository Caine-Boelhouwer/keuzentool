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
  <link href="/css/fontawesome-all.min.css" rel="stylesheet">
  <link href="/css/datatables.fontawesome.css" rel="stylesheet">
  <link href="/css/style.min.css" rel="stylesheet">
</head>

<body class="app">

  {{-- Reveal --}}
  <div class="reveal fast custom_reveal" id="confirm_reveal" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">
    <div class="heading">
      <h4 id="reveal_title">:title:</h4>
      <div class="close_button" data-close aria-label="Close modal"><i class="far fa-times-circle"></i></div>
    </div>
    <p id="reveal_content">:content:</p>
    <div class="button_group">
      <a class="action_button fill reveal_cancel" data-close>Cancel</a>
      <a id="reveal_confirm" class="action_button fill white" href="#">Accept</a>
    </div>
  </div>

  {{-- Content --}}
  <div class="container">
    <div class="wrapper">
      <div class="side_menu">
        <div class="grid-x side_menu_row">
          <div class="cell small-4">
            <div class="primary_menu">
              <div class="head">
                <div class="img_container logo"></div>
              </div>
              <div class="menu_items">
                <a href="/isolatie" class="menu_item {{ stripos('/'.Request::path(), 'isolatie') ? 'active' : '' }}">
                  <i class="fas fa-blanket"></i>
                  <div class="name">Isolatie</div>
                </a>
                <a href="/berichten" class="menu_item {{ stripos('/'.Request::path(), 'berichten') ? 'active' : '' }}">
                  <i class="fas fa-envelope"></i>
                  <div class="name">Berichten</div>
                </a>
              </div>
              <div class="footer">
                <a href="/systeem/gebruikers/" class="menu_item {{ stripos('/'.Request::path(), 'systeem') ? 'active' : '' }}">
                  <i class="fas fa-cogs"></i>
                  <div class="name">Systeem</div>
                </a>
                <a href="/systeem/profiel" class="profile_item">
                  <div class="name">{{ Auth::user()->username }}</div>
                  <div class="avatar" style="background-image: url('/uploads/avatar/{{ Auth::user()->avatar }}');"></div>
                </a>
              </div>
            </div>
          </div>
          <div class="cell small-8">
            <div class="secondary_menu">
              <ul class="{{ stripos('/'.Request::path(), 'isolatie') ? 'active' : '' }}">
                <li class="item_section">Isolatie</li>
                <li><a href="/isolatie/" class="">Overzicht</a></li>
                <li><a href="/isolatie/archief" class="">Archive</a></li>
              </ul>

              <ul class="{{ stripos('/'.Request::path(), 'systeem') ? 'active' : '' }}">
                <li class="item_section">Gebruikers</li>
                <li><a href="/systeem/gebruikers" class="">Overzicht</a></li>
                <li><a href="/systeem/gebruikers/archief" class="">Archive</a></li>
              </ul>

              <ul class="{{ stripos('/'.Request::path(), 'berichten') ? 'active' : '' }}">
                <li class="item_section">Berichten</li>
                <li><a href="/berichten" class="">Overzicht</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="main_content">
        {{-- Toast --}}
        @if (session('toast_status'))
          <div id="session_toast" class="callout toast fast {{ session('toast_style') }}" data-closable="fade-out">
            <i class="far fa-bell"></i>
            <h6>{!! session('toast_content') !!}</h6>
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
              <i class="far fa-times-circle"></i>
            </button>
          </div>
        @endif

        {{-- Ajax Toast --}}
        <div id="ajax_toast" class="callout toast fast" data-closable="fade-out">
          <h6></h6>
          <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <i class="far fa-times-circle"></i>
          </button>
        </div>

        {{-- Loader --}}
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>

        @yield('content')
      </div>
    </div>

    <a class="button" id="toggle_side_menu">Menu</a>
  </div>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="/js/foundation.min.js"></script>
  <script src="/js/moment.min.js"></script>
  <script src="/js/datatables.min.js"></script>
  <script src="/js/datetime-moment.js"></script>
  <script src="/js/datatables.checkboxes.min.js"></script>
  <script src="/js/app.min.js"></script>
</body>
</html>
