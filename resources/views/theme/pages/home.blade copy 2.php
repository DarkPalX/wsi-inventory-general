@extends('theme.main')

@section('pagecss')
    <style>
        .navigation-item:hover i {
            color: #287ad1; /* Change icon color on hover */
        }

        .navigation-item i {
            color: #000; /* Default icon color */
        }

        .navigation-item:hover .dropdown-menu {
            display: block;
            position: absolute;
            margin-top: -50%; /* Adjust dropdown position as needed */
            margin-left: 30%;
            bottom: 0;
            left: 42px;
        }

        .dropdown-menu {
            display: none;
        }

        .dropdown-menu .dropdown-item {
            font-size: 12px;
        }

        .dropdown-item:hover {
            background-color: #287ad1;
        }

        .posted td {
            background-color: rgb(189, 243, 231);
        }
        body {
            font-family: Poppins;
            font-size:13px;
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

        /* custom styles */
        @media only screen and (min-width: 769px) and (max-width: 1351px) {
            .text-pills {
                color: white;
                background-color: black;
                padding: 5px 14px;
                position: absolute;
                text-wrap: nowrap;
                z-index: 9999;
                border-radius: 50px;
                font-size: 16px;
                transform: translate(48px, -52px);
                font-weight: 600;
                cursor: pointer;
            }
            .text-pills-holder:hover .text-pills {
                display: none !important;
                /* display: block !important; */
            }
            .text-vanish small {
                display: none;
            }
        }

        /* addons by jeff */
        section#content .wrapper.mx-5.mt-4 .row.mb-5 .col-lg-11.col-md-12.col-sm-12,
        section#content .wrapper.mx-5.mt-4 .row.mb-5 .col-lg-1.col-md-12.col-sm-12.mb-md-5.mb-sm-5.shadow.rounded-5 {
            margin-top: 16px;
        }
        .col-auto.text-center.navigation-item.text-pills-holder {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            border-bottom: 1px solid #e9e9e9;
            width: 100%;
        }
        .col-auto.text-center.navigation-item.text-pills-holder a:not([class]) {
            color: #0047ab;
        }
        .col-auto.text-center.navigation-item.text-pills-holder a:not([class]):hover {
            color: #287ad1;
        }

    </style>


@endsection

@section('content')

    <div class="wrapper mx-5 mt-4">
        <div class="row mb-5">

            <div class="col-lg-1 col-md-12 col-sm-12 mb-md-5 mb-sm-5 shadow rounded-5" style="height: fit-content; display:none;">
                
                <div class="col-md-12 text-menu-holder">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row justify-content-center mb-3 mt-4">
                
                                <div class="col-auto text-center navigation-item text-pills-holder" @if(!RolePermission::has_permission(5,auth()->user()->role_id,1)) style="display: none" @endif>
                                    <a href="{{ route('items.index') }}">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" viewBox="0 0 24 24">
                                          <path fill-rule="evenodd" d="M5.005 10.19a1 1 0 0 1 1 1v.233l5.998 3.464L18 11.423v-.232a1 1 0 1 1 2 0V12a1 1 0 0 1-.5.866l-6.997 4.042a1 1 0 0 1-1 0l-6.998-4.042a1 1 0 0 1-.5-.866v-.81a1 1 0 0 1 1-1ZM5 15.15a1 1 0 0 1 1 1v.232l5.997 3.464 5.998-3.464v-.232a1 1 0 1 1 2 0v.81a1 1 0 0 1-.5.865l-6.998 4.042a1 1 0 0 1-1 0L4.5 17.824a1 1 0 0 1-.5-.866v-.81a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                                          <path d="M12.503 2.134a1 1 0 0 0-1 0L4.501 6.17A1 1 0 0 0 4.5 7.902l7.002 4.047a1 1 0 0 0 1 0l6.998-4.04a1 1 0 0 0 0-1.732l-6.997-4.042Z"/>
                                        </svg>
                                    </a>

                                    <a href="{{ route('items.index') }}" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish">
                                        <small style="font-size: 12px;">Manage Items</small>
                                        <span class="text-pills" style="display: none">Manage Items</span>
                                    </a>

                                    <div class="btn-group">
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('items.index') }}">Items List</a>
                                            <a class="dropdown-item" href="{{ route('items.create') }}" @if(!RolePermission::has_permission(1,auth()->user()->role_id,1)) style="display: none" @endif>Create New Item</a>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-auto text-center navigation-item text-pills-holder" @if(!RolePermission::has_permission(5,auth()->user()->role_id,2)) style="display: none" @endif>
                                    <a href="{{ route('receiving.transactions.index') }}">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" viewBox="0 0 24 24">
                                          <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5h7.586l-.293.293a1 1 0 0 0 1.414 1.414l2-2a1 1 0 0 0 0-1.414l-2-2a1 1 0 0 0-1.414 1.414l.293.293H4V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>

                                    <a href="{{ route('receiving.transactions.index') }}" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish">
                                        <small style="font-size: 12px;">Receiving</small>
                                        <span class="text-pills" style="display: none">Receiving</span>
                                    </a>
                                    
                                    <div class="btn-group">
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('receiving.transactions.index') }}">Receiving Transaction List</a>
                                            <a class="dropdown-item" href="{{ route('receiving.transactions.create') }}" @if(!RolePermission::has_permission(2,auth()->user()->role_id,1)) style="display: none" @endif>Create New Transaction</a>
                                            {{-- <a class="dropdown-item" href="{{ route('receiving.purchase-orders.index') }}">Purchase Order List</a>
                                            <a class="dropdown-item" href="{{ route('receiving.purchase-orders.create') }}">Create New Order</a> --}}
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-auto text-center navigation-item text-pills-holder" @if(!RolePermission::has_permission(5,auth()->user()->role_id,3)) style="display: none" @endif>
                                    <a href="{{ route('issuance.requisitions.index') }}">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" viewBox="0 0 24 24">
                                          <path fill-rule="evenodd" d="M12 3a1 1 0 0 1 .78.375l4 5a1 1 0 1 1-1.56 1.25L13 6.85V14a1 1 0 1 1-2 0V6.85L8.78 9.626a1 1 0 1 1-1.56-1.25l4-5A1 1 0 0 1 12 3ZM9 14v-1H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-4v1a3 3 0 1 1-6 0Zm8 2a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>

                                    <a href="{{ route('issuance.requisitions.index') }}" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish">
                                        <small style="font-size: 12px;">Requisitions</small>
                                        <span class="text-pills" style="display: none">Requisitions</span>
                                    </a>
                                    
                                    <div class="btn-group">
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('issuance.requisitions.index') }}">Material Requisition List</a>
                                            <a class="dropdown-item" href="{{ route('issuance.requisitions.create') }}" @if(!RolePermission::has_permission(3,auth()->user()->role_id,1)) style="display: none" @endif>Create New Request</a>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-auto text-center navigation-item text-pills-holder" @if(!RolePermission::has_permission(5,auth()->user()->role_id,4)) style="display: none" @endif>
                                    <a href="{{ auth()->user()->role_id == 5 ? route('par.transactions.user') : route('par.transactions.index') }}">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" viewBox="0 0 24 24">
                                          <path fill-rule="evenodd" d="M10 2a3 3 0 0 0-3 3v1H5a3 3 0 0 0-3 3v2.382l1.447.723.005.003.027.013.12.056c.108.05.272.123.486.212.429.177 1.056.416 1.834.655C7.481 13.524 9.63 14 12 14c2.372 0 4.52-.475 6.08-.956.78-.24 1.406-.478 1.835-.655a14.028 14.028 0 0 0 .606-.268l.027-.013.005-.002L22 11.381V9a3 3 0 0 0-3-3h-2V5a3 3 0 0 0-3-3h-4Zm5 4V5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1h6Zm6.447 7.894.553-.276V19a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-5.382l.553.276.002.002.004.002.013.006.041.02.151.07c.13.06.318.144.557.242.478.198 1.163.46 2.01.72C7.019 15.476 9.37 16 12 16c2.628 0 4.98-.525 6.67-1.044a22.95 22.95 0 0 0 2.01-.72 15.994 15.994 0 0 0 .707-.312l.041-.02.013-.006.004-.002.001-.001-.431-.866.432.865ZM12 10a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>

                                    <a href="{{ auth()->user()->role_id == 5 ? route('par.transactions.user') : route('par.transactions.index') }}" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish">
                                        <small style="font-size: 12px;">PAR</small>
                                        <span class="text-pills" style="display: none">PAR Items</span>
                                    </a>
                                </div>
                
                                <div class="col-auto text-center navigation-item text-pills-holder" @if(!RolePermission::has_permission(5,auth()->user()->role_id,5)) style="display: none" @endif>
                                    <a href="javascript:void(0)">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" viewBox="0 0 24 24">
                                          <path d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z"/>
                                          <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z"/>
                                        </svg>
                                    </a>

                                    <a href="javascript:void(0)" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish"><small style="font-size: 12px;">Reports</small></a>
                                    
                                    <div class="btn-group">
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('reports.issuance') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,1)) style="display: none" @endif>Issuance Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.requisitions') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,8)) @endif>Requisition Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.receiving') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,2)) style="display: none" @endif>Receiving Stock Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.deficit-items') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,2)) style="display: none" @endif>Below Minimum Stock</a>
                                            <a class="dropdown-item" href="{{ route('reports.stock-card') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,4)) style="display: none" @endif>Stock Card Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.inventory') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,5)) style="display: none" @endif>Inventory Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.users') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,6)) style="display: none" @endif>User Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.audit-trail') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,7)) style="display: none" @endif>Audit Trail</a>
                                            <a class="dropdown-item" href="{{ route('reports.items') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,8)) style="display: none" @endif>Item List</a>
                                            <a class="dropdown-item" href="{{ route('reports.fast-moving-items') }}" target="_blank" @if(!RolePermission::has_permission(6,auth()->user()->role_id,8)) style="display: none" @endif>Fast Moving Items</a>
									
                                            <div class="dropdown-submenu-container">
                                                <a href="#" class="dropdown-item dropdown-toggle">FSI Reports</a>
                                                {{-- <div class="dropdown-menu bg-light shadow"> --}}
                                                <div class="dropdown-submenu bg-light shadow" style="height: 200px;">
                                                    <a class="dropdown-item" href="{{ route('reports-fsi.stock-card') }}" target="_blank">Appendix 58 - SC</a>
                                                    <a class="dropdown-item" href="{{ route('reports-fsi.inventory-custodian') }}" target="_blank">Appendix 59 - ICS</a>
                                                    <a class="dropdown-item" href="{{ route('reports-fsi.inventory-physical-count') }}" target="_blank">Appendix 66 - RPCI</a>
                                                    <a class="dropdown-item" href="{{ route('reports-fsi.property-card') }}" target="_blank">Appendix 69 - PC</a>
                                                    <a class="dropdown-item" href="{{ route('reports-fsi.property-plant-equipment-count') }}" target="_blank">Appendix 73 - RPCPPE</a>
                                                    <a class="dropdown-item" href="{{ route('reports-fsi.unserviceable-property-inspection') }}" target="_blank">Appendix 74 - IIRUP</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-auto text-center navigation-item text-pills-holder" @if(!RolePermission::has_permission(5,auth()->user()->role_id,6) && auth()->user()->role_id != 1) style="display: none" @endif>
                                {{-- <div class="col-auto text-center navigation-item text-pills-holder" style="border-bottom-color: transparent;" @if(!RolePermission::has_permission(5,auth()->user()->role_id,6) && auth()->user()->role_id != 1) style="display: none" @endif> --}}
                                    <a href="javascript:void(0)">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" viewBox="0 0 24 24">
                                          <path fill-rule="evenodd" d="M17 10v1.126c.367.095.714.24 1.032.428l.796-.797 1.415 1.415-.797.796c.188.318.333.665.428 1.032H21v2h-1.126c-.095.367-.24.714-.428 1.032l.797.796-1.415 1.415-.796-.797a3.979 3.979 0 0 1-1.032.428V20h-2v-1.126a3.977 3.977 0 0 1-1.032-.428l-.796.797-1.415-1.415.797-.796A3.975 3.975 0 0 1 12.126 16H11v-2h1.126c.095-.367.24-.714.428-1.032l-.797-.796 1.415-1.415.796.797A3.977 3.977 0 0 1 15 11.126V10h2Zm.406 3.578.016.016c.354.358.574.85.578 1.392v.028a2 2 0 0 1-3.409 1.406l-.01-.012a2 2 0 0 1 2.826-2.83ZM5 8a4 4 0 1 1 7.938.703 7.029 7.029 0 0 0-3.235 3.235A4 4 0 0 1 5 8Zm4.29 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h6.101A6.979 6.979 0 0 1 9 15c0-.695.101-1.366.29-2Z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>

                                    <a href="javascript:void(0)" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish"><small style="font-size: 12px;">Maintenance</small></a>
                                    
                                    <div class="btn-group">
                                        <div class="dropdown-menu">
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
                                    </div>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="col-md-12 mb-2">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0">Dashboard</h4>
                                {{-- <div class="tools">
                                    <button class="btn btn-primary">Add New</button>
                                    <button class="btn btn-secondary">Settings</button>
                                </div> --}}
                            </div>
                            
                            <div class="row justify-content-center">
                    
                                <div class="col-sm-6 col-lg-3 mb-4">
                                    <div class="border rounded-5 shadow p-3 h-100">
                                        <div class="feature-box fbox-effect">
                                            <div class="fbox-icon">
                                                <a href="{{ route('issuance.transactions.index') }}"><i class="uil-upload-alt"></i></a>
                                            </div>
                                            <div class="fbox-content">
                                                <div class="counter-small">
                                                    <span style="font-size:28px;"><strong>{{ $total_issuance }}</strong></span>
                                                </div>
                                                <p>Total Requisitions</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-3 mb-4">
                                    <div class="border rounded-5 shadow p-3 h-100">
                                        <div class="feature-box fbox-effect">
                                            <div class="fbox-icon">
                                                <a href="{{ route('issuance.requisitions.index') }}"><i class="bi-archive"></i></a>
                                            </div>
                                            <div class="fbox-content">
                                                <div class="counter-small">
                                                    <span style="font-size:28px;"><strong>{{ number_format($total_pending_issuance,0) }}</strong></span>
                                                </div>
                                                {{-- <div class="counter counter-small">
                                                    <span data-from="0" data-to="{{ $inventory }}" data-refresh-interval="50" data-speed="700"></span>
                                                </div> --}}
                                                <p>Pending Issuance</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-3 mb-4">
                                    <div class="border rounded-5 shadow p-3 h-100">
                                        <div class="feature-box fbox-effect">
                                            <div class="fbox-icon">
                                                <a href="{{ route('issuance.requisitions.index') }}"><i class="bi-archive"></i></a>
                                            </div>
                                            <div class="fbox-content">
                                                <div class="counter-small">
                                                    <span style="font-size:28px;"><strong>{{ $total_unfulfilled_requests }}</strong></span>
                                                </div>
                                                <p>Unfulfilled Requests</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::user()->role_id == env('APPROVER_ROLE_ID') || Auth::user()->role_id == env('SECRETARY_ROLE_ID'))

                                <div class="col-sm-6 col-lg-3 mb-4">
                                    <div class="border rounded-5 shadow p-3 h-100">
                                        <div class="feature-box fbox-effect">
                                            <div class="fbox-icon">
                                                <a href="{{ route('par.transactions.index') }}"><i class="bi-boxes"></i></a>
                                            </div>
                                            <div class="fbox-content">
                                                <div class="counter-small">
                                                    <span style="font-size:28px;"><strong>{{ number_format($total_equipments,0) }}</strong></span>
                                                </div>
                                                {{-- <div class="counter counter-small">
                                                    <span data-from="0" data-to="{{ $inventory }}" data-refresh-interval="50" data-speed="700"></span>
                                                </div> --}}
                                                <p>PAR Items</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-sm-6 col-lg-3 mb-4">
                                    <div class="border rounded-5 shadow p-3 h-100">
                                        <div class="feature-box fbox-effect">
                                            <div class="fbox-icon">
                                                <a target="_blank" href="{{ route('reports.deficit-items') }}"><i class="bi-boxes"></i></a>
                                            </div>
                                            <div class="fbox-content">
                                                <div class="counter-small">
                                                    <span style="font-size:28px;"><strong>{{ number_format("1",0) }}</strong></span>
                                                </div>
                                                
                                                <p>Below Minimum Stock</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="card border-0 shadow">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <strong><small>Latest Issuance Transactions</small></strong>
                                        <div class="tools">
                                            <a href="{{ route('issuance.transactions.index') }}" class="btn btn-light text-dark"><i class="fa fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive-faker">
                                            <table class="transactions table table-hover" cellspacing="0" width="100%">
                                                <thead class="table-secondary">
                                                    <tr>
                                                        <th width="20%">Ref #</th>
                                                        <th width="20%">Released</th>
                                                        <th>Status</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($issuance_transactions as $issuance_transaction)
                                                        @php 
                                                            $requisition = App\Models\Custom\RequisitionHeader::where('ref_no', $issuance_transaction->ris_no)->first();
                                                        @endphp

                                                        <tr id="row{{$issuance_transaction->id}}" onclick="window.location.href='{{ route('issuance.requisitions.show-issuance', $requisition->id) }}';" class="{{ $issuance_transaction->status == 'POSTED' ? 'posted' : '' }}">
                                                            <td><a href="{{ route('issuance.requisitions.show-issuance', $requisition->id) }}">{{ $issuance_transaction->ref_no }}</a></td>
                                                            <td>{{ (new DateTime($issuance_transaction->date_received))->format('M d, Y') }}</td>
                                                            <td>
                                                                {{-- {{ $issuance_transaction->status }} --}}
                                                                <strong><small style="display: inline-block; width: 100px; text-align: center;font-size:12px;" class="rounded text-white {{ $issuance_transaction->status == 'SAVED' ? 'bg-secondary' : ($issuance_transaction->status == 'CANCELLED' ? 'bg-danger' : 'bg-success') }} p-1">{{ $issuance_transaction->status }}</small></strong>
                                                            </td>
                                                            <td>{{ $issuance_transaction->remarks }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center text-danger p-3" colspan="100%">No item available</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{-- {{ $issuance_transactions->onEachSide(1)->links('pagination::bootstrap-5') }} --}}
                                                </div>
                                            </div>
                            
                                        </div>
                            
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="col-md-12 mb-2">
                            <div class="card border-0 shadow">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <strong><small>Pending Issuance Transactions</small></strong>
                                    <div class="tools">
                                        <a href="{{ route('issuance.requisitions.index') }}" class="btn btn-light text-dark"><i class="fa fa-list"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-faker">
                                        <table class="transactions table table-hover" cellspacing="0" width="100%">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th width="10%">Ref #</th>
                                                    <th>Date Requested</th>
                                                    <th>Date Needed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pending_issuance_transactions as $pending_issuance_transaction)
                                                    <tr id="row{{$pending_issuance_transaction->id}}" onclick="window.location.href='{{ route('issuance.requisitions.show', ['id' => $pending_issuance_transaction->id]) }}';" class="{{ $pending_issuance_transaction->status == 'POSTED' ? 'posted' : '' }}">
                                                        <td><strong><a href="{{ route('issuance.requisitions.show', ['id' => $pending_issuance_transaction->id]) }}">{{ $pending_issuance_transaction->ref_no }}</a></strong></td>
                                                        <td>{{ (new DateTime($pending_issuance_transaction->date_requested))->format('M d, Y') }}</td>
                                                        <td>{{ (new DateTime($pending_issuance_transaction->date_needed))->format('M d, Y') }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center text-danger p-3" colspan="100%">No item available</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- {{ $pending_issuance_transactions->onEachSide(1)->links('pagination::bootstrap-5') }} --}}
                                            </div>
                                        </div>
                        
                                    </div>
                        
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="col-md-12 mb-2">
                            <div class="card border-0 shadow">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <strong><small>Fast Moving Items</small></strong>
                                    <div class="tools">
                                        <a href="{{ route('reports.fast-moving-items') }}" class="btn btn-light text-dark"><i class="fa fa-list"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-faker">
                                        <table class="transactions table table-hover" cellspacing="0" width="100%">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th class="text-start">SKU</th>
                                                    <th>Item</th>
                                                    <th>Total Issued</th>
                                                    <th>Daily Average</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($fast_moving_items as $fast_moving_item)
                                                    <tr>
                                                        <td class="text-start"><strong><a href="{{ route('items.show', $fast_moving_item->item_id) }}">{{ $fast_moving_item->sku }}</a></strong></td>
                                                        <td>{{ App\Models\Custom\Item::getItemInfo($fast_moving_item->item_id)->name }}</td>
                                                        <td>{{ $fast_moving_item->total_issued }}</td>
                                                        <td>{{ number_format($fast_moving_item->daily_average, 2) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center text-danger p-3" colspan="100%">No item available</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- {{ $pending_issuance_transactions->onEachSide(1)->links('pagination::bootstrap-5') }} --}}
                                            </div>
                                        </div>
                        
                                    </div>
                        
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>



    {{-- MODAL --}}

    <div class="modal fade text-start funding-management-modal" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi-wallet i-alt mr-2"></i> Funding</h5>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">Manage Agencies</a>
                        <a href="#" class="list-group-item list-group-item-action">Create an Agency</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('pagejs')
    <script>
        $(document).ready(function() {

            var table = new DataTable('.transactions', {
                order: [[2, 'desc']], 

                columnDefs: [
                    {
                        visible: false,
                        target: []
                    }
                ]
            });
        });
    </script>
@endsection