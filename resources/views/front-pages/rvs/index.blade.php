@extends('front-pages.layouts.app')

@section('title', 'Ralph Veterinary Service (RVS)')

@section('content')
<!-- Hero Section -->
<section 
    class="relative bg-[url('assets/img/bg-hero.jpg')] bg-cover bg-center text-white overflow-hidden"
>
    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-blue-900/70"></div>

    <!-- Decorative wave shadow -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="currentColor" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,165.3C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    
    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <div>
                <div class="inline-block bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    Professional Veterinary Care
                </div>

                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    Ralph Veterinary Service
                </h1>

                <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                    Expert veterinary treatment, diagnostics, and farm consultancy services for all your animal healthcare needs. We bring professional care directly to your farm.
                </p>

                <div class="gap-4 inline-flex">
                    <a href="{{ route('bookings.create') }}"
                       class="bg-white text-blue-700 px-8 py-4 rounded-lg font-semibold hover:bg-blue-50 transition shadow-lg text-center">
                        Book Appointment
                    </a>

                    <a href="{{ route('rvs.services') }}"
                       class="bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-600 transition border-2 border-white text-center">
                        View All Services
                    </a>
                </div>
            </div>
            
           
        </div>
    </div>
    
</section>


<!-- Why Choose RVS -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose Ralph Veterinary Service?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We combine decades of veterinary expertise with modern technology to provide exceptional animal healthcare
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Certified Experts</h3>
                <p class="text-gray-600">
                    Our team consists of licensed veterinary doctors with extensive experience in animal healthcare.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">24/7 Emergency</h3>
                <p class="text-gray-600">
                    Round-the-clock emergency services available for critical animal health situations.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="bg-yellow-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">On-Site Visits</h3>
                <p class="text-gray-600">
                    We come to your farm or location, eliminating the stress of transporting animals.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Complete Records</h3>
                <p class="text-gray-600">
                    Comprehensive health records and treatment history for all your animals.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Services -->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Services</h2>
            <p class="text-xl text-gray-600">Comprehensive veterinary care for all animal types</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse($services as $service)

                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition group">
                    @if($service->image)
                        <img src="{{ Storage::url($service->image) }}"
                             alt="{{ $service->title }}"
                             class="w-full h-48 object-cover group-hover:scale-110 transition duration-300">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            {{ $service->title }}
                        </h3>

                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($service->description, 100) }}
                        </p>

                        @if($service->price)
                            <p class="text-2xl font-bold text-blue-600 mb-4">
                                From ₦{{ number_format($service->price, 2) }}
                            </p>
                        @endif

                        <a href="{{ route('bookings.create', $service->slug) }}"
                           class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-semibold transition">
                            Book This Service
                        </a>
                    </div>
                </div>

            @empty

                <!-- Empty State -->
                <div class="col-span-4 py-12 text-center">

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
                        Please check back soon.
                    </p>

                </div>

            @endforelse

        </div>

        <!-- Button only shows when services exist -->
        @if($services->count())
            <div class="text-center mt-8">
                <a href="{{ route('rvs.services') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                    View All Services
                </a>
            </div>
        @endif

    </div>
</section>


<!-- How It Works -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
            <p class="text-xl text-gray-600">Simple steps to get professional veterinary care</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Choose Service</h3>
                <p class="text-gray-600">Select the veterinary service you need from our comprehensive list</p>
            </div>

            <div class="text-center">
                <div class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Book Appointment</h3>
                <p class="text-gray-600">Fill out our simple booking form with your details and preferred date</p>
            </div>

            <div class="text-center">
                <div class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Get Confirmation</h3>
                <p class="text-gray-600">Receive confirmation and schedule details from our team</p>
            </div>

            <div class="text-center">
                <div class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-4">4</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Expert Care</h3>
                <p class="text-gray-600">Our veterinary team visits your location and provides professional treatment</p>
            </div>
        </div>
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
            <div class="bg-white rounded-xl shadow-md p-8 hover:shadow-xl transition">
                <div class="flex items-center mb-4">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    @endfor
                </div>
                <p class="text-gray-700 mb-6 italic leading-relaxed">"{{ $testimonial->testimonial }}"</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xl mr-4">
                        {{ substr($testimonial->client_name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $testimonial->client_name }}</p>
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

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-4">Ready to Get Started?</h2>
        <p class="text-xl mb-8 text-blue-100">
            Book a veterinary service appointment today and experience professional animal healthcare
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('bookings.create') }}" class="bg-white text-blue-700 px-8 py-4 rounded-lg font-semibold hover:bg-blue-50 transition shadow-lg">
                Book Appointment Now
            </a>
            <a href="https://wa.me/{{ env('WHATSAPP_NUMBER') }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg font-semibold transition inline-flex items-center justify-center">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                Chat on WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection