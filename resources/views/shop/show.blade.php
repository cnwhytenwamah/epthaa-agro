@extends('layouts.app')

@section('title', $product->name)

@section('content')
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-primary">Shop</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div>
                @if($product->images && count($product->images) > 0)
                <div class="mb-4">
                    <img id="mainImage" src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
                </div>
                
                @if(count($product->images) > 1)
                <div class="grid grid-cols-4 gap-4">
                    @foreach($product->images as $image)
                    <img src="{{ Storage::url($image) }}" alt="{{ $product->name }}" class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition" onclick="changeMainImage('{{ Storage::url($image) }}')">
                    @endforeach
                </div>
                @endif
                @else
                <div class="w-full h-96 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center">
                    <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <span class="inline-block bg-primary text-white px-3 py-1 rounded-full text-sm font-semibold mb-4">
                    {{ $product->category->name }}
                </span>
                
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                
                <div class="flex items-center gap-4 mb-6">
                    <span class="text-4xl font-bold text-primary">₦{{ number_format($product->price, 2) }}</span>
                    @if($product->stock_quantity > 0)
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-lg font-semibold">
                        In Stock ({{ $product->stock_quantity }} available)
                    </span>
                    @else
                    <span class="bg-red-100 text-red-800 px-4 py-2 rounded-lg font-semibold">Out of Stock</span>
                    @endif
                </div>

                <div class="mb-6 pb-6 border-b">
                    <p class="text-sm text-gray-600 mb-2">SKU: <span class="font-semibold">{{ $product->sku }}</span></p>
                    @if($product->packaging_info)
                    <p class="text-sm text-gray-600">Packaging: <span class="font-semibold">{{ $product->packaging_info }}</span></p>
                    @endif
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                </div>

                @if($product->usage_instructions)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Usage Instructions</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->usage_instructions }}</p>
                </div>
                @endif

                @if($product->dosage_info)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Dosage Information</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->dosage_info }}</p>
                </div>
                @endif

                @if($product->safety_info)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Safety Information</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->safety_info }}</p>
                </div>
                @endif

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="flex items-center gap-4 mb-4">
                        <label class="text-gray-700 font-semibold">Quantity:</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-primary hover:bg-secondary text-white py-4 rounded-lg font-semibold transition text-lg" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                            Add to Cart
                        </button>
                        <a href="https://wa.me/{{ env('WHATSAPP_NUMBER') }}?text=I'm interested in {{ $product->name }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-6 py-4 rounded-lg transition flex items-center justify-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    <a href="{{ route('shop.show', $related->slug) }}">
                        @if($related->images && count($related->images) > 0)
                        <img src="{{ Storage::url($related->images[0]) }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                        @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300"></div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $related->name }}</h3>
                            <p class="text-2xl font-bold text-primary">₦{{ number_format($related->price, 2) }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    function changeMainImage(src) {
        document.getElementById('mainImage').src = src;
    }
</script>
@endpush
@endsection