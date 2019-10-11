<template>
<div class="after container" @mouseleave="menuShow = false" style="margin-top: -7vh;">
            <div class="row" style="margin-top: 7vh;z-index: 1000;position: absolute;">
                <div class="col-2" style="min-width: 300px;max-width: 300px;margin-left: -5vw;">
                    <div class="list-group" id="list-tab" role="tablist"  style="text-align: right;">
                        <li class="" id="list-home-list" data-toggle="list" role="tab" aria-controls="home" v-for="(item, index) in menus" :key="index" @mouseover="showMenu(item)">{{ item.name }} > </li>
                    </div>
                </div>
                <div class="col-9" style="margin-left: -2vw;">
                    <div class="tab-content" id="nav-tabContent" v-show="menuShow" style="background: #fff;">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

                        <div class="row wrap">
                            <div class="card-columns col-md-10">
                                <div class="card"  v-for="(category, index) in categories" :key="index" style="margin: 0; width: 110%; border: none;">
                                    <div class="card-body" style="padding: 0;" id="category">
                                        <!-- <h5 class="card-title">{{ category.name }}</h5> -->
                                        <li class="active" @click="gotoCat(category.id)">{{ category.name }}</li>
                                        <!-- <v-btn flat color="primary" @click="gotoCat(category.id)">{{ category.name }}</v-btn> -->
                                        <li class="card-text" v-for="subcat in category.sub_categories" :key="subcat.id" @click="gotoSub(subcat.id)">{{ subcat.name }}</li>
                                        
                                    </div>
                                </div>
                            </div>
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
      menus: [], 
      menuShow: false,
      categories: [],
    };
  },
  methods: {
      
    showMenu(menu) {
      this.menuShow = true;
      this.categories = menu.categories;
    },
    gotoSub(item) {
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
  mounted() {
    axios
      .get("menus")
      .then(response => {
        this.menus = response.data;
      })
      .catch(error => {
        this.errors = error.response.data.errors;
      });
  }
};
</script>




<style scoped>

.after {
  position: absolute;
  color: #000;
  display: block;
}

#category .active {
  color: #e65540;
  padding: 5px 0;
  cursor: pointer;
  /* font-size: 17px; */
  font-style: italic;
  font-weight: bold;
}
#category .card-text {
  cursor: pointer;
  padding: 5px 0;
}

#category .card-text:hover {
  color: #f00;
}
</style>
