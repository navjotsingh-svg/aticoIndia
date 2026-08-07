<div class="enquiry-modal" id="enquiryModal" aria-hidden="true" role="dialog" aria-labelledby="enquiryModalTitle">
    <div class="enquiry-modal-backdrop" data-close-enquiry></div>
    <div class="enquiry-modal-dialog">
        <div class="enquiry-modal-card">
            <button type="button" class="enquiry-modal-close" data-close-enquiry aria-label="Close enquiry form">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>

            <div class="enquiry-modal-layout">
                <aside class="enquiry-modal-aside">
                    <div class="enquiry-modal-aside-inner">
                        <span class="enquiry-modal-badge"><i class="fa fa-flask" aria-hidden="true"></i> Free Quote</span>
                        <h2 id="enquiryModalTitle">Get Your Free Quote</h2>
                        <p>Share your lab equipment requirements and our team will respond with pricing and availability.</p>
                        <ul class="enquiry-modal-features">
                            <li><i class="fa fa-check-circle" aria-hidden="true"></i> ISO 9001 certified manufacturer</li>
                            <li><i class="fa fa-check-circle" aria-hidden="true"></i> Export to 80+ countries worldwide</li>
                            <li><i class="fa fa-check-circle" aria-hidden="true"></i> Custom lab setup consultation</li>
                        </ul>
                        <div class="enquiry-modal-contact">
                            <a href="tel:+919996186555"><i class="fa fa-phone" aria-hidden="true"></i> +91-9996186555</a>
                            <a href="mailto:sales@aticoindia.com"><i class="fa fa-envelope-o" aria-hidden="true"></i> sales@aticoindia.com</a>
                        </div>
                    </div>
                </aside>

                <div class="enquiry-modal-form-wrap">
                    <h3 class="enquiry-modal-form-title">Send Enquiry</h3>
                    <p class="enquiry-modal-form-lead">Fill in your details and we will get back to you shortly.</p>

                    <form class="enquiry-modal-form" method="post" action="{{ route('enquiry.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('partials.inquiry-meta')
                        <div class="enquiry-form-grid">
                            <label class="enquiry-field">
                                <span class="enquiry-field-label">Full Name <em>*</em></span>
                                <input class="input" name="name" placeholder="Your name" required value="{{ old('name') }}">
                            </label>
                            <label class="enquiry-field">
                                <span class="enquiry-field-label">Email</span>
                                <input class="input" type="email" name="email" placeholder="you@company.com" value="{{ old('email') }}">
                            </label>
                            <label class="enquiry-field">
                                <span class="enquiry-field-label">Phone</span>
                                <input class="input" name="mobile_no" placeholder="+91 98765 43210" value="{{ old('mobile_no') }}">
                            </label>
                            <label class="enquiry-field">
                                <span class="enquiry-field-label">Country <em>*</em></span>
                                @include('partials.inquiry-country')
                            </label>
                        </div>
                        <label class="enquiry-field enquiry-field--full">
                            <span class="enquiry-field-label">Message</span>
                            <textarea name="message" rows="4" placeholder="Tell us about the equipment or lab setup you need...">{{ old('message') }}</textarea>
                        </label>
                        @include('partials.inquiry-attachment')
                        @include('partials.inquiry-recaptcha')
                        <button class="btn btn-enquiry-submit" type="submit">
                            <span>Submit Enquiry</span>
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>
                        <p class="enquiry-modal-note">
                            Colleges and universities setting up a complete lab can email us at
                            <a href="mailto:sales@aticoindia.com">sales@aticoindia.com</a> for a custom quotation.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
