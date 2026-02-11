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
                    <div class="col-8 offset-2">
                        <div class="row">
                            <a href="javascript:void(0)" class="text-decoration-none text-end" onclick="print_area('print-area')">
                                <small>Print Report &nbsp;</small>
                            </a>
                        </div>
                    </div>
                </div>
                    
                <div class=	"print-area col-8 offset-2">
                    <table class="col-12 border border-1 border-dark thick-top-border thick-bottom-border thick-right-border thick-left-border">

                        {{-- HEADINGS --}}
                        <tr>
                            <td colspan="100%" class="text-end"><i>Appendix 71 &nbsp;</i></td>
                        </tr>
                        <tr>
                            <td colspan="100%" class="text-center text-uppercase"><strong>{{ $page->name }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="100%">&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td class="" colspan="4"><strong>Entity Name: <u>{{ Setting::info()->company_name }}</u></strong></td>
                            <td class="" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="thick-bottom-border" colspan="4"><strong>Fund Cluster: ___________</strong></td>
                            <td class="thick-bottom-border text-end" colspan="2"><strong>PAR No.: <u>{{ $transfer_detail->par_header->issuance->ref_no }}</u></strong></td>
                        </tr>
                        
                        {{-- HEADER --}}
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%"><strong>Quantity</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%"><strong>Unit</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%"><strong>Description</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%"><strong>Property Number</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%"><strong>Date Acquired</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="10%"><strong>Amount</strong></td>
                        </tr>

                        {{-- BODY --}}
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" >{{ $transfer_detail->quantity }}</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >{{ $transfer_detail->item->unit->name }}</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >{{ $transfer_detail->item->name }}</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >{{ $transfer_detail->barcode }}</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >{{ $transfer_detail->date_received }}</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >{{ $transfer_detail->item->MAC }}</td>
                        </tr>
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                        </tr>

                        {{-- FOOTER --}}
                        <tr>
                            <td class="thick-top-border thick-right-border" colspan="3">Received by:</td>
                            <td class="thick-top-border" colspan="3">Issued by:</td>
                        </tr>
                        <tr>
                            <td class="thick-left-border thick-right-border text-center" colspan="3">______________________________________________________________________</td>
                            <td class="thick-right-border text-center" colspan="3">______________________________________________________________________</td>
                        </tr>
                        <tr>
                            <td class="thick-left-border thick-right-border text-center" colspan="3">Signature Over Printed Name of End User</td>
                            <td class="thick-right-border text-center" colspan="3">Signature Over Printed Name of Supply and/or Property Custodian</td>
                        </tr>
                        <tr>
                            <td class="thick-left-border thick-right-border text-center" colspan="3">______________________________________________________________________</td>
                            <td class="thick-right-border text-center" colspan="3">______________________________________________________________________</td>
                        </tr>
                        <tr>
                            <td class="thick-left-border thick-right-border text-center" colspan="3">Position/Office</td>
                            <td class="thick-right-border text-center" colspan="3">Position/Office</td>
                        </tr>
                        <tr>
                            <td class="thick-left-border thick-right-border text-center" colspan="3">______________________________________________________________________</td>
                            <td class="thick-right-border text-center" colspan="3">______________________________________________________________________</td>
                        </tr>
                        <tr>
                            <td class="thick-left-border thick-right-border text-center" colspan="3">Date</td>
                            <td class="thick-right-border text-center" colspan="3">Date</td>
                        </tr>
                        <tr>
                            <td class="thick-left-border thick-right-border text-center" colspan="3">&nbsp;</td>
                            <td class="thick-right-border text-center" colspan="3">&nbsp;</td>
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
