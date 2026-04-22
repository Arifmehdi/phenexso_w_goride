@extends('goride.layouts.dashboard')

@section('title', 'Request History | Corporate Dashboard')

@section('content')
    <div class="dashboard-header">
        <h2>Request & Trip History</h2>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Request Type</th>
                    <th>Vehicle Type</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>15 Mar 2026</td>
                    <td>Monthly Subscription</td>
                    <td>Sedan</td>
                    <td>30 Days</td>
                    <td><span class="status-badge status-active">Approved</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;">View</a></td>
                </tr>
                <tr>
                    <td>10 Mar 2026</td>
                    <td>Airport Pick/Drop</td>
                    <td>Microbus</td>
                    <td>One Way</td>
                    <td><span class="status-badge status-active">Completed</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;">View</a></td>
                </tr>
                <tr>
                    <td>05 Mar 2026</td>
                    <td>Event Support</td>
                    <td>Grand Cabin</td>
                    <td>2 Days</td>
                    <td><span class="status-badge status-active">Completed</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;">View</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
