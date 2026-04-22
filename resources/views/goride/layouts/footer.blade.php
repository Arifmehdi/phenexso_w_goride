<!-- ── FOOTER ── -->
<footer>
    <div class="container">
        <div class="footer-top">
            <div class="footer-top-text">
                <h3>{{ __('goride.footer.get_app') }}</h3>
                <p>{{ __('goride.footer.book_faster') }}</p>
            </div>
            <div class="footer-app-btns">
                <a href="#" class="footer-app-btn"><i class="fab fa-apple"></i> App Store</a>
                <a href="#" class="footer-app-btn"><i class="fab fa-google-play"></i> Google Play</a>
            </div>
        </div>
        <div class="footer-grid">
            <div class="footer-about">
                <!-- <img src="{{ asset('goride/assets/go_ride_logo.jpg') }}" alt="GoRide Bangladesh"> -->
                <h1>GoRide Bangladesh</h1>
                <p>{{ __('goride.footer.about_text') }}</p>
                <div class="footer-socials">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h4>{{ __('goride.footer.quick_links') }}</h4>
                <ul>
                    <li><a href="{{ route('home') }}">{{ __('goride.nav.home') }}</a></li>
                    <li><a href="{{ route('about') }}">{{ __('goride.nav.about') }}</a></li>
                    <li><a href="{{ route('service') }}">{{ __('goride.nav.services') }}</a></li>
                    <li><a href="{{ route('fleet') }}">{{ __('goride.nav.fleet') }}</a></li>
                    <li><a href="{{ route('tours') }}">{{ __('goride.nav.tours') }}</a></li>
                    <li><a href="#">{{ __('goride.nav.book_now') ?? 'Book a Ride' }}</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>{{ __('goride.nav.services') }}</h4>
                <ul>
                    <li><a href="{{ route('contact') }}">{{ __('goride.nav.contact') }}</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">FAQ</a></li>
                    @if(Auth::check())
                        <li><a href="{{ route('user.dashboard') }}">{{ __('goride.nav.dashboard') }}</a></li>
                    @else
                        <li><a href="{{ route('login') }}">{{ __('goride.nav.login') }}</a></li>
                    @endif
                </ul>
            </div>
            <div class="footer-contact">
                <h4>{{ __('goride.footer.contact_info') }}</h4>
                <p><i class="fas fa-phone-alt"></i> +880 1234 567890</p>
                <p><i class="fas fa-envelope"></i> info@goride.com.bd</p>
                <p><i class="fas fa-map-marker-alt"></i> House 12, Gulshan 1, Dhaka</p>
                <p><i class="fab fa-whatsapp"></i> +880 1234 567890</p>
                <p style="margin-top:16px; font-size:0.8rem; color:#475569;">Available 24/7 for support</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} GoRide Bangladesh. {{ __('goride.footer.rights_reserved') }} {{ __('goride.footer.built_for') }} 🇧🇩</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Cookies</a>
            </div>
        </div>
    </div>
</footer>
