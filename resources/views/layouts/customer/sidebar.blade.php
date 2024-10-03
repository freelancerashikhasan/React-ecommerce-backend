@php
    $queryString = $_SERVER['QUERY_STRING'];
@endphp
<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="{{ (Auth::user()->image != null) ? asset('uploads/user/profile/'.Auth::user()->image) : defaultImg(Auth::user()->gender) }}"  width="60px" height="60px" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">{{ Auth::user()->name }}<i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="{{ route('user.customer.profile.index') }}"><i class="ti-user"></i>Profile</a>
                        {{-- <a href="#!"><i class="ti-settings"></i>Settings</a> --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="ti-layout-sidebar-left"></i> {{ __('Log Out') }}
                            </a>
                        </form>
                        {{-- <a href="auth-normal-sign-in.html"><i
                                class="ti-layout-sidebar-left"></i>Logout</a> --}}
                    </li>
                </ul>
            </div>
        </div>
        {{-- <div class="p-15 p-b-0">
            <form class="form-material">
                <div class="form-group form-primary">
                    <input type="text" name="footer-email" class="form-control"
                        required="">
                    <span class="form-bar"></span>
                    <label class="float-label"><i class="fa fa-search m-r-10"></i>Search
                        Friend</label>
                </div>
            </form>
        </div> --}}

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Dashboard</div>
        <ul class="pcoded-item pcoded-left-item">
            {{-- <li class="active">
                <a href="{{ route('shop') }}" class="waves-effect waves-dark mb-2">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Go Shop</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li> --}}
            <li class="active">
                <a href="{{ route('user.customer.home') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>


        @if (Auth::user()->rank != false)
            @if (Auth::user()->rank->rankInfo->id != 6)
                <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Users</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu {{ Request::is('user/clients*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="fa fa-user-o"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Users</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{ Request::is('user/clients/create')  ? 'active' : '' }}">
                                <a href="{{ route('user.customer.client.create') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">User Registration</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{ Request::is('user/clients')  ? 'active' : '' }}">
                                <a href="{{ route('user.customer.client.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">User List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endif
        @endif

        {{-- <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Merchant Data Entry</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/marchant/data*')  ? 'active pcoded-trigger' : '' }} {{ Request::is('user/marchant/team/with/data*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-database"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">With Trade License</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('user/marchant/data/create')  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.marchant.data.create') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Data Entry</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="pcoded-hasmenu {{ Request::is('user/marchant/data')  ? 'active' : '' }}">

                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="fa fa-database"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Pending Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu" style="margin: auto;">
                            <li class="">
                                <a href="{{ route('user.customer.marchant.data.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">With QR Code</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('user.customer.marchant.data.index') }}?without_qr_code" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Without QR Code</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ (Request::is('user/marchant/data'.'?approved'))  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.marchant.data.index') }}?approved" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Approved Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="pcoded-hasmenu {{ Request::is('user/marchant/team/with/data')  ? 'active' : '' }}">

                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="fa fa-database"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Team Pending Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu" style="margin: auto;">
                            <li class="">
                                <a href="{{ route('user.customer.marchant.team.with.data.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">With QR Code</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('user.customer.marchant.team.with.data.index') }}?without_qr_code" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Without QR Code</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ (Request::is('user/marchant/team/with/data'.'?approved'))  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.marchant.team.with.data.index') }}?approved" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Team Approved Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu {{ Request::is('user/marchant/without/data*')  ? 'active pcoded-trigger' : '' }} {{ Request::is('user/marchant/team/without/data*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-database"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Without Trade License</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('user/marchant/without/data/create')  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.marchant.without.data.create') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Data Entry</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="pcoded-hasmenu {{ Request::is('user/marchant/without/data')  ? 'active' : '' }}">

                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="fa fa-database"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Pending Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu" style="margin: auto;">
                            <li class="">
                                <a href="{{ route('user.customer.marchant.without.data.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">With QR Code</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('user.customer.marchant.without.data.index') }}?without_qr_code" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Without QR Code</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ (Request::is('user/marchant/without/data'.'?approved'))  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.marchant.without.data.index') }}?approved" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Approved Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <li class="pcoded-hasmenu {{ Request::is('user/marchant/team/without/data')  ? 'active' : '' }}">

                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="fa fa-database"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Team Pending Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu" style="margin: auto;">
                            <li class="">
                                <a href="{{ route('user.customer.marchant.team.without.data.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">With QR Code</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('user.customer.marchant.team.without.data.index') }}?without_qr_code" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Without QR Code</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="{{ (Request::is('user/marchant/team/without/data'.'?approved'))  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.marchant.team.without.data.index') }}?approved" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Team Approved Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul> --}}

        @if (Auth::user()->rank->rank_id != 6)
            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Refer</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu {{ Request::is('user/customer/refer*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-share-alt-square"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">My Teams</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ Request::is('user/customer/refer')  ? 'active' : '' }}">
                            <a href="{{ route('user.customer.refer.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Refer List</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        @if (Auth::user()->rank->rank_id != 6)
                            <li class="{{ Request::is('user/customer/refer/team/count')  ? 'active' : '' }}">
                                <a href="{{ route('user.customer.refer.team.count') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Team User Count</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        @endif
                        {{-- <li class="{{ Request::is('user/customer/refer/team/sales')  ? 'active' : '' }}">
                            <a href="{{ route('user.customer.refer.team.sales') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Team User Sales</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li> --}}

                    </ul>
                </li>
            </ul>
        @endif

        {{-- <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Orders</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/customer/order*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">My Orders</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ ($queryString != 'deliverd') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.order.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'deliverd') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.order.index') }}?deliverd" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Deliverd Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul> --}}

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Reports</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/customer/reports*')  ? 'active pcoded-trigger' : '' }} {{ Request::is('user/customer/reports/entry-reports')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Commission Reports</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('user/customer/reports*')  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.reports.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">All Commissions</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('user/customer/reports*')  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.reports.index') }}?customer" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Customer Purchase Commissions</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    @if (Auth::user()->rank->rank_id != 6)
                        <li class="{{ Request::is('user/customer/reports*')  ? 'active' : '' }}">
                            <a href="{{ route('user.customer.reports.index') }}?pharmacy" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Pharmacy Purchase Commissions</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                    @endif

                </ul>
            </li>
            @if (Auth::user()->rank->rank_id != 6)
                {{-- <li class="pcoded-hasmenu {{ Request::is('user/customer/reports/entry-reports')  ? 'active' : '' }}" >
                    <a href="{{ route('user.customer.reports.team.entry.reports') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Team Entry Reports</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li> --}}
            @endif
        </ul>

        @if ((Auth::user()->with_trade_permission == App\Helpers\Constant::DATA_APPROVAL_PERMISSION_WITH_LICENSE['yes']) || (Auth::user()->without_trade_permission == App\Helpers\Constant::DATA_APPROVAL_PERMISSION_WITHOUT_LICENSE['yes']) || (Auth::user()->user_approval_per == App\Helpers\Constant::USER_APPROVAL_PERMISSION['yes']))
            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Permited Role</div>
            <ul class="pcoded-item pcoded-left-item">
                @if (Auth::user()->user_approval_per == App\Helpers\Constant::USER_APPROVAL_PERMISSION['yes'])
                    <li class="pcoded-hasmenu {{ Request::is('user/permited/user')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="fa fa-user-o"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Team Users</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="{{ route('user.customer.permited.user.approval_index') }}?all" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">All User List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('user.customer.permited.user.approval_index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Non-Approved User List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('user.customer.permited.user.approval_index') }}?approved_list" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Approved User List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->with_trade_permission == App\Helpers\Constant::DATA_APPROVAL_PERMISSION_WITH_LICENSE['yes'])
                    <li class="pcoded-hasmenu {{ Request::is('user/permited/merchant/data')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="fa fa-database"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">With Trade License</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{ Request::is('user/permited/merchant/data')  ? 'active' : '' }}">
                                <a href="{{ route('user.customer.permited.merchant.data.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">With QR Data</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{ Request::is('user/permited/merchant/data')  ? 'active' : '' }}">
                                <a href="{{ route('user.customer.permited.merchant.data.index') }}?qr_not_submited" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Without QR Data</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->without_trade_permission == App\Helpers\Constant::DATA_APPROVAL_PERMISSION_WITHOUT_LICENSE['yes'])
                    <li class="pcoded-hasmenu {{ Request::is('user/permited/merchant/data/without-trade-license')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="fa fa-database"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Without Trade License</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{ Request::is('user/permited/merchant/data/without-trade-license')  ? 'active' : '' }}">
                                <a href="{{ route('user.customer.permited.merchant.data.without.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">With QR Data</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{ Request::is('user/permited/merchant/data/without-trade-license')  ? 'active' : '' }}">
                                <a href="{{ route('user.customer.permited.merchant.data.without.index') }}?qr_not_submited" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Without QR Data</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        @endif

        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Finance
        </div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu  {{ Request::is('user/customer/withdraw*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">My Withdraw</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('user/customer/withdraw/create') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.withdraw.create') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Withdraw Now</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ (($queryString != 'approved_list') && $queryString != 'rejected_list') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.withdraw.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Pending Withdraw</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'approved_list') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.withdraw.index') }}?approved_list" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Approved Withdraw</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <li class="{{ ($queryString == 'rejected_list') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.withdraw.index') }}?rejected_list" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Rejected Withdraw</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li style="padding: 6px 28px;" class="pcoded-hasmenu  {{ Request::is('user/customer/withdraw*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="waves-effect waves-dark">
                        {{-- <i class="ti-layout-sidebar-left"></i> --}}
                        <span class="pcoded-micon"><i class="fa fa-sign-out"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">{{ __('Log Out') }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </form>
            </li>
        </ul>

    </div>
</nav>
