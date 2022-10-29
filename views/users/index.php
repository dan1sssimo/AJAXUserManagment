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
                                    <button type="button" class="btn btn-success groupTaskTop">OK</button>
                                </div>
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="usersList">

                                    </table>
                                </div>
                                <div class="d-flex justify-content-evenly">
                                    <button type="button" class="btn btn-primary"
                                            data-toggle="modal"
                                            data-target="#user-form-modal" id="addUser">Add
                                    </button>
                                    <select class="form-select w-25 task2" aria-label="Default select example"
                                            name="task2">
                                        <option selected value="0">Please Select</option>
                                        <option value="1">Set active</option>
                                        <option value="2">Set not active</option>
                                        <option value="3">Delete</option>
                                    </select>
                                    <button type="button" class="btn btn-success groupTaskBottom">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
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