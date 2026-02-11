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
                            <td>Category</td>
                            <td colspan="3">Search</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="category" id="category" class="form-control" style="font-size:12px;">
                                    <option value="">- All -</option>
                                    @php $categories = \App\Models\Custom\ItemCategory::orderBy('name')->get(); @endphp
                                    @forelse($categories as $category)
                                        <option value="{{$category->id}}" @if(isset($_GET['category']) && $_GET['category']==$category->id) selected @endif>{{$category->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </td>
                            <td width="30%"><input name="search" type="search" id="search" class="form-control" placeholder="Search by SKU, Title, Subtitle, ISBN"  @if(isset($_GET['search'])) value="{{$_GET['search']}}" @endif style="font-size:12px;"></td>
                            <td>
                                <input type="submit" class="btn text-light" value="Search" style="font-size:12px; background-color: #3d80e3;">
                            </td>
                           
                        </tr>
                        <tr><td><a href="{{route('reports.fast-moving-items')}}" style="font-size:12px;">Reset Filter</a></td></tr>
                    </table>
                </form>
            </div>


            <div class="table-responsive-faker">
                <table id="report" class="table table-hover" cellspacing="0" width="100%">
                    <thead class="table-primary">
                        <tr>
                            <th>SKU</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Total Issued</th>
                            <th>Daily Average</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rs as $r)
                            <tr id="row{{$r->bid}}">
                                <td>{{ $r->sku }}</td>
                                <td><strong>{{ $r->bname }}</strong></td>
                                <td>{{ $r->cname }}</td>
                                <td>{{ $r->unit }}</td>
                                <td>{{ $r->total_issued }}</td>
                                <td>{{ $r->daily_average }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-danger p-5" colspan="100%">No item available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="row">
                    {{-- <div class="col-md-12">
                        {{ $rs->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div> --}}
                </div>

            </div>

        </div>

    </div>

@endsection

@section('pagejs')

     <script>
        var target_cols = [];
        var col = 5;
        var sort = 'desc';
    </script>
	{{-- <script>
		$(document).ready(function() {

			// Disable DataTables alerts
			$.fn.dataTable.ext.errMode = 'none';  // Suppress the error alert

			var table = new DataTable('#report-dam', {
				responsive: true,
				layout: {
					topStart: {
						buttons: [
							{
								extend: 'copy',
								action: function(e, dt, button, config) {
									logExportActivity('copy');  // Custom audit log function
									$.fn.dataTable.ext.buttons.copyHtml5.action.call(this, e, dt, button, config);
								}
							},
							{
								extend: 'excel',
								action: function(e, dt, button, config) {
									logExportActivity('excel');  // Custom audit log function
									$.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
								}
							},
							{
								extend: 'pdf',
								action: function(e, dt, button, config) {
									logExportActivity('pdf');  // Custom audit log function
									$.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
								},
								orientation: 'landscape', 
								pageSize: 'A2',
								title: '{{ $page->name }} | Foreign Service Institute',
								exportOptions: {
									columns: ':visible'
								}
							},
							{
								extend: 'csv',
								action: function(e, dt, button, config) {
									logExportActivity('csv');  // Custom audit log function
									$.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
								}
							},
							{
								extend: 'print',
								action: function(e, dt, button, config) {
									logExportActivity('print');  // Custom audit log function
									$.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
								}
							},
							{
								extend: 'colvis'
							}
						]
					}
				},

				columnDefs: [
                    columnDefs: [
                        {
                            targets: [6],
                            type: 'num'
                        }
                    ]
				]
			});

			// You can add custom error handling here, if desired
			table.on('error.dt', function(e, settings, techNote, message) {
				console.log('DataTables error: ', message);  // Log the error if needed
			});
		});


		function logExportActivity(type) {
			$.ajax({
				url: '{{ route("reports.log-export-activity") }}',
				type: 'POST',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content'),  // Add CSRF token for Laravel
					action: type,
					description: 'User exported the {{ $page->name }} report as ' + type
				},
				success: function(response) {
					console.log('Audit logged successfully.');
				},
				error: function(xhr) {
					console.log('Error logging audit.');
				}
			});
		}
    </script> --}}
@endsection