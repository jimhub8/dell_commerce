<template>
<v-content>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <v-card style="padding: 20px 0;">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item :to="{ path: '/' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item>Products</el-breadcrumb-item>
                    </el-breadcrumb>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <v-card style="padding: 10px 0;">
                    <v-layout row>
                        <v-flex sm1 style="margin-left: 10px;">
                            <v-tooltip right>
                                <v-btn icon slot="activator" class="mx-0" @click="getGroupPro">
                                    <v-icon color="blue darken-2" small>refresh</v-icon>
                                </v-btn>
                                <span>Refresh</span>
                            </v-tooltip>
                        </v-flex>
                        <v-flex sm1>
                            <h3 style="margin-left: 30px !important;margin-top: 10px;">Products</h3>
                        </v-flex>
                        <v-flex sm2>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <vue-good-table class="table-hover" :columns="columns" :rows="group_products.products" :search-options="{ enabled: true }" :pagination-options="{enabled: true,mode: 'pages'}" v-loading="isLoading" :sort-options="{enabled: true, initialSortBy: {field: 'id', type: 'asc'}}" :select-options="{ enabled: true }" @on-row-dblclick="openEdit" @on-selected-rows-change="selectionChanged" :selectOptions="{ enabled: true, selectOnCheckboxOnly: true}">
                    <template slot="table-row" slot-scope="props">
                        <!-- <span v-if="props.column.field == 'created_at'">
                                    <el-tag type="success">{{ props.rows.created_at }}</el-tag>
                                </span>  -->

                        <span v-if="props.column.field == 'created_at'">
                            <span>
                                <el-tag type="success">{{props.formattedRow.created_at}}</el-tag>
                            </span>
                        </span>
                        <span v-if="props.column.field == 'actions'">
                            <v-tooltip bottom v-if="user.can['edit products']">
                                <v-btn slot="activator" icon class="mx-0" @click="openEdit(props.row)">
                                    <v-icon small color="blue darken-2">edit</v-icon>
                                </v-btn>
                                <span>Edit</span>
                            </v-tooltip>
                            <v-tooltip bottom v-if="user.can['delete products']">
                                <v-btn slot="activator" icon class="mx-0" @click="deleteItem(props.row)">
                                    <v-icon small color="pink darken-2">delete</v-icon>
                                </v-btn>
                                <span>Delete</span>
                            </v-tooltip>
                            <v-tooltip bottom v-if="user.can['change products image']">
                                <v-btn slot="activator" icon class="mx-0" @click="imageUpdate(props.row)">
                                    <v-icon small color="info darken-2">image</v-icon>
                                </v-btn>
                                <span>Update image</span>
                            </v-tooltip>
                            <v-tooltip bottom v-if="user.can['view products']">
                                <v-btn slot="activator" icon class="mx-0" @click="view(props.row)">
                                    <v-icon small color="orange darken-2">visibility</v-icon>
                                </v-btn>
                                <span>View Product</span>
                            </v-tooltip>
                        </span>
                        <span v-else>
                            {{props.formattedRow[props.column.field]}}
                        </span>
                    </template>
                </vue-good-table>
            </v-flex>
        </v-layout>
        <myImage></myImage>
    </v-container>
</v-content>
</template>

<script>
import myImage from "../admin/products/Image";
export default {
    components: {
        myImage,
    },
    data() {
        return {
            form: {},
            loader: false,
            isEmpty: false,
            isBordered: true,
            isStriped: true,
            isNarrowed: false,
            isHoverable: true,
            isFocusable: true,
            hasMobileCards: true,
            isPaginated: true,
            currentPage: 1,
            perPage: 5,
            search: '',
            products_det: {
                data: []
            },
            products_search: [],
            temp: '',
            group_products: [],
            checkedRows: [],

            columns: [{
                    label: 'Id#',
                    field: 'id',
                    type: 'number',
                },
                {
                    label: 'Product Name',
                    field: 'product_name',
                },
                {
                    label: 'Sku Number',
                    field: 'sku_no',
                },
                {
                    label: 'Barcode',
                    field: 'bar_code',
                },
                {
                    label: 'Lot Product',
                    field: 'lot',
                    sortable: false,
                },
                {
                    label: 'Has Serial',
                    field: 'has_serial',
                    sortable: false,
                },
                {
                    label: 'Dangerouse Goods',
                    field: 'dangerous',
                    sortable: false,
                },
                {
                    label: 'Created On',
                    field: 'created_at',
                    type: 'date',
                    dateInputFormat: 'YYYY-MM-DD',
                    dateOutputFormat: 'Do MMMM YYYY',
                },
                {
                    label: 'Actions',
                    field: 'actions',
                    sortable: false,
                },
            ],
        }
    },
    methods: {
        openCreate() {
            eventBus.$emit('openCreateProduct')
        },
        openExcel() {
            eventBus.$emit('openExcelProduct')
        },
        openUpload() {
            eventBus.$emit('openChooseupload')
        },
        openEdit(data) {
            console.log(data.row.id)
            // router.push({ name: 'editProducts', params: { id: data.id } })
            this.$router.push({
                name: "editProducts",
                params: {
                    id: data.row.id
                }
            });
            // eventBus.$emit('openEditProduct', data)
        },

        imageUpdate(data) {
            eventBus.$emit("imageEvent", data);
        },
        openShow(data) {
            eventBus.$emit('openShowProduct', data)
        },
        getGroupPro() {
            // this.$store.dispatch('getGroupPro');
            axios.get(`/groups/${this.$route.params.id}`)
                .then((response) => {
                    this.group_products = response.data
                })

        },
        filter(data) {
            this.$store.dispatch('filterProd_table', data)
        },
        filteredList() {
            // console.log(this.products.data.filter(product => {
            //     return product.product_name.toLowerCase().includes(this.search.toLowerCase())
            // }));
            if (this.search.length < 1) {
                this.products
                return
            } else {
                this.products_det.data = this.products.data.filter(product => {
                    return product.product_name.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        },
        updateSelected(url) {
            // alert('test')
            if (this.checkedRows.length < 1) {
                eventBus.$emit('errorEvent', 'Please select atleast one row')
                return
            }

            this.$store.dispatch('updateSelected', {
                    url,
                    checked: this.checkedRows
                })
                .then((response) => {
                    eventBus.$emit('alertRequest', 'Updated')
                    this.checkedRows = []
                    this.getGroupPro()
                })
        },
        selectionChanged(params) {
            this.checkedRows = params.selectedRows
        },

        deleteItem(item) {
            if (confirm("Are you sure you want to delete this item?")) {
                this.loading = true;
                axios
                    .delete(`/products/${item.id}`)
                    .then(response => {
                        this.loading = false;
                        this.message = "deleted successifully";
                        this.color = "black";
                        this.snackbar = true;
                        this.products.splice(index, 1);
                    })
                    .catch(error => {
                        this.loading = false;
                        this.message = "something went wrong";
                        this.color = "red";
                        this.snackbar = true;
                        this.errors = error.response.data.errors;
                    });
            }
        },
    },
    computed: {
        isLoading() {
            return this.$store.getters.loading;
        },
    },
    mounted() {
        // this.$store.dispatch('getGroupPro');
        this.getGroupPro();
    },

}
</script>

<style scoped>
.el-input--prefix .el-input__inner {
    border-radius: 50px !important;
}

.v-toolbar__content,
.v-toolbar__extension {
    height: auto !important;
}
</style>
