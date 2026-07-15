@extends('admin.master')
@section('title')Admin Dashboard | Pending Approvals @endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pending Approval Requests</h3>
        <div class="card-tools">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <div class="card-body">
        {{-- Filter Tabs --}}
        <div class="row mb-4">
            <div class="col-12">
                <ul class="nav nav-pills" id="approvalTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ request('type') == 'all' || !request('type') ? 'active' : '' }}" 
                           href="{{ route('admin.approvals.index', ['type' => 'all']) }}">
                            <i class="fas fa-users"></i> All Pending
                            <span class="badge badge-warning ml-1">{{ $stats['total_pending'] ?? 0 }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('type') == 'driver' ? 'active' : '' }}" 
                           href="{{ route('admin.approvals.index', ['type' => 'driver']) }}">
                            <i class="fas fa-motorcycle"></i> Riders
                            <span class="badge badge-info ml-1">{{ $stats['pending_drivers'] ?? 0 }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('type') == 'corporate' ? 'active' : '' }}" 
                           href="{{ route('admin.approvals.index', ['type' => 'corporate']) }}">
                            <i class="fas fa-building"></i> Corporate
                            <span class="badge badge-info ml-1">{{ $stats['pending_corporates'] ?? 0 }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="row mb-4">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $stats['total_pending'] ?? 0 }}</h3>
                        <p>Pending Approvals</p>
                    </div>
                    <div class="icon"><i class="fas fa-clock"></i></div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $stats['pending_drivers'] ?? 0 }}</h3>
                        <p>Pending Riders</p>
                    </div>
                    <div class="icon"><i class="fas fa-motorcycle"></i></div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $stats['pending_corporates'] ?? 0 }}</h3>
                        <p>Pending Corporates</p>
                    </div>
                    <div class="icon"><i class="fas fa-building"></i></div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $stats['active_drivers'] ?? 0 }}</h3>
                        <p>Active Riders</p>
                    </div>
                    <div class="icon"><i class="fas fa-check-circle"></i></div>
                </div>
            </div>
        </div>

        {{-- Users Table --}}
        @if($users->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Vehicle</th>
                            <th>Profile %</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $user->name }}</strong>
                                @if($user->company_name)
                                    <br><small class="text-muted">{{ $user->company_name }}</small>
                                @endif
                            </td>
                            <td>
                                {{ $user->email }}<br>
                                <small>{{ $user->mobile }}</small>
                            </td>
                            <td>
                                <span class="badge badge-{{ $user->role == 'driver' ? 'info' : 'primary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>{{ $user->vehicle_type ?? 'N/A' }}</td>
                            <td>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-{{ $user->profile_completion >= 70 ? 'success' : ($user->profile_completion >= 40 ? 'warning' : 'danger') }}" 
                                         role="progressbar" 
                                         style="width: {{ $user->profile_completion }}%"
                                         aria-valuenow="{{ $user->profile_completion }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small>{{ $user->profile_completion }}%</small>
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" 
                                            class="btn btn-success btn-sm" 
                                            onclick="approveUser({{ $user->id }}, '{{ $user->name }}')">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                    <button type="button" 
                                            class="btn btn-danger btn-sm" 
                                            onclick="rejectUser({{ $user->id }}, '{{ $user->name }}')">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                    @if($user->role == 'driver')
                                        <a href="{{ route('admin.drivers.edit', $user->id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-check-circle fa-4x text-success"></i>
                <h4 class="mt-3">All caught up!</h4>
                <p class="text-muted">There are no pending approval requests right now.</p>
            </div>
        @endif
    </div>
</div>

<script>
    // Approve/Reject post back to the named routes with CSRF via a
    // dynamically-built form (full page reload shows the flash message).
    function submitApproval(url, confirmText) {
        if (!confirm(confirmText)) return;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        var token = document.createElement('input');
        token.type = 'hidden';
        token.name = '_token';
        token.value = '{{ csrf_token() }}';
        form.appendChild(token);
        document.body.appendChild(form);
        form.submit();
    }

    function approveUser(id, name) {
        submitApproval(
            '{{ url('admin/users') }}/' + id + '/approve',
            'Approve "' + name + '"? They will be able to log in and use the platform.'
        );
    }

    function rejectUser(id, name) {
        submitApproval(
            '{{ url('admin/users') }}/' + id + '/reject',
            'Reject "' + name + '"? They will not be able to use the platform.'
        );
    }
</script>
@endsection
