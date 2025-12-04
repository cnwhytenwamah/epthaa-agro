@extends('admin.layout.app')

@section('content')

{{-- ===== Header ===== --}}
<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Create Category</h2>
                <h5 class="text-white op-7 mb-2">Add a new product category</h5>
            </div>

            <div class="ml-md-auto mt-3 mt-md-0">
                <a href="{{ route('admin.categories.index') }}"
                   class="btn btn-round" style="background-color: #10b981; color: #fff;">
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
                    <h4 class="card-title">New Category Form</h4>
                </div>

                <div class="card-body">

                    {{-- Alerts --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('admin.categories.store') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        {{-- Category Name --}}
                        <div class="form-group">
                            <label>Category Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
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
                                      placeholder="Describe this category...">{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="form-group">
                            <label>Category Image</label>
                            <input type="file"
                                   name="image"
                                   accept="image/*"
                                   class="form-control-file @error('image') is-invalid @enderror">

                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <small class="form-text text-muted">
                                Recommended size: 400×400px
                            </small>
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       checked
                                       class="custom-control-input"
                                       id="activeCheck">

                                <label class="custom-control-label" for="activeCheck">
                                    Active (Category is visible)
                                </label>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="form-group text-right">

                            <a href="{{ route('admin.categories.index') }}"
                               class="btn btn-danger mr-2">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn " style="background-color: #10b981; color: #fff;">
                                <i class="fas fa-save"></i> Create Category
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
