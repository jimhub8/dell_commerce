<template>
<div>
    <div>
        <v-card>
            <v-card-title>
                <h3>
                    <strong>Your Cart</strong>
                </h3>
            </v-card-title>
            <v-card-text v-for="cart in carts" :key="cart.item.id">
                <!-- <div> -->
                <v-layout wrap>
                    <v-flex sm3>
                        <avatar :username="cart.item.name" style="font-size: 15px;margin: auto;padding: 10px;"></avatar>
                    </v-flex>
                    <v-divider vertical></v-divider>
                    <v-flex sm7 offset-sm1>
                        {{ cart.item.name }}
                        <br>
                        <!-- <v-divider></v-divider> -->
                        {{ cart.qty }} X {{ cart.item.price }}
                        <br>
                        <v-btn icon small color="primary" @click="subtructCart(cart.item.id)">
                            <!-- <v-icon>minimize</v-icon> -->
                            <i class="fas fa-minus"></i>
                        </v-btn>
                        {{ cart.qty }}
                        <v-btn icon small color="primary" @click="addToCart(cart.item.id)">
                            <v-icon>add</v-icon>
                        </v-btn>
                    </v-flex>
                </v-layout>
                <!-- </div> -->
                <v-divider></v-divider>
            </v-card-text>
            <v-card-text>
                <b>Subtotal</b>
                <span style="float: right;">{{ totalPrice }}</span>
                <br>
                <b>Discount</b>
                <span style="float: right;">{{ discount }}</span>
                <br>
                <v-text-field v-model="coupon" color="purple darken-2" label="Enter Coupon" required></v-text-field>
                <v-btn color="info" raised>Apply</v-btn>
                <br>
                <strong>Total</strong>
                <span style="float: right;">{{ getTotal }}</span>
            </v-card-text>
            <v-card-actions>
                <!-- <v-btn flat color="primary">Continue Shopping</v-btn> -->
                <v-spacer></v-spacer>
                <!-- <v-btn flat color="success" @click="checkout">Checkout</v-btn> -->
                <form action="/createpayment" method="post">
                    <!-- <input type="hidden" name="_token" :value="csrf"> -->
                    <v-btn color="Success" flat type="submit">Checkout</v-btn>
                </form>
            </v-card-actions>
        </v-card>
    </div>
</div>
</template>

<script>
import Avatar from "vue-avatar";
export default {
    components: {
        Avatar
    },
    data() {
        return {
            // csrf: document
            //     .querySelector('meta[name="csrf-token"]')
            //     .getAttribute("content"),
            carts: [],
            newCart: [],
            cartAdd: false,
            totalPrice: 0,
            discount: 0,
            coupon: ""
        };
    },
    created() {
        eventBus.$on("cartEvent", data => {
            this.carts = data;
            this.cartAdd = true;
        });
    },
    methods: {
        subtructCart(cart) {
            eventBus.$emit("loadingRequest");
            axios
                .post(`/subToCart/${cart}`)
                .then(response => {
                    eventBus.$emit("cartEvent", response.data);
                    eventBus.$emit("alertRequest", 'Cart Reduced');
                    // this.cart = response.data
                    // this.message = "added";
                    // this.snackbar = true;
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        addToCart(cart) {
            eventBus.$emit("addCartEvent", cart);
        },
        checkout() {},
        cons(cart) {
            console.log(cart);
        }
    },
    computed: {
        getSubTotal() {
            if (this.carts.length > 0) {
                this.totalPrice = 0;
                for (let index = 0; index < this.carts.length; index++) {
                    const element = this.carts[index];
                    this.totalPrice = parseInt(element.price) + this.totalPrice;
                }
            }
            return this.totalPrice;
        },
        getTotal() {
            if (this.carts.length > 0) {
                return parseInt(this.getSubTotal) - this.discount;
            }
        }
    },
    mounted() {
        axios.get("/getCart").then(response => {
            this.carts = response.data;
        });
    }
};
</script>

<style>
</style>
