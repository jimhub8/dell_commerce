<template>
<v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="700px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Add About</span>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="close">
                    <v-icon color="black">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-form ref="form" @submit.prevent style="width: 100% !important;">
                            <v-container grid-list-xl fluid>
                                <v-layout wrap>
                                    <v-flex xs12 sm12>
                                        <v-textarea v-model="brand.about_us" color="blue">
                                            <div slot="label">
                                                About Us
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
    props: ['openAddRequest', 'brand'],
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
            loading: false,
            categories: [],
            disabled: true,
            form: Object.assign({}, defaultForm),
            rules: {
                name: [val => (val || '').length > 0 || 'This field is required']
            },
            aboutus: [],
            brandSelect: [],
        }
    },
    methods: {
        save() {
            this.loading = true
            axios.patch(`/aboutus/${this.brand.id}`, {
                form: this.brand,
                brandSelect: this.$data.brandSelect
            }).
            then((response) => {
                    this.loading = false
                    console.log(response);
                    // this.close;
                    // this.resetForm();
                    eventBus.$emit("alertRequest", 'Successifully Updated');
                    Object.assign(this.$parent.aboutus[this.$parent.editedIndex], this.$parent.proEdit)
                    // this.$parent.aboutus.push(response.data)
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
    },
    computed: {},
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
