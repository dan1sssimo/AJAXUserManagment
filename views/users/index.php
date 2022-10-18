<div class="container">
    <div class="row flex-lg-nowrap">
        <div class="col">
            <div class="row flex-lg-nowrap">
                <div class="col mb-3">
                    <div class="e-panel card">
                        <div class="card-body">
                            <div class="e-table">
                                <div class="d-flex justify-content-evenly">
                                    <button type="button" class="btn btn-primary">Add</button>
                                    <select class="form-select w-25" aria-label="Default select example">
                                        <option selected>Please Select</option>
                                        <option value="1">Set active</option>
                                        <option value="2">Set not active</option>
                                        <option value="3">Delete</option>
                                    </select>
                                    <button type="button" class="btn btn-success">OK</button>
                                </div>
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="align-top">
                                                <div
                                                        class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                                                    <input type="checkbox" class="custom-control-input" id="all-items">
                                                    <label class="custom-control-label" for="all-items"></label>
                                                </div>
                                            </th>
                                            <th class="max-width">Name</th>
                                            <th class="sortable">Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($users as $user) : ?>
                                            <?php if (isset($user)): ?>
                                                <tr>
                                                    <td class="align-middle">
                                                        <div
                                                                class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   id="item-1">
                                                            <label class="custom-control-label" for="item-1"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap align-middle"><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                                                    <td class="text-nowrap align-middle">
                                                        <span><?= $user['role'] ?></span></td>
                                                    <td class="text-center align-middle"><i
                                                                class="fa fa-circle active-circle"></i><?= $user['status'] ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group align-top">
                                                            <button class="btn btn-sm btn-outline-secondary badge"
                                                                    type="button"
                                                                    data-toggle="modal"
                                                                    data-target="#user-form-modal">Edit
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-secondary badge"
                                                                    type="button"><i
                                                                        class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-evenly">
                                    <button type="button" class="btn btn-primary">Add</button>
                                    <select class="form-select w-25" aria-label="Default select example">
                                        <option selected>Please Select</option>
                                        <option value="1">Set active</option>
                                        <option value="2">Set not active</option>
                                        <option value="3">Delete</option>
                                    </select>
                                    <button type="button" class="btn btn-success">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Form Modal -->
                <div class="modal fade" id="user-form-modal" tabindex="-1" aria-labelledby="user-form-modal"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="UserModalLabel">AddUser/EditUser</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="first-name" class="col-form-label">First Name:</label>
                                        <input type="text" class="form-control" id="first-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name" class="col-form-label">Last Name:</label>
                                        <input type="text" class="form-control" id="last-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="Status" class="col-form-label">Status</label>
                                        <input type="text" class="form-control" id="Status">
                                    </div>
                                    <div class="form-group">
                                        <label for="Status" class="col-form-label">Role</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select role</option>
                                            <option value="1">User</option>
                                            <option value="2">Admin</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
    
</script>