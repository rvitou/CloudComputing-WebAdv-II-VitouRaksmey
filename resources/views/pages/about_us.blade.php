@extends('layouts.public')

@section('title', 'About Us - Global Currency Archive')

@section('content')
    <section class="about-us-section">
        <div class="about-us-content">
            <h1>Our Mission & Vision</h1>
            <p>The Global Currency Archive is a passion project dedicated to the fascinating world of banknotes. Our mission is to digitally preserve and showcase the rich history, intricate artistry, and cultural significance of currencies from every corner of the globe. We envision a world where the stories behind these tangible pieces of history are accessible to everyone, from seasoned numismatists to curious learners.</p>
            <p>Founded on the principle that every note tells a story, we strive to be the most comprehensive and user-friendly online resource for currency documentation. Our team is committed to meticulous research, high-quality imaging, and creating an engaging platform for discovery.</p>
        </div>
        <div class="about-us-image">
            <img src="{{ asset('img/mission.jpg') }}" alt="About Us">
        </div>
    </section>

    <section class="our-missions-section">
        <h2>What We Do</h2>
        <div class="missions-grid">
            <div class="mission-card">
                Digitally Archive Banknotes from All Nations.
            </div>
            <div class="mission-card">
                Provide Historical Context and Cultural Significance for Each Note.
            </div>
            <div class="mission-card">
                Offer Advanced Search and Filtering Options for Easy Discovery.
            </div>
            <div class="mission-card">
                Foster a Community of Currency Enthusiasts and Researchers.
            </div>
        </div>
    </section>

    <section class="bottom-content-section">
        <div class="bottom-content-image">
            <img src="{{ asset('img/me.png') }}" alt="Our Team" style="height: 300px; width: auto; background: white; ">
        </div>
        <div class="who-are-we-text">
            <h3>Who Are We?</h3>
            <p>We are a small team of historians, designers, and technology enthusiasts united by a shared passion for numismatics. Our collective expertise allows us to curate, document, and present currency information with accuracy and visual appeal. We believe that by understanding the money of different eras and cultures, we gain a deeper appreciation for our shared human heritage.</p>
        </div>
    </section>
@endsection
