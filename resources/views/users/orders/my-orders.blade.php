@extends('front-pages.layouts.app')

@section('title', 'My Orders')

@section('content')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">My Orders</h1>
                <p class="text-gray-600 mt-2">Track and manage your product orders</p>
            </div>
            <a href="{{ route('shop.index') }}" class="bg-primary hover:bg-secondary text-white px-6 py-3 rounded-lg font-semibold transition">
                Continue Shopping
            </a>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Orders</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $orders->total() }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Pending</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $orders->where('order_status', 'pending')->count() }}</p>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Processing</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $orders->where('order_status', 'processing')->count() }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Delivered</p>
                        <p class="text-3xl font-bold text-green-600">{{ $orders->where('order_status', 'delivered')->count() }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders List -->
        @forelse($orders as $order)
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4 hover:shadow-lg transition">
            <!-- Order Header -->
            <div class="bg-gray-50 px-6 py-4 border-b flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex flex-wrap items-center gap-4 mb-2 md:mb-0">
                    <div>
                        <p class="text-sm text-gray-600">Order Number</p>
                        <p class="font-bold text-gray-900">{{ $order->order_number }}</p>
                    </div>
                    <div class="border-l pl-4">
                        <p class="text-sm text-gray-600">Order Date</p>
                        <p class="font-medium text-gray-900">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="border-l pl-4">
                        <p class="text-sm text-gray-600">Total Amount</p>
                        <p class="font-bold text-primary">₦{{ number_format($order->total, 2) }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                        @if($order->order_status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->order_status === 'processing') bg-blue-100 text-blue-800
                        @elseif($order->order_status === 'shipped') bg-indigo-100 text-indigo-800
                        @elseif($order->order_status === 'delivered') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($order->order_status) }}
                    </span>
                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                        @if($order->payment_status === 'paid') bg-green-100 text-green-800
                        @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-center gap-4 pb-4 border-b last:border-b-0">
                        @if($item->product && $item->product->images && count($item->product->images) > 0)
                        <img src="{{ Storage::url($item->product->images[0]) }}" alt="{{ $item->product_name }}" class="w-20 h-20 object-cover rounded-lg">
                        @else
                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        @endif
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 mb-1">{{ $item->product_name }}</h4>
                            <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                            <p class="text-sm text-gray-600">Price: ₦{{ number_format($item->price, 2) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900">₦{{ number_format($item->subtotal, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="mt-6 pt-6 border-t">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="font-medium text-gray-900">₦{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Delivery Fee:</span>
                        <span class="font-medium text-gray-900">₦{{ number_format($order->delivery_fee, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold pt-2 border-t">
                        <span class="text-gray-900">Total:</span>
                        <span class="text-primary">₦{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                <!-- Delivery Information -->
                <div class="mt-6 bg-gray-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-3">Delivery Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600 mb-1">Recipient</p>
                            <p class="font-medium text-gray-900">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Phone</p>
                            <p class="font-medium text-gray-900">{{ $order->customer_phone }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-600 mb-1">Address</p>
                            <p class="font-medium text-gray-900">{{ $order->delivery_address }}, {{ $order->city }}, {{ $order->state }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('orders.show', $order) }}" class="flex-1 md:flex-none bg-primary hover:bg-secondary text-white px-6 py-2 rounded-lg font-medium transition text-center">
                        View Details
                    </a>
                    @if($order->order_status !== 'delivered' && $order->order_status !== 'cancelled')
                    <a href="https://wa.me/{{ env('WHATSAPP_NUMBER') }}?text=Hi, I need help with order {{ $order->order_number }}" target="_blank" class="flex-1 md:flex-none bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition text-center">
                        Contact Support
                    </a>
                    @endif
                    @if($order->payment_status === 'paid')
                    <button onclick="alert('Download invoice feature will be implemented')" class="flex-1 md:flex-none bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium transition">
                        Download Invoice
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Orders Yet</h3>
            <p class="text-gray-600 mb-6">You haven't placed any orders yet</p>
            <a href="{{ route('shop.index') }}" class="inline-block bg-primary hover:bg-secondary text-white px-8 py-3 rounded-lg font-semibold transition">
                Start Shopping
            </a>
        </div>
        @endforelse

        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</section>
@endsection