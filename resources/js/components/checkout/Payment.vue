<template>
<div>
    <h2>Select Payment Method</h2>
    <v-container grid-list-xl fluid>
        <v-layout wrap>
            <v-radio-group v-model="account.payment">
                <v-radio label="Cash On Delivery" value="Cash On Delivery"></v-radio>
                <v-radio label="Paypal" value="Paypal"></v-radio>
                <v-radio label="M-pesa" value="M-pesa"></v-radio>
            </v-radio-group>
        </v-layout>
    </v-container>
</div>
</template>

<script>
export default {
    props: ['user', 'account']
}
</script>

<style>

</style>
