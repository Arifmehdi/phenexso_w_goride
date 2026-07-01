<table id="example1" class="table table-sm table-bordered table-striped text-nowrap">
    <thead>
    <tr>
        <th width="20">SL</th>
        <th width="90">Action</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>License No</th>
        <th>NID</th>
        <th width="160">Profile Completion</th>
        <th>Verification</th>
        <th width="120">Approve</th>
    </tr>
    </thead>
    <tbody>
        <?php $i = (($drivers->currentPage() - 1) * $drivers->perPage() + 1); ?>

        @foreach($drivers as $driver)
        @php
            $completion = $driver->profile_completion ?? 0;
            $vstatus    = $driver->verification_status ?? null;
            $barColor   = $completion >= 100 ? 'bg-success' : ($completion >= 50 ? 'bg-warning' : 'bg-danger');
            $vBadge     = [
                'incomplete' => 'secondary',
                'pending'    => 'warning',
                'verified'   => 'success',
                'rejected'   => 'danger',
            ][$vstatus] ?? 'secondary';
            $isApproved = $driver->status == 1;
        @endphp
        <tr>
            <td>{{$i++}}</td>
            <td>
                <div class="dropdown show">
                    <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink{{$driver->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink{{$driver->id}}">
                        <a class="dropdown-item" href="{{route('admin.drivers.verification',$driver->id)}}"><i class="fas fa-id-card"></i> View Documents</a>
                        <a class="dropdown-item" href="{{route('admin.drivers.edit',$driver->id)}}"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </td>
            <td>{{$driver->name}}</td>
            <td>{{$driver->mobile}}</td>
            <td>{{$driver->email ?: '—'}}</td>
            <td>{{$driver->license_no ?: '—'}}</td>
            <td>{{$driver->nid ?: '—'}}</td>
            <td>
                <div class="progress" style="height: 18px;">
                    <div class="progress-bar {{ $barColor }}" role="progressbar"
                         style="width: {{ $completion }}%;"
                         aria-valuenow="{{ $completion }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $completion }}%
                    </div>
                </div>
            </td>
            <td>
                <span class="badge badge-{{ $vBadge }}">{{ ucfirst($vstatus ?? 'incomplete') }}</span>
            </td>
            <td>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input driver-approve-switch"
                           id="approveSwitch{{$driver->id}}"
                           data-id="{{ $driver->id }}"
                           data-name="{{ $driver->name }}"
                           data-url="{{ route('admin.drivers.toggle-status', $driver->id) }}"
                           {{ $isApproved ? 'checked' : '' }}>
                    <label class="custom-control-label" for="approveSwitch{{$driver->id}}">
                        <span class="switch-label-text">{{ $isApproved ? 'Approved' : 'Inactive' }}</span>
                    </label>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $drivers->render() }}
