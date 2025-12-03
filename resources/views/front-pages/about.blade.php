@extends('front-pages.layouts.app')

@section('title', 'About Us')

@section('content')
<!-- Hero Section -->
<section class="relative bg-[url('assets/img/hero.jpg')] bg-cover bg-center text-gray-500 py-16">    
    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-4">About EPTHAA AGRO LIMITED</h1>

        <p class="text-xl text-gray-500">Leading the way in veterinary care and agricultural solutions</p>
    </div>
</section>

<!-- Company Overview -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Story</h2>
                <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                    EPTHAA AGRO LIMITED was founded with a vision to revolutionize animal healthcare and agricultural productivity in Nigeria. We bring together decades of veterinary expertise with modern business practices to serve farmers, ranchers, and animal owners across the country.
                </p>
                <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                    Through our two flagship brands - Ralph Veterinary Service (RVS) and Just Veterinary Service (JVS) - we provide comprehensive solutions that address every aspect of animal health and farm management.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Our commitment to excellence, integrity, and continuous innovation has made us a trusted partner for agricultural professionals throughout Nigeria.
                </p>
            </div>
            <div class="bg-gradient-to-br from-green-100 to-green-200 rounded-2xl p-8 h-96 flex items-center justify-center">
                <svg class="w-64 h-64 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Our Brands -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-gray-900 text-center mb-12">Our Brands</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- RVS -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white p-8">
                    <div class="text-center">
                        <h3 class="text-4xl font-bold mb-2">RVS</h3>
                        <p class="text-xl text-blue-100">Ralph Veterinary Service</p>
                    </div>
                </div>
                <div class="p-8">
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Our professional veterinary service division provides comprehensive animal healthcare including treatment, diagnostics, vaccination programs, farm consultancy, and breeding advisory services.
                    </p>
                    <h4 class="font-semibold text-gray-900 mb-2">Services Include:</h4>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#10b981] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Professional veterinary treatment and diagnostics</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#10b981] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Comprehensive vaccination programs</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#10b981] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Expert farm consultancy services</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#10b981] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Breeding advisory and support</span>
                        </li>
                    </ul>
                    <a href="{{ route('rvs.services') }}" class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        View Services
                    </a>
                </div>
            </div>

            <!-- JVS -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="h-48 bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center text-white p-8">
                    <div class="text-center">
                        <h3 class="text-4xl font-bold mb-2">JVS</h3>
                        <p class="text-xl text-green-100">Just Veterinary Service</p>
                    </div>
                </div>
                <div class="p-8">
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Our retail division offers a complete range of veterinary medicines, animal feeds, supplements, farming tools, and accessories to support your agricultural operations.
                    </p>
                    <h4 class="font-semibold text-gray-900 mb-2">Products Include:</h4>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#10b981] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Quality veterinary medicines and drugs</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#10b981] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Premium animal feeds and supplements</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#10b981] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Essential farming tools and equipment</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#10b981] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Animal care accessories</span>
                        </li>
                    </ul>
                    <a href="{{ route('shop.index') }}" class="inline-block mt-6 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        Shop Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-gray-900 text-center mb-12">Our Core Values</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-[#10b981] rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Professionalism</h3>
                <p class="text-gray-600">We maintain the highest standards in all our services and operations.</p>
            </div>

            <div class="text-center">
                <div class="bg-[#10b981] rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Quality</h3>
                <p class="text-gray-600">We deliver only the best products and services to our clients.</p>
            </div>

            <div class="text-center">
                <div class="bg-[#10b981] rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Integrity</h3>
                <p class="text-gray-600">Honesty and transparency guide everything we do.</p>
            </div>

            <div class="text-center">
                <div class="bg-[#10b981] rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Education</h3>
                <p class="text-gray-600">We empower our clients with knowledge for better animal care.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-gradient-to-r from-[#10b981] to-[#059669] text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-4">Ready to Partner With Us?</h2>
        <p class="text-xl mb-8 text-green-100">Experience the difference of professional veterinary care and quality products</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('bookings.create') }}" class="bg-white text-[#10b981] px-8 py-4 rounded-lg font-semibold hover:bg-green-50 transition">
                Book a Service
            </a>
            <a href="{{ route('contact') }}" class="bg-green-700 text-white px-8 py-4 rounded-lg font-semibold hover:bg-green-600 transition border-2 border-white">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection