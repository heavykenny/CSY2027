/*

TemplateMo 559 eShop

https://templatemo.com/tm-559-zay-shop

*/

'use strict';
$(document).ready(function () {

    // Accordion
    let all_panels = $('.templatemo-accordion > li > ul').hide();

    $('.templatemo-accordion > li > a').click(function () {
        let target = $(this).next();
        if (!target.hasClass('active')) {
            all_panels.removeClass('active').slideUp();
            target.addClass('active').slideDown();
        }
        return false;
    });
    // End accordion

    // Product detail
    $('.product-links-wap a').click(function () {
        let this_src = $(this).children('img').attr('src');
        $('#product-detail').attr('src', this_src);
        return false;
    });

    $('#btn-minus').click(function () {
        const var_value = $("#var-value");
        let val = var_value.html();

        const btn_out_of_stock = $("#btn-out-of-stock");

        if (val === '0') {
            val = '0';
        } else {
            val--;
            btn_out_of_stock.css('display', 'none');
        }

        var_value.html(val);
        $("#product-quantity").val(val);
        return false;
    });

    $('#btn-plus').click(function () {
        const var_value = $("#var-value");
        const product_quantity = $("#product-quantity");
        const btn_out_of_stock = $("#btn-out-of-stock");

        let val = var_value.html();
        let max = product_quantity.attr('max');

        if (val === max) {
            val = max;
            btn_out_of_stock.css('display', '');
        } else {
            val++;
        }

        var_value.html(val);
        product_quantity.val(val);
        return false;
    });

    $('.btn-size').click(function () {
        const var_value = $("#var-value");
        const btn_size = $(".btn-size");

        let this_val = $(this).html();
        var_value.val(this_val);
        btn_size.removeClass('btn-secondary');
        btn_size.addClass('btn-success');
        $(this).removeClass('btn-success');
        $(this).addClass('btn-secondary');
        return false;
    });
    // End product detail
});
