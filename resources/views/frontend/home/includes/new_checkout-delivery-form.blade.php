<header class="bg-success py-2 px-3">
    <h2 class="text-white h5 d-flex align-items-center gap-2 mb-0">
        <i class="fas fa-shipping-fast"></i> Shpping Address
    </h2>
</header>

<form action="{{ route('storeDeliveryLocation') }}" method="POST" class="p-4">
    @csrf

    <!-- Address Title -->
    <div class="mb-3">
        <label for="address_title" class="form-label">
            Address Title <span class="text-danger">*</span>
        </label>
        <input type="text" id="address_title" name="address_title"
               value="{{ $dl ? $dl->address_title : old('address_title') }}"
               placeholder="e.g. Home, Office, Mom’s House"
               class="form-control @error('address_title') is-invalid @enderror">
        @error('address_title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Name & Mobile -->
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label for="name" class="form-label">
                Name <span class="text-danger">*</span>
            </label>
            <input type="text" id="name" name="name"
                   value="{{ $dl ? $dl->name : Auth::user()->name  }}"
                   placeholder="Enter full name"
                   class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="mobile" class="form-label">
                Mobile <span class="text-danger">*</span>
            </label>
            <input type="text" id="mobile" name="mobile"
                   value="{{ $dl ? $dl->mobile : Auth::user()->mobile  }}"
                   placeholder="e.g. 01XXXXXXXXX"
                   class="form-control @error('mobile') is-invalid @enderror">
            @error('mobile')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email"
               value="{{ $dl ? $dl->email : Auth::user()->email  }}"
               placeholder="Optional"
               class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

   

    <!-- Submit Button -->
    <button type="submit" class="btn btn-success w-100">
        Save <i class="fa fa-arrow-right ms-2"></i>
    </button>
</form>
