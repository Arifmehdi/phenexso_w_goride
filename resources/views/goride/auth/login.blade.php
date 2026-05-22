@extends('goride.layouts.master')

@section('title', 'Sign In | GoRide Bangladesh')

@push('css')
<style>
    :root {
        --auth-bg: #fdfdfd;
        --auth-card: #ffffff;
        --auth-text: #1e293b;
        --auth-muted: #64748b;
        --auth-primary: #1A7A3C;
        --auth-border: #f1f5f9;
        --auth-input-bg: #f8fafc;
    }

    .auth-page {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--auth-bg);
        padding: 40px 20px;
    }

    .auth-card {
        width: 100%;
        max-width: 400px;
        background: var(--auth-card);
        padding: 0;
        /* Deep, soft shadow for modern look */
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.035);
        border-radius: 32px;
        border: 1px solid var(--auth-border);
        overflow: hidden;
    }

    .auth-body {
        padding: 48px 40px;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .auth-header img {
        height: 48px;
        margin-bottom: 24px;
        /* filter: grayscale(1) opacity(0.8); subtle touch */
    }

    .auth-header h1 {
        font-family: 'Sora', sans-serif;
        font-size: 22px;
        font-weight: 800;
        color: var(--auth-text);
        letter-spacing: -0.02em;
    }

    .auth-header p {
        font-size: 14px;
        color: var(--auth-muted);
        margin-top: 6px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: var(--auth-text);
        margin-bottom: 8px;
        padding-left: 4px;
    }

    .input-control {
        width: 100%;
        height: 54px;
        padding: 0 20px;
        background: var(--auth-input-bg);
        border: 1.5px solid transparent;
        border-radius: 16px;
        font-size: 15px;
        font-weight: 500;
        color: var(--auth-text);
        transition: all 0.2s ease;
        outline: none;
    }

    .input-control:focus {
        background: #fff;
        border-color: var(--auth-primary);
        box-shadow: 0 0 0 4px rgba(26, 122, 60, 0.08);
    }

    /* Modern Dropdown Styling */
    select.input-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5' /%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        background-size: 16px;
        cursor: pointer;
    }

    .btn-submit {
        width: 100%;
        height: 56px;
        background: var(--auth-primary);
        color: #fff;
        border: none;
        border-radius: 18px;
        font-family: 'Sora', sans-serif;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-top: 8px;
        box-shadow: 0 10px 15px -3px rgba(26, 122, 60, 0.2);
    }

    .btn-submit:hover {
        background: #145e2e;
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(26, 122, 60, 0.25);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .auth-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: -8px;
        margin-bottom: 32px;
        padding: 0 4px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 13px;
        color: var(--auth-muted);
        user-select: none;
    }

    .remember-me input {
        width: 18px;
        height: 18px;
        border-radius: 6px;
        accent-color: var(--auth-primary);
        cursor: pointer;
    }

    .forgot-link {
        font-size: 13px;
        color: var(--auth-primary);
        font-weight: 700;
        text-decoration: none;
    }

    .auth-footer {
        text-align: center;
        margin-top: 40px;
        padding-top: 32px;
        border-top: 1px solid var(--auth-border);
    }

    .auth-footer p {
        font-size: 14px;
        color: var(--auth-muted);
    }

    .auth-footer a {
        color: var(--auth-text);
        font-weight: 700;
        text-decoration: none;
        margin-left: 4px;
        transition: color 0.2s;
    }

    .auth-footer a:hover {
        color: var(--auth-primary);
    }

    .alert {
        padding: 14px 20px;
        border-radius: 16px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 32px;
        text-align: center;
    }

    .alert-danger {
        background: #fff1f2;
        color: #e11d48;
        border: 1px solid #ffe4e6;
    }

    @media (max-width: 480px) {
        .auth-card {
            border-radius: 24px;
        }
        .auth-body {
            padding: 40px 24px;
        }
    }
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-body">
            <div class="auth-header">
                <img src="{{ asset('goride/assets/go_ride_logo.jpg') }}" alt="GoRide">
                <h1>Sign In</h1>
                <p>Welcome back to GoRide Bangladesh</p>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.user') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Account Type</label>
                    <select name="guard" class="input-control">
                        <option value="web" {{ ($guard ?? 'web') === 'web' ? 'selected' : '' }}>Customer Account</option>
                        <option value="driver" {{ ($guard ?? '') === 'driver' ? 'selected' : '' }}>Driver Account</option>
                        <option value="corporate" {{ ($guard ?? '') === 'corporate' ? 'selected' : '' }}>Corporate Account</option>
                        <option value="admin" {{ ($guard ?? '') === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Email or Mobile</label>
                    <input type="text" name="login" class="input-control" placeholder="e.g. 017XXXXXXXX" value="{{ old('login') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="input-control" placeholder="••••••••" required>
                </div>

                <div class="auth-meta">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Keep me signed in
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot?</a>
                </div>

                <button type="submit" class="btn-submit">
                    Sign In
                </button>
            </form>

            <div class="auth-footer">
                <p>Don't have an account? <a href="{{ route('registration') }}">Create one</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
