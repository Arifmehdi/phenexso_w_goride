@extends('frontend.layouts.ecommercemaster')

@section('content')
<section class="my-0 section">
  <div class="container">

     <!-- Success/Error Messages -->
      @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
    <div class="row">

      {{-- Sidebar --}}
      <aside class="col-lg-3 mb-4">
        <div class="card text-center">
          <div class="card-body">
            <img id="profilePreview"
                 src="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $user->fi()]) }}"
                 alt="Profile"
                 class="rounded-circle border border-success mb-2"
                 style="width:80px; height:80px; object-fit:cover; cursor:pointer;">
            <input type="file" id="profileImageInput" accept="image/*" class="d-none">

            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="text-muted">{{ $user->email }}</p>
          </div>

          <ul class="list-group list-group-flush text-start">
            <li class="list-group-item">
              <a href="{{route('user.dashboard')}}" 
                 class="tab-link {{ $activeTab=='dashboard'?'text-success fw-bold':'' }}">
                 Dashboard
              </a>
            </li>
            <li class="list-group-item">
              <a href="{{route('user.orders', ['type' => 'all'])}}" 
                 class="tab-link {{ $activeTab=='order'?'text-success fw-bold':'' }}">
                 Orders
              </a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.editMyInformation')}}" 
                 class="tab-link {{ $activeTab=='edit'?'text-success fw-bold':'' }}">
                 Personal Info
              </a>
            </li>
            {{--<li class="list-group-item">
                  <a href="{{ route('health.registration') }}" 
                      class="tab-link">
                        Health Card Form
                  </a>
              </li>--}}

              @if (isset($user) && $user->idcard)

                {{--<li class="list-group-item">
                    <a href="{{ asset('storage/'.$user->idcard->file_name) }}" target="_blank"
                        class="tab-link">
                          Health Card
                    </a>
                </li>--}}
              {{--@if ($user->email == 'admin@gmail.com')
                <li class="list-group-item">
                    <a href="{{ route('user.idcard')  }}" class="tab-link">
                         Health Card
                    </a>
                </li>
              @endif--}}
              @endif

            <li class="list-group-item">
              <a href="{{ route('logout') }}" class="text-danger">Logout</a>
            </li>
          </ul>
        </div>
      </aside>

      {{-- Main Content --}}
      <div class="col-lg-9">
        <div class="tab-content">

          {{-- Dashboard Tab --}}
          <div class="tab-pane fade {{ $activeTab=='dashboard'?'show active':'' }}" id="dashboard">
            <div class="row g-3">
              {{-- Total Orders --}}
              <div class="col-md-4">
                <a href="{{ route('user.orders', ['type' => 'all']) }}" class="text-decoration-none">
                  <div class="card border-success shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                      <div class="bg-success text-white d-flex justify-content-center align-items-center rounded-circle" 
                           style="width:50px; height:50px; font-size:20px;">
                        <i class="fa-solid fa-cart-plus"></i>
                      </div>
                      <div>
                        <h4 class="text-success mb-0">{{ $user->orders()->count() }}</h4>
                        <small>Total Orders</small>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              {{-- Today Orders --}}
              <div class="col-md-4">
                <a href="{{ route('user.orders', ['type' => 'today']) }}" class="text-decoration-none">
                  <div class="card border-primary shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                      <div class="bg-primary text-white d-flex justify-content-center align-items-center rounded-circle" 
                           style="width:50px; height:50px; font-size:20px;">
                        <i class="fa-solid fa-cart-plus"></i>
                      </div>
                      <div>
                        <h4 class="text-primary mb-0">{{ $todayOrdersCount }}</h4>
                        <small>Today Orders</small>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              {{-- Cancelled Orders --}}
              <div class="col-md-4">
                <a href="{{ route('user.orders', ['type' => 'cancelled']) }}" class="text-decoration-none">
                  <div class="card border-danger shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                      <div class="bg-danger text-white d-flex justify-content-center align-items-center rounded-circle" 
                           style="width:50px; height:50px; font-size:20px;">
                        <i class="fa-solid fa-cart-plus"></i>
                      </div>
                      <div>
                        <h4 class="text-danger mb-0">{{ $cancelOrdersCount }}</h4>
                        <small>Cancelled Orders</small>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          {{-- Orders Tab --}}
          <div class="tab-pane fade {{ $activeTab=='order'?'show active':'' }}" id="order">
            <div class="card">
              <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white">My Orders</h5>
                @if(isset($type))
                  <div class="btn-group btn-group-sm">
                    <a href="{{ route('user.orders', ['type' => 'all']) }}" 
                       class="btn {{ $type=='all'?'btn-light border':'btn-outline-light' }}">All</a>
                    <a href="{{ route('user.orders', ['type' => 'today']) }}" 
                       class="btn {{ $type=='today'?'btn-light border':'btn-outline-light' }}">Today</a>
                    <a href="{{ route('user.orders', ['type' => 'cancelled']) }}" 
                       class="btn {{ $type=='cancelled'?'btn-light border':'btn-outline-light' }}">Cancelled</a>
                  </div>
                @endif
              </div>
              <div class="card-body p-3">
                @if($orders->count())
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                      <thead class="table-light">
                        <tr>
                          <th>ORDER</th>
                          <th>DATE</th>
                          <th>STATUS</th>
                          <th>TOTAL</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($orders as $order)
                          <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="text-capitalize">{{ $order->order_status }}</td>
                            <td>{{ number_format($order->grand_total, 2) }} tk</td>
                            <td>
                               <a class="btn btn-primary btn-xs" target="_blank" href="{{ route('user.orderPrint', $order->id) }}"><i class="fas fa-print w3-small"></i> Invoice</a>
                                <a class="btn btn-primary btn-xs" target="_blank" href="{{ route('user.orderChalan', $order->id) }}"><i class="fas fa-print w3-small"></i> Chalan</a>
                                  
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="mt-3">
                    {{ $orders->links() }}
                  </div>
                @else
                  <p class="text-center text-muted">No orders found.</p>
                @endif
              </div>
            </div>
          </div>

          {{-- Personal Info Edit Tab --}}
          <div class="tab-pane fade {{ $activeTab=='edit'?'show active':'' }}" id="edit">
            <div class="card">
              <div class="card-header bg-primary text-white">Account Details</div>
              <div class="card-body">
                <form action="{{ route('user.changeMyInformation') }}" method="POST" class="needs-validation" novalidate>
                  @csrf

                  {{-- Name & Mobile --}}
                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                      <input type="text" id="name" name="name" value="{{ old('name',$user->name) }}" class="form-control" required>
                      @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                      <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                      <input type="text" id="mobile" name="mobile" value="{{ old('mobile',$user->mobile) }}" class="form-control" required>
                      @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                  </div>

                  {{-- Email --}}
                  <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email',$user->email) }}" class="form-control" required>
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  {{-- Father Name --}}
                  <div class="mb-3">
                    <label for="father_name" class="form-label">Father Name <span class="text-danger">*</span></label>
                    <input type="text" id="father_name" name="father_name" class="form-control" value="{{ old('father_name',$user->father_name) }}" required>
                    @error('father_name')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  {{-- Address --}}
                  <div class="mb-3">
                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address',$user->address) }}" required>
                    @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  {{-- Registration Date --}}
                  <div class="mb-3">
                    <label for="reg_date" class="form-label">Date Of Registration <span class="text-danger">*</span></label>
                    <input type="date" id="reg_date" name="reg_date" class="form-control" value="{{ old('reg_date',$user->reg_date) }}" required>
                    @error('reg_date')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  {{-- Bkash Number --}}
                  <div class="mb-3">
                    <label for="bkash_number" class="form-label">Registration Payment Bkash No <span class="text-danger">*</span></label>
                    <input type="text" id="bkash_number" name="bkash_number" class="form-control" value="{{ old('bkash_number',$user->bkash_number) }}" required>
                    @error('bkash_number')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  {{-- Date of Birth --}}
                  <div class="mb-3">
                    <label for="dob" class="form-label">Date Of Birth <span class="text-danger">*</span></label>
                    <input type="date" id="dob" name="dob" class="form-control" value="{{ old('dob',$user->dob) }}" required>
                    @error('dob')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  {{-- Blood Group --}}
                  <div class="mb-3">
                    <label for="blood_group" class="form-label">Blood Group <span class="text-danger">*</span></label>
                    <select id="blood_group" name="blood_group" class="form-select" required>
                      <option value="">Select One</option>
                      @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
                        <option value="{{ $bg }}" {{ old('blood_group', $user->blood_group) == $bg ? 'selected' : '' }}>
                          {{ $bg }}
                        </option>
                      @endforeach
                    </select>
                    @error('blood_group')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  <hr class="mt-4">
                  <h6>Change Password</h6>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">Current Password</label>
                      <input type="password" name="old_password" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">New Password</label>
                      <input type="password" name="new_password" class="form-control">
                    </div>
                    <div class="col-12">
                      <label class="form-label">Confirm New Password</label>
                      <input type="password" name="confirm_password" class="form-control">
                    </div>
                  </div>

                  <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form>
              </div>
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
  // Profile Image Upload
  document.getElementById('profilePreview').addEventListener('click',()=>document.getElementById('profileImageInput').click());
  document.getElementById('profileImageInput').addEventListener('change', function(){
    const file = this.files[0];
    if(!file) return;
    const formData = new FormData();
    formData.append('image',file);
    formData.append('_token','{{ csrf_token() }}');
    const reader = new FileReader();
    reader.onload = e=>document.getElementById('profilePreview').src=e.target.result;
    reader.readAsDataURL(file);
    fetch("{{ route('user.uploadProfileImage') }}",{method:'POST',body:formData})
      .then(res=>res.json()).then(data=>{if(!data.success) alert('Upload failed')}).catch(()=>alert('Upload failed'));
  });
</script>
@endpush
