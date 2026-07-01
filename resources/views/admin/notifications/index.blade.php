@extends('admin.master')
@section('title',"Admin Dashboard | Notifications")

@section('body')
<section class="content py-4">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Stat cards --}}
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="small-box bg-info"><div class="inner"><h3>{{ $stats['total'] }}</h3><p>Total Notifications</p></div><div class="icon"><i class="fas fa-bell"></i></div></div>
            </div>
            <div class="col-md-3 col-6">
                <div class="small-box bg-success"><div class="inner"><h3>{{ $stats['broadcasts'] }}</h3><p>Broadcasts</p></div><div class="icon"><i class="fas fa-bullhorn"></i></div></div>
            </div>
            <div class="col-md-3 col-6">
                <div class="small-box bg-warning"><div class="inner"><h3>{{ $stats['unread'] }}</h3><p>Unread</p></div><div class="icon"><i class="fas fa-envelope"></i></div></div>
            </div>
            <div class="col-md-3 col-6">
                <div class="small-box bg-secondary"><div class="inner"><h3>{{ $stats['today'] }}</h3><p>Sent Today</p></div><div class="icon"><i class="fas fa-calendar-day"></i></div></div>
            </div>
        </div>

        <div class="row">
            {{-- Compose --}}
            <div class="col-md-4">
                <div class="card card-success">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-bullhorn"></i> Send Notification</h3></div>
                    <form action="{{ route('admin.notifications.send') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Send To <span class="text-danger">*</span></label>
                                <select name="target" class="form-control" required>
                                    <option value="all_users">All Customers (Passengers)</option>
                                    <option value="all_drivers">All Riders (Drivers)</option>
                                    <option value="all_corporates">All Corporates</option>
                                    <option value="all_admins">All Admins</option>
                                    <option value="everyone">Everyone</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" maxlength="255" placeholder="e.g. Eid Special Offer!">
                                @error('title')<p class="text-danger small">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea name="message" class="form-control" rows="4" maxlength="1000"
                                          placeholder="Write your announcement...">{{ old('message') }}</textarea>
                            </div>
                            <div class="alert alert-info py-2 px-3 mb-0">
                                <small><i class="fas fa-info-circle"></i> Saved to the in-app inbox <strong>and</strong> sent as a push notification.</small>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Send Now</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Management list --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manage Notifications</h3>
                        <div class="card-tools">
                            <form method="GET" class="form-inline">
                                <select name="scope" class="form-control form-control-sm mr-1" onchange="this.form.submit()">
                                    <option value="broadcast" {{ $scope=='broadcast'?'selected':'' }}>Broadcasts</option>
                                    <option value="all" {{ $scope=='all'?'selected':'' }}>All Notifications</option>
                                </select>
                                <select name="audience" class="form-control form-control-sm mr-1" onchange="this.form.submit()">
                                    <option value="">All Audiences</option>
                                    <option value="all" {{ request('audience')=='all'?'selected':'' }}>Everyone</option>
                                    <option value="user" {{ request('audience')=='user'?'selected':'' }}>Customers</option>
                                    <option value="driver" {{ request('audience')=='driver'?'selected':'' }}>Riders</option>
                                    <option value="corporate" {{ request('audience')=='corporate'?'selected':'' }}>Corporates</option>
                                    <option value="admin" {{ request('audience')=='admin'?'selected':'' }}>Admins</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Audience</th>
                                    <th>Title / Type</th>
                                    <th>Status</th>
                                    <th>Sent</th>
                                    <th width="50"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $n)
                                    <tr>
                                        <td>
                                            <span class="badge badge-{{ ['all'=>'primary','driver'=>'warning','user'=>'info','corporate'=>'dark','admin'=>'danger'][$n->recipient_type] ?? 'secondary' }}">
                                                {{ ['all'=>'Everyone','driver'=>'Riders','user'=>'Customers','corporate'=>'Corporates','admin'=>'Admins'][$n->recipient_type] ?? ucfirst($n->recipient_type ?? '—') }}
                                            </span>
                                            @if(!$n->all_show)<br><small class="text-muted">#{{ $n->user_id }}</small>@endif
                                        </td>
                                        <td>
                                            <strong>{{ $n->title }}</strong>
                                            @if($n->message)<br><small class="text-muted">{{ Str::limit($n->message, 45) }}</small>@endif
                                            @if($n->type)<br><span class="badge badge-light">{{ $n->type }}</span>@endif
                                        </td>
                                        <td>
                                            @if($n->all_show)
                                                <span class="badge badge-success">Broadcast</span>
                                            @elseif($n->is_read)
                                                <span class="badge badge-secondary">Read</span>
                                            @else
                                                <span class="badge badge-warning">Unread</span>
                                            @endif
                                        </td>
                                        <td><small>{{ $n->created_at?->diffForHumans() }}</small></td>
                                        <td>
                                            <form action="{{ route('admin.notifications.destroy', $n->id) }}" method="POST" onsubmit="return confirm('Delete this notification?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-xs btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted py-4">No notifications found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($notifications->hasPages())
                        <div class="card-footer">{{ $notifications->render() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
