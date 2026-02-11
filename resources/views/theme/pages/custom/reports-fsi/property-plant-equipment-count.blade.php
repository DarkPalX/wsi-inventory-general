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
            <div class="col-md-10">
                
                
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
                            <td colspan="100%" class="text-end"><i>Appendix 73 &nbsp;</i></td>
                        </tr>
                        <tr>
                            <td colspan="100%" class="text-center text-uppercase"><strong>{{ $page->name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="border border-0 text-center" colspan="10">_________________________________</td>
                        </tr>
                        <tr>
                            <td class="border border-0 text-center" colspan="10"><small style="font-size:12px;">(Type of Property, Plant and Equipment)</small></td>
                        </tr>
                        <tr>
                            <td class="border border-0 text-center" colspan="10"><strong>As at _________________________________</strong></td>
                        </tr>
                        <tr>
                            <td colspan="100%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="border border-0" colspan="10"><strong>Fund Cluster: ___________</strong></td>
                        </tr>
                        <tr>
                            <td class="border border-0" colspan="10"><strong>For which <u>(Name of Accountable Officer)</u>, <u>(Official Designation)</u>, <u>{{ Setting::info()->company_name }}</u> is accountable, having assumed such accoutability on <u>(Date of Assumption)</u>.</strong></td>
                        </tr>
                        
                        {{-- HEADER --}}
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Article</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Description</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Property Number</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Unit of Measure</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Unit Value</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Quantity per Property Card</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%" rowspan="2"><strong>Quantity per Physical Count</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%" colspan="2"><strong>Shortage/Overage</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%" rowspan="2"><strong>Remarks</strong></td>
                        </tr>
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%">Quantity</td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%">Value</td>
                        </tr>

                        {{-- BODY --}}
                        @forelse($items as $item)
                            <tr>
                                <td class="border border-1 border-dark" style="text-align: center;" ></td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $item->name }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $item->sku }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $item->unit->name }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $item->MAC }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $item->MAC }}</td>
                                <td class="border border-1 border-dark" style="text-align: center;" >{{ $item->MAC }}</td>
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
                            <td class="thick-top-border" colspan="3">Certified Correct by:</td>
                            <td class="thick-top-border" colspan="4">Approved by:</td>
                            <td class="thick-top-border" colspan="3">Verified by:</td>
                        </tr>

                        <tr>
                            <td class="text-center" colspan="10">&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="text-center" colspan="3">_______________________________________________________</td>
                            <td class="text-center" colspan="4">_______________________________________________________</td>
                            <td class="text-center" colspan="3">_______________________________________________________</td>
                        </tr>

                        <tr>
                            <td class="text-center" colspan="3">Signature over Printed Name of Inventory Committee Chair and Members</td>
                            <td class="text-center" colspan="4">Signature over Printed Name of Head of  Agency/Entity or Authorized Representative</td>
                            <td class="text-center" colspan="3">Signature over Printed Name of COA Representative</td>
                        </tr>

                        <tr>
                            <td class="text-center" colspan="10">&nbsp;</td>
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
