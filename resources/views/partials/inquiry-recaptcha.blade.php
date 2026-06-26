@if(config('inquiry.recaptcha_site_key'))
    <div class="form-recaptcha">
        <div class="g-recaptcha" data-sitekey="{{ config('inquiry.recaptcha_site_key') }}"></div>
        @error('g-recaptcha-response')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>
@endif
