@extends('layouts.auth')

@section('content')

<div class="content_card">

  <h3>Login</h3>

  {!! Form::open(['url' => route('login'), 'class' => '']) !!}

    {{ csrf_field() }}

    <div class="grid-x grid-margin-x">

      @if (count($errors) > 0)
        <div class="cell small-12 has-error">
          <span>Deze inloggegevens zijn niet juist.</span>
        </div>
      @endif

      {{-- E-mail --}}
      <div class="cell small-12 @if ($errors->has('email')) has-error @endif">
        {!! Form::label('inputEmail', 'E-mail') !!}
        {!! Form::text('inputEmail', old('email'), ['name' => 'email', 'class' => 'validate', 'placeholder' => 'voorbeeld@indestad.nl']) !!}
      </div>

      {{-- Password --}}
      <div class="cell small-12 @if ($errors->has('password')) has-error @endif">
        {!! Form::label('inputPassword', 'Wachtwoord') !!}
        {!! Form::password('password', ['name' => 'password', 'class' => 'validate', 'placeholder' => '*********', 'autocomplete' => 'new-password']) !!}
      </div>

      {{-- Remember box --}}
      <div class="cell small-6">
        <input type="checkbox" id="remember-box" class="custom_checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
        <label for="remember-box" class="custom_checkbox_label">Onthoud mij</label>
      </div>

      {{-- Button --}}
      <div class="cell small-12">
        {!! Form::button('Log in', ['class' => 'button', 'type' => 'submit']) !!}
      </div>
    </div>
  {!! Form::close() !!}
</div>

@endsection
