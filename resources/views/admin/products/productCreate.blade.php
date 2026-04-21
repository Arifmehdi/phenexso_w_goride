@extends('admin.master')

@section('title')
   Admin Dashboard | Product Create
@endsection

@push('css')
    <style>
        /* Custom styling for product tags select box */
        .productTags {
            width: 100%;
        }
        /* Margin bottom utility class */
        .margin-bottom {
            margin-bottom: 20px;
        }
        /* Initially hide subcategory containers */
        .subcat-add {
            display: none;
        }
    </style>
@endpush

@section('body')
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            {{-- Card Header --}}
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1">
                        <i class="fas fa-plus-circle text-primary"></i>&nbsp; Add New Product
                    </h3>
                    <div class="card-tools w3-small">
                        <a href="{{ route('admin.productsAll')}}" class="btn-create-from btn btn-outline-primary btn-xs pull-right mr-2 py-1">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>

            {{-- Product Create Form --}}
            <form action="{{ route('admin.productStore')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    {{-- Left Column: Product Details --}}
                    <div class="col-sm-7">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                {{-- Product Name (English)--}}
                                <div class="form-group">
                                    <label for="name_en">Product Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control" placeholder="Product Name (English)" onkeyup="makeSlug(this.value)" required>
                                    @error('name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Slug --}}
                                <div class="form-group">
                                    <label for="slug">Slug <span class="text-danger">*</span></label>
                                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="URL" class="form-control" required>
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Product Code --}}
                                {{-- <div class="form-group">
                                    <label for="product_code">Product Sku <span class="text-danger">*</span></label>
                                    <input type="text" name="sku" value="{{ old('sku') }}" class="form-control" placeholder="Enter product Sku">
                                    @error('sku')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                {{-- Product Price --}}
                                {{--<div class="form-group">
                                    <label for="price">Product Price <span class="text-danger">*</span></label>
                                    <input type="number" name="price" value="{{ old('price') }}" class="form-control" placeholder="Enter price">
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>--}}
                                <div class="form-group">
                                    <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
                                    <input type="number" name="purchase_price" value="{{ old('purchase_price') }}" class="form-control" placeholder="Enter purchase price">
                                    @error('purchase_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="selling_price">Selling Price <span class="text-danger">*</span></label>
                                    <input type="number" name="selling_price" value="{{ old('selling_price') }}" class="form-control" placeholder="Enter selling price">
                                    @error('selling_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Product Stock <span class="text-danger"></span></label>
                                    <input type="number" name="stock" value="{{ old('stock') }}" class="form-control" placeholder="Enter stock">
                                    @error('stock')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Unit --}}
                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <select name="unit" id="unit" class="form-control">
                                        <option value="">Select Unit</option>
                                        @foreach($units  as $unit)
                                            <option value="{{ $unit->name_en }}" {{ old('unit') == $unit->name_en ? 'selected' : '' }}>
                                                {{ $unit->name_en }} {{ $unit->name_bn ? '(' . $unit->name_bn . ')' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Discount --}}
                                <div class="form-group">
                                    <label for="discount">Product Discount (flat)</label>
                                    <input type="number" name="discount" value="{{ old('discount') }}" class="form-control" placeholder="Enter discount">
                                </div>

                                {{-- Rider Assignment --}}
                                <div class="form-group">
                                    <label for="rider_id">Assign Rider (Driver)</label>
                                    <select name="rider_id" id="rider_id" class="form-control select2">
                                        <option value="">Select Rider</option>
                                        @foreach($riders as $rider)
                                            <option value="{{ $rider->id }}" {{ old('rider_id') == $rider->id ? 'selected' : '' }}>
                                                {{ $rider->name }} ({{ $rider->mobile }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('rider_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                        </div>

                        {{-- Excerpt & Description --}}
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                {{-- Excerpt --}}
                                <div class="form-group">
                                    <label for="excerpt_en">Excerpt</label>
                                    <textarea name="excerpt_en" id="excerpt_en" class="form-control" rows="2" placeholder="Excerpt">{{ old('excerpt_en') }}</textarea>
                                </div>

                                {{-- Description --}}
                                <div class="form-group">
                                    <label for="description_en">Description</label>
                                    <textarea name="description_en" id="summernote" class="form-control summernote" rows="5" placeholder="Description">{{ old('description_en') }}</textarea>
                                </div>

                                {{-- Active Checkbox --}}
                                <div class="form-group">
                                    <label class="mr-3">
                                        <input type="checkbox" name="active" {{ old('active', 1) ? 'checked' : '' }}>
                                        Active
                                    </label>
                                </div>

                                {{-- Feature Checkbox --}}
                                <div class="form-group">
                                    <label class="mr-3">
                                        <input type="checkbox" name="feature" {{ old('feature', 1) ? 'checked' : '' }}>
                                        Featured
                                    </label>
                                </div>

                                {{-- Editor Checkbox --}}
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="editor" {{ old('editor', 1) ? 'checked' : '' }}>
                                        Editor
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Featured Image and Media --}}
                    <div class="col-sm-5">
                        <div class="card card-primary card-outline margin-bottom">
                            <div class="card-header">
                                <h3 class="card-title">Add Featured Image</h3>
                                <span class="text-danger">&nbsp;&nbsp;Better Size(210x210px)</span>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="feature_image" class="col-sm-4 col-form-label">Featured Image</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control-file" id="feature_image" name="featured_image" value="{{ old('feature_image') }}">
                                    </div>
                                    @error('feature_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="additional_images" class="col-sm-4 col-form-label">Additional Images</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control-file" id="additional_images" name="additional_images[]" multiple>
                                    </div>
                                    @error('additional_images')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Include media selection modal/component --}}
                        @includeIf('admin.media.mediaContainer')
                    </div>
                </div>

                {{-- Categories & Subcategories Section --}}
                @if($categories->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="add-categories-subcategories">
                            <div class="card card-primary card-outline">
                                <div class="card-header with-border">
                                    <h3 class="card-title">Add Category</h3>
                                </div>
                                <div class="card-body p-2">
                                    @foreach($categories as $cat)
                                        <div class="category-area">
                                            {{-- Category Checkbox --}}
                                            <div class="custom-control custom-checkbox bg-light rounded-lg mb-1">
                                                <input type="checkbox" class="custom-control-input toggle-category-checkbox" id="customCheckId_{{ $cat->id }}" name="categories[]" value="{{ $cat->id }}">
                                                <label class="custom-control-label" for="customCheckId_{{ $cat->id }}">{{ $cat->name_en ?? $cat->name_bn }}</label>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Submit Button --}}
                <div class="card-footer text-right">
                    <input type="submit" class="btn btn-primary px-5" value="Save Product">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        // Toggle product status active/inactive (if used somewhere)
        $(document).on('click', ".productStatus", function(e){
            e.preventDefault();
            var that = $(this);
            var url = that.attr('data-url');
            $.ajax({
                url: url,
                method: "get",
                success: function(res) {
                    if(res.active == true) {
                        that.removeClass('badge-danger').addClass('badge-primary').text('Active');
                    } else {
                        that.removeClass('badge-primary').addClass('badge-danger').text('Inactive');
                    }
                }
            });
        });

        // Product search input AJAX call (if used somewhere)
        $(document).on('keyup', ".product-search", function(e){
            e.preventDefault();
            var that = $(this);
            var url = that.attr('data-url');
            var q = that.val();
            $.ajax({
                url: url,
                data: {q:q},
                method: "get",
                success: function(res) {
                    if(res.success) {
                        $(".data-container").empty().append(res.page);
                    }
                }
            });
        });


        // Show/hide subcategories on category checkbox toggle
        $(document).on('click', '.toggle-category-checkbox', function() {
            var that = $(this);
            if(that.is(":checked")) {
                that.closest('.category-area').find('.subcat-add').show();
            } else {
                that.closest('.category-area').find('.subcat-add').hide();
            }
        });

    });

    // Slug generator from product name input
    function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
    }
</script>
@endpush
