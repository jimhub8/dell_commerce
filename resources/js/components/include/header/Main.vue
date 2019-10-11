<template>
<div>
    <div class="container-menu-header-v2 p-t-26">
        <div class="topbar2" style="margin-top: -26px;padding-bottom: 20px;">
            <div class="topbar-social">
                <a href="https://www.facebook.com/DellmatGroup" target="_blank" class="topbar-social-item fa fa-facebook"></a>
                <!-- <a href="#" class="topbar-social-item fa fa-instagram"></a>
                <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                <a href="#" class="topbar-social-item fa fa-youtube-play"></a> -->
            </div>
            <br>
            <hr>

            <!-- Logo2 -->
            <router-link to="/" class="logo2">
                <img src="/storage/logo/delmat1.jpg" alt="Delmat" style="height: 50px !important;">
                </router-link>

                <div class="topbar-child2">
                    <span class="topbar-email">info@dellmat.com</span>

                    <div class="topbar-language rs1-select2">
                        <select class="selection-1" name="time">
                            <option>KSH</option>
                        </select>
                    </div>
                    <a href="/client/login" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;" >Become a seller</a>
                    <!--  -->
                    <!-- <a href="/client/login" class="header-wrapicon1 dis-block m-l-30" v-if="user">
              <img src="/storage/icons/icon-header-01.png" class="header-icon1" alt="ICON">
            </a> -->
                    <Logout :user="user" v-if="user"></Logout>

                    <a href="/client/login" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;" v-else>Login</a>

                    <span class="linedivide1"></span>

                    <div class="header-wrapicon2 m-r-13">
                        <img
                src="/storage/icons/cart.png"
                class="header-icon1 js-show-header-dropdown"
                alt="ICON"
              >
                        <span class="header-icons-noti">{{ cartItems.length }}</span>

                        <!-- Header cart noti -->
                        <myCart></myCart>
                    </div>
                    <div class="header-wrapicon2 m-r-13">
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

        <div class="flex-c-m size22 s-text21 pos-relative" style="background:#f0f0f0;">
            <div class="after col-md-3" @mouseleave="menuShow = false">
                <v-btn flat color="info" @click="catShow = !catShow">Categories</v-btn>
                <div class="row" style="z-index: 1000;position: absolute;background:transparent" v-show="catShow">
                    <div class="col-2" style="min-width: 300px;max-width: 300px;margin-left: -5vw;background: #eee;">
                        <div class="list-group" id="list-tab" role="tablist" style="text-align: right;">
                            <li style="color: #000; padding: 5px;" id="list-home-list" data-toggle="list" role="tab" aria-controls="home" v-for="(item, index) in menus" :key="index" @mouseover="showMenu(item)">{{ item.name }} </li>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8 col-sm-8" style="overflow-y: scroll ;border: 1px solid #00000038;background: #fff;max-height: 80vh;">
                        <div class="tab-content" id="nav-tabContent" v-show="menuShow" style="background: #fff;">
                            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                <div class="row wrap">
                                    <div class="card-columns col-md-10">
                                        <div class="card" v-for="(category, index) in categories" :key="index" style="border: none; width: 300px; margin-right: 100px;">
                                            <div class="card-body" style="padding: 0;" id="category">
                                                <li class="active" @click="gotoCat(category.id)">{{ category.name }}</li>
                                                <li class="card-text" v-for="subcat in category.sub_categories" :key="subcat.id" @click="gotoSub(subcat.id)">{{ subcat.name }}</li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <v-layout wrap>
                <v-flex sm5 class="form-group" style="margin-top: 10px">
                    <!-- <v-text-field v-model="form.search" color="blue darken-2" label="Menu Name" required></v-text-field> -->
                    <input type="text" class="form-control" placeholder="Search..." v-model="search" @keyup.enter="productSearch">
            </v-flex>
                    <v-flex sm2 style="margin-top: 5px">
                        <v-tooltip bottom>
                            <v-btn slot="activator" icon class="mx-0" @click="productSearch">
                                <v-icon small color="primary darken-2">search</v-icon>
                            </v-btn>
                            <span>Search</span>
                        </v-tooltip>
                    </v-flex>
            </v-layout>
        </div>

        <div class="wrap_header">

            <!-- Main Menu -->
            <div class="wrap_menu" id="header1">
                <nav class="menu">
                    <ul class="main_menu">
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

            <!-- Header Icon -->
            <div class="header-icons"></div>
        </div>
    </div>

</div>
</template>
