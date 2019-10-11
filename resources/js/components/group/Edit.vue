<template>
<div>
    <el-dialog title="Sku Prefix" :visible.sync="dialog" width="30%">
        <el-input v-model="form.prefix" autocomplete="off"></el-input>
        <span slot="footer" class="dialog-footer">
            <el-button @click="dialog = false">Cancel</el-button>
            <el-button type="primary" @click="update">Submit</el-button>
        </span>
    </el-dialog>
    <v-content>
        <v-container fluid fill-height>
            <v-layout justify-center align-center>
                <v-card style="width: 100%">
                    <v-card-title>
                        <span class="headline text-center" style="margin: auto;">Create Items Group</span>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout row wrap>
                                <VCard style="width: 100%">
                                    <v-flex sm12>
                                        <v-card-text>
                                            <div>
                                                <label for="">Item Group Name</label>
                                                <el-input placeholder="Item Group Name" v-model="form.group_name"></el-input>
                                            </div>
                                            <div>
                                                <label for="">Description</label>
                                                <el-input type="textarea" placeholder="Description" v-model="form.description" maxlength="500" show-word-limit></el-input>
                                            </div>
                                            <v-layout row wrap>
                                                <v-flex sm4>

                                                    <label for="">Category</label> <br>
                                                    <el-select v-model="form.category" clearable placeholder="Display Name">
                                                        <el-option v-for="item in categories" :key="item.value" :label="item.name" :value="item.id">
                                                        </el-option>
                                                    </el-select>
                                                </v-flex>
                                                <v-flex sm4>

                                                    <label for="">Sub Category</label> <br>
                                                    <el-select v-model="form.category" clearable placeholder="Display Name">
                                                        <el-option v-for="item in categories" :key="item.value" :label="item.name" :value="item.id">
                                                        </el-option>
                                                    </el-select>
                                                </v-flex>
                                                <v-flex sm4>

                                                    <label for="">Unit</label> <br>
                                                    <el-select v-model="form.units" clearable placeholder="Display Name">
                                                        <el-option v-for="item in units" :key="item.value" :label="item.label" :value="item.value">
                                                        </el-option>
                                                    </el-select>
                                                </v-flex>
                                            </v-layout>
                                            <div>
                                                <label for="">Multiple Items?</label>
                                            </div>
                                            <VDivider />
                                            <div v-for="(attr, index) in attribute_arr" :key="index">
                                                <v-layout row wrap>
                                                    <v-flex sm4>
                                                        <label for="">Attribute</label> <br>
                                                        <el-select v-model="attr.attribute" clearable placeholder="Attribute">
                                                            <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                                            </el-option>
                                                        </el-select>
                                                    </v-flex>
                                                    <v-flex sm4 style="margin-left: 87px">
                                                        <label for="">Options</label>
                                                        <vue-tags-input v-model="attr.tag" :tags="attr.tags" @tags-changed="newTags => attr.tags = newTags" />
                                                    </v-flex>
                                                    <v-flex sm2>
                                                        <v-tooltip bottom>
                                                            <v-btn icon class="mx-0" @click="remove(index)" slot="activator" style="margin-top: 30px !important">
                                                                <v-icon small color="pink darken-2">delete</v-icon>
                                                            </v-btn>
                                                            <span>Remove</span>
                                                        </v-tooltip>
                                                    </v-flex>
                                                </v-layout>
                                            </div>
                                            <v-flex sm12>
                                                <v-btn raised color="info" @click="add_attribute" v-if="attribute_arr.length < 2">Add more attributes</v-btn>
                                            </v-flex>
                                        </v-card-text>
                                    </v-flex>

                                    <v-flex sm12>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">ITEM NAME</th>
                                                    <th scope="col">SKU
                                                        <span>
                                                            <v-tooltip bottom>
                                                                <v-btn icon class="mx-0" @click="sku_generate" slot="activator">
                                                                    <v-icon small color="pink darken-2">settings</v-icon>
                                                                </v-btn>
                                                                <span>Generate sku</span>
                                                            </v-tooltip>
                                                        </span>
                                                    </th>
                                                    <th scope="col">Price(KES)</th>
                                                    <th scope="col">REORDER LEVEL</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in itemAttribute_arr" :key="index">
                                                    <th scope="row">{{ index + 1 }}</th>
                                                    <td>{{ item.item_name }}</td>
                                                    <td>
                                                        <el-input placeholder="Please input" v-model="item.sku_no" clearable>
                                                        </el-input>
                                                    </td>
                                                    <td>
                                                        <el-input placeholder="Please input" v-model="item.price" clearable type="number">
                                                        </el-input>
                                                    </td>
                                                    <td>
                                                        <el-input placeholder="Please input" v-model="item.reorder_point" clearable type="number">
                                                        </el-input>
                                                    </td>
                                                    <td>
                                                        <v-tooltip bottom>
                                                            <v-btn icon class="mx-0" @click="deleteItem(index)" slot="activator">
                                                                <v-icon small color="pink darken-2">delete</v-icon>
                                                            </v-btn>
                                                            <span>Delete</span>
                                                        </v-tooltip>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </v-flex>
                                    <v-flex sm12>
                                        <v-btn color="info" @click="summary">summary</v-btn>
                                    </v-flex>
                                </VCard>
                            </v-layout>

                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="blue darken-1" flat @click="close">Close</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="save" :loading="loading" :disabled="loading">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-layout>
        </v-container>
    </v-content>
</div>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';
export default {
    components: {
        VueTagsInput,
    },
    data() {
        return {
            dialog: false,
            loading: false,
            options: [{
                value: 'Color',
                label: 'Color'
            }, {
                value: 'Size',
                label: 'Size'
            }, ],
            units: [{
                value: 'KGs',
                label: 'KGs'
            }, {
                value: 'Grams',
                label: 'Grams'
            }, {
                value: 'Pounds',
                label: 'Pounds'
            }, ],
            form: {},
            value: '',
            tag: '',
            attribute_arr: [{
                attribute: '',
                tag: '',
                tags: [],
            }],
            itemAttribute_arr: [],
            tags: [],
            attributeShow: '',
            u_id: null
        };
    },
    methods: {
        update() {
            this.dialog = false
            this.summary()
        },

        save() {
            this.form.itemAttribute_arr = this.itemAttribute_arr
            this.errors = {}
            this.loading = true
            axios.post('/groups', this.$data.form).then((response) => {
                this.loading = false
                // console.log(response);
                this.$store.dispatch('alertEvent', 'Product added')
                // this.$store.dispatch('getProducts')
                eventBus.$emit('productEvent', data)
                this.close()
            }).catch((error) => {
                // console.log(error.response);
                this.loading = false
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    this.loading = false
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                }
                this.errors = error.response.data.errors
            })
        },
        close() {
            this.dialog = false;
        },
        deleteItem(index) {
            this.itemAttribute_arr.splice(index, 1)
        },
        remove(index) {
            this.attribute_arr.splice(index, 1)
        },
        sku_generate() {
            this.dialog = true
        },
        summary() {
            this.itemAttribute_arr = []
            var i = 0
            if (this.attribute_arr.length < 1) {
                eventBus.$emit('errorEvent', 'select an attribute')
            }
            if (this.attribute_arr.length == 1) {
                for (let index = 0; index < this.attribute_arr.length; index++) {
                    const element = this.attribute_arr[index];
                    for (let key = 0; key < element.tags.length; key++) {
                        i++
                        const element_a = element.tags[key];
                        this.itemAttribute_arr.push({
                            item_name: this.form.group_name + element_a.text,
                            sku_no: this.form.prefix + ("00000000" + (parseInt(this.unique_sku) + i)).slice(-8),
                            price: 0,
                            reorder_point: 0,
                        })
                    }
                }
            } else {
                for (let index = 0; index < this.attribute_arr.length; index++) {
                    const element = this.attribute_arr[index];
                    // console.log(element);
                    for (let index_1 = 1; index_1 < this.attribute_arr.length; index_1++) {
                        const element_1 = this.attribute_arr[index_1];
                        // console.log(element_1);
                        for (let key = 0; key < element.tags.length; key++) {
                            const element_a = element.tags[key];
                            // console.log(element_a);
                            for (let key_1 = 0; key_1 < element_1.tags.length; key_1++) {
                                const element_b = element_1.tags[key_1];
                                if (element_a.text != element_b.text && element_a.text != '' && element_b.text != '' && element != element_1) {
                                    i++
                                    // console.log(element_a.text + element_b.text);
                                    this.itemAttribute_arr.push({
                                        item_name: this.form.group_name + '-' + element_b.text + '/' + element_a.text,
                                        sku_no: this.form.prefix + ("00000000" + (parseInt(this.unique_sku) + i)).slice(-8),
                                        price: 0,
                                        reorder_point: 0,
                                    })
                                }
                            }
                        }
                    }
                }
            }

        },
        add_attribute() {
            this.attribute_arr.push({
                attribute: '',
                tag: '',
                tags: [],
            })
        }
    },
    computed: {
        unique_sku() {
            return this.$store.getters.unique_sku
        }
    },
    mounted() {
        // this.$store.dispatch('getunique_sku')
        this.form = this.$route.params.data;
    },
}
</script>

<style>

</style>
