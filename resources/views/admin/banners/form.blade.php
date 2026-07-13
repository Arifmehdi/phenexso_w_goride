@php $b = $banner ?? null; @endphp

<div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control" placeholder="Optional caption"
           value="{{ old('title', $b->title ?? '') }}">
</div>

<div class="form-group">
    <label>Image {!! $b ? '' : '<span class="text-danger">*</span>' !!}</label>
    <input type="file" name="image" class="form-control-file" accept="image/*">
    <small class="form-text text-muted">Upload an image (max 4MB), or paste a URL below.</small>
    @if($b && $b->image_url)
        <img src="{{ $b->image_url }}" alt="" style="max-height:60px;margin-top:6px;border-radius:6px;">
    @endif
</div>

<div class="form-group">
    <label>…or Image URL</label>
    <input type="text" name="image_url" class="form-control" placeholder="https://…"
           value="{{ old('image_url', $b->image_url ?? '') }}">
</div>

<div class="form-group">
    <label>Link (optional)</label>
    <input type="text" name="link" class="form-control" placeholder="Where tapping the banner goes"
           value="{{ old('link', $b->link ?? '') }}">
</div>

<div class="form-row">
    <div class="form-group col-6">
        <label>Sort Order</label>
        <input type="number" min="0" name="sort_order" class="form-control"
               value="{{ old('sort_order', $b->sort_order ?? 0) }}">
    </div>
    <div class="form-group col-6">
        <label>Expires At</label>
        <input type="datetime-local" name="expires_at" class="form-control"
               value="{{ old('expires_at', optional($b->expires_at ?? null)->format('Y-m-d\TH:i')) }}">
    </div>
</div>

<div class="form-group">
    <label>
        <input type="checkbox" name="is_active" value="1"
               {{ old('is_active', ($b->is_active ?? true)) ? 'checked' : '' }}> Active
    </label>
</div>
