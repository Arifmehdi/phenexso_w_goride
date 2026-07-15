@extends('admin.master')
@section('title')Admin | Support Tickets @endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-headset"></i> Support Tickets</h3>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills mb-3">
            @foreach(['all', 'open', 'in_progress', 'resolved', 'closed'] as $s)
                <li class="nav-item">
                    <a class="nav-link {{ request('status', 'all') == $s ? 'active' : '' }}"
                       href="{{ route('admin.ride-ops.tickets', ['status' => $s]) }}">
                        {{ ucfirst(str_replace('_', ' ', $s)) }}
                    </a>
                </li>
            @endforeach
        </ul>

        @if($tickets->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                        <tr><th>#</th><th>Subject</th><th>From</th><th>Category</th><th>Replies</th><th>Status</th><th>Created</th><th></th></tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td><strong>{{ $t->subject }}</strong></td>
                            <td>{{ ucfirst($t->owner_type) }} #{{ $t->user_id }}</td>
                            <td>{{ $t->category ?? 'general' }}</td>
                            <td>{{ $t->replies_count }}</td>
                            <td>
                                <span class="badge badge-{{ $t->status == 'open' ? 'warning' : ($t->status == 'resolved' ? 'success' : ($t->status == 'closed' ? 'secondary' : 'info')) }}">
                                    {{ str_replace('_', ' ', $t->status) }}
                                </span>
                            </td>
                            <td><small>{{ $t->created_at->format('d M Y H:i') }}</small></td>
                            <td>
                                <a href="{{ route('admin.ride-ops.tickets.show', $t->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-reply"></i> Open
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">{{ $tickets->links() }}</div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-check-circle fa-3x text-success"></i>
                <h5 class="mt-3 text-muted">No tickets in this list</h5>
            </div>
        @endif
    </div>
</div>
@endsection
