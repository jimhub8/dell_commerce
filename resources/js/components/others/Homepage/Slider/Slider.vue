<template>
  <div>
    <section class="slide1">
      <div class="wrap-slick1">
        <div class="slick1">
          <div
            class="item-slick1 item1-slick1"
            style="background-image: url(/healthwise/products/4kBP0hPRMqkl2lxoygnQkbwYaJSKlT8NNi9omLbe.jpeg);">
            <div v-for="pro in headerPro" :key="pro.id" class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
              <h2
                class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22"
                data-appear="fadeInUp"
              >Leather Bags</h2>

              <span
                class="caption2-slide1 m-text1 t-center animated visible-false m-b-33"
                data-appear="fadeInDown"
              >New Collection 2018</span>

              <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
                <!-- Button -->
                <a
                  href="product.html"
                  class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4"
                >Shop Now</a>
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
  // props: ['singleP'],
  data() {
    return {
      singleP: [],
      headerPro: []
    };
  },

  mounted() {
    axios
      .get("/headerPro")
      .then(response => {
        this.headerPro = response.data;
      })
      .catch(error => {
        // this.loading = false;
        this.errors = error.response.data.errors;
      });
    axios
      .get("/getsP")
      .then(response => {
        this.singleP = response.data;
      })
      .catch(error => {
        // this.loading = false;
        this.errors = error.response.data.errors;
      });
  }
};
</script>
