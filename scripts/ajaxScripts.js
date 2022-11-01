document.onreadystatechange = function () {
    if (document.readyState === 'complete') {

        fetchUser()

        function fetchUser() {
            let action = "Load";
            $.ajax({
                url: '/users/list',
                method: "POST",
                dataType: "json",
                data: {action: action},
                success: function (data) {
                    $('#usersList').append(`<thead>
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
                                            </thead>`);
                    data.user.forEach(element => {
                        $('#usersList').append(`<tr id="user${element.id}">
                                                        <td class="align-middle">
                                                            <div
                                                                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                                <input type="checkbox" class="custom-control-input items"
                                                                       data-id="users" id="${element.id}">
                                                                <label class="custom-control-label" for="${element.id}"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap align-middle userName">${element.firstname} ${element.lastname}</td>
                                                        <td class="text-nowrap align-middle userRole">
                                                            <span>${element.role}</span>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                              ${element.status === '1' ?
                            '<i class="fa fa-circle active-circle userStatus"></i>' :
                            '<i class="fa fa-circle circle greyCircle userStatus"></i>'}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div class="btn-group align-top">
                                                                <button class="btn btn-sm btn-outline-secondary badge edit"
                                                                        type="button"
                                                                        data-toggle="modal"
                                                                        data-target="#user-form-modal"
                                                                        value="${element.id}">Edit
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-secondary badge fa fa-trash delete"
                                                                        data-toggle="modal"
                                                                        data-target="#user-confirm"
                                                                        type="button" value="${element.id}">
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>`);
                    })
                }
            })
        }

        function groupTask(task) {
            $('div').remove(".alert-danger")
            let arr = $('.items:checked').map(function (i, el) {
                if ($(el).prop('id') !== 'allItems')
                    return $(el).prop('id');
            }).get();
            $.ajax({
                url: '/users/task',
                method: "POST",
                dataType: 'json',
                data: {task: task, arr: arr},
                success: function (data) {
                    console.log(data)
                    if (data.status === true && data.error == null) {
                        switch (task) {
                            case "1" : {
                                data.user.forEach(element => {
                                    $(`#user${element}`).find('.userStatus').removeClass('circle greyCircle')
                                    $(`#user${element}`).find('.userStatus').addClass('active-circle')
                                })
                                break
                            }
                            case "2" : {
                                data.user.forEach(element => {
                                    $(`#user${element}`).find('.userStatus').addClass('circle greyCircle')
                                    $(`#user${element}`).find('.userStatus').removeClass('active-circle')
                                })
                                break
                            }
                            case "3": {
                                data.user.forEach(element => {
                                    $(`#user${element}`).remove()
                                })
                                break
                            }
                        }
                    } else if (data.status === false && data.error !== null) {
                        data.error.message.forEach(element => {
                            $('.pageTitle').append(`<div class="alert alert-danger" role="alert">${element}</div>`);
                        })
                    }
                }
            })
        }

        $(document).on('click', '.groupTaskTop', function () {
            groupTask($('.task').val())
        })

        $(document).on('click', '.groupTaskBottom', function () {
            groupTask($('.task2').val())
        })

        $(document).on('click', '.delete', function () {
            $('div').remove(".alert-danger")
            let id = $(this).val()
            let row = $(this).closest("tr");
            let fullName = row.get(0).querySelector('.userName').innerText
            $('#userNameDelete').val(fullName)
            $(document).off('click', '#confirmDel')
            $(document).on('click', '#confirmDel', function () {
                    $('div').remove(".alert-danger")
                    $.ajax({
                        url: '/users/delete',
                        method: "POST",
                        dataType: 'json',
                        data: {id: id},
                        success: function (data) {
                            if (data.status === true && data.error == null) {
                                $(`#user${data.user.id}`).remove()
                                document.getElementById("closeConfirm").click();
                                $(document).off('click', '#confirmDel')
                            } else if (data.status === false && data.error !== null) {
                                $('#confirmForm').append(`<div class="alert alert-danger" role="alert">${data.error.message}</div>`);
                            }
                        }
                    })
                }
            )
        })


        $(document).on('click', '.edit', function () {
            $('div').remove(".alert-danger")
            let id = $(this).val()
            let row = $(this).closest("tr")
            let fullName = row.get(0).querySelector('.userName').innerText.split(' ')
            let role = row.get(0).querySelector('.userRole').innerText
            $('#status')[0].checked = row.get(0).querySelector('.userStatus').classList.contains('active-circle')
            $('#firstname').val(fullName[0])
            $('#lastname').val(fullName[1])
            $('#role').val(role)
            $('#UserModalLabel').text('EditUser')
            $(document).off('click', '#submit')
            $(document).on('click', '#submit', function () {
                $('div').remove(".alert-danger")
                let firstname = $('#firstname').val()
                let lastname = $('#lastname').val()
                let status = $('#status').is(':checked') ? 1 : 0
                let role = $('#role').val()
                $.ajax({
                    url: '/users/edit',
                    method: "POST",
                    dataType: 'json',
                    data: {id: id, firstname: firstname, lastname: lastname, status: status, role: role},
                    success: function (data) {
                        if (data.status === true && data.error == null) {
                            let user = $(`#user${data.user.id}`)
                            let fullName = `${data.user.firstname} ${data.user.lastname}`
                            user.find('.userName').text(fullName)
                            user.find('.userRole').text(data.user.role)
                            if (data.user.status === '1') {
                                user.find('.userStatus').removeClass('circle greyCircle')
                                user.find('.userStatus').addClass('active-circle')
                            } else {
                                user.find('.userStatus').addClass('circle greyCircle')
                                user.find('.userStatus').removeClass('active-circle')
                            }
                            $(document).off('click', '#submit')
                            document.getElementById("closeForm").click();
                        } else if (data.status === false && data.error !== null) {
                            data.error.message.forEach(element => {
                                $('#modalForm').append(`<div class="alert alert-danger" role="alert">${element}</div>`);
                            })
                        }
                    }
                })
            })
        })

        $(document).on('click', '#addUser', function () {
            $('div').remove(".alert-danger")
            $('#firstname').val('')
            $('#lastname').val('')
            $('#status').prop('checked', false)
            $('#role').val('Select role')
            $('#UserModalLabel').text('AddUser')
            $(document).off('click', '#submit')
            $(document).on('click', '#submit', function () {
                $('div').remove(".alert-danger")
                let firstname = $('#firstname').val()
                let lastname = $('#lastname').val()
                let status = $('#status').is(':checked') ? 1 : 0
                let role = $('#role').val()
                $.ajax({
                    url: '/users/add',
                    method: "POST",
                    data: {firstname: firstname, lastname: lastname, status: status, role: role},
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === true && data.error == null) {
                            $('#usersList').append(`<tr id="user${data.user.id}">
                                                        <td class="align-middle">
                                                            <div
                                                                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                                <input type="checkbox" class="custom-control-input items"
                                                                       data-id="users" id="${data.user.id}">
                                                                <label class="custom-control-label" for="${data.user.id}"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap align-middle userName">${data.user.firstname} ${data.user.lastname}</td>
                                                        <td class="text-nowrap align-middle userRole">
                                                            <span>${data.user.role}</span>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                              ${data.user.status === '1' ?
                                '<i class="fa fa-circle active-circle userStatus"></i>' :
                                '<i class="fa fa-circle circle greyCircle userStatus"></i>'}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div class="btn-group align-top">
                                                                <button class="btn btn-sm btn-outline-secondary badge edit"
                                                                        type="button"
                                                                        data-toggle="modal"
                                                                        data-target="#user-form-modal"
                                                                        value="${data.user.id}">Edit
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-secondary badge fa fa-trash delete"
                                                                        data-toggle="modal"
                                                                        data-target="#user-confirm"
                                                                        type="button" value="${data.user.id}">
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>`);
                            $(document).off('click', '#submit')
                            $("#allItems").prop('checked', false)
                            document.getElementById("closeForm").click();
                        } else if (data.status === false && data.error !== null) {
                            data.error.message.forEach(element => {
                                $('#modalForm').append(`<div class="alert alert-danger" role="alert">${element}</div>`);
                            })
                        }
                    }
                })
            })
        })
    }
}

