@extends('goride.layouts.dashboard')

@section('title', 'My Trips | GoRide Bangladesh')

@section('content')
    <div class="dashboard-header">
        <h2>My Trip History</h2>
        <a href="{{ route('home') }}" class="btn-primary" style="width: auto; padding: 10px 25px; text-decoration: none; display: inline-block;">Book New Trip</a>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Pickup</th>
                    <th>Destination</th>
                    <th>Car Type</th>
                    <th>Fare</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-route" style="font-size: 2rem; display: block; margin-bottom: 10px; opacity: 0.5;"></i>
                        No trip history found.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
