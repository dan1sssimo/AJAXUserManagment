$(document).on('click', '.items', function () {
    let groupId = $(this).data('id');
    let allChecked = $('.items[data-id="' + groupId + '"]:not(:checked)').length === 0;
    $('#allItems[data-id="' + groupId + '"]').prop("checked", allChecked);
})
$(document).on('click', '#allItems', function () {
    $('#allItems').is(':checked') ? $('.items').prop('checked', true) : $(".items").prop('checked', false)
})
