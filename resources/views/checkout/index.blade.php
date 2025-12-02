@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Checkout</h1>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Checkout Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Delivery Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('customer_name') border-red-500 @enderror">
                                @error('customer_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('customer_email') border-red-500 @enderror">
                                @error('customer_email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('customer_phone') border-red-500 @enderror">
                                @error('customer_phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                <input type="text" name="city" value="{{ old('city') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('city') border-red-500 @enderror">
                                @error('city')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                                <select name="state" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('state') border-red-500 @enderror">
                                    <option value="">Select State</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Abuja">Abuja</option>
                                    <option value="Kano">Kano</option>
                                    <option value="Rivers">Rivers</option>
                                    <option value="Oyo">Oyo</option>
                                    <option value="Kaduna">Kaduna</option>
                                    <!-- Add more states -->
                                </select>
                                @error('state')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Delivery Address *</label>
                                <textarea name="delivery_address" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('delivery_address') border-red-500 @enderror">{{ old('delivery_address') }}</textarea>
                                @error('delivery_address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Payment Method</h2>

                        <div class="space-y-4">
                            <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-primary transition">
                                <input type="radio" name="payment_method" value="paystack" checked class="w-5 h-5 text-primary">
                                <div class="ml-4 flex-1">
                                    <p class="font-semibold text-gray-900">Pay with Paystack</p>
                                    <p class="text-sm text-gray-600">Secure payment with card, bank transfer, or USSD</p>
                                </div>
                                <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 10h18v11H3V10zm0-2V5a2 2 0 012-2h14a2 2 0 012 2v3H3z"/>
                                </svg>
                            </label>

                            <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-primary transition">
                                <input type="radio" name="payment_method" value="flutterwave" class="w-5 h-5 text-primary">
                                <div class="ml-4 flex-1">
                                    <p class="font-semibold text-gray-900">Pay with Flutterwave</p>
                                    <p class="text-sm text-gray-600">Multiple payment options available</p>
                                </div>
                                <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 10h18v11H3V10zm0-2V5a2 2 0 012-2h14a2 2 0 012 2v3H3z"/>
                                </svg>
                            </label>

                            <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-primary transition">
                                <input type="radio" name="payment_method" value="cash" class="w-5 h-5 text-primary">
                                <div class="ml-4 flex-1">
                                    <p class="font-semibold text-gray-900">Pay on Delivery</p>
                                    <p class="text-sm text-gray-600">Pay with cash when your order arrives</p>
                                </div>
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>

                        <div class="space-y-3 mb-6 pb-6 border-b max-h-64 overflow-y-auto">
                            @foreach($cart as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-700">{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                <span class="font-semibold">₦{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="space-y-3 mb-6 pb-6 border-b">
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal</span>
                                <span class="font-semibold">₦{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>Delivery Fee</span>
                                <span class="font-semibold">₦{{ number_format($deliveryFee, 2) }}</span>
                            </div>
                        </div>

                        <div class="flex justify-between text-xl font-bold text-gray-900 mb-6">
                            <span>Total</span>
                            <span class="text-primary">₦{{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-secondary text-white py-4 rounded-lg font-semibold transition text-lg">
                            Place Order
                        </button>

                        <p class="text-xs text-gray-600 text-center mt-4">
                            By placing your order, you agree to our terms and conditions
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection