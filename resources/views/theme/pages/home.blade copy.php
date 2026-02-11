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
            margin-left: 100%;
            bottom: 0;
            left: 42px;
        }

        .dropdown-menu {
            display: none;
        }

        .dropdown-menu .dropdown-item {
            padding: 14px;
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
                display: block !important;
            }
            .text-vanish small {
                display: none;
            }
        }
    </style>


@endsection

@section('content')

    <div class="wrapper mx-5 mt-4">
        <div class="row mb-5">

            <div class="col-lg-1 col-md-12 col-sm-12 mb-md-5 mb-sm-5 shadow rounded-5">
                
                <div class="col-md-12 text-menu-holder">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row justify-content-center mb-3">
                
                                <div class="col-auto text-center navigation-item text-pills-holder">
                                    <a href="{{ route('books.index') }}"><i class="bi-book display-6 mt-2 mb-2 mx-auto d-block"></i></a>

                                    <a href="{{ route('books.index') }}" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish">
                                        <small style="font-size: 12px;">Manage Items</small>
                                        <span class="text-pills" style="display: none">Manage Items</span>
                                    </a>
                                </div>
                
                                <div class="col-auto text-center navigation-item text-pills-holder">
                                    <a href="{{ route('receiving.transactions.index') }}"><i class="uil-download-alt display-6 mt-2 mb-2 mx-auto d-block"></i></a>

                                    <a href="{{ route('books.index') }}" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish">
                                        <small style="font-size: 12px;">Receiving</small>
                                        <span class="text-pills" style="display: none">Receiving</span>
                                    </a>
                                </div>
                
                                <div class="col-auto text-center navigation-item text-pills-holder">
                                    <a href="{{ route('issuance.transactions.index') }}"><i class="uil-upload-alt display-6 mt-2 mb-2 mx-auto d-block"></i></a>

                                    <a href="{{ route('issuance.transactions.index') }}" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish">
                                        <small style="font-size: 12px;">Issuance</small>
                                        <span class="text-pills" style="display: none">Issuance</span>
                                    </a>
                                </div>
                
                                <div class="col-auto text-center navigation-item text-pills-holder">
                                    <a href="javascript:void(0)"><i class="bi-graph-up display-6 mt-2 mb-2 mx-auto d-block"></i></a>

                                    <a href="javascript:void(0)" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish"><small style="font-size: 12px;">Reports</small></a>
                                    
                                    <div class="btn-group">
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('reports.issuance') }}" target="_blank">Issuance Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.receiving') }}" target="_blank">Receiving Stock Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.stock-card') }}" target="_blank">Stock Card Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.inventory') }}" target="_blank">Inventory Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.users') }}" target="_blank">User Report</a>
                                            <a class="dropdown-item" href="{{ route('reports.audit-trail') }}" target="_blank">Audit Trail</a>
                                            <a class="dropdown-item" href="{{ route('reports.books') }}" target="_blank">Item List</a>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-auto text-center navigation-item text-pills-holder">
                                    <a href="javascript:void(0)"><i class="bi-gear display-6 mt-2 mb-2 mx-auto d-block"></i></a>

                                    <a href="javascript:void(0)" class="text-dark mt-2 mb-2 mx-auto d-block text-uppercase text-vanish"><small style="font-size: 12px;">Maintenance</small></a>
                                    
                                    <div class="btn-group">
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('books.categories.index') }}">Item Categories</a>
                                            <a class="dropdown-item" href="{{ route('books.authors.index') }}">Item Authors</a>
                                            <a class="dropdown-item" href="{{ route('books.publishers.index') }}">Item Publishers</a>
                                            <a class="dropdown-item" href="{{ route('books.agencies.index') }}">Receiving Agencies</a>
                                            <a class="dropdown-item" href="{{ route('receiving.suppliers.index') }}">Item Suppliers/Printers</a>
                                            <a class="dropdown-item" href="{{ route('issuance.receivers.index') }}">Issuance Receivers</a>
                                            <a class="dropdown-item" href="{{ route('accounts.users.index') }}">System Users</a>
                                            <a class="dropdown-item" href="{{ route('accounts.roles.index') }}">System Roles</a>
                                            <a class="dropdown-item" href="{{ route('accounts.permissions.index') }}">System Permissions</a>
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            

            <div class="col-lg-11 col-md-12 col-sm-12">

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
                                                <a href="{{ route('books.index') }}"><i class="bi-book"></i></a>
                                            </div>
                                            <div class="fbox-content">
                                                <div class="counter counter-small">
                                                    <span data-from="0" data-to="{{ $inventory }}" data-refresh-interval="50" data-speed="700"></span>
                                                </div>
                                                <p>Total Inventory</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="col-sm-6 col-lg-3 mb-4">
                                    <div class="border rounded-5 shadow p-3 h-100">
                                        <div class="feature-box fbox-effect">
                                            <div class="fbox-icon">
                                                <a href="{{ route('books.index') }}"><i class="fa fa-peso-sign"></i></a>
                                            </div>
                                            <div class="fbox-content">
                                                <div class="counter-small">
                                                    {{-- <span id="total-cost" data-from="0" data-to="{{ $total_cost }}" data-refresh-interval="50" data-speed="700">
                                                        {{ number_format($total_cost, 2) }}
                                                    </span> --}}
                                                    
                                                    {{-- <span data-from="0" data-to="{{ number_format($total_cost,2) }}" data-refresh-interval="50" data-speed="700"></span> --}}
                                                    {{-- <span data-from="0" data-to="{{ $total_cost }}" data-refresh-interval="50" data-speed="700"></span> --}}

                                                    <span style="font-size:28px;"><strong>{{ number_format($total_cost,2) }}</strong></span>
                                                </div>
                                                <p>Total Cost</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="col-sm-6 col-lg-3 mb-4">
                                    <div class="border rounded-5 shadow p-3 h-100">
                                        <div class="feature-box fbox-effect">
                                            <div class="fbox-icon">
                                                <a href="{{ route('receiving.transactions.index') }}"><i class="uil-download-alt"></i></a>
                                            </div>
                                            <div class="fbox-content">
                                                <div class="counter counter-small">
                                                    <span data-from="0" data-to="{{ $current_receiving_count }}" data-refresh-interval="50" data-speed="700"></span>
                                                </div>
                                                <p>PENDING Receiving Transaction </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="col-sm-6 col-lg-3 mb-4">
                                    <div class="border rounded-5 shadow p-3 h-100">
                                        <div class="feature-box fbox-effect">
                                            <div class="fbox-icon">
                                                <a href="{{ route('issuance.transactions.index') }}"><i class="uil-upload-alt"></i></a>
                                            </div>
                                            <div class="fbox-content">
                                                <div class="counter counter-small">
                                                    <span data-from="0" data-to="{{ $current_issuance_count }}" data-refresh-interval="50" data-speed="700"></span>
                                                </div>
                                                <p>PENDING Issuance Transaction</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7">
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
                                            <table class="table table-hover" cellspacing="0" width="100%">
                                                <thead class="table-secondary">
                                                    <tr>
                                                        <th width="10%">Ref #</th>
                                                        <th>Released</th>
                                                        <th>Receiver</th>
                                                        <th>Status</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($issuance_transactions as $issuance_transaction)
                                                        <tr id="row{{$issuance_transaction->id}}" onclick="window.location.href='{{ route('issuance.transactions.show', ['id' => $issuance_transaction->id]) }}';" class="{{ $issuance_transaction->status == 'POSTED' ? 'posted' : '' }}">
                                                            <td><a href="{{ route('issuance.transactions.show', ['id' => $issuance_transaction->id]) }}">{{ $issuance_transaction->ref_no }}</a></td>
                                                            <td>{{ (new DateTime($issuance_transaction->date_received))->format('M d, Y') }}</td>
                                                            <td>
                                                                {!! \App\Models\Custom\IssuanceHeader::receivers_name($issuance_transaction->id) !!}</small>
                                                            </td>
                                                            <td>
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
                                                    {{ $issuance_transactions->onEachSide(1)->links('pagination::bootstrap-5') }}
                                                </div>
                                            </div>
                            
                                        </div>
                            
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-md-12 mb-2">
                                <div class="card border-0 shadow">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <strong><small>Latest Receiving Transactions</small></strong>
                                        <div class="tools">
                                            <a href="{{ route('receiving.transactions.index') }}" class="btn btn-light text-dark"><i class="fa fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive-faker">
                                            <table class="table table-hover" cellspacing="0" width="100%">
                                                <thead class="table-secondary">
                                                    <tr>
                                                        <th width="10%">Ref #</th>
                                                        <th>Received</th>
                                                        <th>Suppliers</th>
                                                        <th>Status</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($receiving_transactions as $receiving_transaction)
                                                        <tr id="row{{$receiving_transaction->id}}" onclick="window.location.href='{{ route('receiving.transactions.show', ['id' => $receiving_transaction->id]) }}';" class="{{ $receiving_transaction->status == 'POSTED' ? 'posted' : '' }}">
                                                            <td><strong><a href="{{ route('receiving.transactions.show', ['id' => $receiving_transaction->id]) }}">{{ $receiving_transaction->ref_no }}</a></strong></td>
                                                            <td>{{ (new DateTime($receiving_transaction->date_received))->format('M d, Y') }}</td>
                                                            <td>
                                                                {!! \App\Models\Custom\ReceivingHeader::suppliers_name($receiving_transaction->id) !!}
                                                            </td>
                                                            <td>
                                                                <strong><small style="display: inline-block; width: 100px; text-align: center;font-size:12px;" class="rounded text-white {{ $receiving_transaction->status == 'SAVED' ? 'bg-secondary' : ($receiving_transaction->status == 'CANCELLED' ? 'bg-danger' : 'bg-success') }} p-1">{{ $receiving_transaction->status }}</small></strong>
                                                            </td>
                                                            <td>{{ $receiving_transaction->remarks }}</td>
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
                                                    {{ $receiving_transactions->onEachSide(1)->links('pagination::bootstrap-5') }}
                                                </div>
                                            </div>
                            
                                        </div>
                            
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="col-md-12 mb-2">
                            <div class="card border-0 shadow">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <strong><small>Recent Activities</small></strong>
                                    <div class="tools">
                                        <a href="{{ route('reports.audit-trail') }}" target="_blank" class="btn btn-light text-dark"><i class="fa fa-list"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-faker">
                                        <table class="table table-hover" cellspacing="0" width="100%">
                                            <tbody>
                                                @forelse ($activity_logs as $activity_log)
                                                    <tr>
                                                        <td>
                                                            <small><strong>{{ User::getName($activity_log->log_by) }}</strong> {{ $activity_log->dashboard_activity }}</small>
                                                        </td>
                                                        <td class="text-end">
                                                            <small style="font-size:10px">{{ Setting::date_for_listing($activity_log->activity_date) }}</small>
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
@endsection