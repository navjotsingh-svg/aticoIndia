@extends('layouts.app')

@section('content')
    <h1>{{ $blog->name }}</h1>
    <p class="muted">{{ optional($blog->created_at)->format('M d, Y') }}</p>
    @php
        $image = (string) ($blog->image ?? '');
        $path = str_starts_with($image, 'http')
            ? $image
            : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/blog_images/' . $image, '/'));
    @endphp
    @if ($image !== '')
        <img src="{{ $path }}" alt="{{ $blog->img_alt ?? $blog->name }}" style="max-width:100%;max-height:420px;object-fit:contain;border-radius:6px;background:#fff;padding:8px;">
    @endif

    <div class="card">
        {!! $blog->description !!}
    </div>

    <h3 style="margin-top: 24px;">General Enquiry</h3>
    <form class="card" method="post" action="{{ route('enquiry.store') }}" enctype="multipart/form-data">
        @csrf
        @include('partials.inquiry-meta')
        <input class="input" name="name" placeholder="Name" required>
        <input class="input" name="email" placeholder="Email">
        <input class="input" name="mobile_no" placeholder="Phone">
        @include('partials.inquiry-country')
        <textarea name="message" rows="4" placeholder="Message"></textarea>
        @include('partials.inquiry-attachment')
        @include('partials.inquiry-recaptcha')
        <button class="btn" type="submit">Submit</button>
    </form>
@endsection
