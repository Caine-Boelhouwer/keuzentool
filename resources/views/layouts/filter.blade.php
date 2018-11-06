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
  <link href="/css/style.min.css" rel="stylesheet">
</head>

<body class="filter">

  {{-- Reveal --}}
  <div class="reveal tiny fast custom_reveal @if (session('validation_contact_status')) active @endif" id="contact_reveal" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">
    <div class="heading grid-x">
      <div class="cell small-9">
        <div id="reveal_title">Contact opnemen</div>
      </div>
      <div class="cell small-3">
        <div class="close_button" data-close aria-label="Close modal">Sluiten</div>
      </div>
    </div>

    {!! Form::open(['url' => '/berichten/opslaan', 'class' => 'contact_form_container']) !!}
      <div class="grid-x">
        <div class="cell small-12 @if ($errors->has('contact_name')) has-error @endif">
          {!! Form::label('inputName', 'Naam *') !!}
          {!! Form::text('inputName', old('contact_name'), ['name' => 'contact_name', 'class' => '', 'placeholder' => 'Naam']) !!}
        </div>
      </div>

      <div class="grid-x">
        <div class="cell small-12 @if ($errors->has('contact_mail')) has-error @endif">
          {!! Form::label('inputMail', 'E-mail *') !!}
          {!! Form::text('inputMail', old('contact_mail'), ['name' => 'contact_mail', 'class' => '', 'placeholder' => 'E-mail']) !!}
        </div>
      </div>

      <div class="grid-x">
        <div class="cell small-12 @if ($errors->has('contact_mail')) has-error @endif">
          {!! Form::label('inputPhone', 'Telefoonnummer *') !!}
          {!! Form::text('inputPhone', old('contact_phone'), ['name' => 'contact_phone', 'class' => '', 'placeholder' => 'Telefoonnummer']) !!}
        </div>
      </div>

      <div class="grid-x">
        <div class="cell small-12 @if ($errors->has('contact_mail')) has-error @endif">
          {!! Form::label('inputMessage', 'Bericht *') !!}
          {!! Form::textarea('inputMessage', old('contact_message'), ['name' => 'contact_message', 'class' => '', 'placeholder' => 'Bericht', 'rows' => 4]) !!}
        </div>
      </div>

      <div class="grid-x">
        <div class="cell text-center">
          {!! Form::submit('Verstuur'); !!}
        </div>
      </div>
    {!! Form::close() !!}
  </div>

  {{-- Content --}}
  <div class="container">
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

    <div class="wrapper">

      <div class="header">
        <div class="grid-container">
          <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-6 large-2">
              <div class="logo_container">
                <div class="img_container logo"></div>
              </div>
            </div>
            <div class="cell small-12 medium-6 large-10">
              <div class="quick_link">
                <a href="https://www.cini.nl/">Terug naar cini.nl</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="grid-container">
        <div class="grid-x grid-padding-x">
          <div class="cell small-12">
            <div class="main_content">
              @yield('content')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="/js/foundation.min.js"></script>
  <script src="/js/moment.min.js"></script>
  <script src="/js/app.min.js"></script>
</body>
</html>
