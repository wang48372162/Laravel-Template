@if (config('auth.grecaptcha.use'))
    <div class="g-recaptcha" data-sitekey="{{ config('auth.grecaptcha.sitekey') }}"></div>

    @if ($errors->has('g-recaptcha-response'))
        <div class="form-control d-none is-invalid"></div>
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
        </span>
    @endif
@endif
