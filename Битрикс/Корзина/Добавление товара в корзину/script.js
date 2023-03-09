$(document).on('click', '.add-cart-ajax', function (evt) {
    var id = $(this).attr('data-cart')
    var data = {'ID': id, 'QUANTITY': $('.quantity-data-' + id).val()};
    var quantity = $('.quant-data-catalog-'+id).val()

    $.ajax({
        type: 'post',
        url: '/ajax/cart/addToCart.php',
        data: data,
        dataType: 'html',
        success: function (response) {
            $('.count-cart-ajax').text(response)
        }
    });

    return false;
});