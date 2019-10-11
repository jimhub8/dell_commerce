<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Add Attribute</span>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="close">
                    <v-icon color="black">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-flex sm12>
                    <v-text-field v-model="form.value" color="blue darken-2" label="Value" required></v-text-field>
                    <small class="has-text-danger" v-if="errors.value">{{ errors.value[0] }}</small>
                </v-flex>
                <v-card-actions>
                    <v-btn flat @click="resetForm">reset</v-btn>
                    <v-btn flat @click="close">Close</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn :disabled="loading" :loading="loading" flat color="primary" @click="save">Submit</v-btn>
                </v-card-actions>
            </v-card-text>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
export default {
    components: {},
    data() {
        const defaultForm = Object.freeze({
            attribute: "",
            description: "",
        });
        return {
            options: [{
                value: 'select',
                label: 'Select'
            }, {
                value: 'radio',
                label: 'Radio'
            }, {
                value: 'text',
                label: 'Text'
            }, {
                value: 'text_area',
                label: 'Text Area'
            }, ],
            errors: {},
            defaultForm,
            dialog: false,
            loading: false,
            form: Object.assign({}, defaultForm),
        };
    },
    methods: {
        save() {
            this.loading = true;
            axios
                .post("/attribute_value", this.$data.form)
                .then(response => {
                    this.loading = false;
                    console.log(response);
                    // this.close();
                    // this.resetForm();
                    eventBus.$emit("alertRequest", "Successifully Created");
                    this.$parent.attributes.push(response.data);
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
        close() {
            this.dialog = false
        }
    },
    created() {
        eventBus.$on('createAttributeEvent', data => {
            this.dialog = true
        })
    },
};
</script>
