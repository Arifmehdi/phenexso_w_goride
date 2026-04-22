@extends('goride.layouts.master')

@section('title', 'Corporate Registration | GoRide Bangladesh')

@section('content')
<div class="login-page-bg">
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ asset('goride/assets/go_ride_logo.jpg') }}" alt="GoRide Bangladesh">
            <h2>Corporate Account</h2>
            <p>Manage your company transport professionally</p>
        </div>

        <div class="login-tabs">
            <div class="login-tab" onclick="location.href='{{ route('registration') }}'">Customer</div>
            <div class="login-tab" onclick="location.href='{{ route('registration.driver') }}'">Driver / Owner</div>
            <div class="login-tab active" onclick="location.href='{{ route('registration.corporate') }}'">Corporate</div>
        </div>

        <form action="{{ route('main.register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company_name" class="form-control" placeholder="Enter company name" value="{{ old('company_name') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Contact Person Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter full name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label>Official Email</label>
                <input type="email" name="email" class="form-control" placeholder="company@email.com" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn-primary">Register Corporate Account <i class="fas fa-building"></i></button>
        </form>

        <div style="text-align:center;margin-top:28px;padding-top:24px;border-top:1px solid var(--border);">
            <p style="font-size:14px;color:var(--text-light);margin-bottom:14px;">Already have an account?</p>
            <a href="{{ route('login') }}" class="login-btn" style="display:inline-block; width:100%; text-align:center; background:var(--accent); color:var(--text); border:1.5px solid var(--border);">Back to Login</a>
        </div>
    </div>
</div>
@endsection
