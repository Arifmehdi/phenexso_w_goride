@extends('admin.master')
@section('title')Admin | Ticket #{{ $ticket->id }} @endsection
@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">#{{ $ticket->id }} — {{ $ticket->subject }}</h3>
        <div class="card-tools">
            <form method="POST" action="{{ route('admin.ride-ops.tickets.status', $ticket->id) }}" class="d-inline">
                @csrf
                <select name="status" class="form-control-sm" onchange="this.form.submit()">
                    @foreach(['open', 'in_progress', 'resolved', 'closed'] as $s)
                        <option value="{{ $s }}" {{ $ticket->status == $s ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $s)) }}
                        </option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.ride-ops.tickets') }}" class="btn btn-sm btn-outline-secondary ml-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
    <div class="card-body">
        <p class="text-muted mb-1">
            From: <strong>{{ ucfirst($ticket->owner_type) }} #{{ $ticket->user_id }}</strong>
            • {{ $ticket->category ?? 'general' }} • {{ $ticket->created_at->format('d M Y H:i') }}
        </p>
        <div class="p-3 mb-3 bg-light rounded border">{{ $ticket->message }}</div>

        <h6 class="text-muted">Conversation</h6>
        @forelse($ticket->replies as $r)
            <div class="p-2 mb-2 rounded border {{ $r->sender_type == 'admin' ? 'bg-success-light text-right' : 'bg-light' }}"
                 style="{{ $r->sender_type == 'admin' ? 'background:#e8f5e9;' : '' }}">
                <small class="text-muted d-block">
                    {{ $r->sender_type == 'admin' ? 'Support (you)' : 'Customer' }} • {{ $r->created_at->format('d M H:i') }}
                </small>
                {{ $r->message }}
            </div>
        @empty
            <p class="text-muted"><small>No replies yet.</small></p>
        @endforelse

        <form method="POST" action="{{ route('admin.ride-ops.tickets.reply', $ticket->id) }}" class="mt-3">
            @csrf
            <div class="form-group">
                <textarea name="message" class="form-control" rows="3"
                          placeholder="Write a reply to the customer…" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-paper-plane"></i> Send Reply
            </button>
        </form>
    </div>
</div>
@endsection
