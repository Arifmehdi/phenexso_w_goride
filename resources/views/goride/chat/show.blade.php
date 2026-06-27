@extends('goride.layouts.dashboard')
@section('title', 'Chat | GoRide')
@section('content')
<div style="padding:20px;">
  <h3>Conversation #{{ $conversation->id }}</h3>
  <p style="color:#6b7280;">{{ $conversation->title ?? 'Private Chat' }}</p>
  <a href="{{ route('chat.index') }}" style="color:#10713C;text-decoration:none;font-weight:600;">
    <i class="fas fa-arrow-left"></i> Back to Messages
  </a>
</div>
@endsection
