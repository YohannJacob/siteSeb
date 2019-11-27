$(document).ready(function () {

    $('.js-delete-image').on('click', function (e) {
        e.preventDefault();

        id = $(this).attr('id');
        var $link = $(e.currentTarget);
        url = $link.attr('href');

        toRemove = $('#delete-' + id)

        $.ajax({
            url: url,
            data: { 'entityId': id },
            method: 'POST',
        }).done(function (data, reponse) {

            toRemove.remove();
        })
    });
});