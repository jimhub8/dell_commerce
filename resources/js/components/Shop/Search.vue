<template>
<div>
    <headerP></headerP>
    <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
    <section class="bgwhite p-t-55 p-b-65" v-show="!loader">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 p-b-50">
                    <h1 class="text-center">Search results for {{ search }}</h1>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-3 p-b-50" v-for="product in products.data" :key="product.id">
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
                                    <button class="block2-name dis-block s-text3 p-b-5" @click="detail(product.id)">{{ product.product_name }}</button>
                                    <span class="block2-price m-text6 p-r-5">{{ product.price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
export default {
  components: {
    headerP
  },
  data() {
    return {
      products: [],
      menus: [],
      search: this.$route.params.search,
      loader: false,
      wish: [],
      cat_id: null
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
    catId(item) {
      this.cat_id = item;
      this.FilterShop();
    },
    catAll() {
      this.cat_id = null;
      this.FilterShop();
    },

    detail(Pid) {
      this.$router.push({
        name: "details",
        params: {
          id: Pid
        }
      });
    },

    redirect(search) {
      this.$router.push({
        name: "search",
        params: {
          search: this.search
        }
      });
      this.getProduct(search);
    },
    getProduct(search) {
          this.loader = true;
      eventBus.$emit("progressEvent");
      axios
        .post(`/searchItems/${search}`)
        .then(response => {
        //   eventBus.$emit("ScollEvent");
          eventBus.$emit("StoprogEvent");
          this.loader = false;
          this.products = response.data;
          this.search = search;
        })
        .catch(error => {
          this.loader = false;
          eventBus.$emit("StoprogEvent");
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
    }
  },
  mounted() {
    this.loader = true;
    this.getProduct(this.$route.params.search);
  },
  created() {
    eventBus.$on("searchEvent", data => {
      this.redirect(data);
    });
  }
};
</script>

<style scoped>
.wrap-pic-w img {
  height: 300px;
}
</style>
