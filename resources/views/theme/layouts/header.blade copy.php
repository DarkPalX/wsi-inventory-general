<style>
	#logo {
		display: flex;
		align-items: center;
	}

	.logo-text {
		margin-left: -35px; /* Adjust this value as needed */
	}	

	#primary-menu a {
        text-decoration: none;
    }

	.dropdown:hover .dropdown-menu {
		display: block;
		right: 0;
	}

	.dropdown-menu .dropdown-item {
        color: black;
		padding: 7px;
		font-size: 12px;
	}

	.dropdown-item:hover {
        color: white;
		background-color: #287ad1;
	}
	nav.primary-menu a.menu-link,
	nav.primary-menu ul li span.menu-link {
		font-size: 10px;
		color: black;
	}

	.header-border-color: {
		rgba(var(--cnvs-contrast-rgb), .1);
	}


	/* Style for nested submenu container */
	.dropdown-submenu-container {
		position: relative;
	}

	/* Hide the submenu by default */
	.dropdown-submenu-container .dropdown-submenu {
		display: none;
		top: 0;
		left: 100%;
		margin-top: -1px;
		position: absolute;
	}

	/* Show submenu only when hovering over .dropdown-submenu */
	.dropdown-submenu-container:hover .dropdown-submenu {
		display: block;
	}
</style>

<header id="header" class="full-header header-size-sm semi-transparent dark">
	<div id="header-wrap" style="background-color:#0047AB ;">
		<div class="container">
			<div class="header-row justify-content-between justify-content-lg-start">

				<!-- Logo
				============================================= -->
				<div id="logo" class="m-2">
					<a href="{{ env('APP_URL') }}">
						<img class="logo-default" src="{{ asset('theme/images/company-logo.png') }}" alt="Logo" style="height: 40px;">
					</a>
				</div><!-- #logo end -->

				<div class="mx-lg-3 mx-sm-0 d-none d-lg-block">
					{{-- <strong class="logo-text text-uppercase" style="font-size:17px;">Foreign Service Institute</strong> --}}
					<strong class="logo-text text-uppercase text-white" style="font-size:14px;"><span class="text-warning">Foreign Service</span> Institute</strong>
				</div>

				<div class="primary-menu-trigger">
					<button class="cnvs-hamburger" type="button" title="Open Mobile Menu">
						<span class="cnvs-hamburger-box"><span class="cnvs-hamburger-inner"></span></span>
					</button>
				</div>

				<!-- Primary Navigation
				============================================= -->
					<nav class="primary-menu with-arrows ms-lg-auto me-lg-3">
						<ul class="menu-container menu-item">
							@if(!Route::is('home'))
							
								<li class="mx-1 dropdown">
									<a class="text-light menu-link" href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a>
								</li>
								<li class="mx-1 dropdown" @if(!RolePermission::has_permission(5,auth()->user()->role_id,1)) style="display: none" @endif>
									<a class="text-light menu-link" href="{{ route('items.index') }}"><i class="bi-boxes bi-alt"></i> Manage Items</a>
									<div class="dropdown-menu bg-light shadow">
										<a class="dropdown-item" href="{{ route('items.index') }}">Items List</a>
										<a class="dropdown-item" href="{{ route('items.create') }}" @if(!RolePermission::has_permission(1,auth()->user()->role_id,1)) style="display: none" @endif>Create New Item</a>
									</div>
								</li>
								
								<li class="mx-1 dropdown" @if(!RolePermission::has_permission(5,auth()->user()->role_id,2)) style="display: none" @endif>
									<a class="text-light menu-link" href="{{ route('receiving.transactions.index') }}"><i class="uil-download-alt"></i> Receiving</a>
									<div class="dropdown-menu bg-light shadow">
										<a class="dropdown-item" href="{{ route('receiving.transactions.index') }}">Receiving Transaction List</a>
										<a class="dropdown-item" href="{{ route('receiving.transactions.create') }}" @if(!RolePermission::has_permission(2,auth()->user()->role_id,1)) style="display: none" @endif>Create New Transaction</a>
										{{-- <a class="dropdown-item" href="{{ route('receiving.purchase-orders.index') }}">Purchase Order List</a>
										<a class="dropdown-item" href="{{ route('receiving.purchase-orders.create') }}">Create New Order</a> --}}
									</div>
								</li>
							
								<li class="mx-1 dropdown" @if(!RolePermission::has_permission(5,auth()->user()->role_id,3)) style="display: none" @endif>
									<a class="text-light menu-link" href="{{ route('issuance.requisitions.index') }}"><i class="uil-upload-alt"></i> Requisitions</a>
									<div class="dropdown-menu bg-light shadow">
										{{-- <a class="dropdown-item" href="{{ route('issuance.transactions.index') }}">Issuance Transaction List</a> --}}
										{{-- <a class="dropdown-item" href="{{ route('issuance.transactions.create') }}">Create New Transaction</a> --}}
										<a class="dropdown-item" href="{{ route('issuance.requisitions.index') }}">Material Requisition List</a>
										<a class="dropdown-item" href="{{ route('issuance.requisitions.create') }}" @if(!RolePermission::has_permission(3,auth()->user()->role_id,1)) style="display: none" @endif>Create New Request</a>
									</div>
								</li>
							
								<li class="mx-1" @if(!RolePermission::has_permission(5,auth()->user()->role_id,4)) style="display: none" @endif>
									<a class="text-light menu-link" href="{{ route('par.transactions.index') }}"><i class="uil-suitcase"></i> PAR Items</a>
								</li>
							
								<li class="mx-1 dropdown" @if(!RolePermission::has_permission(5,auth()->user()->role_id,5)) style="display: none" @endif>
									<span class="text-light menu-link"><i class="bi-graph-up"></i> Reports</span>
									<div class="dropdown-menu bg-light shadow">
										<a class="dropdown-item" href="{{ route('reports.issuance') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,1)) style="display: none" @endif>Issuance Report</a>
										<a class="dropdown-item" href="{{ route('reports.requisitions') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,8)) @endif>Requisition Report</a>
										<a class="dropdown-item" href="{{ route('reports.receiving') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,2)) style="display: none" @endif>Receiving Stock Report</a>
										<a class="dropdown-item" href="{{ route('reports.deficit-items') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,2)) style="display: none" @endif>Below Minimum Stock</a>
										<a class="dropdown-item" href="{{ route('reports.stock-card') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,4)) style="display: none" @endif>Stock Card Report</a>
										<a class="dropdown-item" href="{{ route('reports.inventory') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,5)) style="display: none" @endif>Inventory Report</a>
										<a class="dropdown-item" href="{{ route('reports.users') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,6)) style="display: none" @endif>User Report</a>
										<a class="dropdown-item" href="{{ route('reports.audit-trail') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,7)) style="display: none" @endif>Audit Trail</a>
										<a class="dropdown-item" href="{{ route('reports.items') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,8)) style="display: none" @endif>Item List</a>
									
										<div class="dropdown-submenu-container">
											<a href="#" class="dropdown-item dropdown-toggle">FSI Reports</a>
											<div class="dropdown-submenu bg-light shadow">
												<a class="dropdown-item" href="{{ route('reports-fsi.stock-card') }}" target="_blank">Appendix 58 - SC</a>
												<a class="dropdown-item" href="{{ route('reports-fsi.inventory-custodian') }}" target="_blank">Appendix 59 - ICS</a>
												<a class="dropdown-item" href="{{ route('reports-fsi.inventory-physical-count') }}" target="_blank">Appendix 66 - RPCI</a>
												<a class="dropdown-item" href="{{ route('reports-fsi.property-card') }}" target="_blank">Appendix 69 - PC</a>
												<a class="dropdown-item" href="{{ route('reports-fsi.property-plant-equipment-count') }}" target="_blank">Appendix 73 - RPCPPE</a>
												<a class="dropdown-item" href="{{ route('reports-fsi.unserviceable-property-inspection') }}" target="_blank">Appendix 74 - IIRUP</a>
											</div>
										</div>
									
									</div>
								</li>
							
								<li class="mx-1 dropdown" @if(!RolePermission::has_permission(5,auth()->user()->role_id,6) && auth()->user()->role_id != 1) style="display: none" @endif>
									<span class="text-light menu-link"><i class="bi-gear"></i> Maintenance</span>
									<div class="dropdown-menu bg-light shadow">
										<a class="dropdown-item" href="{{ route('items.categories.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,1)) style="display: none" @endif>Item Categories</a>
										<a class="dropdown-item" href="{{ route('items.units.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,2)) style="display: none" @endif>Item Units</a>
										<a class="dropdown-item" href="{{ route('receiving.suppliers.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,3)) style="display: none" @endif>Suppliers</a>
										<a class="dropdown-item" href="{{ route('issuance.employees.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,4)) style="display: none" @endif>Employees</a>
										<a class="dropdown-item" href="{{ route('accounts.divisions.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,5)) style="display: none" @endif>Divisions</a>
										<a class="dropdown-item" href="{{ route('accounts.sections.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,6)) style="display: none" @endif>Sections</a>
										<a class="dropdown-item" href="{{ route('accounts.users.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,7)) style="display: none" @endif>System Users</a>
										<a class="dropdown-item" href="{{ route('accounts.roles.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,8)) style="display: none" @endif>System Roles</a>
										<a class="dropdown-item" href="{{ route('accounts.permissions.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,9)) style="display: none" @endif>Permissions</a>
									</div>
								</li>

								<li class="mx-1 dropdown d-flex align-items-center" style="height: 100%;">
									<form action="{{ route('search.result') }}" method="GET" class="d-flex align-items-center" style="margin-top: 22px;">
										<input type="text" name="search" class="form-control form-control-sm me-2 bg-light text-dark" placeholder="Search..." style="max-width: 200px;">
										<button type="submit" class="btn btn-sm" style="background-color: rgb(31, 96, 194)"><i class="fa fa-search"></i></button>
									</form>
								</li>
								

								<li class="mx-1 dropdown m-2 d-none d-lg-block">
									<div class="bg-light fa-2x" style="width: 1px; opacity: 35%;">&nbsp;</div>
								</li>
								

								<!-- User profile dropdown integrated into the menu list -->
								<li class="mx-1 dropdown">
									<a href="#" class="text-light menu-link dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
										<img src="{{ asset(Auth::user()->avatar ?? 'images/user.png') }}" alt="profile" class="rounded-circle" width="35px" height="35px" style="object-fit: cover;">
									</a>
									<ul class="dropdown-menu text-small shadow bg-light" aria-labelledby="dropdownUser">
										<li>
											<a class="dropdown-item disabled text-dark" href="#">
												<strong class="text-uppercase"><small><i class="fa fa-user"></i> {{ Auth::user()->name }}</small></strong>
											</a>
										</li>
										<li><a class="dropdown-item" href="{{ route('accounts.users.edit-profile') }}">Profile</a></li>
										<li><a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i> Log Out</a></li>
									</ul>
								</li>

							@else
							
								<li class="mx-1 dropdown d-flex align-items-center" style="height: 100%;">
									<form action="{{ route('search.result') }}" method="GET" class="d-flex align-items-center" style="margin-top: 22px;">
										<input type="text" name="search" class="form-control form-control-sm me-2 bg-light text-dark" placeholder="Search..." style="max-width: 200px;">
										<button type="submit" class="btn btn-sm" style="background-color: rgb(31, 96, 194)"><i class="fa fa-search"></i></button>
									</form>
								</li>
								

								<li class="mx-1 dropdown m-2 d-none d-lg-block">
									<div class="bg-light fa-2x" style="width: 1px; opacity: 35%;">&nbsp;</div>
								</li>

								<!-- User profile dropdown integrated into the menu list -->
								<li class="mx-1 dropdown">
									<a href="#" class="text-light menu-link dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
										<img src="{{ asset(Auth::user()->avatar ?? 'images/user.png') }}" alt="profile" class="rounded-circle" width="35px" height="35px" style="object-fit: cover;">
									</a>
									<ul class="dropdown-menu text-small shadow bg-light" aria-labelledby="dropdownUser">
										<li>
											<a class="dropdown-item disabled text-dark" href="#">
												<strong class="text-uppercase"><small><i class="fa fa-user"></i> {{ Auth::user()->name }}</small></strong>
											</a>
										</li>
										<li><a class="dropdown-item" href="{{ route('accounts.users.edit-profile') }}">Profile</a></li>
										<li><a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i> Log Out</a></li>
									</ul>
								</li>
							
								<li class="mx-1 dropdown menu-item">
									<a class="text-light menu-link" href="javascript:void(0)">&nbsp;</a>
								</li>

							@endif
						</ul>
					</nav>
					
				<!-- #primary-menu end -->


				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
					<input type="hidden" name="role_id" value="{{Auth::user()->role_id }}">
				</form>

				<form class="top-search-form" action="search.html" method="get">
					<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off" style="height: 30px;">
				</form>

			</div>
		</div>
	</div>
	<div class="header-wrap-clone"></div>
</header>
	
{{-- MODAL --}}

@php
	$items = App\Models\Custom\Item::all();
@endphp

<div class="modal fade text-start funding-management-modal" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Select a item</h5>
				<button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				
				<div class="list-group">
					<select class="selectpicker" data-live-search="true" required>
						<option>-- SELECT A BOOK --</option>
						@foreach($items as $item)
							<option value="{{ $item->id }}">{{ $item->sku }}: {{ $item->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="list-group">
					{{-- <a href="{{ route('reports.stock-card', $item->id) }}" target="_blank"><button type="button" class="btn btn-success mt-2">Confirm</button></a> --}}
				</div>
			</div>
		</div>
	</div>
</div>
