@extends('goride.layouts.dashboard')
@section('title', 'Notifications | GoRide')

@section('content')
<div style="max-width: 760px; margin: 0 auto; padding: 24px 16px;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="margin:0; font-size:22px; color:var(--text-color);">
            <i class="fas fa-bell" style="color:var(--primary-color); margin-right:8px;"></i> Notifications
        </h2>
        @if($notifications->total() > 0)
            <form action="{{ route('user.notifications.read-all') }}" method="POST">
                @csrf
                <button type="submit" style="background:none; border:1px solid var(--primary-color); color:var(--primary-color); padding:6px 14px; border-radius:20px; cursor:pointer; font-size:13px;">
                    Mark all read
                </button>
            </form>
        @endif
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9; color:#2e7d32; padding:10px 14px; border-radius:10px; margin-bottom:16px; font-size:14px;">{{ session('success') }}</div>
    @endif

    @forelse($notifications as $n)
        @php
            $isUnread = !$n->all_show && !$n->is_read;
            $icon = [
                'ride_request'    => 'fa-car',
                'account_approved'=> 'fa-check-circle',
                'account_inactive'=> 'fa-ban',
                'payment'         => 'fa-wallet',
                'promo'           => 'fa-tag',
                'announcement'    => 'fa-bullhorn',
            ][$n->type] ?? 'fa-bell';
            $color = $n->type === 'account_approved' ? '#2e7d32' : ($n->type === 'account_inactive' ? '#c62828' : 'var(--primary-color)');
        @endphp
        <div style="display:flex; gap:14px; background:{{ $isUnread ? '#f1f8f4' : '#fff' }}; border:1px solid {{ $isUnread ? 'var(--primary-color)' : '#eee' }}; border-radius:14px; padding:16px; margin-bottom:12px;">
            <div style="flex-shrink:0; width:42px; height:42px; border-radius:10px; background:rgba(16,113,60,0.1); display:flex; align-items:center; justify-content:center;">
                <i class="fas {{ $icon }}" style="color:{{ $color }};"></i>
            </div>
            <div style="flex:1;">
                <div style="display:flex; justify-content:space-between; align-items:start;">
                    <strong style="font-size:15px; color:var(--text-color);">{{ $n->title }}</strong>
                    @if($n->all_show)
                        <span style="font-size:10px; background:#eee; color:#666; padding:2px 8px; border-radius:10px;">Broadcast</span>
                    @elseif($isUnread)
                        <span style="width:9px; height:9px; background:var(--primary-color); border-radius:50%; display:inline-block; margin-top:5px;"></span>
                    @endif
                </div>
                @if($n->message)
                    <p style="margin:4px 0 0; font-size:14px; color:#666; line-height:1.4;">{{ $n->message }}</p>
                @endif
                <div style="margin-top:8px; display:flex; justify-content:space-between; align-items:center;">
                    <small style="color:#999;">{{ $n->created_at?->diffForHumans() }}</small>
                    @if($isUnread)
                        <form action="{{ route('user.notifications.read', $n->id) }}" method="POST">
                            @csrf
                            <button type="submit" style="background:none; border:none; color:var(--primary-color); cursor:pointer; font-size:12px;">Mark read</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div style="text-align:center; padding:60px 20px; color:#999;">
            <i class="fas fa-bell-slash" style="font-size:48px; opacity:0.3;"></i>
            <p style="margin-top:16px; font-size:16px;">No notifications yet</p>
        </div>
    @endforelse

    <div style="margin-top:16px;">{{ $notifications->links() }}</div>
</div>
@endsection
