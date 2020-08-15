$('.act-edit').on('click', function (e) {
    e.preventDefault();
    var btn = $(this);
    var url = btn.data('url');

    $.ajax({
        'type': 'GET',
        'url': url,
        success: function (data) {
            console.log(data)
            if (data.mess == 0){
                btn.html('Đã giao');
                btn.addClass('btn-success').removeClass('btn-danger');
            }
            else {
                btn.html('Chưa giao');

                btn.addClass('btn-danger').removeClass('btn-success');

            }
        },
        error: function () {
            console.log('err')
        }
    })
})
