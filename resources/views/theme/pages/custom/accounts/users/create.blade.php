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
                        <li class="breadcrumb-item"><a href="{{ route('accounts.users.index') }}">{{ $page->name }}</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ol>
                </nav>
                
            </div>
        </div>
        
        <div class="row mt-5">

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">User Information</div>

                        <div class="card-body">
                            
							<form method="post" action="{{ route('accounts.users.store') }}">
                                @csrf

                                {{-- <div hidden>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" id="firstname" name="firstname" value="{{ old('firstname', '') }}" required>
                                            @error('firstname')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="middlename" class="col-sm-2 col-form-label">Middle Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control {{ $errors->has('middlename') ? 'is-invalid' : '' }}" id="middlename" name="middlename" value="{{ old('middlename', '') }}" required>
                                            @error('middlename')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" id="lastname" name="lastname" value="{{ old('lastname', '') }}" required>
                                            @error('lastname')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Section</label>
                                        <div class="col-sm-10">
                                            <select class="form-control {{ $errors->has('section_id') ? 'is-invalid' : '' }}" id="section_id" name="section_id" required>
                                                <option value="0">-- SELECT SECTION --</option>
                                                @foreach($sections as $section)
                                                    <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('section_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div> --}}
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Employee Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" 
                                            class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" 
                                            id="firstname" 
                                            name="firstname" 
                                            value="{{ old('firstname', '') }}" 
                                            placeholder="Search employee"
                                            list="employee_list"
                                            autocomplete="off"
                                            oninput="setSectionId(this)"
                                            onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" 
                                            required
                                        >

                                        <datalist id="employee_list">
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->name }}" 
                                                        data-section="{{ $employee->section_id }}">
                                                    {{ $employee->emp_id }} - {{ $employee->department }} - {{ $employee->position }}
                                                </option>
                                            @endforeach
                                        </datalist>

                                        <input type="hidden" id="section_id" name="section_id">


                                        @error('firstname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select id="role_id" name="role_id" class="select-tags form-select {{ $errors->has('role_id') ? 'is-invalid' : '' }}" aria-hidden="true" style="width:100%;" required>
                                            <option value="">-- SELECT ROLE --</option>
                                            @foreach($roles as $role)
                                                @if($role->id != 5)
                                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="fancy-title title-center title-border">
                                    <i class="bi-key display-6 text-danger"></i>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email', '') }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" id="password" name="password" required>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
									</div>
								</div>

								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Confirm Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                        @error('confirm_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-primary">Save</button>
										<a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-light">Cancel</a>
									</div>
								</div>
							</form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('pagejs')
    <script>
        function setSectionId(input) {
            let val = input.value;
            let options = document.getElementById('employee_list').options;
            let hidden = document.getElementById('section_id');
            
            hidden.value = ''; // reset
            
            for (let i = 0; i < options.length; i++) {
                if (options[i].value === val) {
                    hidden.value = options[i].dataset.section; // assign section_id
                    break;
                }
            }
        }
    </script>
@endsection