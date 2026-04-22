@extends('goride.layouts.dashboard')

@section('title', 'My Dashboard | GoRide Bangladesh')

@section('content')
    <div class="dashboard-header">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
        <a href="{{ route('home') }}" class="btn-primary" style="width: auto; padding: 10px 25px; text-decoration: none; display: inline-block;">Book a New Trip</a>
    </div>

    <div class="dash-grid">
        <div class="dash-card">
            <div class="icon" style="background: #e0f2fe; color: #0369a1;"><i class="fas fa-route"></i></div>
            <h4>Total Trips</h4>
            <div class="value">0</div>
        </div>
        <div class="dash-card">
            <div class="icon" style="background: #dcfce7; color: #166534;"><i class="fas fa-clock"></i></div>
            <h4>Active Bookings</h4>
            <div class="value">0</div>
        </div>
        <div class="dash-card">
            <div class="icon" style="background: #fef9c3; color: #854d0e;"><i class="fas fa-heart"></i></div>
            <h4>Saved Places</h4>
            <div class="value">0</div>
        </div>
    </div>

    <div class="section-title" style="text-align: left; margin-bottom: 25px;">
        <h3 style="font-size: 1.5rem;">My Recent Bookings</h3>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Destination</th>
                    <th>Car Type</th>
                    <th>Fare</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-info-circle"></i> No bookings found yet.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
