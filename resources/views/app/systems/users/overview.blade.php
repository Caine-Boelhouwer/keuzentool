@extends('layouts.app')

@section('content')

  <div class="page_content">
    <div class="page_overview_head">
      <div class="grid-x grid-padding-x grid-margin-x">
        <div class="cell small-12">
          @include('layouts.pages.overview.title', [
            'title' => 'Gebruikers',
          ])
        </div>
        <div class="cell small-12">
          @include('layouts.pages.overview.actionbar', [
            'archive' => true,
            'switch' => true,
            'searchbar' => true,
            'add' => true,
            'type' => 'Gebruiker',
            'page' => 'systeem/gebruikers'
          ])
        </div>
      </div>
    </div>

    <div class="page_table_wrapper">
      <div class="grid-x grid-padding-x grid-margin-x">
        <div class="cell small-12">
          {!! Form::open(['url' => '/systeem/gebruikers/archief/bulk', 'id' => 'table_form']) !!}
            <table id="overview_table" class="hover stack rank_{{ Auth::user()->role->ranking }}">
              <thead>
                <tr>
                  <th class="multi-select" width="2%"></th>
                  <th class="default-sort">Username</th>
                  <th>Rol</th>
                  <th>E-mail</th>
                  <th>Status</th>
                  @include('layouts.tables.head')
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr data-status="{{ $user->status }}">
                    <td>{{ $user->id }}</td>
                    @if (Auth::user()->id != $user->id)
                      <td><a class="user_name" href="/systeem/gebruikers/{{ $user->id }}">{{ $user->username or '-' }}</a></td>
                    @else
                      <td><a class="user_name is_self" href="/profile"><span class="hidden">aaaaa</span>{{ $user->username or '-' }}</a></td>
                    @endif
                    <td>{{ $user->role->name or '-' }}</td>
                    <td>{{ $user->email or '-' }}</td>
                    <td>{{ Helper::setStatusText($user->status) }}</td>
                    @if (Auth::user()->id != $user->id)
                      @include('layouts.tables.option', [
                        'data_id' => $user->id,
                        'data_item' => $user->username,
                        'data_role_ranking' => $user->role->ranking,
                        'show' => true,
                        'edit' => true,
                        'archive' => true,
                        'delete' => false,
                        'restore' => false,
                        'page' => 'systeem/gebruikers',
                      ])
                    @else
                      <td></td>
                    @endif
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
