@extends('admin.master')
@section('title')Admin | Rewards & Referrals @endsection
@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

{{-- ── Programme summary ─────────────────────────────────────────── --}}
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format($stats['total_referred']) }}</h3>
                <p>People joined by referral</p>
            </div>
            <div class="icon"><i class="fas fa-user-plus"></i></div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format($stats['total_credited']) }}</h3>
                <p>Bonuses credited (first ride done)</p>
            </div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>৳{{ number_format($stats['bonus_paid']) }}</h3>
                <p>Total bonus paid out</p>
            </div>
            <div class="icon"><i class="fas fa-coins"></i></div>
        </div>
    </div>
</div>

{{-- ── Settings ──────────────────────────────────────────────────── --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-sliders-h"></i> Rewards Settings</h3>
    </div>
    <form method="POST" action="{{ route('admin.ride-ops.rewards.save') }}">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label>৳ per 1 point</label>
                    <input type="number" step="0.01" min="1" name="taka_per_point"
                           class="form-control" value="{{ $settings['taka_per_point'] }}" required>
                    <small class="text-muted">
                        A rider/driver earns 1 point per this much completed fare.
                    </small>
                </div>
                <div class="col-md-4 form-group">
                    <label>Referral bonus (৳)</label>
                    <input type="number" step="0.01" min="0" name="referral_bonus"
                           class="form-control" value="{{ $settings['referral_bonus'] }}" required>
                    <small class="text-muted">
                        Paid to the person who invited. 0 = off.
                    </small>
                </div>
                <div class="col-md-4 form-group">
                    <label>Welcome bonus (৳)</label>
                    <input type="number" step="0.01" min="0" name="referee_bonus"
                           class="form-control" value="{{ $settings['referee_bonus'] }}" required>
                    <small class="text-muted">
                        Paid to the new user. 0 = off.
                    </small>
                </div>
            </div>
            <div class="alert alert-light border mb-0">
                <strong>How it works:</strong> both bonuses are paid once, automatically,
                when a referred user completes their <em>first</em> ride. Tiers are fixed:
                Bronze 0 &rarr; Silver 500 &rarr; Gold 2,000 &rarr; Platinum 5,000 points.
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </div>
    </form>
</div>

{{-- ── Leaderboard ───────────────────────────────────────────────── --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-trophy"></i> Top Referrers</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Mobile</th>
                    <th>Code</th>
                    <th class="text-right">People invited</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaders as $i => $l)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $l->name }}</td>
                        <td>
                            <span class="badge {{ $l->role === 'Driver' ? 'badge-primary' : 'badge-secondary' }}">
                                {{ $l->role }}
                            </span>
                        </td>
                        <td>{{ $l->mobile ?: '—' }}</td>
                        <td><code>{{ $l->code }}</code></td>
                        <td class="text-right"><strong>{{ $l->count }}</strong></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Nobody has invited anyone yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
