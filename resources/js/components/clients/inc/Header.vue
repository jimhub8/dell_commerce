<template>
<div>
    <v-app id="inspire">
        <!-- temporary -->
        <v-navigation-drawer right temporary v-model="right" fixed></v-navigation-drawer>
        <!-- temporary -->
        <v-navigation-drawer fixed :color="color" :clipped="$vuetify.breakpoint.lgAndUp" app v-model="drawer">
            <v-list dense id="navigation">
                <v-img :aspect-ratio="16/9" src="storage/landS.jpg">
                    <v-layout pa-2 column fill-height class="lightbox white--text">
                        <v-spacer></v-spacer>
                        <v-flex shrink>
                            <div class="subheading">{{ user.name }}</div>
                            <div class="body-1">{{ user.email }}</div>
                        </v-flex>
                    </v-layout>
                </v-img>
                <template>
                    <v-card>
                        <!-- <v-card style="background: url('storage/ps/landS.jpg')"> -->
                        <router-link to="/profile" class="v-list__tile v-list__tile--link" v-if="user.can['view dashboard']">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">account_circle</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Profile</div>
                            </div>
                        </router-link>

                        <router-link to="/reviews" class="v-list__tile v-list__tile--link" v-if="user.can['view main category']">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">comment</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Reviews</div>
                            </div>
                        </router-link>
                        <router-link to="/wishlist" class="v-list__tile v-list__tile--link" v-if="user.can['view category']">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">settings</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Wishlist</div>
                            </div>
                        </router-link>
                        <router-link to="/myOrders" class="v-list__tile v-list__tile--link" v-if="user.can['view subcategory']">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">shopping_cart</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Orders</div>
                            </div>
                        </router-link>

                    </v-card>
                </template>
            </v-list>
        </v-navigation-drawer>
    </v-app>
</div>
</template>

<script>
import Notifications from "../notification/Notification";
import Logout from "./Logout";
export default {
    components: {
        Notifications,
        Logout
    },
    props: ["user", 'company'],
    data() {
        return {
            drawer: true,
            right: null,
        };
    },
};
</script>

<style scoped>
.v-expansion-panel__container:hover {
    border-radius: 10px !important;
    width: 90% !important;
    margin-left: 15px !important;
    background: #e3edfe !important;
    color: #1a73e8 !important;
}

.theme--light {
    background-color: #212120 !important;
    /* background: url('storage/logo1.jpg') !important; */
    color: #fff !important;
}
</style>
