@extends('admin.master')
@section('title', 'Admin Dashboard | Promo Codes')

@section('body')
<section class="pt-5">
    <div class="card shadow bg-info">
        <div class="card-header">
            <div class="card-title">Promo Codes</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        {{-- Add form --}}
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-header text-info">
                    <div class="card-title">Add Promo Code</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.promo-codes.store') }}" method="POST">
                        @csrf
                        @include('admin.promo_codes.form', ['promo' => null])
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-info">Create Promo Code</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- List --}}
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="card-title">All Promo Codes</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Code</th>
                                    <th>Discount</th>
                                    <th>Min Fare</th>
                                    <th>Uses</th>
                                    <th>Expires</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = (($promoCodes->currentPage() - 1) * $promoCodes->perPage() + 1); ?>
                                @forelse($promoCodes as $promo)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><strong>{{ $promo->code }}</strong></td>
                                    <td>
                                        @if($promo->type === 'percent')
                                            {{ rtrim(rtrim(number_format($promo->value,2),'0'),'.') }}%
                                            @if($promo->max_discount) <small class="text-muted">(max ৳{{ $promo->max_discount }})</small>@endif
                                        @else
                                            ৳{{ rtrim(rtrim(number_format($promo->value,2),'0'),'.') }} flat
                                        @endif
                                    </td>
                                    <td>৳{{ $promo->min_fare }}</td>
                                    <td>{{ $promo->used_count }}{{ $promo->max_uses ? ' / '.$promo->max_uses : '' }}</td>
                                    <td>{{ $promo->expires_at ? $promo->expires_at->format('d M Y') : '—' }}</td>
                                    <td>
                                        @if($promo->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <a href="#" data-toggle="modal" data-target="#pcedit{{ $promo->id }}" class="text-success mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.promo-codes.destroy', $promo->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-danger" onclick="return confirm('Delete this promo code?')" style="all:unset; cursor:pointer;"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Edit modal --}}
                                <div class="modal fade" id="pcedit{{ $promo->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Promo Code</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.promo-codes.update', $promo->id) }}" method="POST">
                                                    @csrf
                                                    @include('admin.promo_codes.form', ['promo' => $promo])
                                                    <div class="form-group mt-2">
                                                        <button type="submit" class="btn btn-info">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr><td colspan="8" class="text-danger h6 text-center">No promo codes yet</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $promoCodes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
