@extends('admin.master')

@section('title', 'Admin Dashboard | Unit Create')

@push('css')
@endpush

@section('body')
<section class="content py-3">
    <div class="row">
        <div class="col-md-8 mx-auto">

            <!-- Header Card -->
            <div class="card mb-2 shadow-lg">
                <div class="card-header- d-flex justify-content-between align-items-center px-2 py-2">
                    <h3 class="card-title text-sm text-bold text-muted pt-1">
                        <i class="fas fa-plus-circle text-primary"></i> Add New Unit
                    </h3>
                    <a href="{{ route('admin.unitsAll') }}" class="btn btn-outline-primary btn-xs">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card card-primary card-outline shadow-lg">
                <div class="card-body bg-light px-3">
                    <form action="{{ route('admin.unitStore') }}" method="POST">
                        @csrf

                        <!-- Unit Name (English)-->
                        <div class="form-group row">
                            <label for="name_en" class="col-sm-3 col-form-label text-left">
                                Unit Name (English) <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="name_en" value="{{ old('name_en') }}" id="name_en" class="form-control" placeholder="e.g., Kilogram, Piece, Liter" required>
                                @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Unit Name (Bangla) -->
                        <div class="form-group row">
                            <label for="name_bn" class="col-sm-3 col-form-label text-left">
                                Unit Name (Bangla)
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="name_bn" value="{{ old('name_bn') }}" id="name_bn" class="form-control" placeholder="e.g., কিলোগ্রাম, পিস, লিটার">
                                @error('name_bn') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Active -->
                        <div class="form-group row">
                            <label for="active" class="col-sm-3 col-form-label text-left">Active</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" name="active" type="checkbox" id="active" checked>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="form-group row mb-0">
                            <div class="col-sm-9 offset-sm-3 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
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