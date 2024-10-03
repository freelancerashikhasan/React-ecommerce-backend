(function ($) {

    "use strict";

    $('.select').niceSelect();

    // RESPONSIVE MENU
    $('.responsive').on('click', function (e) {
        $('#mobile-menu').slideToggle();
    });

    // meanmenu
    $('#mobile-menu').meanmenu({
        meanMenuContainer: '.mobile-menu',
        meanScreenWidth: "992"
    });

    //Header Search
    if ($('.discount-close').length) {
        $('.discount-close').on('click', function () {
            $('.discount-bar').addClass('d-none');
        });
    }


    // menu toggle
    $(".main-menu li a").on('click', function () {
        if ($(window).width() < 700) {
            $("#mobile-menu").slideUp();
        }
    });

    // toggle2
    $('.coupon-click').on("click", function () {
        $('.coupon-form').slideToggle();
        $('.coupon-form').toggleClass('caupon-area')
    })

    // sticky-header

    if ($(".header-style-1, .header-style-3").length) {
        var header = document.getElementById("header-sticky");
        var stickyPosition = header.offsetTop + header.offsetHeight;
        window.onscroll = function () {
            if (window.pageYOffset > stickyPosition) {
                header.classList.add("sticky");
                document.querySelectorAll('.page-wrap')[0].style.marginTop = header.offsetHeight + "px";
            } else {
                header.classList.remove("sticky");
                document.querySelectorAll('.page-wrap')[0].style.marginTop = "0px";
            }
        };
    }

    /*------------------------------------------
        = Header shopping catagory toggle
    -------------------------------------------*/
    if ($(".header-category-item").length) {
        var headershopToggleBtn = $(".header-category-toggle-btn");
        var headershopContent = $(".category-shop-item");
        var headershopCloseBtn = $(".category-shop-close");
        var body = $("body");

        headershopToggleBtn.on("click", function (e) {
            headershopContent.toggleClass("category-shop-item-toggle");
            e.stopPropagation();
        });

        headershopCloseBtn.on("click", function (e) {
            headershopContent.removeClass("category-shop-item-toggle");
            e.stopPropagation();
        });

        body.on("click", function () {
            headershopContent.removeClass("category-shop-item-toggle");
        }).find(headershopContent).on("click", function (e) {
            e.stopPropagation();
        });
    }


    /*    Header shopping catagory Sub-menu */
    jQuery('#metis-menu').metisMenu().show();


    // HERO SLIDER
    var menu = [];
    jQuery('.swiper-slide').each(function (index) {
        menu.push(jQuery(this).find('.slide-inner').attr("data-text"));
    });
    var interleaveOffset = 0.5;
    var swiperOptions = {
        loop: true,
        speed: 1000,
        parallax: true,
        autoplay: {
            delay: 6500,
            disableOnInteraction: false,
        },
        watchSlidesProgress: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        on: {
            progress: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    var slideProgress = swiper.slides[i].progress;
                    var innerOffset = swiper.width * interleaveOffset;
                    var innerTranslate = slideProgress * innerOffset;
                    swiper.slides[i].querySelector(".slide-inner").style.transform =
                        "translate3d(" + innerTranslate + "px, 0, 0)";
                }
            },

            touchStart: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = "";
                }
            },

            setTransition: function (speed) {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(".slide-inner").style.transition =
                        speed + "ms";
                }
            }
        }
    };

    var swiper = new Swiper(".swiper-container", swiperOptions);

    // DATA BACKGROUND IMAGE
    var sliderBgSetting = $(".slide-bg-image");
    sliderBgSetting.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });



    // tooltips

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })



    /*------------------------------------------
        = HIDE PRELOADER
    -------------------------------------------*/
    function preloader() {
        if ($('.preloader').length) {
            $('.preloader').delay(100).fadeOut(500, function () {

                //active wow
                wow.init();

            });
        }
    }



    /*------------------------------------------
        = WOW ANIMATION SETTING
    -------------------------------------------*/
    var wow = new WOW({
        boxClass: 'wow',      // default
        animateClass: 'animated', // default
        offset: 0,          // default
        mobile: true,       // default
        live: true        // default
    });



    /*------------------------------------------
       = BACK TO TOP BTN SETTING
   -------------------------------------------*/
    $("body").append("<a href='#' class='back-btn'><i class='icon-angale-right2'></i></a>");

    function toggleBackToTopBtn() {
        var amountScrolled = 1000;
        if ($(window).scrollTop() > amountScrolled) {
            $("a.back-btn").fadeIn("slow");
        } else {
            $("a.back-btn").fadeOut("slow");
        }
    }

    $(".back-btn").on("click", function () {
        $("html,body").animate({
            scrollTop: 0
        }, 700);
        return false;
    })


    //  hover-active
    let rightItems = document.querySelectorAll('.case-right-items .item');
    let leftItems = document.querySelectorAll('.case-left-image-group .img-item');

    rightItems.forEach((rightItem, index) => {
        rightItem.addEventListener('mouseenter', function () {
            handleHover(rightItem, leftItems[index]);
        });
    });

    function handleHover(rightItem, leftItem) {
        rightItems.forEach(item => {
            item.classList.remove('active');
            item.classList.add('item');
        });
        leftItems.forEach(item => {
            item.classList.remove('active');
            item.classList.add('img-item');
        });
        rightItem.classList.add('active');
        leftItem.classList.add('active');
    }


    /*------------------------------------------
        = Featured SLIDER
    -------------------------------------------*/
    if ($(".featured-category-slider-active").length) {
        $(".featured-category-slider-active").owlCarousel({
            autoplay: false,
            smartSpeed: 300,
            margin: 20,
            loop: true,
            autoplayHoverPause: true,
            dots: true,
            navText: ['<i class="icon-angale-right"></i>', '<i class="icon-angale-right2"></i>'],
            nav: false,
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                    nav: false
                },

                350: {
                    items: 2,
                    dots: true,
                    nav: false
                },
                500: {
                    items: 3,
                    dots: true,
                    nav: false
                },

                768: {
                    items: 4,
                },
                992: {
                    items: 5,
                },

                1200: {
                    items: 6
                },

                1400: {
                    items: 6
                },

            }
        });
    }
    /*------------------------------------------
        = Featured SLIDER
    -------------------------------------------*/
    if ($(".featured-category-slider-active-s2").length) {
        $(".featured-category-slider-active-s2").owlCarousel({
            autoplay: true,
            smartSpeed: 1000,
            margin: 20,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            nav: false,
            responsive: {
                0: {
                    items: 1,
                },

                350: {
                    items: 1,
                },
                400: {
                    items: 2,
                },
                500: {
                    items: 2,
                },
                600: {
                    items: 3,
                },

                768: {
                    items: 4,
                },
                992: {
                    items: 5,
                },

                1200: {
                    items: 6
                },

                1400: {
                    items: 7
                },

            }
        });
    }
    /*------------------------------------------
        = deal active
    -------------------------------------------*/
    if ($(".deal-active").length) {
        $(".deal-active").owlCarousel({
            autoplay: false,
            smartSpeed: 300,
            margin: 20,
            loop: true,
            autoplayHoverPause: true,
            dots: true,
            navText: ['<i class="icon-angale-right"></i>', '<i class="icon-angale-right2"></i>'],
            nav: false,
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                    nav: false
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 2,
                },

                1400: {
                    items: 2
                },

            }
        });
    }


    /*------------------------------------------
        = best-selling-active
    -------------------------------------------*/
    if ($(".best-selling-active").length) {
        $(".best-selling-active").owlCarousel({
            autoplay: false,
            smartSpeed: 1000,
            margin: 20,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            arrows: true,
            nav: true,
            navText: ['<i class="icon-angale-right"></i>', '<i class="icon-angale-right2"></i>'],
            responsive: {
                0: {
                    items: 1
                },

                450: {
                    items: 1,
                },
                767: {
                    items: 2,
                },

                992: {
                    items: 1
                },

                1200: {
                    items: 2
                }
            }
        });
    }


    /*------------------------------------------
       = PARTNERS SLIDER
   -------------------------------------------*/
    if ($(".partners-slider").length) {
        $(".partners-slider").owlCarousel({
            autoplay: true,
            smartSpeed: 300,
            margin: 0,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            arrows: false,
            nav: false,
            responsive: {
                0: {
                    items: 2
                },

                550: {
                    items: 3
                },

                992: {
                    items: 4
                },

                1200: {
                    items: 5
                }
            }
        });
    }

    /*------------------------------------------
    testimonial-active
    -------------------------------------------*/
    if ($(".testimonial-active").length) {
        $(".testimonial-active").owlCarousel({
            autoplay: true,
            smartSpeed: 2000,
            margin: 0,
            loop: true,
            items: 1,
            autoplayHoverPause: true,
            dots: false,
            arrows: false,
            nav: false,
        });
    }

    /*------------------------------------------
        = top-selling-active
    -------------------------------------------*/
    if ($(".top-selling-active").length) {
        $(".top-selling-active").owlCarousel({
            autoplay: false,
            smartSpeed: 300,
            margin: 20,
            loop: true,
            autoplayHoverPause: true,
            dots: true,
            navText: ['<i class="icon-angale-right"></i>', '<i class="icon-angale-right2"></i>'],
            nav: false,
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                    nav: false
                },
                500: {
                    items: 2,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 2,
                },

                1400: {
                    items: 3
                },

            }
        });
    }

    /*------------------------------------------
        = deal active
    -------------------------------------------*/
    if ($(".top-selling-active-s2").length) {
        $(".top-selling-active-s2").owlCarousel({
            autoplay: false,
            smartSpeed: 300,
            margin: 20,
            loop: true,
            autoplayHoverPause: true,
            dots: true,
            navText: ['<i class="icon-angale-right"></i>', '<i class="icon-angale-right2"></i>'],
            nav: false,
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                    nav: false
                },
                500: {
                    items: 2,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 2,
                },

                1400: {
                    items: 4
                },

            }
        });
    }

    /*------------------------------------------
        = best-selling-active-s2
    -------------------------------------------*/
    if ($(".best-selling-active-s2").length) {
        $(".best-selling-active-s2").owlCarousel({
            autoplay: false,
            smartSpeed: 1000,
            margin: 20,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            arrows: true,
            nav: true,
            navText: ['<i class="icon-angale-right"></i>', '<i class="icon-angale-right2"></i>'],
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                },

                450: {
                    items: 1,
                    dots: true,
                },
                767: {
                    items: 2,
                    dots: true,
                },

                992: {
                    items: 2
                },

                1200: {
                    items: 4
                }
            }
        });
    }

    /*------------------------------------------
        = instagram-slider
    -------------------------------------------*/
    if ($(".instagram-slider").length) {
        $(".instagram-slider").owlCarousel({
            autoplay: true,
            smartSpeed: 300,
            margin: 6,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            nav: false,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },

                500: {
                    items: 2,
                    nav: false,
                },

                600: {
                    items: 3,
                    nav: false,
                },

                768: {
                    items: 3,
                },

                991: {
                    items: 3,
                },
                1200: {
                    items: 4,
                },

                1400: {
                    items: 6
                },

            }
        });
    }

    $(document).ready(function () {
        $('.instagram-popup').magnificPopup({
            type: 'image',
            mainClass: 'mfp-with-zoom',
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out',
            }

        });

    });


    /*------------------------------------------
        = POPUP VIDEO
    -------------------------------------------*/
    if ($(".video-btn").length) {
        $(".video-btn").on("click", function () {
            $.fancybox({
                href: this.href,
                type: $(this).data("type"),
                'title': this.title,
                helpers: {
                    title: { type: 'inside' },
                    media: {}
                },

                beforeShow: function () {
                    $(".fancybox-wrap").addClass("portfolio-fancybox");
                }
            });
            return false
        });
    }


    /*------------------------------------------
      = FUNFACT
  -------------------------------------------*/
    if ($(".odometer").length) {
        $('.odometer').appear();
        $(document.body).on('appear', '.odometer', function (e) {
            var odo = $(".odometer");
            odo.each(function () {
                var countNumber = $(this).attr("data-count");
                $(this).html(countNumber);
            });
        });
    }



    /*------------------------------------------
        = MASONRY GALLERY SETTING
    -------------------------------------------*/
    function masonryGridSetting() {
        if ($('.masonry-gallery').length) {
            var $grid = $('.masonry-gallery').masonry({
                itemSelector: '.grid-item',
                columnWidth: '.grid-item',
                percentPosition: true
            });

            $grid.imagesLoaded().progress(function () {
                $grid.masonry('layout');
            });
        }
    }
    masonryGridSetting();


    /*------------------------------------------
        = CONTACT FORM SUBMISSION
    -------------------------------------------*/
    if ($("#contact-form-mejor").length) {
        $("#contact-form-mejor").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },

                email: "required",

                phone: "required",

                subject: {
                    required: true
                }


            },

            messages: {
                name: "Please enter your name",
                email: "Please enter your email address",
                phone: "Please enter your phone number",
                subject: "Please select your contact subject"
            },

            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: "mail-contact.php",
                    data: $(form).serialize(),
                    success: function () {
                        $("#loader").hide();
                        $("#success").slideDown("slow");
                        setTimeout(function () {
                            $("#success").slideUp("slow");
                        }, 3000);
                        form.reset();
                    },
                    error: function () {
                        $("#loader").hide();
                        $("#error").slideDown("slow");
                        setTimeout(function () {
                            $("#error").slideUp("slow");
                        }, 3000);
                    }
                });
                return false; // required to block normal submit since you used ajax
            }

        });
    }


    /*------------------------------------------
        = FUNCTION FORM SORTING GALLERY
    -------------------------------------------*/
    function sortingGallery() {
        if ($(".sortable-gallery .products-filters").length) {
            var $container = $('.product-container');
            $container.isotope({
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false,
                }
            });

            $(".products-filters li a").on("click", function () {
                $('.products-filters li .current').removeClass('current');
                $(this).addClass('current');
                var selector = $(this).attr('data-filter');
                $container.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false,
                    }
                });
                return false;
            });
        }
    }

    sortingGallery();


    /*--------------------------------------------------------
    / 11. Price Slider
    /----------------------------------------------------------*/
    var $anSelect = $('.anSelect select'),
        $sliderRange = $('#sliderRange');

    if ($sliderRange.length > 0) {
        $sliderRange.slider({
            range: true,
            min: 0,
            max: 10000,
            values: [500, 10000],
            slide: function (event, ui) {
                $("#amount").html("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        $("#amount").html("$" + $sliderRange.slider("values", 0) + " - $" + $sliderRange.slider("values", 1));
    }


    /*-----------------------
       cart-plus-minus-button
     -------------------------*/
    $(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
    $(".qtybutton").on("click", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    // Single gallery slider
    function productGallary() {
        if ($('.product-active').length && $('.product-thumbnil-active').length) {

            var $sync1 = $(".product-active"),
                $sync2 = $(".product-thumbnil-active"),
                flag = false,
                duration = 500;

            $sync1
                .owlCarousel({
                    items: 1,
                    margin: 0,
                    nav: false,
                    dots: false
                })
                .on('changed.owl.carousel', function (e) {
                    if (!flag) {
                        flag = true;
                        $sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
                        flag = false;
                    }
                });

            $sync2
                .owlCarousel({
                    margin: 10,
                    items: 4,
                    nav: false,
                    dots: false,
                    center: false,
                    responsive: {
                        0: {
                            items: 2,
                            autoWidth: false
                        },
                        400: {
                            items: 2,
                            autoWidth: false
                        },
                        500: {
                            items: 2,
                            center: false,
                            autoWidth: false
                        },
                        600: {
                            items: 3,
                            autoWidth: false
                        },
                        1200: {
                            items: 4,
                            autoWidth: false
                        }
                    },
                })
                .on('click', '.owl-item', function () {
                    $sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);

                })
                .on('changed.owl.carousel', function (e) {
                    if (!flag) {
                        flag = true;
                        $sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
                        flag = false;
                    }
                });

        };
    }

    productGallary();



    /*------------------------------------------
            = COUNTDOWN CLOCK
    -------------------------------------------*/
    if ($("#clock").length) {
        $('#clock').countdown('2024/12/03', function (event) {
            var $this = $(this).html(event.strftime('' +
                '<div class="box"><div><div class="time">%D</div></div></div>' +
                '<div class="box"><div><div class="time">%H</div></div></div>' +
                '<div class="box"><div><div class="time">%M</div></div></div>' +
                '<div class="box"><div><div class="time">%S</div></div></div>'));
        });
    }

    /*------------------------------------------
            = COUNTDOWN CLOCK TWO
    -------------------------------------------*/
    if ($("#clock-s2, #clock-s3").length) {
        $('#clock-s2, #clock-s3').countdown('2024/12/03', function (event) {
            var $this = $(this).html(event.strftime('' +
                '<div class="box"><div><div class="time">%D</div> <span>Days</span> </div></div>' +
                '<div class="box"><div><div class="time">%H</div> <span>Hours</span> </div></div>' +
                '<div class="box"><div><div class="time">%M</div> <span>Mins</span> </div></div>' +
                '<div class="box"><div><div class="time">%S</div> <span>Secs</span> </div></div>'));
        });
    }


    /*==========================================================================
        WHEN DOCUMENT LOADING
    ==========================================================================*/
    $(window).on('load', function () {

        preloader();

        sortingGallery();

    });



    /*==========================================================================
        WHEN WINDOW SCROLL
    ==========================================================================*/
    $(window).on("scroll", function () {
        toggleBackToTopBtn();
    });


    /*==========================================================================
        WHEN WINDOW RESIZE
    ==========================================================================*/
    $(window).on("resize", function () {

    });



})(window.jQuery);
