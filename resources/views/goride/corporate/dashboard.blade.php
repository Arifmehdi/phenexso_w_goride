@extends('goride.layouts.dashboard')

@section('title', 'Corporate Dashboard | GoRide Bangladesh')

@section('content')
    <div class="dashboard-header">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
        <a href="{{ route('corporate.new-request') }}" class="btn-primary" style="width: auto; padding: 10px 25px; text-decoration: none; display: inline-block;">+ Request New Car</a>
    </div>

    <div class="dash-grid">
        <div class="dash-card">
            <div class="icon" style="background: #e0f2fe; color: #0369a1;"><i class="fas fa-car"></i></div>
            <h4>Active Cars</h4>
            <div class="value">08</div>
        </div>
        <div class="dash-card">
            <div class="icon" style="background: #dcfce7; color: #166534;"><i class="fas fa-calendar-check"></i></div>
            <h4>Ongoing Trips</h4>
            <div class="value">03</div>
        </div>
        <div class="dash-card">
            <div class="icon" style="background: #fef9c3; color: #854d0e;"><i class="fas fa-clock"></i></div>
            <h4>Pending Requests</h4>
            <div class="value">02</div>
        </div>
        <div class="dash-card">
            <div class="icon" style="background: #fee2e2; color: #991b1b;"><i class="fas fa-exclamation-circle"></i></div>
            <h4>Due Invoices</h4>
            <div class="value">৳ 45,200</div>
        </div>
    </div>

    <div class="section-title" style="text-align: left; margin-bottom: 25px;">
        <h3 style="font-size: 1.5rem;">Current Car Assignments</h3>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Car Model</th>
                    <th>Reg. Number</th>
                    <th>Driver Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Toyota Noah 2019</td>
                    <td>DHK-METRO-KA-1234</td>
                    <td>Abdul Karim</td>
                    <td><span class="status-badge status-active">On Duty</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;">Track</a></td>
                </tr>
                <tr>
                    <td>Toyota Allion 2018</td>
                    <td>DHK-METRO-GA-5678</td>
                    <td>Rahat Hossain</td>
                    <td><span class="status-badge status-active">On Duty</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;">Track</a></td>
                </tr>
                <tr>
                    <td>Toyota Hiace 2020</td>
                    <td>DHK-METRO-CHA-9012</td>
                    <td>Sumon Ahmed</td>
                    <td><span class="status-badge status-pending">Idle</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;">Details</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
