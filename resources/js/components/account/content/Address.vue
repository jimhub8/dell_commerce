<template>
<div>
    <v-layout wrap>
        <v-flex xs12 sm5 style="margin-left: 10px">
            <v-text-field v-model="form.name" color="blue darken-2" label="Full name" required></v-text-field>
            <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
        </v-flex>
        <v-flex xs12 sm5 style="margin-left: 10px">
            <v-text-field v-model="form.email" color="blue darken-2" label="Email" required></v-text-field>
            <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
        </v-flex>
        <v-flex xs12 sm5 style="margin-left: 10px">
            <v-text-field v-model="form.city" color="blue darken-2" label="City" required></v-text-field>
            <small class="has-text-danger" v-if="errors.city">{{ errors.city[0] }}</small>
        </v-flex>
        <v-flex xs12 sm5 style="margin-left: 10px">
            <v-text-field v-model="form.phone" color="blue darken-2" label="Phone" required></v-text-field>
            <small class="has-text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
        </v-flex>
        <v-flex xs12 sm5 style="margin-left: 10px">
            <v-text-field v-model="form.country" color="blue darken-2" label="Country" required></v-text-field>
            <small class="has-text-danger" v-if="errors.country">{{ errors.country[0] }}</small>
        </v-flex>
        <v-flex xs12 sm5 style="margin-left: 10px">
            <v-text-field v-model="form.postal_code" color="blue darken-2" label="Postal Code" required></v-text-field>
            <small class="has-text-danger" v-if="errors.postal_code">{{ errors.postal_code[0] }}</small>
        </v-flex>
        <GmapAutocomplete @place_changed="setPlace" class="form-control" style="border: 2px solid #bbb5b552 !important;margin-left: 10px" v-model="form.address"></GmapAutocomplete>

        <v-flex sm5 style="margin-left: 6px">
            <VBtn color="primary" @click="update" :loading="loading" :disabled="loading">Update</VBtn>
        </v-flex>
    </v-layout>
</div>
</template>

<script>
export default {
    props: ['user'],
    data() {
        return {
            address: {},
            errors: {},
            form: {
                name: '',
                location: '',
            },
            loading: false,
        }
    },
    methods: {
        setPlace(place) {
            this.form.address = place;
        },
        update() {
            this.loading = true;
            axios.post('/address', this.form)
                .then(response => {
                    this.loading = false;
                        eventBus.$emit('alertRequest', 'Address updated')
                    this.allOrder = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    if (error.response.status === 500 || error.response.status === 405) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    } else if (error.response.status === 401 || error.response.status === 409) {
                        eventBus.$emit('reloadRequest', error.response.statusText)
                    }
                    this.errors = error.response.data.errors;
                });
        },
        getAddress() {
            axios.get('/address')
                .then(response => {
                    this.loading = false;
                    if (response.data) {
                        this.form = response.data;
                    }
                })
                .catch(error => {
                    this.loading = false;
                    if (error.response.status === 500 || error.response.status === 405) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    } else if (error.response.status === 401 || error.response.status === 409) {
                        eventBus.$emit('reloadRequest', error.response.statusText)
                    }
                    this.errors = error.response.data.errors;
                });
        },
    },
    mounted() {
        this.getAddress();
    },
}
</script>
