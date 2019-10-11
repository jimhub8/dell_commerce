<template>
<div>
    <v-content>
        <v-container fluid fill-height>
            <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
                <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
            </div>
            <v-layout justify-center align-center v-show="!loader">
                <v-layout row wrap>
                    <v-card>
                        <v-card-title>
                            Category
                            <v-btn @click="openAdd" flat color="primary">Add Category</v-btn>
                            <!-- <v-spacer></v-spacer> -->
                            <v-tooltip bottom>
                                <v-btn slot="activator" icon class="mx-0" @click="getCategory">
                                    <v-icon small color="blue darken-2">refresh</v-icon>
                                </v-btn>
                                <span>Refresh</span>
                            </v-tooltip>
                            <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :headers="headers" :items="categories" class="elevation-1" :search="search" :loading="loading">
                            <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                            <template slot="items" slot-scope="props">
                                <td>{{ props.item.name }}</td>
                                <td class="text-xs-right">{{ props.item.description }}</td>
                                <td class="text-xs-right">{{ props.item.created_at }}</td>
                                <td class="justify-center layout px-0">
                                    <v-tooltip bottom v-if="user.can['edit category']">
                                        <v-btn slot="activator" icon class="mx-0" @click="editCategory(props.item)">
                                            <v-icon small color="blue darken-2">edit</v-icon>
                                        </v-btn>
                                        <span>Edit</span>
                                    </v-tooltip>
                                    <v-tooltip bottom v-if="user.can['edit category']">
                                        <v-btn slot="activator" icon class="mx-0" @click="deleteItem(props.item)">
                                            <v-icon small color="blue darken-2">delete</v-icon>
                                        </v-btn>
                                        <span>Delete</span>
                                    </v-tooltip>
                                </td>
                            </template>
                            <v-alert slot="no-results" :value="true" color="error" icon="warning">
                                Your search for "{{ search }}" found no results.
                            </v-alert>
                        </v-data-table>
                    </v-card>
                </v-layout>
            </v-layout>
        </v-container>
        <v-snackbar :timeout="timeout" bottom :color="color" left v-model="snackbar">
            {{ message }}
            <v-btn>close</v-btn>
        </v-snackbar>
    </v-content>
    <Create @closeRequest="close" :openAddRequest="dispAdd" @alertRequest="showAlert"></Create>
    <Edit @closeRequest="close" :openAddRequest="dispEdit" @alertRequest="showAlert" :category="catEdit"></Edit>
    <!-- <ShowTask @closeRequest="close" :openAddRequest="dispShow" @alertRequest="showAlert" :task="catEdit"></ShowTask> -->

</div>
</template>

<script>
import Create from "./Create";
import Edit from "./Edit";
// import ShowTask from './ShowTask';

export default {
    props: ['user'],
    components: {
        Create,
        Edit
    },

    data() {
        return {
            search: "",
            loading: false,
            dispAdd: false,
            dispEdit: false,
            dispShow: false,
            categories: [],
            catEdit: [],
            loader: false,
            snackbar: false,
            timeout: 5000,
            color: "",
            message: "",
            headers: [{
                    text: "Category Name",
                    align: "left",
                    value: "name"
                },
                {
                    text: "Description",
                    value: "description"
                },
                {
                    text: "Created On",
                    value: "created_at"
                },
                {
                    text: "Actions",
                    sortable: false
                }
            ]
        }
    },

    methods: {
        openAdd() {
            this.dispAdd = true;
        },
        close() {
            this.dispAdd = this.dispShow = this.dispEdit = false;
        },
        showAlert() {
            this.message = "Successifully Added";
            this.snackbar = true;
            this.color = "indigo";
        },
        deleteItem(item) {
            if (confirm('Are you sure you want to delete this item?')) {
                this.loading = true
                axios.delete(`/categories/${item.id}`)
                    .then((response) => {
                        this.loading = false
                        eventBus.$emit("alertRequest", 'Successifully deleted');
                        this.categories.splice(index, 1)
                    })
                    .catch((error) => {
                        this.loading = false
                        if (error.response.status === 500) {
                            eventBus.$emit('errorEvent', error.response.statusText)
                            return
                        }
                        this.errors = error.response.data.errors
                    })
            }
        },

        editCategory(task) {
            this.catEdit = Object.assign({}, task);
            this.editedIndex = this.categories.indexOf(task);
            this.dispEdit = true;
            eventBus.$emit('catSelectEvent', task.menu_id)
        },
        getCategory() {
            this.loader = true;
            axios
                .get("/categories")
                .then(response => {
                    this.loader = false;
                    this.categories = response.data;
                })
                .catch(error => {
                    this.loader = false;
                    this.errors = error.response.data.errors;
                });
        }
    },
    mounted() {
        this.loader = true;
        this.getCategory();
    },

    beforeRouteEnter(to, from, next) {
        next(vm => {
            if (vm.user.can['view category']) {
                next();
            } else {
                next('/unauthorized');
            }
        })
    }
};
</script>
