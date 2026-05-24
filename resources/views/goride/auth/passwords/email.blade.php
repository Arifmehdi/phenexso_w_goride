@extends('goride.layouts.master')

@section('title', 'Reset Password | GoRide Bangladesh')

@section('content')
<div class="login-page-bg">
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ asset('goride/assets/go_ride_logo.jpg') }}" alt="GoRide Bangladesh">
            <h2>Reset Password</h2>
            <p>Enter your email to receive a password reset link</p>
        </div>

        @if (session('status'))
            <div style="background:#dcfce7; border:1px solid #16a34a; color:#166534; padding:12px; border-radius:12px; margin-bottom:20px; font-size:14px; text-align:center;">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <input type="hidden" name="guard" value="{{ $guard ?? 'web' }}">
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="example@email.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span style="color:#ef4444; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Send Reset Link <i class="fas fa-paper-plane"></i></button>
        </form>

        <div style="text-align:center;margin-top:28px;padding-top:24px;border-top:1px solid var(--border);">
            <p style="font-size:14px;color:var(--text-light);"><a href="{{ route('login') }}"><b>Back to Login</b></a></p>
        </div>
    </div>
</div>
@endsection
