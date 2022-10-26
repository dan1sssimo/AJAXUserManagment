function groupTask(task) {
    let arr = $('input:checked').map(function (i, el) {
        if ($(el).prop('id') !== 'allItems')
            return $(el).prop('id');
    }).get();
    $.ajax({
        url: '/users/task',
        method: "POST",
        data: {task: task, arr: arr},
        success: function (data) {
            document.body.outerHTML = data
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
        let row = $(this).closest("tr");
        let fullName = row.get(0).querySelector('.userName').innerText
        $('#userNameDelete').val(fullName)
        $(document).off('click', '#confirm')
        $(document).on('click', '#confirm', function () {
                $.ajax({
                    url: '/users/delete',
                    method: "POST",
                    data: {id: id},
                    success: function (data) {
                        document.body.outerHTML = data
                    }
                })
            }
        )
    }
)
$(document).on('click', '.edit', function () {
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
            let firstname = $('#firstname').val()
            let lastname = $('#lastname').val()
            let status = $('#status').is(':checked') ? 1 : 0
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
    $('#status').prop('checked', false)
    $('#role').val('Select role')
    $('#UserModalLabel').text('AddUser')
    $(document).off('click', '#submit')
    $(document).on('click', '#submit', function () {
            let firstname = $('#firstname').val()
            let lastname = $('#lastname').val()
            let status = $('#status').is(':checked') ? 1 : 0
            let role = $('#role').val()
            $.ajax({
                url: '/users/add',
                method: "POST",
                data: {firstname: firstname, lastname: lastname, status: status, role: role},
                success: function (data) {
                    console.log(data)
                    document.body.outerHTML = data
                }
            })
        }
    )
})