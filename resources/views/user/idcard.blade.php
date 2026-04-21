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
            <li class="list-group-item">
                  <a href="{{ route('health.registration') }}" 
                      class="tab-link">
                        Health Card Form
                  </a>
              </li>

              @if (isset($user) && $user->idcard)

                <li class="list-group-item">
                    <a href="{{ asset('storage/'.$user->idcard->file_name) }}" target="_blank"
                        class="tab-link">
                          Health Card
                    </a>
                </li>

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
              <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">My Orders</h5>
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

          {{-- Id Card Info  --}}

        <div class="card print-card" style="width: 350px; height: 550px; margin: auto; border: 1px solid #ccc; border-radius: 10px;
            font-family: Arial, sans-serif; position: relative; overflow: visible;
            background: linear-gradient(to bottom, #BBDFBB 0%, #BBDFBB 30%, #DFF2DF 50%, #ffffff 100%);">

            <!-- Top Right Button -->
            <a href="{{ route('user.idcard.pdf') }}" target="_blank" 
                style="position: absolute; top: 10px; right: 10px; padding: 5px 10px; font-size: 14px; border: none; border-radius: 5px; background-color: #59BA47; color: #fff; cursor: pointer; z-index: 10; text-decoration: none;">
                Print
            </a>

            <!-- Card content here -->
            <div class="card-body text-center" style="padding: 20px;">
                <!-- Profile Image -->
              <img 
                  src="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $user->fi()]) ?? 'https://img.freepik.com/free-vector/smiling-young-man-illustration_1308-174669.jpg' }} " 
                  alt="Profile Photo" 
                  style="width: 140px; height: 140px; object-fit: cover; border-radius: 8px; border: 2px solid #59BA47; margin-bottom: 10px;">

                <div style="font-weight: bold; font-size: 16px; margin: 0;">{{ Auth::user()->name ?? 'Guest User' }}</div>
                <div style="font-size: 14px; margin: 0;">Blood Group: {{ Auth::user()->blood_group ?? 'A+' }}</div>
                <div style="font-size: 14px; margin: 0 0 10px 0;">Mobile: {{ Auth::user()->mobile ?? '+880123456789' }}</div>
                <div style="font-size: 25px; font-weight: bold; color: #BEC6BD; margin: 0; padding: 0;">Health Card</div>
                <div style="margin: 0; padding: 0; font-size: 14px;">
                    <img src="https://93.phenexsoft.com/uslive/original/logo-alt1756994190.png" alt="site logo" style="width: 40%; margin: 0; padding: 0;">
                </div>
            </div>

            <!-- Signature and Date -->
            <div style="display: flex; justify-content: space-between; align-items: flex-end; padding: 0 20px; position: absolute; bottom: 60px; width: 100%; font-size: 14px; margin-bottom: 6px">
                <div style="text-align: left;">
                    <img src="{{ asset('img/sign.png') }}" alt="signature image" style="width: 120px; height: auto; display: block; margin-bottom: 2px;">
                    <div style="font-size: 12px;">Signature</div>
                </div>
                <div style="text-align: center; font-size: 14px;">
                    <span style="font-size:16px">{{ Auth::user()->registration_date ?? date('d/m/Y') }}</span><br>
                    Date of Registration
                </div>
            </div>

            <!-- Footer -->
            <div style="background-color: #59BA47; color: #053800; padding: 10px; font-size: 12px; position: absolute; bottom: 0; width: 100%; text-align: center; line-height: 1.4;">
                <div>Address: H-302 High School Road Muradpur High School Road East Jurain, Dhaka - 1204, Phone - 01973-005566</div>
                <div>{{ 'www.93shasthoseba.com' }}</div>
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
