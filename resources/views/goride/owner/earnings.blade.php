@extends('goride.layouts.dashboard')

@section('title', 'My Earnings | Owner Dashboard')

@section('content')
    <div class="dashboard-header">
        <h2>Earnings Overview</h2>
        <button class="btn-primary" style="width: auto; padding: 10px 25px;">Withdraw Funds</button>
    </div>

    <div class="dash-grid">
        <div class="dash-card">
            <div class="icon" style="background: #dcfce7; color: #166534;"><i class="fas fa-wallet"></i></div>
            <h4>Available Balance</h4>
            <div class="value">৳ 4,250</div>
        </div>
        <div class="dash-card">
            <div class="icon" style="background: #e0f2fe; color: #0369a1;"><i class="fas fa-hand-holding-usd"></i></div>
            <h4>Total Earned</h4>
            <div class="value">৳ 12,450</div>
        </div>
        <div class="dash-card">
            <div class="icon" style="background: #fef9c3; color: #854d0e;"><i class="fas fa-clock"></i></div>
            <h4>Pending</h4>
            <div class="value">৳ 850</div>
        </div>
    </div>

    <h3 style="margin-bottom: 25px; font-size: 1.5rem;">Recent Transactions</h3>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>21 Mar 2026</td>
                    <td>Trip #TR-8820 Payment</td>
                    <td>৳ 1,200</td>
                    <td>Credit</td>
                    <td><span class="status-badge status-active">Settled</span></td>
                </tr>
                <tr>
                    <td>20 Mar 2026</td>
                    <td>Trip #TR-8815 Payment</td>
                    <td>৳ 2,500</td>
                    <td>Credit</td>
                    <td><span class="status-badge status-active">Settled</span></td>
                </tr>
                <tr>
                    <td>15 Mar 2026</td>
                    <td>Weekly Withdrawal</td>
                    <td>- ৳ 5,000</td>
                    <td>Debit</td>
                    <td><span class="status-badge status-active">Paid</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
