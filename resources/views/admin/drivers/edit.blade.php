@extends('admin.master')
@section('title',"Admin Dashboard | Edit Driver")

@section('body')
<section class="content py-4">
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="m-0">Edit Driver — {{ $driver->name }}</h4>
            <div>
                <a href="{{ route('admin.drivers.verification', $driver->id) }}" class="btn btn-info btn-sm"><i class="fas fa-id-card"></i> View Documents</a>
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-default btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>

        <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.drivers._form', ['driver' => $driver])
            <div class="text-right mb-5">
                <input type="submit" class="btn btn-success px-4" value="Update Driver">
            </div>
        </form>
    </div>
</section>
@endsection
