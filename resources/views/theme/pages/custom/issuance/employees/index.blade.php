@extends('theme.main')

@section('pagecss')
@endsection

@section('content')
    <div class="wrapper p-5">
        
        <div class="row">

            <div class="col-md-6">
                <strong class="text-uppercase">{{ $page->name }}</strong>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item">{{ $page->name }}</li>
                        <li class="breadcrumb-item">Manage</li>
                    </ol>
                </nav>
                
            </div>
            
        </div>

        <div class="row mt-4 mb-3">
            
            {{-- FILTERS AMD ACTIONS --}}
            @include('theme.layouts.filters')

            <div class="col-md-6 d-flex align-items-center justify-content-end">
                <form class="d-flex align-items-center" id="searchForm" style="margin-bottom: 0; margin-right: -2%;">
                    <input name="search" type="search" id="search" class="form-control" placeholder="Search by Name" value="{{ $filter->search }}" style="width: auto;">
                    <button class="btn filter" type="button" id="btnSearch"><i data-feather="search"></i></button>
                </form>

                <a data-bs-toggle="modal" data-bs-target=".create-form-modal" class="btn btn-primary">Create New Employee</a>
                {{-- <a href="{{ route('issuance.employees.create') }}" class="btn btn-primary">Create New Employee</a> --}}
            </div>
            
        </div>
        
        <div class="row">

            <div class="table-responsive-faker" style="background-color: aliceblue;">
                <table id="authors_tbl" class="table table-hover" cellspacing="0" width="100%">
                    <thead class="table-secondary">
                        <tr>
                            <th width="2%">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th width="5%"></th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Section</th>
                            <th>Position</th>
                            <th>Hired Date</th>
                            <th class="text-center" width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr id="row{{$employee->id}}" @if($employee->trashed()) class="table-danger" @endif>
                                <td>
                                    <input type="checkbox" class="@if($employee->trashed()) employee-trashed @else select-item @endif" id="cb{{ $employee->id }}" @if($employee->trashed()) disabled @endif>
                                    <label class="custom-control-label" for="cb{{ $employee->id }}"></label>
                                </td>
                                <td><img src="{{ asset($employee->avatar ?? 'images/user-icon.png') }}" alt="profile" class="rounded-circle bg-dark" width="50px" height="50px" style="object-fit: cover;"></td>
                                <td><strong>{{ $employee->emp_id }}</strong></td>
                                <td><strong>{{ $employee->name }}</strong></td>
                                <td>{{ $employee->section->name }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->hired_date }}</td>
                                <td class="flex justify-center text-center">
                                    <a href="{{ route('issuance.employees.show', $employee->id) }}" class="btn btn-light text-primary"><i class="uil-eye"></i></a>
                                    @if($employee->trashed())
                                        <a href="javascript:void(0)" class="btn btn-transparent text-primary">&nbsp;</a>
                                        {{-- <a href="javascript:void(0)" class="btn btn-light text-primary" onclick="single_restore({{ $employee->id }})"><i class="fa-solid fa-undo-alt"></i></a> --}}
                                    @else
                                        <a data-bs-toggle="modal" data-bs-target="#edit_employee{{ $employee->id }}" class="btn btn-light text-warning"><i class="uil-edit-alt"></i></a>
                                        {{-- <a href="{{ route('issuance.employees.edit', $employee->id) }}" class="btn btn-light text-warning"><i class="uil-edit-alt"></i></a> --}}
                                        <a href="javascript:void(0)" class="btn btn-light text-danger" onclick="single_delete({{ $employee->id }})"><i class="uil-trash-alt"></i></a>
                                    @endif
                                </td>
                            </tr>

                            {{-- EDIT EMPLOYEE MODAL --}}
                            <div id="edit_employee{{ $employee->id }}" class="modal fade text-start" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Employee's Information</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('issuance.employees.update', $employee->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2 col-form-label">Employee ID</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="emp_id" name="emp_id" value="{{ $employee->emp_id }}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Section</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control {{ $errors->has('section_id') ? 'is-invalid' : '' }}" id="section_id" name="section_id" required>
                                                            <option value="">-- SELECT SECTION --</option>
                                                            @foreach($sections as $section)
                                                                <option value="{{ $section->id }}" {{ $employee->section_id == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('section_id')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2 col-form-label">Position</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2 col-form-label">Hired Date</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="hired_date" name="hired_date" value="{{ $employee->hired_date }}">
                                                    </div>
                                                </div>
                                                
                                                <div id="cover_image_input{{ $employee->id }}" class="form-group row" @if(!is_null($employee->avatar)) style="display: none" @endif>
                                                    <label for="name" class="col-sm-2 col-form-label">Profile Photo</label>
                                                    <div class="col-sm-10">
                                                        <input name="avatar" class="form-control" type="file" class="file-loading" data-show-preview="false" accept=".png, .jpg">
                                                    </div>
                                                </div>
                                                
                                                <div id="cover_image_display{{ $employee->id }}" class="form-group row" @if(is_null($employee->avatar)) style="display: none" @endif>
                                                    <label for="name" class="col-sm-2 col-form-label">Profile Photo</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="bi-image"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" value="{{ basename($employee->avatar) }}" class="form-control" readonly>
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-outline-danger" onclick="remove_file('#cover_image_display{{ $employee->id }}', '#cover_image_input{{ $employee->id }}')">
                                                                    <i class="bi-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                        <a data-bs-dismiss="modal" class="btn btn-light">Cancel</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td class="text-center text-danger p-5" colspan="100%">No employee available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="row">
                    <div class="col-md-12">
                        {{ $employees->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>

        </div>

    </div>


    {{-- MODALS --}}
    @include('theme.layouts.modals')

    <div class="modal fade text-start create-form-modal" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="centerModalLabel">Create New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('issuance.employees.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Employee ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="emp_id" name="emp_id" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Section</label>
                            <div class="col-sm-10">
                                <select class="form-control {{ $errors->has('section_id') ? 'is-invalid' : '' }}" id="section_id" name="section_id" required>
                                    <option value="">-- SELECT SECTION --</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Position</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="position" name="position">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Hired Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="hired_date" name="hired_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Profile Photo</label>
                            <div class="col-sm-10">
                                <input id="avatar" name="avatar" class="input-file" type="file" class="file-loading" data-show-preview="false" accept=".png, .jpg">		
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a data-bs-dismiss="modal" class="btn btn-light">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    <form action="" id="posting_form" style="display:none;" method="post">
        @csrf
        <input type="text" id="employees" name="employees">
        <input type="text" id="status" name="status">
    </form>

@endsection

@section('pagejs')
	
    <!-- jQuery -->
    {{-- <script src="{{ asset('theme/js/jquery-3.6.0.min.js') }}"></script> --}}

    <script src="{{ asset('lib/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script>
        let listingUrl = "{{ route('issuance.employees.index') }}";
        let searchType = "{{ $searchType }}";
    </script>
    <script src="{{ asset('js/listing.js') }}"></script>

    <script>
        function single_delete(id){
            $('.single-delete').modal('show');
            $('.btn-delete').on('click', function() {
                post_form("{{ route('issuance.employees.single-delete') }}",'',id);
            });
        }

        function multiple_delete() {
            var counter = 0;
            var selected_employees = '';

            $(".select-item:checked").each(function() {
                counter++;
                var fid = $(this).attr('id');
                
                if (fid !== undefined) {
                    selected_employees += fid.substring(2) + '|';
                }
            });

            if (counter < 1) {
                $('.prompt-no-selected').modal('show');
                return false;
            } else {
                $('.multiple-delete').modal('show');
                $('.btn-delete-multiple').on('click', function() {
                    post_form("{{ route('issuance.employees.multiple-delete') }}", '', selected_employees);
                });
            }
        }
        
        function single_restore(id){
            post_form("{{ route('issuance.employees.single-restore') }}",'',id);
        }

        function multiple_restore() {
            var counter = 0;
            var selected_employees = '';

            $(".select-item:checked").each(function() {
                counter++;
                var fid = $(this).attr('id');
                
                if (fid !== undefined) {
                    selected_employees += fid.substring(2) + '|';
                }
            });

            if (counter < 1) {
                $('.prompt-no-selected').modal('show');
                return false;
            } else {
                $('.multiple-restore').modal('show');
                $('.btn-restore-multiple').on('click', function() {
                    post_form("{{ route('issuance.employees.multiple-restore') }}", '', selected_employees);
                });
            }
        }
        
        function post_form(url,status,employees){
            $('#posting_form').attr('action',url);
            $('#employees').val(employees);
            $('#status').val(status);
            $('#posting_form').submit();
        }
    </script>
    
    <script>
        document.querySelectorAll('.dropdown-menu').forEach(function (dropdown) {
            dropdown.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });
		
		function remove_file(remove_div, show_div){
			$(remove_div).hide();
			$(show_div).show();
		}
    </script>

    {{-- <script>
        jQuery(document).ready(function() {
            jQuery('#authors_tbl').dataTable();
        });
    </script> --}}
@endsection