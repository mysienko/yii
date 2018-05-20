$(document).ready(function () {

    /*
    $('.sign_btn').magnificPopup({
        type: 'inline',
        preloader: false,
    });

    $('.reg_btn').magnificPopup({
        type: 'inline',
        preloader: false,
    });
    */

    $('.plus').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var $num = $this.siblings('.count_input').val();
        $num = +$num;
        $num++;
        $this.siblings('.count_input').val($num);
    });
    $('.minus').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var $num = $this.siblings('.count_input').val();
        $num = +$num;
        $num--;
        if($num < 1) {
            return false;
        }
        $this.siblings('.count_input').val($num);
    });


    $('.head_account').click(function (e) {
        e.preventDefault();
        $('.head_account_more').toggleClass('active');
    });

    $('.broadcasting_btn').click(function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $('.broadcasting_more').toggleClass('active');
    });


    if($('div').hasClass('slide1')) {
        $('.slide1').owlCarousel({
            loop: true,
            margin: 45,
            responsiveClass: true,
            responsive:{
                0:{
                    items:1,
                    margin: 0,
                },
                622:{
                    items: 2,
                    margin: 20,
                },
                1050:{
                    items: 3,
                    margin: 15,
                },
                1366:{
                    items: 3,
                    nav: true,
                    loop: true
                }
            }
        });
    }

    if($('div').hasClass('slide2')) {
        $('.slide2').owlCarousel({
            loop: true,
            margin: 45,
            responsiveClass: true,
            responsive:{
                0:{
                    items:1,
                    margin: 0,
                },
                622:{
                    items: 2,
                    margin: 20,
                },
                1050:{
                    items: 3,
                    margin: 15,
                },
                1366:{
                    items: 3,
                    nav: true,
                    loop: true
                }
            }
        });
    }

    if($('div').hasClass('slide3')) {
        $('.slide3').owlCarousel({
            loop: true,
            margin: 45,
            responsiveClass: true,
            responsive:{
                0:{
                    items:1,
                    margin: 0,
                },
                622:{
                    items: 2,
                    margin: 20,
                },
                1050:{
                    items: 3,
                    margin: 15,
                },
                1366:{
                    items: 3,
                    nav: true,
                    loop: true
                }
            }
        });
    }

    if($('div').hasClass('main_news_slide')) {
        $('.main_news_slide').owlCarousel({
            loop: true,
            margin: 45,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: true
                },
                768:{
                    items:2,
                    margin: 15,
                    nav: true
                },
                1600:{
                    items: 3,
                    nav: true,
                    loop: true
                }
            }
        });
    }


    $('.mob_open_btn').click(function (e) {
        e.preventDefault();
        $('.mobile_head').addClass('open');
    });

    $('.menu_close_btn').click(function (e) {
        e.preventDefault();
        $('.mobile_head').removeClass('open');
    });

    $('.profile_add_btn').click(function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $('.add_more').toggleClass('open');
    });


    $('.goods_sections .accardion_btn').click(function (e) {
        e.preventDefault();
        $('.goods_sec_list').toggleClass('active');
    });
    $('.goods_price .accardion_btn').click(function (e) {
        e.preventDefault();
        $('.range_slider').toggleClass('active');
    });
    $('.goods_sorting .accardion_btn').click(function (e) {
        e.preventDefault();
        $('.sorting_block').toggleClass('active');
    });

    var goods_height = $('.goods_item_info').height();
    $('.goods_item_img').css('max-height',goods_height + 19);
    $(window).resize(function () {
        var goods_height = $('.goods_item_info').height();
        $('.goods_item_img').css('max-height',goods_height);
    });

    var news_height = $('.min_image').height();
    $('.big_image').css('max-height',news_height);
    $(window).resize(function () {
        var news_height = $('.min_image').height();
        $('.big_image').css('max-height',news_height);
    });

    $(function() {
        $(".auto_filter_form").change(function() {
            $(".auto_filter_form").submit();
        });
    });

});