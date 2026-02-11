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
                        <li class="breadcrumb-item">View</li>
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
													<th width="5%">ID</th>
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
															<td>
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
																<input type="number" step="1" value="{{ $requisition_detail->item->getMACAttribute() }}" class="border-0 bg-transparent" disabled>
															</td>
															<td>
																<input type="number" step="1" value="{{ $requisition_detail->quantity }}" class="border-0 bg-transparent" disabled>
															</td>
															<td>
																<input name="quantity[]" 
																	type="number" step="1" value="{{ App\Models\Custom\IssuanceDetail::getConsumableQuantity($requisition_detail->ref_no, $requisition_detail->sku) }}" class="border-0 bg-transparent" disabled>
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

									<div class="col-sm-12">
										<table class="table table-hover" id="selected_items_table">
											<thead>
												<tr>
													<th width="5%">ID</th>
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
															<td>
																{{ $requisition_detail->item_id }}
																{{-- <input name="item_id[]" type="hidden" value="{{ $requisition_detail->item_id }}"> --}}
															</td>
															<td>
																{{ $requisition_detail->sku }}
																{{-- <input name="sku[]" type="hidden" value="{{ $requisition_detail->sku }}"> --}}
															</td>
															<td>
																{{ $requisition_detail->item()->withTrashed()->first()->name }}
																{{-- <input name="item_name[]" type="hidden" value="{{ $requisition_detail->item()->withTrashed()->first()->name }}"> --}}
															</td>
															<td>
																{{ $requisition_detail->item->unit->name }}
															</td>
															<td>
																{{ $requisition_detail->item->type->name }}
																{{-- <input name="item_type_id[]" type="hidden" value="{{ $requisition_detail->item->type->id }}"> --}}
															</td>
															<td>
																<input type="number" step="1" value="{{ $requisition_detail->item->getMACAttribute() }}" class="border-0 bg-transparent" disabled>
															</td>
															<td>
																<input type="number" step="1" value="{{ $requisition_detail->quantity }}" class="border-0 bg-transparent" disabled>
															</td>
															<td>
																<input name="requested_quantity[]"
																	type="number" step="1" value="{{ $equipment_qty_issued }}" class="border-0 bg-transparent" disabled >
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
																				</div>
																				<div class="col-1 text-center">
																					1
																					<input type="hidden" name="quantity[]" value="1">
																				</div>
																				<div class="col-4">
																					<input type="text" name="barcode[]" value="{{  $par_detail->barcode }}" class="border-0 bg-transparent" disabled>
																				</div>
																				<div class="col-4">
																					@php
																						$listId = 'receiver_list_' . $loop->parent->index . '_' . $loop->index;
																					@endphp

																					<input type="text" value="{{ App\Models\Custom\ParHeader::getEmployeeIdName($par_header->id, $par_header->employee_id, $requisition_detail->item_id) }}" class="border-0 bg-transparent" disabled>
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

								{{-- <div class="divider text-uppercase divider-center"><small>Other Details</small></div>
								
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
								</div> --}}

								<div class="form-group row">
									<div class="col-sm-10">
										{{-- <a href="{{ route('issuance.requisitions.index') }}" class="btn btn-secondary">Back</a> --}}
										<a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-secondary">Back</a>
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
@endsection