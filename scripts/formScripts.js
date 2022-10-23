$(document).on('click', '.items', function () {
    if ($('.items').is(':checked'))
        $('#allItems').prop('checked', false)

})
$(document).on('click', '#allItems', function () {
    $('#allItems').is(':checked') ? $('.items').prop('checked', true) : $(".items").prop('checked', false)
})
$(document).on('change', '.task', function () {
    $('.task').not($(this)).val($(this).val());
})