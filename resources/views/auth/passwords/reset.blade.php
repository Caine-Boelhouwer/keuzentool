@extends('layouts.auth')

@section('content')

<div class="content_card">
  <h3>Reset wachtwoord</h3>
  <p>
    Vul je gebruikersnaam in dat gekoppeld is aan je account en vul het nieuwe wachtwoord in.
  </p>

  {!! Form::open(['url' => route('password.request'), 'class' => '']) !!}

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="grid-x grid-margin-x">
      {{-- E-mail --}}
      <div class="cell small-12 @if ($errors->has('email')) has-error @endif">
        {!! Form::label('inputEmail', 'E-mail') !!}
        {!! Form::email('inputEmail', isset($email) ? $email : old('email'), ['name' => 'email', 'class' => 'validate', 'placeholder' => 'voorbeeld@transcore.nl', 'required' => 'required']) !!}

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      {{-- Password --}}
      <div class="cell small-12 @if ($errors->has('password')) has-error @endif">
        {!! Form::label('inputPassword', 'Wachtwoord') !!}
        {!! Form::password('password', ['name' => 'password', 'id' => 'inputPassword', 'class' => 'validate', 'required' => 'required']) !!}

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      {{-- Confirm Password --}}
      <div class="cell small-12 @if ($errors->has('password_confirmation')) has-error @endif">
        {!! Form::label('inputConfirmPassword', 'Bevestig wachtwoord') !!}
        {!! Form::password('password', ['name' => 'password_confirmation', 'id' => 'inputConfirmPassword', 'class' => 'validate', 'required' => 'required']) !!}

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
      </div>

      {{-- Button --}}
      <div class="cell small-12">
        {!! Form::button('Herstel & Log in', ['class' => 'button', 'type' => 'submit']) !!}
      </div>
    </div>
  {!! Form::close() !!}
</div>

@endsection
