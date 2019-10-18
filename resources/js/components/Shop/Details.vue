<template>
<div>
    <headerP></headerP>
    <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
    <div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">
            <div class="w-size13 p-t-30 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots" v-if="products.images.length > 0">
                        <div class="wrap-pic-w" v-for="image in products.images" :key="image.id">
                            <img :src="image.image" :alt="image.mimetype" style="height: 100px; margin-bottom: 10px;" @click="products.image = image.image">
                        </div>
                        <img :src="originalImage" style="height: 100px; margin-bottom: 10px;" @click="products.image = originalImage">
                    </div>

                    <div class="slick3">
                        <div class="item-slick3">
                            <div class="wrap-pic-w">
                                <img :src="products.image" :alt="products.product_name">
                                <div class="text-xs-center">
                                    <v-rating v-model="avgRating" readonly half-increments></v-rating>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-size14 p-t-30 respon5">
                <h4 class="product-detail-name m-text16 p-b-13">
                    {{ products.product_name }}
                </h4>

                <span class="m-text17">
                    Price: {{ products.price }}
                </span>
                <p>Available: {{ products.quantity }}</p>
                <div v-html="products.description"></div>

                <!--  -->
                <div class="p-t-33 p-b-60">

                    <!-- <div class="flex-m flex-w" v-if="sizes.length > 0">
                        <div class="s-text15 w-size15 t-center">
                            Size
                        </div>

                        <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                            <select class="selection-2" name="color">
                              <option>Choose an option</option>
                              <option v-for="size in sizes" :key="size.id">{{ size.name }}</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="flex-r-m flex-w p-t-10">
                        <div class="w-size16 flex-m flex-w">

                            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10" v-if="products.attributes.length > 0">
                                <el-select v-model="form.attribute" clearable placeholder="Select size" @change="priceChange">
                                    <el-option v-for="item in products.attributes" :key="item.id" :label="item.value" :value="item.id">
                                    </el-option>
                                </el-select>
                            </div>

                            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">

                                <input v-model="form.quantity" class="size8 m-text18 t-center num-product" type="number" min="1" name="num-product" value="1">
                            </div>

                            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                <!-- Button -->
                                <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" @click="addToCart">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-b-45">
                    <!-- <span class="s-text8 m-r-35">SKU: MUG-01</span> -->
                    <span class="s-text8">Categories: {{ categories.name }}</span>
                </div>
                <div v-html="products.details"></div>
            </div>
        </div>
        <Review :product="products" :pid="products.id"></Review>
        <v-btn @click="getProduct">Review</v-btn>
        <v-expansion-panel>
            <v-expansion-panel-content>
                <div slot="header">Reviews</div>
                <v-card>
                    <v-card-text v-for="review in reviews.data" :key="review.id">
                        <img :src="review.profile" alt="" style="width: 50px; height: 50px; border-radius: 50%; text-align: center;">
                        <h2>{{ review.user_name }}</h2>
                        <small>{{ review.comments }}</small>
                        <div>
                            <v-rating readonly small half-increments v-model="review.rating"></v-rating>
                        </div>
                        <v-divider></v-divider>
                    </v-card-text>
                </v-card>
                <div class="text-xs-center" style="margin: auto; width: 100%;" v-if="reviews.last_page > 1">
                    <v-pagination v-model="reviews.current_page" :length="reviews.last_page" total-visible="5" @input="next(reviews.path, reviews.current_page)" circle></v-pagination>
                </div>
            </v-expansion-panel-content>
        </v-expansion-panel>
    </div>
    <!-- RELATED PRODUCTS -->
    <section class="relateproduct bgwhite p-t-45 p-b-138">
        <div class="container">
            <!-- <div class="sec-title p-b-60">
                    <h3 class="m-text5 t-center">
                        Related Products
                    </h3>
                </div> -->

            <v-data-iterator :items="relatedProducts" :rows-per-page-items="rowsPerPageItems" :pagination.sync="pagination" content-tag="v-layout" row wrap>
                <v-toolbar slot="header" class="mb-2" color="white darken-5" dark flat>
                    <v-toolbar-title style="color: #000; margin: auto;">Related Products</v-toolbar-title>
                </v-toolbar>
                <v-flex slot="item" slot-scope="props" xs12 sm6 md4 lg3>

                    <v-card>

                        <!-- <v-divider></v-divider> -->
                        <v-card-text>
                            <v-content>
                                <div class="image-container">
                                    <v-img class="white--text" height="230px" :src="props.item.image">
                                        <v-container fill-height fluid>
                                            <v-layout fill-height>
                                                <v-flex xs12 align-end flexbox>
                                                    <span class="headline">{{ props.item.name }}</span>
                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                    </v-img>

                                    <!-- <div class="after">This is some content</div> -->
                                    <div class="caption after text-center" :class="{'selected': isSelected(props.item.id)}">
                                        <!-- <v-btn color="primary" flat style="margin: auto;" @click="view(prod)">view prod</v-btn>  -->
                                        <div id="tooltip">
                                            <v-tooltip bottom class="" data-wow-delay="0.4s">
                                                <v-btn icon class="mx-0" slot="activator" @click="view(props.item)" style="margin-top: 100px;">
                                                    <v-icon color="info darken-2" small>visibility</v-icon>
                                                </v-btn>
                                                <span>view product</span>
                                            </v-tooltip>
                                            <v-tooltip bottom class="" data-wow-delay="0.8s">
                                                <v-btn icon class="mx-0" slot="activator" @click="wishList(props.item.id)" style="margin-top: 100px;">
                                                    <v-icon color="success darken-2" small>favorite</v-icon>
                                                </v-btn>
                                                <span>Wish list</span>
                                            </v-tooltip>
                                            <v-tooltip bottom class="" data-wow-delay="1.2s">
                                                <v-btn icon class="mx-0" slot="activator" @click="addToCart(props.item.id)" style="margin-top: 100px;">
                                                    <v-icon color="orange darken-2" small>shopping_cart</v-icon>
                                                </v-btn>
                                                <span>Add To Cart</span>
                                            </v-tooltip>
                                        </div>
                                    </div>
                                </div>
                            </v-content>
                        </v-card-text>
                        <v-divider></v-divider>
                        <div class="text-center" style="background: #f0f0f0;">
                            <v-btn flat color="orange" @click="redirect(props.item.id)">{{ props.item.product_name }}</v-btn>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-danger">List price: <s>{{ props.item.list_price }}</s></small>

                                </div>
                                <div class="col-6">
                                    <p class="price">Our price: {{ props.item.price }}</p>

                                </div>
                            </div>
                            <!-- <v-divider></v-divider> -->
                        </div>
                    </v-card>
                </v-flex>
            </v-data-iterator>

            <!-- Slide2 -->
        </div>
    </section>
    <!-- RELATED PRODUCTS -->
    <Show></Show>
</div>
</template>

<script>
import headerP from "../include/Headerpartial";
import Review from "../reviews/Review";
import Show from "../home/Show";
export default {
    components: {
        headerP,
        Show,
        Review
    },
    data() {
        return {
            form: {
                quantity: 1
            },
            loader: false,
            products: [],
            categories: [],
            proId: this.$route.params.id,
            showError: false,
            error_msg: "",
            relatedProducts: [],
            rowsPerPageItems: [4, 8, 12],
            pagination: {
                rowsPerPage: 4
            },
            selectedCard: -1,
            reviews: [],
            sizes: [],
            avgRating: null,
            originalImage: ""
        };
    },
    methods: {
        redirect(proId) {
            // this.proId = this.$route.params.id
            this.$router.push({
                name: "details",
                params: {
                    id: proId
                }
            });
            this.getProduct();
        },
        addToCart() {
            // alert('cart')
            // if (this.form.quantity > this.products.quantity) {
            //       eventBus.$emit("errorRequest", response.data.errors);
            //   this.error_msg = "Amount entered is more than available";
            // } else if (this.form.quantity < 1) {
            //       eventBus.$emit("errorRequest", response.data.errors);
            //   this.error_msg = "Quantity must be greater than 1";
            // } else {
            eventBus.$emit("progressEvent");
            axios
                .post(`/cartAdd/${this.proId}`, this.$data.form)
                .then(response => {
                    this.loading = false;
                    eventBus.$emit("StoprogEvent");
                    if (response.data.errors) {
                        eventBus.$emit("errorRequest", response.data.errors);

                        return (this.err_ms = response.data.errors);
                    } else {
                        eventBus.$emit("StoprogEvent");
                        eventBus.$emit("alertRequest", "Cart Added");
                        eventBus.$emit("cartEvent", response.data);
                    }
                    // this.close();
                    // this.resetForm();
                    // this.$parent.brands.push(response.data)
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
            // }
        },

        hoverCard(selectedIndex) {
            this.selectedCard = selectedIndex;
            // this.animateCards()
        },
        isSelected(cardIndex) {
            return this.selectedCard === cardIndex;
        },
        view(product) {
            eventBus.$emit("viewProEvent", product);
        },

        // addToCart(cart) {
        //   eventBus.$emit("addCartEvent", cart);
        // },
        wishList(item) {
            eventBus.$emit("WishListEvent", item);
        },
        getProduct() {
            this.proId = this.$route.params.id;
            eventBus.$emit("progressEvent");
            axios
                .get(`/show_product/${this.proId}`)
                .then(response => {
                    eventBus.$emit("ScollEvent");
                    eventBus.$emit("StoprogEvent");
                    this.loader = false;
                    this.getReviews();
                    this.getRelated();
                    this.getAvgReviews();
                    this.getCategory(response.data.id);
                    this.products = response.data;
                    this.originalImage = response.data.image;
                    this.sizes = response.data.sizes;
                })
                .catch(error => {
                    this.loader = false;
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },

        getRelated() {
            axios
                .get(`/related/${this.proId}`)
                .then(response => {
                    // eventBus.$emit("StoprogEvent");
                    this.loader = false;
                    this.relatedProducts = response.data;
                })
                .catch(error => {
                    this.loader = false;
                    // eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },
        getReviews() {
            eventBus.$emit("progressEvent");
            axios
                .get(`/getReviews/${this.proId}`)
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.reviews = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },

        getAvgReviews() {
            axios
                .get(`/ratings/${this.proId}`)
                .then(response => {
                    if (response.data) {
                        this.avgRating = response.data;
                    } else {
                        this.avgRating = 0;
                    }
                })
                .catch(error => {
                    // eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },

        next(page) {
            eventBus.$emit("progressEvent");
            axios
                .get(this.reviews.path + `?page=` + this.reviews.current_page)
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.reviews = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },
        getCategory(id) {
            axios
                .get(`categories/${id}`)
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },

        priceChange(data) {
            eventBus.$emit("progressEvent");
            axios
                .get(`product_attribute/${data}`)
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.products.price = response.data.price
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        }
    },
    mounted() {
        this.loader = true;
        this.getProduct();
        // this.getRelated();
        // this.getReviews();
        // this.getAvgReviews();
    },
    created() {
        eventBus.$on("ReviewRequest", data => {
            this.getReviews();
            this.getAvgReviews();
        });
    }
};
</script>

<style scoped>
.wrap-pic-w img {
    height: 300px;
}

.slick3-dots li {
    display: none !important;
}

.w-100 {
    height: 230px;
    transition: height 0.3s, opacity 0.3s;
}

.w-100.selected {
    transition: height 0.6s, opacity 0.6s;
    /* zoom: 1.2; */
    opacity: 0.8;
}

.caption {
    display: none;
}

.caption.selected {
    transition: height 0.6s, opacity 0.6s;
    display: block;
}

#container {
    position: relative;
    width: 100%;
    height: 100%;
}

#container.after {
    position: absolute;
    color: #000;
    display: none;
}

#container:hover.after {
    display: block;
    background: rgba(0, 0, 0, 6);
}

.image-container {
    position: relative;
    height: 230px;
    width: 100%;
}

.image-container .after {
    position: absolute;
    top: 0;
    left: 0;
    height: 230px;
    width: 100%;
    display: none;
    color: #fff;
}

.image-container:hover .after {
    display: block;
    background: rgba(0, 0, 0, 0.6);
}

#tooltip .v-btn {
    background: rgba(240, 240, 240, 0.26);
}

#tooltip .v-btn:hover {
    background: rgba(0, 0, 0, 0.24);
}

.v-btn .v-btn__content .v-icon {
    box-shadow: 0 9px 30px -6px rgba(255, 54, 54, 0.5);
}

.theme--light.v-data-iterator .v-data-iterator__actions {
    margin-top: 0 !important;
}

ul,
li {
    margin: 0px;
    /* list-style-type: none; */
}
</style>
