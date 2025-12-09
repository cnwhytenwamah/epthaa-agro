@extends('front-pages.layouts.app')

@section('title', $service->title)

@section('content')
<section class="relative bg-[url('{{ asset('assets/img/bg-hero.jpg') }}')] bg-cover bg-center text-white py-20">
    <div class="absolute inset-0 bg-blue-900/70"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <nav class="mb-6 text-sm text-blue-200">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('rvs.index') }}" class="hover:text-white">RVS</a>
            <span class="mx-2">/</span>
            <a href="{{ route('rvs.services') }}" class="hover:text-white">Services</a>
            <span class="mx-2">/</span>
            <span class="text-white">{{ $service->title }}</span>
        </nav>
        
        <h1 class="text-5xl font-bold mb-4">
            {{ $service->title }}
        </h1>

        <p class="text-xl text-blue-100 max-w-3xl">
            Learn more about our {{ $service->title }} service and how we support animal health with professional care.
        </p>

    </div>
</section>



<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                @if($service->image)
                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="w-full h-96 object-cover rounded-2xl shadow-lg mb-8">
                @else
                <div class="w-full h-96 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl shadow-lg mb-8 flex items-center justify-center">
                    <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                @endif

                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ $service->title }}</h1>
                
                <div class="prose prose-lg max-w-none mb-8">
                    <p class="text-xl text-gray-700 leading-relaxed">{{ $service->description }}</p>
                </div>

                @if($service->details)
                <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Service Details</h2>
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! nl2br(e($service->details)) !!}
                    </div>
                </div>
                @endif

                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">What's Included</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Professional consultation</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Comprehensive examination</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Detailed health report</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Treatment recommendations</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Follow-up support</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Expert advice and guidance</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        Frequently Asked Questions
                    </h2>

                    <div class="space-y-4">

                        <details class="group border-b pb-4">
                            <summary class="flex cursor-pointer items-center justify-between font-semibold text-gray-900 list-none">
                                How do I book this service?
                                
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 transition-transform duration-300 group-open:rotate-180"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"/>
                                </svg>
                            </summary>

                            <p class="text-gray-600 mt-2">
                                Simply click the "Book Now" button and fill out the appointment form.
                                Our team will contact you within 24 hours to confirm your booking.
                            </p>
                        </details>

                        <details class="group border-b pb-4">
                            <summary class="flex cursor-pointer items-center justify-between font-semibold text-gray-900 list-none">
                                Do you visit my location?

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 transition-transform duration-300 group-open:rotate-180"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"/>
                                </svg>
                            </summary>

                            <p class="text-gray-600 mt-2">
                                Yes! We provide on-site veterinary services. Our team will come directly
                                to your farm or location.
                            </p>
                        </details>

                        <details class="group border-b pb-4">
                            <summary class="flex cursor-pointer items-center justify-between font-semibold text-gray-900 list-none">
                                What should I prepare before the visit?

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 transition-transform duration-300 group-open:rotate-180"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"/>
                                </svg>
                            </summary>

                            <p class="text-gray-600 mt-2">
                                Please have your animals accessible and any previous medical records
                                ready. Provide a clean, well-lit area for examination if possible.
                            </p>
                        </details>

                        <details class="group pb-4">
                            <summary class="flex cursor-pointer items-center justify-between font-semibold text-gray-900 list-none">
                                Is emergency service available?

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 transition-transform duration-300 group-open:rotate-180"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"/>
                                </svg>
                            </summary>

                            <p class="text-gray-600 mt-2">
                                Yes, we offer 24/7 emergency veterinary services. Contact us immediately
                                via phone or WhatsApp for urgent cases.
                            </p>
                        </details>

                    </div>
                </div>

            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-8 sticky top-24">
                    @if($service->price)
                    <div class="mb-6 pb-6 border-b">
                        <p class="text-sm text-gray-600 mb-1">Starting from:</p>
                        <p class="text-4xl font-bold text-blue-600">₦{{ number_format($service->price, 2) }}</p>
                    </div>
                    @endif

                    <a href="{{ route('bookings.create', $service->slug) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-4 rounded-lg font-semibold transition mb-4 text-lg">
                        Book This Service
                    </a>

                    <a href="https://wa.me/{{ env('WHATSAPP_NUMBER') }}?text=I'm interested in {{ $service->title }}" target="_blank" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-4 rounded-lg font-semibold transition mb-6 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        WhatsApp Inquiry
                    </a>

                    <div class="space-y-3 pt-6 border-t">
                        <h3 class="font-bold text-gray-900 mb-4">Service Features:</h3>
                        
                        <div class="flex items-center text-sm text-gray-700">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>On-site service available</span>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-700">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Licensed professionals</span>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-700">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Follow-up care included</span>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-700">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Emergency support</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t">
                        <p class="text-sm text-gray-600 text-center mb-2">Need Help?</p>
                        <p class="text-sm font-semibold text-gray-900 text-center">Call: {{ env('WHATSAPP_NUMBER') }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 mt-6">
                    <h3 class="font-bold text-gray-900 mb-4">Other Services</h3>
                    <a href="{{ route('rvs.services') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                        View All Services →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection