@extends('goride.layouts.dashboard')

@section('title', 'My Profile | Owner Dashboard')

@section('content')
    <div class="dashboard-header">
        <h2>Account Profile</h2>
        <button type="submit" form="profileForm" class="btn-primary" style="width: auto; padding: 10px 25px;">Update Profile</button>
    </div>

    <div class="form-container" style="margin: 0; max-width: none;">
        <form id="profileForm" action="#" method="POST">
            @csrf
            <div class="form-grid-2col" style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="tel" class="form-control" value="{{ Auth::user()->mobile }}" disabled>
                    <small style="color: #64748b;">Mobile number cannot be changed once verified.</small>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="{{ Auth::user()->dob }}">
                </div>
                <div class="form-group">
                    <label>Present Address</label>
                    <textarea name="present_address" class="form-control" rows="2">{{ Auth::user()->present_address }}</textarea>
                </div>
                <div class="form-group">
                    <label>Short Bio</label>
                    <input type="text" name="short_bio" class="form-control" value="{{ Auth::user()->short_bio }}">
                </div>
            </div>
        </form>
    </div>
@endsection
