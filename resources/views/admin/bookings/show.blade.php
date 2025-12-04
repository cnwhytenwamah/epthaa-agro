@extends('admin.layout.app')

@section('content')

{{-- ===== Header ===== --}}
<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Booking #{{ $booking->id }}</h2>
                <h5 class="text-white op-7 mb-2">Details and actions for this veterinary service booking</h5>
            </div>
        </div>
    </div>
</div>

{{-- ===== Body ===== --}}
<div class="page-inner mt--5">

    <div class="row">

        {{-- ===== Main Details ===== --}}
        <div class="col-lg-8">

            {{-- Client Information --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-user mr-2"></i> Client Information
                    </h4>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <strong>Name:</strong> {{ $booking->client_name }}
                    </div>
                    <div class="col-md-6">
                        <strong>Phone:</strong> <a href="tel:{{ $booking->client_phone }}">{{ $booking->client_phone }}</a>
                    </div>
                    @if($booking->client_email)
                        <div class="col-md-6">
                            <strong>Email:</strong> <a href="mailto:{{ $booking->client_email }}">{{ $booking->client_email }}</a>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <strong>Location:</strong> {{ $booking->location }}
                    </div>
                </div>
            </div>

            {{-- Service Information --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-stethoscope mr-2"></i> Service Information
                    </h4>
                </div>
                <div class="card-body">
                    <p><strong>Service:</strong> {{ $booking->service->title }}</p>
                    <p><strong>Animal Type:</strong> {{ $booking->animal_type }}</p>
                    <p><strong>Preferred Date:</strong> {{ $booking->preferred_date->format('F d, Y') }}
                        @if($booking->preferred_time)
                            at {{ date('h:i A', strtotime($booking->preferred_time)) }}
                        @endif
                    </p>
                    <p><strong>Issue Description:</strong></p>
                    <p class="p-3 bg-light rounded">{{ $booking->issue_description }}</p>
                </div>
            </div>

            {{-- Admin Notes --}}
            @if($booking->admin_notes)
            <div class="card mb-4 border-left-primary">
                <div class="card-body">
                    <h5 class="card-title">Admin Notes</h5>
                    <p>{{ $booking->admin_notes }}</p>
                </div>
            </div>
            @endif

        </div>

        {{-- ===== Sidebar ===== --}}
        <div class="col-lg-4">

            {{-- Booking Status & Update --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Booking Status</h5>
                </div>
                <div class="card-body">

                    @php
                        $statusClasses = [
                            'pending' => 'badge-warning',
                            'confirmed' => 'badge-primary',
                            'completed' => 'badge-success',
                            'cancelled' => 'badge-danger'
                        ];
                    @endphp
                    <p>
                        <span class="badge {{ $statusClasses[$booking->status] ?? 'badge-secondary' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </p>

                    <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group mb-3">
                            <label for="status">Update Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="admin_notes">Admin Notes</label>
                            <textarea name="admin_notes" id="admin_notes" rows="4" class="form-control" placeholder="Add notes about this booking...">{{ $booking->admin_notes }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Booking</button>
                    </form>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Quick Actions</h5>
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <a href="tel:{{ $booking->client_phone }}" class="btn btn-success btn-block">
                        <i class="fas fa-phone mr-2"></i> Call Client
                    </a>
                    @if($booking->client_email)
                    <a href="mailto:{{ $booking->client_email }}" class="btn btn-primary btn-block">
                        <i class="fas fa-envelope mr-2"></i> Send Email
                    </a>
                    @endif
                    <a href="https://wa.me/{{ $booking->client_phone }}" target="_blank" class="btn btn-success btn-block">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                    </a>
                </div>
            </div>

            {{-- Booking Info --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Booking Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                    <p><strong>Created:</strong> {{ $booking->created_at->format('M d, Y') }}</p>
                    <p><strong>Last Updated:</strong> {{ $booking->updated_at->diffForHumans() }}</p>
                </div>
            </div>

            {{-- Back Button --}}
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-block">
                ← Back to Bookings
            </a>

        </div>
    </div>
</div>

@endsection