@extends('goride.layouts.dashboard')

@section('title', 'New Car Request | Corporate Dashboard')

@section('content')
    <div class="dashboard-header">
        <h2>Request a New Vehicle</h2>
        <p style="color: var(--text-light);">Submit a request for an additional car or microbus for your team.</p>
    </div>

    <div class="form-container" style="margin: 0; max-width: 800px;">
        <form id="newRequestForm" action="#" method="POST">
            @csrf
            <div class="form-grid-2col" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Service Type</label>
                    <select name="service_type" class="form-control">
                        <option>Office Pick/Drop</option>
                        <option>Executive Rental</option>
                        <option>Monthly Subscription</option>
                        <option>Event Support</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Vehicle Type</label>
                    <select name="vehicle_type" class="form-control">
                        <option>Sedan (Standard)</option>
                        <option>SUV (Premium)</option>
                        <option>Microbus (10-12 Seats)</option>
                        <option>Grand Cabin (14 Seats)</option>
                    </select>
                </div>
            </div>

            <div class="form-grid-2col" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Required From Date</label>
                    <input type="date" name="start_date" class="form-control">
                </div>
                <div class="form-group">
                    <label>Required For (Duration)</label>
                    <select name="duration" class="form-control">
                        <option>One Day</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                        <option>Indefinite (Subscription)</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Pickup Location</label>
                <input type="text" name="pickup_location" class="form-control" placeholder="Office address or specific point">
            </div>

            <div class="form-group">
                <label>Special Instructions</label>
                <textarea name="notes" class="form-control" rows="3" placeholder="e.g. Need a non-smoking driver, AC must be high-powered..."></textarea>
            </div>

            <button type="submit" class="btn-primary">Submit Request</button>
        </form>
    </div>
@endsection
