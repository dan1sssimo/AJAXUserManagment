<div class="container" id="tUser">
    <div class="row flex-lg-nowrap">
        <div class="col">
            <div class="row flex-lg-nowrap">
                <div class="col mb-3">
                    <div class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4 class="mr-2"><span>Users</span></h4>
                            </div>
                            <div class="e-table">
                                <div class="d-flex justify-content-evenly">
                                    <button type="button" class="btn btn-primary"
                                            data-toggle="modal"
                                            data-target="#user-form-modal" id="addUser">Add
                                    </button>
                                    <select class="form-select w-25 task" aria-label="Default select example"
                                            name="task">
                                        <option selected value="0">Please Select</option>
                                        <option value="1">Set active</option>
                                        <option value="2">Set not active</option>
                                        <option value="3">Delete</option>
                                    </select>
                                    <button type="button" class="btn btn-success groupTask">OK</button>
                                </div>
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="align-top">
                                                <div
                                                        class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                                                    <input type="checkbox" class="custom-control-input" id="allItems"
                                                           name="allItems" data-id="users">
                                                    <label class="custom-control-label" for="allItems"></label>
                                                </div>
                                            </th>
                                            <th class="max-width">Name</th>
                                            <th class="sortable">Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($users)) : ?>
                                            <?php foreach ($users as $user) : ?>
                                                <tr>
                                                    <td class="align-middle">
                                                        <div
                                                                class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                            <input type="checkbox" class="custom-control-input items"
                                                                   id="<?= $user['id'] ?>" data-id="users">
                                                            <label class="custom-control-label"
                                                                   for="<?= $user['id'] ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap align-middle userName"><?= $user['firstname'] . ' ' . $user['lastname'] ?></td>
                                                    <td class="text-nowrap align-middle userRole">
                                                        <span><?= $user['role'] ?></span></td>
                                                    <td class="text-center align-middle">
                                                        <?php if ($user['status'] == 1) : ?>
                                                            <i
                                                                    class="fa fa-circle active-circle userStatus"></i>
                                                        <?php else: ?>
                                                            <i
                                                                    class="fa fa-circle not-active-circle userStatus"></i>
                                                        <?php endif ?>
                                                    </td>

                                                    <td class="text-center align-middle">
                                                        <div class="btn-group align-top">
                                                            <button class="btn btn-sm btn-outline-secondary badge edit"
                                                                    type="button"
                                                                    data-toggle="modal"
                                                                    data-target="#user-form-modal"
                                                                    value="<?= $user['id'] ?>">Edit
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-secondary badge fa fa-trash delete"
                                                                    type="button" value="<?= $user['id'] ?>"
                                                                    data-toggle="modal"
                                                                    data-target="#user-confirm">
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-evenly">
                                    <button type="button" class="btn btn-primary"
                                            data-toggle="modal"
                                            data-target="#user-form-modal" id="addUser">Add
                                    </button>
                                    <select class="form-select w-25 task" aria-label="Default select example"
                                            name="task">
                                        <option selected value="0">Please Select</option>
                                        <option value="1">Set active</option>
                                        <option value="2">Set not active</option>
                                        <option value="3">Delete</option>
                                    </select>
                                    <button type="button" class="btn btn-success groupTask">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- UserFormModal -->
                <?php include_once 'views/users/userFormModal.php' ?>
                <!-- EndUserFormModal -->
                <!-- ConfirmWindow -->
                <?php include_once 'views/users/confirmForm.php' ?>
                <!-- EndConfirmWindow -->
            </div>
        </div>
    </div>
</div>