<div class="modal fade" id="{{ $name }}" tabindex="-1" role="dialog" aria-labelledby="{{ $name }}Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $name }}Label">{{ $title }}</h5>

        @if ($close ?? true)
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        @endif
      </div>

      <div class="modal-body">
        {{ $slot }}
      </div>

      <div class="modal-footer">
        @isset($footer)
          {{ $footer }}
        @else
          @if ($cancel ?? true)
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
          @endif

          @if ($ok ?? true)
            <button type="button" class="btn btn-primary">確定</button>
          @endif
        @endisset
      </div>
    </div>
  </div>
</div>
