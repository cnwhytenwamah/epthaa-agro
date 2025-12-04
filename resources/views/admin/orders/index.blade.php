@extends('admin.layout.app')

@section('content')

<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Orders</h2>
                <h5 class="text-white op-7 mb-2">Manage all customer orders</h5>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2">

                <div class="col-md-3">
                    <input type="text" name="search"
                           class="form-control"
                           value="{{ request('search') }}"
                           placeholder="Order ID or customer">
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                        <option value="processing" {{ request('status')=='processing'?'selected':'' }}>Processing</option>
                        <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Completed</option>
                        <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="date" name="date"
                           class="form-control"
                           value="{{ request('date') }}">
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button class="btn w-100" style="background-color: #10b981; color: #fff;">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>

                    @if(request()->hasAny(['search','status','date']))
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary w-100">
                            Clear
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </div>

    {{-- Orders Table --}}
    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th width="130">Actions</th>
                </tr>
                </thead>

                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>
                            <strong>{{ $order->customer_name }}</strong><br>
                            <small>{{ $order->customer_phone }}</small>
                        </td>
                        <td>₦{{ number_format($order->total_amount, 2) }}</td>

                        <td>
                            <span class="badge
                                @if($order->status=='pending') badge-warning
                                @elseif($order->status=='processing') badge-info
                                @elseif($order->status=='completed') badge-success
                                @else badge-danger @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td>
                            {{ ucfirst($order->payment_method) }}
                        </td>

                        <td>
                            {{ $order->created_at->format('M d, Y') }}
                        </td>

                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="btn btn-sm btn-primary">
                                View
                            </a>

                            <a href="{{ route('admin.orders.invoice', $order) }}"
                               class="btn btn-sm btn-secondary">
                                Invoice
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            No orders found
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

            {{-- Pagination --}}
            {{ $orders->links() }}

        </div>
    </div>

</div>
@endsection
