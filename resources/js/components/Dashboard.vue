<template>
<v-content>
    <v-container fluid fill-height>
        <v-layout justify-center align-center>
            <v-flex sm12>
                <v-layout wrap>
                    <div class="panel-header panel-header-lg row" style="width: 120% !important">
                        <div class="column">
                            <h3 class="text-center" style="color: #fff;">Products Chart</h3>
                            <my-product :height="255" :width="1200"></my-product>
                        </div>
                    </div>
                </v-layout>
                <div class="col-md-12">
                    <div class="card card-stats card-raised">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="statistics">
                                        <div class="">
                                            <div class="icon icon-primary">
                                                <v-icon color="green">local_shipping</v-icon>
                                            </div>
                                            <h3 class="info-title"><span><b>{{ AllProducts.length }}</b></span></h3>
                                            <h6 class="stats-title"><strong>Products</strong></h6>
                                        </div>
                                    </div>
                                </div>
                                <v-divider vertical></v-divider>
                                <div class="col-md-3">
                                    <div class="statistics">
                                        <div class="">
                                            <div class="icon icon-success">
                                                <v-icon color="purple">account_circle</v-icon>
                                            </div>
                                            <h3 class="info-title"><span><b>{{ Allusers }}</b></span></h3>
                                            <h6 class="stats-title"><strong>Users</strong></h6>
                                        </div>
                                    </div>
                                </div>
                                <v-divider vertical></v-divider>
                                <div class="col-md-3">
                                    <div class="statistics">
                                        <div class="">
                                            <div class="icon icon-info">
                                                <v-icon color="indigo">map</v-icon>
                                            </div>
                                            <h3 class="info-title"><span><b>{{ products.length }}</b></span></h3>
                                            <h6 class="stats-title"><strong>Products</strong></h6>
                                        </div>
                                    </div>
                                </div>
                                <v-divider vertical></v-divider>
                                <div class="col-md-2">
                                    <div class="statistics">
                                        <div class="">
                                            <div class="icon icon-danger">
                                                <v-icon color="red">call_split</v-icon>
                                            </div>
                                            <h3 class="info-title"><span><b>{{ orders }}</b></span></h3>
                                            <h6 class="stats-title"><strong> Orders</strong></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->

                <v-divider></v-divider>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-chart">
                            <div class="card-body">
                                <div class="chart-area">
                                    <my-product :height="255"></my-product>
                                    <!-- <my-product :height="255"></my-product> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-chart">
                            <div class="card-body">
                                <div class="chart-area">
                                    <my-Orders :height="255"></my-Orders>
                                    <!-- <my-delivered :height="255"></my-delivered> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-chart">
                            <div class="card-body">
                                <div class="chart-area">
                                    <!-- <my-cancled :height="255"></my-cancled> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 40px;">
                    <div class="card card-stats card-raised">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="statistics">
                                        <div class="">
                                            <div class="icon icon-danger">
                                                <v-icon color="danger">local_shipping</v-icon>
                                            </div>
                                            <h3 class="info-title"><span><b>{{ categories.length }}</b></span></h3>
                                            <h6 class="stats-title"><strong> Categories</strong></h6>
                                        </div>
                                    </div>
                                </div>
                                <v-divider vertical></v-divider>
                                <div class="col-md-3">
                                    <div class="statistics">
                                        <div class="">
                                            <div class="icon icon-primary">
                                                <v-icon color="pink">check_circle</v-icon>
                                            </div>
                                            <h3 class="info-title"><span><b>{{ brands.length }}</b></span></h3>
                                            <h6 class="stats-title"><strong>Brands</strong></h6>
                                        </div>
                                    </div>
                                </div>
                                <v-divider vertical></v-divider>
                                <div class="col-md-3">
                                    <div class="statistics">
                                        <div class="">
                                            <div class="icon icon-success">
                                                <v-icon color="orange">cloud</v-icon>
                                            </div>
                                            <h3 class="info-title"><span><b>{{ AllPending }}</b></span></h3>
                                            <h6 class="stats-title"><strong>Pending</strong></h6>
                                        </div>
                                    </div>
                                </div>
                                <v-divider vertical></v-divider>
                                <div class="col-md-2">
                                    <div class="statistics">
                                        <div class="">
                                            <div class="icon icon-info">
                                                <v-icon color="info">block</v-icon>
                                            </div>
                                            <h3 class="info-title"><span><b>{{ parseInt(orders) - parseInt(AllPending) }}</b></span></h3>
                                            <h6 class="stats-title"><strong>Delivered</strong></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <v-divider></v-divider>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-chart">
                            <div class="card-body">
                                <div class="chart-area">
                                    <my-brands :height="255"></my-brands>
                                </div>
                                <!-- <div class="progress-Ship">
                                    <img src="storage/country/ke.png" alt="">
                                    Kenya: {{ parseInt(products.Kenya/AllProducts*100) }} %
                                    <v-progress-linear color="secondary" height="2" :value="products.Kenya / AllProducts * 100"></v-progress-linear>
                                    <img src="storage/country/tz.png" alt="">
                                    Tanzania: {{ parseInt(products.Tanzania/AllProducts*100) }} %
                                    <v-progress-linear color="success" height="2" :value="products.Tanzania / AllProducts * 100"></v-progress-linear>
                                    <img src="storage/country/ug.png" alt="">
                                    Uganda: {{ parseInt(products.Uganda/AllProducts*100) }} %
                                    <v-progress-linear color="info" height="2" :value="products.Uganda / AllProducts * 100"></v-progress-linear>
                                </div> -->
                                <!-- <div class="progress-Ship">
                                    <div v-for="categori in categories" :key="categori.id">
                                        {{ categori.name }}: {{ parseInt(categori.count / AllProducts * 100) }} %
                                        <v-progress-linear color="red" height="2" :value="categori.count / AllProducts * 100"></v-progress-linear>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-chart">
                            <div class="card-body">
                                <div class="chart-area">
                                    <my-categories :height="255"></my-categories>
                                    <!-- <my-Orders :height="255"></my-Orders> -->
                                </div>
                                <!-- <div class="progress-Ship">
                                    <div v-for="brand in brands" :key="brand.id">
                                        {{ brand.name }}: {{ parseInt(brand.length / AllProducts * 100) }} %
                                        <v-progress-linear color="indigo" height="2" :value="brand.count / AllProducts * 100"></v-progress-linear>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <v-btn @click="getChartOrders" flat color="primary">Count</v-btn> -->
            </v-flex>
        </v-layout>
    </v-container>
</v-content>
</template>

<script>
// import LineChart from './csv/LineChart'
import categories from './charts/Category'
import Product from './charts/Product'
// import Delivered from './charts/Delivered'
// import Cancled from './charts/Cancled'
import Order from './charts/Order'
import Brand from './charts/Brand'

export default {
    props: ["user"],
    name: 'VueChartJS',
    components: {
        'my-product': Product,
        'my-categories': categories,
        // 'my-delivered': Delivered,
        'my-Orders': Order,
        // 'my-cancled': Cancled,
        'my-brands': Brand,
    },
    data() {
        return {
            label: [],
            data: [],
            Allusers: {},
            loader: false,
            AllProducts: {},
            categories: {},
            brands: {},
            notCompleted: {},
            AllCanceled: {},
            AllderiveredShipment: {},
            AllapprovedShipment: {},
            notifications: [],
            products: {},
            orders: null,
            colorCache: {},
            AllPending: null,
            AllDelivered: null
        }
    },
    methods: {
        getProducts() {
            axios.get('/getProducts')
                .then((response) => {
                    this.products = response.data
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
        getChartOrders() {
            axios.get('/countOrders')
                .then((response) => {
                    this.orders = response.data
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },

        ref() {
            axios.get('/getChartData')
                .then((response) => {
                    // console.log(response);
                    eventBus.$emit('chartEvent', response.data);
                    this.label = response.data.lables
                    this.data = response.data.rows
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
    },
    mounted() {
        this.getProducts()
        this.getChartOrders()
        this.loader = true
        axios.get('/getUsersCount')
            .then((response) => {
                this.Allusers = response.data
            })
            .catch((error) => {
                this.errors = error.response.data.errors
            })
        axios.get('/countDelivered')
            .then((response) => {
                this.AllDelivered = response.data
            })
            .catch((error) => {
                this.errors = error.response.data.errors
            })
        axios.get('/countPending')
            .then((response) => {
                this.AllPending = response.data
            })
            .catch((error) => {
                this.errors = error.response.data.errors
            })

        axios.get('/getProducts')
            .then((response) => {
                this.AllProducts = response.data
            })
            .catch((error) => {
                this.errors = error.response.data.errors
            })

        axios.get('/brands')
            .then((response) => {
                this.brands = response.data
            })
            .catch((error) => {
                this.errors = error.response.data.errors
            })

        // Dashboard
        axios.get('/categories')
            .then((response) => {
                this.categories = response.data
            })
            .catch((error) => {
                this.errors = error.response.data.errors
            })

        // axios.get('/getCanceledCount')
        //     .then((response) => {
        //         this.AllCanceled = response.data
        //     })
        //     .catch((error) => {
        //         this.errors = error.response.data.errors
        //     })

        // axios.get('/deriveredShipmentCount')
        //     .then((response) => {
        //         this.AllderiveredShipment = response.data
        //     })
        //     .catch((error) => {
        //         this.errors = error.response.data.errors
        //     })

        // axios.get('/deriveredShipmentCount')
        //     .then((response) => {
        //         this.loader = false
        //         this.AllderiveredShipment = response.data
        //     })
        //     .catch((error) => {
        //         this.loader = false
        //         this.errors = error.response.data.errors
        //     })

        // axios.get('/getCountryhipments')
        //     .then((response) => {
        //         this.products = response.data
        //     })
        //     .catch((error) => {
        //         this.errors = error.response.data.errors
        //     })

    },
    
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if (vm.user.can['view dashboard']) { 
                next();
            } else {
                next('/unauthorized');
            }
        })
    }
}
</script>

<style scoped>
.justify-center {
    margin-top: -100px !important;
}

.card-stats {
    margin-top: -10px;
    padding: 20px 0;
}

/* .statistics {
    background: #f0f0f0 !important;
} */

.progress-Ship {
    margin-top: 100px !important;
}

.v-icon {
    font-size: 64px !important;
}

.v-icon {
    box-shadow: 0 9px 30px -6px rgba(255, 54, 54, .5);
    padding: 5px;
    border-radius: 50%;
}

.info-title {
    margin-top: 20px;
}
</style>
