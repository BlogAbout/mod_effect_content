jQuery(function ($) {
    $('.list_contents .p-paginations .p-page').on('click', function () {
        $(this).parents('.list_contents').find('.page_content').removeClass('active');
        $(this).parents('.list_contents').find('.block_' + $(this).attr('data-page')).addClass('active');
        $(this).siblings('.p-page').removeClass('current');
        $(this).addClass('current');
    });
});