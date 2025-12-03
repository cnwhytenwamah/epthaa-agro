@extends('admin.layout.app')

@section('content')

<div class="panel-header bg-dark-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold">Admin Dashboard</h2>
				<h5 class="text-white op-7 mb-2">{{ $title }}</h5>
			</div>
		</div>
	</div>
</div>

<div class="page-inner mt--5">

	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">JVS Module</h4>
					<p class="card-category">Product & Order Management</p>
				</div>

				<div class="card-body">
					<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">

						<div class="px-2 text-center">
							<h1>{{ $totalproductCatgories }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Product Categories</a>
						</div>

						<div class="px-2 text-center">
							<h1>{{ $totalproducts }}</h1>
							<a href="{{ route('admin.products.index') }}" class="fw-bold mt-3 mb-0">Products</a>
						</div>

						<div class="px-2 text-center">
							<h1>{{ $totalOrders ?? 0 }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Orders</a>
						</div>

						<div class="px-2 text-center">
							<h1>{{ $totalPayments ?? 0 }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Payments</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row mt-4">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">RVS Module</h4>
					<p class="card-category">Services & Bookings</p>
				</div>

				<div class="card-body">
					<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">

						<div class="px-2 text-center">
							<h1>{{ $totalServices ?? 0 }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Services</a>
						</div>

						<div class="px-2 text-center">
							<h1>{{ $totalBookings ?? 0 }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Bookings</a>
						</div>

						<div class="px-2 text-center">
							<h1>{{ $pendingBookings ?? 0 }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Pending Schedules</a>
						</div>

						<div class="px-2 text-center">
							<h1>{{ $totalInquiries ?? 0 }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Inquiries</a>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row mt-4">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">General Tools</h4>
					<p class="card-category">Administration & Analytics</p>
				</div>

				<div class="card-body">
					<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">

						<div class="px-2 text-center">
							<h1>{{ $totalUsers ?? 0 }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Staff & Users</a>
						</div>

						<div class="px-2 text-center">
							<h1>{{ $totalReports ?? 0 }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Reports</a>
						</div>

						<div class="px-2 text-center">
							<h1>{{ $totalBookings ?? 0 }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Sales Analytics</a>
						</div>

						<div class="px-2 text-center">
							<h1>{{ $contentItems ?? 0 }}</h1>
							<a href="" class="fw-bold mt-3 mb-0">Content Items</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection
