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
                <v-container grid-list-xl fluid>
                    <v-text-field v-model="form.attribute" color="blue darken-2" label="Attribute" required></v-text-field>
                    <small class="has-text-danger" v-if="errors.attribute">{{ errors.attribute[0] }}</small>
                </v-container>
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
            errors: {},
            defaultForm,
            dialog: false,
            loading: false,
            disabled: true,
            form: Object.assign({}, defaultForm),
            rules: {
                name: [val => (val || "").length > 0 || "This field is required"]
            }
        };
    },
    methods: {
        save() {
            this.loading = true;
            axios
                .post("/attributes", this.$data.form)
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
