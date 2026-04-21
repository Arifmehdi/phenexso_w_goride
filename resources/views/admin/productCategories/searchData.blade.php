<table class="table table-striped table-bordered table-hover table-md">
    <thead class="w3-small text-muted thead-light">
        <tr>
            <th scope="col" width="30">SL</th>
            <th scope="col" width="60">Action</th>
            <th scope="col"> Category Name (English)</th>
            <th scope="col"> Category Name (Bangla)</th>
            <th scope="col">Image</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = (($categories->currentPage() - 1) * $categories->perPage() + 1); ?>
        
        @forelse ($categories as $category)
            {{-- 🔹 Parent Category --}}
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td scope="row">
                    <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="{{ route('admin.productCategoryEdit', $category) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                            <form action="{{ route('admin.productCategoryDelete', $category) }}" method="post" onclick="return confirm('Are you sure to delete?')">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </td>

                <td>{{ Str::limit($category->name_en, 30) }}</td>
                <td>{{ Str::limit($category->name_bn, 30) }}</td>
                <td>
                    <img width="30" height="20"
                         src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $category->fi()]) }}"
                         alt="">
                </td>

                <td>
                    @if($category->active == 1)
                        <button class="badge border-0 badge-primary categoryStatus"
                            data-url="{{ route('admin.categoryStatus', ['category' => $category->id]) }}">
                            Active
                        </button>
                    @else
                        <button class="badge border-0 badge-danger categoryStatus"
                            data-url="{{ route('admin.categoryStatus', ['category' => $category->id]) }}">
                            Inactive
                        </button>
                    @endif
                </td>
            </tr>

            {{-- 🔸 Subcategories --}}
            @foreach ($category->children as $child)
                <tr>
                    <td></td> {{-- leave blank for subcategory --}}
                    <td scope="row">
                        <div class="dropdown show">
                            <a class="btn btn-secondary btn-xs dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="{{ route('admin.productCategoryEdit', $child) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                                <form action="{{ route('admin.productCategoryDelete', $child) }}" method="post" onclick="return confirm('Are you sure to delete?')">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>

                    {{-- 👇 Indent + arrow for visual hierarchy --}}
                    <td>&nbsp;&nbsp;&nbsp;↳ {{ Str::limit($child->name_en, 30) }}</td>
                    <td>&nbsp;&nbsp;&nbsp; {{ Str::limit($child->name_bn, 30) }}</td>
                    <td>
                        <img width="30" height="20"
                             src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $child->fi()]) }}"
                             alt="">
                    </td>

                    <td>
                        @if($child->active == 1)
                            <button class="badge border-0 badge-primary categoryStatus"
                                data-url="{{ route('admin.categoryStatus', ['category' => $child->id]) }}">
                                Active
                            </button>
                        @else
                            <button class="badge border-0 badge-danger categoryStatus"
                                data-url="{{ route('admin.categoryStatus', ['category' => $child->id]) }}">
                                Inactive
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach

        @empty
            <tr>
                <td colspan="6" class="text-danger h5 text-center">No Category Found</td>
            </tr>
        @endforelse
    </tbody>
</table>
