<div class="modal fade" id="user-form-modal" tabindex="-1" aria-labelledby="user-form-modal" aria-hidden="true" data-backdrop="false" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UserModalLabel">Add user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="modalForm">
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control" id="firstname"
                               name="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lastname"
                               name="lastname">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Status:</label>
                    </div>
                    <div class="form-group">
                        <label class="switch col-form-label">
                            <input type="checkbox" class="form-control" id="status"
                                   name="status" value="status">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-form-label">Role</label>
                        <select class="form-select" aria-label="Default select example"
                                id="role"
                                name="role">
                            <option selected>Select role</option>
                            <option>User</option>
                            <option>Admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeForm">Close
                </button>
                <button type="submit" class="btn btn-primary" id="submit">Save</button>
            </div>
        </div>
    </div>
</div>
