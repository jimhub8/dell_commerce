<template>
<div>
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="index.html" class="logo-mobile">
            <img src="/storage/logo/delmat1.jpg" alt="Delmat" style="max-width: 100px;">
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                <!-- <a href="/login" class="header-wrapicon1 dis-block" v-if="user">
              <img src="/storage/icons/icon-header-01.png" class="header-icon1" alt="ICON">
            </a> -->
                <a href="/login" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;">Become a seller</a>
                <Logout :user="user" v-if="user"></Logout>

                <a href="/login" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;" v-else>Login</a>

                <span class="linedivide2"></span>

                <div class="header-wrapicon2">
                    <img src="/storage/icons/cart.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{ cartItems.length }}</span>

                    <!-- Header cart noti -->
                    <myCart></myCart>
                </div>
                <span class="linedivide2"></span>
                <div class="header-wrapicon2">
                    <img src="/storage/icons/wish.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{ wishItems.length }}</span>

                    <!-- Header cart noti -->
                    <myWish></myWish>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu">
        <nav class="side-menu">
            <ul class="main-menu">
                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <span class="topbar-child1">Free shipping for standard order over Ksh1000</span>
                </li>

                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <div class="topbar-child2-mobile">
                        <span class="topbar-email">info@dellmat.com</span>

                        <div class="topbar-language rs1-select2">
                            <select class="selection-1" name="time">
                                <option>KSH</option>
                            </select>
                        </div>
                    </div>
                </li>

                <li class="item-topbar-mobile p-l-10">
                    <div class="topbar-social-mobile">
                        <a href="https://www.facebook.com/DellmatGroup" target="_blank" class="topbar-social-item fa fa-facebook"></a>
                        <!-- <a href="#" class="topbar-social-item fa fa-instagram"></a>
                            <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                            <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                            <a href="#" class="topbar-social-item fa fa-youtube-play"></a> -->
                    </div>
                </li>

                <li>
                    <router-link @click.native="progressBar" to="/" style="color: #333">Home</router-link>
                </li>

                <li>
                    <router-link @click.native="progressBar" to="/shop" style="color: #333">Shop</router-link>
                </li>

                <li>
                    <router-link @click.native="progressBar" to="/cartHome" style="color: #333">Cart</router-link>
                </li>
                <li>
                    <router-link @click.native="progressBar" to="/about" style="color: #333">About</router-link>
                </li>
            </ul>
        </nav>
    </div>

</div>
</template>
