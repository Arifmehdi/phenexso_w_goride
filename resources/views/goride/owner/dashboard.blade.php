@extends('goride.layouts.dashboard')

@section('title', 'Owner/Driver Dashboard | GoRide Bangladesh')

@push('css')
    <style>
        .progress-container {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            margin-bottom: 40px;
            border: 1px solid #f1f5f9;
        }
        .progress-bar-bg {
            height: 12px;
            background: #f1f5f9;
            border-radius: 10px;
            margin: 15px 0;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            background: var(--primary-color);
            width: 40%;
            border-radius: 10px;
            transition: width 1s ease-in-out;
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-header">
        <h2>Driver Overview</h2>
        <div class="status-badge status-active">Online & Ready</div>
    </div>

    <div class="progress-container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h4 style="color: var(--text-color); font-weight: 700;">Complete Your Profile</h4>
            <span style="color: var(--primary-color); font-weight: 800;">40%</span>
        </div>
        <div class="progress-bar-bg">
            <div class="progress-bar-fill"></div>
        </div>
        <p style="font-size: 0.9rem; color: var(--text-light);">Upload your <strong>NID Front & Back</strong> to start receiving premium trips.</p>
        <button class="login-btn" style="margin-top: 15px; padding: 8px 20px; font-size: 14px;">Complete Profile</button>
    </div>

    <div class="dash-grid">
        <div class="dash-card">
            <div class="icon" style="background: #fef9c3; color: #854d0e;"><i class="fas fa-star"></i></div>
            <h4>Rating</h4>
            <div class="value">4.85</div>
        </div>
        <div class="dash-card">
            <div class="icon" style="background: #dcfce7; color: #166534;"><i class="fas fa-money-bill-wave"></i></div>
            <h4>Total Earnings</h4>
            <div class="value">৳ 12,450</div>
        </div>
        <div class="dash-card">
            <div class="icon" style="background: #e0f2fe; color: #0369a1;"><i class="fas fa-map-marker-alt"></i></div>
            <h4>Total Trips</h4>
            <div class="value">24</div>
        </div>
        <div class="dash-card">
            <div class="icon" style="background: #fee2e2; color: #991b1b;"><i class="fas fa-gas-pump"></i></div>
            <h4>Fuel Expense</h4>
            <div class="value">৳ 3,200</div>
        </div>
    </div>

    <div class="section-title" style="text-align: left; margin-bottom: 25px;">
        <h3 style="font-size: 1.5rem;">Recent Trips</h3>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Route</th>
                    <th>Client Type</th>
                    <th>Fare</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>21 Mar 2026</td>
                    <td>Gulshan to Airport</td>
                    <td>One-Time</td>
                    <td>৳ 1,200</td>
                    <td><span class="status-badge status-active">Completed</span></td>
                </tr>
                <tr>
                    <td>20 Mar 2026</td>
                    <td>Uttara (Hourly)</td>
                    <td>Corporate</td>
                    <td>৳ 2,500</td>
                    <td><span class="status-badge status-active">Completed</span></td>
                </tr>
                <tr>
                    <td>19 Mar 2026</td>
                    <td>Dhaka to Sylhet</td>
                    <td>Tours</td>
                    <td>৳ 8,000</td>
                    <td><span class="status-badge status-active">Completed</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
