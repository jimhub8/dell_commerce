<template>
<div>
    <v-card>
        <v-card-title>
            Order
            <!-- <v-spacer></v-spacer> -->
            <v-tooltip bottom>
                <v-btn slot="activator" icon class="mx-0" @click="getOrders">
                    <v-icon small color="blue darken-2">refresh</v-icon>
                </v-btn>
                <span>Refresh</span>
            </v-tooltip>
            <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
        </v-card-title>
        <v-data-table :headers="headers" :items="orders.data" class="elevation-1" :search="search" :loading="loading">
            <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
            <template slot="items" slot-scope="props">
                <td>
                    {{ props.item.order_date }}
                </td>
                <td class="text-xs-right">{{ props.item.client_name }}</td>
                <td class="text-xs-right">{{ props.item.total }}</td>
                <td class="text-xs-right">{{ props.item.product_name }}</td>
                <!-- <td class="text-xs-right">{{ props.item.name }}</td> -->
                <td class="text-xs-right">{{ props.item.quantity }}</td>
                <td class="text-xs-right">
                     {{ props.item.status }}
                </td>
                <td class="justify-center layout px-0">
                    <v-tooltip bottom>
                        <v-btn slot="activator" icon class="mx-0" @click="view(props.item)">
                            <v-icon small color="indigo darken-2">visibility</v-icon>
                        </v-btn>
                        <span>View Order</span>
                    </v-tooltip>
                    <form :action="'/invoice/'+props.item.id" method="get" target="_blank">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="type" value="stream">
                        <v-tooltip bottom>
                            <v-btn flat slot="activator" color="info" icon class="mx-0" type="submit">
                                <v-icon>book</v-icon>
                            </v-btn>
                            <span>Stream invoice</span>
                        </v-tooltip>
                    </form>
                    <form :action="'/invoice/'+props.item.id" method="get">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="type" value="download">
                        <v-tooltip bottom>
                            <v-btn flat slot="activator" color="primary" icon class="mx-0" type="submit">
                                <v-icon>cloud_upload</v-icon>
                            </v-btn>
                            <span>Download invoice</span>
                        </v-tooltip>
                    </form>
                </td>
            </template>
            <v-alert slot="no-results" :value="true" color="error" icon="warning">
                Your search for "{{ search }}" found no results.
            </v-alert>
        </v-data-table>
    </v-card>
</div>
</template>

<script>
import myView from "../admin/orders/View";
export default {
    props: ['user'],
    components: {
        myView
    },

    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            search: "",
            loading: false,
            orders: [],
            catEdit: [],
            loader: false,
            snackbar: false,
            timeout: 5000,
            color: "",
            message: "",
            discount: 0,
            totalPrice: null,
            carts: [],
            headers: [{
                    text: "Created On",
                    value: "order_date"
                },
                {
                    text: "Client Name",
                    align: "left",
                    value: "client_name"
                },
                {
                    text: "Amount",
                    value: "price"
                },
                {
                    text: "Product",
                    value: "product_name"
                },
                // {
                //     text: "Name",
                //     value: "name"
                // },
                {
                    text: "Quantity",
                    value: "quantity"
                },
                {
                    text: "Status",
                    value: "status"
                },
                {
                    text: "Actions",
                    sortable: false
                }
            ]
        };
    },

    methods: {
        getOrders() {
            this.loading = true;
            axios
                .get("/clientOrders")
                .then(response => {
                    this.loader = false;
                    this.loading = false;
                    this.orders = response.data;
                    // this.carts = response.data.carts;
                })
                .catch(error => {
                    this.loader = false;
                    this.loading = false;
                    if (error.response.status === 500) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    }
                    this.errors = error.response.data.errors;
                });
        },
        view(order) {
            eventBus.$emit("viewOrdEvent", order);
        },

    },
    mounted() {
        this.loader = true;
        this.getOrders();
    },

    computed: {
        getSubTotal() {
            this.orders.forEach(element => {
                this.carts = element.cart;
            });
            // if (this.orders.carts.length > 0) {
            //     this.totalPrice = 0;
            //     for (let index = 0; index < this.orders.carts.length; index++) {
            //         const element = this.orders.carts[index];
            //         this.totalPrice = parseInt(element.price) + this.totalPrice;
            //     }
            // }
            // return this.carts;
        }
        // getTotal() {
        //     if (this.carts.length > 0) {
        //         return parseInt(this.getSubTotal) - this.discount;
        //     }
        // }
    },

    // beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //         if (vm.user.can['view orders']) {
    //             next();
    //         } else {
    //             next('/unauthorized');
    //         }
    //     })
    // }
};
</script>
