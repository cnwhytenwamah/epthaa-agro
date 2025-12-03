@extends('admin.layout.app')
@section('content')	
	<div class="panel-header bg-dark-gradient">
		<div class="page-inner py-5">
			<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
				<div>
					<h2 class="text-white pb-2 fw-bold">product Edit</h2>
					<h5 class="text-white op-7 mb-2">{{ $title }}</h5>
				</div>
			</div>
		</div>
	</div>

	<div class="page-inner mt--5"> 
		<div class="row mt--2 justify-content-start align-items-center" style="min-height: 80vh;">
			<div class="col-lg-12">
				<div class="card full-height">
					<div class="card-body">
						<div class="card-title px-2">Make changes to the form below to edit this product.</div>
                        
                        <form method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="slug" value="{{ $product->slug }}">

                            <div class="row g-3">

                                {{-- Title --}}
                                <div class="col-lg-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $product->title) }}" class="form-control" required>
                                </div>
                                
                                {{-- Category --}}
                                <div class="col-lg-6">
                                    <label for="product_category_id" class="form-label">product Category</label>
                                    <select name="product_category_id" id="product_category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Description --}}
                                <div class="col-lg-12 my-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $product->description) }}</textarea>
                                </div>	

                                {{-- Address --}}
                                <div class="col-lg-6">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" value="{{ old('address', $product->address) }}" class="form-control">
                                </div>

                                {{-- City --}}
                                <div class="col-lg-3">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" value="{{ old('city', $product->city) }}" class="form-control">
                                </div>

                                {{-- State --}}
                                <div class="col-lg-3">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" value="{{ old('state', $product->state) }}" class="form-control">
                                </div>

                                {{-- Country --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" name="country" value="{{ old('country', $product->country) }}" class="form-control">
                                </div>

                                {{-- Postal Code --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code', $product->postal_code) }}" class="form-control">
                                </div>

                                {{-- Latitude --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Latitude</label>
                                    <input type="text" name="latitude" value="{{ old('latitude', $product->latitude) }}" class="form-control">
                                </div>

                                {{-- Longitude --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Longitude</label>
                                    <input type="text" name="longitude" value="{{ old('longitude', $product->longitude) }}" class="form-control">
                                </div>

                                {{-- product Type --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">product Type</label>
                                    <input type="text" name="product_type" value="{{ old('product_type', $product->product_type) }}" class="form-control">
                                </div>

                                {{-- Bedrooms --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Bedrooms</label>
                                    <input type="number" name="bedrooms" value="{{ old('bedrooms', $product->bedrooms) }}" class="form-control">
                                </div>

                                {{-- Bathrooms --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Bathrooms</label>
                                    <input type="number" name="bathrooms" value="{{ old('bathrooms', $product->bathrooms) }}" class="form-control">
                                </div>

                                {{-- Toilets --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Toilets</label>
                                    <input type="number" name="toilets" value="{{ old('toilets', $product->toilets) }}" class="form-control">
                                </div>

                                {{-- Parking Space --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Parking Space</label>
                                    <input type="number" name="parking_space" value="{{ old('parking_space', $product->parking_space) }}" class="form-control">
                                </div>

                                {{-- Floor Area --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Floor Area (sqm)</label>
                                    <input type="number" name="floor_area" value="{{ old('floor_area', $product->floor_area) }}" class="form-control">
                                </div>

                                {{-- Land Area --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Land Area (sqm)</label>
                                    <input type="number" name="land_area" value="{{ old('land_area', $product->land_area) }}" class="form-control">
                                </div>

                                {{-- Furnishing --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Furnishing</label>
                                    <select name="furnishing" class="form-control">
                                        @foreach($furnishings as $option)
                                            <option value="{{ $option['value'] }}" 
                                                {{ old('furnishing', $product->furnishing) == $option['value'] ? 'selected' : '' }}>
                                                {{ $option['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Year Built --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Year Built</label>
                                    <input type="number" name="year_built" value="{{ old('year_built', $product->year_built) }}" class="form-control">
                                </div>

                                {{-- Price --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Price</label>
                                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control" required>
                                </div>

                                {{-- Currency --}}
                                <div class="col-lg-4 my-3">
                                    <label class="form-label">Currency</label>
                                    <input type="text" name="currency" value="{{ old('currency', $product->currency) }}" class="form-control">
                                </div>

                                {{-- Rent Frequency --}}
                                <div class="col-lg my-3">
                                    <label class="form-label">Rent Frequency</label>
                                    <select name="rent_frequency" class="form-control">
                                        @foreach($rent_frequencies as $option)
                                            <option value="{{ $option['value'] }}" 
                                                {{ old('rent_frequency', $product->rent_frequency) == $option['value'] ? 'selected' : '' }}>
                                                {{ $option['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Offer Type --}}
                                <div class="col-lg my-3">
                                    <label class="form-label">Offer Type</label>
                                    <select name="offer_type" class="form-control">
                                        @foreach($offer_types as $option)
                                            <option value="{{ $option['value'] }}" 
                                                {{ old('offer_type', $product->offer_type) == $option['value'] ? 'selected' : '' }}>
                                                {{ $option['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Amenities --}}
                                <div class="col-lg-8 my-3">
                                    <label class="form-label">Amenities</label>
                                    <div id="amenities-wrapper">
                                       <input type="text" name="amenities" class="form-control" value="{{ implode(',', json_decode($product->amenities, true)) }}">
                                    </div>
                                </div>

                                {{-- Features --}}
                                <div class="col-12 my-3">
                                    <label class="form-label">Features</label>
                                    <textarea name="features" class="form-control" rows="2">{{ implode(',', json_decode($product->features, true)) }}</textarea>
                                </div>

                                {{-- Keywords --}}
                                <div class="col-12 my-3">
                                    <label class="form-label">Keywords</label>
                                    <input type="text" name="keywords" 
                                        value="{{ old('keywords', $product->keywords) }}" 
                                        class="form-control">
                                </div>

                                {{-- Dropzone Images --}}
                                <div class="col-12 my-3">
                                    <label class="form-label">product Images</label>
                                    <div id="product-dropzone" class="dropzone border border-2 p-3"  data-product-images='@json($product->images)'></div>

                                    {{-- Existing Images Preview 
                                    @if(!empty($product->images))
                                        <div class="d-flex flex-wrap gap-3 mt-3">
                                            @foreach(json_decode($product->images, true) as $img)
                                                <div class="position-relative">
                                                    <img src="{{ $img }}" alt="product Image" width="120" class="img-thumbnail">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif--}}
                                </div>

                                {{-- Cover Image --}}
                                <div class="col-lg-6 my-3">
                                    <label class="form-label">Cover Image</label><br>
                                    <input type="file" name="cover_image" class="form-control">
                                    @if($product->cover_image)
                                        <img src="{{ $product->cover_image }}" alt="Cover" width="150" class="mb-2"><br>
                                    @endif
                                    
                                </div>
                                <input type="hidden" name="is_edit" value="1">
                                {{-- Status --}}
                                <div class="col-lg-6 my-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control" required>
                                        @foreach($statuses as $option)
                                            <option value="{{ $option['value'] }}" 
                                                {{ old('status', $product->status) == $option['value'] ? 'selected' : '' }}>
                                                {{ $option['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Submit --}}
                                <div class="col-12 text-start mt-4">
									<button type="button" class="btn btn-pink save_data" data-url="{{ route('admin.product.update') }}">Save Changes</button>
								</div>
                            </div>
                        </form>

					</div>
				</div>
			</div>
		</div>	
	</div>
@endsection

