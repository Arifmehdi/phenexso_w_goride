<table class="table table-striped table-bordered table-hover table-md">
    <thead class="w3-small text-muted thead-light">
        <tr>
            <th scope="col" width="30">SL</th>
            <th scope="col" width="60">Action</th>
            <th scope="col"> Unit Name (English)</th>
            <th scope="col"> Unit Name (Bangla)</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = (($units->currentPage() - 1) * $units->perPage() + 1); ?>

        @forelse ($units as $unit)
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td scope="row">
                    <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="{{ route('admin.unitEdit', $unit) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                            <form action="{{ route('admin.unitDelete', $unit) }}" method="post" onclick="return confirm('Are you sure to delete?')">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </td>

                <td>{{ Str::limit($unit->name_en, 30) }}</td>
                <td>{{ Str::limit($unit->name_bn, 30) }}</td>

                <td>
                    @if($unit->active == 1)
                        <button class="badge border-0 badge-primary unitStatus"
                            data-url="{{ route('admin.unitStatus', ['unit' => $unit->id]) }}">
                            Active
                        </button>
                    @else
                        <button class="badge border-0 badge-danger unitStatus"
                            data-url="{{ route('admin.unitStatus', ['unit' => $unit->id]) }}">
                            Inactive
                        </button>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">No units found.</td>
            </tr>
        @endforelse
    </tbody>
</table>