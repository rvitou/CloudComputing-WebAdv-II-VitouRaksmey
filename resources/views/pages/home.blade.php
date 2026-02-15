@extends('layouts.public')

@section('title', 'Home - Global Currency Archive')

@section('content')
    {{-- Hero Section --}}
    <section class="hero-section">
        <h1>Explore Global Currencies</h1>
        <p>Your comprehensive archive of banknotes from around the world.</p>
        <a href="#countries" class="btn btn-login">Start Exploring</a>
    </section>

    {{-- Country Selection Section (was Currency Flags Section) --}}
    <section id="countries" class="country-selection">
        <h2>Select a Country</h2>
        <div class="country-grid">
            {{-- ADDED 'protected-flag-link' class here --}}
            <a href="{{ route('currency.detail', ['countrySlug' => 'cambodia']) }}" class="country-card protected-flag-link">
                <img src="{{ asset('img/flags/cambodia.svg') }}" alt="Cambodia Flag">
                <h3>Cambodia</h3>
            </a>
            <a href="{{ route('currency.detail', ['countrySlug' => 'china']) }}" class="country-card protected-flag-link">
                <img src="{{ asset('img/flags/china.webp') }}" alt="China Flag">
                <h3>China</h3>
            </a>
            <a href="{{ route('currency.detail', ['countrySlug' => 'vietnam']) }}" class="country-card protected-flag-link">
                <img src="{{ asset('img/flags/vietnam.png') }}" alt="Vietnam Flag">
                <h3>Vietnam</h3>
            </a>
            <a href="{{ route('currency.detail', ['countrySlug' => 'usa']) }}" class="country-card protected-flag-link">
                <img src="{{ asset('img/flags/usa.png') }}" alt="USA Flag">
                <h3>USA</h3>
            </a>
        </div>
    </section>

    {{-- Currency Story Section --}}
    <section class="currency-story-section">
        <div class="currency-story-content">
            <h2 class="section-title" style="text-align: left;">The Story of Currencies</h2>
            <p>Every banknote tells a story of its nation’s history, culture, and aspirations. From ancient barter systems to modern digital transactions, currency has evolved dramatically, reflecting the changing dynamics of societies worldwide. Our archive delves into these narratives, preserving the intricate designs, security features, and historical context that make each note unique. Discover how political shifts, economic booms, and technological advancements have shaped the very money in our hands.</p>
        </div>
        <div class="currency-story-image">
            <img src="{{ asset('img/story-placeholder.jpg') }}" alt="Currency Story Image">
        </div>
    </section>

    {{-- Featured Collection Section --}}
    <section class="featured-collection-section">
        <h2 class="section-title">Featured Collections</h2>
        <div class="collection-grid">
            <div class="collection-item">
                <img src="{{ asset('img/collection1.jpg') }}" alt="Collection 1">
                <h4>Ancient Dynasties</h4>
                <p>Notes from historical empires.</p>
            </div>
            <div class="collection-item">
                <img src="{{ asset('img/collection2.avif') }}" alt="Collection 2">
                <h4>Post-War Currencies</h4>
                <p>The money of reconstruction.</p>
            </div>
            <div class="collection-item">
                <img src="{{ asset('img/collection3.jpeg') }}" alt="Collection 3">
                <h4>Modern Innovations</h4>
                <p>New materials and security.</p>
            </div>
        </div>
    </section>

    {{-- Importance Section --}}
    <section class="importance-section">
        <h2 class="section-title" style="color: #007bff;">Why Currency Archiving Matters</h2>
        <div class="importance-grid">
            <div class="importance-item">
                <h4>Preserving History</h4>
                <p>Banknotes are tangible records of economic and political evolution, offering insights into societal values and historical events.</p>
            </div>
            <div class="importance-item">
                <h4>Educational Resource</h4>
                <p>A comprehensive archive provides valuable learning materials for students, researchers, and enthusiasts of numismatics.</p>
            </div>
            <div class="importance-item">
                <h4>Cultural Heritage</h4>
                <p>Each note is a work of art, reflecting a nation's unique symbols, landmarks, and significant figures, contributing to global cultural heritage.</p>
            </div>
        </div>
    </section>

    {{-- Call to Action Section --}}
    <section class="cta-section">
        <h2>Join Our Community!</h2>
        <p>Become a part of the Global Currency Archive. Share your knowledge, discover new notes, and connect with fellow enthusiasts.</p>
        <div class="cta-buttons">
            <a href="{{ route('home') }}#countries" class="btn btn-explore">Explore Now</a>
            {{-- ADDED: @guest directive to hide/disable Register button after login --}}
            @guest
                <a href="{{ route('register') }}" class="btn btn-register">Register</a>
            @endguest
        </div>
    </section>

    {{-- Detailed Footer --}}
    <div class="detailed-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>The Global Currency Archive is dedicated to preserving the history and artistry of banknotes from around the world. We provide a comprehensive, searchable database for enthusiasts, researchers, and the curious.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about.us') }}">About Us</a></li>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('collections') }}" class="protected-link">Collections</a></li>
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <div class="footer-contact-info">
                    <span class="icon-email"></span><p>info@currencyarchive.com</p>
                </div>
                <div class="footer-contact-info">
                    <span class="icon-phone"></span><p>+123 456 7890</p>
                </div>
            </div>
        </div>
        <div class="footer-disclaimer">
            <h3>Disclaimer</h3>
            <p>This website is for informational and educational purposes only. We do not engage in the buying, selling, or trading of currencies. All information provided is for archival and historical reference.</p>
        </div>
        <div class="footer-copyright">
            <p>&copy; 2025 Global Currency Archive. All rights reserved.</p>
        </div>
    </div>

@endsection

@section('scripts')
    {{-- JavaScript for Protected Links and Flags --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isGuest = {{ Auth::check() ? 'false' : 'true' }};

            if (isGuest) {
                // Protect general protected links (this will now only affect 'Collections' in the footer, if it retains 'protected-link')
                const protectedLinks = document.querySelectorAll('.protected-link');
                protectedLinks.forEach(link => {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        alert('Please log in or sign up to access this feature.');
                    });
                });

                // Protect country flag links (this remains the source of alerts for flags)
                const protectedFlagLinks = document.querySelectorAll('.protected-flag-link');
                protectedFlagLinks.forEach(link => {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        alert('Please log in or sign up to view currency details.');
                    });
                });
            }
        });
    </script>
@endsection
