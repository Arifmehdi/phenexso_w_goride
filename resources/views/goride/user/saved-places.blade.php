@extends('goride.layouts.dashboard')

@section('title', 'Saved Places | GoRide Bangladesh')

@push('css')
    <style>
        .place-card {
            background: white;
            padding: 20px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            transition: var(--transition);
        }
        .place-card:hover {
            border-color: var(--primary);
            transform: translateX(5px);
        }
        .place-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .place-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-header">
        <h2>Saved Places</h2>
        <button class="btn-primary" style="width: auto; padding: 10px 25px;">+ Add New Place</button>
    </div>

    <div class="places-list">
        <div class="place-card">
            <div class="place-info">
                <div class="place-icon"><i class="fas fa-home"></i></div>
                <div>
                    <h4 style="margin:0;">Home</h4>
                    <p style="margin:0; font-size: 0.85rem; color: var(--text-light);">Mirpur 12, Block C, House 23</p>
                </div>
            </div>
            <a href="#" style="color: var(--danger);"><i class="fas fa-trash-alt"></i></a>
        </div>

        <div class="place-card">
            <div class="place-info">
                <div class="place-icon"><i class="fas fa-briefcase"></i></div>
                <div>
                    <h4 style="margin:0;">Office</h4>
                    <p style="margin:0; font-size: 0.85rem; color: var(--text-light);">Gulshan 1, Plot 45, Road 12</p>
                </div>
            </div>
            <a href="#" style="color: var(--danger);"><i class="fas fa-trash-alt"></i></a>
        </div>
    </div>
@endsection
