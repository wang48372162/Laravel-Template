<label class="btn btn-{{ $color ?? 'primary' }}{{ ($block ?? false) ? ' block' : '' }}">
  <input type="file" name="{{ $name }}" class="d-none" @if($submit ?? false) onchange="this.form.submit()" @endif required>

  @isset($icon)
    <i class="{{ $icon }}"></i>
  @endisset

  {{ $text }}
</label>

<div class="form-control d-none{{ $errors->has($name) ? ' is-invalid' : '' }}"></div>
@if ($errors->has($name))
  <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first($name) }}</strong>
  </span>
@endif
