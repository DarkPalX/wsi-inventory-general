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
            <div class="col-md-12">
                
                
                {{-- <form id="select_item_form" class="d-flex justify-content-between align-items-end" action="{{ route('reports-fsi.stock-card') }}" method="get">
                    <div class="col-6">
                        <strong>Select an item</strong>
                        <select name="id" class="selectpicker border w-100 form-control" data-live-search="true" onchange="document.getElementById('select_item_form').submit()">
                            <option disabled selected>-- SELECT ITEM --</option>
                            @foreach($items as $selection)
                                <option value="{{ $selection->id }}" @if($item->id == $selection->id) selected @endif>{{ $selection->sku }}: {{ $selection->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form> --}}

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
                            <td colspan="100%" class="text-end"><i>Appendix 74 &nbsp;</i></td>
                        </tr>
                        <tr>
                            <td colspan="100%" class="text-center text-uppercase"><strong>{{ $page->name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="border border-0 text-center" colspan="18"><strong>As at _________________________________</strong></td>
                        </tr>
                        <tr>
                            <td colspan="100%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="border border-0" colspan="12"><strong>Entity Name: <u>{{ Setting::info()->company_name }}</u></strong></td>
                            <td class="border border-0 text-end" colspan="6"><strong>Fund Cluster: ___________</strong></td>
                        </tr>
                        <tr>
                            <td class="border border-0 text-center" colspan="3"><strong>__________________________________________</strong></td>
                            <td class="border border-0 text-center" colspan="3"><strong>__________________________________________</strong></td>
                            <td class="border border-0 text-center" colspan="3"><strong>__________________________________________</strong></td>
                            <td class="border border-0" colspan="9">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="border border-0 text-center" colspan="3">(Name of Accountable Office)</td>
                            <td class="border border-0 text-center" colspan="3">(Designation)</td>
                            <td class="border border-0 text-center" colspan="3">(Station)</td>
                            <td class="border border-0" colspan="9">&nbsp;</td>
                        </tr>
                        
                        {{-- HEADER --}}
                        <tr>
                            <td class="thick-top-border thick-bottom-border thick-left-border" style="text-align: center;" colspan="10" width="60%"><strong>INVENTORY</strong></td>
                            <td class="thick-top-border thick-bottom-border thick-left-border thick-right-border" style="text-align: center;" colspan="8" width="40%"><strong>INSPECTION and DISPOSAL</strong></td>
                        </tr>
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%" rowspan="2"><strong>Date Acquired</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%" rowspan="2"><strong>Particulars/ Articles</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%" rowspan="2"><strong>Property No.</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%" rowspan="2"><strong>Qty</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%" rowspan="2"><strong>Unit Cost</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%" rowspan="2"><strong>Total Cost</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%" rowspan="2"><strong>Accumulated Depreciation</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%" rowspan="2"><strong>Accumulated Impairment Losses</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%" rowspan="2"><strong>Carrying Amount</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Remarks</strong></td>

                            <td class="border border-1 border-dark thick-left-border" style="text-align: center;" width="25%" colspan="5"><strong>DISPOSAL</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%" rowspan="2"><strong>Appraised Value</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" colspan="2"><strong>RECORD OF SALES</strong></td>
                        </tr>
                        <tr>
                            <td class="border border-1 border-dark thick-left-border" style="text-align: center;" width="5%">Sale</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%">Transfer</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%">Destruction</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%">Others (Specify)</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%">Total</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%">OR No.</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="5%">Amount</td>
                        </tr>

                        {{-- BODY --}}
                        @forelse($items as $item)
                            <tr>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $item->sku }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $item->Inventory }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ number_format($item->MAC, 2, ',', '.') }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ number_format($item->MAC * $item->MAC, 2, ',', '.') }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>

                                <td class="border border-1 border-dark thick-left-border" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-danger text-center">No transaction history</td>
                            </tr>
                        @endforelse

                        {{-- FOOTER --}}
                        <tr>
                            <td class="thick-top-border text-center" colspan="10">&nbsp;</td>
                            <td class="thick-top-border thick-left-border text-center" colspan="8">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="10">I HEREBY request inspection and disposition, pursuant to Section  79 of PD 1445, of the property enumerated above.</td>
                            <td class="thick-left-border p-2" colspan="4">I CERTIFY that I have inspected each and every article enumerated in this report, and that the disposition made thereof was, in my judgment, the best for the public interest.</td>
                            <td class="text-center">&nbsp;</td>
                            <td class="p-2" colspan="3">I CERTIFY that I have witnessed the disposition of the articles enumerated on this report this ____day of ___________, _____.</td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="10">&nbsp;</td>
                            <td class="thick-left-border text-center" colspan="8">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="p-4" colspan="5">Requested by:</td>
                            <td class="p-4" colspan="5">Approved by:</td>
                            <td class="thick-left-border text-center" colspan="8">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">_______________________________________________________</td>
                            <td class="text-center" colspan="5">_______________________________________________________</td>
                            <td class="thick-left-border text-center" colspan="4">_______________________________________________________</td>
                            <td class="text-center">&nbsp;</td>
                            <td class="text-center p-2" colspan="3">_______________________________________________________</td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">(Signature over Printed Name of Accountable Officer)</td>
                            <td class="text-center" colspan="5">(Signature over Printed Name of Authorized Official)</td>
                            <td class="thick-left-border text-center" colspan="4">(Signature over Printed Name of Inspection Officer)</td>
                            <td class="text-center">&nbsp;</td>
                            <td class="text-center" colspan="3">(Signature over Printed Name of Witness)</td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="10">&nbsp;</td>
                            <td class="thick-left-border text-center" colspan="8">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">_______________________________________________________</td>
                            <td class="text-center" colspan="5">_______________________________________________________</td>
                            <td class="thick-left-border text-center" colspan="8">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">(Designation of Accountable Officer)</td>
                            <td class="text-center" colspan="5">(Designation of Authorized Official)</td>
                            <td class="thick-left-border text-center" colspan="8">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="10">&nbsp;</td>
                            <td class="thick-left-border text-center" colspan="8">&nbsp;</td>
                        </tr>

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
