<template>
<div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6"></div>
    </div>
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
    methods: {
        redirect(proId) {
            // alert('oooo')
            this.$router.push({
                name: 'details',
                params: {
                    id: proId
                }
            })

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
.v-menu--inline {
    width: 100% !important;
    min-width: 30% !important;
}

.v-menu__content {
    width: 50%;
    z-index: 1000;
}

.v-list__tile__title:hover {
    color: blueviolet;
}

.v-list__tile__title {
    cursor: pointer;
}
</style>
