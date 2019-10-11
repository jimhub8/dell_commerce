<template>
<div>
    <headerP></headerP>
    <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
    <section class="bgwhite p-t-55 p-b-65" v-show="!loader">
        <div class="container">
            <div class="text-center">
                <h3>Thank you for shopping</h3>
                <v-list>
                <router-link style="text-decoration: none; text-transform: none;" to="/shop" class="v-btn v-btn--flat theme--light primary--text">
                    <div class="v-btn__content">Go to Shop</div>
                            
                </router-link>
            </v-list>
            </div>
        </div>
    </section>
</div>
</template>

<script>
import headerP from "../include/Headerpartial";
export default {
    data() {
        return {
            loader: false 
        }
    },
};
</script>

<style scoped>
</style>
