<template>
<div>
    <v-content>
        <v-container fluid fill-height>
            <div v-show="loader" style="text-align: center; width: 100%; margin-top: 200px;">
                <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
            </div>
            <v-layout justify-center align-center v-show="!loader">
                <v-card>
                    <v-card-title>
                        Attribute
                        <v-btn @click="openAdd" flat color="primary">Add Attribute</v-btn>
                        <!-- <v-spacer></v-spacer> -->
                        <v-tooltip bottom>
                            <v-btn slot="activator" icon class="mx-0" @click="getAttributes">
                                <v-icon small color="blue darken-2">refresh</v-icon>
                            </v-btn>
                            <span>Refresh</span>
                        </v-tooltip>
                        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
                    </v-card-title>
                    <v-data-table :headers="headers" :items="attributes" class="elevation-1" :search="search" :loading="loading">
                        <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                        <template slot="items" slot-scope="props">
                            <td>{{ props.item.name }}</td>
                            <td class="text-xs-right">{{ props.item.created_at }}</td>
                            <td class="justify-center layout px-0">
                                <v-tooltip bottom>
                                    <v-btn slot="activator" icon class="mx-0" @click="editProduct(props.item.id)">
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
        </v-container>
        <myCreate></myCreate>
    </v-content>
</div>
</template>

<script>
import myCreate from './Create'
export default {
    components: {
        myCreate,
    },
    props: ['user'],

    data() {
        return {
            search: "",
            loader: false,
            loading: false,
            headers: [{
                    text: "Attribute Name",
                    align: "left",
                    value: "name"
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
            eventBus.$emit('createAttributeEvent')
        },

        editProduct(id) {
            this.$router.push({
                name: "AttributeEdit",
                params: {
                    id: id
                }
            });

        },
        getAttributes() {
            this.$store.dispatch('getAttributes')
        },
    },
    computed: {
        attributes() {
            return this.$store.getters.attributes
        }
    },
    mounted() {
        this.getAttributes();
    },

};
</script>
