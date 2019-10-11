<template>
  <div>
    <headerP></headerP>
    <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
      <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
    <!-- <v-btn flat color="primary" @click="getWish">Get</v-btn> -->
    <section class="bgwhite p-t-115 p-b-58" style="background: #f8fafc;">
		<div class="container">
			<div class="sec-title p-b-22">
				<h3 class="m-text5 t-center">
					Your Wish List
				</h3>
			</div>

			<!-- Tab01 --> 
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist" style=" padding: 30px 0;background: rgb(239, 243, 247)">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab">Best Seller</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#featured" role="tab">Featured</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#sale" role="tab">New Products</a>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#top-rate" role="tab">Top Rate</a>
					</li> -->
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-35">
					<!-- - -->
					<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
						<div class="row">
							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50" v-for="wish in wishes" :key="wish.id" v-if="wish.best_sell === 1">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
										<img :src="wish.image" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<v-tooltip bottom style="margin-left: 90%;">
                                                <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(wish.id)" style="margin-top: -20px;">
                                                    <v-icon color="pink darken-2" large>favorite</v-icon>
                                                </v-btn>
                                                <span>Wish list</span>
                                            </v-tooltip>


											<div class="block2-btn-addcart w-size1 trans-0-4">
												<!-- Button -->
												<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
													Add to Cart
												</button>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
											{{ wish.name }}
										</a>

										<span class="block2-price m-text6 p-r-5">
											{{ wish.price }}
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="featured" role="tabpanel">
						<div class="row">
							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50" v-for="wish in wishes" :key="wish.id" v-if="wish.featured === 1">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelfeatured">
										<img :src="wish.image" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<v-tooltip bottom style="margin-left: 90%;">
                                                <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(wish.id)" style="margin-top: -20px;">
                                                    <v-icon color="pink darken-2" large>favorite</v-icon>
                                                </v-btn>
                                                <span>Wish list</span>
                                            </v-tooltip>


											<div class="block2-btn-addcart w-size1 trans-0-4">
												<!-- Button -->
												<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
													Add to Cart
												</button>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
											{{ wish.name }}
										</a>

										<span class="block2-oldprice m-text7 p-r-5">
											{{ wish.price }}
										</span>

										<span class="block2-newprice m-text8 p-r-5">
											{{ wish.price }}
										</span>
									</div>
								</div>
							</div>

						</div>
					</div>

					<!--  -->
					<div class="tab-pane fade" id="sale" role="tabpanel">
						<div class="row">
							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50" v-for="wish in wishes" :key="wish.id" v-if="wish.new_product === 1">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
										<img :src="wish.image" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<v-tooltip bottom style="margin-left: 90%;">
                                                <v-btn icon class="mx-0 block2-btn-addwishlist hov-pointer trans-0-4" slot="activator" @click="addToWish(wish.id)" style="margin-top: -20px;">
                                                    <v-icon color="pink darken-2" large>favorite</v-icon>
                                                </v-btn>
                                                <span>Wish list</span>
                                            </v-tooltip>


											<div class="block2-btn-addcart w-size1 trans-0-4">
												<!-- Button -->
												<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
													Add to Cart
												</button>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
											{{ wish.name }}
										</a>

										<span class="block2-price m-text6 p-r-5">
											{{ wish.price }}
										</span>
									</div>
								</div>
							</div>
				</div>
				</div>
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
      categories: [],
      items: [
        {
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
      price: [
        {
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
      wishes: [],
      cat_id: null,
    };
  },
  methods: {
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
    getCategory() {
      axios
        .get("/categories")
        .then(response => {
          this.categories = response.data;
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
      axios.get("/wish").then(response => {
          eventBus.$emit("StoprogEvent");
        this.wishes = response.data;
      })
        .catch(error => {
          eventBus.$emit("StoprogEvent");
          this.errors = error.response.data.errors;
        });
    },
    addToWish(item) {
      eventBus.$emit("WishListEvent", item);
    },
  },
  mounted() {
    this.loader = true;
    this.FilterShop();
    this.getWish(); 
    this.getCategory();
  },
  created() {
    eventBus.$on("RefWishEvent", data => {
      this.getWish()
    });
  },
};
</script>

<style scoped>
.wrap-pic-w img {
  height: 300px;
}
</style>
