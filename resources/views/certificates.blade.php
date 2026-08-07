@extends('layouts.app')

@section('title', 'Certificates - Atico India')
@section('meta_description', 'View Atico India quality certifications including ISO 9001, CE Mark, WHO-GMP, ISO 13485, ISO 14001 and more.')

@section('body_class')
page-catalog
@endsection

@section('page_head')
    <div class="page-head">
        <div class="container">
            <nav class="page-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Certificates</span>
            </nav>
            <h1>Certificates</h1>
        </div>
    </div>
@endsection

@section('content')
    <section class="inner-page certificates-page">
        <div class="certificates-grid">
            @foreach ([
                ['subtitle' => 'ISO', 'title' => '9001', 'image' => 'c1.webp'],
                ['subtitle' => 'CE Mark', 'title' => 'CE', 'image' => 'c2.webp'],
                ['subtitle' => 'WHO-GMP', 'title' => 'GMP', 'image' => 'c3.webp'],
                ['subtitle' => 'ISO 13485', 'title' => 'ISO', 'image' => 'c4.webp'],
                ['subtitle' => 'Advanced', 'title' => 'CE', 'image' => 'Advanced-CE.webp'],
                ['subtitle' => 'Quality', 'title' => 'Policy', 'image' => 'Child-Labour-Clearence-Certificate.webp'],
                ['subtitle' => 'ISO', 'title' => '9001', 'image' => 'ISO-9001.webp'],
                ['subtitle' => 'ISO', 'title' => '13485-2003', 'image' => 'ISO-13485-2003.webp'],
                ['subtitle' => 'ISO', 'title' => '14001', 'image' => 'ISO-14001.webp'],
                ['subtitle' => 'ISO', 'title' => '18001', 'image' => 'OHSAS-18001.webp'],
                ['subtitle' => 'SSI', 'title' => 'Certificate', 'image' => 'OHSAS-18001.webp'],
                ['subtitle' => 'WHO', 'title' => 'GMP', 'image' => 'WHO-GMP.webp'],
            ] as $certificate)
                <article class="certificate-card card-panel">
                    <div class="certificate-card-head">
                        <div class="certificate-card-icon">
                            <i class="fa fa-certificate" aria-hidden="true"></i>
                        </div>
                        <div>
                            <p class="certificate-card-subtitle">{{ $certificate['subtitle'] }}</p>
                            <h2 class="certificate-card-title">{{ $certificate['title'] }}</h2>
                        </div>
                    </div>
                    <a href="{{ asset('assets/frontend/images/certificates/' . $certificate['image']) }}" class="certificate-card-image" target="_blank" rel="noreferrer">
                        <img
                            src="{{ asset('assets/frontend/images/certificates/' . $certificate['image']) }}"
                            alt="{{ $certificate['subtitle'] }} {{ $certificate['title'] }} certificate"
                            loading="lazy"
                        >
                    </a>
                </article>
            @endforeach
        </div>
    </section>
@endsection
