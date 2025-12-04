@extends('admin.layout.app')

@section('content')

<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <h2 class="text-white pb-2 fw-bold">Order #{{ $order->id }}</h2>
        <h5 class="text-white op-7">Order details & purchased items</h5>
    </div>
</div>

<div class="page-inner mt--5">

<div class="row">

    {{-- Order Summary --}}
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
                <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>

                <hr>

                <p>
                    <strong>Status:</strong>
                    <span class="badge
                        @if($order->status=='pending') badge-warning
                        @elseif($order->status=='processing') badge-info
                        @elseif($order->status=='completed') badge-success
                        @else badge-danger @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>

                <p><strong>Payment:</strong> {{ ucfirst($order->payment_method) }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                <p><strong>Total:</strong> ₦{{ number_format($order->total_amount, 2) }}</p>

                <hr>

                <a href="{{ route('admin.orders.invoice', $order) }}"
                   class="btn btn-secondary btn-block">
                    <i class="fas fa-file-invoice mr-1"></i>
                    Print Invoice
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="btn btn-outline-secondary btn-block mt-2">
                    ← Back to Orders
                </a>
            </div>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Order Items</h4>
            </div>

            <div class="card-body table-responsive">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>₦{{ number_format($item->price,2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                ₦{{ number_format($item->price * $item->quantity,2) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total</th>
                            <th>₦{{ number_format($order->total_amount,2) }}</th>
                        </tr>
                    </tfoot>

                </table>

            </div>
        </div>
    </div>

</div>
</div>
@endsection