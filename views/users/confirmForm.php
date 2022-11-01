<div class="modal fade" id="user-confirm" tabindex="-1" aria-labelledby="user-form-modal" aria-hidden="true" data-backdrop="false" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ">ConfirmWindow</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="confirmForm">
                <form method="post">
                    <div class="modal-body">
                        <label for="userNameDelete">You want to delete this user?</label>
                        <input type="text" class="form-control" id="userNameDelete" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeConfirm">Close</button>
                <button type="submit" class="btn btn-danger" id="confirmDel">DeleteUser</button>
            </div>
        </div>
    </div>
</div>
