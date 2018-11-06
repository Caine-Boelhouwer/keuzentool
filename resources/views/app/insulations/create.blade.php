@extends('layouts.app')

@section('content')
  <div class="dark_bg"></div>

  <div class="page_content">
    <div class="page_detail_head">
      <div class="grid-x grid-padding-x grid-margin-x">
        @include('layouts.pages.detail.head', [
          'id' => 0,
          'title' => 'Isolatie aanmaken',
          'breadcrumb' => $breadcrumbs,
          'save' => true,
          'edit' => false,
          'archive' => false,
          'delete' => false,
          'cancel' => true,
          'page' => 'isolatie'
        ])
      </div>
    </div>

    {!! Form::open(['url' => 'isolatie/opslaan', 'class' => 'custom_form_container', 'files' => true]) !!}
      <div class="page_block">
        <div class="custom_form">
          <h5>Algemeen</h5>
          <div class="grid-x grid-margin-x">
            {{-- Status --}}
            <div class="cell small-12 medium-6 xlarge-2 @if ($errors->has('status')) has-error @endif">
              {!! Form::label('inputStatus', 'Status') !!}
              <div class="custom_select_input">
                {!! Form::select(null, [1 => 'Active', 0 => 'Inactive'], old('status'), ['name' => 'status', 'id' => 'inputStatus', 'class' => '']) !!}
              </div>
            </div>

            {{-- Name --}}
            <div class="cell small-12 medium-6 xlarge-10 @if ($errors->has('name')) has-error @endif">
              {!! Form::label('inputName', 'Naam') !!}
              {!! Form::text('inputName', old('name'), ['name' => 'name', 'class' => '', 'placeholder' => 'Naam']) !!}
            </div>
          </div>

          <h5>Eigenschappen</h5>
          <div class="grid-x grid-margin-x">
            {{-- Max. temp. --}}
            <div class="cell small-12 medium-6 xlarge-2 @if ($errors->has('max_temp')) has-error @endif">
              {!! Form::label('inputMaxtemp', 'Max. temperatuur') !!}
              {!! Form::number('inputMaxtemp', old('max_temp'), ['name' => 'max_temp', 'class' => '', 'placeholder' => '00']) !!}
            </div>

            {{-- Min. temp. --}}
            <div class="cell small-12 medium-6 xlarge-2 @if ($errors->has('min_temp')) has-error @endif">
              {!! Form::label('inputMintemp', 'Min. temperatuur') !!}
              {!! Form::number('inputMintemp', old('min_temp'), ['name' => 'min_temp', 'class' => '', 'placeholder' => '00']) !!}
            </div>

            {{-- Location --}}
            <div class="cell small-12 medium-6 xlarge-8 @if ($errors->has('location')) has-error @endif">
              {!! Form::label('inputLocation', 'Locatie') !!}
              {!! Form::text('inputLocation', old('location'), ['name' => 'location', 'class' => '', 'placeholder' => 'Locatie']) !!}
            </div>
          </div>

          <h5>Specificaties</h5>
          <div class="grid-x grid-margin-x">
            {{-- Insulation mat. --}}
            <div class="cell small-12 medium-6 xlarge-3 @if ($errors->has('insulation_mat')) has-error @endif">
              {!! Form::label('inputInsulationMat', 'Isolatie materiaal') !!}
              {!! Form::text('inputInsulationMat', old('insulation_mat'), ['name' => 'insulation_mat', 'class' => '', 'placeholder' => 'Materiaal']) !!}
            </div>

            {{-- Insulation spec. --}}
            <div class="cell small-12 medium-6 xlarge-3 @if ($errors->has('insulation_spec')) has-error @endif">
              {!! Form::label('inputInsulationSpec', 'Isolatie meteriaal specificatie') !!}
              {!! Form::text('inputInsulationSpec', old('insulation_spec'), ['name' => 'insulation_spec', 'class' => '', 'placeholder' => 'Specificatie']) !!}
            </div>

            {{-- Finish spec. --}}
            <div class="cell small-12 medium-6 xlarge-3 @if ($errors->has('finish_mat')) has-error @endif">
              {!! Form::label('inputFinishMat', 'Afwerkingmateriaal') !!}
              {!! Form::text('inputFinishMat', old('finish_mat'), ['name' => 'finish_mat', 'class' => '', 'placeholder' => 'Materiaal']) !!}
            </div>

            {{-- Finish spec. --}}
            <div class="cell small-12 medium-6 xlarge-3 @if ($errors->has('finish_spec')) has-error @endif">
              {!! Form::label('inputFinishSpec', 'Afwerkingmateriaal specificatie') !!}
              {!! Form::text('inputFinishSpec', old('finish_spec'), ['name' => 'finish_spec', 'class' => '', 'placeholder' => 'Specificatie']) !!}
            </div>
          </div>

          <h5>Content</h5>
          <div class="grid-x grid-margin-x">
            {{-- Description --}}
            <div class="cell small-12 medium-6 @if ($errors->has('description')) has-error @endif">
              {!! Form::label('inputDescription', 'Omschrijving') !!}
              {!! Form::textarea('inputDescription', old('description'), ['name' => 'description', 'class' => '', 'placeholder' => 'Omschrijving', 'rows' => 7]) !!}
            </div>

            {{-- Explanation --}}
            <div class="cell small-12 medium-6 @if ($errors->has('explanation')) has-error @endif">
              {!! Form::label('inputExplanation', 'Extra toelichting') !!}
              {!! Form::textarea('inputExplanation', old('explanation'), ['name' => 'explanation', 'class' => '', 'placeholder' => 'Extra toelichting', 'rows' => 7]) !!}
            </div>
          </div>

          <div class="grid-x grid-margin-x">
            {{-- Image --}}
            <div class="cell small-12 medium-6 upload_button upload_insulation @if ($errors->has('image')) has-error @endif">
              <div class="insulation_image insulation_image_preview" style="background-image: url('/uploads/insulation/no_image.png');"></div>
              <label for="upload_file_insulation_image" class="custom_file_upload">Kies afbeelding <i class="far fa-upload"></i></label>
              {{ Form::file('image', ['name' => 'image', 'id' => 'upload_file_insulation_image', 'accept' => 'image/x-png,image/jpeg']) }}
            </div>

            {{-- Chapter --}}
            <div class="cell small-12 medium-6 @if ($errors->has('chapter')) has-error @endif">
              {!! Form::label('inputChapter', 'PDF hoofdstuk') !!}
              {!! Form::text('inputChapter', old('chapter'), ['name' => 'chapter', 'class' => '', 'placeholder' => 'Hoofdstuk']) !!}
            </div>
          </div>

        </div>
      </div>
    {{ Form::close() }}
  </div>

@endsection
