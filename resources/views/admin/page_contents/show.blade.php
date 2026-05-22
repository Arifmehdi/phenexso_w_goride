@extends('admin.master')
@section('title', 'Page Details: ' . $pageContent->page_slug)

@push('css')
<style>
    .detail-card { border-radius: 24px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.04); overflow: hidden; background: #fff; }
    .page-header-info { background: #fdfdfd; padding: 40px; border-bottom: 1px solid #f1f5f9; }
    .content-section { padding: 40px; }
    .label-pill { font-size: 10px; font-weight: 900; padding: 6px 16px; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; display: inline-block; }
    .badge-slug { background: #f1f5f9; color: #475569; }
    
    .content-box { 
        background: #f8fafc; 
        border: 1.5px solid #e2e8f0; 
        border-radius: 18px; 
        padding: 30px; 
        font-size: 16px; 
        line-height: 1.7; 
        color: #334155;
    }
    
    .flag-icon { width: 22px; border-radius: 3px; margin-right: 12px; }
    .section-title-modern { font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 25px; display: flex; align-items: center; }
</style>
@endpush

@section('body')

<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="m-0 font-weight-bold" style="letter-spacing: -1px;"><i class="fas fa-search mr-3 text-info"></i>Page Inspection</h1>
            </div>
            <div class="btn-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <a href="{{ route('admin.page_contents.index') }}" class="btn btn-white px-4 py-2" style="background: white; font-weight: 700;">
                    <i class="fas fa-arrow-left mr-2"></i> List
                </a>
                <a href="{{ route('admin.page_contents.edit', $pageContent->id) }}" class="btn btn-warning px-4 py-2" style="font-weight: 700;">
                    <i class="fas fa-edit mr-2"></i> Edit Content
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content pb-5">
    <div class="container-fluid">
        <div class="card detail-card">
            <div class="page-header-info">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="label-pill badge-slug">SLUG: {{ $pageContent->page_slug }}</span>
                        <h2 class="mb-0 font-weight-bold" style="color: #0f172a; font-size: 28px;">{{ $pageContent->getRawOriginal('title') ?: 'Untitled Page' }}</h2>
                    </div>
                    <div class="text-right">
                        <span class="badge {{ $pageContent->active ? 'badge-success' : 'badge-secondary' }} px-3 py-2" style="border-radius: 8px;">
                            {{ $pageContent->active ? '● LIVE' : '● DRAFT' }}
                        </span>
                        <p class="text-muted small mt-2 mb-0">Modified {{ $pageContent->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <div class="row no-gutters">
                {{-- ENGLISH SIDE --}}
                <div class="col-md-6 border-right">
                    <div class="content-section">
                        <div class="section-title-modern">
                            <img src="https://flagcdn.com/w20/us.png" class="flag-icon" alt="EN"> English Version
                        </div>
                        
                        <div class="mb-5">
                            <label class="small text-muted font-weight-bold text-uppercase" style="letter-spacing: 1px;">Subtitle</label>
                            <p class="lead font-weight-bold" style="color: #475569;">{{ $pageContent->getRawOriginal('subtitle') ?: '—' }}</p>
                        </div>

                        <div class="mb-5">
                            <label class="small text-muted font-weight-bold text-uppercase" style="letter-spacing: 1px;">Description</label>
                            <div class="content-box">{{ $pageContent->getRawOriginal('description') ?: 'No description provided.' }}</div>
                        </div>

                        <div>
                            <label class="small text-muted font-weight-bold text-uppercase" style="letter-spacing: 1px;">Body Content</label>
                            <div class="border rounded p-4 bg-white shadow-sm" style="border-radius: 18px !important;">
                                {!! $pageContent->getRawOriginal('content') ?: '<em class="text-muted">No body content.</em>' !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BANGLA SIDE --}}
                <div class="col-md-6">
                    <div class="content-section" style="background: #fdfdfd;">
                        <div class="section-title-modern">
                            <img src="https://flagcdn.com/w20/bd.png" class="flag-icon" alt="BN"> Bangla Version
                        </div>

                        <div class="mb-5">
                            <label class="small text-muted font-weight-bold text-uppercase" style="letter-spacing: 1px;">টাইটেল</label>
                            <h4 class="font-weight-bold text-success">{{ $pageContent->title_bn ?: '—' }}</h4>
                        </div>

                        <div class="mb-5">
                            <label class="small text-muted font-weight-bold text-uppercase" style="letter-spacing: 1px;">সাবটাইটেল</label>
                            <p class="lead font-weight-bold" style="color: #475569;">{{ $pageContent->subtitle_bn ?: '—' }}</p>
                        </div>

                        <div class="mb-5">
                            <label class="small text-muted font-weight-bold text-uppercase" style="letter-spacing: 1px;">বিবরণ</label>
                            <div class="content-box" style="background: #ecfdf5; border-color: #d1fae5;">{{ $pageContent->description_bn ?: 'কোন বিবরণ নেই।' }}</div>
                        </div>

                        <div>
                            <label class="small text-muted font-weight-bold text-uppercase" style="letter-spacing: 1px;">মূল কন্টেন্ট</label>
                            <div class="border rounded p-4 bg-white shadow-sm" style="border-radius: 18px !important;">
                                {!! $pageContent->content_bn ?: '<em class="text-muted">কোন বিস্তারিত কন্টেন্ট নেই।</em>' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
