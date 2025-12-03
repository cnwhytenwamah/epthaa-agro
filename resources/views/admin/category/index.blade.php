@extends('admin.layout.app')
@section('content')	
	<div class="panel-header bg-dark-gradient">
		<div class="page-inner py-5">
			<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
				<div>
					<h2 class="text-white pb-2 fw-bold">List Categories</h2>
					<h5 class="text-white op-7 mb-2">{{$title}}</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="page-inner mt--5"> 
		<div class="row mt--2 justify-content-start align-items-center" style="min-height: 30vh;">
			<div class="col-lg-12">
				<div class="card full-height">
					<div class="card-body">
						<div class="card-title px-2">List of Categories</div>
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Slug</th>
									<th>Name</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php $sn = 1; @endphp
								@forelse($categories as $category)
									<tr>
										<td>{{ $sn++ }}</td>
										<td>{{ $category->slug }}</td>
										<td>{{ $category->name }}</td>
										<td>
											<a href="{{route('admin.edit-category', $category->id)}}" class="btn btn-pink btn-sm" title="Edit">
												<i class="fa fa-edit"></i>
											</a>
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="13" class="text-center">No category available at the moment.</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>	
	</div>
@endsection
