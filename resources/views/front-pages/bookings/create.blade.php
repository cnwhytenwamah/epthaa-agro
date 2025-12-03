@extends('front-pages.layouts.app')

@section('title', 'Book a Service')

@section('content')
<section class="relative bg-[url('assets/img/bg-hero.jpg')] bg-cover bg-center text-gray-500 py-16">    
    <div class="absolute inset-0 bg-black/50"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Book Veterinary Service</h1>

        <p class="text-xl text-gray-500">Professional care for your animals</p>
    </div>
</section>

<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Service *</label>
                    <select name="service_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('service_id') border-red-500 @enderror">
                        <option value="">Choose a service...</option>
                        @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ ($selectedService && $selectedService->id == $service->id) || old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->title }}
                            @if($service->price)
                            - ₦{{ number_format($service->price, 2) }}
                            @endif
                        </option>
                        @endforeach
                    </select>
                    @error('service_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Name *</label>
                        <input type="text" name="client_name" value="{{ old('client_name', auth()->user()->name ?? '') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('client_name') border-red-500 @enderror">
                        @error('client_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                        <input type="tel" name="client_phone" value="{{ old('client_phone') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('client_phone') border-red-500 @enderror">
                        @error('client_phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="client_email" value="{{ old('client_email', auth()->user()->email ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('client_email') border-red-500 @enderror">
                        @error('client_email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Animal/Farm Type *</label>
                        <input type="text" name="animal_type" value="{{ old('animal_type') }}" required placeholder="e.g., Cattle, Poultry, Goat, etc." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('animal_type') border-red-500 @enderror">
                        @error('animal_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Date *</label>
                        <input type="date" name="preferred_date" value="{{ old('preferred_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('preferred_date') border-red-500 @enderror">
                        @error('preferred_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Time</label>
                        <input type="time" name="preferred_time" value="{{ old('preferred_time') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('preferred_time') border-red-500 @enderror">
                        @error('preferred_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Location/Address *</label>
                    <textarea name="location" rows="2" required placeholder="Enter your farm/location address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('location') border-red-500 @enderror">{{ old('location') }}</textarea>
                    @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Issue Description *</label>
                    <textarea name="issue_description" rows="5" required placeholder="Please describe the issue or reason for the appointment (minimum 20 characters)" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('issue_description') border-red-500 @enderror">{{ old('issue_description') }}</textarea>
                    <p class="text-sm text-gray-600 mt-1">Provide as much detail as possible to help us prepare for your visit</p>
                    @error('issue_description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <strong>Note:</strong> Your booking request will be reviewed by our team. We'll contact you within 24 hours to confirm your appointment.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-[#10b981] hover:bg-[#059669] text-white py-4 rounded-lg font-semibold transition text-lg">
                        Submit Booking Request
                    </button>
                    <a href="{{ route('rvs.services') }}" class="px-6 py-4 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Contact Alternative -->
        <div class="mt-8 text-center">
            <p class="text-gray-600 mb-4">Prefer to speak with someone directly?</p>
            <a href="https://wa.me/{{ env('WHATSAPP_NUMBER') }}" target="_blank" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                Chat on WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection