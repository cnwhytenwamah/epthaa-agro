@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

        @if(empty($cart))
        <div class="text-center py-16 bg-white rounded-lg shadow-md">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Your cart is empty</h3>
            <p class="text-gray-600 mb-6">Add some products to get started!</p>
            <a href="{{ route('shop.index') }}" class="inline-block bg-primary hover:bg-secondary text-white px-8 py-3 rounded-lg font-semibold transition">
                Continue Shopping
            </a>
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @foreach($cart as $id => $item)
                    <div class="p-6 border-b last:border-b-0 hover:bg-gray-50 transition">
                        <div class="flex gap-6">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                @if($item['image'])
                                <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-lg">
                                @else
                                <div class="w-24 h-24 bg-gray-200 rounded-lg"></div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $item['name'] }}</h3>
                                <p class="text-2xl font-bold text-primary mb-4">₦{{ number_format($item['price'], 2) }}</p>

                                <div class="flex items-center gap-4">
                                    <!-- Quantity Update -->
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <label class="text-sm text-gray-600">Qty:</label>
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                        <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition">
                                            Update
                                        </button>
                                    </form>

                                    <!-- Remove Button -->
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-medium">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Subtotal -->
                            <div class="flex-shrink-0 text-right">
                                <p class="text-sm text-gray-600 mb-1">Subtotal</p>
                                <p class="text-xl font-bold text-gray-900">₦{{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('shop.index') }}" class="inline-flex items-center text-primary hover:text-secondary font-semibold mt-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Continue Shopping
                </a>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6 pb-6 border-b">
                        <div class="flex justify-between text-gray-700">
                            <span>Subtotal</span>
                            <span class="font-semibold">₦{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Delivery Fee</span>
                            <span class="font-semibold">₦2,000.00</span>
                        </div>
                    </div>

                    <div class="flex justify-between text-xl font-bold text-gray-900 mb-6">
                        <span>Total</span>
                        <span class="text-primary">₦{{ number_format($total + 2000, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full bg-primary hover:bg-secondary text-white text-center py-4 rounded-lg font-semibold transition">
                        Proceed to Checkout
                    </a>

                    <p class="text-sm text-gray-600 text-center mt-4">
                        Secure checkout with multiple payment options
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection