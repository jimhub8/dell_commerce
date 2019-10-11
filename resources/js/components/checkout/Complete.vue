<template>
<div>
    <h2>Order Summary</h2>
    <v-container grid-list-xl fluid>
        <v-layout wrap>
            <v-flex sm5 offset-sm1>
                <h3>Billing Address</h3>
                {{ account.name }} <br>
                <address>{{ account.name }}</address>
                {{ account.country }} <br>
                {{ account.city }} <br>
                {{ account.phone }} <br>
            </v-flex>

            <v-flex sm5 offset-sm1>
                <h3>Billing Address</h3>
                {{ account.name }} <br>
                <address>{{ account.name }}</address>
                {{ account.country }} <br>
                {{ account.city }} <br>
                {{ account.phone }} <br>
            </v-flex>
        </v-layout>
        <myCart :account="account"></myCart>
    </v-container>
</div>
</template>

<script>
import myCart from './CartHome'
export default {
    props: ['account'],
    components: {
        myCart,
    },
}
</script>

<style>

</style>
