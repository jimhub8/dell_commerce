<template>
<div>
    <v-content>
        <v-container fluid fill-height v-show="!loader">
            <v-layout justify-center align-center>
                <div class="container">
                    <v-card>
                        <h3 class="text-center">Clients</h3>
                        <v-divider></v-divider>
                        <v-card-title>
                            <v-tooltip right>
                                <v-btn icon slot="activator" class="mx-0" @click="getGroups">
                                    <v-icon color="blue darken-2" small>refresh</v-icon>
                                </v-btn>
                                <span>Refresh</span>
                            </v-tooltip>
                            <v-spacer></v-spacer>
                            <v-btn flat color="primary" @click="openCreate">Add Product</v-btn>
                            <!-- <v-btn flat color="primary" @click="openEdit(selected)">Edit</v-btn> -->
                        </v-card-title>
                        <vue-good-table class="table-hover" :columns="columns" :rows="groups.data" :search-options="{ enabled: true }" :pagination-options="{enabled: true,mode: 'pages'}" :sort-options="{enabled: true, initialSortBy: {field: 'name', type: 'asc'}}" v-loading="isLoading" @on-row-dblclick="openProducts">
                            <template slot="table-row" slot-scope="props">
                                <span v-if="props.column.field == 'actions'">
                                    <v-tooltip bottom>
                                        <v-btn icon class="mx-0" @click="openEdit(props.row)" slot="activator">
                                            <v-icon small color="blue darken-2">edit</v-icon>
                                        </v-btn>
                                        <span>Edit</span>
                                    </v-tooltip>
                                    <v-tooltip bottom>
                                        <v-btn icon class="mx-0" @click="deleteItem(props.row)" slot="activator">
                                            <v-icon small color="pink darken-2">delete</v-icon>
                                        </v-btn>
                                        <span>Delete</span>
                                    </v-tooltip>
                                </span>
                                <span v-else-if="props.column.field == 'group_name'">
                                    <span style="cursor: pointer">
                                        <v-icon color="primary">folder</v-icon> {{props.row.group_name}}
                                    </span>
                                </span>
                                <span v-else-if="props.column.field == 'created_at'">
                                    <span>
                                        <el-tag type="success">{{props.formattedRow.created_at}}</el-tag>
                                    </span>
                                </span>
                                <span v-else>
                                    {{props.formattedRow[props.column.field]}}
                                </span>
                            </template>
                        </vue-good-table>
                    </v-card>
                </div>
            </v-layout>
        </v-container>
    </v-content>
</div>
</template>

<script>
export default {
    components: {},
    data() {
        return {
            loading: false,
            isEmpty: false,
            loader: false,
            search: '',
            selected: [],
            columns: [
                // {
                //     label: 'Id#',
                //     field: 'id',
                //     type: 'number',
                // },
                {
                    label: 'Group name',
                    field: 'group_name',
                },
                {
                    label: 'Sku',
                    field: 'sku_no',
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
                },
            ],
            isPaginated: true,
            currentPage: 1,
            perPage: 5,
            items: ['Activate Box', 'Deactivate Box', 'Delete Box'],
        }
    },
    methods: {
        openCreate() {
            // eventBus.$emit('openCreateBox')
            this.$router.push({
                name: "groupCreate",
            });
        },

        openEdit(data) {
            this.$router.push({
                name: "groupEdit",
                params: {
                    data: data
                }
            });
        },

        openShow(data) {
            eventBus.$emit('openShowBox', data)
        },
        getGroups() {
            eventBus.$emit("LoadingEvent");
            this.$store.dispatch('getGroups');
        },
        deleteItem(item) {
            console.log(item)
            const index = this.$store.getters.groups.indexOf(item);
            if (confirm("Are you sure you want to delete this item?")) {
                axios
                    .delete(`/groups/${item.id}`)
                    .then(response => {
                        this.$store.getters.groups.splice(index, 1);
                        //// console.log(response);
                    })
                    .catch(error => (this.errors = error.response.data.errors));
            }
        },
        openProducts(data) {
            console.log(data.row.id);
            this.$router.push({
                name: "groupShow",
                params: {
                    id: data.row.id
                }
            });
        }
    },
    computed: {
        groups() {
            return this.$store.getters.groups
        },
        isLoading() {
            return this.$store.getters.loading;
        },
    },
    mounted() {
        eventBus.$emit("LoadingEvent");
        // this.$store.dispatch('getGroups');
        this.getGroups();
    },
    created() {
        eventBus.$on('boxEvent', data => {
            this.getGroups();
        })
    },
}
</script>
