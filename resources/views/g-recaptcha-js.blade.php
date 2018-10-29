@if (config('auth.grecaptcha.use'))
    @push('js')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endpush
@endif
