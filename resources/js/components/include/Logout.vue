<template>
<div class="text-xs-center">
    <v-menu v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-y transition="slide-y-transition">
        <v-btn icon slot="activator" dark>
            <v-icon color="primary lighten-1" large>
                account_circle
            </v-icon>
        </v-btn>

        <v-card>
            <v-list>
                <v-list-tile avatar>
                    <v-list-tile-avatar>
                        <!-- <avatar :username="user.name" style="font-size: 40px;margin: auto;padding: 50px;"></avatar> -->
                        <!-- <avatar :username="user.name" style="font-size: 20px;margin: auto;padding: 0px;"></avatar> -->
                        <img @error="onImageLoadFailure($event)" :src="user.profile" :alt="user.name">
                    </v-list-tile-avatar>

                        <v-list-tile-content>
                            <v-list-tile-title>{{ user.name }}</v-list-tile-title>
                        </v-list-tile-content>

                        <!-- <v-list-tile-action v-if="notifications.length > 0">
                        <v-tooltip bottom>
                            <v-btn slot="activator" :class="fav ? 'red--text' : ''" icon @click="read()">
                                <v-icon>check_circle</v-icon>
                            </v-btn>
                            <span>Mark as read</span>
                        </v-tooltip>
                    </v-list-tile-action> -->
                </v-list-tile>
                <v-divider></v-divider>
                <!-- <a :href="admin_url" class="v-list__tile v-list__tile--link" v-for="role in user.roles" :key="role.id" v-if="role.name != 'Client'" target="_blank">
                    <div class="v-list__tile__action">
                        <v-icon color="primary">account_circle</v-icon>
                        </div>
                    <div class="v-list__tile__content">
                        <div class="v-list__tile__title">
                            My account
                        </div>
                    </div>
                </a> -->
                <router-link to="/myOrders" class="v-list__tile v-list__tile--link">My orders</router-link>
            </v-list>

            <v-divider></v-divider>

            <v-card-actions>
                <form action="/logout" method="post">
                    <input type="hidden" name="_token" :value="csrf">
                    <!-- <v-btn flat color="primary" type="submit">Logout</v-btn>-->
                    <v-tooltip bottom>
                        <v-btn flat slot="activator" color="primary" icon class="mx-0" type="submit">
                            <i class="fa fa-sign-out"></i>
                        </v-btn>
                        <span>Logout from this device</span>
                    </v-tooltip>
                </form>

                <form action="/logoutOther" method="get">
                    <input type="hidden" name="_token" :value="csrf">
                    <!-- <v-btn flat color="orange" type="submit">Logout other devices out</v-btn> -->

                    <v-tooltip bottom>
                        <v-btn flat slot="activator" color="orange" icon class="mx-0" type="submit">
                            <i class="fa fa-sign-out"></i>
                        </v-btn>
                        <span>Logout other devices</span>
                    </v-tooltip>
                </form>
                <v-spacer></v-spacer>
                <v-btn flat @click="menu = false">close</v-btn>
            </v-card-actions>
        </v-card>
    </v-menu>
</div>
</template>

<script>
// import Avatar from 'vue-avatar'
export default {
    props: ['user'],
    computed: {
        // Avatar
    },
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            menu: false,
            admin_url: process.env.MIX_ADMIN_APP_URL,
        }
    },
    methods: {
        onImageLoadFailure(event) {
            event.target.src = '/storage/profile/image.png'
        }
    },
};
</script>

<style scoped>
/* .v-menu--inline {
    margin-top: -60px;
    float: right;
} */
</style>
