@extends('layouts.app')

@section('title', 'Contact Us - Atico India')
@section('meta_description', 'Contact Atico India for lab equipment enquiries, quotations, and tender support. Call +91-9896793832 or email sales@aticoindia.com.')

@section('body_class')
page-catalog
@endsection

@section('page_head')
    <div class="page-head">
        <div class="container">
            <nav class="page-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Contact Us</span>
            </nav>
            <h1>Contact Us</h1>
        </div>
    </div>
@endsection

@section('content')
    <section class="inner-page contact-page">
        <div class="contact-grid">
            <div class="contact-intro">
                <h2>Get in Touch</h2>
                <p>Have a question about our lab equipment, need a quotation, or want to discuss a tender project? Reach out to our team — we are happy to help schools, colleges, universities, and institutions worldwide.</p>

                <ul class="contact-list">
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> 5309, Grain Market, Near B. D. Sen. Sec. School, Ambala Cantt-133001, Haryana, India</li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:sales@aticoindia.com">sales@aticoindia.com</a></li>
                    <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:+919896793832">+91-9896793832</a></li>
                    <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:+919996186555">+91-9996186555</a></li>
                    <li><i class="fa fa-fax" aria-hidden="true"></i> Fax: +91-0171-4004736</li>
                    <li><i class="fa fa-globe" aria-hidden="true"></i> <a href="https://www.aticoindia.com" target="_blank" rel="noreferrer">www.aticoindia.com</a></li>
                </ul>

                <div class="contact-extra card-panel">
                    <h3>Business Hours</h3>
                    <p>Monday to Saturday — 9:00 AM to 6:00 PM (IST)</p>
                    <p class="muted">For urgent enquiries, call our order help-line and our team will assist you.</p>
                </div>
            </div>

            <div class="contact-form card-panel">
                <h3>Drop Us a Line</h3>
                <p class="muted">Fill in the form below and we will get back to you shortly.</p>

                <form method="post" action="{{ route('enquiry.store') }}" enctype="multipart/form-data">
                    @csrf
                    @include('partials.inquiry-meta')
                    <input class="input" name="name" placeholder="Your Name *" required value="{{ old('name') }}">
                    <input class="input" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                    <input class="input" name="mobile_no" placeholder="Phone Number" value="{{ old('mobile_no') }}">
                    @include('partials.inquiry-country')
                    <textarea name="message" rows="5" placeholder="How can we help?">{{ old('message') }}</textarea>
                    @include('partials.inquiry-attachment')
                    @include('partials.inquiry-recaptcha')
                    <button class="btn btn-block" type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>
@endsection
