$('.feedback-form-ajax').submit(function (e) {
    e.preventDefault();

    var that = $(this),
        formData = new FormData(that.get(0));

    $.ajax({
        contentType: false,
        processData: false,
        type: 'POST',
        url: '/ajax/feedback/feedback.php',
        data: formData,
        dataType: 'html',

        success: function (response) {
            if (response == 1) location.reload();
            else alert(response)
        },

    });
    return false;

});