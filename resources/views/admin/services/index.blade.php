@extends('admin.layout.app')

@section('content')  
{{-- Header --}}
<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Manage Services</h2>
                <h5 class="text-white op-7 mb-2">Create, edit and remove services</h5>
            </div>
            <div class="ml-md-auto">
                <a href="{{ route('admin.services.create') }}" class="btn btn-success btn-round">
                    <i class="fas fa-plus"></i> Add Service
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Body --}}
<div class="page-inner mt--5"> 

{{-- Alerts --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Services</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="width:160px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>

                                <td>
                                    @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}"
                                             width="45" height="45" class="rounded">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>

                                <td>{{ $service->title }}</td>

                                <td>
                                    {{ $service->price ? '₦'.number_format($service->price,2) : 'Free' }}
                                </td>

                                <td>
                                    @if($service->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>{{ $service->created_at->format('M d, Y') }}</td>

                                <td>
                                    <div class="btn-group">

                                        <a href="{{ route('admin.services.edit',$service) }}"
                                           class="btn btn-sm btn-info"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form method="POST"
                                              action="{{ route('admin.services.destroy', $service) }}"
                                              onsubmit="return confirm('Delete this service?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    No services found
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $services->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection