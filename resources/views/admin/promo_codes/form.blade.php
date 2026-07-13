@php $p = $promo ?? null; @endphp

<div class="form-group">
    <label>Code <span class="text-danger">*</span></label>
    <input type="text" name="code" class="form-control text-uppercase"
           placeholder="e.g. GORIDE50" value="{{ old('code', $p->code ?? '') }}" required>
</div>

<div class="form-row">
    <div class="form-group col-6">
        <label>Discount Type <span class="text-danger">*</span></label>
        <select name="type" class="form-control" required>
            <option value="percent" {{ old('type', $p->type ?? '') === 'percent' ? 'selected' : '' }}>Percent (%)</option>
            <option value="flat" {{ old('type', $p->type ?? '') === 'flat' ? 'selected' : '' }}>Flat (৳)</option>
        </select>
    </div>
    <div class="form-group col-6">
        <label>Value <span class="text-danger">*</span></label>
        <input type="number" step="0.01" min="0" name="value" class="form-control"
               placeholder="e.g. 50" value="{{ old('value', $p->value ?? '') }}" required>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-6">
        <label>Min Fare (৳)</label>
        <input type="number" step="0.01" min="0" name="min_fare" class="form-control"
               placeholder="0" value="{{ old('min_fare', $p->min_fare ?? 0) }}">
    </div>
    <div class="form-group col-6">
        <label>Max Discount (৳)</label>
        <input type="number" step="0.01" min="0" name="max_discount" class="form-control"
               placeholder="optional (for %)" value="{{ old('max_discount', $p->max_discount ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-6">
        <label>Max Uses</label>
        <input type="number" min="0" name="max_uses" class="form-control"
               placeholder="unlimited" value="{{ old('max_uses', $p->max_uses ?? '') }}">
    </div>
    <div class="form-group col-6">
        <label>Expires At</label>
        <input type="datetime-local" name="expires_at" class="form-control"
               value="{{ old('expires_at', optional($p->expires_at ?? null)->format('Y-m-d\TH:i')) }}">
    </div>
</div>

<div class="form-group">
    <label>
        <input type="checkbox" name="is_active" value="1"
               {{ old('is_active', ($p->is_active ?? true)) ? 'checked' : '' }}> Active
    </label>
</div>
