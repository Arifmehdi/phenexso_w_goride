@extends('admin.master')

@section('title')
   Admin Dashboard | Unit Edit
@endsection

@push('css')
<!-- Add any page-specific CSS here -->
@endpush

@section('body')
<section class="content py-3">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title text-muted"><i class="fas fa-edit text-primary"></i> Edit Unit</h3>
                    <a href="{{ route('admin.unitsAll') }}" class="btn btn-outline-secondary btn-xs float-right">Back</a>
                </div>
            </div>

            <div class="card shadow-lg card-outline card-primary">
                <div class="card-body p-3">

                    <form action="{{ route('admin.unitUpdate', $unit) }}" method="POST">
                        @csrf
                        @method('POST')

                        {{--  Unit Name (English)  --}}
                        <div class="form-group">
                            <label for="name_en">Unit Name (English) <span class="text-danger">*</span></label>
                            <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $unit->name_en) }}"
                                class="form-control @error('name_en') is-invalid @enderror" placeholder="e.g., Kilogram, Piece, Liter" required>
                            @error('name_en')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Unit Name (Bangla)  --}}
                        <div class="form-group">
                            <label for="name_bn">Unit Name (Bangla)</label>
                            <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn', $unit->name_bn) }}"
                                class="form-control @error('name_bn') is-invalid @enderror" placeholder="e.g., কিলোগ্রাম, পিস, লিটার">
                            @error('name_bn')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Active --}}
                        <div class="form-group">
                            <label for="active">Active</label>
                            <div class="form-check">
                                <input class="form-check-input" name="active" type="checkbox" id="active"
                                    {{ old('active', $unit->active) ? 'checked' : '' }}>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    // Optional: Add any JavaScript if needed
</script>
@endpush