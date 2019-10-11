<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Add Prescription</span>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="close">
                    <v-icon color="black">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-form ref="form" @submit.prevent>
                            <v-container grid-list-xl fluid>
                                <v-layout wrap>
                                    <v-flex xs12 sm12>
                                        <v-textarea v-model="form.description" color="blue">
                                            <div slot="label">Special Instructions
                                                <small>(optional)</small>
                                            </div>
                                        </v-textarea>
                                    </v-flex>
                                </v-layout>
                                <!-- <v-card> -->
                                <v-divider></v-divider>
                                <img v-show="imagePlaced" :src="avatar" style="width: 200px; height: 200px;">
                                <v-btn color="red" darken-1 raised @click="onPickFile" style="color: #fff;">Upload Image</v-btn>
                                <input
                                    type="file"
                                    @change="Getimage"
                                    accept="image/*"
                                    style="display: none"
                                    ref="fileInput"
                                >
                                <!-- <v-btn @click="upload" flat v-show="imagePlaced" :loading="loading" :disabled="loading">Upload</v-btn> -->
                                <v-btn @click="cancle" flat v-show="imagePlaced">Cancel</v-btn>
                                <!-- </v-card> -->
                            </v-container>
                            <v-card-actions>
                                <v-btn flat @click="resetForm">reset</v-btn>
                                <v-btn flat @click="close">Close</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn :disabled="loading" :loading="loading" flat color="primary" @click="save">Submit</v-btn>
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
    components: {},
    data() {
        const defaultForm = Object.freeze({
            description: ""
        });
        return {
            errors: {},
            defaultForm,
            loading: false,
            disabled: true,
            dialog: false,
            form: Object.assign({}, defaultForm),
            avatar: "",
            imagePlaced: false
        };
    },
    methods: {
        onPickFile() {
            this.$refs.fileInput.click();
        },
        onFilePicked(event) {
            this.imagePlaced = true;
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
        Getimage(e) {
            let image = e.target.files[0];
            // this.read(image);
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                this.avatar = e.target.result;
            };
            this.imagePlaced = true;
            let form = new FormData();
            form.append("image", image);
            this.file = form;
            console.log(e.target.files);
        },

        upload(item) {
            this.loading = true;
            axios.post(`/preImg/${item.id}`, this.file)
                .then(response => {
                    this.loading = false;
                    // console.log(response);
                    this.imagePlaced = false;
                    this.color = "black";
                    this.text = "Profile image updated";
                    this.snackbar = true;
                    // this.close()
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },

        cancle() {
            this.avatar = this.LogedUser.profile;
            this.imagePlaced = false;
        },
        save() {
            this.loading = true;
            axios
                .post("/prescriptions", this.$data.form)
                .then(response => {
                    this.loading = false;
                    console.log(response);
                    this.close();
                    // this.resetForm();
                    this.upload(response.data);
                    // eventBus.$emit("alertRequest", 'Successifully Created');
                    this.$parent.products.push(response.data);
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        resetForm() {
            this.form = Object.assign({}, this.defaultForm);
            this.$refs.form.reset();
        },
        close() {
            this.dialog = false;
        }
    },
    created() {
        eventBus.$on("prescriptionEvent", data => {
            this.dialog = true;
            // this.item = data
        });
    },
    mounted() {
        axios
            .get("/brands")
            .then(response => {
                this.loader = false;
                this.brands = response.data;
            })
            .catch(error => {
                this.loader = false;
                this.errors = error.response.data.errors;
            });
    }
};
</script>
