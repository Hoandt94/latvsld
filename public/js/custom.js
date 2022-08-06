function showNotification(title, message = '', type = 'success'){
    var e = {
        message: message,
        title: title ? title : "Thông báo mới"
    };
    var t = $.notify(e, {
        type: type,
        allow_dismiss: true,
        newest_on_top: true,
        timer: 2000,
        placement: {
            from: 'top',
            align: 'right'
        },
        offset: {
            x: 30,
            y: 30
        },
        z_index: 10000,
        animate: {
            enter: 'fadeIn',
            exit: 'fadeOut'
        }
    });
}