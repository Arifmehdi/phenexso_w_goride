@extends('goride.layouts.dashboard')

@section('title', 'My Cars | Owner Dashboard')

@section('content')
    <div class="dashboard-header">
        <h2>My Vehicles</h2>
        <button class="btn-primary" style="width: auto; padding: 10px 25px;">+ Add New Car</button>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Vehicle Model</th>
                    <th>Reg. Number</th>
                    <th>Assigned Driver</th>
                    <th>Current Status</th>
                    <th>Documents</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: 600;">Toyota Noah 2019</td>
                    <td>DHK-METRO-KA-1234</td>
                    <td>Self</td>
                    <td><span class="status-badge status-active">Active</span></td>
                    <td><span style="color: #10b981;"><i class="fas fa-check-circle"></i> Complete</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;">Edit</a></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;">Toyota Axio 2017</td>
                    <td>DHK-METRO-GA-8890</td>
                    <td>Karimullah</td>
                    <td><span class="status-badge status-pending">In Review</span></td>
                    <td><span style="color: #ef4444;"><i class="fas fa-clock"></i> Pending</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;">Edit</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
