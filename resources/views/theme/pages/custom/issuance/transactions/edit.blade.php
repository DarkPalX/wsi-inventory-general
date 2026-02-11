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
                        <li class="breadcrumb-item"><a href="{{ route('issuance.requisitions.index') }}">{{ $page->name }}</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ol>
                </nav>
                
            </div>
        </div>
        
        <div class="row mt-5">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Issuance Details</div>

                        <div class="card-body">
							<div class="form-group row">
								<div class="col-sm-9">
									<p class="form-control-plaintext mb-0">Requestor : <strong>{{ User::getName($requisition->requested_by); }}</strong></p>
									<p class="form-control-plaintext mb-0">Division : <strong>ICT</strong></p>
									<p class="form-control-plaintext mb-0">Section : <strong>Developers</strong></p>
									<p class="form-control-plaintext mb-0">Purpose : <strong>{{ $requisition->purpose }}</strong></p>
									<p class="form-control-plaintext mb-0">Remarks : <strong>{{ $requisition->remarks }}</strong></p>
								</div>
								<div class="col-sm-3">
									<p class="form-control-plaintext mb-0">Responsibility Center Code : <strong>{{ $requisition->responsibility_center_code }}</strong></p>
									<p class="form-control-plaintext mb-0">RIS # : <strong>{{ $requisition->ref_no }}</strong></p>
									<p class="form-control-plaintext mb-0">Date Requested : <strong>{{ $requisition->date_requested }}</strong></p>
									<p class="form-control-plaintext mb-0">Date Needed : <strong>{{ $requisition->date_needed }}</strong></p>
								</div>
							</div>
						</div>
						
                    </div>
                </div>
				
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Issuance Details</div>

                        <div class="card-body">
                            
							<form id="issuance_form" method="post" action="{{ route('issuance.transactions.update', $issuance->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')

								<div class="divider text-uppercase divider-center"><small>OFFICE SUPPLIES</small></div>
								
								<div class="form-group row">
									<div class="col-sm-12">
										<table class="table table-hover" id="selected_items_table">
											<thead>
												<tr>
													<th width="5%" hidden>ID</th>
													<th width="10%">SKU</th>
													<th width="20%">Item</th>
													<th width="10%">Unit</th>
													<th width="15%">Type</th>
													<th width="10%">Price</th>
													<th width="10%">Qty Requested</th>
													<th width="10%">Qty Issued</th>
												</tr>
											</thead>
											<tbody>
												@php
													$office_supplies_count = 0;
												@endphp
												
												@foreach($requisition_details as $requisition_detail)
    												@if($requisition_detail->item->type->id == 1)
														@php
															$office_supplies_count++;	
														@endphp
														<tr>
															<td hidden>
																{{ $requisition_detail->item_id }}
																<input name="item_id[]" type="text" value="{{ $requisition_detail->item_id }}" hidden>
															</td>
															<td>
																{{ $requisition_detail->sku }}
																<input name="sku[]" type="text" value="{{ $requisition_detail->sku }}" hidden>
															</td>
															<td>
																{{ $requisition_detail->item()->withTrashed()->first()->name }}
																<input name="item_name[]" type="text" value="{{ $requisition_detail->item()->withTrashed()->first()->name }}" hidden>
															</td>
															<td>
																{{ $requisition_detail->item->unit->name }}
															</td>
															<td>
																{{ $requisition_detail->item->type->name }}
																<input name="item_type_id[]" type="text" value="{{ $requisition_detail->item->type->id }}" hidden>
															</td>

															
															<td>
																{{ $requisition_detail->item->getMACAttribute() }}
																<input hidden name="cost[]" type="number" step="0.01" value="{{ $requisition_detail->item->getMACAttribute() }}">
															</td>
															<td>
																{{ $requisition_detail->quantity }}
															</td>
															<td>
																<input name="quantity[]" 
																	type="number" step="1" value="{{ App\Models\Custom\IssuanceDetail::getConsumableQuantity($requisition_detail->ref_no, $requisition_detail->sku) }}" min="0" max="{{ $requisition_detail->quantity }}" onclick="this.select()"
																	onkeypress="if(event.key === 'Enter') { event.preventDefault(); }"
																	oninput="
																		this.value = this.value < 0 ? 0 : Math.min(this.value);
																		var quantity = parseFloat(this.value); 
																	" 
																>
															</td>
														</tr>

														<div class="form-group row" hidden>
															<div class="col-2">
																<input name="barcode[]" value="">
																<input type="text" name="individual_receiver[]" value="NULL : NULL"/>
															</div>
														</div>
														
													@endif
												@endforeach

												@if($office_supplies_count == 0)
													<tr>
														<td colspan="100%" class="text-center text-danger">No items selected</td>
													</tr>
												@endif
											</tbody>
										</table>
									</div>
								</div>

								<div class="divider text-uppercase divider-center"><small>EQUIPMENTS</small></div>
								
								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Accountable</label>
									<div class="col-sm-10">
										<input type="text" id="search_receiver" class="form-control search_receiver" autocomplete="off" placeholder="Type to search employee" list="search_receiver_list" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" onclick="select()">
										<datalist id="search_receiver_list"></datalist>
									</div>
								</div>
								
								<div class="form-group row">

									<div class="col-sm-12">
										<table class="table table-hover" id="selected_items_table">
											<thead>
												<tr>
													<th width="5%" hidden>ID</th>
													<th width="10%">SKU</th>
													<th width="20%">Item</th>
													<th width="10%">Unit</th>
													<th width="15%">Type</th>
													<th width="10%">Price</th>
													<th width="10%">Qty Requested</th>
													<th width="10%">Qty Issued</th>
													<th width="10%">&nbsp;</th>
												</tr>
											</thead>
											<tbody>
												@php
													$equipments_count = 0;
												@endphp

												@foreach($requisition_details as $index => $requisition_detail)
													@php 
														$equipments_count++; 
														$equipment_qty_issued = App\Models\Custom\ParDetail::whereIn('par_header_id', function($query) use ($issuance) {
																				$query->select('id')
																					->from('par_headers')
																					->where('issuance_header_id', $issuance->id);
																				})
																				->where('item_id', $requisition_detail->item_id)
																				->where('status', 'OPEN')
																				->count();
													@endphp

													@if($requisition_detail->item->type->id == 2)
														<tr>
															<td hidden>
																{{ $requisition_detail->item_id }}
															</td>
															<td>
																{{ $requisition_detail->sku }}
															</td>
															<td>
																{{ $requisition_detail->item()->withTrashed()->first()->name }}
															</td>
															<td>
																{{ $requisition_detail->item->unit->name }}
															</td>
															<td>
																{{ $requisition_detail->item->type->name }}
															</td>
															<td>
																{{ $requisition_detail->item->getMACAttribute() }}
																<input hidden name="requested_cost[]" type="number" step="0.01" value="{{ $requisition_detail->item->getMACAttribute() }}" >
															</td>
															<td>
																{{ $requisition_detail->quantity }}
															</td>
															<td>
																<input name="requested_quantity[]"
																	type="number" step="1" 
																	value="{{ $equipment_qty_issued }}" 
																	min="0" max="{{ $requisition_detail->quantity }}"
																	data-index="{{ $index }}"
																	data-item-id="{{ $requisition_detail->item_id }}"
																	data-sku="{{ $requisition_detail->sku }}"
																	data-item-name="{{ $requisition_detail->item->name }}"
																	data-unit-name="{{ $requisition_detail->item->unit->name }}"
																	data-type-id="{{ $requisition_detail->item->type->id }}"
																	data-type-name="{{ $requisition_detail->item->type->name }}"
																	data-item-cost="{{ $requisition_detail->item->getMACAttribute() }}"
																	onclick="this.select()"
																	onkeypress="if(event.key === 'Enter') { event.preventDefault(); }"
																	oninput="
																		this.value = this.value < 0 ? 0 : Math.min(this.value, this.max);
																		// this.value = this.value < 1 ? 1 : Math.min(this.value, this.max);
																		handleQuantityChange(this);
																	"
																>
															</td>
															<td>
																<button
																	type="button"
																	class="btn btn-sm btn-secondary"
																	onclick="handleQuantityChange(document.querySelector('input[name=\'requested_quantity[]\'][data-index=\'{{ $index }}\']'))">
																	Reassign
																</button>

															</td>
														</tr>
														<tr>
															<td colspan="100%">
																<div class=" mt-2" id="assign_accountable_div_{{ $index }}">
																	{{-- For individual accountability assignment --}}

																	
																	<div class="row mb-2">
																		<div class="col-2"><strong><small>ACCOUNTABILITY DETAILS</small></strong></div>
																		<div class="col-1 text-center">Qty</div>
																		<div class="col-4">Barcode</div>
																		<div class="col-4">Accountable</div>
																	</div>
																	
																	@php
																		$par_headers = App\Models\Custom\ParHeader::where('issuance_header_id', $issuance->id)->get();
																	@endphp
																	
																	@foreach($par_headers as $par_header)

																		@php
																			$par_details = App\Models\Custom\ParDetail::where('par_header_id', $par_header->id)->where('item_id', $requisition_detail->item_id)->where('status', 'OPEN')->get();	
																		@endphp

																		@foreach($par_details as $par_detail)
																			<div class="row mb-2">
																				<div class="col-2">
																					<input type="hidden" name="sku[]" value="{{ $requisition_detail->sku }}">
																					<input type="hidden" name="item_id[]" value="{{ $requisition_detail->item_id }}">
																					<input type="hidden" name="item_name[]" value="{{ $requisition_detail->item->name }}">
																					<input type="hidden" name="item_type_id[]" value="{{ $requisition_detail->item->type->id }}">
																					<input type="hidden"readonly  name="cost[]" value="{{ $requisition_detail->item->getMACAttribute() }}">
																				</div>
																				<div class="col-1 text-center">
																					1
																					<input type="hidden" name="quantity[]" value="1">
																				</div>
																				<div class="col-4">
																					<input type="text" name="barcode[]" value="{{  $par_detail->barcode }}" class="form-control form-control-sm barcode-input" onclick="select()" placeholder="Enter barcode" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" autocomplete="off" required>
																				</div>
																				<div class="col-4">
																					@php
																						$listId = 'receiver_list_' . $loop->parent->index . '_' . $loop->index;
																					@endphp

																					<input type="text"
																						name="individual_receiver[]"
																						value="{{ App\Models\Custom\ParHeader::getEmployeeIdName($par_header->id, $par_header->employee_id, $requisition_detail->item_id) }}"
																						class="form-control form-control-sm search_receiver_individual"
																						placeholder="Search employee"
																						list="{{ $listId }}"
																						autocomplete="off"
																						onclick="select()"
																						onkeypress="if(event.key === 'Enter') { event.preventDefault(); }"
																						required>
																					<datalist id="{{ $listId }}"></datalist>
																					
																				</div>
																			</div>
																		@endforeach
																		
																	@endforeach
																	
																</div>
															</td>
														</tr>
													@endif
												@endforeach


												@if($equipments_count == 0)
													<tr>
														<td colspan="100%" class="text-center text-danger">No items selected</td>
													</tr>
												@endif
											</tbody>
										</table>
									</div>

								</div>

								<div class="divider text-uppercase divider-center"><small>Other Details</small></div>
								
								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Date Released</label>
									<div class="col-sm-10">
										<input type="date" class="form-control" id="date_released" name="date_released" value="<?= date('Y-m-d'); ?>" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" required>
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
								<div class="form-group row" hidden>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="responsibility_center_code" value="{{ $requisition->responsibility_center_code }}">
										<input type="text" class="form-control" name="ris_no" value="{{ $requisition->ref_no }}" required>
										<input type="text" class="form-control" name="requested_by" value="{{ $requisition->requested_by }}" required>
										<input type="text" class="form-control" id="issuance_id" name="issuance_id" value="{{ $issuance->id }}" required>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-primary">Save</button>
										<a href="{{ route('issuance.requisitions.index') }}" class="btn btn-light">Back</a>
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

		function handleQuantityChange(input) {
			let index = input.dataset.index;
			let quantity = parseInt(input.value) || 0;

			let itemId = input.dataset.itemId;
			let sku = input.dataset.sku;
			let itemName = input.dataset.itemName;
			let unitName = input.dataset.unitName;
			let typeId = input.dataset.typeId;
			let typeName = input.dataset.typeName;
			let itemCost = input.dataset.itemCost;

			let container = document.getElementById('assign_accountable_div_' + index);
			container.innerHTML = '';

			container.innerHTML += `
				<div class="row mb-2">
					<div class="col-2"><strong><small>ACCOUNTABILITY DETAILS</small></strong></div>
					<div class="col-1 text-center">Qty</div>
					<div class="col-4">Barcode</div>
					<div class="col-4">Accountable</div>
				</div>
			`;

			for (let i = 0; i < quantity; i++) {
				let row = `
					<div class="row mb-2">
						<div class="col-2">
							<input type="hidden" name="sku[]" value="${sku}">
							<input type="hidden" name="item_id[]" value="${itemId}">
							<input type="hidden" name="item_name[]" value="${itemName}">
							<input type="hidden" name="item_type_id[]" value="${typeId}">
							<input type="hidden"readonly  name="cost[]" value="${itemCost}">
						</div>
						<div class="col-1 text-center">
							1
							<input type="hidden" name="quantity[]" value="1">
						</div>
						<div class="col-4">
							<input type="text" name="barcode[]" class="form-control form-control-sm barcode-input" onclick="select()" placeholder="Enter barcode" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" autocomplete="off" required>
						</div>
						<div class="col-4">
							<input type="text"
								name="individual_receiver[]"
								class="form-control form-control-sm search_receiver_individual"
								placeholder="Search employee"
								list="receiver_list_${index}_${i}"
								autocomplete="off"
								onclick="select()"
								onkeypress="if(event.key === 'Enter') { event.preventDefault(); }"
								required>
							<datalist id="receiver_list_${index}_${i}"></datalist>
						</div>
					</div>
				`;
				
				container.insertAdjacentHTML('beforeend', row);
			}

			// Fill in the value from the global "Accountable" input
			let globalAccountable = document.getElementById('search_receiver')?.value ?? '';
			// let inputs = container.querySelectorAll(`input[name^="assign[${index}]["][name$="[accountable_employee]"]`);
			let inputs = container.querySelectorAll('input.search_receiver_individual');
			inputs.forEach(input => {
				input.value = globalAccountable;
			});

			container.classList.remove('d-none');
		}

		// For Accountable Employees Search
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
				const listId = $(this).attr('list'); // Get the datalist ID assigned to this input
				const datalist = $('#' + listId);

				if (query.length > 0) {
					$.ajax({
						url: '{{ route("issuance.transactions.search-receiver") }}',
						method: 'GET',
						data: { q: query },
						success: function (data) {
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
			
		document.getElementById('issuance_form').addEventListener('submit', function (e) {
			const barcodes = [];
			let hasDuplicates = false;
		
			document.querySelectorAll('input[name="barcode[]"]').forEach(input => {
				const value = input.value.trim();
		
				if (value !== '') {
					if (barcodes.includes(value)) {
						hasDuplicates = true;
						input.classList.add('is-invalid');
					} else {
						barcodes.push(value);
						input.classList.remove('is-invalid');
					}
				}
			});
		
			if (hasDuplicates) {
				e.preventDefault();
				Swal.fire({
					icon: 'warning',
					title: 'Duplicate barcodes found!',
					text: 'Please ensure all barcodes are unique.',
				});
			}
		});

		$(document).ready(function () {
			let barcodeTimer;

			$(document).on('input', 'input[name="barcode[]"]', function () {
				const input = $(this);
				clearTimeout(barcodeTimer); // Reset timer on each input

				barcodeTimer = setTimeout(function () {
					const query = input.val().trim();
					const issuance_id = $('#issuance_id').val();

					if (query.length > 0) {
						$.ajax({
							url: '{{ route("issuance.transactions.search-existing-barcode") }}',
							method: 'GET',
							data: { q: query, id: issuance_id },
							success: function (data) {
								if (data.results) {
									input.addClass('is-invalid');
									Swal.fire({
										icon: 'warning',
										title: 'Duplicate barcode found!',
										text: 'Please ensure all barcodes are unique.',
									});
								} else {
									input.removeClass('is-invalid');
								}
							},
							error: function () {
								console.error('Error checking barcode.');
							}
						});
					}
				}, 700);
			});
		});

		$(document).ready(function () {
			$(document).on('keydown', '.barcode-input', function (e) {
				if (e.key === 'Enter') {
					e.preventDefault(); // prevent form submit if inside a form

					const currentInput = $(this);
					const inputs = $('.barcode-input');
					const currentIndex = inputs.index(currentInput);

					if (currentIndex !== -1 && currentIndex < inputs.length - 1) {
						const nextInput = inputs.eq(currentIndex + 1);
						nextInput.focus().select(); // focus and select content
					}
				}
			});
		});

	</script>

	{{-- <script>

		function handleQuantityChange(input) {
			let index = input.dataset.index;
			let quantity = parseInt(input.value) || 0;

			let itemId = input.dataset.itemId;
			let sku = input.dataset.sku;
			let itemName = input.dataset.itemName;
			let unitName = input.dataset.unitName;
			let typeId = input.dataset.typeId;
			let typeName = input.dataset.typeName;

			let container = document.getElementById('assign_accountable_div_' + index);
			container.innerHTML = '';

			container.innerHTML += `
				<div class="row mb-2">
					<div class="col-2"><strong><small>ACCOUNTABILITY DETAILS</small></strong></div>
					<div class="col-1 text-center">Qty</div>
					<div class="col-4">Barcode</div>
					<div class="col-4">Accountable</div>
				</div>
			`;

			for (let i = 0; i < quantity; i++) {
				let row = `
					<div class="row mb-2">
						<div class="col-2">
							<input type="hidden" name="sku[]" value="${sku}">
							<input type="hidden" name="item_id[]" value="${itemId}">
							<input type="hidden" name="item_name[]" value="${itemName}">
							<input type="hidden" name="item_type_id[]" value="${typeId}">
						</div>
						<div class="col-1 text-center">
							1
							<input type="hidden" name="quantity[]" value="1">
						</div>
						<div class="col-4">
							<input type="text" name="barcode[]" class="form-control form-control-sm barcode-input" onclick="select()" placeholder="Enter barcode" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" autocomplete="off" required>
						</div>
						<div class="col-4">
							<input type="text"
								name="individual_receiver[]"
								class="form-control form-control-sm search_receiver_individual"
								placeholder="Search employee"
								list="receiver_list_${index}_${i}"
								autocomplete="off"
								onclick="select()"
								onkeypress="if(event.key === 'Enter') { event.preventDefault(); }"
								required>
							<datalist id="receiver_list_${index}_${i}"></datalist>
						</div>
					</div>
				`;
				
				container.insertAdjacentHTML('beforeend', row);
			}

			// Fill in the value from the global "Accountable" input
			let globalAccountable = document.getElementById('search_receiver')?.value ?? '';
			// let inputs = container.querySelectorAll(`input[name^="assign[${index}]["][name$="[accountable_employee]"]`);
			let inputs = container.querySelectorAll('input.search_receiver_individual');
			inputs.forEach(input => {
				input.value = globalAccountable;
			});

			container.classList.remove('d-none');
		}

		// function handleQuantityChange(input) {
		// 	let index = input.dataset.index;
		// 	let quantity = parseInt(input.value) || 0;

		// 	let itemId = input.dataset.itemId;
		// 	let sku = input.dataset.sku;
		// 	let itemName = input.dataset.itemName;
		// 	let unitName = input.dataset.unitName;
		// 	let typeId = input.dataset.typeId;
		// 	let typeName = input.dataset.typeName;

		// 	let container = document.getElementById('assign_accountable_div_' + index);
		// 	container.innerHTML = '';

		// 	container.innerHTML += `
		// 		<div class="row mb-2">
		// 			<div class="col-1">ID</div>
		// 			<div class="col-2">SKU</div>
		// 			<div class="col-2">Item</div>
		// 			<div class="col-1">Unit</div>
		// 			<div class="col-1">Type</div>
		// 			<div class="col-1 text-center">Qty</div>
		// 			<div class="col-2">Barcode</div>
		// 			<div class="col-2">Accountable</div>
		// 		</div>
		// 	`;

		// 	for (let i = 0; i < quantity; i++) {
		// 		let row = `
		// 			<div class="row mb-2">
		// 				<div class="col-1">
		// 					${itemId}
		// 					<input type="hidden" name="item_id[]" value="${itemId}">
		// 				</div>
		// 				<div class="col-2">
		// 					${sku}
		// 					<input type="hidden" name="sku[]" value="${sku}">
		// 				</div>
		// 				<div class="col-2">
		// 					${itemName}
		// 					<input type="hidden" name="item_name[]" value="${itemName}">
		// 				</div>
		// 				<div class="col-1">${unitName}</div>
		// 				<div class="col-1">
		// 					${typeName}
		// 					<input type="hidden" name="item_type_id[]" value="${typeId}">
		// 				</div>
		// 				<div class="col-1 text-center">
		// 					x1
		// 					<input type="hidden" name="quantity[]" value="1">
		// 				</div>
		// 				<div class="col-2">
		// 					<input type="text" name="barcode[]" class="form-control form-control-sm" placeholder="Enter barcode" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" autocomplete="off" required>
		// 				</div>
		// 				<div class="col-2">
		// 					<input type="text"
		// 						name="individual_receiver[]"
		// 						class="form-control form-control-sm search_receiver_individual"
		// 						placeholder="Search employee"
		// 						list="receiver_list_${index}_${i}"
		// 						autocomplete="off"
		// 						onclick="select()"
		// 						onkeypress="if(event.key === 'Enter') { event.preventDefault(); }"
		// 						required>
		// 					<datalist id="receiver_list_${index}_${i}"></datalist>
		// 				</div>
		// 			</div>
		// 		`;
				
		// 		container.insertAdjacentHTML('beforeend', row);
		// 	}

		// 	// Fill in the value from the global "Accountable" input
		// 	let globalAccountable = document.getElementById('search_receiver')?.value ?? '';
		// 	// let inputs = container.querySelectorAll(`input[name^="assign[${index}]["][name$="[accountable_employee]"]`);
		// 	let inputs = container.querySelectorAll('input.search_receiver_individual');
		// 	inputs.forEach(input => {
		// 		input.value = globalAccountable;
		// 	});

		// 	container.classList.remove('d-none');
		// }

		// For Accountable Employees Search
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
				const listId = $(this).attr('list'); // Get the datalist ID assigned to this input
				const datalist = $('#' + listId);

				if (query.length > 0) {
					$.ajax({
						url: '{{ route("issuance.transactions.search-receiver") }}',
						method: 'GET',
						data: { q: query },
						success: function (data) {
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
			
		document.getElementById('issuance_form').addEventListener('submit', function (e) {
			const barcodes = [];
			let hasDuplicates = false;
		
			document.querySelectorAll('input[name="barcode[]"]').forEach(input => {
				const value = input.value.trim();
		
				if (value !== '') {
					if (barcodes.includes(value)) {
						hasDuplicates = true;
						input.classList.add('is-invalid');
					} else {
						barcodes.push(value);
						input.classList.remove('is-invalid');
					}
				}
			});
		
			if (hasDuplicates) {
				e.preventDefault();
				Swal.fire({
					icon: 'warning',
					title: 'Duplicate barcodes found!',
					text: 'Please ensure all barcodes are unique.',
				});
			}
		});

		$(document).ready(function () {
			let barcodeTimer;

			$(document).on('input', 'input[name="barcode[]"]', function () {
				const input = $(this);
				clearTimeout(barcodeTimer); // Reset timer on each input

				barcodeTimer = setTimeout(function () {
					const query = input.val().trim();
					const issuance_id = $('#issuance_id').val();

					if (query.length > 0) {
						$.ajax({
							url: '{{ route("issuance.transactions.search-existing-barcode") }}',
							method: 'GET',
							data: { q: query, id: issuance_id },
							success: function (data) {
								if (data.results) {
									input.addClass('is-invalid');
									Swal.fire({
										icon: 'warning',
										title: 'Duplicate barcode found!',
										text: 'Please ensure all barcodes are unique.',
									});
								} else {
									input.removeClass('is-invalid');
								}
							},
							error: function () {
								console.error('Error checking barcode.');
							}
						});
					}
				}, 700);
			});
		});

		$(document).ready(function () {
			$(document).on('keydown', '.barcode-input', function (e) {
				if (e.key === 'Enter') {
					e.preventDefault(); // prevent form submit if inside a form

					const currentInput = $(this);
					const inputs = $('.barcode-input');
					const currentIndex = inputs.index(currentInput);

					if (currentIndex !== -1 && currentIndex < inputs.length - 1) {
						const nextInput = inputs.eq(currentIndex + 1);
						nextInput.focus().select(); // focus and select content
					}
				}
			});
		});

	</script> --}}


@endsection