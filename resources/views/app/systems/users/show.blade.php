@extends('layouts.app')

@section('content')
  <div class="dark_bg"></div>

  <div class="page_content page_show">
    <div class="page_detail_head">
      <div class="grid-x grid-padding-x grid-margin-x">
        @include('layouts.pages.detail.head', [
          'id' => $user->id,
          'title' => $user->username,
          'breadcrumb' => $breadcrumbs,
          'save' => false,
          'edit' => true,
          'archive' => true,
          'delete' => false,
          'cancel' => false,
          'page' => 'systeem/gebruikers'
        ])
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
            <div class="status_container status_code_{{ $user->status }}">
              {{ Helper::setStatusText($user->status) }}
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
                <div class="field_data">{{ $user->username }}</div>
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
                <div class="field_data">{{ $user->email or '-' }}</div>
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
                <div class="field_data">{{ $user->role->name }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid-x grid-margin-x detail_row">
          {{-- Avatar --}}
          <div class="cell small-12 medium-6 xlarge-4 upload_button upload_avatar">
            <div class="avatar avatar_preview" style="background-image: url('/uploads/avatar/{{ $user->avatar }}');"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
