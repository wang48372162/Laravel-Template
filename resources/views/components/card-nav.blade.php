<div class="card">
  <div class="card-header justify-content-center">
    <span>
      @isset($icon)
        <i class="{{ $icon }} fa-fw text-primary"></i>
      @endisset

      {{ $title }}
    </span>
  </div>

  <nav class="navbar navbar-light p-0">
    <div class="navbar-nav-scroll">
      {{ $slot }}
    </div>
  </nav>
</div>
