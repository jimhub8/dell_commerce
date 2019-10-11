<template>
<div>
    <v-content>
        <v-container fluid fill-height>
            <v-layout justify-center align-center v-show="!loader">
                <v-card style="width: 100%;">
                    <v-card>
                        <v-card-title fixed>
                            <span class="headline">Add Attribute value</span>
                            <v-spacer></v-spacer>
                        </v-card-title>
                        <v-card-text>
                            <v-flex sm12>
                                <v-text-field v-model="form.value" color="blue darken-2" label="Value" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.value">{{ errors.value[0] }}</small>
                            </v-flex>
                            <v-flex sm12>
                                <v-btn :disabled="loading" :loading="loading" flat color="primary" @click="save">Submit</v-btn>
                            </v-flex>
                            <VDivider/>
                            <div style="height: 100px;"></div>
                            <v-flex sm12>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(values, key) in form.values" :key="values.id">
                                            <th scope="row">{{ key + 1 }}</th>
                                            <td>{{ values.value }}</td>
                                            <td>
                                                <v-tooltip bottom>
                                                    <v-btn slot="activator" icon class="mx-0" @click="edit_value(props.item.id)">
                                                        <v-icon small color="blue darken-2">edit</v-icon>
                                                    </v-btn>
                                                    <span>Edit</span>
                                                </v-tooltip>
                                                <v-tooltip bottom>
                                                    <v-btn slot="activator" icon class="mx-0" @click="delete_value(props.item.id)">
                                                        <v-icon small color="pink darken-2">delete</v-icon>
                                                    </v-btn>
                                                    <span>Delete</span>
                                                </v-tooltip>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </v-flex>
                            <!-- <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn :disabled="loading" :loading="loading" flat color="primary" @click="save">Submit</v-btn>
                            </v-card-actions> -->
                        </v-card-text>
                    </v-card>
                </v-card>
            </v-layout>
        </v-container>
    </v-content>
</div>
</template>

<script>
export default {
    components: {},
    data() {
        const defaultForm = Object.freeze({
            value: ''
        });
        return {
            errors: {},
            defaultForm,
            loading: false,
            form: Object.assign({}, defaultForm),
        };
    },
    methods: {
        save() {
            this.loading = true;
            // this.form.id = this.$route.params.id
            axios
                .post("/attribute_value", this.form)
                .then(response => {
                    this.loading = false;
                    console.log(response);
                    // this.close();
                    // this.resetForm();
                    eventBus.$emit("alertRequest", "Successifully Created");
                })
                .catch(error => {
                    this.loading = false;
                    if (error.response.status === 500) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    } else if (error.response.status === 401 || error.response.status === 409) {
                        eventBus.$emit('reloadRequest', error.response.statusText)
                    }
                    this.errors = error.response.data.errors;
                });
        },
        resetForm() {
            this.form = Object.assign({}, this.defaultForm);
            this.$refs.form.reset();
        },
        getAtt() {
            axios.get(`/attributes/${this.$route.params.id}`, this.form)
                .then(response => {
                    this.loading = false;
                    this.form = response.data
                    console.log(response);
                    // this.close();
                    // this.resetForm();
                    // eventBus.$emit("alertRequest", "Successifully Created");
                })
                .catch(error => {
                    this.loading = false;
                    if (error.response.status === 500) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    } else if (error.response.status === 401 || error.response.status === 409) {
                        eventBus.$emit('reloadRequest', error.response.statusText)
                    }
                    this.errors = error.response.data.errors;
                });
        }

    },
    mounted() {
        this.getAtt()
    },
    created() {
        eventBus.$on('createAttributeEvent', data => {

        })
    },
};
</script>
