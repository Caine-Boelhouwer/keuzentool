<div class="cell small-12">
  <a href="/{{ $page }}" class="back_link">Terug</a>
</div>
<div class="cell small-12 medium-6 large-7">
  <h3 class="page_title">{{ $title }}</h3>
</div>
<div class="cell small-12 medium-6 large-5">
  <div class="action_bar">
    @if ($save)
      <a class="action_button fill success" id="save_form"><i class="fas fa-save"></i>Opslaan</a>
    @endif
    @if ($edit)
      <a href="/{{ $page }}/bewerken/{{ $id }}" class="action_button fill"><i class="far fa-edit"></i>Bewerken</a>
    @endif
    @if ($archive)
      <a href="/{{ $page }}/archief/{{ $id }}" class="action_button fill alert"><i class="fas fa-archive"></i>Archiveer</a>
    @endif
    @if ($delete)
      <a class="confirm_reveal_trigger action_button fill alert"
        data-reveal-title="Verwijderen"
        data-reveal-content="Weet je zeker dat je <strong>{{ $title }}</strong> wil verwijderen"
        data-reveal-link="{{ url($page.'/verwijderen/'.$id) }}"><i class="fas fa-trash-alt"></i> Verwijderen</a>
    @endif
    @if ($cancel)
      @if ($id != 0)
        <a href="/{{ $page }}/{{ $id }}" class="action_button fill alert"><i class="fas fa-ban"></i>Anulleren</a>
      @else
        <a href="/{{ $page }}" class="action_button fill alert"><i class="fas fa-ban"></i>Anulleren</a>
      @endif
    @endif
  </div>
</div>
<div class="cell small-12">
  @if (isset($breadcrumbs))
    <nav role="navigation">
      <ul class="breadcrumbs custom">
        @foreach ($breadcrumbs as $key => $value)
          <li><a @if (!empty($value)) href="{{ $value }}" @endif class="breadcrumb">{{ $key }}</a></li>
        @endforeach
      </ul>
    </nav>
  @endif
</div>
