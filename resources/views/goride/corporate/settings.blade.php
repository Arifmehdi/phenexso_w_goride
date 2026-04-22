@extends('goride.layouts.dashboard')

@section('title', 'Account Settings | Corporate Dashboard')

@section('content')
    <div class="dashboard-header">
        <h2>Account Settings</h2>
        <button type="submit" form="settingsForm" class="btn-primary" style="width: auto; padding: 10px 25px;">Save Changes</button>
    </div>

    <div class="form-container" style="margin: 0; max-width: none;">
        <form id="settingsForm" action="#" method="POST">
            @csrf
            <h3 style="margin-bottom: 25px; color: var(--primary-color);">Company Profile</h3>
            <div class="form-grid-2col" style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="company_name" class="form-control" value="Acme Corporation">
                </div>
                <div class="form-group">
                    <label>Tax ID (TIN)</label>
                    <input type="text" name="tin" class="form-control" value="123456789012">
                </div>
                <div class="form-group">
                    <label>Primary Contact Person</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                </div>
                <div class="form-group">
                    <label>Contact Designation</label>
                    <input type="text" name="designation" class="form-control" value="Operations Manager">
                </div>
                <div class="form-group">
                    <label>Official Email</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group">
                    <label>Notification Phone</label>
                    <input type="tel" name="mobile" class="form-control" value="{{ Auth::user()->mobile }}">
                </div>
            </div>
        </form>

        <h3 style="margin-bottom: 25px; color: var(--primary-color); margin-top: 40px;">Security</h3>
        <form action="#" method="POST" style="max-width: 400px;">
            @csrf
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-control" placeholder="••••••••">
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" placeholder="New password">
            </div>
            <button type="submit" class="btn-prev" style="padding: 10px 20px;">Change Password</button>
        </form>
    </div>
@endsection
