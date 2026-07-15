@extends('admin.master')
@section('title')Admin | Surge Pricing @endsection
@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-bolt text-warning"></i> Surge Zones</h3></div>
            <div class="card-body">
                @if($zones->count() > 0)
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr><th>Name</th><th>Center</th><th>Radius</th><th>Multiplier</th><th>Status</th><th></th></tr>
                        </thead>
                        <tbody>
                            @foreach($zones as $z)
                            <tr>
                                <td><strong>{{ $z->name }}</strong></td>
                                <td><small>{{ $z->center_lat }}, {{ $z->center_lng }}</small></td>
                                <td>{{ $z->radius_km }} km</td>
                                <td><span class="badge badge-warning">{{ number_format((float) $z->multiplier, 1) }}x</span></td>
                                <td>
                                    <span class="badge badge-{{ $z->is_active ? 'success' : 'secondary' }}">
                                        {{ $z->is_active ? 'Active' : 'Off' }}
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin.ride-ops.surge.toggle', $z->id) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-{{ $z->is_active ? 'outline-secondary' : 'success' }}">
                                            {{ $z->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted text-center py-4">No surge zones yet — create one on the right.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">New Surge Zone</h3></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.ride-ops.surge.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Zone name</label>
                        <input name="name" class="form-control" placeholder="e.g. Gulshan" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Center latitude</label>
                            <input name="center_lat" type="number" step="any" class="form-control" placeholder="23.7808" required>
                        </div>
                        <div class="form-group col">
                            <label>Center longitude</label>
                            <input name="center_lng" type="number" step="any" class="form-control" placeholder="90.4172" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Radius (km)</label>
                            <input name="radius_km" type="number" class="form-control" value="3" min="1" max="50">
                        </div>
                        <div class="form-group col">
                            <label>Multiplier</label>
                            <input name="multiplier" type="number" step="0.1" class="form-control" value="1.5" min="1" max="5" required>
                        </div>
                    </div>
                    <button class="btn btn-warning btn-block"><i class="fas fa-bolt"></i> Create &amp; Activate</button>
                </form>
                @if($errors->any())
                    <div class="alert alert-danger mt-3 mb-0"><small>{{ $errors->first() }}</small></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
