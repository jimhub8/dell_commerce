<template>
<v-layout row justify-center style="background: rgb(239, 239, 239) !important;">
    <v-card-text>
        <v-container grid-list-md>
            <v-layout wrap>
                <v-form ref="form" @submit.prevent="submit">
                    <v-container grid-list-xl fluid>
                        <v-layout wrap>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.company_name" color="blue darken-2" label="Legal Name / Company Name*" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.company_name">{{ errors.company_name[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.company_address" color="blue darken-2" label="Company Address*" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.company_address">{{ errors.company_address[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.address_2" color="blue darken-2" label="Company Address 2" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.address_2">{{ errors.address_2[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.company_phone" color="blue darken-2" label="Telephone Number*" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.company_phone">{{ errors.company_phone[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.company_email" color="blue darken-2" label="Company Email*" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.company_email">{{ errors.company_email[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.company_website" color="blue darken-2" label="Company Website" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.company_website">{{ errors.company_website[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.postal_code" color="blue darken-2" label="Company postal code" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.postal_code">{{ errors.postal_code[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.company_businessno" color="blue darken-2" label="Business Registration No." required></v-text-field>
                                <small class="has-text-danger" v-if="errors.company_businessno">{{ errors.company_businessno[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.location" color="blue darken-2" label="Plaza/Mall" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.location">{{ errors.location[0] }}</small>
                            </v-flex>
                        </v-layout>

                        <v-card>
                            <v-divider></v-divider>
                            <!-- <h6 class="text-center" color="green">Admin</h6> -->
                            <v-btn color="red" darken-1 raised @click="onPickFile" style="color: #fff;">Choose Logo</v-btn>
                            <input type="file" @change="Getimage" accept="image/*" style="display: none" ref="fileInput">
                            <img v-show="imagePlaced" :src="avatar" style="width: 200px; height: 200px;">
                            <!-- <v-btn @click="upload" flat v-show="imagePlaced" :loading="loading" :disabled="loading">Upload</v-btn> -->
                        </v-card>
                    </v-container>
                </v-form>
            </v-layout>
        </v-container>
    </v-card-text>
</v-layout>
</template>

<script>
export default {
    props: ['account', 'errors'],
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
            //   errors: {},
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
            axios
                .post("/vendor_company", this.$data.form)
                .then(response => {
                    console.log(response);
                    // this.$parent.AllCompanies.push(response.data)
                    // this.close;
                    // this.resetForm();
                    // this.$emit('closeRequest');
                    this.upload(response.data);
                    this.$emit("alertRequest");
                })
                .catch((error) => {
                    eventBus.$emit('errorEvent', 'Please confirm if all fields are filled')

                    this.errors = error.response.data.errors
                })
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
                .post(`/vendor_logo/${item.id}`, this.file)
                .then(response => {
                    this.loading = false;
                    console.log(response);
                    eventBus.$emit("alertRequest", "Successifully Created");
                    eventBus.$emit("companyResponse", item.id);

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
    created() {
        eventBus.$on('CompanyEvent', data => {
            this.save()
        })
    },
};
</script>
