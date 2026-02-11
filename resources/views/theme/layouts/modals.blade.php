{{-- SINGLE DELETE --}}
<div class="modal fade text-start single-delete" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="centerModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-delete">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{-- MULTIPLE DELETE --}}
<div class="modal fade text-start multiple-delete" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="centerModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete these items?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-delete-multiple">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{-- MULTIPLE RESTORE --}}
<div class="modal fade text-start multiple-restore" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="centerModalLabel">Restore Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to restore these items?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-restore-multiple">Restore</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{-- SINGLE POST --}}
<div class="modal fade text-start single-post" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="centerModalLabel">Post Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to post this transaction?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-post">Post</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{-- SINGLE CANCELLATION --}}
<div class="modal fade text-start single-cancel" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="centerModalLabel">Confirm Cancellation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this transaction?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-delete">Confirm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{-- MULTIPLE CANCELLATION --}}
<div class="modal fade text-start multiple-cancel" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="centerModalLabel">Confirm Cancellation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel these transactions?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-delete-multiple">Confirm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{-- NO SELECTED PROMPT --}}
<div class="modal fade text-start prompt-no-selected" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="centerModalLabel">Invalid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You have no selected items.
            </div>
        </div>
    </div>
</div>



{{-- FOR PAR ACTIONS --}}

{{-- SINGLE CLOSE --}}
{{-- <div class="modal fade text-start single-close" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="centerModalLabel">Close PAR Item Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to close this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-close-par">Close</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- SINGLE CLOSE --}}
<div class="modal fade text-start single-close" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form action="{{ route('par.items.single-close') }}" method="post">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="centerModalLabel">Surrender PAR Item Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to surrender this item?
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-12 mt-2 col-form-label">Remarks</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="remarks"></textarea>
                        </div>
                    </div>
                    
                    <input type="hidden" id="par_detail_id_close" name="transactions">
                    <input type="hidden" id="status" name="status">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-close-par">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>  

    </div>
</div>

{{-- SINGLE TRANSFER --}}
<div class="modal fade text-start single-transfer" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form action="{{ route('par.items.single-transfer') }}" method="post">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="centerModalLabel">Transfer PAR Item Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to transfer this item?

                    <div class="form-group row">
                        <label for="name" class="col-sm-12 mt-4 col-form-label">Transfer Type</label>
                        <div class="col-sm-12">
                            <label><input type="radio" name="transfer_type" value="Reassignment" checked> Reassignment</label><br>
                            <label><input type="radio" name="transfer_type" value="Donation"> Donation</label><br>
                            <label><input type="radio" name="transfer_type" value="Relocate"> Relocate</label><br>
                            <label><input type="radio" name="transfer_type" value="Others"> Others <input type="text" name="transfer_specification" class="border-0 border-bottom" placeholder="(Specify)"></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Transfer to</label>
                        <div class="col-sm-12">
                            <input type="text" id="search_receiver" name="employee_id" class="form-control search_receiver" autocomplete="off" placeholder="Type to search employee" list="search_receiver_list" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" onclick="select()" required>
                            <datalist id="search_receiver_list"></datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Remarks</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="remarks"></textarea>
                        </div>
                    </div>
                    
                    <input type="hidden" id="par_detail_id_transfer" name="transactions">
                    <input type="hidden" id="status" name="status">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-transfer-par">Transfer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>  

    </div>
</div>

{{-- SINGLE BORROW --}}
<div class="modal fade text-start single-borrow" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form action="{{ route('par.items.single-borrow') }}" method="post">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="centerModalLabel">Borrow PAR Item Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Borrower</label>
                        <div class="col-sm-12">
                            <input type="text" id="search_receivers" name="employee_id" class="form-control search_receiver" autocomplete="off" placeholder="Type to search employee" list="search_receiver_list" onkeypress="if(event.key === 'Enter') { event.preventDefault(); }" onclick="select()" required>
                            <datalist id="search_receiver_list"></datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Reason / Purpose</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="remarks"></textarea>
                        </div>
                    </div>
                    
                    <input type="hidden" id="par_detail_id_borrow" name="transactions">
                    <input type="hidden" id="status" name="status">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-borrow-par">Borrow</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>  

    </div>
</div>

{{-- SINGLE RETURN --}}
<div class="modal fade text-start single-return" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form action="{{ route('par.items.single-return') }}" method="post">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="centerModalLabel">Return PAR Item Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Reason / Purpose</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="remarks"></textarea>
                        </div>
                    </div>
                    
                    <input type="hidden" id="par_detail_id_return" name="transactions">
                    <input type="hidden" id="status" name="status">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-return-par">Return</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>  

    </div>
</div>