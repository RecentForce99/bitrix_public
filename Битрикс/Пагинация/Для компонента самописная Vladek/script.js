$(document).on('click', '.pagination-custom__item-uslugi-ajax', function () { //PAGINATION

    var targetContainer = $('.all-news__content'),
        typeID = $('.pagination-custom-uslugi-ajax').attr('type-id'),
        pageID = $(this).attr('page-id');

    var uri = '?' + 'PAGEN_'+typeID+'='+pageID;
    history.pushState(null, null, uri);    // == url.href

    ///////////////////////////////////////////////////////
    $.ajax({
        type: 'GET',
        url: uri,
        dataType: 'html',
        success: function(response){

            $('.all-news__content').empty()
            $('.pagination-custom-uslugi-ajax').remove() //  Удаляем старую навигацию
            var elements = $(response).find('.all-news__content a'),
                pagination = $(response).find('.pagination-custom-uslugi-ajax');


            targetContainer.append(elements);
            $('.all-news .container').append(pagination)

        }
    })
    ///////////////////////////////////////////////////////




})