@extends('front-pages.layouts.app')

@section('title', 'Order #' . $order->order_number)

@section('content')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('orders.my-orders') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Orders
            </a>
        </div>

        <!-- Order Header -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Order #{{ $order->order_number }}</h1>
                    <p class="text-gray-600">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div class="mt-4 md:mt-0 flex flex-col items-end gap-2">
                    <span class="inline-flex px-4 py-2 text-sm font-semibold rounded-full
                        @if($order->order_status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->order_status === 'processing') bg-blue-100 text-blue-800
                        @elseif($order->order_status === 'shipped') bg-indigo-100 text-indigo-800
                        @elseif($order->order_status === 'delivered') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($order->order_status) }}
                    </span>
                    <span class="inline-flex px-4 py-2 text-sm font-semibold rounded-full
                        @if($order->payment_status === 'paid') bg-green-100 text-green-800
                        @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif">
                        Payment: {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>

            <!-- Order Progress -->
            <div class="relative">
                <div class="absolute top-5 left-0 right-0 h-1 bg-gray-200"></div>
                <div class="absolute top-5 left-0 h-1 bg-primary transition-all duration-500" 
                    style="width: {{ $order->order_status === 'pending' ? '0%' : ($order->order_status === 'processing' ? '33%' : ($order->order_status === 'shipped' ? '66%' : '100%')) }}">
                </div>
                
                <div class="relative flex justify-between">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full {{ in_array($order->order_status, ['pending', 'processing', 'shipped', 'delivered']) ? 'bg-primary' : 'bg-gray-300' }} flex items-center justify-center text-white mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 text-center">Order<br>Placed</p>
                    </div>
                    
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full {{ in_array($order->order_status, ['processing', 'shipped', 'delivered']) ? 'bg-primary' : 'bg-gray-300' }} flex items-center justify-center text-white mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 text-center">Processing</p>
                    </div>
                    
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full {{ in_array($order->order_status, ['shipped', 'delivered']) ? 'bg-primary' : 'bg-gray-300' }} flex items-center justify-center text-white mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 text-center">Shipped</p>
                    </div>
                    
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full {{ $order->order_status === 'delivered' ? 'bg-primary' : 'bg-gray-300' }} flex items-center justify-center text-white mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 text-center">Delivered</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Order Items</h2>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex items-center gap-4 pb-4 border-b last:border-b-0">
                    @if($item->product && $item->product->images && count($item->product->images) > 0)
                    <img src="{{ Storage::url($item->product->images[0]) }}" alt="{{ $item->product_name }}" class="w-24 h-24 object-cover rounded-lg">
                    @else
                    <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    @endif
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $item->product_name }}</h3>
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <span>Qty: {{ $item->quantity }}</span>
                            <span>Price: ₦{{ number_format($item->price, 2) }}</span>
                        </div>
                        @if($item->product)
                        <a href="{{ route('shop.show', $item->product->slug) }}" class="text-sm text-primary hover:text-secondary mt-2 inline-block">
                            View Product →
                        </a>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900 text-lg">₦{{ number_format($item->subtotal, 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Total -->
            <div class="mt-6 pt-6 border-t space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal:</span>
                    <span class="font-medium text-gray-900">₦{{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Delivery Fee:</span>
                    <span class="font-medium text-gray-900">₦{{ number_format($order->delivery_fee, 2) }}</span>
                </div>
                <div class="flex justify-between text-xl font-bold pt-2 border-t">
                    <span class="text-gray-900">Total:</span>
                    <span class="text-primary">₦{{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Delivery & Payment Info -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Delivery Information -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Delivery Information
                </h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600 mb-1">Recipient</p>
                        <p class="font-medium text-gray-900">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Phone</p>
                        <p class="font-medium text-gray-900">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Email</p>
                        <p class="font-medium text-gray-900">{{ $order->customer_email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Delivery Address</p>
                        <p class="font-medium text-gray-900">{{ $order->delivery_address }}</p>
                        <p class="font-medium text-gray-900">{{ $order->city }}, {{ $order->state }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Payment Information
                </h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600 mb-1">Payment Method</p>
                        <p class="font-medium text-gray-900">{{ ucfirst($order->payment_method) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Payment Status</p>
                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                            @if($order->payment_status === 'paid') bg-green-100 text-green-800
                            @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                    @if($order->payment_reference)
                    <div>
                        <p class="text-gray-600 mb-1">Payment Reference</p>
                        <p class="font-medium text-gray-900 font-mono text-xs">{{ $order->payment_reference }}</p>
                    </div>
                    @endif
                </div>

                @if($order->payment_status === 'paid')
                <button onclick="alert('Download invoice feature will be implemented')" class="mt-6 w-full bg-primary hover:bg-secondary text-white py-3 rounded-lg font-semibold transition">
                    Download Invoice
                </button>
                @endif
            </div>
        </div>

        <!-- Need Help Section -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-1">
                    <h4 class="text-lg font-bold text-blue-900 mb-2">Need Help with Your Order?</h4>
                    <p class="text-blue-800 mb-4">Our support team is here to assist you with any questions or concerns.</p>
                    <div class="flex gap-3">
                        <a href="tel:{{ env('WHATSAPP_NUMBER') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                            Call Support
                        </a>
                        <a href="https://wa.me/{{ env('WHATSAPP_NUMBER') }}?text=Hi, I need help with order {{ $order->order_number }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition">
                            WhatsApp Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection