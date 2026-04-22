@extends('goride.layouts.master')

@section('title', 'Login | GoRide Bangladesh')

@section('content')
<div class="login-page-bg">
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ asset('goride/assets/go_ride_logo.jpg') }}" alt="GoRide Bangladesh">
            <h2>Welcome Back</h2>
            <p>Sign in to your GoRide account</p>
        </div>

        @if(session('error'))
            <div style="background:#fee2e2; border:1px solid #ef4444; color:#b91c1c; padding:12px; border-radius:12px; margin-bottom:20px; font-size:14px; text-align:center;">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#fee2e2; border:1px solid #ef4444; color:#b91c1c; padding:12px; border-radius:12px; margin-bottom:20px; font-size:14px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-tabs">
            <div class="login-tab active">Customer</div>
            <div class="login-tab" onclick="location.href='{{ route('registration.driver') }}'">Driver / Owner</div>
            <div class="login-tab" onclick="location.href='{{ route('registration.corporate') }}'">Corporate</div>
        </div>

        {{-- ADDED ID HERE --}}
        <form action="{{ route('login.user') }}" method="POST" id="loginForm">
            @csrf
            <div class="form-group">
                <label>Email or Mobile Number</label>
                <input type="text" name="login" class="form-control" placeholder="017XXXXXXXX or example@email.com" value="{{ old('login') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;font-size:14px;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:400;color:var(--text-mid);">
                    <input type="checkbox" name="remember" style="width:16px;height:16px;" {{ old('remember') ? 'checked' : '' }}> Remember me
                </label>
                <a href="#" style="color:var(--primary);font-weight:700;">Forgot Password?</a>
            </div>
            <input type="submit" class="btn-primary" value="Login Now">
        </form>

        <div style="text-align:center;margin-top:28px;padding-top:24px;border-top:1px solid var(--border);">
            <p style="font-size:14px;color:var(--text-light);margin-bottom:14px;">Don't have an account?</p>
            <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('registration.driver') }}" style="display:flex;align-items:center;gap:7px;background:var(--primary-light);color:var(--primary);padding:10px 18px;border-radius:50px;font-family:'Sora',sans-serif;font-size:13px;font-weight:700;"><i class="fas fa-car"></i> Join as Driver</a>
                <a href="{{ route('registration.corporate') }}" style="display:flex;align-items:center;gap:7px;background:var(--accent);color:var(--text);padding:10px 18px;border-radius:50px;font-family:'Sora',sans-serif;font-size:13px;font-weight:700;border:1.5px solid var(--border);"><i class="fas fa-building"></i> Corporate</a>
            </div>
        </div>

        <div style="margin-top:24px;padding:18px;background:var(--accent);border-radius:12px;text-align:center;">
            <p style="font-size:13px;color:var(--text-light);margin-bottom:10px;">Also available on mobile</p>
            <div style="display:flex;gap:10px;justify-content:center;">
                <a href="#" style="display:flex;align-items:center;gap:7px;background:var(--primary);color:white;padding:9px 16px;border-radius:8px;font-family:'Sora',sans-serif;font-size:12px;font-weight:700;"><i class="fab fa-apple"></i> App Store</a>
                <a href="#" style="display:flex;align-items:center;gap:7px;background:var(--text);color:white;padding:9px 16px;border-radius:8px;font-family:'Sora',sans-serif;font-size:12px;font-weight:700;"><i class="fab fa-google-play"></i> Google Play</a>
            </div>
        </div>
    </div>
</div>

{{-- DEBUG SCRIPT --}}
<script>
    // Check if form exists before adding event listener
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e){
            console.log('FORM SUBMIT TRIGGERED');
        });
    } else {
        console.error('Login form not found!');
    }
</script>

@endsection