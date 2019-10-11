<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="400px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Update Status</span>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="close">
                    <v-icon color="black">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                        <v-btn flat color="pink" style="border: 1px solid; border-radius: 20px;">{{ order.status }}</v-btn>
                        <v-divider></v-divider>
                    <v-layout wrap>
                        <v-form ref="form" @submit.prevent>
                            <v-container grid-list-xl fluid>
                                <v-layout wrap>
                                    <v-select :items="statuses" v-model="statusSelect" label="Select Status" single-line item-text="name" item-value="name" return-object persistent-hint></v-select>
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
    data() {
        return {
            statusSelect: [],
            errors: {},
            order: [],
            statuses: [{
                'name': 'Pending',
            }, {
                'name': 'Delivered',
            }, {
                'name': 'Returned',
            }, {
                'name': 'Cancelled',
            }, {
                'name': 'Transit',
            }],
            dialog:false,
            loading:false,
        }
    },
    methods: {
        save() {
            this.loading = true
            axios.patch(`/sales/${this.order.id}`, this.statusSelect).
            then((response) => {
                    this.loading = false
                    console.log(response);
                    // this.close();
                    // this.resetForm();
                    eventBus.$emit("alertRequest", 'Successifully Created');
                })
                .catch((error) => {
                    this.loading = false
                    this.errors = error.response.data.errors
                })
        },
        getStatus() {
            this.loading = true
            axios.get('/status').
            then((response) => {
                    this.loading = false
                    console.log(response);
                    this.statuses = response.data
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
            this.dialog = false
        },
    },
    created() {
        eventBus.$on('statusUpdateEvent', data => {
            this.dialog = true
            this.order = data
            this.getStatus()
        })
    },
}
</script>
