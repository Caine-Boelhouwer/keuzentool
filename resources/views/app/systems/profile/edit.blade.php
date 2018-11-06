@extends('layouts.app')

@section('content')
  <div class="dark_bg"></div>

  <div class="page_content">
    <div class="page_detail_head">
      <div class="grid-x grid-padding-x grid-margin-x">
        <div class="cell small-12">
          <a href="/systeem/profiel" class="back_link">Terug</a>
        </div>
        <div class="cell small-12 medium-6 large-7">
          <h3 class="page_title">{{ Auth::user()->username }}</h3>
        </div>
        <div class="cell small-12 medium-6 large-5">
          <div class="action_bar">
            <a class="action_button fill success" id="save_form"><i class="fas fa-save"></i>Save</a>
            <a href="/systeem/profiel" class="action_button fill alert"><i class="fas fa-ban"></i>Cancel</a>
          </div>
        </div>
        <div class="cell small-12">
          @if (isset($breadcrumbs))
            <nav role="navigation">
              <ul class="breadcrumbs custom">
                @foreach ($breadcrumbs as $key => $value)
                  <li><a @if (!empty($value)) href="{{ $value }}" @endif class="breadcrumb">{{ $key }}</a></li>
                @endforeach
              </ul>
            </nav>
          @endif
        </div>
      </div>
    </div>

    {!! Form::open(['url' => 'system/profile/edit/', 'class' => 'custom_form_container', 'files' => true]) !!}
      <div class="page_block">
        <div class="custom_form">
          <h5>Informatie</h5>

          <div class="grid-x grid-margin-x">
            {{-- Status --}}
            <div class="cell small-12 medium-4 xlarge-4 @if ($errors->has('status')) has-error @endif">
              {!! Form::label('inputStatus', 'Status') !!}
              <div class="custom_select_input">
                {!! Form::select(null, [1 => 'Active', 0 => 'Inactive'], Auth::user()->status, ['name' => 'status', 'id' => 'inputStatus', 'class' => '']) !!}
              </div>
            </div>

            {{-- Role --}}
            <div class="cell small-12 medium-6 xlarge-4 @if ($errors->has('roles_id')) has-error @endif">
              {!! Form::label('inputRole', 'Role') !!}
              <div class="custom_select_input">
                {!! Form::select(null, $roles, Auth::user()->role->id, ['name' => 'roles_id', 'id' => 'inputRole', 'class' => '']) !!}
              </div>
            </div>
          </div>

          <div class="grid-x grid-margin-x">
            {{-- Username --}}
            <div class="cell small-12 medium-6 xlarge-4 @if ($errors->has('username')) has-error @endif">
              {!! Form::label('inputUsername', 'Username') !!}
              {!! Form::text('inputUsername', Auth::user()->username, ['name' => 'username', 'class' => '', 'placeholder' => 'Username']) !!}
            </div>

            {{-- Email --}}
            <div class="cell small-12 medium-6 xlarge-4 @if ($errors->has('email')) has-error @endif">
              {!! Form::label('inputEmail', 'Email') !!}
              {!! Form::email('inputEmail', Auth::user()->email, ['name' => 'email', 'class' => '', 'placeholder' => 'example@gmail.com']) !!}
            </div>

            {{-- Password --}}
            <div class="cell small-12 medium-6 xlarge-4 @if ($errors->has('password')) has-error @endif">
              {!! Form::label('inputPassword', 'Password (min. 6 characters)') !!}
              {!! Form::password('password', ['name' => 'password', 'id' => 'inputPassword', 'class' => '', 'autocomplete' => 'new-password']) !!}
            </div>
          </div>

          <div class="grid-x grid-margin-x">
            {{-- Avatar --}}
            <div class="cell small-12 medium-6 xlarge-4 upload_button upload_avatar @if ($errors->has('avatar')) has-error @endif">
              <div class="avatar avatar_preview" style="background-image: url('/uploads/avatar/{{ Auth::user()->avatar }}');"></div>
              <label for="upload_file_avatar" class="custom_file_upload">Choose avatar <i class="far fa-upload"></i></label>
              {{ Form::file('image', ['name' => 'avatar', 'id' => 'upload_file_avatar', 'accept' => 'image/x-png,image/jpeg']) }}
            </div>
          </div>
        </div>
      </div>
    {{ Form::close() }}
  </div>

@endsection
