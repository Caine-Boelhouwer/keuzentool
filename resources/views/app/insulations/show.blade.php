@extends('layouts.app')

@section('content')
  <div class="dark_bg"></div>

  <div class="page_content page_show">
    <div class="page_detail_head">
      <div class="grid-x grid-padding-x grid-margin-x">
        @include('layouts.pages.detail.head', [
          'id' => $insulation->id,
          'title' => $insulation->name,
          'breadcrumb' => $breadcrumbs,
          'save' => false,
          'edit' => true,
          'archive' => true,
          'delete' => false,
          'cancel' => false,
          'page' => 'isolatie'
        ])
      </div>
    </div>

    <div class="page_block">
      <div class="custom_form">

        <div class="grid-x grid-margin-x">
          <div class="cell small-12 medium-6">
            <h5>Eigenschappen</h5>
          </div>
          {{-- Status--}}
          <div class="cell small-12 medium-6 text-right">
            <div class="status_container status_code_{{ $insulation->status }}">
              {{ Helper::setStatusText($insulation->status) }}
            </div>
          </div>
        </div>

        <div class="grid-x grid-margin-x detail_row">
          {{-- Max. temp. --}}
          <div class="cell small-12 medium-auto">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Max. temperatuur:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $insulation->max_temp or '-' }} &#8451;</div>
              </div>
            </div>
          </div>

          {{-- Min. temp. --}}
          <div class="cell small-12 medium-auto">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Min. temperatuur:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $insulation->min_temp or '-' }} &#8451;</div>
              </div>
            </div>
          </div>

          {{-- Location --}}
          <div class="cell small-12 medium-auto">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Locatie:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $insulation->location or '-' }}</div>
              </div>
            </div>
          </div>
        </div>

        <h5>Specificaties</h5>
        <div class="grid-x grid-margin-x detail_row">
          {{-- Insulation mat. --}}
          <div class="cell small-12 medium-3">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Isolatie materiaal:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $insulation->insulation_mat or '-' }}</div>
              </div>
            </div>
          </div>

          {{-- Insulation spec. --}}
          <div class="cell small-12 medium-3">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Isolatie meteriaal specificatie:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $insulation->insulation_spec or '-' }}</div>
              </div>
            </div>
          </div>

          {{-- Finish spec. --}}
          <div class="cell small-12 medium-3">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Afwerkingmateriaal:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $insulation->finish_mat or '-' }}</div>
              </div>
            </div>
          </div>

          {{-- Finish spec. --}}
          <div class="cell small-12 medium-3">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Afwerkingmateriaal:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $insulation->finish_spec or '-' }}</div>
              </div>
            </div>
          </div>
        </div>

        <h5>Content</h5>
        <div class="grid-x grid-margin-x detail_row">
          {{-- Chapter --}}
          <div class="cell small-12 medium-6">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">PDF hoofdstuk:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ $insulation->chapter }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid-x grid-margin-x detail_row">
          {{-- Description --}}
          <div class="cell small-12 medium-6">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Omschrijving:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ isset($insulation->description) ? htmlspecialchars_decode($insulation->description) : '-'}}</div>
              </div>
            </div>
          </div>

          {{-- Explanation --}}
          <div class="cell small-12 medium-6">
            <div class="grid-x">
              <div class="cell small-12 medium-12">
                <div class="label_field">Extra toelichting:</div>
              </div>
              <div class="cell small-12 medium-12">
                <div class="field_data">{{ isset($insulation->explanation) ? htmlspecialchars_decode($insulation->explanation) : '-'}}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid-x grid-margin-x detail_row">
          {{-- Image --}}
          <div class="cell small-12 medium-6 xlarge-6 upload_button upload_insulation">
            <div class="insulation_image insulation_image_preview" style="background-image: url('/uploads/insulation/{{ $insulation->image }}');"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
