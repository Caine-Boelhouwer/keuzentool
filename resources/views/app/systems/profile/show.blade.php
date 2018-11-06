@extends('layouts.app')

@section('content')
  <div class="dark_bg"></div>

  <div class="page_content page_show">
    <div class="page_detail_head">
      <div class="grid-x grid-padding-x grid-margin-x">
        <div class="cell small-12">
          <a href="/system/users" class="back_link">Gebruikers</a>
        </div>
        <div class="cell small-12 medium-6 large-7">
          <h3 class="page_title">{{ Auth::user()->username }}</h3>
        </div>
        <div class="cell small-12 medium-6 large-5">
          <div class="action_bar">
            <a href="/systeem/profiel/bewerken" class="action_button fill"><i class="far fa-edit"></i> Bewerken</a>
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

    <div class="page_block">
      <div class="custom_form">

        <div class="grid-x grid-margin-x">
          <div class="cell small-12 medium-6">
            <h5>Informatie</h5>
          </div>
          {{-- Status--}}
          <div class="cell small-12 medium-6 text-right">
            <div class="status_container status_code_{{ Auth::user()->status }}">
              {{ Helper::setStatusText(Auth::user()->status) }}
            </div>
          </div>
        </div>

        <div class="grid-x grid-margin-x detail_row">
          {{-- Username--}}
          <div class="cell small-12 medium-4">
            <div class="grid-x">
              <div class="cell small-12 medium-6">
                <div class="label_field">Username:</div>
              </div>
              <div class="cell small-12 medium-6">
                <div class="field_data">{{ Auth::user()->username }}</div>
              </div>
            </div>
          </div>

          {{-- Email--}}
          <div class="cell small-12 medium-4">
            <div class="grid-x">
              <div class="cell small-12 medium-6">
                <div class="label_field">Email:</div>
              </div>
              <div class="cell small-12 medium-6">
                <div class="field_data">{{ Auth::user()->email }}</div>
              </div>
            </div>
          </div>

          {{-- Role--}}
          <div class="cell small-12 medium-4">
            <div class="grid-x">
              <div class="cell small-12 medium-6">
                <div class="label_field">Role:</div>
              </div>
              <div class="cell small-12 medium-6">
                <div class="field_data">{{ Auth::user()->role->name }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid-x grid-margin-x detail_row">
          {{-- Avatar --}}
          <div class="cell small-12 medium-6 xlarge-4 upload_button upload_avatar">
            <div class="avatar avatar_preview" style="background-image: url('/uploads/avatar/{{ Auth::user()->avatar }}');"></div>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection
