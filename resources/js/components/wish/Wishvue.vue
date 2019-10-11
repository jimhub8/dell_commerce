<template>
<div>
    <div class="header-cart header-dropdown">
        <ul class="header-cart-wrapitem">
            <li class="header-cart-item" v-for="cart in wishes" :key="cart.id">
                <div class="header-cart-item-img">
                    <img :src="cart.image" alt="IMG">
          </div>

                    <div class="header-cart-item-txt">
                        <a href="#" class="header-cart-item-name">{{ cart.name }}</a>
                        <span class="header-cart-item-info">KSH {{ cart.price }}</span>
                    </div>
            </li>
        </ul>

        <div class="header-cart-buttons">
            <div class="header-cart-wrapbtn">
                <!-- Button -->
                <router-link class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4" to="/wishlist">View Wishlist</router-link>
                <!-- <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4"></a> -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            wishes: [],
            newCart: [],
        };
    },
    created() {
        eventBus.$on("RefWishEvent", data => {
            this.getWish();
        });
    },
    methods: {
        getWish() {
            // eventBus.$emit("addCartEvent", cart);
            axios.get("/wish").then(response => {
                    this.wishes = response.data;
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
        cons(cart) {
            console.log(cart);
        }
    },
    mounted() {
        this.getWish()
    }
};
</script>
