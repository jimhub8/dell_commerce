<template>
<div>
<Best :product="product"></Best>
<Featured :product="product"></Featured>
<NewProduct :product="product"></NewProduct>
</div>
</template>

<script>
import NewProduct from './type/New'
import Featured from "./type/Featured";
import Best from "./type/Best";
export default {
    components: {
        NewProduct, Best, Featured
    },
    data() {
        return {

        }
    },
    mounted () {
        this.$store.dispatch('getProducts');
    },
    computed: {
        product() {
            return this.$store.getters.products
        }
    },
}
</script>

<style scoped>

</style>
