<template>
<div>
    <headerP></headerP>
    <h1 class="text-center">My Shopping Cart</h1>
    <v-divider></v-divider>
    <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
    <v-tooltip bottom>
        <v-btn slot="activator" icon class="mx-0" @click="getCartProduct">
            <v-icon small color="orange darken-2">refresh</v-icon>
        </v-btn>
        <span>Cart</span>
    </v-tooltip>
    <section class="cart bgwhite p-t-70 p-b-100" v-show="!loader">
        <div class="container">
            <!-- <div class="container" v-if="carts.length > 0"> -->
            <!-- Cart item -->

            <div class="container-table-cart pos-relative">
                <div class="wrap-table-shopping-cart bgwhite">
                    <table class="table-shopping-cart">
                        <tr class="table-head">
                            <th class="column-1"></th>
                            <th class="column-2">Product</th>
                            <th class="column-3">Price</th>
                            <th class="column-4 p-l-70">Quantity</th>
                            <th class="column-5">Total</th>
                        </tr>

                        <tr class="table-row" v-for="cart in carts" :key="cart.id">
                            <td class="column-1">
                                <div class="cart-img-product b-rad-4 o-f-hidden" @click="flashCart(cart)">
                                    <img :src="cart.name.image" alt="IMG-PRODUCT">
                                </div>
                            </td>
                            <td class="column-2">{{ cart.name.product_name }}</td>
                            <td class="column-3">{{ cart.name.price }}</td>
                            <td class="column-4">
                                <div class="flex-w bo5 of-hidden w-size17">
                                    <v-btn icon small @click="subtructCart(cart.name.id)">
                                        <i class="fa fa-minus"></i>
                                    </v-btn>
                                    <p style="text-align: center; margin: auto;">{{ cart.qty }}</p>
                                    <v-btn icon small @click="addToCart(cart.name.id)"> 
                                        <v-icon>add</v-icon>
                                    </v-btn>
                                </div>
                            </td>
                            <td class="column-5">{{ cart.subtotal }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
                <div class="flex-w flex-m w-full-sm">
                    <div class="size11 bo4 m-r-10">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" v-model="coupon.c_value" name="coupon-code" placeholder="Coupon Code">
                        <small class="text-danger" v-if="err_ms">{{ err_ms }}</small>
                    </div>

                    <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
                        <!-- Button -->
                        <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" @click="couponApply">Apply coupon</button>
                    </div>
                </div>

            </div>

            <!-- Total -->
            <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                <h5 class="m-text20 p-b-24">Cart Totals</h5>

                <!--  -->
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">Subtotal:</span>

                    <span class="m-text21 w-size20 w-full-sm">KSH {{ cart_total }}</span>
                </div>
                <div class="flex-w flex-sb-m p-b-12" v-if="couponSessin.length > 0">
                    <span class="s-text18 w-size19 w-full-sm" style="color: red;">Coupon:</span>

                    <span class="m-text21 w-size20 w-full-sm" style="color: red;">{{ parseFloat(totalCoupon)/parseFloat(cart_total)*100 }}% off</span>
                </div>

                <!--  -->
                <hr>

                <!--  -->
                <div class="flex-w flex-sb-m p-t-26 p-b-30">
                    <span class="m-text22 w-size19 w-full-sm">Total:</span>

                    <span class="m-text21 w-size20 w-full-sm">KSH {{ parseFloat(cart_total) - parseFloat(totalCoupon) }}</span>
                </div>
                <button style="height: 44px;" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" @click="goToCheckout">Proceed to Checkout</button>
            </div>
        </div>
        <!-- <div v-else style="background: #f0f0f0;">
            <p class="text-center" style="background: #f2dede; font-size: 13px; color: #a94442 !important;">Your hopping cart is empty!</p>
            <v-list>
                <router-link to="/shop" class="v-list__tile v-list__tile--link" style="width: 8%; margin: auto;">
                    <div class="v-list__tile__content">
                        <div class="v-list__tile__title">
                            Go to Shop
                        </div>
                    </div>
                </router-link>
            </v-list>
        </div> -->
    </section>
</div>
</template>

<script>
import headerP from "../include/Headerpartial";
export default {
    components: {
        headerP
    },
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            carts: [],
            loader: false,
            totalCoupon: 0,
            totalPrice: 0,
            discount: 0,
            finalAmount: 0,
            coupon: {
                c_value: ""
            },
            cart_total: null,
            couponSessin: [],
            CartProduct: [],
            err_ms: '',
            form: {
                total: null
            },
        };
    },
    methods: {
        getCart() {
            axios.get("/getCart").then(response => {
                eventBus.$emit("StoprogEvent");
                this.carts = response.data;
                this.loader = false;
                eventBus.$emit("cartEvent", response.data);
            });
        },
        cash_delivery() {
            eventBus.$emit("progressEvent");
            this.form.total = parseInt(this.cart_total) - parseInt(this.getCouponT)
            axios.post('cash_delivery', this.form)
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    // eventBus.$emit("cartEvent", response.data);
                    eventBus.$emit("alertRequest", "Order added");
                    // this.carts = response.data;
                    // this.message = "added";
                    // this.snackbar = true;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        get_cart_total() {
            axios.get('cart_total')
                .then(response => {
                    this.cart_total = response.data
                    this.getCouponT(response.data)
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
        flashCart(cart) {
            eventBus.$emit("progressEvent");
            // eventBus.$emit("loadingRequest");
            axios
                .post('/flashCart', cart)
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    eventBus.$emit("cartEvent", response.data);
                    eventBus.$emit("alertRequest", "Item Removed");
                    this.carts = response.data;
                    // this.message = "added";
                    // this.snackbar = true;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        subtructCart(cart) {
            eventBus.$emit("progressEvent");
            // eventBus.$emit("loadingRequest");
            axios
                .post(`/subToCart/${cart}`)
                .then(response => {
                    this.get_cart_total()
                    eventBus.$emit("StoprogEvent");
                    eventBus.$emit("cartEvent", response.data);
                    eventBus.$emit("alertRequest", "Cart Reduced");
                    this.carts = response.data;
                    // this.message = "added";
                    // this.snackbar = true;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        addToCart(cart) {
            eventBus.$emit("addCartEvent", cart)
                    this.get_cart_total()
        },
        couponApply() {
            axios
                .post("/couponApply", this.coupon)
                .then(response => {
                    // console.log(response.data.errors);
                    if (response.data.errors) {
                        return this.err_ms = response.data.errors
                    } else {
                        eventBus.$emit("StoprogEvent");
                        eventBus.$emit("cartEvent", response.data);
                        eventBus.$emit("alertRequest", "Coupon Applied");
                        this.getCouponSess();
                        this.getCart();
                        this.err_ms = ''
                    }
                    // this.message = "added";
                    // this.snackbar = true;
                })
                .catch(error => {
                    console.log(error);
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },

        getCartProduct() {
            eventBus.$emit("progressEvent");
            axios
                .get("/getCart")
                .then(response => {
                    // console.log(response.data);

                    eventBus.$emit("StoprogEvent");
                    this.CartProduct = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },
        getCouponSess() {
            eventBus.$emit("progressEvent");
            axios
                .get("/couponSes")
                .then(response => {
                    eventBus.$emit("StoprogEvent");
                    this.couponSessin = response.data;
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.errors = error.response.data.errors;
                });
        },
        goToCheckout() {
            this.$router.push({
                name: "checkout"
            });
        },

        getCouponT(data) {
            // console.log(data);
            if (this.couponSessin.length > 0) {
                this.totalCoupon = 0;
                for (let index = 0; index < this.couponSessin.length; index++) {
                    const element = this.couponSessin[index];
                    // console.log(element)
                    if (element.disc_type === "percentage") {
                        this.totalCoupon += (parseInt(data) * parseInt(element.amount)) / 100;
                        // console.log(data, element.amount);

                    } else if (element.disc_type === "fixedCart") {
                        this.totalCoupon = (this.totalCoupon + element.amount);
                        // console.log('this.totalCoupon');
                        // this.finalAmount = this.getTotal - this.totalCoupon;
                    }
                    //  else if (element.disc_type === "productDisc") {
                    //   this.totalCoupon = parseInt(element.amount) + this.totalCoupon;
                    // }
                    else {
                        this.totalCoupon = parseInt(element.amount) + this.totalCoupon;
                    }
                }
                return this.totalCoupon;
            } else {
                return this.totalCoupon;
            }
        }
    },
    mounted() {
        this.loader = true;
        this.getCouponSess();
        this.get_cart_total();
        this.getCart();
    },
    created() {
        eventBus.$on("cartEvent", data => {
            this.carts = data;
            this.cartAdd = true;
        });
        // eventBus.$on("flashEvent", data => {
        //   this.flashCart(data)
        // });
    },
    computed: {
        getSubTotal() {
            /*if (this.carts.length > 0) {
                this.totalPrice = 0;
                for (let index = 0; index < this.carts.length; index++) {
                    const element = this.carts[index];
                    this.totalPrice = parseInt(element.price) + this.totalPrice;
                }
            }

            return this.totalPrice;*/
        },
        getTotal() {
            if (this.carts.length > 0) {
                return parseInt(this.getSubTotal) - this.discount;
            }
        },
    }
};
</script>

<style>
</style>
