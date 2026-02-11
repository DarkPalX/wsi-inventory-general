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

                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <a href="javascript:void(0)" class="text-decoration-none text-end" onclick="print_area('print-area')">
                                <small>Print Report &nbsp;</small>
                            </a>
                        </div>
                    </div>
                </div>
                    
                <div class=	"print-area col-12">
                    <table class="col-12 border border-1 border-dark thick-top-border thick-bottom-border thick-right-border thick-left-border">

                        {{-- HEADINGS --}}
                        <tr>
                            <td colspan="100%" class="text-end"><i>Appendix 58 &nbsp;</i></td>
                        </tr>
                        <tr>
                            <td colspan="100%" class="text-center text-uppercase"><strong>{{ $page->name }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="100%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="border border-0" colspan="5"><strong>Entity Name: <u>{{ Setting::info()->company_name }}</u></strong></td>
                            <td class="border border-0" colspan="2"><strong>Fund Cluster: ___________</strong></td>
                        </tr>
                        
                        {{-- HEADER 1 --}}
                        <tr>
                            <td class="border border-1 border-dark" colspan="5">Item: {{ $item->name ?? '' }}</td>
                            <td class="border border-1 border-dark" colspan="2">Stock No.: {{ $item->sku ?? 'Select a item first' }}</td>
                        </tr>
                        <tr>
                            <td class="border border-1 border-dark" colspan="5">Description: {{ $item->name ?? '' }}</td>
                            <td class="border border-1 border-dark" colspan="2">Re-order Point.: {{ $item->minimum_stock }}</td>
                        </tr>
                        <tr>
                            <td class="border border-1 thick-bottom-border border-dark" colspan="5">Unit of Measurement: {{ $item->unit->name }}</td>
                            <td class="border border-1 thick-bottom-border border-dark" colspan="2"></td>
                        </tr>
                        
                        {{-- HEADER 2 --}}
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Date</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%" rowspan="2"><strong>Reference</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%" colspan="2"><strong>Transaction</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Office</strong></td>

                            <td class="border border-1 border-dark" style="text-align: center;" width="10%"><strong>Balance</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>No. of Days to Consume</strong></td>
                        </tr>
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%">Type</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%">Qty</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%">Qty</td>
                        </tr>

                        {{-- BODY --}}
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
                                <td class="border border-1 border-dark" style="text-align: center;">{{ \Carbon\Carbon::parse($entry['date'])->format('m/d/Y') }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;">{!! $trans_id !!}</td>
                                <td class="border border-1 border-dark" style="text-align: center;">{{ $entry['type'] }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;">{{ $entry['quantity'] }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;">{{ $entry['section'] }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;">{{ $entry['running_balance'] }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;"></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-danger text-center">No transaction history</td>
                            </tr>
                        @endforelse

                    </table>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script>
        function print_area(area) {
            var printContents = document.querySelector('.' + area).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = '<div class="' + area + '">' + printContents + '</div>';

            window.print();

            document.body.innerHTML = originalContents;
            window.location.reload(); // Optionally reload the page to restore the original state
        }
    </script>
@endsection
