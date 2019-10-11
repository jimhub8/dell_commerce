<template>
<v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="500px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Add category</span>
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
                                <v-select :items="menus" v-model="menuSelect" label="Select Category" single-line item-text="name" item-value="id" return-object persistent-hint></v-select>
                                <v-layout wrap>
                                    <v-flex xs12 sm12>
                                        <v-text-field v-model="category.name" color="blue darken-2" label="category Name" required></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.charges">{{ errors.charges[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm12>
                                        <v-textarea v-model="category.description" color="blue">
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
    props: ["openAddRequest", "category"],
    components: {},
    data() {
        const defaultForm = Object.freeze({
            name: "",
            description: ""
        });
        return {
            errors: {},
            menus: [],
            menuSelect: [],
            defaultForm,
            loading: false,
            disabled: true,
            form: Object.assign({}, defaultForm),
            rules: {
                name: [val => (val || "").length > 0 || "This field is required"]
            },
            brands: []
        };
    },
    methods: {
        save() {
            this.loading = true;
            axios
                .patch(`/categories/${this.category.id}`, {
                    form: this.category,
                    menu: this.$data.menuSelect
                })
                .then(response => {
                    this.loading = false;
                    console.log(response);
                    // this.close;
                    // this.resetForm();
                    eventBus.$emit("alertRequest", "Successifully Updated");
                    Object.assign(
                        this.$parent.categories[this.$parent.editedIndex],
                        this.$parent.proEdit
                    );
                    // this.$parent.categories.push(response.data)
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        resetForm() {
            this.form = Object.assign({}, this.defaultForm);
            this.$refs.form.reset();
        },
        close() {
            this.$emit("closeRequest");
        }
    },
    computed: {},
    mounted() {
        axios
            .get("/menus")
            .then(response => {
                this.loader = false;
                this.menus = response.data;
            })
            .catch(error => {
                this.loader = false;
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors;
            });
        // axios.get('/brands')
        //     .then((response) => {
        //         this.loader = false
        //         this.brands = response.data
        //     })
        //     .catch((error) => {
        //         this.loader = false
        //         this.errors = error.response.data.errors
        //     })
    },
    created() {
        eventBus.$on('catSelectEvent', data => {
            axios.get(`/menus/${data}`)
                .then((response) => {
                    // this.loader = false
                    this.menuSelect = response.data
                })
                .catch((error) => {
                    // this.loader = false
                    this.errors = error.response.data.errors
                })
        })
    }
};
</script>
