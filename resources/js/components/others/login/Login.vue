<template>
<v-dialog v-model="dialog" persistent max-width="500px">

    <v-card class="elevation-12">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Login form</v-toolbar-title>
            <v-spacer></v-spacer>

        </v-toolbar>
        <v-form method="POST" action="/login">
            <input type="hidden" name="_token" :value="csrf">

            <v-card-text>
                <v-text-field prepend-icon="person" name="email" label="Login" type="text"></v-text-field>

                <v-divider></v-divider>
                <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password"></v-text-field>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="checkbox">
                            <label>
                                remember me
                                <input type="checkbox" name="remember">
                            </label>
                        </div>
                    </div>
                </div>

            </v-card-text>
            <v-card-actions>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <a class="btn btn-link" href="/forgort">
                            Forgot Your Password
                        </a>
                    </div>
                </div>
                <v-spacer></v-spacer>
                <v-btn color="primary" type="submit">Login</v-btn>
                <v-btn color="primary" @click="close">Close</v-btn>
            </v-card-actions>
        </v-form>
    </v-card>
</v-dialog>
</template>

<script>
export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            dialog: false,
        }
    },
    methods: {
        close() {
            this.dialog = false
        }
    },
    created() {
        eventBus.$on('loginEvent', data => {
            this.dialog = true
        })
    },
}
</script>

<style scoped>

</style>
