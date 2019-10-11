<template>
<v-stepper v-model="e6" vertical>
    <v-stepper-step :complete="e6 > 1" step="1">Seller Info</v-stepper-step>
    <v-stepper-content step="1" style="background: #fff;">
        <v-card color="grey lighten-1" class="mb-5">
            <Seller :account="account" :errors="errors"></Seller>
        </v-card>
        <v-btn color="primary" @click="goToStep2">Continue</v-btn>
    </v-stepper-content>

    <v-stepper-step :complete="e6 > 2" step="2">Company Details</v-stepper-step>
    <v-stepper-content step="2" style="background: #fff;">
        <v-card color="grey lighten-1" class="mb-5">
            <Company :account="account" :errors="errors"></Company>
        </v-card>
        <v-btn color="primary" @click="goToStep3">Continue</v-btn>
        <v-btn flat @click="e6 = 1">Back</v-btn>
    </v-stepper-content>

    <v-stepper-step :complete="e6 > 3" step="3">Bank Details</v-stepper-step>
    <v-stepper-content step="3" style="background: #fff;">
        <v-card color="grey lighten-1" class="mb-5">
            <Bank :account="account" :errors="errors"></Bank>
        </v-card>
        <v-btn color="primary" @click="finish" :loading="loading">Finish</v-btn>
        <v-btn flat @click="e6 = 2">Back</v-btn>
    </v-stepper-content>
    <v-snackbar :timeout="timeout" :bottom="y === 'bottom'" :color="Scolor" :left="x === 'left'" v-model="snackbar">
        {{ message }}
        <v-icon dark right>check_circle</v-icon>
    </v-snackbar>
</v-stepper>
</template>

<script>
import Register from './register/Register.vue';
import Company from './register/Company.vue';
import Bank from './register/Bank';
import Seller from './register/Seller';
export default {
    components: {
        Register,
        Company,
        Seller,
        Bank
    },
    data() {
        return {
            account: {
                user_name: '',
                user_email: '',
                user_phone: '',
                user_address: '',
                company_name: '',
                company_email: '',
                company_phone: '',
                company_address: '',
                company_businessno: '',
                company_website: '',
                account_no: '',
                account_name: '',
                mpesa_name: '',
                mpesa_phone: '',
            },
            e6: 1,
            errors: {},
            message: "Success",
            snackbar: false,
            y: "bottom",
            x: "left",
            Scolor: "",
            timeout: 5000,
        }
    },
    methods: {
        goToStep2() {
            if (this.account.user_name == '' || this.account.email == '' || this.account.phone == '') {
                eventBus.$emit('errorEvent', 'Please confirm if all fields  with * are filled')
                return
            }
            this.e6 = 2
            //   eventBus.$emit("CompanyEvent");
        },
        goToStep3() {
            if (this.account.company_name == '', this.account.company_email == '', this.account.company_phone == '', this.account.company_address == '', this.account.company_businessno == '') {
                eventBus.$emit('errorEvent', 'Please confirm if all fields  with * are filled')
                return
            }
            this.e6 = 3
            //   eventBus.$emit("CompanyEvent");
        },
        finish() {
            //   eventBus.$emit("userEvent", this.company_id);
            this.loading = true
            axios.post('/vendor_user', this.$data.account).
            then((response) => {
                    this.loading = false
                    window.location.replace('/thankyou')
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
            // window.location.replace('/thankyou')
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
