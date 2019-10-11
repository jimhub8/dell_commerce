<template>
<div>
    <v-card>
        <v-card-title>
            Brands&Categories
            <v-btn @click="filterItem" flat color="primary">Filter</v-btn>
        </v-card-title>
        <v-card-text style="max-height: 500px; overflow: scroll;">
            <div v-for="category in categories" :key="category.id">
                <v-list-group>
                    <v-list-tile slot="activator">
                        <v-list-tile-title>{{ category.name }}</v-list-tile-title>
                    </v-list-tile>

                    <div class="v-list__tile theme--light" v-for="brand in category.brands" :key="brand.id">
                        <v-checkbox v-model="filBrand" :label="brand.name" :value="brand.id"></v-checkbox>
                    </div>
                </v-list-group>
            </div>
        </v-card-text>
        <v-card-actions></v-card-actions>
    </v-card>
</div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            filBrand: [],
        }
    },
    methods: {
        getCategory() {
            axios.get('/categories')
                .then((response) => {
                    this.categories = response.data
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
        filterItem() {
            axios.post('/filterItem', this.$data.filBrand)
                .then((response) => {
                    eventBus.$emit("proFiltertEvent", response.data);
                    // this.categories = response.data
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
    },
    mounted() {
        this.getCategory()
    },
}
</script>

<style>

</style>
