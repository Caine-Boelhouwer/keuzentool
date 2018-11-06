@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

  <div class="page_head search_head">
    <div class="page_wrapper">
      <div class="grid-x grid-margin-x header">
        <div class="cell small-12 medium-6">
          <h3 class="page_header">Dashboard</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="page_content">
    <div class="page_wrapper">
      <div class="grid-x grid-margin-x dashboard main_form">
        @if ($user->tasksExecutor->count() > 0)
          @foreach ($user->tasksExecutor as $task)
            <div class="cell small-12 medium-4 xxlarge-3 block">
              <div class="grid-x info_head">
                <div class="cell small-12 medium-6">
                  <h4>Taak</h4>
                </div>
                <div class="cell small-12 medium-6 text-right">
                  <div class="date_badge {{ Helper::setBadgeStatus($task->date) }}">{{ isset($task->date) ? Helper::parseDutchFormat($task->date, 'd-m-y') : '-' }}</div>
                </div>
              </div>
              <div class="content">
                {{ $task->title }}
              </div>
              <a href="/taken/bekijken/{{ $task->id }}" class="link">Ga naar taak <i class="far fa-angle-right"></i></a>
            </div>
          @endforeach
        @else
          <div class="cell small-12 medium-4 xxlarge-3 block">
            <div class="grid-x info_head">
              <div class="cell small-12 medium-6">
                <h4>Taak</h4>
              </div>
              <div class="cell small-12 medium-6 text-right">
              </div>
            </div>
            <div class="content">
              Geen taken...
            </div>
          </div>
        @endif
      </div>

      <div class="cell small-12 consult_container">
        <table class="overview_table_mini" class="hover stack">
          <thead>
            <tr>
              <th class="default-sort">In behandeling door jou</th>
              <th>Type</th>
              <th>E-mail</th>
              <th>Telefoonnummer</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user->personasConsultant as $persona)
              <tr>
                <td><a href="/{{ $persona->type == 'owner' ? 'eigenaren' : 'beheerders' }}/bekijken/{{ $persona->id }}">{{ $persona->data->name or '-' }}</a></td>
                <td>{{ isset($persona->type) ? Helper::translatePersonaType($persona->type) : '-' }}</td>
                <td>{{ $persona->data->email or '-' }}</td>
                <td>{{ $persona->data->phone or '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
