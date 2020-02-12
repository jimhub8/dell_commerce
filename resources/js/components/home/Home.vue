<template>
<div class="" id="contain">
    <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
    <div v-show="!loader" id="container">
        <!-- <div class="after container" @mouseleave="menuShow = false">
            <div class="row" style="margin-top: 7vh;z-index: 1000;position: absolute;background:#f00">
            <v-btn @click="catShow = !catShow">Categories</v-btn>
                <div class="col-2" style="min-width: 300px;max-width: 300px;margin-left: -5vw;" v-show="catShow">
                    <div class="list-group" id="list-tab" role="tablist" style="text-align: right;">
                        <li class="" id="list-home-list" data-toggle="list" role="tab" aria-controls="home" v-for="(item, index) in menus" :key="index" @mouseover="showMenu(item)">{{ item.name }}</li>
                    </div>
                </div>
                <div class="col-10" style="margin-left: -2vw;">
                    <div class="tab-content" id="nav-tabContent" v-show="menuShow" style="background: #fff;">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <div class="row wrap">
                                <div class="card-columns col-md-10">
                                    <div class="card" v-for="(category, index) in categories" :key="index" style="margin: 0; width: 110%; border: none;">
                                        <div class="card-body" style="padding: 0;" id="category">
                                            <li class="active">{{ category.name }}</li>
                                            <li class="card-text" v-for="subcat in category.sub_categories" :key="subcat.id" @click="gotoSub(subcat.id)">{{ subcat.name }}</li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <Menu></Menu> -->

        <div id="backImage">
            <v-layout wrap style="margin-top: 15px;">

                <v-flex sm12 md12>
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" v-for="(item, index) in headerPro" :key="index" :data-slide-to="parseInt(index)+parseInt(1)"></li>
                        </ol>
                        <div class="carousel-inner" id="container">
                            <div class="carousel-item active">
                                <div class="image-container">
                                    <img class="d-block w-100" :src="singleP.image" alt="First slide" style="height: 60vh;">
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
                                    <img class="d-block w-100" :src="product.image" alt="First slide" style="height: 60vh;">
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
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </v-flex>
                <v-flex sm2 md2 offset-md1 offset-sm1>
                    <!-- <v-layout wrap style="margin-top: 150px;">
                        <v-flex xs12 sm12>
                            <v-btn round @click="prescription" color="success">Upload Prescription</v-btn>
                        </v-flex>
                        <v-divider></v-divider>
                        <v-flex xs12 sm12 style="margin-top: 20px;">
                            <v-btn round @click="authenticate" color="error">Authenticate Product</v-btn>
                        </v-flex>
                    </v-layout> -->
                </v-flex>
            </v-layout>
        </div>
        <myProduct></myProduct>
        <myFilter v-show="filter"></myFilter>
        <!-- <Prescription></Prescription> -->
        <Show></Show>
    </div>
</div>
</template>

<script>
// import myShop from '../Shop/Shop'
import myFilter from "../filter/Filter";
import myProduct from "../product/Sliders";
// import myShop from "../Shop/Shop";
// import CartHome from "../cart/CartHome";
import Show from "../home/Show";
import Menu from "./Menu";
export default {
    components: {
        // myShop,
        // myShop,
        // CartHome,
        Menu,
        Show,
        myProduct,
        myFilter
    },
    data() {
        return {
            singleP: [],
            singleT: [],
            singleTN: [],
            headerPro: [],
            menus: [],
            categories: [],
            loader: false,
            catShow: false,
            menuShow: false,
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

        gotoSub(item) {
            this.$router.push({
                name: "Category",
                params: {
                    id: item,
                    type: "subcat"
                }
            });
            // eventBus.$emit("gotoSUbcatEvent", item);
        },
        gotoCat(item) {
            this.$router.push({
                name: "Category",
                params: {
                    id: item,
                    type: "cat"
                }
            });
            // eventBus.$emit("gotoCatEvent", item);
        },
        showMenu(menu) {
            this.menuShow = true;
            this.categories = menu.categories;
        },

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
        eventBus.$emit("ScollTopEvent");
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

        axios
            .get("menus")
            .then(response => {
                this.menus = response.data;
            })
            .catch(error => {
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
    height: 60vh;
    width: 100%;
    background: rgba(0, 0, 0, 0.45);
}

.image-container .after {
    position: absolute;
    top: 0;
    left: 0;
    height: 60vh;
    width: 100%;
    display: block;
    color: #fff;
    background: rgba(0, 0, 0, 0.45);
}

.image-container:hover .after {
    display: block;
    background: rgba(0, 0, 0, 0.45);
}

#backImage {
    /* background: url(/storage/cover/pixel.jpeg); */
    background-position: center;
    /* background-repeat: no-repeat;  */
}

#category .active {
    color: #e65540;
    padding: 5px 0;
    cursor: pointer;
    /* font-size: 17px; */
    font-style: italic;
    font-weight: bold;
}

#category .card-text {
    cursor: pointer;
    padding: 5px 0;
}

#category .card-text:hover {
    color: #f00;
}
</style>
