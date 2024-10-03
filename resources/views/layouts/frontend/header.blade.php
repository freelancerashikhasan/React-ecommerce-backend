<!-- start header -->
{{-- <div class="discount-bar">
    <div class="container">
        <div class="discount-text">
            <p><span>30%</span> discount all products spatial for December</p>
            <div class="discount-close">
                <i class="icon-icon_close"></i>
            </div>
        </div>
    </div>
</div> --}}
{{-- <div class="topbar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col col-lg-3 col-md-12 col-12">
                <div class="contact-link">
                    <ul>
                        <li><a href="#">Quick Help</a></li>
                        <li><a href="#">Order Tracking</a></li>
                        <li><a href="wishlist.html">Wishlist</a></li>
                    </ul>
                </div>
            </div>
            <div class="col col-lg-6 col-md-12 col-12">
                <div class="help-link">
                    <p>Need help? Call us: <a href="tel:+4065550120">(+800) 1234 5678 90</a> or
                        info@company.com</p>
                </div>
            </div>
            <div class="col col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="topbar-select">
                    <ul class="topbar-select-wrap">
                        <li>
                            <select class="select">
                                <option>English</option>
                                <option>Spanish</option>
                                <option>Hindi</option>
                                <option>Bangla</option>
                            </select>
                        </li>
                        <li>
                            <select class="select">
                                <option>USD</option>
                                <option>Euro</option>
                                <option>Rupi</option>
                                <option>Crypto</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<style>
    ul.account-menu-sub-menu {
        position: absolute;
        padding: 10px;
        text-align: left;
        margin-top: 12px;
        border-radius: 4px;
        height: auto;
        background: #fff;
        z-index: 999;
        min-width: 175px;
        min-width: 175px;
        display: none;
    }

    ul.account-menu-sub-menu.show{
        display: block;
    }

    ul.account-menu-sub-menu li {
        padding: 3px;
        height: 35px;
    }

    ul.account-menu-sub-menu li a {
        padding: 6px 6px;
        float: left;
        color: #535a6b;
        transition: 0.3s;
    }
    ul.account-menu-sub-menu li a:hover , ul.account-menu-sub-menu li a.active{
        color: #5d7b1a;
    }
</style>
<header class="header-area header-style-1">
    <!--  start header-middle -->
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ asset('uploads/system/') . '/' . companyInfo()->website_logo }}" alt="{{ companyInfo()->company_name }}" width="200px">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <form action="#" class="middle-box">
                        <div class="category">
                            <select name="service" class="form-control select">
                                <option disabled="disabled" selected="">categorys</option>
                                @foreach (categories() as $category)
                                    <option>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="search-box">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Search Products">
                                <button class="search-btn" type="submit"> <i><img src="{{ asset('frontend/assets/images/icon/search.png') }}" alt=""></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="middle-right">
                        <ul>
                            {{-- <li><a href="wishlist.html"><i class="icon-heart"><span
                                            class="cart-count">2</span></i></a></li> --}}
                            {{-- <li><a href="compare.html"><i class="icon-left-and-right-arrows-1"></i></a></li> --}}
                            <li class="cart-btn">
                                <a href="javascript::" onclick="cartView();">
                                    <i class="icon-cart"><span class="cart-count itemCount">2</span></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  end header-middle -->
    <!-- end topbar -->
    <div id="header-sticky" class="menu-area">
        <div class="container">
            <div class="second-menu">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-7 col-sm-5 col-3">
                        <div class="navbar-header navbar-header-for-mediam-device">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img src="{{ asset('uploads/system/') . '/' . companyInfo()->website_logo }}" alt="{{ companyInfo()->company_name }}" width="100px">
                            </a>
                        </div>
                        <div class="header-category-item">
                            <button class="header-category-toggle-btn"><span>Browse Categorys</span> </button>
                            <div class="category-shop-item">
                                <ul id="metis-menu">
                                    @foreach (categories() as $category)
                                        @if (subcategories($category->id) != true)
                                            <li>
                                                <a style="padding: 7px;" href="{{ route('shop') }}?category={{ $category->id }}">
                                                    @if ($category->image != null)
                                                        <img style="width: 30px; margin-right: 4px; height: 30px;" src="{{ asset('uploads/category/'.$category->image) }}" alt="{{ $category->category_name }}">
                                                    @else
                                                        <i class="icon-mask-1"></i>
                                                    @endif
                                                    {{ $category->category_name }}</a>
                                            </li>
                                        @else
                                            <li class="header-catagory-item">
                                                <a style="padding: 7px;" class="menu-down-arrow" href="{{ route('shop') }}?category={{ $category->id }}">
                                                @if ($category->image != null)
                                                    <img style="width: 30px; margin-right: 4px; height: 30px;" src="{{ asset('uploads/category/'.$category->image) }}" alt="{{ $category->category_name }}">
                                                @else
                                                    <i class="icon-medicine"></i>
                                                @endif

                                                {{ $category->category_name }}</a>

                                                <ul class="header-catagory-single">
                                                    @foreach (subcategories($category->id) as $subcategory)
                                                        <li><a href="{{ route('shop') }}?category={{ $category->id }}">{{ $subcategory->subcategory }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-1 col-1 text-right text-xl-right">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul class="nav">
                                    <li class="">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class=""><a href="{{ route('shop') }}">Shop</a>

                                    </li>
                                    <li class="has-submenu"><a href="javascript::">About Us</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Company Profile</a></li>
                                            <li class="third-lavel-menu"><a href="javascript::">Legal Paper</a>
                                                <ul class="sub-menu">
                                                    <li><a href="#">Certificate of Incorporation</a> </li>
                                                    <li><a href="#">Trade License</a> </li>
                                                    <li><a href="#">Tin Certificate</a> </li>
                                                </ul>
                                            </li>
                                            <li class="third-lavel-menu"><a href="javascript::">Founders</a>
                                                <ul class="sub-menu">
                                                    <li><a href="#">Chairman Messages</a> </li>
                                                    <li><a href="#">Managing Director Messages</a> </li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Our Mission</a></li>
                                            <li><a href="#">Our Vision</a></li>
                                            <li><a href="#">Advisor Panel</a></li>
                                            <li><a href="#">Future Plan of Organization</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="javascript::">Our History</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Success Stories </a></li>
                                            <li><a href="#">Photo Gallery </a></li>
                                            <li><a href="#">Video Gallery </a></li>
                                        </ul>
                                    </li>
                                    {{-- <li><a href="#">Sister Concern</a></li> --}}
                                    <li><a href="{{ route('contact_us') }}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 text-left">
                        <div class="header-area-right">
                            <div class="profile">
                                @auth
                                    <a href="javascript::" class="account-menu">
                                        <i class="icon-user-1"></i>
                                        <span>
                                            <small>My Account</small>
                                            <span>Hello, {{ auth()->user()->name }} </span>
                                        </span>
                                    </a>
                                    <ul class="account-menu-sub-menu shadow">
                                        <li><a class="{{ (Route::currentRouteName() == 'user.auth_customer.home') ? 'active' : '' }}" href="{{ route('user.auth_customer.home') }}">Dashboard</a></li>

                                        <li><a class="{{ (Route::currentRouteName() == 'user.auth_customer.profile.myProfile') ? 'active' : '' }}" href="{{ route('user.auth_customer.profile.myProfile') }}">My Profile</a></li>

                                        <li><a class="{{ (Route::currentRouteName() == 'user.auth_customer.profile.change_password') ? 'active' : '' }}" href="{{ route('user.auth_customer.profile.change_password') }}">Change Password</a></li>


                                        <li><a class="{{ (Route::currentRouteName() == 'user.auth_customer.order.index') ? 'active' : '' }}" href="{{ route('user.auth_customer.order.index') }}">My Orders</a></li>

                                        <li><a class="{{ (Route::currentRouteName() == 'user.auth_customer.order.canceledOrders') ? 'active' : '' }}" href="{{ route('user.auth_customer.order.canceledOrders') }}">Cancellation</a></li>


                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a style="padding-left: 0px; margin-left: -2px;" class="text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    <i class="ti-layout-sidebar-left"></i> {{ __('Log Out') }}
                                                </a>
                                            </form>
                                        </li>

                                    </ul>
                                @else
                                    <a href="{{ route('login') }}">
                                        <i class="icon-user-1"></i>
                                        <span>
                                            <small>My Account</small>
                                            <span>Login / Register</span>
                                        </span>
                                    </a>
                                @endauth

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end of header -->
@push('js')
    <script>
        $('.account-menu').click(function(){
            $('.account-menu-sub-menu').toggle('show');
        });
    </script>
@endpush
