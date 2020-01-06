<template>
<div>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" scrollable max-width="600px; max-height: 400vh">
                <ais-index app-id="V4Q0BRYFL9" api-key="725411e9791003be9e5a4cd11ad820dc" index-name="productname">
                    <ais-search-box></ais-search-box>
                    <v-divider></v-divider>
                    <ais-results>
                        <template slot-scope="{ result }">
                            <v-card-text>
                                <router-link :to="'/details/' + result.id" style="color: white">{{ result.product_name }}</router-link>
                            </v-card-text>
                        </template>
                    </ais-results>
                </ais-index>
        </v-dialog>
    </v-layout>
    <!-- <ul class="list-group">
        <li class="list-group-item active">
            <input v-model="seach" type="text" @keyup.enter="algolia_search" class="form-control" />
        </li>
        <li class="list-group-item" v-for="item in seach_results" v-if="seach_results.length > 0" :key="item.id">
                <router-link :to="'/details/' + item.id">{{ item.product_name }}</router-link>
        </li>
        <li class="list-group-item" v-else > 0">No Results</li>
    </ul> -->
    <!-- <el-select v-model="seach" filterable remote reserve-keyword placeholder="type at least 3 characters" :remote-method="algolia_search" :loading="loading" style="width: 100%;" @change="product_search">
        <el-option v-for="item in seach_results" :key="item.id" :label="item.product_name" :value="item.id">
        </el-option>
    </el-select> -->

</div>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';
import 'instantsearch.css/themes/algolia-min.css';
export default {
    components: {
        algoliasearch,
    },
    data() {
        return {
            seach_results: [],
            seach: '',
            dialog: false,
            loading: false
        }
    },
    methods: {
        algolia_search(data) {
            // console.log(data);

            axios.get(`/algolia_search/${this.seach}`).then((response) => {
                this.seach_results = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                }
                this.errors = error.response.data.errors
            })
        },

        product_search(data) {
            // console.log(data);

            eventBus.$emit("searchEvent", data);
            this.$router.push({
                name: "search",
                params: {
                    search: data
                }
            });

            // axios.get(`/algolia_search/${data}`).then((response) => {
            //     this.seach_results = response.data
            // }).catch((error) => {
            //     if (error.response.status === 500) {
            //         eventBus.$emit('errorEvent', error.response.statusText)
            //         return
            //     } else if (error.response.status === 401 || error.response.status === 409) {
            //         eventBus.$emit('reloadRequest', error.response.statusText)
            //     }
            //     this.errors = error.response.data.errors
            // })
        }
    },
    created() {
        eventBus.$on('openSearch', data => {
            this.dialog = true
        });
    },
}
</script>

<style lang="scss">
ul {
    // max-height: 80vh;
    // overflow-y: scroll;
}
</style>
