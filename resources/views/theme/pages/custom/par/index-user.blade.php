@extends('theme.main')

@section('pagecss')
@endsection

@section('content')
    <div class="wrapper p-5">
        
        <div class="row">

            <div class="col-md-6">
                <strong class="text-uppercase"><h3 style="margin-bottom: 0px;">{{ $page->name }}</h3></strong>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item">{{ $page->name }}</li>
                        <li class="breadcrumb-item">Manage</li>
                    </ol>
                </nav>
                
            </div>
            
        </div>

        <div class="row mt-4 mb-3">
            
            {{-- FILTERS AMD ACTIONS 
            @include('theme.layouts.transaction-filters')
            --}}
            
        </div>
        
        <div class="row">
            <div class="table-responsive-faker">

                <table id="authors_tbl" class="table table-hover" cellspacing="0" width="100%">
                    <thead class="table-secondary">
                        <tr>                            
                            <th>Barcode</th>
                            <th>RIS #</th>
                            <th>Issuance Ref #</th>
                            <th>SKU</th>
                            <th>Item Description</th>
                            <th>Price</th>
                            <th>Accountable</th>
                            <th>Added By</th>           
                            <th class="text-center">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody style="font-size:12px !important;">
                        @forelse ($transactions as $transaction)
                            @php $transaction_info = \App\Models\Custom\IssuanceHeader::find($transaction->issuance_header_id); @endphp
                            
                            <tr id="row{{$transaction->id}}">                                
                                <td valign="middle">{{ $transaction->barcode }}</td>
                                <td valign="middle">{{ $transaction_info->ris_no }}</td>
                                <td valign="middle">{{ $transaction_info->ref_no }}</td>
                                <td valign="middle">{{ \App\Models\Custom\Item::getItemInfo($transaction->item_id)->sku; }}</td>
                                <td valign="middle">{{ \App\Models\Custom\Item::getItemInfo($transaction->item_id)->name; }}</td>
                                <td valign="middle">{{ $transaction->price }}</td>
                                <td valign="middle">
                                    <strong>{{ $transaction->emp_name }}</strong><br>
                                    {{ $transaction->division_name }} | {{ $transaction->section_name }}
                                </td>
                                <td valign="middle">
                                    <strong>{{ User::getName($transaction->created_by) }}</strong><br>
                                    {{ (new DateTime($transaction->created_at))->format('M d, Y') }}
                                </td>
                                <td valign="middle" class="text-center">
                                    <strong><small style="display: inline-block; width: 100px; text-align: center;font-size:12px;" class="rounded text-white {{ $transaction->status == 'OPEN' ? 'bg-success' : ($transaction->status == 'SURRENDERED' || 'CLOSED' ? 'bg-danger' : 'bg-warning') }} p-1">{{ $transaction->status }}</small></strong><br>
                                </td>

                                <td valign="middle">
                                    <a href="{{ route('par.transactions.show', $transaction->item_id) }}?barcode={{ $transaction->barcode }}" class="btn btn-light text-primary" title="View Transaction"><i class="bi-eye"></i></a>
                                    <a href="{{ route('reports-fsi.property-acknowledgement-receipt', ['id' => $transaction->id]) }}" target="_blank" class="btn btn-light text-primary" title="Generate Property Acknowledgement Receipt"><i class="bi-receipt"></i></a>
                                    
                                    @if($transaction->status != 'SURRENDERED')
                                      
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-light text-secondary shadow-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi-gear"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                @if($transaction->status != 'SURRENDERED' && $transaction->status != 'BORROWED')
                                                    @if(RolePermission::has_permission(3,auth()->user()->role_id,3))
                                                        <li>
                                                            <a href="javascript:void(0)" class="dropdown-item" onclick="single_transfer({{ $transaction->id, $transaction->item_id }})" title="Transfer">
                                                                <i class="bi-send"></i> Transfer
                                                            </a>
                                                        </li>
                                                    @endif
                                            
                                                        <li>
                                                            <a href="javascript:void(0)" class="dropdown-item" onclick="single_borrow({{ $transaction->id, $transaction->item_id }})" title="Borrow">
                                                                <i class="bi-inboxes"></i> Borrow
                                                            </a>
                                                        </li>
                                                
                                                    @if(RolePermission::has_permission(3,auth()->user()->role_id,2))
                                                        <li>
                                                            <a href="javascript:void(0)" class="dropdown-item" onclick="single_close({{ $transaction->id, $transaction->item_id }})" title="Surrender PAR Item">
                                                                <i class="fa-solid fa-cancel"></i> Surrender
                                                            </a>
                                                        </li>
                                                    @endif
                                                @elseif($transaction->status == 'BORROWED')
                                                    <li>
                                                        <a href="javascript:void(0)" class="dropdown-item" onclick="single_return({{ $transaction->id, $transaction->item_id }})" title="Return">
                                                            <i class="bi-arrow-return-left"></i> Return
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-danger p-5" colspan="100%">No item available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="row">
                    <div class="col-md-12">
                        {{ $transactions->appends($_GET)->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- MODALS --}}
    @include('theme.layouts.modals')
    
    
    <form action="" id="posting_form" style="display:none;" method="post">
        @csrf
        <input type="text" id="transactions" name="transactions">
        <input type="text" id="status" name="status">
    </form>

@endsection

@section('pagejs')
	
    <!-- jQuery -->
    <script src="{{ asset('theme/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('lib/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script>
        let listingUrl = "{{ route('par.transactions.index') }}";
    </script>
    <script src="{{ asset('js/listing.js') }}"></script>

    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
        
        function single_transfer(id,item_id){
            $('.single-transfer').modal('show');
            $('#par_detail_id_transfer').val(id);
            $('#status').val(status);
        }
        
        function single_borrow(id,item_id){
            $('.single-borrow').modal('show');
            $('#par_detail_id_borrow').val(id);
            $('#status').val(status);
        }
        
        function single_return(id,item_id){
            $('.single-return').modal('show');
            $('#par_detail_id_return').val(id);
            $('#status').val(status);
        }
        
        function single_close(id,item_id){
            $('.single-close').modal('show');
            $('#par_detail_id_close').val(id);
            $('#status').val(status);
        }
        
        // function single_close(id){
        //     $('.single-close').modal('show');
        //     $('.btn-close-par').on('click', function() {
        //         post_form("{{ route('par.items.single-close') }}",'',id);
        //     });
        // }
        
        function post_form(url,status,transactions){
            $('#posting_form').attr('action',url);
            $('#transactions').val(transactions);
            $('#status').val(status);
            $('#posting_form').submit();
        }
    </script>
    
    <script>
        document.querySelectorAll('.dropdown-menu').forEach(function (dropdown) {
            dropdown.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });
    </script>

    <script>
		// For Accountable Employees Search
		$(document).ready(function () {
			$('.search_receiver').on('input', function () {
				const query = $(this).val().trim();

				if (query.length > 0) { // Fetch data only if input is longer than 2 characters
					$.ajax({
						url: '{{ route("issuance.transactions.search-receiver") }}',
						method: 'GET',
						data: { q: query },
						success: function (data) {

							const options = data.results;
							const datalist = $('#search_receiver_list');

							datalist.empty(); // Clear existing options

							options.forEach(item => {
								datalist.append(`<option value="${item.emp_id} : ${item.name}">`);
							});

						},
						error: function () {
							console.error('Error fetching data.');
						}
					});
				}
			});
		});
    </script>
@endsection