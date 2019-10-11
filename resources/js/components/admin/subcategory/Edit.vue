<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Add Subcategory</span>
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
                                        <v-select :items="categories" v-model="SubcatSelect" label="Select Category" single-line item-text="name" item-value="id" return-object persistent-hint></v-select>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="subcategory.name" color="blue darken-2" label="Subcategory Name" required></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm12>
                                        <v-textarea v-model="subcategory.description" color="blue">
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
    // props: ['openAddRequest', 'subcategory'],
    components: {},
    data() {
        const defaultForm = Object.freeze({
            name: '',
            description: '',
        })
        return {
            errors: {},
            categorySelect: [],
            defaultForm,
            dialog: false,
            loading: false,
            categories: [],
            subcategory: [],
            disabled: true,
            form: Object.assign({}, defaultForm),
            rules: {
                name: [val => (val || '').length > 0 || 'This field is required']
            },
            subcategories: [],
            SubcatSelect: [],
        }
    },
    methods: {
        save() {
            this.loading = true
            axios.patch(`/subcategories/${this.SubcatSelect.id}`, {
                form: this.subcategory,
                SubcatSelect: this.$data.SubcatSelect
            }).
            then((response) => {
                    this.loading = false
                    // console.log(response);
                    // this.close;
                    // this.resetForm();
                    eventBus.$emit("alertRequest", 'Successifully Updated');
                    // Object.assign(this.$parent.subcategories[this.$parent.editedIndex], this.$parent.proEdit)
                    // this.$parent.subcategories.push(response.data)
                })
                .catch((error) => {
                    this.loading = false
                    this.errors = error.response.data.errors
                })
        },
        getcategory(id) {
            axios.get(`/categories/${id}`)
            .then((response) => {
                this.loader = false
                this.SubcatSelect = response.data
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
    },
    created() {
         eventBus.$on('subCatEditEvent', data => {
            this.subcategory = data
            this.dialog = true
            this.getcategory(data.category_id)
        })
    },
    mounted() {
        axios.get('/categories')
            .then((response) => {
                this.loader = false
                this.categories = response.data
            })
            .catch((error) => {
                this.loader = false
                this.errors = error.response.data.errors
            })
    },
}
</script>
