@extends('theme.layouts.report')

@section('pagecss')
    <style>
        .thick-top-border {
            border-top: 3px solid #000 !important;
        }
        .thick-bottom-border {
            border-bottom: 3px solid #000 !important;
        }
        .thick-left-border {
            border-left: 3px solid #000 !important;
        }
        .thick-right-border {
            border-right: 3px solid #000 !important;
        }
    </style>
@endsection

@section('content')
    <div class="wrapper p-5">
        
        <div class="row">

            <div class="col-md-12 text-center">
                <h4 class="text-uppercase">{{ $page->name }}<br><small>{{ Setting::info()->company_name }}</small></h4>
            </div>
            
        </div>
        
        <div class="row mt-5 justify-content-center">
            <div class="col-md-8">
                
                
                <form id="select_item_form" class="d-flex justify-content-between align-items-end" action="{{ route('reports-fsi.stock-card') }}" method="get">
                    <div class="col-6">
                        <strong>Select an item</strong>
                        <select name="id" class="selectpicker border w-100 form-control" data-live-search="true" onchange="document.getElementById('select_item_form').submit()">
                            <option disabled selected>-- SELECT ITEM --</option>
                            @foreach($items as $selection)
                                <option value="{{ $selection->id }}" @if($item->id == $selection->id) selected @endif>{{ $selection->sku }}: {{ $selection->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                
                <table class="col-12 border border-1 border-dark">

                    {{-- HEADINGS --}}
                    <tr>
                        <td colspan="100%" class="text-end"><i>Appendix 58 &nbsp;</i></td>
                    </tr>
                    <tr>
                        <td colspan="100%" class="text-center"><strong>STOCK CARD</strong></td>
                    </tr>
                    <tr>
                        <td colspan="100%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="border border-0" colspan="5"><strong>Entity Name: </strong></td>
                        <td class="border border-0" colspan="2"><strong>Fund Cluster: </strong></td>
                    </tr>
                    
                    {{-- HEADER --}}
                    <tr>
                        <td class="border border-1 border-dark" colspan="5">Item: </td>
                        <td class="border border-1 border-dark" colspan="2">Stock No.: </td>
                    </tr>
                    <tr>
                        <td class="border border-1 border-dark" colspan="5">Description: </td>
                        <td class="border border-1 border-dark" colspan="2">Re-order Point.: </td>
                    </tr>
                    <tr>
                        <td class="border border-1 thick-bottom-border border-dark" colspan="5">Unit of Measurement: </td>
                        <td class="border border-1 thick-bottom-border border-dark" colspan="2"></td>
                    </tr>
                    
                    {{-- BODY --}}
                    <tr>
                        <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Date</strong></td>
                        <td class="border border-1 border-dark" style="text-align: center;" width="20%" rowspan="2"><strong>Reference</strong></td>
                        <td class="border border-1 border-dark" style="text-align: center;" width="10%"><strong>Receipt</strong></td>
                        <td class="border border-1 border-dark" style="text-align: center;" width="20%" colspan="2"><strong>Issue</strong></td>

                        <td class="border border-1 border-dark" style="text-align: center;" width="20%"><strong>Balance</strong></td>
                        <td class="border border-1 border-dark" style="text-align: center;" width="20%" rowspan="2"><strong>No. of Days to Consume</strong></td>
                    </tr>
                    <tr>
                        <td class="border border-1 border-dark" style="text-align: center;" width="5%">Qty</td>
                        <td class="border border-1 border-dark" style="text-align: center;" width="5%">Qty</td>
                        <td class="border border-1 border-dark" style="text-align: center;" width="10%">Office</td>
                        <td class="border border-1 border-dark" style="text-align: center;" width="5%">Qty</td>
                    </tr>
                    
                    <tr>
                        <td class="border border-1 border-dark" style="text-align: center;">05/09/2025</td>
                        <td class="border border-1 border-dark" style="text-align: center;">IS9078123</td>
                        <td class="border border-1 border-dark" style="text-align: center;">20</td>
                        <td class="border border-1 border-dark" style="text-align: center;">10</td>
                        <td class="border border-1 border-dark" style="text-align: center;">ICT</td>
                        <td class="border border-1 border-dark" style="text-align: center;">10</td>
                        <td class="border border-1 border-dark" style="text-align: center;"></td>
                    </tr>

                </table>
                
                {{-- <div class="card">
                    <div class="card-header">Stock Card</div>

                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td width="50%">                                    
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="30%">Item </td>
                                            <td width="5%">:</td>
                                            <td>{{ $item->sku ?? 'Select a item first' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Description</td>
                                            <td width="5%">:</td>
                                            <td>{{ $item->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Unit of Measurement</td>
                                            <td width="5%">:</td>
                                            <td>{{ $item->unit->name }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Inventory</td>
                                            <td width="5%">:</td>
                                            <td>{{ $item->Inventory }}</td>
                                        </tr>
                                        <!-- <tr>
                                            <td width="10%">Cost</td>
                                            <td width="1%">:</td>
                                            <td>{{ $item->price }}</td>
                                        </tr>
                                        <tr>
                                            <td width="10%">Total Cost</td>
                                            <td width="1%">:</td>
                                            <td>{{ number_format(($item->price * $item->Inventory),2) }}</td>
                                        </tr> -->
                                    </table>
                                </td>
                                <td valign="top">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="30%">Stock No</td>
                                            <td width="5%">:</td>
                                            <td>{{ $item->id }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Reorder Point</td>
                                            <td width="5%">:</td>
                                            <td>{{ $item->minimum_stock }}</td>
                                        </tr>
                                       
                                    </table>
                                </td>
                            </tr>
                        </table>
                        
                        
                        <div class="table-responsive mt-5">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Transaction ID</th>
                                        <th>Quantity</th>
                                        <th>Running Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stock_card as $entry)
                                        @php
                                            $trans_id = '';
                                            if($entry['type'] == 'Receiving'){
                                                $trans_id = '<a href="' . route('receiving.transactions.show', ['id' => $entry['transaction_id']]) . '">' . $entry['ref_no'] . '</a>';

                                            }
                                            if($entry['type'] == 'Issuance'){
                                                $trans_id = '<a href="' . route('issuance.transactions.show', ['id' => $entry['transaction_id']]) . '">' . $entry['ref_no'] . '</a>';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($entry['date'])->format('m/d/Y') }}</td>
                                            <td>{{ $entry['type'] }}</td>
                                            <td>{!! $trans_id !!}</td>
                                            <td>{{ $entry['quantity'] }}</td>
                                            <td>{{ $entry['running_balance'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" class="text-danger text-center">No transaction history</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <a href="javascript:window.history.back()" class="btn btn-secondary mt-4">Back</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
@endsection
