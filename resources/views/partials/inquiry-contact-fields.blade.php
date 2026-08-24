@php
    $emailField = $emailField ?? 'email';
    $phoneField = $phoneField ?? 'mobile_no';
    $layout = $layout ?? 'stack';
@endphp

@if ($layout === 'grid')
    <label class="enquiry-field">
        <span class="enquiry-field-label">Email <em>*</em></span>
        <span class="enquiry-field-hint">Email or phone required</span>
        <input class="input @error($emailField) is-invalid @enderror" type="email" name="{{ $emailField }}" placeholder="you@company.com" value="{{ old($emailField) }}">
        @error($emailField)
            <span class="field-error">{{ $message }}</span>
        @enderror
    </label>
    <label class="enquiry-field">
        <span class="enquiry-field-label">Phone <em>*</em></span>
        <span class="enquiry-field-hint">Email or phone required</span>
        <input class="input @error($phoneField) is-invalid @enderror" name="{{ $phoneField }}" placeholder="+91 98765 43210" value="{{ old($phoneField) }}">
        @error($phoneField)
            <span class="field-error">{{ $message }}</span>
        @enderror
    </label>
@else
    <input class="input @error($emailField) is-invalid @enderror" type="email" name="{{ $emailField }}" placeholder="Email Address *" value="{{ old($emailField) }}">
    @error($emailField)
        <span class="field-error">{{ $message }}</span>
    @enderror
    <input class="input @error($phoneField) is-invalid @enderror" name="{{ $phoneField }}" placeholder="Phone Number *" value="{{ old($phoneField) }}">
    @error($phoneField)
        <span class="field-error">{{ $message }}</span>
    @enderror
    <p class="field-hint">Provide at least one: email or phone number.</p>
@endif
