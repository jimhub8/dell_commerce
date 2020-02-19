<template>
<div>
    <headerP></headerP>
    <div v-show="loading" style="text-align: center; width: 100%; margin-top: 200px;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
    <section class="bgwhite p-t-55 p-b-65" v-show="!loading">
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

                            <li class="p-t-4" v-for="menu in menus" :key="menu.id">
                                <v-btn raised color="success" @click="catId(menu.id)" v-if="menu.id === cat_id">{{ menu.name }}</v-btn>
                                <v-btn flat color="primary" @click="catId(menu.id)" v-else>{{ menu.name }}</v-btn>
                            </li>
                        </ul> -->

                        <!-- <v-flex xs12 sm12>
                                    <v-select :items="price" v-model="priceSelect" label="Filter By Price" single-line item-text="state" item-value="state" return-object persistent-hint @change="FilterShop"></v-select>
                                </v-flex> -->
                        <!-- <v-layout row wrap>
                            <v-flex sm5  @change="FilterShop">
                                <el-input placeholder="Please input" v-model="price[0]"></el-input>
                            </v-flex>
                            <v-flex sm5  @change="FilterShop" offset-sm1>
                                <el-input placeholder="Please input" v-model="price[1]"></el-input>
                            </v-flex>
                        </v-layout>

                        <label for="">Price Range </label>
                        <el-slider v-model="price" range :max="500000" @change="FilterShop"></el-slider> -->

                        <!--  -->
                        <!-- <h4 class="m-text14 p-b-32">Filters</h4>
                        <div class="filter-color p-t-22 p-b-50 bo3">
                            <div class="m-text15 p-b-12">Color</div>

                            <ul class="flex-w">
                                <li class="m-r-10">
                                    <input
                      class="checkbox-color-filter"
                      id="color-filter1"
                      type="checkbox"
                      name="color-filter1"
                    >
                                    <label class="color-filter color-filter1" for="color-filter1"></label>
                                </li>

                                <li class="m-r-10">
                                    <input
                      class="checkbox-color-filter"
                      id="color-filter2"
                      type="checkbox"
                      name="color-filter2"
                    >
                                    <label class="color-filter color-filter2" for="color-filter2"></label>
                                </li>

                                <li class="m-r-10">
                                    <input
                      class="checkbox-color-filter"
                      id="color-filter3"
                      type="checkbox"
                      name="color-filter3"
                    >
                                    <label class="color-filter color-filter3" for="color-filter3"></label>
                                </li>

                                <li class="m-r-10">
                                    <input
                      class="checkbox-color-filter"
                      id="color-filter4"
                      type="checkbox"
                      name="color-filter4"
                    >
                                    <label class="color-filter color-filter4" for="color-filter4"></label>
                                </li>

                                <li class="m-r-10">
                                    <input
                      class="checkbox-color-filter"
                      id="color-filter5"
                      type="checkbox"
                      name="color-filter5"
                    >
                                    <label class="color-filter color-filter5" for="color-filter5"></label>
                                </li>

                                <li class="m-r-10">
                                    <input
                      class="checkbox-color-filter"
                      id="color-filter6"
                      type="checkbox"
                      name="color-filter6"
                    >
                                    <label class="color-filter color-filter6" for="color-filter6"></label>
                                </li>

                                <li class="m-r-10">
                                    <input
                      class="checkbox-color-filter"
                      id="color-filter7"
                      type="checkbox"
                      name="color-filter7"
                    >
                                    <label class="color-filter color-filter7" for="color-filter7"></label>
                                </li>
                            </ul>
                        </div>

                        <div class="search-product pos-relative bo4 of-hidden">
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
                        <div class="flex-w">
                            <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                                <!-- <v-layout wrap> -->
                                <!-- <v-flex xs12 sm12>
                                    <v-select :items="items" v-model="itemSelect" label="Filter By" single-line item-text="state" item-value="abbr" return-object persistent-hint @change="FilterShop"></v-select>
                                </v-flex> -->
                            </div>
                        </div>

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
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="list-price text-danger">List price: <s>{{ product.list_price }}</s></small>
                                        </div>
                                        <div class="col-6">
                                            <p>Price {{ product.price }}</p>
                                        </div>
                                    </div>
                                    <hr>
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
import myFilter from './details/filter'
export default {
    components: {
        headerP, myFilter
    },
    data() {
        return {
            menus: [],
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
            price: [0, 30000],
            priceSelect: {
                state: "All"
            },
            loader: false,
            wish: [],
            cat_id: null,

            filter_data: {
                price: [0, 0],
                category_id: 0
            },
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
                .post(this.products.path + `?page=` + this.products.current_page, {
                    item: this.cat_id,
                    price: this.priceSelect,
                    itemSelect: this.itemSelect
                })
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.products = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },
        getMenus() {
            axios
                .get("/menus")
                .then(response => {
                    this.menus = response.data;
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
        FilterShop(id) {
            eventBus.$emit("progressEvent");
            this.filter_data.category_id = id
            eventBus.$emit("progressEvent");
            var payload = {
                model: 'FilterShop',
                update: 'updateProductsList',
                data: this.filter_data,

            }
            this.$store.dispatch('filterData', payload)
            // axios
            //     .post("/FilterShop", {
            //         item: this.cat_id,
            //         price: this.price,
            //         itemSelect: this.itemSelect
            //     })
            //     .then(response => {
            //         eventBus.$emit("StoprogEvent");
            //         this.loader = false;
            //         this.products = response.data;
            //     })
            //     .catch(error => {
            //         eventBus.$emit("StoprogEvent");
            //         this.loader = false;
            //         this.errors = error.response.data.errors;
            //     });
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
            // eventBus.$emit("progressEvent");
            // // eventBus.$emit("loadingRequest");
            // axios
            //   .patch(`/wish/${item}`)
            //   .then(response => {
            //     eventBus.$emit("alertRequest", 'Added To Wishlist');
            //     eventBus.$emit("StoprogEvent");
            //     this.FilterShop()
            //     // this.message = "added";
            //     // this.snackbar = true;
            //   })
            //   .catch(error => {
            //     eventBus.$emit("StoprogEvent");
            //     this.errors = error.response.data.errors;
            //   });
        }
    },
    mounted() {
        // this.loader = true;
        this.FilterShop();
        this.getMenus();
        eventBus.$emit("ScollTopEvent");
    },
    updated() {},
    beforeRouteLeave(to, from, next) {
        // eventBus.$emit("progressEvent");
        next();
    },
    created() {
        eventBus.$on("RefWishEvent", data => {
            this.FilterShop();
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
