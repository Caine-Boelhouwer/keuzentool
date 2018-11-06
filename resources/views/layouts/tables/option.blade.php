<td>
  <ul class="dropdown menu table_dropdown" data-dropdown-menu data-closing-time="50" data-disable-hover="true" data-click-open="true">
    <li>
      <a href="#"><i class="far fa-ellipsis-h"></i></a>
      <ul class="menu">
        @if ($show)
          <li><a href="/{{ $page }}/{{ $data_id }}">Bekijken</a></li>
        @endif
        @if ($edit)
          @if (Auth::user()->role->ranking < $data_role_ranking)
            <li><a href="/{{ $page }}/bewerken/{{ $data_id }}">Bewerken</a></li>
          @endif
        @endif
        @if ($restore)
          <li>
            <a class="confirm_reveal_trigger"
              data-reveal-title="Herstellen"
              data-reveal-content="Weet je zeker dat je <strong>{{ $data_item }}</strong> wil herstellen"
              data-reveal-link="{{ url($page.'/herstellen/'.$data_id) }}">Herstellen</a>
          </li>
        @endif
        @if ($archive)
          @if (Auth::user()->role->ranking < $data_role_ranking)
            <li><a href="/{{ $page }}/archief/{{ $data_id }}">Archiveer</a></li>
          @endif
        @endif
        @if ($delete)
          <li>
            <a class="confirm_reveal_trigger"
              data-reveal-title="Verwijderen"
              data-reveal-content="Weet je zeker dat je <strong>{{ $data_item }}</strong> wil verwijderen"
              data-reveal-link="{{ url($page.'/verwijderen/'.$data_id) }}">Verwijderen</a>
          </li>
        @endif
      </ul>
    </li>
  </ul>
</td>
