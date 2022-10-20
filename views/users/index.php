<div class="container" id="tUser">
    <div class="row flex-lg-nowrap">
        <div class="col">
            <div class="row flex-lg-nowrap">
                <div class="col mb-3">
                    <div class="e-panel card">
                        <div class="card-body">
                            <div class="e-table">
                                <div class="d-flex justify-content-evenly">
                                    <button type="button" class="btn btn-primary"
                                            data-toggle="modal"
                                            data-target="#user-form-modal" id="addUser">Add
                                    </button>
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
                                        <?php foreach ($users

                                                       as $user) : ?>
                                            <?php if (isset($user)): ?>
                                                <tr>
                                                    <td class="align-middle">
                                                        <div
                                                                class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   id="<?= $user['id'] ?>">
                                                            <label class="custom-control-label"
                                                                   for="<?= $user['id'] ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap align-middle userName"><?= $user['firstname'] . ' ' . $user['lastname'] ?></td>
                                                    <td class="text-nowrap align-middle">
                                                        <span><?= $user['role'] ?></span></td>
                                                    <td class="text-center align-middle"><i
                                                                class="fa fa-circle active-circle"></i><?= $user['id'] ?>
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
                                                                    type="button" value="<?= $user['id'] ?>">
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="inner"></div>

                                <div class=" d-flex justify-content-evenly">
                                    <button type="button" class="btn btn-primary">Add</button>
                                    <select class="form-select w-25"
                                            aria-label="Default select example">
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
                                <form method="post">
                                    <div class="form-group">
                                        <label for="firstname" class="col-form-label">First Name:</label>
                                        <input type="text" class="form-control" id="firstname"
                                               name="firstname" >
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" class="col-form-label">Last Name:</label>
                                        <input type="text" class="form-control" id="lastname"
                                               name="lastname" >
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="col-form-label">Status</label>
                                        <input type="text" class="form-control" id="status"
                                               name="status" >
                                    </div>
                                    <div class="form-group">
                                        <label for="role" class="col-form-label">Role</label>
                                        <select class="form-select" aria-label="Default select example"
                                                id="role"
                                                name="role" >
                                            <option selected>Select role</option>
                                            <option>User</option>
                                            <option>Admin</option>
                                        </select>
                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).on('click', '.delete', function () {
                    let id = $(this).val()
                    $.ajax({
                        url: '/users/delete',
                        method: "GET",
                        data: {id: id},
                        success: function (data) {
                            document.body.outerHTML = data
                        }
                    })
                }
            )
            $(document).on('click', '.edit', function () {
                    let id = $(this).val()
/*                    let users = document.querySelectorAll('.userName')
                    users.forEach(element => $('#firstname').val(element.innerHTML))*/
                    $(document).off('click', '#submit')
                    $(document).on('click', '#submit', function () {
                        let firstname = $('#firstname').val()
                        let lastname = $('#lastname').val()
                        let status = $('#status').val()
                        let role = $('#role').val()
                        $.ajax({
                            url: '/users/edit',
                            method: "POST",
                            data: {id: id, firstname: firstname, lastname: lastname, status: status, role: role},
                            success: function (data) {
                                document.body.outerHTML = data
                            }
                        })
                    })
                }
            )

            $(document).on('click', '#addUser', function () {
                $('#firstname').val('')
                $('#lastname').val('')
                $('#status').val('')
                $(document).off('click', '#submit')
                $(document).on('click', '#submit', function () {
                        let firstname = $('#firstname').val()
                        let lastname = $('#lastname').val()
                        let status = $('#status').val()
                        let role = $('#role').val()
                        $.ajax({
                            url: '/users/add',
                            method: "POST",
                            data: {firstname: firstname, lastname: lastname, status: status, role: role},
                            success: function (data) {
                                document.body.outerHTML = data
                            }
                        })
                    }
                )
            })
        </script>
