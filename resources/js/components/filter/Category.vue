<template>
<div>
    <headerP></headerP>
    <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
    <section class="bgwhite p-t-55 p-b-65" v-show="!loader">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                    <div class="leftbar p-r-20 p-r-0-sm">
                        <!--  -->
                        <!-- <h4 class="m-text14 p-b-7">Categories</h4> -->
                        <myFilter></myFilter>

                        <!-- <ul class="p-b-54">
                            <li class="p-t-4">
                                <v-btn raised color="success" @click="catAll" v-if="cat_id === null">All</v-btn>
                                <v-btn flat color="primary" @click="catAll" v-else>All</v-btn>
                            </li>

                            <li class="p-t-4" v-for="category in categories" :key="category.id">
                                <v-btn raised color="success" @click="catId(category.id)" v-if="category.id === cat_id">{{ category.name }}</v-btn>
                                <v-btn flat color="primary" @click="catId(category.id)" v-else>{{ category.name }}</v-btn>
                            </li>
                        </ul> -->

                        <!-- <div class="search-product pos-relative bo4 of-hidden">
                            <input
                                class="s-text7 size6 p-l-23 p-r-50"
                                type="text"
                                name="search-product"
                                placeholder="Search Products..."
                                v-model="form.search"
                                @keyup.enter="searchItems">

                            <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                  <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                </button>
                        </div> -->
                    </div>
                </div>

                <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                    <!--  -->
                    <div class="flex-sb-m flex-w p-b-35">
                        <!-- <div class="flex-w">
                            <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                                <v-flex xs12 sm12>
                                    <v-select :items="items" v-model="itemSelect" label="Filter By" single-line item-text="state" item-value="abbr" return-object persistent-hint @change="FilterShop"></v-select>
                                </v-flex>
                            </div>
                            <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                                <v-flex xs12 sm12>
                                    <v-select :items="price" v-model="priceSelect" label="Filter By Price" single-line item-text="state" item-value="state" return-object persistent-hint @change="FilterShop"></v-select>
                                </v-flex>
                            </div>
                        </div> -->

                        <span class="s-text8 p-t-5 p-b-5">Showing page {{ products.current_page }} of {{ products.last_page }} pages</span>
                    </div>

                    <!-- Product -->
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4 p-b-50" v-for="product in products.data" :key="product.id">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew" v-if="product.new_product === 1">
                                    <img :src="product.image" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <!-- <span class="block2-btn-addwishlist hov-pointer trans-0-4">
                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true" @click.native="addToWish(product.id)"></i>
                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true" @click.native="addToWish(product.id)"></i>
                      </span> -->
                                        <v-tooltip bottom style="margin-left: 90%;" v-if="product.wish_list === 1">
                                            <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(product.id)" style="margin-top: -20px;">
                                                <v-icon color="pink darken-2" large>favorite</v-icon>
                                            </v-btn>
                                            <span>Wish list</span>
                                        </v-tooltip>

                                        <v-tooltip bottom style="margin-left: 90%;" v-else>
                                            <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(product.id)" style="margin-top: -20px;">
                                                <v-icon color="white darken-2" large>favorite</v-icon>
                                            </v-btn>
                                            <span>Wish list</span>
                                        </v-tooltip>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <v-btn color="success" @click="addToCart(product.id)">Add to Cart</v-btn>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-img wrap-pic-w of-hidden pos-relative" v-else>
                                    <img :src="product.image" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                      </a> -->
                                        <v-tooltip bottom style="margin-left: 90%;" v-if="product.wish_list === 1">
                                            <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(product.id)" style="margin-top: -20px;">
                                                <v-icon color="pink darken-2" large>favorite</v-icon>
                                            </v-btn>
                                            <span>Wish list</span>
                                        </v-tooltip>
                                        <v-tooltip bottom style="margin-left: 90%;" v-else>
                                            <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(product.id)" style="margin-top: -20px;">
                                                <v-icon color="white darken-2" large>favorite</v-icon>
                                            </v-btn>
                                            <span>Wish list</span>
                                        </v-tooltip>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <v-btn color="primary" @click="addToCart(product.id)">Add to Cart</v-btn>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <button class="block2-name dis-block s-text3 p-b-5" @click="redirect(product.id)">{{ product.product_name }}</button>
                                    <span class="block2-price m-text6 p-r-5">{{ product.price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <!-- <div class="pagination flex-m flex-w p-t-26">
            <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
            <a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
          </div>-->
                <div class="text-xs-center" style="margin: auto; width: 100%;" v-if="products.last_page > 1">
                    <v-pagination v-model="products.current_page" :length="products.last_page" total-visible="6" @input="next(products.path, products.current_page, 'products')" circle></v-pagination>
                </div>
            </div>
        </div>
    </section>
</div>
</template>

<script>
import headerP from "../include/Headerpartial";
import myFilter from '../Shop/details/filter'
export default {
    components: {
        headerP,
        myFilter
    },
    data() {
        return {
            categories: [],
            form: {
                search: ""
            },
            items: [{
                    state: "All"
                },
                {
                    state: "New",
                    abbr: "new_product"
                },
                {
                    state: "Popularity",
                    abbr: "best_sell"
                },
                {
                    state: "Featured",
                    abbr: "featured"
                }
            ],
            itemSelect: {
                abbr: "All",
                state: "All"
            },
            price: [{
                    state: "All"
                },
                {
                    state: "0-500"
                },
                {
                    state: "501-1000"
                },
                {
                    state: "1000-5000"
                }
            ],
            priceSelect: {
                state: "All"
            },
            loader: false,
            wish: [],
            cat_id: null,
            filterId: this.$route.params.id,
            type: this.$route.params.type
        };
    },
    methods: {
        searchItems() {
            eventBus.$emit("progressEvent");
            axios
                .post("/search", this.form)
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.products = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },
        redirect(proId) {
            // alert('oooo')
            this.$router.push({
                name: "details",
                params: {
                    id: proId
                }
            });
        },
        catId(item) {
            this.cat_id = item;
            this.FilterShop();
        },
        catAll() {
            this.cat_id = null;
            this.FilterShop();
        },
        getProducts() {
            this.loader = true;
            axios
                .get("/products")
                .then(response => {
                    this.loader = false;
                    this.products = response.data;
                })
                .catch(error => {
                    this.loader = false;
                    this.errors = error.response.data.errors;
                });
        },
        addToCart(cart) {
            eventBus.$emit("addCartEvent", cart);
        },

        next(page) {
            eventBus.$emit("progressEvent");
            axios
                .get(this.products.path + `?page=` + this.products.current_page)
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.products = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },
        getCategory() {
            axios
                .get("/menus")
                .then(response => {
                    this.loader = false;
                    this.categories = response.data;
                })
                .catch(error => {
                    this.loader = false;
                    this.errors = error.response.data.errors;
                });
        },
        FilterShop(item) {
            eventBus.$emit("progressEvent");
            axios
                .post("/FilterShop", {
                    item: this.cat_id,
                    price: this.priceSelect,
                    itemSelect: this.itemSelect
                })
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.loader = false;
                    this.products = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.loader = false;
                    this.errors = error.response.data.errors;
                });
        },
        getWish() {
            eventBus.$emit("progressEvent");
            axios
                .get("/wish")
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.wish = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },
        addToWish(item) {
            eventBus.$emit("WishListEvent", item);
        },
        gotoSUbcat(data) {
            console.log(data);
            axios
                .get(`/subcategory/${data}`)
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.products = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },
        gotoCat(data) {
            console.log(data);
            axios
                .get(`/category/${data}`)
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.products = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        }
    },
    mounted() {
        (this.filterId = this.$route.params.id), (this.loader = true);
        if (this.$route.params.type == "cat") {
            this.gotoCat(this.filterId);
        } else {
            this.gotoSUbcat(this.filterId);
        }
        // this.FilterShop();
        this.getCategory();
    },
    beforeRouteLeave(to, from, next) {
        // eventBus.$emit("progressEvent");
        next();
    },
    created() {
        eventBus.$on("goToSubEvent", data => {
            this.gotoSUbcat(data);
        });

        eventBus.$on("goToCatEvent", data => {
            this.gotoCat(data);
        });
    },

    computed: {
        products() {
            return this.$store.getters.products
        },
        loading() {
            return this.$store.getters.loading
        }
    },
};
</script>

<style scoped>
.wrap-pic-w img {
    height: 300px;
}
</style>
