<div class="action_bar">
  @if ($archive)
    <a href="#" class="action_button fill" id="bulk_archive"><i class="fas fa-archive"></i> Archiveer</a>
  @endif

  @if ($switch)
    <div class="switch_container">
      <div class="switch tiny">
        <input class="switch-input" id="switch_for_active" type="checkbox">
        <label class="switch-paddle" for="switch_for_active">
          <span class="show-for-sr">Laat actieven zien</span>
        </label>
        <label class="switch_content" for="switch_for_active">Laat actieven zien</label>
      </div>
    </div>
  @endif

  @if ($searchbar)
    <label class="table_search_input">
      <input type="text" placeholder="Typ om te zoeken..." id="table_searchbar">
    </label>
  @endif

  @if ($add)
    <a href="/{{ $page }}/aanmaken" class="action_button fill"><i class="fas fa-plus-circle"></i> {{ $type }} aanmaken</a>
  @endif
</div>
