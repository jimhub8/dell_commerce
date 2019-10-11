<template>
<v-layout row justify-center>
    <v-dialog v-model="openShowRequest" persistent max-width="1000px">
        <v-card v-if="openShowRequest">
            <v-card-title>
                <span class="headline">{{ user.name }} Profile</span>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="close">
                    <v-icon color="black">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <!-- <avatar :username="user.name" style="font-size: 40px;margin: auto;padding: 50px;"></avatar> -->
                <img :src="user.profile" :alt="user.name" style="width: 150px; height: 150px; border-radius: 50%; text-align:center; margin-top 70px;margin-left-100px;margin-left: 45%;">
                <ul class="list-group">
                    <li class="list-group-item active"><b>Details</b></li>
                    <li class="list-group-item"><label for="">Name:</label><span style="margin-right: 100px; float: right;">{{ user.name }}</span></li>
                    <li class="list-group-item"><label for="">Role:</label><span style="margin-right: 100px; float: right;" v-for="role in user.roles" :key="role.id">{{ role.name }}</span></li>
                    <li class="list-group-item"><label for="">Phone:</label><span style="margin-right: 100px; float: right;">{{ user.phone }}</span></li>
                    <li class="list-group-item"><label for="">Email:</label><span style="margin-right: 100px; float: right;">{{ user.email }}</span></li>
                    <li class="list-group-item"><label for="">City:</label><span style="margin-right: 100px; float: right;">{{ user.city }}</span></li>
                    <li class="list-group-item"><label for="">Address:</label><span style="margin-right: 100px; float: right;">{{ user.address }}</span></li>
                </ul>
            </v-card-text>
            <v-card-actions>
                <v-btn color="blue darken-1" flat @click.native="close">Close</v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
import Avatar from 'vue-avatar'
export default {
    props: ['user', 'openShowRequest'],
    components: {
        Avatar
    },
    data() {
        return {
            AllShip: {
                data: []
            },
            pagin: [],
            permissions: [],
            // nextPage: false,
            loader: false,
            // AllShip: [],
        }
    },
    methods: {
        next(page) {
            this.loader = true
            axios.post(`/getUserPro/${this.pagin.id}?page=` + this.AllShip.current_page)
                .then((response) => {
                    this.loader = false
                    this.AllShip = response.data
                })
        },
        getShipmentsCl(data) {
            this.loader = true
            axios.post(`/getUserPro/${data.id}`)
                .then((response) => {
                    this.loader = false
                    this.AllShip = response.data
                })
                .catch((error) => {
                    this.loader = false
                    this.errors = error.response.data.errors
                })
        },
        close() {
            this.$emit('closeRequest')
        }
    },
    created() {
        eventBus.$on('getShipEvent', data => {
            this.getShipmentsCl(data)
            this.pagin = data
        });
    },
    mounted() {
        axios.get('/getPermissions')
            .then((response) => {
                this.permissions = response.data
            })
            .catch((errors) => {
                this.errors = error.response.data.errors
            })
    }
}
</script>
