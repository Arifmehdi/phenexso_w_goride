@extends('goride.layouts.master')

@section('title', 'Set New Password | GoRide Bangladesh')

@section('content')
<div class="login-page-bg">
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ asset('goride/assets/go_ride_logo.jpg') }}" alt="GoRide Bangladesh">
            <h2>New Password</h2>
            <p>Please enter your new password below</p>
        </div>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="guard" value="{{ $guard ?? 'web' }}">
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" required readonly>
                @error('email')
                    <span style="color:#ef4444; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required autofocus>
                @error('password')
                    <span style="color:#ef4444; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-primary">Reset Password <i class="fas fa-key"></i></button>
        </form>
    </div>
</div>
@endsection
