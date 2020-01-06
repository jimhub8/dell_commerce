<template>
<v-container fluid grid-list-md>
    <v-data-iterator :items="product.data" :rows-per-page-items="rowsPerPageItems" :pagination.sync="pagination" content-tag="v-layout" row wrap>
        <v-toolbar slot="header" class="mb-2" color="white darken-5" dark flat>
            <v-toolbar-title style="color: #000; margin: auto;margin-top: -50px;">Best Sell</v-toolbar-title>
            <hr>
        </v-toolbar>
        <v-flex slot="item" slot-scope="props" xs12 sm6 md4 lg3 v-if="props.item.best_sell">
            <v-card>
                <!-- <v-divider></v-divider> -->
                <v-card-text>
                    <v-content>
                        <div class="image-container">
                            <v-img class="white--text" height="230px" :src="props.item.image">
                                <!-- <v-container fill-height fluid>
                                    <v-layout fill-height>
                                        <v-flex xs12 align-end flexbox>
                                            <span class="headline" style="color: #808385;">{{ props.item.name }}</span>
                                        </v-flex>
                                    </v-layout>
                                </v-container> -->
                            </v-img>

                            <!-- <div class="after">This is some content</div> -->
                            <div class="caption after text-center  trans-0-4" :class="{'selected': isSelected(props.item.id)}">
                                <v-btn color="primary" flat style="margin: auto;">{{ props.item.name }}</v-btn>
                                <div id="tooltip">
                                    <v-tooltip bottom data-wow-delay="0.4s" class="trans-0-4">
                                        <v-btn icon class="mx-0" slot="activator" @click="view(props.item)" style="margin-top: 60px;">
                                            <v-icon color="info darken-2" small>visibility</v-icon>
                                        </v-btn>
                                        <span>view product</span>
                                    </v-tooltip>
                                    <v-tooltip bottom class="trans-0-4" data-wow-delay="0.8s">
                                        <v-btn icon class="mx-0" slot="activator" @click="wishList(props.item.id)" style="margin-top: 60px;">
                                            <v-icon color="success darken-2" small>favorite</v-icon>
                                        </v-btn>
                                        <span>Wish list</span>
                                    </v-tooltip>
                                    <v-tooltip bottom class="trans-0-4" data-wow-delay="1.2s">
                                        <v-btn icon class="mx-0" slot="activator" @click="addToCart(props.item.id)" style="margin-top: 60px;">
                                            <v-icon color="orange darken-2" small>shopping_cart</v-icon>
                                        </v-btn>
                                        <span>Add To Cart</span>
                                    </v-tooltip>
                                </div>
                            </div>
                        </div>
                    </v-content>
                </v-card-text>
                <v-divider></v-divider>
                <div class="text-center" style="background: #f0f0f0;">
                    <!-- <v-btn flat color="orange" @click="redirect(props.item.id)">{{ props.item.product_name }}</v-btn> -->
                    <p  @click="redirect(props.item.id)" style="cursor: pointer">{{ props.item.product_name }}</p>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <small class="text-danger">List price: <s>{{ props.item.list_price }}</s></small>

                        </div>
                        <div class="col-6">
                            <p class="price">Our price: {{ props.item.price }}</p>

                        </div>
                    </div>
                    <!-- <v-divider></v-divider> -->
                </div>
            </v-card>
        </v-flex>
    </v-data-iterator>
</v-container>
</template>

<script>
export default {
    props: ['product'],
    data: () => ({
        rowsPerPageItems: [4, 8, 12],
        pagination: {
            rowsPerPage: 4
        },
        selectedCard: -1,
        bestSell: []
    }),
    methods: {
        redirect(proId) {
            // alert('oooo')
            this.$router.push({
                name: 'details',
                params: {
                    id: proId
                }
            })

        },
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

        addToCart(cart) {
            eventBus.$emit("addCartEvent", cart);
        },
        wishList(item) {
            eventBus.$emit("WishListEvent", item);
        }
    },
    mounted() {
        axios.get("/bestSell").then(response => {
            this.bestSell = response.data;
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
    transition: cubic-bezier(0.6, 0.04, 0.98, 0.335);
    transition-delay: 500ms;
    transition-duration: 1s;
    transition-timing-function: cubic-bezier(0.165, 0.84, 0.44, 1);
    animation: ease-in-out;
    animation-duration: 1s;
    animation-name: inherit;
    animation-fill-mode: both;
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

/* .v-btn--active, .v-btn:focus, .v-btn:hover {
    white-space: nowrap !important;
    text-overflow: ellipsis !important;
    max-width: 320px !important;
    overflow: hidden !important;
    display: block !important;
    -webkit-line-clamp: 6 !important;
} */
</style>
