<template>
<VCard style="padding: 20px;width: 80%; margin: auto;box-shadow: 7px 7px 8px -4px rgb(210, 225, 246),0 12px 17px 2px rgb(210, 225, 246),0 5px 22px 4px rgb(210, 225, 246) !important;">
    <v-stepper v-model="e6" vertical>
        <v-stepper-step :complete="e6 > 1" step="1">User information</v-stepper-step>
        <v-stepper-content step="1" style="background: #fff;">
            <v-card color="white lighten-1" class="mb-5">
                <myAddress :user="user" :form="form"></myAddress>
            </v-card>
            <v-btn color="primary" @click="goToStep2">Continue</v-btn>
        </v-stepper-content>

        <v-stepper-step :complete="e6 > 2" step="2">Payment</v-stepper-step>
        <v-stepper-content step="2" style="background: #fff;">
            <v-card color="white lighten-1" class="mb-5">
                <myPayment :account="account"></myPayment>
            </v-card>
            <v-btn color="primary" @click="goToStep3">Continue</v-btn>
            <v-btn flat @click="e6 = 1">Back</v-btn>
        </v-stepper-content>

        <v-stepper-step :complete="e6 > 3" step="3">Complete</v-stepper-step>
        <v-stepper-content step="3" style="background: #fff;">
            <v-card color="white lighten-1" class="mb-5">
                <myComplete :account="account"></myComplete>
            </v-card>
            <!-- <v-btn color="primary" @click="finish">Finish</v-btn> -->
            <v-btn flat @click="e6 = 2">Back</v-btn>
        </v-stepper-content>
    </v-stepper>
</VCard>
</template>

<script>
import myAddress from './Address'
import myPayment from './Payment'
import myComplete from './Complete'
export default {
    props: ['user'],
    components: {
        myAddress,
        myComplete,
        myPayment
    },
    data() {
        return {
            account: [],
            e6: 1,
            errors: {},
            form: {},
        }
    },
    methods: {
        goToStep2() {
            if (this.user) {
                this.account = this.user
            } else {
                this.account = this.form
            }
            if (this.account == {}) {
                eventBus.$emit('errorEvent', 'Please confirm if all fields  with * are filled')
                return
            }
            this.e6 = 2
            axios.patch(`/address/${this.user.id}`, this.account).
            then((response) => {})
                .catch((error) => {
                    if (error.response.status === 500) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    } else {
                        eventBus.$emit('errorEvent', 'Please confirm if all fields  with * are filled')
                        this.errors = error.response.data.errors
                    }
                    // console.log()
                })
        },
        goToStep3() {
            if (!this.account.payment) {
                eventBus.$emit('errorEvent', 'Please confirm if all fields  with * are filled')
                return
            }
            this.e6 = 3
            //   eventBus.$emit("CompanyEvent");
        },
        finish() {
            if (this.account.payment == 'Paypal') {
                eventBus.$emit("paypalEvent", this.account);
                return
            }
            this.loading = true
            axios.post('/vendor_user', this.$data.account).
            then((response) => {
                    this.loading = false
                    this.$emit('alertRequest', 'Account Created');
                    eventBus.$emit("userResponse");
                })
                .catch((error) => {
                    this.loading = false
                    if (error.response.status === 500) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    } else {
                        eventBus.$emit('errorEvent', 'Please confirm if all fields  with * are filled')
                        this.e6 = 1
                        this.errors = error.response.data.errors
                    }
                    // console.log()
                })
        },
        cancel() {
            window.location.replace('/')
        },

        showerror(data) {
            this.message = data;
            this.Scolor = "red";
            this.snackbar = true;
        },

    },
    created() {
        eventBus.$on('userResponse', data => {
            window.location.replace('/thankyou')
        })
        eventBus.$on('companyResponse', data => {
            this.e6 = 2
            // this.finish(data)
            this.company_id = data
        })
        eventBus.$on("errorEvent", data => {
            this.showerror(data);
        });
    },
}
</script>
