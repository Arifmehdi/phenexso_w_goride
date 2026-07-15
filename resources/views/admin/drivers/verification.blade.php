@extends('admin.master')
@section('title',"Driver Verification | ".$driver->name)

@section('body')
<section class="content py-4">
    <div class="container-fluid">

        @php
            $completion = $driver->profile_completion ?? 0;
            $vstatus    = $driver->verification_status ?? 'incomplete';
            $barColor   = $completion >= 100 ? 'bg-success' : ($completion >= 50 ? 'bg-warning' : 'bg-danger');
            $img = function($path) {
                return $path ? asset('storage/'.$path) : null;
            };
        @endphp

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="m-0">Rider Verification — {{ $driver->name }}</h4>
                    <a href="{{ route('admin.drivers.index') }}" class="btn btn-default btn-sm"><i class="fas fa-arrow-left"></i> Back to list</a>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Left: status + actions --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        @if($img($driver->profile_image))
                            <img src="{{ $img($driver->profile_image) }}" class="img-circle elevation-2" style="width:110px;height:110px;object-fit:cover;" alt="Profile">
                        @else
                            <div class="img-circle bg-light d-inline-flex align-items-center justify-content-center" style="width:110px;height:110px;">
                                <i class="fas fa-user fa-3x text-muted"></i>
                            </div>
                        @endif
                        <h5 class="mt-3 mb-0">{{ $driver->name }}</h5>
                        <p class="text-muted mb-2">{{ $driver->mobile }}</p>

                        <span class="badge badge-{{ ['incomplete'=>'secondary','pending'=>'warning','verified'=>'success','rejected'=>'danger'][$vstatus] ?? 'secondary' }} px-3 py-1">
                            {{ ucfirst($vstatus) }}
                        </span>

                        <div class="mt-3 text-left">
                            <small class="text-muted">Profile completion</small>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar {{ $barColor }}" style="width: {{ $completion }}%;">{{ $completion }}%</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Approve / Reject --}}
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Decision</h3></div>
                    <div class="card-body">
                        <button id="approveBtn" class="btn btn-success btn-block mb-2" data-url="{{ route('admin.drivers.toggle-status', $driver->id) }}">
                            <i class="fas fa-check-circle"></i> Approve Rider
                        </button>
                        <button id="rejectBtn" class="btn btn-outline-danger btn-block" data-url="{{ route('admin.drivers.toggle-status', $driver->id) }}">
                            <i class="fas fa-times-circle"></i> Set Inactive
                        </button>
                        @if($vstatus === 'rejected' && $driver->rejection_reason)
                            <div class="alert alert-danger mt-3 mb-0 py-2 px-3"><small>Reason: {{ $driver->rejection_reason }}</small></div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right: details --}}
            <div class="col-md-8">
                {{-- Personal --}}
                <div class="card">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-user-circle"></i> Personal Information</h3></div>
                    <div class="card-body">
                        <div class="row">
                            @foreach([
                                'Father Name' => $driver->father_name ?? null,
                                'Mother Name' => $driver->mother_name ?? null,
                                'Date of Birth' => $driver->dob ?? null,
                                'Blood Group' => $driver->blood_group ?? null,
                                'Present Address' => $driver->present_address ?? null,
                                'Permanent Address' => $driver->permanent_address ?? null,
                                'Emergency Contact' => trim(($driver->emergency_contact_name ?? '').' '.($driver->emergency_contact_phone ?? '')),
                            ] as $label => $val)
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">{{ $label }}</small>
                                    <strong>{{ $val ?: '—' }}</strong>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- NID --}}
                <div class="card">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-id-card"></i> National ID — {{ $driver->nid ?: 'Not provided' }}</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">NID Front</small>
                                @if($img($driver->nid_front_image ?? null))
                                    <a href="{{ $img($driver->nid_front_image) }}" target="_blank"><img src="{{ $img($driver->nid_front_image) }}" class="img-fluid border rounded" style="max-height:180px;"></a>
                                @else
                                    <div class="text-muted small border rounded p-4 text-center">Not uploaded</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">NID Back</small>
                                @if($img($driver->nid_back_image ?? null))
                                    <a href="{{ $img($driver->nid_back_image) }}" target="_blank"><img src="{{ $img($driver->nid_back_image) }}" class="img-fluid border rounded" style="max-height:180px;"></a>
                                @else
                                    <div class="text-muted small border rounded p-4 text-center">Not uploaded</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- License --}}
                <div class="card">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-car"></i> Driving License — {{ $driver->license_no ?: 'Not provided' }}</h3></div>
                    <div class="card-body">
                        <p class="mb-2"><small class="text-muted">Expiry:</small> <strong>{{ $driver->license_expiry ?? '—' }}</strong></p>
                        @if($img($driver->license_image ?? null))
                            <a href="{{ $img($driver->license_image) }}" target="_blank"><img src="{{ $img($driver->license_image) }}" class="img-fluid border rounded" style="max-height:200px;"></a>
                        @else
                            <div class="text-muted small border rounded p-4 text-center">License image not uploaded</div>
                        @endif
                    </div>
                </div>

                {{-- Vehicle --}}
                <div class="card">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-taxi"></i> Vehicle</h3></div>
                    <div class="card-body">
                        <div class="row">
                            @foreach([
                                'Type' => $driver->vehicle_type ?? null,
                                'Model' => $driver->vehicle_model ?? null,
                                'Plate' => $driver->vehicle_plate ?? null,
                                'Color' => $driver->vehicle_color ?? null,
                                'Year' => $driver->vehicle_year ?? null,
                            ] as $label => $val)
                                <div class="col-md-4 mb-2">
                                    <small class="text-muted d-block">{{ $label }}</small>
                                    <strong>{{ $val ?: '—' }}</strong>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
$(function () {
    function decide(approve, url) {
        if (approve) {
            Swal.fire({
                title: 'Approve this rider?',
                text: '{{ $driver->name }} will be able to go online and receive rides.',
                icon: 'question', showCancelButton: true,
                confirmButtonColor: '#10713C', confirmButtonText: 'Yes, approve'
            }).then(function (r) { if (r.isConfirmed) send(1, url); });
        } else {
            Swal.fire({
                title: 'Set rider inactive?',
                input: 'text', inputPlaceholder: 'Reason (optional)',
                icon: 'warning', showCancelButton: true,
                confirmButtonColor: '#ED1C24', confirmButtonText: 'Yes, set inactive'
            }).then(function (r) { if (r.isConfirmed) send(0, url, r.value); });
        }
    }
    function send(approve, url, reason) {
        $.ajax({
            url: url, method: 'POST',
            data: { _token: '{{ csrf_token() }}', approve: approve, reason: reason || '' },
            success: function (res) {
                if (res.success) {
                    Swal.fire({ icon: 'success', title: 'Done', text: res.message, timer: 1800, showConfirmButton: false })
                        .then(function () { location.reload(); });
                } else {
                    Swal.fire('Error', res.message || 'Failed.', 'error');
                }
            },
            error: function () { Swal.fire('Error', 'Something went wrong.', 'error'); }
        });
    }
    $('#approveBtn').on('click', function () { decide(true, $(this).data('url')); });
    $('#rejectBtn').on('click', function () { decide(false, $(this).data('url')); });
});
</script>
@endpush
