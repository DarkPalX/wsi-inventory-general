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
                
                
                <form id="select_item_form" class="d-flex justify-content-between align-items-end" action="{{ route('reports-fsi.property-card') }}" method="get">
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
                            <td colspan="100%" class="text-end"><i>Appendix 69 &nbsp;</i></td>
                        </tr>
                        <tr>
                            <td colspan="100%" class="text-center text-uppercase"><strong>{{ $page->name }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="100%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="border border-0 thick-bottom-border" colspan="5"><strong>Entity Name: <u>{{ Setting::info()->company_name }}</u></strong></td>
                            <td class="border border-0 thick-bottom-border text-end" colspan="3"><strong class="text-end">Fund Cluster: ___________</strong></td>
                        </tr>
                        
                        {{-- HEADER 1 --}}
                        <tr>
                            <td class="border border-1 border-dark thick-bottom-border" colspan="5"><strong>Property, Plant and Equipment:</strong></td>
                            <td class="thick-left-border" colspan="3"><strong>Property Number: {{ $item->sku }}</strong></td>
                        </tr>
                        <tr>
                            <td class="border border-1 border-dark thick-bottom-border" colspan="5"><strong>Description: {{ $item->name }}</strong></td>
                            <td class="thick-bottom-border thick-left-border" colspan="3">&nbsp;</td>
                        </tr>
                        
                        {{-- HEADER 2 --}}
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Date</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Reference/PAR No.</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%"><strong>Receipt</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="30%" colspan="2"><strong>Issue/Transfer/Disposal</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%"><strong>Balance</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Amount</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%" rowspan="2"><strong>Remarks</strong></td>
                        </tr>
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%">Qty.</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%">Qty.</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%">Office/Officer</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%">Qty.</td>
                        </tr>

                        {{-- BODY --}}
                        @forelse($par_details as $par_detail)
                            <tr>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $par_detail->date_received }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $par_detail->par_header->issuance->ref_no }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $par_detail->quantity }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $par_detail->par_header->employee->section->name }} - {{ $par_detail->par_header->employee->name }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $par_detail->price }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $par_detail->remarks }}</td>
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
