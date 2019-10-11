<template>
<div>
    <v-app id="inspire">
        <v-navigation-drawer right temporary v-model="right" fixed>
            <myCart></myCart>
        </v-navigation-drawer>
        <v-toolbar dark color="primary" style="z-index: 1;" fixed>
            <!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
            <v-toolbar-title class="white--text">
                <v-btn color="white" @click="unfilter" dark flat>Healthwise</v-btn>
            </v-toolbar-title>
            <div class="text-xs-center">
                <v-menu offset-y v-for="menu in menus" :key="menu.id">
                    <v-btn slot="activator" color="white" dark flat>
                        {{ menu.name }}
                    </v-btn>
                    <v-layout wrap style="background: #fff;">
                        <v-flex v-for="category in menu.categories" :key="category.id">
                            <v-list>
                                <v-subheader>
                                    <h3>{{ category.name }}</h3>
                                </v-subheader>
                                <v-list-tile v-for="subcats in category.sub_categories" :key="subcats.id" @click="categoryPro(subcats)">
                                    <v-list-tile-title>{{ subcats.name }}</v-list-tile-title>
                                    <v-divider></v-divider>

                                </v-list-tile>
                                <!-- <v-divider vertical></v-divider> -->
                            </v-list>
                            <v-divider vertical></v-divider>
                        </v-flex>
                    </v-layout>
                    <!-- <v-divider></v-divider>  -->
                </v-menu>
            </div>
            <v-spacer></v-spacer>
            <!-- <v-btn icon>
                <v-icon>search</v-icon>
            </v-btn> -->
            <v-tooltip bottom>
                <v-btn icon class="mx-0" @click.stop="right = !right" slot="activator">
                    <v-badge color="orange" left>
                        <span slot="badge">{{ cartItems.length }}</span>
                        <v-icon color="orange darken-2">shopping_cart</v-icon>
                    </v-badge>
                </v-btn>
                <span>Cart</span>
            </v-tooltip>
            <!-- <v-btn icon>
                <v-icon>apps</v-icon>
            </v-btn> -->
            <!-- <form class="form-inline">
                <div class="md-form my-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                </div>
            </form> -->
        </v-toolbar>
    </v-app>
    <Show></Show>
    <v-snackbar :timeout="timeout" :bottom="y === 'bottom'" :color="Scolor" :left="x === 'left'" v-model="snackbar">
        {{ message }}
        <v-icon dark right>check_circle</v-icon>
    </v-snackbar>
</div>
<!-- Navbar -->
</template>

<script>
import myCart from '../cart/Cart'
import Show from '../home/Show'
export default {
    // router,
    components: {
        Show,
        myCart
    },
    data() {
        return {
            cartItems: [],
            categories: [],
            menus: [],
            drawer: true,
            right: null,
            snackbar: false,
            y: 'bottom',
            x: 'left',
            Allusers: [],
            Scolor: '',
            timeout: 5000,
            message: "Success"
        }
    },
    methods: {
        categoryPro(data) {
            // console.log(data)
            eventBus.$emit("filterEvent", data.id);

            // router.go('')
            // this.$router.push(`/filter/${data.id}`)
        },
        unfilter() {
            this.loadingalert()
            eventBus.$emit("unfilterEvent");
        },
        getCart() {
            axios.get('/getCart')
                .then((response) => {
                    this.cartItems = response.data
                    eventBus.$emit("cartEvent", response.data);
                })
        },

        showalert() {
            this.message = "success";
            this.Scolor = "black";
            this.snackbar = true;
        },

        loadingalert() {
            this.message = "Loading...";
            this.Scolor = "black";
            this.y = "top";
            this.x = "right";
            this.snackbar = true;
        }
    },
    mounted() {
        this.getCart()
        axios.get("/categories")
            .then(response => {
                this.categories = response.data;
            })
            .catch(error => {
                // this.loading = false;
                this.errors = error.response.data.errors;
            });

        axios.get("/menus")
            .then(response => {
                this.menus = response.data;
            })
            .catch(error => {
                // this.loading = false;
                this.errors = error.response.data.errors;
            });

    },
    created() {
        eventBus.$on("cartEvent", data => {
            this.cartItems = data;
        });
        eventBus.$on('alertRequest', data => {
            this.showalert()
        })
        eventBus.$on('loadingRequest', data => {
            this.loadingalert()
        })

        this.timer = window.setInterval(() => {
            this.getCart();
            // eventBus.$emit("cartEvent", response.data);
        }, 60000);
    },
}
</script>

<style scoped>
.dropdown:hover .dropdown-menu {
    display: block;
}

.navbar .dropdown-menu {
    width: 400px !important;
}

.navbar-expand-lg {
    position: fixed;
    background: #132f51 !important;
    z-index: 1;
    width: 100%;
    margin-top: -25px;
    padding: 10px 0px;
}

.theme--light.v-list {
    padding: 20px !important;
}
</style>
