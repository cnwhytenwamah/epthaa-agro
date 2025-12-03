@extends('admin.layout.app')
@section('content')	
	<div class="panel-header bg-dark-gradient">
		<div class="page-inner py-5">
			<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
				<div>
					<h2 class="text-white pb-2 fw-bold">Edit Category</h2>
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
						<div class="card-title px-2">Fill the form below to edit category.</div>
						<form>
							@csrf
							<div class="form-group">
								<label for="title">Name</label>
								<input type="text" class="form-control" id="name" value="{{$categories->name}}" name="name" placeholder="Enter Name">
							</div>
							<input type="hidden" name="id" value="{{$categories->id}}">
							<div class="form-group">
								<label for="slug">Slug</label>
								<input type="text" class="form-control" id="slug" value="{{$categories->slug}}" name="slug" placeholder="Enter Slug">
							</div>

							<div class="text-start mt-4 px-3">
								<button type="button" class="btn btn-pink save_data" data-url="{{route('admin.update-category')}}">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>	
	</div>

			
@endsection