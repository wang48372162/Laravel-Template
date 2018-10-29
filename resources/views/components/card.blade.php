<div class="card">
  <div class="card-header">
    <h5>
      @isset($icon)
        <i class="{{ $icon }}"></i>
      @endisset

      {{ $title }}
    </h5>

    {{ $extra ?? null }}
  </div>

  @if ($body ?? true) <div class="card-body"> @endif

    {{ $slot }}

  @if ($body ?? true) </div> @endif
</div>
