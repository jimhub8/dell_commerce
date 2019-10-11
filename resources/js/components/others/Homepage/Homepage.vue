<template>
<div>
    <mySlider :singleP="singleP"></mySlider>
    <!-- <myProduct></myProduct> -->
</div>
</template>

<script>
import mySlider from './Slider/Slider'
// import myProduct from './Product/Product'
export default {
    components: {
        mySlider,
        // myProduct
    },
    data(){
        return {
singleP: [],
        }
    },

    mounted() {
        axios.get("/getsP")
            .then(response => {
                this.singleP = response.data;
            })
            .catch(error => {
                // this.loading = false;
                this.errors = error.response.data.errors;
            });
    }
}
</script>

<style>

</style>
