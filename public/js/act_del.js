$('.act-del').on('click', function (e) {
    e.preventDefault();
    var btn = $(this);
    var url = btn.data('url');

    $.ajax({
        'type': 'GET',
        'url': url,
        success: function (data) {
            if (data.code == 200) {
                btn.parent().parent().remove();
            }
        },
        error: function () {

        }
    })
})
