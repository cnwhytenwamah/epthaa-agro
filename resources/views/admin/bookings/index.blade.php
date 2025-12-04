@extends('admin.layout.app')

@section('content')

{{-- ===== Header ===== --}}
<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Bookings Management</h2>
                <h5 class="text-white op-7 mb-2">View, manage, and update veterinary service appointments</h5>
            </div>
        </div>
    </div>
</div>

{{-- ===== Body ===== --}}
<div class="page-inner mt--5">

    {{-- ===== Filter & Stats Row ===== --}}
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center flex-wrap">

            {{-- Status Filter --}}
            <form method="GET" action="{{ route('admin.bookings.index') }}" class="form-inline mb-3">
                <select name="status" class="form-control mr-2" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @if(request('status'))
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Clear</a>
                @endif
            </form>

        </div>
    </div>

    {{-- ===== Bookings Table ===== --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">All Bookings</h4>
                </div>

                <div class="card-body">

                    {{-- Alerts --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Service</th>
                                    <th>Animal Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td>#{{ $booking->id }}</td>
                                        <td>
                                            <strong>{{ $booking->client_name }}</strong><br>
                                            <small class="text-muted">{{ $booking->client_phone }}</small>
                                        </td>
                                        <td>{{ $booking->service->title }}</td>
                                        <td>{{ $booking->animal_type }}</td>
                                        <td>
                                            {{ $booking->preferred_date->format('M d, Y') }}
                                            @if($booking->preferred_time)
                                                <br>
                                                <small class="text-muted">{{ date('h:i A', strtotime($booking->preferred_time)) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'badge-warning',
                                                    'confirmed' => 'badge-primary',
                                                    'completed' => 'badge-success',
                                                    'cancelled' => 'badge-danger'
                                                ];
                                            @endphp
                                            <span class="badge {{ $statusClasses[$booking->status] ?? 'badge-secondary' }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">

                                                {{-- View --}}
                                                <a href="{{ route('admin.bookings.show', $booking) }}"
                                                   class="btn btn-sm btn-info"
                                                   title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                {{-- Call --}}
                                                <a href="tel:{{ $booking->client_phone }}"
                                                   class="btn btn-sm btn-success"
                                                   title="Call Client">
                                                    <i class="fas fa-phone"></i>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('admin.bookings.destroy', $booking) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            No bookings found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $bookings->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ===== Statistics Row ===== --}}
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body text-center">
                    <p class="card-category">Total Bookings</p>
                    <h4 class="card-title">{{ $bookings->total() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body text-center">
                    <p class="card-category">Pending</p>
                    <h4 class="card-title">{{ $bookings->where('status', 'pending')->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body text-center">
                    <p class="card-category">Confirmed</p>
                    <h4 class="card-title">{{ $bookings->where('status', 'confirmed')->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body text-center">
                    <p class="card-category">Completed</p>
                    <h4 class="card-title">{{ $bookings->where('status', 'completed')->count() }}</h4>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
