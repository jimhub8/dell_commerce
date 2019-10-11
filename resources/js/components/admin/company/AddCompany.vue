<template>
<v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="700px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Add Company</span>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-form ref="form" @submit.prevent="submit">
                            <v-container grid-list-xl fluid>
                                <v-layout wrap>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.company_name" color="blue darken-2" label="Company name" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.company_name">{{ errors.company_name[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.address" color="blue darken-2" label="Company Address" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.phone" color="blue darken-2" label="Telephone Number" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.email" color="blue darken-2" label="Company Email" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.country" color="blue darken-2" label="Country" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.country">{{ errors.country[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.city" color="blue darken-2" label="City/Street/Town" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.city">{{ errors.city[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.country" color="blue darken-2" label="Company country" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.country">{{ errors.country[0] }}</small>
                                    </v-flex>

                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.website" color="blue darken-2" label="Company Website" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.website">{{ errors.website[0] }}</small>
                                    </v-flex>
                                </v-layout>
                                <v-card>
                                    <v-divider></v-divider>
                                    <v-btn color="red" darken-1 raised @click="onPickFile" style="color: #fff;">Upload Logo</v-btn>
                                    <input type="file" @change="Getimage" accept="image/*" style="display: none" ref="fileInput">
                                    <img v-show="imagePlaced" :src="avatar" style="width: 200px; height: 200px;">
                                    <!-- <v-btn @click="upload" flat v-show="imagePlaced" :loading="loading" :disabled="loading">Upload</v-btn>
                                    <v-btn @click="close" flat>Close</v-btn> -->
                                </v-card>
                            </v-container>
                            <v-card-actions>
                                <v-btn flat @click="resetForm">reset</v-btn>
                                <v-btn flat @click="close">Close</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn flat color="primary" :loading="loading" @click="save">Submit</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-layout>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
export default {
    props: ["openAddRequest", "compAdmin"],
    components: {},
    data() {
        const defaultForm = Object.freeze({
            company_name: "",
            email: "",
            phone: "",
            address: "",
            website: ""
        });
        return {
            defaultForm,
            errors: {},
            form: Object.assign({}, defaultForm),
            rules: {
                name: [val => (val || "").length > 0 || "This field is required"]
            },
            loading: false,
            imagePlaced: false,
            avatar: ""
        };
    },
    methods: {
        save() {
            this.loading = true;
            axios
                .post("/companies", this.$data.form)
                .then(response => {
                    this.loading = false;
                    console.log(response);
                    // this.$parent.AllCompanies.push(response.data)
                    // this.close;
                    // this.resetForm();
                    // this.$emit('closeRequest');
                    this.upload(response.data);
                    this.$emit("alertRequest");
                })
                .catch(error => {
                    this.loading = false;
                    if (error.response.status === 500) {
                        eventBus.$emit("errorEvent", error.response.statusText);
                        return;
                    }
                    this.errors = error.response.data.errors;
                });
        },
        resetForm() {
            this.form = Object.assign({}, this.defaultForm);
            this.$refs.form.reset();
        },
        alert() {
            this.$emit("alertRequest");
        },
        close() {
            this.$emit("closeRequest");
        },

        Getimage(e) {
            this.imagePlaced = true;
            let image = e.target.files[0];
            // this.read(image);
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                this.avatar = e.target.result;
            };
            let form = new FormData();
            form.append("image", image);
            this.file = form;
            console.log(e.target.files);
        },

        upload(item) {
            this.loading = true;
            axios
                .post(`/logo/${item.id}`, this.file)
                .then(response => {
                    this.loading = false;
                    console.log(response);
                    eventBus.$emit("alertRequest", "Successifully Created");

                    this.close();
                })
                .catch(error => {
                    this.loading = false;
                    this.Editloader = false;
                    // this.close()
                    this.color = "red";
                    this.message = "Something went wrong";
                    this.snackbar = true;
                    this.errors = error.response.data.errors;
                });
        },
        // Image Upload
        onPickFile() {
            this.$refs.fileInput.click();
        },
        onFilePicked(event) {
            const files = event.target.files;
            let filename = files[0].name;
            if (filename.lastIndexOf(".") <= 0) {
                return alert("please upload a valid image");
            }
            const fileReader = new FileReader();
            fileReader.addEventListener("load", () => {
                this.avatar = fileReader.result;
            });
            fileReader.readAsDataURL(files[0]);
            this.image = files[0];
        },

        cancle() {
            if (this.companyLogo.logo.length > 0) {
                this.avatar = this.companyLogo.logo;
            } else {
                this.imagePlaced = false;
                this.avatar = "";
            }
        }
    },
    computed: {
        formIsValid() {
            return (
                this.form.company_name &&
                this.form.email &&
                this.form.phone &&
                this.form.address
            );
        }
    }
};
</script>
