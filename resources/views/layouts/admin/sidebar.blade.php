@php
    $queryString = $_SERVER['QUERY_STRING'];
@endphp
<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{ route('admin.home') }}">
            <img src="{{ asset('uploads/system/').'/'.companyInfo()->admin_logo }}" class="header-brand-img desktop-lgo" alt="Admintro logo">
            <img src="{{ asset('uploads/system/').'/'.companyInfo()->admin_logo }}" class="header-brand-img dark-logo" alt="Admintro logo">
            <img src="{{ asset('uploads/system/').'/'.companyInfo()->admin_logo }}" class="header-brand-img mobile-logo" alt="Admintro logo">
            <img src="{{ asset('uploads/system/').'/'.companyInfo()->admin_logo }}" class="header-brand-img darkmobile-logo" alt="Admintro logo">
        </a>
    </div>
    <div class="app-sidebar__user">
        <div class="dropdown user-pro-body text-center">
            <div class="user-pic">
                <img src="assets/images/users/2.jpg" alt="user-img" class="avatar-xl rounded-circle mb-1">
            </div>
            <div class="user-info">
                <h5 class=" mb-1">Jessica <i class="ion-checkmark-circled  text-success fs-12"></i></h5>
                <span class="text-muted app-sidebar__user-name text-sm">Web Designer</span>
            </div>
        </div>
        <div class="sidebar-navs">
            <ul class="nav nav-pills-circle">
                <li class="nav-item" data-placement="top" data-toggle="tooltip" title="Support">
                    <a class="icon" href="javascript:;" >
                        <i class="las la-life-ring header-icons"></i>
                    </a>
                </li>
                <li class="nav-item" data-placement="top" data-toggle="tooltip" title="Documentation">
                    <a class="icon" href="javascript:;">
                        <i class="las  la-file-alt header-icons"></i>
                    </a>
                </li>
                <li class="nav-item" data-placement="top" data-toggle="tooltip" title="Projects">
                    <a href="javascript:;" class="icon">
                        <i class="las la-project-diagram header-icons"></i>
                    </a>
                </li>
                <li class="nav-item" data-placement="top" data-toggle="tooltip" title="Settins">
                    <a class="icon" href="javascript:;">
                        <i class="las la-cog header-icons"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <ul class="side-menu app-sidebar3">
        <li class="slide">
            <a class="side-menu__item"  href="{{ route('admin.home') }}">
            <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z"/></svg>
            <span class="side-menu__label">Dashboard</span><span class="badge badge-danger side-badge">Hot</span></a>
        </li>
        <li class="slide  {{ Request::is('admin/order/product*') ? 'menu-open' : '' }}">
            <a class="side-menu__item" data-toggle="slide" href="javascript:;">
            <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16.66 4.52l2.83 2.83-2.83 2.83-2.83-2.83 2.83-2.83M9 5v4H5V5h4m10 10v4h-4v-4h4M9 15v4H5v-4h4m7.66-13.31L11 7.34 16.66 13l5.66-5.66-5.66-5.65zM11 3H3v8h8V3zm10 10h-8v8h8v-8zm-10 0H3v8h8v-8z"/></svg>
            <span class="side-menu__label">Custom Orders</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ route('admin.order.index') }}" class="slide-item  {{ (($queryString != 'placed_orders') && ($queryString != 'logistic_orders') && ($queryString != 'deliverd_orders')  && ($queryString != 'rejected_orders')) ? 'active' : '' }}">Request Order</a></li>
                <li><a href="{{ route('admin.order.index') }}?placed_orders" class="slide-item  {{ ($queryString == 'placed_orders') ? 'active' : '' }}">Placed Order</a></li>
                <li><a href="{{ route('admin.order.index') }}?logistic_orders" class="slide-item  {{ ($queryString == 'logistic_orders') ? 'active' : '' }}">Process Order</a></li>
                <li><a href="{{ route('admin.order.index') }}?deliverd_orders" class="slide-item {{ ($queryString == 'deliverd_orders') ? 'active' : '' }}">Deliverd Order</a></li>
                <li><a href="{{ route('admin.order.index') }}?rejected_orders" class="slide-item  {{ ($queryString == 'rejected_orders') ? 'active' : '' }}">Rejected Order</a></li>
            </ul>
        </li>
        <li class="slide   {{ Request::is('admin/categories') ? 'menu-open' : '' }} {{ Request::is('admin/subcategory') ? 'menu-open' : '' }} {{ Request::is('admin/product*') ? 'menu-open' : '' }}  {{ Request::is('admin/package*') ? 'menu-open' : '' }}">
            <a class="side-menu__item" data-toggle="slide" href="javascript:;">
            <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16.66 4.52l2.83 2.83-2.83 2.83-2.83-2.83 2.83-2.83M9 5v4H5V5h4m10 10v4h-4v-4h4M9 15v4H5v-4h4m7.66-13.31L11 7.34 16.66 13l5.66-5.66-5.66-5.65zM11 3H3v8h8V3zm10 10h-8v8h8v-8zm-10 0H3v8h8v-8z"/></svg>
            <span class="side-menu__label">Products</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ route('admin.category.index') }}" class="slide-item   {{ Request::is('admin/categories') ? 'active' : '' }}">Categories</a></li>

                <li><a href="{{ route('admin.subcategory.index') }}" class="slide-item  {{ Request::is('admin/subcategory') ? 'active' : '' }}">Sub Category</a></li>

                <li><a href="{{ route('admin.product.create') }}" class="slide-item  {{ Request::is('admin/product/create') ? 'active' : '' }}">Add Product</a></li>

                <li><a href="{{ route('admin.product.index') }}" class="slide-item {{ Request::is('admin/product') ? 'active' : '' }}">Products</a></li>

                <li><a href="{{ route('admin.stock.create') }}" class="slide-item {{ Request::is('admin/stock/create') ? 'active' : '' }}">Add Stock</a></li>

                <li><a href="{{ route('admin.stock.index') }}" class="slide-item {{ Request::is('admin/stock') ? 'active' : '' }}">Stock</a></li>
            </ul>
        </li>
        <li class="slide  {{ Request::is('admin/transaction') ? 'menu-open' : '' }}">
            <a class="side-menu__item" data-toggle="slide" href="javascript:;">
            <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16.66 4.52l2.83 2.83-2.83 2.83-2.83-2.83 2.83-2.83M9 5v4H5V5h4m10 10v4h-4v-4h4M9 15v4H5v-4h4m7.66-13.31L11 7.34 16.66 13l5.66-5.66-5.66-5.65zM11 3H3v8h8V3zm10 10h-8v8h8v-8zm-10 0H3v8h8v-8z"/></svg>
            <span class="side-menu__label">Transection</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ route('admin.transaction.index') }}" class="slide-item {{ Request::is('admin/transaction') ? 'active' : '' }}">All Transections</a></li>
            </ul>
        </li>
        <li class="slide  {{ Request::is('admin/settings/company-info') ? 'menu-open' : '' }} {{ Request::is('admin/settings/home/home-page') ? 'menu-open' : '' }} ">
            <a class="side-menu__item" data-toggle="slide" href="javascript:;">
            <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16.66 4.52l2.83 2.83-2.83 2.83-2.83-2.83 2.83-2.83M9 5v4H5V5h4m10 10v4h-4v-4h4M9 15v4H5v-4h4m7.66-13.31L11 7.34 16.66 13l5.66-5.66-5.66-5.65zM11 3H3v8h8V3zm10 10h-8v8h8v-8zm-10 0H3v8h8v-8z"/></svg>
            <span class="side-menu__label">Settings</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ route('admin.settings.index') }}" class="slide-item {{ Request::is('admin/settings/company-info') ? 'active' : '' }}">Company Info</a></li>

                <li><a href="{{ route('admin.settings.home.index') }}" class="slide-item {{ Request::is('admin/settings/home/home-page') ? 'active' : '' }}">Page Settings</a></li>

                <li><a href="{{ route('admin.settings.notice.index') }}" class="slide-item {{ Request::is('admin/settings/notice/index') ? 'active' : '' }}">Notice</a></li>

            </ul>
        </li>
        <li class="slide {{ Request::is('admin/settings/country') ? 'menu-open' : '' }}  {{ Request::is('admin/settings/state') ? 'menu-open' : '' }}">
            <a class="side-menu__item" data-toggle="slide" href="javascript:;">
            <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16.66 4.52l2.83 2.83-2.83 2.83-2.83-2.83 2.83-2.83M9 5v4H5V5h4m10 10v4h-4v-4h4M9 15v4H5v-4h4m7.66-13.31L11 7.34 16.66 13l5.66-5.66-5.66-5.65zM11 3H3v8h8V3zm10 10h-8v8h8v-8zm-10 0H3v8h8v-8z"/></svg>
            <span class="side-menu__label">Country</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ route('admin.settings.division.index') }}" class="slide-item  {{ Request::is('admin/settings/division') ? 'active' : '' }}">Division</a></li>

                <li><a href="{{ route('admin.settings.district.index') }}" class="slide-item {{ Request::is('admin/settings/district') ? 'active' : '' }}">District</a></li>

                <li><a href="{{ route('admin.settings.upzila.index') }}" class="slide-item {{ Request::is('admin/settings/upzila') ? 'active' : '' }}">Upazila</a></li>

                <li><a href="{{ route('admin.settings.union.index') }}" class="slide-item {{ Request::is('admin/settings/union') ? 'active' : '' }}">Union</a></li>

                <li><a href="{{ route('admin.settings.state.index') }}" class="slide-item  {{ Request::is('admin/settings/state') ? 'active' : '' }}">State</a></li>

            </ul>
        </li>
        <li class="slide">

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <a type="button" class="nav-link" href="{{ route('admin.logout') }}"onclick="event.preventDefault();this.closest('form').submit();"> <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16.66 4.52l2.83 2.83-2.83 2.83-2.83-2.83 2.83-2.83M9 5v4H5V5h4m10 10v4h-4v-4h4M9 15v4H5v-4h4m7.66-13.31L11 7.34 16.66 13l5.66-5.66-5.66-5.65zM11 3H3v8h8V3zm10 10h-8v8h8v-8zm-10 0H3v8h8v-8z"/></svg> <p> Logout </p></a>
            </form>

        </li>
    </ul>
</aside>
