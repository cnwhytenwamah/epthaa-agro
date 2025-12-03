<div class="form-group">
    <label>Title</label>
    <input type="text"
           name="title"
           class="form-control"
           value="{{ old('title', $service->title ?? '') }}"
           required>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea name="description"
              class="form-control"
              rows="3"
              required>{{ old('description', $service->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Details</label>
    <textarea name="details"
              class="form-control"
              rows="4">{{ old('details', $service->details ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Price</label>
    <input type="number"
           step="0.01"
           min="0"
           name="price"
           class="form-control"
           value="{{ old('price', $service->price ?? '') }}">
</div>

<div class="form-group">
    <label>Service Image</label>
    <input type="file" name="image" class="form-control">

    @if(!empty($service?->image))
        <div class="mt-2">
            <img src="{{ asset('storage/'.$service->image) }}" height="80">
        </div>
    @endif
</div>

<div class="form-group">
    <label>
        <input type="checkbox"
               name="is_active"
               value="1"
               {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
        Active
    </label>
</div>
