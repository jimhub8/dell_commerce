<template>
<v-layout row justify-center style="background: rgb(239, 239, 239) !important;">

    <v-card-text>
        <v-container grid-list-md>
            <v-layout wrap v-show="!loader">
                <v-form ref="form" @submit.prevent>
                    <v-container grid-list-xl fluid>
                        <v-layout wrap>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.user_name" color="purple darken-2" label="Full name" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.user_name">{{ errors.user_name[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.user_email" color="blue darken-2" label="Email" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.email">{{ errors.user_email[0] }}</small>
                            </v-flex>
                            <!-- <v-flex xs12 sm6>
                                        <v-text-field :append-icon="e1 ? 'visibility_off' : 'visibility'" :type="e1 ? 'password' : 'text'" v-model="account.password" name="input-10-2" label="Enter your password" hint="At least 6 characters" min="8" value="" class="input-group--focused"></v-text-field>
                                        <small class="has-text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                    </v-flex> -->
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.user_address" color="blue darken-2" label="Address" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.user_address">{{ errors.user_address[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.city" color="blue darken-2" label="City" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.user_city">{{ errors.user_city[0] }}</small>
                            </v-flex>
                            <!-- <v-flex xs12 sm6>
                                        <v-text-field v-model="account.country" color="blue darken-2" label="Country" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.country">{{ errors.country[0] }}</small>
                                    </v-flex> -->
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.user_phone" color="blue darken-2" label="Phone" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.user_phone">{{ errors.user_phone[0] }}</small>
                            </v-flex>
                            <!-- <div class="form-group col-md-6">
                                <label class="col-md-6 col-form-label text-md-right" for="">Company</label>
                                <select class="custom-select custom-select-md col-md-12" v-model="form.company">
                                        <option v-for="company in companies" :key="company.id" :value="company.id">{{ company.company_name }}</option>
                                    </select>
                                <small class="has-text-danger" v-if="errors.company">{{ errors.company[0] }}</small>
                            </div> -->
                        </v-layout>
                    </v-container>
                </v-form>
            </v-layout>
            <div v-show="loader" style="text-align: center; width: 100%;">
                <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
            </div>
        </v-container>
    </v-card-text>
</v-layout>
</template>

<script>
export default {
    props: ['account', 'errors'],
    data() {
        const defaultForm = Object.freeze({
            name: '',
            // password: '',
            email: '',
            phone: '',
            branch: '',
            address: '',
            company: '',
            // country: '',
        })
        return {
            loading: false,
            // errors: [],
            selected: [],
            permissions: [],
            defaultForm,
            loader: false,
            e1: true,
            form: Object.assign({}, defaultForm),
            emailRules: [
                v => {
                    return !!v || 'E-mail is required'
                },
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
            rules: {
                name: [val => (val || '').length > 0 || 'This field is required']
            },
        }
    },
    methods: {
        save(id) {
            this.form.company = id
            this.loading = true
            axios.post('/vendor_user', this.$data.form).
            then((response) => {
                    this.loading = false
                    // console.log(response);
                    // this.resetForm();
                    this.$emit('alertRequest');
                    eventBus.$emit("userResponse");
                })
                .catch((error) => {
                    this.loading = false
                    if (error.response.status === 500) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    } else {
                        this.errors = error.response.data.errors
                    }
                    // console.log()
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

    created() {
        eventBus.$on('userEvent', data => {
            this.save(data)
        })
    },
}
</script>
