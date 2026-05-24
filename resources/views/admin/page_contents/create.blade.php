@extends('admin.master')
@section('title', 'Create Page Content')

@push('css')
<style>
    /* Premium UI Overrides */
    .editor-card { border-radius: 24px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.04); overflow: hidden; background: #fff; }
    .form-section { padding: 40px; }
    .section-label { font-size: 11px; font-weight: 900; color: #1A7A3C; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 25px; display: block; }
    
    .label-elegant { font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 10px; display: block; padding-left: 4px; }
    
    .input-elegant { 
        background: #f8fafc !important; 
        border: 1.5px solid #e2e8f0 !important; 
        border-radius: 14px !important; 
        padding: 16px 20px !important; 
        height: auto !important; 
        font-size: 15px !important;
        font-weight: 500 !important;
        color: #1e293b !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: none !important;
    }
    .input-elegant:focus { 
        background: white !important; 
        border-color: #1A7A3C !important; 
        box-shadow: 0 0 0 4px rgba(26, 122, 60, 0.08) !important;
        outline: none !important;
    }

    .nav-tabs-custom { border: none; display: flex; gap: 10px; padding: 20px 30px; background: #fdfdfd; border-bottom: 1px solid #f1f5f9; }
    .nav-tabs-custom .nav-link { 
        border: none !important; color: #94a3b8; font-weight: 700; font-size: 14px; 
        padding: 12px 24px; border-radius: 14px; transition: all 0.3s;
        display: flex; align-items: center; gap: 10px; background: #f8fafc;
    }
    .nav-tabs-custom .nav-link.active { background: #1A7A3C !important; color: white !important; box-shadow: 0 10px 20px rgba(26,122,60,0.2); }

    .sticky-actions { position: sticky; bottom: 0; background: rgba(255,255,255,0.9); backdrop-filter: blur(15px); padding: 20px 40px; border-top: 1px solid #f1f5f9; z-index: 1000; }
    .btn-save { background: #1A7A3C; color: white; padding: 14px 40px; border-radius: 14px; font-weight: 800; border: none; box-shadow: 0 10px 20px rgba(26,122,60,0.15); transition: all 0.3s; }
</style>
@endpush

@section('body')

<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="m-0 font-weight-bold" style="letter-spacing: -1px;"><i class="fas fa-plus-circle mr-3 text-success"></i>New Page Content</h1>
            </div>
            <a href="{{ route('admin.page_contents.index') }}" class="btn btn-light px-4" style="border-radius: 12px; font-weight: 700; border: 1px solid #e2e8f0;">
                <i class="fas fa-chevron-left mr-2"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="content pb-5">
    <div class="container-fluid">
        <form action="{{ route('admin.page_contents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="card editor-card mb-4">
                <div class="form-section" style="padding-bottom: 20px;">
                    <span class="section-label">General Configuration</span>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label-elegant">Page Slug (URL Identifier)</label>
                            <input type="text" name="page_slug" class="form-control input-elegant" placeholder="e.g. pricing-page" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="label-elegant">Featured Image</label>
                            <input type="file" name="image" class="form-control input-elegant" style="padding: 10px 20px !important;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card editor-card">
                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#en-content">English Version</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bn-content">Bangla Version</a></li>
                </ul>

                <div class="card-body p-0">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="en-content">
                            <div class="form-section">
                                <div class="row">
                                    <div class="col-md-6 mb-4"><label class="label-elegant">Title</label><input type="text" name="title" class="form-control input-elegant" placeholder="Enter title..."></div>
                                    <div class="col-md-6 mb-4"><label class="label-elegant">Subtitle</label><input type="text" name="subtitle" class="form-control input-elegant" placeholder="Enter subtitle..."></div>
                                    <div class="col-12 mb-4"><label class="label-elegant">Description</label><textarea name="description" class="form-control input-elegant" rows="2" placeholder="Brief summary..."></textarea></div>
                                    <div class="col-12"><label class="label-elegant">Full Body Content</label><textarea name="content" id="summernote_en" class="form-control"></textarea></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="bn-content">
                            <div class="form-section">
                                <div class="row">
                                    <div class="col-md-6 mb-4"><label class="label-elegant">টাইটেল (Title BN)</label><input type="text" name="title_bn" class="form-control input-elegant" placeholder="শিরোনাম..."></div>
                                    <div class="col-md-6 mb-4"><label class="label-elegant">সাবটাইটেল (Subtitle BN)</label><input type="text" name="subtitle_bn" class="form-control input-elegant" placeholder="উপ-শিরোনাম..."></div>
                                    <div class="col-12 mb-4"><label class="label-elegant">বিবরণ (Description BN)</label><textarea name="description_bn" class="form-control input-elegant" rows="2" placeholder="সারসংক্ষেপ..."></textarea></div>
                                    <div class="col-12"><label class="label-elegant">বিস্তারিত কন্টেন্ট (Content BN)</label><textarea name="content_bn" id="summernote_bn" class="form-control"></textarea></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sticky-actions text-right">
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-check-circle mr-2"></i> Save Page Content
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#summernote_en, #summernote_bn').summernote({ height: 300 });
    });
</script>
@endpush
