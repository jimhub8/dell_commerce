<template>
<v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="700px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Add Coupon</span>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="close">
                    <v-icon color="black">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-form ref="form" @submit.prevent>
                            <v-container grid-list-xl fluid>
                                <v-layout wrap>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.name" color="blue darken-2" label="Coupon Name" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.amount" type="number" color="blue darken-2" label="Coupon Amount" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                                    </v-flex>
                                    <div class="form-group col-md-6">
                                        <label class="col-md-6 col-form-label text-md-right" for="">Discount type</label>
                                        <select class="custom-select custom-select-md col-md-12" v-model="form.disc_type">
                                            <option value=""></option>
                                            <option value="percentage">Percentage Discount</option>
                                            <option value="fixedCart">Fixed Cart Discount</option>
                                            <option value="productDisc">Fixed Product Discount</option>
                                    </select>
                                        <small class="has-text-danger" v-if="errors.disc_type">{{ errors.disc_type[0] }}</small>
                                    </div>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.expiry_date" color="blue darken-2" label="Expiry date" required type="date" :min="today"></v-text-field>
                                        <small class="has-text-danger" v-if="errors.expiry_date">{{ errors.expiry_date[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.min_spend" color="blue darken-2" label="Minimum Spend" type="number" required min="1"></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.max_spend" color="blue darken-2" label="Maximum Spend" type="number" required min="1"></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>

                                    <v-flex xs12 sm6>
                                        <v-autocomplete v-model="form.model" :items="products" :loading="isLoading" :search-input.sync="search" chips clearable hide-details hide-selected item-text="name" item-value="id" label="Search for a products..." multiple>
                                            <template slot="no-data">
                                                <v-list-tile>
                                                    <v-list-tile-title>
                                                        Search for
                                                        <strong>Products</strong>
                                                    </v-list-tile-title>
                                                </v-list-tile>
                                            </template>
                                            <template slot="selection" slot-scope="{ item, selected }">
                                                <v-chip :selected="selected" color="blue-grey" close @input="remove(item)" class="white--text">
                                                    <v-icon left>mdi-coin</v-icon>
                                                    <span v-text="item.name"></span>
                                                </v-chip>
                                            </template>
                                            <template slot="item" slot-scope="{ item, tile }">
                                                <v-list-tile-avatar color="indigo" class="headline font-weight-light white--text">
                                                    {{ item.name.charAt(0) }}
                                                </v-list-tile-avatar>
                                                <v-list-tile-content>
                                                    <v-list-tile-title v-text="item.name"></v-list-tile-title>
                                                    <v-list-tile-sub-title v-text="item.email"></v-list-tile-sub-title>
                                                </v-list-tile-content>
                                                <v-list-tile-action>
                                                    <v-icon>mdi-coin</v-icon>
                                                </v-list-tile-action>
                                            </template>
                                        </v-autocomplete>
                                    </v-flex>

                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.usage_limit" color="blue darken-2" label="Usage Limit" type="number" required min="1"></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>

                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.limit_user" color="blue darken-2" label="Usage per user" type="number" required min="1"></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.item_limit" color="blue darken-2" label="Limit usage to X products" type="number" required min="1"></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>
                                    <v-switch v-model="form.ind_use" class="mt-0" color="primary lighten-2" hide-details label="Individual use"></v-switch>
                                    <v-flex xs12 sm12>
                                        <v-textarea v-model="form.description" color="blue">
                                            <div slot="label">
                                                Description <small>(optional)</small>
                                            </div>
                                        </v-textarea>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <v-card-actions>
                                <v-btn flat @click="resetForm">reset</v-btn>
                                <v-btn flat @click="close">Close</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn :disabled="loading" :loading="loading" flat color="primary" @click="save">Submit</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-layout>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
export default {
    props: ['openAddRequest'],
    components: {},
    data() {
        const defaultForm = Object.freeze({
            categories: null,
            categoriesx: null,
            description: "",
            disc_type: "percentage",
            ind_use: false,
            item_limit: "1",
            limit_user: "1",
            max_spend: 1,
            min_spend: 1,
            name: "",
            products: '',
            productsx: '',
            updated_at: "",
            usage_limit: "1",
            user_id: 1,
            amount: '', 
        })
        return {
            errors: {},
            products: [],
            defaultForm,
            model: null,
            isLoading: false,
            pro: {
                search: null,
            },
            search: null,
            loading: false,
            disabled: true,
            form: Object.assign({}, defaultForm),
            rules: {
                name: [val => (val || '').length > 0 || 'This field is required']
            },
            today: new Date().toISOString().slice(0, 10),
        }
    },
    methods: {
        save() {
            this.loading = true
            axios.post('/coupons', this.$data.form).
            then((response) => {
                    this.loading = false
                    console.log(response);
                    this.close();
                    this.resetForm();
                    eventBus.$emit("alertRequest", 'Coupon Created');
                    this.$parent.Coupons.push(response.data)
                })
                .catch((error) => {
                    this.loading = false
                    this.errors = error.response.data.errors
                })
        },
        resetForm() {
            this.form = Object.assign({}, this.defaultForm)
            this.$refs.form.reset()
        },
        close() {
            this.$emit('closeRequest')
        },
        remove(item) {
            console.log(item)
            const index = this.form.model.indexOf(item.id)
            if (index >= 0) this.form.model.splice(index, 1)
        },
        getProducts() {
            // alert('getProducts')
            // this.isLoading = true
            axios.post('/searchProduct', this.$data.pro).
            then((response) => {
                    this.isLoading = false
                    console.log(response);
                    this.products = response.data
                    // this.close();
                    // this.resetForm();
                })
                .catch((error) => {
                    this.isLoading = false
                    this.errors = error.response.data.errors
                })
        }
    },
    watch: {
        search(val) {
            //   alert(val)
            let items = {
                itemSearch: val
            }
            // Items have already been loaded
            if (this.products.length > 0) return

            this.isLoading = true

            // Lazily load input items
            axios.post('/searchProduct', items).
            then((response) => {
                    this.isLoading = false
                    console.log(response);
                    this.products = response.data
                    // this.close();
                    // this.resetForm();
                })
                .catch((error) => {
                    this.isLoading = false
                    this.errors = error.response.data.errors
                })
            // this.getProducts()
        }
    }
}
</script>
