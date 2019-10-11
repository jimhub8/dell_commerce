<template>
<div>
    <v-content>
        <v-container fluid fill-height>
            <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
                <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
            </div>
            <v-layout justify-center align-center v-show="!loader">
                <v-layout row wrap>
                    <v-card>
                        <v-card-title>
                            Products
                            <v-btn @click="openAdd" flat color="primary">Add Product</v-btn>
                            <!-- <v-spacer></v-spacer> -->
                            <v-tooltip bottom>
                                <v-btn slot="activator" icon class="mx-0" @click="getProduct">
                                    <v-icon small color="blue darken-2">refresh</v-icon>
                                </v-btn>
                                <span>Refresh</span>
                            </v-tooltip>
                            <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :headers="headers" :items="products" class="elevation-1" :search="search" :loading="loading">
                            <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                            <template slot="items" slot-scope="props">
                                <td>{{ props.item.name }}</td>
                                <td class="text-xs-right">{{ props.item.quantity }}</td>
                                <td class="text-xs-right">{{ props.item.price }}</td>
                                <td class="text-xs-right">{{ props.item.description }}</td>
                                <!-- Featured -->
                                <td class="text-xs-right" v-if="props.item.featured === '1' || props.item.featured === 1">
                                    <v-tooltip bottom>
                                        <v-btn icon class="mx-0" @click="StatusItem(props.item, props.item.featured, 'featured', props.item.id)" slot="activator">
                                            <v-icon color="blue darken-2">check_circle</v-icon>
                                        </v-btn>
                                        <span>Make not Featured</span>
                                    </v-tooltip>
                                </td>
                                <td class="text-xs-right" v-else>
                                    <v-tooltip bottom>
                                        <v-btn icon class="mx-0" @click="StatusItem(props.item, props.item.featured, 'featured', props.item.id)" slot="activator">
                                            <v-icon color="danger darken-2">block</v-icon>
                                        </v-btn>
                                        <span>Make Featured</span>
                                    </v-tooltip>
                                </td>
                                <!-- Featured end -->

                                <!-- Featured -->
                                <td class="text-xs-right" v-if="props.item.new_product === '1' || props.item.new_product === 1">
                                    <v-tooltip bottom>
                                        <v-btn icon class="mx-0" @click="StatusItem(props.item, props.item.new_product, 'new_product', props.item.id)" slot="activator">
                                            <v-icon color="blue darken-2">check_circle</v-icon>
                                        </v-btn>
                                        <span>Make not newP</span>
                                    </v-tooltip>
                                </td>
                                <td class="text-xs-right" v-else>
                                    <v-tooltip bottom>
                                        <v-btn icon class="mx-0" @click="StatusItem(props.item, props.item.new_product, 'new_product', props.item.id)" slot="activator">
                                            <v-icon color="danger darken-2">block</v-icon>
                                        </v-btn>
                                        <span>Make newP</span>
                                    </v-tooltip>
                                </td>
                                <!-- newP -->
                                <!-- newP -->
                                <td class="text-xs-right" v-if="props.item.best_sell === '1' || props.item.best_sell === 1">
                                    <v-tooltip bottom>
                                        <v-btn icon class="mx-0" @click="StatusItem(props.item, props.item.best_sell, 'best_sell', props.item.id)" slot="activator">
                                            <v-icon color="blue darken-2">check_circle</v-icon>
                                        </v-btn>
                                        <span>Make not newP</span>
                                    </v-tooltip>
                                </td>
                                <td class="text-xs-right" v-else>
                                    <v-tooltip bottom>
                                        <v-btn icon class="mx-0" @click="StatusItem(props.item, props.item.best_sell, 'best_sell', props.item.id)" slot="activator">
                                            <v-icon color="danger darken-2">block</v-icon>
                                        </v-btn>
                                        <span>Make newP</span>
                                    </v-tooltip>
                                </td>
                                <!-- newP -->
                                <td class="justify-center layout px-0">
                                    <v-tooltip bottom>
                                        <v-btn slot="activator" icon class="mx-0" @click="editProduct(props.item)">
                                            <v-icon small color="blue darken-2">edit</v-icon>
                                        </v-btn>
                                        <span>Edit</span>
                                    </v-tooltip>
                                    <v-tooltip bottom>
                                        <v-btn slot="activator" icon class="mx-0" @click="editProduct(props.item)">
                                            <v-icon small color="pink darken-2">delete</v-icon>
                                        </v-btn>
                                        <span>Delete</span>
                                    </v-tooltip>
                                    <v-tooltip bottom>
                                        <v-btn slot="activator" icon class="mx-0" @click="imageUpdate(props.item)">
                                            <v-icon small color="info darken-2">image</v-icon>
                                        </v-btn>
                                        <span>Update image</span>
                                    </v-tooltip>
                                </td>
                            </template>
                            <v-alert slot="no-results" :value="true" color="error" icon="warning">
                                Your search for "{{ search }}" found no results.
                            </v-alert>
                        </v-data-table>
                    </v-card>
                </v-layout>
            </v-layout>
        </v-container>
        <v-snackbar :timeout="timeout" bottom :color="color" left v-model="snackbar">
            {{ message }}
            <v-btn>close</v-btn>
        </v-snackbar>
    </v-content>
    <Create @closeRequest="close" :openAddRequest="dispAdd" @alertRequest="showAlert"></Create>
    <Edit @closeRequest="close" :openAddRequest="dispEdit" @alertRequest="showAlert" :product="proEdit"></Edit>
    <myImage></myImage>
    <!-- <ShowTask @closeRequest="close" :openAddRequest="dispShow" @alertRequest="showAlert" :task="proEdit"></ShowTask> -->

</div>
</template>

<script>
import Create from "./Create";
import Edit from "./Edit";
import myImage from "./Image";
// import ShowTask from './ShowTask';

export default {
    components: {
        Create,
        myImage,
        Edit
    },

    data() {
        return {
            search: "",
            loading: false,
            dispAdd: false,
            dispEdit: false,
            dispShow: false,
            products: [],
            proEdit: [],
            loader: false,
            snackbar: false,
            timeout: 5000,
            color: "",
            message: "",
            editedIndex: null,
            headers: [{
                    text: "Product Name",
                    align: "left",
                    value: "name"
                },
                {
                    text: "Quantity Available",
                    value: "quantity"
                },
                {
                    text: "Price",
                    value: "price"
                },
                {
                    text: "Description",
                    value: "description"
                },
                {
                    text: "Featured",
                    value: "featured",
                    sortable: false
                },
                {
                    text: "New Product",
                    value: "new_product",
                    sortable: false
                },
                {
                    text: "Best Seller",
                    value: "best_sell",
                    sortable: false
                },

                {
                    text: "Actions",
                    sortable: false
                },
            ],
            editedItem: [],
        }
    },

    methods: {
        StatusItem(item, data, status, id) {
            this.loading = true;
            // this.editedIndex = this.products.indexOf(item)
            // this.editedItem = Object.assign({}, item)
            axios.post(`/StatusItem/${id}`, {
                    data: data,
                    status: status,
                })
                .then(response => {
                    this.loading = false;
                    this.getProduct();
                    // Object.assign(this.products[this.editedIndex], this.response.data)
                    // Object.assign(this.products[this.editedIndex], data)
                    // this.products = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },

        deleteItem(item) {
            if (confirm('Are you sure you want to delete this item?')) {
                this.loading = true
                axios.delete(`/products/${item.id}`)
                    .then((response) => {
                        this.loading = false
                        this.message = 'deleted successifully'
                        this.color = 'black'
                        this.snackbar = true
                        this.products.splice(index, 1)
                    })
                    .catch((error) => {
                        this.loading = false
                        this.message = 'something went wrong'
                        this.color = 'red'
                        this.snackbar = true
                        this.errors = error.response.data.errors
                    })
            }
        },
        imageUpdate(data) {
            eventBus.$emit("imageEvent", data);
        },
        openAdd() {
            this.dispAdd = true;
        },
        close() {
            this.dispAdd = this.dispShow = this.dispEdit = false;
        },
        showAlert() {
            this.message = "Successifully Added";
            this.snackbar = true;
            this.color = "indigo";
        },

        editProduct(task) {
            this.proEdit = Object.assign({}, task);
            this.editedIndex = this.products.indexOf(task);
            this.dispEdit = true;
        },
        getProduct() {
            this.loading = true;
            axios
                .get("/getProducts")
                .then(response => {
                    this.loading = false;
                    this.loader = false;
                    this.products = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.loader = false;
                    this.errors = error.response.data.errors;
                });
        }
    },
    mounted() {
        this.loader = true;
        this.getProduct();
    }
};
</script>
