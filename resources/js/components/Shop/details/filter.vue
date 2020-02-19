<template>
<div>
    <div class="col-xs-12 col-md-12 sidebar-shop">
        <div class="sidebar-product-categori">
            <div class="widget-title">
                <h3>PRODUCT CATEGORIES</h3>
            </div>
            <div class="widget-content">
                <ul class="product-categories">
                    <li class="cat-item" v-for="cat in category" :key="cat.id">
                        <p style="cursor: pointer" @click="FilterShop(cat.id)">{{ cat.name }}</p>
                        <!-- <span class="count">(5)</span> -->
                    </li>
                </ul>
            </div>
            <div class="product-filter mb-30">
                <div class="widget-title">
                    <h3>Filter by price</h3>
                </div>
                <div class="widget-content">
                    <!-- <div id="price-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                        <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span>
                    </div> -->
                    <el-slider v-model="filter_data.price" range :max="500000" @change="FilterShop(filter_data.category_id)"></el-slider>

                    <div class="price-values">
                        <div class="price_text_btn">
                            <span>Price:</span>
                            <input type="text" class="price-amount" />
                        </div>
                        <button class="button" type="submit">Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            filter_data: {
                price: [0, 0],
                category_id: 0
            },
        }
    },
    methods: {
        FilterShop(id) {
            this.filter_data.category_id = id
            eventBus.$emit("progressEvent");
            var payload = {
                model: 'FilterShop',
                update: 'updateProductsList',
                data: this.filter_data,

            }
            this.$store.dispatch('filterData', payload)
                .then((res) => {
                    eventBus.$emit("StoprogEvent");
                })
        },
        getCategory() {
            var payload = {
                model: 'categories',
                update: 'updateCategoryList',
            }
            this.$store.dispatch('getData', payload)
        }
    },
    mounted() {
        this.getCategory();
    },
    computed: {
        category() {
            return this.$store.getters.category
        }
    },

}
</script>
