<!-- start of footer-section -->
<footer class="footer-section">
    <div class="container">
        <div class="offer-features-area">
            <div class="offer-features-wrap">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="features-item">
                            <div class="features-icon">
                                <div class="icon">
                                    <i class="icon-shipped"></i>
                                </div>
                            </div>
                            <div class="features-text">
                                <h2>FREE & FAST SHIPPING</h2>
                                <p>Orders All Over $100</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="features-item">
                            <div class="features-icon">
                                <div class="icon">
                                    <i class="icon-cashback"></i>
                                </div>
                            </div>
                            <div class="features-text">
                                <h2>MONEY BACK GUARANTEE</h2>
                                <p>With a 30 Day Minimum</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="features-item">
                            <div class="features-icon">
                                <div class="icon">
                                    <i class="icon-privacy"></i>
                                </div>
                            </div>
                            <div class="features-text">
                                <h2>ALL SECURE PAYMENT</h2>
                                <p>Up to 12 months installments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="features-item">
                            <div class="features-icon">
                                <div class="icon">
                                    <i class="icon-discount"></i>
                                </div>
                            </div>
                            <div class="features-text">
                                <h2>ALL SECURE DSCOUNT</h2>
                                <p>Up to 12% Discount</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="upper-footer">
        <div class="container">
            <div class="row">
                <div class="col col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="widget about-widget">
                        <div class="widget-logo">
                            <img src="{{ asset('uploads/system/') . '/' . companyInfo()->website_logo }}" alt="{{ companyInfo()->company_name }}" width="200px">
                        </div>

                        <div class="footer-text">
                            <p>{{ (ganarelsetting()->about_company != null) ? ganarelsetting()->about_company : 'I have been a loyal customer of this auto parts company for years and I cannot recommend them enough.' }} </p>
                        </div>
                        <div class="footer-icon">
                            {{-- <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-google-plus-g"></i></a> --}}

                            @if (socials()->email != NULL)
                                <a target="_blank" href="mailto:{{ socials()->email }}">
                                    <i style="font-size: 18px;" class="far fa-envelope"></i>
                                </a>
                            @endif
                            @if (socials()->facebook != NULL)
                                <a target="_blank" href="{{ socials()->facebook }}">
                                    <i style="font-size: 18px;" class="fab fa-facebook-square"></i>
                                </a>
                            @endif
                            @if (socials()->instagram != NULL)
                                <a target="_blank" href="{{ socials()->instagram }}">
                                    <i style="font-size: 18px;" class="fab fa-instagram"></i>
                                </a>
                            @endif
                            @if (socials()->linkedin != NULL)
                                <a target="_blank" href="{{ socials()->linkedin }}">
                                    <i style="font-size: 18px;" class="fab fa-linkedin"></i>
                                </a>
                            @endif
                            @if (socials()->x != NULL)
                                <a target="_blank" href="{{ socials()->x }}">
                                    <i style="font-size: 18px;" class="fab fa-twitter-square"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="widget link-widget">
                        <div class="widget-title">
                            <h3>Menu</h3>
                        </div>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('shop') }}">Shop</a></li>
                            {{-- <li><a href="{{ route('about_us') }}">About Us</a></li> --}}
                            <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="widget subscribe">
                        <div class="widget-title">
                            <h3>Contact Us</h3>
                        </div>

                        <div class="contact-ft">
                            <ul>
                                <li><i><img src="{{ asset('frontend/assets/images/icon/mail.png') }}" alt=""></i> <a class="text-white" href="mailto:{{ socials()->email }}">{{ socials()->email }}</a></li>

                                <li><i class="icon-contact"></i> <a class="text-white" href="tel:{{ socials()->phone }}">{{ socials()->phone }}</a></li>
                                <li><i class="icon-placeholder"></i>{{ explode('<br>', ganarelsetting()->address)[0] ?? '' }} <br> {{ explode('<br>', ganarelsetting()->address)[1] ?? '' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </div>
    <div class="lower-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-lg-4 col-12">
                    <div class="copy-left">
                        <p class="copyright">{{ date('Y') }} &copy; All Right Reserved By <a href="{{ route('home') }}"> {{ companyInfo()->company_name }}</a></p>
                    </div>
                </div>
                <div class="col col-lg-8 col-12">
                    <ul class="lower-footer-link">
                        <li><a href="index.html"><img src="{{ asset('frontend/assets/images/icon/payments.png') }}" alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end of site-footer-section -->

<div class="mobile-navigation">
    <ul>
        <li>
            <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
            <br>Home
        </li>
        <li>
            <a href="{{ route('shop') }}"><i class="fa-solid fa-shop"></i></a>
            <br>Shop
        </li>
        <li>
            <a href="javascript::" onclick="cartView();"><i class="fa-solid fa-cart-shopping"></i></a>
            <br>Bag <span style="background: #5D7B1A; width: 18px; height: 18px; font-size: 14px; color: white; position: absolute; border-radius: 50%; font-weight: 400; align-items: center; justify-content: center; margin-top: -34px; line-height: 18px;" class="itemCount3">0</span>
        </li>
        <li>
            <a href="{{ route('user.auth_customer.order.index') }}"><i class="fa-solid fa-file-lines"></i></a>
            <br>Orders
        </li>
        <li>
            <a href="javascript::" id="dropdownMenu2"><i class="fa-solid fa-list"></i></a>
            <br>Categories
            {{-- <div class="categories-shop-item">
                <ul id="metis-menu">
                    @foreach (categories() as $category)
                        <li class="header-categories-item">
                            <a class="menu-down-arrow2" href="{{ route('shop') }}?category={{ $category->id }}"><i class="icon-medicine"></i> {{ $category->category_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div> --}}
            <div class="mobile-navigation-category-dropdown-menu">
                @foreach (categories() as $category)
                    <a class="" href="{{ route('shop') }}?category={{ $category->id }}"><i class="icon-medicine"></i> {{ $category->category_name }}</a>
                @endforeach
            </div>
        </li>

    </ul>
</div>

<!-- modal-cart-view  -->
<div id="modal-cart-view" class="modal fade" tabindex="-1">
    <div class="modal-dialog cart-quickview">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                    class="icon-icon_close"></i></button>
            <div class="modal-body d-flex">
                <div class="product-details">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="product-single-img">
                                <div class="item">
                                    <img src="{{ asset('frontend/assets/images/product-details/1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-single-content">
                                <h5>Hand Sanitizer Alcohol GEL</h5>
                                <ul class="rating">
                                    <li><i class="icon-star" aria-hidden="true"></i></li>
                                    <li><i class="icon-star" aria-hidden="true"></i></li>
                                    <li><i class="icon-star" aria-hidden="true"></i></li>
                                    <li><i class="icon-star" aria-hidden="true"></i></li>
                                    <li><i class="icon-star" aria-hidden="true"></i></li>
                                </ul>
                                <h6>$541.88</h6>
                                <p>I have been a loyal customer of this auto parts company for years and I cannot.</p>
                                <div class="product-filter-item color">
                                    <div class="color-name">
                                        <span>Color :</span>
                                        <ul>
                                            <li class="color1"><input id="a1" type="radio" name="color"
                                                    value="30">
                                                <label for="a1"></label>
                                            </li>
                                            <li class="color2"><input id="a2" type="radio" name="color"
                                                    value="30">
                                                <label for="a2"></label>
                                            </li>
                                            <li class="color3"><input id="a3" type="radio" name="color"
                                                    value="30">
                                                <label for="a3"></label>
                                            </li>
                                            <li class="color4"><input id="a4" type="radio" name="color"
                                                    value="30">
                                                <label for="a4"></label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-filter-item color filter-size">
                                    <div class="color-name">
                                        <span>Size :</span>
                                        <ul>
                                            <li class="color"><input id="wa1" type="radio" name="size"
                                                    value="30">
                                                <label for="wa1">S</label>
                                            </li>
                                            <li class="color"><input id="wa2" type="radio" name="size"
                                                    value="30">
                                                <label for="wa2">M</label>
                                            </li>
                                            <li class="color"><input id="wa3" type="radio" name="size"
                                                    value="30">
                                                <label for="wa3">L</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="pro-single-btn">
                                    <b>Quantity : </b>
                                    <div class="quantity cart-plus-minus">
                                        <input type="text" value="1">
                                    </div>
                                    <a href="#" class="btn-style-1">Add to cart</a>
                                    <a href="wishlist.html"><i class="icon icon-heart"></i></a>
                                    <a href="compare.html"><i class="icon icon-svgexport-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal-cart-view -->
</div>
<style>
    .notice-img {
        text-align: center;
        border: 1px solid #ddd;
        margin-top: 10px;
        overflow: hidden;
    }
    .notice-text {
        border: 1px solid #ddd;
        margin-top: 4px;
        overflow: hidden;
    }

    .notice-img img {
        width: 100%;
        height: 100%;
        text-align: center;
    }

</style>




@if (Route::currentRouteName() != 'checkout.index')
    @include('layouts.frontend.add-card')
@endif

@push('js')
    <script>
        $('#dropdownMenu2').click(function (){
            $('.mobile-navigation-category-dropdown-menu').slideToggle('slow');

        });

    </script>
@endpush
