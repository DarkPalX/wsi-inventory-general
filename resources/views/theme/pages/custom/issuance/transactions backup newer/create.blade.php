@extends('theme.main')

@section('pagecss')
<!-- Plugins/Components CSS -->
<link rel="stylesheet" href="{{ asset('theme/css/components/select-boxes.css') }}">
@endsection

@section('content')
    <div class="wrapper p-5">
        
        <div class="row">
        
            <div class="col-md-6">
                <strong class="text-uppercase">{{ $page->name }}</strong>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('issuance.transactions.index') }}">{{ $page->name }}</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ol>
                </nav>
                
            </div>
        </div>
        
        <div class="row mt-5">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Transaction Details</div>

                        <div class="card-body">
                            
							<form method="post" action="{{ route('issuance.transactions.store') }}" enctype="multipart/form-data" onsubmit="return checkSelectedItems();">
                                @csrf
								{{-- <div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Technical Report #</label>
									<div class="col-sm-10">
										<input type="text" id="technical_report_no" name="technical_report_no" class="form-control" autocomplete="off" placeholder="Enter Technical Report Control #" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }">
									</div>
								</div> --}}
								<div class="form-group row" hidden>
									<label class="col-sm-2 col-form-label">Receiving Agency</label>
									<div class="col-sm-10">
										<select id="receiver_id" name="receiver_id[]" class="select-tags form-select" multiple aria-hidden="true" style="width:100%;">
											<option value="">-- SELECT RECEIVER --</option>
											@foreach($receivers as $receiver)
												<option selected value="{{ $receiver->id }}" {{ old('receiver_id') == $receiver->id ? 'selected' : '' }}>{{ $receiver->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								{{-- <div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Receiver</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="actual_receiver" name="actual_receiver">
									</div>
								</div> --}}
								{{-- <div class="form-group row">
									<label class="col-sm-2 col-form-label">Truck Plate #</label>
									<div class="col-sm-10">
										<select id="vehicle_id" name="vehicle_id" class="select-tags form-select {{ $errors->has('vehicle_id') ? 'is-invalid' : '' }}" aria-hidden="true" style="width:100%;" required>
											<option value="">-- SELECT PLATE NO. --</option>
											@foreach($vehicles as $vehicle)
												<option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->plate_no }}</option>
											@endforeach
										</select>
										@error('vehicle_id')
											<small class="text-danger">The truck plate # is required</small>
										@enderror
									</div>
								</div> --}}
								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Release Date</label>
									<div class="col-sm-10">
										<input type="date" class="form-control" id="date_released" name="date_released" value="<?= date('Y-m-d'); ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Attachments</label>
									<div class="col-sm-10">
										<input id="attachments" name="attachments[]" class="input-file file-loading" type="file" data-show-upload="false" data-show-caption="true" data-show-preview="false" multiple>
									</div>
								</div>
								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Remarks</label>
									<div class="col-sm-10">
										<textarea class="form-control" id="remarks" name="remarks"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Accountable</label>
									<div class="col-sm-10">
										<input type="text" id="search_receiver" class="form-control search_receiver" autocomplete="off" placeholder="Type to search employee" list="search_receiver_list" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" onclick="select()">
										<datalist id="search_receiver_list"></datalist>
										<small id="receiver-error" class="text-sm text-danger" style="font-size:12px; display: none;">
											Employee cannot be empty
										</small>
									</div>
								</div>

								<div class="form-group row" hidden>
									<div class="col-sm-2">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="is_for_sale" name="is_for_sale" onchange="togglePriceInfo(this)">
											<label class="form-check-label" for="is_for_sale"><strong>For Sale</strong></label>
										</div>
									</div>
								</div>

								<div class="divider text-uppercase divider-center"><small>Item Details</small></div>
								
								<div class="form-group row">
									<div class="col-sm-12">
										<table class="table table-hover" id="selected_items_table">
											<thead>
												<tr>
													<th width="1%"></th>
													<th width="5%">ID</th>
													<th width="10%">SKU</th>
													<th width="20%">Item</th>
													<th width="5%">Unit</th>
													<th width="10%">Qty</th>
													<th width="15%">Accountable</th>
												</tr>
											</thead>
											<tbody>
												<!-- Selected items will be appended here -->
												<div id="computation-row" style="display:none;">
													<tr style="pointer-events: none; display:none;">
														<td colspan="6"><input name="item_id[]" type="text" value="0" hidden></td>
														<td class="text-end">Net Total</td>
														<td class="text-end"><input type="number" name="net_total" value="0.00" class="text-end border-0" readonly></td>
														<td colspan="2">&nbsp;</td>
													</tr>
													<tr style="pointer-events: auto; display:none;" class="table-borderless" hidden>
														<td colspan="6"><input name="item_id[]" type="text" value="0" hidden></td>
														<td class="text-end">VAT (%)</td>
														<td class="text-end"><input type="number" name="vat" value="12" class="text-end border-0" step="1" min="0" onclick="this.select()" oninput="this.value = this.value < 0 ? 0 : this.value;" ></td>
														<td>&nbsp;</td>
													</tr>
													<tr style="pointer-events: none; display:none;" hidden>
														<td colspan="6"><input name="item_id[]" type="text" value="0" hidden></td>
														<td class="text-end">Grand Total</td>
														<td class="text-end"><input type="number" name="grand_total" value="0.00" class="text-end border-0 fw-bold" style="font-size:17px;" readonly></td>
														<td>&nbsp;</td>
													</tr>
												</div>
											</tbody>
										</table>
									</div>
								</div>

								<div class="divider text-uppercase divider-center"><small>Reference</small></div>

								<div class="form-group row">
									<div class="col-md-11">
										<input type="text" class="form-control" id="item_search" name="item_search" placeholder="Search item via ID or item name .." onkeypress="if(event.key === 'Enter') { event.preventDefault(); }">
									</div>
									<div class="col-md-1">
										<button type="button" class="btn btn-secondary" onclick="document.getElementById('item_search').value=''; document.getElementById('item_search').dispatchEvent(new Event('input')); document.getElementById('item_search').dispatchEvent(new Event('change'));">Clear</button>
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-12">
										<table class="table table-hover" id="search_results_table">
											<thead>
												<tr>
													<th width="10%">ID</th>
													<th width="15%">SKU</th>
													<th>Item</th>
													<th>Unit</th>
													<th width="10%">Stock</th>
													<th width="10%">Action</th>
												</tr>
											</thead>
											<tbody>
												<!-- Results will be appended here via AJAX -->
											</tbody>
										</table>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-primary">Save</button>
										<a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-light">Cancel</a>
									</div>
								</div>
							</form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        

    </div>

@endsection

@section('pagejs')
	<script>
		jQuery(document).ready( function(){
			// select Tags
			jQuery(".select-tags").select2({
				tags: true
			});
		});
	</script>

	<script>
		// Handle AJAX search and displaying results
		jQuery(document).ready(function() {
			$ = jQuery;

			$('#item_search').on('input', function() {
				
				// if ($('#search_receiver').val().trim() === "") {
				// 	let inputField = $('#search_receiver');
				// 	let errorMessage = $('#receiver-error');

				// 	inputField.addClass('border-danger');
				// 	errorMessage.show();
				// 	$('#item_search').val('');

				// 	setTimeout(function () {
				// 		inputField.removeClass('border-danger').tooltip('hide');
				// 		errorMessage.hide();
				// 	}, 5000);
				// }
				// else{
					let searchQuery = $(this).val();
					if (searchQuery.length) {
						$.ajax({
							url: '{{ route("issuance.transactions.search-item") }}',
							method: 'GET',
							data: { query: searchQuery },
							success: function(data) {
								console.log(data);
								let resultsTableBody = $('#search_results_table tbody');
								resultsTableBody.html(''); // Clear the table

								if (data.results.length) {
									data.results.forEach(item => {
										resultsTableBody.append(`
											<tr>
												<td>${item.id}</td>
												<td>${item.sku}</td>
												<td>${item.name}</td>
												<td>${item.unit}</td>
												<td>${item.inventory}</td>
												<td><button type="button" name="insert_selected[]" class="btn btn-outline-primary add-item-btn" data-id="${item.id}" data-sku="${item.sku}" data-name="${item.name}" data-unit="${item.unit}" data-inventory="${item.inventory}">Add</button></td>
											</tr>
										`);
									});
								} else {
									resultsTableBody.append('<tr><td class="text-center text-danger" colspan="100$">No items found</td></tr>');
								}
							},
							error: function(xhr) {
								console.log('Error:', xhr.responseText);
							}
						});
					} else {
						$('#search_results_table tbody').html('<tr><td class="text-center text-danger" colspan="100%">Search query is empty</td></tr>');
					}
				// }

			});
		});

		
		// Handle adding items to the selected list
		document.addEventListener('click', function(event) {
			let target = event.target.closest('button'); // Get the closest button element
			
			if (!target) return; // Exit if no button is clicked

			let id = target.getAttribute('data-id');
			let sku = target.getAttribute('data-sku');
			let name = target.getAttribute('data-name');
			let unit = target.getAttribute('data-unit');
			let inventory = target.getAttribute('data-inventory');
			let receiver = $('#search_receiver').val();

			// Handle adding items to the selected list
			if (target.classList.contains('add-item-btn')) {
				let selectedTableBody = document.querySelector('#selected_items_table tbody');
				
				// Check if the item already exists in the selected items table
				let exists = Array.from(selectedTableBody.querySelectorAll('tr')).some(row => {
					return row.querySelector('input[name="item_id[]"]').value === id;
				});

				if (!exists) {
					// Create a new row for the selected items table
					let newRow = selectedTableBody.insertRow(0);

					// Insert cells and their content
					let actionCell = newRow.insertCell(0);
					actionCell.innerHTML = '<button name="remove_selected[]" type="button" class="btn btn-outline-danger remove-item-btn" data-id="'+id+'" data-sku="'+sku+'" data-name="'+name+'" data-unit="'+unit+'"><i class="bi-trash"></i></button>';

					let idCell = newRow.insertCell(1);
					idCell.innerHTML = id + '<input name="item_id[]" type="text" value="' + id +'" hidden>';

					let skuCell = newRow.insertCell(2);
					skuCell.innerHTML = sku + '<input name="sku[]" type="text" value="' + sku +'" hidden>';

					let nameCell = newRow.insertCell(3);
					nameCell.textContent = name;
					nameCell.innerHTML = name + '<input name="item_name[]" type="text" value="' + name +'" hidden>';

					let unitCell = newRow.insertCell(4);
					unitCell.textContent = unit;

					let quantityCell = newRow.insertCell(5);
					quantityCell.innerHTML = `
						<input name="quantity[]" 
							type="number" step="1" value="1" min="1" max="${inventory}" onclick="this.select()" class="text-end"
							style="width:100%;"
							oninput="
								this.value = this.value < 1 ? 1 : Math.min(this.value, this.max);
								var quantity = parseFloat(this.value); 
							" 
						>
					`;

					let receiverCell = newRow.insertCell(6);
					receiverCell.innerHTML = `
						<input type="text" id="search_receiver_individual" name="individual_receiver[]" value="${receiver}" class="text-end search_receiver_individual" autocomplete="off" placeholder="Search employee" list="search_receiver_list" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" onclick="select()" required>
						<datalist class="search_receiver_list_individual"></datalist>
					`;
					

					// Optionally remove the item from the search results
					target.closest('tr').remove();
				} else {
					Swal.fire({
						icon: 'warning',
						title: 'Item Already Added',
						text: 'This item is already in the selected list.',
						confirmButtonText: 'OK'
					});
				}
			}

			// Handle removing items from the selected list
			if (target.classList.contains('remove-item-btn')) {
				let searchResultsTableBody = document.querySelector('#search_results_table tbody');

				// Remove the item from the selected items table
				target.closest('tr').remove();
			}
		});

		function checkSelectedItems() {
			const selectedItemsTable = document.querySelector('#selected_items_table tbody');
			if (!selectedItemsTable || selectedItemsTable.children.length === 0) {
				Swal.fire({
					icon: 'warning',
					title: 'No Items Selected',
					text: 'Please select at least one item before saving.',
				});
				return false; // Prevent form submission
			}
			return true; // Allow form submission if items are selected
		}


		//Calculations

		function updateTotals(){
			// alert('asd');
			
			// Select all rows in the selected items table (excluding the computation row)
			const selectedItemsRows = document.querySelectorAll('#selected_items_table tbody tr');

			let netTotal = 0;
			
			// Loop through each row to sum the subtotals
			selectedItemsRows.forEach(row => {
				const subtotalInput = row.querySelector('input[name="subtotal[]"]');
				if (subtotalInput) {
					netTotal += parseFloat(subtotalInput.value);
				}
			});

			// Get VAT value (make sure it's a number and within a reasonable range)
			let vatPercentage = parseFloat(document.querySelector('input[name="vat"]').value) || 0;
			
			// Calculate the VAT amount
			let vatAmount = (netTotal * vatPercentage) / 100;
			
			// Calculate the grand total (net total + VAT)
			let grandTotal = netTotal + vatAmount;

			// Update the computed values in the table
			document.querySelector('input[name="net_total"]').value = netTotal.toFixed(2);
			document.querySelector('input[name="grand_total"]').value = grandTotal.toFixed(2);
		}


		document.addEventListener('input', function(event) {
			if (event.target.matches('input[name="vat"]') || 
				event.target.matches('input[name="quantity[]"]') || 
				event.target.matches('input[name="remove_selected[]"]')
			) {
				updateTotals();
			}
		});
		
		document.addEventListener('click', function(event) {
			if (event.target.closest('button[name="remove_selected[]"]') ||
				event.target.closest('button[name="insert_selected[]"]')) {
				updateTotals(); 
			}
		});

	</script>

	<script>
		$(document).ready(function () {
			$('#search_receiver').on('input', function () {
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
		

		$(document).ready(function () {
			$(document).on('input', '.search_receiver_individual', function () {
				const query = $(this).val().trim();

				if (query.length > 0) {
					$.ajax({
						url: '{{ route("issuance.transactions.search-receiver") }}',
						method: 'GET',
						data: { q: query },
						success: function (data) {

							const datalist = $('#search_receiver_list');

							datalist.empty(); // Clear existing options
							data.results.forEach(item => {
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