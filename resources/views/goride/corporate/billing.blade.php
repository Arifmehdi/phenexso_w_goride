@extends('goride.layouts.dashboard')

@section('title', 'Billing & Invoices | Corporate Dashboard')

@section('content')
    <div class="dashboard-header">
        <h2>Billing & Invoices</h2>
        <div class="dash-card" style="padding: 15px 30px; margin-bottom: 0;">
            <h4 style="margin: 0;">Current Outstanding: <span style="color: #ef4444; font-size: 1.2rem;">৳ 45,200</span></h4>
        </div>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Billing Period</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: 600;">#INV-2026-031</td>
                    <td>01 Mar - 15 Mar 2026</td>
                    <td>৳ 22,500</td>
                    <td>25 Mar 2026</td>
                    <td><span class="status-badge status-unpaid">Unpaid</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;"><i class="fas fa-download"></i> PDF</a></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;">#INV-2026-030</td>
                    <td>15 Feb - 28 Feb 2026</td>
                    <td>৳ 22,700</td>
                    <td>10 Mar 2026</td>
                    <td><span class="status-badge status-unpaid">Unpaid</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;"><i class="fas fa-download"></i> PDF</a></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;">#INV-2026-029</td>
                    <td>01 Feb - 14 Feb 2026</td>
                    <td>৳ 18,300</td>
                    <td>20 Feb 2026</td>
                    <td><span class="status-badge status-active">Paid</span></td>
                    <td><a href="#" style="color: var(--primary-color); font-weight: 600;"><i class="fas fa-download"></i> PDF</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
