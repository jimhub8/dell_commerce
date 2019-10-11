<template>
<v-layout row justify-center style="background: rgb(239, 239, 239) !important;">
    <v-card-text>
        <v-container grid-list-md>
            <v-layout wrap>
                <v-form ref="form" @submit.prevent="submit">
                    <v-container grid-list-xl fluid>
                        <v-layout wrap>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.user_name" color="blue darken-2" label="Full Name*" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.user_name">{{ errors.user_name[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.user_email" color="blue darken-2" label="Email*" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.user_email">{{ errors.user_email[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.user_address" color="blue darken-2" label="Address*" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.user_address">{{ errors.user_address[0] }}</small>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="account.user_phone" color="blue darken-2" label="Phone Number*" required></v-text-field>
                                <small class="has-text-danger" v-if="errors.user_phone">{{ errors.user_phone[0] }}</small>
                            </v-flex>
                        </v-layout>
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
            name: "",
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
