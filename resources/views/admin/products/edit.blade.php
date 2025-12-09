@extends('admin.layout.app')

@section('content')

<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Edit Product</h2>
                <h5 class="text-white op-7 mb-2">{{ $product->name }}</h5>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="removed_images" id="removed_images">

                        <div class="row">

                            {{-- Product Name --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                                </div>
                            </div>

                            {{-- SKU --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" @selected($product->category_id == $cat->id)>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price (₦)</label>
                                    <input name="price" type="number" step="0.01" class="form-control" value="{{ old('price', $product->price) }}" required>
                                </div>
                            </div>

                            {{-- Stock Quantity --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stock Quantity</label>
                                    <input name="stock_quantity" type="number" class="form-control" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>

                            {{-- Usage Instructions --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Usage Instructions</label>
                                    <textarea name="usage_instructions" class="form-control" rows="2">{{ old('usage_instructions', $product->usage_instructions) }}</textarea>
                                </div>
                            </div>

                            {{-- Dosage Info --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dosage Info</label>
                                    <textarea name="dosage_info" class="form-control" rows="2">{{ old('dosage_info', $product->dosage_info) }}</textarea>
                                </div>
                            </div>

                            {{-- Safety Info --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Safety Info</label>
                                    <textarea name="safety_info" class="form-control" rows="2">{{ old('safety_info', $product->safety_info) }}</textarea>
                                </div>
                            </div>

                            {{-- Packaging Info --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Packaging Info</label>
                                    <input name="packaging_info" type="text" class="form-control" value="{{ old('packaging_info', $product->packaging_info) }}">
                                </div>
                            </div>

                            {{-- Existing Images --}}
                            @if(!empty($product->images))
                                <div class="col-12 mt-3">
                                    <label class="fw-bold">Current Images</label>
                                    <div class="d-flex flex-wrap mt-2" id="imageWrap">
                                        @foreach($product->images as $img)
                                            <div class="position-relative m-2" data-image="{{ $img }}">
                                                <img src="{{ asset($img) }}" width="120" class="img-thumbnail">
                                                <button type="button" class="btn btn-danger btn-sm position-absolute" style="top:-8px; right:-8px" onclick="removeImage(this)">×</button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Add New Images --}}
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label>Add New Images</label>
                                    <input type="file" name="images[]" multiple class="form-control">
                                </div>
                            </div>

                            {{-- Toggles --}}
                            <div class="col-md-6 mt-2">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" value="1" id="is_active" style="opacity:1 !important; position:static !important;" {{ $product->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" name="is_featured" class="form-check-input" value="1" id="is_featured" style="opacity:1 !important; position:static !important;" {{ $product->is_featured ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">Featured</label>
                                </div>
                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="text-right mt-4">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn ml-2" style="background-color: #10b981; color: #fff;">Update Product</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let removedImages = []

    function removeImage(btn){
        let parent = btn.closest('[data-image]')
        let path   = parent.getAttribute('data-image')

        removedImages.push(path)
        document.getElementById('removed_images').value = JSON.stringify(removedImages)

        parent.remove()
    }
</script>
@endsection
