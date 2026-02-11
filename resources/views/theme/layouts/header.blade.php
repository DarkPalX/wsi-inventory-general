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
		background-color: #fe6400;
	}
	nav.primary-menu a.menu-link,
	nav.primary-menu ul li span.menu-link {
		font-size: 11px;
		color: white;
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

<header id="header" class="full-header header-size-md dark">
	<div id="header-wrap" style="background-color:#fe6400;">
		<div class="container">
			<div class="header-row">

				<!-- Logo
				============================================= -->
				{{-- <div id="logo">
					<a href="{{ route('home') }}">
						<img class="logo-default p-2" srcset="{{ asset('images/company-logo-white.png') }}" src="{{ asset('images/company-logo-white.png') }}" alt="Logo" style="height: 55px;">
						<img class="logo-dark p-2" srcset="{{ asset('images/company-logo-white.png') }}" src="{{ asset('images/company-logo-white.png') }}" alt="Logo" style="height: 55px;">
					</a>
				</div> --}}
				<div id="logo">
					<a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
						<img class="logo-default p-2"
							src="{{ asset('images/company-logo-white.png') }}"
							alt="Logo"
							style="height:65px;">

						<span class="d-none d-lg-block ms-2">
							<strong class="text-uppercase"
									style="font-size:14px; color:#ffffff;">
								General Inventory System
							</strong>
						</span>
					</a>
				</div>

				<!-- #logo end -->

				<div class="header-misc">

					<!-- Top Search
					============================================= -->
					<div id="top-search" class="header-misc-icon">
						<a href="#" id="top-search-trigger"><i class="uil uil-search"></i><i class="bi-x-lg"></i></a>
					</div><!-- #top-search end -->

					<!-- Settings
					============================================= -->
					<div id="top-cart" class="header-misc-icon d-none d-sm-block">
						<a href="#" id="top-cart-trigger"><i class="uil uil-user"></i></a>
						<div class="top-cart-content">
							<div class="top-cart-items">
								
								<div class="top-cart-item">
									<div class="top-cart-item-image">
										<a href="{{ route('accounts.users.edit-profile') }}"><img src="{{ asset(Auth::user()->avatar ?? 'images/user.png') }}" alt="profile" class="rounded-circle" width="35px" height="35px" style="object-fit: cover;"></a>
									</div>
									<div class="top-cart-item-desc">
										<div class="top-cart-item-desc-title">
											<a href="{{ route('accounts.users.edit-profile') }}">{{ Auth::user()->name }}</a>
											<span class="top-cart-item-price d-block">{{ Auth::user()->role->name }}</span>
										</div>
										<div class="top-cart-item-quantity"><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-solid fa-sign-out text-light"></i></a></div>
									</div>
								</div>

							</div>
						</div>
					</div>
					
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
						<input type="hidden" name="role_id" value="{{Auth::user()->role_id }}">
					</form>
					<!-- #settings end -->

				</div>

				<div class="primary-menu-trigger">
					<button class="cnvs-hamburger" type="button" title="Open Mobile Menu">
						<span class="cnvs-hamburger-box"><span class="cnvs-hamburger-inner"></span></span>
					</button>
				</div>

				<!-- Primary Navigation
				============================================= -->
				<nav class="primary-menu">

					<ul class="menu-container">
						<li class="menu-item">
							<a class="menu-link" href="{{ route('home') }}"><div>Dashboard</div></a>
						</li>

						<li class="menu-item" @if(!RolePermission::has_permission(5,auth()->user()->role_id,1)) style="display: none" @endif>
							<a class="menu-link" href="{{ route('items.index') }}"><div>Items</div></a>
							<ul class="sub-menu-container">
								<li class="menu-item">
									<a class="menu-link" href="{{ route('items.index') }}">List of Items</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ route('items.create') }}" @if(!RolePermission::has_permission(1,auth()->user()->role_id,1)) style="display: none" @endif>Create New Item</a>
								</li>
							</ul>
						</li>

						<li class="menu-item mega-menu mega-menu-full" @if(!RolePermission::has_permission(5,auth()->user()->role_id,2)) style="display: none" @endif>
							<a class="menu-link" href="{{ route('receiving.transactions.index') }}"><div>Receiving</div></a>
							<div class="mega-menu-content mega-menu-style-2">
								<div class="container">
									<div class="row">

										<ul class="sub-menu-container mega-menu-column col-lg-9">
											<li class="menu-item">
												<div class="widget">

													<h4>Latest Receiving Transactions</h4>

													
													<div class="table-responsive-faker">

														<table class="table table-hover" cellspacing="0" width="100%">
															<thead>
																<tr>                            
																	<th>Ref #</th>
																	<th>Date Received</th>
																	<th>Supplier</th>
																	<th>Created</th>                            
																	<th class="text-center">Status</th>
																	<th></th>
																</tr>
															</thead>
															<tbody style="font-size:12px !important;">
																@php
																	$receiving_transactions = App\Models\Custom\ReceivingHeader::orderByDesc('id')->take(5)->get();
																@endphp

																@forelse ($receiving_transactions as $receiving_transaction)
																	<tr id="row{{$receiving_transaction->id}}">                                
																		<td valign="middle"><strong><a href="{{ route('receiving.transactions.show', ['id' => $receiving_transaction->id]) }}">{{ $receiving_transaction->ref_no }}</a></strong></td>
																		<td valign="middle">{{ (new DateTime($receiving_transaction->date_received))->format('M d, Y') }}</td>
																		<td valign="middle" width="20%"><small>{!! \App\Models\Custom\ReceivingHeader::suppliers_name($receiving_transaction->id) !!}</td>
																	
																		<td valign="middle">
																			
																				<strong>{{ User::getName($receiving_transaction->created_by) }}</strong><br>
																				{{ Setting::date_for_listing($receiving_transaction->created_at) }}
																		
																		</td>
																		<td valign="middle" valign="center">
																			<strong><small style="display: inline-block; width: 100px; text-align: center;font-size:12px;" class="rounded text-white {{ $receiving_transaction->status == 'SAVED' ? 'bg-secondary' : ($receiving_transaction->status == 'CANCELLED' ? 'bg-danger' : 'bg-success') }} p-1">{{ $receiving_transaction->status }}</small></strong><br>
																			@if($receiving_transaction->status == 'POSTED')
																				{{ Setting::date_for_listing($receiving_transaction->posted_at) }}
																			@endif

																			@if($receiving_transaction->status == 'CANCELLED')
																			{{ Setting::date_for_listing($receiving_transaction->cancelled_at) }}
																			@endif
																		</td>

																		<td valign="middle">
																			<a href="{{ route('receiving.transactions.show', ['id' => $receiving_transaction->id]) }}" class="btn" title="View Transaction"><i class="bi-eye"></i></a>
																			
																		

																		</td>
																	</tr>
																@empty
																	<tr>
																		<td class="text-center text-danger p-5" colspan="100%">No item available</td>
																	</tr>
																@endforelse
															</tbody>
														</table>

													</div>

												</div>
											</li>
										</ul>

										<ul class="sub-menu-container mega-menu-column col-lg-3">
											<li class="menu-item">
												<a class="menu-link" href="{{ route('receiving.transactions.index') }}">Show Transactions</a>
											</li>
											<li class="menu-item" @if(!RolePermission::has_permission(2,auth()->user()->role_id,1)) hidden @endif>
												<a class="menu-link" href="{{ route('receiving.transactions.create') }}">Create New Transaction</a>
											</li>
										</ul>

									</div>
								</div>
							</div>
						</li>

						<li class="menu-item mega-menu mega-menu-full" @if(!RolePermission::has_permission(5,auth()->user()->role_id,3)) style="display: none" @endif>
							<a class="menu-link" href="{{ route('issuance.requisitions.index') }}"><div>Requisitions</div></a>
							<div class="mega-menu-content mega-menu-style-2">
								<div class="container">
									<div class="row">

										<ul class="sub-menu-container mega-menu-column col-lg-9">
											<li class="menu-item">
												<div class="widget">

													<h4>Latest Requisitions</h4>

													
													<div class="table-responsive-faker">

														<table class="table table-hover" cellspacing="0" width="100%">
															<thead>
																<tr>                      
																	<th>RIS #</th>
																	<th>Date Requested</th>
																	<th>Requested By</th>
																	<th>Purpose</th>    
																	<th>Remarks</th>    
																	<th class="text-center">Status</th>
																	<th></th>
																</tr>
															</thead>
															<tbody style="font-size:12px !important;">
																@php
																	$requisition_transactions = App\Models\Custom\RequisitionHeader::orderByDesc('id')->take(5)->get();
																@endphp
																
																@forelse ($requisition_transactions as $requisition_transaction)
																	<tr id="row{{$requisition_transaction->id}}">                                
																		<td valign="middle"><strong><a href="{{ route('issuance.requisitions.show', ['id' => $requisition_transaction->id]) }}">{{ $requisition_transaction->ref_no }}</a></strong></td>
																		<td valign="middle">{{ (new DateTime($requisition_transaction->date_requested))->format('M d, Y') }}</td>
																		<td valign="middle">
																			<strong>{{ User::getSection($requisition_transaction->requested_by) }} | {{ User::getName($requisition_transaction->requested_by) }}</strong><br>
																			{{ Setting::date_for_listing($requisition_transaction->created_at) }}
																		</td>
																		<td valign="middle">{{ $requisition_transaction->purpose ?? '-' }}</td>
																		<td valign="middle">{{ $requisition_transaction->remarks ?? '-' }}</td>
																		<td class="text-center" valign="middle">
																			<strong><small style="display: inline-block; width: 100px; text-align: center;font-size:12px;" class="rounded text-white {{ $requisition_transaction->status == 'SAVED' ? 'bg-secondary' : ($requisition_transaction->status == 'CANCELLED' ? 'bg-danger' : 'bg-success') }} p-1">{{ $requisition_transaction->status }}</small></strong><br>
																			@if($requisition_transaction->status == 'POSTED')
																				{{ Setting::date_for_listing($requisition_transaction->posted_at) }}
																			@endif

																			@if($requisition_transaction->status == 'CANCELLED')
																			{{ Setting::date_for_listing($requisition_transaction->cancelled_at) }}
																			@endif
																		</td>

																		<td valign="middle">
																			<div class="btn-group">
																				<button type="button" class="btn btn-light text-primary shadow-0" data-bs-toggle="dropdown" aria-expanded="false">
																					<i class="bi-eye"></i>
																				</button>
																				<ul class="dropdown-menu dropdown-menu-end">
																					<li>
																						<a href="{{ route('issuance.requisitions.show', ['id' => $requisition_transaction->id]) }}" class="dropdown-item" title="View Requests">
																							<i class="bi-eye"></i> View Requests
																						</a>
																					</li>
																					
																					
																					<li @if(!App\Models\Custom\IssuanceHeader::hasIssuance($requisition_transaction->ref_no)) hidden @endif>
																						<a href="{{ route('issuance.requisitions.show-issuance',  $requisition_transaction->id) }}" class="dropdown-item" title="">
																							<i class="bi-eye"></i> View Issuance
																						</a>
																					</li>
																				</ul>
																			</div>
																		</td>
																	</tr>
																@empty
																	<tr>
																		<td class="text-center text-danger p-5" colspan="100%">No item available</td>
																	</tr>
																@endforelse
															</tbody>
														</table>

													</div>

												</div>
											</li>
										</ul>

										<ul class="sub-menu-container mega-menu-column col-lg-3">
											<li class="menu-item">
												<a class="menu-link" href="{{ route('issuance.requisitions.index') }}">Show Transactions</a>
											</li>
											<li class="menu-item" @if(!RolePermission::has_permission(3,auth()->user()->role_id,1)) hidden @endif>
												<a class="menu-link" href="{{ route('issuance.requisitions.create') }}">Create New Request</a>
											</li>
										</ul>

									</div>
								</div>
							</div>
						</li>

						<li class="menu-item" @if(!RolePermission::has_permission(5,auth()->user()->role_id,4)) style="display: none" @endif>
							<a class="menu-link" href="{{ auth()->user()->role_id == 5 ? route('par.transactions.user') : route('par.transactions.index') }}"><div>Par Items</div></a>
						</li>

						<li class="menu-item mega-menu mega-menu-full" @if(!RolePermission::has_permission(5,auth()->user()->role_id,5)) style="display: none" @endif>
							<a class="menu-link" href="javascript:void(0)"><div>Reports</div></a>
							
							<div class="mega-menu-content mega-menu-style-2">
								<div class="container">
									<div class="row">
										<ul class="sub-menu-container mega-menu-column col-lg-6">
											<li class="menu-item mega-menu-title">
												<div class="col-md-12 mb-2">
													<div class="card border-0 shadow">
														<div class="card-header d-flex justify-content-between align-items-center">
															<strong><small>Recent Activities</small></strong>
															<div class="tools">
																<a href="{{ route('reports.audit-trail') }}" target="_blank" class="btn"><i class="fa fa-list"></i></a>
															</div>
														</div>
														<div class="card-body">
															<div class="table-responsive-faker">
																<table class="table table-hover" cellspacing="0" width="100%">
																	<tbody>
																		@php
																			$recent_activities = App\Models\ActivityLog::orderByDesc('created_at')->take(5)->get();
																		@endphp

																		@forelse ($recent_activities as $recent_activity)
																			<tr>
																				<td>
																					<small><strong>{{ User::getName($recent_activity->log_by) }}</strong> {{ $recent_activity->dashboard_activity }}</small>
																				</td>
																				<td class="text-end">
																					<small style="font-size:10px">{{ Setting::date_for_listing($recent_activity->activity_date) }}</small>
																				</td>
																			</tr>
																		@empty
																			<tr>
																				<td class="text-center text-danger p-3" colspan="100%">No item available</td>
																			</tr>
																		@endforelse
																	</tbody>
																</table>
												
															</div>
												
														</div>
													</div>
												</div>
											</li>
										</ul>
										<ul class="sub-menu-container mega-menu-column col-lg-3">
											<li class="menu-item mega-menu-title">
												<a class="menu-link" href="#"><div>Reports</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports.issuance') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,1)) style="display: none" @endif>Issuance Report</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports.requisitions') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,8)) @endif>Requisition Report</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports.receiving') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,2)) style="display: none" @endif>Receiving Stock Report</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports.deficit-items') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,2)) style="display: none" @endif>Below Minimum Stock</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports.stock-card') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,4)) style="display: none" @endif>Stock Card Report</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports.inventory') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,5)) style="display: none" @endif>Inventory Report</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports.users') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,6)) style="display: none" @endif>User Report</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports.audit-trail') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,7)) style="display: none" @endif>Audit Trail</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports.items') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,8)) style="display: none" @endif>Item List</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports.fast-moving-items') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,8)) style="display: none" @endif>Fast Moving Items</a>
													</li>
												</ul>
											</li>
										</ul>
										<ul class="sub-menu-container mega-menu-column col-lg-3">
											<li class="menu-item mega-menu-title">
												<a class="menu-link" href="#"><div>FSI Reports</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports-fsi.stock-card') }}" target="_blank">Appendix 58 - SC</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports-fsi.inventory-custodian') }}" target="_blank">Appendix 59 - ICS</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports-fsi.inventory-physical-count') }}" target="_blank">Appendix 66 - RPCI</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports-fsi.property-card') }}" target="_blank">Appendix 69 - PC</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports-fsi.property-plant-equipment-count') }}" target="_blank">Appendix 73 - RPCPPE</a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="{{ route('reports-fsi.unserviceable-property-inspection') }}" target="_blank">Appendix 74 - IIRUP</a>
													</li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</li>

						<li class="menu-item" @if(!RolePermission::has_permission(5,auth()->user()->role_id,6) && auth()->user()->role_id != 1) style="display: none" @endif>
							<a class="menu-link" href="javascript:void(0)"><div>Maintenance</div></a>
							<ul class="sub-menu-container">
								<li class="menu-item">
									<a class="menu-link" href="{{ route('items.categories.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,1)) style="display: none" @endif>Item Categories</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ route('items.units.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,2)) style="display: none" @endif>Item Units</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ route('receiving.suppliers.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,3)) style="display: none" @endif>Suppliers</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ route('issuance.employees.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,4)) style="display: none" @endif>Employees</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ route('accounts.divisions.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,5)) style="display: none" @endif>Divisions</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ route('accounts.sections.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,6)) style="display: none" @endif>Sections</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ route('accounts.users.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,7)) style="display: none" @endif>System Users</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ route('accounts.roles.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,8)) style="display: none" @endif>System Roles</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ route('accounts.permissions.index') }}" @if(!RolePermission::has_permission(7,auth()->user()->role_id,9)) style="display: none" @endif>Permissions</a>
								</li>
							</ul>
						</li>
						
					</ul>

				</nav><!-- #primary-menu end -->

				<form class="top-search-form" action="{{ route('search.result') }}" method="get">
					<input type="text" name="search" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
				</form>

			</div>
		</div>
	</div>
	<div class="header-wrap-clone"></div>
</header>