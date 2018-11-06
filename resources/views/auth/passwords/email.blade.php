@extends('layouts.auth')

@section('content')

<div class="content_card">
  <h3>Wachtwoord vergeten</h3>

  <p>
    Vul het e-mailadres in die gekoppeld is aan je account.
  </p>

  {!! Form::open(['url' => route('password.email'), 'class' => '']) !!}

    {{ csrf_field() }}

    <div class="grid-x grid-margin-x">
      {{-- Username --}}
      <div class="cell small-12 @if ($errors->has('email')) has-error @endif">
        {!! Form::label('inputEmail', 'E-mail') !!}
        {!! Form::text('inputEmail', old('email'), ['name' => 'email', 'class' => 'validate', 'placeholder' => 'voorbeeld@indestad.nl', 'required' => 'required']) !!}
      </div>

      {{-- Button --}}
      <div class="cell small-12">
        {!! Form::button('Verzenden', ['class' => 'button', 'type' => 'submit']) !!}
      </div>
    </div>
  {!! Form::close() !!}
</div>

@endsection
