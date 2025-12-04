@extends('admin.layout.app')

@section('content')

{{-- ===== Header ===== --}}
<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Categories Management</h2>
                <h5 class="text-white op-7 mb-2">View, add, edit and manage product categories (JVS)</h5>
            </div>

            <div class="ml-md-auto mt-3 mt-md-0">
                <a href="{{ route('admin.categories.create') }}"
                   class="btn btn-round"
                   style="background-color:#10b981;color:#fff;">
                    <i class="fas fa-plus"></i> Add Category
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ===== Body ===== --}}
<div class="page-inner mt--5">

    {{-- ===== Stats ===== --}}
    <div class="row">

        <div class="col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center bubble-shadow-small">
                                <i class="fas fa-layer-group text-pink"></i>
                            </div>
                        </div>
                        <div class="col ml-3">
                            <div class="numbers">
                                <p class="card-category">Total Categories</p>
                                <h4 class="card-title">{{ $statistics['total_categories'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center bubble-shadow-small">
                                <i class="fas fa-check-circle text-pink"></i>
                            </div>
                        </div>
                        <div class="col ml-3">
                            <div class="numbers">
                                <p class="card-category">Active</p>
                                <h4 class="card-title">{{ $statistics['active_categories'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center bubble-shadow-small">
                                <i class="fas fa-times-circle text-pink"></i>
                            </div>
                        </div>
                        <div class="col ml-3">
                            <div class="numbers">
                                <p class="card-category">Inactive</p>
                                <h4 class="card-title">{{ $statistics['inactive_categories'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center bubble-shadow-small">
                                <i class="fas fa-boxes text-pink"></i>
                            </div>
                        </div>
                        <div class="col ml-3">
                            <div class="numbers">
                                <p class="card-category">With Products</p>
                                <h4 class="card-title">{{ $statistics['categories_with_products'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== Categories Table ===== --}}
    <div class="row mt-4">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Categories List</h4>

                        {{-- Search --}}
                        <form method="GET"
                              action="{{ route('admin.categories.index') }}"
                              class="ml-md-auto form-inline">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control mr-2"
                                   placeholder="Search categories...">
                            <button class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">

                    {{-- Alerts --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="table-responsive">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Products</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($categories as $category)

                                <tr>
                                    <td>#{{ $category->id }}</td>

                                    <td>
                                        <strong>{{ $category->name }}</strong><br>
                                        <small class="text-muted">{{ $category->slug }}</small>
                                    </td>

                                    <td>
                                        {{ Str::limit($category->description, 60) }}
                                    </td>

                                    <td>
                                        <span class="badge badge-info">
                                            {{ $category->products_count }} Products
                                        </span>
                                    </td>

                                    <td>
                                        @if($category->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $category->created_at->format('M d, Y') }}
                                    </td>

                                    <td>
                                        <div class="btn-group">

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                               class="btn btn-sm btn-info"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Toggle --}}
                                            <form action="{{ route('admin.categories.toggle-status', $category) }}"
                                                  method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-warning" title="Toggle Status">
                                                    <i class="fas fa-sync"></i>
                                                </button>
                                            </form>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this category?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        No categories found
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>
                        </table>

                    </div>

                    {{-- ===== Pagination ===== --}}
                    <div class="mt-3">
                        {{ $categories->links() }}
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection