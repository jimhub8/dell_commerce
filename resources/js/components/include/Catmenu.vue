<template>
<div style="col-xl-3 col-lg-3 hidden-md hidden-sm pull-left category-wrapper; margin-left: -70%;">
    <div class="categori-menu" @mouseleave="show_menu = false">
        <p @mouseover="show_menu = true" style="font-size: 23px;font-weight: 600;padding: 10px; color: #fff">
            <span> <VIcon color="white">menu</VIcon> </span>
            Categories
        </p>
        <ul class="categori-menu-list menu-hidden" style="display: block;" v-show="show_menu">
            <li v-for="(item, index) in menus" :key="index">
                <a href="shop.html">{{ item.name }}<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                <!-- categori Mega-Menu Start -->
                <ul class="ht-dropdown megamenu first-megamenu" style="width: auto;">
                    <!-- Single Column Start -->

                    <li class="single-megamenu" v-for="(category, index) in item.categories" :key="index">

                        <ul>
                            <v-layout row wrap>
                                <v-flex sm3>
                                    <li style="cursor:pointer" class="menu-tile" @click="gotoCat(category.id)">{{ category.name }}</li>
                                    <li style="cursor:pointer; color: black;" v-for="subcat in category.sub_categories" :key="subcat.id" @click="gotoSub(subcat.id)">{{ subcat.name }}</li>
                                </v-flex>
                            </v-layout>
                        </ul>
                    </li>
                    <!-- Single Column End -->
                </ul>
                <!-- categori Mega-Menu End -->
            </li>
        </ul>
    </div>
</div>
</template>

<script>
export default {
    props: ['menus', 'categories'],
    data() {
        return {
            show_menu: false,
        }
    },
    methods: {
        showMenu() {
            this.show_menu = true
            // this.show_menu = !this.show_menu
        },

        gotoSub(item) {
            eventBus.$emit("progressEvent");
            eventBus.$emit("goToSubEvent", item);
            this.$router.push({
                name: "Category",
                params: {
                    id: item,
                    type: "subcat"
                }
            });
            // eventBus.$emit("gotoSUbcatEvent", item);
        },
        gotoCat(item) {
            eventBus.$emit("progressEvent");
            eventBus.$emit("goToCatEvent", item);
            this.$router.push({
                name: "Category",
                params: {
                    id: item,
                    type: "cat"
                }
            });
            // eventBus.$emit("gotoCatEvent", item);
        },
    },
}
</script>
