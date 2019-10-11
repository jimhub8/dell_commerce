<template>
  <div>
    <div class="header-cart header-dropdown">
      <ul class="header-cart-wrapitem">
        <li class="header-cart-item" v-for="cart in carts" :key="cart.id">
          <div class="header-cart-item-img" @click="flashCart(cart.name.id)">
            <img :src=" cart.name.image" alt="IMG">
          </div>

          <div class="header-cart-item-txt">
            <a href="#" class="header-cart-item-name">{{ cart.name.product_name }}</a>
            <span class="header-cart-item-info">{{ cart.qty }} X {{ cart.name.price }}</span>
          </div>
        </li>
        <!-- <li class="header-cart-item" v-else>No items in the cart</li> -->
      </ul>

      <div v-if="carts.length > 0" class="header-cart-total">Total: {{ getTotal }}</div>

      <div class="header-cart-buttons">
        <div class="header-cart-wrapbtn">
          <!-- Button -->
          <router-link
            class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4"
            to="/cartHome"
          >View Cart</router-link>
          <!-- <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4"></a> -->
        </div>
        <form action="/createpayment" method="post">
          <input type="hidden" name="_token" :value="csrf">
          <button
            class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4"
            type="submit" style="width: 125px;"
          >Check Out</button>
        </form>
      </div>
    </div>
  </div>
</template>


<script>
// import Avatar from "vue-avatar";
export default {
  components: {
    // Avatar
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
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
    },
    flashCart(cart) {
      // eventBus.$emit('flashEvent', data)

      eventBus.$emit("progressEvent");
      // eventBus.$emit("loadingRequest");
      axios
        .post(`/flashCart/${cart}`)
        .then(response => {
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
