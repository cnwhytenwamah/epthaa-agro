@extends('admin.layout.app')
@section('content')	
	<div class="panel-header bg-dark-gradient">
		<div class="page-inner py-5">
			<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
				<div>
					<h2 class="text-white pb-2 fw-bold">Add product</h2>
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
						<div class="card-title px-2">Fill the form below to add a product.</div>

						<form method="POST" enctype="multipart/form-data">
							@csrf
							<div class="row g-3">

								{{-- Title --}}
								<div class="col-lg-6">
									<label class="form-label">Title</label>
									<input type="text" name="title" class="form-control" required>
								</div>
                                
                                {{-- Category --}}
                                <div class="col-lg-6">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="product_category_id" id="product_category_id" class="form-control">
                                        @forelse($categories as $category)
                                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                                        @empty
                                            <option value="">No Category Available</option>
                                        @endforelse
                                    </select>
                                </div>

								{{-- Description --}}
								<div class="col-lg-12 my-3">
									<label class="form-label">Description</label>
									<textarea name="description" class="form-control" rows="3" required></textarea>
								</div>	

								{{-- Address --}}
								<div class="col-lg-6">
									<label class="form-label">Address</label>
									<input type="text" name="address" class="form-control">
								</div>

								{{-- City --}}
								<div class="col-lg-3">
									<label class="form-label">City</label>
									<input type="text" name="city" class="form-control">
								</div>

								{{-- State --}}
								<div class="col-lg-3">
									<label class="form-label">State</label>
									<input type="text" name="state" class="form-control">
								</div>

								{{-- Country --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Country</label>
									<input type="text" name="country" class="form-control">
								</div>

								{{-- Postal Code --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Postal Code</label>
									<input type="text" name="postal_code" class="form-control">
								</div>

								{{-- Latitude --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Latitude</label>
									<input type="text" name="latitude" class="form-control">
								</div>

								{{-- Longitude --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Longitude</label>
									<input type="text" name="longitude" class="form-control">
								</div>

								{{-- product Type --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">product Type</label>
									<input type="text" name="product_type" class="form-control">
								</div>

								{{-- Bedrooms --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Bedrooms</label>
									<input type="number" name="bedrooms" class="form-control">
								</div>

								{{-- Bathrooms --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Bathrooms</label>
									<input type="number" name="bathrooms" class="form-control">
								</div>

								{{-- Toilets --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Toilets</label>
									<input type="number" name="toilets" class="form-control">
								</div>

								{{-- Parking Space --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Parking Space</label>
									<input type="number" name="parking_space" class="form-control">
								</div>

								{{-- Floor Area --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Floor Area (sqm)</label>
									<input type="number" name="floor_area" class="form-control">
								</div>

								{{-- Land Area --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Land Area (sqm)</label>
									<input type="number" name="land_area" class="form-control">
								</div>

								{{-- Furnishing --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Furnishing</label>
									<select name="furnishing" class="form-control">
                                        @forelse($furnishings as $option)
                                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                        @empty
                                            <option value="">-- Select Furnishing --</option>
                                        @endforelse
                                    </select>
								</div>

								{{-- Year Built --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Year Built</label>
									<input type="number" name="year_built" class="form-control">
								</div>

								{{-- Price --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Price</label>
									<input type="number" step="0.01" name="price" class="form-control" required>
								</div>

								{{-- Currency --}}
								<div class="col-lg-4 my-3">
									<label class="form-label">Currency</label>
									<input type="text" name="currency" class="form-control" value="USD">
								</div>

								{{-- Rent Frequency --}}
								<div class="col-lg my-3">
									<label class="form-label">Rent Frequency</label>
                                    <select name="rent_frequency" class="form-control">
                                        @forelse($rent_frequencies as $option)
                                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                        @empty
                                            <option value="">-- Select Rent Frequency --</option>
                                        @endforelse
                                    </select>
								</div>
                                {{-- Offer Type --}}
								<div class="col-lg my-3">
									<label class="form-label">Offer Type</label>
                                    <select name="offer_type" class="form-control">
                                        @forelse($offer_types as $option)
                                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                        @empty
                                            <option value="">-- Select Offer type --</option>
                                        @endforelse
                                    </select>
								</div>
								{{-- Amenities (dynamic) --}}
								<div class="col-lg-8 my-3">
									<label class="form-label">Amenities </label>
									<div id="amenities-wrapper">
										<div class="input-group mb-2">
											<input type="text" name="amenities" class="form-control" placeholder="Enter comma separated amenities">
										</div>
									</div>
								</div>

								{{-- Features --}}
								<div class="col-12 my-3">
									<label class="form-label">Features</label>
									<textarea name="features" class="form-control" rows="2"></textarea>
								</div>

								{{-- Keywords --}}
								<div class="col-12 my-3">
									<label class="form-label">Keywords</label>
									<input type="text" name="keywords" class="form-control" placeholder="Enter comma separated keywords">
								</div>

								{{-- Dropzone Images --}}
								<div class="col-12 my-3">
									<label class="form-label">product Images</label>
									<div id="product-dropzone" class="dropzone border border-2 p-3"></div>
									{{-- Hidden input to store filenames --}}
									<div id="images-hidden"></div>
								</div>

                                <div class="col-lg-6 my-3">
									<label class="form-label">Cover Image</label>
									<input type="file" name="cover_image" class="form-control" required>
								</div>

                                {{-- Status --}}
								<div class="col-lg-6 my-3">
									<label class="form-label">Status</label>
									<select name="status" class="form-control" required>
										@forelse($statuses as $option)
											<option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                        @empty
                                            <option value="">-- Select status --</option>
                                        @endforelse
									</select>
								</div>

								{{-- Submit --}}
								<div class="col-12 text-start mt-4">
									<button type="button" class="btn btn-pink save_data" data-url="{{ route('admin.product.store') }}">Submit</button>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>	
	</div>
@endsection

@push('scripts')

@endpush
