@extends('admin.master')
@section('title', 'Edit Product: ' . $product->name_en)

@push('css')
<style>
    .editor-card { border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; }
    .card-header-tabs { background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 15px 25px; }
    .nav-tabs-custom { border: none; }
    .nav-tabs-custom .nav-link { 
        border: none; color: #64748b; font-weight: 700; font-size: 14px; 
        padding: 10px 20px; border-radius: 10px; transition: all 0.2s;
        display: flex; align-items: center; gap: 8px;
    }
    .nav-tabs-custom .nav-link.active { background: #1A7A3C; color: white !important; box-shadow: 0 4px 12px rgba(26,122,60,0.2); }
    .lang-flag { width: 18px; border-radius: 2px; }
    
    .form-section { padding: 30px; }
    .section-label { font-size: 11px; font-weight: 800; color: #1A7A3C; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; display: block; }
    
    .input-elegant { 
        background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 12px 18px;
        transition: all 0.2s; font-size: 15px;
    }
    .input-elegant:focus { background: white; border-color: #1A7A3C; box-shadow: 0 0 0 4px rgba(26,122,60,0.1); outline: none; }
    
    .sticky-actions { position: sticky; bottom: 0; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); padding: 15px 30px; border-top: 1px solid #e2e8f0; z-index: 100; }
    .image-preview { border-radius: 12px; border: 1px solid #e2e8f0; width: 100%; object-fit: cover; }
    .media-card { background: white; border-radius: 12px; padding: 10px; border: 1px solid #e2e8f0; position: relative; }
    .delete-media { position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-size: 10px; border: none; cursor: pointer; }
</style>
@endpush

@section('body')

<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1 class="m-0 font-weight-bold"><i class="fas fa-edit mr-2 text-warning"></i>Edit Product</h1>
                <p class="text-muted small mb-0">Modifying: <strong>{{ $product->name_en }}</strong> (ID: #{{ $product->id }})</p>
            </div>
            <a href="{{ route('admin.productsAll') }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </div>
</div>

<div class="content pb-5">
    <div class="container-fluid">
        <form action="{{ route('admin.productUpdate', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                {{-- MAIN CONTENT --}}
                <div class="col-lg-8">
                    <div class="card editor-card mb-4">
                        <div class="card-header-tabs">
                            <ul class="nav nav-tabs nav-tabs-custom" id="langTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="en-tab" data-toggle="tab" href="#english-content" role="tab">
                                        <img src="https://flagcdn.com/w20/us.png" class="lang-flag" alt="EN"> English Content
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="bn-tab" data-toggle="tab" href="#bangla-content" role="tab">
                                        <img src="https://flagcdn.com/w20/bd.png" class="lang-flag" alt="BN"> Bangla Content
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-0">
                            <div class="tab-content" id="langTabsContent">
                                {{-- ENGLISH TAB --}}
                                <div class="tab-pane fade show active" id="english-content" role="tabpanel">
                                    <div class="form-section">
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold small mb-2">Product Name (EN) <span class="text-danger">*</span></label>
                                            <input type="text" name="name_en" class="form-control input-elegant" value="{{ $product->name_en }}" onkeyup="makeSlug(this.value)" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold small mb-2">Short Excerpt (EN)</label>
                                            <textarea name="excerpt_en" class="form-control input-elegant" rows="2">{{ $product->excerpt_en }}</textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="font-weight-bold small mb-2">Full Description (EN)</label>
                                            <textarea name="description_en" id="summernote_en" class="form-control">{{ $product->description_en }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- BANGLA TAB --}}
                                <div class="tab-pane fade" id="bangla-content" role="tabpanel">
                                    <div class="form-section">
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold small mb-2">পণ্যের নাম (BN)</label>
                                            <input type="text" name="name_bn" class="form-control input-elegant" value="{{ $product->name_bn }}">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold small mb-2">সংক্ষিপ্ত বিবরণ (BN)</label>
                                            <textarea name="excerpt_bn" class="form-control input-elegant" rows="2">{{ $product->excerpt_bn }}</textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="font-weight-bold small mb-2">বিস্তারিত বিবরণ (BN)</label>
                                            <textarea name="description_bn" id="summernote_bn" class="form-control">{{ $product->description_bn }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card editor-card mb-4">
                        <div class="form-section">
                            <span class="section-label">Pricing & Inventory</span>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="small font-weight-bold">Selling Price (৳)</label>
                                    <input type="number" name="selling_price" class="form-control input-elegant" value="{{ $product->selling_price }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="small font-weight-bold">Purchase Price (৳)</label>
                                    <input type="number" name="purchase_price" class="form-control input-elegant" value="{{ $product->purchase_price }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="small font-weight-bold">Discount (Flat ৳)</label>
                                    <input type="number" name="discount" class="form-control input-elegant" value="{{ $product->discount }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="small font-weight-bold">Stock Quantity</label>
                                    <input type="number" name="stock" class="form-control input-elegant" value="{{ $product->stock }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="small font-weight-bold">Unit</label>
                                    <select name="unit" class="form-control input-elegant">
                                        <option value="">Select Unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->name_en }}" {{ $product->unit == $unit->name_en ? 'selected' : '' }}>{{ $unit->name_en }} ({{ $unit->name_bn }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR CONFIG --}}
                <div class="col-lg-4">
                    <div class="card editor-card mb-4">
                        <div class="form-section">
                            <span class="section-label">Organization</span>
                            <div class="form-group mb-4">
                                <label class="small font-weight-bold">URL Slug <span class="text-danger">*</span></label>
                                <input type="text" id="slug" name="slug" class="form-control input-elegant" value="{{ $product->slug }}" required>
                            </div>

                            <div class="form-group mb-4">
                                <label class="small font-weight-bold">Category</label>
                                <div class="item-list-container" style="max-height: 250px; overflow-y: auto;">
                                    @php $attachedCats = $product->categories()->pluck('product_category_id')->toArray(); @endphp
                                    @foreach($categories as $cat)
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" name="categories[]" class="custom-control-input" id="cat{{ $cat->id }}" value="{{ $cat->id }}" {{ in_array($cat->id, $attachedCats) ? 'checked' : '' }}>
                                            <label class="custom-control-label small" for="cat{{ $cat->id }}">{{ $cat->name_en }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <label class="small font-weight-bold">Assign Rider (Driver)</label>
                                <select name="rider_id" class="form-control input-elegant">
                                    <option value="">No Rider Assigned</option>
                                    @foreach($riders as $rider)
                                        <option value="{{ $rider->id }}" {{ $product->rider_id == $rider->id ? 'selected' : '' }}>{{ $rider->name }} ({{ $rider->mobile }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card editor-card mb-4">
                        <div class="form-section">
                            <span class="section-label">Featured Image</span>
                            <div class="mb-3">
                                <img src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $product->fi()]) }}" alt="Preview" class="image-preview mb-3">
                                <input type="file" name="featured_image" class="form-control-file input-elegant">
                                <small class="text-muted mt-1 d-block">Recommended: 800x800px</small>
                            </div>
                            
                            <hr class="my-4">
                            <span class="section-label">Additional Gallery</span>
                            <div class="row mb-3">
                                @foreach($product->media as $media)
                                    <div class="col-4 mb-3">
                                        <div class="media-card">
                                            <a href="{{ route('admin.product.image.delete', $media->id) }}" class="delete-media" onclick="return confirm('Delete image?')">×</a>
                                            <img src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $media->file_name]) }}" class="w-100 rounded" style="height: 60px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="file" name="additional_images[]" class="form-control-file input-elegant" multiple>
                        </div>
                    </div>

                    <div class="card editor-card">
                        <div class="form-section">
                            <span class="section-label">Visibility</span>
                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" class="custom-control-input" id="active" name="active" value="1" {{ $product->active ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold small" for="active">Active (Visible to users)</label>
                            </div>
                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" class="custom-control-input" id="feature" name="feature" value="1" {{ $product->feature ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold small" for="feature">Featured on Home</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="editor" name="editor" value="1" {{ $product->editor ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold small" for="editor">Editor's Choice</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sticky-actions text-right">
                <button type="submit" class="btn btn-primary px-5 font-weight-bold shadow-sm">
                    <i class="fas fa-save mr-2"></i> Update Product
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#summernote_en, #summernote_bn').summernote({
            height: 250,
            placeholder: 'Detailed specifications and info...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });

    function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
    }
</script>
@endpush
