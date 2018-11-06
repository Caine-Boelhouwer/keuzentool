@extends('layouts.filter')

@section('content')
  <div class="grid-x results_container">
    <div class="cell small-12">
      <div class="grid-x search_data_container">
        <div class="cell small-12 medium-3 search_data_content">
          <h3>Resultaat</h3>
          <div class="search_text">Uw ingevoerde gegevens:</div>
          <a href="/" class="change_search_data">Aanpassen</a>
        </div>
        <div class="cell small-12 medium-9">
          <div class="grid-x grid-margin-x search_data_wrapper">
            <div class="cell small-12 medium-6 large-auto search_data ambient">
              <h3 class="data">{{ $ambient_temp }}&#8451;</h3>
              <div class="remark">Omgevingstemperatuur</div>
            </div>
            <div class="cell small-12 medium-6 large-auto search_data max_temp">
              <h3 class="data">{{ $max_temp }}&#8451;</h3>
              <div class="remark">Hoogste procestemperatuur</div>
            </div>
            <div class="cell small-12 medium-6 large-auto search_data min_temp">
              <h3 class="data">{{ $min_temp }}&#8451;</h3>
              <div class="remark">Laagste procestemperatuur</div>
            </div>
            <div class="cell small-12 medium-6 large-auto search_data location">
              <h3 class="data">{{ $location->name }}</h3>
              <div class="remark">Locatie</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="cell small-12">
      @if ($insulation)
        <div class="grid-x grid-margin-x result_data_container">
          <div class="cell small-12 medium-6 result_content_container">
            <h5>Richtlijn CINI</h5>
            <p>{{ $insulation->description }}</p>
            <div class="result_box">
              <div class="grid-x result_section result_divider">
                <div class="cell small-12 medium-8 result_label">
                  Type isolatie:
                </div>
                <div class="cell small-12 medium-4 result_content">
                  {{ $insulation->name }}
                </div>
              </div>
              <div class="grid-x result_section result_divider">
                <div class="cell small-12 medium-8 result_label">
                  Isolatie materiaal:
                </div>
                <div class="cell small-12 medium-4 result_content">
                  {{ $insulation->insulation_mat }}
                </div>
                <div class="cell small-12 medium-8 result_label">
                  Isolatie meteriaal specificatie:
                </div>
                <div class="cell small-12 medium-4 result_content">
                  {{ $insulation->insulation_spec }}
                </div>
              </div>
              <div class="grid-x result_section">
                <div class="cell small-12 medium-8 result_label">
                  Afwerkingmateriaal:
                </div>
                <div class="cell small-12 medium-4 result_content">
                  {{ $insulation->finish_mat }}
                </div>
                <div class="cell small-12 medium-8 result_label">
                  Afwerkingmateriaal specificatie:
                </div>
                <div class="cell small-12 medium-4 result_content">
                  {{ $insulation->finish_spec }}
                </div>
              </div>

              <div class="grid-x result_manual">
                <div class="cell small-12">
                  <h5>In handboek</h5>
                  <a href="https://www.cini.nl/nl/login/" target="_blank" class="manual_link">{{ $insulation->chapter }}</a>
                </div>
              </div>

              <div class="grid-x result_explanation">
                <div class="cell small-12">
                  <a class="explanation">Verdere toelichting</a>
                  <p>{{ $insulation->explanation }}</p>
                </div>
              </div>
            </div>

            <div class="grid-x grid-margin-x action_container">
              <div class="cell small-12 medium-6">
                <a href="https://www.cini.nl/nl/kenniscentrum/producten/">Bestel het handboek</a>
              </div>
              <div class="cell small-12 medium-6">
                <a data-toggle="contact_reveal">Contact opnemen</a>
              </div>
            </div>
          </div>

          <div class="cell small-12 medium-6 img_placeholder">
            <div class="img_container" style="background-image: url('/uploads/insulation/{{ $insulation->image }}');"></div>
          </div>
        </div>
      @else
        <div class="grid-x no_results_container">
          <div class="cell text-center">
            <h3>Geen isolatie gevonden...</h3>
            <a data-toggle="contact_reveal">Contact opnemen</a>
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
