<template>
<div class="text-xs-center">
    <v-menu v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-x  v-for="(category, index) in categories" :key="index">
        <v-btn slot="activator" color="indigo" dark>
           {{ category.name }}
        </v-btn>
        <!-- <v-list subheader>
            <v-subheader>Previous chats</v-subheader>

            <v-list-tile v-for="item in subcats" :key="item.title" @click="">
                <v-list-tile-content>
                    <v-list-tile-title v-html="item.name"></v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list> -->

        <v-card>
            <v-list>
                <v-list-tile avatar>
                    <v-list-tile-avatar>
                        <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John">
                    </v-list-tile-avatar>

                        <v-list-tile-content>
                            <v-list-tile-title>John Leider</v-list-tile-title>
                            <v-list-tile-sub-title>Founder of Vuetify.js</v-list-tile-sub-title>
                        </v-list-tile-content>

                        <v-list-tile-action>
                            <v-btn :class="fav ? 'red--text' : ''" icon @click="fav = !fav">
                                <v-icon>favorite</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                </v-list-tile>
            </v-list>

            <v-divider></v-divider>

            <v-list>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-switch v-model="message" color="purple"></v-switch>
                    </v-list-tile-action>
                    <v-list-tile-title>Enable messages</v-list-tile-title>
                </v-list-tile>

                <v-list-tile>
                    <v-list-tile-action>
                        <v-switch v-model="hints" color="purple"></v-switch>
                    </v-list-tile-action>
                    <v-list-tile-title>Enable hints</v-list-tile-title>
                </v-list-tile>
            </v-list>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn flat @click="menu = false">Cancel</v-btn>
                <v-btn color="primary" flat @click="menu = false">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-menu>
</div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            subcats: [],
            fav: true,
            menu: false,
            message: false,
            hints: true,
        }
    },
    mounted() {
        axios.get('categories')
            .then((response) => {
                this.categories = response.data
            })
            .catch((error) => {
                this.errors = error.response.data.errors;
            })

        axios.get('subcategories')
            .then((response) => {
                this.subcats = response.data
            })
            .catch((error) => {
                this.errors = error.response.data.errors;
            })
    },
}
</script>

<style scoped>

</style>
