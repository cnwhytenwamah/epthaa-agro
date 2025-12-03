<div class="sidebar sidebar-style-2">			
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">

			<div class="user">
				<div class="avatar-sm float-left mr-2">
					<img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
				</div>
				<div class="info">
					<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
						<span>
							Hizrian
							<span class="user-level">Administrator</span>
						</span>
					</a>
					<div class="clearfix"></div>
				</div>
			</div>

			<ul class="nav nav-pink">

				<li class="nav-item active">
					<a href="{{ route('admin.dashboard') }}">
						<i class="fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>

				<li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">Menu</h4>
				</li>

				<li class="nav-item">
					<a data-toggle="collapse" href="#rvs">
						<i class="fas fa-heartbeat"></i>
						<p>RVS Module</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="rvs">
						<ul class="nav nav-collapse">
							<li>
								<a href="{{ route('admin.services.index') }}">
									<span class="sub-item">Manage Services</span>
								</a>
							</li>
							<li>
								<a href="">
									<span class="sub-item">Bookings & Scheduling</span>
								</a>
							</li>
							<li>
								<a href="">
									<span class="sub-item">Inquiries</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item">
					<a data-toggle="collapse" href="#jvs">
						<i class="fas fa-boxes"></i>
						<p>JVS Module</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="jvs">
						<ul class="nav nav-collapse">
							<li>
								<a href="">
									<span class="sub-item">Products & Inventory</span>
								</a>
							</li>
							<li>
								<a href="">
									<span class="sub-item">Orders</span>
								</a>
							</li>
							<li>
								<a href="">
									<span class="sub-item">Payments</span>
								</a>
							</li>
							<li>
								<a href="">
									<span class="sub-item">Invoice Generator</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item">
					<a data-toggle="collapse" href="#general">
						<i class="fas fa-tools"></i>
						<p>General Tools</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="general">
						<ul class="nav nav-collapse">
							<li>
								<a href="">
									<span class="sub-item">Staff & User Management</span>
								</a>
							</li>
							<li>
								<a href="">
									<span class="sub-item">Sales & Booking Analytics</span>
								</a>
							</li>
							<li>
								<a href="">
									<span class="sub-item">Reports (Export)</span>
								</a>
							</li>
							<li>
								<a href="">
									<span class="sub-item">Content Management</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item">
					<a href="">
						<i class="fas fa-ticket-alt"></i>
						<p>Support Tickets</p>
					</a>
				</li>

				
				<li class="mx-4 mt-2">
					<a href="#" class="btn btn-pink btn-block">Logout</a>
				</li>

			</ul>
		</div>
	</div>
</div>
<!-- End Sidebar -->
