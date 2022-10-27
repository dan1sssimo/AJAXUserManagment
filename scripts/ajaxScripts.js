document.onreadystatechange = function () {
    if (document.readyState === 'complete') {
        fetchUser()
    }
}

function fetchUser() {
    let action = "Load";
    $.ajax({
        url: '/users/list',
        method: "POST",
        data: {action: action},
        success: function (data) {
            $('#usersList').html(data);
        }
    })
}

function groupTask(task) {
    let arr = $('input:checked').map(function (i, el) {
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
            if (data.error === true) {
                data.messages.forEach(element => {
                    $('#tUser').append(`<p class="errors">${element}<p>`);
                })
            } else if (data.error === false) {
                fetchUser();
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
        let id = $(this).val()
        $.ajax({
            url: '/users/delete',
            method: "POST",
            dataType: 'json',
            data: {id: id},
            success: function (data) {
                console.log(data)
                if (data.error === true) {
                    data.messages.forEach(element => {
                        $('.modal-content').append(`<p class="errors">${element}<p>`);
                    })
                } else if (data.error === false) {
                    fetchUser()
                }
            }
        })
    }
)
$(document).on('click', '.edit', function () {
        $('p').remove()
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
            $('p').remove(".errors")
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
                    if (data.error === true) {
                        console.log(data)
                        data.messages.forEach(element => {
                            console.log(element)
                            $('#modalForm').append(`<p class="errors">${element}<p>`);
                        })
                    } else if (data.error === false) {
                        console.log(data)
                        fetchUser();
                        $(document).off('click', '#submit')
                    }
                }
            })
        })
    }
)

$(document).on('click', '#addUser', function () {
    $('.modal-backdrop').hide()
    $('p').remove()
    $('#firstname').val('')
    $('#lastname').val('')
    $('#status').prop('checked', false)
    $('#role').val('Select role')
    $('#UserModalLabel').text('AddUser')
    $(document).off('click', '#submit')
    $(document).on('click', '#submit', function () {
            $('p').remove(".errors")
            let firstname = $('#firstname').val()
            let lastname = $('#lastname').val()
            let status = $('#status').is(':checked') ? 1 : 0
            let role = $('#role').val()
            $(document).off('click', '#submit')
            $.ajax({
                url: '/users/add',
                method: "POST",
                data: {firstname: firstname, lastname: lastname, status: status, role: role},
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    if (data.error === true) {
                        data.messages.forEach(element => {
                            console.log(element)
                            $('#modalForm').append(`<p class="errors">${element}<p>`);
                        })
                    } else if (data.error === false) {
                        $('#user-form-modal, .modal-backdrop').hide()
                        fetchUser();
                    }
                }
            })
        }
    )
})
