@extends('layouts.app')

@section('content')

  <div class="page_content">
    <div class="page_overview_head">
      <div class="grid-x grid-padding-x grid-margin-x">
        <div class="cell small-12">
          @include('layouts.pages.overview.title', [
            'title' => 'Isolatie archive',
          ])
        </div>
        <div class="cell small-12">
          @include('layouts.pages.overview.actionbar', [
            'archive' => false,
            'switch' => true,
            'searchbar' => true,
            'add' => false,
            'type' => 'isolatie',
            'page' => 'isolatie'
          ])
        </div>
      </div>
    </div>

    <div class="page_table_wrapper">
      <div class="grid-x grid-padding-x grid-margin-x">
        <div class="cell small-12">
          <table id="overview_table" class="hover stack">
            <thead>
              <tr>
                <th class="default-sort">Naam</th>
                <th>Max. temp.</th>
                <th>Min. temp.</th>
                <th>Locatie</th>
                @include('layouts.tables.head')
              </tr>
            </thead>
            <tbody>
              @foreach ($insulations as $insulation)
                <tr data-status="{{ $insulation->status }}">
                  <td>{{ $insulation->name or '-' }}</td>
                  <td>{{ $insulation->max_temp or '-' }} &#8451;</td>
                  <td>{{ $insulation->min_temp or '-' }} &#8451;</td>
                  <td>{{ $insulation->location or '-' }}</td>
                  @include('layouts.tables.option', [
                    'data_id' => $insulation->id,
                    'data_item' => $insulation->type,
                    'data_role_ranking' => 999,
                    'show' => false,
                    'edit' => false,
                    'archive' => false,
                    'delete' => true,
                    'restore' => true,
                    'page' => 'isolatie',
                  ])
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
