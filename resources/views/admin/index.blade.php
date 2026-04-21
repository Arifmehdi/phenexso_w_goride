@extends('admin.master')

@section('title')
    Admin Dashboard | {{ env('APP_NAME') }}
@endsection

@section('body')
<section class="content py-5" style="min-height: 700px;">
    <div class="row g-4">
        {{-- Card: Products --}}
        <div class="col-xl-3 col-md-6">
            <div class="card w3-purple shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-end">
                    <div>
                        <h4 class="text-white mb-1">{{ $productcount }}</h4>
                        <h6 class="text-white mb-0">All Products</h6>
                    </div>
                    <div style="width: 45px; height: 50px;">
                        <canvas id="chart-products" height="50"></canvas>
                    </div>
                </div>
                <div class="card-footer text-center border-top border-light">
                    <a href="{{ route('admin.productsAll') }}" class="text-white">View All</a>
                </div>
            </div>
        </div>

        {{-- Card: Orders --}}
        <div class="col-xl-3 col-md-6">
            <div class="card w3-deep-purple shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-end">
                    <div>
                        <h4 class="text-white mb-1">{{ $orders }}</h4>
                        <h6 class="text-white mb-0">All Orders</h6>
                    </div>
                    <div style="width: 45px; height: 50px;">
                        <canvas id="chart-orders" height="50"></canvas>
                    </div>
                </div>
                <div class="card-footer text-center border-top border-light">
                    <a href="{{ route('admin.orderList') }}" class="text-white">View All</a>
                </div>
            </div>
        </div>

        {{-- Card: Users --}}
        <div class="col-xl-3 col-md-6">
            <div class="card w3-teal shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-end">
                    <div>
                        <h4 class="text-white mb-1">{{ $users }}</h4>
                        <h6 class="text-white mb-0">All Users</h6>
                    </div>
                    <div style="width: 45px; height: 50px;">
                        <canvas id="chart-users" height="50"></canvas>
                    </div>
                </div>
                <div class="card-footer text-center border-top border-light">
                    <a href="{{ route('admin.all_user') }}" class="text-white">View All</a>
                </div>
            </div>
        </div>

        {{-- Card: Doctors --}}
        <div class="col-xl-3 col-md-6">
            <div class="card w3-indigo shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-end">
                    <div>
                        <h4 class="text-white mb-1">{{ $cat }}</h4>
                        <h6 class="text-white mb-0">All Categories</h6>
                    </div>
                    <div style="width: 45px; height: 50px;">
                        <canvas id="chart-doctors" height="50"></canvas>
                    </div>
                </div>
                <div class="card-footer text-center border-top border-light">
                    <a href="{{ route('admin.productCategoriesAll') }}" class="text-white">View All</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Table: Top Products --}}
    <div class="card w3-round shadow-lg mt-5">
        <div class="card-header py-2 d-flex align-items-center">
            <h3 class="card-title w3-small fw-bold text-muted mb-0">
                <i class="fas fa-th text-primary me-1"></i> Top Products
            </h3>
        </div>

        <div class="card-body bg-light px-0 pb-0 pt-2">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-middle">
                    <thead class="w3-small text-muted bg-light">
                        <tr>
                            <th width="30">SL</th>
                            <th width="60">Action</th>
                            <th>Product Name</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $key => $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('admin.productEdit', $product) }}" class="dropdown-item">
                                                    <i class="fa fa-edit me-1"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.productDelete', $product) }}" method="post"
                                                    onsubmit="return confirm('Are you sure to delete?')">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa fa-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ Str::limit($product->name_en, 30) }}</td>
                                <td>{{ $product->stock ?? 'N/A' }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <img src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $product->fi()]) }}"
                                         width="40" height="30" alt="Product Image">
                                </td>
                                <td>
                                    @if ($product->active == 1)
                                        <button class="badge bg-primary border-0 productStatus"
                                            data-url="{{ route('admin.productStatus', ['product' => $product->id]) }}">
                                            Active
                                        </button>
                                    @else
                                        <button class="badge bg-danger border-0 productStatus"
                                            data-url="{{ route('admin.productStatus', ['product' => $product->id]) }}">
                                            Inactive
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-danger fw-bold">No Product Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
