<template>
<div>
    <v-expansion-panel>
        <v-expansion-panel-content v-for="category in categories" :key="category.id">
            <div slot="header">{{ category.name }}</div>
            <v-card>
                <v-card-text>
                    <v-radio-group v-model="radios.sub_cat" :mandatory="false" @change="getFilter">
                        <v-radio v-for="subcat in category.sub_categories" :key="subcat.id" :label="subcat.name" :value="subcat.id"></v-radio>
                    </v-radio-group>
                </v-card-text>
            </v-card>
        </v-expansion-panel-content>
    </v-expansion-panel>

    <v-expansion-panel>
        <v-expansion-panel-content>
            <div slot="header">Brands</div>
            <v-card>
                <v-card-text>
                    <v-radio-group v-model="radios.brand" :mandatory="false" @change="getFilter">
                        <v-radio v-for="brand in brands" :key="brand.id" :label="brand.name" :value="brand.id"></v-radio>
                    </v-radio-group>
                </v-card-text>
            </v-card>
        </v-expansion-panel-content>
    </v-expansion-panel>
</div>
</template>

<script>
export default {
    data() {
        return {
            radios: {
                sub_cat: '',
                brand: '',
                price: '',
            },
            categories: [],
            brands: []
        }
    },
    methods: {
        getFilter() {
            // alert(this.radios)
            eventBus.$emit("sideBarEvent", this.radios);

        },
        // getFilter(id) {
        //     axios.post("/filterItems", this.radios)
        //     .then(response => {
        //         this.loader = false;
        //         this.brands = response.data;
        //     })
        //     .catch(error => {
        //         this.loader = false;
        //         this.errors = error.response.data.errors;
        //     });
        // }
    },
    mounted() {
        axios.get("/categories")
            .then(response => {
                this.loader = false;
                this.categories = response.data;
            })
            .catch(error => {
                this.loader = false;
                this.errors = error.response.data.errors;
            });
            
        axios.get("/brands")
            .then(response => {
                this.loader = false;
                this.brands = response.data;
            })
            .catch(error => {
                this.loader = false;
                this.errors = error.response.data.errors;
            });
    }
}
</script>
