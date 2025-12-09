@extends('admin.layout.app')

@section('content')

{{-- ===== Header ===== --}}
<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="">
                <h2 class="text-white pb-2 fw-bold">Add Product</h2>
                <h5 class="text-white op-7 mb-2">Create a new veterinary product</h5>
            </div>
        </div>
    </div>
</div>

{{-- ===== Body ===== --}}
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            {{-- Product Name --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input name="name" type="text" class="form-control"
                                           value="{{ old('name') }}" required>
                                </div>
                            </div>

                            {{-- SKU --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input name="sku" type="text" class="form-control"
                                           value="{{ old('sku') }}" required>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price (₦)</label>
                                    <input name="price" type="number" step="0.01"
                                           class="form-control"
                                           value="{{ old('price') }}" required>
                                </div>
                            </div>

                            {{-- Stock --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stock Quantity</label>
                                    <input name="stock_quantity"
                                           type="number"
                                           class="form-control"
                                           value="{{ old('stock_quantity') }}" required>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description"
                                              class="form-control"
                                              rows="3"
                                              required>{{ old('description') }}</textarea>
                                </div>
                            </div>

                            {{-- Usage --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Usage Instructions</label>
                                    <textarea name="usage_instructions" class="form-control" rows="2"></textarea>
                                </div>
                            </div>

                            {{-- Dosage --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dosage Info</label>
                                    <textarea name="dosage_info" class="form-control" rows="2"></textarea>
                                </div>
                            </div>

                            {{-- Safety --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Safety Info</label>
                                    <textarea name="safety_info" class="form-control" rows="2"></textarea>
                                </div>
                            </div>

                            {{-- Packaging --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Packaging Info</label>
                                    <input name="packaging_info" type="text" class="form-control">
                                </div>
                            </div>

                            {{-- Images --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Images</label>
                                    <input name="images" type="file"
                                            class="form-control">
                                </div>
                            </div>

                            {{-- Toggles --}}
                            <div class="col-md-6 mt-2">
                                <div class="form-check">
                                    <input value="1" type="checkbox" name="is_active" class="form-check-input" checked style="opacity:1 !important; position:static !important;" id="is_active">
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input value="1" type="checkbox" name="is_featured" class="form-check-input" style="opacity:1 !important; position:static !important;" id="is_featured">
                                    <label class="form-check-label" for="is_featured">
                                        Featured
                                    </label>
                                </div>
                            </div>


                        </div>

                        {{-- Buttons --}}
                        <div class="text-right mt-4">
                            <a href="{{ route('admin.products.index') }}"
                               class="btn btn-danger">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn ml-2" style="background-color: #10b981; color: #fff;">
                                Create Product
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
