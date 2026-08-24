<aside class="sidebar-card catalog-sidebar">
    <h3 class="sidebar-title sidebar-title--enquiry">Send Enquiry</h3>
    <form class="sidebar-form" method="post" action="{{ route('enquiry.store') }}" enctype="multipart/form-data" data-inquiry-form>
        @csrf
        @include('partials.inquiry-meta')
        @if (session('enquiry_success'))
            <div class="form-success-state form-success-state--compact" role="status">
                <p><i class="fa fa-check-circle" aria-hidden="true"></i> {{ session('success') }}</p>
            </div>
        @else
            <input class="input @error('name') is-invalid @enderror" name="name" placeholder="Your Name *" required value="{{ old('name') }}">
            @error('name')
                <span class="field-error">{{ $message }}</span>
            @enderror
            @include('partials.inquiry-contact-fields')
            @include('partials.inquiry-country')
            @error('country')
                <span class="field-error">{{ $message }}</span>
            @enderror
            <textarea name="message" rows="3" placeholder="Your message">{{ old('message') }}</textarea>
            @include('partials.inquiry-attachment')
            @include('partials.inquiry-recaptcha')
            @error('g-recaptcha-response')
                <span class="field-error">{{ $message }}</span>
            @enderror
            <button class="btn" type="submit">Submit</button>
        @endif
    </form>

    @include('partials.sidebar-categories')
</aside>
