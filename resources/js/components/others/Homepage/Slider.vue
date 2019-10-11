<template>
  <div v-if="mountEl">
    <section class="newproduct bgwhite p-t-45 p-b-105">
      <div class="container">
        <div class="sec-title p-b-60">
          <h3 class="m-text5 t-center">Featured Products</h3>
        </div>
 
        <!-- Slide2 -->
        <div class="wrap-slick2">
          <div class="slick2">
            <!-- <div class="item-slick2 p-l-15 p-r-15" v-for="product in products" :key="product.id"> -->
            <div class="item-slick2 p-l-15 p-r-15" v-for="i in 12" :key="i">
              <!-- Block2 -->
              <div class="block2">
                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                  <img src="/storage/img/bg-6.jpg" alt="IMG-PRODUCT">

                  <div class="block2-overlay trans-0-4">
                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                      <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                      <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                    </a>

                    <div class="block2-btn-addcart w-size1 trans-0-4">
                      <!-- Button -->
                      <button
                        class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4"
                      >Add to Cart</button>
                    </div>
                  </div>
                </div>

                <div class="block2-txt p-t-20">
                  <a
                    href="product-detail.html"
                    class="block2-name dis-block s-text3 p-b-5"
                  >Coach slim easton black</a>
                  
                  <span class="block2-price m-text6 p-r-5">$165.90</span>
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
export default {
  data() {
    return {
      products: {},
      mountEl: false,
    };
  },
  beforeCreate() {
    axios
      .get("/getProducts")
      .then(response => {
        this.products = response.data;
      })
      .catch(error => {
        this.loading = false;
        this.errors = error.response.data.errors;
      });
  },
  mounted() {
        this.mountEl = true
  },
};
</script>