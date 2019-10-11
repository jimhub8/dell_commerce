<template>
<v-app id="inspire" v-scroll="onScroll">
    <vue-topprogress ref="topProgress"></vue-topprogress>
    <!-- <v-app id="inspire"> -->
    <header class="header2" id="headerq">
        <!-- Header desktop -->
        <div class="wrap_header fixed-header2 trans-0-4">
            <!-- Logo -->
            <router-link @click.native="progressBar" to="/" class="logo">
                <img src="/storage/delmat.jpg" alt="Delmat">
            </router-link>
            <div class="flex-c-m size22 s-text21 pos-relative" style="background:#f0f0f0;">
                <div class="after col-md-3" @mouseleave="menuShow = false">
                    <v-btn flat color="info" @click="catShow = !catShow">Categories</v-btn>
                    <div class="row" style="z-index: 1000;position: absolute;background:transparant" v-show="catShow">
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
            <!-- Mini Menu Start -->
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

                        <!-- <li>
                                <router-link @click.native="progressBar" to="/about">About Us</router-link>
                            </li> -->

                    </ul>
                </nav>
            </div>

            <div class="header-icons">
                <!-- <a href="/login" class="header-wrapicon1 dis-block" v-if="user">
            <img src="/storage/icons/icon-header-01.png" class="header-icon1" alt="ICON">
          </a> -->
                <a href="/vendors" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;">Become a seller</a>
                <Logout :user="user" v-if="user"></Logout>

                <v-btn href="/login" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;" v-else>Login</v-btn>

                <span class="linedivide1"></span>

                <div class="header-wrapicon2">
                    <img src="/storage/icons/cart.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{ cartItems }}</span>

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
        </div>
        <!-- Mini Menu Start End -->

        <!-- Big navigation Start -->
        <div class="container-menu-header-v2 p-t-26">
            <div class="topbar2" style="margin-top: -26px;padding-bottom: 20px;">
                <div class="topbar-social">
                    <a href="https://www.facebook.com/DellmatGroup" target="_blank" class="topbar-social-item fa fa-facebook"></a>
                    <!-- <a href="#" class="topbar-social-item fa fa-facebook"></a>
                    <a href="#" class="topbar-social-item fa fa-instagram"></a>
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

                    <!--  -->
                    <!-- <a href="/login" class="header-wrapicon1 dis-block m-l-30" v-if="user">
              <img src="/storage/icons/icon-header-01.png" class="header-icon1" alt="ICON">
            </a> -->
                    <a href="/vendors" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;">Become a seller</a>
                    <Logout :user="user" v-if="user"></Logout>

                    <a href="/login" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;" v-else>Login</a>

                    <span class="linedivide1"></span>

                    <div class="header-wrapicon2 m-r-13">
                        <img src="/storage/icons/cart.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">{{ cartItems }}</span>

                        <!-- Header cart noti -->
                        <myCart></myCart>
                    </div>
                    <div class="header-wrapicon2 m-r-13">
                        <img src="/storage/icons/wish.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
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

                            <!-- <li>
                                <router-link @click.native="progressBar" to="/about">About Us</router-link>
                            </li> -->
                        </ul>
                    </nav>
                </div>

                <!-- Header Icon -->
                <div class="header-icons"></div>
            </div>
        </div>
        <!-- Big navigation End -->

        <!-- Header Mobile -->
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
                    <a href="/vendors" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;">Become a seller</a>
                    <Logout :user="user" v-if="user"></Logout>

                    <a href="/login" class="v-btn v-btn--flat theme--light primary--text" style="text-decoration: none;" v-else>Login</a>

                    <span class="linedivide2"></span>

                    <div class="header-wrapicon2">
                        <img src="/storage/icons/cart.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">{{ cartItems }}</span>

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
                            <!-- <a href="#" class="topbar-social-item fa fa-facebook"></a>
                            <a href="#" class="topbar-social-item fa fa-instagram"></a>
                            <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                            <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                            <a href="#" class="topbar-social-item fa fa-youtube-play"></a> -->
                        </div>
                    </li>

                    <li>
                        <router-link @click.native="progressBar" to="/" style="color: #333">Home</router-link>
                        <!-- <a href="index.html">Home</a> -->
                        <!-- <ul class="sub_menu">
                <li>
                  <a href="index.html">Homepage V1</a>
                </li>
                <li>
                  <a href="home-02.html">Homepage V2</a>
                </li>
                <li>
                  <a href="home-03.html">Homepage V3</a>
                </li>
              </ul>-->
                    </li>

                    <li>
                        <router-link @click.native="progressBar" to="/shop" style="color: #333">Shop</router-link>
                    </li>

                    <li>
                        <router-link @click.native="progressBar" to="/cartHome" style="color: #333">Cart</router-link>
                    </li>
                    <!-- <li>
                        <router-link @click.native="progressBar" to="/about" style="color: #333">About</router-link>
                    </li> -->
                </ul>
            </nav>
        </div>
        <!-- Menu Mobile -->

    </header>
    <v-fab-transition v-if="offsetTop >= 400">
        <v-btn color="pink" v-scroll-to="'#headerq'" dark fab fixed bottom left ref="button">
            <v-icon>keyboard_arrow_up</v-icon>
        </v-btn>
    </v-fab-transition>
    <v-snackbar :timeout="timeout" :bottom="y === 'bottom'" :color="Scolor" :left="x === 'left'" v-model="snackbar">
        {{ message }}
        <v-icon dark right>check_circle</v-icon>
    </v-snackbar>
</v-app>
</template>

<script>
import * as easings from "vuetify/es5/util/easing-patterns";
// vuetify/es5/Vuetify/goTo/easing-patterns
import {
    vueTopprogress
} from "vue-top-progress";
import myCart from "../cart/Cartvue";
import myWish from "../wish/Wishvue";
import myShop from "../Shop/Shop";
import CartHome from "../cart/CartHome";
import Logout from "./Logout";
export default {
    // router,
    props: ["user"],
    components: {
        // Show,
        vueTopprogress,
        myWish,
        myShop,
        CartHome,
        myCart,
        Logout
    },
    data() {
        return {
            search: "",
            catShow: false,
            menuShow: false,
            cartItems: null,
            categories: [],
            menus: [],
            drawer: true,
            right: null,
            snackbar: false,
            y: "bottom",
            x: "left",
            Allusers: [],
            Scolor: "",
            timeout: 5000,
            message: "Success",
            offsetTop: 0,
            duration: 1000,
            easing: "easeInOutCubic",
            easings: Object.keys(easings),
            type: "number",
            wishItems: []
        };
    },
    methods: {
        gotoSub(item) {
            eventBus.$emit("progressEvent");
            eventBus.$emit("goToSubEvent", item);
            this.$router.push({
                name: "Category",
                params: {
                    id: item,
                    type: "subcat"
                }
            });
            // eventBus.$emit("gotoSUbcatEvent", item);
        },
        gotoCat(item) {
            eventBus.$emit("progressEvent");
            eventBus.$emit("goToCatEvent", item);
            this.$router.push({
                name: "Category",
                params: {
                    id: item,
                    type: "cat"
                }
            });
            // eventBus.$emit("gotoCatEvent", item);
        },
        showMenu(menu) {
            this.menuShow = true;
            this.categories = menu.categories;
        },
        progressBar() {
            this.$refs.topProgress.start();
        },

        onScroll(e) {
            this.offsetTop = window.pageYOffset || document.documentElement.scrollTop;
        },
        addToCart(cart) {
            console.log(cart);
            eventBus.$emit("progressEvent");
            // eventBus.$emit("loadingRequest");
            axios
                .post(`/cart/${cart}`)
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    if (response.data.errors) {
                        eventBus.$emit("errorRequest", response.data.errors);

                        return (this.err_ms = response.data.errors);
                    } else {
                        eventBus.$emit("cartEvent", response.data);
                        // this.cart = response.data
                        // this.message = "added";
                        eventBus.$emit("alertRequest", "Cart Added");
                    }
                    // this.snackbar = true;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        categoryPro(data) {
            // console.log(data)
            eventBus.$emit("filterEvent", data.id);

            // router.go('')
            // this.$router.push(`/filter/${data.id}`)
        },
        unfilter() {
            this.loadingalert();
            eventBus.$emit("unfilterEvent");
        },
        getCart() {
            axios.get("/cart_count").then(response => {
                this.cartItems = response.data;
            });
        },
        getWish() {
            eventBus.$emit("progressEvent");
            axios
                .get("/wish")
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.wishItems = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },

        addToWish(item) {
            eventBus.$emit("progressEvent");
            // eventBus.$emit("loadingRequest");
            axios
                .patch(`/wish/${item}`)
                .then(response => {
                    eventBus.$emit("alertRequest", "Wishlist updated");
                    eventBus.$emit("RefWishEvent");
                    eventBus.$emit("StoprogEvent");
                    this.getWish();
                    // this.snackbar = true;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },

        showerror(data) {
            this.message = data;
            this.Scolor = "red";
            this.snackbar = true;
        },

        showalert(data) {
            this.message = data;
            this.Scolor = "black";
            this.snackbar = true;
        },

        loadingalert() {
            this.message = "Loading...";
            this.Scolor = "black";
            this.y = "top";
            this.x = "right";
            this.snackbar = true;
        },

        productSearch() {
            eventBus.$emit("searchEvent", this.search);
            this.$router.push({
                name: "search",
                params: {
                    search: this.search
                }
            });
        }
    },

    created() {
        eventBus.$on("addCartEvent", data => {
            this.addToCart(data);
        });
        eventBus.$on("WishListEvent", data => {
            this.addToWish(data);
        });
        eventBus.$on("cartEvent", data => {
            this.getCart()
        });
        eventBus.$on("alertRequest", data => {
            this.showalert(data);
        });
        eventBus.$on("errorRequest", data => {
            this.showerror(data);
        });
        eventBus.$on("loadingRequest", data => {
            this.loadingalert();
        });
        eventBus.$on("progressEvent", data => {
            this.$refs.topProgress.start();
        });
        eventBus.$on("StoprogEvent", data => {
            this.$refs.topProgress.done();
        });
        eventBus.$on("ScollEvent", data => {
            window.scrollTo(0, 300);
            // VueScroll.scrollTo('#headerq', 1000)
        });
        eventBus.$on("errorEvent", data => {
            this.showerror(data);
        });
        this.timer = window.setInterval(() => {
            this.getCart();
            // eventBus.$emit("cartEvent", response.data);
        }, 60000);
    },

    computed: {
        target() {
            const value = this[this.type];
            return Number(value);
        },
        options() {
            return {
                duration: this.duration,
                offsetTop: this.offsetTop,
                easing: this.easing
            };
        }
    },
    mounted() {
        // this.progressBar();
        this.getCart();
        this.getWish();
        axios
            .get("/categories")
            .then(response => {
                this.categories = response.data;
            })
            .catch(error => {
                // this.loading = false;
                this.errors = error.response.data.errors;
            });

        axios
            .get("/menus")
            .then(response => {
                this.menus = response.data;
            })
            .catch(error => {
                // this.loading = false;
                this.errors = error.response.data.errors;
            });
    },
};
</script>

<style scoped>
#header1 .main_menu>li>a:hover {
    color: #f0aca1;
}

.router-link-exact-active {
    color: #e65540 !important;
}

#category .active {
    color: #e65540;
    padding: 5px 0;
    cursor: pointer;
    /* font-size: 17px; */
    font-style: italic;
    font-weight: bold;
}

#category .card-text {
    cursor: pointer;
    padding: 5px 0;
    color: #000;
}

#category .card-text:hover {
    color: #f00;
}
</style>
