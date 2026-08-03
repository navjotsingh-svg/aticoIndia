<aside class="sidebar-card catalog-sidebar blog-sidebar">
    <h3 class="sidebar-title sidebar-title--enquiry">Send Enquiry</h3>
    <form class="sidebar-form" method="post" action="{{ route('enquiry.store') }}" enctype="multipart/form-data">
        @csrf
        @include('partials.inquiry-meta')
        <input class="input" name="name" placeholder="Your Name" required value="{{ old('name') }}">
        <input class="input" name="email" type="email" placeholder="Email" value="{{ old('email') }}">
        <input class="input" name="mobile_no" placeholder="Phone Number" value="{{ old('mobile_no') }}">
        @include('partials.inquiry-country')
        <textarea name="message" rows="3" placeholder="Your message">{{ old('message') }}</textarea>
        @include('partials.inquiry-attachment')
        @include('partials.inquiry-recaptcha')
        <button class="btn" type="submit">Submit</button>
    </form>

    @include('partials.sidebar-recent-posts')
</aside>
