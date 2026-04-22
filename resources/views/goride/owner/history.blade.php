@extends('goride.layouts.dashboard')

@section('title', 'Trip History | Owner Dashboard')

@section('content')
    <div class="dashboard-header">
        <h2>Your Trip History</h2>
        <div style="display: flex; gap: 10px;">
            <select class="form-control" style="width: 150px; padding: 8px;">
                <option>All Time</option>
                <option>Last 7 Days</option>
                <option>This Month</option>
            </select>
        </div>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Pickup</th>
                    <th>Destination</th>
                    <th>Car</th>
                    <th>Fare</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>21 Mar 2026</td>
                    <td>Gulshan 1</td>
                    <td>Airport Terminal 2</td>
                    <td>Toyota Noah</td>
                    <td>৳ 1,200</td>
                    <td><span class="status-badge status-active">Completed</span></td>
                </tr>
                <tr>
                    <td>20 Mar 2026</td>
                    <td>Banani</td>
                    <td>Dhanmondi 27</td>
                    <td>Toyota Axio</td>
                    <td>৳ 800</td>
                    <td><span class="status-badge status-active">Completed</span></td>
                </tr>
                <tr>
                    <td>19 Mar 2026</td>
                    <td>Dhaka</td>
                    <td>Sylhet City</td>
                    <td>Toyota Noah</td>
                    <td>৳ 8,500</td>
                    <td><span class="status-badge status-active">Completed</span></td>
                </tr>
                <tr>
                    <td>18 Mar 2026</td>
                    <td>Uttara</td>
                    <td>Gazipur</td>
                    <td>Toyota Hiace</td>
                    <td>৳ 2,500</td>
                    <td><span class="status-badge status-active">Completed</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
