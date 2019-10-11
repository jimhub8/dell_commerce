<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Image Update</span>
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
                                <v-card>
                                    <v-divider></v-divider>
                                    <v-card-text>
                                        <img :src="avatar" style="width: 100%; height: 200px;" v-show="actualImage">
                                        <img :src="avatar" style="width: 100%; height: 200px;" v-show="!actualImage">
                                    </v-card-text>
                                        <v-card-actions>
                                            <v-btn color="red" darken-1 raised @click="onPickFile" style="color: #fff;">Update Image</v-btn>
                                            <input type="file" @change="Getimage" accept="image/*" style="display: none" ref="fileInput">
                                            <v-btn flat @click="cancle" v-show="imagePlaced">Cancle</v-btn>
                                        </v-card-actions>
                                </v-card>
                            </v-container>
                            <v-card-actions>
                                <v-btn flat @click="close">Close</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn :disabled="loading" :loading="loading" flat color="primary" @click="upload" v-show="imagePlaced">Submit</v-btn>
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
// import VueUploadMultipleImage from 'vue-upload-multiple-image'
export default {
    props: ['openLogoRequest'],
    data() {
        return {
            errors: {},
            loading: false,
            dialog: false,
            disabled: true,
            avatar: "",
            actualImage: false,
            imagePlaced: false,
            company: []
        };
    },
    methods: {
        onPickFile() {
            this.$refs.fileInput.click();
        },
        onFilePicked(event) {
            this.actualImage = true;
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
            this.actualImage = true;
            this.imagePlaced = true;
            let form = new FormData();
            form.append("image", image);
            this.file = form;
            console.log(e.target.files);
        },

        upload() {
            this.loading = true;
            axios.post(`/logo/${this.company.id}`, this.file)
                .then(response => {
                    this.loading = false;
                    // console.log(response);
                    this.actualImage = false;
                    // this.color = "black";
                    // this.text = "Image updated";
                    // this.snackbar = true;
                    this.close();
                    eventBus.$emit("companyEvent");
                    this.imagePlaced = false;
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },

        cancle() {
            this.avatar = this.company.image;
            this.imagePlaced = false;
            this.actualImage = false;
        },
        close() {
            this.actualImage = false;
            this.dialog = false;
        }
    },
    created() {
        eventBus.$on("logoEvent", data => {
            this.company = data;
            this.avatar = data.logo;
            this.dialog = true;
        });
    }
};
</script>
