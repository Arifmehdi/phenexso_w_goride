@php
    // $driver is null on create, the model on edit
    $d = $driver ?? null;
    $val = fn($field, $default = '') => old($field, $d?->{$field} ?? $default);
    $imgUrl = fn($field) => ($d && $d->{$field}) ? asset('storage/'.$d->{$field}) : null;
    $bloodGroups = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];
    $vehicleTypes = ['car','motor','cng','ambulance'];
@endphp

{{-- ── Account ── --}}
<div class="card">
    <div class="card-header bg-light"><strong><i class="fas fa-user-circle text-success"></i> Account</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $val('name') }}" placeholder="Full name">
                @error('name')<p class="text-danger small">{{ $message }}</p>@enderror
            </div>
            <div class="col-md-6 form-group">
                <label>Mobile <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $val('mobile') }}" placeholder="01XXXXXXXXX">
                @error('mobile')<p class="text-danger small">{{ $message }}</p>@enderror
            </div>
            <div class="col-md-6 form-group">
                <label>Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $val('email') }}" placeholder="email@example.com">
                @error('email')<p class="text-danger small">{{ $message }}</p>@enderror
            </div>
            <div class="col-md-3 form-group">
                <label>Password {{ isset($driver) ? '(blank = keep)' : '' }} @if(!isset($driver))<span class="text-danger">*</span>@endif</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" {{ isset($driver) ? '' : 'required' }}>
                @error('password')<p class="text-danger small">{{ $message }}</p>@enderror
            </div>
            <div class="col-md-3 form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm" {{ isset($driver) ? '' : 'required' }}>
            </div>
        </div>
    </div>
</div>

{{-- ── Personal ── --}}
<div class="card">
    <div class="card-header bg-light"><strong><i class="fas fa-id-badge text-success"></i> Personal Information</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Father's Name</label>
                <input type="text" class="form-control" name="father_name" value="{{ $val('father_name') }}">
            </div>
            <div class="col-md-6 form-group">
                <label>Mother's Name</label>
                <input type="text" class="form-control" name="mother_name" value="{{ $val('mother_name') }}">
            </div>
            <div class="col-md-4 form-group">
                <label>Date of Birth</label>
                <input type="date" class="form-control" name="dob" value="{{ $val('dob') }}">
            </div>
            <div class="col-md-4 form-group">
                <label>Blood Group</label>
                <select name="blood_group" class="form-control">
                    <option value="">Select</option>
                    @foreach($bloodGroups as $bg)
                        <option value="{{ $bg }}" {{ $val('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-group">
                <label>Present Address</label>
                <textarea name="present_address" rows="2" class="form-control">{{ $val('present_address') }}</textarea>
            </div>
            <div class="col-md-12 form-group">
                <label>Permanent Address</label>
                <textarea name="permanent_address" rows="2" class="form-control">{{ $val('permanent_address') }}</textarea>
            </div>
            <div class="col-md-6 form-group">
                <label>Emergency Contact Name</label>
                <input type="text" class="form-control" name="emergency_contact_name" value="{{ $val('emergency_contact_name') }}">
            </div>
            <div class="col-md-6 form-group">
                <label>Emergency Contact Phone</label>
                <input type="text" class="form-control" name="emergency_contact_phone" value="{{ $val('emergency_contact_phone') }}">
            </div>
        </div>
    </div>
</div>

{{-- ── NID ── --}}
<div class="card">
    <div class="card-header bg-light"><strong><i class="fas fa-id-card text-success"></i> National ID (NID)</strong></div>
    <div class="card-body">
        <div class="form-group">
            <label>NID Number</label>
            <input type="text" class="form-control" name="nid" value="{{ $val('nid') }}">
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label>NID Front Photo</label>
                <input type="file" class="form-control-file" name="nid_front_image" accept="image/*">
                @if($imgUrl('nid_front_image'))
                    <a href="{{ $imgUrl('nid_front_image') }}" target="_blank"><img src="{{ $imgUrl('nid_front_image') }}" class="img-thumbnail mt-2" style="max-height:120px;"></a>
                @endif
            </div>
            <div class="col-md-6 form-group">
                <label>NID Back Photo</label>
                <input type="file" class="form-control-file" name="nid_back_image" accept="image/*">
                @if($imgUrl('nid_back_image'))
                    <a href="{{ $imgUrl('nid_back_image') }}" target="_blank"><img src="{{ $imgUrl('nid_back_image') }}" class="img-thumbnail mt-2" style="max-height:120px;"></a>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ── License ── --}}
<div class="card">
    <div class="card-header bg-light"><strong><i class="fas fa-car-side text-success"></i> Driving License</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>License Number</label>
                <input type="text" class="form-control" name="license_no" value="{{ $val('license_no') }}">
            </div>
            <div class="col-md-6 form-group">
                <label>License Expiry</label>
                <input type="date" class="form-control" name="license_expiry" value="{{ $val('license_expiry') }}">
            </div>
            <div class="col-md-6 form-group">
                <label>License Photo</label>
                <input type="file" class="form-control-file" name="license_image" accept="image/*">
                @if($imgUrl('license_image'))
                    <a href="{{ $imgUrl('license_image') }}" target="_blank"><img src="{{ $imgUrl('license_image') }}" class="img-thumbnail mt-2" style="max-height:120px;"></a>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ── Vehicle ── --}}
<div class="card">
    <div class="card-header bg-light"><strong><i class="fas fa-taxi text-success"></i> Vehicle</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 form-group">
                <label>Vehicle Type</label>
                <select name="vehicle_type" class="form-control">
                    <option value="">Select</option>
                    @foreach($vehicleTypes as $vt)
                        <option value="{{ $vt }}" {{ $val('vehicle_type') == $vt ? 'selected' : '' }}>{{ ucfirst($vt) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label>Model</label>
                <input type="text" class="form-control" name="vehicle_model" value="{{ $val('vehicle_model') }}">
            </div>
            <div class="col-md-4 form-group">
                <label>Plate Number</label>
                <input type="text" class="form-control" name="vehicle_plate" value="{{ $val('vehicle_plate') }}">
            </div>
            <div class="col-md-4 form-group">
                <label>Color</label>
                <input type="text" class="form-control" name="vehicle_color" value="{{ $val('vehicle_color') }}">
            </div>
            <div class="col-md-4 form-group">
                <label>Year</label>
                <input type="text" class="form-control" name="vehicle_year" value="{{ $val('vehicle_year') }}" maxlength="4">
            </div>
        </div>
    </div>
</div>

{{-- ── Photo + Status ── --}}
<div class="card">
    <div class="card-header bg-light"><strong><i class="fas fa-camera text-success"></i> Profile Photo & Status</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Profile Photo</label>
                <input type="file" class="form-control-file" name="profile_image" accept="image/*">
                @if($imgUrl('profile_image'))
                    <br><img src="{{ $imgUrl('profile_image') }}" class="img-circle mt-2" style="width:90px;height:90px;object-fit:cover;">
                @endif
            </div>
            <div class="col-md-6 form-group">
                <label>Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="1" {{ $val('status', '1') == '1' ? 'selected' : '' }}>Active (Approved)</option>
                    <option value="0" {{ $val('status') === '0' || $val('status') === 0 ? 'selected' : '' }}>Inactive (Pending)</option>
                </select>
                @error('status')<p class="text-danger small">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>
</div>
