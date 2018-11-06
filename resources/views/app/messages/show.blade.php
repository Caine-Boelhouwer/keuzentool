@extends('layouts.app')

@section('content')
  <div class="dark_bg"></div>

  <div class="page_content page_show">
    <div class="page_detail_head">
      <div class="grid-x grid-padding-x grid-margin-x">
        @include('layouts.pages.detail.head', [
          'id' => $message->id,
          'title' => $message->name,
          'breadcrumb' => $breadcrumbs,
          'save' => false,
          'edit' => false,
          'archive' => false,
          'delete' => true,
          'cancel' => false,
          'page' => 'berichten'
        ])
      </div>
    </div>

    <div class="page_block">
      <div class="custom_form">

        <h5>Contactgegevens</h5>
        <div class="grid-x grid-margin-x detail_row">
          {{-- Name --}}
          <div class="cell small-12 medium-auto">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Naam:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $message->name or '-' }}</div>
              </div>
            </div>
          </div>

          {{-- Email --}}
          <div class="cell small-12 medium-auto">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">E-mail:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $message->email or '-' }}</div>
              </div>
            </div>
          </div>

          {{-- Email --}}
          <div class="cell small-12 medium-auto">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Telefoonnummer:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $message->phone or '-' }}</div>
              </div>
            </div>
          </div>
        </div>

        <h5>Bericht</h5>
        <div class="grid-x grid-margin-x detail_row">
          {{-- Message --}}
          <div class="cell small-12 medium-12">
            <div class="field_data">{{ isset($message->message) ? htmlspecialchars_decode($message->message) : '-'}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
