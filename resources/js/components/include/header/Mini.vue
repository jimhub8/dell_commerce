<template>
    <div>
        <div class="wrap_menu" id="header2">
                    <nav class="menu">
                        <ul class="main_menu" style="background: #fff;">
                            <li>
                                <router-link @click.native="progressBar" to="/">Home</router-link>
                            </li>

                            <li>
                                <router-link @click.native="progressBar" to="/shop">Shop</router-link>
                            </li>

                            <li>
                                <router-link @click.native="progressBar" to="/cartHome">Cart</router-link>
                            </li>

                            <li>
                                <router-link @click.native="progressBar" to="/about">About Us</router-link>
                            </li>

                        </ul>
                    </nav>
                </div>

                <div class="header-icons">
                    <!-- <a href="/login" class="header-wrapicon1 dis-block" v-if="user">
            <img src="/storage/icons/icon-header-01.png" class="header-icon1" alt="ICON">
          </a> -->
                    <!-- <a href="/login" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;" >Become a seller</a> -->
                    <Logout :user="user" v-if="user"></Logout>

                    <v-btn href="/login" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;" v-else>Login</v-btn>

                    <span class="linedivide1"></span>

                    <div class="header-wrapicon2">
                        <img
              src="/storage/icons/cart.png"
              class="header-icon1 js-show-header-dropdown"
              alt="ICON"
            >
                        <span class="header-icons-noti">{{ cartItems.length }}</span>

                        <!-- Header cart noti -->
                        <myCart></myCart>
                    </div>
                    <span class="linedivide2"></span>
                    <div class="header-wrapicon2">
                        <img
              src="/storage/icons/wish.png"
              class="header-icon1 js-show-header-dropdown"
              alt="ICON"
            >
                        <span class="header-icons-noti">{{ wishItems.length }}</span>

                        <!-- Header cart noti -->
                        <myWish></myWish>
                    </div>
                </div>
        </div>
    </div>
</template>
