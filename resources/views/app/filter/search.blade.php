@extends('layouts.filter')

@section('content')
  <div class="grid-x grid-margin-x search_container">
    <div class="cell small-12 medium-6 form_container">
      <h3>Cini Isolatiesysteem keuzetool</h3>
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.</p>

      {!! Form::open(['url' => '/zoeken', 'class' => 'filter_form_container']) !!}
        <div class="grid-x grid-margin-x">
          <div class="cell small-12 medium-8">
            {!! Form::label('inputAmbient', 'Omgevingstemperatuur') !!}
          </div>
          <div class="cell small-12 medium-4 @if ($errors->has('max_temp')) has-error @endif">
            {!! Form::text('inputAmbient', old('ambient_temp'), ['name' => 'ambient_temp', 'class' => '', 'placeholder' => '23']) !!}
          </div>
        </div>

        <div class="grid-x grid-margin-x">
          <div class="cell small-12 medium-8">
            {!! Form::label('inputMaxTemp', 'Hoogste procestemperatuur') !!}
          </div>
          <div class="cell small-12 medium-4 @if ($errors->has('max_temp')) has-error @endif">
            {!! Form::text('inputMaxTemp', old('max_temp'), ['name' => 'max_temp', 'class' => '', 'placeholder' => '120']) !!}
          </div>
        </div>

        <div class="grid-x grid-margin-x">
          <div class="cell small-12 medium-8">
            {!! Form::label('inputMinTemp', 'Laagste procestemperatuur') !!}
          </div>
          <div class="cell small-12 medium-4 @if ($errors->has('min_temp')) has-error @endif">
            {!! Form::text('inputMinTemp', old('min_temp'), ['name' => 'min_temp', 'class' => '', 'placeholder' => '120']) !!}
          </div>
        </div>

        <div class="grid-x grid-margin-x">
          <div class="cell small-12 @if ($errors->has('location')) has-error @endif">
            {!! Form::label('inputLocation', 'Locatie') !!}
            {!! Form::select(null, Helper::getLocations(), old('location'), ['name' => 'location', 'id' => 'inputLocation', 'class' => '']) !!}
          </div>
        </div>

        <div class="grid-x grid-margin-x">
          <div class="cell small-12">
            {!! Form::submit('Resultaat weergeven') !!}
          </div>
        </div>
      {!! Form::close() !!}
    </div>
    <div class="cell small-12 medium-6 img_placeholder">
      <div class="img_container"></div>
    </div>
  </div>
@endsection
