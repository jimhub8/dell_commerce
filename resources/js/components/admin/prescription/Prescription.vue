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
                            Prescription
                            <v-btn @click="openAdd" flat color="primary">Add Prescription</v-btn>
                            <!-- <v-spacer></v-spacer> -->
                            <v-tooltip bottom>
                                <v-btn slot="activator" icon class="mx-0" @click="getCategory">
                                    <v-icon small color="blue darken-2">refresh</v-icon>
                                </v-btn>
                                <span>Refresh</span>
                            </v-tooltip>
                            <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :headers="headers" :items="prescriptions" class="elevation-1" :search="search" :loading="loading">
                            <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                            <template slot="items" slot-scope="props">
                                <td>{{ props.item.name }}</td>
                                <td class="text-xs-right">{{ props.item.description }}</td>
                                <td class="text-xs-right">{{ props.item.created_at }}</td>
                                <td class="justify-center layout px-0">
                                    <v-tooltip bottom>
                                        <v-btn slot="activator" icon class="mx-0" @click="editProduct(props.item)">
                                            <v-icon small color="blue darken-2">edit</v-icon>
                                        </v-btn>
                                        <span>Edit</span>
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
    <Edit @closeRequest="close" :openAddRequest="dispEdit" @alertRequest="showAlert" :prescription="catEdit"></Edit>
    <!-- <ShowTask @closeRequest="close" :openAddRequest="dispShow" @alertRequest="showAlert" :task="catEdit"></ShowTask> -->

</div>
</template>

<script>
import Create from "./Create";
import Edit from "./Edit";
// import ShowTask from './ShowTask';

export default {
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
            prescriptions: [],
            catEdit: [],
            loader: false,
            snackbar: false,
            timeout: 5000,
            color: "",
            message: "",
            headers: [{
                    text: "Prescription Name",
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

        editProduct(task) {
            this.catEdit = Object.assign({}, task);
            this.editedIndex = this.prescriptions.indexOf(task);
            this.dispEdit = true;
        },
        getCategory() {
            this.loading = true;
            axios
                .get("/prescriptions")
                .then(response => {
                    this.loader = false;
                    this.loading = false;
                    this.prescriptions = response.data;
                })
                .catch(error => {
                    this.loader = false;
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        }
    },
    mounted() {
        this.loader = true;
        this.getCategory();
    }
};
</script>
