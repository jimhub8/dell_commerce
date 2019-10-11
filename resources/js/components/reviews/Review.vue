<template>
<v-layout row justify-center>
    <v-btn flat color="orange" @click="openDialog">Rate the product</v-btn>
    <v-dialog v-model="dialog" persistent max-width="400px">
        <v-card class="elevation-16 mx-auto">
            <v-card-title fixed>
                <h5 class="t-center" style="color: #000;text-transform: none;">
                    Rate <span style="color: rgba(2, 234, 0, 0.58);">{{ product.name }}</span>
                </h5>
                <!-- <span class="headline">Rate {{ product.name }}</span> -->
                <v-spacer></v-spacer>
                <v-btn icon dark @click="close">
                    <v-icon color="black">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                If you enjoy using {{ product.name }}, please take a few seconds to rate your experience with the product. It really helps!

                <div class="text-xs-center mt-5">
                    <v-rating v-model="review.rating" color="yellow darken-3" background-color="grey darken-1" empty-icon="$vuetify.icons.ratingFull" half-increments hover></v-rating>
                </div>

                <v-flex xs12 sm12>
                    <v-textarea v-model="review.comments" color="blue">
                        <div slot="label">
                            Your Review <small>(optional)</small>
                        </div>
                    </v-textarea>
                </v-flex>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions class="justify-space-between">
                <v-btn flat @click="close">No Thanks</v-btn>
                <v-btn color="primary" flat @click="rate" :loading="loading">
                    Rate Now
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
export default {
    props: ["pid", 'product'],
    data() {
        return {
            review: {
                rating: 0,
                comments: ""
            },
            loading: false,
            dialog: false
        };
    },
    methods: {
        rate() {
            this.loading = true;
            axios
                .post(`/rate/${this.pid}`, this.review)
                .then(response => {
                    this.loading = false;
                    // console.log(response);
                    this.close();
                    // this.resetForm();
                    eventBus.$emit("ReviewRequest");
                    eventBus.$emit("alertRequest", "Thanks for rating this product");
                    // this.$parent.brands.push(response.data)
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        openDialog() {
            this.dialog = true;
        },
        close() {
            this.dialog = false;
        }
    },
    mounted() {
        // axios.get('/categories')
        //     .then((response) => {
        //         this.loader = false
        //         this.categories = response.data
        //     })
        //     .catch((error) => {
        //         this.loader = false
        //         this.errors = error.response.data.errors
        //     })
    }
};
</script>
