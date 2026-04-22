@extends('goride.layouts.dashboard')

@section('title', 'My Fleet | Corporate Dashboard')

@section('content')
    <div class="dashboard-header">
        <h2>Manage Your Fleet</h2>
        <div style="display: flex; gap: 10px;">
            <input type="text" class="form-control" placeholder="Search car or driver..." style="width: 250px; padding: 8px 15px;">
            <button class="btn-primary" style="width: auto; padding: 8px 20px;">Filter</button>
        </div>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Reg. Number</th>
                    <th>Driver</th>
                    <th>Contact</th>
                    <th>Service Area</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: 600;">Toyota Noah 2019</td>
                    <td>DHK-METRO-KA-1234</td>
                    <td>Abdul Karim</td>
                    <td>01711223344</td>
                    <td>Dhaka Metro</td>
                    <td><span class="status-badge status-active">Active</span></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;">Toyota Allion 2018</td>
                    <td>DHK-METRO-GA-5678</td>
                    <td>Rahat Hossain</td>
                    <td>01822334455</td>
                    <td>Dhaka Metro</td>
                    <td><span class="status-badge status-active">Active</span></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;">Toyota Hiace 2020</td>
                    <td>DHK-METRO-CHA-9012</td>
                    <td>Sumon Ahmed</td>
                    <td>01933445566</td>
                    <td>Nationwide</td>
                    <td><span class="status-badge status-pending">Idle</span></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;">Toyota Premio 2021</td>
                    <td>DHK-METRO-KHA-1122</td>
                    <td>Zakir Hossain</td>
                    <td>01744556677</td>
                    <td>Dhaka Metro</td>
                    <td><span class="status-badge status-active">Active</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
