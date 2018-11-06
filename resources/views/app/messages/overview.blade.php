@extends('layouts.app')

@section('content')

  <div class="page_content">
    <div class="page_overview_head">
      <div class="grid-x grid-padding-x grid-margin-x">
        <div class="cell small-12">
          @include('layouts.pages.overview.title', [
            'title' => 'Berichten',
          ])
        </div>
        <div class="cell small-12">
          @include('layouts.pages.overview.actionbar', [
            'archive' => false,
            'switch' => false,
            'searchbar' => true,
            'add' => false,
            'type' => 'Berichten',
            'page' => 'berichten'
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
                <th>E-mail</th>
                <th>Phone</th>
                @include('layouts.tables.head')
              </tr>
            </thead>
            <tbody>
              @foreach ($messages as $message)
                <tr data-status="{{ $message->status }}">
                  <td><a href="/berichten/{{ $message->id }}">{{ $message->name or '-' }}</a></td>
                  <td>{{ $message->email or '-' }}</td>
                  <td>{{ $message->phone or '-' }}</td>
                  @include('layouts.tables.option', [
                    'data_id' => $message->id,
                    'data_item' => $message->name,
                    'data_role_ranking' => 9999,
                    'show' => true,
                    'edit' => false,
                    'archive' => false,
                    'delete' => true,
                    'restore' => false,
                    'page' => 'berichten',
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
