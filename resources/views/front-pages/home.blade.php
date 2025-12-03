@extends('front-pages.layouts.app')

@section('title', 'Home')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-b from-gray-100 via-[#f6e4c6] to-[#f2c07a]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12">


            <div class="text-left max-w-xl animate-slideLeft">

                <p class="text-sm tracking-widest font-semibold text-gray-700 uppercase mb-3 animate-fadeUp delay-100">
                    We Offer
                </p>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-5 text-black animate-fadeUp delay-200">
                    Wide range of products
                </h1>

                <p class="text-lg text-gray-700 mb-8 animate-fadeUp delay-300">
                    Pets and animal care products, accessories, all your veterinary care products.
                </p>

                <div class="flex gap-4 animate-fadeUp delay-400">
                    <a href="{{ route('bookings.create') }}"
                       class="bg-black text-white px-8 py-4 font-semibold uppercase text-sm hover:bg-gray-800 transition shadow-md">
                        Book Veterinary Service
                    </a>

                    <a href="{{ route('shop.index') }}"
                       class="border-2 border-black text-black px-8 py-4 font-semibold uppercase text-sm hover:bg-black hover:text-white transition">
                        Shop Products
                    </a>
                </div>

            </div>


            <div class="relative w-full flex justify-center lg:justify-end animate-slideRight delay-300">
                <img 
                    src="{{ asset('assets/img/Animal4-1.png') }}" 
                    alt="Farm and domestic animals"
                    class="w-full max-w-xl object-contain drop-shadow-xl"
                >
            </div>

        </div>
    </div>
</section>


<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Who We Are</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                EPTHAA AGRO LIMITED is a leading provider of professional veterinary services and quality agricultural products in Nigeria. We combine expertise, integrity, and innovation to serve farmers and animal owners nationwide.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                    <div class="text-center text-white">
                        <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <h3 class="text-3xl font-bold">RVS</h3>
                        <p class="text-blue-100">Ralph Veterinary Service</p>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">
                        Professional veterinary treatment, diagnostics, vaccination programs, farm consultancy, and breeding advisory services.
                    </p>
                    <a href="{{ route('rvs.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
                        Learn More
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-48 bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center">
                    <div class="text-center text-white">
                        <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="text-3xl font-bold">JVS</h3>
                        <p class="text-green-100">Just Veterinary Service</p>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">
                        Complete range of veterinary medicines, animal feeds, supplements, tools, and accessories for all your agricultural needs.
                    </p>
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                        Shop Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Veterinary Services</h2>
            <p class="text-xl text-gray-600">Professional care for your animals</p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse($services as $service)

                <!-- Service Card -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    
                    @if($service->image)
                        <img src="{{ Storage::url($service->image) }}"
                             alt="{{ $service->title }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-green-400 to-green-600"></div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $service->title }}
                        </h3>

                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($service->description, 100) }}
                        </p>

                        <a href="{{ route('bookings.create', $service->slug) }}"
                           class="text-primary hover:text-[#059669] font-semibold">
                            Book Now →
                        </a>
                    </div>
                </div>

            @empty

                
                <div class="col-span-full p-12 text-center">

                    <div class="flex justify-center mb-6 space-x-6 text-gray-400 text-4xl">
                        <i class="fa-solid fa-stethoscope"></i>
                        <i class="fa-solid fa-paw"></i>
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>

                    <h3 class="text-2xl font-semibold text-gray-800 mb-3">
                        Services Not Available
                    </h3>

                    <p class="text-gray-500 max-w-md mx-auto">
                        Our veterinary services are currently being prepared.
                        Please check back soon — we&apos;ll be ready to serve your animals shortly!
                    </p>
                </div>

            @endforelse
        </div>

        @if($services->count())
            <div class="text-center mt-8">
                <a href="{{ route('rvs.services') }}"
                   class="inline-block bg-[#10b981] hover:bg-[#059669] text-white px-8 py-3 rounded-lg font-semibold transition">
                    View All Services
                </a>
            </div>
        @endif

    </div>
</section>


<!-- Featured Products -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Products</h2>
            <p class="text-xl text-gray-600">Quality products for your agricultural needs</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse($featuredProducts as $product)

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                    <a href="{{ route('shop.show', $product->slug) }}">

                        @if($product->images && count($product->images) > 0)
                            <img src="{{ Storage::url($product->images[0]) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-64 object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-gray-200 to-gray-300"></div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                {{ $product->name }}
                            </h3>

                            <p class="text-gray-600 text-sm mb-3">
                                {{ Str::limit($product->description, 60) }}
                            </p>

                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-bold text-primary">
                                    ₦{{ number_format($product->price, 2) }}
                                </span>

                                @if($product->stock_quantity > 0)
                                    <span class="text-green-600 text-sm font-semibold">In Stock</span>
                                @else
                                    <span class="text-red-600 text-sm font-semibold">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                    </a>

                    <div class="p-4 pt-0">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="w-full bg-[#10b981] hover:bg-[#059669] text-white py-2 rounded-lg font-semibold transition"
                                    {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>

            @empty

                <div class="col-span-full p-12 text-center">

                    <div class="flex justify-center mb-6 space-x-6 text-gray-400 text-4xl">
                        <i class="fa-solid fa-box-open"></i>
                        <i class="fa-solid fa-cart-shopping"></i>
                        <i class="fa-solid fa-seedling"></i>
                    </div>

                    <h3 class="text-2xl font-semibold text-gray-900 mb-3">
                        Products Not Available
                    </h3>

                    <p class="text-gray-600 max-w-md mx-auto">
                        Our featured products are currently not available.
                        Please check back soon for new stock updates.
                    </p>

                </div>

            @endforelse

        </div>

        <!-- Show button only when products exist -->
        @if($featuredProducts->count())
            <div class="text-center mt-8">
                <a href="{{ route('shop.index') }}"
                   class="inline-block bg-[#10b981] hover:bg-[#059669] text-white px-8 py-3 rounded-lg font-semibold transition">
                    View All Products
                </a>
            </div>
        @endif

    </div>
</section>


<!-- Testimonials -->
@if($testimonials->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">What Our Clients Say</h2>
            <p class="text-xl text-gray-600">Trusted by farmers and animal owners across Nigeria</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                <div class="flex items-center mb-4">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    @endfor
                </div>
                <p class="text-gray-600 mb-4 italic">"{{ $testimonial->testimonial }}"</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-[#10b981] flex items-center justify-center text-white font-bold text-xl">
                        {{ substr($testimonial->client_name, 0, 1) }}
                    </div>
                    <div class="ml-4">
                        <p class="font-semibold text-gray-900">{{ $testimonial->client_name }}</p>
                        @if($testimonial->client_location)
                        <p class="text-gray-600 text-sm">{{ $testimonial->client_location }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="py-16 bg-gradient-to-r from-[#10b981] to-[#059669] text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-4">Ready to Get Started?</h2>
        <p class="text-xl mb-8 text-green-100">Book a veterinary service or shop for quality products today</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('bookings.create') }}" class="bg-white text-[#10b981] px-8 py-4 rounded-lg font-semibold hover:bg-green-50 transition">
                Book Appointment
            </a>
            <a href="{{ route('contact') }}" class="bg-green-700 text-white px-8 py-4 rounded-lg font-semibold hover:bg-green-600 transition border-2 border-white">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection