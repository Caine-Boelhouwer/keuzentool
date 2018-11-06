@extends('layouts.app')

@section('content')

  <div class="page_content">
    <div class="page_overview_head">
      <div class="grid-x grid-padding-x grid-margin-x">
        <div class="cell small-12">
          @include('layouts.pages.overview.title', [
            'title' => 'Isolatie',
          ])
        </div>
        <div class="cell small-12">
          @include('layouts.pages.overview.actionbar', [
            'archive' => true,
            'switch' => true,
            'searchbar' => true,
            'add' => true,
            'type' => 'Isolatie',
            'page' => 'isolatie'
          ])
        </div>
      </div>
    </div>

    <div class="page_table_wrapper">
      <div class="grid-x grid-padding-x grid-margin-x">
        <div class="cell small-12">
          {!! Form::open(['url' => '/isolatie/archief/bulk', 'id' => 'table_form']) !!}
            <table id="overview_table" class="hover stack">
              <thead>
                <tr>
                  <th class="multi-select" width="2%"></th>
                  <th class="default-sort">Naam</th>
                  <th>Max. temp.</th>
                  <th>Min. temp.</th>
                  <th>Locatie</th>
                  <th>Status</th>
                  @include('layouts.tables.head')
                </tr>
              </thead>
              <tbody>
                @foreach ($insulations as $insulation)
                  <tr data-status="{{ $insulation->status }}">
                    <td>{{ $insulation->id }}</td>
                    <td><a href="/isolatie/{{ $insulation->id }}">{{ $insulation->name or '-' }}</a></td>
                    <td>{{ $insulation->max_temp or '-' }} &#8451;</td>
                    <td>{{ $insulation->min_temp or '-' }} &#8451;</td>
                    <td>{{ $insulation->location->name or '-' }}</td>
                    <td>{{ Helper::setStatusText($insulation->status) }}</td>
                    @include('layouts.tables.option', [
                      'data_id' => $insulation->id,
                      'data_item' => $insulation->name,
                      'data_role_ranking' => 9999,
                      'show' => true,
                      'edit' => true,
                      'archive' => true,
                      'delete' => false,
                      'restore' => false,
                      'page' => 'isolatie',
                    ])
                  </tr>
                @endforeach
              </tbody>
            </table>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>

@endsection
