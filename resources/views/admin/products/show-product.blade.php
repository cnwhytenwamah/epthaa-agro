@extends('admin.layout.app')

@section('content')	
<div class="panel-header bg-dark-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Blog Details</h2>
                <h5 class="text-white op-7 mb-2">{{ $product->title }}</h5>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5"> 
    <div class="row mt--2">
        <div class="col-lg-12">
            <div class="card full-height">
                <div class="card-body">
                    <h1 class="mb-4">{{ $product->title }}</h1>

                    {{-- Cover Image --}}
                    <div class="mb-4">
                        <img src="{{ $product->cover_image }}" alt="{{ $product->title }}" class="img-fluid rounded shadow">
                    </div>

                    {{-- Basic Info --}}
                    <div class="card mb-4">
                        <div class="card-header">Basic Information</div>
                        <div class="card-body">
                            <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                            <p><strong>Slug:</strong> {{ $product->slug ?? 'N/A' }}</p>
                            <p><strong>Description:</strong> $product->description</p>
                            <p><strong>Keywords:</strong> $product->keywords</p>
                            <p><strong>Status:</strong> {{ ucfirst($product->status) }}</p>
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="card mb-4">
                        <div class="card-header">Location</div>
                        <div class="card-body">
                            <p><strong>Address:</strong> {{ $product->address }}</p>
                            <p><strong>City:</strong> {{ $product->city }}</p>
                            <p><strong>State:</strong> {{ $product->state }}</p>
                            <p><strong>Country:</strong> {{ $product->country }}</p>
                            <p><strong>Postal Code:</strong> {{ $product->postal_code ?? 'N/A' }}</p>
                            <p><strong>Latitude:</strong> {{ $product->latitude ?? 'N/A' }}</p>
                            <p><strong>Longitude:</strong> {{ $product->longitude ?? 'N/A' }}</p>
                        </div>
                    </div>

                    {{-- Specifications --}}
                    <div class="card mb-4">
                        <div class="card-header">Specifications</div>
                        <div class="card-body">
                            <p><strong>Type:</strong> {{ $product->product_type }}</p>
                            <p><strong>Bedrooms:</strong> {{ $product->bedrooms }}</p>
                            <p><strong>Bathrooms:</strong> {{ $product->bathrooms }}</p>
                            <p><strong>Toilets:</strong> {{ $product->toilets ?? 'N/A' }}</p>
                            <p><strong>Parking Space:</strong> {{ $product->parking_space ?? 'N/A' }}</p>
                            <p><strong>Floor Area:</strong> {{ $product->floor_area ?? 'N/A' }}</p>
                            <p><strong>Land Area:</strong> {{ $product->land_area ?? 'N/A' }}</p>
                            <p><strong>Furnishing:</strong> {{ $product->furnishing ?? 'N/A' }}</p>
                            <p><strong>Year Built:</strong> {{ $product->year_built ?? 'N/A' }}</p>
                        </div>
                    </div>

                    {{-- Pricing --}}
                    <div class="card mb-4">
                        <div class="card-header">Pricing</div>
                        <div class="card-body">
                            <p><strong>Price:</strong> {{ number_format($product->price, 2) }} {{ $product->currency }}</p>
                            <p><strong>Rent Frequency:</strong> {{ $product->rent_frequency ?? 'N/A' }}</p>
                            <p><strong>Offer Type:</strong> {{ $product->offer_type ?? 'N/A' }}</p>
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="card mb-4">
                        <div class="card-header">Additional Images</div>
                        <div class="card-body">
                            @if(!empty($product->images) && is_array($product->images))
                                <div class="row">
                                    @foreach($product->images as $img)
                                        <div class="col-md-3 mb-3">
                                            <img src="{{ $img }}" class="img-fluid rounded shadow-sm" alt="product image">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No additional images available.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Amenities & Features --}}
                    <div class="card mb-4">
                        <div class="card-header">Amenities & Features</div>
                        <div class="card-body">
                            <p>
                                <strong>Amenities:</strong>
                                {{ !empty($product->amenities) ? implode(' | ', json_decode($product->amenities, true)) : 'N/A' }}
                            </p>
                            <p>
                                <strong>Features:</strong>
                                {{ !empty($product->features) ? implode(' | ', json_decode($product->features, true)) : 'N/A' }}
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-pink mt-3">Back to List</a>
                </div>
            </div>
        </div>
    </div>	
</div>
@endsection
