@extends('admin.layout.app')
@section('content')	
	<div class="panel-header bg-dark-gradient">
		<div class="page-inner py-5">
			<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
				<div>
					<h2 class="text-white pb-2 fw-bold">List products</h2>
					<h5 class="text-white op-7 mb-2">{{$title}}</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="page-inner mt--5"> 
		<div class="row mt--2">
			<div class="col-lg-12">
				<div class="card full-height">
					<div class="card-body table-responsive">
						<div class="card-title">List of products</div>
						<table id="table" class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Photo</th>
									<th>product Type</th>
									<th>Title</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php $sn = 1; @endphp
								@forelse($products as $product)
									<tr>
										<td>{{ $sn++ }}</td>
										<td>
											<img src="{{ asset($product->cover_image) }}" 
												alt="{{ $product->title }}" 
												width="40px" 
												class="img-thumbnail">
										</td>
										<td>{{ $product->product_type }}</td>
										<td>{{ $product->title }}</td>
										<td>{{ $product->status }}</td>
										<td class="">
											<a href="{{route('admin.product.show', $product->slug)}}" class="btn btn-pink btn-sm" title="View">												
												<i class="fa fa-eye"></i>
											</a>
											<a href="{{route('admin.product.edit',$product->slug)}}" class="btn btn-pink btn-sm" title="Edit">
												<i class="fa fa-edit"></i>
											</a>
										</td>
									</tr>
								@empty
									
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>	
	</div>
@endsection
