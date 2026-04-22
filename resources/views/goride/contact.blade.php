@extends('goride.layouts.master')

@section('title', 'Contact Us | GoRide Bangladesh')

@section('content')
<div class="page-hero">
    <div class="page-hero-content">
        <h1>Get In Touch</h1>
        <p>Our team is available 24/7 to help with bookings, corporate inquiries, or any support you need.</p>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>Contact</span>
        </div>
    </div>
</div>

<section style="background:white;">
    <div class="container">
        <div class="contact-wrapper">
            <div class="contact-info-card">
                <h3>Contact Information</h3>
                <p>Fill out the form and our team will respond within 24 hours — usually much sooner.</p>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                    <div><h4>Phone</h4><p>{{ $ws->contact_mobile }}</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-envelope"></i></div>
                    <div><h4>Email</h4><p>{{ $ws->contact_email }}</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div><h4>Office</h4><p>{{ $ws->contact_address }}</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fab fa-whatsapp"></i></div>
                    <div><h4>WhatsApp</h4><p>{{ $ws->contact_whatsapp ?? $ws->contact_mobile }}</p></div>
                </div>
                <div style="margin-top:36px;padding-top:28px;border-top:1px solid rgba(255,255,255,0.15);">
                    <p style="font-size:0.8rem;opacity:0.6;margin-bottom:12px;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Also On</p>
                    <div style="display:flex;gap:10px;">
                        <a href="#" style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.10);border:1px solid rgba(255,255,255,0.15);color:white;padding:10px 16px;border-radius:10px;font-size:13px;font-weight:600;transition:all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.10)'"><i class="fab fa-apple" style="font-size:16px;"></i> iOS App</a>
                        <a href="#" style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.10);border:1px solid rgba(255,255,255,0.15);color:white;padding:10px 16px;border-radius:10px;font-size:13px;font-weight:600;transition:all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.10)'"><i class="fab fa-google-play" style="font-size:15px;"></i> Android</a>
                    </div>
                </div>
            </div>

            <div class="form-container" style="margin:0;">
                <h3 style="font-family:'Sora',sans-serif;font-size:1.3rem;font-weight:800;margin-bottom:8px;">Send a Message</h3>
                <p style="color:var(--text-light);margin-bottom:28px;font-size:0.875rem;">We'll get back to you as soon as possible.</p>
                <form id="contactForm" action="#" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group"><label>First Name</label><input type="text" name="first_name" class="form-control" placeholder="Rahim" required></div>
                        <div class="form-group"><label>Last Name</label><input type="text" name="last_name" class="form-control" placeholder="Sarkar" required></div>
                    </div>
                    <div class="form-group"><label>Email Address</label><input type="email" name="email" class="form-control" placeholder="rahim@example.com" required></div>
                    <div class="form-group"><label>Phone Number</label><input type="tel" name="phone" class="form-control" placeholder="017XXXXXXXX"></div>
                    <div class="form-group">
                        <label>Subject</label>
                        <select name="subject" class="form-control">
                            <option>General Inquiry</option>
                            <option>Booking Support</option>
                            <option>Corporate Partnership</option>
                            <option>Driver / Owner Support</option>
                            <option>Feedback</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Message</label><textarea name="message" class="form-control" rows="5" placeholder="How can we help you?" required></textarea></div>
                    <button type="submit" class="btn-primary">Send Message <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
