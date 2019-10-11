<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Add Product</span>
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
                                        <v-select :items="categories" v-model="CatSelect" label="Select category" single-line item-text="name" item-value="id" return-object persistent-hint @change="changeCat(CatSelect)"></v-select>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-select :items="subcategories" v-model="subCatSelect" label="Select Subcategory" single-line item-text="name" item-value="id" return-object persistent-hint></v-select>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="product.name" color="blue darken-2" label="Product Name" required></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="product.price" color="blue darken-2" label="Price" required></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="product.list_price" color="blue darken-2" label="List Price" required></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="product.quantity" color="blue darken-2" label="Quantity" required></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm12>
                                        <v-textarea v-model="product.description" color="blue">
                                            <div slot="label">
                                                Special Instructions <small>(optional)</small>
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
    props: ['categories'],
    components: {},
    data() {
        const defaultForm = Object.freeze({
            name: '',
            quantity: '',
            price: '',
            description: '',
        })
        return {
            subcategories: [],
            product: [],
            errors: {},
            dialog: false,
            defaultForm,
            loading: false,
            disabled: true,
            form: Object.assign({}, defaultForm),
            rules: {
                name: [val => (val || '').length > 0 || 'This field is required']
            },
      CatSelect: [],
            subCatSelect: [],
        }
    },
    methods: {
        save() {
            this.loading = true
            axios.patch(`/products/${this.product.id}`, {
                form: this.product,
                subCatSelect: this.$data.subCatSelect
            }).
            then((response) => {
                    this.loading = false
                    console.log(response);
                    // this.resetForm();
                    eventBus.$emit("alertRequest", 'Successifully Updated');
                    Object.assign(this.$parent.products[this.$parent.editedIndex], this.$parent.proEdit)
                    this.close();
                    // this.$parent.products.push(response.data)
                })
                .catch((error) => {
                    this.loading = false
                        if (error.response.status === 500) {
                            eventBus.$emit('errorEvent', error.response.statusText)
                            return
                        }
                    this.errors = error.response.data.errors
                })
        },
        getSubs(id) {
            axios.get(`/subcategories/${id}`)
            .then((response) => {
                this.loader = false
                this.subCatSelect = response.data
            })
            .catch((error) => {
                this.loader = false
                this.errors = error.response.data.errors
            })
        },
        resetForm() {
            this.form = Object.assign({}, this.defaultForm)
            this.$refs.form.reset()
        },
        close() {
            // this.$emit('closeRequest')
            this.dialog = false
        },
    changeCat(item) {
      this.subcategories = item.sub_categories;
    }
    },
    created() {
         eventBus.$on('ProEditEvent', data => {
            this.product = data
            this.getSubs(data.subCategory_id)
            this.dialog = true
        })
    },
    mounted() {
    axios
      .get("/subcategories")
      .then(response => {
        this.subcategories = response.data;
      })
      .catch(error => {
        this.errors = error.response.data.errors;
      });
    },
}
</script>
