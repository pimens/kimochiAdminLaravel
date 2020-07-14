<!-- HEADER DESKTOP-->
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="#">
                    <img height='50' width='50' src="{{ asset('assets/images/logo.jpg') }}" alt="John Doe" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="{{ Request()->is('makanan')? 'active' : '' }}">
                        <a href="/makanan">
                            <i class="fas fa-trophy"></i>
                            <span class="bot-line"></span>Beranda</a>
                    </li>
                    <li class="{{ Request()->is('cabang')? 'active' : '' }}">
                        <a href="/cabang">
                            <i class="fas fa-shopping-basket"></i>
                            <span class="bot-line"></span>Cabang</a>
                    </li>
                    <li class="{{ Request()->is('promo')? 'active' : '' }}">
                        <a href="/promo">
                            <i class="fas fa-shopping-basket"></i>
                            <span class="bot-line"></span>Promo</a>
                    </li>
                </ul>
            </div>
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="{{ asset('assets/images/logo.jpg') }}" alt="John Doe" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#"> john doe</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/logo.jpg') }}" alt="John Doe" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#">Admin Kimochi</a>
                                    </h5>
                                    <span class="email">admin@gmail.com</span>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="/logout">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER DESKTOP-->

<!-- HEADER MOBILE-->
<header class="header-mobile header-mobile-2 d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img height='50' width='50' src="{{ asset('assets/images/logo.jpg') }}" alt="John Doe" />

                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a href="#">
                        <i class="fas fa-shopping-basket"></i>
                        <span class="bot-line"></span>eCommerce</a>
                </li>
                <li>
                    <a href="table.html">
                        <i class="fas fa-trophy"></i>
                        <span class="bot-line"></span>Features</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="sub-header-mobile-2 d-block d-lg-none">
    <div class="header__tool">
        <div class="header-button-item has-noti js-item-menu">
            <i class="zmdi zmdi-notifications"></i>
        </div>
        <div class="header-button-item js-item-menu">
            <i class="zmdi zmdi-settings"></i>
        </div>
        <div class="account-wrap">
            <div class="account-item account-item--style2 clearfix js-item-menu">
                <div class="image">
                    <img src="{{ asset('assets/images/icon/avatar-01.jpg') }}" alt="John Doe" />

                </div>
                <div class="content">
                    <a class="js-acc-btn" href="#">AdminKimochi</a>
                </div>
                <div class="account-dropdown js-dropdown">
                    <div class="info clearfix">
                        <div class="image">
                            <a href="#">
                                <img src="{{ asset('assets/images/icon/avatar-01.jpg') }}" alt="John Doe" />
                            </a>
                        </div>
                        <div class="content">
                            <h5 class="name">
                                <a href="#">AdminKimochi</a>
                            </h5>
                            <span class="email">admin@gmail.com</span>
                        </div>
                    </div>
                    <div class="account-dropdown__footer">
                        <a href="/logout">
                            <i class="zmdi zmdi-power"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!-- END HEADER MOBILE -->