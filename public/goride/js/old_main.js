document.addEventListener('DOMContentLoaded', () => {

    /* ── HEADER SCROLL SHADOW ── */
    const header = document.querySelector('header');
    if (header) {
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 20);
        }, { passive: true });
    }

    /* ── MOBILE MENU ── */
    const mobileBtn = document.querySelector('.mobile-menu-btn');
    const navEl = document.querySelector('nav');
    if (mobileBtn && navEl) {
        mobileBtn.addEventListener('click', () => {
            navEl.classList.toggle('open');
            const icon = mobileBtn.querySelector('i');
            if (icon) {
                icon.className = navEl.classList.contains('open')
                    ? 'fas fa-times'
                    : 'fas fa-bars';
            }
        });
        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!header.contains(e.target)) {
                navEl.classList.remove('open');
                const icon = mobileBtn.querySelector('i');
                if (icon) icon.className = 'fas fa-bars';
            }
        });
        // Close on nav link click (mobile)
        navEl.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navEl.classList.remove('open');
                const icon = mobileBtn.querySelector('i');
                if (icon) icon.className = 'fas fa-bars';
            });
        });
    }

    /* ── ANIMATED COUNTERS ── */
    const statItems = document.querySelectorAll('.stat-item h3');
    if (statItems.length > 0) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                const raw = el.textContent.replace(/[^0-9]/g, '');
                const target = parseInt(raw, 10);
                const hasSuffix = el.id !== 'count-dest';
                const duration = 2000;
                const start = performance.now();

                const tick = (now) => {
                    const elapsed = Math.min((now - start) / duration, 1);
                    const ease = 1 - Math.pow(1 - elapsed, 3);
                    el.textContent = Math.ceil(ease * target) + (hasSuffix ? '+' : '');
                    if (elapsed < 1) requestAnimationFrame(tick);
                };
                requestAnimationFrame(tick);
                obs.unobserve(el);
            });
        }, { threshold: 0.5 });
        statItems.forEach(s => observer.observe(s));
    }

    /* ── LANGUAGE TOGGLE ── */
    const langBtn = document.querySelector('.lang-toggle');
    if (langBtn) {
        langBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const isBangla = langBtn.textContent.trim() === 'বাংলা';
            langBtn.textContent = isBangla ? 'English' : 'বাংলা';
            document.documentElement.lang = isBangla ? 'bn' : 'en';
        });
    }

    /* ── FORM SUBMIT FEEDBACK ── */
    document.querySelectorAll('form').forEach(form => {
        if (form.id === 'bookingForm') return; // handled separately
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            if (!btn) return;
            const orig = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check"></i> Sent Successfully!';
                btn.style.background = 'var(--success)';
                setTimeout(() => {
                    btn.innerHTML = orig;
                    btn.disabled = false;
                    btn.style.background = '';
                    form.reset();
                }, 3000);
            }, 1800);
        });
    });

    /* ── BOOKING FORM + OTP MODAL ── */
    const bookingForm = document.getElementById('bookingForm');
    const otpModal = document.getElementById('otpModal');
    const verifyBtn = document.getElementById('verifyOtpBtn');

    if (bookingForm && otpModal) {
        bookingForm.addEventListener('submit', (e) => {
            e.preventDefault();
            otpModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        otpModal.addEventListener('click', (e) => {
            if (e.target === otpModal) closeModal();
        });
    }
    if (verifyBtn) {
        verifyBtn.addEventListener('click', () => {
            const otp = document.querySelector('.otp-input');
            if (otp && otp.value.length < 4) {
                otp.style.borderColor = 'var(--danger)';
                otp.focus();
                return;
            }
            verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';
            verifyBtn.disabled = true;
            setTimeout(() => {
                closeModal();
                showToast('🎉 Booking Confirmed! We'll contact you shortly.', 'success');
                setTimeout(() => { window.location.href = 'index.html'; }, 2500);
            }, 1500);
        });
    }
    function closeModal() {
        if (otpModal) otpModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    /* ── LOGIN TABS ── */
    document.querySelectorAll('.login-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.login-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });

    /* ── TOAST NOTIFICATION ── */
    function showToast(message, type = 'info') {
        const existing = document.querySelector('.gr-toast');
        if (existing) existing.remove();

        const toast = document.createElement('div');
        toast.className = 'gr-toast';
        toast.style.cssText = `
            position: fixed; bottom: 32px; left: 50%; transform: translateX(-50%) translateY(20px);
            background: ${type === 'success' ? 'var(--primary)' : '#1a2332'};
            color: white; padding: 16px 28px; border-radius: 50px;
            font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 600;
            box-shadow: 0 12px 36px rgba(0,0,0,0.2); z-index: 9999;
            opacity: 0; transition: all 0.4s cubic-bezier(0.22,1,0.36,1);
            white-space: nowrap; max-width: 90vw; text-align: center;
        `;
        toast.textContent = message;
        document.body.appendChild(toast);
        requestAnimationFrame(() => {
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(-50%) translateY(0)';
        });
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(-50%) translateY(20px)';
            setTimeout(() => toast.remove(), 400);
        }, 3500);
    }

    /* ── SCROLL REVEAL ── */
    const revealEls = document.querySelectorAll(
        '.entry-card, .why-card, .service-card, .fleet-card, .tour-card, .testimonial-card, .vm-card'
    );
    if (revealEls.length > 0 && 'IntersectionObserver' in window) {
        const revealObs = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    entry.target.style.transitionDelay = `${(i % 6) * 60}ms`;
                    entry.target.classList.add('revealed');
                    revealObs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        const style = document.createElement('style');
        style.textContent = `
            .entry-card, .why-card, .service-card, .fleet-card, .tour-card, .testimonial-card, .vm-card {
                opacity: 0; transform: translateY(24px);
                transition: opacity 0.5s ease, transform 0.5s ease, box-shadow 0.35s ease, border-color 0.35s ease;
            }
            .revealed { opacity: 1 !important; transform: translateY(0) !important; }
        `;
        document.head.appendChild(style);
        revealEls.forEach(el => revealObs.observe(el));
    }

    /* ── CONTACT FORM ── */
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = contactForm.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check"></i> Message Sent!';
                btn.style.background = 'var(--success)';
                contactForm.reset();
                setTimeout(() => {
                    btn.innerHTML = 'Send Message <i class="fas fa-paper-plane"></i>';
                    btn.disabled = false;
                    btn.style.background = '';
                }, 4000);
            }, 2000);
        });
    }

    /* ── SET MIN DATE ON BOOKING ── */
    const dateInput = document.querySelector('input[type="date"]');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }

});
