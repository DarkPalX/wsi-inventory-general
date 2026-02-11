@extends('theme.layouts.report')

@section('pagecss')
@endsection

@section('content')
    <div class="wrapper p-5">
        
        <div class="row">

            <div class="col-md-12 text-center">
                <h4 class="text-uppercase">{{ $page->name }}<br><small>{{ Setting::info()->company_name }}</small></h4>
            </div>
            
        </div>
        
        <div class="row mt-5">
            <div>
                <form class="d-flex align-items-center" id="searchForm" style="margin-bottom:10px;font-size: 12px !important;">
                    <input type="hidden" name="is_search" id="is_search" value="1">
                    <table width="100%" style="margin-bottom: 0px;">
                        <tr style="font-size:12px;font-weight:bold;">
                            <td>Start Date</td>
                            <td>End Date</td>
                            {{-- <td>Receiver</td> --}}
                            <td>Status</td>
                            <td colspan="3">Search</td>
                        </tr>
                        <tr>
                            <td><input type="date" class="form-control" name="start_date" id="start_date" style="font-size:12px;"  @if(isset($_GET['start_date'])) value="{{$_GET['start_date']}}" @endif></td>
                            <td><input type="date" class="form-control" name="end_date" id="end_date" style="font-size:12px;"  @if(isset($_GET['start_date'])) value="{{$_GET['end_date']}}" @endif></td>
                            {{-- <td>
                                <select name="receiver" id="receiver" class="form-control" style="font-size:12px;">
                                    <option value="">- All -</option>
                                    @php $receivers = \App\Models\Custom\Receiver::orderBy('name')->get(); @endphp
                                    @forelse($receivers as $receiver)
                                        <option value="{{$receiver->id}}" @if(isset($_GET['receiver']) && $_GET['receiver']==$receiver->id) selected @endif>{{$receiver->name}}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </td> --}}
                            <td>
                                <select name="status" id="status" class="form-control" style="font-size:12px;">
                                    <option value="" selected>- All -</option>
                                    <option value="SAVED" @if(isset($_GET['status']) && $_GET['status']=='SAVED') selected @endif>SAVED</option>
                                    <option value="POSTED" @if(isset($_GET['status']) && $_GET['status']=='POSTED') selected @endif>POSTED</option>
                                    <option value="CANCELLED" @if(isset($_GET['status']) && $_GET['status']=='CANCELLED') selected @endif>CANCELLED</option>
                                </select>
                            </td>
                            <td width="30%"><input name="search" type="search" id="search" class="form-control" placeholder="Search by Ref#, SKU, Title, Remarks"  @if(isset($_GET['search'])) value="{{$_GET['search']}}" @endif style="font-size:12px;"></td>
                            <td>
                                <input type="submit" class="btn text-light" value="Search" style="font-size:12px; background-color: #3d80e3;">
                            </td>
                           
                        </tr>
                        <tr><td><a href="{{route('reports.issuance')}}" style="font-size:12px;">Reset Filter</a></td></tr>
                    </table>
                </form>
            </div>
            <div class="table-responsive-faker">
                <table id="report" class="table table-hover" cellspacing="0" width="100%">
                    <thead class="table-primary">
                        <tr>
                            <th>RIS #</th>
                            <th>Responsibility Center Code</th>
                            <th>Date Requested</th>
                            <th>Status</th>     
                            <th>Posted By</th>
                            <th>Posted Date</th> 
                            <th>Created By</th>
                            <th>Created Date</th>    
                                                     
                            <th>Item SKU</th>
                            <th>Item Name</th>
                            <th>Qty Ordered</th>                           
                            <th>Qty Received</th>                           
                            <th>Qty Balance</th>                           
                            <th>Remarks</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rs as $r)
                            @php
                                $issued = App\Models\Custom\IssuanceDetail::getIssuedQty($r->ref_no, $r->item_id);
                                $balance = $r->quantity - $issued;
                            @endphp
                            <tr id="row{{$r->id}}">
                                <td>{{ $r->ref_no }}</td>
                                <td>{{ $r->responsibility_center_code }}</td>
                                <td>{{ Carbon\Carbon::parse($r->requested_at)->format('Y-m-d') }}</td>
                                <td>@if(App\Models\Custom\IssuanceHeader::hasIssuance($r->ref_no) && App\Models\Custom\IssuanceHeader::getIssuanceStatus($r->ref_no) > 0)
                                        <strong><small style="display: inline-block; width: 100px; text-align: center;font-size:12px;" class="rounded text-white bg-warning p-1">PARTIAL</small></strong><br>
                                    @elseif(App\Models\Custom\IssuanceHeader::hasIssuance($r->ref_no) && App\Models\Custom\IssuanceHeader::getIssuanceStatus($r->ref_no) == 0)
                                        <strong><small style="display: inline-block; width: 100px; text-align: center;font-size:12px;" class="rounded text-white bg-success p-1">COMPLETED</small></strong><br>
                                    @else
                                        @if($r->status == 'POSTED')
                                            <strong><small style="display: inline-block; width: 100px; text-align: center;font-size:12px;" class="rounded text-white bg-secondary p-1">PENDING</small></strong><br>
                                        @endif
                                    @endif</td>

                                <td>{{ User::getName($r->posted_by) }}</td>
                                <td>{{ $r->posted_at }}</td>
                                <td>{{ User::getName($r->hcr) }}</td>
                                <td>{{ $r->created_at }}</td>
                                <td>{{ $r->itemsku }}</td>
                                <td>{{ $r->itemname }}</td>
                                <td>{{ $r->quantity }}</td>
                                <td>{{ $issued }}</td>
                                <td>{{ $balance }}</td>                               
                                <td>{{ $r->remarks }}</td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-danger p-5" colspan="100%">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
               

            </div>

        </div>

    </div>

@endsection

@section('pagejs')
     <script>
        var target_cols = [];
        var col = 0;
        var sort = 'asc';
    </script>
@endsection