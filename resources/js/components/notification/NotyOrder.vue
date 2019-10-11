<template>
<v-layout row justify-center>
    <v-dialog v-model="openRequest" persistent max-width="1400px">
        <v-card>
            <v-card-title>
                <span class="headline">Order</span>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="close">
                    <v-icon color="black">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <div class="card">
                    <div class="card-header">
                        <ul class="list-group text-center">
                            <li class="list-group-item active">{{ orders.order.name }}'s' Orders</li>
                        </ul>
                    </div>
                    <!-- <div class="card-body">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home" v-for="cart in orders.cart"  :key="cart.id"> {{ cart.item.name }} | {{ cart.qty }}
                                     <span class="badge" style="float: right; color: #fff; background: #000;">{{ cart.item.price }}</span>
                                </a>
                            </div> -->

                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Payment Id</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">List Price</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(cart, index) in orders.cart" :key="index">
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ cart.item.name }}</td>
                                <td>{{ orders.order.product_id }}</td>
                                <td>{{ cart.item.description }}</td>
                                <td>{{ cart.item.price }}</td>
                                <td>{{ cart.item.list_price }}</td>
                                <td>{{ cart.item.created_at }}</td>
                                <td>{{ orders.order.status }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                    <!-- <b>Tax:
                                <span class="badge" style="float: right; color: #fff; background: #f00;">Ksh{{ getSubTotal }}</span>
                            </b> -->
                    <strong><b style="font-size: 15px;">Sub Total:</b>
                                <span class="badge" style="float: right; color: #fff; background: #f00; font-size:15px;">Ksh{{ getSubTotal }}</span>
                            </strong>
                </div>
                </div>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="close">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
export default {
    props: ['openRequest', 'orders', 'user'],
    data() {
        return {
            totalPrice: null
        }
    },
    methods: {
        close() {
            this.$emit('closeRequest')
        }
    },
    computed: {
        getSubTotal() {
            if (this.orders.cart.length > 0) {
                this.totalPrice = 0;
                for (let index = 0; index < this.orders.cart.length; index++) {
                    const element = this.orders.cart[index];
                    this.totalPrice = parseInt(element.price) + this.totalPrice;
                }
            }
            return this.totalPrice;
        },
        getTotal() {
            if (this.orders.cart.length > 0) {
                return parseInt(this.getSubTotal) - this.discount;
            }
        }
    },
}
</script>
