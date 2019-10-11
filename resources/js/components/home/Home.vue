<template>
<div id="contain">
    <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
    <div v-show="!loader" id="container" style="margin-top: -105px;">
        <div class="after"></div>
        <div id="backImage">
            <v-layout wrap>
                <v-flex sm12 md12>
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                        <!-- <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li
                  data-target="#carouselExampleIndicators"
                  v-for="(item, index) in headerPro"
                  :key="index"
                  :data-slide-to="parseInt(index)+parseInt(1)"
                ></li>
              </ol> -->
                        <div class="carousel-inner" id="container">
                            <div class="carousel-item active">
                                <div class="image-container">
                                    <img
                      class="d-block w-100"
                      :src="singleP.image"
                      alt="First slide"
                      style="height: 100vh;"
                    >
                                    <!-- <img class="d-block w-100" src="storage/products/product1.jpg" alt="First slide"> -->
                                    <div class="after"></div>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h1 class="wow fadeInUp" data-wow-delay="0.8s">
                                            <strong>{{ singleP.name }}</strong>
                                        </h1>
                                        <v-divider></v-divider>
                                        <p class="wow fadeInUp" data-wow-delay="1.2s" style="color: rgba(240, 240, 240, 0.77);">
                                            <b>{{ singleP.description }}</b>
                                        </p>
                                        <p class="wow fadeInUp" data-wow-delay="1.6s">For only {{ singleP.price }}</p>
                                        <v-btn @click="view(singleP)" raised color="primary" data-wow-delay="2.0s">See Item</v-btn>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" v-for="product in headerPro" :key="product.id">
                                <div class="image-container">
                                    <img
                      class="d-block w-100"
                      :src="product.image"
                      alt="First slide"
                      style="height: 100vh;"
                    >
                                    <!-- <img class="d-block w-100" src="storage/products/product2.jpg" alt="First slide"> -->
                                    <div class="after"></div>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h1 class="wow fadeInUp" data-wow-delay="0.8s">
                                            <strong>{{ product.name }}</strong>
                                        </h1>
                                        <v-divider></v-divider>
                                        <p class="wow fadeInUp" data-wow-delay="1.2s" style="color: rgba(240, 240, 240, 0.77);">
                                            <b>{{ product.description }}</b>
                                        </p>
                                        <p class="wow fadeInUp" data-wow-delay="1.6s">For only {{ product.price }}</p>
                                        <v-btn @click="view(product)" raised color="info" class="wow flipInY" data-wow-delay="2.0s">See Item</v-btn>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a
                class="carousel-control-prev"
                href="#carouselExampleIndicators"
                role="button"
                data-slide="prev"
              >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
                        <a
                class="carousel-control-next"
                href="#carouselExampleIndicators"
                role="button"
                data-slide="next"
              >
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
                        <!-- <v-btn
                raised
                v-scroll-to="'#carousel'"
                style="margin-left: 45%; margin-top: -100px;"
              >Scroll</v-btn>-->
                        <div style="margin-top: -100px; margin-left: 50vw;">
                            <v-btn icon class="mx-0" slot="activator" v-scroll-to="'#carousel'" raised>
                                <v-icon color="white darken-2" large>keyboard_arrow_down</v-icon>
                            </v-btn>
                        </div>
                    </div>
                </v-flex>
                <!-- <v-flex sm2 md2 offset-md1 offset-sm1>
            <v-layout wrap style="margin-top: 150px;">
              <v-flex xs12 sm12>
                <v-btn round @click="prescription" color="success">Upload Prescription</v-btn>
              </v-flex>
              <v-divider></v-divider>
              <v-flex xs12 sm12 style="margin-top: 20px;">
                <v-btn round @click="authenticate" color="error">Authenticate Product</v-btn>
              </v-flex>
            </v-layout>
          </v-flex>-->
            </v-layout>
        </div>
        <div id="carousel">
            <myProduct></myProduct>
            <myFilter v-show="filter"></myFilter>
            <Prescription></Prescription>
            <Show></Show>
        </div>
    </div>
</div>
</template>

<script>
// import myShop from '../Shop/Shop'
import myFilter from "../filter/Filter";
import Prescription from "./Prescription";
import myProduct from "../product/Sliders";
// import myShop from "../Shop/Shop";
// import CartHome from "../cart/CartHome";
import Show from "../home/Show";
export default {
    components: {
        // myShop,
        // myShop,
        // CartHome,
        Show,
        myProduct,
        myFilter,
        Prescription
    },
    data() {
        return {
            singleP: [],
            singleT: [],
            singleTN: [],
            headerPro: [],
            loader: false,
            filter: false
        };
    },
    methods: {
        // addToCart(cart) {
        //   console.log(cart);
        //   eventBus.$emit("loadingRequest");
        //   axios
        //     .post(`/cart/${cart}`)
        //     .then(response => {
        //       eventBus.$emit("cartEvent", response.data);
        //       // this.cart = response.data
        //       // this.message = "added";
        //       eventBus.$emit("alertRequest", 'Cart Added');
        //       // this.snackbar = true;
        //     })
        //     .catch(error => {
        //       this.loading = false;
        //       this.errors = error.response.data.errors;
        //     });
        // },

        view(product) {
            eventBus.$emit("viewProEvent", product);
        },
        prescription() {
            eventBus.$emit("prescriptionEvent");
        },
        authenticate() {
            eventBus.$emit("authenticateEvent");
        }
    },
    mounted() {
        // eventBus.$emit('StoprogEvent');
        // alert('enter')
        (this.loader = true),
        axios
            .get("/getTP")
            .then(response => {
                (this.loader = false), (this.singleT = response.data);
            })
            .catch(error => {
                this.loader = false;
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

        axios
            .get("/getTP?page=2")
            .then(response => {
                this.singleTN = response.data;
            })
            .catch(error => {
                // this.loading = false;
                this.errors = error.response.data.errors;
            });

        axios
            .get("/headerPro")
            .then(response => {
                this.headerPro = response.data;
            })
            .catch(error => {
                // this.loading = false;
                this.errors = error.response.data.errors;
            });
    },
    created() {
        // eventBus.$on("addCartEvent", data => {
        //   this.addToCart(data);
        // });
        eventBus.$on("filterEvent", data => {
            this.filter = true;
        });

        eventBus.$on("unfilterEvent", data => {
            this.filter = false;
        });
    },
    beforeRouteLeave(to, from, next) {
        // eventBus.$emit('progressEvent');
        next();
    },

    updated() {
        // alert('updated')
        // eventBus.$emit("StoprogEvent");
    }
};
</script>

<style scoped>
.carousel-caption {
    margin-bottom: 70px;
    width: 30%;
    /* color: #000; */
}

#container {
    position: relative;
    width: 100%;
    height: 100%;
}

#container.after {
    position: absolute;
    color: #000;
    display: block;
}

#container:hover.after {
    display: block;
    background: rgba(0, 0, 0, 6);
}

.image-container {
    position: relative;
    height: 100vh;
    width: 100%;
    background: rgba(0, 0, 0, 0.45);
}

.image-container .after {
    position: absolute;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100%;
    display: block;
    color: #fff;
    background: rgba(30, 43, 111, 0.58);
}

/* .image-container:hover .after {
  display: block;
  background: rgba(0, 0, 0, 0.45);
} */

#backImage {
    /* background: url(/storage/cover/pixel.jpeg); */
    background-position: center;
    background-attachment: fixed;
    /* background-repeat: no-repeat;  */
}

.carousel-control-prev {
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    font-size: 18px;
    color: white;
    position: absolute;
    background-color: black;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    border-radius: 50%;
    z-index: 200;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

.carousel-control-next {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    color: white;
    position: absolute;
    background-color: black;
    top: 50%;
    padding: 10px;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    border-radius: 50%;
    z-index: 200;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}
</style>
