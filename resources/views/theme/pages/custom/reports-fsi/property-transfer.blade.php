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
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 5px;
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
                            <td colspan="100%" class="text-end"><i>Appendix 76 &nbsp;</i></td>
                        </tr>
                        <tr>
                            <td colspan="100%" class="text-center text-uppercase"><strong>{{ $page->name }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="100%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="border border-0 thick-bottom-border" colspan="3"><strong>Entity Name: <u>{{ Setting::info()->company_name }}</u></strong></td>
                            <td class="border border-0 thick-bottom-border text-end" colspan="2"><strong class="text-end">Fund Cluster: ___________</strong></td>
                        </tr>
                        
                        {{-- HEADER 1 --}}
                        <tr>
                            {{-- <td class="border border-1 border-dark thick-bottom-border" colspan="5"><strong>Property, Plant and Equipment:</strong></td> --}}
                            <td class="thick-left-border" colspan="3"><strong>From Accountable Officer/Agency/Fund Cluster: {{ $transfer_detail->par_header->employee->name }}</strong></td>
                            <td class="thick-left-border " colspan="2"><strong>PTR No.: {{ $transfer_detail->id }}</strong></td>
                        </tr>
                        <tr>
                            {{-- <td class="border border-1 border-dark thick-bottom-border" colspan="5"><strong>Property, Plant and Equipment:</strong></td> --}}
                            <td class="thick-left-border thick-bottom-border" colspan="3"><strong>To Accountable Officer/Agency/Fund Cluster: {{ $transfer_detail->transferred_to_employee->name }}</strong></td>
                            <td class="thick-left-border thick-bottom-border" colspan="2"><strong>Date: {{ $transfer_detail->date_transferred }}</strong></td>
                        </tr>
                        
                        {{-- HEADER 2 --}}
                        <tr>
                            <td class="" colspan="5">Transfer Type: (check only one)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="1">
                                <label class="checkbox-label"><input type="checkbox" value="Donation" @if($transfer_detail->transfer_type == 'Donation') checked onclick="return false;" @endif><span>Donation</span></label>
                            </td>
                            <td colspan="2">
                                <label class="checkbox-label"><input type="checkbox" value="Relocate" @if($transfer_detail->transfer_type == 'Relocate') checked onclick="return false;" @endif><span>Relocate</span></label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr class="thick-bottom-border">
                            <td>&nbsp;</td>
                            <td colspan="1">
                                <label class="checkbox-label"><input type="checkbox" value="Reassignment" @if($transfer_detail->transfer_type == 'Reassignment') checked onclick="return false;" @endif><span>Reassignment</span></label>
                            </td>
                            <td colspan="2">
                                <label class="checkbox-label"><input type="checkbox" value="Others" @if($transfer_detail->transfer_type == 'Others') checked onclick="return false;" @endif><span>Others ({{ $transfer_detail->transfer_specification ?? 'Specify' }})</span></label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        {{-- HEADER 3 --}}
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%"><strong>Date Acquired</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%"><strong>Property No.</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%"><strong>Description</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%"><strong>Amount</strong></td>
                            <td class="border border-1 border-dark" style="text-align: center;" width="20%"><strong>Condiotion of PPE</strong></td>
                        </tr>

                        {{-- BODY --}}
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" >{{ $transfer_detail->date_received }}</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >{{ $transfer_detail->barcode }}</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >{{ $transfer_detail->item->name }}</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >{{ $transfer_detail->item->MAC }}</td>
                            <td class="border border-1 border-dark" style="text-align: center;" ></td>
                        </tr>
                        <tr>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                            <td class="border border-1 border-dark" style="text-align: center;" >&nbsp;</td>
                        </tr>

                        {{-- FOOTER --}}
                        <tr class="thick-top-border">
                            <td colspan="5"><strong>Reason for Transfer:</strong></td>
                        </tr>
                        <tr class="thick-bottom-border">
                            <td colspan="5" class="p-2">
                                
                                <span><u>{{ $transfer_detail->remarks }}</u></span>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><strong>Approved by:</strong></td>
                            <td><strong>Released/Issued by:</strong></td>
                            <td><strong>Received by:</strong></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Signature:</strong></td>
                            <td class="p-1">______________________________________________</td>
                            <td class="p-1">______________________________________________</td>
                            <td class="p-1">______________________________________________</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Printed Name:</strong></td>
                            <td class="p-1">______________________________________________</td>
                            <td class="p-1">______________________________________________</td>
                            <td class="p-1">______________________________________________</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Designation:</strong></td>
                            <td class="p-1">______________________________________________</td>
                            <td class="p-1">______________________________________________</td>
                            <td class="p-1">______________________________________________</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Date:</strong></td>
                            <td class="p-1">______________________________________________</td>
                            <td class="p-1">______________________________________________</td>
                            <td class="p-1">______________________________________________</td>
                            <td>&nbsp;</td>
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
