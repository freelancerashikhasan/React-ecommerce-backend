<!--**************** Icon Css ****************-->
<link href="{{ asset('frontend/assets/css/icomoon.css') }}" rel="stylesheet">
<!--**************** bootstrap Css ****************-->
<link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
<!--**************** animate Css ****************-->
<link href="{{ asset('frontend/assets/css/animate.css') }}" rel="stylesheet">
<!--**************** All Slider Css ****************-->
<link href="{{ asset('frontend/assets/css/owl.carousel.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/owl.theme.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/slick.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/swiper.min.css') }}" rel="stylesheet">
<!--**************** Others Plugin Css ****************-->
<link href="{{ asset('frontend/assets/css/meanmenu.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/nice-select.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/owl.transitions.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/magnific-popup.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/jquery.fancybox.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/odometer-theme-default.css') }}" rel="stylesheet">


{{-- sweetalert2 --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.min.css" integrity="sha512-l1vPIxNzx1pUOKdZEe4kEnWCBzFVVYX5QziGS7zRZE4Gi5ykXrfvUgnSBttDbs0kXe2L06m9+51eadS+Bg6a+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="{{ asset('frontend/assets/sass/style.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/custom.css') }}" rel="stylesheet">






{{-- @include('layouts.frontend.animated') --}}

<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        background-color: transparent !important;
    }

    .select2-container .select2-selection--single{
        height: 38px;
        border: 1px solid #ddd !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        height: 38px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        padding: 5px 20px 4px 20px;
    }

    .select2-search--dropdown .select2-search__field:focus {
        outline: none;
    }

    .static-hero-left{
        padding: 0px !important;
    }
    @media (max-width: 576px){
        .header-middle {
            display: none;
        }
    }

    .offer-banner-item {
        margin: 0px 6px;
        max-height: 215px;
        background: transparent !important;
    }
    .cta-banner-img {
        background: transparent !important;
    }

    /* @media (max-width: 576px){
        .header-middle {
            display: none;
        }
    } */


    .mobile-navigation {
        display: none;
        padding: 5px 5px;
        position: fixed;
        bottom: 0px;
        width: 100%;
        z-index: 21000;
        background: #fff;
        border-top: 1px solid #ddd;
    }



    @media (max-width: 576px){
        .back-btn{
            bottom: 80px;
        }
        .mobile-navigation{
            display: block;
        }
        .footer-section{
            margin-bottom: 60px;
        }
    }

    .mobile-navigation ul {
        display: flex;
    }

    .mobile-navigation ul li {
        width: 25%;
        text-align: center;
        padding: 10px;
        font-size: 12px;
        font-weight: 600;
        padding-bottom: 1px;
    }
    .mobile-navigation ul li a{
        padding: 12px;
    }
    .mobile-navigation ul li a svg {
        font-size: 21px;
        color: #5d7b1a;
    }
    .mobile-navigation ul li a:hover svg{
        color: #fd9f2f;
        transition: 0.3s;
    }
    .mobile-navigation ul li a:hover .mobile-navigation ul li{
        color: #fd9f2f;
        transition: 0.3s;
    }
    .categories-shop-item {
        background: #fff;
        width: 245px;
        z-index: 11111;
        position: absolute;
        left: auto;
        /* top: -158px; */
        /* opacity: 0; */
        /* visibility: hidden; */
        transition: all 0.3s ease-out 0s;
        box-shadow: 0px 2px 20px 0px rgba(62, 65, 159, 0.09);
        padding: 10px 0;
        bottom: 65px;
        right: 10px;
    }

    .categories-shop-item ul {
        display: block !important;
    }

    .categories-shop-item ul li {
        width: 100%;
        text-align: left;
    }
    .mobile-navigation-category-dropdown-menu {
        display: none;
        min-width: 18rem;
        bottom: 66px;
        right: 11px;
        padding: 7px 0px;
        position: absolute;
        z-index: 1000;
        margin: 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: .25rem;
    }
    .mobile-navigation-category-dropdown-menu a {
        padding: 9px 12px !important;
        width: 100%;
        display: block;
        font-size: 13px;
        color: #707070;
    }
    .mobile-navigation-category-dropdown-menu a:hover, .mobile-navigation-category-dropdown-menu a:hover i {
        background: #5d7b1a24;
        color: #5d7b1a;
    }

    .navbar-header-for-mediam-device {
        display: none;
        text-align: left;
    }

    .navbar-header-for-mediam-device img {
        width: 120px !important;
        max-width: 120px !important;
    }
    .product-item .product-image{
        padding: 0px;
    }
    .product-item .product-info .subtitle {
        color: #1c263a;
    }
    .separator-padding {
        padding: 60px 0;
    }
    @media (max-width: 992px){
        .header-area .header-category-item {
            display: none;
        }
        .navbar-header-for-mediam-device {
            display: block !important;
        }
        .product-item .product-info h2 a {
            font-size: 14px;
        }
        .product-item .product-info .subtitle {
            font-size: 12px;
            color: #1c263a;
        }
        .product-item .product-info .price .old-price, .product-item .product-info .price .present-price{
            font-size:12px;
        }
    }
    @media (max-width: 576px){
        .product-item .product-info h2 a {
            font-size: 14px;
        }
        .product-item .product-info .subtitle {
            font-size: 12px;
            color: #1c263a;
        }
        .product-item .product-info .price .old-price, .product-item .product-info .price .present-price{
            font-size:12px;
        }

        .hero-slider-img .slick-slide img{
            height: 150px;
        }
    }



</style>

<style>
    body.toggled {
        overflow: hidden;
    }
    body.toggled::after {
        background: #000 none repeat scroll 0 0;
        bottom: 0;
        content: "";
        left: 0;
        opacity: 0.7;
        position: absolute;
        right: 0;
        z-index: 9;
        top: 0;
    }
    .cart-sidebar {
        background: #fff none repeat scroll 0 0;
        overflow: auto;
        position: fixed;
        right: -400px;
        top: 0;
        width: 372px;
        z-index: 999;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
        height: 100vh;
        border:1px solid #7aa223;
    }
    .cart-sidebar.toggled {
        right: 0px;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }
    .cart-sidebar-body {
        height: 66vh;
        overflow: inherit;
    }
    .cart-sidebar-header {
        background: #1c2224 none repeat scroll 0 0;
        color: #fff;
        padding: 18px 20px;
    }
    .cart-sidebar-header h5 {
        color: #fff;
        font-size: 16px;
        line-height: 24px;
        margin: 0;
    }
    .cart-sidebar-header .float-right {
        background: #fff none repeat scroll 0 0;
        border-radius: 24px;
        color: #000;
        height: 26px;
        line-height: 25px;
        text-align: center;
        width: 26px;
        float: right;
    }
    .cart-list-product {
        border-bottom: 1px solid #ececec;
        overflow: hidden;
        padding: 14px 20px;
        position: relative;
    }
    .cart-list-product img {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: #ececec #ececec #dcdcdc;
        border-image: none;
        border-radius: 2px;
        border-style: solid;
        border-width: 1px 1px 3px;
        box-shadow: 0 0 3px #ececec;
        float: left;
        height: 99px;
        margin: 0 15px 0 0;
        object-fit: scale-down;
        width: 82px;

    }
    .cart-list-product h5 a {
        font-size: 14px;
    }
    .cart-list-product h5 {
        margin: 0;
    }
    .cart-list-product h6 {
        font-size: 11px;
    }
    .cart-list-product > h6 span {
        color: #e96125;
    }
    .remove-cart {
        position: absolute;
        right: 18px;
        top: 12px;
    }
    .cart-list-product .badge {
        background: #f2fef2 none repeat scroll 0 0;
        border: 1px solid #51aa1b;
        border-radius: 2px;
        color: #51aa1b;
        font-size: 11px;
        font-weight: 500;
        padding: 3px 6px;
    }
    .cart-sidebar-footer {
        background: #ececec none repeat scroll 0 0;
        padding: 14px 20px;
    }
    .cart-store-details p {
        margin: 0 0 3px;
    }
    .cart-store-details h6 {
        margin: 10px 0 19px;
    }
    .cart-sidebar-footer .btn {
        padding: 15px 17px;
    }
    .remove-cart {
        color: #ff0808;
    }

    .cart-list-product h5 a {
        color: #32430c !important;
        font-weight: 600;
    }

    .cart-list-product h6 {
        font-size: 15px;
        color: #f59607 !important;
        font-weight: 600;
    }
    del.regular-price {
        font-size: 12px;
    }
    .cart-list-product .product_plus_minus input {
        width: 40px;
        font-size: 14px;
        text-align: center;
        margin: 0px 1px;
    }

    .cart-list-product .product_plus_minus button {
        padding: 0px 5px;
        font-size: 16px;
        border: 1px solid #303f0f !important;
    }
    .cart-list-product .product_plus_minus{
        text-align: center;
    }
    .cart-store-details h6 {
        font-size: 20px;
        font-weight: 600;
    }
    .footer-icon {
        margin-top: 18px;
    }
    .footer-icon a {
        margin-right: 11px;
    }
    .footer-icon a svg {
        color: #fff;
        border: 1px solid #fff;
        padding: 9px 10px;
        border-radius: 100%;
        font-size: 18px !important;
    }

    .btn-secondary {
        background-color: #4e6b0d;
        border-color: #4e6b0d;
    }

    .btn-secondary:hover {
        transition: 0.3s;
        color: #4e6b0d !important;
        background: #ffff !important;
    }
    .btn-secondary:focus{
        outline-color: #4e6b0d !important;
    }
    .btn-secondary:focus, .btn-secondary:active:focus {
        box-shadow: none;
    }

    svg#verify {
        position: absolute;
        margin-top: -49px;
        right: 31px;
        background: #68910a4d;
        padding: 3px 4px;
        border-radius: 50%;
        font-size: 18px;
        color: #68910a;
        border: 1px solid #68910a;
    }




</style>

