@extends('admin.layout.app')

@section('content')

{{-- ===== Header ===== --}}
<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Edit Category</h2>
                <h5 class="text-white op-7 mb-2">Update category information</h5>
            </div>

            <div class="ml-md-auto mt-3 mt-md-0">
                <a href="{{ route('admin.categories.index') }}"
                   class="btn btn-round btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Categories
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ===== Body ===== --}}
<div class="page-inner mt--5">

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">Edit Category</h4>
                </div>

                <div class="card-body">

                    {{-- Alerts --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('admin.categories.update', $category) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Category Name --}}
                        <div class="form-group">
                            <label>Category Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $category->name) }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description"
                                      rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Describe this category...">{{ old('description', $category->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Current Image Preview --}}
                        @if($category->image)
                            <div class="form-group">
                                <label>Current Image</label>
                                <div class="mb-2">
                                    <img src="{{ Storage::url($category->image) }}"
                                         alt="{{ $category->name }}"
                                         style="max-width:140px"
                                         class="img-thumbnail">
                                </div>
                            </div>
                        @endif

                        {{-- Image Upload --}}
                        <div class="form-group">
                            <label>Update Image</label>
                            <input type="file"
                                   name="image"
                                   accept="image/*"
                                   class="form-control-file @error('image') is-invalid @enderror">

                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <small class="form-text text-muted">
                                Leave empty to keep the current image
                            </small>
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       class="custom-control-input"
                                       id="activeCheck"
                                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}>

                                <label class="custom-control-label" for="activeCheck">
                                    Active (Category is visible)
                                </label>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="form-group text-right">

                            <a href="{{ route('admin.categories.index') }}"
                               class="btn btn-secondary mr-2">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn btn-info">
                                <i class="fas fa-save"></i> Update Category
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection