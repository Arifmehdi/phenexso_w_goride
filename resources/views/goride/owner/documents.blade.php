@extends('goride.layouts.dashboard')

@section('title', 'My Documents | Owner Dashboard')

@push('css')
    <style>
        .doc-card {
            background: white;
            padding: 25px;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            transition: 0.3s;
        }
        .doc-card:hover {
            border-color: var(--primary-color);
            transform: translateX(5px);
        }
        .doc-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .doc-icon {
            width: 50px;
            height: 50px;
            background: #f8fafc;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #64748b;
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-header">
        <h2>Document Verification</h2>
        <div class="status-badge status-pending">Verified Status</div>
    </div>

    <div class="doc-list">
        <div class="doc-card">
            <div class="doc-info">
                <div class="doc-icon"><i class="fas fa-id-card"></i></div>
                <div>
                    <h4 style="margin: 0;">NID (National ID)</h4>
                    <p style="font-size: 0.85rem; color: var(--text-light); margin: 0;">National Identification Document</p>
                </div>
            </div>
            @if(Auth::user()->nid)
                <span class="status-badge status-active"><i class="fas fa-check-circle"></i> Uploaded</span>
            @else
                <button class="login-btn" style="padding: 5px 15px; font-size: 0.85rem;">Upload Now</button>
            @endif
        </div>

        <div class="doc-card">
            <div class="doc-info">
                <div class="doc-icon"><i class="fas fa-address-card"></i></div>
                <div>
                    <h4 style="margin: 0;">Driving License</h4>
                    <p style="font-size: 0.85rem; color: var(--text-light); margin: 0;">License Number: {{ Auth::user()->license_no ?? 'Not Provided' }}</p>
                </div>
            </div>
            @if(Auth::user()->license_no)
                <span class="status-badge status-active"><i class="fas fa-check-circle"></i> Uploaded</span>
            @else
                <button class="login-btn" style="padding: 5px 15px; font-size: 0.85rem;">Upload Now</button>
            @endif
        </div>

        <div class="doc-card">
            <div class="doc-info">
                <div class="doc-icon"><i class="fas fa-file-invoice"></i></div>
                <div>
                    <h4 style="margin: 0;">Vehicle Tax Token</h4>
                    <p style="font-size: 0.85rem; color: var(--text-light); margin: 0;">Required for active fleet vehicles</p>
                </div>
            </div>
            <button class="login-btn" style="padding: 5px 15px; font-size: 0.85rem;">Upload Now</button>
        </div>

        <div class="doc-card">
            <div class="doc-info">
                <div class="doc-icon"><i class="fas fa-shield-alt"></i></div>
                <div>
                    <h4 style="margin: 0;">Insurance Documents</h4>
                    <p style="font-size: 0.85rem; color: var(--text-light); margin: 0;">Comprehensive coverage documents</p>
                </div>
            </div>
            <button class="login-btn" style="padding: 5px 15px; font-size: 0.85rem;">Upload Now</button>
        </div>
    </div>
@endsection
