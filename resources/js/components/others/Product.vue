<template>
<v-layout wrap class="container-fluid">
    <!-- <v-flex sm3>
        <mySidebar></mySidebar>
    </v-flex> -->
    <h1 class="text-center" style="width: 100%;">Bestsellers</h1>
    <v-divider></v-divider>
    <v-flex sm12>
        <v-layout wrap>
            <v-flex sm3 v-for="(bestS, index) in bestSell.data" :key="index" :ref="`bestS_${index}`" @mouseover="hoverCard(index)" @mouseout="hoverCard(-1)">
                <v-card>
                    <v-card-title id="container">
                        <div class="image-container">
                            <img class="d-block w-100" :src="bestS.image" alt="First slide"
                    :class="{'selected': isSelected(index)}" @mouseover="hoverCard(index)" @mouseout="hoverCard(-1)">

                            <!-- <div class="after">This is some content</div> -->
                            <div class="caption after text-center" :class="{'selected': isSelected(index)}">
                                <!-- <v-btn color="primary" flat style="margin: auto;" @click="view(bestS)">view bestS</v-btn>  -->
                                <div id="tooltip">
                                    <v-tooltip bottom class="" data-wow-delay="0.4s">
                                        <v-btn icon class="mx-0" slot="activator" @click="view(bestS)" style="margin-top: 100px;">
                                            <v-icon color="info darken-2" small>visibility</v-icon>
                                        </v-btn>
                                        <span>view bestS</span>
                                    </v-tooltip>
                                    <v-tooltip bottom class="" data-wow-delay="0.8s">
                                        <v-btn icon class="mx-0" slot="activator" @click="wishList(bestS)" style="margin-top: 100px;">
                                            <v-icon color="success darken-2" small>favorite</v-icon>
                                        </v-btn>
                                        <span>Wish list</span>
                                    </v-tooltip>
                                    <v-tooltip bottom class="" data-wow-delay="1.2s">
                                        <v-btn icon class="mx-0" slot="activator" @click="addToCart(bestS.id)" style="margin-top: 100px;">
                                            <v-icon color="orange darken-2" small>shopping_cart</v-icon>
                                        </v-btn>
                                        <span>Add To Cart</span>
                                    </v-tooltip>
                                </div>
                            </div>
                        </div>
                    </v-card-title>
                </v-card>
                <v-card-text>
                    <h4 class="text-center">{{ bestS.name }}</h4>
                    <p class="text-center">KSH {{ bestS.price }}</p>
                </v-card-text>
            </v-flex>
            <div v-show="nextPage" style="text-align: center; width: 100%;">
                <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
            </div>
            <div class="text-xs-center" style="margin: auto; width: 100%;" v-if="bestSell.last_page > 1">
                <v-pagination v-model="bestSell.current_page" :length="bestSell.last_page" total-visible="5" @input="next(bestSell.path, bestSell.current_page, 'bestSell')" circle></v-pagination>
            </div>
            <v-snackbar :timeout="timeout" top="top" :color="color" right="right" v-model="snackbar">
                {{ message }}
                <v-icon dark right>check_circle</v-icon>
            </v-snackbar>
        </v-layout>
    </v-flex>

    <h1 class="text-center" style="width: 100%;">Featured Products</h1>
    <v-divider style="width: 100%; color: red; backgroung: red"></v-divider>
    <v-flex sm12>
        <v-layout wrap>
            <v-flex sm3 v-for="(prod, index) in featured.data" :key="index" :ref="`product_${index}`" @mouseover="hoverCard(index)" @mouseout="hoverCard(-1)">
                <v-card>
                    <v-card-title id="container">
                        <div class="image-container">
                            <img class="d-block w-100" :src="prod.image" alt="First slide"
                    :class="{'selected': isSelected(index)}" @mouseover="hoverCard(index)" @mouseout="hoverCard(-1)">

                            <!-- <div class="after">This is some content</div> -->
                            <div class="caption after text-center" :class="{'selected': isSelected(index)}">
                                <!-- <v-btn color="primary" flat style="margin: auto;" @click="view(prod)">view prod</v-btn>  -->
                                <div id="tooltip">
                                    <v-tooltip bottom class="" data-wow-delay="0.4s">
                                        <v-btn icon class="mx-0" slot="activator" @click="view(prod)" style="margin-top: 100px;">
                                            <v-icon color="info darken-2" small>visibility</v-icon>
                                        </v-btn>
                                        <span>view product</span>
                                    </v-tooltip>
                                    <v-tooltip bottom class="" data-wow-delay="0.8s">
                                        <v-btn icon class="mx-0" slot="activator" @click="wishList(prod)" style="margin-top: 100px;">
                                            <v-icon color="success darken-2" small>favorite</v-icon>
                                        </v-btn>
                                        <span>Wish list</span>
                                    </v-tooltip>
                                    <v-tooltip bottom class="" data-wow-delay="1.2s">
                                        <v-btn icon class="mx-0" slot="activator" @click="addToCart(prod.id)" style="margin-top: 100px;">
                                            <v-icon color="orange darken-2" small>shopping_cart</v-icon>
                                        </v-btn>
                                        <span>Add To Cart</span>
                                    </v-tooltip>
                                </div>
                            </div>
                        </div>
                    </v-card-title>
                </v-card>
                <v-card-text>
                    <h4 class="text-center">{{ prod.name }}</h4>
                    <p class="text-center">KSH {{ prod.price }}</p>
                </v-card-text>
            </v-flex>
            <div v-show="nextPage" style="text-align: center; width: 100%;">
                <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
            </div>
            <div class="text-xs-center" style="margin: auto; width: 100%;" v-if="featured.last_page > 1">
                <v-pagination v-model="featured.current_page" :length="featured.last_page" total-visible="5" @input="next(featured.path, featured.current_page, 'featured')" circle></v-pagination>
            </div>
            <v-snackbar :timeout="timeout" top="top" :color="color" right="right" v-model="snackbar">
                {{ message }}
                <v-icon dark right>check_circle</v-icon>
            </v-snackbar>
        </v-layout>
    </v-flex>

    <h1 class="text-center" style="width: 100%;">New Products</h1>
    <v-divider style="width: 100%; color: red; backgroung: red"></v-divider>
    <v-flex sm12>
        <v-layout wrap>
            <v-flex sm3 v-for="(item, index) in newProduct.data" :key="index" :ref="`product_${index}`" @mouseover="hoverCard(index)" @mouseout="hoverCard(-1)">
                <v-card>
                    <v-card-title id="container">
                        <div class="image-container">
                            <img class="d-block w-100" :src="item.image" alt="First slide"
                    :class="{'selected': isSelected(index)}" @mouseover="hoverCard(index)" @mouseout="hoverCard(-1)">

                            <!-- <div class="after">This is some content</div> -->
                            <div class="caption after text-center" :class="{'selected': isSelected(index)}">
                                <!-- <v-btn color="primary" flat style="margin: auto;" @click="view(item)">view item</v-btn>  -->
                                <div id="tooltip">
                                    <v-tooltip bottom class="" data-wow-delay="0.4s">
                                        <v-btn icon class="mx-0" slot="activator" @click="view(item)" style="margin-top: 100px;">
                                            <v-icon color="info darken-2" small>visibility</v-icon>
                                        </v-btn>
                                        <span>view Product</span>
                                    </v-tooltip>
                                    <v-tooltip bottom class="" data-wow-delay="0.8s">
                                        <v-btn icon class="mx-0" slot="activator" @click="wishList(item)" style="margin-top: 100px;">
                                            <v-icon color="success darken-2" small>favorite</v-icon>
                                        </v-btn>
                                        <span>Wish list</span>
                                    </v-tooltip>
                                    <v-tooltip bottom class="" data-wow-delay="1.2s">
                                        <v-btn icon class="mx-0" slot="activator" @click="addToCart(item.id)" style="margin-top: 100px;">
                                            <v-icon color="orange darken-2" small>shopping_cart</v-icon>
                                        </v-btn>
                                        <span style="margin-top: -100px;">Add To Cart</span>
                                    </v-tooltip>
                                </div>
                            </div>
                        </div>
                    </v-card-title>
                </v-card>
                <v-card-text>
                    <h4 class="text-center">{{ item.name }}</h4>
                    <p class="text-center">KSH {{ item.price }}</p>
                </v-card-text>
            </v-flex>
            <div v-show="nextPage" style="text-align: center; width: 100%;">
                <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
            </div>
            <div class="text-xs-center" style="margin: auto; width: 100%;" v-if="newProduct.last_page > 1">
                <v-pagination v-model="newProduct.current_page" :length="newProduct.last_page" total-visible="5" @input="next(newProduct.path, newProduct.current_page, 'newProduct')" circle></v-pagination>
            </div>
            <v-snackbar :timeout="timeout" top="top" :color="color" right="right" v-model="snackbar">
                {{ message }}
                <v-icon dark right>check_circle</v-icon>
            </v-snackbar>
        </v-layout>
    </v-flex>
</v-layout>
</template>

<script>
// import mySidebar from './Sidebar'
export default {
    components: {
        // mySidebar
    },
    data() {
        return {
            products: [],
            timeout: 5,
            snackbar: false,
            color: "black",
            message: "",
            nextPage: false,
            selectedCard: -1,
            featured: [],
            bestSell: [],
            newProduct: [],
        };
    },
    methods: {
        hoverCard(selectedIndex) {
            this.selectedCard = selectedIndex;
            // this.animateCards()
        },
        isSelected(cardIndex) {
            return this.selectedCard === cardIndex;
        },
        view(product) {
            eventBus.$emit("viewProEvent", product);
        },
        wishList() {},
        addToCart(cart) {
            eventBus.$emit("addCartEvent", cart);
        },

        next(page, current_page, resp) {
            // console.log(resp)
            this.nextPage = true;
            axios
                .get(page + `?page=` + current_page, this.form)
                .then(response => {
                    this.nextPage = false;
                    if (resp === 'featured') {
                        // alert('featered')
                        this.featured = response.data;
                    }else if (resp === 'newProduct') {
                        // alert('newProduct')
                        this.newProduct = response.data;
                    } else if (resp === 'bestSell') {
                        // alert('bestSell')
                        this.bestSell = response.data;
                    } else{
                        // alert('nooop')
                    }
                });
        },
        // next(page) {
        //     this.nextPage = true;
        //     axios
        //         .get(
        //             this.products.path + `?page=` + this.products.current_page,
        //             this.form
        //         )
        //         .then(response => {
        //             this.nextPage = false;
        //             this.products = response.data;
        //         });
        // },
        getProducts() {
            axios
                .get("/products")
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        }
    },
    mounted() {
        this.getProducts()
        axios.get('/featured')
            .then((response) => {
                this.featured = response.data
            })

        axios.get('/bestSell')
            .then((response) => {
                this.bestSell = response.data
            })

        axios.get('/newProduct')
            .then((response) => {
                this.newProduct = response.data
            })
    },

    created() {
        eventBus.$on("proFiltertEvent", data => {
            this.products = data;
        });
    }
};
</script>

<style scoped>
.w-100 {
    height: 230px;
    transition: height 0.3s, opacity 0.3s;
}

.w-100.selected {
    transition: height 0.6s, opacity 0.6s;
    /* zoom: 1.2; */
    opacity: 0.8;
}

.caption {
    display: none;
}

.caption.selected {
    transition: height 0.6s, opacity 0.6s;
    display: block;
}

#container {
    position: relative;
    width: 100%;
    height: 100%;
}

#container.after {
    position: absolute;
    color: #000;
    display: none;
}

#container:hover.after {
    display: block;
    background: rgba(0, 0, 0, 6);
}

.image-container {
    position: relative;
    height: 230px;
    width: 100%;
}

.image-container .after {
    position: absolute;
    top: 0;
    left: 0;
    height: 230px;
    width: 100%;
    display: none;
    color: #fff;
}

.image-container:hover .after {
    display: block;
    background: rgba(0, 0, 0, 0.6);
}

#tooltip .v-btn {
    background: rgba(240, 240, 240, 0.26);
}

#tooltip .v-btn:hover {
    background: rgba(0, 0, 0, 0.24);
}

.v-btn .v-btn__content .v-icon {
    box-shadow: 0 9px 30px -6px rgba(255, 54, 54, 0.5);
}

/* .theme--light.v-pagination .v-pagination__item {
    display: none !important;
} */

</style>
